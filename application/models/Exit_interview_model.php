<?php 

/**
 * 
 */
class Exit_interview_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function resignation_detail($conditions=array())
	{
		$this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xe.email, ebi.father_name, ebi.cnic, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.date_of_birth, ebi.date_of_joining, xc.name AS project_name, xd.department_name, xdd.designation_name, p.name AS province_name, rr.reason_text, xer.resignation_id, xer.reason, xer.notice_date, xer.resignation_date');

		$this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
		$this->db->join('employee_basic_info ebi', 'xer.employee_id = ebi.user_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$this->db->join('xin_departments xd', 'xe.department_id = xd.department_id', 'left');
		$this->db->join('xin_designations xdd', 'xe.designation_id = xdd.designation_id', 'left');
		$this->db->join('provinces p', 'xe.provience_id = p.id', 'left');

		$this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');

		$this->db->where($conditions);
		return $this->db->get('xin_employee_resignations xer');
	}


}


 ?>