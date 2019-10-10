<?php 

/**
 * 
 */
class Insurance_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function get_employees($conditions=array(), $limit="", $offset="")
	{
		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xc.name as project_name, xe.date_of_joining, xdd.department_name, xd.designation_name, ebi.contact_number, ebi.date_of_birth, ebi.cnic, ebi.email_address, i.from_date, i.to_date, i.status");

		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');

        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->join('employee_permanent_location_info epli', 'xe.employee_id = epli.user_id', 'left');
        $this->db->join('employee_residential_info eri', 'xe.employee_id = eri.user_id', 'left');

        $this->db->join('insurance i', 'xe.employee_id = i.employee_id', 'left');

		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);

        // $this->db->order_by('CAST(xe.employee_id AS UNSIGNED)', 'ASC');

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->order_by('xe.user_id', 'ASC');
		return $this->db->get('xin_employees xe');
	}

    function get_insurance_claims($conditions=array(), $limit="", $offset="")
    {
        $this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xc.name AS project_name, xdd.department_name, xd.designation_name, ic.*, ebi.contact_number, ebi.personal_contact, cnic, ebi.date_of_birth, ebi.father_name, g.gender_name, CONCAT(rb.first_name, ' ', rb.last_name) AS remarks_by_name, CONCAT(db.first_name, ' ', db.last_name) AS decision_by_name");

        $this->db->join('xin_employees xe', 'ic.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_employees rb', 'ic.remarks_by = rb.employee_id', 'left');
        $this->db->join('xin_employees db', 'ic.decision_by = db.employee_id', 'left');

        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');

        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');
        $this->db->join('employee_permanent_location_info epli', 'xe.employee_id = epli.user_id', 'left');
        $this->db->join('employee_residential_info eri', 'xe.employee_id = eri.user_id', 'left');

        $this->db->limit($limit, $offset);

        if(!empty($conditions))
            $this->db->where($conditions);

        // $this->db->order_by('CAST(xe.employee_id AS UNSIGNED)', 'ASC');
        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->order_by('xe.user_id', 'ASC');
        return $this->db->get('insurance_claims ic');
    }

	function add_claim($data)
	{
		return $this->db->insert('insurance_claims', $data);
	}

    function update($data, $employee_id)
    {
        $this->db->where('employee_id', $employee_id);
        return $this->db->update('insurance', $data);
    }

    function insurance_log($data)
    {
        return $this->db->insert('insurance_log', $data);
    }

    function get_pending_insurances($conditions=array(), $limit="", $offset="")
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, i.from_date, i.to_date, i.status, xc.name AS project_name, xd.department_name, xdd.designation_name');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_departments xd', 'xe.department_id = xd.department_id', 'left');
        $this->db->join('xin_designations xdd', 'xe.designation_id = xdd.designation_id', 'left');
        $this->db->join('insurance i', 'xe.employee_id = i.employee_id', 'left');

        $this->db->limit($limit, $offset);
        
        if(!empty($conditions))
            $this->db->where($conditions);

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        return $this->db->get('xin_employees xe');
    }


    function check_insurance_status($employee_id)
    {
        return $this->db->get_where('insurance i', array('i.employee_id' => $employee_id))->row();
    }


    function upload($files = array())
    {
        return $this->db->insert_batch('insurance_files', $files);
    }

    function update_insurance_claim($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('insurance_claims', $data);
    }

    function get_insurance_files($id)
    {
        $this->db->where('insurance_claim_id', $id);
        return $this->db->get('insurance_files');
    }

    // function get_insurance_claims($conditions="", $limit="", $offset="")
    // {
    //     $this->db->select('CONCAT(xe.first_name, " ", xe.last_name) AS emp_name, xc.name AS project_name, xd.department_name, xdd.designation_name, ic.type');
    //     $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
    //     $this->db->join('xin_departments xd', 'xe.department_id = xd.department_id', 'left');
    //     $this->db->join('xin_designations xdd', 'xe.designation_id = xdd.designation_id', 'left');

    //     $this->db->join('insurance_claims ic', 'xe.employee_id = ic.employee_id', 'left');

    //     if($conditions != "")
    //         $this->db->where($conditions);

    //     if($limit != "")
    //         $this->db->limit($limit, $offset);
    //     return $this->db->get('xin_employees xe');
    // }



}


?>