<?php 

 /**

 * NOTICE OF LICENSE

 *

 * This source file is subject to the CTC License

 * that is bundled with this package in the file license.txt.

 * It is also available through the world-wide-web at this URL:

 * http://www.ctc.org.pk/license.txt

 * If you did not receive a copy of the license and are unable to

 * obtain it through the world-wide-web, please send an email

 * to pm_developer@yahoo.com so we can send you a copy immediately.

 *

 * DISCLAIMER

 *

 * Do not edit or add to this file if you wish to upgrade this extension to newer

 * versions in the future. If you wish to customize this extension for your

 * needs please contact us at pm_developer@yahoo.com for more information.

 *

 * @package  Ayat Ullah Khan@CTC - interview

 * @copyright  Copyright © ctc.org.pk. All Rights Reserved

 * @edited by: Saddam

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Interview extends MY_Controller {

	

	public function __construct()

     {

          parent::__construct();

          $this->load->library('session');

          $this->load->helper('form');

          $this->load->helper('url');

          $this->load->helper('html');

          $this->load->database();

          $this->load->library('form_validation');

          //load the models

          $this->load->model('Login_model');

		  $this->load->model('Designation_model');

		  $this->load->model('Department_model');

		  $this->load->model('Employees_model');

		  $this->load->model('Xin_model');

		  $this->load->model('Expense_model');

		  $this->load->model('Timesheet_model');

		  $this->load->model('Job_post_model');

		  $this->load->model('Project_model');

		  $this->load->model('Awards_model');

		  $this->load->model('Announcement_model');

		  $this->load->model('Interview_model');

$this->load->model('job_longlisted_model'); // load model


     }

	

	/*Function to set JSON output*/

	public function output($Return=array()){

		/*Set response header*/

		header("Access-Control-Allow-Origin: *");

		header("Content-Type: application/json; charset=UTF-8");

		/*Final JSON response*/

		exit(json_encode($Return));

	} 

	

	public function index($offset = NULL)

	{

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		// Pagination.
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('interview/index');
		$config['total_rows'] = $this->Interview_model->count_completed();
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

		// get user > added by

		$user = $this->Xin_model->read_user_info($session['user_id']);

		// get designation

		$_designation = $this->Designation_model->read_designation_information($user[0]->designation_id);

		$all_interviews = $this->Interview_model->interview_information();

		/*$data = array(

			'title' => $this->Xin_model->site_title(),

			'breadcrumbs' => $this->lang->line('interview_title'),

			'path_url' => 'interview',

			'first_name' => $user[0]->first_name,

			'last_name' => $user[0]->last_name,

			'employee_id' => $user[0]->employee_id,

			'username' => $user[0]->username,

			'email' => $user[0]->email,

			'designation_name' => $_designation[0]->designation_name,

			'date_of_birth' => $user[0]->date_of_birth,

			'date_of_joining' => $user[0]->date_of_joining,

			'contact_no' => $user[0]->contact_no,

			'last_four_employees' => $this->Xin_model->last_four_employees(),

			//'all_interviews' => $this->Interview_model->interview_information(),

			'last_jobs' => $this->Xin_model->last_jobs()

			);*/

			$data['all_interviews']=$this->Interview_model->scheduled_interviews();

			$data['completed_interviews']=$this->Interview_model->completed_interviews($limit, $offset);

			$data['overdue_interviews'] = $this->Interview_model->overdue_interviews();

			$data['subview'] = $this->load->view('interviews/interview', $data, TRUE);

			$this->load->view('layout_main', $data); //page load

	}
	// View all scheduled interviews.
	public function list_scheduled($offset = NULL){
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		// Pagination
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('interview/list_scheduled');
		$config['total_rows'] = $this->Interview_model->count_scheduled();
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
		$data['all_scheduled'] = $this->Interview_model->all_scheduled($limit, $offset);
		$data['subview'] = $this->load->view('interviews/scheduled_list', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// View all completed interviews.
	public function list_completed($offset = NULL){
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		// Pagination
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('interview/list_completed');
		$config['total_rows'] = $this->Interview_model->count_completed();
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
		$data['all_completed'] = $this->Interview_model->completed_interviews($limit, $offset);
		$data['subview'] = $this->load->view('interviews/completed_list', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// View all overdue interviews.
	public function list_overdue($offset = NULL){
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		// Pagination
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('interview/list_overdue');
		$config['total_rows'] = $this->Interview_model->count_overdue();
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
		$data['all_overdue'] = $this->Interview_model->all_overdue($limit, $offset);
		$data['subview'] = $this->load->view('interviews/overdue_list', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// Search in scheduled interviews.
	public function search_scheduled(){
		$rollno = $this->input->get('rollno');
		$name = $this->input->get('name');
		$project = $this->input->get('project');
		$designation = $this->input->get('designation');
		$province = $this->input->get('province');
		$district = $this->input->get('district');
		$data['search_results'] = $this->Interview_model->scheduled_search($rollno, $name, $project, $designation, $province, $district);
		$data['subview'] = $this->load->view('interviews/scheduled_list', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// Search in completed interviews.
	public function search_completed(){
		$rollno = $this->input->get('rollno');
		$name = $this->input->get('name');
		$project = $this->input->get('project');
		$designation = $this->input->get('designation');
		$province = $this->input->get('province');
		$district = $this->input->get('district');
		$data['search_results'] = $this->Interview_model->completed_search($rollno, $name, $project, $designation, $province, $district);
		$data['subview'] = $this->load->view('interviews/completed_list', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// Search in overdue interviews.
	public function search_overdue(){
		$rollno = $this->input->get('rollno');
		$name = $this->input->get('name');
		$project = $this->input->get('project');
		$designation = $this->input->get('designation');
		$province = $this->input->get('province');
		$district = $this->input->get('district');
		$data['search_results'] = $this->Interview_model->overdue_search($rollno, $name, $project, $designation, $province, $district);
		$data['subview'] = $this->load->view('interviews/overdue_list', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// Re-schedule an interview.
	public function re_schedule(){
		$rollnumber = $this->input->post('rollnumber');
		$data = array(
			'interview_date' => $this->input->post('interview_date')
		);
		$this->Interview_model->re_schedule($rollnumber, $data);
		$this->session->set_flashdata('success', '<strong>Success !</strong> The Interview has been Re-scheduled.');
		redirect('interview');
	}
	// Delete an interview.
	public function delete_interview($rollnumber){
		if($this->Interview_model->delete_interview($rollnumber)){
			$this->session->set_flashdata('success', '<strong>Deleted !</strong> The interview has been deleted !');
			redirect('interview');
		}else{
			echo "The operation wasn't successfull !";
		}
	}
	// Add marks manually.
	public function add_marks(){
		$data['path_url'] = 'interview_marks';
		$data['subview'] = $this->load->view('interviews/interview_marks', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// Get applicant's detail by rollnumber.
	public function get_rollnumber($rollnumber){
		$data = $this->Interview_model->get_rollnumber_detail($rollnumber);
		echo json_encode($data);
	}
	// Save interview marks.
	public function save_marks(){
		$this->form_validation->set_rules('applicant_rollnumber', 'Applicant Roll number', 'trim|required');
		$this->form_validation->set_rules('marks_obtained', 'Marks Obtained', 'required|numeric|max_length[2]');
		$this->form_validation->set_rules('total_marks', 'Total Marks', 'required|numeric');
		if($this->form_validation->run() == FALSE){
			$this->add_marks();
		}else{
			$data = array(
				'rollnumber' => $this->input->post('applicant_rollnumber'),
				'obtain_marks' => $this->input->post('marks_obtained'),
				'total_marks' => $this->input->post('total_marks')
			);
			$this->Interview_model->save_marks($data);
			$this->session->set_flashdata('success', '<strong>Success !</strong> Interview marks have been saved successfully!');
			redirect('interview');
		}
	}
	// Interview form for SM/UCCSO.
	public function form_sm($rollnumber){
		$data['path_url'] = '';
		$data['applicant_detail'] = $this->Interview_model->applicant_detail($rollnumber);
		$data['subview'] = $this->load->view('interviews/sm_interview_form', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// Save SM Interview result.
	public function sm_interview(){
		$q1 = $this->input->post('per_marks');
		$q2 = $this->input->post('qual_marks');
		$q3 = $this->input->post('exp_marks');
		$q4 = $this->input->post('job_marks');
		$q5 = $this->input->post('sup_marks');
		$q6 = $this->input->post('rep_marks');
		$q7 = $this->input->post('mob_marks');
		$q8 = $this->input->post('comm_marks');
		$obtained = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8;
		$data = array(
			'rollnumber' => $this->input->post('rollnumber'),
			'obtain_marks' => $obtained,
			'total_marks' => 50,
			'remark1' => $this->input->post('per_remarks'),
			'remark2' => $this->input->post('qual_remarks'),
			'remark3' => $this->input->post('exp_remarks'),
			'remark4' => $this->input->post('job_remarks'),
			'remark5' => $this->input->post('sup_remarks'),
			'remark6' => $this->input->post('rep_remarks'),
			'remark7' => $this->input->post('mob_remarks'),
			'remark8' => $this->input->post('comm_remarks'),
			'remark10' => $this->input->post('overall_remarks')
		);
		$exists = $this->db->get_where('interview_result', array('rollnumber' => $_POST['rollnumber']))->row();
		if(!empty($exists)){
			$rollnumber = $this->input->post('rollnumber');
			$add_obtained = $obtained + $exists->obtain_marks;
			$add_total = $exists->total_marks + 50;
			$data2 = array(
				'obtain_marks' => $add_obtained,
				'total_marks' => $add_total
				);
			$this->Interview_model->update_sm_interview($rollnumber, $data2);
			$this->session->set_flashdata('success', '<strong>Success !</strong> Interview marks have been udpated successfully.');
			redirect('interview');
		}elseif($this->Interview_model->save_sm_interview($data)){
			$this->session->set_flashdata('success', '<strong>Success !</strong> The interview result has been saved successfully');
			redirect('interview');
		}else{
			echo "The operation wasn't successful! try again.";
		}
	}
	// Interview form for DHCSO.
	public function form_dhcso($rollnumber){
		$data['path_url'] = '';
		$data['applicant_detail'] = $this->Interview_model->applicant_detail($rollnumber);
		$data['subview'] = $this->load->view('interviews/dhcso_interview_form', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// Save DHCSO interview.
	public function dhcso_interview(){
		$q1 = $this->input->post('per_marks');
		$q2 = $this->input->post('con_marks');
		$q3 = $this->input->post('qual_marks');
		$q4 = $this->input->post('exp_marks');
		$q5 = $this->input->post('comp_marks');
		$q6 = $this->input->post('job_marks');
		$q7 = $this->input->post('prof_marks');
		$q8 = $this->input->post('attrib_marks');
		$q9 = $this->input->post('comm_marks');
		$obtained = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9;
		$data = array(
			'rollnumber' => $this->input->post('rollnumber'),
			'obtain_marks' => $obtained,
			'total_marks' => 50,
			'remark1' => $this->input->post('per_remarks'),
			'remark2' => $this->input->post('con_remarks'),
			'remark3' => $this->input->post('qual_remarks'),
			'remark4' => $this->input->post('exp_remarks'),
			'remark5' => $this->input->post('comp_remarks'),
			'remark6' => $this->input->post('job_remarks'),
			'remark7' => $this->input->post('prof_remarks'),
			'remark8' => $this->input->post('attrib_remarks'),
			'remark9' => $this->input->post('comm_remarks'),
			'remark10' => $this->input->post('overall_remarks')
		);
		$exists = $this->db->get_where('interview_result', array('rollnumber' => $_POST['rollnumber']))->row();
		if(!empty($exists)){
			$rollnumber = $this->input->post('rollnumber');
			$add_obtained = $obtained + $exists->obtain_marks;
			$add_total = $exists->total_marks + 50;
			$data1 = array(
				'obtain_marks' => $add_obtained,
				'total_marks' => $add_total
				);
			$this->Interview_model->update_dhcso_interview($rollnumber, $data1);
			$this->session->set_flashdata('success', '<strong>Success !</strong> Interview marks have been updated successfully.');
			redirect('interview');
		}elseif($this->Interview_model->save_dhcso_interview($data)){
			$this->session->set_flashdata('success', '<strong>Success !</strong> The interview result has been submitted successfully.');
			redirect('interview');
		}else{
			echo "The operation wasn't successful! try again.";
		}
	}
	// Interview form for FCM/CHW.
	public function form_fcm($rollnumber){
		$data['path_url'] = '';
		$data['applicant_detail'] = $this->Interview_model->applicant_detail($rollnumber);
		$data['subview'] = $this->load->view('interviews/fcm_interview_form', $data, TRUE);
		$this->load->view('layout_main', $data); // page load.
	}
	// Save FCM/CHW interview.
	public function fcm_interview(){
		$q1 = $this->input->post('dob_marks');
		$q2 = $this->input->post('marital_marks');
		$q3 = $this->input->post('qual_marks');
		$q4 = $this->input->post('exp_marks');
		$q5 = $this->input->post('comm_marks');
		$q6 = $this->input->post('mob_marks');
		$q7 = $this->input->post('lang_marks');
		$obtained = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7;
		$data = array(
			'rollnumber' => $this->input->post('rollnumber'),
			'obtain_marks' => $obtained,
			'total_marks' => 50,
			'remark1' => $this->input->post('dob_remarks'),
			'remark2' => $this->input->post('marital_remarks'),
			'remark3' => $this->input->post('qual_remarks'),
			'remark4' => $this->input->post('exp_remarks'),
			'remark5' => $this->input->post('comm_remarks'),
			'remark6' => $this->input->post('mob_remarks'),
			'remark7' => $this->input->post('lang_remarks'),
			'remark10' => $this->input->post('overall_remarks')
			);
		$exists = $this->db->get_where('interview_result', array('rollnumber' => $_POST['rollnumber']))->row();
		if(!empty($exists)){
			$rollnumber = $this->input->post('rollnumber');
			$add_obtained = $obtained + $exists->obtain_marks;
			$add_total = $exists->total_marks + 50;
			$data3 = array(
				'obtain_marks' => $add_obtained,
				'total_marks' => $add_total
				);
			$this->Interview_model->update_fcm_interview($rollnumber, $data3);
			$this->session->set_flashdata('success', '<strong>Success !</strong> Interview marks have been updated successfully.');
			redirect('interview');
		}elseif($this->Interview_model->save_fcm_interview($data)){
			$this->session->set_flashdata('success', '<strong>Success !</strong> The interview result has been submitted successfully.');
			redirect('interview');
		}else{
			echo "The operation wasn't successful";
		}
	}
	// Print interview assessment sheet for individual applicant having designation DHCSO.
	public function print_sheet_dhcso($rollnumber){
		$this->load->library('Pdf');
	    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	    $pdf->SetTitle('Interview Assessment Sheet');
	    $pdf->SetHeaderMargin(30);
	    $pdf->SetTopMargin(20);
	    $pdf->setFooterMargin(20);
	    $pdf->SetAutoPageBreak(true);
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetAuthor('Saddam');
	    $pdf->SetDisplayMode('real', 'default');
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->setFontSubsetting(true);
	    $pdf->setFont('times', '', 12);
	    $pdf->setPrintHeader(false);
	    $pdf->setPrintFooter(false);
	    // Add a page
	    $data['sheet'] = $this->Interview_model->print_sheet($rollnumber);
	    // $title = $print->title;
	    ob_start();
	    $pdf->AddPage(); // Data will be loaded to the page here.
	    $html = $this->load->view('interviews/print_sheet', $data, true);
	    $pdf->writeHTML($html, true, false, true, false, '');
	    ob_clean();
	    $pdf->Output(md5(time()).'.pdf', 'I');
	}
	// Print interview assessment sheet for individual applicant designation CHW/FCM.
	public function print_sheet_fcm($rollnumber){
		$this->load->library('Pdf');
	    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	    $pdf->SetTitle('Interview Assessment Sheet');
	    $pdf->SetHeaderMargin(30);
	    $pdf->SetTopMargin(20);
	    $pdf->setFooterMargin(20);
	    $pdf->SetAutoPageBreak(true);
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetAuthor('Saddam');
	    $pdf->SetDisplayMode('real', 'default');
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->setFontSubsetting(true);
	    $pdf->setFont('times', '', 12);
	    $pdf->setPrintHeader(false);
	    $pdf->setPrintFooter(false);
	    // Add a page
	    $data['sheet'] = $this->Interview_model->print_sheet($rollnumber);
	    // $title = $print->title;
	    ob_start();
	    $pdf->AddPage(); // Data will be loaded to the page here.
	    $html = $this->load->view('interviews/print_sheet_fcm', $data, true);
	    $pdf->writeHTML($html, true, false, true, false, '');
	    ob_clean();
	    $pdf->Output(md5(time()).'.pdf', 'I');
	}
	// Print interview assessment sheet for individual applicant having designation SM.
	public function print_sheet_sm($rollnumber){
		$this->load->library('Pdf');
	    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	    $pdf->SetTitle('Interview Assessment Sheet');
	    $pdf->SetHeaderMargin(30);
	    $pdf->SetTopMargin(20);
	    $pdf->setFooterMargin(20);
	    $pdf->SetAutoPageBreak(true);
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->SetAuthor('Saddam');
	    $pdf->SetDisplayMode('real', 'default');
	    $pdf->SetCreator(PDF_CREATOR);
	    $pdf->setFontSubsetting(true);
	    $pdf->setFont('times', '', 12);
	    $pdf->setPrintHeader(false);
	    $pdf->setPrintFooter(false);
	    // Add a page
	    $data['sheet'] = $this->Interview_model->print_sheet($rollnumber);
	    // $title = $print->title;
	    ob_start();
	    $pdf->AddPage(); // Data will be loaded to the page here.
	    $html = $this->load->view('interviews/print_sheet_sm', $data, true);
	    $pdf->writeHTML($html, true, false, true, false, '');
	    ob_clean();
	    $pdf->Output(md5(time()).'.pdf', 'I');
	}

	// get opened and closed tickets for chart

	public function tickets_data()

	{

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('opened'=>'', 'closed'=>'');

		// open

		$Return['opened'] = $this->Xin_model->all_open_tickets();

		// closed

		$Return['closed'] = $this->Xin_model->all_closed_tickets();

		$this->output($Return);

		exit;

	}

	

	// get company wise salary

	public function payroll_company_wise()

	{

		$Return = array('chart_data'=>'', 'c_name'=>'', 'c_am'=>'','c_color'=>'');

		$c_name = array();

		$c_am = array();	

		$c_color = array('#ff4dff','#a64dff','#cc33ff','#9966ff','#0099ff','#33cc33','#ff4dff','#ff1aff','#0099cc','#ff0066');

		$someArray = array();

		$j=0;

		foreach($this->Xin_model->all_companies_chart() as $comp) {

		$company_pay = $this->Xin_model->get_company_make_payment($comp->company_id);

		$c_name[] = htmlspecialchars_decode($comp->name);

		$c_am[] = $company_pay[0]->paidAmount;

		$someArray[] = array(

		  'label'   => htmlspecialchars_decode($comp->name),

		  'value' => $company_pay[0]->paidAmount,

		  'bgcolor' => $c_color[$j]

		  );

		  $j++;

		}

		$Return['c_name'] = $c_name;

		$Return['c_am'] = $c_am;

		$Return['chart_data'] = $someArray;

		$this->output($Return);

		exit;

	}

	

	// get location|station wise salary

	public function payroll_location_wise()

	{

		$Return = array('chart_data'=>'', 'c_name'=>'', 'c_am'=>'','c_color'=>'');

		$c_name = array();

		$c_am = array();	

		$c_color = array('#3e70c9','#f59345','#f44236','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC');

		$someArray = array();

		$j=0;

		foreach($this->Xin_model->all_location_chart() as $location) {

		$location_pay = $this->Xin_model->get_location_make_payment($location->location_id);

		$c_name[] = htmlspecialchars_decode($location->location_name);

		$c_am[] = $location_pay[0]->paidAmount;

		$someArray[] = array(

		  'label'   => htmlspecialchars_decode($location->location_name),

		  'value' => $location_pay[0]->paidAmount,

		  'bgcolor' => $c_color[$j]

		  );

		  $j++;

		}

		$Return['c_name'] = $c_name;

		$Return['c_am'] = $c_am;

		$Return['chart_data'] = $someArray;

		$this->output($Return);

		exit;

	}

	

	// get department wise salary

	public function payroll_department_wise()

	{

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('chart_data'=>'', 'c_name'=>'', 'c_am'=>'','c_color'=>'');

		$c_name = array();

		$c_am = array();	

		$c_color = array('#3e70c9','#f59345','#f44236','#8A2BE2','#D2691E','#6495ED','#DC143C','#006400','#556B2F','#9932CC');

		$someArray = array();

		$j=0;

		foreach($this->Xin_model->all_departments_chart() as $department) {

		$department_pay = $this->Xin_model->get_department_make_payment($department->department_id);

		$c_name[] = htmlspecialchars_decode($department->department_name);

		$c_am[] = $department_pay[0]->paidAmount;

		$someArray[] = array(

		  'label'   => htmlspecialchars_decode($department->department_name),

		  'value' => $department_pay[0]->paidAmount,

		  'bgcolor' => $c_color[$j]

		  );

		  $j++;

		}

		$Return['c_name'] = $c_name;

		$Return['c_am'] = $c_am;

		$Return['chart_data'] = $someArray;

		$this->output($Return);

		exit;

	}

	

	// get designation wise salary

	public function payroll_designation_wise()

	{

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('chart_data'=>'', 'c_name'=>'', 'c_am'=>'','c_color'=>'');

		$c_name = array();

		$c_am = array();	

		$c_color = array('#1AAF5D','#F2C500','#F45B00','#8E0000','#0E948C','#6495ED','#DC143C','#006400','#556B2F','#9932CC');

		$someArray = array();

		$j=0;

		foreach($this->Xin_model->all_designations_chart() as $designation) {

		$result = $this->Xin_model->get_designation_make_payment($designation->designation_id);

		$c_name[] = htmlspecialchars_decode($designation->designation_name);

		$c_am[] = $result[0]->paidAmount;

		$someArray[] = array(

		  'label'   => htmlspecialchars_decode($designation->designation_name),

		  'value' => $result[0]->paidAmount,

		  'bgcolor' => $c_color[$j]

		  );

		  $j++;

		}

		$Return['c_name'] = $c_name;

		$Return['c_am'] = $c_am;

		$Return['chart_data'] = $someArray;

		$this->output($Return);

		exit;

	}

	

	// set new language

	public function set_language($language = "") {

        

        $language = ($language != "") ? $language : "english";

        $this->session->set_userdata('site_lang', $language);

        redirect($_SERVER['HTTP_REFERER']);

        

    }

}

