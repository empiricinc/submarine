<?php 

/**
 * 
 */
class Disciplinary_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function add($data)
	{
		return $this->db->insert('disciplinary', $data);
	}

	function upload_files($files = array())
	{
		return $this->db->insert_batch('disciplinary_files', $files);
	}

	public function employee_info($conditions=array(), $limit="", $offset="", $user_roles=array())
	{

		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.date_of_birth, xe.company_id,
		 xc.name as company_name, xdd.department_id, xdd.department_name, xd.designation_id, xd.designation_name, xe.provience_id, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.job_title, ebi.cnic");
		      
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');       
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');

        $this->db->where($conditions);
        if(!empty($user_roles))
        	$this->db->where_not_in('xe.user_role_id', array(1, 2));
        
        $this->db->limit($limit, $offset);

        return $this->db->get('xin_employees xe');
	}


	function disciplinary_actions($conditions=array(), $limit="", $offset="")
	{
		if(array_key_exists('di.id', $conditions))
		{
			$this->db->select('di.*, xc.name AS project_name, xd.designation_name, xds.department_name, dr.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, CONCAT(c_by.first_name, " ", IFNULL(c_by.last_name, "")) AS created_by, ebi.cnic, ebi.job_title, ebi.date_of_joining, di.status_id, ds.status_text, dt.type_name, dc.name AS category_name');
			$this->db->join('xin_companies AS xc', 'di.project_id = xc.company_id', 'left');
			$this->db->join('xin_designations AS xd', 'di.designation_id = xd.designation_id', 'left');
			$this->db->join('xin_departments AS xds', 'di.department_id = xds.department_id', 'left');
			$this->db->join('disciplinary_reasons AS dr', 'di.reason_id = dr.id', 'left');
			$this->db->join('xin_employees c_by', 'di.created_by = c_by.employee_id', 'left');
			$this->db->join('xin_employees xe', 'di.employee_id = xe.employee_id', 'left');
			$this->db->join('employee_basic_info ebi', 'di.employee_id = ebi.user_id', 'left');
			$this->db->join('disciplinary_status ds', 'di.status_id = ds.id', 'left');
			$this->db->join('disciplinary_type dt', 'di.type_id = dt.id', 'left');
			$this->db->join('disciplinary_category dc', 'di.category_id = dc.id', 'left');
					
			$this->db->where($conditions);
			return $this->db->get('disciplinary AS di');
		}

		$this->db->select('di.*, xc.name AS project_name, xd.designation_name, xds.department_name, dr.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, ds.status_text, dt.type_name, ebi.father_name, ebi.cnic, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.date_of_birth, ebi.job_title, CONCAT(c_by.first_name, " ", IFNULL(c_by.last_name, "")) AS created_by_name');
		$this->db->join('xin_companies AS xc', 'di.project_id = xc.company_id', 'left');
		$this->db->join('xin_designations AS xd', 'di.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments AS xds', 'di.department_id = xds.department_id', 'left');
		$this->db->join('disciplinary_reasons AS dr', 'di.reason_id = dr.id', 'left');
		$this->db->join('xin_employees xe', 'di.employee_id = xe.employee_id', 'left');
		$this->db->join('xin_employees c_by', 'di.created_by = c_by.employee_id', 'left');
		$this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
		$this->db->join('disciplinary_status ds', 'di.status_id = ds.id', 'left');
		$this->db->join('disciplinary_type dt', 'di.type_id = dt.id', 'left');
		
		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);

		$this->db->order_by('di.id', 'desc');
		return $this->db->get('disciplinary AS di');

	}


	function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('disciplinary', $data);
	}

	function disciplinary_status()
	{
		return $this->db->get('disciplinary_status');
	}

	function disciplinary_files($disciplinary_id)
	{
		$this->db->select('df.original_name, df.file_name, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, df.upload_date');
		$this->db->join('xin_employees xe', 'df.uploaded_by = xe.employee_id', 'left');
		$this->db->where('disciplinary_id', $disciplinary_id);
		return $this->db->get('disciplinary_files df');
	}

	function add_comments($data)
	{
		return $this->db->insert('disciplinary_comments', $data);
	}


	function get_comments($id, $type="")
	{
		$this->db->select('dc.id, dc.comment_text, ds.status_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, dc.added_date');
		$this->db->join('disciplinary_status ds', 'dc.status_id = ds.id', 'left'); 
		$this->db->join('xin_employees xe', 'dc.added_by = xe.employee_id', 'left');
		$this->db->where('dc.disciplinary_id', $id);
		$this->db->where('dc.type', $type);
		return $this->db->get('disciplinary_comments dc')->result();

	}

	function get_max_status($id)
	{
		$this->db->select('MAX(ds.id) AS status_id, ds.status_text');
		$this->db->join('disciplinary_status ds', 'dc.status_id = ds.id', 'left');
		$this->db->where('dc.disciplinary_id', $id);
		return $this->db->get('disciplinary_comments dc')->row();
	}

	function disciplinary_reasons()
	{
		return $this->db->get('disciplinary_reasons');
	}


	function get_disciplinary_type()
	{
		return $this->db->get('disciplinary_type');
	}

	function get_status_id($status_text="")
	{
		$this->db->where('status_text', $status_text);
    	return $this->db->get('disciplinary_status')->row();
	}

	function get_template($type_id)
	{
		$this->db->where('disciplinary_type_id', $type_id);
		return $this->db->get('disciplinary_documents')->row();
	}

	function position_filled_against()
	{
		return $this->db->get('position_filled_against')->result();
	}

	function transfer_types()
	{
		return $this->db->get('transfer_type')->result();
	}

	function job_positions($conditions=array())
	{
		$this->db->select('DISTINCT(xin_designations.designation_id), xin_designations.designation_name');
		$this->db->join('xin_designations', 'location_job_position.designation_id = xin_designations.designation_id', 'left');
		$this->db->where($conditions);
		return $this->db->get('location_job_position')->result();
	}

	function get_districts($conditions=array())
	{
		$this->db->select('DISTINCT(district.id), district.name');

		$this->db->join('district', 'location_job_position.district_id = district.id');
		$this->db->where($conditions);
		return $this->db->get('location_job_position')->result();
	}

	function get_tehsils($conditions=array())
	{
		$this->db->select('DISTINCT(tehsil.id), tehsil.name');
		
		$this->db->join('tehsil', 'location_job_position.tehsil_id = tehsil.id');
		$this->db->where($conditions);
		return $this->db->get('location_job_position')->result();
	}

	function get_union_councils($conditions=array())
	{
		$this->db->select('DISTINCT(union_councel.id), union_councel.name');
		
		$this->db->join('union_councel', 'location_job_position.uc_id = union_councel.id');
		$this->db->where($conditions);
		return $this->db->get('location_job_position')->result();
	}

	function reason_descriptions($reason_id="")
	{
		$this->db->select('disciplinary_reason_description_id AS desc_id, name');
		$this->db->where('disciplinary_reason_id', $reason_id);
		return $this->db->get('disciplinary_reason_descriptions')->result();
	}

	function categories()
	{
		return $this->db->get('disciplinary_category')->result();
	}

	function get_employee_name($employee_id)
	{
		$this->db->select('CONCAT(first_name, " ", IFNULL(last_name, "")) AS employee_name');
		$this->db->where('employee_id', $employee_id);
		return $this->db->get('xin_employees')->row();
	}

	function get_employee_signature($employee_id)
	{
		$this->db->select('image_name');
		$this->db->where('employee_id', $employee_id);
		return $this->db->get('employee_signature')->row();
	}

	function previous_action($employee_id, $disciplinary_id)
	{
		$this->db->select('disciplinary.id, disciplinary_type.type_name, disciplinary_status.status_text');
		$this->db->join('disciplinary_type', 'disciplinary.type_id = disciplinary_type.id', 'left');
		$this->db->join('disciplinary_status', 'disciplinary.status_id = disciplinary_status.id', 'left');
		$this->db->order_by('disciplinary.id', 'DESC');
		$this->db->limit(1);
		$this->db->where(array('disciplinary.employee_id' => $employee_id, 'disciplinary.id !=' => $disciplinary_id));
		return $this->db->get('disciplinary')->row();
	}

}




 ?>