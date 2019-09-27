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



class Job_post extends MY_Controller {

	

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
		//$data['sl3'] = $this->session->userdata('accessLevel');

		$data['title'] = $this->Xin_model->site_title();

        $data['geProvinces'] = $this->ProvinceCity->getAllProvinces();   

        $data['getakcity'] = $this->ProvinceCity->getCity();   

		$data['location_job_position'] = $this->Location_model->all_location_job_position();



		$data['all_designations'] = $this->Designation_model->all_designations();
		
		$data['all_departments'] = $this->Department_model->all_departments();

		$data['all_companies'] = $this->Xin_model->get_companies();


		$data['all_job_types'] = $this->Job_post_model->all_job_types();


		$data['breadcrumbs'] = $this->lang->line('left_job_posts');

		$data['path_url'] = 'job_post';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('45',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("job_post/job_list", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}

     }

	 public function getcity() {
        $json = array();
        $this->ProvinceCity->setProvinceID($this->input->post('provinceID'));
        $json = $this->ProvinceCity->getCity();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // get areas names
    public function getareas() {
        $json = array();
        $this->ProvinceCity->settheCityID($this->input->post('thecityID'));
        $json = $this->ProvinceCity->getAreas();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

// get areas names
    public function getareaspositionsdept() {
        $json = array();
        $this->ProvinceCity->setthepositiondeptID($this->input->post('theAreaID'));
        $json = $this->ProvinceCity->getAreas_positionDept();
        header('Content-Type: application/json');
        echo json_encode($json);
    }


    // get areas names
    public function getCBVareas() {
        $json = array();
        $this->ProvinceCity->settheucID($this->input->post('theucID'));
        $json = $this->ProvinceCity->getCBVAreas();
        header('Content-Type: application/json');
        echo json_encode($json);
    }


    // get sub areas names
    public function getCBVSubAreas() {
        $json = array();
        $this->ProvinceCity->settheareaID($this->input->post('theareaID'));
        $json = $this->ProvinceCity->getCBVSubAreas();
        header('Content-Type: application/json');
        echo json_encode($json);
    }


public function getDistrict() {
        $json = array();
        $this->ProvinceCity->setProvinceID($this->input->post('provinceID'));
        $json = $this->ProvinceCity->getDistrict();
        header('Content-Type: application/json');
        echo json_encode($json);
    }

    // get tehsil names
    public function getTehsil() {
        $json = array();
        $this->ProvinceCity->setthedistrictID($this->input->post('thedistrictID'));
        $json = $this->ProvinceCity->getTehsil();
        header('Content-Type: application/json');
        echo json_encode($json);
    }


    // get uc names
    public function getuc() {
        $json = array();
        $this->ProvinceCity->settehsilID($this->input->post('tehsilID'));
        $json = $this->ProvinceCity->getuc();
        header('Content-Type: application/json');
        echo json_encode($json);
    }





    public function job_list()

     {



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("job_post/job_list", $data);

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

		/* get job status*/

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

	  exit();

     }

	 

	 public function read()

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

				'all_companies' => $this->Xin_model->get_companies(),


				'all_job_types' => $this->Job_post_model->all_job_types()

				);

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view('job_post/dialog_job_post', $data);

		} else {

			redirect('');

		}

	}

	

	// Validate and add info in database

	public function add_job() {

	//print_r($_POST); exit();


		if($this->input->post('add_type')=='job') {		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		$long_description = $_POST['long_description'];	

		$short_description = $_POST['short_description'];	

		$qt_short_description = htmlspecialchars(addslashes($short_description), ENT_QUOTES);

		$qt_description = htmlspecialchars(addslashes($long_description), ENT_QUOTES);

	 

	

		$data = array(

		'company' => $this->input->post('company_id'), 

		'job_title' => $this->input->post('job_title'), 
		'job_type' => $this->input->post('job_type'),
		'job_vacancy' => '1',
		'gender' => $this->input->post('gender'),
		'minimum_experience' => $this->input->post('experience'),
		'date_of_closing' => $this->input->post('date_of_closing'),

		'province' => $this->input->post('province_id'),
		'designation_id' => $this->input->post('designation_id'),
		'department_id' => $this->input->post('department_id'),

		'city_name' => $this->input->post('city_id'),
		'district_id' => $this->input->post('district_id'),
		'tehsil_id' => $this->input->post('tehsil_id'),
		'uc_id' => $this->input->post('uc_id'),
		'area_name' => $this->input->post('area_id'),
		'sub_area_id' => $this->input->post('sub_area_id'),
		'domicile' => $this->input->post('domicile'),	
		'cnic' => $this->input->post('cnic'),		
		'education' => $this->input->post('education'),		
		'age' => $this->input->post('age'),	
		'short_description' => $qt_short_description,
		'long_description' => $qt_description,
		'status' => '1',
		'created_at' => date('Y-m-d h:i:s'),


		//'designation_id' => $this->input->post('designation_id'),
		

		);

		$result = $this->Job_post_model->add($data);

		$data2 = array('status' => '1');
		$result = $this->Job_post_model->update_location_job_position($data2,$id=$this->input->post('id'));


		$this->session->set_flashdata('message', 'Job Created Successfully');

		redirect($_SERVER['HTTP_REFERER']); 

		/*if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_job_added');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);*/

		exit;

		}

	}








	public function assign_test() {

	
//print_r($_POST); exit();
 
		$dt = $this->input->post('test_date');	
	    $test_date = date("Y-m-d h:i:s", strtotime($dt)); 

		$data = array(

		'rollnumber' => $this->input->post('rollnumber'), 
		'email' => $this->input->post('email'), 
		'test_date' => $test_date,
		'city_id' => $this->input->post('city_id'),
		'sdt' => date('Y-m-d h:i:s'),

		);

		$result = $this->Job_post_model->add_test($data);

		$this->session->set_flashdata('testmessage', 'Test Added Successfully');

		redirect($_SERVER['HTTP_REFERER']); 


	}




	public function add_interview_result() {

		$question1 = $this->input->post('communication');
		$question2 = $this->input->post('experience');
		$question3 = $this->input->post('aptitude');
		$question4 = $this->input->post('personality');
		$question5 = $this->input->post('language');
		$question6 = $this->input->post('education');
		$question7 = $this->input->post('general_knowledge');
		$obtain_marks = $question1 + $question2 + $question3 + $question4 + $question5 + $question6 + $question7;


		$data = array(

		'rollnumber' => $this->input->post('rollnumber'), 
		
		//'total_question' => $this->input->post('7'), 

		'obtain_marks' => $obtain_marks,

		'total_marks' => $this->input->post('total_marks'),

		'sdt' => date('Y-m-d h:i:s'),
	);

		 
		$result = $this->Job_post_model->add_interview_result($data);

		$this->session->set_flashdata('interviewResult', 'Interview Result Added Successfully');

		redirect($_SERVER['HTTP_REFERER']); 

	}




	public function assign_interview() {
	
//print_r($_POST); exit();
	    $dt = $this->input->post('interview_date');	
	    $interview_date = date("Y-m-d h:i:s", strtotime($dt)); //exit();
		$data = array(
						'rollnumber' => $this->input->post('rollnumber'), 
						'email' => $this->input->post('email'), 
						'interview_date' => $interview_date,
						'city_id' => $this->input->post('city_id'),
						'interview_person' => $this->input->post('interview_person'),
						'sdt' => date('Y-m-d h:i:s'),
					);

		 

		$result = $this->Job_post_model->assign_interview($data);

		$this->session->set_flashdata('interviewmessage', 'interview Added Successfully');

	
		redirect($_SERVER['HTTP_REFERER']); 


 

	}



	public function assign_employee_contract() { 
	
		$data = array(
						'user_id' => $this->input->post('rollnumber'), 
						//'basic_salery' => $this->input->post('basic_salery'), 
						//'from_date' => date('Y-m-d h:i:s'), //
						 'from_date' =>  date('Y-m-d', strtotime($this->input->post('from_date'))).date(' H:i:s'),
						//'to_date' => date('Y-m-d h:i:s'), //
						 'to_date' => date('Y-m-d', strtotime($this->input->post('to_date'))).date(' H:i:s'),
						//'contract_manager' => $this->input->post('contract_manager'),
						'contract_type' => $this->input->post('contract_type'),
						'status' => '0',
						//'long_description' => $this->input->post('long_description'),

						'sdt' => date('Y-m-d h:i:s'),
					);

		//print_r($data); exit();

		$result = $this->Job_post_model->add_employee_contract($data);

		$this->session->set_flashdata('contactmessage', 'Contract Added Successfully');

		redirect($_SERVER['HTTP_REFERER']); 
	}



	public function send_offer_letter() {
		
			$data = array(
							'user_id' => $this->input->post('rollnumber'), 							
							'status' => '0',
							'sdt' => date('Y-m-d h:i:s'),
						);

			$result = $this->Job_post_model->send_offer_letter($data);

			$this->session->set_flashdata('contactmessage', 'Offer Letter Sent Successfully');

			redirect($_SERVER['HTTP_REFERER']); 
		}



	public function add_application_form() {

				$obsalry = $this->input->post('basic_salary');
				$obtaxdeduc = $this->input->post('tax_deduction');
				$taxcalcu = $obtaxdeduc*100/$obsalry;
	
//print_r($_POST); exit();


		$employxindata = array( // xin_employee Employee Form 		


						'employee_id' => $this->input->post('application_id'), 
						'first_name' => $this->input->post('emp_name'),
						'last_name' => $this->input->post('last_name'),
						'username' => $this->input->post('username'),
						'email' => $this->input->post('email_address'),
						'password' => $this->input->post('password'),
						'company_id' => $this->input->post('company_id'), 
						'designation_id' => $this->input->post('designation_id'), 
						'department_id' => $this->input->post('department_id'),
						'provience_id' => $this->input->post('provience_id'), 
						'city_id' => $this->input->post('city_id'),
						'status' => '1',
						'is_active' => '1',
						'user_role_id' => '5', // user role 5 for employee only
						'created_at' => date('Y-m-d h:i:s'),
					);
					
					$result = $this->Job_post_model->add_xin_employee_info($employxindata);


		$employeedata = array( // Employee Form 			
						'user_id' => $this->input->post('application_id'), 
						'job_title' => $this->input->post('job_title'), 
						//'department_name' => $this->input->post('department_name'),
						//'emp_name' => $this->input->post('emp_name'),
						'father_name' => $this->input->post('father_name'),
						'relation_id' => $this->input->post('relation_id'),
						'gender' => $this->input->post('gender'),
						//'date_of_birth' => $this->input->post('date_of_birth'),
						'date_of_birth' =>  date('Y-m-d', strtotime($this->input->post('date_of_birth'))).date(' H:i:s'),
						'marital_status' => $this->input->post('marital_status'),
						//'date_of_joining' => $this->input->post('date_of_joining'),
						'date_of_joining' =>  date('Y-m-d', strtotime($this->input->post('date_of_joining'))).date(' H:i:s'),
						'cnic' => $this->input->post('cnic'),
						//'cnic_expiry_date' => $this->input->post('cnic_expiry_date'),
						'cnic_expiry_date' =>  date('Y-m-d', strtotime($this->input->post('cnic_expiry_date'))).date(' H:i:s'),
						'other_cnic_type_id' => $this->input->post('other_cnic_type_id'),
						'employee_contract_type' => $this->input->post('employee_contract_type'),
						'other_id_name' => $this->input->post('other_id_name'),
						'other_passport_id' => $this->input->post('other_passport_id'),
						'tribe' => $this->input->post('tribe'),
						'ethnicity' => $this->input->post('ethnicity'),
						'language' => $this->input->post('language'),
						'other_languages' => $this->input->post('other_languages'),
						'nationality' => $this->input->post('nationality'),
						'religion' => $this->input->post('religion'),
						'contact_number' => $this->input->post('contact_number'),
						'personal_contact' => $this->input->post('personal_contact'),
						'contact_other' => $this->input->post('contact_other'),
						'bloodgroup' => $this->input->post('bloodgroup'),
						'email_address' => $this->input->post('email_address'),
						//'contract_expiry_date' => $this->input->post('contract_expiry_date'),
						'contract_expiry_date' =>  date('Y-m-d', strtotime($this->input->post('contract_expiry_date'))).date(' H:i:s'),
						'remarks' => $this->input->post('remarks'),

						'sdt' => date('Y-m-d h:i:s'),
					);
					$result = $this->Job_post_model->add_employee_basic_info($employeedata);






		$residenciallocationdata = array(  //Employee's Residential Location Details

						'user_id' => $this->input->post('application_id'), 
						'resident_province' => $this->input->post('resident_province'),
						'resident_district' => $this->input->post('resident_district'),
						'resident_tehsil' => $this->input->post('resident_tehsil'),
						'resident_uc' => $this->input->post('resident_uc'),
						'resident_address_details' => $this->input->post('resident_address_details'),
						'sdt' => date('Y-m-d h:i:s'),
					);
					$result = $this->Job_post_model->add_employee_residential_info($residenciallocationdata);



		$permanentlocationdata = array( //Employee's Permanent Location Details
						'user_id' => $this->input->post('application_id'), 
						'permanent_yesno' => $this->input->post('permanent_yesno'),
						'permanent_province' => $this->input->post('permanent_province'),
						'permanent_district' => $this->input->post('permanent_district'),
						'permanent_tehsil' => $this->input->post('permanent_tehsil'),
						'permanent_uc' => $this->input->post('permanent_uc'),
						'permanent_address_details' => $this->input->post('permanent_address_details'),
						'local_id' => $this->input->post('local_id'),
						'verify_local_id' => $this->input->post('verify_local_id'),
						'sdt' => date('Y-m-d h:i:s'),
					);
 				$result = $this->Job_post_model->add_employee_permanent_location_info($permanentlocationdata);


		$educationaldata = array( //Educational Details
						'user_id' => $this->input->post('application_id'), 
						'last_qualification_name' => $this->input->post('last_qualification_name'),
						'qualification_id' => $this->input->post('qualification_id'),
						'discipline_id' => $this->input->post('discipline_id'),
						'sdt' => date('Y-m-d h:i:s'),
					);
				$result = $this->Job_post_model->add_employee_educational_info($educationaldata);


		$totalexperiencedata = array( //Total Experience
						'user_id' => $this->input->post('application_id'), 
						'total_polio_experience_year' => $this->input->post('total_polio_experience_year'),
						'total_polio_experience_month' => $this->input->post('total_polio_experience_month'),
						'total_polio_experience_day' => $this->input->post('total_polio_experience_day'),
						'other_experience_year' => $this->input->post('other_experience_year'),
						'other_experience_month' => $this->input->post('other_experience_month'),
						'other_experience_day' => $this->input->post('other_experience_day'),
						'summary_total_experience_year' => $this->input->post('summary_total_experience_year'),
						'summary_total_experience_month' => $this->input->post('summary_total_experience_month'),
						'summary_total_experience_day' => $this->input->post('summary_total_experience_day'),
						'sdt' => date('Y-m-d h:i:s'),
					);
				$result = $this->Job_post_model->add_employee_total_experience_info($totalexperiencedata);



$salaryDetails = array( //Total Experience
						'user_id' => $this->input->post('application_id'), 
						'basic_salary' => $this->input->post('basic_salary'),
						'gross_salary' => $this->input->post('gross_salary'),
						'security_deposit' => $this->input->post('security_deposit'),
						'sdt' => date('Y-m-d h:i:s'),
					);
				$result = $this->Job_post_model->add_employee_salary_details($salaryDetails);


$employeeallowance = array( //Total Experience
						'user_id' => $this->input->post('application_id'), 
						'house_rent_allowance' => $this->input->post('house_rent_allowance'),
						'medical_allowance' => $this->input->post('medical_allowance'),
						'travelling_allowance' => $this->input->post('travelling_allowance'),
						'sdt' => date('Y-m-d h:i:s'),
					);
				$result = $this->Job_post_model->add_employee_allowance_details($employeeallowance);

				 

$employeeDeductions = array( //Total Experience
						'user_id' => $this->input->post('application_id'), 
						'eobi' => $this->input->post('eobi'),
						'provident_fund' => $this->input->post('provident_fund'),
						'tax_deduction' => $taxcalcu,
						'sdt' => date('Y-m-d h:i:s'),
					);
				$result = $this->Job_post_model->add_employee_deductions_details($employeeDeductions);




		$employeecards = array( // employee_cards
								'employee_id' => $this->input->post('application_id'), 					
								'card_status' => 'pending', 	
								'receive_date' => date('Y-m-d'),
							);
						$result = $this->Job_post_model->add_employee_cards($employeecards);





		$employeeinsurance = array( // employee_cards
								'employee_id' => $this->input->post('application_id'), 						
								'updated_at' => date('Y-m-d'),
							);
						$result = $this->Job_post_model->add_employee_insurance($employeeinsurance);




		$bankinfodata = array( //Bank Information	
			            'user_id' => $this->input->post('application_id'), 
						'bank_id' => $this->input->post('bank_id'),
						'account_id' => $this->input->post('account_id'),
						'branch_code' => $this->input->post('branch_code'),
						'sdt' => date('Y-m-d h:i:s'),
					);
				$result = $this->Job_post_model->add_employee_bank_information_info($bankinfodata);




		$supervisordata = array( //supervisor details						
						'user_id' => $this->input->post('application_id'), 
						'ds_id' => $this->input->post('ds_id'), 
						'ts_id' => $this->input->post('ts_id'),
						'us_id' => $this->input->post('us_id'),
						'as_id' => $this->input->post('as_id'),
						'sdt' => date('Y-m-d h:i:s'),
					);
		$result = $this->Job_post_model->add_employee_supervisor_details($supervisordata);









		$this->session->set_flashdata('appformmessage', 'Application Form Added Successfully');

	
		redirect($_SERVER['HTTP_REFERER']); 


 

	}




	

	// Validate and update info in database

	public function update() {

	

		if($this->input->post('edit_type')=='job') {

			

		$id = $this->uri->segment(3);

		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */

		$long_description = $_POST['long_description'];	

		$short_description = $_POST['short_description'];	

		$qt_short_description = htmlspecialchars(addslashes($short_description), ENT_QUOTES);

		$qt_description = htmlspecialchars(addslashes($long_description), ENT_QUOTES);

		

		if($this->input->post('job_title')==='') {

       		$Return['error'] = $this->lang->line('xin_error_jobpost_title');

		} else if($this->input->post('job_type')==='') {

			$Return['error'] = $this->lang->line('xin_error_jobpost_type');

		} else if($this->input->post('designation_id')==='') {

			$Return['error'] = $this->lang->line('xin_error_jobpost_designation');

		} else if($this->input->post('vacancy')==='') {

			$Return['error'] = $this->lang->line('xin_error_jobpost_positions');

		} else if($this->input->post('date_of_closing')==='') {

       		$Return['error'] = $this->lang->line('xin_error_jobpost_closing_date');

		} else if($qt_short_description==='') {

       		$Return['error'] = $this->lang->line('xin_error_jobpost_short_description');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

	

		$data = array(

		'job_title' => $this->input->post('job_title'),

		'job_type' => $this->input->post('job_type'),

		'designation_id' => $this->input->post('designation_id'),

		'short_description' => $qt_short_description,

		'long_description' => $qt_description,

		'status' => $this->input->post('status'),

		'job_vacancy' => $this->input->post('vacancy'),

		'date_of_closing' => $this->input->post('date_of_closing'),

		'gender' => $this->input->post('gender'),

		'minimum_experience' => $this->input->post('experience')		

		);

		

		$result = $this->Job_post_model->update_record($data,$id);		

		

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_success_job_updated');

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

		$result = $this->Job_post_model->delete_record($id);

		if(isset($id)) {

			$Return['result'] = $this->lang->line('xin_success_job_deleted');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

	}

}

