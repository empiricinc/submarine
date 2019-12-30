<?php
/*
* Filename: Contract_model.php
* Filepath: Models / Contract_model.php
* Author: Saddam
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Contract_model extends CI_Model {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
	 public function contract_information($limit, $offset) {
	 	$this->db->select('employee_contract.*,
			 	 					xin_contract_type.contract_type_id,
			 	 					xin_contract_type.name as cont_type,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.job_id,
			 	 					xin_job_applications.fullname,
			 	 					xin_job_applications.email,
			 	 					xin_job_applications.gender,
			 	 					xin_job_applications.province,
			 	 					xin_job_applications.city_name,
			 	 					xin_job_applications.cnic,
			 	 					xin_job_applications.dob,
			 	 					xin_companies.name,
			 	 					xin_designations.designation_id,
			 	 					xin_designations.designation_name,
		                     provinces.id,
		                     provinces.name as provName,
		                     xin_departments.department_id,
		                     xin_jobs.job_id,
		                     xin_jobs.company,
		                     xin_jobs.designation_id,
		                     xin_jobs.department_id,
		                     district.id,
		                     district.name as cityName');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
      $this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
      $this->db->join('district', 'xin_job_applications.city_name = district.id', 'left');
      $this->db->join('xin_departments', 'xin_jobs.department_id = xin_departments.department_id', 'left');
      // $this->db->order_by('employee_contract.id', 'DESC');
		$this->db->limit($limit, $offset);
	 	$query = $this->db->get();
	 	return $query->result();
	}
	// Get records near to expiry, expired contracts.
	public function get_by_date(){
		$date1 = date('Y-m-d');
		$str2 = date('Y-m-d', strtotime('+15 days', strtotime($date1)));
		$this->db->select('employee_contract.id,
									employee_contract.user_id,
									employee_contract.from_date,
									employee_contract.to_date,
									employee_contract.contract_manager,
									employee_contract.contract_type,
									employee_contract.status,
									employee_contract.sdt,
									xin_contract_type.contract_type_id,
									xin_contract_type.name,
                           xin_employees.employee_id,
                           xin_employees.provience_id,
                           xin_employees.company_id,
                           xin_employees.designation_id,
                           xin_employees.department_id,
                           xin_employees.city_id,
                           xin_employees.user_role_id,
                           xin_companies.company_id,
									xin_companies.name as comp_name,
                           xin_designations.designation_id,
                           xin_departments.department_id,
                           provinces.id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
      $this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left'); // This line and below this are added later.
      $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
      $this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
      $this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
      $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->order_by('employee_contract.id', 'DESC');
		// $this->db->where("DATEDIFF(NOW(), $str2) BETWEEN 21 AND 1");
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
	// Count active contracts
	public function count_active(){
		return $this->db->where(array('status'=> 1))->from('employee_contract')->count_all_results();
	}
	// Get all active contracts
	public function all_active_contracts($limit, $offset){
		$this->db->select('employee_contract.*,
			 	 					xin_contract_type.contract_type_id,
			 	 					xin_contract_type.name as cont_type,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.job_id,
			 	 					xin_job_applications.fullname,
			 	 					xin_job_applications.email,
			 	 					xin_job_applications.gender,
			 	 					xin_job_applications.province,
			 	 					xin_job_applications.city_name,
			 	 					xin_job_applications.cnic,
			 	 					xin_job_applications.dob,
			 	 					xin_companies.company_id,
			 	 					xin_companies.name,
			 	 					xin_jobs.job_id,
		                     xin_jobs.company,
		                     xin_jobs.designation_id,
		                     xin_jobs.department_id,
			 	 					xin_designations.designation_id,
			 	 					xin_designations.designation_name,
                           provinces.id,
                           xin_departments.department_id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
      $this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
      $this->db->join('xin_departments', 'xin_jobs.department_id = xin_departments.department_id', 'left');
		$this->db->where(array('employee_contract.status' => 1));
		$this->db->order_by('employee_contract.id', 'DESC');
		// $this->db->or_where(array('employee_contract.status' => 2));
		// $this->db->or_where(array('employee_contract.status' => 3));
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        return $query->result();
	}
	// Count pending contracts
	public function count_contracts(){
		return $this->db->where(array('status'=> 0))->from('employee_contract')->count_all_results();
	}
	public function get_pending_contracts($limit, $offset){
		$this->db->select('employee_contract.*,
			 	 					xin_contract_type.contract_type_id,
			 	 					xin_contract_type.name as cont_type,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.job_id,
			 	 					xin_job_applications.fullname,
			 	 					xin_job_applications.province,
			 	 					xin_job_applications.city_name,
			 	 					xin_job_applications.gender,
			 	 					xin_job_applications.email,
			 	 					xin_job_applications.message,
			 	 					xin_job_applications.created_at,
			 	 					xin_jobs.job_id,
			 	 					xin_jobs.company,
			 	 					xin_jobs.designation_id,
			 	 					xin_companies.company_id,
			 	 					xin_companies.name as compName,
			 	 					xin_designations.designation_id,
			 	 					xin_designations.designation_name,
			 	 					provinces.id,
			 	 					provinces.name,
			 	 					city.id,
			 	 					city.name as city_name,
			 	 					domicile.id,
			 	 					domicile.name as dom_name');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		// $this->db->join('gender', 'xin_job_applications.gender = gender.gender_id', 'left');
		$this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->join('domicile', 'xin_job_applications.domicile = domicile.id', 'left');
		$this->db->where('employee_contract.status', 0);
		$this->db->order_by('employee_contract.id', 'DESC');
		$this->db->limit($limit, $offset);
	 	$query = $this->db->get();
	 	return $query->result();
	}
	// Count all expired contracts
	public function count_expired(){
		$date1 = date('Y-m-d');
		$str2 = date('Y-m-d', strtotime('+15 days', strtotime($date1)));
		return $this->db->where('to_date <=', $str2)->from('employee_contract')->count_all_results();
	}
	// All contracts near expiry, all expired contracts.
	public function all_expired_contracts($limit, $offset){
		$date1 = date('Y-m-d');
		$str2 = date('Y-m-d', strtotime('+15 days', strtotime($date1)));
		$this->db->select('employee_contract.id,
									employee_contract.user_id,
									employee_contract.from_date,
									employee_contract.to_date,
									employee_contract.contract_manager,
									employee_contract.contract_type,
									employee_contract.status,
									employee_contract.sdt,
									xin_contract_type.contract_type_id,
									xin_contract_type.name as contType,
                           xin_employees.employee_id,
                           xin_employees.first_name,
                           xin_employees.last_name,
                           xin_employees.email,
                           xin_employees.company_id,
                           xin_employees.designation_id,
                           xin_employees.department_id,
                           xin_employees.provience_id,
                           xin_employees.city_id,
                           xin_employees.user_role_id,
                           xin_companies.company_id,
                           xin_companies.name,
                           xin_designations.designation_id,
                           xin_designations.designation_name,
                           xin_departments.department_id,
                           provinces.id,
                           provinces.name as provName,
                           district.id,
                           district.name as distName');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
      $this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
      $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
      $this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
      $this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
      $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
      $this->db->join('district', 'xin_employees.city_id = district.id', 'left');
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->order_by('employee_contract.id', 'DESC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	// Count rejected/finished contracts
	public function count_rejected(){
		return $this->db->where(array('status'=> 5, 'status'=>6))->from('employee_contract')->count_all_results();
	}
	// Finished / Rejected contracts.
	public function rejected_contracts($limit, $offset){
		$this->db->select('employee_contract.id,
									employee_contract.user_id,
									employee_contract.from_date,
									employee_contract.to_date,
									employee_contract.contract_manager,
									employee_contract.contract_type,
									employee_contract.status,
									employee_contract.sdt,
									employee_contract.rejection_reason,
									xin_contract_type.contract_type_id,
									xin_contract_type.name as contType,
		                     xin_job_applications.application_id,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.job_id,
			 	 					xin_job_applications.fullname,
			 	 					xin_job_applications.email,
			 	 					xin_job_applications.gender,
			 	 					xin_job_applications.province,
			 	 					xin_job_applications.city_name,
			 	 					xin_job_applications.cnic,
			 	 					xin_job_applications.dob,
			 	 					xin_jobs.job_id,
			 	 					xin_jobs.company,
			 	 					xin_jobs.designation_id,
			 	 					xin_jobs.department_id,
		                     xin_companies.company_id,
		                     xin_companies.name,
		                     xin_designations.designation_id,
		                     xin_designations.designation_name,
		                     xin_departments.department_id,
		                     provinces.id,
		                     provinces.name as provName,');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
     	$this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
     	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
     	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
     	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
     	$this->db->join('xin_departments', 'xin_jobs.department_id = xin_departments.department_id', 'left');
     	$this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
		$this->db->where('employee_contract.status', 5);
		$this->db->or_where('employee_contract.status', 6);
		$this->db->order_by('employee_contract.id', 'DESC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	// Get printed contracts.
	public function printed_contracts($status = ''){
		$this->db->select('employee_contract.*,
			 	 					xin_contract_type.contract_type_id,
			 	 					xin_contract_type.name as cont_type,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.job_id,
			 	 					xin_job_applications.fullname,
			 	 					xin_job_applications.email,
			 	 					xin_job_applications.gender,
			 	 					xin_job_applications.province,
			 	 					xin_job_applications.city_name,
			 	 					xin_job_applications.cnic,
			 	 					xin_job_applications.dob,
			 	 					xin_jobs.job_id,
			 	 					xin_jobs.company,
			 	 					xin_jobs.designation_id,
			 	 					xin_companies.company_id,
			 	 					xin_companies.name,
			 	 					xin_designations.designation_id,
			 	 					xin_designations.designation_name,
		                    	xin_departments.department_id,
		                    	provinces.id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
      $this->db->join('xin_departments', 'xin_jobs.department_id = xin_departments.department_id', 'left');
      $this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
	   $this->db->where('employee_contract.status', $status);
	   $this->db->order_by('employee_contract.id', 'DESC');
	   // $this->db->limit(10);
	   return $this->db->get()->result();
	}
	// Contract history.
	public function contract_history($user_id){
		$this->db->select('employee_contract.*,
									xin_contract_type.contract_type_id,
									xin_contract_type.name');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->where('employee_contract.user_id', $user_id);
		return $this->db->get()->result();
	}
		function applicantdetails($id){
  
	 		$condition = " application_id =" . $id . " ";
	      $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 
	      $this->db->from('xin_job_applications');
	      $this->db->where($condition);
	      $this->db->order_by('application_id', 'DESC');
	      $this->db->limit(1);
			$query = $this->db->get();
			return $query->result(); 
 		}	 
 		// Get contract info by segment 3 id.
 		public function get_contract_byID(){
 			$this->db->select('user_id, long_description, from_date, to_date');
 			$this->db->from('employee_contract');
 			$this->db->where('user_id', $this->uri->segment(3));
 			return $this->db->get()->row_array();
 		}
 		// Create contract.
 		public function create_contract($user_id = '', $data = ''){
 			$this->db->where(array('user_id' => $user_id, 'status' => 0));
 			$this->db->update('employee_contract', $data);
 		}
 		// Select contract format from the list.
 		public function get_contract_formats(){
 			$this->db->select('xin_contract_type.contract_type_id,
 										xin_contract_type.designation,
 										xin_contract_type.name,
 										xin_contract_type.contract_format,
 										xin_designations.designation_id,
 										xin_designations.designation_name');
 			$this->db->from('xin_contract_type');
 			$this->db->join('xin_designations', 'xin_contract_type.designation = xin_designations.designation_id', 'left');
 			return $this->db->get()->result();
 		}
 		// Get contract for extension.
 		public function get_for_extension(){
 			$this->db->select('id, user_id, long_description, from_date, to_date');
 			$this->db->from('employee_contract');
 			$this->db->where('user_id', $this->uri->segment(3));
 			return $this->db->get()->row_array();
 		}
	public function addtoAcctiveContract($id) {
	    //extract($data);
	    $this->db->where('user_id', $id);
	    //echo $this->db->last_query(); exit();
	    $this->db->update('employee_contract', array('status' => '1')); // status for short list
	    return true;
	}
	// Add to distributed contracts.
	public function distribute_contracts($id){
		$this->db->where('user_id', $id);
		$this->db->where('status', 2);
		$this->db->update('employee_contract', array('status' => '3'));
		return true;
	}
	// Attach to personal file.
	public function attach_to_file($id){
		$this->db->where('user_id', $id);
		$this->db->where('status', 3);
		$this->db->update('employee_contract', array('status' => '4'));
		return true;
	}
	// Contract extension
	public function contract_extension($data = ''){
		$this->db->insert('employee_contract', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Extend multiple contracts at once.
	public function extend_bulk($date, $data){
		$this->db->where('to_date <=', $date);
		// $this->db->where('status !=', 5);
		$this->db->update('employee_contract', $data);
		return true;
	}
	// Finish contract
	public function finish_contract($id = '', $data = ''){
		$this->db->where('user_id', $id);
		$this->db->update('employee_contract', $data);
		return true;
	}
	// Reject contract.
	public function reject_contract($user_id = '', $data = ''){
		$this->db->where('user_id', $user_id);
		$this->db->update('employee_contract', $data);
		return true;
	}
	// Count finished contracts
	public function count_finished(){
		return $this->db->where('status', 2)->from('employee_contract')->count_all_results();
	}
	// Get finished contracts.
	public function contracts_finished(){
		$this->db->select('employee_contract.*');
		return $this->db->get()->result();
	}
	// Uploading scanned copy of contract.
	public function upload_copy($user_id = '', $data = ''){
		$this->db->where('user_id', $user_id);
		$this->db->update('employee_contract', $data);
	}
	// Insert contract copy.
	public function insert($data = array()){
        $insert = $this->db->insert_batch('employee_contract_files', $data);
        return $insert?true:false;
    }
    // View employee's scanned contract copies.
    public function get_copies($user_id = ''){
    	$this->db->select('employee_contract.id,
		    						employee_contract.user_id,
		    						employee_contract_files.file_id,
		    						employee_contract_files.emp_id,
		    						employee_contract_files.file_name');
    	$this->db->from('employee_contract_files');
    	$this->db->join('employee_contract', 'employee_contract_files.emp_id = employee_contract.user_id');
    	$this->db->where('employee_contract_files.emp_id', $user_id);
    	return $this->db->get()->result();
    }
    // Delete copies.
    public function delete_file($file_id){
    	$this->db->where('file_id', $file_id);
    	$this->db->delete('employee_contract_files');
    	if($this->db->affected_rows() > 0){
    		return true;
    	}else{
    		return false;
    	}
    }
	// Printing contracts. Single contract printing.
	public function contract_print($user_id){
		$this->db->select('*');
		$this->db->from('employee_contract');
		$this->db->where('user_id', $user_id);
		return $this->db->get()->result();
	}
	// Printing contracts. Print multiple having status equals 0 (Pending...)
	public function print_bulk(){
		$this->db->select('*');
		$this->db->from('employee_contract');
		$this->db->where('status', 0);
		return $this->db->get()->result();
	}
	// Add multiple to distributed.
	public function distribute_bulk(){
		return $this->db->where('status', 2)->update('employee_contract', array('status' => 3));
	}
	// Bulk attach to personal file.
	public function attach_bulk(){
		return $this->db->where('status', 3)->update('employee_contract', array('status' => 4));
	}
	// Count all results to display them in the buttons.
	public function count_active_contracts(){
		return $this->db->where('status', 1)->from('employee_contract')->count_all_results();
	}
	public function count_printed_contracts(){
		return $this->db->where('status', 2)->from('employee_contract')->count_all_results();
	}
	public function count_distributed_contracts(){
		return $this->db->where('status', 3)->from('employee_contract')->count_all_results();
	}
	public function count_attached_contracts(){
		return $this->db->where('status', 4)->from('employee_contract')->count_all_results();
	}
	// ---------------------- Offer Letters -------------------------------------------//
	public function offer_letters($limit, $offset){
	   $this->db->select('employee_offer_letter.id, 
				 					employee_offer_letter.user_id,
				 					employee_offer_letter.status,
				 					employee_offer_letter.attachment,
				 					employee_offer_letter.sdt,
				 					xin_companies.company_id,
				 					xin_companies.name,
				 					xin_designations.designation_id,
				 					xin_designations.designation_name,
				 					xin_job_applications.application_id,
				 					xin_job_applications.job_id,
				 					xin_job_applications.fullname,
				 					xin_jobs.job_id,
				 					xin_jobs.company,
				 					xin_jobs.designation_id');
	 	$this->db->from('employee_offer_letter');
	 	$this->db->join('xin_job_applications', 'employee_offer_letter.user_id = xin_job_applications.application_id', 'left');
	 	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
	 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
	 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
	 	$this->db->order_by('employee_offer_letter.id', 'DESC');
	 	$this->db->limit($limit, $offset);
	 	$query = $this->db->get();
	 	return $query->result();
	}
	// Count accepted offer letters.
	public function count_offer_letters(){
		return $this->db->where('status', 1)->from('employee_offer_letter')->count_all_results();
	}
	// Count rejected offer letters.
	public function count_rejected_letters(){
		return $this->db->where('status', 2)->from('employee_offer_letter')->count_all_results();
	}
	// count pending offer letters.
	public function count_pending_letters(){
		return $this->db->where('status', 0)->from('employee_offer_letter')->count_all_results();
	}
	// Pending offer letters.
	public function pending_offer_letters($limit, $offset){
		$this->db->select('employee_offer_letter.id, 
				 					employee_offer_letter.user_id,
				 					employee_offer_letter.status,
				 					employee_offer_letter.attachment,
				 					employee_offer_letter.sdt,
				 					xin_companies.company_id,
				 					xin_companies.name,
				 					xin_designations.designation_id,
				 					xin_designations.designation_name,
				 					xin_job_applications.application_id,
				 					xin_job_applications.job_id,
				 					xin_job_applications.fullname,
				 					xin_jobs.job_id,
				 					xin_jobs.company,
				 					xin_jobs.designation_id');
		$this->db->from('employee_offer_letter');
		$this->db->join('xin_job_applications', 'employee_offer_letter.user_id = xin_job_applications.application_id', 'left');
	 	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
	 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
	 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
	 	$this->db->where('employee_offer_letter.status', 0);
	 	$this->db->order_by('employee_offer_letter.id', 'DESC');
	 	$this->db->limit($limit, $offset);
	 	$query = $this->db->get();
	 	return $query->result();
	}
	// Rejected offer letters.
	public function rejected_offer_letters($limit, $offset){
		$this->db->select('employee_offer_letter.id, 
				 					employee_offer_letter.user_id,
				 					employee_offer_letter.status,
				 					employee_offer_letter.attachment,
				 					employee_offer_letter.sdt,
				 					xin_companies.company_id,
				 					xin_companies.name,
				 					xin_designations.designation_id,
				 					xin_designations.designation_name,
				 					xin_job_applications.application_id,
				 					xin_job_applications.job_id,
				 					xin_job_applications.fullname,
				 					xin_jobs.job_id,
				 					xin_jobs.company,
				 					xin_jobs.designation_id');
		$this->db->from('employee_offer_letter');
		$this->db->join('xin_job_applications', 'employee_offer_letter.user_id = xin_job_applications.application_id', 'left');
	 	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
	 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
	 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
	 	$this->db->where('employee_offer_letter.status', 3);
	 	$this->db->order_by('employee_offer_letter.id', 'DESC');
	 	$this->db->limit($limit, $offset);
	 	$query = $this->db->get();
	 	return $query->result();
	}
	// Get offer letter formats.
	public function get_offer_letters(){
		return $this->db->from('offer_letter_formats')->get()->result();
	}
	// Check if the offer letter exists.
	public function offer_letter_exists(){
		$this->db->select('id, user_id, attachment, sdt');
		$this->db->from('employee_offer_letter');
		$this->db->where('user_id', $this->uri->segment(3));
		return $this->db->get()->row_array();
	}
	// Upload offer letter
	public function upload_offer_letter($user_id = '', $data = ''){
		$this->db->where('user_id', $user_id);
		$this->db->update('employee_offer_letter', $data);
		return true;
	}
	// Accept letter
	 public function accept_letter($user_id){
		 $this->db->where('user_id', $user_id);
		 $this->db->update('employee_offer_letter', array('status' => 1));
		 return true;
	 }
	 // Reject letter
	  public function reject_letter($user_id){
		 $this->db->where('user_id', $user_id);
		 $this->db->update('employee_offer_letter', array('status' => 3));
		 return true;
	 }
	 // Print offer letter.
	 public function offer_letter_print($user_id){
	 	$this->db->select('*');
	 	$this->db->from('employee_offer_letter');
	 	$this->db->where('user_id', $user_id);
	 	return $this->db->get()->row();
	 }
	 // ---------------------------------- Search in offer letters ----------------------------- //
	 // Search in accepted offer letters.
	 public function accepted_search($keyword){
	 	$this->db->select('employee_offer_letter.id, 
				 					employee_offer_letter.user_id,
				 					employee_offer_letter.status,
				 					employee_offer_letter.attachment,
				 					employee_offer_letter.sdt,
				 					xin_companies.company_id,
				 					xin_companies.name,
				 					xin_designations.designation_id,
				 					xin_designations.designation_name,
				 					xin_job_applications.application_id,
				 					xin_job_applications.job_id,
				 					xin_job_applications.fullname,
				 					xin_jobs.job_id,
				 					xin_jobs.company,
				 					xin_jobs.designation_id');
	 	$this->db->from('employee_offer_letter');
	 	$this->db->join('xin_job_applications', 'employee_offer_letter.user_id = xin_job_applications.application_id', 'left');
	 	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
	 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
	 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
	 	$this->db->like('xin_job_applications.fullname', $keyword);
	 	$this->db->where('employee_offer_letter.status', 1);
	 	$this->db->or_like('xin_companies.name', $keyword);
	 	$this->db->where('employee_offer_letter.status', 1);
	 	$this->db->or_like('xin_designations.designation_name', $keyword);
	 	$this->db->where('employee_offer_letter.status', 1);
	 	$this->db->order_by('employee_offer_letter.id', 'DESC');
	 	$query = $this->db->get();
	 	return $query->result();
	 }
	 // Search in pending offer letters.
	 public function pending_search($keyword){
	 	$this->db->select('employee_offer_letter.id, 
				 					employee_offer_letter.user_id,
				 					employee_offer_letter.status,
				 					employee_offer_letter.attachment,
				 					employee_offer_letter.sdt,
				 					xin_companies.company_id,
				 					xin_companies.name,
				 					xin_designations.designation_id,
				 					xin_designations.designation_name,
				 					xin_job_applications.application_id,
				 					xin_job_applications.job_id,
				 					xin_job_applications.fullname,
				 					xin_jobs.job_id,
				 					xin_jobs.company,
				 					xin_jobs.designation_id');
		$this->db->from('employee_offer_letter');
		$this->db->join('xin_job_applications', 'employee_offer_letter.user_id = xin_job_applications.application_id', 'left');
	 	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
	 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
	 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
	 	$this->db->where('employee_offer_letter.status', 0);
	 	$this->db->like('xin_job_applications.fullname', $keyword);
	 	$this->db->where('employee_offer_letter.status', 0);
	 	$this->db->or_like('xin_companies.name', $keyword);
	 	$this->db->where('employee_offer_letter.status', 0);
	 	$this->db->or_like('xin_designations.designation_name', $keyword);
	 	$this->db->where('employee_offer_letter.status', 0);
	 	$this->db->order_by('employee_offer_letter.id', 'DESC');
	 	$query = $this->db->get();
	 	return $query->result();
	 }
	 // Search in rejected offer letters.
	 public function rejected_search($keyword){
	 	$this->db->select('employee_offer_letter.id, 
				 					employee_offer_letter.user_id,
				 					employee_offer_letter.status,
				 					employee_offer_letter.attachment,
				 					employee_offer_letter.sdt,
				 					xin_companies.company_id,
				 					xin_companies.name,
				 					xin_designations.designation_id,
				 					xin_designations.designation_name,
				 					xin_job_applications.application_id,
				 					xin_job_applications.job_id,
				 					xin_job_applications.fullname,
				 					xin_jobs.job_id,
				 					xin_jobs.company,
				 					xin_jobs.designation_id');
		$this->db->from('employee_offer_letter');
		$this->db->join('xin_job_applications', 'employee_offer_letter.user_id = xin_job_applications.application_id', 'left');
	 	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
	 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
	 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
	 	$this->db->where('employee_offer_letter.status', 3);
	 	$this->db->like('xin_job_applications.fullname', $keyword);
	 	$this->db->where('employee_offer_letter.status', 3);
	 	$this->db->or_like('xin_companies.name', $keyword);
	 	$this->db->where('employee_offer_letter.status', 3);
	 	$this->db->or_like('xin_designations.designation_name', $keyword);
	 	$this->db->where('employee_offer_letter.status', 3);
	 	$this->db->order_by('employee_offer_letter.id', 'DESC');
	 	$query = $this->db->get();
	 	return $query->result();
	 }
	 // Applicant data for offer letter.
	 public function applicant_data(){
	 	$this->db->select('xin_job_applications.application_id,
	 								xin_job_applications.job_id,
	 								xin_job_applications.fullname,
	 								xin_job_applications.gender,
	 								xin_job_applications.province,
	 								xin_job_applications.city_name,
	 								xin_job_applications.cnic,
	 								xin_job_applications.cnic_expiry_date,
	 								xin_job_applications.dob,
	 								xin_job_applications.created_at,
	 								xin_jobs.job_id,
	 								xin_jobs.job_title,
	 								xin_jobs.designation_id,
	 								xin_jobs.company,
	 								xin_designations.designation_id,
	 								xin_designations.designation_name,
	 								provinces.id,
	 								provinces.name,
	 								district.id,
	 								district.name as dist_name');
	 	$this->db->from('xin_job_applications');
	 	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
	 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
	 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
	 	$this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
	 	$this->db->join('district', 'xin_job_applications.city_name = district.id', 'left');
	 	$this->db->where('xin_job_applications.application_id', $this->uri->segment(3));
	 	$query = $this->db->get();
	 	// echo $this->db->last_query();
	 	return $query->row();
	 }
	 // All applicants' data for contracts generation.
	 public function applicants_data($ids){
	 	$this->db->select('xin_job_applications.application_id,
	 								xin_job_applications.job_id,
	 								xin_job_applications.fullname,
	 								xin_job_applications.gender,
	 								xin_job_applications.province,
	 								xin_job_applications.city_name,
	 								xin_job_applications.cnic,
	 								xin_job_applications.cnic_expiry_date,
	 								xin_job_applications.dob,
	 								xin_job_applications.created_at,
	 								xin_jobs.job_id,
	 								xin_jobs.job_title,
	 								xin_jobs.designation_id,
	 								xin_jobs.company,
	 								xin_designations.designation_id,
	 								xin_designations.designation_name,
	 								provinces.id,
	 								provinces.name,
	 								district.id,
	 								district.name as dist_name');
	 	$this->db->from('xin_job_applications');
	 	$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
	 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
	 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
	 	$this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
	 	$this->db->join('district', 'xin_job_applications.city_name = district.id', 'left');
	 	$this->db->where_in('xin_job_applications.application_id', $ids);
	 	$query = $this->db->get();
	 	// echo $this->db->last_query();
	 	return $query->result();
	 }
	 // --------------------- Contract template setup --------------------------//
	 // Get designations.
	 public function get_designations(){
	 	return $this->db->get('xin_designations')->result();
	 }
	 // Add new template.
	 public function add_template($data){
	 	$this->db->insert('xin_contract_type', $data);
	 	if($this->db->affected_rows() > 0){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 }
	 // Check for existing templates. View and edit the existing template.
	 public function template_exists($id){
	 	$this->db->select('xin_contract_type.contract_type_id,
	 								xin_contract_type.name,
	 								xin_contract_type.contract_format,
	 								xin_contract_type.designation,
	 								xin_designations.designation_id,
	 								xin_designations.designation_name');
	 	$this->db->from('xin_contract_type');
	 	$this->db->join('xin_designations', 'xin_contract_type.designation = xin_designations.designation_id', 'left');
	 	$this->db->where('xin_contract_type.contract_type_id', $id);
	 	return $this->db->get()->row_array();
	 }
	 // Count all templates to display pagination.
	 public function count_templates(){
	 	return $this->db->from('xin_contract_type')->count_all_results();
	 }
	 // Get templates
	 public function get_templates($limit, $offset){
	 	$this->db->select('xin_contract_type.*,
	 								xin_designations.designation_id,
	 								xin_designations.designation_name');
	 	$this->db->from('xin_contract_type');
	 	$this->db->join('xin_designations', 'xin_contract_type.designation = xin_designations.designation_id', 'left');
	 	$this->db->limit($limit, $offset);
	 	return $this->db->get()->result();
	 }
	 // Delete template.
	 public function delete_template($id){
	 	$this->db->where('contract_type_id', $id);
	 	$this->db->delete('xin_contract_type');
	 	return true;
	 }
	 // Update the template.
	 public function update_template($id, $data){
	 	$this->db->where('contract_type_id', $id);
	 	$this->db->update('xin_contract_type', $data);
	 	return true;
	 }
	 // Search templates.
	 public function search_templates($keyword){
	 	$this->db->select('xin_contract_type.*,
	 								xin_designations.designation_id,
	 								xin_designations.designation_name');
	 	$this->db->from('xin_contract_type');
	 	$this->db->join('xin_designations', 'xin_contract_type.designation = xin_designations.designation_id', 'left');
	 	$this->db->like('xin_contract_type.name', $keyword);
	 	$this->db->or_like('xin_designations.designation_name', $keyword);
	 	return $this->db->get()->result();
	 }
	 // ---------------------- Offer letter template setup ---------------------------------- //
	 // Save the template into the database.
	 public function add_offer_template($data){
	 	$this->db->insert('offer_letter_formats', $data);
	 	if($this->db->affected_rows() > 0){
	 		return true;
	 	}else{
	 		return false;
	 	}
	 }
	 // Count offer letter templates.
	 public function count_offer_templates(){
	 	return $this->db->from('offer_letter_formats')->count_all_results();
	 }
	 // Get the pre-saved templates from the database.
	 public function get_offer_templates($limit, $offset){
	 	$this->db->select('offer_letter_formats.*,
	 								xin_designations.designation_id,
	 								xin_designations.designation_name');
	 	$this->db->from('offer_letter_formats');
	 	$this->db->join('xin_designations', 'offer_letter_formats.designation = xin_designations.designation_id','left');
	 	$this->db->limit($limit, $offset);
	 	return $this->db->get()->result();
	 }
	 // Edit offer letter template.
	 public function edit_offer_template($id){
	 	$this->db->select('offer_letter_formats.id,
	 								offer_letter_formats.designation,
	 								offer_letter_formats.offer_letter_text,
	 								offer_letter_formats.offer_letter_type,
	 								xin_designations.designation_id,
	 								xin_designations.designation_name');
	 	$this->db->from('offer_letter_formats');
	 	$this->db->join('xin_designations', 'offer_letter_formats.designation = xin_designations.designation_id', 'left');
	 	$this->db->where('offer_letter_formats.id', $id);
	 	return $this->db->get()->row_array();
	 }
	 // Update offer letter template
	 public function update_offer_template($id, $data){
	 	$this->db->where('id', $id);
	 	$this->db->update('offer_letter_formats', $data);
	 	return true;
	 }
	 // Delete offer letter template.
	 public function delete_offer_template($id){
	 	$this->db->where('id', $id);
	 	$this->db->delete('offer_letter_formats');
	 	return true;
	 }
	 // Search offer letter templates.
	 public function search_offer_templates($keyword){
	 	$this->db->select('offer_letter_formats.*,
	 								xin_designations.designation_id,
	 								xin_designations.designation_name');
	 	$this->db->from('offer_letter_formats');
	 	$this->db->join('xin_designations', 'offer_letter_formats.designation = xin_designations.designation_id', 'left');
	 	$this->db->like('xin_designations.designation_name', $keyword);
	 	return $this->db->get()->result();
	 }

	// ------------------------------- Search queries ---------------------------------------- //
	 // Get projects.
	 public function get_projects(){
	 	return $this->db->get('xin_companies')->result();
	 }
	 // Get designations
	 public function get_provinces(){
	 	return $this->db->get('provinces')->result();
	 }
	// Search pending contracts.
	 public function search_pending_contracts($applicant_name, $project, $designation, $province, $date_from, $date_to){
	 	$this->db->select('employee_contract.*,
			 	 					xin_contract_type.contract_type_id,
			 	 					xin_contract_type.name as cont_type,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.job_id,
			 	 					xin_job_applications.fullname,
			 	 					xin_job_applications.province,
			 	 					xin_job_applications.city_name,
			 	 					xin_job_applications.gender,
			 	 					xin_job_applications.email,
			 	 					xin_job_applications.message,
			 	 					xin_job_applications.created_at,
			 	 					xin_jobs.job_id,
			 	 					xin_jobs.company,
			 	 					xin_jobs.designation_id,
			 	 					xin_companies.company_id,
			 	 					xin_companies.name as compName,
			 	 					xin_designations.designation_id,
			 	 					xin_designations.designation_name,
			 	 					provinces.id,
			 	 					provinces.name,
			 	 					city.id,
			 	 					city.name as city_name,
			 	 					domicile.id,
			 	 					domicile.name as dom_name');
	 	$this->db->from('employee_contract');
	 	$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		// $this->db->join('gender', 'xin_job_applications.gender = gender.gender_id', 'left');
		$this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->join('domicile', 'xin_job_applications.domicile = domicile.id', 'left');
		$this->db->where('xin_job_applications.fullname', $applicant_name);
		$this->db->where('employee_contract.status', 0);
		$this->db->or_where('xin_companies.name', $project);
		$this->db->where('employee_contract.status', 0);
		$this->db->or_where('xin_designations.designation_name', $designation);
		$this->db->where('employee_contract.status', 0);
		$this->db->or_where('provinces.name', $province);
		$this->db->where('employee_contract.status', 0);
		$this->db->or_where('employee_contract.sdt >=', $date_from);
		$this->db->where('employee_contract.sdt <=', $date_to);
		$this->db->where('employee_contract.status', 0);
	 	$query = $this->db->get();
	 	return $query->result();
	 }
	 // Search active contracts.
	 public function search_active_contracts($applicant_name, $project, $designation, $province, $date_from, $date_to){
	 	$this->db->select('employee_contract.*,
			 	 					xin_contract_type.contract_type_id,
			 	 					xin_contract_type.name as cont_type,
			 	 					xin_job_applications.application_id,
			 	 					xin_job_applications.job_id,
			 	 					xin_job_applications.fullname,
			 	 					xin_job_applications.province,
			 	 					xin_job_applications.city_name,
			 	 					xin_job_applications.gender,
			 	 					xin_job_applications.email,
			 	 					xin_job_applications.message,
			 	 					xin_job_applications.created_at,
			 	 					xin_jobs.job_id,
			 	 					xin_jobs.company,
			 	 					xin_jobs.designation_id,
			 	 					xin_companies.company_id,
			 	 					xin_companies.name as compName,
			 	 					xin_designations.designation_id,
			 	 					xin_designations.designation_name,
			 	 					provinces.id,
			 	 					provinces.name,
			 	 					city.id,
			 	 					city.name as city_name,
			 	 					domicile.id,
			 	 					domicile.name as dom_name');
	 	$this->db->from('employee_contract');
	 	$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		// $this->db->join('gender', 'xin_job_applications.gender = gender.gender_id', 'left');
		$this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
		$this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		$this->db->join('domicile', 'xin_job_applications.domicile = domicile.id', 'left');
		$this->db->where('xin_job_applications.fullname', $applicant_name);
		$this->db->where('employee_contract.status', 1);
		$this->db->or_where('xin_companies.name', $project);
		$this->db->where('employee_contract.status', 1);
		$this->db->or_where('xin_designations.designation_name', $designation);
		$this->db->where('employee_contract.status', 1);
		$this->db->or_where('provinces.name', $province);
		$this->db->where('employee_contract.status', 1);
		$this->db->or_where('employee_contract.sdt >=', $date_from);
		$this->db->where('employee_contract.sdt <=', $date_to);
		$this->db->where('employee_contract.status', 1);
	 	$query = $this->db->get();
	 	return $query->result();
	 }
	 // Search to be expired contracts.
	 public function search_expiring_contracts($applicant_name, $project, $designation, $province, $date_from, $date_to){
		$date1 = date('Y-m-d');
		$str2 = date('Y-m-d', strtotime('+15 days', strtotime($date1)));
		$this->db->select('employee_contract.id,
									employee_contract.user_id,
									employee_contract.from_date,
									employee_contract.to_date,
									employee_contract.contract_manager,
									employee_contract.contract_type,
									employee_contract.status,
									employee_contract.sdt,
									xin_contract_type.contract_type_id,
									xin_contract_type.name as contType,
                           xin_employees.employee_id,
                           xin_employees.first_name,
                           xin_employees.last_name,
                           xin_employees.email,
                           xin_employees.company_id,
                           xin_employees.designation_id,
                           xin_employees.department_id,
                           xin_employees.provience_id,
                           xin_employees.city_id,
                           xin_employees.user_role_id,
                           xin_companies.company_id,
                           xin_companies.name,
                           xin_designations.designation_id,
                           xin_designations.designation_name,
                           xin_departments.department_id,
                           provinces.id,
                           provinces.name as provName,
                           district.id,
                           district.name as distName');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
      $this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
      $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
      $this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
      $this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
      $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
      $this->db->join('district', 'xin_employees.city_id = district.id', 'left');
      $this->db->where('xin_employees.first_name', $applicant_name);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->or_where('xin_companies.name', $project);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->or_where('xin_designations.designation_name', $designation);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->or_where('provinces.name', $province);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->or_where('employee_contract.sdt >=', $date_from);
		$this->db->where('employee_contract.sdt <=', $date_to);
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->order_by('employee_contract.id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
}
?>