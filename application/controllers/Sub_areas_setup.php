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

 * @package  Ayat Ullah Khan@CTC - Locations

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */


defined('BASEPATH') OR exit('No direct script access allowed');



class Sub_areas_setup extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		$this->load->model("Designation_model");

		$this->load->model("Department_model");
		 

		$this->load->model("Location_model");

		$this->load->model("Xin_model");

		$this->load->model('All_setups_model');

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

		$data['title'] = $this->Xin_model->site_title();

		//$data['all_countries'] = $this->Xin_model->get_countries();

        //$data['geProvinces'] = $this->All_setups_model->getAllProvinces(); 

        //$data['all_tehsil'] = $this->All_setups_model->all_tehsil();   

        $data['all_uc'] = $this->All_setups_model->all_uc();   
        $data['allareas'] = $this->All_setups_model->allareas();   
        $data['all_sub_areas'] = $this->All_setups_model->all_sub_areas();   
        



		//$data['all_companies'] = $this->Xin_model->get_companies();

		//$data['all_employees'] = $this->Xin_model->all_employees();

		/*if ($_POST) {  ($this->input->post('province_id')=='all') ? $data['all_locations'] = $this->Location_model->all_office_locationsCondiall($_POST['company_id']) :  $data['all_locations'] = $this->Location_model->all_office_locationsCondi($_POST['company_id'],$_POST['province_id']);
							
				} else {
						$data['all_locations'] = $this->Location_model->all_office_locations();

				}
					*/	
		 
		

		//$data['all_designations'] = $this->Designation_model->all_designations();

		//$data['all_departments'] = $this->Department_model->all_departments();

		//$data['all_projects'] = $this->Company_model->read_company_information();

		$data['breadcrumbs'] = $this->lang->line('xin_locations');

		$data['path_url'] = 'areas_setup';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('4',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("setup-form/sub_areas_setup_list", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}		  

     }

 

    public function location_list()

     {



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("location/location_list", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$location = $this->Location_model->get_locations();

		

		$data = array();



          foreach($location->result() as $r) {

			  

			  // get country

			  $country = $this->Xin_model->read_country_info($r->country);

			  if(!is_null($country)){

			  	$c_name = $country[0]->country_name;

			  } else {

				  $c_name = '--';	

			  }

			  // get company

			  $company = $this->Xin_model->read_company_info($r->company_id);

			  if(!is_null($company)){

			  	$comp_name = $company[0]->name;

			  } else {

				  $comp_name = '--';	

			  }

			  // get user

			  $user = $this->Xin_model->read_user_info($r->added_by);

			  // user full name

			  if(!is_null($user)){

			  	$full_name = $user[0]->first_name.' '.$user[0]->last_name;

			  } else {

				$full_name = '--';	

			  }

			  

			   // get location head

			  $location_head = $this->Xin_model->read_user_info($r->location_head);

			  // user full name

			   if(!is_null($location_head)){

			  	$head_name = $location_head[0]->first_name.' '.$location_head[0]->last_name;

			  } else {

				  $head_name = '--';	

			  }



               $data[] = array(

			   		'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_edit').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light"  data-toggle="modal" data-target="#edit-modal-data"  data-location_id="'. $r->location_id . '"><i class="fa fa-pencil-square-o"></i></button></span></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_view').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-location_id="'. $r->location_id . '"><i class="fa fa-eye"></i></button></span><span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $r->location_id . '"><i class="fa fa-trash-o"></i></button></span>',

                    $r->location_name,

					$head_name,

                    $comp_name,

                    $r->city,

                    $c_name,

					$full_name

               );

          }



          $output = array(

               "draw" => $draw,

                 "recordsTotal" => $location->num_rows(),

                 "recordsFiltered" => $location->num_rows(),

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

		$id = $this->input->get('location_id');

       // $data['all_countries'] = $this->xin_model->get_countries();

		$result = $this->Location_model->read_location_information($id);

		$data = array(

				'location_id' => $result[0]->location_id,

				'company_id' => $result[0]->company_id,

				'location_head' => $result[0]->location_head,

				'location_manager' => $result[0]->location_manager,

				'location_name' => $result[0]->location_name,

				'email' => $result[0]->email,

				'phone' => $result[0]->phone,

				'fax' => $result[0]->fax,

				'address_1' => $result[0]->address_1,

				'address_2' => $result[0]->address_2,

				'city' => $result[0]->city,

				'state' => $result[0]->state,

				'zipcode' => $result[0]->zipcode,

				'countryid' => $result[0]->country,

				'all_countries' => $this->Xin_model->get_countries(),

				'all_companies' => $this->Xin_model->get_companies(),

				'all_employees' => $this->Xin_model->all_employees()

				);

		if(!empty($session)){ 

			$this->load->view('location/dialog_location', $data);

		} else {

			redirect('');

		}

	}

	

	public function read_info()

	{

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}

		$data['title'] = $this->Xin_model->site_title();

		$id = $this->input->get('location_id');

       // $data['all_countries'] = $this->xin_model->get_countries();

		$result = $this->Location_model->read_location_information($id);

		$data = array(

				'location_id' => $result[0]->location_id,

				'company_id' => $result[0]->company_id,

				'location_head' => $result[0]->location_head,

				'location_manager' => $result[0]->location_manager,

				'location_name' => $result[0]->location_name,

				'email' => $result[0]->email,

				'phone' => $result[0]->phone,

				'fax' => $result[0]->fax,

				'address_1' => $result[0]->address_1,

				'address_2' => $result[0]->address_2,

				'city' => $result[0]->city,

				'state' => $result[0]->state,

				'zipcode' => $result[0]->zipcode,

				'countryid' => $result[0]->country,

				'all_countries' => $this->Xin_model->get_countries(),

				'all_companies' => $this->Xin_model->get_companies(),

				'all_employees' => $this->Xin_model->all_employees()

				);

		if(!empty($session)){ 

			$this->load->view('location/view_location', $data);

		} else {

			redirect('');

		}

	}


	public function add_sub_area() {

	


		//if($this->input->post('location_option')) {

		 //print_r($_POST); exit();

		 
	

		$data = array(

		'name' => $this->input->post('name'),

		'area_id' => $this->input->post('id'),
 
		);

		$result = $this->Location_model->add_subarea($data);

		 

				$this->session->set_flashdata('messageSuccess', 'Sub Area Added Successfully');
                redirect($_SERVER['HTTP_REFERER']); 


		exit;

		/*}else{ 
				$this->session->set_flashdata('error', 'error');
                redirect($_SERVER['HTTP_REFERER']); 


		}*/

	}


	public function add_areas() {

	


		//if($this->input->post('location_option')) {

		 //print_r($_POST); exit();

		 
	

		$data = array(

		'name' => $this->input->post('name'),

		'area_id' => $this->input->post('id'),
 
		);

		$result = $this->Location_model->add_areas($data);

		 

				$this->session->set_flashdata('messageSuccess', 'Sub Area Added Successfully');
                redirect($_SERVER['HTTP_REFERER']); 


		exit;

		/*}else{ 
				$this->session->set_flashdata('error', 'error');
                redirect($_SERVER['HTTP_REFERER']); 


		}*/

	}
	

	// Validate and add info in database

	public function add_location() {

	


		if($this->input->post('location_option')) {

		 //print_r($_POST); exit();

		 
	

		$data = array(

		'company_id' => $this->input->post('company_id'),

		'province_id' => ($this->input->post('province_id')) ? $this->input->post('province_id') : '0',

		'city_id' => ($this->input->post('city_id')) ? $this->input->post('city_id') : '0',

		'district_id' => ($this->input->post('district_id')) ? $this->input->post('district_id') : '0',

		'tehsil_id' => ($this->input->post('tehsil_id')) ? $this->input->post('tehsil_id') : '0',

		'uc_id' => ($this->input->post('uc_id')) ? $this->input->post('uc_id') : '0',

		'area_id' => ($this->input->post('area_id')) ? $this->input->post('area_id') : '0',

		'sub_area_id' => ($this->input->post('sub_area_id')) ? $this->input->post('sub_area_id') : '0',
 
		'added_by' => $this->input->post('user_id'),

		'sdt' => date('Y-m-d h:i:s'),

		

		);

		$result = $this->Location_model->add($data);

		/*if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_add_location');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);*/

				$this->session->set_flashdata('messageSuccess', 'Application Form Added Successfully');
                redirect($_SERVER['HTTP_REFERER']); 


		exit;

		}else{ 
				$this->session->set_flashdata('error', 'Records/Locations not saved');
                redirect($_SERVER['HTTP_REFERER']); 


		}

	}

	

	// Validate and add info in database

	public function add_location_position() {

	
		if($_POST['sectionChooser']==1) {

		  foreach ($_POST['total_job_positions1'] as $key => $val) { //echo print_r($_POST['total_job_positions2']); exit();
							$data['job_code'] = $val;
							$data['location_id'] = $_POST['location_id'];
							$data['company_id'] = $_POST['company_id'];
							$data['province_id'] = $_POST['province_id'];
							$data['city_id'] = $_POST['city_id'];
							$data['district_id'] = $_POST['district_id'];
							$data['tehsil_id'] = $_POST['tehsil_id'];
							$data['uc_id'] = $_POST['uc_id'];
							$data['area_id'] = $_POST['area_id'];
							$data['sub_area_id'] = $_POST['sub_area_id'];
							
							$data['designation_id'] = $_POST['designation_id']; 
							$data['department_id'] = $_POST['department_id']; 
							$data['status'] = 0; 
				 			$data['sdt'] = date('Y-m-d H:i:s');
							$result1 = $this->Location_model->add_job_positions($data);
						} 
 
				$this->session->set_flashdata('messageSuccess', 'Application Form Added Successfully');
                redirect($_SERVER['HTTP_REFERER']); 

		}

		if($_POST['sectionChooser']==2) {   //echo print_r($_POST['total_job_positions2']); exit();

		  foreach ($_POST['total_job_positions2'] as $key => $val) {
							$data['job_code'] = $val;
							$data['location_id'] = $_POST['location_id']; 
							$data['company_id'] = $_POST['company_id'];
							$data['province_id'] = $_POST['province_id'];
							$data['city_id'] = $_POST['city_id'];
							$data['district_id'] = $_POST['district_id'];
							$data['tehsil_id'] = $_POST['tehsil_id'];
							$data['uc_id'] = $_POST['uc_id'];
							$data['area_id'] = $_POST['area_id'];
							$data['sub_area_id'] = $_POST['sub_area_id'];

							$data['designation_id'] = $_POST['designation_id']; 
							$data['department_id'] = $_POST['department_id'];
							$data['status'] = 0;  
				 			$data['sdt'] = date('Y-m-d H:i:s');
							$result2 = $this->Location_model->add_job_positions($data);
						} 
 
				$this->session->set_flashdata('messageSuccess', 'Application Form Added Successfully');
                redirect($_SERVER['HTTP_REFERER']); 

		}

		if($_POST['sectionChooser']==3) {

		  foreach ($_POST['total_job_positions3'] as $key => $val) {
							$data['job_code'] = $val;
							$data['location_id'] = $_POST['location_id'];
							$data['company_id'] = $_POST['company_id'];
							$data['province_id'] = $_POST['province_id'];
							$data['city_id'] = $_POST['city_id'];
							$data['district_id'] = $_POST['district_id'];
							$data['tehsil_id'] = $_POST['tehsil_id'];
							$data['uc_id'] = $_POST['uc_id'];
							$data['area_id'] = $_POST['area_id'];
							$data['sub_area_id'] = $_POST['sub_area_id'];

							$data['designation_id'] = $_POST['designation_id']; 
							$data['department_id'] = $_POST['department_id'];
							$data['status'] = 0; 
				 			$data['sdt'] = date('Y-m-d H:i:s');
							$result3 = $this->Location_model->add_job_positions($data);
						} 
 
				$this->session->set_flashdata('messageSuccess', 'Area Codes Added Successfully');
                redirect($_SERVER['HTTP_REFERER']); 

		}

		 

	}


	// Validate and update info in database

	public function update() {

	

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}

		if($this->input->post('edit_type')=='location') {

			

		$id = $this->uri->segment(3);

		

		// Check validation for user input

		$this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');

		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');

		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		if($this->input->post('company')==='') {

        	$Return['error'] = $this->lang->line('error_company_field');

		} else if($this->input->post('name')==='') {

			$Return['error'] = $this->lang->line('xin_error_name_field');

		} else if($this->input->post('location_head')==='') {

			$Return['error'] = $this->lang->line('error_locationhead_field');

		} else if($this->input->post('city')==='') {

			$Return['error'] = $this->lang->line('xin_error_city_field');

		} else if($this->input->post('country')==='') {

			$Return['error'] = $this->lang->line('xin_error_country_field');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

	

		$data = array(

		'company_id' => $this->input->post('company'),

		'location_name' => $this->input->post('name'),

		'location_head' => $this->input->post('location_head'),

		'location_manager' => $this->input->post('location_manager'),

		'email' => $this->input->post('email'),

		'phone' => $this->input->post('phone'),

		'fax' => $this->input->post('fax'),

		'address_1' => $this->input->post('address_1'),

		'address_2' => $this->input->post('address_2'),

		'city' => $this->input->post('city'),

		'state' => $this->input->post('state'),

		'zipcode' => $this->input->post('zipcode'),

		'country' => $this->input->post('country'),		

		);	

		

		$result = $this->Location_model->update_record($data,$id);		

		

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_update_location');

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

		$result = $this->Location_model->delete_record($id);

		if(isset($id)) {

			$Return['result'] = $this->lang->line('xin_success_delete_location');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

	}

}

