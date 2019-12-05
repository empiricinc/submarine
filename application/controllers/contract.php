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
		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id']; 

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
       	// $data['sl2'] = $this->session->userdata('accessLevel');
		// $user_session['sl4'] = $this->session->userdata('accessLevel'); 
		// var_dump($user_session['sl4']['accessLevel3']); exit;
		// if(!$user_session['sl4']['accessLevel3']){ redirect(''); } // If it wan't accessLevel3, user will be redirected to the login screen.
		 
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
		$data['all_contract']=$this->Contract_model->contract_information($limit, $offset);
		$data['expired_contracts'] = $this->Contract_model->get_by_date();
		$data['pending_contracts'] = $this->Contract_model->get_pending_contracts($limit, $offset);
		$data['rejected_contracts'] = $this->Contract_model->rejected_contracts($limit, $offset);
		//$data['list_jobs'] = $this->Contract_model->jobs_list(); 
        $data['path_url'] = 'dashboard';
        //$role_resources_ids = $this->Xin_model->user_role_resource();            
		// if(in_array('45',$role_resources_ids)) {
			$data['subview'] = $this->load->view('dashboard/contract', $data, TRUE);
			$this->load->view('layout_main', $data); //page load
		// }
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
		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //    	$data['sl2'] = $this->session->userdata('accessLevel');  
		 
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
		$data['pen_contracts'] = $this->Contract_model->get_pending_contracts($limit, $offset);
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
		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //       $data['sl2'] = $this->session->userdata('accessLevel');  
		 
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
		$data['active_contracts'] = $this->Contract_model->all_active_contracts($limit, $offset);
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
		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //       $data['sl2'] = $this->session->userdata('accessLevel');  
		 
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
		$data['expired_contracts'] = $this->Contract_model->all_expired_contracts($limit, $offset);
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
		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //       $data['sl2'] = $this->session->userdata('accessLevel');

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
		$data['rej_contracts'] = $this->Contract_model->rejected_contracts($limit, $offset);
		$data['subview'] = $this->load->view('dashboard/rejected_contracts', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// Create new contract.
	public function create_contract(){
		$data['cr_contract'] = $this->Contract_model->get_contract_byID();
		// $data['extension'] = $this->Contract_model->get_for_extension();
		$data['types'] = $this->Contract_model->get_contract_formats();
		$data['applicant'] = $this->Contract_model->applicant_data();
		$data['path_url'] = '';
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
	// Activate contract first, then activate it.
	public function activate_first(){
		echo "You need to create the contract first, then you can activate it !";
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
	public function reject($user_id){
		$data = array(
			'rejection_reason' => 'The contract has been rejected because of unexpected reasons.',
			'status' => 6
		);
		if($this->Contract_model->reject_contract($user_id, $data)){
			$this->session->set_flashdata('messageactive', 'Contract has been rejected!');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "Error in rejecting contract !";
		}
	}
	// Extend contract.
	public function extend(){
		$data['extension'] = $this->Contract_model->get_for_extension();
		$data['cr_contract'] = $this->Contract_model->get_contract_byID();
		$data['applicant'] = $this->Contract_model->applicant_data();
		$data['types'] = $this->Contract_model->get_contract_formats();
		$data['path_url'] = '';
		$data['subview'] = $this->load->view('dashboard/create_contract', $data, TRUE);
		$this->load->view('layout_main', $data);
	}
	// Save the updated data to database.
	public function extend_contract(){
		// $id = $this->input->post('user_id');
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'from_date' => $this->input->post('from_date'),
			'to_date' => $this->input->post('to_date'),
			'long_description' => $this->input->post('long_description'),
			'status' => 0
		);
		$this->Contract_model->contract_extension($data);
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
			'status' => 0
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
		// $projid = $session['project_id'];
	 //   	$provid = $session['provience_id'];

		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //     	$data['sl2'] = $this->session->userdata('accessLevel');

		// if($data['sl2']){
			$printed = $this->Contract_model->printed_contracts($status);
		// }else{
			// $printed = $this->Contract_model->printed_contracts_manager($projid, $provid, $status);
		// }
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
	    $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
	    $pdf->SetTitle('Employment Contract');
	    $pdf->SetHeaderMargin(30);
	    $pdf->setMargins(10, 20, 10, true);
	    $pdf->SetTopMargin(0.4);
	    $pdf->setFooterMargin(0.97);
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
	    ob_start();
	    $data = $this->Contract_model->contract_print($user_id);
	    foreach($data as $print){
	      // $title = $print->title;
	    	$session1 = $this->session->userdata('username');
	    	$find = array("{{name}}", "{{designation}}", "{{district}}", "{{date}}", "{{start_date}}", "{{session}}", "{{logged_user}}", "{{cnic}}");
	    	$contract = $this->Contract_model->applicant_data();
	      	$content = $print->long_description;
	      	$replace =  array('{{name}}' => $contract->fullname, '{{designation}}'=>$contract->designation_name, '{{district}}' => $contract->dist_name, '{{date}}'=>date('M y'), '{{start_date}}' => date('M d, Y', strtotime($contract->created_at)), '{{logged_user}}'=> substr(ucfirst($session1['username']), 0, 1), '{{session' => ucfirst($session1['username']), '{{cnic}}' => $contract->cnic);
	    }
	    $width = $pdf->pixelsToUnits(600);
	    $height = $pdf->pixelsToUnits(705);
	    $resolution = array($width, $height);
	    $pdf->AddPage('P', $resolution); // Data will be loaded to the page here.
	    $html =  str_replace($find, $replace, $content);
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
	    ob_start();
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
		$data = array(
			'status' => 1
		);
		$ids = $this->input->post('print');
		if(isset($_POST['activate_bulk'])){ // If checkbox is not checked, contract can't be activated.
			$this->db->where_in('user_id', $ids);
			if($this->db->update('employee_contract', $data)){
				$this->session->set_flashdata('messageactive', 'Contracts activated successfully.');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				echo "The operation wasn't successful, please try again.";
			}
		}elseif(isset($_POST['generate_bulk'])){ // If the generate button's clicked !
			foreach($ids as $value){
				$session = $this->session->userdata('username');
				$applicants = $this->Contract_model->applicants_data($value);
				$formats = $this->db->get_where('xin_contract_type', array('contract_type_id' => 4))->row();
	            $applicant='';
				foreach($applicants as $applicant){
	            	$find = array("{{name}}", "{{designation}}", "{{district}}", "{{date}}", "{{start_date}}", "{{end_date}}", "{{session}}", "{{logged_user}}", "{{logged_email}}", "{{cnic}}", "{{gender}}", "{{address}}", "{{province}}");
	            	$start_date = date("F jS, Y", strtotime($applicant->created_at));
	            	$end_date = date('F jS, Y', strtotime($applicant->created_at));
	            	$gender = $applicant->gender == 0 ? "Mr." : "Ms.";
	        		$replace = array(
	            		'{{name}}' => $applicant->fullname,
	            		'{{designation}}'=>$applicant->designation_name,
	            		'{{district}}' => $applicant->dist_name,
	            		'{{date}}'=>date("M y"),
	            		'{{start_date}}' => $start_date,
	            		'{{end_date}}' => $end_date,
	            		'{{session}}'=> substr(strtoupper($session['username']), 0, 2),
	            		'{{logged_user}}' => ucfirst($session['username']),
	            		'{{logged_email}}' => $session['email'],
	            		'{{cnic}}' => $applicant->cnic,
	            		'{{gender}}' => $gender,
	            		'{{address}}' => 'P/O Madyan, Teh & Distt. Swat',
	            		'{{province}}' => $applicant->name
	        		);
	            	$subject = $formats->contract_format;
	            	$save_format = str_replace($find, $replace, $subject);
					$data2 = array(
						'long_description' => $save_format
					);
					//$this->db->where_in('user_id', $ids);	
					//echo "<pre>"; print_r($replace); 
					//$this->db->where('status', 0)->update('employee_contract', $data2);
					// $this->session->set_flashdata('messageactive', 'Contracts generated successfully.');
					// redirect('contract');
	            } // 2nd foreach.
					$this->db->where_in('user_id', $value);	
					$this->db->where('status', 0)->update('employee_contract', $data2);
			} // 1st foreach
			$this->session->set_flashdata('messageactive', 'Contracts generated successfully.');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "Select at least one checkbox from the list.";
			return false;
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
	// Attach to personal file.
	public function attach($id){
		if($this->Contract_model->attach_to_file($id)){
			$this->session->set_flashdata('messageactive', 'Attachment to personal file has been successful.');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "Attachment wasn't successful, try again !";
		}
	}
	// Status change in bulk.
	public function bulk_update(){
		print_r($_POST);
		
	}
	public function count_age(){
		$birthday = $this->db->get_where('xin_job_applications', array('application_id'=> 257))->row();
		$dob = strtotime($birthday->dob);
		$gender = $birthday->gender;
		echo $birthday->dob.'<br>'; 
		echo $gender = 1 ? 'Male': 'Female';   
		$tdate = time();
		$age = date('Y', $tdate) - date('Y', $dob);
		if($age > '60' AND $gender = 0 OR $age > '55' AND $gender = 1){
			echo "I'm $age years old and I'm not entitled to get an insurance from the company.";
		}elseif($age < '18'){
			echo "I'm $age years old and I'm not entitled to get an insurance nor EOBI contract.";
		}else{
			echo "<br> I'm $age years old and I'm entitled to get a contract with insurance, Hooray!";
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
		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id'];

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
		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //       $data['sl2'] = $this->session->userdata('accessLevel');
	    $data['letters'] = $this->Contract_model->offer_letters($limit, $offset);
	    $data['pen_letters'] = $this->Contract_model->pending_offer_letters($limit, $offset);
	    $data['rej_letters'] = $this->Contract_model->rejected_offer_letters($limit, $offset);
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
		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id'];

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
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //       $data['sl2'] = $this->session->userdata('accessLevel');

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
		// $projid = $session['project_id'];
	 //    $provid = $session['provience_id'];

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
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //       $data['sl2'] = $this->session->userdata('accessLevel');

		$data['rejected_letters'] = $this->Contract_model->rejected_offer_letters($limit, $offset);
		$data['subview'] = $this->load->view('dashboard/rejected_offer_letters', $data, TRUE);
    	$this->load->view('layout_main', $data); // Page load.
	}
	// List of all accepted offer letters.
	public function list_accepted_letters($offset = NULL){
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

	    $this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/list_accepted_letters');
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
		 
		// $data['sl3'] = $this->session->userdata('accessLevel');  
  //       $data['sl2'] = $this->session->userdata('accessLevel');
	    $data['letters'] = $this->Contract_model->offer_letters($limit, $offset);
	    $data['subview'] = $this->load->view('dashboard/accepted_offer_letters', $data, TRUE);
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
  	$data['applicant'] = $this->Contract_model->applicant_data();
  	$data['path_url'] = '';
  	$data['subview'] = $this->load->view('dashboard/upload_letter', $data, TRUE);
    $this->load->view('layout_main', $data); // Page load.
  }
  // Create an offer letter.
  public function create_offer_letter(){
  	$user_id = $this->input->post('user_id');
  	$data = array(
  		'attachment' => htmlentities($this->input->post('offer_letter'))
  	);
  	$this->Contract_model->upload_offer_letter($user_id, $data);
  	$this->session->set_flashdata('success', '<strong>Success !</strong> Offer letter has been generated successfully!');
  	redirect('contract/offer_letters');
  }
  // Print offer letter.
  public function print_offer_letter($user_id){
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
	    $data['offer_letter'] = $this->Contract_model->offer_letter_print($user_id);
	    // $title = $print->title;
	    ob_start();
	    $pdf->AddPage(); // Data will be loaded to the page here.
	    $html = $this->load->view('dashboard/print_letter', $data, true);
	    $pdf->writeHTML($html, true, false, true, false, '');
	    ob_clean();
	    $pdf->Output(md5(time()).'.pdf', 'I');
	}
	// -------------------------------- Search for data ----------------------------------- //
	// Search accepted offer letters.
	public function search_accepted(){
		$keyword = $this->input->get('search_accepted');
		$data['results'] = $this->Contract_model->accepted_search($keyword);
	  	$data['subview'] = $this->load->view('dashboard/accepted_offer_letters', $data, TRUE);
	    $this->load->view('layout_main', $data); // Page load.
	}
	// Search pending offer letters.
	public function search_pending(){
		$keyword = $this->input->get('search_pending');
		$data['results'] = $this->Contract_model->pending_search($keyword);
	  	$data['subview'] = $this->load->view('dashboard/pending_offer_letters', $data, TRUE);
	    $this->load->view('layout_main', $data); // Page load.
	}
	// Search rejected offer letters.
	public function search_rejected(){
		$keyword = $this->input->get('search_rejected');
		$data['results'] = $this->Contract_model->rejected_search($keyword);
	  	$data['subview'] = $this->load->view('dashboard/rejected_offer_letters', $data, TRUE);
	    $this->load->view('layout_main', $data); // Page load.
	}
	// -------------------------- Contract setup (creating templates) ----------------------- //
	// Load the form.
	public function contract_setup(){
		$data['parth_url'] = '';
		$data['designations'] = $this->Contract_model->get_designations();
		$data['subview'] = $this->load->view('dashboard/contract_setup', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// Add new template.
	public function add_template(){
		$data = array(
			'designation' => $this->input->post('designation'),
			'name' => trim($this->input->post('cont_type')),
			'contract_format' => $this->input->post('contract_format'),
			'created_at' => $this->input->post('created_at')
		);
		// Check for existing record in the database, if exists, stop inserting more.
		$where = array('designation'=>$_POST['designation'], 'name'=>$_POST['cont_type']);
		$existing_record = $this->db->select('designation,name')->from('xin_contract_type')->where($where)->get()->result();
		if($existing_record){ // If record does exist, show a message. (return false).
			echo "The Template for this Cadre has already been created, try another one.";
		}else{ // Insert the data into the database.
			$this->Contract_model->add_template($data);
			$this->session->set_flashdata('success', '<strong>Success! </strong>Template has been created successfully.');
			redirect('contract/templates');
		}
	}
	// Template list.
	public function templates($offset = NULL){
		$limit = 10;
		if(!empty($offset)){
			$this->uri->segment(3);
		}
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url('contract/templates');
		$config['total_rows'] = $this->Contract_model->count_templates();
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
		$data['path_url'] = '';
		$data['templates'] = $this->Contract_model->get_templates($limit, $offset);
		$data['subview'] = $this->load->view('dashboard/template_list', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// View / Edit template
	public function edit_template($id){
		$data['path_url'] = '';
		$data['designations'] = $this->Contract_model->get_designations();
		$data['edit_template'] = $this->Contract_model->template_exists($id);
		$data['subview'] = $this->load->view('dashboard/contract_setup', $data, TRUE);
		$this->load->view('layout_main', $data); // Page load.
	}
	// Delete template.
	public function delete_template($id){
		if($this->Contract_model->delete_template($id)){
			$this->session->set_flashdata('success', '<strong>Success! </strong>Template has been deleted successfully.');
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			echo "The operation wasn't successful, try again.";
		}
	}
	// Update template.
	public function update_template(){
		$id = $this->input->post('contract_type_id');
		$data = array(
			'designation' => $this->input->post('designation'),
			'name' => $this->input->post('cont_type'),
			'contract_format' => $this->input->post('contract_format')
		);
		if($this->Contract_model->update_template($id, $data)){
			$this->session->set_flashdata('success', '<strong>Success! </strong>Template has been updated successfully.');
			redirect('contract/templates');
		}else{
			echo "The operation wasn't successful, try again.";
		}
	}
	// Search templates.
	public function search_templates(){
		$keyword = $this->input->get('search_templates');
		$data['results'] = $this->Contract_model->search_templates($keyword);
		$data['path_url'] = '';
		$data['subview'] = $this->load->view('dashboard/template_list', $data, TRUE);
		$this->load->view('layout_main', $data);
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