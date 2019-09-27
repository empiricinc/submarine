<?php



class Resignations_model extends CI_Model {

 

    public function __construct()
    {

        parent::__construct();

        $this->load->database();

    }


    public function get_resignations()
    {
        $this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
        // $this->db->join('xin_designations xd', 'xer.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        return $this->db->get('xin_employee_resignations xer');
    }

    public function get_detail($resignation_id)
    {
    	$this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		return $this->db->get_where('xin_employee_resignations xer', array('resignation_id' => $resignation_id));
    }
 


}
