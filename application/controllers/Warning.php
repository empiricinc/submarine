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

 * @package  Workable Zone - Warning

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Warning extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		//load the model

		$this->load->model("Warning_model");

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

		$data['all_warning_types'] = $this->Warning_model->all_warning_types();

		$data['breadcrumbs'] = $this->lang->line('left_warnings');

		$data['path_url'] = 'warning';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('22',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("warning/warning_list", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}

     }

 

    public function warning_list() {



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("warning/warning_list", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$warning = $this->Warning_model->get_warning();

		

		$data = array();



        foreach($warning->result() as $r) {

			 			  

		// get user > warning to

		$user = $this->Xin_model->read_user_info($r->warning_to);

		// user full name

		if(!is_null($user)){

			$warning_to = $user[0]->first_name.' '.$user[0]->last_name;

		} else {

			$warning_to = '--';	

		}

		// get user > warning by

		$user_by = $this->Xin_model->read_user_info($r->warning_by);

		// user full name

		if(!is_null($user_by)){

			$warning_by = $user_by[0]->first_name.' '.$user_by[0]->last_name;

		} else {

			$warning_by = '--';	

		}

		// get warning date

		$warning_date = $this->Xin_model->set_date_format($r->warning_date);

				

		// get status

		if($r->status==0): $status = $this->lang->line('xin_pending');

		elseif($r->status==1): $status = $this->lang->line('xin_accepted'); else: $status = $this->lang->line('xin_rejected'); endif;

		// get warning type

		$warning_type = $this->Warning_model->read_warning_type_information($r->warning_type_id);

		if(!is_null($warning_type)){

			$wtype = $warning_type[0]->type;

		} else {

			$wtype = '--';	

		}

		

		$data[] = array(

			'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target=".edit-modal-data"  data-warning_id="'. $r->warning_id . '"><i class="fa fa-pencil-square-o"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_view').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-warning_id="'. $r->warning_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->warning_id . '"><i class="fa fa-trash-o"></i></button></span>',

			$warning_to,

			$warning_date,

			$r->subject,

			$wtype,

			$status,

			$warning_by

		);

      }



	  $output = array(

		   "draw" => $draw,

			 "recordsTotal" => $warning->num_rows(),

			 "recordsFiltered" => $warning->num_rows(),

			 "data" => $data

		);

	  echo json_encode($output);

	  exit();

     }

	 

	 public function read()

	{

		$data['title'] = $this->Xin_model->site_title();

		$id = $this->input->get('warning_id');

		$result = $this->Warning_model->read_warning_information($id);

		$data = array(

				'warning_id' => $result[0]->warning_id,

				'warning_to' => $result[0]->warning_to,

				'warning_by' => $result[0]->warning_by,

				'warning_date' => $result[0]->warning_date,

				'warning_type_id' => $result[0]->warning_type_id,

				'subject' => $result[0]->subject,

				'description' => $result[0]->description,

				'status' => $result[0]->status,

				'all_employees' => $this->Xin_model->all_employees(),

				'all_warning_types' => $this->Warning_model->all_warning_types(),

				);

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view('warning/dialog_warning', $data);

		} else {

			redirect('');

		}

	}

	

	// Validate and add info in database

	public function add_warning() {

	

		if($this->input->post('add_type')=='warning') {		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		$description = $this->input->post('description');

		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);

		

		if($this->input->post('warning_to')==='') {

       		 $Return['error'] = $this->lang->line('xin_employee_error_warning');

		} else if($this->input->post('type')==='') {

			$Return['error'] = $this->lang->line('xin_employee_error_warning_type');

		} else if($this->input->post('subject')==='') {

			 $Return['error'] = $this->lang->line('xin_employee_error_subject');

		} else if(empty($this->input->post('warning_by'))) {

			 $Return['error'] = $this->lang->line('xin_employee_error_warning_by');

		} else if(empty($this->input->post('warning_date'))) {

			 $Return['error'] = $this->lang->line('xin_employee_error_warning_date');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

	

		$data = array(

		'warning_to' => $this->input->post('warning_to'),

		'warning_type_id' => $this->input->post('type'),

		'description' => $qt_description,

		'subject' => $this->input->post('subject'),

		'warning_by' => $this->input->post('warning_by'),

		'warning_date' => $this->input->post('warning_date'),

		'status' => '0',

		'created_at' => date('d-m-Y'),

		);

		$result = $this->Warning_model->add($data);

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_employee_warning_added');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

		exit;

		}

	}

	

	// Validate and update info in database

	public function update() {

	

		if($this->input->post('edit_type')=='warning') {

			

		$id = $this->uri->segment(3);

		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		$description = $this->input->post('description');

		$qt_description = htmlspecialchars(addslashes($description), ENT_QUOTES);

		

		if($this->input->post('warning_to')==='') {

       		 $Return['error'] = $this->lang->line('xin_employee_error_warning');

		} else if($this->input->post('type')==='') {

			$Return['error'] = $this->lang->line('xin_employee_error_warning_type');

		} else if($this->input->post('subject')==='') {

			 $Return['error'] = $this->lang->line('xin_employee_error_subject');

		} else if(empty($this->input->post('warning_by'))) {

			 $Return['error'] = $this->lang->line('xin_employee_error_warning_by');

		} else if(empty($this->input->post('warning_date'))) {

			 $Return['error'] = $this->lang->line('xin_employee_error_warning_date');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

	

		$data = array(

		'warning_to' => $this->input->post('warning_to'),

		'warning_type_id' => $this->input->post('type'),

		'description' => $qt_description,

		'subject' => $this->input->post('subject'),

		'warning_by' => $this->input->post('warning_by'),

		'warning_date' => $this->input->post('warning_date'),

		'status' => $this->input->post('status'),

		);

		

		$result = $this->Warning_model->update_record($data,$id);		

		

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_employee_warning_updated');

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

		$result = $this->Warning_model->delete_record($id);

		if(isset($id)) {

			$Return['result'] = $this->lang->line('xin_employee_warning_deleted');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

	}

}

