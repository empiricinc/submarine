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
		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.status AS employee_status, xc.name as project_name, xdd.department_name, xd.designation_name, ebi.date_of_birth, ebi.date_of_joining AS doj, ebi.contact_number, i.from_date, i.to_date, i.status");

		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->join('insurance i', 'xe.employee_id = i.employee_id', 'left');

		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);


        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->order_by('xe.user_id', 'DESC');
		return $this->db->get('xin_employees xe');
	}

    function get_insurance_claims($conditions=array(), $limit="", $offset="")
    {
        $this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xc.name AS project_name, xdd.department_name, xd.designation_name, ic.id, ic.type, ic.incident_date, ic.reporting_date, ic.status, ebi.contact_number");

        $this->db->join('xin_employees xe', 'ic.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');

        $this->db->limit($limit, $offset);

        if(!empty($conditions))
            $this->db->where($conditions);

        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->order_by('ic.entry_at', 'DESC');
        return $this->db->get('insurance_claims ic');
    }

    function insurance_claims_report($conditions=array())
    {
        $this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name,
            xc.name AS project_name, xdd.department_name, xd.designation_name, ic.type, ic.incident_date, ic.reporting_date, ic.status, ic.reported_by, ic.subject, ic.description, ic.entry_at, ic.remarks, ic.remarks_date, ic.decision_text, ic.decision_date, ic.decision, ebi.father_name, ebi.contact_number, ebi.personal_contact, ebi.date_of_birth, ebi.cnic, g.gender_name, CONCAT(r_by.first_name, " ", IFNULL(r_by.last_name, "")) AS remarks_by, CONCAT(d_by.first_name, " ", IFNULL(d_by.last_name, "")) AS decision_by, CONCAT(e_by.first_name, " ", IFNULL(e_by.last_name, "")) AS created_by');

        $this->db->join('xin_employees xe', 'ic.employee_id = xe.employee_id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');
        $this->db->join('xin_employees e_by', 'ic.entry_by = e_by.employee_id', 'left');
        $this->db->join('xin_employees r_by', 'ic.remarks_by = r_by.employee_id', 'left');
        $this->db->join('xin_employees d_by', 'ic.decision_by = d_by.employee_id', 'left');
        $this->db->join('employee_basic_info ebi', 'ic.employee_id = ebi.user_id', 'left');
        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');

        $this->db->where($conditions);
        return $this->db->get('insurance_claims ic')->result();
    }

    function get_insurance_claim_detail($conditions=array())
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, ebi.cnic, ebi.job_title, ic.id AS insurance_claim_id, ic.type, ic.incident_date, ic.reporting_date, ic.reported_by, ic.subject, ic.description, ic.status, ic.entry_at, ic.remarks, ic.remarks_date, ic.decision_date, ic.decision, ic.decision_text,
            CONCAT(r_by.first_name, " ", IFNULL(r_by.last_name, "")) AS remarks_by, 
            CONCAT(d_by.first_name, " ", IFNULL(d_by.last_name, "")) AS decision_by, 
            CONCAT(e_by.first_name, " ", IFNULL(e_by.last_name, "")) AS created_by');

        $this->db->join('xin_employees xe', 'ic.employee_id = xe.employee_id', 'left');
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->join('xin_employees e_by', 'ic.entry_by = e_by.employee_id', 'left');
        $this->db->join('xin_employees r_by', 'ic.remarks_by = r_by.employee_id', 'left');
        $this->db->join('xin_employees d_by', 'ic.decision_by = d_by.employee_id', 'left');

        $this->db->where($conditions);
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
        $this->db->order_by('xe.user_id', 'DESC');
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

    function get_insurance_files($claim_id)
    {
        $this->db->select('CONCAT(xin_employees.first_name, " ", IFNULL(xin_employees.last_name, "")) AS uploaded_by, insurance_files.original_name, insurance_files.file_name, insurance_files.uploaded_date');
        $this->db->join('xin_employees', 'insurance_files.uploaded_by = xin_employees.employee_id', 'left');
        $this->db->where('insurance_claim_id', $claim_id);
        return $this->db->get('insurance_files');
    }

    function get_employee_status($id)
    {
        $this->db->select('xe.status');
        return $this->db->get_where('xin_employees xe', array('xe.employee_id' => $id));
    }

    function check_claim_existence($employee_id)
    {
        $this->db->where_in('status', array('pending', 'inprogress'));
        $this->db->where('employee_id', $employee_id);
        return $this->db->get('insurance_claims')->num_rows();
    }

    function get_insurance_id($employee_id)
    {
        $this->db->where(array('employee_id' => $employee_id));
        return $this->db->get('insurance')->row()->id;
    }

    function get_file_types()
    {
        return $this->db->get('insurance_file_types')->result();
    }

    function add_files_checklist($data)
    {
        return $this->db->insert_batch('insurance_files_checklist', $data);
    }


    function update_files_checklist($conditions, $data)
    {
        $this->db->where($conditions);
        return $this->db->update('insurance_files_checklist', $data);
    }

    function get_files_checklist($claim_id)
    {
        $this->db->select('insurance_file_types.id, insurance_file_types.type_description, insurance_files_checklist.status');
        $this->db->join('insurance_file_types', 'insurance_files_checklist.file_type_id = insurance_file_types.id', 'left');

        $this->db->where('insurance_files_checklist.insurance_claim_id', $claim_id);
        return $this->db->get('insurance_files_checklist')->result();
    }

}


?>