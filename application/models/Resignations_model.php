<?php


class Resignations_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function get_resignations($conditions=array(), $limit="", $offset="")
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xd.designation_name, xc.name AS project_name, rr.reason_text, xer.resignation_id, xer.resignation_date, xer.reason, rs.status_text');
        $this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('resignation_status rs', 'xer.status = rs.id', 'left');

        if(!empty($conditions))
            $this->db->where($conditions);

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->limit($limit, $offset);
        $this->db->order_by('xer.resignation_id', 'DESC');
        return $this->db->get('xin_employee_resignations xer');
    }


    public function get_detail($conditions=array())
    {
        $this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xd.designation_name, xc.name AS project_name, rr.reason_text, xer.resignation_id, xer.notice_date, xer.resignation_date, xer.subject, xer.description, xer.decision_date, xer.reason, xer.created_at, xer.reversion_approved_by, xer.reversion_request_date, xer.reversion_approval_date, xer.acceptance_letter, xer.exit_interview_status, rs.id AS status_id, rs.status_text, CONCAT(aby.first_name, " ", aby.last_name) AS decision_by, CONCAT(rby.first_name, " ", IFNULL(rby.last_name, "")) AS reversion_by, rev.reason_text AS reversion_reason');

    	$this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('resignation_status rs', 'xer.status = rs.id', 'left');

        $this->db->join('xin_employees aby', 'xer.decision_by = aby.user_id', 'left');
        $this->db->join('xin_employees rby', 'xer.reversion_approved_by = rby.employee_id', 'left');
        $this->db->join('resignation_reversion_reasons rev', 'xer.reversion_reason = rev.id', 'left');

        $this->db->where($conditions);

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
		return $this->db->get('xin_employee_resignations xer');
    }

    public function decision_detail($resignation_id)
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS decision_by, xer.decision_date');
        $this->db->join('xin_employees xe', 'xer.decision_by = xe.employee_id', 'left');
        $this->db->where('xer.resignation_id', $resignation_id);
        return $this->db->get('xin_employee_resignations xer')->row();
    }

    public function reversion_detail($resignation_id)
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS reversion_by, xer.reversion_request_date, xer.reversion_approval_date, r.reason_text');
        $this->db->join('xin_employees xe', 'xer.reversion_approved_by = xe.employee_id', 'left');
        $this->db->join('resignation_reversion_reasons r', 'xer.reversion_reason = r.id', 'left');
        $this->db->where('xer.resignation_id', $resignation_id);
        return $this->db->get('xin_employee_resignations xer')->row();
    }

    public function add($data)
    {
        return $this->db->insert('resignation_comments', $data);
    }

    public function update($resignation_id, $data)
    {
        $this->db->where(array('resignation_id' => $resignation_id));
        return $this->db->update('xin_employee_resignations', $data);
    }

    public function get_status_id($status_text)
    {
        $this->db->select('id');
        $this->db->where('status_text', $status_text);
        return $this->db->get('resignation_status')->row();
    }

    public function accept_resignation($resignation_id, $data)
    {
        $this->db->where('resignation_id', $resignation_id);
        return $this->db->update('xin_employee_resignations', $data);
    }

    public function employee_status($resignation_id, $status, $is_active)
    {
        $this->db->select('employee_id');
        $rec = $this->db->get('xin_employee_resignations')->row();
        $employee_id = $rec->employee_id;

        $this->db->where('employee_id', $employee_id);
        return $this->db->update('xin_employees', array('status' => $status, 'is_active' => $is_active));
    }

    public function check_resignation_status($employee_id)
    {
        $this->db->where('decision_by IS NULL');
        $this->db->where('employee_id', $employee_id);
        $rows = $this->db->get('xin_employee_resignations')->num_rows();

        if($rows > 0)
            return true;
        else
            return false;
    }

    public function get_status_comments($resignation_id)
    {
        $this->db->select('rs.status_text, rc.comment_text, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, rc.added_date, rc.created_at');
        $this->db->join('resignation_status rs', 'rc.status_id = rs.id', 'left');
        $this->db->join('xin_employees xe', 'rc.added_by = xe.employee_id', 'left');
        $this->db->where('rc.resignation_id', $resignation_id);
        return $this->db->get('resignation_comments rc')->result();
    }

    public function resignation_reversion_reasons()
    {
        return $this->db->get('resignation_reversion_reasons')->result();
    }


    public function acceptance_letter_template()
    {
        $this->db->select('description');
        $this->db->where('name', 'Resignation Acceptance');
        return $this->db->get('document_templates')->row();
    }

    public function employee_detail_for_letter($resignation_id)
    {
        $this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, ebi.job_title, ebi.cnic, xer.notice_date, xer.resignation_date');
        $this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->where('xer.resignation_id', $resignation_id);
        return $this->db->get('xin_employee_resignations xer')->row();
    }

}
