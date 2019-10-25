<?php 


/**
 * 
 */
class Employee_cards_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get_employee_cards($conditions=array(), $limit="", $offset="")
    {
        $this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.contact_no, xd.designation_name, ebi.cnic, ebi.contact_number, ebi.personal_contact,
            ebi.date_of_birth, ebi.job_title, xc.name AS project_name, ec.id AS card_id, ec.status, ec.issue_date, ec.expiry_date, ebi.date_of_joining, ec.print_date, ec.deliver_date, ec.receive_date");

        $this->db->join('xin_employees xe', 'ec.employee_id = xe.employee_id', 'left');
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');        
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');

        $this->db->limit($limit, $offset);

        if(!empty($conditions))
            $this->db->where($conditions);

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->order_by('ec.id', 'DESC');
        
        return $this->db->get('employee_cards ec');
    }

    function add($data)
    {
        return $this->db->insert('employee_cards', $data);
    }

    function check_previous_request($employee_id)
    {
        $this->db->where(array('employee_id' => $employee_id, 'status !=' => '4'));
        return $this->db->get('employee_cards');
    }

    function update_card_status($conditions=array(), $data=array())
    {
    	$this->db->where($conditions);
		return $this->db->update('employee_cards', $data);
    }

}



 ?>