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

 * @Edited by Saddam@CTC - contract

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Contract extends MY_Controller {

	

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

		 $this->load->model('Contract_model');


//$this->load->model('job_longlisted_model'); // load model

		  $session = $this->session->userdata('username'); // Load the session variable here.

		  if(empty($session)){ // if the session is empty, redirect user to the login page.

		  	redirect('');

		  }

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
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}
		$projid = $session['project_id'];
	    $provid = $session['provience_id']; 

		 
		$data['sl3'] = $this->session->userdata('accessLevel');  
      	$data['sl2'] = $this->session->userdata('accessLevel');
		$user_session['sl4'] = $this->session->userdata('accessLevel'); // var_dump($user_session['sl4']['accessLevel3']); exit;
		if(!$user_session['sl4']['accessLevel3']){ redirect(''); } // If it wan't accessLevel3, user will be redirected to the login screen.
		 
		// get user > added by

		$user = $this->Xin_model->read_user_info($session['user_id']);

		// get designation

		$_designation = $this->Designation_model->read_designation_information($user[0]->designation_id);

		$all_contract = $this->Contract_model->contract_information($limit, $offset);
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/index');
		$config['total_rows'] = $this->Contract_model->count_contracts();
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

		if($data['sl2']){
			$data['all_contract']=$this->Contract_model->contract_information($limit, $offset);
		}else{
			$data['all_contract']=$this->Contract_model->contract_information_manager($projid, $provid);
		}

		if($data['sl2']){
			$data['expired_contracts'] = $this->Contract_model->get_by_date();
		}else{
			$data['expired_contracts'] = $this->Contract_model->get_by_date_manager($projid, $provid);
		}

		if($data['sl2']){
			$data['pending_contracts'] = $this->Contract_model->get_pending_contracts($limit, $offset);
		}else{
			$data['pending_contracts'] = $this->Contract_model->get_pending_contracts_manager($projid, $provid, $limit, $offset);
		}

		if($data['sl2']){
			$data['rejected_contracts'] = $this->Contract_model->rejected_contracts($limit, $offset);
		}else{
			$data['rejected_contracts'] = $this->Contract_model->rejected_contracts_manager($projid, $provid, $limit, $offset);
		}
		//$data['list_jobs'] = $this->Contract_model->jobs_list(); 
        $data['path_url'] = 'dashboard';
        $role_resources_ids = $this->Xin_model->user_role_resource();            
		if(in_array('45',$role_resources_ids)) {
			$data['subview'] = $this->load->view('dashboard/contract', $data, TRUE);
			$this->load->view('layout_main', $data); //page load
		}
	}
	// List of all pending contracts
	public function pending_contracts($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$projid = $session['project_id'];
	    $provid = $session['provience_id'];

		 
		$data['sl3'] = $this->session->userdata('accessLevel');  
     	$data['sl2'] = $this->session->userdata('accessLevel');  
		 
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/pending_contracts');
		$config['total_rows'] = $this->Contract_model->count_contracts();
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
		if($data['sl2']){
			$data['pen_contracts'] = $this->Contract_model->get_pending_contracts($limit, $offset);
		}else{
			$data['pen_contracts'] = $this->Contract_model->get_pending_contracts_manager($projid, $provid, $limit, $offset);
		}
		$data['subview'] = $this->load->view('dashboard/pending_contracts', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// List of all active contracts.
	public function all_active($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$projid = $session['project_id'];
	    $provid = $session['provience_id'];

		 
		$data['sl3'] = $this->session->userdata('accessLevel');  
        $data['sl2'] = $this->session->userdata('accessLevel');  
		 
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/all_active');
		$config['total_rows'] = $this->Contract_model->count_active();
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
		if($data['sl2']){
			$data['active_contracts'] = $this->Contract_model->all_active_contracts($limit, $offset);
		}else{
			$data['active_contracts'] = $this->Contract_model->all_active_contracts_manager($projid, $provid, $limit, $offset);
		}
      $data['path_url'] = 'dashboard';
		$data['subview'] = $this->load->view('dashboard/active_contracts', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// List of all Expired contracts.
	public function all_expired($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$projid = $session['project_id'];
	    $provid = $session['provience_id'];

		 
		$data['sl3'] = $this->session->userdata('accessLevel');  
        $data['sl2'] = $this->session->userdata('accessLevel');  
		 
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/all_expired');
		$config['total_rows'] = $this->Contract_model->count_expired();
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
		if($data['sl2']){
			$data['expired_contracts'] = $this->Contract_model->all_expired_contracts($limit, $offset);
		}else{
			$data['expired_contracts'] = $this->Contract_model->all_expired_contracts_manager($projid, $provid, $limit, $offset);
		}
		$data['subview'] = $this->load->view('dashboard/expired_contracts', $data, TRUE);
		$this->load->view('layout_main', $data);
	}
	// All rejected / finished contracts.
	public function all_rejected($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$projid = $session['project_id'];
	    $provid = $session['provience_id'];

		 
		$data['sl3'] = $this->session->userdata('accessLevel');  
        $data['sl2'] = $this->session->userdata('accessLevel');

      	$this->load->library('pagination');
		$config['base_url'] = base_url('contract/all_rejected');
		$config['total_rows'] = $this->Contract_model->count_rejected();
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
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
		if($data['sl2']){
			$data['rej_contracts'] = $this->Contract_model->rejected_contracts($limit, $offset);
		}else{
			$data['rej_contracts'] = $this->Contract_model->rejected_contracts_manager($projid, $provid, $limit, $offset);
		}
		$data['subview'] = $this->load->view('dashboard/rejected_contracts', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// Create new contract.
	public function create_contract(){
		$data['cr_contract'] = $this->Contract_model->get_contract_byID();
		$data['types'] = $this->Contract_model->get_contract_formats();
		$data['subview'] = $this->load->view('dashboard/create_contract', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// Add new contract for the user.
	public function add_contract(){
		$user_id = $this->input->post('user_id');
		$data = array(
			'long_description' => $this->input->post('long_description'),
			'from_date' => $this->input->post('from_date'),
			'to_date' => $this->input->post('to_date')
		);
		$this->Contract_model->create_contract($user_id, $data);
		$this->session->set_flashdata('messageactive', 'Contract created Successfully !');
		redirect('contract'); 
	}
	// Verify contract and upload a scanned copy.
	public function verify(){
		$data['cr_contract'] = $this->Contract_model->get_contract_byID();
		$data['subview'] = $this->load->view('dashboard/contract_copy', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// Upload the scanned copy of the contract. Single file upload.
	public function contract_copy(){
		$this->load->library('upload');
	    $config['upload_path'] = './uploads/contract';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['encrypt_name'] = TRUE;
	    $this->upload->initialize($config);
	    if ($this->upload->do_upload('scanned_copy')) {
	       $file_data = $this->upload->data();
	     } else { 
	      echo "Error uploading file.";
	     }
	     $user_id = $this->input->post('user_id');
	     $data = array(
	      'contract_copy' => $file_data['file_name']
	     );
		$this->Contract_model->upload_copy($user_id, $data);
		$this->session->set_flashdata('messageactive', 'File uploaded successfully!');
		return redirect('contract');
	}
	// Multiple files upload. Contract copies upload.
	function contract_upload(){
        $data = array();
        // If file upload form submitted
        if(!empty($_FILES['files']['name']) AND !empty('user_id')){
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                // File upload configuration
                $uploadPath = './uploads/contract/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['encrypt_name'] = TRUE;
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['emp_id'] = $this->input->post('user_id');
                }
            }
            if(!empty($uploadData)){
                // Insert files data into the database
                $insert = $this->Contract_model->insert($uploadData);
                // Upload status message
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('messageactive', $statusMsg);
            }
        }
        redirect('contract');
    }
	// Finishing a contract.
	public function finish(){
	 	$id = $this->input->post('id');
	 	$data = array(
	 		'rejection_reason' => $this->input->post('reason'),
	 		'status' => 5
	 	);
	 	if($this->Contract_model->finish_contract($id, $data)){
	 		$this->session->set_flashdata('messageactive', 'Contract has been finished!');
	 		redirect($_SERVER['HTTP_REFERER']);
	 	}else{
	 		echo "Error finishing Contract !";
	 	}
	}
	// Rejecting a contract.
	public function reject(){
		$id = $this->input->post("user_id");
		$data = array(
			'rejection_reason' => $this->input->post('reason'),
			'status' => 6
		);
		if($this->Contract_model->reject_contract($id, $data)){
			$this->session->set_flashdata('messageactive', 'Contract has been rejected!');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "Error in rejecting contract !";
		}
	}
	// Extend contract.
	public function extend(){
		$data['extension'] = $this->Contract_model->get_for_extension();
		$data['types'] = $this->Contract_model->get_contract_formats();
		$data['subview'] = $this->load->view('dashboard/create_contract', $data, TRUE);
		$this->load->view('layout_main', $data);
	}
	// Save the updated data to database.
	public function extend_contract(){
		$id = $this->input->post('user_id');
		$data = array(
			'from_date' => $this->input->post('from_date'),
			'to_date' => $this->input->post('to_date'),
			'long_description' => $this->input->post('long_description'),
			'status' => 1
		);
		$this->Contract_model->contract_extension($id, $data);
		$this->session->set_flashdata('messageactive', 'Contract has been extended successfully!');
		redirect('contract');
	}
		// Extend All contracts at once.
	public function extend_all(){
		$date_0 = date('Y-m-d');
		$date_1 = strtotime($date_0. '+ 15 days');
		$date = date('Y-m-d', $date_1);
		$data = array(
			'from_date' => $this->input->post('date_from'),
			'to_date' => $this->input->post('date_to'),
			'status' => 1
		);
		if($this->Contract_model->extend_bulk($date, $data)){
			$this->session->set_flashdata('messageactive', '<strong>Woohoo ! </strong> Contracts have been extended successfully!');
			redirect('contract');
		}else{
			echo "The operation wasn't successful, try again!" ."<a href='javascript:history.go(-1);'>Go Back &laquo;</a>";
		}
	}
	// View printed contracts by status.
	public function get_printed($status = ''){
		$session = $this->session->userdata('username');
		$projid = $session['project_id'];
	   	$provid = $session['provience_id'];

		 
		$data['sl3'] = $this->session->userdata('accessLevel');  
      $data['sl2'] = $this->session->userdata('accessLevel');

		if($data['sl2']){
			$printed = $this->Contract_model->printed_contracts($status);
		}else{
			$printed = $this->Contract_model->printed_contracts_manager($projid, $provid, $status);
		}
		echo json_encode($printed);
	}
	// View contract detail. view images and other important things.
	// public function view_contract($user_id){
	// 	$data['view_contracts'] = $this->Contract_model->contract_view($user_id);
	// 	$data['subview'] = $this->load->view('dashboard/contract_detail', $data, TRUE);
	// 	$this->load->view('layout_main', $data);
	// }
	// Print contract letter.
	public function print_contract($user_id){
		$this->load->library('Pdf');
	    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	    $pdf->SetTitle('Employment Contract');
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
	    $data = $this->Contract_model->contract_print($user_id);
	    foreach($data as $print){
	      // $title = $print->title;
	      $content = $print->long_description;
	      $from_date = date('l, F jS, Y', strtotime($print->from_date));
	      $to_date = date('l, F jS, Y', strtotime($print->to_date));
	    }
	    $pdf->AddPage(); // Data will be loaded to the page here.
	    $html =  $content.'Starts From: <strong>'.$from_date.'</strong> till <strong>'.$to_date.'</strong>.';
	    $pdf->writeHTML($html, true, false, true, false, '');
	    ob_clean();
	    $pdf->Output(md5(time()).'.pdf', 'I');
	    $status = $this->db->select('status')->from('employee_contract');
	    $this->db->where('user_id', $user_id);
	    $this->db->where('status', 1);
	    if($status == 1){
	    	$this->db->update('employee_contract', array('status' => '2'));
	    }
	}
	// Print multiple letters at once.
	public function print_all_contracts(){
		$this->load->library('Pdf');
	    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
	    $pdf->SetTitle('Employment Contract');
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
	    $contracts = $this->Contract_model->print_bulk();
	    foreach($contracts as $print){
		    // $title = $print->title;
		    $content = $print->long_description;
		    $from_date = date('l jS F, Y', strtotime($print->from_date));
		    $to_date = date('l jS F, Y', strtotime($print->to_date));
	    
		    $pdf->AddPage(); // Data will be loaded to the page here.
		    $html =  $content.'Starts from <strong>'.$from_date.'</strong> till <strong>'.$to_date.'.';
		    $pdf->writeHTML($html, true, false, true, false, '');
		}
	    ob_clean();
	    $pdf->Output(md5(time()).'.pdf', 'I');
	    $status = $this->db->select('status')->from('employee_contract');
	    $this->db->where('status', 1);
	    if($status == 1){
	    	$this->db->update('employee_contract', array('status' => '2'));
	    }
	}
	// Activate multiple contract at once. (Bulk activate)
	public function activate_all_contracts(){
		if($this->Contract_model->activate_bulk()){	
	       $this->session->set_flashdata('messageactive', 'Contracts activated successfully.');
			redirect($_SERVER['HTTP_REFERER']); 
	    }else {
	        echo 'Activating contracts not successful, try again !';
	    }
	}
	// Distribute contracts
	public function distribute($id){
		if($this->Contract_model->distribute_contracts($id)){
			$this->session->set_flashdata('messageactive', 'Contracts distributed successfully.');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "Distributing contracts was not successful, try again !";
		}
	}
        // Bulk distribute.
	public function bulk_distribute(){
		if($this->Contract_model->distribute_bulk()){
			$this->session->set_flashdata('messageactive', 'Contracts have been added to distributed!');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "The action was not successful, please try again!";
		}
	}
        // Bulk attach
	public function bulk_attach(){
		if($this->Contract_model->attach_bulk()){
			$this->session->set_flashdata('messageactive', 'Contracts have been attached to personal file.');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "The action was not successful, please try again!";
		}
	}
	// Attach to personal file.
	public function attach($id){
		if($this->Contract_model->attach_to_file($id)){
			$this->session->set_flashdata('messageactive', 'Attachment to personal file has been successful.');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "Attachment wasn't successful, try again !";
		}
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

 public function activatecontract($id) {

    if($this->Contract_model->addtoAcctiveContract($id)) // call the method from the controller
	    {
	       // echo 'update successful...';  	
	       $this->session->set_flashdata('messageactive', 'contract activated successfully.');
	       //echo $_SERVER['HTTP_REFERER']; // $this->agent->referrer();
			redirect($_SERVER['HTTP_REFERER']); 
	    }
	    else
	    {
	        echo 'update not successful...';
	    }
 }
 //---------------------------- Offer Letters ----------------------------//
 // Offer letters (All offer letters -- Accepted)
	public function offer_letters($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$projid = $session['project_id'];
	    $provid = $session['provience_id'];

	    $this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/offer_letters');
		$config['total_rows'] = $this->Contract_model->count_offer_letters();
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
		 
		$data['sl3'] = $this->session->userdata('accessLevel');  
        $data['sl2'] = $this->session->userdata('accessLevel');
	    $data['letters'] = $this->Contract_model->offer_letters($limit, $offset);
	    $data['pen_letters'] = $this->Contract_model->pending_offer_letters($limit, $offset);
	    $data['subview'] = $this->load->view('dashboard/offer_letters', $data, TRUE);
	    $this->load->view('layout_main', $data); // Page load.
	}
	// View all pending offer letters.
	public function list_pending_letters($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$projid = $session['project_id'];
	    $provid = $session['provience_id'];

	    $this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/list_pending_letters');
		$config['total_rows'] = $this->Contract_model->count_pending_letters();
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
		$data['sl3'] = $this->session->userdata('accessLevel');  
        $data['sl2'] = $this->session->userdata('accessLevel');

		$data['pend_letters'] = $this->Contract_model->pending_offer_letters($limit, $offset);
		$data['subview'] = $this->load->view('dashboard/pending_offer_letters', $data, TRUE);
    	$this->load->view('layout_main', $data); // Page load.

	}
	// List of all rejected letters.
	public function list_rejected_letters($offset = NULL){
		$session = $this->session->userdata('username');
		if(empty($session)){
			redirect('');
		}
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$projid = $session['project_id'];
	    $provid = $session['provience_id'];

	    $this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/list_rejected_letters');
		$config['total_rows'] = $this->Contract_model->count_rejected_letters();
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
		$data['sl3'] = $this->session->userdata('accessLevel');  
        $data['sl2'] = $this->session->userdata('accessLevel');

		$data['rejected_letters'] = $this->Contract_model->pending_offer_letters($limit, $offset);
		$data['subview'] = $this->load->view('dashboard/rejected_offer_letters', $data, TRUE);
    	$this->load->view('layout_main', $data); // Page load.
	}
// Accept Offer letter
  public function accept_offer_letter($user_id){
    if($this->Contract_model->accept_letter($user_id)){
       $this->session->set_flashdata('messageactive', 'Offer letter has been accepted successfully!');
       redirect($_SERVER['HTTP_REFERER']);
    }else{
      echo "The letter acceptance wasn't successful !";
    }
  }
// Reject Offer letter
  public function reject_offer_letter($user_id){
    if($this->Contract_model->reject_letter($user_id)){
       $this->session->set_flashdata('messageactive', 'The offer letter was rejected !');
       redirect($_SERVER['HTTP_REFERER']);
    }else{
      echo "The operation wasn't successful !";
    }
  }
  // Upload offer letters.
  public function upload_offer_letter($user_id){
  	$data['letters'] = $this->Contract_model->get_offer_letters();
  	$data['letter_exists'] = $this->Contract_model->offer_letter_exists(); // If letter exists, put in textarea.
  	$data['subview'] = $this->load->view('dashboard/upload_letter', $data, TRUE);
    $this->load->view('layout_main', $data); // Page load.
  }
  // Create an offer letter.
  public function create_offer_letter(){
  	$user_id = $this->input->post('user_id');
  	$data = array(
  		'attachment' => $this->input->post('offer_letter'),
  	);
  	$this->Contract_model->upload_offer_letter($user_id, $data);
  	$this->session->set_flashdata('success', '<strong>Success !</strong> Offer letter has been uploaded successfully!');
  	redirect('contract/offer_letters');
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
?>