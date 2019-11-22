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

	public function get($conditions=array())
	{
		$this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xe.email, ebi.father_name, ebi.job_title, ebi.cnic, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.date_of_birth, ebi.date_of_joining, xc.name AS project_name, xd.department_name, xdd.designation_name, p.name AS province_name, rr.reason_text, xer.resignation_id, xer.reason, xer.notice_date, xer.resignation_date');

		$this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
		$this->db->join('employee_basic_info ebi', 'xer.employee_id = ebi.user_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$this->db->join('xin_departments xd', 'xe.department_id = xd.department_id', 'left');
		$this->db->join('xin_designations xdd', 'xe.designation_id = xdd.designation_id', 'left');
		$this->db->join('provinces p', 'xe.provience_id = p.id', 'left');

		$this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
		$this->db->join('resignation_status rs', 'xer.status = rs.id', 'left');

		$this->db->order_by('xer.resignation_date', 'ASC');
		$this->db->where_not_in('rs.status_text', array('rejected', 'reversal'));
		$this->db->where($conditions);
		return $this->db->get('xin_employee_resignations xer');
	}

	public function get_detail($conditions=array())
	{
		$this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, ebi.job_title, xer.resignation_id, ei.id AS exit_interview_id, ei.supervisor_name, ei.last_working_date, ei.interview_date, ei.respondent_found, ei.respondent_not_found_reason, ei.respondent_not_found_other_reason, ei.endorsed_by_authority, ei.authority_name, ei.designation_id, ei.resignation_enforced, ei.resignation_enforced_detail, ei.position_leaving_reason, ei.position_leaving_other_reason, ei.position_leaving_comments, ei.company_property_returned, ei.supervision, ei.supervisor_support, ei.like_to_rejoin');
		
		$this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
		$this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
		$this->db->join('exit_interview ei', 'xer.resignation_id = ei.resignation_id', 'left');

		$this->db->where($conditions);
		return $this->db->get('xin_employee_resignations xer');
	}

	public function position_leaving_reasons()
	{
		$this->db->select('id, reason_text');
		return $this->db->get('position_leaving_reasons')->result();
	}

	public function respondent_not_found_reasons()
	{
		$this->db->select('id, reason_text');
		return $this->db->get('respondent_not_found_reasons')->result();
	}

	public function add($data)
	{
		return $this->db->insert('exit_interview', $data);
	}

	public function update($interview_id, $data)
	{
		$this->db->where('id', $interview_id);
		return $this->db->update('exit_interview', $data);
	}

	public function check_record_existence($resignation_id)
	{
		$this->db->select('id');
		$this->db->where('resignation_id', $resignation_id);
		return $this->db->get('exit_interview');
	}


}


 ?>