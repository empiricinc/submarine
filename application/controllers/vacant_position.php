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

 * @package  Ayat Ullah Khan@CTC - Job Post

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Vacant_position extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		$this->load->model("Job_post_model");

		$this->load->model("Xin_model");

		$this->load->model("Location_model");

		$this->load->model("Designation_model");

		$this->load->model("Department_model");

        $this->load->model('ProvinceCity');

        $this->load->model('Job_longlisted_model'); // load model
        
		$this->load->model("Company_model");





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


		$data['projid'] = $session['project_id'];
		$data['provid'] = $session['provience_id'];

		//$data['sl1'] = $this->session->userdata('accessLevel');
		$data['sl2'] = $this->session->userdata('accessLevel');
		$data['sl3'] = $this->session->userdata('accessLevel'); //echo $data['sl3']['accessLevel3']; exit();

		$data['title'] = $this->Xin_model->site_title();

        $data['geProvinces'] = $this->ProvinceCity->getAllProvinces();   
        $data['getakcity'] = $this->ProvinceCity->getCity();   
		        
		/*if($_POST){ ($this->input->post('province_id')=='all') ?  $data['location_job_position'] = $this->Location_model->all_location_job_positionCondiall($_POST['company_id']) : $data['location_job_position'] = $this->Location_model->all_location_job_positionCondi($_POST['company_id'],$_POST['province_id']);
		}else{
			//if($data['sl2']['accessLevel2']){
			if(isset($data['sl2']['accessLevel2'])  &&  !empty($data['sl2']['accessLevel2'])){	
				        $data['location_job_position'] = $this->Location_model->all_location_job_position();
				 }else{ 
			            $data['location_job_position'] = $this->Location_model->all_location_job_positionn($projid,$provid);
			          }			 			 
		}
		*/



		$data['all_designations'] = $this->Designation_model->all_designations();
		
		$data['all_departments'] = $this->Department_model->all_departments();

		$data['all_companies'] = $this->Xin_model->get_companies();


		$data['all_job_types'] = $this->Job_post_model->all_job_types();


		$data['breadcrumbs'] = $this->lang->line('left_job_posts');

	    $data['path_url'] = 'vacant_position';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('45',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("job_post/vacant_position", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}

     }

	  
 


 





    public function weakened_position()

     {/*



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("job_post/weakened_position", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$jobs = $this->Job_post_model->get_jobs();

		

		$data = array();



        foreach($jobs->result() as $r) {

			 			  



		// get job designation

		$designation = $this->Designation_model->read_designation_information($r->designation_id);

		if(!is_null($designation)){

			$designation_name = $designation[0]->designation_name;

		} else {

			$designation_name = '--';

		}

		// get job type

		$job_type = $this->Job_post_model->read_job_type_information($r->job_type);

		if(!is_null($job_type)){

			$jtype = $job_type[0]->type;

		} else {

			$jtype = '--';

		}

		// get date

		$date_of_closing = $this->Xin_model->set_date_format($r->date_of_closing);

		$created_at = $this->Xin_model->set_date_format($r->created_at);

		 

		if($r->status==1): $status = $this->lang->line('xin_published'); elseif($r->status==2): $status = $this->lang->line('xin_unpublished'); endif;

		

		$data[] = array(

			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-job_id="'. $r->job_id . '"><i class="fa fa-pencil-square-o"></i></button></span><a href="'.site_url().'frontend/jobs/detail/'.$r->job_id.'" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$this->lang->line('xin_view').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"><i class="fa fa-eye"></i></button></a><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->job_id . '"><i class="fa fa-trash-o"></i></button></span>',

			$r->job_title,

			$designation_name,

			$jtype,

			$r->job_vacancy,

			$date_of_closing,

			$status,

			$created_at

		);

      }



	  $output = array(

		   "draw" => $draw,

			 "recordsTotal" => $jobs->num_rows(),

			 "recordsFiltered" => $jobs->num_rows(),

			 "data" => $data

		);

	  echo json_encode($output);

	  exit();*/

     }

	 

	 public function read()

	{/*

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

				'all_companies' => $this->Xin_model->get_companies(),


				'all_job_types' => $this->Job_post_model->all_job_types()

				);

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view('job_post/dialog_job_post', $data);

		} else {

			redirect('');

		}
*/
	}

	

	// Validate and add info in database

	public function add_job() {

	

		if($this->input->post('add_type')=='job') {		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		$long_description = $_POST['long_description'];	

		$short_description = $_POST['short_description'];	

		$qt_short_description = htmlspecialchars(addslashes($short_description), ENT_QUOTES);

		$qt_description = htmlspecialchars(addslashes($long_description), ENT_QUOTES);

		 

	

		$data = array(

		'company' => $this->input->post('company'), 
		


		'job_title' => $this->input->post('job_title'), 

		'job_type' => $this->input->post('job_type'),

		'designation_id' => $this->input->post('designation_id'),

		'status' => $this->input->post('status'),

		'job_vacancy' => $this->input->post('vacancy'),

		'date_of_closing' => $this->input->post('date_of_closing'),
		
		'province' => $this->input->post('province'),
		'city_name' => $this->input->post('city_name'),
		'area_name' => $this->input->post('area_name'),
		'province' => $this->input->post('province'),
		'long_description' => $qt_description,
		'gender' => $this->input->post('gender'),
		'minimum_experience' => $this->input->post('experience'),
		'domicile' => $this->input->post('domicile'),	
		'cnic' => $this->input->post('cnic'),		
		'education' => $this->input->post('education'),		
		'age' => $this->input->post('age'),		

		'short_description' => $qt_short_description,

	

		'created_at' => date('Y-m-d h:i:s'),

		

		);

		$result = $this->Job_post_model->add($data);

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_job_added');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

		exit;

		}

	}





 


 


	

	 

	
 

}

