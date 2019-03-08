<?php if(! defined("BASEPATH")) exit ("No direct script access allowed!");
/* File name: Tests
* Author: Saddam
* Root folder: Controllers
* Views: test-system - test.php
*/
class Tests extends MY_Controller{
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
		$this->load->library('form_validation')
		$this->load->helper('form')
		$this->load->helper('url');
		$this->load->helper('html');
		// Load all models here to easily access them and their functions ... 
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
	public function all_questions(){
}

?>