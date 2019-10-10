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

	function get_employees($conditions=array(), $employee_type="", $limit="", $offset="")
	{
        $other_fields = "";
        if($employee_type == "resigned")
        {
            $other_fields .= ", CONCAT(ra_by.first_name, ' ', IFNULL(ra_by.last_name, '')) AS resignation_accepted_by, xer.resignation_date, xer.reason AS other_reason, xer.accepted_date, xer.subject, xer.description, rr.reason_text";
        }
        elseif($employee_type == "terminated")
        {
            $other_fields .= ",CONCAT(t_by.first_name, ' ', IFNULL(t_by.last_name, '')) AS termination_by, CONCAT(ta_by.first_name, ' ', IFNULL(ta_by.last_name, '')) AS termination_accepted_by, t.other_reason, t.description, t.notice_date, t.terminated_by, t.termination_date, t.confirmed_date, tr.reason_text";
        }

        $employee_basic_info_fileds = ", ebi.father_name, ebi.date_of_birth, ebi.cnic, ebi.cnic_expiry_date, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.other_languages, xec.from_date AS date_of_joining, xec.to_date AS contract_expiry_date, g.gender_name, m.marital_name, c.country_name, r.religion_name, tribe.tribe_name, e.ethnicity_name, l.language_name, bg.blood_group_name";

		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name,'')) AS emp_name, xe.contact_no, xe.email, xc.name as company_name, xe.date_of_joining, xdd.department_name, xd.designation_name, xol.location_name,
            epli.permanent_address_details AS p_address, pp.name AS p_province, pd.name AS p_district, pt.name AS p_tehsil, pu.name AS p_uc,
            eri.resident_address_details AS r_address, rp.name AS r_province, rd.name AS r_district, rt.name AS r_tehsil, ru.name AS r_uc $other_fields $employee_basic_info_fileds");

        /* Company, Designation, Gender etc would be picked from employee_basic_info */
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        
        $this->db->join('xin_employee_contract xec', 'ebi.user_id = xec.employee_id', 'left');
        $this->db->join('xin_contract_type xct', 'xec.contract_type_id = xct.contract_type_id', 'left');
        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');
        $this->db->join('marital_status m', 'ebi.marital_status = m.marital_id', 'left');
        $this->db->join('xin_countries c', 'ebi.nationality = c.country_id', 'left');
        $this->db->join('religion r', 'ebi.religion = r.id', 'left');
        $this->db->join('tribe', 'ebi.tribe = tribe.tribe_id', 'left');
        $this->db->join('ethnicity e', 'ebi.ethnicity = e.ethnicity_id', 'left');
        $this->db->join('language l', 'ebi.language = l.language_id', 'left');
        $this->db->join('blood_group bg', 'ebi.bloodgroup = bg.blood_group_id', 'left');


		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');
        $this->db->join('xin_employee_location xel', 'xe.employee_id = xel.employee_id', 'left');
        $this->db->join('xin_office_location xol', 'xel.office_location_id = xol.location_id', 'left');

        $this->db->join('employee_permanent_location_info epli', 'xe.employee_id = epli.user_id', 'left');
        $this->db->join('provinces pp', 'epli.permanent_province = pp.id', 'left');
        $this->db->join('district pd', 'epli.permanent_district = pd.id', 'left');
        $this->db->join('tehsil pt', 'epli.permanent_tehsil = pt.id', 'left');
        $this->db->join('union_councel pu', 'epli.permanent_uc = pu.id', 'left');

        $this->db->join('employee_residential_info eri', 'xe.employee_id = eri.user_id', 'left');
        $this->db->join('provinces rp', 'eri.resident_province = rp.id', 'left');
        $this->db->join('district rd', 'eri.resident_district = rd.id', 'left');
        $this->db->join('tehsil rt', 'eri.resident_tehsil = rt.id', 'left');
        $this->db->join('union_councel ru', 'eri.resident_uc = ru.id', 'left');

        if($employee_type == "resigned")
        {
            $this->db->join('xin_employee_resignations xer', 'xe.employee_id = xer.employee_id', 'right');
            $this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
            $this->db->join('xin_employees ra_by', 'ra_by.user_id = xer.accepted_by', 'left');
        }
        elseif($employee_type == "terminated")
        {
            $this->db->join('termination t', 'xe.employee_id = t.employee_id', 'right');
            $this->db->join('termination_reasons tr', 't.reason_id = tr.id', 'left');
            $this->db->join('xin_employees t_by', 't_by.user_id = t.terminated_by', 'left');
            $this->db->join('xin_employees ta_by', 'ta_by.user_id = t.confirmed_by', 'left');
        }


		$this->db->limit($limit, $offset);

		if(!empty($conditions))
			$this->db->where($conditions);

        // $this->db->order_by('CAST(xe.employee_id AS UNSIGNED)', 'ASC');
        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->order_by('xe.user_id', 'ASC');
		return $this->db->get('xin_employees xe');
	}

    /* Fix it use single function */
    function get_employee_detail($conditions=array())
    {
        $employee_basic_info_fileds = ", ebi.father_name, ebi.cnic, ebi.cnic_expiry_date, ebi.date_of_birth, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.contract_expiry_date, ebi.other_languages, ebi.relation_id AS relation, ebi.gender, ebi.marital_status, ebi.tribe, ebi.ethnicity, ebi.language, ebi.nationality, ebi.religion, ebi.bloodgroup, r.relation_name, t.tribe_name, g.gender_name, e.ethnicity_name, l.language_name, co.country_name, rn.religion_name, bg.blood_group_name, g.gender_name, m.marital_name, xct.name AS contract_type";


        $this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.contact_no, xe.email, xc.name as company_name, xe.date_of_joining, xdd.department_name, xd.designation_name, xol.location_name,
            epli.permanent_address_details AS p_address, pp.name AS p_province, pd.name AS p_district, pt.name AS p_tehsil, pu.name AS p_uc,
            eri.resident_address_details AS r_address, rp.name AS r_province, rd.name AS r_district, rt.name AS r_tehsil, ru.name AS r_uc $employee_basic_info_fileds");
              
        $this->db->join('xin_employee_location xel', 'xe.employee_id = xel.employee_id', 'left');
        $this->db->join('xin_office_location xol', 'xel.office_location_id = xol.location_id', 'left');

        $this->db->join('employee_permanent_location_info epli', 'xe.employee_id = epli.user_id', 'left');
        $this->db->join('provinces pp', 'epli.permanent_province = pp.id', 'left');
        $this->db->join('district pd', 'epli.permanent_district = pd.id', 'left');
        $this->db->join('tehsil pt', 'epli.permanent_tehsil = pt.id', 'left');
        $this->db->join('union_councel pu', 'epli.permanent_uc = pu.id', 'left');

        $this->db->join('employee_residential_info eri', 'xe.employee_id = eri.user_id', 'left');
        $this->db->join('provinces rp', 'eri.resident_province = rp.id', 'left');
        $this->db->join('district rd', 'eri.resident_district = rd.id', 'left');
        $this->db->join('tehsil rt', 'eri.resident_tehsil = rt.id', 'left');
        $this->db->join('union_councel ru', 'eri.resident_uc = ru.id', 'left');

        
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        
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
        $this->db->where($conditions);

        // $this->db->order_by('CAST(xe.employee_id AS UNSIGNED)', 'ASC');
        $this->db->order_by('xe.user_id', 'ASC');
        return $this->db->get('xin_employees xe')->row();
    }

    function get_employee_cards($conditions=array(), $limit="", $offset="")
    {

        $this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.contact_no, xd.designation_name, ebi.cnic, ebi.contact_number, ebi.personal_contact,
            ebi.date_of_birth,
            eri.resident_address_details AS r_address, rp.name AS r_province, rd.name AS r_district, rt.name AS r_tehsil, ru.name AS r_uc,
            epli.permanent_address_details AS p_address, pp.name AS p_province, pd.name AS p_district, pt.name AS p_tehsil, pu.name AS p_uc, ebi.date_of_birth,
            eri.resident_address_details AS r_address, rp.name AS r_province, rd.name AS r_district, rt.name AS r_tehsil, ru.name AS r_uc,
             xc.name AS project_name, ec.id AS card_id, ec.card_status, ec.issue_date, ec.expiry_date, xe.date_of_joining, ec.print_date, ec.deliver_date, ec.receive_date");

        /* Company, Designation, Gender etc would be picked from employee_basic_info */
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');

        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');

        $this->db->join('employee_permanent_location_info epli', 'xe.employee_id = epli.user_id', 'left');
        $this->db->join('provinces pp', 'epli.permanent_province = pp.id', 'left');
        $this->db->join('district pd', 'epli.permanent_district = pd.id', 'left');
        $this->db->join('tehsil pt', 'epli.permanent_tehsil = pt.id', 'left');
        $this->db->join('union_councel pu', 'epli.permanent_uc = pu.id', 'left');

        $this->db->join('employee_residential_info eri', 'xe.employee_id = eri.user_id', 'left');
        $this->db->join('provinces rp', 'eri.resident_province = rp.id', 'left');
        $this->db->join('district rd', 'eri.resident_district = rd.id', 'left');
        $this->db->join('tehsil rt', 'eri.resident_tehsil = rt.id', 'left');
        $this->db->join('union_councel ru', 'eri.resident_uc = ru.id', 'left');

        $this->db->join('employee_cards ec', 'xe.employee_id = ec.employee_id', 'left');

        $this->db->limit($limit, $offset);

        if(!empty($conditions))
            $this->db->where($conditions);


        // $this->db->order_by('CAST(xe.employee_id AS UNSIGNED)', 'ASC');
        $this->db->where_not_in('xe.user_role_id', array(1, 2));
        $this->db->order_by('xe.user_id', 'ASC');
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


	function get_designations($project_id="")
	{
        $this->db->select('DISTINCT(xd.designation_id), xd.designation_name');
        $this->db->join('xin_employees xe', 'xd.designation_id = xe.designation_id', 'left');
        // if($project_id != "")
        // {
            // $this->db->join('xin_office_location xol', 'xd.designation_id = xol.designation_id', 'left');
            $this->db->where('xe.company_id', $project_id);
        // }
		return $this->db->get('xin_designations xd')->result();
	}

	function get_provinces($project_id="")
	{
        $this->db->select('DISTINCT(p.id), p.name');
        if($project_id != "")
        {
            $this->db->join('xin_office_location xol', 'p.id = xol.province_id', 'left');
            $this->db->where('xol.company_id', $project_id);
        }

		return $this->db->get('provinces p')->result();
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

    public function get_area_uc($id)
    {
        return $this->db->get_where('areas', array('uc_id' => $id))->result();
    }

    public function get_sub_area($id)
    {
        return $this->db->get_where('sub_area', array('area_id' => $id))->result();
    }

    public function get_companies($project_id="")
    {
    	$this->db->select('xc.company_id, xc.name');
        if($project_id != "")
            $this->db->where('xc.company_id', $project_id);
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

    public function get_locations($project_id="")
    {
        $this->db->select('xol.location_id, xol.location_name');
        if($project_id != "")
            $this->db->where('xol.company_id', $project_id);
        return $this->db->get('xin_office_location xol')->result();
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
    //     $this->db->select('xe.employee_id, CONCAT(xe.first_name," ", xe.last_name) AS employee_name, t.id, tr.reason_text, t.other_reason, t.description, t.notice_date, CONCAT(tby.first_name," ", tby.last_name) AS terminator, xd.designation_name');
    //     $this->db->join('xin_employees AS xe', 't.employee_id = xe.employee_id', 'left');
    //     $this->db->join('xin_employees AS tby', 't.terminated_by = tby .user_id', 'left');
    //     $this->db->join('termination_reasons AS tr', 't.reason_id = tr.id', 'left');
    //     $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
    //     $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
    //     return $this->db->get('termination AS t')->result();
    // }



    function get_trainings($conditions=array(), $limit="", $offset="")
    {
        $this->db->select('xt.trg_id, xt.facilitator_name, xt.trainee_employees, xt.target_group, xt.start_date, xt.end_date, xt.hall_detail, xt.session, xt.approval_type, xt.status, xc.name AS company, xtt.type AS training_type, p.name AS province_name');
        $this->db->join('xin_companies xc', 'xt.project = xc.company_id', 'left');
        $this->db->join('xin_training_types xtt', 'xt.trg_type = xtt.training_type_id', 'left');
        $this->db->join('provinces p', 'xt.location = p.id', 'left');
        // $this->db->join('provinces p', 'xt.location = p.id', 'left');

        $this->db->limit($limit, $offset);

        if(!empty($conditions))
            $this->db->where($conditions);
        return $this->db->get('xin_trainings xt');
    }

    function get_training_detail($conditions=array())
    {
        $this->db->select("xt.trg_id, xt.facilitator_name, xt.trainee_employees, xt.target_group, xt.start_date, xt.end_date, xt.hall_detail, xt.session, xt.approval_type, xt.status, xc.name AS company, xtt.type AS training_type, p.name AS province_name, d.name AS district_name, 
            CONCAT(IFNULL(t1.first_name, ''), ' ', IFNULL(t1.last_name, '')) AS t1_name, t1.contact_number AS t1_contact, t1.email AS t1_email, t1.expertise AS t1_expertise, t1.address AS t1_address, d1.designation_name AS d1_designation_name,
            CONCAT(IFNULL(t2.first_name, ''), ' ', IFNULL(t2.last_name, '')) AS t2_name, t2.contact_number AS t2_contact, t2.email AS t2_email, t2.expertise AS t2_expertise, t2.address AS t2_address, d2.designation_name AS d2_designation_name,
            xtl.location AS training_location, c.name AS city_name");
       
        $this->db->join('xin_companies xc', 'xt.project = xc.company_id', 'left');
        $this->db->join('xin_training_types xtt', 'xt.trg_type = xtt.training_type_id', 'left');
        $this->db->join('provinces p', 'xt.location = p.id', 'left');
        $this->db->join('district d', 'xt.district = d.id', 'left');
        
        $this->db->join('xin_trainers t1', 'xt.trainer_one = t1.trainer_id', 'left');
        $this->db->join('xin_designations d1', 't1.designation_id = d1.designation_id', 'left');

        $this->db->join('xin_trainers t2', 'xt.trainer_two = t2.trainer_id', 'left');
        $this->db->join('xin_designations d2', 't1.designation_id = d2.designation_id', 'left');

        $this->db->join('xin_training_locations xtl', 'xt.location = xtl.location_id', 'left');
        $this->db->join('city c', 'xtl.city = c.id', 'left');

        $this->db->where($conditions);
        return $this->db->get('xin_trainings xt')->row();
    }

    function get_training_attendance($training_id)
    {
        $this->db->select('ta.training_id, xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xd.designation_name, ta.status AS attendance, DATE_FORMAT(ta.attendance_date, "%Y-%m-%d") AS attendance_date');
        $this->db->join('xin_employees xe', 'ta.emp_id = xe.employee_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');

        $this->db->where('ta.training_id', $training_id);
        $this->db->group_by('ta.emp_id');
        return $this->db->get('training_attendance ta')->result_array();
    }

    function get_attendance_dates($training_id)
    {
        $this->db->select('DISTINCT(DATE_FORMAT(ta.attendance_date, "%Y-%m-%d")) AS attendance_date');
        $this->db->where('ta.training_id', $training_id);
        return $this->db->get('training_attendance ta')->result();
    }

    function get_employee_attendance($training_id, $employee_id)
    {
        $this->db->select('DISTINCT(DATE_FORMAT(ta.attendance_date, "%Y-%m-%d")) AS attendance_date, LOWER(`status`) AS status');
        $this->db->where(array('ta.training_id'=> $training_id, 'ta.emp_id'=> $employee_id));
        return $this->db->get('training_attendance ta')->result_array();
    }

    function datewise_attendance($training_id, $employee_id, $training_date)
    {
        $this->db->select('LOWER(`status`) AS status');
        $this->db->where(array('ta.training_id'=> $training_id, 'ta.emp_id'=> $employee_id, 'DATE_FORMAT(ta.attendance_date, "%Y-%m-%d") =' => $training_date));
        return $this->db->get('training_attendance ta')->row();
    }

    function get_training_expenses($training_id)
    {
        $this->db->select('ta.training_id, xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, xd.designation_name, xta.dsa, xta.travel, xta.stay_allowance,
            (SELECT COUNT(`eta`.`status`) FROM `training_attendance` `eta` WHERE `eta`.`status` = "Present" AND `eta`.`training_id` = '.$training_id.' AND `eta`.`emp_id` = `xe`.`employee_id`)  AS `presence_count`');
        $this->db->join('xin_employees xe', 'ta.emp_id = xe.employee_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_training_allowances xta', 'xe.designation_id = xta.designation AND xe.company_id = xta.project', 'left');
        $this->db->where('ta.training_id', $training_id);
        $this->db->group_by('ta.emp_id');
        return $this->db->get('training_attendance ta')->result();
    }


    function get_events($conditions="", $limit="", $offset="")
    {
        $this->db->select('ec.event_id, ec.title, ec.start_date, ec.end_date, xc.name AS project_name, xd.designation_name, xtt.type AS training_type, p.name AS province, d.name AS district');

        $this->db->join('xin_companies xc', 'ec.project = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'ec.designation = xd.designation_id', 'left');
        $this->db->join('xin_training_types xtt', 'ec.trg_type = xtt.training_type_id', 'left');
        $this->db->join('provinces p', 'ec.province = p.id', 'left');
        $this->db->join('district d', 'ec.district = d.id', 'left');
        $this->db->limit($limit, $offset);
        if($conditions != "")
            $this->db->where($conditions);
        return $this->db->get('events_calendar ec');
    }

    function get_training_types()
    {
        return $this->db->get('xin_training_types')->result();
    }

    function get_tests($limit="", $offset="")
    {
        $this->db->limit($limit, $offset);
        $this->db->select('(SELECT COUNT(rollnumber) FROM assign_test WHERE assign_test.test_date = t.test_date)  AS no_applicants, test_date');
        return $this->db->get('assign_test t');
    }


    public function applicants_report($date_from="", $date_to="", $job_id="", $project="", $designation="", $rollno="", $applicant_name="", $limit="", $offset=""){
        $this->db->select('xin_job_applications.*,
                            xin_jobs.job_id,
                            xin_jobs.job_title,
                            xin_jobs.company,
                            xin_jobs.designation_id,
                            xin_companies.company_id,
                            xin_companies.name as compName,
                            assign_test.test_date AS exam_date,
                            test_result.obtain_marks, test_result.total_marks, 
                            gender.gender_name AS applicant_gender, 
                            education.name AS applicant_education,
                            provinces.name AS province_name,
                            city.name AS city_name');
        // $this->db->from('xin_job_applications');
        $this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
        $this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
        $this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
        $this->db->join('assign_test', 'xin_job_applications.application_id = assign_test.rollnumber', 'right');


        $this->db->join('test_result', 'xin_job_applications.application_id = assign_test.rollnumber', 'left');
        $this->db->join('gender', 'xin_job_applications.gender = gender.gender_id', 'left');
        $this->db->join('education', 'xin_job_applications.education = education.id', 'left');
        $this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
        $this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
             
        // $this->db->limit($limit, $offset);
        if($date_from != "")
            $this->db->where('xin_job_applications.created_at >=', $date_from);

        if($date_to != "")
            $this->db->where('xin_job_applications.created_at <=', $date_to);
        if($job_id != "")
            $this->db->where('xin_job_applications.job_id', $job_id);
        if($project != "")
            $this->db->where('xin_companies.company_id', $project);
        if($designation != "")
            $this->db->where('xin_designations.designation_id', $designation);
        if($rollno != "")
            $this->db->where('xin_job_applications.application_id', $rollno);
        if($applicant_name != "")
            $this->db->like('xin_job_applications.fullname', $applicant_name);
        
        $this->db->limit($limit, $offset);
        $results =  $this->db->get('xin_job_applications');
        return $results;
    }

    public function applicants_report_detail($applicant_id)
    {
        $this->db->select('xin_job_applications.*,
                            xin_jobs.job_id,
                            xin_jobs.job_title,
                            xin_jobs.company,
                            xin_jobs.designation_id,
                            xin_companies.company_id,
                            xin_companies.name as compName,
                            assign_test.test_date AS exam_date,
                            test_result.obtain_marks, test_result.total_marks, 
                            gender.gender_name AS applicant_gender, 
                            education.name AS applicant_education,
                            provinces.name AS province_name,
                            city.name AS city_name');
        $this->db->from('xin_job_applications');
        $this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
        $this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
        $this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
        $this->db->join('assign_test', 'xin_job_applications.application_id = assign_test.rollnumber', 'left');
        $this->db->join('test_result', 'xin_job_applications.application_id = test_result.rollnumber', 'left');
        $this->db->join('gender', 'xin_job_applications.gender = gender.gender_id', 'left');
        $this->db->join('education', 'xin_job_applications.education = education.id', 'left');
        $this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
        $this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
        $this->db->where('xin_job_applications.application_id', $applicant_id);  

        return $this->db->get();
    }


    public function get_projects(){
        $this->db->select('company_id, name');
        $this->db->from('xin_companies');
        return $this->db->get()->result();
    }

    // Get data from jobs table to display them in the dropdown.
    public function get_jobs(){
        $this->db->select('job_id, job_title');
        $this->db->from('xin_jobs');
        return $this->db->get()->result();
    }



    /* Training Activity */

    public function get_activity_detail($conditions=array(), $limit="", $offset="")
    {
        // if($limit != "" && $offset == "")
        //     $limit = " LIMIT $limit";
        // else if ($limit != "" && $offset != "")
        //     $limit = " LIMIT $offset, $limit";


        // $result = $this->db->query('SELECT `xt`.`start_date`, `xt`.`trainee_employees`, (CHAR_LENGTH(xt.trainee_employees) - CHAR_LENGTH(REPLACE(xt.trainee_employees, ",", "")) + 1) AS plan_no_of_participants, `xtt`.`type` AS `training_type`, `p`.`name` AS `province`, `d`.`name` AS `district` FROM `xin_trainings` `xt` LEFT JOIN `xin_training_types` `xtt` ON `xt`.`trg_type` = `xtt`.`training_type_id` LEFT JOIN `provinces` `p` ON `xt`.`location` = `p`.`id` LEFT JOIN `district` `d` ON `xt`.`district` = `d`.`id` '. $conditions .  $limit);

        $this->db->select('`xt`.`start_date`, `xt`.`trainee_employees`, (CHAR_LENGTH(xt.trainee_employees) - CHAR_LENGTH(REPLACE(xt.trainee_employees, ",", "")) + 1) AS plan_no_of_participants, `xtt`.`type` AS `training_type`, `p`.`name` AS `province`, `d`.`name` AS `district`');
        $this->db->join('xin_training_types xtt', 'xt.trg_type = xtt.training_type_id', 'left');
        $this->db->join('provinces p', 'xt.location = p.id', 'left');
        $this->db->join('district d', 'xt.district = d.id', 'left');
        $this->db->where($conditions);
        $this->db->limit($limit, $offset);
        return $this->db->get('xin_trainings xt');

    }

    public function get_designation_gender($participant)
    {
        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS employee_name, g.gender_name AS gender, xd.designation_id, xd.designation_name');
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');
        // $this->db->join('training_attendance ta', '')
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->where('xe.employee_id', $participant);
        return $this->db->get('xin_employees xe');
    }

}