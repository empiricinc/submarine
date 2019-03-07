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

 * @author   Mian Abdullah Jan - Workable Zone

 * @package  Workable Zone - User > Job Interviews

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Job_interviews extends MY_Controller {

	

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

		$data['all_employees'] = $this->Xin_model->all_employees();

		$data['all_interview_jobs'] = $this->Job_post_model->all_interview_jobs();

		$data['breadcrumbs'] = $this->lang->line('left_job_interviews');

		$data['path_url'] = 'user/user_job_interviews';

		if(!empty($session)){ 

			$data['subview'] = $this->load->view("user/job_interviews", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

		} else {

			redirect('');

		}

		  

     }

 

    public function interview_list()

     {



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("user/job_interviews", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$interview = $this->Job_post_model->all_interviews();

		

		$data = array();



        foreach($interview->result() as $r) {

			

		$aim = explode(',',$r->interviewees_id);

		foreach($aim as $dIds) {

		if($session['user_id'] == $dIds) {

		

		// get job title

		$job = $this->Job_post_model->read_job_information($r->job_id);

		if(!is_null($job)){

			$job_title = $job[0]->job_title;

		} else {

			$job_title = '--';	

		}

		// get date

		$interview_date = $this->Xin_model->set_date_format($r->interview_date);		

				

		// get interviewers

		/*if($r->interviewers_id == '') {

			$interviewers = '-';

		} else {

			$interviewers = '<ol class="nl">';

		foreach(explode(',',$r->interviewers_id) as $interviewers_id) {

			$user_intwer = $this->Xin_model->read_user_info($interviewers_id);

			$interviewers .= '<li>'.$user_intwer[0]->first_name. ' '.$user_intwer[0]->last_name.'</li>';

			}

			$interviewers .= '</ol>';

		}*/

		

		// get time

		$interview_time = $r->interview_date.' '.$r->interview_time;

		$interview_ex_time =  new DateTime($interview_time);

		$int_time = $interview_ex_time->format('h:i a');

		

		// interview date and time

		$interview_d_t = $interview_date.' '.$int_time;

		// interview added by

		$u_added = $this->Xin_model->read_user_info($r->added_by);

		// user full name

		if(!is_null($u_added)){

			$int_addedby = $u_added[0]->first_name. ' '.$u_added[0]->last_name;

		} else {

			$int_addedby = '--';	

		}

		// interview message

		$description = html_entity_decode($r->description);

		$data[] = array(

			'<a href="'.site_url().'frontend/jobs/detail/'.$r->job_id.'/" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"><i class="fa fa-arrow-circle-right"></i></button></a>',

			$job_title,

			$description,

			$r->interview_place,

			$interview_d_t,

			$int_addedby

		);

      }

		} } // e-interviews

	  $output = array(

		   "draw" => $draw,

			 "recordsTotal" => $interview->num_rows(),

			 "recordsFiltered" => $interview->num_rows(),

			 "data" => $data

		);

	  echo json_encode($output);

	  exit();

     }

}

