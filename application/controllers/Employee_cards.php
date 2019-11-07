<?php 

/**
 * 
 */
class Employee_cards extends MY_Controller
{
	var $session_data;
	function __construct()
	{
		parent::__construct();
		if(empty($this->session->username))
            redirect(base_url());

        $roles = array(1, 2, 3);
        $user_role = $this->session->username['user_role'];

        $project_id = $this->session->username['project_id'];
        $province_id = $this->session->username['provience_id'];
        if(!in_array($user_role, $roles))
			redirect(base_url().'User_panel');

		if($user_role == 1 || $user_role == 2)
		{
			$project_id = '';
			$province_id = '';
		}

        $this->session_data = array(
					        	'user_id' => $this->session->username['employee_id'], 
					        	'project_id' => $project_id, 
					        	'province_id' => $province_id
					        );
        
		$this->load->database();

		$this->load->model(array(
							'Designations_model',
							'Province_model',
							'Projects_model'
						));
		$this->load->model('Employee_cards_model', 'Cards_model');


	}

	function remove_empty_entries($conditions)
	{
		foreach ($conditions as $key => $value) {
			if($value == '')
				unset($conditions[$key]);

		}

		return $conditions;
	}

	function index()
	{
		/* Card status 0 => card request, 1 => pending, 2 => printed, 3 => delivered, 4 => received */
		$data['title'] = 'Employee Cards Dashboard';

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ec.status' => '0',
					'xe.is_active' => '1'
				];

	    $data['card_request'] = $this->Cards_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();

	    $conditions['ec.status'] = '1';
		$data['pending'] = $this->Cards_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();

		$conditions['ec.status'] = '2';
		$data['printed'] = $this->Cards_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();
		
		$conditions['ec.status'] = '3';
		$data['delivered'] = $this->Cards_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();

		$conditions['ec.status'] = '4';
		$data['received'] = $this->Cards_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();

		$data['content'] = $this->load->view('employee-cards/dashboard', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}


	public function view()
	{
		$status = $this->input->get('status');
		$offset = $this->input->get('page');
		$title = '';

		switch ($status) {
			case '0':
				$title = 'Card Requests';
				break;
			case '1':
				$title = 'Pending for Print';
				break;
			case '2':
				$title = 'Printed';
				break;
			case '3':
				$title = 'Delivered';
				break;
			case '4':
				$title = 'Received';
				break;

		}

		$this->security->xss_clean($status);

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ec.status' => $status,
					'xe.is_active' => '1'
				];

		if(isset($_GET['search']))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			$project = (int) $this->input->get('project');
			$designation = (int) $this->input->get('designation');

			$employee_type = $this->input->get('employee_type');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			$conditions['xe.designation_id'] = $designation;

			if($project != 0)
				$conditions['xe.company_id'] = $project;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;

		} 
		
		$filtered_conditions = $this->remove_empty_entries($conditions);


		$data['title'] = $title;
		$data['employees'] = $this->Cards_model->get_employee_cards($filtered_conditions, $this->limit, $offset)->result();
		
		$total_rows = $this->Cards_model->get_employee_cards($filtered_conditions)->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url, TRUE);
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['card_status'] = $status;
		$data['content'] = $this->load->view('employee-cards/view', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}

	public function print_cards()
	{
		$ids = $this->uri->segment(3);
		$card_ids = explode('-', $ids);

		$data['title'] = 'Employee Cards';

		$employees = array();

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ec.status' => '1',
					'xe.is_active' => '1'
				];
		$filtered_conditions = $this->remove_empty_entries($conditions);
		if($card_ids[0] != "")
		{
			for ($i=0; $i < count($card_ids); $i++) { 
				$conditions['ec.id'] = $card_ids[$i];
				$filtered_conditions = $this->remove_empty_entries($conditions);
				$emp_data = $this->Cards_model->get_employee_cards($filtered_conditions)->row();
				
				array_push($employees, $emp_data);
			}
			$data['employees'] = $employees;
		}
		else
		{
			$data['employees'] = $this->Cards_model->get_employee_cards($filtered_conditions)->result();
		}
		
		$total_rows = $this->Cards_model->get_employee_cards($conditions)->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['content'] = $this->load->view('employee-cards/print-view', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}

	public function receive($offset="")
	{
		$card_status = '3';
		$ids = $this->uri->segment(3);
		$card_ids = explode('-', $ids);

		$data['title'] = 'Employee Cards';

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ec.status' => $card_status,
					'xe.is_active' => '1'
				];

		if(isset($_GET['search']))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			$designation = (int) $this->input->get('designation');

			$employee_type = $this->input->get('employee_type');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			$conditions['xe.designation_id'] = $designation;

		} 
		
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Employee Cards';
		$data['employees'] = $this->Cards_model->get_employee_cards($filtered_conditions, $this->limit, $offset)->result();
	
		$total_rows = $this->Cards_model->get_employee_cards($filtered_conditions)->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['card_status'] = $card_status;
		$data['content'] = $this->load->view('employee-cards/card-received', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}


	public function status_update()
	{
		$ids = $this->input->post('card_ids');
		$status = $this->input->post('status');
		$date = $this->input->post('status_date');

		$card_ids = explode('-', $ids);
		$new_status = '';
		$date_field = '';

		switch ($status) {
			case '0':
				$new_status = '1';
				$date_field = 'request_print_date';
				break;
			case '1':
				$new_status = '2';
				$date_field = 'print_date';
				break;
			case '2':
				$new_status = '3';
				$date_field = 'deliver_date';
				break;
			case '3':
				$new_status = '4';
				$date_field = 'receive_date';
				break;
		}

		if($card_ids[0] != '')
		{
			for ($i=0; $i < count($card_ids); $i++) { 
				$conditions = array('id' => $card_ids[$i]);
				$data = array('status' => $new_status, $date_field => $date);
				$updated = $this->Cards_model->update_card_status($conditions, $data);
			}
		}
		else
		{
			$conditions = array('id' => $card_id);
			$data = array('status' => $new_status, $date_field => $date);
			
			$updated = $this->Cards_model->update_card_status($conditions, $data);
		}

		
		if($updated)
		{
			if($status == '3')
				redirect('Employee_cards/received', 'refresh');
			else
				redirect('Employee_cards/view?status='.$status, 'refresh');
		}
	}

	public function update_status_all()
	{
		$status = $this->input->post('status');
		$date = $this->input->post('status_date');

		switch ($status) {
			case '0':
				$new_status = '1';
				$date_field = 'request_print_date';
				break;
			case '1':
				$new_status = '2';
				$date_field = 'print_date';
				break;
			case '2':
				$new_status = '3';
				$date_field = 'deliver_date';
				break;
			case '3':
				$new_status = '4';
				$date_field = 'receive_date';
				break;
		}

		$conditions = array('status' => $status);
		$data = array('status' => $new_status, $date_field => $date);
		
		$updated = $this->Cards_model->update_card_status($conditions, $data);

		if($updated)
		{
			// $this->session->set_flashdata('success', 'Status Updated successfully');
			redirect('Employee_cards/view?status='.$status, 'refresh');
		}

	}



}

