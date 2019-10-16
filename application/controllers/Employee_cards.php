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
							'Reports_model',
							'Investigation_model',
							'Resignations_model',
							'Terminations_model',
							'Designations_model',
							'Province_model',
							'Projects_model'
						));


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
		$data['title'] = 'Employee Cards Dashboard';

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ec.card_status' => 'printed'
				];

		$data['printed'] = $this->Reports_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();
		$conditions['ec.card_status'] = 'pending';
		$data['pending'] = $this->Reports_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();
		$conditions['ec.card_status'] = 'delivered';
		$data['delivered'] = $this->Reports_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();
		$conditions['ec.card_status'] = 'received';
		$data['received'] = $this->Reports_model->get_employee_cards($this->remove_empty_entries($conditions), 5, "")->result();

		$data['content'] = $this->load->view('employee-cards/dashboard', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}


	public function view()
	{
		$status_num = $this->input->get('status');
		$offset = $this->input->get('page');

		$card_status = "";
		if($status_num == '1')
			$card_status = 'pending';
		elseif($status_num == '2')
			$card_status = 'printed';
		elseif($status_num == '3')
			$card_status = 'delivered';
		elseif($status_num == '4')
			$card_status = 'received';


		$this->security->xss_clean($status_num);

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ec.card_status' => $card_status
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

		$data['title'] = 'Employee Cards';
		$data['employees'] = $this->Reports_model->get_employee_cards($filtered_conditions, $this->limit, $offset)->result();
		
		$total_rows = $this->Reports_model->get_employee_cards($filtered_conditions)->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url, TRUE);
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['card_status'] = $card_status;
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
					'ec.card_status' => 'pending'
				];
		$filtered_conditions = $this->remove_empty_entries($conditions);
		if($card_ids[0] != "")
		{
			for ($i=0; $i < count($card_ids); $i++) { 
				$conditions['ec.id'] = $card_ids[$i];
				$filtered_conditions = $this->remove_empty_entries($conditions);
				$emp_data = $this->Reports_model->get_employee_cards($filtered_conditions)->row();
				
				array_push($employees, $emp_data);
			}
			$data['employees'] = $employees;
		}
		else
		{
			$data['employees'] = $this->Reports_model->get_employee_cards($filtered_conditions)->result();
		}
		
		$total_rows = $this->Reports_model->get_employee_cards($conditions)->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['content'] = $this->load->view('employee-cards/print-view', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}

	public function received($offset="")
	{
		$card_status = 'delivered';
		$ids = $this->uri->segment(3);
		$card_ids = explode('-', $ids);

		$data['title'] = 'Employee Cards';

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ec.card_status' => $card_status
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
		$data['employees'] = $this->Reports_model->get_employee_cards($filtered_conditions, $this->limit, $offset)->result();
	
		$total_rows = $this->Reports_model->get_employee_cards($filtered_conditions)->num_rows();
		$url = 'Employee_cards/view';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['card_status'] = $card_status;
		$data['content'] = $this->load->view('employee-cards/card-received', $data, TRUE);
		$this->load->view('employee-cards/_template', $data);
	}


	public function change_status()
	{	

		$ids = $this->uri->segment(3);
		$card_ids = explode('-', $ids);

		$status = $card_status = $this->uri->segment(4);
		$is_dash = $this->uri->segment(5);
		
		if($card_status == "")
			show_404();


		$employees = array();
		$date = date('Y-m-d');
		$date_type = '';

		if($card_status == "")
			$card_status = $this->input->get('card_status');

		if($card_status == '1')
		{
			$card_status = 'printed';
			$date_type = 'print_date';
		}
		elseif($card_status == '2')
		{
			$card_status = 'delivered';
			$date_type = 'deliver_date';
		}
		elseif($card_status == '3')
		{
			$card_status = 'received';
			$date_type = 'receive_date';
		}

		$data['title'] = 'Employee Cards';

		
		if($card_ids[0] != "")
		{
			for ($i=0; $i < count($card_ids); $i++) { 
				$this->db->update('employee_cards', 
									array('card_status' => $card_status, $date_type => $date), 
									array('id' => $card_ids[$i])
								);
			}
		}
		else
		{
			$this->db->update('employee_cards', 
								array('card_status' => $card_status)
							);
		}

		
		if($is_dash == '1')
			redirect('Employee_cards/index');
		else if($card_status == 'received')
			redirect('Employee_cards/received');
		redirect(base_url().'Employee_cards/view?status='.$status, 'refresh');
	}



}

