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

 * @package  Workable Zone - Complaints

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Complaints extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		//load the model

		$this->load->model("Complaints_model");

		$this->load->model("Xin_model");

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

		$data['breadcrumbs'] = $this->lang->line('left_complaints');

		$data['path_url'] = 'complaints';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('21',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("complaints/complaint_list", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}	  

     }

 

    public function complaint_list()

     {



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("complaints/complaint_list", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$complaint = $this->Complaints_model->get_complaints();

		

		$data = array();



        foreach($complaint->result() as $r) {

			 			  

		// get user > added by

		$user = $this->Xin_model->read_user_info($r->complaint_from);

		// user full name

		if(!is_null($user)){

			$complaint_from = $user[0]->first_name.' '.$user[0]->last_name;

		} else {

			$complaint_from = '--';	

		}

		// get complaint date

		$complaint_date = $this->Xin_model->set_date_format($r->complaint_date);

		

		if($r->complaint_against == '') {

			$ol = '--';

		} else {

			$ol = '<ol class="nl">';

			foreach(explode(',',$r->complaint_against) as $desig_id) {

				$_comp_name = $this->Xin_model->read_user_info($desig_id);

				if(!is_null($_comp_name)){

					$ol .= '<li>'.$_comp_name[0]->first_name.' '.$_comp_name[0]->last_name.'</li>';

				} else {

					$ol .= '';

				}

				

			 }

			 $ol .= '</ol>';

		}

		

		// get status

		if($r->status==0): $status = $this->lang->line('xin_pending');

		elseif($r->status==1): $status = $this->lang->line('xin_accepted'); else: $status = $this->lang->line('xin_rejected'); endif;

		

		$data[] = array(

			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-complaint_id="'. $r->complaint_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_view').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-complaint_id="'. $r->complaint_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->complaint_id . '"><i class="fa fa-trash-o"></i></button></span>',

			$complaint_from,

			$ol,

			$r->title,

			$complaint_date,

			$status

		);

      }



	  $output = array(

		   "draw" => $draw,

			 "recordsTotal" => $complaint->num_rows(),

			 "recordsFiltered" => $complaint->num_rows(),

			 "data" => $data

		);

	  echo json_encode($output);

	  exit();

     }

	 

	 public function read()

	{

		$data['title'] = $this->Xin_model->site_title();

		$id = $this->input->get('complaint_id');

		$result = $this->Complaints_model->read_complaint_information($id);

		$data = array(

				'complaint_id' => $result[0]->complaint_id,

				'complaint_from' => $result[0]->complaint_from,

				'title' => $result[0]->title,

				'complaint_date' => $result[0]->complaint_date,

				'complaint_against' => $result[0]->complaint_against,

				'description' => $result[0]->description,

				'status' => $result[0]->status,

				'all_employees' => $this->Xin_model->all_employees(),

				);

			$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view('complaints/dialog_complaint', $data);

		} else {

			redirect('');

		}

	}

	

	// Validate and add info in database

	public function add_complaint() {

	

		if($this->input->post('add_type')=='complaint') {		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		$description = $this->input->post('description');

		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);

		

		if($this->input->post('employee_id')==='') {

       		 $Return['error'] = $this->lang->line('xin_error_complaint_from');

		} else if($this->input->post('title')==='') {

			$Return['error'] = $this->lang->line('xin_error_complaint_title');

		} else if($this->input->post('complaint_date')==='') {

			 $Return['error'] = $this->lang->line('xin_error_complaint_date');

		} else if(empty($this->input->post('complaint_against'))) {

			 $Return['error'] = $this->lang->line('xin_error_complaint_against');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

		$complaint_against_ids = implode(',',$this->input->post('complaint_against'));

	

		$data = array(

		'complaint_from' => $this->input->post('employee_id'),

		'title' => $this->input->post('title'),

		'description' => $qt_description,

		'complaint_date' => $this->input->post('complaint_date'),

		'complaint_against' => $complaint_against_ids,

		'created_at' => date('d-m-Y'),

		

		);

		$result = $this->Complaints_model->add($data);

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_complaint_added');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

		exit;

		}

	}

	

	// Validate and update info in database

	public function update() {

	

		if($this->input->post('edit_type')=='complaint') {

			

		$id = $this->uri->segment(3);

		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		$description = $this->input->post('description');

		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);

		

		if($this->input->post('employee_id')==='') {

       		 $Return['error'] = $this->lang->line('xin_error_complaint_from');

		} else if($this->input->post('title')==='') {

			$Return['error'] = $this->lang->line('xin_error_complaint_title');

		} else if($this->input->post('complaint_date')==='') {

			 $Return['error'] = $this->lang->line('xin_error_complaint_date');

		} else if(empty($this->input->post('complaint_against'))) {

			 $Return['error'] = $this->lang->line('xin_error_complaint_against');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

		$complaint_against_ids = implode(',',$this->input->post('complaint_against'));

	

		$data = array(

		'complaint_from' => $this->input->post('employee_id'),

		'title' => $this->input->post('title'),

		'description' => $qt_description,

		'complaint_date' => $this->input->post('complaint_date'),

		'complaint_against' => $complaint_against_ids,

		'status' => $this->input->post('status'),

		);

		

		$result = $this->Complaints_model->update_record($data,$id);		

		

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_complaint_updated');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

		exit;

		}

	}

	

	public function delete() {

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

		$id = $this->uri->segment(3);

		$result = $this->Complaints_model->delete_record($id);

		if(isset($id)) {

			$Return['result'] = $this->lang->line('xin_success_complaint_deleted');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

	}

}

