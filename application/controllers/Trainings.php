<?php if(!defined('BASEPATH')) exit('No direct script access allowed.');

/* Filename: Trainings.php
*  Author: Saddam
*  Filepath: application / controllers / Trainings.php
*/
class Trainings extends CI_Controller{
	function __construct(){
		parent::__construct();
		// Load the models and other required resources / libraries here in the construct function so that they're available in all the methods you write in this class.
		$this->load->model('Trainings_model');
	}
	// The default function to be loaded when one opens the application.
	public function index($offset = NULL){
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/index');
		$config['total_rows'] = $this->Trainings_model->count_trainings();
		$config['per_page'] = $limit;
		$config['num_links'] = 3;
		$config["full_tag_open"] = '<ul class="pagination">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li>';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li>';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = 'next &raquo;';
	    $config["next_tag_open"] = '<li>';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainings | Dashboard';
		$data['content'] = 'training-files/dashboard';
		$data['trainings_list'] = $this->Trainings_model->get_trainings($limit, $offset);
		$this->load->view('training-files/components/template', $data);
	}
	// Load the create trainings page first.
	public function add_trainings($comp_id = ''){
		$data['title']  = 'Trainings | Create Training';
		$data['content'] = 'training-files/create_training';
		$data['projects'] = $this->Trainings_model->get_projects();
		$data['training_types'] = $this->Trainings_model->get_training_types();
		$data['trainers'] = $this->Trainings_model->get_trainers();
		$data['venues'] = $this->Trainings_model->get_venues();
		$data['locations'] = $this->Trainings_model->get_locations();
		$this->load->view('training-files/components/template', $data);
	}
	// Perform the insert action here in this function, set the form action on this method.
	public function create_training(){
		$employees = ''; // make a variable and cast an array to it.
		if(isset($_POST['employee'])){
			$tEmployees = $_POST['employee'];
			for($i = 0; $i < count($tEmployees); $i++){
				$employees .= $tEmployees[$i]. ',';
			}
		}
		$data = array(
					'location' => $this->input->post('location'),
					'project' => $this->input->post('project'),
					'trg_type' => $this->input->post('trg_type'),
					'trainer_one' => $this->input->post('trainer_1'),
					'trainer_two' => $this->input->post('trainer_1'),
					'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'),
					'facilitator_name' => $this->input->post('facilitator'),
					'trainee_employees' => rtrim($employees, ','),
					'target_group' => $this->input->post('target'),
					'venue' => $this->input->post('venue'),
					'hall_detail' => $this->input->post('hall'),
					'session' => $this->input->post('session'),
					'approval_type' => $this->input->post('approval_type'),
					'created_at' => $this->input->post('created_at')
					); // insert data in array into database.
		$this->Trainings_model->create_training($data);
		$this->session->set_flashdata('success', '<strong>Great Job! </strong> Your data has been added successfully. Now you can add more...');
		return redirect('trainings/add_trainings');
	}
	// List of all trainings.
	public function all_trainings($offset = NULL){
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/all_trainings');
		$config['total_rows'] = $this->Trainings_model->count_trainings();
		$config['per_page'] = $limit;
		$config['num_links'] = 3;
		$config["full_tag_open"] = '<ul class="pagination">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li>';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li>';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = 'next &raquo;';
	    $config["next_tag_open"] = '<li>';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainings | Trainings List';
		$data['content'] = 'training-files/trainings_list';
		$data['list_trainings'] = $this->Trainings_model->get_trainings($limit, $offset);
		$this->load->view('training-files/components/template', $data);
	}
	// Search trainings.
	public function training_search(){
		$training = $this->input->get('search_training');
		$data['results'] = $this->Trainings_model->search_trainings($training);
		$data['title'] = 'Trainings | Search Results';
		$data['content'] = 'training-files/trainings_list';
		$this->load->view('training-files/components/template', $data);
	}
	// View training detail.
	public function detail_training($trg_id){
		$data['title'] = 'Trainings | Training Detail';
		$data['content'] = 'training-files/trainings_list';
		// Get trainees registered in the training.
		$data['training_detail'] = $detail_row = $this->Trainings_model->training_detail($trg_id);
		$employee_detail = explode(',', $detail_row['trainee_employees']);
		$serial = 1;
		$employee_names = '';
		for ($i = 0; $i < count($employee_detail); $i++) {
			$this->db->select('xin_employees.first_name,
								xin_employees.last_name,
								xin_employees.designation_id,
								xin_employees.company_id,
								xin_employees.address,
								xin_employees.contact_no,
								xin_companies.company_id,
								xin_companies.name,
								xin_designations.designation_id,
								xin_designations.designation_name');
			$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id');
			$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id');
			$row = $this->db->get_where('xin_employees', array('user_id' => $employee_detail[$i]))->row();
			// Print the data in HTML view.
			$employee_names .= "<div class='row'><div class='col-lg-2'><strong>". $serial++.". </strong>". ucfirst($row->first_name) . " " . ucfirst($row->last_name) ."</div><div class='col-lg-3'> ".$row->designation_name. "</div><div class='col-lg-2'>".$row->name."</div><div class='col-lg-2'>".$row->contact_no."</div><div class='col-lg-3'>".$row->address."</div><hr></div>";
		}
		$data['employee_names'] = $employee_names;
		$this->load->view('training-files/components/template', $data);
	}
	// List of all trainers.
	public function trainers(){
		$data['title'] = 'Trainings | Trainers List';
		$data['content'] = 'training-files/trainers_list';
		$data['trainers_list'] = $this->Trainings_model->get_trainers();
		$this->load->view('training-files/components/template', $data);
	}
	// Add new trainers.
	public function add_trainer(){
		$data['title'] = 'Trainings | Add Trainer';
		$data['content'] = 'training-files/add_trainer';
		$data['designations'] = $this->Trainings_model->get_designations();
		$this->load->view('training-files/components/template', $data);
	}
	// Add trainer into database.
	public function add_new_trainer(){
		$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'contact_number' => $this->input->post('contact'),
					'email' => $this->input->post('email'),
					'expertise' => $this->input->post('expertise'),
					'address' => $this->input->post('address'),
					'created_at' => $this->input->post('created_at')
					);
		var_dump($data);
	}
	// Search trainers.
	public function trainer_search(){
		$trainer = $this->input->get('search_trainer');
		$data['results'] = $this->Trainings_model->search_trainers($trainer);
		$data['title'] = 'Trainings | Search Trainers';
		$data['content'] = 'training-files/trainers_list';
		$this->load->view('training-files/components/template', $data);
	}
	// Trainer's detail
	public function detail_trainer($trainer_id){
		$data['title'] = 'Trainings | Trainer Detail';
		$data['content'] = 'training-files/trainers_list';
		$data['trainer_detail'] = $this->Trainings_model->trainer_detail($trainer_id);
		$this->load->view('training-files/components/template', $data);
	}
	// Create designations.
	public function add_allowances(){
		$data['title'] = 'Trainings | Create Designations';
		$data['content'] = 'training-files/create_allowances';
		$data['designations'] = $this->Trainings_model->get_designations();
		$data['projects'] = $this->Trainings_model->get_projects();
		$data['allowances'] = $this->Trainings_model->get_allowances();
		$this->load->view('training-files/components/template', $data);
	}
	// Create training allowances.
	public function create_allowances(){
		$data = array(
					'project' => $this->input->post('project'),
					'designation' => $this->input->post('designation'),
					'behavior' => $this->input->post('behavior'),
					'dsa' => $this->input->post('dsa'),
					'travel' => $this->input->post('travel'),
					'stay_allowance' => $this->input->post('stay')
					);
		$this->Trainings_model->add_new_allowances($data);
		$this->session->set_flashdata('success', '<strong>Great Job! </strong> Allowance has been added successfully, now you can add more...');
		return redirect('trainings/add_allowances');
	}
	// Get project's designations for creating exam.
	public function get_trg_projects($proj_id){
		$desig_list = $this->Trainings_model->get_pro_designations($proj_id);
		echo json_encode($desig_list);
	}
	// Get city name by province id
	public function get_provinces($id){
		$prov_list = $this->Trainings_model->provinces_data($id);
		echo json_encode($prov_list);
	}
	// Training locations setup.
	public function locations($offset = NULL){
		$limit = 5;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/locations');
		$config['total_rows'] = $this->Trainings_model->count_locations();
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$config["full_tag_open"] = '<ul class="pagination">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li>';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li>';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = 'next &raquo;';
	    $config["next_tag_open"] = '<li>';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainings | Training Locations';
		$data['content'] = 'training-files/training_locations';
		$data['locations'] = $this->Trainings_model->get_locations();
		$data['all_locations'] = $this->Trainings_model->get_trainig_locations($limit, $offset);
		$this->load->view('training-files/components/template', $data);
	}
	// Create training locations.
	public function create_locations(){
		$data = array(
			'province' => $this->input->post('location'),
			'city' => $this->input->post('city'),
			'location' => $this->input->post('venue')
		);
		$save = $this->Trainings_model->add_locations($data);
		echo json_encode($save);
	}
	// Add stay hotels in different places. Display a grid below the form.
	public function stay_hotels($offset = NULL){
		$limit = 5;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/stay_hotels');
		$config['total_rows'] = $this->Trainings_model->count_hotels();
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$config["full_tag_open"] = '<ul class="pagination">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li>';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li>';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = 'next &raquo;';
	    $config["next_tag_open"] = '<li>';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainings | Stay Hotels';
		$data['content'] = 'training-files/stay_hotels';
		$data['locations'] = $this->Trainings_model->get_locations();
		$data['hotels'] = $this->Trainings_model->get_stay_hotels($limit, $offset);
		$data['room_types'] = $this->Trainings_model->get_room_types();
		$this->load->view('training-files/components/template', $data);
	}
	// Get all hotels to display them on a separate view page.
	public function all_stay_hotels($offset = NULL){
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/all_stay_hotels');
		$config['total_rows'] = $this->Trainings_model->count_hotels();
		$config['per_page'] = $limit;
		$config['num_links'] = 5;
		$config["full_tag_open"] = '<ul class="pagination">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li>';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li>';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = 'next &raquo;';
	    $config["next_tag_open"] = '<li>';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainings | Hotels List';
		$data['content'] = 'training-files/hotels_list';
		$data['room_types'] = $this->Trainings_model->get_room_types();
		$data['hotels_list'] = $this->Trainings_model->get_stay_hotels($limit, $offset);
		$this->load->view('training-files/components/template', $data);
	}
	// Search for specific hotels in the list.
	public function hotel_search(){
		$hotel = $this->input->get('search_hotel');
		$data['title'] = 'Trainings | Search Hotels';
		$data['content'] = 'training-files/hotels_list';
		$data['results'] = $this->Trainings_model->search_hotels($hotel);
		$this->load->view('training-files/components/template', $data);
	}
	// Hotel detail, view single hotel with details by hotel_id.
	public function detail_hotel($hotel_id){
		$data['title'] = 'Trainings | Hotel Detail';
		$data['content'] = 'training-files/hotels_list';
		$data['hotel_detail'] = $this->Trainings_model->hotel_detail($hotel_id);
		$this->load->view('training-files/components/template', $data);
	}
	// Add new hotels for staying in the province or city.
	public function add_stay_hotels(){
		$data = array(
				'province' => $this->input->post('location'),
				'city' => $this->input->post('city'),
				'hotel_name' => $this->input->post('hotel')
			);
		$save_data = $this->Trainings_model->create_stay_hotels($data);
		echo json_encode($save_data);
	}
	// Add hotel amenities.
	public function add_amenities(){
		$amenities = '';
		if(isset($_POST['amenity'])){
			$pAmenities = $_POST['amenity'];
			for($i = 0; $i < count($pAmenities); $i++){
				$amenities .= $pAmenities[$i]. ', ';
			}
		}
		$data = array(
				'room_type_id' => $this->input->post('room_type'),
				'amenities' => rtrim($amenities, ', ')
		);
		$this->Trainings_model->hotel_amenities($data);
		$this->session->set_flashdata('success', '<strong>Good Job! </strong> Data has been stored successfully, now you can add more...');
		return redirect('trainings/stay_hotels');
	}
	// Add room charges for which you can add amenities later.
	public function add_room_charges(){
		$data = array(
			'hotel_id' => $this->input->post('hotel_id'),
			'room_type' => $this->input->post('room_type'),
			'charges' => $this->input->post('charges')
		);
		$this->Trainings_model->add_prices($data);
		$this->session->set_flashdata('success', '<strong>Good Job! </strong> Price has been added successfully, now you can add more...');
		return redirect('trainings/stay_hotels');
	}
	// Prices detail
	public function prices_detail($hotel_id){
		$data['title'] = 'Trainings | Prices Detail';
		$data['content'] = 'training-files/stay_hotels';
		$data['prices'] = $this->Trainings_model->get_prices($hotel_id);
		$this->load->view('training-files/components/template', $data);
	}
	// Get employees for trainings.
	public function training_employees($comp_id = ''){
		$employees = $this->Trainings_model->get_employees_for_training($comp_id);
		echo json_encode($employees);
		// $data['employees'] = $this->Trainings_model->get_employees_for_training($comp_id);
	}
	// Load the attencance view
	public function attendance_view(){
		$data['trainings'] = $this->Trainings_model->get_trainings_list();
		$data['title'] = 'Trainings | Employees Attendance';
		$data['content'] = 'training-files/attendance_view';
		$this->load->view('training-files/components/template', $data);
	}
	// Employees' attendance in training.
	public function attendance(){
		$trg_id = $_POST['training'];
		$data['trainee_employees'] = $row = $this->Trainings_model->get_trainees($trg_id);
		$ids = array();
		$names = array();
		$ids = explode(',', $row->trainee_employees);
		for ($i = 0; $i < count($ids); $i++) {
			$names[$i] = $this->db->query("SELECT employee_id, first_name, last_name FROM xin_employees WHERE employee_id = " . $ids[$i])->row();
		}
		$data['names'] = $names;
		$data['title'] = 'Trainings | Attendance';
		$data['content'] = 'training-files/attendance';
		$this->load->view('training-files/components/template', $data);
	}
	// Save attendance to the database.
	public function save_attendance(){ // This is a multi-insert function. (batch_insert)
		$status = $_POST['status'];
		$training_id = $_POST['trg_id'];
		$emp_id = $_POST['employee_id'];
		$project = $_POST['project'];
		// Count all the options and dump into the database.
		$length = count($status); 
		$length = count($training_id);
		$length = count($emp_id);
		$length = count($project);
		// Take all the data in a loop to get the data and insert into database.
		for($j = 0; $j < $length; $j++) {
			$data = array(
					'status' => $_POST['status'][$j],
					'training_id' => $_POST['trg_id'][$j],
					'emp_id' => $_POST['employee_id'][$j],
					'project_id' => $_POST['project'][$j]
					);
			$this->Trainings_model->store_attendance($data); // Send the data to the DB.
		}
		// Print a success message on the screen on successful submission of data.
		$this->session->set_flashdata('success', 'Attendance submitted successfully!');
		return redirect('Trainings/attendance_view');
	}
}

?>