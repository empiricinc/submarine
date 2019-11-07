<?php 

/**
 * 
 */
class Field_joining_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}


	function get_employees($conditions=array(), $limit="", $offset="", $type="both")
	{

		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, ebi.father_name, g.gender_name AS gender, xe.email, ebi.personal_contact, ebi.contact_number, ebi.date_of_birth, xc.name as company_name, ebi.date_of_joining, xdd.department_name, xd.designation_name, p.name AS province, fj.doj, fj.cnic_no, fj.dob, fj.verified_through, fj.cnic_entry_at, fj.doj_entry_at");

        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');

        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');

        $this->db->join('provinces p', 'xe.provience_id = p.id', 'left');
        $this->db->join('field_joining fj', 'xe.employee_id = fj.employee_id', 'left');


		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);

		if($type == 'unverified')
			$this->db->where('cnic_no IS NULL AND doj IS NULL');
		elseif($type == 'cnic')
			$this->db->where('cnic_no IS NOT NULL AND doj IS NULL');
		elseif($type == 'doj')
			$this->db->where('doj IS NOT NULL AND cnic IS NULL');
		elseif($type == 'both')
			$this->db->where('cnic_no IS NOT NULL AND doj IS NOT NULL');

        // $this->db->order_by('CAST(xe.employee_id AS UNSIGNED)', 'ASC');
        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->order_by('xe.user_id', 'DESC');
        $this->db->group_by('xe.employee_id');
		return $this->db->get('xin_employees xe');
	}


	public function add_employee_doj($data)
	{
		return $this->db->insert('field_joining', $data);
	}

	public function doj_cnic_check($data)
	{
		return $this->db->insert('field_joining', $data);
	}

	public function update_field_joining($data, $where)
	{
		$this->db->where($where);
		return $this->db->update('field_joining', $data);
	}



}



 ?>