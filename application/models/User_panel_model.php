<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_panel_model extends CI_Model 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    function get_name_designation($id)
    {
        $this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, xd.designation_name');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        return $this->db->get_where('xin_employees xe', array('xe.employee_id' => $id))->row();
    }


    function get_employee_detail($id)
	{
        $employee_basic_info_fileds = ", ebi.father_name, ebi.date_of_birth, ebi.cnic, ebi.cnic_expiry_date, ebi.personal_contact, ebi.contact_number, ebi.contact_other, ebi.other_languages, ebi.relation_id AS relation, ebi.gender, ebi.marital_status, ebi.tribe, ebi.ethnicity, ebi.language, ebi.nationality, ebi.religion, ebi.bloodgroup";


		$this->db->select("xe.employee_id, CONCAT(xe.first_name, ' ', IFNULL(xe.last_name, '')) AS emp_name, xe.email AS email_address, xe.profile_picture,
		 xc.name as company_name, xdd.department_name, xd.designation_name, 
            epli.permanent_address_details, permanent_province, permanent_district, permanent_tehsil, permanent_uc,
            eri.resident_address_details, resident_province, resident_district, resident_tehsil, resident_uc $employee_basic_info_fileds");
		      
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->join('employee_permanent_location_info epli', 'xe.employee_id = epli.user_id', 'left');
        $this->db->join('employee_residential_info eri', 'xe.employee_id = eri.user_id', 'left');

        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        $this->db->join('xin_departments xdd', 'xe.department_id = xdd.department_id', 'left');


		return $this->db->get_where('xin_employees xe', array('xe.employee_id' => $id))->row();
	}


    public function update_employee($data, $id)
    {        
        $this->db->where(array('employee_id' => $id));
        $this->db->update('xin_employees', array('email' => $data['email_address']));

        $key = array_search($data['email_address'], $data);
        unset($data[$key]);

        $this->db->where('user_id', $id);
        return $this->db->update('employee_basic_info', $data);
    }

    public function update_profile_pic($image, $id)
    {
        $this->db->where('employee_id', $id);
        return $this->db->update('xin_employees', array('profile_picture' => $image));
    }

    public function get_employee_gender($employee_id)
    {
        $this->db->select('g.gender_id, g.gender_name');
        $this->db->join('gender g', 'ebi.gender = g.gender_id', 'left');
        $this->db->where('ebi.user_id', $employee_id);
        return $this->db->get('employee_basic_info ebi')->row();  
    }

    public function get_previous_pic($employee_id)
    {
        $this->db->select('profile_picture');
        return $this->db->get_where('xin_employees', array('employee_id' => $employee_id))->row();
    }

    public function check_address_existence($table, $id)
    {
        $this->db->where('user_id', $id);
        return $this->db->get($table)->num_rows();
    }

    public function update_current_address($data, $id)
    {
        $this->db->where('user_id', $id);
        return $this->db->update('employee_residential_info', $data);
    }

    public function add_residential_address($data)
    {
        return $this->db->insert('employee_residential_info', $data);
    }

    public function update_permanent_address($data, $id)
    {
        $this->db->where('user_id', $id);
        return $this->db->update('employee_permanent_location_info', $data);
    }

    public function add_permanent_address($data)
    {
        return $this->db->insert('employee_permanent_location_info', $data);
    }

    public function update_emp_qualification($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('employee_educational_info', $data);
    }

    public function update_emp_bank_info($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('employee_bank_information_info', $data);
    }

    public function update_job_detail($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('job_experience', $data);
    }


    public function delete_emp_bank_info($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('employee_bank_information_info');
    }

    public function delete_emp_qualification_info($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('employee_educational_info');
    }

    public function delete_job_experience($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('job_experience');
    }

    public function add_qualification($data)
    {
        return $this->db->insert('employee_educational_info', $data);
    }

    public function add_bank_info($data)
    {
        return $this->db->insert('employee_bank_information_info', $data);
    }

    public function add_experience($data)
    {
        return $this->db->insert('job_experience', $data);
    }

    /********************* Employee Information **************************/

    public function emp_current_address($id)
    {
        return $this->db->get_where('employee_residential_info', array('user_id' => $id))->row();
    }

    public function emp_permanent_address($id)
    {
        return $this->db->get_where('employee_permanent_location_info', array('user_id' => $id))->row();
    }

    public function emp_educational_info($id)
    {
        $this->db->select('eei.id, eei.institute_name, eei.qualification_id, eei.discipline_id, d.discipline_name, q.name, eei.from, eei.to');
        $this->db->join('qualification AS q', 'eei.qualification_id = q.id', 'left');
        $this->db->join('discipline AS d', 'eei.discipline_id = d.discipline_id');
        return $this->db->get_where('employee_educational_info AS eei', array('eei.user_id' => $id))->result();
    }

    public function emp_job_experience($id)
    {
        return $this->db->get_where('job_experience', array('user_id' => $id))->result();
    }

    public function emp_bank_info($id)
    {
        $this->db->select('ebi.id, ebi.bank_id, ebi.account_title, ebi.account_id, ebi.branch_code, b.bank_name');
        $this->db->join('bank AS b', 'ebi.bank_id = b.bank_id', 'left');
        return $this->db->get_where('employee_bank_information_info AS ebi', array('ebi.user_id' => $id))->result();
    }

    public function emp_supervisor_detail($id)
    {
        $this->db->select('ebi.user_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, dsg.designation_name, ebi.contact_number, d.name AS district, t.name AS tehsil, uc.name AS union_council, dsg.designation_name');

        $this->db->join('employee_basic_info AS ebi', 'esd.as_id = ebi.user_id', 'left');
        $this->db->join('district AS d', 'esd.ds_id = d.id', 'left');
        $this->db->join('tehsil AS t', 'esd.ts_id = t.id', 'left');
        $this->db->join('union_councel AS uc', 'esd.us_id = uc.id', 'left');
        $this->db->join('xin_designations AS dsg', 'esd.as_id = dsg.designation_id', 'left');

        // $this->db->join('xin_employees xe', 'xe.employee_id = ebi.user_id', 'left');

        $this->db->join('xin_employees AS xe', 'ebi.user_id = xe.employee_id', 'left');


        return $this->db->get_where('employee_supervisor_details AS esd', array('esd.user_id' => $id))->row();
    }

    /*************************** FIELDS IN EMPLOYEE FORM ***************************/


    /****************** Edit Education and Qualification *********************/

    public function get_education_info($id)
    {
        $this->db->select('eei.id, eei.institute_name, eei.qualification_id, eei.discipline_id, d.discipline_name, q.name, eei.from, eei.to');
        $this->db->join('qualification AS q', 'eei.qualification_id = q.id', 'left');
        $this->db->join('discipline AS d', 'eei.discipline_id = d.discipline_id', 'left');
        $this->db->where(array('eei.id' => $id));
        return $this->db->get('employee_educational_info AS eei')->row();
    }

    public function get_bank_info($id)
    {
        $this->db->join('bank AS b', 'ebi.bank_id = b.bank_id', 'left');
        $this->db->where(array('ebi.id' => $id));
        return $this->db->get('employee_bank_information_info AS ebi')->row();
    }

    public function get_job_info($id)
    {
        $this->db->where(array('id' => $id));
        return $this->db->get('job_experience')->row();
    }



    /****************** /. Edit Education and Qualification *****************/
    public function get_tribe()
    {
        return $this->db->get('tribe')->result();
    }

    public function get_marital_status()
    {
        return $this->db->get('marital_status')->result();
    }

    public function get_gender()
    {
        return $this->db->get('gender')->result();
    }

    public function get_countries()
    {
        return $this->db->get('xin_countries')->result();
    }

    public function get_religion()
    {
        return $this->db->get('religion')->result();
    }

    public function get_contract_type()
    {
        return $this->db->get('xin_contract_type')->result();
    }

    public function get_language()
    {
        return $this->db->get('language')->result();
    }

    public function get_ethnicity()
    {
        return $this->db->get('ethnicity')->result();
    }


    public function get_blood_group()
    {
        return $this->db->get('blood_group')->result();
    }

    public function get_province()
    {
        return $this->db->get('provinces')->result();
    }

    public function get_district()
    {     
        return $this->db->get('district')->result();
    }


    public function get_tehsil()
    {
        return $this->db->get('tehsil')->result();
    }


    public function get_union_council()
    {
        return $this->db->get('union_council')->result();
    }

    public function get_discipline()
    {
        return $this->db->get('discipline')->result();
    }

    public function get_bank()
    {
        return $this->db->get('bank')->result();
    }

    public function get_qualification()
    {
        return $this->db->get('qualification')->result();
    }


    public function get_district_province($id="")
    {
        if($id == "")
            return false;
        return $this->db->get_where('district', array('province_id' => $id))->result();
    }

    public function get_tehsil_district($id="")
    {
        if($id == "")
            return false;
        return $this->db->get_where('tehsil', array('district_id' => $id))->result();
    }

    public function get_uc_tehsil($id="")
    {
        if($id == "")
            return false;
        return $this->db->get_where('union_councel', array('tehsil_id' => $id))->result();
    }


    /*******************************************************************************/
    public function get_company_policies()
    {
        return $this->db->get('xin_company_policy')->result();
    }


    public function get_policy_detail($id)
    {
        $this->db->select('cm.name, cp.policy_id, cp.title, cp.description');
        $this->db->join('xin_companies AS cm', 'cp.company_id = cm.company_id', 'left');
        $this->db->where('policy_id', $id);
        return $this->db->get('xin_company_policy AS cp')->row();
    }

    public function get_resignation_reasons()
    {
        return $this->db->get('resignation_reasons')->result();
    }

    public function get_employee_designation($emp_id)
    {

        $this->db->select('CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, xd.designation_name');
        $this->db->join('xin_designations AS xd', 'xe.designation_id = xd.designation_id');
        return $this->db->get('xin_employees xe')->row();

    }
 
    public function add_resignation($data)
    {
        return $this->db->insert('xin_employee_resignations', $data);
    }

    public function get_leave_types($gender="")
    {
        if($gender == 'male')
            $this->db->where('identifier !=', 'maternity');

        $this->db->where('status', '1');
        return $this->db->get('xin_leave_type')->result();
    }

    
    public function leaves_available_count($emp_id, $gender="")
    {
        $year = date('Y');
        $query = "
            SELECT `xlt`.*, (SELECT FLOOR(`leaves_earned`) FROM `xin_employees` WHERE `employee_id` = $emp_id AND `xlt`.`identifier` = 'casual') AS `leaves_earned`,
            (SELECT SUM(DATEDIFF(`xla`.`to_date`, `xla`.`from_date`)) AS leave_count 
            FROM `xin_leave_applications` `xla` 
            WHERE `xla`.`employee_id` = $emp_id 
            AND `xla`.`leave_type_id` = `xlt`.`leave_type_id` 
            AND `xla`.`status` = '2' AND DATE_FORMAT(`xla`.`from_date`, '%Y') = '$year') AS leave_taken
            FROM `employee_basic_info` `ebi`, `gender` `g`, `xin_leave_type` `xlt`
            WHERE `ebi`.`gender` = `g`.`gender_id`
            AND `ebi`.`user_id` = $emp_id 
            ";

        if($gender != "")
        {
            $query .= " AND LOWER(`g`.`gender_name`) = '$gender'";
        }
        if(strtolower($gender) == 'male')
        {
            $query .= " AND `xlt`.`identifier` != 'maternity'";
        }

        return $this->db->query($query)->result();
    }

    public function previous_leave_applications($emp_id, $limit="")
    {
        if($limit != "")
            $this->db->limit($limit);

        $this->db->select('xla.leave_id, xla.leave_type_id, xlt.type_name, xla.from_date, xla.to_date, xla.reason, xla.remarks, xla.applied_on, xla.status');
        $this->db->join('xin_leave_type AS xlt', 'xla.leave_type_id = xlt.leave_type_id');
        $this->db->where('xla.employee_id', $emp_id);
        $this->db->order_by('xla.leave_id', 'DESC');
        return $this->db->get('xin_leave_applications AS xla')->result();

    }

    public function add_leave_request($data)
    {
        return $this->db->insert('xin_leave_applications', $data);
    }

    public function get_leave_detail($id)
    {
        $this->db->select('xlt.type_name, xla.from_date, xla.to_date, xla.reason, xla.remarks, xla.applied_on, xla.status');
        $this->db->join('xin_leave_type AS xlt', 'xla.leave_type_id = xlt.leave_type_id');
        $this->db->where('xla.leave_id', $id);
        return $this->db->get('xin_leave_applications AS xla')->row();
    }

    public function get_employee_trainings($employee_id=FALSE, $training_id=FALSE, $limit=FALSE)
    {
        $condition = "";

        $rowLimit = "";
        $date = date('Y-m-d');

        if($limit !== FALSE)
        {
            $rowLimit = " LIMIT 5";
            $condition .= " AND xt.start_date > '$date'";
        }

        if($training_id !== FALSE)
        {
            $condition .= ' AND xt.trg_id = ' . $training_id;
            $rowLimit = " LIMIT 1";
        }


        $condition .= ' ORDER BY xt.start_date DESC';

        $query = $this->db->query("SELECT xt.trg_id AS training_id, xt.trainer_one, xt.trainer_two, xt.facilitator_name, xt.target_group, xt.start_date, xt.end_date, xt.hall_detail, xt.session, xt.approval_type, 
            p.name AS province, 
            xc.name AS company, 
            xtt.type AS training_type, 
            CONCAT(t1.first_name,' ', t1.last_name) AS trainer1, t1.contact_number AS trainer1_contact, t1.email AS trainer1_email,
            CONCAT(t2.first_name,' ', t2.last_name) AS trainer2, t2.contact_number AS trainer2_contact, t2.email AS trainer2_email,
            xtl.location AS training_location, 
            c.name AS training_city
            FROM xin_trainings xt
            LEFT JOIN provinces p ON xt.location = p.id
            LEFT JOIN xin_companies xc ON xt.project = xc.company_id
            LEFT JOIN xin_training_types xtt ON xt.trg_type = xtt.training_type_id
            LEFT JOIN xin_trainers t1 ON xt.trainer_one = t1.trainer_id
            LEFT JOIN xin_trainers t2 ON xt.trainer_two = t2.trainer_id
            LEFT JOIN xin_training_locations xtl ON xt.venue = xtl.location_id
            LEFT JOIN city c ON xtl.city = c.id
            LEFT JOIN xin_employees xe ON xt.trainee_employees = xe.employee_id

            WHERE (trainee_employees LIKE '".$employee_id.",%' 
            OR trainee_employees LIKE '%,".$employee_id."' 
            OR trainee_employees LIKE '%,".$employee_id.",%' 
            OR trainee_employees LIKE '".$employee_id."') $condition $rowLimit");

        return $query;
    }

    public function new_trainings($employee_id)
    {
        $current_date = date('Y-m-d');
        $this->db->where(array('start_date <' => $current_date));
        $this->db->get('xin_trainings')->num_rows();
    }

    public function get_employee_card_detail($employee_id)
    {
        $this->db->select('xe.employee_id, CONCAT(xe.first_name," ", IFNULL(xe.last_name, "")) AS emp_name, xc.name AS project_name, xd.designation_name');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        return $this->db->get_where('xin_employees xe', array('xe.employee_id' => $employee_id))->row();
    }

    public function get_card_request_reasons($employee_id)
    {
        return $this->db->get('card_request_reasons')->result();
    }

    public function get_previous_request($employee_id)
    {
        $this->db->where('ec.employee_id', $employee_id);
        $this->db->order_by('ec.id', 'DESC');
        return $this->db->get('employee_cards ec')->row();
    }

    public function employee_basic_payroll_info()
    {
        $this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, ebi.cnic, xc.name AS company_name, xd.designation_name');
        $this->db->join('employee_basic_info ebi', 'xe.employee_id = ebi.user_id', 'left');
        $this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
        $this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
        return $this->db->get('xin_employees xe')->row();
    }

    public function employee_salary($employee_id)
    {
        $this->db->where('es.user_id', $employee_id);
        $this->db->join('employee_allowances ea', 'es.user_id = ea.user_id', 'left');
        $this->db->join('employee_deductions ed', 'es.user_id = ed.user_id', 'left');
        return $this->db->get('employee_salary es')->row();
    }

    public function get_open_investigations($employee_id)
    {
        $this->db->select('ci.id AS complaint_id, ci.complaint_no, ci.employee_id, ci.evidence, ci.evidence_date, ci.description, ci.reported_by, ci.reported_date, ci.forward_date, ci.other_reason, ir.reason_text');
        $this->db->where(array('ci.employee_id' => $employee_id, 'ci.contact_complainee' => '1', 'ci.complainee_reply' => NULL));
        $this->db->or_where('ci.complainee_reply', '');
        $this->db->join('investigation_reasons ir', 'ci.reason_id = ir.id', 'left');
        return $this->db->get('complaint_internal ci');
    }

    public function contract_print($user_id){
        $this->db->select('*');
        $this->db->from('employee_contract');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->result();
    }

    public function employee_status($employee_id)
    {
        $this->db->select('is_active');
        $this->db->where('employee_id', $employee_id);
        return $this->db->get('xin_employees')->row();
    }

    public function employee_payroll($employee_id, $salary_month)
    {
        $this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, ebi.cnic, xd.department_name, xdd.designation_name, es.salary_id, es.basic_salary, es.gross_salary, es.sdt, p.basic_salary AS payroll_basic_salary, p.total_allowance, p.total_deduction, p.net_salary AS payroll_net_salary, ea.house_rent_allowance, ea.medical_allowance, ea.travelling_allowance, ed.eobi, ed.provident_fund, ed.tax_deduction');
        $this->db->join('xin_employees xe', 'es.user_id = xe.employee_id', 'left');
        $this->db->join('employee_basic_info ebi', 'es.user_id = ebi.user_id', 'left');
        $this->db->join('xin_departments xd', 'xe.department_id = xd.department_id', 'left');
        $this->db->join('xin_designations xdd', 'xe.designation_id = xdd.designation_id', 'left');

        $this->db->join('payroll p', 'es.user_id = p.user_id', 'left');
        $this->db->join('employee_deductions ed', 'es.user_id = ed.user_id', 'left');
        $this->db->join('employee_allowances ea', 'es.user_id = ea.user_id', 'left');
        
        return $this->db->get_where('employee_salary es', array('es.user_id' => $employee_id, 'DATE_FORMAT(es.sdt, "%Y-%m") =' => $salary_month))->row();
    }

}
