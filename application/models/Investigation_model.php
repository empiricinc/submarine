<?php 

/**
 * 
 */
class Investigation_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function add($data)
	{
		return $this->db->insert('investigation', $data);
	}

	function update($inv_id, $data)
	{
		$this->db->where('id', $inv_id);
		return $this->db->update('investigation', $data);
	}

	function upload_files($files = array())
	{
		return $this->db->insert_batch('investigation_files', $files);
	}

	function get_employees($conditions=array(), $limit="", $offset="", $user_roles=array())
	{
		$this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name,
			ebi.cnic, xc.name AS company_name, xdd.department_name, xd.designation_name, p.name AS province, ebi.date_of_birth');
		$this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');
        $this->db->join('provinces p', 'xe.provience_id = p.id', 'left');

        $this->db->where($conditions);
        $this->db->where_not_in('xe.user_role_id', $user_roles);
        $this->db->limit($limit, $offset);

        $this->db->order_by('xe.user_id', 'ASC');
        return $this->db->get('xin_employees xe');
	}

	public function employee_info($conditions=array(), $limit="", $offset="", $user_roles=array())
	{
		$employee_basic_info_fileds = ", ebi.father_name, ebi.date_of_birth, ebi.cnic, ebi.cnic_expiry_date, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.other_languages, ebi.relation_id AS relation, ebi.gender, ebi.marital_status, g.gender_name, m.marital_name";


		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.email AS email_address, xe.profile_picture, xc.company_id, g.gender_name,
		 xc.name as company_name, xdd.department_id, xdd.department_name, xd.designation_id, xd.designation_name, xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.provience_id, p.name AS province $employee_basic_info_fileds");
		      

        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');
        
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->join('provinces p', 'xe.provience_id = p.id', 'left');
        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');
        $this->db->join('marital_status m', 'ebi.marital_status = m.marital_id', 'left');


        $this->db->where($conditions);
        if(!empty($user_roles))
        	$this->db->where_not_in('xe.user_role_id', $user_roles);
        
        $this->db->limit($limit, $offset);

        return $this->db->get('xin_employees xe');
	}

	public function get_previous_inquiries($employee_id)
	{
		$this->db->select('i.*, ir.reason_text');
		$this->db->join('investigation_reasons ir', 'i.reason_id = ir.id', 'left');
		$this->db->where('employee_id', $employee_id);
		return $this->db->get('investigation i')->result();
	}

	public function add_investigation($data)
	{
		return $this->db->insert('investigation', $data);
	}

	public function upload($files = array())
	{
		return $this->db->insert_batch('investigation_files', $files);
	}


	public function get_investigations($conditions=array(), $limit="", $offset="")
	{
		if(array_key_exists('i.id', $conditions))
		{
			$this->db->select('i.*, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS action_taken_by, ebi.cnic');
			$this->db->join('xin_companies AS xc', 'i.project_id = xc.company_id', 'left');
			$this->db->join('xin_designations AS xd', 'i.designation_id = xd.designation_id', 'left');
			$this->db->join('xin_departments AS xds', 'i.department_id = xds.department_id', 'left');
			$this->db->join('investigation_reasons AS ir', 'i.reason_id = ir.id', 'left');
			$this->db->join('xin_employees xe', 'i.employee_id = xe.employee_id', 'left');
			$this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
					
			$this->db->join('xin_employees atb', 'i.action_by = atb.employee_id', 'left');
			$this->db->where($conditions);
			return $this->db->get('investigation AS i');
		}

		$this->db->select('i.*, xc.name AS project_name, xd.designation_name, xds.department_name, ir.reason_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, ebi.cnic');
		$this->db->join('xin_companies AS xc', 'i.project_id = xc.company_id', 'left');
		$this->db->join('xin_designations AS xd', 'i.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments AS xds', 'i.department_id = xds.department_id', 'left');
		$this->db->join('investigation_reasons AS ir', 'i.reason_id = ir.id', 'left');
		$this->db->join('xin_employees xe', 'i.employee_id = xe.employee_id', 'left');
		$this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
		
		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);

		$this->db->order_by('i.id', 'desc');
		return $this->db->get('investigation AS i');
	}


	public function get_comments($id, $type)
	{
		$this->db->select('ic.id, ic.comment_text, ic.status, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, ic.added_date');
		$this->db->join('xin_employees xe', 'ic.added_by = xe.employee_id', 'left');
		$this->db->where(array('ic.investigation_id' => $id, 'ic.type' => $type));

		return $this->db->get('investigation_comments ic')->result();

	}

	public function add_comments($data)
	{
		return $this->db->insert('investigation_comments', $data);
	}

	public function investigation_files($id)
	{
		$this->db->select('if.*, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name');
		
		$this->db->join('xin_employees xe', 'if.uploaded_by = xe.employee_id', 'left');
		$this->db->where('investigation_id', $id);
		return $this->db->get('investigation_files if');
	}

	public function update_status($id, $data=array())
	{
		$this->db->where('id', $id);
		return $this->db->update('investigation', $data);
	}

	public function get_reasons()
	{
		return $this->db->get('investigation_reasons')->result();
	}




}




 ?>