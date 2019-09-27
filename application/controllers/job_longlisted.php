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

 * @author   Ayat Ullah Khan - CTC

 * @package  Ayat Ullah Khan@CTC - Job Candidates

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Job_longlisted extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		//load the model

		$this->load->model("Job_post_model");

		$this->load->model("Xin_model");

		$this->load->model("Designation_model");

		$this->load->model("Job_criteria_model");

		$this->load->model('Job_longlisted_model'); 

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

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}

		$data['title'] = $this->Xin_model->site_title();

		$data['breadcrumbs'] = 'Long Listed Candidates';//$this->lang->line('left_job_candidates');


		$data['path_url'] = 'job_longlisted';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('46',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("job_post/job_longlisted", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}		  

     }

 

 public function longlisttoshortlist($jobId) {

    if($this->Job_longlisted_model->updatelonglist($jobId)) // call the method from the controller
	    {
	       // echo 'update successful...';  	
	       $this->session->set_flashdata('message', 'Information Has been Successfully Inserted');

	       //echo $_SERVER['HTTP_REFERER']; // $this->agent->referrer();

			redirect($_SERVER['HTTP_REFERER']); 


	    }
	    else
	    {
	        echo 'update not successful...';
	    }


 }



  public function addapplicationtoReserve($jobId) {   

    
      $job_id =  $this->uri->segment(3);
	  $application_id =  $this->uri->segment(4);  
 
		 $this->Job_longlisted_model->addjobtoReserve($job_id);
		 $this->Job_longlisted_model->addapplicationtoReserve($application_id);

		 $this->session->set_flashdata('userselectedmessage', 'Applicant Reserved Successfully');

		redirect($_SERVER['HTTP_REFERER']); 


 }


	  public function activateReserve() {   

	    
	        $job_id =  $this->uri->segment(3);
		    $locationId =  $this->uri->segment(4);  
	 
			 $this->Job_longlisted_model->openReserve($job_id);
			 $this->Job_longlisted_model->locationClosed($locationId);

			 $this->session->set_flashdata('message', 'Reserved Applicant Activated Successfully');

			redirect($_SERVER['HTTP_REFERER']); 


	 }



  public function selectedtopermanant($jobId) {   

    
     $job_id =  $this->uri->segment(3);
	 $application_id =  $this->uri->segment(4);
	 $total_positions =  $this->uri->segment(5);

   	$data = array(
					'job_id' => $job_id,
					'user_id' => $application_id, 
					'sdt' => date('Y-m-d h:i:s'),
					);

	$this->db->where(" job_id =" . $job_id);
        $this->db->from('selected_candidates');
        $TuserSelected = $this->db->count_all_results();

        if($TuserSelected>=$total_positions){

        	$this->session->set_flashdata('positionsLimitMessage', 'Positions Limit Completeted');	

        }else{	 

		 $this->Job_longlisted_model->select_candidate($data);
		 $this->Job_longlisted_model->update_user_to_select($application_id);
		 $this->session->set_flashdata('userselectedmessage', 'User Selected Successfully');

		}

		

		redirect($_SERVER['HTTP_REFERER']); 


 }



  public function selectedtopermanantR($jobId) {   

    
     $job_id =  $this->uri->segment(3);
	 $application_id =  $this->uri->segment(4);
	 $total_positions =  $this->uri->segment(5);

   	$data = array(
					'job_id' => $job_id,
					'user_id' => $application_id, 
					'sdt' => date('Y-m-d h:i:s'),
					);

	
		$this->db->where(" job_id =" . $job_id);
        $this->db->from('selected_candidates');
      
      /*  $TuserSelected = $this->db->count_all_results();

        if($TuserSelected>=$total_positions){

        	$this->session->set_flashdata('positionsLimitMessage', 'Positions Limit Completeted');	

        }else{	*/ 

		 $this->Job_longlisted_model->select_candidate($data);
		 $this->Job_longlisted_model->update_user_to_select2($application_id);
		 $this->session->set_flashdata('userselectedmessage', 'User Selected Successfully');

		//}

		

		redirect($_SERVER['HTTP_REFERER']); 


 }




 public function addtolonglisted($jobId) {

    if($this->Job_longlisted_model->addtolonglist($jobId)) // call the method from the controller
	    {
	       // echo 'update successful...';  	
	       $this->session->set_flashdata('message', 'Information Has been Successfully Inserted');

	       //echo $_SERVER['HTTP_REFERER']; // $this->agent->referrer();

			redirect($_SERVER['HTTP_REFERER']); 


	    }
	    else
	    {
	        echo 'update not successful...';
	    }


 }



 public function closethisjob($jobId) {

    if($this->Job_longlisted_model->addtoclosedjob($jobId)) // call the method from the controller
	    {
	       // echo 'update successful...';  	
	       $this->session->set_flashdata('contactmessage', 'Job Closed Successfully');

	       //echo $_SERVER['HTTP_REFERER']; // $this->agent->referrer();

			redirect($_SERVER['HTTP_REFERER']); 


	    }
	    else
	    {
	        echo 'update not successful...';
	    }


 }


 public function getlonglistedsinglerecord($jobId) {

			 $jobdetails = $this->Job_longlisted_model->read_postedjob_information($jobId);

				 $gender = $jobdetails[0]->gender;
				 $age = $jobdetails[0]->age;
				 $education = $jobdetails[0]->education;
				 $minimum_experience = $jobdetails[0]->minimum_experience;
				 $domicile = $jobdetails[0]->domicile;
				 $province = $jobdetails[0]->province;
				 $city_name = $jobdetails[0]->city_name;


				 $data['allCandidates'] = $this->Job_longlisted_model->getCandidatesAuto($jobId,$gender,$age,$education,$minimum_experience,$province,$city_name);


				 $data['allCandidatesnn'] = $this->Job_longlisted_model->getCandidatesnn($jobId);                            
				 $data['getage'] = $this->Job_criteria_model->getAge($age);
				 $data['getEducation'] = $this->Job_criteria_model->education($education);
				 $data['getDomicile'] = $this->Job_criteria_model->domicile($domicile);
				 $data['getProvince'] = $this->Job_criteria_model->province($province);
				 $data['getcityName'] = $this->Job_criteria_model->getcity($city_name);
				    //print_r($data['allCandidates']);
				        $data['breadcrumbs'] = $this->lang->line('left_job_posts');
						$data['path_url'] = 'job_longlisted';
				        $data['subview'] = $this->load->view("job_post/job_longlisted", $data, TRUE);
							$this->load->view('layout_main', $data); //page load 
    }





public function getsinglejoballapplication($jobId) {

			 $jobdetails = $this->Job_longlisted_model->getjobdetails($jobId);

			  foreach($jobdetails as $jobdetails){
	                       $gender = $jobdetails->gender;
	                       $age = $jobdetails->age;
	                       $education = $jobdetails->education;
	                       $exp = $jobdetails->minimum_experience;
	                       $domicile = $jobdetails->domicile;
	                       $province = $jobdetails->province;
	                       $city_name = $jobdetails->city_name;
                       }

				 $data['allCandidates'] = $this->Job_longlisted_model->singlejoballCandidates($jobId);                            
				 $data['getage'] = $this->Job_criteria_model->getAge($age);
				 $data['getEducation'] = $this->Job_criteria_model->education($education);
				 $data['getDomicile'] = $this->Job_criteria_model->domicile($domicile);
				 $data['getProvince'] = $this->Job_criteria_model->province($province);
				 $data['getcityName'] = $this->Job_criteria_model->getcity($city_name);
				    //print_r($data['allCandidates']);
				        $data['breadcrumbs'] = $this->lang->line('left_job_posts');
						$data['path_url'] = 'job_longlisted';
				        $data['subview'] = $this->load->view("job_post/job_longlisted", $data, TRUE);
							$this->load->view('layout_main', $data); //page load 
    }



 


 public function getshortlistedrecord($jobId) {
  

 $jobdetails = $this->Job_longlisted_model->getjobdetails($jobId);
  
  foreach($jobdetails as $jobdetails){
                               $gender = $jobdetails->gender;
                               $age = $jobdetails->age;
                               $education = $jobdetails->education;
                               $exp = $jobdetails->minimum_experience;

                               $domicile = $jobdetails->domicile;
                               $province = $jobdetails->province;
                               $city_name = $jobdetails->city_name;

                            }
 

 //$data['allCandidates'] = $this->Job_longlisted_model->getShortlistCandidates($jobId,$gender,$age,$education,$exp,$domicile,$province,$city_name);
 $data['allCandidates'] = $this->Job_longlisted_model->getShortlistCandidatesnn($jobId);                            

 $data['getage'] = $this->Job_criteria_model->getAge($age);
 
 $data['getEducation'] = $this->Job_criteria_model->education($education);
 
 $data['getDomicile'] = $this->Job_criteria_model->domicile($domicile);
  
 $data['getProvince'] = $this->Job_criteria_model->province($province);

 $data['getcityName'] = $this->Job_criteria_model->getcity($city_name);
   
    //print_r($data['allCandidates']);
        
        $data['breadcrumbs'] = $this->lang->line('left_job_posts');

		$data['path_url'] = 'job_longlisted';

        $data['subview'] = $this->load->view("job_post/job_longlisted", $data, TRUE);

			$this->load->view('layout_main', $data); //page load 
    }






 public function getReservedRecords($jobId) {
  

 $jobdetails = $this->Job_longlisted_model->getjobdetails($jobId);
  
  foreach($jobdetails as $jobdetails){
                               $gender = $jobdetails->gender;
                               $age = $jobdetails->age;
                               $education = $jobdetails->education;
                               $exp = $jobdetails->minimum_experience;

                               $domicile = $jobdetails->domicile;
                               $province = $jobdetails->province;
                               $city_name = $jobdetails->city_name;

                            }
 
 $data['allCandidates'] = $this->Job_longlisted_model->getReservedCandidates($jobId);                            

 $data['getage'] = $this->Job_criteria_model->getAge($age);
 
 $data['getEducation'] = $this->Job_criteria_model->education($education);
 
 $data['getDomicile'] = $this->Job_criteria_model->domicile($domicile);
  
 $data['getProvince'] = $this->Job_criteria_model->province($province);

 $data['getcityName'] = $this->Job_criteria_model->getcity($city_name);
   
    //print_r($data['allCandidates']);
        
        $data['breadcrumbs'] = $this->lang->line('left_job_posts');

		$data['path_url'] = 'job_longlisted';

        $data['subview'] = $this->load->view("job_post/job_longlisted", $data, TRUE);

			$this->load->view('layout_main', $data); //page load 
    }






 public function getselectedrecord($jobId) {
  

 $jobdetails = $this->Job_longlisted_model->getjobdetails($jobId);
  
  foreach($jobdetails as $jobdetails){
                               
$company_id = $jobdetails->company;
$designation_id = $jobdetails->designation_id;
$department_id = $jobdetails->department_id;
                               $gender = $jobdetails->gender;
                               $age = $jobdetails->age;
                               $education = $jobdetails->education;
                               $exp = $jobdetails->minimum_experience;
                               $domicile = $jobdetails->domicile;
                               $province = $jobdetails->province;
                               $city_name = $jobdetails->city_name;

                            }
$data = array('company_id' => $company_id, 'designation_id' => $designation_id, 'department_id' => $department_id);
 

 //$data['allCandidates'] = $this->Job_longlisted_model->getSelectedCandidates($jobId,$gender,$age,$education,$exp,$domicile,$province,$city_name);                            
$data['allCandidates'] = $this->Job_longlisted_model->getSelectedCandidatesnn2($jobId);
 $data['getage'] = $this->Job_criteria_model->getAge($age);
 
 $data['getEducation'] = $this->Job_criteria_model->education($education);
 
 $data['getDomicile'] = $this->Job_criteria_model->domicile($domicile);
  
 $data['getProvince'] = $this->Job_criteria_model->province($province);

 $data['getcityName'] = $this->Job_criteria_model->getcity($city_name);

 $data['all_job_types'] = $this->Job_post_model->all_job_types();

   
    //print_r($data['allCandidates']);
        
        $data['breadcrumbs'] = $this->lang->line('left_job_posts');

		$data['path_url'] = 'job_longlisted';

        $data['subview'] = $this->load->view("job_post/job_longlisted", $data, TRUE);

			$this->load->view('layout_main', $data); //page load 
    }




 public function reserveselectedrecord($jobId) {
  

 $jobdetails = $this->Job_longlisted_model->getjobdetails($jobId);
  
  foreach($jobdetails as $jobdetails){
                               
$company_id = $jobdetails->company;
$designation_id = $jobdetails->designation_id;
$department_id = $jobdetails->department_id;
                               $gender = $jobdetails->gender;
                               $age = $jobdetails->age;
                               $education = $jobdetails->education;
                               $exp = $jobdetails->minimum_experience;
                               $domicile = $jobdetails->domicile;
                               $province = $jobdetails->province;
                               $city_name = $jobdetails->city_name;

                            }
$data = array('company_id' => $company_id, 'designation_id' => $designation_id, 'department_id' => $department_id);
 

                            
 $data['allCandidates'] = $this->Job_longlisted_model->getReserveSelectedCandidates($jobId);
 $data['getage'] = $this->Job_criteria_model->getAge($age);
 
 $data['getEducation'] = $this->Job_criteria_model->education($education);
 
 $data['getDomicile'] = $this->Job_criteria_model->domicile($domicile);
  
 $data['getProvince'] = $this->Job_criteria_model->province($province);

 $data['getcityName'] = $this->Job_criteria_model->getcity($city_name);
   
    //print_r($data['allCandidates']);
        
        $data['breadcrumbs'] = $this->lang->line('left_job_posts');

		$data['path_url'] = 'job_longlisted';

        $data['subview'] = $this->load->view("job_post/job_longlisted", $data, TRUE);

			$this->load->view('layout_main', $data); //page load 
    }







    public function candidate_list()

     {



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("job_post/job_longlisted", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$candidates = $this->Job_post_model->get_jobs_candidates();

		

		$data = array();



        foreach($candidates->result() as $r) {

			 			  

		// get user

		$user = $this->Xin_model->read_user_info($r->user_id);

		// get full name

		if(!is_null($user)){

			$full_name = $user[0]->first_name. ' ' .$user[0]->last_name;

			$uemail = $user[0]->email;

		} else {

			$full_name = '--';	

			$uemail = '--';

		}

		// get job title

		$job = $this->Job_post_model->read_job_information($r->job_id);

		if(!is_null($job)){

			$job_title = $job[0]->job_title;

		} else {

			$job_title = '--';	

		}

		// get date

		$created_at = $this->Xin_model->set_date_format($r->created_at);

		

		$data[] = array(

			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_download').'">

			<a href="'.site_url().'download?type=resume&filename='.$r->job_resume.'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"><i class="fa fa-download"></i></button></a></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->application_id . '"><i class="fa fa-trash-o"></i></button></span>',

			$job_title,

			$full_name,

			$uemail,

			$r->application_status,

			$created_at

		);

      }



	  $output = array(

		   "draw" => $draw,

			 "recordsTotal" => $candidates->num_rows(),

			 "recordsFiltered" => $candidates->num_rows(),

			 "data" => $data

		);

	  echo json_encode($output);

	  exit();

     }

	 	

	// delete job candidate / job application	

	public function delete() {

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

		$id = $this->uri->segment(3);

		$result = $this->Job_post_model->delete_application_record($id);

		if(isset($id)) {

			$Return['result'] = $this->lang->line('xin_error_job_application');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

	}

}

