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

 * @author   Ayat Ullah Khan

 * @package  Ayat Ullah Khan@CTC - User > Promotion

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

defined('BASEPATH') OR exit('No direct script access allowed');



class Promotion extends MY_Controller {

	

	 public function __construct() {

        Parent::__construct();

		$this->load->library('session');

		$this->load->helper('form');

		$this->load->helper('url');

		$this->load->helper('html');

		$this->load->database();

		$this->load->library('form_validation');

		//load the model

		$this->load->model("Promotion_model");

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

		$data['breadcrumbs'] = $this->lang->line('left_promotions');

		$data['path_url'] = 'user/user_promotion';

		if(!empty($session)){ 

			$data['subview'] = $this->load->view("user/promotion_list", $data, TRUE);

			$this->load->view('layout_main', $data); //page load

		} else {

			redirect('');

		}

		  

     }

 

    public function promotion_list()

     {



		$data['title'] = $this->Xin_model->site_title();

		$session = $this->session->userdata('username');

		if(!empty($session)){ 

			$this->load->view("user/promotion_list", $data);

		} else {

			redirect('');

		}

		// Datatables Variables

		$draw = intval($this->input->get("draw"));

		$start = intval($this->input->get("start"));

		$length = intval($this->input->get("length"));

		

		

		$promotion = $this->Promotion_model->get_employee_promotions($session['user_id']);

		

		$data = array();



        foreach($promotion->result() as $r) {

			 			  

		// get user > added by

		$user = $this->Xin_model->read_user_info($r->added_by);

		// user full name

		if(!is_null($user)){

			$full_name = $user[0]->first_name.' '.$user[0]->last_name;

		} else {

			$full_name = '--';	

		}

		

		// get user > employee_

		$employee = $this->Xin_model->read_user_info($r->employee_id);

		// employee full name

		if(!is_null($employee)){

			$employee_name = $employee[0]->first_name.' '.$employee[0]->last_name;

		} else {

			$employee_name = '--';	

		}

		// get promotion date

		$promotion_date = $this->Xin_model->set_date_format($r->promotion_date);

		// description

		$description =  html_entity_decode($r->description);

		

		$data[] = array('<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_view').'"><button type="button" class="btn btn-secondary btn-sm m-b-0-0 waves-effect waves-light" data-toggle="modal" data-target=".view-modal-data" data-promotion_id="'. $r->promotion_id . '"><i class="fa fa-eye"></i></button></span>',

			$employee_name,

			$r->title,

			$promotion_date,

			$description,

			$full_name

		);

      }



	  $output = array(

		   "draw" => $draw,

			 "recordsTotal" => $promotion->num_rows(),

			 "recordsFiltered" => $promotion->num_rows(),

			 "data" => $data

		);

	  echo json_encode($output);

	  exit();

     }

}

