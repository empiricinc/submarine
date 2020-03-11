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
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}

		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id'];
	 //    $departmentLevel5 = $session['department_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //       $data['sl2'] = $this->session->userdata('accessLevel');
        //$data['slt'] = $this->session->userdata('department_id'); // un-comment later.

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
		//if($data['sl2']){ // Check Access Level.
			$data['trainings_list'] = $this->Trainings_model->get_trainings($limit, $offset);
		//}else{
			//$data['trainings_list'] = $this->Trainings_model->get_trainings_manager($provid, $limit, $offset);
		//}
		
		//if($data['sl2']){
			$data['refreshers'] = $this->Trainings_model->refresher_training();
		//}else{
			//$data['refreshers'] = $this->Trainings_model->refresher_training_manager($provid);
		//}
		
		//if($data['sl2']){
			$data['completed_trainings'] = $this->Trainings_model->trainings_completed($limit, $offset);
		//}else{
		//	 $data['completed_trainings'] = $this->Trainings_model->trainings_completed_manager($provid, $limit, $offfset);
		//}
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
		$data['designations'] = $this->Trainings_model->get_designations();
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
					'district' => $this->input->post('city'),
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
		for($i = 0; $i < count($tEmployees); $i++){ 
			$this->db->where('employee_id', $tEmployees[$i]);
			$status = $this->db->select('status')->from('xin_employees')->get()->row();
			if($status->status == 1)
			$this->db->update('xin_employees', array('status' => '2'));
			elseif($status->status == 2)
			$this->db->update('xin_employees', array('status' => '3'));
			else
			$this->db->update('xin_employees', array('status' => '2'));
		} // Update training_status for employees when added to the training.

		$this->session->set_flashdata('success', '<strong>Great Job! </strong> Your data has been added successfully. Now you can add more...');
		return redirect('trainings/add_trainings');
	}
	// List of all trainings.
	public function all_trainings($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		// $projid = $session['project_id'];
	 	// $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  		// $data['sl2'] = $this->session->userdata('accessLevel');

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
	    $config["prev_link"] = "&laquo; prev";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainings | Trainings List';
		$data['content'] = 'training-files/trainings_list';
		//if($data['sl2']){
			$data['list_trainings'] = $this->Trainings_model->get_all_trainings($limit, $offset);
		//}else{
			// $data['list_trainings'] = $this->Trainings_model->get_all_trainings_manager($provid, $limit, $offset);
		//}
		$this->load->view('training-files/components/template', $data);
	}
	// All completed trainings...
	public function all_completed($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		// $projid = $session['project_id'];
	 	// $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  		// $data['sl2'] = $this->session->userdata('accessLevel');

		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/all_completed');
		$config['total_rows'] = $this->Trainings_model->count_completed();
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
	    $config["prev_link"] = "&laquo; prev";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainigs | Completed Trainings';
		$data['content'] = 'training-files/completed_list';
		//if($data['sl2']){
			$data['completed_trainings'] = $this->Trainings_model->trainings_completed($limit, $offset);
		//}else{
			 //$data['completed_trainings'] = $this->Trainings_model->trainings_completed_manager($provid, $limit, $offfset);
		//}
		$this->load->view('training-files/components/template', $data);
	}
	// Get by training's status.
	public function get_by_trg_status($status = ''){
		$data = $this->Trainings_model->get_by_status($status);
		echo json_encode($data);
	}
	// All refresher trainings' list.
	public function all_refresher($offset = null){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}

		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/all_refresher');
		$config['total_rows'] = $this->Trainings_model->count_refresher();
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
	    $config["prev_link"] = "&laquo; prev";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainings | All Refreshers';
		$data['content'] = 'training-files/all_refresher';
		// if($data['sl2']){ // Check Access Level.
			$data['list_trainings'] = $this->Trainings_model->all_refresher_trainings($limit, $offset);
		// }else{
			// $data['list_trainings'] = $this->Trainings_model->all_refresher_trainings_manager($provid, $limit, $offset);
		// }
		// Load the function and pass the vars to create pagination.
		$this->load->view('training-files/components/template', $data); // Load view
	}
	// Search trainings.
	public function training_search(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

		$training = $this->input->get('search_training');
		// if($data['sl2']){
			$data['results'] = $this->Trainings_model->search_trainings($training);
		// }else{
			// $data['results'] = $this->Trainings_model->search_trainings_manager($provid, $training);
		// }
		$data['title'] = 'Trainings | Search Results';
		$data['content'] = 'training-files/trainings_list';
		$this->load->view('training-files/components/template', $data);
	}
	public function refresher_search(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

		$training = $this->input->get('search_training');
		// if($data['sl2']){
			$data['results'] = $this->Trainings_model->search_refresher($training);
		// }
		$data['title'] = 'Trainings | Search Results';
		$data['content'] = 'training-files/all_refresher';
		$this->load->view('training-files/components/template', $data);
	}
	// Completed trainings search.
	public function completed_search(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		// $projid = $session['project_id'];
		// $provid = $session['provience_id'];

		// $data['sl3'] = $this->session->userdata('accessLevel');
		// $data['sl2'] = $this->session->userdata('accessLevel');
		$training = $this->input->get('search_training');
		// if($data['sl2']){
			$data['results'] = $this->Trainings_model->search_completed($training);
		// }
		$data['title'] = 'Trainings | Search Results';
		$data['content'] = 'training-files/completed_list';
		$this->load->view('training-files/components/template', $data);
	}
	// View training detail.
	public function detail_training($trg_id){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

		// $data['title'] = 'Trainings | Training Detail';
		$data['content'] = 'training-files/trainings_list';
		// Get trainees registered in the training.
		// if($data['sl2']){
			$data['training_detail'] = $detail_row = $this->Trainings_model->training_detail($trg_id);
		// }else{
			// $data['training_detail'] = $detail_row = $this->Trainings_model->training_detail_manager($provid, $trg_id);
		// }
		$employee_detail = explode(',', $detail_row['trainee_employees']);
		$serial = 1;
		$employee_names = '';
		$no_employees = '';
		for ($i = 0; $i < count($employee_detail); $i++) {
			$this->db->select('xin_employees.employee_id,
								xin_employees.first_name,
								xin_employees.designation_id,
								xin_employees.company_id,
								xin_companies.company_id,
								xin_companies.name,
								xin_designations.designation_id,
								xin_designations.designation_name');
			$this->db->join('xin_companies', 'xin_employees.company_id = xin_companies.company_id', 'left');
			$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
			$row = $this->db->get_where('xin_employees', array('employee_id' => $employee_detail[$i]))->row();
			// Print the data in HTML view.
			if(!empty($row)){
				$employee_names .= "<div class='row'><div class='col-lg-4'><strong>". $serial++.". </strong>". ucfirst($row->first_name). "</div><div class='col-lg-4'> ".$row->designation_name. "</div><div class='col-lg-4'>".$row->name."</div><hr></div>";
			}else{
				$no_employees .= '<div class="alert alert-danger"><p class="lead text-center">Sorry, there are no trainees registered in this training ! Try removing the training instead.</p></div>';
			}
		}
		$data['employee_names'] = $employee_names;
		$data['no_employees'] = $no_employees;
		$this->load->view('training-files/components/template', $data);
	}
	// Delete training if no employees registered in it..
	public function delete_trg($trg_id){
		if($this->Trainings_model->remove_training($trg_id)){
			$this->session->set_flashdata('success', '<strong>Success !</strong> The training has been removed successfully!');
			redirect('trainings/all_trainings');
		}else{
			echo "The operation wasn't successful. Try again.";
		}
	}
	// List of all trainers.
	public function trainers($offset = NULL){
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/trainers');
		$config['total_rows'] = $this->Trainings_model->count_trainers();
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
	    $config["prev_link"] = "&laquo; prev";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		$data['title'] = 'Trainings | Trainers List';
		$data['content'] = 'training-files/trainers_list';
		$data['trainers_list'] = $this->Trainings_model->get_all_trainers($limit, $offset);
		$this->load->view('training-files/components/template', $data);
	}
	// Add new trainers.
	public function add_trainer(){
		$data['title'] = 'Trainings | Add Trainer';
		$data['content'] = 'training-files/add_trainer';
		$data['designations'] = $this->Trainings_model->get_designations();
		$this->load->view('training-files/components/template', $data);
	}
	// Add new trainers, it's not important by the time.
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
		$data = $this->Trainings_model->add_trainer($data);
		echo json_encode($data);
	}
	// Activate or Deactivate a trainer.
	public function trainer_status($trainer_id){
		$tr_status = $this->db->select('status')->get_where('xin_trainers', array('trainer_id' => $trainer_id))->row();
		if($tr_status->status == '1'){
			$this->db->where('trainer_id', $trainer_id);
			$this->db->update('xin_trainers', array('status' => '0'));
		}else{
			$this->db->where('trainer_id', $trainer_id);
			$this->db->update('xin_trainers', array('status' => '1'));
		}
		redirect('trainings/trainers');
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
	// Get tehsil name by city id
	public function get_districts($id){
		$dist_list = $this->Trainings_model->districts_data($id);
		echo json_encode($dist_list);
	}
	// Get union coucil name by tehsil id
	public function get_tehsils($id){
		$teh_list = $this->Trainings_model->tehsils_data($id);
		echo json_encode($teh_list);
	}
	// Training locations setup.
	public function locations($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 5;
		if(!empty($offset)){
			$this->uri->segment(3);
		}

		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

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
		// if($data['sl2']){
			$data['all_locations'] = $this->Trainings_model->get_training_locations($limit, $offset);
		// }else{
			// $data['all_locations'] = $this->Trainings_model->get_training_locations_manager($provid, $limit, $offset);
		// }
		$this->load->view('training-files/components/template', $data);
	}
	// Create training locations.
	public function create_locations(){
		$data = array(
			'province' => $this->input->post('location'),
			'city' => $this->input->post('city'),
			'location' => $this->input->post('venue'),
			'description' => $this->input->post('description')
		);
		$save = $this->Trainings_model->add_locations($data);
		echo json_encode($save);
	}
	// Add stay hotels in different places. Display a grid below the form.
	public function stay_hotels($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 5;
		if(!empty($offset)){
			$this->uri->segment(3);
		}

		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

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
		// if($data['sl2']){
			$data['hotels'] = $this->Trainings_model->get_stay_hotels($limit, $offset);
		// }else{
			// $data['hotels'] = $this->Trainings_model->get_stay_hotels_manager($provid, $limit, $offset);
		// }
		$data['room_types'] = $this->Trainings_model->get_room_types();
		$this->load->view('training-files/components/template', $data);
	}
	// Get all hotels to display them on a separate view page.
	public function all_stay_hotels($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}

		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

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
		// if($data['sl2']){
			$data['hotels_list'] = $this->Trainings_model->get_stay_hotels($limit, $offset);
		// }else{
			// $data['hotels_list'] = $this->Trainings_model->get_stay_hotels_manager($provid, $limit, $offset);
		// }
		$this->load->view('training-files/components/template', $data);
	}
	// Search for specific hotels in the list.
	public function hotel_search(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

		$hotel = $this->input->get('search_hotel');
		$data['title'] = 'Trainings | Search Hotels';
		$data['content'] = 'training-files/hotels_list';
		// if($data['sl2']){
			$data['results'] = $this->Trainings_model->search_hotels($hotel);
		// }else{
			// $data['results'] = $this->Trainings_model->search_hotels_manager($provid, $hotel);
		// }
		$this->load->view('training-files/components/template', $data);
	}
	// Hotel detail, view single hotel with details by hotel_id.
	public function detail_hotel($hotel_id){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

		$data['title'] = 'Trainings | Hotel Detail';
		$data['content'] = 'training-files/hotels_list';
		// if($data['sl2']){
			$data['hotel_detail'] = $this->Trainings_model->hotel_detail($hotel_id);
		// }else{
			// $data['hotel_detail'] = $this->Trainings_model->hotel_detail_manager($provid, $hotel_id);
		// }
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
	// Store the updated hotel into the database.
	public function modify_hotel(){
		$hotel_id = $this->input->post('hotel_id');
		$data = array(
			'hotel_name' => $this->input->post('hotel_name')
		);
		$this->Trainings_model->update_hotel($hotel_id, $data);
		return redirect('trainings/stay_hotels');
	}
	// Delete a hotel from database.
	public function delete_hotel($hotel_id){
		$this->Trainings_model->delete_hotel($hotel_id);
		return redirect('trainings/stay_hotels');
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
	}
	// Employees' attendance in training.
	public function attendance($trg_id=''){
		if($trg_id == "") // If $trg_id is empty, load the page from the post form.
			$trg_id = $_POST['training'];
		$data['trainee_employees'] = $row = $this->Trainings_model->get_trainees($trg_id);
		$ids = array();
		$names = array();
		$ids = explode(',', $row->trainee_employees);
		for ($i = 0; $i < count($ids); $i++) {
			$names[$i] = $this->db->query("SELECT employee_id, first_name FROM xin_employees WHERE employee_id = " . $ids[$i])->row();
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
			$date = date('Y-m-d');
			$date_check = $this->db->select('attendance_date, training_id')->where('training_id', $training_id[0])->from('training_attendance')->get()->row();
			$return = $date_check->attendance_date;
			if($date_check->attendance_date == $date){
				echo "You've already saved the attencance. Try doing it tomorrow !";
				return false;
			}else{
				$this->Trainings_model->store_attendance($data); // Send the data to the DB.
			}
		}
			$status = $this->db->select('status')->from('xin_trainings');
			$this->db->where('trg_id', $training_id[0]);
			if($status == '1')
				$this->db->update('xin_trainings', array('status' => '2'));
			elseif($status == '2')
				$this->db->update('xin_trainings', array('status' => '3'));
			elseif($status == '3')
				$this->db->update('xin_trainings', array('status' => '4'));
			else
				$this->db->update('xin_trainings', array('status' => '2'));
		// Print a success message on the screen on successful submission of data.
		$this->session->set_flashdata('success', 'Attendance submitted successfully!');
		return redirect('Trainings/all_trainings');
	}
	// Training expenses
	public function expenses($trg_id = ''){
		$data['title'] = 'Trainings | Expenses Detail';
		$data['content'] = 'training-files/training_expenses';
		$data['expenses'] = $this->Trainings_model->training_expenses($trg_id); 
		$this->load->view('training-files/components/template', $data);
	}
	// Save training expenses to payroll.
	public function save_to_payroll(){
		$expenses = 1000 + 2000 + 500;
		$data = array(
				'training_expense' => $expenses,
				);
		$ids = $this->input->post('employee');
		if(isset($_POST['employee'])){
			$this->db->where_in('user_id', $ids);
			$this->db->update('employee_expenses', $data);
			$this->session->set_flashdata('success', '<strong>Success !</strong> Expenses have been saved to payroll successfully.');
			redirect('trainings');
		}else{
			echo "Select at least one checkbox from the list below.";
		}
	}
	// Get the data you wish to show on the page.
	public function get_count_desig($desig_id = '', $status = ''){
		$data = $this->Trainings_model->get_designation_employees($desig_id, $status);
		echo json_encode($data);
	}
	// Training activity reporting.
	public function activity_reporting($trg_id){
		$data['title'] = 'Trainings | Activity Reporting';
		$data['content'] = 'training-files/activity_report';
		$this->load->view('training-files/components/template', $data);
	}
	// Save activity report to database.
	public function store_activity_report(){
		$checks = ''; // make a variable and cast an array to it.
		if(isset($_POST['checklist'])){
			$listChecked = $_POST['checklist'];
			for($i = 1; $i <= count($listChecked); $i++){
				$checks .= $listChecked[$i]. ',';
			}
		}
		$data = array(
			'trg_id' => $this->input->post('trg_id'),
			'trg_type' => $this->input->post('res_trg'),
			'staff_travel' => $this->input->post('staff'),
			'rooms' => $this->input->post('rooms'),
			'budget_amount' => $this->input->post('budget'),
			'actual_expenses' => $this->input->post('expenses'),
			'checklist' => rtrim($checks, ','),
			'chip_rep' => $this->input->post('chip_rep'),
			'unicef_rep' => $this->input->post('unicef_rep')
		);
		$this->Trainings_model->trg_activity_reporting($data);
		$this->session->set_flashdata('success', '<strong>Hooray! </strong>Activity report has been saved, you can view it at any time you want!');
		return redirect('Trainings/all_trainings');
	}
	// Get activity reports.
	public function get_activity_reporting($activity_id = ''){
		$data['reports'] = $employees = $this->Trainings_model->get_activity_report($activity_id);
		$trainees = explode(',', $employees['trainee_employees']);
		// $checklist = explode(',', $employees['checklist']);
		$trainee_names = '';
		// $chklist = '';
		$male = 0;
		$female = 0;
		for ($j = 0; $j < count($trainees); $j++ ) {
		 	$this->db->select('xin_employees.employee_id,
		 						xin_employees.first_name,
		 						xin_employees.designation_id,
		 						xin_employees.company_id,
		 						xin_designations.designation_id,
		 						xin_designations.designation_name,
		 						xin_companies.company_id,
		 						xin_companies.name,
								xin_trainings.trg_id'); // xin_employees.gender,
			$this->db->join('xin_trainings', 'xin_employees.employee_id = xin_trainings.trainee_employees', 'left');
			$this->db->join('xin_activity_reporting', 'xin_trainings.trg_id = xin_activity_reporting.trg_id', 'left');
			$this->db->join('xin_designations', 'xin_employees.designation_id = xin_designations.designation_id', 'left');
			$this->db->join('xin_companies', 'xin_employees.company_id = xin_employees.company_id', 'left');
			$rows = $this->db->get_where('xin_employees', array('xin_employees.employee_id' => $trainees[$j]))->row();

			if(@$rows->gender == "Male"){ $male++; }
			elseif(@$rows->gender == "Female"){ $female++; }
			@$trainee_names .= "<p>".$rows->designation_name."</p>";
		}
		// for($k = 0; $k < count($checklist); $k++){
		// 	$this->db->select('id, checklist_text');
		// 	$res = $this->db->get_where('activity_checklist', array('id' => $checklist[$k]))->row();
		// 	@$chklist .= "<p>".$res->checklist_text.".</p>";
		// }
		$data['male'] = $male;
		$data['female'] = $female;
		$data['trainee_names'] = $trainee_names;
		$data['title'] = 'Trainings | Activity Reporting';
		$data['content'] = 'training-files/activity_reporting';

		$this->load->view('training-files/components/template', $data);
	}
	// Events calendar, tentative six months trainings calendar. (Setup form)
	public function events_calendar($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 7;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		// $projid = $session['project_id'];
	    // $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
        // $data['sl2'] = $this->session->userdata('accessLevel');

		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('trainings/events_calendar');
		$config['total_rows'] = $this->Trainings_model->count_events();
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
		$data['title'] = 'Trainings | Events Calendar';
		$data['content'] = 'training-files/events_calendar';
		$data['projects'] = $this->Trainings_model->get_projects();
		$data['training_types'] = $this->Trainings_model->get_training_types();
		$data['locations'] = $this->Trainings_model->get_locations();
		$data['designations'] = $this->Trainings_model->get_designations();
		// if($data['sl2']){
			$data['events_list'] = $this->Trainings_model->get_events($limit, $offset);
		// }else{
			// $data['events_list'] = $this->Trainings_model->get_events($provid, $limit, $offset);
		// }
		$this->load->view('training-files/components/template', $data);
	}
	// Save events on the database.
	public function create_calendar(){
		$data = array(
			'title'	   => $this->input->post('title'),
			'province' => $this->input->post('province'),
			'district' => $this->input->post('district'),
			'project'  => $this->input->post('project'),
			'designation' => $this->input->post('designation'),
			'trg_type' => $this->input->post('trg_type'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date')
		);
		$this->Trainings_model->store_calendar($data);
		$this->session->set_flashdata('success', '<strong>Hooray !</strong> Calendar has been added successfully, now you can view it at any time !');
		return redirect('trainings/events_calendar');
	}
	// Get calendar.
	public function get_calendar()
    {
        $data = $this->db->get("events_calendar")->result();
        foreach ($data as $key => $value) {
            $data['data'][$key]['title'] = $value->title;
            $data['data'][$key]['province'] = $value->province;
            $data['data'][$key]['district'] = $value->district;
            $data['data'][$key]['project'] = $value->project;
            $data['data'][$key]['designation'] = $value->designation;
            $data['data'][$key]['trg_type'] = $value->trg_type;
            $data['data'][$key]['start'] = $value->start_date;
            $data['data'][$key]['end'] = $value->end_date;
            $data['data'][$key]['backgroundColor'] = "#00a65a";
            $data['data'][$key]['url'] = base_url('trainings/event_detail/').$value->event_id;
        }
        $data['title'] = 'Trainings | Events Calendar';
        $data['content'] = 'training-files/events_calendar_view';
        $this->load->view('training-files/components/template', $data);
    }
    // Delete an event.
    public function delete_event($event_id){
    	$this->Trainings_model->delete_event($event_id);
    	redirect('trainings/get_calendar');
    }
    // Modify an event.
    public function modify_event($event_id){
    	$data['title'] = 'Trainings | Modify Event';
    	$data['content'] = 'training-files/events_calendar';
    	$data['projects'] = $this->Trainings_model->get_projects();
		$data['training_types'] = $this->Trainings_model->get_training_types();
		$data['locations'] = $this->Trainings_model->get_locations();
		$data['designations'] = $this->Trainings_model->get_designations();
    	$data['edit'] = $this->Trainings_model->modify_event($event_id);
    	$this->load->view('training-files/components/template', $data);
    }
    // Send the udpated data back to the database.
    public function update_calendar(){
    	$event_id = $this->input->post('event_id');
    	$data = array(
    		'title'	   => $this->input->post('title'),
			'province' => $this->input->post('province'),
			'district' => $this->input->post('district'),
			'project'  => $this->input->post('project'),
			'designation' => $this->input->post('designation'),
			'trg_type' => $this->input->post('trg_type'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date')
    	);
    	$this->Trainings_model->update_event($event_id, $data);
    	$this->session->set_flashdata('success', '<strong>Success !</strong> Event has been updated successfully!');
    	return redirect('trainings/events_calendar');
    }
    // Event detail.
    public function event_detail($event_id){
    	$data['title'] = 'Trainings | Event Detail';
    	$data['content'] = 'training-files/events_calendar_view';
    	$data['event_detail'] = $this->Trainings_model->detail_event($event_id);
    	$this->load->view('training-files/components/template', $data);
    }
    // --------------------------------------------------------------------------------
    // Export to excel.
    // --------------------------------------------------------------------------------
    // Exporting Events.
    public function exportExcel(){
    	$filename = 'Events_'.date('M Y').'.csv';
    	header("Content-Description: File Transfer");
    	header("Content-Disposition: attachment; filename=$filename");
    	header("Content-Type: application/csv; "); 
		$events = $this->Trainings_model->get_events_report(); // Get data.
		$file = fopen('php://output', 'w'); // File creation
		$header = array("Event ID","Title","Province","district","Project","Designation","Trg Type","Start Date","End Date");
		fputcsv($file, $header);
		foreach ($events as $key=>$event){
			fputcsv($file, array($event['event_id'], $event['title'], $event['provName'], $event['cityName'], $event['compName'], $event['designation_name'], $event['type'], $event['start_date'], $event['end_date']));
		}
		fclose($file);
		exit;
    }
    // Exporting Trainings.
    public function export_trainings() {
		$filename = 'Trainings_'.date('M Y').'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");
		$trainings = $this->Trainings_model->get_trainings_report();
		$file = fopen('php://output', 'w');
		$header = array("Trg Type","Location","Trainers","Facilitator","Started On","Ended On","Venue","Hall Detail","Sessions","Approval Type","Announcement","Number of Trainees");
		fputcsv($file, $header);
        foreach ($trainings as $key=>$trg){
        	$trainers = $trg['first_name'].' '.$trg['last_name'].', '.$trg['trainer_two']; // Trainers
            fputcsv($file, array($trg['type'], $trg['prov_name'], $trainers, $trg['facilitator_name'], $trg['start_date'], $trg['end_date'], $trg['location'], $trg['hall_detail'], $trg['session'], $trg['approval_type'], $trg['created_at'], $trg['trainees']));
        }
        fclose($file);
        exit;
    }
}

?>