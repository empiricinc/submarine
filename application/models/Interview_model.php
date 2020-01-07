<?php
/*
* Created by: Ayat Ullah
* Edited by: Saddam
*/
defined('BASEPATH') OR exit('No direct script access allowed');



class Interview_model extends CI_Model {

 

    public function __construct()

    {

        parent::__construct();

        $this->load->database();

    }
    // Interviews not done yet, schedules interviews.
	 public function interview_information() {
	 	$due_date = date('Y-m-d');
	 	$this->db->select('*');
	 	$this->db->from('assign_interview');
	 	$this->db->where('interview_date >', $due_date);
	 	return $this->db->get()->result();

		//$condition = "id =" . "'" . $id . "'";
		//$this->db->select('*');
		//$this->db->from('assign_interview');
		//$this->db->where($condition);
	//	$this->db->limit(1);
		//$query = $this->db->get();

	}
	// Get scheduled interviews. (Interview date > Current date)
	public function scheduled_interviews(){
		$due_date = date('Y-m-d');
		$this->db->select('assign_interview.*,
							xin_job_applications.application_id,
							xin_job_applications.job_id,
							xin_jobs.job_id,
							xin_jobs.company,
							xin_jobs.job_title,
							xin_jobs.designation_id,
							xin_jobs.province,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name,
							provinces.id,
							provinces.name as provName,
							city.id,
							city.name as cityName');
		$this->db->from('assign_interview');
		$this->db->join('xin_job_applications', 'assign_interview.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->where('assign_interview.interview_date >= ', $due_date);
		// Make sure that the rollnumber doesn't exist in the interview_result table.
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM interview_result)');
		$query = $this->db->get();
		$this->db->limit(10);
		// echo $this->db->last_query();
		return $query->result();
	}
	// Search interviews.
	public function scheduled_search($rollno, $name, $project, $designation, $province, $district){
		$int_date = date('Y-m-d');
		$this->db->select('assign_interview.*,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_jobs.company,
							xin_jobs.designation_id,
							xin_jobs.province,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name,
							provinces.id,
							provinces.name as provName,
							city.id,
							city.name as cityName');
		$this->db->from('assign_interview');
		$this->db->join('xin_job_applications', 'assign_interview.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->where('assign_interview.rollnumber', $rollno);
		$this->db->where('assign_interview.interview_date >=', $int_date);
		$this->db->or_where('xin_job_applications.fullname', $name);
		$this->db->where('assign_interview.interview_date >=', $int_date);
		$this->db->or_where('xin_companies.name', $project);
		$this->db->where('assign_interview.interview_date >=', $int_date);
		$this->db->or_where('xin_designations.designation_name', $designation);
		$this->db->where('assign_interview.interview_date >=', $int_date);
		$this->db->or_where('provinces.name', $province);
		$this->db->where('assign_interview.interview_date >=', $int_date);
		$this->db->or_where('city.name', $district);
		$this->db->where('assign_interview.interview_date >=', $int_date);
		// Make sure that the rollnumber doesn't exist in the interview_result table.
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM interview_result)');
		return $this->db->get()->result();
	}
	// Count scheduled interviews.
	public function count_scheduled(){
		$date_range = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('assign_interview');
		$this->db->where('interview_date >=', $date_range);
		// Make sure that the rollnumber doesn't exist in the interview_result table.
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM interview_result)');
		return $this->db->get()->num_rows();
	}
	// Get all scheduled interviews.
	public function all_scheduled($limit, $offset){
		$due_date = date('Y-m-d');
		$this->db->select('assign_interview.*,
							xin_job_applications.application_id,
							xin_job_applications.job_id,
							xin_job_applications.fullname,
							xin_jobs.job_id,
							xin_jobs.company,
							xin_jobs.job_title,
							xin_jobs.designation_id,
							xin_jobs.province,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name,
							provinces.id,
							provinces.name as provName,
							city.id,
							city.name as cityName');
		$this->db->from('assign_interview');
		$this->db->join('xin_job_applications', 'assign_interview.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->where('assign_interview.interview_date >= ', $due_date);
		// Make sure that the rollnumber doesn't exist in the interview_result table.
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM interview_result)');
		$query = $this->db->get();
		$this->db->limit($limit, $offset);
		// echo $this->db->last_query();
		return $query->result();
	}


function applicantdetails($id){
  
  $condition =      " application_id =" . $id . " ";
             
    $this->db->select("xin_job_applications.*,
    					gender.gender_id,
    					gender.gender_name as genderName,
    					age.id,
    					age.name as age_name,
    					education.id,
    					education.name as edu_name,
    					provinces.id,
    					provinces.name as prov_name,
    					city.id,
    					city.name as cityName,
    					xin_jobs.job_id,
    					xin_jobs.job_title,
    					xin_jobs.company,
    					xin_jobs.designation_id,
    					xin_jobs.province,
    					xin_companies.company_id,
    					xin_companies.name as comp_name,
    					xin_designations.designation_id,
    					xin_designations.designation_name,
    					interview_result.id,
    					interview_result.rollnumber,
    					interview_result.obtain_marks,
    					interview_result.total_marks,
    					interview_result.sdt as int_date,
    					assign_interview.id,
    					assign_interview.rollnumber,
    					assign_interview.interview_date as assigned_date"); 
    $this->db->from('xin_job_applications');
    $this->db->join('gender', 'xin_job_applications.gender = gender.gender_id', 'left');
    $this->db->join('age', 'xin_job_applications.age = age.id', 'left');
    $this->db->join('education', 'xin_job_applications.education = education.id', 'left');
    $this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
    $this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
    $this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
    $this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
    $this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
    $this->db->join('interview_result', 'xin_job_applications.application_id = interview_result.rollnumber', 'left');
    $this->db->join('assign_interview', 'xin_job_applications.application_id = assign_interview.rollnumber', 'left');
    $this->db->where($condition);
    $this->db->order_by('application_id', 'DESC');
    $this->db->limit(1);
     $query = $this->db->get(); //echo $this->db->last_query();
  return $query->result();
	}	 

 function interview_result_exists($table,$field,$value)
    {
        $this->db->where($field,$value);
        $query = $this->db->get($table);
        if (!empty($query->result_array())){
            return 1;
        }
        else{
            return 0;
        }
    }
    // Count completed interviews.
    public function count_completed(){
    	return $this->db->count_all_results('interview_result');
    }
    // Get completed interviews with marks, location, project and designation.
    public function completed_interviews($limit, $offset){
    	$this->db->select('interview_result.id,
    						interview_result.rollnumber,
    						interview_result.obtain_marks,
    						interview_result.total_marks,
    						interview_result.sdt,
    						xin_job_applications.application_id,
    						xin_job_applications.fullname,
    						xin_job_applications.job_id,
    						xin_job_applications.city_name,
    						xin_jobs.job_id,
    						xin_jobs.company,
    						xin_jobs.designation_id,
    						xin_jobs.province,
    						xin_companies.company_id,
    						xin_companies.name as comp_name,
    						xin_designations.designation_id,
    						xin_designations.designation_name,
    						provinces.id,
    						provinces.name as prov_name,
    						city.id,
    						city.name as city_name');
    	$this->db->from('interview_result');
    	$this->db->join('xin_job_applications', 'interview_result.rollnumber = xin_job_applications.application_id', 'left');
    	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
    	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
    	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
    	$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
    	$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
    	$this->db->limit($limit, $offset);
    	return $this->db->get()->result();
    }
    // Search completed interviews.
   	public function completed_search($rollno, $name, $project, $designation, $province, $district){
   		$this->db->select('interview_result.id,
    						interview_result.rollnumber,
    						interview_result.obtain_marks,
    						interview_result.total_marks,
    						interview_result.sdt,
    						xin_job_applications.application_id,
    						xin_job_applications.fullname,
    						xin_job_applications.job_id,
    						xin_job_applications.city_name,
    						xin_jobs.job_id,
    						xin_jobs.company,
    						xin_jobs.designation_id,
    						xin_jobs.province,
    						xin_companies.company_id,
    						xin_companies.name as comp_name,
    						xin_designations.designation_id,
    						xin_designations.designation_name,
    						provinces.id,
    						provinces.name as prov_name,
    						city.id,
    						city.name as city_name');
    	$this->db->from('interview_result');
    	$this->db->join('xin_job_applications', 'interview_result.rollnumber = xin_job_applications.application_id', 'left');
    	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
    	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
    	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
    	$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
    	$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
    	$this->db->where('interview_result.rollnumber', $rollno);
    	$this->db->or_where('xin_job_applications.fullname', $name);
    	$this->db->or_where('xin_companies.name', $project);
    	$this->db->or_where('xin_designations.designation_name', $designation);
    	$this->db->or_where('provinces.name', $province);
    	$this->db->or_where('city.name', $district);
    	return $this->db->get()->result();
   	}
    // Overdue interviews, date passed and not done yet.
    public function overdue_interviews(){
		$range = date('Y-m-d');
		$this->db->select('assign_interview.*,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.application_id,
							xin_job_applications.job_id,
							xin_jobs.job_id,
							xin_jobs.company,
							xin_jobs.job_title,
							xin_jobs.designation_id,
							xin_jobs.province,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name,
							provinces.id,
							provinces.name as provName,
							city.id,
							city.name as cityName');
		$this->db->from('assign_interview');
		$this->db->join('xin_job_applications', 'assign_interview.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->where('assign_interview.interview_date < ', $range);
		// Make sure that the rollnumber doesn't exist in the interview_result table.
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM interview_result)');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
	// Count all overdue interviews.
	public function count_overdue(){
		$date_range = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('assign_interview');
		$this->db->where('interview_date <', $date_range);
		// Make sure that the rollnumber doesn't exist in the interview_result table.
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM interview_result)');
		return $this->db->get()->num_rows();
	}
	// Get all overdue interviews. (List of all overdue interviews)
	public function all_overdue($limit, $offset){
		$range = date('Y-m-d');
		$this->db->select('assign_interview.*,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.application_id,
							xin_job_applications.job_id,
							xin_jobs.job_id,
							xin_jobs.company,
							xin_jobs.job_title,
							xin_jobs.designation_id,
							xin_jobs.province,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name,
							provinces.id,
							provinces.name as provName,
							city.id,
							city.name as cityName');
		$this->db->from('assign_interview');
		$this->db->join('xin_job_applications', 'assign_interview.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->where('assign_interview.interview_date < ', $range);
		// Make sure that the rollnumber doesn't exist in the interview_result table.
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM interview_result)');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	// Search overdue interviews.
	public function overdue_search($rollno, $name, $project, $designation, $province, $district){
		$overdue_date = date('Y-m-d');
		$this->db->select('assign_interview.*,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.application_id,
							xin_job_applications.job_id,
							xin_jobs.job_id,
							xin_jobs.company,
							xin_jobs.job_title,
							xin_jobs.designation_id,
							xin_jobs.province,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name,
							provinces.id,
							provinces.name as provName,
							city.id,
							city.name as cityName');
		$this->db->from('assign_interview');
		$this->db->join('xin_job_applications', 'assign_interview.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->where('assign_interview.rollnumber', $rollno);
		$this->db->where('assign_interview.interview_date < ', $overdue_date);
		$this->db->or_where('xin_job_applications.fullname', $name);
		$this->db->where('assign_interview.interview_date < ', $overdue_date);
		$this->db->or_where('xin_companies.name', $project);
		$this->db->where('assign_interview.interview_date <', $overdue_date);
		$this->db->or_where('xin_designations.designation_name', $designation);
		$this->db->where('assign_interview.interview_date <', $overdue_date);
		$this->db->or_where('provinces.name', $province);
		$this->db->where('assign_interview.interview_date <', $overdue_date);
		$this->db->or_where('city.name', $district);
		$this->db->where('assign_interview.interview_date < ', $overdue_date);
		// Make sure that the rollnumber doesn't exist in the interview_result table.
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM interview_result)');
		return $this->db->get()->result();
	}
	// Re-schedule an interview.
	public function re_schedule($rollnumber, $data){
		$this->db->where('rollnumber', $rollnumber);
		$this->db->update('assign_interview', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Delete an interview.
	public function delete_interview($rollnumber){
		$this->db->where('rollnumber', $rollnumber);
		$this->db->delete('assign_interview');
		return true;
	}
	// Get rollnumber detail for applicant for entering interview marks manually.
	public function get_rollnumber_detail($rollnumber){
		$this->db->select('assign_interview.rollnumber,
									xin_job_applications.application_id,
									xin_job_applications.job_id,
									xin_job_applications.fullname,
									xin_jobs.job_id,
									xin_jobs.company,
									xin_jobs.designation_id,
									xin_companies.company_id,
									xin_companies.name,
									xin_designations.designation_id,
									xin_designations.designation_name');
		$this->db->from('assign_interview');
		$this->db->join('xin_job_applications', 'assign_interview.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->where('assign_interview.rollnumber', $rollnumber);
		echo $this->db->last_query();
		$query = $this->db->get();
		return $query->row();
	}
	// Save interview marks.
	public function save_marks($data){
		$this->db->insert('interview_result', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Display applicant detail in the form while adding result.
	public function applicant_detail($rollnumber){
		$this->db->select('assign_interview.rollnumber,
							assign_interview.interview_date,
									xin_job_applications.application_id,
									xin_job_applications.job_id,
									xin_job_applications.fullname,
									xin_job_applications.cnic,
									xin_job_applications.city_name,
									xin_jobs.job_id,
									xin_jobs.company,
									xin_jobs.designation_id,
									xin_companies.company_id,
									xin_companies.name,
									xin_designations.designation_id,
									xin_designations.designation_name,
									district.id,
									district.name as cityName');
		$this->db->from('assign_interview');
		$this->db->join('xin_job_applications', 'assign_interview.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('district', 'xin_job_applications.city_name = district.id', 'left');
		$this->db->where('assign_interview.rollnumber', $this->uri->segment(3));
		echo $this->db->last_query();
		$query = $this->db->get();
		return $query->row();
	}
	// Save SM interview.
	public function save_sm_interview($data){
		$this->db->insert('interview_result', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Upate SM Interview if roll number already exists.
	public function update_sm_interview($rollnumber, $data){
		$this->db->where('rollnumber', $rollnumber);
		$this->db->update('interview_result', $data);
		return true;
	}
	// Save DHCSO interview.
	public function save_dhcso_interview($data){
		$this->db->insert('interview_result', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Update DHCSO interview if the roll number already exists.
	public function update_dhcso_interview($rollnumber, $data){
		$this->db->where('rollnumber', $rollnumber);
		$this->db->update('interview_result', $data);
		return true;
	}
	// Save FCM/CHW interview.
	public function save_fcm_interview($data){
		$this->db->insert('interview_result', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Update FCM/CHW interview if roll number already
	public function update_fcm_interview($rollnumber, $data){
		$this->db->where('rollnumber', $rollnumber);
		$this->db->update('interview_result', $data);
		return true;
	}
	// read job info
/*	 public function read_job_information($id) {

		$condition = "id =" . "'" . $id . "'";
		$this->db->select('*');
		$this->db->from('assign_interview');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return null;
		}
	}
*/
	

	// get all job > frontend

/*	public function all_jobs() {

	  $query = $this->db->query("SELECT * from xin_jobs");

  	  return $query->result();

	}*/
  

		// Function to add record in table
/*
	public function assign_interview($data){

 
		$this->db->insert('assign_interview', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}
*/


	// Function to Delete selected record from table
	/*public function delete_record($id){

		$this->db->where('job_id', $id);
		$this->db->delete('xin_jobs');		

	}*/

	// Function to update record in table

	/*public function update_record($data, $id){

		$this->db->where('job_id', $id);

		if( $this->db->update('xin_jobs',$data)) {

			return true;

		} else {

			return false;

		}		

	}*/
}

?>