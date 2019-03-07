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

 * @package  Workable Zone - Performance Indicator

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Performance_indicator extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		//load the model

		$this->load->model("Performance_indicator_model");

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

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}

		$data['title'] = $this->Xin_model->site_title();

		$data['all_designations'] = $this->Designation_model->all_designations();

		$data['breadcrumbs'] = $this->lang->line('left_performance_indicator');

		$data['path_url'] = 'performance_indicator';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('24',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("performance/performance_indicator_list", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}

     }

 

    public function performance_indicator_list()

     {



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("performance/performance_indicator_list", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$performance = $this->Performance_indicator_model->get_performance_indicator();

		

		$data = array();



        foreach($performance->result() as $r) {

			 			  

		// created date

		$created_at = $this->Xin_model->set_date_format($r->created_at);

		// get user > added by

		$user = $this->Xin_model->read_user_info($r->added_by);

		// user full name

		if(!is_null($user)){

			$full_name = $user[0]->first_name.' '.$user[0]->last_name;

		} else {

			$full_name = '--';	

		}

		// get designation

		$designation = $this->Designation_model->read_designation_information($r->designation_id);

		if(!is_null($designation)){

			$ides = $designation[0]->designation_name;

			$idepartment = $this->Department_model->read_department_information($designation[0]->department_id);

			if(!is_null($idepartment)){

				$department = $idepartment[0]->department_name;

			} else {

				$department = '--';

			}

		} else {

			$department = '--';	

			$ides = '--';

		}

		// department

		

		if(!is_null($user)){

			$full_name = $user[0]->first_name.' '.$user[0]->last_name;

		} else {

			$full_name = '--';	

		}

		

		$data[] = array(

			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_view').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light view-data" data-toggle="modal" data-target=".view-modal-data" data-p_indicator_id="'. $r->performance_indicator_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-performance_indicator_id="'. $r->performance_indicator_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->performance_indicator_id . '"><i class="fa fa-trash-o"></i></button></span>',

			$ides,

			$department,

			$full_name,

			$created_at

		);

      }



	  $output = array(

		   "draw" => $draw,

			 "recordsTotal" => $performance->num_rows(),

			 "recordsFiltered" => $performance->num_rows(),

			 "data" => $data

		);

	  echo json_encode($output);

	  exit();

     }

	 

	 public function read()

	{

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}

		$data['title'] = $this->Xin_model->site_title();

		$id = $this->input->get('performance_indicator_id');

		$result = $this->Performance_indicator_model->read_performance_indicator_information($id);

		$data = array(

				'performance_indicator_id' => $result[0]->performance_indicator_id,

				'designation_id' => $result[0]->designation_id,

				'customer_experience' => $result[0]->customer_experience,

				'marketing' => $result[0]->marketing,

				'management' => $result[0]->management,

				'administration' => $result[0]->administration,

				'presentation_skill' => $result[0]->presentation_skill,

				'quality_of_work' => $result[0]->quality_of_work,

				'efficiency' => $result[0]->efficiency,

				'integrity' => $result[0]->integrity,

				'professionalism' => $result[0]->professionalism,

				'team_work' => $result[0]->team_work,

				'critical_thinking' => $result[0]->critical_thinking,

				'conflict_management' => $result[0]->conflict_management,

				'attendance' => $result[0]->attendance,

				'ability_to_meet_deadline' => $result[0]->ability_to_meet_deadline,

				'all_designations' => $this->Designation_model->all_designations()

				);

		if(!empty($session)){ 

			$this->load->view('performance/dialog_indicator', $data);

		} else {

			redirect('');

		}

	}

	

	// Validate and add info in database

	public function add_indicator() {

	

		if($this->input->post('add_type')=='indicator') {		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */		

		if($this->input->post('designation_id')==='') {

       		$Return['error'] = $this->lang->line('xin_error_designation_field');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

	

		$data = array(

		'customer_experience' => $this->input->post('customer_experience'),

		'marketing' => $this->input->post('marketing'),

		'designation_id' => $this->input->post('designation_id'),

		'management' => $this->input->post('management'),

		'administration' => $this->input->post('administration'),

		'presentation_skill' => $this->input->post('presentation_skill'),

		'quality_of_work' => $this->input->post('quality_of_work'),

		'efficiency' => $this->input->post('efficiency'),

		'integrity' => $this->input->post('integrity'),

		'professionalism' => $this->input->post('professionalism'),

		'team_work' => $this->input->post('team_work'),

		'critical_thinking' => $this->input->post('critical_thinking'),

		'conflict_management' => $this->input->post('conflict_management'),

		'attendance' => $this->input->post('attendance'),

		'ability_to_meet_deadline' => $this->input->post('ability_to_meet_deadline'),

		'added_by' => $this->input->post('user_id'),

		'created_at' => date('d-m-Y'),

		

		);

		$result = $this->Performance_indicator_model->add($data);

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_performance_added');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

		exit;

		}

	}

	

	// Validate and update info in database

	public function update() {

	

		if($this->input->post('edit_type')=='indicator') {

			

		$id = $this->uri->segment(3);

		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */		

		if($this->input->post('designation_id')==='') {

       		$Return['error'] = $this->lang->line('xin_error_designation_field');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

	

		$data = array(

		'customer_experience' => $this->input->post('customer_experience'),

		'marketing' => $this->input->post('marketing'),

		'designation_id' => $this->input->post('designation_id'),

		'management' => $this->input->post('management'),

		'administration' => $this->input->post('administration'),

		'presentation_skill' => $this->input->post('presentation_skill'),

		'quality_of_work' => $this->input->post('quality_of_work'),

		'efficiency' => $this->input->post('efficiency'),

		'integrity' => $this->input->post('integrity'),

		'professionalism' => $this->input->post('professionalism'),

		'team_work' => $this->input->post('team_work'),

		'critical_thinking' => $this->input->post('critical_thinking'),

		'conflict_management' => $this->input->post('conflict_management'),

		'attendance' => $this->input->post('attendance'),

		'ability_to_meet_deadline' => $this->input->post('ability_to_meet_deadline')

		);

		

		$result = $this->Performance_indicator_model->update_record($data,$id);		

		

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_performance_updated');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

		exit;

		}

	}

	

	public function delete() {

		

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

		$id = $this->uri->segment(3);

		$result = $this->Performance_indicator_model->delete_record($id);

		if(isset($id)) {

			$Return['result'] = $this->lang->line('xin_success_performance_deleted');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

	}

}

