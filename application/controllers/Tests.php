<?php 
/* File name: Tests.php
* Author: Saddam
* Location: Controllers / Tests / Tests.php
* -------------------------------------------------------------------------------------------------
* All the code for the test system written here in this controller, add, edit, update, delete       * questions and answers, submit test, show result card, marks, failed or passed message to applicant.
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
	public function index(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['projects'] = $this->Tests_model->get_projects(); // Get projects.
		$data['designations'] = $this->Tests_model->get_designations(); // Get designations.
		$data['path_url'] = 'test';
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/test', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load
		} else {
			redirect('');
		}
	}
	// Code from another file ... 
	// Adding new questions to the database and then display them to the candidate...
	public function upload(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$this->form_validation->set_rules('project', 'Project', 'trim|required');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('question', 'Question', 'trim|required');
			if($this->form_validation->run() == FALSE){
				$data['title'] = $this->Xin_model->site_title();
				$data['breadcrumbs'] = $this->lang->line('xin_tests');
				$data['projects'] = $this->Tests_model->get_projects(); // Get projects.
				$data['designations'] = $this->Tests_model->get_designations(); // Get designations.
				$data['path_url'] = 'test';
				if(!empty($session)){
					$data['subview'] = $this->load->view('test-system/test', $data, TRUE);
					$this->load->view('layout_main', $data); // Page Load ...
				}
				echo "<strong style='color: red; background: yellow;'>Aww snap! </strong> Looks like you missed the required fields, go back & fill them !";
				//$this->load->view('components/template', $data);
			} else {
			$data = array(
				'project_id' => $this->input->post('project'),
				'designation_id' => $this->input->post('designation'),
				'question' => $this->input->post('question')
			);
			$save = $this->Tests_model->create_questions($data);
			echo json_encode($save);
		}
	}
	// Display all questions...
	public function all_questions($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$total_questions = count($this->Tests_model->get_questions());
		$limit = 5;
		if(!is_null($offset)){
			$offset = $this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['base_url'] = base_url(). 'tests/all_questions/';
		$config['total_rows'] = $total_questions;
		$config['per_page'] = $limit;
		$this->pagination->initialize($config);
		$data['questions'] = $this->Tests_model->get_questions($config['per_page'], $this->uri->segment(3));
		$data['designations'] = $this->Tests_model->onchange(); // Get designations
		$data['projects'] = $this->Tests_model->get_projects(); // Get projects
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'questions_list';
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/questions_list', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load 
		}
	}
	// Get the page that shows question with the form with it to add options.
	public function add_options($id){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$data['addopt'] = $this->Tests_model->add_choices($id);
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'add_options'; 
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/add_options', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load
		}
	}
	// Create answers for a question with its ID...
	public function add_answers(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
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
		$this->session->set_flashdata('success', '<strong>Good Job! </strong>  Options have been added successfully!');
		return redirect('tests/all_questions');
	}
	// View single record...
	public function view_single($id){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$data['view_one'] = $this->Tests_model->get_single($id);
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'single_record';
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/view_single', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load.
		}
	}
	// Delete a record...
	public function delete($id){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$data['delete'] = $this->Tests_model->delete_question($id);
		$this->session->set_flashdata('success', '<strong>Good Job! </strong> Question has been deleted successfully!');
		return redirect('tests/all_questions');
	}
	// Random questions / data to display
	public function questions_for_test(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		// Get answers with the question ID stored as FK in the answers table.
		$data['questions_rand'] = $this->Tests_model->test_questions();
		// Get without join, the questions only...
		$data['qdash'] = $this->Tests_model->quest_paper();
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'question_paper';
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/question_paper', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load ... 
		}
	}
	// Edit records...
	public function edit($id){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$data['edit'] = $this->Tests_model->edit_question($id);
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'edit_question';
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/edit_question', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load
		}
	}
	// Update the question that's been fetched previously ... 
	public function update_question(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
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
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$keyword = $this->input->get('keyword'); // Keyword is the word that's been typed in box.
		$data['results'] = $this->Tests_model->search_questions($keyword);
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'search_results';
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/search_results', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load ... 
		}

	}
	// Function to get data changing the dropdown value..
	public function designation_wise_questions(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
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
	// Count the correct answers and return the total score.
	public function applicant_result($app_id){ // Send the applicant's ID to check result.
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'result_card';
		$data['calc_result'] = $this->Tests_model->count_uploads($app_id); // Added ID Here ... 
		$data['subview'] = $this->load->view('test-system/result_card', $data, TRUE);
		$this->load->view('layout_main', $data); // Page Load ... 
	}
	// Submit tests taken by applicants to the database. (tbl_name: ex_applicants).
	public function applicants_test(){ // No need for ID, just send the test to the database.
		$question_id = $_POST['question_id'];
		$answers = $_POST['answer'];
		$length = count($answers);
		$length = count($question_id);
		for($j = 0; $j < $length; $j++){
			$data = array(
			'question_id' => $_POST['question_id'][$j],
			'answer_id'   => $_POST['answer'][$j]
			);
			$this->Tests_model->submit_paper($data);
		}
		$this->session->set_flashdata('success', '<strong>Congratulations! </strong> Your test has been submitted successfully! click the buttons below to perform those actions !');
		redirect('tests/test_submitted');
	}
	// Redirect the user to the test submitted page, where he can check his/her result, marks, failed/passed and more...
	public function test_submitted(){
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'test_submitted';
		$data['subview'] = $this->load->view('test-system/test_submitted', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load ...
	}
	// Modify answers / options for the questions. Display the data in the form...
	public function edit_answer($id){
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'edit_answer';
		$data['answers_edit'] = $this->Tests_model->get_ans_for_edit($id);
		$data['subview'] = $this->load->view('test-system/edit_answer', $data, TRUE);
		$this->load->view('layout_main', $data); // Page Load... 
	}
	// Update the answer.
	public function update_answer(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$ans_id = $this->input->post('answer_id'); // Send the ans_id in the hidden field.
		$data = array(
			'q_id' => $this->input->post('question_id'),
			'ans_name' => $this->input->post('answer'),
			'status' => $this->input->post('status')
		);
		$this->Tests_model->update_answers($ans_id, $data);
		$this->session->set_flashdata('success', '<strong>Nice Job! </strong> Answer has been updated successfully!'); // Display a message on success.
		return redirect('tests/all_questions'); // Page redirection.
	}
	// Delete the answer.
	public function delete_answer($ans_id){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$data['delete'] = $this->Tests_model->delete_answers($ans_id);
		$this->session->set_flashdata('success', '<strong>Good Job! </strong> Answer has been deleted!');
		return redirect('tests/all_questions');
	}
	// AJAX instant search 
	public function search_results(){
		$keyword = $this->input->post('keyword');
		if(!empty($keyword)){
			$this->db->like('question', $keyword);
		}
		$this->db->select('*');
		$this->db->from('ex_questions');
		$search = $this->db->get();
		$result = $search->result();
		echo "<table class='table table-hover'>
		<tr>
			<th class='any'>Serial</th>
			<th class='any'>Question</th>
			<th class='any'>Action</th>
		</tr>";
		$serial = 1; foreach($result as $single) :
		echo "<tr>
				<td class='para'>'.$serial.'</td>
				<td class='para'>'.$single->question'.</td></tr>";
		$serial++; endforeach;
		echo "<table>";
	}
}

?>