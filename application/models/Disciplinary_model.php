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
		 xc.name as company_name, xdd.department_id, xdd.department_name, xd.designation_id, xd.designation_name, xe.provience_id, ebi.personal_contact, ebi.contact_number, ebi.contact_other");
		      
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
			$this->db->select('di.*, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, di.status_id, ds.status_text, dt.type_name');
			$this->db->join('xin_companies AS xc', 'di.project_id = xc.company_id', 'left');
			$this->db->join('xin_designations AS xd', 'di.designation_id = xd.designation_id', 'left');
			$this->db->join('xin_departments AS xds', 'di.department_id = xds.department_id', 'left');
			$this->db->join('investigation_reasons AS ir', 'di.reason_id = ir.id', 'left');
			$this->db->join('employee_basic_info ebi', 'di.employee_id = ebi.user_id', 'left');
			$this->db->join('xin_employees xe', 'di.employee_id = xe.employee_id', 'left');
			$this->db->join('disciplinary_status ds', 'di.status_id = ds.id', 'left');
			$this->db->join('disciplinary_type dt', 'di.type_id = dt.id', 'left');
					
			$this->db->where($conditions);
			return $this->db->get('disciplinary AS di');
		}

		$this->db->select('di.*, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, ds.status_text, dt.type_name');
		$this->db->join('xin_companies AS xc', 'di.project_id = xc.company_id', 'left');
		$this->db->join('xin_designations AS xd', 'di.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments AS xds', 'di.department_id = xds.department_id', 'left');
		$this->db->join('investigation_reasons AS ir', 'di.reason_id = ir.id', 'left');
		$this->db->join('employee_basic_info ebi', 'di.employee_id = ebi.user_id', 'left');
		$this->db->join('xin_employees xe', 'di.employee_id = xe.employee_id', 'left');
		$this->db->join('disciplinary_status ds', 'di.status_id = ds.id', 'left');
		$this->db->join('disciplinary_type dt', 'di.type_id = dt.id', 'left');
		
		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);

		return $this->db->get('disciplinary AS di');

	}

	// function get_disciplinary_status($id)
	// {

	// }

	function update_status($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('disciplinary', $data);
	}

	function disciplinary_status()
	{
		return $this->db->get('disciplinary_status');
	}

	function add_comments($data)
	{
		return $this->db->insert('disciplinary_comments', $data);
	}

	// function comments()
	// {
	// 	return $this->db->get('disciplinary_comments')->result();
	// }

	function get_comments($id)
	{
		$this->db->select('dc.id, dc.comment_text, ds.status_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, dc.added_date');
		$this->db->join('disciplinary_status ds', 'dc.status_id = ds.id', 'left'); 
		$this->db->join('xin_employees xe', 'dc.added_by = xe.employee_id', 'left');
		$this->db->where('dc.disciplinary_id', $id);
		return $this->db->get('disciplinary_comments dc')->result();

	}

	function get_max_status($id)
	{
		$this->db->select('MAX(ds.id) AS status_id, ds.status_text');
		$this->db->join('disciplinary_status ds', 'dc.status_id = ds.id', 'left');
		$this->db->where('dc.disciplinary_id', $id);
		return $this->db->get('disciplinary_comments dc')->row();
	}


	function get_disciplinary_type()
	{
		return $this->db->get('disciplinary_type')->result();
	}



}




 ?>