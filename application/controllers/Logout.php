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

 * @package  Ayat Ullah Khan@CTC - Logout

 * @author-email  pm_developer@yahoo.com

 * @copyright  Copyright 2019 © ctc.org.pk All Rights Reserved

 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class logout extends CI_Controller

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

          //load the login model

          $this->load->model('Login_model');

		  $this->load->model('Employees_model');

     }

	 

	// Logout from admin page

	public function index() {

	

		$session = $this->session->userdata('username');

		$last_data = array(

			'is_logged_in' => '0',

			'last_logout_date' => date('d-m-Y H:i:s')

		); 

		$this->Employees_model->update_record($last_data, $session['user_id']);

				

		// Removing session data

		$data['title'] = 'HRMS Software';

		$sess_array = array('username' => '');

		$this->session->sess_destroy();

		$Return['result'] = 'Successfully Logout.';

		redirect('', 'refresh');

	}

} 

?>