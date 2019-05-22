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
		return $this->db->count_all('xin_trainings');
	}
	// Get data from database and list them on the dashboard.
	public function get_trainings($limit = '', $offset = ''){
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
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id');
		$this->db->limit($limit, $offset);
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
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id');
		$this->db->join('xin_training_locations', 'xin_trainings.location = xin_training_locations.location_id');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id');
		$this->db->like('xin_trainings.facilitator_name', $training);
		$this->db->or_like('xin_trainings.approval_type', $training);
		$this->db->or_like('xin_trainers.first_name', $training);
		$this->db->or_like('xin_training_types.type', $training);
		$this->db->or_like('xin_training_locations.location', $training);
		$this->db->or_like('provinces.name', $training);
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
							xin_designations.designation_id,
							xin_designations.designation_name,
							provinces.id,
							provinces.name as provName');
		$this->db->from('xin_trainings');
		$this->db->join('xin_trainers', 'xin_trainings.trainer_one = xin_trainers.trainer_id');
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id');
		$this->db->join('xin_training_locations', 'xin_trainings.venue = xin_training_locations.location_id');
		$this->db->join('xin_companies', 'xin_trainings.project = xin_companies.company_id');
		$this->db->join('xin_designations', 'xin_companies.designation_id = xin_designations.designation_id');
		$this->db->join('provinces', 'xin_trainings.location = provinces.id');
		$this->db->where('xin_trainings.trg_id', $trg_id);
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
	// Get trainers to feed them into the dropdown list to assign to trainings.
	public function get_trainers(){
		$this->db->select('trainer_id, first_name, last_name, contact_number, email, designation_id, expertise, address, status, created_at');
		$this->db->from('xin_trainers');
		$this->db->where('status', 1);
		return $this->db->get()->result();
	}
	// Add new trainer.
	public function add_trainer(){
		$this->db->insert('xin_trainers');
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
							city.id as cityId,
							city.name as city_name');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id');
		$this->db->join('city', 'xin_training_hotels.city = city.id');
		$this->db->like('xin_training_hotels.hotel_name', $hotel);
		$this->db->or_like('provinces.name', $hotel);
		$this->db->or_like('city.name', $hotel);
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
							city.id,
							city.name as cityName');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id');
		$this->db->join('city', 'xin_training_hotels.city = city.id');
		$this->db->where('hotel_id', $hotel_id);
		return $this->db->get()->row_array();
	}
	// Get employees to feed them into the dropdown list to assign training to.
	public function get_employees(){
		$this->db->select('employee_id, first_name, last_name, user_id');
		$this->db->from('xin_employees');
		return $this->db->get()->result();
	}
	// Get designations to show them in the dropdown list.
	public function get_designations(){
		$this->db->select('designation_id, designation_name');
		$this->db->from('xin_designations');
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
		$this->db->select('xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('xin_companies');
		$this->db->join('xin_designations', 'xin_companies.designation_id = xin_designations.designation_id');
		$this->db->where('xin_companies.company_id', $proj_id);
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
							city.id as city_id,
							city.name as city_name');
		$this->db->from('provinces');
		$this->db->join('city', 'provinces.id = city.province_id');
		$this->db->where('provinces.id', $id);
		return $this->db->get()->result();
	}
	// count all training locations to create pagination.
	public function count_locations(){
		return $this->db->count_all('xin_training_locations');
	}
	// Get location information to show in HTML table.
	public function get_trainig_locations($limit = '', $offset = ''){
		$this->db->select('xin_training_locations.location_id,
							xin_training_locations.province,
							xin_training_locations.city,
							xin_training_locations.location,
							provinces.id,
							provinces.name,
							city.id as city_id,
							city.name as city_name');
		$this->db->from('xin_training_locations');
		$this->db->join('provinces', 'xin_training_locations.province = provinces.id');
		$this->db->join('city', 'xin_training_locations.city = city.id');
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
		$this->db->join('xin_companies', 'xin_training_allowances.project = xin_companies.company_id');
		$this->db->join('xin_designations', 'xin_training_allowances.designation = xin_designations.designation_id');
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
							city.id as city_id,
							city.name as city_name');
		$this->db->from('xin_training_hotels');
		$this->db->join('provinces', 'xin_training_hotels.province = provinces.id');
		$this->db->join('city', 'xin_training_hotels.city = city.id');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Get room types to show them in the dropdown list.
	public function get_room_types(){
		$this->db->select('price_id, room_type, charges, hotel_id');
		$this->db->from('xin_training_prices');
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
							xin_employees.last_name,
							xin_employees.email,
							xin_employees.company_id,
							xin_employees.designation_id,
							xin_employees.contact_no,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_name,
							xin_designations.designation_name');
		$this->db->from('xin_employees');
		$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id');
		$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id');
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
		$this->db->join('xin_training_types', 'xin_trainings.trg_type = xin_training_types.training_type_id');
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
}

?>