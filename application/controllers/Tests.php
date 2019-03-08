<?php 
/* File name: Tests.php
* Author: Saddam
* Location: Controllers / Tests
* Views: test-system - test.php
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
		// Load all models here to easily access them and their functions ...
		$this->load->model('Tests_model');
		$this->load->model('Xin_model');
		$this->load->model('Employees_model');
		$this->load->model('Finance_model');
		$this->load->model('Expense_model');
	}
	public function index(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
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
		$this->form_validation->set_rules('question', "Question", 'required');
			if($this->form_validation->run() == FALSE){
				$data['title'] = $this->Xin_model->site_title();
				$data['breadcrumbs'] = $this->lang->line('xin_tests');
				$data['path_url'] = 'test';
				if(!empty($session)){
					$data['subview'] = $this->load->view('test-system/test', $data, TRUE);
					$this->load->view('layout_main', $data); // Page Load ...
				}
				echo "Nothing here !";
				//$this->load->view('components/template', $data);
			} else {
			$data = array(
				'question' => $this->input->post('question')
			);
			$this->Tests_model->create_questions($data);
			$this->session->set_flashdata('success', '<strong>Good Job !</strong> Question has been uploaded successfully! Now you can add possible answers too.');
			return redirect('tests/all_questions');
		}
	}
	// Display all questions...
	public function all_questions(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		// $this->load->library('pagination');
		// $cofig['base_url'] = base_url('tests/all_questions');
		// $config['total_rows'] = 200;
		// $config['per_page'] = 2;
		// $this->pagination->initialize($config);
		$data['questions'] = $this->Tests_model->get_questions();
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'questions_list';
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/questions_list', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load 
		}
	}
	// Add options for the question...
	public function addoptions($id){
		$data['addopt'] = $this->Tests_model->get_row('ex_questions', $id);
		$data['title'] = 'Online Exam | Add Options';
		$data['body'] = 'addoptions';
		$this->load->view('components/template', $data);
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
		var_dump($id); exit();
		$data['delete'] = $this->test_model->delete_data('ex_questions', $id);
		$this->session->set_flashdata('msg', 'Question has been deleted successfully!');
		return redirect('test/allquestions');
	}
}

?>