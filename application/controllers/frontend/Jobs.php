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

 * @author   Ayat Ullah Khan

 * @package  ctc - Jobs

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Jobs extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('email');

		$this->load->library('form_validation');

		//load the model

		$this->load->model("Job_post_model");

		$this->load->model("Xin_model");

		$this->load->model("Designation_model");

		$this->load->model("Department_model");

	}

	

	/*Function to set JSON output*/

	public function output($Return=array()){

		/*Set response header*/

		header("Access-Control-Allow-Origin: *");

		header("Content-Type: application/json; charset=UTF-8");

		/*Final JSON response*/

		exit(json_encode($Return));

	}

	

	 public function index()

     {

		$data['title'] = $this->Xin_model->site_title();

		$data['all_designations'] = $this->Designation_model->all_designations();

		$data['all_job_types'] = $this->Job_post_model->all_job_types();

		$data['all_jobs'] = $this->Job_post_model->all_jobs();

		$data['all_jobs_by_designation'] = $this->Job_post_model->read_all_jobs_by_designation();

		$session = $this->session->userdata('username');

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('44',$role_resources_ids)) {

			if(!empty($session)){ 

			$this->load->view("frontend/jobs", $data);

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}

     }

	 

	 public function detail()

	{

		$data['title'] = $this->Xin_model->site_title();

		$id = $this->uri->segment(4);

		$result = $this->Job_post_model->read_job_information($id);

		$data = array(

				'job_id' => $result[0]->job_id,

				'title' => $this->Xin_model->site_title(),

				'job_title' => $result[0]->job_title,

				'designation_id' => $result[0]->designation_id,

				'job_type_id' => $result[0]->job_type,

				'job_vacancy' => $result[0]->job_vacancy,

				'gender' => $result[0]->gender,

				'minimum_experience' => $result[0]->minimum_experience,

				'date_of_closing' => $result[0]->date_of_closing,

				'short_description' => $result[0]->short_description,

				'long_description' => $result[0]->long_description,

				'status' => $result[0]->status,

				'created_at' => $result[0]->created_at,

				'all_designations' => $this->Designation_model->all_designations(),

				'all_job_types' => $this->Job_post_model->all_job_types()

				);

		$session = $this->session->userdata('username');

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('44',$role_resources_ids)) {

			if(!empty($session)){ 

			$this->load->view('frontend/job_details', $data);

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}

	}

	

	public function apply()

	{

		$data['title'] = $this->Xin_model->site_title();

		$id = $this->input->get('job_id');

		$result = $this->Job_post_model->read_job_information($id);

		$data = array(

				'job_id' => $result[0]->job_id,

				'job_title' => $result[0]->job_title,

				'designation_id' => $result[0]->designation_id,

				'job_type_id' => $result[0]->job_type,

				'job_vacancy' => $result[0]->job_vacancy,

				'gender' => $result[0]->gender,

				'minimum_experience' => $result[0]->minimum_experience,

				'date_of_closing' => $result[0]->date_of_closing,

				'short_description' => $result[0]->short_description,

				'long_description' => $result[0]->long_description,

				'status' => $result[0]->status,

				'all_designations' => $this->Designation_model->all_designations(),

				'all_job_types' => $this->Job_post_model->all_job_types()

				);

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view('frontend/dialog_job_apply', $data);

		} else {

			redirect('');

		}

	}

	

	// Validate and add info in database

	public function apply_job() {

	//

		if($this->input->post('add_type')=='apply_job') {		

		/* Define return | here result is used to return user data and error for error message */

		//$Return = array('result'=>'', 'error'=>'');

		

		$user_id = $this->input->post('user_id');

		$job_id = $this->uri->segment(4);

		$message = $this->input->post('message');	

		$fullname = $this->input->post('fullname');	

		$email = $this->input->post('email');	

		$gender = $this->input->post('gender');	

		$age = $this->input->post('age');	

		$education = $this->input->post('education');

		$experience = $this->input->post('experience');

		$domicile = $this->input->post('domicile');	

		$province = $this->input->post('province');	

		$city_name = $this->input->post('city_name');	


 

 


 



 //print_r($_POST); exit();
		 
 
 
		
/*
			if(is_uploaded_file($_FILES['resume']['tmp_name'])) {

				//checking image type

				$allowed =  explode( ',',$system_setting[0]->job_application_format);

				$filename = $_FILES['resume']['name'];

				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				

				if(in_array($ext,$allowed)){

					$tmp_name = $_FILES["resume"]["tmp_name"];

					$resume = "uploads/resume/";

					// basename() may prevent filesystem traversal attacks;

					// further validation/sanitation of the filename may be appropriate

					$name = basename($_FILES["resume"]["name"]);

					$newfilename = 'resume_'.round(microtime(true)).'.'.$ext;

					move_uploaded_file($tmp_name, $resume.$newfilename);

					$fname = $newfilename;

				} else {

					$Return['error'] = $this->lang->line('xin_resume_attachment_must_be').': '.$system_setting[0]->job_application_format;

				}

			}*/

		 /*
 
 
    	 if(is_uploaded_file($_FILES['resume']['tmp_name'])) {

				//checking image type

				$allowed =  explode( ',',$system_setting[0]->job_application_format);

				$filename = $_FILES['resume']['name'];

				$ext = pathinfo($filename, PATHINFO_EXTENSION);

				

				if(in_array($ext,$allowed)){

					$tmp_name = $_FILES["resume"]["tmp_name"];

					$resume = "uploads/resume/";

					// basename() may prevent filesystem traversal attacks;

					// further validation/sanitation of the filename may be appropriate

					$name = basename($_FILES["resume"]["name"]);

					$newfilename = 'resume_'.round(microtime(true)).'.'.$ext;

					move_uploaded_file($tmp_name, $resume.$newfilename);

					$fname = $newfilename;

				} else {

					$Return['error'] = $this->lang->line('xin_resume_attachment_must_be').': '.$system_setting[0]->job_application_format;

				}

			}*/

	

		$data = array(

		'job_id' => $job_id,
		'user_id' => $user_id,
		'fullname' => $fullname,
		'email' => $email,	
		'gender' => $gender,
		'age' => $age,	
		'education' => $education,	
		'minimum_experience' => $experience,
		'domicile' => $domicile,	
		'province' => $province,	
		'city_name' => $city_name,	
		'message' => $message,
		'job_resume' => 'resume_1552575517.pdf',
		//'job_resume' => $fname,

		'application_status' => '1',


		'created_at' => date('Y-m-d h:i:s')

		);

		$result = $this->Job_post_model->add_resume($data);

			$this->session->set_flashdata('message', 'Application Submitted Successfully');
                redirect($_SERVER['HTTP_REFERER']); 
		 

			//$Return['result'] = $this->lang->line('xin_success_resume_submitted');

			

			//get setting info 

			//$setting = $this->Xin_model->read_setting_info(1);

			 

			

		 

		//$this->output($Return);

		exit;

		}

	}

}

