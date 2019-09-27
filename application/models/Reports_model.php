<?php 

/**
 * 
 */
class Reports_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	function get_employees($conditions="", $employee_type="", $limit="", $offset="")
	{
        $other_fields = "";
        if($employee_type == "resigned")
        {
            $other_fields .= ", CONCAT(ra_by.first_name, ' ', ra_by.last_name) AS resignation_accepted_by, xer.resignation_date, xer.reason AS other_reason, xer.accepted_date, xer.subject, xer.description, rr.reason_text";
        }
        elseif($employee_type == "terminated")
        {
            $other_fields .= ",CONCAT(t_by.first_name, ' ', t_by.last_name) AS termination_by, CONCAT(ta_by.first_name, ' ', ta_by.last_name) AS termination_accepted_by, t.other_reason, t.description, t.notice_date, t.terminated_by, t.terminated_at, t.confirmed_date, tr.reason_text";
        }

		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', xe.last_name) AS emp_name, xe.contact_no, xe.gender, xe.email, xe.date_of_birth, xc.name as company_name, xe.date_of_joining, xdd.department_name, xd.designation_name, xol.location_name,
            epli.permanent_address_details AS p_address, pp.name AS p_province, pd.name AS p_district, pt.name AS p_tehsil, pu.name AS p_uc,
            eri.resident_address_details AS r_address, rp.name AS r_province, rd.name AS r_district, rt.name AS r_tehsil, ru.name AS r_uc $other_fields");
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');
        $this->db->join('xin_employee_location xel', 'xe.employee_id = xel.employee_id', 'left');
        $this->db->join('xin_office_location xol', 'xel.office_location_id = xol.location_id', 'left');

        $this->db->join('employee_permanent_location_info epli', 'xe.user_id = epli.user_id', 'left');
        $this->db->join('provinces pp', 'epli.permanent_province = pp.id', 'left');
        $this->db->join('district pd', 'epli.permanent_district = pd.id', 'left');
        $this->db->join('tehsil pt', 'epli.permanent_tehsil = pt.id', 'left');
        $this->db->join('union_councel pu', 'epli.permanent_uc = pu.id', 'left');

        $this->db->join('employee_residential_info eri', 'xe.user_id = eri.user_id', 'left');
        $this->db->join('provinces rp', 'eri.resident_province = rp.id', 'left');
        $this->db->join('district rd', 'eri.resident_district = rd.id', 'left');
        $this->db->join('tehsil rt', 'eri.resident_tehsil = rt.id', 'left');
        $this->db->join('union_councel ru', 'eri.resident_uc = ru.id', 'left');

        if($employee_type == "resigned")
        {
            $this->db->join('xin_employee_resignations xer', 'xe.user_id = xer.employee_id', 'right');
            $this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
            $this->db->join('xin_employees ra_by', 'ra_by.user_id = xer.accepted_by', 'left');
        }
        elseif($employee_type == "terminated")
        {
            $this->db->join('termination t', 'xe.user_id = t.employee_id', 'right');
            $this->db->join('termination_reasons tr', 't.reason_id = tr.id', 'left');
            $this->db->join('xin_employees t_by', 't_by.user_id = t.terminated_by', 'left');
            $this->db->join('xin_employees ta_by', 'ta_by.user_id = t.confirmed_by', 'left');
        }
        // $this->db->join('xin_employee_documents xed', 'xe.user_id = xed.employee_id', 'left');
        // $this->db->join('xin_document_type AS xdt', 'xed.document_type_id = xdt.document_type_id', 'left');
        
        // $this->db->join('xin_employee_qualification xeq', 'xe.user_id = xeq.employee_id', 'left');
        // $this->db->join('qualification q', 'xeq.qualification_id = q.id', 'left');

        // $this->db->join('xin_qualification_education_level xqel', 'xeq.education_level_id = xqel.education_level_id', 'left');
        // $this->db->join('employee_educational_info eei', 'xeq.education_level_id = xqel.education_level_id', 'left');
        // $this->db->join('discipline d', 'xeq.discipline_id = d.discipline_id', 'left');

		$this->db->limit($limit, $offset);

		if($conditions != "")
			$this->db->where("$conditions");
		return $this->db->get('xin_employees xe');
	}

    function get_employee_qulaification($id)
    {
        $this->db->select('xeq.from_year AS from_year, xeq.to_year AS to_year,
            q.name AS qulaification, d.discipline_name');
        $this->db->join('qualification q', 'xeq.qualification_id = q.id', 'left');
        $this->db->join('discipline d', 'xeq.discipline_id = d.discipline_id', 'left');
        return $this->db->get_where('xin_employee_qualification xeq', array('xeq.employee_id' => $id))->result();
    }

    function get_employee_documents($id)
    {
        $this->db->select('xed.date_of_expiry, xed.title AS document, xdt.document_type');
        $this->db->join('xin_document_type AS xdt', 'xed.document_type_id = xdt.document_type_id', 'left');
        return $this->db->get_where('xin_employee_documents xed', array('xed.employee_id' => $id))->result();
    }

    /* Fix it use single function */
	function get_employee_detail($id)
	{
        $employee_basic_info_fileds = ", ebi.father_name, ebi.cnic, ebi.cnic_expiry_date, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.contract_expiry_date, ebi.other_languages, ebi.relation_id AS relation, ebi.gender, ebi.marital_status, ebi.tribe, ebi.ethnicity, ebi.language, ebi.nationality, ebi.religion, ebi.bloodgroup, r.relation_name, t.tribe_name, g.gender_name, e.ethnicity_name, l.language_name, co.country_name, rn.religion_name, bg.blood_group_name, g.gender_name, m.marital_name, xct.name AS contract_type";


		$this->db->select("xe.employee_id, xe.first_name, xe.last_name, xe.contact_no, xe.gender, xe.email, xe.date_of_birth, xe.gender, xe.address, xe.marital_status, xc.name as company_name, xdd.department_name, xd.designation_name, xol.location_name, xe.employee_id, CONCAT(xe.first_name, ' ', xe.last_name) AS emp_name, xe.contact_no, xe.gender, xe.email, xe.date_of_birth, xc.name as company_name, xe.date_of_joining, xdd.department_name, xd.designation_name, xol.location_name,
            epli.permanent_address_details AS p_address, pp.name AS p_province, pd.name AS p_district, pt.name AS p_tehsil, pu.name AS p_uc,
            eri.resident_address_details AS r_address, rp.name AS r_province, rd.name AS r_district, rt.name AS r_tehsil, ru.name AS r_uc $employee_basic_info_fileds");
		      
        $this->db->join('xin_employee_location xel', 'xe.employee_id = xel.employee_id', 'left');
        $this->db->join('xin_office_location xol', 'xel.office_location_id = xol.location_id', 'left');

        $this->db->join('employee_permanent_location_info epli', 'xe.user_id = epli.user_id', 'left');
        $this->db->join('provinces pp', 'epli.permanent_province = pp.id', 'left');
        $this->db->join('district pd', 'epli.permanent_district = pd.id', 'left');
        $this->db->join('tehsil pt', 'epli.permanent_tehsil = pt.id', 'left');
        $this->db->join('union_councel pu', 'epli.permanent_uc = pu.id', 'left');

        $this->db->join('employee_residential_info eri', 'xe.user_id = eri.user_id', 'left');
        $this->db->join('provinces rp', 'eri.resident_province = rp.id', 'left');
        $this->db->join('district rd', 'eri.resident_district = rd.id', 'left');
        $this->db->join('tehsil rt', 'eri.resident_tehsil = rt.id', 'left');
        $this->db->join('union_councel ru', 'eri.resident_uc = ru.id', 'left');

        
        $this->db->join('employee_basic_info ebi', 'xe.user_id = ebi.user_id', 'left');
        
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');

        $this->db->join('employee_languages el', 'ebi.user_id = el.employee_id', 'left');
        $this->db->join('relation r', 'ebi.relation_id = r.relation_id', 'left');
        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');
        $this->db->join('tribe t', 'ebi.tribe = t.tribe_id', 'left');
        $this->db->join('ethnicity e', 'ebi.ethnicity = e.ethnicity_id', 'left');
        $this->db->join('language l', 'ebi.language = l.language_id', 'left');
        $this->db->join('marital_status m', 'ebi.marital_status = m.marital_id', 'left');

        $this->db->join('xin_countries co', 'ebi.nationality = co.country_id', 'left');
        $this->db->join('religion rn', 'ebi.religion = rn.id', 'left');
        $this->db->join('blood_group bg', 'ebi.bloodgroup = bg.blood_group_id', 'left');
        $this->db->join('xin_contract_type xct', 'ebi.employee_contract_type = xct.contract_type_id', 'left');

        
        // $this->db->join('marital_status m', 'ebi.marital_status = m.marital_id', 'left');
        // $this->db->join('xin_employee_contract xec', 'ebi.employee_contract_type = xec.contract_id', 'left');
        // $this->db->join('xin_contract_type xct', 'xec.contract_type_id = xct.contract_type_id', 'left');
        
        // $this->db->join('blood_group bg', 'ebi.bloodgroup = bg.blood_group_id', 'left');

		return $this->db->get_where('xin_employees xe', array('xe.employee_id' => $id))->row();
	}

	function get_designations()
	{
		return $this->db->get('xin_designations')->result();
	}

	function get_provinces()
	{
		return $this->db->get('provinces')->result();
	}

	public function get_district_province($id)
    {
        return $this->db->get_where('district', array('province_id' => $id))->result();
    }

    public function get_tehsil_district($id)
    {
        return $this->db->get_where('tehsil', array('district_id' => $id))->result();
    }

    public function get_uc_tehsil($id)
    {
        return $this->db->get_where('union_councel', array('tehsil_id' => $id))->result();
    }

    public function get_companies()
    {
    	$this->db->select('xc.company_id, xc.name');
    	return $this->db->get('xin_companies xc')->result();
    }

    public function get_permanent_address($employee_id)
    {
    	$this->db->select('e.permanent_address_details, p.name, d.name, t.name, u.name');
    	$this->db->join('provinces p', 'e.permanent_province = p.id', 'left');
    	$this->db->join('district d', 'e.permanent_district = d.id', 'left');
    	$this->db->join('tehsil t', 'e.permanent_tehsil = p.id', 'left');
    	$this->db->join('union_councel u', 'e.permanent_province = u.id', 'left');
    	$this->db->get('employee_permanent_location_info e')->result();
    }

    public function get_residential_address($employee_id)
    {
    	$this->db->select('e.resident_address_details, p.name, d.name, t.name, u.name');
    	$this->db->join('provinces p', 'e.resident_province = p.id', 'left');
    	$this->db->join('district d', 'e.resident_district = d.id', 'left');
    	$this->db->join('tehsil t', 'e.resident_tehsil = p.id', 'left');
    	$this->db->join('union_councel u', 'e.resident_province = u.id', 'left');
    	$this->db->get('employee_residential_info e')->result();
    }

    public function get_locations()
    {
        $this->db->select('location_id, location_name');
        return $this->db->get('xin_office_location')->result();
    }

    // public function get_resignations()
    // {
    //     $this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
    //     $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
    //     $this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
    //     // $this->db->join('xin_designations xd', 'xer.designation_id = xd.designation_id', 'left');
    //     $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
    //     return $this->db->get('xin_employee_resignations xer')->result();
    // }

    // public function get_terminations()
    // {
    //     $this->db->select('xe.user_id, CONCAT(xe.first_name," ", xe.last_name) AS employee_name, t.id, tr.reason_text, t.other_reason, t.description, t.notice_date, CONCAT(tby.first_name," ", tby.last_name) AS terminator, xd.designation_name');
    //     $this->db->join('xin_employees AS xe', 't.employee_id = xe.user_id', 'left');
    //     $this->db->join('xin_employees AS tby', 't.terminated_by = tby .user_id', 'left');
    //     $this->db->join('termination_reasons AS tr', 't.reason_id = tr.id', 'left');
    //     $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
    //     $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
    //     return $this->db->get('termination AS t')->result();
    // }


}