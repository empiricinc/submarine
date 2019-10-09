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



class Payroll extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		//$this->load->model("Job_post_model");
		$this->load->library('Pdf');

		$this->load->model("Xin_model");

		$this->load->model("Location_model");

		$this->load->model("Designation_model");

		$this->load->model("Department_model");

        $this->load->model('ProvinceCity');

        //$this->load->model('Job_longlisted_model'); // load model
        
		$this->load->model("Company_model");



		$this->load->model('Payroll_model');

		$this->load->model('Employees_model');  





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

		$projid = $session['project_id'];
		$provid = $session['provience_id'];



		$data['title'] = $this->Xin_model->site_title();

        

//print_r($_POST); exit();


        $data['geProvinces'] = $this->ProvinceCity->getAllProvinces();   
          

		$data['location_job_position'] = $this->Location_model->all_location_job_position();



		//$data['all_designations'] = $this->Designation_model->all_designations();
		
		//$data['all_departments'] = $this->Department_model->all_departments();

		$data['all_companies'] = $this->Xin_model->get_companies();


		//$data['check_u_month'] = $this->Payroll_model->get_user_payroll();


		//$data['all_job_types'] = $this->Job_post_model->all_job_types();

/*echo $this->input->post('company_id');
echo $this->input->post('province_id'); exit();
*/
		if($_POST){
				if($this->input->post('company_id') && $this->input->post('province_id')){
					$data['payrollempName'] = $this->Employees_model->payrollprojprov($this->input->post('company_id'),$this->input->post('province_id')); 
				}elseif ($this->input->post('company_id')) {
					$data['payrollempName'] = $this->Employees_model->payrollempName($this->input->post('company_id')); 
				}
					
           }else{
           	$data['payrollempName'] = 1; 
           	//$data['payrollempName'] = $this->Employees_model->payrollempName2($projid,$provid); 
           }

		$data['breadcrumbs'] = $this->lang->line('left_job_posts');

	    $data['path_url'] = 'payroll';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('45',$role_resources_ids)) {

			if(!empty($session)){ 

			$data['subview'] = $this->load->view("payroll/payroll", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}

     }

	  
 
	public function add_employee_payroll() {  


		//var_dump($session['employee_id']); exit();

		 //echo "<pre>"; print_r($_POST); echo "</pre>"; exit(); 

	

		 foreach ($_POST['employee_id'] as $key => $val) { 
						//$data =	$data['user_id'] = $val;
						 
						//$data =	$_POST['basic_salary'][$key]; 
						//$data =	$_POST['total_allowance'][$key]; 
						//$data =	$_POST['total_deduction'][$key]; 
						//$data =	$_POST['net_salary'][$key]; 
						//$data =	$_POST['created_by'][$key]; 
				 		//	$data['sdt'] = date('Y-m-d H:i:s');
						//	$data['edt'] = date('Y-m-d H:i:s');
						
						$data = array(

										'employee_id' => $val, 
										
										'basic_salary' => $_POST['basic_salary'][$key], 

										'total_allowances' => $_POST['total_allowances'][$key],
										
										'company_id' => $_POST['company_id'][$key],

										'location_id' => $_POST['location_id'][$key],

										'department_id' => $_POST['department_id'][$key],
										
										'designation_id' => $_POST['designation_id'][$key],

										'payment_date' => date('Y-m'),
										
										'house_rent_allowance' => $_POST['house_rent_allowance'][$key],
										
										'medical_allowance' => $_POST['medical_allowance'][$key],

										'dearness_allowance' => 0,
										
										'security_deposit' => 0,

										'overtime_rate' => 0,
										'is_advance_salary_deduct' => 0,
										'advance_salary_amount' => 0,
										'is_payment' => 0,
										'payment_method' => 0,
										'hourly_rate' => 0,
										'total_hours_work' => 0,
										'comments' => 0,
										'status' => 1,




										'travelling_allowance' => $_POST['travelling_allowance'][$key],

										'total_deductions' => $_POST['total_deductions'][$key],

										'eobi' => $_POST['eobi'][$key],
										
										'provident_fund' => $_POST['provident_fund'][$key],
										
										'tax_deduction' => $_POST['tax_deduction'][$key],
										
										'net_salary' => $_POST['net_salary'][$key],
										'payment_amount' => $_POST['net_salary'][$key],
										'gross_salary' => $_POST['net_salary'][$key],

										'created_by' => $_POST['created_by'][$key],

										 
										
										'created_at' => date('Y-m-d h:i:s'),

										);

										$result = $this->Payroll_model->add_payroll_master_sheet($data); 

										
			}

			if ($result == TRUE) {   $this->session->set_flashdata('message', ' Payroll Created Successfully');
															
						  } else {   $this->session->set_flashdata('message', ' Payroll Error!'); }
 						
 						              redirect('payroll'); 

	}


 












	 // payment history

	 public function payment_sheet()

     {

		$session = $this->session->userdata('username');

		if(empty($session)){ 

			redirect('');

		}

		$projid = $session['project_id']; 
		$provid = $session['provience_id'];


		$data['title'] = $this->Xin_model->site_title();

		//$data['all_employees'] = $this->Xin_model->all_employees();

		$data['all_companies'] = $this->Xin_model->get_companies();

        $data['geProvinces'] = $this->ProvinceCity->getAllProvinces();   

		//$data['payrollempName'] = $this->Employees_model->payrollempName($this->input->post('company_id')); 

		/*if($_POST){
			$data['payrollempName'] = $this->Employees_model->payrollempName($this->input->post('company_id')); 
           }else{
           	$data['payrollempName'] = $this->Employees_model->payrollempName2($projid,$provid); 
           }*/

        if($_POST){
        	if($this->input->post('company_id') && $this->input->post('province_id')){
					$data['payrollempName'] = $this->Employees_model->payrollprojprovMonth($this->input->post('company_id'),$this->input->post('province_id',$this->input->post('month_year')));
				}elseif($this->input->post('company_id') && $this->input->post('province_id')){
					$data['payrollempName'] = $this->Employees_model->payrollprojprovmatersheet($this->input->post('company_id'),$this->input->post('province_id')); 
				}elseif ($this->input->post('company_id')) {
					$data['payrollempName'] = $this->Employees_model->payrollprojMastersheet($this->input->post('company_id')); 
				}
					
           }else{
           	$data['payrollempName'] = 1; 
           	//$data['payrollempName'] = $this->Employees_model->payrollempName2($projid,$provid); 
           }   

		$data['breadcrumbs'] = $this->lang->line('left_payment_history');

		$data['path_url'] = 'payment_sheet';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(in_array('45',$role_resources_ids)) {

			if(!empty($session)){

			$data['subview'] = $this->load->view("payroll/payment_sheet", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

			} else {

				redirect('');

			}

		} else {

			redirect('dashboard/');

		}		  

     }

	 



	 public function pdf_create() {

		 

		//$this->load->library('Pdf');

		$system = $this->Xin_model->read_setting_info(1);

		

		

		 // create new PDF document

   		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		

		$id = $this->uri->segment(4);

		$payment = $this->Payroll_model->read_make_payment_information($id);

		$user = $this->Xin_model->read_user_info($payment[0]->employee_id);

		

		// if password generate option enable

		if($system[0]->is_payslip_password_generate==1) {

			/**

			* Protect PDF from being printed, copied or modified. In order to being viewed, the user needs

			* to provide password as selected format in settings module.

			*/

			if($system[0]->payslip_password_format=='dateofbirth') {

				$password_val = date("dmY", strtotime($user[0]->date_of_birth));

			} else if($system[0]->payslip_password_format=='contact_no') {

				$password_val = $user[0]->contact_no;

			} else if($system[0]->payslip_password_format=='full_name') {

				$password_val = $user[0]->first_name.$user[0]->last_name;

			} else if($system[0]->payslip_password_format=='email') {

				$password_val = $user[0]->email;

			} else if($system[0]->payslip_password_format=='password') {

				$password_val = $user[0]->password;

			} else if($system[0]->payslip_password_format=='user_password') {

				$password_val = $user[0]->username.$user[0]->password;

			} else if($system[0]->payslip_password_format=='employee_id') {

				$password_val = $user[0]->employee_id;

			} else if($system[0]->payslip_password_format=='employee_id_password') {

				$password_val = $user[0]->employee_id.$user[0]->password;

			} else if($system[0]->payslip_password_format=='dateofbirth_name') {

				$dob = date("dmY", strtotime($user[0]->date_of_birth));

				$fname = $user[0]->first_name;

				$lname = $user[0]->last_name;

				$password_val = $dob.$fname[0].$lname[0];

			}

			$pdf->SetProtection(array('print', 'copy','modify'), $password_val, $password_val, 0, null);

		}

		

		

		$_des_name = $this->Designation_model->read_designation_information($user[0]->designation_id);

		$department = $this->Department_model->read_department_information($user[0]->department_id);

		$location = $this->Xin_model->read_location_info($department[0]->location_id);

		// company info

		$company = $this->Xin_model->read_company_info($location[0]->company_id);

		

		

		$p_method = '';

		if($payment[0]->payment_method==1){

		  $p_method = 'Online';

		} else if($payment[0]->payment_method==2){

		  $p_method = 'PayPal';

		} else if($payment[0]->payment_method==3) {

		  $p_method = 'Payoneer';

		} else if($payment[0]->payment_method==4){

		  $p_method = 'Bank Transfer';

		} else if($payment[0]->payment_method==5) {

		  $p_method = 'Cheque';

		} else {

		  $p_method = 'Cash';

		}



		//$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		$company_name = $company[0]->name;

		// set default header data

		$c_info_email = $company[0]->email;

		$c_info_phone = $company[0]->contact_number;

		$country = $this->Xin_model->read_country_info($company[0]->country);

		$c_info_address = $company[0]->address_1.' '.$company[0]->address_2.', '.$company[0]->city.' - '.$company[0]->zipcode.', '.$country[0]->country_name;

		$email_phone_address = "".$this->lang->line('dashboard_email')." : $c_info_email | ".$this->lang->line('xin_phone')." : $c_info_phone \n".$this->lang->line('xin_address').": $c_info_address";

		$header_string = $email_phone_address;

		

		

		// set document information

		$pdf->SetCreator('Workable-Zone');

		$pdf->SetAuthor('Workable-Zone');

		//$pdf->SetTitle('Workable-Zone - Payslip');

		//$pdf->SetSubject('TCPDF Tutorial');

		//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		$pdf->SetHeaderData('../../../uploads/logo/payroll/'.$system[0]->payroll_logo, 40, $company_name, $header_string);

			

		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		

		// set header and footer fonts

		$pdf->setHeaderFont(Array('helvetica', '', 11.5));

		$pdf->setFooterFont(Array('helvetica', '', 9));

		

		// set default monospaced font

		$pdf->SetDefaultMonospacedFont('courier');

		

		// set margins

		$pdf->SetMargins(15, 27, 15);

		$pdf->SetHeaderMargin(5);

		$pdf->SetFooterMargin(10);

		

		// set auto page breaks

		$pdf->SetAutoPageBreak(TRUE, 25);

		

		// set image scale factor

		$pdf->setImageScale(1.25);

		$pdf->SetAuthor($company_name);

		$pdf->SetTitle($company[0]->name.' - '.$this->lang->line('xin_print_payslip'));

		$pdf->SetSubject($this->lang->line('xin_payslip'));

		$pdf->SetKeywords($this->lang->line('xin_payslip'));

		// set font

		$pdf->SetFont('helvetica', 'B', 10);

				

		// set header and footer fonts

		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		

		// set default monospaced font

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		

		// set margins

		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		

		// set auto page breaks

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		

		// set image scale factor

		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		

		// ---------------------------------------------------------

		

		// set default font subsetting mode

		$pdf->setFontSubsetting(true);

		

		// Set font

		// dejavusans is a UTF-8 Unicode font, if you only need to

		// print standard ASCII chars, you can use core fonts like

		// helvetica or times to reduce file size.

		$pdf->SetFont('dejavusans', '', 10, '', true);

		

		// Add a page

		// This method has several options, check the source code documentation for more information.

		$pdf->AddPage();

		

		// set text shadow effect

		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

		

		// -----------------------------------------------------------------------------

		

		$tbl = '

		<table cellpadding="1" cellspacing="1" border="0">

			<tr>

				<td align="center"><h1>'.$this->lang->line('xin_payslip').'</h1></td>

			</tr>

			<tr>

				<td align="center"><strong>'.$this->lang->line('xin_payslip_number').':</strong> #'.$payment[0]->make_payment_id.'</td>

			</tr>

			<tr>

				<td align="center"><strong>'.$this->lang->line('xin_e_details_date').':</strong> '.date("d F, Y").'</td>

			</tr>

		</table>

		';

		$pdf->writeHTML($tbl, true, false, false, false, '');

		

		// -----------------------------------------------------------------------------

		

		$fname = $user[0]->first_name.' '.$user[0]->last_name;

		$tbl = '

		<table cellpadding="5" cellspacing="0" border="1">

			<tr>

				<td>'.$this->lang->line('xin_name').'</td>

				<td>'.$fname.'</td>

				<td>'.$this->lang->line('dashboard_employee_id').'</td>

				<td>'.$user[0]->employee_id.'</td>

			</tr>

			<tr>

				<td>'.$this->lang->line('left_department').'</td>

				<td>'.$department[0]->department_name.'</td>

				<td>'.$this->lang->line('left_designation').'</td>

				<td>'.$_des_name[0]->designation_name.'</td>

			</tr>

			<tr>

				<td>'.$this->lang->line('xin_salary_month').'</td>

				<td>'.date("F Y", strtotime($payment[0]->payment_date)).'</td>

				<td>'.$this->lang->line('xin_payslip_number').'</td>

				<td>'.$payment[0]->make_payment_id.'</td>

			</tr>

		

		</table>

		';

	

		$pdf->writeHTML($tbl, true, false, true, false, '');

		

		if(null!=$this->uri->segment(3) && $this->uri->segment(3)=='sl') {

		// -----------------------------------------------------------------------------

		

		// Allowances

		if($payment[0]->house_rent_allowance!='' || $payment[0]->house_rent_allowance!=0){

			$hra = $this->Xin_model->currency_sign($payment[0]->house_rent_allowance);

		} else { $hra = '0';}

		if($payment[0]->medical_allowance!='' || $payment[0]->medical_allowance!=0){

			$ma = $this->Xin_model->currency_sign($payment[0]->medical_allowance);

		} else { $ma = '0';}

		if($payment[0]->travelling_allowance!='' || $payment[0]->travelling_allowance!=0){

			$ta = $this->Xin_model->currency_sign($payment[0]->travelling_allowance);

		} else { $ta = '0';}

		if($payment[0]->dearness_allowance!='' || $payment[0]->dearness_allowance!=0){

			$da = $this->Xin_model->currency_sign($payment[0]->dearness_allowance);

		} else { $da = '0';}

		

		// Deductions

		if($payment[0]->provident_fund!='' || $payment[0]->provident_fund!=0){

			$pf = $this->Xin_model->currency_sign($payment[0]->provident_fund);

		} else { $pf = '0';}

		if($payment[0]->tax_deduction!='' || $payment[0]->tax_deduction!=0){

			$td = $this->Xin_model->currency_sign($payment[0]->tax_deduction);

		} else { $td = '0';}

		if($payment[0]->security_deposit!='' || $payment[0]->security_deposit!=0){

			$sd = $this->Xin_model->currency_sign($payment[0]->security_deposit);

		} else { $sd = '0';}

		

		// get advance salary

		if($payment[0]->is_advance_salary_deduct==1){

			$re_paid_amount = $payment[0]->net_salary - $payment[0]->advance_salary_amount;

			$ad_sl = '<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_advance_deducted_salary').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->advance_salary_amount).'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_paid_amount').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->payment_amount).'</td>

			</tr>

			';

		} else {

			$ad_sl = '<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_paid_amount').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->payment_amount).'</td>

			</tr>';

		}

		

		$tbl = '

		<table cellpadding="4" cellspacing="0" border="0">

			<tr>

				<td><table cellpadding="5" cellspacing="0" border="1">

			<tr style="background-color:#9F9;">

				<td><strong>'.$this->lang->line('xin_earning_salary').'</strong></td>

				<td align="right"><strong>'.$this->lang->line('xin_amount').'</strong></td>

			</tr>

			<tr>

				<td>'.$this->lang->line('xin_Payroll_house_rent_allowance').'</td>

				<td align="right">'.$hra.'</td>

			</tr>

			<tr>

				<td>'.$this->lang->line('xin_payroll_medical_allowance').'</td>

				<td align="right">'.$ma.'</td>

			</tr>

			<tr>

				<td>'.$this->lang->line('xin_payroll_travel_allowance').'</td>

				<td align="right">'.$ta.'</td>

			</tr>

			<tr>

				<td>'.$this->lang->line('xin_payroll_dearness_allowance').'</td>

				<td align="right">'.$da.'</td>

			</tr>

		</table></td>

				<td><table cellpadding="5" cellspacing="0" border="1">

			<tr style="background-color:#ff7575;">

				<td><strong>'.$this->lang->line('xin_deduction_salary').'</strong></td>

				<td align="right"><strong>'.$this->lang->line('xin_amount').'</strong></td>

			</tr>

			<tr>

				<td>'.$this->lang->line('xin_payroll_provident_fund_de').'</td>

				<td align="right">'.$pf.'</td>

			</tr>

			<tr>

				<td>'.$this->lang->line('xin_payroll_tax_deduction_de').'</td>

				<td align="right">'.$td.'</td>

			</tr>

			<tr>

				<td>'.$this->lang->line('xin_payroll_security_deposit').'</td>

				<td align="right">'.$sd.'</td>

			</tr>

		</table></td>

			</tr>

		</table>

		';

		

		$pdf->writeHTML($tbl, true, false, false, false, '');

		

		// -----------------------------------------------------------------------------

		

		$tbl = '

		<table cellpadding="5" cellspacing="0" border="1">

			<tr style="background-color:#c4e5fd;">

			  <th colspan="4" align="center"><strong>'.$this->lang->line('xin_payment_details').'</strong></th>

			 </tr>

			 <tr>

				<td colspan="2">'.$this->lang->line('xin_payroll_basic_salary').'</td>

				<td colspan="2" align="right">'.$this->Xin_model->currency_sign($payment[0]->basic_salary).'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_payroll_gross_salary').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->gross_salary).'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_payroll_total_allowance').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->total_allowances).'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_payroll_total_deduction').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->total_deductions).'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_payroll_net_salary').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->net_salary).'</td>

			</tr>

			'.$ad_sl.'

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_payment_method').'</td>

				<td align="right">'.$p_method.'</td>

			</tr>

		</table>

		';

		

		$pdf->writeHTML($tbl, true, false, false, false, '');

		}

		if(null!=$this->uri->segment(3) && $this->uri->segment(3)=='hr') {

		// -----------------------------------------------------------------------------

		$tbl = '

		<table cellpadding="5" cellspacing="0" border="1">

			<tr style="background-color:#c4e5fd;">

			  <th colspan="4" align="center"><strong>'.$this->lang->line('xin_payment_details').'</strong></th>

			 </tr>

			<tr>

				<td colspan="2">'.$this->lang->line('xin_payroll_hourly_rate').'</td>

				<td colspan="2" align="right">'.$this->Xin_model->currency_sign($payment[0]->hourly_rate).'</td>

			</tr>

			<tr>

				<td colspan="2">'.$this->lang->line('xin_total_hours_worked').'</td>

				<td colspan="2" align="right">'.$payment[0]->total_hours_work.'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_payroll_gross_salary').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->payment_amount).'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_payroll_net_salary').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->payment_amount).'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_paid_amount').'</td>

				<td align="right">'.$this->Xin_model->currency_sign($payment[0]->payment_amount).'</td>

			</tr>

			<tr>

				<td colspan="2">&nbsp;</td>

				<td>'.$this->lang->line('xin_payment_method').'</td>

				<td align="right">'.$p_method.'</td>

			</tr>

		</table>

		';

		

		$pdf->writeHTML($tbl, true, false, false, false, '');

		}

		// -----------------------------------------------------------------------------

		

		$tbl = '

		<table cellpadding="5" cellspacing="0" border="0">

			<tr>

				<td align="right" colspan="4">'.$this->lang->line('xin_payslip_authorised_signatory').'</td>

			</tr>

		</table>

		';

		

		$pdf->writeHTML($tbl, true, false, false, false, '');

				

		// ---------------------------------------------------------

		

		// Close and output PDF document

		// This method has several options, check the source code documentation for more information.

		$fname = strtolower($fname);

		$pay_month = strtolower(date("F Y", strtotime($payment[0]->payment_date)));

		//Close and output PDF document

		$pdf->Output('payslip_'.$fname.'_'.$pay_month.'.pdf', 'D');

		

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

