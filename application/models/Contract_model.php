<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Contract_model extends CI_Model {

 

    public function __construct()

    {

        parent::__construct();

        $this->load->database();

    }

 	



	 public function contract_information() {
	 	 $this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_employees.user_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
	 	 					xin_employees.address,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name');
		 $this->db->from('employee_contract');
		 $this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id');
		 $this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.user_id');
		 $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id');
		 $this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id');
		 $this->db->limit(10);
	 	 $query = $this->db->get();  
        // return $query; 
	 	 return $query->result();
	}
	// Get records near to expiry, expired contracts.
	public function get_by_date(){
		$date1 = date('Y-m-d');
		$str2 = date('Y-m-d', strtotime('+5 days', strtotime($date1)));
		$this->db->select('employee_contract.id,
							employee_contract.user_id,
							employee_contract.from_date,
							employee_contract.to_date,
							employee_contract.contract_manager,
							employee_contract.contract_type,
							employee_contract.status,
							employee_contract.sdt,
							xin_contract_type.contract_type_id,
							xin_contract_type.name');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id');
		$this->db->where('employee_contract.to_date >=', $str2);
		// $this->db->where("DATEDIFF(NOW(), $str2) BETWEEN 21 AND 1");
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
	// Count active contracts
	public function count_active(){
		return $this->db->where('status', 1)->from('employee_contract')->count_all_results();
	}
	// Get all active contracts
	public function all_active_contracts($limit, $offset){
		$this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_employees.user_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
	 	 					xin_employees.address,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id');
		$this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.user_id');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id');
		$this->db->where('employee_contract.status', 1);
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Count pending contracts
	public function count_contracts(){
		return $this->db->where('status', 0)->from('employee_contract')->count_all_results();
	}
	public function get_pending_contracts(){
		$this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_employees.user_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
	 	 					xin_employees.address,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name');
		 $this->db->from('employee_contract');
		 $this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id');
		 $this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.user_id');
		 $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id');
		 $this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id');
		 $this->db->where('employee_contract.status', 0);
		 $this->db->limit(10);
	 	 $query = $this->db->get();
	 	 return $query->result();
	}
	// Count all expired contracts
	public function count_expired(){
		return $this->db->from('employee_contract')->count_all_results();
	}
	// All contracts near expiry, all expired contracts.
	public function all_expired_contracts($limit, $offset){
		$date1 = date('Y-m-d');
		$str2 = date('Y-m-d', strtotime('+10 days', strtotime($date1)));
		$this->db->select('employee_contract.id,
							employee_contract.user_id,
							employee_contract.from_date,
							employee_contract.to_date,
							employee_contract.contract_manager,
							employee_contract.contract_type,
							employee_contract.status,
							employee_contract.sdt,
							xin_contract_type.contract_type_id,
							xin_contract_type.name');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id');
		$this->db->where('employee_contract.to_date >=', $str2);
		// $this->db->where("DATEDIFF(NOW(), $str2) BETWEEN 21 AND 1");
		// $this->db->where('employee_contract.status', 1);
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}


function applicantdetails($id){
  
 		$condition = " application_id =" . $id . " ";
        $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 
        $this->db->from('xin_job_applications');
        $this->db->where($condition);
        $this->db->order_by('application_id', 'DESC');
        $this->db->limit(1);
		$query = $this->db->get(); //echo $this->db->last_query();
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
 			$this->db->where('user_id', $user_id);
 			$this->db->update('employee_contract', $data);
 		}
 		// Get contract for extension.
 		public function get_for_extension(){
 			$this->db->select('id, user_id, long_description, from_date, to_date');
 			$this->db->from('employee_contract');
 			$this->db->where('id', $this->uri->segment(3));
 			return $this->db->get()->row_array();
 		}


	public function addtoAcctiveContract($id) {
	    //extract($data);
	    $this->db->where('user_id', $id);
	    //echo $this->db->last_query(); exit();
	    $this->db->update('employee_contract', array('status' => '1')); // status for short list
	    return true;
	}
	// Contract extension
	public function contract_extension($id = '', $data = ''){
		$this->db->where('id', $id);
		$this->db->update('employee_contract', $data);
	}
	// Finish contract
	public function finish_contract($id = '', $data = ''){
		$this->db->where('id', $id);
		return $this->db->update('employee_contract', $data);
	}
	// Reject contract.
	public function reject_contract($id = '', $data = ''){
		$this->db->where('user_id', $id);
		return $this->db->update('employee_contract', $data);
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
    // View contract detail.
    // public function contract_view($user_id = ''){
    // 	$this->db->select('employee_contract.*,
    // 						employee_contract_files.file_id,
    // 						employee_contract_files.emp_id,
    // 						employee_contract_files.file_name');
    // 	$this->db->from('employee_contract');
    // 	$this->db->join('employee_contract_files', 'employee_contract.user_id = employee_contract_files.emp_id');
    // 	$this->db->where('employee_contract.user_id', $user_id);
    // 	// $this->db->group_by('employee_contract.user_id');
    // 	return $this->db->get()->result();
    // }
	// Printing contracts. Single contract printing.
	public function contract_print($user_id){
		$this->db->select('*');
		$this->db->from('employee_contract');
		$this->db->where('user_id', $user_id);
		return $this->db->get()->result();

	}
	// Printing contracts. Print multiple having status equals 0 (Pending...)
	public function print_bulk(){
		$this->db->select();
		$this->db->from('employee_contract');
		$this->db->where('status', 0);
		return $this->db->get()->result();
	}
	// Activate multiple contracts at once. (Bulk activate)
	public function activate_bulk(){
		return $this->db->where('status', 0)->update('employee_contract', array('status' => 1));
	}
	// Jobs list
	// public function jobs_list(){
	// 	$this->db->select('xin_jobs.job_id,
	// 						xin_jobs.company,
	// 						xin_jobs.job_title,
	// 						xin_jobs.designation_id,
	// 						xin_jobs.job_type,
	// 						xin_jobs.job_vacancy,
	// 						xin_jobs.created_at,
	// 						xin_jobs.date_of_closing,
	// 						xin_companies.company_id,
	// 						xin_companies.name as compName,
	// 						xin_job_type.job_type_id,
	// 						xin_job_type.type,
	// 						xin_designations.designation_id,
	// 						xin_designations.designation_name');
	// 	$this->db->from('xin_jobs');
	// 	$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id');
	// 	$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id');
	// 	$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id');
	// 	$this->db->limit(10);
	// 	return $this->db->get()->result();
	// }	


/*
 function contract_result_exists($table,$field,$value)
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

*/




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