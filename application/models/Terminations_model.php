<?php



class Terminations_model extends CI_Model {

 

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

    }

    public function get_employees()
    {
    	// return $this->db->get_where('xin_employees', array('is_active' => '1'))->result();
    	return $this->db->get_where('employee_basic_info')->result();
    }

    public function get_termination_reasons()
    {
    	return $this->db->get_where('termination_reasons', array('status' => '1'))->result();
    }

    public function add_new($data)
    {
    	return $this->db->insert('termination', $data);
    }

    public function get_terminations($limit="", $offset="")
    {
    	$this->db->select('xe.user_id, CONCAT(xe.first_name," ", xe.last_name) AS employee_name, t.id, tr.reason_text, t.other_reason, t.description, t.notice_date, CONCAT(tby.first_name," ", tby.last_name) AS terminator, xd.designation_name');
    	$this->db->join('xin_employees AS xe', 't.employee_id = xe.user_id', 'left');
    	$this->db->join('xin_employees AS tby', 't.terminated_by = tby .user_id', 'left');
    	$this->db->join('termination_reasons AS tr', 't.reason_id = tr.id', 'left');
    	$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
    	$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->limit($limit, $offset);
    	return $this->db->get('termination AS t');
    }

 


}
