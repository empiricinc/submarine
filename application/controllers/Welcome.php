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

 * @package  Ayat Ullah Khan@CTC - Login

 * @copyright  Copyright © ctc.org.pk. All Rights Reserved

 */

 

defined('BASEPATH') OR exit('No direct script access allowed');



class Welcome extends MY_Controller {



	public function __construct()

	{

		parent::__construct();

		$this->load->helper('url_helper');

		 $this->load->model('Employees_model');

		 $this->load->model('Xin_model');

	}

	

	public function index()

	{		

		$data['title'] = 'HRMS Software';

		$this->load->view('login', $data);

	}

}

