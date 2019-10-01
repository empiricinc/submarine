<?php



class Resignations_model extends CI_Model {

 

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

    }


    public function get_resignations($conditions=array(), $limit="", $offset="")
    {
        $this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
        // $this->db->join('xin_designations xd', 'xer.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->where('xer.status >', '0');

        if(!empty($conditions))
            $this->db->where($conditions);

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->limit($limit, $offset);
        return $this->db->get('xin_employee_resignations xer');
    }

    public function get_requests($conditions=array(), $limit="", $offset="")
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xd.designation_name, xc.name AS project_name, rr.reason_text, xer.resignation_id, xer.resignation_date, xer.reason');
        $this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
        // $this->db->join('xin_designations xd', 'xer.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->where('xer.status', '0');

        if(!empty($conditions))
            $this->db->where($conditions);

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->limit($limit, $offset);
        return $this->db->get('xin_employee_resignations xer');
    }

    public function get_detail($conditions=array())
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xd.designation_name, xc.name AS project_name, rr.reason_text, CONCAT(aby.first_name, " ", aby.last_name) AS decision_by, xer.notice_date, xer.resignation_date, xer.subject, xer.description, xer.decision_date, xer.reason');
    	$this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_employees aby', 'xer.decision_by = aby.user_id', 'left');
        $this->db->where($conditions);

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
		return $this->db->get('xin_employee_resignations xer');
    }

    public function accept_resignation($resignation_id, $data)
    {
        $this->db->where('resignation_id', $resignation_id);
        return $this->db->update('xin_employee_resignations', $data);
    }

    public function employee_status($resignation_id)
    {
        $this->db->select('employee_id');
        $rec = $this->db->get('xin_employee_resignations')->row();
        $employee_id = $rec->employee_id;

        $this->db->where('employee_id', $employee_id);
        return $this->db->update('xin_employees', array('status' => '5', 'is_active' => '0'));
    }

    public function check_resignation_status($employee_id)
    {
        $this->db->where(array('employee_id' => $employee_id, 'status' => '0'));
        $rows = $this->db->get('xin_employee_resignations')->num_rows();

        if($rows > 0)
            return true;
        else
            return false;
    }


}
