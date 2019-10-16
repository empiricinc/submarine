<?php



class Terminations_model extends CI_Model {

 

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

    }

    public function get_employees($conditions=array(), $user_roles=array())
    {
    	// return $this->db->get_where('xin_employees', array('is_active' => '1'))->result();
        $this->db->select('xe.employee_id AS user_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name');

        if(!empty($user_roles))
        $this->db->where_not_in('xe.user_role_id', $user_roles);
        $this->db->where($conditions);
    	return $this->db->get('xin_employees xe')->result();
    }

    public function get_termination_reasons()
    {
    	return $this->db->get_where('termination_reasons', array('status' => '1'))->result();
    }

    public function add_new($data)
    {
    	return $this->db->insert('termination', $data);
    }

    public function get_terminations($conditions=array(), $limit="", $offset="")
    {
    	$this->db->select('xe.employee_id AS user_id, CONCAT(xe.first_name," ", IFNULL(xe.last_name, "")) AS employee_name, t.id, tr.reason_text, t.other_reason, t.description, t.termination_date, CONCAT(tby.first_name," ", IFNULL(tby.last_name, "")) AS terminator, xd.designation_name, xc.name AS company_name');
    	$this->db->join('xin_employees AS xe', 't.employee_id = xe.employee_id', 'left');
    	$this->db->join('xin_employees AS tby', 't.terminated_by = tby .user_id', 'left');
    	$this->db->join('termination_reasons AS tr', 't.reason_id = tr.id', 'left');
    	$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
    	$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        if(!empty($conditions))
            $this->db->where($conditions);

        $this->db->limit($limit, $offset);
    	return $this->db->get('termination AS t');
    }


    public function get_termination_detail($conditions=array())
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xd.designation_name, xc.name AS project_name, t.other_reason, t.description, t.notice_date, t.termination_date, rr.reason_text, CONCAT(tby.first_name, " ", IFNULL(tby.last_name, "")) AS terminated_by');
        $this->db->join('xin_employees xe', 't.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('termination_reasons rr', 't.reason_id = rr.id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');

        $this->db->join('xin_employees AS tby', 't.terminated_by = tby .user_id', 'left');
        $this->db->where($conditions);
        return $this->db->get('termination t')->row();
    }


    public function get_requests($conditions=array(), $limit="", $offset="")
    {
        $this->db->select('xe.employee_id AS user_id, CONCAT(xe.first_name," ", IFNULL(xe.last_name, "")) AS employee_name, t.id, tr.reason_text, t.other_reason, t.description, t.notice_date, CONCAT(tby.first_name," ", IFNULL(tby.last_name, "")) AS terminator, xd.designation_name, xc.name AS company_name');
        $this->db->join('xin_employees AS xe', 't.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_employees AS tby', 't.terminated_by = tby .user_id', 'left');
        $this->db->join('termination_reasons AS tr', 't.reason_id = tr.id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->where('t.status', '0');

        if(!empty($conditions))
            $this->db->where($conditions);

        $this->db->limit($limit, $offset);
        return $this->db->get('termination AS t');
    }


    public function confirmed_by($termination_id, $data)
    {
        $this->db->where('t.id', $termination_id);
        return $this->db->update('termination t', $data);
    }


    public function employee_status($resignation_id)
    {
        $this->db->select('employee_id');
        $rec = $this->db->get('termination')->row();
        $employee_id = $rec->employee_id;

        $this->db->where('employee_id', $employee_id);
        return $this->db->update('xin_employees', array('status' => '6', 'is_active' => '0'));
    }

 


}
