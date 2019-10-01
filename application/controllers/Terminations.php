<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Terminations extends MY_Controller
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
		
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'html'));
		$this->load->model(array('Terminations_model', 'Projects_model', 'Designations_model'));
	}


	function remove_empty_entries($conditions)
	{
		foreach ($conditions as $key => $value) {
			if($value == '')
				unset($conditions[$key]);

		}

		return $conditions;
	}

	public function add()
	{
		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.status <' => '5',
					'xe.is_active' => '1'
				];
		$filtered_conditions = $this->remove_empty_entries($conditions);
		$exclude_user_roles = array(1, 2);
		
		$data['title'] = "Employee Termination Form";
		$data['employees'] = $this->Terminations_model->get_employees($filtered_conditions, $exclude_user_roles);
		$data['reasons'] = $this->Terminations_model->get_termination_reasons();
		$data['content'] = $this->load->view("terminations/add", $data, TRUE);
		$this->load->view('terminations/_template', $data);
	}

	public function terminate()
	{
		$terminated_by = $this->session_data['user_id'];

		$this->form_validation->set_rules('employee', 'Employee', 'required');
		$this->form_validation->set_rules('reason', 'Reason', 'required');
		// $this->form_validation->set_rules('other_reason', 'Other reason', 'required');
		$this->form_validation->set_rules('termination_date', 'Termination Date', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('error', '<strong>Error!</strong> All fields are required.');
			redirect('Terminations/add', 'refresh');
		}

		$employee = $this->input->post('employee');
		$reason = $this->input->post('reason');
		$other_reason_text = $this->input->post('other_reason');
		$termination_date = $this->input->post('termination_date');
		$description = $this->input->post('description');


		$data = array(
					'employee_id' => $employee,
					'reason_id' => $reason,
					'other_reason' => $other_reason_text,
					'termination_date' => $termination_date,
					'description' => $description,
					'terminated_by' => $terminated_by				
				);

		if($this->Terminations_model->add_new($data))
		{
			$this->Terminations_model->employee_status($employee);
			$this->session->set_flashdata('success', '<strong>Success!</strong> Employee terminated successfully.');
		}
		else
		{
			$this->session->set_flashdata('error', '<strong>Error!</strong> Employee termination failed.');
		}

		redirect('Terminations/add', 'refresh');
	}


	function view($offset="")
	{
		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$employeeName = $this->input->get('employee_name');
			$project = $this->input->get('project');
			$designation = $this->input->get('designation');

			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['t.termination_date >='] = $fromDate;
			$conditions['t.termination_date <='] = $toDate;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			$conditions['xe.designation_id'] = $designation;
			
			if($project != 0)
				$conditions['xe.company_id'] = $project;

		} 

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Terminations_model->get_terminations($filtered_conditions)->num_rows();
		$url = 'Terminations/view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

		$data['title'] = "List of terminated employees";
		$data['query_string'] = $_SERVER['QUERY_STRING'];

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['terminated'] = $this->Terminations_model->get_terminations($filtered_conditions, $this->limit, $offset)->result();
		
		$data['content'] = $this->load->view("terminations/view", $data, TRUE);
		$this->load->view('terminations/_template', $data);
	}


	// function requests($offset="")
	// {
	// 	$conditions = [
	// 				'xe.company_id' => $this->session_data['project_id'],
	// 				'xe.provience_id' => $this->session_data['province_id']
	// 			];

	// 	if(isset($_GET['search']))
	// 	{
	// 		$fromDate = $this->input->get('from_date');
	// 		$toDate = $this->input->get('to_date');
	// 		$employeeName = $this->input->get('employee_name');
	// 		$project = $this->input->get('project');
	// 		$designation = $this->input->get('designation');

	// 		if($employeeName != '')
	// 			$employeeName = '%'.$employeeName.'%';

	// 		$conditions['t.confirmed_date >='] = $fromDate;
	// 		$conditions['t.confirmed_date <='] = $toDate;
	// 		$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
	// 		$conditions['xe.designation_id'] = $designation;
			
	// 		if($project != 0)
	// 			$conditions['xe.company_id'] = $project;

	// 	} 

	// 	$filtered_conditions = $this->remove_empty_entries($conditions);

	// 	$total_rows = $this->Terminations_model->get_requests($filtered_conditions)->num_rows();
	// 	$url = 'Terminations/requests';

	// 	$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
	// 	$data['title'] = "Termination Requests";
	// 	$data['query_string'] = $_SERVER['QUERY_STRING'];

	// 	$data['terminated'] = $this->Terminations_model->get_requests($filtered_conditions, $this->limit, $offset)->result();

	// 	$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
	// 	$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
	// 	$data['content'] = $this->load->view("terminations/requests", $data, TRUE);
	// 	$this->load->view('terminations/_template', $data);
	// }


	function detail($termination_id)
	{
	
		if(!empty($termination_id))
		{
			$conditions = [
						'xe.company_id' => $this->session_data['project_id'],
						'xe.provience_id' => $this->session_data['province_id'],
						't.id' => $termination_id
						];

			$filtered_conditions = $this->remove_empty_entries($conditions);

			$data['title'] = "Employee Termination Detail";
			$data['detail'] = $this->Terminations_model->get_termination_detail($filtered_conditions);
			if(empty($data['detail']))
			{
				show_404();
			}
			$data['content'] = $this->load->view('terminations/detail', $data, TRUE);
			$this->load->view('terminations/_template', $data);
		}
		else
		{
			show_404();
		}
		
	}

	// public function confirm($termination_id)
	// {
	// 	$employee_id = $this->session_data['user_id'];

 //        $date = date('Y-m-d');

 //        $data = array(
 //                    'confirmed_by' => $employee_id,
 //                    'confirmed_date' => $date,
 //                    'status' => '1'
 //                );

 //        $res = $this->Terminations_model->confirmed_by($termination_id, $data);

 //        if($res)
 //        {
 //            $this->session->set_flashdata('success', '<strong>Done!</strong> Employee Terminated');
 //            redirect('Terminations/requests');
 //        }
 //        else
 //        {
 //            $this->session->set_flashdata('success', '<strong>Error!</strong> Server Problem');
 //            redirect('Terminations/requests');
 //        }
	// }

}