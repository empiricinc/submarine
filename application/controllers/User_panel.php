<?php 

/**
 * 
 */
class User_panel extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// if(!isset($this->session->user_id))
		// 	redirect(base_url());
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'html'));

		$this->load->database();


		$this->load->model(
			array(
				"User_panel_model",
				"Employees_model",
				"Xin_model",
				"Department_model",
				"Designation_model",
				"Roles_model",
				"Location_model"
			)
		);



	}

	public function index()
	{
		$data['title'] = "Employee's Dashboard";

		$data['content'] = $this->load->view('user_panel/dashboard', $data, TRUE);
		$this->load->view('user_panel/_template', $data);
	}


	public function personal_detail()
	{
		// $id = $this->session->user_id;
		$id = 6;

		if(!empty($id))
		{
			$data['title'] = 'Employee Detail';

			$emp_info = $data['basic_info'] = $this->User_panel_model->get_employee_detail($id);
			//var_dump($emp_info); exit;
			//$emp_info = $data['basic_info'] = $this->User_panel_model->emp_basic_info($id);

			// $data['residential_info'] = $this->User_panel_model->emp_current_address($id);
			// $data['permanent_location_info'] = $this->User_panel_model->emp_permanent_address($id);
			// $data['educational_info'] = $this->User_panel_model->emp_educational_info($id);
			// $data['total_experience_info'] = $this->User_panel_model->emp_work_experience($id);
			// $data['bank_info'] = $this->User_panel_model->emp_bank_info($id);
			$data['supervisor_detail'] = $this->User_panel_model->emp_supervisor_detail($id);
			// echo $this->db->last_query();

			$data['countries'] = $this->User_panel_model->get_countries();
			$data['religion'] = $this->User_panel_model->get_religion();
			$data['tribe'] = $this->User_panel_model->get_tribe();
			$data['marital'] = $this->User_panel_model->get_marital_status();
			$data['gender'] = $this->User_panel_model->get_gender();
			$data['contract_type'] = $this->User_panel_model->get_contract_type();
			$data['language'] = $this->User_panel_model->get_language();
			$data['ethnicity'] = $this->User_panel_model->get_ethnicity();
			$data['blood_group'] = $this->User_panel_model->get_blood_group();
			$data['province'] = $this->User_panel_model->get_province();
			$data['discipline'] = $this->User_panel_model->get_discipline();
			$data['bank'] = $this->User_panel_model->get_bank();
			$data['qualification'] = $this->User_panel_model->get_qualification($id);
			

			
			$data['r_district'] = $this->User_panel_model->get_district_province($emp_info->resident_province);
			$data['p_district'] = $this->User_panel_model->get_district_province($emp_info->permanent_province);

			$data['r_tehsil'] = $this->User_panel_model->get_tehsil_district($emp_info->resident_district);
			$data['p_tehsil'] = $this->User_panel_model->get_tehsil_district($emp_info->permanent_district);

			$data['r_uc'] = $this->User_panel_model->get_uc_tehsil($emp_info->resident_tehsil);
			$data['p_uc'] = $this->User_panel_model->get_uc_tehsil($emp_info->permanent_tehsil);
			
			$data['content'] = $this->load->view('user_panel/personal_detail', $data, TRUE);
			$this->load->view('user_panel/_template', $data);
		}
		else
		{
			show_404();
		}
	}


	public function update_employee()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 6;

		if(isset($_POST['employee_name'])) 
		{

			$data = array(
						'father_name' => $_POST['father_name'],
						'marital_status' => $_POST['marital_status'],
						'cnic' => $_POST['cnic'],
						'cnic_expiry_date' => $_POST['cnic_expiry'],
						'tribe' => $_POST['tribe'],
						'ethnicity' => $_POST['ethnicity'],
						'language' => $_POST['language'],
						'other_languages' => $_POST['other_languages'],
						'nationality' => $_POST['nationality'],
						'religion' => $_POST['religion'],
						'personal_contact' => $_POST['personal_contact_no'],
						'contact_number' => $_POST['contact_no'],
						'contact_other' => $_POST['other_contact_no'],
						'bloodgroup' => $_POST['blood_group'],
						'email_address' => $_POST['email']
					);

			$rec_update = $this->User_panel_model->update_employee($data, $employee_id);
			
			if($rec_update)
				echo '1';
			else 
				echo '0';
		}
		else
		{
			show_404();
		}
		

	}

	public function update_residential_address()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 6;

		if(isset($_POST['residential_province'])) 
		{
			$data = array(
						'resident_province' => $_POST['residential_province'],
						'resident_district' => $_POST['residential_district'],
						'resident_tehsil' => $_POST['residential_tehsil'],
						'resident_uc' => $_POST['residential_uc'],
						'resident_address_details' => $_POST['residential_address']
					);

			$rec_update = $this->User_panel_model->update_current_address($data, $employee_id);
			if($rec_update)
				echo '1';
			else 
				echo '0';
		}
		else
		{
			show_404();
		}
	}


	public function update_permanent_address()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 6;

		if(isset($_POST['permanent_province'])) 
		{
			$data = array(
						'permanent_province' => $_POST['permanent_province'],
						'permanent_district' => $_POST['permanent_district'],
						'permanent_tehsil' => $_POST['permanent_tehsil'],
						'permanent_uc' => $_POST['permanent_uc'],
						'permanent_address_details' => $_POST['permanent_address']
					);

			$rec_update = $this->User_panel_model->update_permanent_address($data, $employee_id);
			if($rec_update)
				echo '1';
			else 
				echo '0';
		}
		else
		{
			show_404();
		}
	}

	public function add_qualification()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 5;

		if(isset($_POST['institute_name'])) 
		{
			$data = array(
					'institute_name' => $_POST['institute_name'],
					'discipline_id' => $_POST['discipline'],
					'qualification_id' => $_POST['qualification'],
					'user_id' => $employee_id	
					);

			$rec_update = $this->User_panel_model->add_qualification($data);
			$rec_id = $this->db->insert_id();
			if($rec_update)
				echo $rec_id;
			else 
				echo '0';
		}
		else
		{
			show_404();
		}
	}

	public function add_bank_info()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 5;
		if(isset($_POST['bank'])) 
		{
			$data = array(
					'bank_id' => $_POST['bank'],
					'account_title' => $_POST['account_title'],
					'account_id' => $_POST['account'],	
					'branch_code' => $_POST['branch_code'],	
					'user_id' => $employee_id
					);

			$rec_added = $this->User_panel_model->add_bank_info($data);
			if($rec_added)
				echo '1';
			else 
				echo '0';
		}
		else
		{
			show_404();
		}
	}


	/******************************* Ajax calls ****************************************/

	public function json_response($data)
	{
		$this->output
			 ->set_content_type('application/json')
			 ->set_output(json_encode(array('data' => $data)));
	}

	function ajax_check()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
	}


	public function district_for_province()
	{
		$this->ajax_check();
		$province_id = $this->input->post('province_id');
		$districts = $this->User_panel_model->get_district_province($province_id);

		$this->json_response($districts);
	}

	public function tehsil_for_district()
	{
		$this->ajax_check();
		$district_id = $this->input->post('district_id');
		$tehsils = $this->User_panel_model->get_tehsil_district($district_id);

		$this->json_response($tehsils);
	}

	public function uc_for_tehsil()
	{
		$this->ajax_check();
		$tehsil_id = $this->input->post('tehsil_id');
		$union_councils = $this->User_panel_model->get_uc_tehsil($tehsil_id);

		$this->json_response($union_councils);
	}



	/**********************************************************************************/


	public function policies()
	{
		$data['title'] = 'Company Policies';

		$data['policy'] = $this->User_panel_model->get_company_policies();
		$data['content'] = $this->load->view('user_panel/policies', $data, TRUE);
		$this->load->view('user_panel/_template', $data);
	}

	public function policy_detail()
	{
		$this->ajax_check();

		$policy_id = $this->input->post('id');
		$policy = $this->User_panel_model->get_policy_detail($policy_id);

		$output = '<div class="row">
        				<div class="col-md-3">
        					<label for="">Title</label>
        				</div>
        				<div class="col-md-9 title">
        				'. $policy->title .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Description</label>
        				</div>
        				<div class="col-md-9 desc">
							'. html_entity_decode($policy->description) .'
        				</div>
        			</div>';



        echo $output;
	}


	public function payroll()
	{
		$data['title'] = "Payroll Information";

		$data['content'] = $this->load->view("user_panel/payroll", $data, TRUE);;
		$this->load->view('user_panel/_template', $data);
	}

	public function leaveManagement()
	{	
		// $employee_id = $this->session->user_id;
		$employee_id = 23;
		$data['title'] = "Leave Management";
		$data['leave_type'] = $this->User_panel_model->get_leave_types();
		$data['leave_available'] = $this->User_panel_model->leaves_available_count($employee_id);
		$data['leave_application'] = $this->User_panel_model->previous_leave_applications($employee_id);

		$data['content'] = $this->load->view("user_panel/leave_management", $data, TRUE);
		$this->load->view('user_panel/_template', $data);
	}

	public function leave_request()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 23;
		$leave_type_id = $this->input->post('leave_type');
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$reason = $this->input->post('reason');

		$data = array(
					'employee_id' => $employee_id,
					'leave_type_id' => $leave_type_id,
					'from_date' => date('Y-m-d', strtotime($from_date)),
					'to_date' => date('Y-m-d', strtotime($to_date)),
					'reason' => trim($reason),
					'status' => '1'
				);

		if($this->User_panel_model->add_leave_request($data))
		{
			$this->session->set_flashdata('success', '<strong>Done!</strong> Your application is submitted, kindly wait for the reply');
			redirect('User_panel/leaveManagement');
		}
		else
		{
			exit("An error was encountered. Please contact the developer");
		}
	}

	public function leave_detail()
	{
		$this->ajax_check();

		$leave_id = $this->input->post('id');
		$row = $this->User_panel_model->get_leave_detail($leave_id);

		$output = '<div class="row">
        				<div class="col-md-3">
        					<label for="">Leave type</label>
        				</div>
        				<div class="col-md-9 title">
        				'. $row->type_name .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">From Date</label>
        				</div>
        				<div class="col-md-9 title">
        				'. $row->from_date .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">To Date</label>
        				</div>
        				<div class="col-md-9 title">
        				'. $row->to_date .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Reason</label>
        				</div>
        				<div class="col-md-9 title">
        				'. $row->reason .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Remarks</label>
        				</div>
        				<div class="col-md-9 desc">
							'. html_entity_decode($row->remarks) .'
        				</div>
        			</div>';



        echo $output;
	}

	public function resignation()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 6;
		$data['title'] = "Resignation Form";
		$data['emp'] = $this->User_panel_model->get_employee_designation($employee_id);
		$data['reasons'] = $this->User_panel_model->get_resignation_reasons();
		$data['content'] = $this->load->view("user_panel/resignation", $data, TRUE);
		$this->load->view('user_panel/_template', $data);
	}


	public function send_resignation()
	{
		$this->ajax_check();

		$title = $this->input->post('title');
		$reason = $this->input->post('reason');
		$other_reason_text = $this->input->post('other_reason');
		$subject = $this->input->post('subject');
		$description = $this->input->post('desc');
		// $employee_id = $this->session->user_id;
		$employee_id = 8;
		$resignation_date = $notice_date = date("Y-m-d");
		$entry_time = date("Y-m-d H:i:s");

		$data = array(
					'employee_id' => $employee_id,
					'notice_date' => $notice_date,
					'resignation_date' => $resignation_date,
					'reason' => $other_reason_text,
					'added_by' => $employee_id,
					'created_at' => $entry_time, 

					'reason_id' => $reason,
					'subject' => $subject,
					'description' => $description
				);

		if($this->User_panel_model->add_resignation($data))
			echo '1';
		else
			echo '0';

	}


	public function get_education_info()
	{
		$this->ajax_check();

		if(isset($_POST['id']))
		{
			$id = $this->input->post('id');
			$data = $this->User_panel_model->get_education_info($id);
			$discipline = $this->User_panel_model->get_discipline();
			$qualification = $this->User_panel_model->get_qualification();

			$this->output
				 ->set_content_type('application/json')
				 ->set_output(json_encode(array('data' => $data, 'discipline' => $discipline, 'qualification' => $qualification)));
		}
		else
		{
			show_404();
		}
		
	}

	public function get_bank_info()
	{
		$this->ajax_check();

		if(isset($_POST['id']))
		{
			$id = $this->input->post('id');
			$data = $this->User_panel_model->get_bank_info($id);
			$bank = $this->User_panel_model->get_bank();

			$this->output
				 ->set_content_type('application/json')
				 ->set_output(json_encode(array('data' => $data, 'bank' => $bank)));
		}
		else
		{
			show_404();
		}
	}

	public function get_job_info()
	{
		$this->ajax_check();

		if(isset($_POST))
		{
			$id = $this->input->post('id');
			$data = $this->User_panel_model->get_job_info($id);

			$this->output
				 ->set_content_type('application/json')
				 ->set_output(json_encode(array('data' => $data)));
		}
		else
		{
			show_404();
		}
	}


	public function update_education_info()
	{
		$this->ajax_check();
		// $employee_id = $this->session->user_id;
		$employee_id = 5;
		
		if(isset($_POST['discipline']))
		{
			$rec_id = $this->input->post('id');
			$discipline = $this->input->post('discipline');
			$qualification = $this->input->post('qualification_id');
			$institute_name = $this->input->post('institute_name');

			$data = array(
					'institute_name' => $institute_name,
					'discipline_id' => $discipline,
					'qualification_id' => $qualification
					);

			$updated = $this->User_panel_model->update_emp_qualification($data, $rec_id);
			if($updated)
			{	
				$msg = '1';
			}
			else 
			{
				$msg = '0';
			}
		} else {
			$msg = '0';
		}

		echo $msg;

	}

	public function add_experience()
	{

		$this->ajax_check();
		// $employee_id = $this->session->user_id;
		$employee_id = 5;
		
		if(isset($_POST['company']))
		{
			$company = $this->input->post('company');
			$designation = $this->input->post('designation');
			$description = $this->input->post('description');
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');

			$data = array(
					'user_id' => $employee_id,
					'company' => $company,
					'designation' => $designation,
					'description' => $description,
					'from_date' => date('Y-m-d', strtotime($from_date)),
					'to_date' => date('Y-m-d', strtotime($to_date))
					);

			$added = $this->User_panel_model->add_experience($data);
			if($added)
			{	
				$msg = '1';
			}
			else 
			{
				$msg = '0';
			}
		} else {
			$msg = '0';
		}

		echo $msg;

	}


	public function update_job()
	{

		$this->ajax_check();
		// $employee_id = $this->session->user_id;
		$employee_id = 5;
		
		if(isset($_POST['company']))
		{
			$rec_id = $this->input->post('id');
			$company = $this->input->post('company');
			$designation = $this->input->post('designation');
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$description = $this->input->post('description');

			$data = array(
					'company' => $company,
					'designation' => $designation,
					'from_date' => $from_date,
					'to_date' => $to_date,
					'description' => $description
					);

			$updated = $this->User_panel_model->update_job_detail($data, $rec_id);
			if($updated)
			{	
				$msg = '1';
			}
			else 
			{
				$msg = '0';
			}
		} else {
			$msg = '0';
		}

		echo $msg;

	}


	public function get_education_table()
	{

		$this->ajax_check();
		// $employee_id = $this->session->user_id;
		$employee_id = 5;
		$education_info = $this->User_panel_model->emp_educational_info($employee_id);
		$total_rows = $this->db->get_where('employee_educational_info', array('user_id' => $employee_id))->num_rows();

		$data = array();
		$count = 1;
		foreach ($education_info as $row) {
			$data[] = array(
								$count,
								$row->institute_name,
								$row->name,
								$row->discipline_name,
								'<a class="plr-5 icon-gray edit-education" data-toggle="modal" href="#edit-education-modal" data="'.$row->id.'" title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="plr-5 icon-gray delete-education" data-toggle="modal" href="#delete-modal" data-id="'.$row->id.'" data-type="qualification" title="Delete">
										<i class="fa fa-trash"></i>
									</a>'
							);

			$count++;
		}
		
		$draw = intval($this->input->get("draw"));
		$output = array(
		    "draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);
		// echo $this->db->last_query();
		echo json_encode($output);

	}

	public function get_bank_table()
	{
		$this->ajax_check();
		// $employee_id = $this->session->user_id;
		$employee_id = 5;
		$bank_info = $this->User_panel_model->emp_bank_info($employee_id);
		$total_rows = $this->db->get_where('employee_bank_information_info', array('user_id' => $employee_id))->num_rows();

		$data = array();
		$count = 1;
		foreach ($bank_info as $row) {
			$data[] = array(
								$count,
								$row->account_title,
								$row->account_id,
								$row->bank_name,
								$row->branch_code,
								'<a class="plr-5 icon-gray edit-bank" data-toggle="modal" href="#edit-bankinfo-modal" data="'.$row->id.'" title="Edit">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="plr-5 icon-gray delete-bank" data-toggle="modal" href="#delete-modal" data-id="'.$row->id.'" data-type="bank" title="Delete">
										<i class="fa fa-trash"></i>
									</a>'
							);

			$count++;
		}
		
		$draw = intval($this->input->get("draw"));
		$output = array(
		    "draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);

		echo json_encode($output);

	}

	public function get_job_table()
	{
		$this->ajax_check();
		// $employee_id = $this->session->user_id;
		$employee_id = 5;
		$job = $this->User_panel_model->emp_job_experience($employee_id);
		$total_rows = $this->db->get_where('job_experience', array('user_id' => $employee_id))->num_rows();

		$data = array();
		$count = 1;
		foreach ($job as $j) {
			$data[] = array(
							$count,
							$j->company,
							$j->designation,
							$j->from_date,
							$j->to_date,
							'<a class="plr-5 icon-gray edit-job" data-toggle="modal" href="#edit-job-modal" data="'.$j->id.'" title="Edit">
									<i class="fa fa-pencil"></i>
								</a>
								<a class="plr-5 icon-gray delete-job" data-toggle="modal" href="#delete-modal" data-id="'.$j->id.'" data-type="job" title="Delete">
									<i class="fa fa-trash"></i>
								</a>'
						);

			$count++;
		}
		
		$draw = intval($this->input->get("draw"));
		$output = array(
		    "draw" => $draw,
			"recordsTotal" => $total_rows,
			"recordsFiltered" => $total_rows,
			"data" => $data
		);

		echo json_encode($output);

	}

	public function update_bank_info()
	{
		$this->ajax_check();

		if(isset($_POST['bank_id']))
		{
			$rec_id = $this->input->post('id');
			$bank_id = $this->input->post('bank_id');
			$acc_title = $this->input->post('acc_title');
			$acc_no = $this->input->post('acc_no');
			$branch_code = $this->input->post('branch_code');

			$data = array(
					'bank_id' => $bank_id,
					'account_title' => $acc_title,
					'account_id' => $acc_no,
					'branch_code' => $branch_code
					);

			$updated = $this->User_panel_model->update_emp_bank_info($data, $rec_id);
			if($updated)
			{
				echo '1';
			}
			else 
			{
				echo $this->db->last_query();
			}
		} else {
			echo '0';
		}
	}


	public function delete_emp_bank_info()
	{
		$this->ajax_check();

		if(isset($_POST['id']))
		{
			$record_id = $this->input->post('id');
			$deleted = $this->User_panel_model->delete_emp_bank_info($record_id);

			if($deleted)
				echo '1';
			else
				echo '0';
		} 
		else
		{
			show_404();
		}
	}


	public function delete_emp_qualification_info()
	{
		$this->ajax_check();

		if(isset($_POST['id']))
		{
			$record_id = $this->input->post('id');
			$deleted = $this->User_panel_model->delete_emp_qualification_info($record_id);

			if($deleted)
				echo '1';
			else
				echo '0';
		} 
		else
		{
			show_404();
		}
	}

	public function delete_job_experience()
	{
		$this->ajax_check();
		if(isset($_POST['id']))
		{
			$record_id = $this->input->post('id');
			$deleted = $this->User_panel_model->delete_job_experience($record_id);

			if($deleted)
				echo '1';
			else
				echo '0';
		} 
		else
		{
			show_404();
		}
	}


	function payroll_pdf($date="")
	{
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Payroll pdf');

		// $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('times', '', 10);

		// add a page
		$pdf->AddPage();

		// set cell padding
		$pdf->setCellPaddings(1, 1, 1, 1);

		// set cell margins
		$pdf->setCellMargins(1, 1, 1, 1);

		// set color for background
		$pdf->SetFillColor(255, 255, 127);


		$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">
			<br>
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);
		

		$topTable = '<br><br><br>';
		$topTable .= '<table border="1px" style="padding: 5px;">
			<tr>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">Payroll No</td>
				<td style="width: 32%;"></td>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">Employee ID</td>
				<td style="width: 32%;"></td>
			</tr>
			<tr>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">Name</td>
				<td style="width: 32%;"></td>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">CNIC</td>
				<td style="width: 32%;"></td>
			</tr>
			<tr>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">Project</td>
				<td style="width: 32%;"></td>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">Designation</td>
				<td style="width: 32%;"></td>
			</tr>
			<tr>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">Gross Salary</td>
				<td style="width: 32%;"></td>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">Paid Salary</td>
				<td style="width: 32%;"></td>
			</tr>
			<tr>
				<td style="width: 18%; font-weight: bold; font-family: helvetica;">Paid Date</td>
				<td style="width: 82%;"></td>
				
			</tr>
		</table>';

		$earningTable = '<table border="1px" style="padding: 5px;">
			<tr>
				<td colspan="2" style="width: 100%; font-weight: bold; font-family: helvetica;">Earning</td>
			</tr>
			<tr>
				<td style="width: 50%; font-weight: bold; font-family: helvetica;">Basic Salary</td>
				<td style="width: 50%;"></td>
			</tr>
			<tr>
				<td style="width: 50%; font-weight: bold; font-family: helvetica;">Medical Allowance</td>
				<td style="width: 50%;"></td>
			</tr>
			<tr>
				<td style="width: 50%; font-weight: bold; font-family: helvetica;">Stationary Allowance</td>
				<td style="width: 50%;"></td>
			</tr>
			<tr>
				<td style="width: 50%; font-weight: bold; font-family: helvetica;">Vehicle Fuel Allowance</td>
				<td style="width: 50%;"></td>
			</tr>
			<tr>
				<td colspan="2" style="width: 100%; font-weight: bold; font-family: helvetica;">Total</td>
			</tr>

		</table>';

		$deductionTable = '<table border="1px" style="padding: 5px;">
			<tr>
				<td colspan="2" style="width: 100%; font-weight: bold; font-family: helvetica;">Deduction</td>
			</tr>
			<tr>
				<td style="width: 50%; font-weight: bold; font-family: helvetica;">Tax</td>
				<td style="width: 50%;"></td>
			</tr>
			<tr>
				<td style="width: 50%; font-weight: bold; font-family: helvetica;">EOBI</td>
				<td style="width: 50%;"></td>
			</tr>
			<tr>
				<td style="width: 50%; font-weight: bold; font-family: helvetica;">Absent</td>
				<td style="width: 50%;"></td>
			</tr>
			<tr>
				<td style="width: 50%; font-weight: bold; font-family: helvetica;">Others</td>
				<td style="width: 50%;"></td>
			</tr>
			<tr>
				<td colspan="2" style="width: 100%; font-weight: bold; font-family: helvetica;">Total</td>
			</tr>

		</table>';

		$topTable = '<table style="padding: 5px;">
			<tr>
				<td style="width: 100%;">'.$topTable.'</td>
			</tr>
		</table>';
		$bottomTable = '<table style="padding: 5px;">
			<tr>
				<td style="width: 50%;">'.$earningTable.'</td>
				<td style="width: 50%;">'.$deductionTable.'</td>
			</tr>
		</table>';


		$pdf->WriteHTMLCell(0, 0, '', '', $topTable, 0, 1, 0, true, '', true);
		$pdf->WriteHTMLCell(0, 0, '', '', $bottomTable, 0, 1, 0, true, '', false);
		// $pdf->WriteHTMLCell(80, 0, '', '', $deductionTable, 0, 1, 0, true, '', false);
		// move pointer to last page
		$pdf->lastPage();
		ob_clean();
		$pdf->Output('payroll.pdf', 'I');
	}


	function trainings()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 3;

		$training_id = $this->input->post('training_id');

		$data['trainings'] = $this->User_panel_model->get_employee_trainings($employee_id)->result();
		$data['title'] = 'Trainings List';
		$data['content'] = $this->load->view('user_panel/trainings', $data, TRUE);
		$this->load->view('user_panel/_template', $data);
		
	}

	function training_detail()
	{
		$this->ajax_check();

		// $employee_id = $this->session->user_id; 
		$employee_id = 3;

		if(isset($_POST['training_id']) && !empty($employee_id))
		{
			$training_id = $this->input->post('training_id');
			$detail = $this->User_panel_model->get_employee_trainings($employee_id, $training_id)->row();

			$output = '<div class="row">
        				<div class="col-md-3">
        					<label for="">Training type</label>
        				</div>
        				<div class="col-md-9 title">
        				'. $detail->training_type .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Province</label>
        				</div>
        				<div class="col-md-9 desc">
							'. ucfirst($detail->province) .'
        				</div>
        			</div>
					<div class="row">
        				<div class="col-md-3">
        					<label for="">City</label>
        				</div>
        				<div class="col-md-9 desc">
							'. ucfirst($detail->training_city) .'
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Location</label>
        				</div>
        				<div class="col-md-9 desc">
							'. ucfirst($detail->training_location) .'
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Training Hall</label>
        				</div>
        				<div class="col-md-9 desc">
							'. ucfirst($detail->hall_detail) .'
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Start Date</label>
        				</div>
        				<div class="col-md-9 desc">
							'. date('d-m-Y', strtotime($detail->start_date)) .'
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">End Date</label>
        				</div>
        				<div class="col-md-9 desc">
							'. date('d-m-Y', strtotime($detail->end_date)) .'
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Trainers</label>
        				</div>
        				<div class="col-md-9 desc">
							'. ucfirst($detail->trainer1). ', '. ucfirst($detail->trainer2) .'
        				</div>
        			</div>';

  
        	


        	echo $output;
		}
		else
		{
			show_404();
		}
	}


	public function personalDetail() {

		$session = $this->session->userdata('username');

		// if(empty($session)){ 

		// 	redirect('');

		// }

		$id = 7;

		$result = $this->Employees_model->read_employee_information($id);

		// if(is_null($result)){

		// 	redirect('employees');

		// }

		// $role_resources_ids = $this->Xin_model->user_role_resource();

		// $data['breadcrumbs'] = $this->lang->line('xin_employee_details');

		// $data['path_url'] = 'employees_detail';

		

		// if(in_array('13',$role_resources_ids)) {

		// } else {

		// 	redirect('dashboard/');

		// }

		

		$data = array(

			'breadcrumbs' => $this->lang->line('xin_employee_detail'),

			'title' => 'Employee Detail',

			'path_url' => 'personal_detail_old',

			'first_name' => $result[0]->first_name,

			'last_name' => $result[0]->last_name,

			'user_id' => $result[0]->user_id,

			'employee_id' => $result[0]->employee_id,

			'company_id' => $result[0]->company_id,

			'username' => $result[0]->username,

			'email' => $result[0]->email,

			'department_id' => $result[0]->department_id,

			'designation_id' => $result[0]->designation_id,

			'user_role_id' => $result[0]->user_role_id,

			'date_of_birth' => $result[0]->date_of_birth,

			'date_of_leaving' => $result[0]->date_of_leaving,

			'gender' => $result[0]->gender,

			'marital_status' => $result[0]->marital_status,

			'contact_no' => $result[0]->contact_no,

			'address' => $result[0]->address,

			'is_active' => $result[0]->is_active,

			'date_of_joining' => $result[0]->date_of_joining,

			'all_departments' => $this->Department_model->all_departments(),

			'all_designations' => $this->Designation_model->all_designations(),

			'all_user_roles' => $this->Roles_model->all_user_roles(),

			// 'title' => $this->Xin_model->site_title(),

			'profile_picture' => $result[0]->profile_picture,

			'facebook_link' => $result[0]->facebook_link,

			'twitter_link' => $result[0]->twitter_link,

			'blogger_link' => $result[0]->blogger_link,

			'linkdedin_link' => $result[0]->linkdedin_link,

			'google_plus_link' => $result[0]->google_plus_link,

			'instagram_link' => $result[0]->instagram_link,

			'pinterest_link' => $result[0]->pinterest_link,

			'youtube_link' => $result[0]->youtube_link,

			'all_countries' => $this->Xin_model->get_countries(),

			'all_document_types' => $this->Employees_model->all_document_types(),

			'all_education_level' => $this->Employees_model->all_education_level(),

			'all_qualification_language' => $this->Employees_model->all_qualification_language(),

			'all_qualification_skill' => $this->Employees_model->all_qualification_skill(),

			'all_contract_types' => $this->Employees_model->all_contract_types(),

			'all_contracts' => $this->Employees_model->all_contracts(),

			'all_office_shifts' => $this->Employees_model->all_office_shifts(),

			'get_all_companies' => $this->Xin_model->get_companies(),

			'all_office_locations' => $this->Location_model->all_office_locations(),

			);

		

		$data['content'] = $this->load->view("user_panel/personalDetail", $data, TRUE);

		$this->load->view('user_panel/_template', $data); //page load

		

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

	 }




}