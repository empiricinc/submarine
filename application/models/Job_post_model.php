<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class job_post_model extends CI_Model {

 

    public function __construct()

    {

        parent::__construct();

        $this->load->database();

    }

 	

	// get jobs

	public function get_jobs() {

	  return $this->db->get("xin_jobs");

	}

			

	// get all job candidates

	public function get_jobs_candidates() {

	  return $this->db->get("xin_job_applications");

	}

	

	// get all employee applied jobs

	public function get_employee_jobs_applied($id) {

		return $query = $this->db->query("SELECT * from xin_job_applications where user_id = '".$id."'");

	}

	 // read job info

	 public function read_job_information($id) {

	

		$condition = "job_id =" . "'" . $id . "'";

		$this->db->select('*');

		$this->db->from('xin_jobs');

		$this->db->where($condition);

		$this->db->limit(1);

		$query = $this->db->get();

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return null;

		}

	}

	

	// get all jobtype jobs

	 public function read_all_jobs_by_type() {

	

		$condition = "job_type !='' group by job_type";

		$this->db->select('*');

		$this->db->from('xin_jobs');

		$this->db->where($condition);

		$this->db->limit(1000);

		$query = $this->db->get();

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return null;

		}

	}

	

	// get all job types

	public function all_job_types() {

	  $query = $this->db->query("SELECT * from xin_job_type");

  	  return $query->result();

	}

	

	// get all jobs by designation

	 public function read_all_jobs_by_designation() {

	

		$condition = "designation_id !='' group by designation_id";

		$this->db->select('*');

		$this->db->from('xin_jobs');

		$this->db->where($condition);

		$this->db->limit(1000);

		$query = $this->db->get();

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return null;

		}

	}

	

	// check apply jobs > remove duplicate

	 public function check_apply_job($job_id,$user_id) {

	

		$condition = "job_id='".$job_id."' and user_id='".$user_id."'";

		$this->db->select('*');

		$this->db->from('xin_job_applications');

		$this->db->where($condition);

		$this->db->limit(1);

		return $query = $this->db->get();

		

		

		// $query->result();

	}

	

	// get all interview jobs > 

	public function all_interview_jobs()

	{

	  $query = $this->db->query("SELECT j.*, jap.* FROM xin_jobs as j, xin_job_applications as jap where j.job_id = jap.job_id group by j.job_id");

  	  return $query->result();

	}

	

	// read job type info

	 public function read_job_type_information($id) {

	

		$condition = "job_type_id =" . "'" . $id . "'";

		$this->db->select('*');

		$this->db->from('xin_job_type');

		$this->db->where($condition);

		$this->db->limit(1);

		$query = $this->db->get();

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return null;

		}

	}

	

	// get all interviews

	public function all_interviews() {

	  return $this->db->get("xin_job_interviews");

	}

	

	

	// Function to add record in table

	public function add($data){

		//echo '<pre>'.print_r($data).'</pre>'; exit();

		$this->db->insert('xin_jobs', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}



	// Function to add record in table

	public function add_test($data){

		//echo '<pre>'.print_r($data).'</pre>'; exit();

		$this->db->insert('assign_test', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}



	// Function to add record in table

	public function add_interview_result($data){

		//echo '<pre>'.print_r($data).'</pre>'; exit();

		$this->db->insert('interview_result', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}	


		// Function to add record in table

	public function assign_interview($data){

		//echo '<pre>'.print_r($data).'</pre>'; exit();

		$this->db->insert('assign_interview', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}



	public function add_employee_contract($data){

		$this->db->insert('employee_contract', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function send_offer_letter($data){

		$this->db->insert('employee_offer_letter', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}




	public function add_employee_basic_info($data){

		$this->db->insert('employee_basic_info', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	

	public function add_xin_employee_info($data){

		$this->db->insert('xin_employees', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function add_employee_residential_info($data){

		$this->db->insert('employee_residential_info', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function add_employee_permanent_location_info($data){

		$this->db->insert('employee_permanent_location_info', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_employee_educational_info($data){

		$this->db->insert('employee_educational_info', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}	


	public function add_employee_total_experience_info($data){

		$this->db->insert('employee_total_experience_info', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}	


	public function add_employee_salary_details($data){

		$this->db->insert('employee_salary', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function add_employee_allowance_details($data){

		$this->db->insert('employee_allowances', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	
	public function add_employee_deductions_details($data){

		$this->db->insert('employee_deductions', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function add_employee_cards($data){

		$this->db->insert('employee_cards', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}


	public function add_employee_insurance($data){

		$this->db->insert('insurance', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function add_employee_bank_information_info($data){

		$this->db->insert('employee_bank_information_info', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}	


	public function add_employee_supervisor_details($data){

		$this->db->insert('employee_supervisor_details', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}	
	

	// Function to add record in table

	public function add_resume($data){
		
		//echo '<pre>'.print_r($data).'</pre>'; exit();

		$this->db->insert('xin_job_applications', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}

	

	// get all job > frontend

	public function all_jobs() {

	  $query = $this->db->query("SELECT * from xin_jobs");

  	  return $query->result();

	}

	

	// Function to Delete selected record from table

	public function delete_record($id){

		$this->db->where('job_id', $id);

		$this->db->delete('xin_jobs');

		

	}

	

	// Function to Delete selected record from table

	public function delete_application_record($id){

		$this->db->where('application_id', $id);

		$this->db->delete('xin_job_applications');

		

	}

	

	// Function to Delete selected record from table

	public function delete_interview_record($id){

		$this->db->where('job_interview_id', $id);

		$this->db->delete('xin_job_interviews');

		

	}

	

	// get department > designations

	public function ajax_job_user_information($id) {

	

		$condition = "job_id =" . "'" . $id . "'";

		$this->db->select('*');

		$this->db->from('xin_job_applications');

		$this->db->where($condition);

		$this->db->limit(100);

		$query = $this->db->get();

		

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

	

	// Function to add record in table

	public function add_interview($data){

		$this->db->insert('xin_job_interviews', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}


	public function update_location_job_position($data, $id){

		$this->db->where('id', $id);

		if( $this->db->update('location_job_position',$data)) {

			return true;

		} else {

			return false;

		}		

	}
	

	// Function to update record in table

	public function update_record($data, $id){

		$this->db->where('job_id', $id);

		if( $this->db->update('xin_jobs',$data)) {

			return true;

		} else {

			return false;

		}		

	}

}

?>