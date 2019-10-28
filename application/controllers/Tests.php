<?php 
/* File name: Tests.php
* Author: Saddam
* Location: Controllers / Tests / Tests.php
*/
if(! defined("BASEPATH")) exit ("No direct script access allowed!");

class Tests extends MY_Controller{
	// Set JSON output 
	public function output($Return = array()){
		// Set response header ... 
		header("Access-Control-Allow-Origin");
		header("Content-Type: application/json; charset = UTF-8");
		// Final JSON response
		exit(json_encode($Return));
	}
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		// Load all models here to easily access them and their functions that are needed...
		$this->load->model('Tests_model');
		$this->load->model('Xin_model');
	}
	public function index($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!is_null($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('tests/index');
		$config['total_rows'] = $this->Tests_model->count_all_records();
		$config['per_page'] = $limit;
		$config['num_links'] = 4;
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
		$data['applicants'] = $this->Tests_model->total_applicants($limit, $offset);
		$data['jobs'] = $this->Tests_model->jobs_list_dashboard();
		$data['appeared'] = $this->Tests_model->appeared_applicants();
		$data['title'] = 'Test System | Dashboard';
		$data['content'] = 'test-system/dashboard';
		$this->load->view('test-system/components/template', $data);
	}
	// Load the question adding page...
	public function add_questions(){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$data['title'] = 'Test System| Add Questions';
		$data['projects'] = $this->Tests_model->get_projects(); // Get projects.
		$data['designations'] = $this->Tests_model->get_designations(); // Get designations.
		// Get recent questions...
		$data['recent_questions'] = $this->Tests_model->get_recent_questions();
		$data['content'] = 'test-system/create_exam';
		$this->load->view('test-system/components/template', $data);
	}
	// Adding new questions to the database and then display them to the candidate...
	public function upload(){ // Create exam.
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
			$data = array(
				'project_id' => $this->input->post('project'),
				'designation_id' => $this->input->post('designation'),
				'question' => $this->input->post('question')
			);
			$save = $this->Tests_model->create_questions($data);
			echo json_encode($save);
	}
	// Display all questions...
	public function all_questions($offset = NULL){
		$data['questions'] = $this->Tests_model->get_questions();
		$data['designations'] = $this->Tests_model->onchange(); // Get designations
		$data['projects'] = $this->Tests_model->get_projects(); // Get projects
		$data['title'] = 'Test System | All Questions';
		$data['content'] = 'test-system/all_questions';
		$this->load->view('test-system/components/template', $data);
	}
	// Get the page that shows question with the form with it to add options.
	public function add_options($id){
		$data['addopt'] = $this->Tests_model->add_choices($id);
		$data['title'] = 'Tests System | Add Answers';
		$data['content'] = 'test-system/add_answers';
		$this->load->view('test-system/components/template', $data); 
	}
	// Create answers for a question with its ID...
	public function add_answers(){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$options_array = $_POST['option'];
		$ques_id = $_POST['que_id'];
		$options_len = count($options_array);
		// $data = $this->input->post('mark');
		// Take the checkbox value and insert it into the database with the status of 1 or 0
		//$chkbox = 0;
		for($i = 0; $i < $options_len; $i++){
			$data = array(
				'q_id' => $ques_id,
				'ans_name' => $_POST['option'][$i],
				//'status' => $chkbox
			);
			// if(isset($_POST['mark1'])){ $chkbox = 1; } else { $chkbox = 0; }
			// if(isset($_POST['mark2'])){ $chkbox = 1; } else { $chkbox = 0; }
			// if(isset($_POST['mark3'])){ $chkbox = 1; } else { $chkbox = 0; }
			// if(isset($_POST['mark4'])){ $chkbox = 1; } else { $chkbox = 0; }
			// echo "<pre>"; print_r($data); exit();
			$this->Tests_model->create_answers($data);
		}
		$this->session->set_flashdata('success', '<strong>Good Job! </strong>  Anwers have been added successfully!');
		return redirect('tests/all_questions');
	}
	// View single record...
	public function view_single($id){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$data['view_one'] = $this->Tests_model->get_single($id);
		$data['title'] = 'Test System | Question Detail';
		$data['content'] = 'test-system/view_single';
		//if(!empty($session)){
			$this->load->view('test-system/components/template', $data);
		//}
	}
	// Delete a record...
	public function delete($id){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$data['delete'] = $this->Tests_model->delete_question($id);
		$this->session->set_flashdata('success', '<strong>Good Job! </strong> Question has been deleted successfully!');
		return redirect('tests/all_questions');
	}
	// Applicant login for taking exam.
	public function exam_login(){
		$this->load->view('test-system/exam_login');
	}
	// Log the applicant in to the paper.
	public function begin_exam(){
		$post_data = $this->input->post();
		$validate = $this->Tests_model->validate_applicant($post_data);
		if($validate){
			$this->session->set_userdata('rollnumber', $post_data['roll_no']);
			redirect("tests/questions_for_test/{$post_data['roll_no']}");
		} else {
			$this->session->set_flashdata('failed', '<strong>Aww snap !</strong> Looks like you have already taken the exam. <br><strong>OR</strong><br> The date you have been given for the exam is over, contact system administrator for further information.');
			redirect('tests/exam_login');
		}
	}
	// Random questions / data to display
	public function questions_for_test(){
		$session = $this->session->userdata('rollnumber');
		if(empty($session)){
			redirect('tests/exam_login');
		}
		// Get answers with the question ID stored as FK in the answers table.
		$data['questions_rand'] = $this->Tests_model->test_questions();
		// Get without join, the questions only...
		$data['qdash'] = $this->Tests_model->quest_paper();
		$data['title'] = 'Question Paper | Test System';
		$this->load->view('test-system/question_paper', $data);
	}
	// Edit records...
	public function edit($id){
		$data['edit'] = $this->Tests_model->edit_question($id);
		$data['title'] = 'Test System | Edit Question';
		$data['content'] = 'test-system/edit_question';
		$this->load->view('test-system/components/template', $data);
	}
	// Update the question that's been fetched previously ... 
	public function update_question(){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$id = $this->input->post('que_id');
		$data = array(
			'question' => $this->input->post('question')
		);
		$this->Tests_model->update_question($id, $data);
		$this->session->set_flashdata('success', '<strong>Great ! </strong> Data has been updated successfully!'); // Display a message to let the admin know that something has happend...
		return redirect('tests/all_questions'); // Redirect to main page where he left...
	}
	// Search questions ....
	public function search(){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$keyword = $this->input->get('keyword'); // Keyword is the word that's been typed in box.
		$data['results'] = $this->Tests_model->search_questions($keyword);
		$data['projects'] = $this->Tests_model->get_projects();
		$data['designations'] = $this->Tests_model->get_designations();
		$data['title'] = 'Test System | Search Results';
		$data['content'] = 'test-system/search_results';
		//if(!empty($session)){
			$this->load->view('test-system/components/template', $data);
		//}

	}
	// Function to get data changing the dropdown value..
	public function designation_wise_questions(){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$designation = $this->input->post('designation');
		$posts = array();
		$posts = $this->Tests_model->onchange();
		echo "<pre>" . json_encode($posts);
	}
	// Change select option to change data in the HTML table.
	public function changeData($designation_id){
		$result= $this->Tests_model->desig_questions($designation_id);
		echo json_encode($result);
	}
	// Change designations with the changing of project in the list.
	public function changeDesignation($project_id){
		$projects = $this->Tests_model->project_questions($project_id);
		echo json_encode($projects);
	}
	// Get project's designations for creating exam.
	public function create_exam_form($proj_id){
		$desig_list = $this->Tests_model->get_pro_designations($proj_id);
		echo json_encode($desig_list);
	}
	// Count the correct answers and return the total score.
	public function applicant_result(){ // Send the applicant's ID to check result.
		$appli_id = $this->input->post('roll');
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$project = $this->input->post('project');
		$designation = $this->input->post('designation');
		$name = $this->input->post('applicant_name');
		$job_id = $this->input->post('job');
		$data['projects'] = $this->Tests_model->get_projects();
		$data['designations'] = $this->Tests_model->get_designations();
		$data['jobs'] = $this->Tests_model->get_jobs();
		$data['title'] = 'Test System | Applicant Result';
		$data['content'] = 'test-system/results';
		$data['calc_result'] = $this->Tests_model->count_applicants($appli_id, $date_from, $date_to, $designation, $name, $job_id, $project);
		$this->load->view('test-system/components/template', $data);
	}
	// Submit tests taken by applicants to the database. (tbl_name: ex_applicants).
	public function applicants_test(){
		$question_id = $_POST['question_id'];
		$answers = $_POST['answer'];
		$applicant_id = $_POST['applicant_id']; // Send the applicant ID with the exam.
		$length = count($answers);
		$length = count($question_id);
		for($j = 0; $j < $length; $j++){
			$data = array(
			'question_id' => $_POST['question_id'][$j],
			'answer_id'   => $_POST['answer'][$j],
			'applicant_id' => $_POST['applicant_id']
			);
				$this->Tests_model->submit_paper($data);
		}
		// Check the applicant's id twice, so that there's no chance of duplicate entry.
		$exists = $this->db->get_where('test_result', array('rollnumber' => $applicant_id));
		if($exists->num_rows() > 0){
			echo "You've already taken the exam. Try applying next time !";
			// $this->db->select('exam_date')->from('ex_applicants')->get()->result();
			// $this->db->where(array('exam_date' => date('Y-m-d'), 'applicant_id' => $applicant_id));
			// $this->db->delete('ex_applicants');
			return FALSE;
		}else{
			$query = $this->db->query('INSERT INTO test_result(rollnumber, obtain_marks, total_marks) SELECT '.$applicant_id.', COUNT(ex_applicants.applicant_id) AS marks, 50 FROM ex_applicants JOIN ex_answers ON ex_applicants.answer_id = ex_answers.ans_id AND ex_answers.status = 1 WHERE ex_applicants.applicant_id = '.$applicant_id.'');
		}
		$this->session->set_flashdata('success', '<strong>Congratulations! </strong> Your test has been submitted successfully! You will be informed about the result shortly !');
		redirect('tests/test_submitted');
	}
	// Redirect the user to the test submitted page, where he can check his/her result, marks, failed/passed and more...
	public function test_submitted(){
		// $data['title'] = 'Test System | Test Submitted';
		// $data['content'] = 'test-system/test_submitted';
		$this->session->sess_destroy();
		$this->load->view('test-system/test_submitted');
	}
	// Modify answers / options for the questions. Display the data in the form...
	public function edit_answer($id){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	recirect('');
		// }
		$data['title'] = 'Test System | Edit Answer';
		$data['content'] = 'test-system/edit_answer';
		$data['answers_edit'] = $this->Tests_model->get_ans_for_edit($id);
		$this->load->view('test-system/components/template', $data);
	}
	// Update the answer.
	public function update_answer(){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$ans_id = $this->input->post('answer_id'); // Send the ans_id in the hidden field.
		$data = array(
			'q_id' => $this->input->post('question_id'),
			'ans_name' => $this->input->post('answer'),
			'status' => $this->input->post('status')
		);
		$this->Tests_model->update_answers($ans_id, $data);
		$this->session->set_flashdata('success', '<strong>Nice Job! </strong> Answer has been updated successfully!'); // Display a message on success.
		return redirect("tests/view_single/{$_POST['question_id']}"); // Page redirection.
	}
	// Delete the answer.
	public function delete_answer($ans_id){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$data['delete'] = $this->Tests_model->delete_answers($ans_id);
		$this->session->set_flashdata('success', '<strong>Good Job! </strong> Answer has been deleted!');
		return redirect('tests/all_questions');
	}
	// View applicants' results.
	public function results(){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$data['jobs'] = $this->Tests_model->get_jobs();
		$data['projects'] = $this->Tests_model->get_projects();
		$data['designations'] = $this->Tests_model->get_designations();
		$data['title'] = 'Test System | Applicant\'s results';
		$data['content'] = 'test-system/results';
		$this->load->view('test-system/components/template', $data);
	}
	// Search criteria, search applicants' result through multiple inputs/dropdowns.
	public function multi_search($project_id, $designation_id, $job_id, $appl_name, $roll_no, $by_date){ // Pass these vars as arguments in this function.
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		echo "This is multiple search facility";
	}
	// Get all the applicants who took the exam/test.
	public function applicants($offset = NULL){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		// Pagination
		$limit = 9;
		if(!is_null($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('tests/applicants');
		$config['total_rows'] = $this->Tests_model->count_all_records();
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
		$data['all_applicants'] = $this->Tests_model->total_applicants($limit, $offset);
		$data['title'] = 'Test System | All Applicants';
		$data['content'] = 'test-system/applicants';
		$this->load->view('test-system/components/template', $data);
	}
	// Projects
	public function projects($offset = NULL){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$limit = 9;
		if(!is_null($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('tests/projects');
		$config['total_rows'] = $this->Tests_model->count_all_projects();
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
		$data['title'] = 'Test System | Projects';
		$data['content'] = 'test-system/projects';
		$data['projects_list'] = $this->Tests_model->projects_list($limit, $offset);
		$this->load->view('test-system/components/template', $data);
	}
	// Jobs list ... 
	public function jobs($offset = NULL){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$limit = 9;
		if(!is_null($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('tests/jobs');
		$config['total_rows'] = $this->Tests_model->count_all_jobs();
		$config['per_page'] = $limit;
		$config['num_links'] = 9;
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
		$data['title'] = 'Test System | Jobs';
		$data['content'] = 'test-system/jobs';
		$data['jobs_list'] = $this->Tests_model->jobs_list($limit, $offset);
		$this->load->view('test-system/components/template', $data);
	}
	// Total appeared applicants.
	public function total_appeared($offset = NULL){
		$limit = 9;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('tests/total_appeared');
		$config['total_rows'] = $this->Tests_model->count_all_appeared();
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
		$data['title'] = 'Test System | Appeared Applicants';
		$data['content'] = 'test-system/appeared';
		$data['appeared_list'] = $this->Tests_model->all_appeared($limit, $offset);
		$this->load->view('test-system/components/template', $data);
	}
	// Projects search
	public function project_search(){
		$project = $this->input->get('search_project');
		$data['results'] = $this->Tests_model->search_projects($project);
		$data['title'] = 'Test System | Projects Search';
		$data['content'] = 'test-system/projects';
		$this->load->view('test-system/components/template', $data);
	}
	// Applicants search
	public function applicant_search(){
		$applicant = $this->input->get('search_applicant');
		$data['results'] = $this->Tests_model->search_applicants($applicant);
		$data['title'] = 'Test System | Applicants Search';
		$data['content'] = 'test-system/applicants';
		$this->load->view('test-system/components/template', $data);
	}
	// Jobs search
	public function job_search(){
		$job = $this->input->get('search_job');
		$data['results'] = $this->Tests_model->search_jobs($job);
		$data['title'] = 'Test System | Jobs Search';
		$data['content'] = 'test-system/jobs';
		$this->load->view('test-system/components/template', $data);
	}
	// Appeared applicants search
	public function appeared_search(){
		$appeared = $this->input->get('search_appeared');
		$data['results'] = $this->Tests_model->search_appeared($appeared);
		$data['title'] = 'Test System | Appeared Applicants Search';
		$data['content'] = 'test-system/appeared';
		$this->load->view('test-system/components/template', $data);
	}
	// Project detail, view single project with its ID.
	public function detail_project($proj_id){
		$data['project_detail'] = $this->Tests_model->project_detail($proj_id);
		$data['title'] = 'Test System | Project Detail';
		$data['content'] = 'test-system/projects';
		$this->load->view('test-system/components/template', $data);
	}
	// Applicant detail, view single applicant by ID.
	public function detail_applicant($applicant_id){
		$data['applicant_detail'] = $this->Tests_model->applicant_detail($applicant_id);
		$data['title'] = 'Test System | Applicant Detail';
		$data['content'] = 'test-system/applicants';
		$this->load->view('test-system/components/template', $data);
	}
	// Job detail, view single job by ID.
	public function detail_job($job_id){
		$data['job_detail'] = $this->Tests_model->job_detail($job_id);
		$data['title'] = 'Job Detail';
		$data['content'] = 'test-system/jobs';
		$this->load->view('test-system/components/template', $data);
	}
	// Reports
	public function reports(){
		// $session = $this->session->userdata('username');
		// if(empty($session)){
		// 	redirect('');
		// }
		$data['jobs'] = $this->Tests_model->get_jobs();
		$data['projects'] = $this->Tests_model->get_projects();
		$data['designations'] = $this->Tests_model->get_designations();
		$data['title'] = 'Test System | Reports';
		$data['content'] = 'test-system/reports';
		$this->load->view('test-system/components/template', $data);
	}
	// Generate report, perform the form action on this function.
	public function generate_by_date(){
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$job_id = $this->input->post('job_id');
		$project = $this->input->post('project');
		$designation = $this->input->post('designation');
		$data['report_gen'] = $this->Tests_model->applicants_report($date_from, $date_to, $job_id, $project, $designation);
		$data['projects'] = $this->Tests_model->get_projects();
		$data['designations'] = $this->Tests_model->get_designations();
		$data['jobs'] = $this->Tests_model->get_jobs();
		$data['title'] = 'Test System | Reports';
		$data['content'] = 'test-system/reports';
		$this->load->view('test-system/components/template', $data);
	}
	// -------------------------- Add result, create and view paper ----------------------------- //
	public function get_rollnumber($rollnumber){
		// $rollnumber = $this->input->post('applicant_rollnumber');
		$data = $this->Tests_model->get_rollnumber_detail($rollnumber);
		echo json_encode($data);
	}
	// Add result manually.
	public function add_result(){
		$data['title'] = 'Test System | Add Result';
		$data['content'] = 'test-system/result_card';
		$this->load->view('test-system/components/template', $data);
	}
	// Save result for the applicant who can't take the exam online.
	public function save_result(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('applicant_rollnumber', 'Applicant Roll Number', 'required|numeric');
		$this->form_validation->set_rules('marks_obtained', 'Marks Obtained', 'required|numeric|max_length[2]');
		$this->form_validation->set_rules('total_marks', 'Total Marks', 'required|numeric');
		if($this->form_validation->run() == FALSE){
			$this->add_result();
		}else{
			$data = array(
				'rollnumber' => $this->input->post('applicant_rollnumber'),
				'obtain_marks' => $this->input->post('marks_obtained'),
				'total_marks' => $this->input->post('total_marks')
			);
			var_dump($data); exit;
			$this->Tests_model->add_result($data);
			$this->session->set_flashdata('success', '<strong>Success !</strong> Result has been saved successfully');
			redirect('tests/total_appeared');
		}
	}
	// Create paper for exam/post.
	public function create_paper(){
		$data['title'] = 'Test System | Create Paper';
		$data['content'] = 'test-system/create_paper';
		$data['projects'] = $this->Tests_model->get_projects();
		$data['designations'] = $this->Tests_model->get_designations();
		$this->load->view('test-system/components/template', $data);
	}
	// Get all the questions on the page to select from them.
	public function get_paper(){
		$project = $this->input->post('project');
		$designation = $this->input->post('designation');
		$data['title'] = 'Test System | Select Questions';
		$data['content'] = 'test-system/create_paper';
		$data['projects'] = $this->Tests_model->get_projects();
		$data['designations'] = $this->Tests_model->get_designations();
		$data['jobs'] = $this->Tests_model->get_jobs();
		$data['list_questions'] = $this->Tests_model->get_for_paper($project, $designation);
		$this->load->view('test-system/components/template', $data);
	}
	// Save paper into the database.
	public function save_paper(){
		$question = $_POST['question'];
		$marks = $_POST['marks'];
		$q_lenght = count($question);
		$q_lenght = count($marks);
		for($i = 0; $i < $q_lenght; $i++){
			$data = array(
				'que_id' => $_POST['question'][$i],
				'project_id' => $_POST['project'],
				'designation_id' => $_POST['designation'],
				'job_id' => $_POST['job_id'],
				'marks' => $_POST['marks'][$i],
				'created_at' => date('Y-m-d')
			);
			$this->Tests_model->create_paper($data);
		}
		$this->session->set_flashdata('success', '<strong>Success !</strong> Paper has been created successfully!');
		redirect('tests/create_paper');
	}
	// View paper pattern.
	public function paper($job_id){
		$data['title'] = 'Test System | Question Paper';
		$data['content'] = 'test-system/paper_pattern';
		$data['qdash'] = $this->Tests_model->question_paper($job_id);
		$data['questions_rand'] = $this->Tests_model->get_paper_pattern();
		$this->load->view('test-system/components/template', $data);
	}
	// Paper detail, click on a job title and view the paper.
	public function list_papers($offset = NULL){
		$limit = 20;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('tests/list_papers');
		$config['total_rows'] = $this->Tests_model->count_jobs();
		$config['per_page'] = $limit;
		$config['num_links'] = 10;
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
		$data['papers'] = $this->Tests_model->get_jobs_papers($limit, $offset);
		$data['title'] = 'Test System | Papers List';
		$data['content'] = 'test-system/papers_list';
		$this->load->view('test-system/components/template', $data);
	}
}

?>