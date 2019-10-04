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

	 public function contract_information() {
	 	 $this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_employees.employee_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
	 	 					xin_employees.address,
                            xin_employees.provience_id,
                            xin_employees.department_id,
                            xin_employees.city_id,
                            xin_employees.user_role_id,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name,
	                        provinces.id,
	                        xin_departments.department_id');
		 $this->db->from('employee_contract');
		 $this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		 $this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
		 $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		 $this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
         $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
         $this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
         $this->db->order_by('employee_contract.user_id', 'DESC');
		 $this->db->limit(10);
	 	 $query = $this->db->get();
	 	 return $query->result();
	}
	// Contract information -- Manager.
	public function contract_information_manager($projid, $provid) {
	 	 $this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_employees.employee_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
	 	 					xin_employees.address,
                            xin_employees.provience_id,
                            xin_employees.department_id,
                            xin_employees.city_id,
                            xin_employees.user_role_id,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name,
	                        provinces.id,
	                        xin_departments.department_id');
		 $this->db->from('employee_contract');
		 $this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		 $this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
		 $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		 $this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
         $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
         $this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
         $this->db->where(array('xin_companies.company_id' => $projid, 'provinces.id' => $provid));
		 $this->db->limit(10);
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
		// $this->db->where("DATEDIFF(NOW(), $str2) BETWEEN 21 AND 1");
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}
	// Get expired contracts by date --- Manager.
		public function get_by_date_manager($projid, $provid){
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
        $this->db->where(array('xin_companies.company_id' => $projid, 'provinces.id' => $provid));
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
	 	 					xin_employees.employee_id,
	 	 					xin_employees.user_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
	 	 					xin_employees.address,
                            xin_employees.provience_id,
                            xin_employees.department_id,
                            xin_employees.user_role_id,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name,
                            provinces.id,
                            xin_departments.department_id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
        $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
        $this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
		$this->db->where(array('employee_contract.status' => 1));
		// $this->db->or_where(array('employee_contract.status' => 2));
		// $this->db->or_where(array('employee_contract.status' => 3));
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        return $query->result();
	}
	// All Active contracts -- Manager.
	public function all_active_contracts_manager($projid, $provid, $limit, $offset){
		$this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_employees.employee_id,
	 	 					xin_employees.user_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
	 	 					xin_employees.address,
                            xin_employees.provience_id,
                            xin_employees.department_id,
                            xin_employees.user_role_id,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name,
                            provinces.id,
                            xin_departments.department_id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
        $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
        $this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
		$this->db->where('employee_contract.status', 1);
		$this->db->where(array('xin_companies.company_id' => $projid, 'provinces.id' => $provid));
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
	 	 					xin_job_applications.fullname,
	 	 					xin_job_applications.province,
	 	 					xin_job_applications.city_name,
	 	 					xin_job_applications.gender,
	 	 					xin_job_applications.email,
	 	 					xin_job_applications.message,
	 	 					xin_job_applications.created_at,
	 	 					gender.gender_id,
	 	 					gender.gender_name,
	 	 					provinces.id,
	 	 					provinces.name,
	 	 					city.id,
	 	 					city.name as city_name,
	 	 					domicile.id,
	 	 					domicile.name as dom_name');
		 $this->db->from('employee_contract');
		 $this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		 $this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		 $this->db->join('gender', 'xin_job_applications.gender = gender.gender_id', 'left');
		 $this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
		 $this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		 $this->db->join('domicile', 'xin_job_applications.domicile = domicile.id', 'left');
		 $this->db->where('employee_contract.status', 0);
		 $this->db->limit($limit, $offset);
	 	 $query = $this->db->get();
	 	 return $query->result();
	}
	// Pending contracts -- Manager.
	public function get_pending_contracts_manager($projid, $provid, $limit, $offset){
		$this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_job_applications.application_id,
	 	 					xin_job_applications.fullname,
	 	 					xin_job_applications.province,
	 	 					xin_job_applications.city_name,
	 	 					xin_job_applications.gender,
	 	 					xin_job_applications.email,
	 	 					xin_job_applications.message,
	 	 					xin_job_applications.created_at,
	 	 					gender.gender_id,
	 	 					gender.gender_name,
	 	 					provinces.id,
	 	 					provinces.name,
	 	 					city.id,
	 	 					city.name as city_name,
	 	 					domicile.id,
	 	 					domicile.name as dom_name');
		 $this->db->from('employee_contract');
		 $this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		 $this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		 $this->db->join('gender', 'xin_job_applications.gender = gender.gender_id', 'left');
		 $this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
		 $this->db->join('city', 'xin_job_applications.city_name = city.id', 'left');
		 $this->db->join('domicile', 'xin_job_applications.domicile = domicile.id', 'left');
		 $this->db->where('employee_contract.status', 0);
		 $this->db->where(array('xin_companies.company_id' => $projid, 'provinces.id' => $provid));
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
							xin_contract_type.name,
                            xin_employees.employee_id,
                            xin_employees.company_id,
                            xin_employees.designation_id,
                            xin_employees.department_id,
                            xin_employees.provience_id,
                            xin_employees.city_id,
                            xin_employees.user_role_id,
                            xin_companies.company_id,
                            xin_designations.designation_id,
                            xin_departments.department_id,
                            provinces.id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
        $this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
        $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
        $this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
        $this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
        $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	// All expired contracts -- Manager.
	public function all_expired_contracts_manager($projid, $provid, $limit, $offset){
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
		                    xin_employees.company_id,
		                    xin_employees.designation_id,
		                    xin_employees.department_id,
		                    xin_employees.provience_id,
		                    xin_employees.city_id,
		                    xin_employees.user_role_id,
		                    xin_companies.company_id,
		                    xin_designations.designation_id,
		                    xin_departments.department_id,
		                    provinces.id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
     	$this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
     	$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
     	$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
     	$this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
     	$this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
		$this->db->where('employee_contract.to_date <=', $str2);
		$this->db->where('employee_contract.status !=', 0);
		$this->db->where(array('xin_companies.company_id' => $projid, 'provinces.id' => $provid));
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	// Count rejected/finished contracts
	public function count_rejected(){
		return $this->db->where('status', 5 OR 'status', 6)->from('employee_contract')->count_all_results();
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
				                    xin_employees.employee_id,
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
				                    xin_job_applications.application_id,
				                    xin_job_applications.fullname');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
     	$this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
     	$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
     	$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
     	$this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
     	$this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
     	$this->db->join('xin_job_applications', 'employee_contract.user_id = xin_job_applications.application_id', 'left');
		$this->db->where('employee_contract.status', 5);
		$this->db->or_where('employee_contract.status', 6);
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	// Reject / finished contracts -- Manger
	public function rejected_contracts_manager($projid, $provid, $limit, $offset){
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
				                    xin_employees.employee_id,
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
				                    provinces.name as provName');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
     	$this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
     	$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
     	$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
     	$this->db->join('xin_departments', 'xin_employees.department_id = xin_departments.department_id', 'left');
     	$this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
		$this->db->where('employee_contract.status', 5);
		$this->db->or_where('employee_contract.status', 6);
		$this->db->where(array('xin_companies.company_id' => $projid, 'provinces.id' => $provid));
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	// Get printed contracts.
	public function printed_contracts($status = ''){
		$this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_employees.employee_id,
	 	 					xin_employees.user_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
                        	xin_employees.department_id,
                        	xin_employees.provience_id,
                        	xin_employees.city_id,
                        	xin_employees.user_role_id,
	 	 					xin_employees.address,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name,
	                    	xin_departments.department_id,
	                    	provinces.id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
        $this->db->join('xin_departments', 'xin_employees.employee_id = xin_departments.department_id', 'left');
        $this->db->join('provinces', 'xin_employees.provience_id = provinces.id', 'left');
		$this->db->where('employee_contract.status', $status);
		// $this->db->limit(10);
		return $this->db->get()->result();
	}
	// Printed contracts -- Manager.
	public function printed_contracts_manager($projid, $provid, $status = ''){
		$this->db->select('employee_contract.*,
	 	 					xin_contract_type.contract_type_id,
	 	 					xin_contract_type.name as cont_type,
	 	 					xin_employees.employee_id,
	 	 					xin_employees.user_id,
	 	 					xin_employees.first_name,
	 	 					xin_employees.last_name,
	 	 					xin_employees.company_id as compID,
	 	 					xin_employees.designation_id as desigID,
                            xin_employees.department_id,
                            xin_employees.provience_id,
                            xin_employees.city_id,
                            xin_employees.user_role_id,
	 	 					xin_employees.address,
	 	 					xin_companies.company_id,
	 	 					xin_companies.name,
	 	 					xin_designations.designation_id,
	 	 					xin_designations.designation_name,
                            xin_departments.department_id,
                            provinces.id');
		$this->db->from('employee_contract');
		$this->db->join('xin_contract_type', 'employee_contract.contract_type = xin_contract_type.contract_type_id', 'left');
		$this->db->join('xin_employees', 'employee_contract.user_id = xin_employees.employee_id', 'left');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
        $this->db->join('xin_departments', 'xin_employees.employee_id = xin_departments.department_id', 'left');
        $this->db->join('provinces', 'xin_employees.provience_id = provinces.id');
		$this->db->where('employee_contract.status', $status);
		$this->db->where(array('xin_companies.company_id' => $projid, 'provinces.id' => $provid));
		// $this->db->limit(10);
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
public function offer_letters(){
     $this->db->select('employee_offer_letter.id, 
 					employee_offer_letter.user_id,
 					employee_offer_letter.status,
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
 	$query = $this->db->get();
 	return $query->result();
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
 $this->db->update('employee_offer_letter', array('status' => 2));
 return true;
 }
}

?>