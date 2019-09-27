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

 * @package  Ayat Ullah Khan@CTC - Accounting

 * @copyright  Copyright © ctc.org.pk. All Rights Reserved

 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Payroll_settings extends MY_Controller

{


   /*Function to set JSON output*/

	public function output($Return=array()){

		/*Set response header*/

		header("Access-Control-Allow-Origin: *");

		header("Content-Type: application/json; charset=UTF-8");

		/*Final JSON response*/

		exit(json_encode($Return));

	}

	public function __construct()

     {

          parent::__construct();

          $this->load->library('session');

          $this->load->helper('form');

          $this->load->helper('url');

          $this->load->helper('html');

          $this->load->database();

          $this->load->library('form_validation');

          //load the models

          $this->load->model('Common_model');

          $this->load->model('Xin_model');


     }

	 public function payroll_settings() {

	

		$session = $this->session->userdata('username');

		if(empty($session)){

			redirect('');

		}

		$con['conditions'] = array();
		$bank_cashes = $this->Common_model->getRows($con, 'xin_finance_bankcash');
		$data['bank_cashes'] = $bank_cashes ? $bank_cashes : array();

		$data['title'] = 'Payrolls';

		$data['breadcrumbs'] = $this->lang->line('xin_acc_payrolls');

		$data['path_url'] = 'payroll_settings';

		$role_resources_ids = $this->Xin_model->user_role_resource();

		if(!empty($session)){ 

			$data['subview'] = $this->load->view("payroll_settings/payroll_settings_list", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

		} else {

			redirect('');

		}

	}

	public function list() {

		$con['condiions'] = array();
		$con['returnType'] = 'object';
		$con['innerJoin'] = array(array(
            'table' => 'xin_finance_bankcash',
            'condition' =>'xin_finance_bankcash.bankcash_id = xin_payroll_settings.bankcash_id',
            'joinType' => 'inner'
        ));
		$payrolls = $this->Common_model->getRows($con, 'xin_payroll_settings');

		

		$data = array();


          foreach($payrolls as $payroll) {
	



		   $data[] = array(

				'<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_delete').'"><button type="button" class="btn btn-danger btn-sm m-b-0-0 waves-effect waves-light delete" data-toggle="modal" data-target=".delete-modal" data-record-id="'. $payroll->id . '"><i class="fa fa-trash-o"></i></button></span>',

				$payroll->name,

				$payroll->account_name,

				ucfirst($payroll->payroll_item)
				

		   );

          }

          $output = array(


                 "recordsTotal" => count($payrolls),

                 "recordsFiltered" => count($payrolls),

                 "data" => $data

            );
          echo json_encode($output);

          exit();

	}

	public function add() {
		if($this->input->post('add_type')=='add_payroll_settings') {		

		/* Define return | here result is used to return user data and error for error message */

		$Return = array('result'=>'', 'error'=>'');

			

		/* Server side PHP input validation */		

		if($this->input->post('name')==='') {

        	$Return['error'] = $this->lang->line('xin_acc_error_payroll_name');

		}

				

		if($Return['error']!=''){

       		$this->output($Return);

    	}

	

		$data = array(

		'name' => $this->input->post('name'),

		'payroll_item' => $this->input->post('payroll_item'),

		'bankcash_id' => $this->input->post('bankcash_id'),

		'created_at' => date('d-m-Y h:i:s'),

		'updated_at' => date('d-m-Y h:i:s')

		);

		$result = $this->Common_model->insert($data, 'xin_payroll_settings');

		if ($result == TRUE) {

			$Return['result'] = $this->lang->line('xin_acc_success_payroll_added');

		} else {

			$Return['error'] = $this->lang->line('xin_error_msg');

		}

		$this->output($Return);

		exit;

		}
	}

		 // delete record

	public function delete() {
		
		if($this->input->post('is_ajax')=='2') {

			/* Define return | here result is used to return user data and error for error message */

			$Return = array('result'=>'', 'error'=>'');

			$id = $this->uri->segment(3);
			$condition = array('id' => $id);
       		$result = $this->Common_model->delete($condition, 'xin_payroll_settings');

			if(isset($id)) {

				$Return['result'] = $this->lang->line('xin_acc_success_bank_cash_deleted');

			} else {

				$Return['error'] = $this->lang->line('xin_error_msg');

			}

			$this->output($Return);

		}

	}
} 

?>