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
		// Load all models here to easily access them and their functions that you need...
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
		$data['designations'] = $this->Tests_model->onchange();
		$data['title'] = $this->Xin_model->site_title();
		$data['breadcrumbs'] = $this->lang->line('xin_tests');
		$data['path_url'] = 'questions_list';
		if(!empty($session)){
			$data['subview'] = $this->load->view('test-system/questions_list', $data, TRUE);
			$this->load->view('layout_main', $data); // Page Load 
		}
	}
	// Get the page that shows question with the form with it ...
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
		$chkbox = 0;
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
		// echo "<pre>"; print_r($data); exit();
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
		// var_dump($id); exit();
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$data['delete'] = $this->Tests_model->delete_question($id);
		$this->session->set_flashdata('success', '<strong>Good Job! </strong> Question has been deleted successfully!');
		// return redirect('tests/all_questions');
		return redirect('tests/all_questions');
	}
	// Random questions / data to display
	public function questions_for_test(){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$this->load->library('pagination');
		$config['base_url'] = base_url('tests/questions_for_test/');
		$config['total_rows'] = count($this->Tests_model->test_questions());
		$config['per_page'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&laquo;';
		$config['next_link'] = '&raquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
		$config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$data['questions_rand'] = $this->Tests_model->test_questions($config['per_page'], $this->uri->segment(3));
		// echo "<pre>";
		// var_dump($data); exit;
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
		// echo "<pre>"; print_r($data); exit();
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
		$keyword = $this->input->get('keyword');
		$data['results'] = $this->Tests_model->search_questions($keyword);
		// echo "<pre>"; print_r($data); exit();
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
	// Count the correct answers and return the total score.
	public function applicant_result(){
		$data = $this->Tests_model->count_uploads();
		echo "You scored <strong style='color: red;'>" . $data . "</strong> out of <strong style='color: red;'> 50</strong>. So you're considered fail, better luck next time !";
	}
}

?>