<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

/* Filename: Trainings_model.php
*  Author: Saddam
*  Filepath: application / models / Trainings_model.php
*/
class Trainings_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	// Count all records in the trainigs table to create pagination.
	public function count_trainings(){
		return $this->db->where('trg_type', 1)->from('xin_trainings')->count_all_results();
	}
	// Get data from database and list them on the dashboard (Induction trainings only)
	public function get_trainings($limit = '', $offset = ''){
		//SUM(LENGTH(trainee_employees) - LENGTH(REPLACE(trainee_employees, ",", ""))+1) as no_of_employees,
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							provinces.id,
							provinces.name as prov_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->where(array('xin_trainings.trg_type' => 1 , 'xin_trainings.status' => 1));
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	// Get trainings -- Manager.
	public function get_trainings_manager($provid, $limit = '', $offset = ''){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							provinces.id,
							provinces.name as prov_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->where(array('xin_trainings.trg_type' => 1, 'xin_trainings.status' => 1));
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// All trainings, both Induction and Refreshers.
	public function get_all_trainings($limit = '', $offset = ''){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							provinces.id,
							provinces.name as prov_name,
							training_attendance.training_id');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('training_attendance', 'xin_trainings.trg_id = training_attendance.training_id', 'left');
		$this->db->group_by('xin_trainings.trg_id');
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Get all trainings -- Manager.
	public function get_all_trainings_manager($provid, $limit = '', $offset = ''){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							provinces.id,
							provinces.name as prov_name,
							training_attendance.training_id');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('training_attendance', 'xin_trainings.trg_id = training_attendance.training_id', 'left');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->group_by('xin_trainings.trg_id');
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Retrieve by status.
	public function get_by_status($status = ''){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							provinces.id,
							provinces.name as prov_name,
							training_attendance.training_id');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('training_attendance', 'xin_trainings.trg_id = training_attendance.training_id', 'left');
		$this->db->where('xin_trainings.status', $status);
		$this->db->group_by('xin_trainings.trg_id');
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		return $this->db->get()->result();
	}
	// Get trainings to display on the dashboard (Refresher trainings only)
	public function refresher_training(){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.location = xin_training_locations.location_id', 'left');
		$this->db->where(array('xin_trainings.trg_type' => 2, 'xin_trainings.status' => 2));
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	// Refresher trainings -- Manager.
	public function refresher_training_manager($provid){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.location = xin_training_locations.location_id', 'left');
		$this->db->where(array('xin_trainings.trg_type' => 2, 'xin_trainings.status' => 2));
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$this->db->where(array('xin_trainings.location' => $provid));
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	// Count refresher trainings
	public function count_refresher(){
		$this->db->where('trg_type', 2);
		return $this->db->count_all_results('xin_trainings');
	}
	// All refresher trainings.
	public function all_refresher_trainings($limit = '', $offset = ''){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							xin_training_types.training_type_id,
							xin_training_types.type,
							provinces.id,
							provinces.name as prov_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.location = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->where(array('xin_trainings.trg_type' => 2));
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// All refresher trainings -- Manager.
	public function all_refresher_trainings_manager($provid, $limit = '', $offset = ''){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							xin_training_types.training_type_id,
							xin_training_types.type,
							provinces.id,
							provinces.name as prov_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.location = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->where(array('xin_trainings.trg_type' => 2));
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$this->db->where(array('xin_trainings.location' => $provid));
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Search in refresher trainings...
	public function search_refresher($training){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							xin_training_types.training_type_id,
							xin_training_types.type,
							provinces.id,
							provinces.name as prov_name,
							district.id as city_id,
							district.name as city_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('district', 'xin_trainings.district = district.id', 'left');
		$this->db->where('xin_trainings.trg_type', 2);
		$this->db->like('xin_training_types.type', $training);
		$this->db->or_like('provinces.name', $training);
		$this->db->where('xin_trainings.trg_type', 2);
		$this->db->or_like('district.name', $training);
		$this->db->where('xin_trainings.trg_type', 2);
		$this->db->or_like('xin_training_locations.location', $training);
		$this->db->where('xin_trainings.trg_type', 2);
		$this->db->or_like('xin_trainers.first_name', $training);
		$this->db->where('xin_trainings.trg_type', 2);
		$this->db->or_like('xin_trainings.target_group', $training);
		$this->db->where('xin_trainings.trg_type', 2);
		$this->db->or_like('xin_trainings.facilitator_name', $training);
		$this->db->where('xin_trainings.trg_type', 2);
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		return $this->db->get()->result();
	}
	// Search completed trainigs.
	public function search_completed($training){
		$this->db->select('COUNT(training_attendance.emp_id) as attendees,
							training_attendance.attendance_id,
							training_attendance.status,
							training_attendance.training_id,
							training_attendance.project_id,
							training_attendance.attendance_date,
							xin_trainings.trg_id,
							xin_trainings.trg_type,
							xin_trainings.trainer_one,
							xin_trainings.start_date,
							xin_trainings.end_date,
							xin_trainings.session,
							xin_trainings.target_group,
							xin_trainings.location,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_locations.location_id,
							xin_training_locations.province,
							xin_training_locations.city,
							xin_training_locations.location,
							provinces.id,
							provinces.name,
							district.id as city_id,
							district.name as city_name,
							xin_employees.employee_id');
		$this->db->from('training_attendance');
		$this->db->join('xin_trainings', 'training_attendance.training_id = xin_trainings.trg_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id AND xin_trainers.trainer_id = xin_trainings.trainer_two');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id');
		$this->db->join('district', 'xin_trainings.district = district.id', 'left');
		$this->db->join('xin_employees', 'training_attendance.emp_id = xin_employees.employee_id');
		$this->db->where('xin_trainings.project = training_attendance.project_id');
		$this->db->group_by('training_attendance.training_id');
		$this->db->where('xin_trainings.trg_id = training_attendance.training_id');
		$this->db->like('xin_training_types.type', $training);
		$this->db->or_like('provinces.name', $training);
		$this->db->or_like('district.name', $training);
		$this->db->or_like('xin_training_locations.location', $training);
		$this->db->or_like('xin_trainers.first_name', $training);
		$this->db->or_like('xin_trainings.target_group', $training);
		$this->db->group_by('training_attendance.training_id');
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		return $this->db->get()->result();
		
	}
	// Search trainigs.
	public function search_trainings($training){
		$this->db->select('xin_trainings.trg_id,
							xin_trainings.start_date,
							xin_trainings.end_date,
							xin_trainings.trg_type,
							xin_trainings.trainer_one,
							xin_trainings.facilitator_name,
							xin_trainings.hall_detail,
							xin_trainings.session,
							xin_trainings.approval_type,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_locations.location_id,
							xin_training_locations.location,
							provinces.id,
							provinces.name as prov_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->like('xin_trainings.facilitator_name', $training);
		$this->db->or_like('xin_trainings.approval_type', $training);
		$this->db->or_like('xin_trainers.first_name', $training);
		$this->db->or_like('xin_training_types.type', $training);
		$this->db->or_like('xin_training_locations.location', $training);
		$this->db->or_like('provinces.name', $training);
		$this->db->or_like('xin_trainings.session', $training);
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		return $this->db->get()->result();
	}
	// Search trainings -- Manager.
	public function search_trainings_manager($provid, $training){
		$this->db->select('xin_trainings.trg_id,
							xin_trainings.start_date,
							xin_trainings.end_date,
							xin_trainings.trg_type,
							xin_trainings.trainer_one,
							xin_trainings.facilitator_name,
							xin_trainings.hall_detail,
							xin_trainings.session,
							xin_trainings.approval_type,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_locations.location_id,
							xin_training_locations.location,
							provinces.id,
							provinces.name as prov_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->like('xin_trainings.facilitator_name', $training);
		$this->db->or_like('xin_trainings.approval_type', $training);
		$this->db->or_like('xin_trainers.first_name', $training);
		$this->db->or_like('xin_training_types.type', $training);
		$this->db->or_like('xin_training_locations.location', $training);
		$this->db->or_like('provinces.name', $training);
		$this->db->or_like('xin_trainings.session', $training);
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		return $this->db->get()->result();
	}
	// Training detail, view single training by training ID.
	public function training_detail($trg_id){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_trainers.email,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							xin_companies.company_id,
							xin_companies.name,
							provinces.id,
							provinces.name as provName,
							district.id,
							district.name as cityName,
							tehsil.id,
							tehsil.name as teh_name,
							union_councel.id,
							union_councel.name as uc_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('xin_companies', 'xin_trainings.project = xin_companies.company_id', 'left');
		// xin_designations.designation_id, xin_designations.designation_name, -- Removed these two.
		// $this->db->join('xin_designations', 'xin_companies.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('district', 'xin_trainings.district = district.id', 'left');
		$this->db->join('tehsil', 'xin_trainings.tehsil = tehsil.id', 'left');
		$this->db->join('union_councel', 'xin_trainings.uc = union_councel.id', 'left');
		$this->db->where('xin_trainings.trg_id', $trg_id);
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$result = $this->db->get();
		return $result->row_array();
	}
	// Training detail -- Manager.
	public function training_detail_manager($provid, $trg_id){
		$this->db->select('xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_trainers.email,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name,
							provinces.id,
							provinces.name as provName,
							district.id,
							district.name as cityName,
							tehsil.id,
							tehsil.name as teh_name,
							union_councel.id,
							union_councel.name as uc_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('xin_companies', 'xin_trainings.project = xin_companies.company_id', 'left');
		// $this->db->join('xin_designations', 'xin_companies.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('district', 'xin_trainings.district = district.id', 'left');
		$this->db->join('tehsil', 'xin_trainings.tehsil = tehsil.id', 'left');
		$this->db->join('union_councel', 'xin_trainings.uc = union_councel.id', 'left');
		$this->db->where('xin_trainings.trg_id', $trg_id);
		$this->db->where(array('provinces.id' => $provid));
		$this->db->order_by('xin_trainings.trg_id', 'DESC');
		$result = $this->db->get();
		return $result->row_array();
	}
	// Create new trainings, insert data into database.
	public function create_training($data){
		$this->db->insert('xin_trainings', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Edit trainings.
	public function edit_training($tr_id){
		$this->db->where('trg_id', $training_id);
		$edit = $this->db->get('xin_trainings');
		return $edit->row_array();
	}
	// Update trainings.
	public function update_training($trg_id, $data){
		$this->db->where('trg_id', $trg_id);
		$this->db->update('xin_trainings', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Delete trainings.
	public function delete_trainig($trg_id){
		$this->db->where('trg_id', $trg_id);
		$this->db->delete('xin_trainings');
		return true;
	}
	// Get training types to feed them in the dropdown list for creating new trainings.
	public function get_training_types(){
		$this->db->select('training_type_id, type, created_at, status');
		$this->db->from('xin_training_types');
		return $this->db->get()->result();
	}
	// Count all trainers to create pagination.
	public function count_trainers(){
		return $this->db->count_all('xin_trainers');
	}
	// Get all trainers for listing.
	public function get_all_trainers($limit, $offset){
		$this->db->select('trainer_id, first_name, last_name, contact_number, email, designation_id, expertise, address, status, created_at');
		$this->db->from('xin_trainers');
		$this->db->order_by('trainer_id', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Get trainers to feed them into the dropdown list to assign to trainings.
	public function get_trainers(){
		$this->db->select('trainer_id, first_name, last_name, status, created_at');
		$this->db->from('xin_trainers');
		$this->db->order_by('trainer_id', 'DESC');
		$this->db->where('status', 1);
		return $this->db->get()->result();
	}
	// Add new trainer.
	public function add_trainer($data){
		$this->db->insert('xin_trainers', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Search trainers.
	public function search_trainers($trainer){
		$this->db->select('*');
		$this->db->from('xin_trainers');
		$this->db->like('first_name', $trainer);
		$this->db->or_like('contact_number', $trainer);
		$this->db->or_like('email', $trainer);
		$this->db->or_like('expertise', $trainer);
		$this->db->or_like('address', $trainer);
		return $this->db->get()->result();
	}
	// Search for specific hotels in the list displayed.
	public function search_hotels($hotel){
		$this->db->select('xin_training_hotels.hotel_id,
							xin_training_hotels.province,
							xin_training_hotels.city,
							xin_training_hotels.hotel_name,
							provinces.id as provId,
							provinces.name,
							district.id as cityId,
							district.name as city_name');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id', 'left');
		$this->db->join('district', 'xin_training_hotels.city = district.id', 'left');
		$this->db->like('xin_training_hotels.hotel_name', $hotel);
		$this->db->or_like('provinces.name', $hotel);
		$this->db->or_like('district.name', $hotel);
		$this->db->order_by('xin_training_hotels.hotel_id', 'DESC');
		return $this->db->get()->result();
	}
	// Search hotels -- Manager.
	public function search_hotels_manager($provid, $hotel){
		$this->db->select('xin_training_hotels.hotel_id,
							xin_training_hotels.province,
							xin_training_hotels.city,
							xin_training_hotels.hotel_name,
							provinces.id as provId,
							provinces.name,
							district.id as cityId,
							district.name as city_name');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id', 'left');
		$this->db->join('district', 'xin_training_hotels.city = district.id', 'left');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->like('xin_training_hotels.hotel_name', $hotel);
		$this->db->or_like('provinces.name', $hotel);
		$this->db->or_like('district.name', $hotel);
		$this->db->order_by('xin_training_hotels.hotel_id', 'DESC');
		return $this->db->get()->result();
	}
	// Trainer's detail.
	public function trainer_detail($trainer_id){
		$this->db->select('*');
		$this->db->from('xin_trainers');
		$this->db->where('trainer_id', $trainer_id);
		return $this->db->get()->row_array();
	}
	// Hotel's detail.
	public function hotel_detail($hotel_id){
		$this->db->select('xin_training_hotels.hotel_id,
							xin_training_hotels.province,
							xin_training_hotels.city,
							xin_training_hotels.hotel_name,
							provinces.id,
							provinces.name,
							district.id,
							district.name as cityName');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id', 'left');
		$this->db->join('district', 'xin_training_hotels.city = district.id', 'left');
		$this->db->where('hotel_id', $hotel_id);
		$this->db->order_by('xin_training_hotels.hotel_id', 'DESC');
		return $this->db->get()->row_array();
	}
	// Hotel detail -- Manager.
	public function hotel_detail_manager($provid, $hotel_id){
		$this->db->select('xin_training_hotels.hotel_id,
							xin_training_hotels.province,
							xin_training_hotels.city,
							xin_training_hotels.hotel_name,
							provinces.id,
							provinces.name,
							district.id,
							district.name as cityName');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id', 'left');
		$this->db->join('district', 'xin_training_hotels.city = district.id', 'left', 'left');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->where('hotel_id', $hotel_id);
		$this->db->order_by('xin_training_hotels.hotel_id', 'DESC');
		return $this->db->get()->row_array();
	}
	// Modify hotel.
	public function update_hotel($hotel_id, $data){
		$this->db->where('hotel_id', $hotel_id);
		$this->db->update('xin_training_hotels', $data);
	}
	// Delete hotel.
	public function delete_hotel($hotel_id){
		$this->db->where('hotel_id', $hotel_id);
		$this->db->delete('xin_training_hotels');
		return true;
	}
	// Get employees to feed them into the dropdown list to assign training to.
	public function get_employees(){
		$this->db->select('employee_id, first_name, last_name, user_id');
		$this->db->from('xin_employees');
		return $this->db->get()->result();
	}
	// Get designations to show them in the dropdown list, 	and count them
	public function get_designations(){
		$this->db->select('COUNT(if(xin_employees.status = "1", 1, NULL)) as applied,
		 					xin_designations.designation_id,
							xin_designations.designation_name,
							xin_employees.designation_id');
		$this->db->from('xin_employees');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
		$this->db->group_by('xin_employees.designation_id');
		return $this->db->get()->result();
	}
	// Get all projects to display in the dropdown list.
	public function get_projects(){
		$this->db->select('company_id, name');
		$this->db->from('xin_companies');
		return $this->db->get()->result();
	}
	// Change designation with changing project in the dropdown list.
	public function get_pro_designations($proj_id){
		$this->db->select('location_job_position.company_id,
							location_job_position.designation_id,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('location_job_position');
		$this->db->join('xin_designations', 'location_job_position.designation_id = xin_designations.designation_id', 'left');
		$this->db->group_by('location_job_position.designation_id');
		$this->db->where('company_id', $proj_id);
		return $this->db->get()->result();
	}
	// Get all locations to show them in the dropdown list.
	public function get_locations(){
		$this->db->select('id, name, slug');
		$this->db->from('provinces');
		return $this->db->get()->result();
	}
	// Get venues for training.
	public function get_venues(){
		$this->db->select('location_id, location');
		$this->db->from('xin_training_locations');
		return $this->db->get()->result();
	}
	// Get with changing value.
	public function provinces_data($id){
		$this->db->select('provinces.id,
							provinces.name,
							district.id as city_id,
							district.name as city_name');
		$this->db->from('provinces');
		$this->db->join('district', 'provinces.id = district.province_id', 'left');
		$this->db->where('provinces.id', $id);
		return $this->db->get()->result();
	}
	// Get districts data.
	public function districts_data($id){
		$this->db->select('district.id,
							district.name as c_name,
							tehsil.id,
							tehsil.name as teh_name');
		$this->db->from('district');
		$this->db->join('tehsil', 'tehsil.district_id = district.id', 'left');
		$this->db->where('district.id', $id);
		return $this->db->get()->result();
	}
	// Get Tehsils' data.
	public function tehsils_data($id){
		$this->db->select('tehsil.id,
							tehsil.name as tehName,
							union_councel.id,
							union_councel.name as uc_name');
		$this->db->from('tehsil');
		$this->db->join('union_councel', 'tehsil.id = union_councel.tehsil_id', 'left');
		$this->db->where('tehsil.id', $id);
		return $this->db->get()->result();
	}
	// count all training locations to create pagination.
	public function count_locations(){
		return $this->db->count_all('xin_training_locations');
	}
	// Get location information to show in HTML table.
	public function get_training_locations($limit = '', $offset = ''){
		$this->db->select('xin_training_locations.location_id,
							xin_training_locations.province,
							xin_training_locations.city,
							xin_training_locations.location,
							xin_training_locations.description,
							provinces.id,
							provinces.name,
							district.id as city_id,
							district.name as city_name');
		$this->db->from('xin_training_locations');
		$this->db->join('provinces', 'xin_training_locations.province = provinces.id', 'left');
		$this->db->join('district', 'xin_training_locations.city = district.id', 'left');
		$this->db->limit($limit, $offset);
		$this->db->order_by('xin_training_locations.location_id', 'DESC');
		return $this->db->get()->result();
	}
	// Get location info -- Manager.
	public function get_training_locations_manager($provid, $limit = '', $offset = ''){
		$this->db->select('xin_training_locations.location_id,
							xin_training_locations.province,
							xin_training_locations.city,
							xin_training_locations.location,
							xin_training_locations.description,
							provinces.id,
							provinces.name,
							district.id as city_id,
							district.name as city_name');
		$this->db->from('xin_training_locations');
		$this->db->join('provinces', 'xin_training_locations.province = provinces.id', 'left');
		$this->db->join('district', 'xin_training_locations.city = district.id', 'left');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->limit($limit, $offset);
		$this->db->order_by('xin_training_locations.location_id', 'DESC');
		return $this->db->get()->result();
	}
	// Add location information into the database.
	public function add_locations($data){
		$this->db->insert('xin_training_locations', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Get allowances to show them in HTML table.
	public function get_allowances(){
		$this->db->select('xin_training_allowances.allowance_id,
							xin_training_allowances.project,
							xin_training_allowances.designation,
							xin_training_allowances.behavior,
							xin_training_allowances.dsa,
							xin_training_allowances.travel,
							xin_training_allowances.stay_allowance,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('xin_training_allowances');
		$this->db->join('xin_companies', 'xin_training_allowances.project = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_training_allowances.designation = xin_designations.designation_id', 'left');
		$this->db->order_by('xin_training_allowances.allowance_id', 'DESC');
		return $this->db->get()->result();
	}
	// Add trainings' allowances.
	public function add_new_allowances($data){
		$this->db->insert('xin_training_allowances', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Add hotels in which the trainees and trainers can stay.
	public function create_stay_hotels($data){
		$this->db->insert('xin_training_hotels', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Count hotels to create pagination
	public function count_hotels(){
		return $this->db->count_all('xin_training_hotels');
	}
	// Get stay hotels recently added into the database.
	public function get_stay_hotels($limit ='', $offset =''){
		$this->db->select('xin_training_hotels.hotel_id,
							xin_training_hotels.province,
							xin_training_hotels.city,
							xin_training_hotels.hotel_name,
							provinces.id,
							provinces.name,
							district.id as city_id,
							district.name as city_name');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id', 'left');
		$this->db->join('district', 'xin_training_hotels.city = district.id', 'left');
		$this->db->limit($limit, $offset);
		$this->db->order_by('xin_training_hotels.hotel_id', 'DESC');
		return $this->db->get()->result();
	}
	// Get stay hotels -- Manager.
	public function get_stay_hotels_manager($provid, $limit ='', $offset =''){
		$this->db->select('xin_training_hotels.hotel_id,
							xin_training_hotels.province,
							xin_training_hotels.city,
							xin_training_hotels.hotel_name,
							provinces.id,
							provinces.name,
							district.id as city_id,
							district.name as city_name');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id', 'left');
		$this->db->join('district', 'xin_training_hotels.city = district.id', 'left');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->limit($limit, $offset);
		$this->db->order_by('xin_training_hotels.hotel_id', 'DESC');
		return $this->db->get()->result();
	}
	// Get room types to show them in the dropdown list.
	public function get_room_types(){
		$this->db->select('price_id, room_type, charges, hotel_id');
		$this->db->from('xin_training_prices');
		$this->db->order_by('price_id', 'DESC');
		return $this->db->get()->result();
	}
	// Add amenities to hotels.
	public function hotel_amenities($data){
		$this->db->insert('xin_training_amenities', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Add prices to hotels.
	public function add_prices($data){
		$this->db->insert('xin_training_prices', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Get all prices list.
	public function get_prices($hotel_id){
		return $this->db->query("SELECT * FROM `xin_training_hotels` AS xth JOIN `xin_training_prices` AS xtp ON xth.hotel_id = xtp.hotel_id JOIN `xin_training_amenities` AS xta ON xta.room_type_id = xtp.price_id WHERE xth.hotel_id = $hotel_id GROUP BY xtp.price_id")->result();
	}
	// Get employees for training.
	public function get_employees_for_training($comp_id){
		$this->db->select('xin_employees.user_id,
							xin_employees.employee_id,
							xin_employees.first_name,
							xin_employees.email,
							xin_employees.company_id,
							xin_employees.designation_id,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_name,
							xin_designations.designation_name');
		$this->db->from('xin_employees');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
		$this->db->where(array('xin_companies.company_id' => $comp_id));
		$query = $this->db->get();
		return $query->result();
	}
	// Get trainee employees for attendance sheet with the training they're registered in.
	public function get_trainees($trg_id){
		return $this->db->query("SELECT xin_trainings.trainee_employees, trg_id, project FROM xin_trainings WHERE trg_id = $trg_id")->row();
	}
	// Get trainings to show them in the dropdown list.
	public function get_trainings_list(){
		$this->db->select('xin_trainings.trg_id,
							xin_trainings.trg_type,
							xin_training_types.training_type_id,
							xin_training_types.type');
		$this->db->from('xin_trainings');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		return $this->db->get()->result();
	}
	// Save employees' attendance to the database now.
	public function store_attendance($data){
		$this->db->insert('training_attendance', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Count completed trainings
	public function count_completed(){
		$this->db->select('*');
		$this->db->from('training_attendance');
		$this->db->group_by('training_id');
		return $this->db->count_all_results();
	}
	// List the completed trainings.
	public function trainings_completed($limit, $offset){
		$this->db->select('COUNT(training_attendance.emp_id) as attendees,
							training_attendance.attendance_id,
							training_attendance.status,
							training_attendance.training_id,
							training_attendance.project_id,
							training_attendance.attendance_date,
							xin_trainings.trg_id,
							xin_trainings.trg_type,
							xin_trainings.trainer_one,
							xin_trainings.start_date,
							xin_trainings.end_date,
							xin_trainings.session,
							xin_trainings.target_group,
							xin_trainings.location,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_locations.location_id,
							xin_training_locations.province,
							xin_training_locations.city,
							xin_training_locations.location,
							provinces.id,
							provinces.name,
							district.id as city_id,
							district.name as city_name,
							xin_employees.employee_id');
		$this->db->from('training_attendance');
		$this->db->join('xin_trainings', 'training_attendance.training_id = xin_trainings.trg_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id AND xin_trainers.trainer_id = xin_trainings.trainer_two', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('district', 'xin_trainings.district = district.id', 'left');
		$this->db->join('xin_employees', 'training_attendance.emp_id = xin_employees.employee_id', 'left');
		$this->db->where('xin_trainings.project = training_attendance.project_id');
		$this->db->group_by('training_attendance.training_id');
		// $this->db->group_by('training_attendance.attendance_date');
		$this->db->where('xin_trainings.trg_id = training_attendance.training_id');
		$this->db->order_by('training_attendance.attendance_date', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Get completed trainings -- Manager.
	public function trainings_completed_manager($provid, $limit, $offset){
		$this->db->select('COUNT(training_attendance.emp_id) as attendees,
							training_attendance.attendance_id,
							training_attendance.status,
							training_attendance.training_id,
							training_attendance.project_id,
							training_attendance.attendance_date,
							xin_trainings.trg_id,
							xin_trainings.trg_type,
							xin_trainings.trainer_one,
							xin_trainings.start_date,
							xin_trainings.end_date,
							xin_trainings.session,
							xin_trainings.target_group,
							xin_trainings.location,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_locations.location_id,
							xin_training_locations.province,
							xin_training_locations.city,
							xin_training_locations.location,
							provinces.id,
							provinces.name,
							district.id as city_id,
							district.name as city_name,
							xin_employees.employee_id');
		$this->db->from('training_attendance');
		$this->db->join('xin_trainings', 'training_attendance.training_id = xin_trainings.trg_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id AND xin_trainers.trainer_id = xin_trainings.trainer_two', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('district', 'xin_training_locations.city = district.id', 'left');
		$this->db->join('xin_employees', 'training_attendance.emp_id = xin_employees.employee_id', 'left');
		$this->db->where('xin_trainings.project = training_attendance.project_id');
		$this->db->group_by('training_attendance.training_id');
		// $this->db->group_by('training_attendance.attendance_date');
		$this->db->where('xin_trainings.trg_id = training_attendance.training_id');
		$this->db->where(array('xin_trainings.location' => $provid));
		$this->db->order_by('training_attendance.attendance_date', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Get training's expenses for each trainee
	public function training_expenses($trg_id=''){
		$this->db->select('xin_training_allowances.*,
							xin_employees.user_id,
							xin_employees.employee_id,
							xin_employees.first_name,
							xin_employees.company_id,
							xin_employees.designation_id,
							training_attendance.emp_id,
							training_attendance.project_id,
							training_attendance.status,
							xin_trainings.trg_id,
							xin_trainings.trg_type,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('xin_employees');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_training_allowances', 'xin_companies.company_id = xin_training_allowances.project', 'left');
		$this->db->join('training_attendance', 'xin_employees.employee_id = training_attendance.emp_id', 'left');
		$this->db->join('xin_trainings', 'training_attendance.training_id = xin_trainings.trg_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		// $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
		$this->db->group_by('training_attendance.emp_id');
		$this->db->where('xin_employees.employee_id = training_attendance.emp_id');
		// $this->db->where('xin_employees.company_id = training_attendance.project_id');
		$this->db->where('xin_trainings.trg_id', $trg_id);
		return $this->db->get()->result();
	}
	// Get training expenses -- Manager.
	public function training_expenses_manager($provid, $trg_id=''){
		$this->db->select('xin_training_allowances.*,
							xin_employees.user_id,
							xin_employees.employee_id,
							xin_employees.first_name,
							xin_employees.company_id,
							xin_employees.designation_id,
							xin_employees.provience_id
							training_attendance.emp_id,
							training_attendance.project_id,
							training_attendance.status,
							xin_trainings.trg_id,
							xin_trainings.trg_type,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('xin_employees');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_training_allowances', 'xin_companies.company_id = xin_training_allowances.project', 'left');
		$this->db->join('training_attendance', 'xin_employees.employee_id = training_attendance.emp_id', 'left');
		$this->db->join('xin_trainings', 'training_attendance.training_id = xin_trainings.trg_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		// $this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
		$this->db->group_by('training_attendance.emp_id');
		$this->db->where('xin_employees.employee_id = training_attendance.emp_id');
		$this->db->where(array('xin_employees.provience_id' => $provid));
		// $this->db->where('xin_employees.company_id = training_attendance.project_id');
		$this->db->where('xin_trainings.trg_id', $trg_id);
		return $this->db->get()->result();
	}
	// Get attendance report
	public function training_report(){
		$this->db->select('training_attendance.*,
							xin_trainings.trg_id,
							xin_employees.employee_id,
							xin_employees.first_name,
							xin_companies.company_id,
							xin_companies.name');
		$this->db->from('training_attendance');
		$this->db->join('xin_trainings', 'training_attendance.training_id = xin_trainings.trg_id', 'left');
		$this->db->join('xin_employees', 'training_attendance.emp_id = xin_employees.employee_id', 'left');
		$this->db->join('xin_companies', 'training_attendance.project_id = xin_companies.company_id', 'left');
		$this->db->where('training_attendance.training_id', 1);
		$this->db->group_by('training_attendance.emp_id');
		$report = $this->db->get();
		echo $this->db->last_query();
		return $report->result();
	}
	// Get attendance report -- Manager.
	public function training_report_manager($provid){
		$this->db->select('training_attendance.*,
							xin_trainings.trg_id,
							xin_trainings.location,
							xin_employees.employee_id,
							xin_employees.first_name,
							xin_companies.company_id,
							xin_companies.name');
		$this->db->from('training_attendance');
		$this->db->join('xin_trainings', 'training_attendance.training_id = xin_trainings.trg_id', 'left');
		$this->db->join('xin_employees', 'training_attendance.emp_id = xin_employees.employee_id', 'left');
		$this->db->join('xin_companies', 'training_attendance.project_id = xin_companies.company_id', 'left');
		$this->db->where('training_attendance.training_id', 1);
		$this->db->where(array('xin_trainings.location' => $provid));
		$this->db->group_by('training_attendance.emp_id');
		$report = $this->db->get();
		echo $this->db->last_query();
		return $report->result();
	}
	// Get employees by designation, induction training.
	public function get_designation_employees($desig_id, $status){
		$this->db->select('xin_employees.employee_id,
							xin_employees.first_name,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('xin_employees');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
		if($desig_id != 0){
			$this->db->where('xin_employees.designation_id', $desig_id);
		}
		$this->db->where('xin_employees.status', $status);
		$this->db->where(array('xin_employees.status' => 1, 'xin_employees.is_active' => 1, 'xin_employees.user_role_id' => 5));
		return $this->db->get()->result();
	}
	// Traiining Activity Reporting.
	public function trg_activity_reporting($data){
		$this->db->insert('xin_activity_reporting', $data);
		if($this->db->affected_rows() > 0 )
			return TRUE;
		else
			return FALSE;
	}
	// Get activity reports already saved on the database.
	public function get_activity_report($activity_id){
		$this->db->select('xin_activity_reporting.*,
							xin_trainings.trg_id,
							xin_trainings.district,
							xin_trainings.location,
							xin_trainings.trainee_employees,
							xin_trainings.trg_type as trgType,
							xin_trainings.start_date,
							xin_trainings.end_date,
							provinces.id,
							provinces.name,
							district.id,
							district.name as cityName,
							xin_training_types.training_type_id,
							xin_training_types.type');
		$this->db->from('xin_activity_reporting');
		$this->db->join('xin_trainings', 'xin_activity_reporting.trg_id = xin_trainings.trg_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('district', 'provinces.id = district.province_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->where('xin_activity_reporting.activity_id', $activity_id);
		$this->db->or_where('xin_activity_reporting.trg_id', $activity_id);
		$this->db->group_by('xin_trainings.trg_id');
		$query = $this->db->get();
		return $query->row_array();
	}
	// Get activity reports -- Manger.
	public function get_activity_report_manager($provid, $activity_id){
		$this->db->select('xin_activity_reporting.*,
							xin_trainings.trg_id,
							xin_trainings.district,
							xin_trainings.location,
							xin_trainings.trainee_employees,
							xin_trainings.trg_type as trgType,
							xin_trainings.start_date,
							xin_trainings.end_date,
							provinces.id,
							provinces.name,
							district.id,
							district.name as cityName,
							xin_training_types.training_type_id,
							xin_training_types.type');
		$this->db->from('xin_activity_reporting');
		$this->db->join('xin_trainings', 'xin_activity_reporting.trg_id = xin_trainings.trg_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->join('district', 'provinces.id = district.province_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->where('xin_activity_reporting.activity_id', $activity_id);
		$this->db->or_where('xin_activity_reporting.trg_id', $activity_id);
		$this->db->group_by('xin_trainings.trg_id');
		$query = $this->db->get();
		return $query->row_array();
	}
	// Events calendar
	public function store_calendar($data){
		$this->db->insert('events_calendar', $data);
		if($this->db->affected_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}
	// count all events.
	public function count_events(){
		return $this->db->count_all('events_calendar');
	}
	// Get all events for listing.
	public function get_events($limit, $offset){
    	$this->db->select('events_calendar.event_id,
    						events_calendar.title,
    						events_calendar.province,
    						events_calendar.district,
    						events_calendar.project,
    						events_calendar.designation,
    						events_calendar.trg_type,
    						events_calendar.start_date,
    						events_calendar.end_date,
    						provinces.id,
    						provinces.name as provName,
    						district.id,
    						district.name as cityName,
    						xin_companies.company_id,
    						xin_companies.name as compName,
    						xin_designations.designation_id,
    						xin_designations.designation_name,
    						xin_training_types.training_type_id,
    						xin_training_types.type');
    	$this->db->from('events_calendar');
    	$this->db->join('provinces', 'events_calendar.province = provinces.id', 'left');
    	$this->db->join('district', 'events_calendar.district = district.id', 'left');
    	$this->db->join('xin_companies', 'events_calendar.project = xin_companies.company_id', 'left');
    	$this->db->join('xin_designations', 'events_calendar.designation = xin_designations.designation_id', 'left');
    	$this->db->join('xin_training_types', 'events_calendar.trg_type = xin_training_types.training_type_id', 'left');
    	$this->db->order_by('events_calendar.event_id', 'DESC');
    	$this->db->limit($limit, $offset);
    	return $this->db->get()->result(); 	
    }
    // Get events -- Manager.
    public function get_events_manager($provid, $limit, $offset){
    	$this->db->select('events_calendar.event_id,
    						events_calendar.title,
    						events_calendar.province,
    						events_calendar.district,
    						events_calendar.project,
    						events_calendar.designation,
    						events_calendar.trg_type,
    						events_calendar.start_date,
    						events_calendar.end_date,
    						provinces.id,
    						provinces.name as provName,
    						district.id,
    						district.name as cityName,
    						xin_companies.company_id,
    						xin_companies.name as compName,
    						xin_designations.designation_id,
    						xin_designations.designation_name,
    						xin_training_types.training_type_id,
    						xin_training_types.type');
    	$this->db->from('events_calendar');
    	$this->db->join('provinces', 'events_calendar.province = provinces.id', 'left');
    	$this->db->join('district', 'events_calendar.district = district.id', 'left');
    	$this->db->join('xin_companies', 'events_calendar.project = xin_companies.company_id', 'left');
    	$this->db->join('xin_designations', 'events_calendar.designation = xin_designations.designation_id', 'left');
    	$this->db->join('xin_training_types', 'events_calendar.trg_type = xin_training_types.training_type_id', 'left');
    	$this->db->where(array('provinces.id' => $provid));
    	$this->db->order_by('events_calendar.event_id', 'DESC');
    	$this->db->limit($limit, $offset);
    	return $this->db->get()->result(); 	
    }
	// Get event detail by event_id.
	public function detail_event($event_id){
		$this->db->select('events_calendar.event_id,
							events_calendar.title,
							events_calendar.province,
							events_calendar.district,
							events_calendar.project,
							events_calendar.designation,
							events_calendar.trg_type,
							events_calendar.start_date, end_date,
							provinces.id,
							provinces.name as provName,
							district.id,
							district.name as cityName,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name,
							xin_training_types.training_type_id,
							xin_training_types.type');
		$this->db->from('events_calendar');
		$this->db->join('provinces', 'events_calendar.province = provinces.id', 'left');
		$this->db->join('district', 'events_calendar.district = district.id', 'left');
		$this->db->join('xin_companies', 'events_calendar.project = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'events_calendar.designation = xin_designations.designation_id', 'left');
		$this->db->join('xin_training_types', 'events_calendar.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->where('events_calendar.event_id', $event_id);
		return $this->db->get()->row_array();
	}
	// Event detail -- Manager.
	public function detail_event_manager($provid, $event_id){
		$this->db->select('events_calendar.event_id,
							events_calendar.title,
							events_calendar.province,
							events_calendar.district,
							events_calendar.project,
							events_calendar.designation,
							events_calendar.trg_type,
							events_calendar.start_date, end_date,
							provinces.id,
							provinces.name as provName,
							district.id,
							district.name as cityName,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name,
							xin_training_types.training_type_id,
							xin_training_types.type');
		$this->db->from('events_calendar');
		$this->db->join('provinces', 'events_calendar.province = provinces.id', 'left');
		$this->db->join('district', 'events_calendar.district = district.id', 'left');
		$this->db->join('xin_companies', 'events_calendar.project = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'events_calendar.designation = xin_designations.designation_id', 'left');
		$this->db->join('xin_training_types', 'events_calendar.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->where(array('provinces.id' => $provid));
		$this->db->where('events_calendar.event_id', $event_id);
		return $this->db->get()->row_array();
	}
	// Modify an event.... [Get data to form for edit...]
	public function modify_event($event_id){
		$this->db->select('events_calendar.event_id,
    						events_calendar.title,
    						events_calendar.province,
    						events_calendar.district,
    						events_calendar.project,
    						events_calendar.designation,
    						events_calendar.trg_type,
    						events_calendar.start_date,
    						events_calendar.end_date,
    						provinces.id,
    						provinces.name as provName,
    						district.id,
    						district.name as cityName,
    						xin_companies.company_id,
    						xin_companies.name as compName,
    						xin_designations.designation_id,
    						xin_designations.designation_name,
    						xin_training_types.training_type_id,
    						xin_training_types.type');
		$this->db->from('events_calendar');
    	$this->db->join('provinces', 'events_calendar.province = provinces.id', 'left');
    	$this->db->join('district', 'events_calendar.district = district.id', 'left');
    	$this->db->join('xin_companies', 'events_calendar.project = xin_companies.company_id', 'left');
    	$this->db->join('xin_designations', 'events_calendar.designation = xin_designations.designation_id', 'left');
    	$this->db->join('xin_training_types', 'events_calendar.trg_type = xin_training_types.training_type_id', 'left');
    	$this->db->where('events_calendar.event_id', $event_id);
    	return $this->db->get()->row();
	}
	// Update the edited event.
	public function update_event($event_id, $data){
		$this->db->where('event_id', $event_id);
		$this->db->update('events_calendar', $data);
		return true;
	}
	// Delete an event.
	public function delete_event($event_id){
		$this->db->where('event_id', $event_id);
		$this->db->delete('events_calendar');
		return true;
	}
	// Remove the training if no trainees are registerd.
	public function remove_training($trg_id){
		$this->db->where('trg_id', $trg_id);
		$this->db->delete('xin_trainings');
		return true;
	}

	// -----------------------------------------------------------------------------
	// Training report, export to excel.
	//------------------------------------------------------------------------------
	// Events calendar report.
	public function get_events_report(){
    	$this->db->select('events_calendar.event_id,
    						events_calendar.title,
    						events_calendar.province,
    						events_calendar.district,
    						events_calendar.project,
    						events_calendar.designation,
    						events_calendar.trg_type,
    						events_calendar.start_date,
    						events_calendar.end_date,
    						provinces.id,
    						provinces.name as provName,
    						district.id,
    						district.name as cityName,
    						xin_companies.company_id,
    						xin_companies.name as compName,
    						xin_designations.designation_id,
    						xin_designations.designation_name,
    						xin_training_types.training_type_id,
    						xin_training_types.type');
    	$this->db->from('events_calendar');
    	$this->db->join('provinces', 'events_calendar.province = provinces.id', 'left');
    	$this->db->join('district', 'events_calendar.district = district.id', 'left');
    	$this->db->join('xin_companies', 'events_calendar.project = xin_companies.company_id', 'left');
    	$this->db->join('xin_designations', 'events_calendar.designation = xin_designations.designation_id', 'left');
    	$this->db->join('xin_training_types', 'events_calendar.trg_type = xin_training_types.training_type_id', 'left');
    	$this->db->order_by('events_calendar.event_id', 'DESC');
    	$this->db->limit(20);
    	return $this->db->get()->result_array(); 	
    }
    // Induction trainings.
    public function get_trainings_report(){
		$this->db->select('length(trainee_employees) - length(replace(trainee_employees,",","") + 1) as trainees,
							xin_trainings.*,
							xin_trainers.trainer_id,
							xin_trainers.first_name,
							xin_trainers.last_name,
							xin_training_types.training_type_id,
							xin_training_types.type,
							xin_training_locations.location_id,
							xin_training_locations.location,
							provinces.id,
							provinces.name as prov_name');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id', 'left');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id', 'left');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id', 'left');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id', 'left');
		$this->db->where(array('xin_trainings.trg_type' => 1, 'xin_trainings.status' => 1));
		$query = $this->db->get();
		return $query->result_array();
	}
}

?>