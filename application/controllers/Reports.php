<?php 

/**
 * 
 */
class Reports extends MY_Controller
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

        /* If admin, superadmin */
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
							'User_panel_model',
							'Province_model',
							'Departments_model',
							'Designations_model',
							'Projects_model',
							'Complaint_model'
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
		// $this->check_read_access('reports');
		$data['title'] = 'Reports Dashboard';
		$data['content'] = $this->load->view('reports/dashboard', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}

	/* Search Conditions */
	private function sc_employees($search_query)
	{
		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.is_active' => '1',
					'xe.status !=' => '0'
				];

		$employee_type = "current";

		if(isset($_GET['search']))
		{
			// parse_str(base64_decode($_GET['query']), $_GET);
			
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			// $district = (int) $this->input->get('district');
			// $tehsil = (int) $this->input->get('tehsil');
			// $uc = (int) $this->input->get('uc');
			$project = (int) $this->input->get('project');
			$designation = (int) $this->input->get('designation');
			// $location = (int) $this->input->get('location');

			$employee_type = $this->input->get('employee_type');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;
			if($project != 0)
				$conditions['xe.company_id'] = $project;
			$conditions['xe.designation_id'] = $designation;
			
		} 
	
		return array($this->remove_empty_entries($conditions), $employee_type);
	}

	private function sc_resignation($search_query)
	{
		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			// parse_str(base64_decode($_GET['query']), $_GET);
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$employeeName = $this->input->get('employee_name');
			$project = (int) $this->input->get('project');
			$designation = (int) $this->input->get('designation');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xer.resignation_date >='] = $fromDate;
			$conditions['xer.resignation_date <='] = $toDate;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			$conditions['xe.designation_id'] = $designation;
			if($project != 0)
				$conditions['xe.company_id'] = $project;
			
		} 

		return $this->remove_empty_entries($conditions);
	}

	private function sc_termination($search_query)
	{
		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			// parse_str(base64_decode($_GET['query']), $_GET);
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

		return $this->remove_empty_entries($conditions);
	}

	private function sc_training($search_query)
	{
		$conditions = [
					'xt.project' => $this->session_data['project_id'],
					'xt.location' => $this->session_data['province_id']
				];
		if(isset($_GET['search']))
		{
			// parse_str(base64_decode($_GET['query']), $_GET);
			$project = (int) $this->input->get('project');
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$facilitator = $this->input->get('facilitator');
			$training_type = (int) $this->input->get('training_type');
			$province = (int) $this->input->get('province');
			$district = (int) $this->input->get('district');

			// $training_format = $this->input->get('training_format');

			if($facilitator != '')
				$facilitator = '%'.$facilitator.'%';
			
			$conditions['xt.facilitator_name LIKE'] = $facilitator;
			$conditions['xt.start_date >='] = $from_date;
			$conditions['xt.to_date <='] = $to_date;
			$conditions['xt.trg_type'] = $training_type;
			$conditions['xt.district'] = $district;

			if($project != 0)
				$conditions['xt.project'] = $project;
			if($province != 0)
				$conditions['xt.location'] = $province;

		} 

		return $this->remove_empty_entries($conditions);
	}

	private function sc_complaints($search_query)
	{
		$conditions = [
					'c.project_id' => $this->session_data['project_id'],
					'c.province_id' => $this->session_data['province_id'],
					'c.status' => 'resolved'
				];

		if(isset($_GET['search']))
		{
			// parse_str(base64_decode($_GET['query']), $_GET);
			$complaintNo = $this->input->get('complaint_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$province = $this->input->get('province');
			$project = $this->input->get('project');

			if($complaintNo != "")
				$conditions['c.complaint_no LIKE'] = '%'.$complaintNo.'%';
			$conditions['c.created_at >='] = $fromDate;
			$conditions['c.created_at <='] = $toDate;


			if($project != 0)
				$conditions['c.project_id'] = $project;
			if($province != 0)
				$conditions['c.province_id'] = $province;
		} 

		return $this->remove_empty_entries($conditions);
	}

	private function sc_events($search_query)
	{
		$conditions = [
					'xc.company_id' => $this->session_data['project_id'],
					'ec.province' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			// parse_str(base64_decode($_GET['query']), $_GET);
			$project = (int) $this->input->get('project');
			$designation = (int) $this->input->get('designation');
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$province = (int) $this->input->get('province');
			$district = (int) $this->input->get('district');
			$training_type = (int) $this->input->get('training_type');

			$conditions['xd.designation_id'] = $designation;
			$conditions['ec.start_date >='] = $from_date;
			$conditions['ec.end_date <='] = $to_date;
			$conditions['ec.district'] = $district;
			$conditions['ec.trg_type'] = $training_type; 

			if($project != 0)
				$conditions['xc.company_id'] = $project;
			if($province != 0)
				$conditions['ec.province'] = $province;
			
		} 

		return $this->remove_empty_entries($conditions);
	}

	private function sc_activity($search_query)
	{
		$conditions = [
					'xt.project' => $this->session_data['project_id'],
					'xt.location' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			// parse_str(base64_decode($_GET['query']), $_GET);
			$project = $this->input->get('project');
			$from_date = $this->input->get('from_date');
			$to_date = $this->input->get('to_date');
			$province = $this->input->get('province');
			$district = $this->input->get('district');
			$training_type = $this->input->get('training_type');
			
			$conditions['xt.start_date >='] = $from_date;
			$conditions['xt.end_date <='] = $to_date;
			$conditions['xt.district'] = $district;
			$conditions['xt.trg_type'] = $training_type;

			if($project != 0)
				$conditions['xt.project'] = $project;
			if($province != 0)
				$conditions['xt.location'] = $province;
		} 

		return $this->remove_empty_entries($conditions);
	}

	/* ./ Search Conditions */

	public function employees($offset="")
	{
		// $this->check_read_access('reports');

		$query_string = $data['query_string'] = $_SERVER['QUERY_STRING'];

		list($conditions, $employee_type) = $this->sc_employees($query_string);
		/* Pagination */

		$total_rows = $this->Reports_model->get_employees($conditions, $employee_type)->num_rows();
		$url = 'Reports/employees';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		/* end pagination */

		$data['title'] = 'List of Employees';
		$data['employees'] = $this->Reports_model->get_employees($conditions, $employee_type, $this->limit, $offset)->result();
		
		
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']);
		$data['content'] = $this->load->view('reports/employees', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}

	public function employee_cards()
	{
		$query_string = $data['query_string'] = $_SERVER['QUERY_STRING'];
		list($conditions, $employee_type) = $this->sc_employees($query_string);

		$data['title'] = 'Employee Cards';
		$data['employees'] = $this->Reports_model->get_employee_cards($conditions, $employee_type)->result();
		
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']);
		$data['content'] = $this->load->view('reports/employee-cards', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}

	public function district_for_province()
	{
		$this->ajax_check();
		$province_id = $this->input->post('province_id');
		$districts = $this->Reports_model->get_district_province($province_id);

		$this->json_response($districts);
	}

	public function tehsil_for_district()
	{
		$this->ajax_check();
		$district_id = $this->input->post('district_id');
		$tehsils = $this->Reports_model->get_tehsil_district($district_id);

		$this->json_response($tehsils);
	}

	public function uc_for_tehsil()
	{
		$this->ajax_check();
		$tehsil_id = $this->input->post('tehsil_id');
		$union_councils = $this->Reports_model->get_uc_tehsil($tehsil_id);

		$this->json_response($union_councils);
	}

	public function area_for_uc()
	{
		$this->ajax_check();
		$uc_id =  $this->input->post('uc_id');
		$areas = $this->Reports_model->get_area_uc($uc_id);

		$this->json_response($areas);
	}

	public function subarea_for_area()
	{
		$this->ajax_check();
		$area_id = $this->input->post('area_id');
		$sub_areas = $this->Reports_model->get_sub_area($area_id);

		$this->json_response($sub_areas);
	}


	function resignations($offset="")
	{	
		$query_string = $data['query_string'] = $_SERVER['QUERY_STRING'];
		$conditions = $this->sc_resignation($query_string);

		$total_rows = $this->Resignations_model->get_resignations($conditions)->num_rows();
		$url = 'Reports/resignations';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		$data['r_employees'] = $this->Resignations_model->get_resignations($conditions, $this->limit, $offset)->result();
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);

		$data['title'] = 'List of Resigned Employees';
		$data['content'] = $this->load->view('reports/resignations', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}

	function resignation_detail($resignation_id)
	{
	
		if(!empty($resignation_id))
		{
			$conditions = [
						'xe.company_id' => $this->session_data['project_id'],
						'xe.provience_id' => $this->session_data['province_id'],
						'xer.resignation_id' => $resignation_id
					];
			$filtered_conditions = $this->remove_empty_entries($conditions);

			$this->load->model('Resignations_model');
			$data['title'] = "Employee Resignation Detail";

			$data['detail'] = $this->Resignations_model->get_detail($filtered_conditions)->row();
			if(empty($data['detail']))
			{
				show_404();
			}
			$data['content'] = $this->load->view('reports/resignation-detail', $data, TRUE);
			$this->load->view('reports/_template', $data);
		}
		else
		{
			show_404();
		}
		
	}

	function terminations($offset="")
	{
		$query_string = $data['query_string'] = $_SERVER['QUERY_STRING'];
		$conditions = $this->sc_termination($query_string);

		$total_rows = $this->Terminations_model->get_terminations($conditions)->num_rows();
		$url = 'Reports/terminations';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);

		$data['title'] = "List of terminated employees";
		
		$data['terminated'] = $this->Terminations_model->get_terminations($conditions, $this->limit, $offset)->result();
		
		$data['content'] = $this->load->view("reports/terminations", $data, TRUE);
		$this->load->view('reports/_template', $data);
	}

	function termination_detail($termination_id)
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
			$data['content'] = $this->load->view('reports/termination-detail', $data, TRUE);
			$this->load->view('reports/_template', $data);
		}
		else
		{
			show_404();
		}
		
	}


	function complaints($offset="")
	{
		$search_query = $data['search_query'] = $_SERVER['QUERY_STRING'];
		$conditions = $this->sc_complaints($search_query);

		$total_rows = $this->Complaint_model->get_complaints($conditions)->num_rows();
		$url = 'Reports/complaints';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Complaint_model->get_complaints($conditions, $this->limit, $offset)->result();
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['province'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		 
		$data['complaints_table'] = $this->load->view('reports/tables/complaints-table', $data, TRUE);
		$data['content'] = $this->load->view('reports/complaints', $data, TRUE);

		$this->load->view('reports/_template', $data);
	}


	function complaint_detail($id)
	{
		$data['title'] = 'Complaint Detail & Remarks';

		$data['project_head'] = $this->Complaint_model->get_project_head($id);

		$conditions = [
						'c.project_id' => $this->session_data['project_id'],
						'c.province_id' => $this->session_data['province_id'],
						'c.id' => $id
						];

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['detail'] = $this->Complaint_model->get_complaints($filtered_conditions);
		if(empty($data['detail']))
		{
			show_404();
		}
		//get_files_and_reviews($complint_id, $sender, $receiver) takes these three arguments
		$data['remarks'] = $this->Complaint_model->get_remarks($id);
		
		if(!empty($data['remarks']))
		{

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Complaint_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}
		

		$data['content'] = $this->load->view('reports/complaint-detail', $data, TRUE);

		$this->load->view('reports/_template', $data);
		
	}


	public function employee_detail($employee_id)
	{
		$conditions = [
				'xe.company_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id'],
				'xe.employee_id' => $employee_id
			];
		$filtered_conditions = $this->remove_empty_entries($conditions);
		$data['title'] = "Employee Detail";

		$data['detail'] = $this->Reports_model->get_employee_detail($filtered_conditions);
		if(empty($data['detail']))
		{
			show_404();
		}
		
		$data['content'] = $this->load->view('reports/employee-detail', $data, TRUE);
		$this->load->view('reports/_template', $data);
		
	}


	public function trainings($offset=NULL)
	{
		$query_string = $data['query_string'] = $_SERVER['QUERY_STRING'];
		$conditions = $this->sc_training($query_string);

		$data['title'] = "List of Trainings";
		$data['training'] = $this->Reports_model->get_trainings($conditions, $this->limit, $offset)->result();

		$total_rows = $this->Reports_model->get_trainings($conditions)->num_rows();
		$url = 'Reports/trainings';
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['training_type'] = $this->Reports_model->get_training_types();

		$data['content'] = $this->load->view('reports/trainings', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}


	public function training_detail($training_id)
	{
		if(!empty($training_id))
		{
			$conditions = [
						'xt.project' => $this->session_data['project_id'],
						'xt.location' => $this->session_data['province_id'],
						'xt.trg_id' => $training_id
					];

			$filtered_conditions = $this->remove_empty_entries($conditions);

			$data['title'] = "Training Detail";
			$data['detail'] = $this->Reports_model->get_training_detail($filtered_conditions);
			if(empty($data['detail']))
			{
				show_404();
			}
			$data['content'] = $this->load->view('reports/training-detail', $data, TRUE);
			$this->load->view('reports/_template', $data);
		}
		else
		{
			show_404();
		}
	}

	public function training_attendees($training_id)
	{
		if(!empty($training_id))
		{
			$conditions = [
						'xt.project' => $this->session_data['project_id'],
						'xt.location' => $this->session_data['province_id'],
						'xt.trg_id' => $training_id
					];

			$filtered_conditions = $this->remove_empty_entries($conditions);

			$data['title'] = "Training Attendance Detail";
			$data['detail'] = $this->Reports_model->get_training_detail($filtered_conditions);
			if(empty($data['detail']))
			{
				show_404();
			}
			$data['attendees']  = $this->Reports_model->get_training_attendance($training_id);
			$data['attendance_date'] = $this->Reports_model->get_attendance_dates($training_id);

			$data['content'] = $this->load->view('reports/training-attendees', $data, TRUE);
			$this->load->view('reports/_template', $data);
		}
		else
		{
			show_404();
		}
	}

	public function training_expenses($training_id)
	{
		if(!empty($training_id))
		{
			$conditions = [
						'xt.project' => $this->session_data['project_id'],
						'xt.location' => $this->session_data['province_id'],
						'xt.trg_id' => $training_id
					];

			$filtered_conditions = $this->remove_empty_entries($conditions);

			$data['title'] = "Training Allowances Detail";
			$data['detail'] = $this->Reports_model->get_training_detail($filtered_conditions);
			if(empty($data['detail']))
			{
				show_404();
			}
			$data['expenses'] = $this->Reports_model->get_training_expenses($training_id);

			$data['content'] = $this->load->view('reports/training-expense', $data, TRUE);
			$this->load->view('reports/_template', $data);
		}
		else
		{
			show_404();
		}
	}


	public function tests($offset="")
	{
		$date_from = $this->input->get('date_from');
		$date_to = $this->input->get('date_to');
		$job_id = $this->input->get('job_id');
		$project = $this->input->get('project');
		$designation = $this->input->get('designation');
		$rollno = $this->input->get('rollno');
		$applicant_name = $this->input->get('applicant_name');


		$data['title'] = "List of Tests";
		$data['query_string'] = $_SERVER['QUERY_STRING'];

		$conditions = [
						'xin_job_applications.project' => $this->session_data['project_id'],
						'xin_job_applications.province' => $this->session_data['province_id']
					];

		$conditions['xin_job_applications.created_at >='] = $date_from;
		$conditions['xin_job_applications.created_at <='] = $date_to;
		$conditions['xin_job_applications.job_id'] = $job_id;
		$conditions['xin_companies.company_id'] = $project;
		$conditions['xin_designations.designation_id'] = $designation;
		$conditions['xin_job_applications.application_id'] = $rollno;

		if($applicant_name != '')
			$conditions['xin_job_applications.fullname'] = "%".$applicant_name."%";

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Reports_model->list_tests($filtered_conditions)->num_rows();
		$url = 'Reports/tests';
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url, TRUE);

		$data['tests'] = $this->Reports_model->list_tests($filtered_conditions)->result();
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);

		$data['jobs'] = $this->Reports_model->get_jobs();

		$data['content'] = $this->load->view('reports/tests', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}


	public function test_detail($applicant_id)
	{
		$conditions = [
						'xin_job_applications.project' => $this->session_data['project_id'],
						'xin_job_applications.province' => $this->session_data['province_id'],
						'xin_job_applications.application_id' => $applicant_id
					];

		if(!empty($applicant_id))
		{
			$data['title'] = "Test Detail";
			
			$filtered_conditions = $this->remove_empty_entries($conditions);
			$data['detail'] = $this->Reports_model->test_detail($filtered_conditions);
			if(empty($data['detail']))
			{
				show_404();
			}
			$data['content'] = $this->load->view('reports/test-detail', $data, TRUE);
			$this->load->view('reports/_template', $data);
		}
		else
		{
			show_404();
		}
	}


	public function events($offset="")
	{
		$search_query = $data['search_query'] = $_SERVER['QUERY_STRING'];
		$conditions = $this->sc_events($search_query);
		
		$data['title'] = "List of Events";
		$data['events'] = $this->Reports_model->get_events($conditions, $this->limit, $offset)->result();
	
		$total_rows = $this->Reports_model->get_events($conditions)->num_rows();
		$url = 'Reports/events';
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designation'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['training_type'] = $this->Reports_model->get_training_types();

		$data['content'] = $this->load->view('reports/events', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}

	function activity($offset="")
	{
		$search_query = $data['search_query'] = $_SERVER['QUERY_STRING'];
		$conditions = $this->sc_activity($search_query);

		$training_detail = $this->Reports_model->get_activity_detail($conditions, $this->limit, $offset)->result_array();

		for($i=0; $i<count($training_detail); $i++)
		{		
			$employees_detail[$i] = array();

			$participants = explode(',', $training_detail[$i]['trainee_employees']);
			
			for($j=0; $j<count($participants); $j++)
			{

				$emp = $this->Reports_model->get_designation_gender($participants[$j])->row_array();	
				array_push($employees_detail[$i], $emp);
			}


			$training[$i] = array();
			$training[$i]['detail'] = $training_detail[$i];

			$maleParticipants = 0;
			$femaleParticipants = 0; 
			$totalParticipants = 0;

			$currentDesignation = 0;
			$designations = array();
	
			rsort($employees_detail[$i]);
			for($x=0; $x<count($employees_detail[$i]); $x++)
			{

				if($employees_detail[$i][$x]['designation_id'] != $currentDesignation)
				{
					array_push($designations, $employees_detail[$i][$x]['designation_name']);
				}

				if($employees_detail[$i][$x]['gender'] == 'Male')
				{
					$maleParticipants += 1;
				}
				elseif($employees_detail[$i][$x]['gender'] == 'Female')
				{
					$femaleParticipants += 1;
				}

				$currentDesignation = $employees_detail[$i][$x]['designation_id'];
			}

			$training[$i]['male_participants'] = $maleParticipants;
			$training[$i]['female_participants'] = $femaleParticipants;
			$training[$i]['designations'] = array_values(array_unique($designations));
		}

		
		$url = 'Reports/activity';
		$total_rows = $this->Reports_model->get_activity_detail($conditions)->num_rows();
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

		$data['title'] = 'Training Activity';
		$data['training'] = (isset($training)) ? $training : array();
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['training_type'] = $this->Reports_model->get_training_types();
		$data['content'] = $this->load->view('reports/training-activity', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}


	public function training_calendar()
	{
		$data['title'] = 'Training Calendar';

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']);
		$data['content'] = $this->load->view('reports/training-calendar', $data, TRUE);
		$this->load->view('reports/_template', $data);
	}

	public function generate_calendar()
	{
		$project = $this->input->get('project');
		$months = $this->input->get('months');
		$year = $this->input->get('year');
		$partYear = '';
		if($months == 'jan_jun')
			$partYear = 'first';
		elseif($months == 'jul_dec')
			$partYear = 'second';

		$this->cbv_training_calendar($project, $year, $partYear);
	}


	/* Excel Reports */

	public function createEmployeeXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $query_string = $_SERVER['QUERY_STRING'];
		list($conditions, $employee_type) = $this->sc_employees($query_string);

        $empInfo = $this->Reports_model->get_employees($conditions, $employee_type)->result();
     
        if(count($empInfo) == 0)
        	exit('No Records found');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        $entity = array();
        $entity = range('A', 'Z');

        array_push($entity, 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG');

        foreach($entity as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

        $sheet->getStyle('A1:AG1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'ID');
        $sheet->SetCellValue('B1', 'Name'); 
        $sheet->SetCellValue('C1', 'Father Name'); 
        $sheet->SetCellValue('D1', 'Company'); 
        $sheet->SetCellValue('E1', 'Department'); 
        $sheet->SetCellValue('F1', 'Designation'); 
        $sheet->SetCellValue('G1', 'Location'); 
        $sheet->SetCellValue('H1', 'Gender'); 
        $sheet->SetCellValue('I1', 'DOB'); 
        $sheet->SetCellValue('J1', 'Contact No'); 
        $sheet->SetCellValue('K1', 'Other Contact'); 
        $sheet->SetCellValue('L1', 'CTC Mobile No'); 
        $sheet->SetCellValue('M1', 'Residentail Address'); 
        $sheet->SetCellValue('N1', 'Permanent Address'); 
        $sheet->SetCellValue('O1', 'Marital Status'); 
        $sheet->SetCellValue('P1', 'CNIC'); 
        $sheet->SetCellValue('Q1', 'CNIC Expiry'); 
        $sheet->SetCellValue('R1', 'Contract Date'); 
        $sheet->SetCellValue('S1', 'Contract Expiry'); 
        $sheet->SetCellValue('T1', 'Nationality'); 
        $sheet->SetCellValue('U1', 'Religion'); 
        $sheet->SetCellValue('V1', 'Tribe'); 
        $sheet->SetCellValue('W1', 'Ethnicity'); 
        $sheet->SetCellValue('X1', 'Language'); 
        $sheet->SetCellValue('Y1', 'Blood Group'); 

        if($employee_type == "resigned")
        {
	        $sheet->SetCellValue('Z1', 'Resignation Reason');       
	        $sheet->SetCellValue('AA1', 'Other Reason');       
	        $sheet->SetCellValue('AB1', 'Description');       
	        $sheet->SetCellValue('AC1', 'Resignation Date');       
	        $sheet->SetCellValue('AD1', 'Accepted By');       
	        $sheet->SetCellValue('AE1', 'Accepted Date');  
        }    
        elseif($employee_type == "terminated")
        {
	        $sheet->SetCellValue('Z1', 'Termination Reason');       
	        $sheet->SetCellValue('AA1', 'Other Reason');       
	        $sheet->SetCellValue('AB1', 'Description');       
	        $sheet->SetCellValue('AC1', 'Notice Date');       
	        $sheet->SetCellValue('AD1', 'Terminated By');       
	        $sheet->SetCellValue('AE1', 'Termination Date');       
	        $sheet->SetCellValue('AF1', 'Termination Accepted By');  
	        $sheet->SetCellValue('AG1', 'Accepted Date');  
        }   

        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $sheet->SetCellValue('A' . $rowCount, $element->employee_id);
            $sheet->SetCellValue('B' . $rowCount, ucwords($element->emp_name));
            $sheet->SetCellValue('C' . $rowCount, ucwords($element->father_name));
            $sheet->SetCellValue('D' . $rowCount, ucwords($element->company_name));
            $sheet->SetCellValue('E' . $rowCount, ucwords($element->department_name));
            $sheet->SetCellValue('F' . $rowCount, ucwords($element->designation_name));
            $sheet->SetCellValue('G' . $rowCount, ucwords($element->location_name));
            $sheet->SetCellValue('H' . $rowCount, $element->gender_name);
            $sheet->SetCellValue('I' . $rowCount, date('d-m-Y', strtotime($element->date_of_birth)));
            $sheet->SetCellValue('J' . $rowCount, $element->personal_contact);
            $sheet->SetCellValue('K' . $rowCount, $element->contact_other);
            $sheet->SetCellValue('L' . $rowCount, $element->contact_number);
            $sheet->SetCellValue('M' . $rowCount, $element->r_address);
            $sheet->SetCellValue('N' . $rowCount, $element->p_address);
            $sheet->SetCellValue('O' . $rowCount, $element->marital_name);
            $sheet->SetCellValue('P' . $rowCount, $element->cnic);
            $sheet->SetCellValue('Q' . $rowCount, date('d-m-Y', strtotime($element->cnic_expiry_date)));
            $sheet->SetCellValue('R' . $rowCount, date('d-m-Y', strtotime($element->date_of_joining)));
            $sheet->SetCellValue('S' . $rowCount, date('d-m-Y', strtotime($element->contract_expiry_date)));
            $sheet->SetCellValue('T' . $rowCount, ucfirst($element->country_name));
            $sheet->SetCellValue('U' . $rowCount, ucfirst($element->religion_name));
            $sheet->SetCellValue('V' . $rowCount, ucfirst($element->tribe_name));
            $sheet->SetCellValue('W' . $rowCount, ucfirst($element->ethnicity_name));
            $sheet->SetCellValue('X' . $rowCount, ucfirst($element->language_name));
            $sheet->SetCellValue('Y' . $rowCount, ucfirst($element->blood_group_name));

            if($employee_type == 'resigned')
       		{
	            $sheet->SetCellValue('Z' . $rowCount, $element->reason_text);
	            $sheet->SetCellValue('AA' . $rowCount, $element->other_reason);
	            $sheet->SetCellValue('AB' . $rowCount, $element->description);
	            $sheet->SetCellValue('AC' . $rowCount, date('d-m-Y', strtotime($element->resignation_date)));
	            $sheet->SetCellValue('AD' . $rowCount, $element->resignation_accepted_by);
	            $sheet->SetCellValue('AE' . $rowCount, date('d-m-Y', strtotime($element->accepted_date)));
        	}
        	elseif($employee_type == 'terminated')
       		{
	            $sheet->SetCellValue('Z' . $rowCount, $element->reason_text);
	            $sheet->SetCellValue('AA' . $rowCount, $element->other_reason);
	            $sheet->SetCellValue('AB' . $rowCount, $element->description);
	            $sheet->SetCellValue('AC' . $rowCount, date('d-m-Y', strtotime($element->notice_date)));
	            $sheet->SetCellValue('AD' . $rowCount, ucwords($element->termination_by));
	            $sheet->SetCellValue('AE' . $rowCount, date('d-m-Y', strtotime($element->termination_date)));
	            $sheet->SetCellValue('AF' . $rowCount, ucwords($element->termination_accepted_by));
	            $sheet->SetCellValue('AG' . $rowCount, date('d-m-Y', strtotime($element->confirmed_date)));
        	}
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       
		// download file
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="employees.xlsx"');
        $objWriter->save('php://output');      
    }

    public function createComplaintsXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $conditions = $this->sc_complaints($_SERVER['QUERY_STRING']);

        // var_dump($conditions); exit;
        $complaints = $this->Complaint_model->get_complaints($conditions)->result();

        if(count($complaints) == 0)
        	exit('No Records found');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','M') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:M1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'Complaint No');
        $sheet->SetCellValue('B1', 'Name');
        $sheet->SetCellValue('C1', 'Contact');
        $sheet->SetCellValue('D1', 'Email');
        $sheet->SetCellValue('E1', 'Subject');
        $sheet->SetCellValue('F1', 'Description');       
        $sheet->SetCellValue('G1', 'Province');       
        $sheet->SetCellValue('H1', 'District');       
        $sheet->SetCellValue('I1', 'Tehsil');       
        $sheet->SetCellValue('J1', 'UC');       
        $sheet->SetCellValue('K1', 'Filing Date');       
        $sheet->SetCellValue('L1', 'Status');       
        $sheet->SetCellValue('M1', 'Closing Remarks');       
        // set Row
        $rowCount = 2;
        foreach ($complaints as $element) {
            $sheet->SetCellValue('A' . $rowCount, $element->complaint_no);
            $sheet->SetCellValue('B' . $rowCount, $element->name);
            $sheet->SetCellValue('C' . $rowCount, $element->contact_no);
            $sheet->SetCellValue('D' . $rowCount, $element->email);
            $sheet->SetCellValue('E' . $rowCount, $element->subject);
            $sheet->SetCellValue('F' . $rowCount, $element->complaint_desc);
            $sheet->SetCellValue('G' . $rowCount, $element->province);
            $sheet->SetCellValue('H' . $rowCount, $element->district);
            $sheet->SetCellValue('I' . $rowCount, $element->tehsil);
            $sheet->SetCellValue('J' . $rowCount, $element->uc);
            $sheet->SetCellValue('K' . $rowCount, $element->created_at);
            $sheet->SetCellValue('L' . $rowCount, $element->status);
            $sheet->SetCellValue('M' . $rowCount, $element->closing_remarks);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
		// download file
       	header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="complaints.xlsx"');
        $objWriter->save('php://output');       
    }

  //   public function createInvestigationsXLS() {
		// // create file name
  //       $fileName = 'data-'.time().'.xlsx';  
		// // load excel library
  //       $this->load->library('excel');

  //       $conditions = $this->session->complaint_internal_search_conditions;
  //       $complaints = $this->Investigation_model->get_complaints_internal($conditions)->result();

  //       if(count($complaints) == 0)
  //       	exit('No Records found');

  //       $objPHPExcel = new PHPExcel();
  //       $objPHPExcel->setActiveSheetIndex(0);
  //       $sheet = $objPHPExcel->getActiveSheet();
        
  //       foreach(range('A','P') as $columnID) {
		//     $sheet->getColumnDimension($columnID)
		//         ->setAutoSize(true);
		// }  

		// $sheet->getStyle('A1:P1')->getFont()->setBold(true);
  //       // set Header
  //       $sheet->SetCellValue('A1', 'Complaint No');
  //       $sheet->SetCellValue('B1', 'Employee Name');
  //       $sheet->SetCellValue('C1', 'Project');
  //       $sheet->SetCellValue('D1', 'Department');
  //       $sheet->SetCellValue('E1', 'Designation');
  //       $sheet->SetCellValue('F1', 'Reason');       
  //       $sheet->SetCellValue('G1', 'Other Reason');       
  //       $sheet->SetCellValue('H1', 'Description');       
  //       $sheet->SetCellValue('I1', 'Evidence');       
  //       $sheet->SetCellValue('J1', 'Evidence Date');       
  //       $sheet->SetCellValue('K1', 'Reported By');       
  //       $sheet->SetCellValue('L1', 'Reported Date');       
  //       $sheet->SetCellValue('M1', 'Closing Remarks');       
  //       $sheet->SetCellValue('N1', 'Remarks By');       
  //       $sheet->SetCellValue('O1', 'Remarks At');       
  //       $sheet->SetCellValue('P1', 'Status');       
  //       // set Row
  //       $rowCount = 2;
  //       foreach ($complaints as $element) {
  //       	$evidence = ($element->evidence == '1') ? 'Yes' : 'No';
  //           $sheet->SetCellValue('A' . $rowCount, $element->complaint_no);
  //           $sheet->SetCellValue('B' . $rowCount, $element->employee_id);
  //           $sheet->SetCellValue('C' . $rowCount, $element->project_name);
  //           $sheet->SetCellValue('D' . $rowCount, $element->department_name);
  //           $sheet->SetCellValue('E' . $rowCount, $element->designation_name);
  //           $sheet->SetCellValue('F' . $rowCount, $element->reason_text);
  //           $sheet->SetCellValue('G' . $rowCount, $element->other_reason);
  //           $sheet->SetCellValue('H' . $rowCount, $element->description);
  //           $sheet->SetCellValue('I' . $rowCount, $evidence);
  //           $sheet->SetCellValue('J' . $rowCount, $element->evidence_date);
  //           $sheet->SetCellValue('K' . $rowCount, $element->reported_by);
  //           $sheet->SetCellValue('L' . $rowCount, $element->reported_date);
  //           $sheet->SetCellValue('M' . $rowCount, $element->closing_remarks);
  //           $sheet->SetCellValue('N' . $rowCount, $element->remarks_by);
  //           $sheet->SetCellValue('O' . $rowCount, $element->remarks_at);
  //           $sheet->SetCellValue('P' . $rowCount, $element->status);
  //           $rowCount++;
  //       }
  //       $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
		// // download file
  //      	header("Content-Type: application/vnd.ms-excel");
  //       header('Content-Disposition: attachment;filename="investigation.xlsx"');
  //       $objWriter->save('php://output');       
  //   }

    public function resignationsXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $conditions = $this->sc_resignation($_SERVER['QUERY_STRING']);
        $resignations = $this->Resignations_model->get_resignations($conditions);

        if(count($resignations) == 0)
        	exit('No Records found');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','H') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:H1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'ID');
        $sheet->SetCellValue('B1', 'Name');
        $sheet->SetCellValue('C1', 'Designation');
        $sheet->SetCellValue('D1', 'Reason');
        $sheet->SetCellValue('E1', 'Other Reason');
        $sheet->SetCellValue('F1', 'Subject');       
        $sheet->SetCellValue('G1', 'Description'); 
        $sheet->SetCellValue('H1', 'Resignation Date'); 


        // set Row
        $rowCount = 2;
        foreach ($resignations as $element) {
            $sheet->SetCellValue('A' . $rowCount, $element->employee_id);
            $sheet->SetCellValue('B' . $rowCount, ucwords($element->first_name . ' ' . $element->last_name));
            $sheet->SetCellValue('C' . $rowCount, $element->designation_name);
            $sheet->SetCellValue('D' . $rowCount, $element->reason_text);
            $sheet->SetCellValue('E' . $rowCount, $element->reason);
            $sheet->SetCellValue('F' . $rowCount, $element->subject);
            $sheet->SetCellValue('G' . $rowCount, $element->description);
            $sheet->SetCellValue('H' . $rowCount, $element->resignation_date);
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="resignations.xlsx"');
        $objWriter->save('php://output');        
    }

    public function terminationsXLS() {
		// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $conditions = $this->sc_termination($_SERVER['QUERY_STRING']);
        $terminations = $this->Terminations_model->get_terminations($conditions)->result();

        if(count($terminations) == 0)
        	exit('No Records found');
        // var_dump($terminations); exit;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','H') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:H1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'ID');
        $sheet->SetCellValue('B1', 'Name');
        $sheet->SetCellValue('C1', 'Designation');
        $sheet->SetCellValue('D1', 'Reason');
        $sheet->SetCellValue('E1', 'Other Reason');   
        $sheet->SetCellValue('F1', 'Description'); 
        $sheet->SetCellValue('G1', 'Termination Date'); 
        $sheet->SetCellValue('H1', 'Terminated by'); 


        // set Row
        $rowCount = 2;
        foreach ($terminations as $element) {
            $sheet->SetCellValue('A' . $rowCount, $element->user_id);
            $sheet->SetCellValue('B' . $rowCount, ucwords($element->employee_name));
            $sheet->SetCellValue('C' . $rowCount, $element->designation_name);
            $sheet->SetCellValue('D' . $rowCount, $element->reason_text);
            $sheet->SetCellValue('E' . $rowCount, $element->other_reason);
            $sheet->SetCellValue('F' . $rowCount, $element->description);
            $sheet->SetCellValue('G' . $rowCount, $element->termination_date);
            $sheet->SetCellValue('H' . $rowCount, $element->terminator);
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="terminations.xlsx"');
        $objWriter->save('php://output');      
    }

    public function trainingsXLS() {
    	// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $conditions = $this->sc_training($_SERVER['QUERY_STRING']);
        $trainings = $this->Reports_model->get_trainings($conditions)->result();

        if(count($trainings) == 0)
        	exit('No Records found');
        // var_dump($terminations); exit;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','I') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:I1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'Project');
        $sheet->SetCellValue('B1', 'Training Type');
        $sheet->SetCellValue('C1', 'Target Group');
        $sheet->SetCellValue('D1', 'Province');
        $sheet->SetCellValue('E1', 'Facilitator');   
        $sheet->SetCellValue('F1', 'Session'); 
        $sheet->SetCellValue('G1', 'Start Date'); 
        $sheet->SetCellValue('H1', 'End Date'); 
        $sheet->SetCellValue('I1', 'Format'); 


        // set Row
        $rowCount = 2;
        foreach ($trainings as $element) {
            $sheet->SetCellValue('A' . $rowCount, ucwords($element->company));
            $sheet->SetCellValue('B' . $rowCount, $element->training_type);
            $sheet->SetCellValue('C' . $rowCount, $element->target_group);
            $sheet->SetCellValue('D' . $rowCount, strtoupper($element->province_name));
            $sheet->SetCellValue('E' . $rowCount, ucwords($element->facilitator_name));
            $sheet->SetCellValue('F' . $rowCount, $element->session);
            $sheet->SetCellValue('G' . $rowCount, date('d-m-Y', strtotime($element->start_date)));
            $sheet->SetCellValue('H' . $rowCount, date('d-m-Y', strtotime($element->end_date)));
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="trainings.xlsx"');
        $objWriter->save('php://output'); 
    }

    public function testsXLS() {
    	// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $date_from = $this->input->get('date_from');
		$date_to = $this->input->get('date_to');
		$job_id = $this->input->get('job_id');
		$project = $this->input->get('project');
		$designation = $this->input->get('designation');
		$rollno = $this->input->get('rollno');
		$applicant_name = $this->input->get('applicant_name');

		$tests = $this->Reports_model->applicants_report($date_from, $date_to, $job_id, $project, $designation, $rollno, $applicant_name)->result();

		if(count($tests) == 0)
        	exit('No Records found');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','M') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:M1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'Applicant ID');
        $sheet->SetCellValue('B1', 'Name');
        $sheet->SetCellValue('C1', 'Gender');
        $sheet->SetCellValue('D1', 'Email');
        $sheet->SetCellValue('E1', 'Age');   
        $sheet->SetCellValue('F1', 'City'); 
        $sheet->SetCellValue('G1', 'Province'); 
        $sheet->SetCellValue('H1', 'Company'); 
        $sheet->SetCellValue('I1', 'Designation'); 
        $sheet->SetCellValue('J1', 'Education'); 
        $sheet->SetCellValue('K1', 'Total Marks'); 
        $sheet->SetCellValue('L1', 'Obtain Marks'); 
        $sheet->SetCellValue('M1', 'Exam Date'); 


        // set Row
        $rowCount = 2;
        foreach ($tests as $element) {
        
            $sheet->SetCellValue('A' . $rowCount, ucwords($element->application_id));
            $sheet->SetCellValue('B' . $rowCount, ucwords($element->fullname));
            $sheet->SetCellValue('C' . $rowCount, $element->applicant_gender);
            $sheet->SetCellValue('D' . $rowCount, strtoupper($element->email));
            $sheet->SetCellValue('E' . $rowCount, ucwords($element->age));
            $sheet->SetCellValue('F' . $rowCount, $element->city_name);
            $sheet->SetCellValue('G' . $rowCount, ucwords($element->province_name));
            $sheet->SetCellValue('H' . $rowCount, $element->compName);
            $sheet->SetCellValue('I' . $rowCount, $element->job_title);
            $sheet->SetCellValue('J' . $rowCount, $element->applicant_education);
            $sheet->SetCellValue('K' . $rowCount, $element->total_marks);
            $sheet->SetCellValue('L' . $rowCount, $element->obtain_marks);
            $sheet->SetCellValue('M' . $rowCount, date('d-m-Y', strtotime($element->exam_date)));
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="tests.xlsx"');
        $objWriter->save('php://output'); 
    }

    public function eventsXLS() {
    	// create file name
        $fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $conditions = $this->sc_events($_SERVER['QUERY_STRING']);
        $events = $this->Reports_model->get_events($conditions)->result();

        if(count($events) == 0)
        	exit('No Records found');
        // var_dump($terminations); exit;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','H') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:H1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'Event Title');
        $sheet->SetCellValue('B1', 'Training Type');
        $sheet->SetCellValue('C1', 'Project');
        $sheet->SetCellValue('D1', 'Designation');
        $sheet->SetCellValue('E1', 'Province');   
        $sheet->SetCellValue('F1', 'District'); 
        $sheet->SetCellValue('G1', 'Start Date'); 
        $sheet->SetCellValue('H1', 'End Date'); 


        // set Row
        $rowCount = 2;
        foreach ($events as $element) {
            $sheet->SetCellValue('A' . $rowCount, ucwords($element->title));
            $sheet->SetCellValue('B' . $rowCount, $element->training_type);
            $sheet->SetCellValue('C' . $rowCount, ucwords($element->project_name));
            $sheet->SetCellValue('D' . $rowCount, strtoupper($element->designation_name));
            $sheet->SetCellValue('E' . $rowCount, ucwords($element->province));
            $sheet->SetCellValue('F' . $rowCount, ucwords($element->district));
            $sheet->SetCellValue('G' . $rowCount, date('d-m-Y', strtotime($element->start_date)));
            $sheet->SetCellValue('H' . $rowCount, date('d-m-Y', strtotime($element->end_date)));
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        // Download file
		header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="events.xlsx"');
        $objWriter->save('php://output'); 
    }

    public function activityXLS()
    {
    	$conditions = $this->sc_activity($_SERVER['QUERY_STRING']);
    	$training_detail = $this->Reports_model->get_activity_detail($conditions)->result_array();

    	if(count($training_detail) == 0)
        	exit('No Records found');

		for($i=0; $i<count($training_detail); $i++)
		{		
			$employees_detail[$i] = array();
			$participants = explode(',', $training_detail[$i]['trainee_employees']);
			
			for($j=0; $j<count($participants); $j++)
			{

				$emp = $this->Reports_model->get_designation_gender($participants[$j])->row_array();	
				array_push($employees_detail[$i], $emp);
			}


			$training[$i] = array();
			$training[$i]['detail'] = $training_detail[$i];

			$maleParticipants = 0;
			$femaleParticipants = 0; 
			$totalParticipants = 0;

			$currentDesignation = 0;
			$designations = array();
	
			rsort($employees_detail[$i]);
			for($x=0; $x<count($employees_detail[$i]); $x++)
			{

				if($employees_detail[$i][$x]['designation_id'] != $currentDesignation)
				{
					array_push($designations, $employees_detail[$i][$x]['designation_name']);
				}

				if($employees_detail[$i][$x]['gender'] == 'Male')
				{
					$maleParticipants += 1;
				}
				elseif($employees_detail[$i][$x]['gender'] == 'Female')
				{
					$femaleParticipants += 1;
				}

				$currentDesignation = $employees_detail[$i][$x]['designation_id'];
			}

			$training[$i]['male_participants'] = $maleParticipants;
			$training[$i]['female_participants'] = $femaleParticipants;
			$training[$i]['designations'] = $designations;
		}

    	$fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        // var_dump($terminations); exit;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','J') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  
        $rowCount = 3;

        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'District');
        $sheet->SetCellValue('B1', 'Town/UC');
        $sheet->SetCellValue('C1', 'Cadre');
        $sheet->SetCellValue('D1', 'Training Type');
        $sheet->SetCellValue('E1', 'Plan (No. of Participants)');  
        $sheet->mergeCells("F1:H1"); 
        $sheet->SetCellValue('F1', 'Accomplishment (No. Of Participants)'); 
        $sheet->SetCellValue('F2', 'Male'); 
        $sheet->SetCellValue('G2', 'Female'); 
        $sheet->SetCellValue('H2', 'Total'); 
        $sheet->SetCellValue('I1', 'Training Date'); 
        $sheet->SetCellValue('J1', 'Remarks'); 
        


        // set Row
        
        for($index=0; $index<count($training); $index++) {
            $sheet->SetCellValue('A' . $rowCount, ucwords($training[$index]['detail']['district']));

            $designations = '';
			for($i=0; $i<count($training[$index]['designations']); $i++) {
				$designations .= $training[$index]['designations'][$i] . ', '; 
			 	
			}
			

			$total_participants = $training[$index]['male_participants'] + $training[$index]['female_participants'];

            $sheet->SetCellValue('B' . $rowCount, '');
            $sheet->SetCellValue('C' . $rowCount, rtrim($designations, ', '));
            $sheet->SetCellValue('D' . $rowCount, $training[$index]['detail']['training_type']);
            $sheet->SetCellValue('E' . $rowCount, $training[$index]['detail']['plan_no_of_participants']);
            $sheet->SetCellValue('F' . $rowCount, $training[$index]['male_participants']);
            $sheet->SetCellValue('G' . $rowCount, $training[$index]['female_participants']);
            $sheet->SetCellValue('H' . $rowCount, $total_participants);
            $sheet->SetCellValue('I' . $rowCount, $training[$index]['detail']['start_date']);
            $sheet->SetCellValue('J' . $rowCount, '');
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="activity.xlsx"');
        header("Content-Type: application/download");
        $objWriter->save('php://output'); 
    }


	public function cbv_training_calendar($project, $year, $partYear)
	{
		if($project == "" OR $year == "" OR $partYear == "")
			redirect('Reports/training_calendar');

		$startDate = $year.'-01';
		$endDate = $year.'-06';
		$calender_months = 'jan-jun';

		if($partYear == 'second')
		{
			$startDate = $year.'-07';
			$endDate = $year.'-12';
			$calender_months = 'jul-dec';
		}


		$this->db->like('LOWER(`type`)', 'induction');
		$induction_row = $this->db->get_where('xin_training_types')->row();
		$induction_id = $induction_row->training_type_id;

		$this->db->like('LOWER(`type`)', 'refresher');
		$refresher_row = $this->db->get_where('xin_training_types')->row();
		$refresher_id = $refresher_row->training_type_id;

		$conditions = "(trg_type = '$induction_id' OR trg_type = '$refresher_id') AND DATE_FORMAT(start_date, '%Y') = '$year'";

		$this->db->where($conditions);
		$calender = $this->db->get('events_calendar')->result();

		if(empty($calender))
			exit('No Records found.');


		$fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        // var_dump($terminations); exit;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        $rowCount = 3;
        // set Header

        $sheet->getStyle('A2:AJ2')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'A7CEEB')
		        )
		    )
		);

		$sheet->getStyle('A3:E3')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'D6E7FF')
		        )
		    )
		);

		$sheet->getStyle('A4:E4')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'D6E7FF')
		        )
		    )
		);

		$sheet->getStyle('F3:T3')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'F9FF3D')
		        )
		    )
		);

		$sheet->getStyle('U3:AI3')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'EBD1B0')
		        )
		    )
		);

		$sheet->getStyle('AJ3')->applyFromArray(
		    array(
		        'fill' => array(
		            'type' => PHPExcel_Style_Fill::FILL_SOLID,
		            'color' => array('rgb' => 'F7EBC6')
		        )
		    )
		);

		
		$trainingTypeRowColor = array(
	        'fill' => array(
	            'type' => PHPExcel_Style_Fill::FILL_SOLID,
	            'color' => array('rgb' => 'FF96A1')
	        )
	    );

		$sheet->getStyle('A5:AJ5')->applyFromArray($trainingTypeRowColor);

		$borderStyle = array(
			'borders' => array(
			'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('rgb' => '000000'),
					),
				),
		);

		$sheet->getStyle('A3:AJ3')->applyFromArray($borderStyle);
		$sheet->getStyle('A4:E4')->applyFromArray($borderStyle);

		$sheet->getStyle('A5:AJ5')->applyFromArray($borderStyle);

        
        $sheet->mergeCells("A1:AJ1"); 
        $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

    	$sheet->getStyle("A1:AJ1")->applyFromArray($style);


       	/* Note: Do it programatically later */

    	/* Cell Width */
    	$sheet->getColumnDimension('A')->setWidth(14);
    	$sheet->getColumnDimension('D')->setWidth(16);
    	$sheet->getColumnDimension('E')->setWidth(16);

    	/* Set width of weeks cols */
    	$weeksCols = range('F', 'Z');
    	array_push($weeksCols, 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI');
    	$weekCounter = 1;

    	for($i=0; $i<count($weeksCols); $i++)
    	{
    		// echo $weeksCols[$i];
    		// echo '<br>';
    		$sheet->getColumnDimension($weeksCols[$i])->setWidth(4);
    		$sheet->SetCellValue($weeksCols[$i].'4', 'W'.$weekCounter);

    		if($weekCounter == 5)
    			$weekCounter = 0;

    		$weekCounter++;
    	}

    	// exit;


    	/* Font Size */
        $sheet->getStyle("A1:AJ1")->getFont()->setSize(16);
        $sheet->getStyle("A3:AJ3")->getFont()->setSize(12);

        $sheet->getStyle('A1:AJ1')->getFont()->setBold(true);

        /* ./Font Size */

        /* Text/FontWrap */
        $sheet->getStyle('A3:AJ3')->getAlignment()->setWrapText(true); 

        /* ./ Text/FontWrap */

        /* Text Alignment */
        $sheet->getStyle('A3:AJ3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A3:AJ3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP); 

        $sheet->getStyle('A4:AJ4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 

        /* ./ Text Alignment */

        /* Row Height */

        $sheet->getRowDimension('1')->setRowHeight(40);
        $sheet->getRowDimension('3')->setRowHeight(60);
        $sheet->getRowDimension('4')->setRowHeight(40);

        /* ./ Row Height */

        /* Merge Rows */


        /* Merge Rows */

        $sheet->SetCellValue('A1', 'TD-KP CBV Tentative Training Calender Jan-Jun '.$year);

        $sheet->mergeCells("A2:AJ2");


        $sheet->SetCellValue('A3', '');
        $sheet->SetCellValue('B3', 'Cadre');
        $sheet->SetCellValue('C3', 'Total');
        $sheet->SetCellValue('D3', 'No. Of Expected Events Jan-Jun '.$year);
        $sheet->SetCellValue('E3', 'Total Events Jan-Jun '.$year);


        $sheet->getStyle("F3:AJ3")->getFont()->setSize(12);
        $sheet->getStyle('F1:AJ3')->getFont()->setBold(true);
        $sheet->mergeCells("F3:J3");
        
        if($partYear == 'first')
        {
        	$sheet->SetCellValue('F3', 'January');
	        $sheet->mergeCells("K3:O3");
	        $sheet->SetCellValue('K3', 'Febuary');
	        $sheet->mergeCells("P3:T3");
	        $sheet->SetCellValue('P3', 'March');
	        $sheet->mergeCells("U3:Y3");
	        $sheet->SetCellValue('U3', 'April');
	        $sheet->mergeCells("Z3:AD3");
	        $sheet->SetCellValue('Z3', 'May');
	        $sheet->mergeCells("AE3:AI3");
	        $sheet->SetCellValue('AE3', 'June');
        }
        elseif($partYear == 'second')
        {
        	$sheet->SetCellValue('F3', 'July');
	        $sheet->mergeCells("K3:O3");
	        $sheet->SetCellValue('K3', 'August');
	        $sheet->mergeCells("P3:T3");
	        $sheet->SetCellValue('P3', 'September');
	        $sheet->mergeCells("U3:Y3");
	        $sheet->SetCellValue('U3', 'October');
	        $sheet->mergeCells("Z3:AD3");
	        $sheet->SetCellValue('Z3', 'November');
	        $sheet->mergeCells("AE3:AI3");
	        $sheet->SetCellValue('AE3', 'December');
        }
        

        $sheet->SetCellValue('AJ3', 'Total');


         /* Fourth Row, Week Cells */
        $alphabets = range('F', 'Z');
        array_push($alphabets, 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI');

        for($i=0; $i<count($alphabets); $i++)
        {
        	$alpha = $alphabets[$i];

        	$sheet->SetCellValue($alpha.'6', '');
	        $sheet->SetCellValue($alpha.'7', '');
	        $sheet->SetCellValue($alpha.'8', '');
	        $sheet->SetCellValue($alpha.'9', '');
	        $sheet->SetCellValue($alpha.'10', '');
        }


        /* Fifth Row */
        $sheet->getStyle("A5:AJ5")->getFont()->setSize(12);
        $sheet->getStyle('A5:AJ5')->getFont()->setBold(true);
        $sheet->mergeCells("A5:AJ5");
        $sheet->SetCellValue('A5', 'Induction Training Events');




        #start of induction

        $startWeek = array(
			        '01-01', '01-07', '01-14',  '01-21', '01-28',
			        '02-01', '02-07', '02-14',  '02-21', '02-28',
			        '03-01', '03-07', '03-14',  '03-21', '03-28',
			        '04-01', '04-07', '04-14',  '04-21', '04-28',
			        '05-01', '05-07', '05-14',  '05-21', '05-28',
			        '06-01', '06-07', '06-14',  '06-21', '06-28'
					);

        $endWeek = array(
			        '01-07', '01-14', '01-21',  '01-28', '01-31',
			        '02-07', '02-14', '02-21',  '02-28', '02-29',
			        '03-07', '03-14', '03-21',  '03-28', '03-31',
			        '04-07', '04-14', '04-21',  '04-28', '04-30',
			        '05-07', '05-14', '05-21',  '05-28', '05-31',
			        '06-07', '06-14', '06-21',  '06-28', '06-30'
					);

        if($partYear == 'second')
        {
        	$startWeek = array(
			        '07-01', '07-07', '07-14',  '07-21', '07-28',
			        '08-01', '08-07', '08-14',  '08-21', '08-28',
			        '09-01', '09-07', '09-14',  '09-21', '09-28',
			        '10-01', '10-07', '10-14',  '10-21', '10-28',
			        '11-01', '11-07', '11-14',  '11-21', '11-28',
			        '12-01', '12-07', '12-14',  '12-21', '12-28'
					);

	        $endWeek = array(
				        '07-07', '07-14', '07-21',  '07-28', '07-31',
				        '08-07', '08-14', '08-21',  '08-28', '08-31',
				        '09-07', '09-14', '09-21',  '09-28', '09-30',
				        '10-07', '10-14', '10-21',  '10-28', '10-31',
				        '11-07', '11-14', '11-21',  '11-28', '11-30',
				        '12-07', '12-14', '12-21',  '12-28', '12-31'
						);
        }


        $this->db->select('d.id, d.name AS district_name');
        $this->db->join('district d', 'ec.district = d.id', 'left');
        $this->db->group_by('d.id');
        $this->db->where(array('ec.project' => $project, 'ec.trg_type' => $induction_id, 'DATE_FORMAT(start_date, "%Y-%m") >=' => $startDate, 'DATE_FORMAT(start_date, "%Y-%m") <=' => $endDate));
        $districts = $this->db->get('events_calendar ec')->result_array();


        for($i=0; $i<count($districts); $i++)
        {
        	$this->db->select('xd.designation_id, xd.designation_name');
	        $this->db->join('xin_designations xd', 'ec.designation = xd.designation_id', 'left');
	        // $this->db->group_by('ec.designations');
	        $this->db->where(array('ec.district' => $districts[$i]['id'], 'ec.project' => $project, 'ec.trg_type' => $induction_id, 'DATE_FORMAT(start_date, "%Y-%m") >=' => $startDate, 'DATE_FORMAT(start_date, "%Y-%m") <=' => $endDate));
	        $this->db->group_by('ec.designation');
	        $designations = $this->db->get('events_calendar ec')->result_array();

	        $districts[$i]['designations'] = $designations;


	        for($j=0; $j<count($designations); $j++)
	        {
	        	$this->db->where(array('district' => $districts[$i]['id'], 'designation' => $designations[$j]['designation_id'], 'project' => $project, 'trg_type' => $induction_id, 'DATE_FORMAT(start_date, "%Y-%m") >=' => $startDate, 'DATE_FORMAT(start_date, "%Y-%m") <=' => $endDate));
	        	$no_of_events = $this->db->get('events_calendar')->num_rows();
	        	$districts[$i]['designations'][$j]['no_events'] = $no_of_events;
	        }
	        
	        
        }


        $rowCount = 6;
        for ($i=0; $i<count($districts); $i++) {

        	$designationsCount = count($districts[$i]['designations']);
        	

        	if($designationsCount > 1)
        	{
        		$uptoRow = $rowCount + count($districts[$i]['designations']) -1;
        		$sheet->mergeCells('A'.$rowCount.':A'.$uptoRow);
		        $sheet->getStyle('A'.$rowCount.':A'.$uptoRow)->getFont()->setSize(12);
		        $sheet->getStyle('A'.$rowCount.':A'.$uptoRow)->getFont()->setBold(true);
		        $sheet->getStyle('A'.$rowCount.':A'.$uptoRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        	}
        	else
        	{
        		$sheet->getStyle('A'.$rowCount)->getFont()->setSize(12);
		        $sheet->getStyle('A'.$rowCount)->getFont()->setBold(true);
        	}
            

	        $sheet->SetCellValue('A'.$rowCount, ucwords($districts[$i]['district_name']));
            
            /* Populate Designations 'B' */
            $dsgIndex=$rowCount;
            for($j=0; $j<$designationsCount; $j++)
            {
            	$sheet->SetCellValue('B'.$dsgIndex, ucwords($districts[$i]['designations'][$j]['designation_name']));

            		$total_events = 0;
            	  	for($w_index=0; $w_index<count($alphabets); $w_index++)
			        {
			        	$alpha = $alphabets[$w_index];
			        	$start_date = $year.'-'.$startWeek[$w_index];
			        	$end_date = $year.'-'.$endWeek[$w_index];
			        	
			        	$this->db->where(array('district' => $districts[$i]['id'], 'designation' => $districts[$i]['designations'][$j]['designation_id'], 'project' => $project, 'trg_type' => $induction_id, 'start_date >=' => "$start_date", 'end_date <=' => "$end_date"));
	        			$eventsCount = $this->db->get('events_calendar')->num_rows();

	        			$total_events += $eventsCount;
	        			$eventsCount = ($eventsCount == 0) ? '' : $eventsCount;
			        	// echo $this->db->last_query();
			        	$sheet->SetCellValue($alpha.$dsgIndex, $eventsCount);
			        }

			    $sheet->getStyle('AJ'.$dsgIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			    $sheet->SetCellValue('AJ'.$dsgIndex, $total_events);
            	$dsgIndex++;
            }

            /* Populate No. of expected events 'D' */
            $ee=$rowCount;
            for($d=0; $d<$designationsCount; $d++)
            {
            	 $sheet->SetCellValue('D'.$ee, ucwords($districts[$i]['designations'][$d]['no_events']));
            	 $ee++;
            }

            /* Populate No. of expected events 'E' */
            $te=$rowCount;
            for($e=0; $e<$designationsCount; $e++)
            {
            	 $sheet->SetCellValue('E'.$te, ucwords($districts[$i]['designations'][$e]['no_events']));
            	 $te++;
            }


            /* Populate weeks */

            if($designationsCount > 1)
        	{
            	$rowCount = $rowCount + count($districts[$i]['designations']);
            } 
            else 
            {
            	$rowCount++;
            }
        }


        $sumColumns = range('D', 'Z');
        array_push($sumColumns, 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ');

        $startRow = 6;
        $endRow = $rowCount -1;
        $nextRow = $rowCount;

        for($columnIndex=0; $columnIndex<count($sumColumns); $columnIndex++)
        {

        	$sheet->SetCellValue($sumColumns[$columnIndex].$nextRow, '=SUM('.$sumColumns[$columnIndex].$startRow.':'.$sumColumns[$columnIndex].$endRow.')');


        }
        
        $sheet->mergeCells('A'.$nextRow.':B'.$nextRow); 
        $sheet->getStyle('A'.$nextRow.':B'.$nextRow)->getFont()->setSize(12);
        $sheet->getStyle('A'.$nextRow.':B'.$nextRow)->getFont()->setBold(true);
        
        $sheet->SetCellValue('A'.$nextRow, 'G.Total Induction');
        // $sheet->getStyle('A'.$nextRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

        $sheet->getStyle('AJ'.$nextRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

        #end of induction


        #start of refresher

        /* Fifth Row */

        $refresherHeading = $rowCount + 1;

        $sheet->getStyle("A".$refresherHeading.":AJ".$refresherHeading)->getFont()->setSize(12);
        $sheet->getStyle("A".$refresherHeading.":AJ".$refresherHeading)->getFont()->setBold(true);
        $sheet->mergeCells("A".$refresherHeading.":AJ".$refresherHeading);
        $sheet->SetCellValue("A".$refresherHeading, 'Refresher Training Events');
        $sheet->getStyle('A'.$refresherHeading.':AJ'.$refresherHeading)->applyFromArray($trainingTypeRowColor);
        $sheet->getStyle('A'.$refresherHeading.':AJ'.$refresherHeading)->applyFromArray($borderStyle);

        // $project = 4;
        // $trg_type = 2; 

        // $year = 2019;

        $startRowSumation = $refresherHeading+1;


        $this->db->select('d.id, d.name AS district_name');
        $this->db->join('district d', 'ec.district = d.id', 'left');
        $this->db->group_by('d.id');
        $this->db->where(array('ec.project' => $project, 'ec.trg_type' => $refresher_id, 'DATE_FORMAT(start_date, "%Y-%m") >=' => $startDate, 'DATE_FORMAT(start_date, "%Y-%m") <=' => $endDate));
        $districts = $this->db->get('events_calendar ec')->result_array();
        // echo $this->db->last_query(); exit;
        for($i=0; $i<count($districts); $i++)
        {
        	$this->db->select('xd.designation_id, xd.designation_name');
	        $this->db->join('xin_designations xd', 'ec.designation = xd.designation_id', 'left');
	        // $this->db->group_by('ec.designations');
	        $this->db->where(array('ec.district' => $districts[$i]['id'], 'ec.project' => $project, 'ec.trg_type' => $refresher_id, 'DATE_FORMAT(start_date, "%Y-%m") >=' => $startDate, 'DATE_FORMAT(start_date, "%Y-%m") <=' => $endDate));
	        $this->db->group_by('ec.designation');
	        $designations = $this->db->get('events_calendar ec')->result_array();

	        $districts[$i]['designations'] = $designations;


	        for($j=0; $j<count($designations); $j++)
	        {
	        	$this->db->where(array('district' => $districts[$i]['id'], 'designation' => $designations[$j]['designation_id'], 'project' => $project, 'trg_type' => $refresher_id, 'DATE_FORMAT(start_date, "%Y-%m") >=' => $startDate, 'DATE_FORMAT(start_date, "%Y-%m") <=' => $endDate));
	        	$no_of_events = $this->db->get('events_calendar')->num_rows();
	        	$districts[$i]['designations'][$j]['no_events'] = $no_of_events;
	        }
	        
	        
        }

 
        $rowCount = $startRowSumation;
        for ($i=0; $i<count($districts); $i++) {

        	$designationsCount = count($districts[$i]['designations']);
        	

        	if($designationsCount > 1)
        	{
        		$uptoRow = $rowCount + count($districts[$i]['designations']) -1;
        		$sheet->mergeCells('A'.$rowCount.':A'.$uptoRow);
		        $sheet->getStyle('A'.$rowCount.':A'.$uptoRow)->getFont()->setSize(12);
		        $sheet->getStyle('A'.$rowCount.':A'.$uptoRow)->getFont()->setBold(true);
		        $sheet->getStyle('A'.$rowCount.':A'.$uptoRow)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
        	}
        	else
        	{
        		$sheet->getStyle('A'.$rowCount)->getFont()->setSize(12);
		        $sheet->getStyle('A'.$rowCount)->getFont()->setBold(true);
        	}
            

	        $sheet->SetCellValue('A'.$rowCount, ucwords($districts[$i]['district_name']));
            
            /* Populate Designations 'B' */
            $dsgIndex=$rowCount;
            for($j=0; $j<$designationsCount; $j++)
            {
            	$sheet->SetCellValue('B'.$dsgIndex, ucwords($districts[$i]['designations'][$j]['designation_name']));

            		$total_events = 0;
            	  	for($w_index=0; $w_index<count($alphabets); $w_index++)
			        {
			        	$alpha = $alphabets[$w_index];
			        	$start_date = $year.'-'.$startWeek[$w_index];
			        	$end_date = $year.'-'.$endWeek[$w_index];
			        	
			        	$this->db->where(array('district' => $districts[$i]['id'], 'designation' => $districts[$i]['designations'][$j]['designation_id'], 'project' => $project, 'trg_type' => $refresher_id, 'start_date >=' => "$start_date", 'end_date <=' => "$end_date"));
	        			$eventsCount = $this->db->get('events_calendar')->num_rows();

	        			$total_events += $eventsCount;
	        			$eventsCount = ($eventsCount == 0) ? '' : $eventsCount;
			        	// echo $this->db->last_query();
			        	$sheet->SetCellValue($alpha.$dsgIndex, $eventsCount);
			        }

			    $sheet->getStyle('AJ'.$dsgIndex)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
			    $sheet->SetCellValue('AJ'.$dsgIndex, $total_events);
            	$dsgIndex++;
            }

            /* Populate No. of expected events 'D' */
            $ee=$rowCount;
            for($d=0; $d<$designationsCount; $d++)
            {
            	 $sheet->SetCellValue('D'.$ee, ucwords($districts[$i]['designations'][$d]['no_events']));
            	 $ee++;
            }

            /* Populate No. of expected events 'E' */
            $te=$rowCount;
            for($e=0; $e<$designationsCount; $e++)
            {
            	 $sheet->SetCellValue('E'.$te, ucwords($districts[$i]['designations'][$e]['no_events']));
            	 $te++;
            }


            /* Populate weeks */
            // $wc = $rowCount;
            // for()

            if($designationsCount > 1)
        	{
            	$rowCount = $rowCount + count($districts[$i]['designations']);
            } 
            else 
            {
            	$rowCount++;
            }
        }

        $sumColumns = range('D', 'Z');
        array_push($sumColumns, 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ');

        $startRow = $startRowSumation;
        $endRow = $rowCount -1;
        $nextRow = $rowCount;

        for($columnIndex=0; $columnIndex<count($sumColumns); $columnIndex++)
        {
        	$sheet->SetCellValue($sumColumns[$columnIndex].$nextRow, '=SUM('.$sumColumns[$columnIndex].$startRow.':'.$sumColumns[$columnIndex].$endRow.')');


        }

        $sheet->mergeCells('A'.$nextRow.':B'.$nextRow); 
        $sheet->getStyle('A'.$nextRow.':B'.$nextRow)->getFont()->setSize(12);
        $sheet->getStyle('A'.$nextRow.':B'.$nextRow)->getFont()->setBold(true);

        $sheet->SetCellValue('A'.$nextRow, 'G.Total Refresher');
        // $sheet->getStyle('A'.$nextRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

        $sheet->getStyle('AJ'.$nextRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

        #end of refresher


       
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		// download file
        header("Content-Type: application/vnd.ms-excel");
        // redirect($fileName); 
        header('Content-Disposition: attachment;filename="cbv_training_calendar('.$calender_months.').xlsx"');
        $objWriter->save('php://output');
	}


    /* PDF Reports */

    function employee_detail_pdf($employee_id=FALSE)
	{
		if($employee_id === FALSE)
			show_404();
		
		$detail = $this->Reports_model->get_employee_detail($employee_id);
		if(empty($detail))
		{
			show_404();
		}

		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Employee Detail');
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);

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

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
		$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">
			<br>
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		$title = '<div></div><h3 style="font-family: helvetica;">Employee Detail</h3>';
		$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
		$employee_detail = '<table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Employee Name</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->first_name .' '. $detail->last_name).'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Father Name</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->father_name).'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Contact No</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->contact_number.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Personal Contact</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->personal_contact.'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Other Contact</td>
				<td style="width: 82%; font-family: helvetica;">'.$detail->other_contact.'</td>
			</tr>
			
			<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Gender</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->gender_name.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">DOB</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->date_of_birth)).'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">CNIC</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->cnic.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">CNIC Expiry</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->cnic_expiry_date)).'</td>
				</tr>

				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Marital Status</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->marital_name.'</td>
				</tr>
			</tbody>
			</table>';

			$employee_detail .= '<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
			<tbody>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Nationality</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->country_name.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Religion</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->religion_name.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Tribe</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->tribe_name.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Ethnicity</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->ethnicity_name.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Language</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->language_name.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Blood Group</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->blood_group_name.'</td>
				</tr>
			</tbody>
			</table>';

			$employee_detail .= '<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
			<tbody>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Project Name</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->company_name.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Location</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->location_name.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Designation</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->designation_name.'</td>
				</tr>
			</tbody>
			</table>';

			$employee_detail .= '<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
			<tbody>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Current Address</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->r_address.'</td>
				</tr>	
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Province</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->r_province.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">District</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->r_district.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Tehsil</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->r_tehsil.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">UC</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->r_uc.'</td>
				</tr>
			</tbody>
			</table>';

			$employee_detail .= '<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
			<tbody>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Permanent Address</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->p_address.'</td>
				</tr>	
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Province</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->p_province.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">District</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->p_district.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Tehsil</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->p_tehsil.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">UC</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->p_uc.'</td>
				</tr>
			</tbody>
			</table>';

			$employee_detail .= '<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
			<tbody>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Contract Type</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->contract_type.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Date of Joining</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->date_of_joining)).'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Contract Expiry</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->contract_expiry_date)).'</td>
					
				</tr>

		</tbody>
		</table>';




		
			$pdf->WriteHTMLCell(0, 0, '', '', $employee_detail, 0, 1, 0, true, '', true);


			// $pdf->WriteHTML($remarks, true, false, false, false, '');
			// move pointer to last page
			$pdf->lastPage();

			// ---------------------------------------------------------

			ob_clean();
			//Close and output PDF document
			$pdf->Output('report.pdf', 'I');
	}

	function employee_cards_pdf()
	{

		$employees = $this->Reports_model->get_employees($this->session->emp_search_conditions, $this->session->emp_search_type)->result();
		// echo $this->db->last_query();
		// var_dump($employees); exit;
		if(empty($employees))
		{
			show_404();
		}


		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Training Detail');
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);

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
		

		$emp_cards = '<table class="table" style="width:872px;height:100%; margin-bottom: 0px;">
								<tbody>';
	
					foreach($employees AS $e) {
						$emp_cards .= '<tr>
							<td id="tdColumn1" style="width:50%;vertical-align: top; padding: 20px;" class="no-padding-print no-border">
									<div class="card-container" id="dvColumn_1_9595">
										<img src="'.base_url().'assets/img/card-front.png" style="width: 380px;height: 240px;">

									<div class="card-emp-picture">
										<img src="'.base_url().'assets/img/no-photo.png" style="position: relative;width: 73px;height: 86px;left: 5px;bottom: 15px;">
									</div>
									<div class="card-emp-name">'.ucwords($e->emp_name).'</div>
									<div class="card-province-logo"><img src="'.base_url().'assets/img/FATA_logo.png" style="position: relative; width: 57px;height: 67px;"></div>
				                    <div class="card-district-heading">District :</div>
				                    <div class="card-tehsil-uc-area-heading">UC/Area :</div>
									<div class="card-district">KP-TD</div>
									<div class="card-uc"></div>
									<div class="card-job-type">'. ucwords($e->designation_name) .'</div>
									<div class="card-emp-id">1280010011978</div>
									<div class="card-sign-authority">( Regional Manager )</div>
									<div class="card-authority-signature"><img src="'.base_url().'assets/img/fatasign.png" style="position: relative; width: 60px;height: 43px; right: 80px;"></div>
								</div>
							</td>
							<td id="tdColumn2" style="width:50%;vertical-align: top; padding: 20px;" class=" no-border">
								<div class="card-container" id="dvColumn_2_9595">
									<img src="'.base_url().'assets/img/card-rear.png" style="width: 380px;height: 240px;">
									<div class="card-cnic">2170267962677</div>
									<div class="card-other-id-name"></div>
									<div class="card-date-of-birth">26-11-1979</div>
									<div class="card-emergency">0345-8566491</div>
									<div class="card-issue-date">Jan,2019</div>
				                    <div class="temporary-card-issue-date"></div>
				                    <div class="card-expiry-date"></div>
									<div class="card-lost-location">Any District Polio control room of KP-TD</div>
								</div>
							</td>
						</tr>';
							
					}
					
					$emp_cards .= '</tbody>
				</table>';




		
			$pdf->WriteHTMLCell(0, 0, '', '', $emp_cards, 0, 1, 0, true, '', true);


			// $pdf->WriteHTML($remarks, true, false, false, false, '');
			// move pointer to last page
			$pdf->lastPage();

			// ---------------------------------------------------------

			ob_clean();
			//Close and output PDF document
			$pdf->Output('report.pdf', 'I');
	}


	function training_detail_pdf($training_id=FALSE)
	{
		if($training_id === FALSE)
			show_404();
		
		$detail = $this->Reports_model->get_training_detail($training_id);
		if(empty($detail))
		{
			show_404();
		}
		$attendees  = $this->Reports_model->get_training_attendance($training_id);
		$attendance_date = $this->Reports_model->get_attendance_dates($training_id);


		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Training Detail');
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);

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

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
		$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">
			<br>
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		$title = '<div></div><h3 style="font-family: helvetica;">Training Detail</h3>';
		$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
		$training_detail = '<table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Project</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->company).'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Training Type</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->training_type).'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Target Group</td>
				<td style="width: 82%; font-family: helvetica;">'.$detail->target_group.'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Session</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->session.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Participants</td>
				<td style="width: 32%; font-family: helvetica;">'.count(explode(',', $detail->trainee_employees)).'</td>
			</tr>
			
			<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Approval Type</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->approval_type.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;"></td>
					<td style="width: 32%; font-family: helvetica;"></td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Start Date</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->start_date)).'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">End Date</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->end_date)).'</td>
				</tr>

				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Province</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->province_name.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">District</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->district_name.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Hall Detail</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->hall_detail.'</td>
				</tr>
				

		</tbody>
		</table>';

		$training_detail .= 
			'<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
				<tbody>
					<tr>
						<td style="width: 100%; font-family: helvetica; font-weight: bold;">Trainer 1</td>
					</tr>
					<tr>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Name</td>
						<td style="width: 82%; font-family: helvetica;">'.ucwords($detail->t1_name).'</td>
					</tr>
					<tr>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Contact</td>
						<td style="width: 32%; font-family: helvetica;">'.$detail->t1_contact.'</td>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Email</td>
						<td style="width: 32%; font-family: helvetica;">'.$detail->t1_email.'</td>
					</tr>
					<tr>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Address</td>
						<td style="width: 82%; font-family: helvetica;">'.$detail->t1_address.'</td>
					</tr>
				</tbody>
				</table>';

		$training_detail .= 
			'<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
				<tbody>
					<tr>
						<td style="width: 100%; font-family: helvetica; font-weight: bold;">Trainer 2</td>
					</tr>
					<tr>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Name</td>
						<td style="width: 82%; font-family: helvetica;">'.ucwords($detail->t2_name).'</td>
					</tr>
					<tr>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Contact</td>
						<td style="width: 32%; font-family: helvetica;">'.$detail->t2_contact.'</td>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Email</td>
						<td style="width: 32%; font-family: helvetica;">'.$detail->t2_email.'</td>
					</tr>
					<tr>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Address</td>
						<td style="width: 82%; font-family: helvetica;">'.$detail->t2_address.'</td>
					</tr>
				</tbody>
				</table>';



		
			$pdf->WriteHTMLCell(0, 0, '', '', $training_detail, 0, 1, 0, true, '', true);


			// $pdf->WriteHTML($remarks, true, false, false, false, '');
			// move pointer to last page
			$pdf->lastPage();

			// ---------------------------------------------------------

			ob_clean();
			//Close and output PDF document
			$pdf->Output('report.pdf', 'I');
	}


	function attendance_detail_pdf($training_id=FALSE)
	{
		if($training_id === FALSE)
			show_404();
		
		$detail = $this->Reports_model->get_training_detail($training_id);
		if(empty($detail))
		{
			show_404();
		}
		
		$attendees = $this->Reports_model->get_training_attendance($training_id);
		$attendance_date = $this->Reports_model->get_attendance_dates($training_id);
			

		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Training Attendance Detail');
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);

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

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
		$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">
			<br>
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		$title = '<div></div><h3 style="font-family: helvetica;">Training Attendance Detail</h3>';
		$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
		$training_detail = '<table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Project</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->company).'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Training Type</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->training_type).'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Target Group</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->target_group.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Participants</td>
				<td style="width: 32%; font-family: helvetica;">'.count(explode(',', $detail->trainee_employees)).'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Approval Type</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->approval_type.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Session</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->session.'</td>
				
			</tr>

				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Start Date</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->start_date)).'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">End Date</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->end_date)).'</td>
				</tr>
				

		</tbody>
		</table>';




		$dates_heading = '';
		$noOfDates = count($attendance_date);
		$percent = 50/$noOfDates;

		foreach($attendance_date AS $ad) {
			$dates_heading .= '<td style="width: '.$percent.'%; font-family: helvetica; font-weight: bold;">'. date('d,M', strtotime($ad->attendance_date)) .'</td>';
		}

		$attendance_detail = '';

		for($i=0; $i<count($attendees); $i++) {

			$attendance_detail .= 
			'<tr>
				<td style="font-family: helvetica;">'. ucwords($attendees[$i]['employee_name']) .'</td>
				<td style="font-family: helvetica;">'. ucwords($attendees[$i]['designation_name']) .'</td>';
				
				foreach($attendance_date AS $a) {
					$attRow = $this->Reports_model->datewise_attendance($attendees[$i]['training_id'], $attendees[$i]['employee_id'], date('Y-m-d', strtotime($a->attendance_date)));

					$attendance_detail .= '<td>';
					if(!empty($attRow)) { 
					 $attendance_detail .= ucfirst($attRow->status); 
					} 
					$attendance_detail .= '</td>';
				}
			$attendance_detail .= '</tr>';
		}

		$training_detail .= 
			'<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
				<tbody>
					<tr>
						<td style="width: 100%; font-family: helvetica; font-weight: bold;">Employee\'s Attendance</td>
					</tr>
					<tr>
						<td style="width: 20%; font-family: helvetica; font-weight: bold;">Name</td>
						<td style="width: 30%; font-family: helvetica; font-weight: bold;">Designation</td>
						'.$dates_heading.'
					</tr>
					'.$attendance_detail.'

				</tbody>
				</table>';




		
			$pdf->WriteHTMLCell(0, 0, '', '', $training_detail, 0, 1, 0, true, '', true);


			// $pdf->WriteHTML($remarks, true, false, false, false, '');
			// move pointer to last page
			$pdf->lastPage();

			// ---------------------------------------------------------

			ob_clean();
			//Close and output PDF document
			$pdf->Output('report.pdf', 'I');
	}

	
	function expenses_detail_pdf($training_id=FALSE)
	{
		if($training_id === FALSE)
			show_404();
		
		$detail = $this->Reports_model->get_training_detail($training_id);
		if(empty($detail))
		{
			show_404();
		}
		$expenses = $this->Reports_model->get_training_expenses($training_id);

		if(empty($detail))
		{
			show_404();
		}

		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Training Expenses Detail');
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);

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

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
		$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">
			<br>
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		$title = '<div></div><h3 style="font-family: helvetica;">Training Expense Detail</h3>';
		$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
		$training_detail = '<table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Project</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->company).'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Training Type</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->training_type).'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Target Group</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->target_group.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Participants</td>
				<td style="width: 32%; font-family: helvetica;">'.count(explode(',', $detail->trainee_employees)).'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Approval Type</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->approval_type.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Session</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->session.'</td>
				
			</tr>

				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Start Date</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->start_date)).'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">End Date</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->end_date)).'</td>
				</tr>
				

		</tbody>
		</table>';


		$expense_rows = '';
		$grand_total = 0;
		foreach ($expenses as $e) {
			$total_expense = $e->dsa + $e->travel + $e->stay_allowance;
			$grand_total += $total_expense;
			$expense_rows .= '<tr>
				<td>'. ucwords($e->employee_name) .'</td>
				<td>'. ucwords($e->designation_name) .'</td>
				<td>'. $e->dsa .'</td>
				<td>'. $e->travel .'</td>
				<td>'. $e->stay_allowance .'</td>
				<td>'. $total_expense .'</td>
			</tr>';
		}

		$expense_detail = '<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 20%; font-family: helvetica; font-weight: bold;">Employee Name</td>
				<td style="width: 20%; font-family: helvetica; font-weight: bold;">Designation</td>
				<td style="width: 15%; font-family: helvetica; font-weight: bold;">DSA</td>
				<td style="width: 15%; font-family: helvetica; font-weight: bold;">Travel</td>
				<td style="width: 15%; font-family: helvetica; font-weight: bold;">Stay Allowance</td>
				<td style="width: 15%; font-family: helvetica; font-weight: bold;">Total</td>
			</tr>
			'. $expense_rows . '
		</tbody>
		</table>';

		$expense_detail .= '<br><br><table border="0px">
		<tbody>
			<tr>
			<td style="width: 80%; font-family: helvetica; font-weight: bold;"></td>
			<td style="width: 20%; font-family: helvetica; font-weight: bold;">Grand Total : '. $grand_total .'
			</td>
			</tr>
		</tbody>
		</table>';




		$training_expense_detail = $training_detail . $expense_detail;
		$pdf->WriteHTMLCell(0, 0, '', '', $training_expense_detail, 0, 1, 0, true, '', true);


		// $pdf->WriteHTML($remarks, true, false, false, false, '');
		// move pointer to last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		ob_clean();
		//Close and output PDF document
		$pdf->Output('report.pdf', 'I');
	}


	function applicant_report_pdf($applicant_id=FALSE)
	{
		if($applicant_id === FALSE)
			show_404();
		
		$detail = $this->Reports_model->applicants_report_detail($applicant_id)->row();

		if(empty($detail))
		{
			show_404();
		}


		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Test Detail');
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);

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

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
		$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">
			<br>
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		$title = '<div></div><h3 style="font-family: helvetica;">Report Card</h3>';
		$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
		$test_detail = '<table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Applicant Name</td>
				<td style="width: 32%; font-family: helvetica;">'.ucwords($detail->fullname).'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Applicant ID</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->application_id.'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Gender</td>
				<td style="width: 82%; font-family: helvetica;">'.$detail->applicant_gender.'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Email</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->email.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Education</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->applicant_education.'</td>
			</tr>
			
			<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Province</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->province_name.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">City</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->city_name.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Company</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->compName.'</td>
				</tr>

		</tbody>
		</table>';

		$test_detail .= 
			'<br><br><table border="1px" style="border: 1px solid black; padding: 5px;">
				<tbody>
					<tr>
						<td style="width: 100%; font-family: helvetica; font-weight: bold;">Exam Date</td>
					</tr>
					<tr>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Obtain Marks</td>
						<td style="width: 32%; font-family: helvetica;">'.$detail->obtain_marks.'</td>
						<td style="width: 18%; font-family: helvetica; font-weight: bold;">Total Marks</td>
						<td style="width: 32%; font-family: helvetica;">'.$detail->total_marks.'</td>
					</tr>
				</tbody>
				</table>';


		
			$pdf->WriteHTMLCell(0, 0, '', '', $test_detail, 0, 1, 0, true, '', true);


			// $pdf->WriteHTML($remarks, true, false, false, false, '');
			// move pointer to last page
			$pdf->lastPage();

			// ---------------------------------------------------------

			ob_clean();
			//Close and output PDF document
			$pdf->Output('report.pdf', 'I');
	}


	function training_activity_pdf()
	{
		$conditions = $this->sc_activity($_SERVER['QUERY_STRING']);
		$training_detail = $this->Reports_model->get_activity_detail($conditions)->result_array();

		$training = array();
		for($i=0; $i<count($training_detail); $i++)
		{		
			$employees_detail[$i] = array();
			$participants = explode(',', $training_detail[$i]['trainee_employees']);
			
			for($j=0; $j<count($participants); $j++)
			{

				$emp = $this->Reports_model->get_designation_gender($participants[$j])->row_array();	
				array_push($employees_detail[$i], $emp);
			}


			$training[$i] = array();
			$training[$i]['detail'] = $training_detail[$i];

			$maleParticipants = 0;
			$femaleParticipants = 0; 
			$totalParticipants = 0;

			$currentDesignation = 0;
			$designations = array();
	
			rsort($employees_detail[$i]);
			for($x=0; $x<count($employees_detail[$i]); $x++)
			{

				if($employees_detail[$i][$x]['designation_id'] != $currentDesignation)
				{
					array_push($designations, $employees_detail[$i][$x]['designation_name']);
				}

				if($employees_detail[$i][$x]['gender'] == 'Male')
				{
					$maleParticipants += 1;
				}
				elseif($employees_detail[$i][$x]['gender'] == 'Female')
				{
					$femaleParticipants += 1;
				}

				$currentDesignation = $employees_detail[$i][$x]['designation_id'];
			}

			$training[$i]['male_participants'] = $maleParticipants;
			$training[$i]['female_participants'] = $femaleParticipants;
			$training[$i]['designations'] = $designations;
		}


		$activity_rows = '';

		for($index=0; $index<count($training); $index++) {
			$designations = '';
			for($i=0; $i<count($training[$index]['designations']); $i++) {
				$designations .= $training[$index]['designations'][$i] . ', '; 
			 	
			}

			$total_participants = $training[$index]['male_participants'] + $training[$index]['female_participants'];

			$activity_rows .= '<tr>
				<td style="font-family: helvetica; font-size: 10px;">'.ucwords($training[$index]['detail']['district']).'</td>
				<td style="font-family: helvetica; font-size: 10px;"></td>
				<td style="font-family: helvetica; font-size: 8px;">'.rtrim($designations, ', ').'</td>
				<td style="font-family: helvetica; font-size: 10px;">'.$training[$index]['detail']['training_type'].'</td>
				<td style="font-family: helvetica; font-size: 10px;">'.$training[$index]['detail']['plan_no_of_participants'].'</td>

				<td style="font-family: helvetica; font-size: 10px;">'.$training[$index]['male_participants'].'</td>
				<td style="font-family: helvetica; font-size: 10px;">'.$training[$index]['female_participants'].'</td>
				<td style="font-family: helvetica; font-size: 10px;">'.$total_participants.'</td>
				<td style="font-family: helvetica; font-size: 10px;">'.date('d-m-Y', strtotime($training[$index]['detail']['start_date'])).'</td>
				<td style="font-family: helvetica;"></td>
			</tr>';
		}

		
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Trainings Activity Detail');
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);

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

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
		$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">
			<br>
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		$title = '<div></div><h3 style="font-family: helvetica;">Monthly Training Activity Report Summary</h3>';
		$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
		$activity_detail = '<table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 10%; font-family: helvetica; font-weight: bold; font-size: 12px;">District</td>
				<td style="width: 10%; font-family: helvetica; font-weight: bold; font-size: 12px;">Town/ UC</td>
				<td style="width: 13%; font-family: helvetica; font-weight: bold; font-size: 12px;">Cadre</td>
				<td style="width: 10%; font-family: helvetica; font-weight: bold; font-size: 12px;">Type of Training</td>
				<td style="width: 10%; font-family: helvetica; font-weight: bold; font-size: 12px;">Plan (# of Participants)</td>
				<td style="width: 25%; font-family: helvetica; font-weight: bold; font-size: 12px;" colspan="3">Accomplishment (# of Participants)</td>
				<td style="width: 12%; font-family: helvetica; font-weight: bold; font-size: 12px;">Training Date</td>
				<td style="width: 10%; font-family: helvetica; font-weight: bold; font-size: 12px;">Remarks</td>
			</tr>
			<tr>
				<td style="font-family: helvetica;"></td>
				<td style="font-family: helvetica;"></td>
				<td style="font-family: helvetica;"></td>
				<td style="font-family: helvetica;"></td>
				<td style="font-family: helvetica;"></td>
				<td style="font-family: helvetica; font-weight: bold; font-size: 12px;">Male</td>
				<td style="font-family: helvetica; font-weight: bold; font-size: 12px;">Female</td>
				<td style="font-family: helvetica; font-weight: bold; font-size: 12px;">Total</td>
				<td style="font-family: helvetica;"></td>
				<td style="font-family: helvetica;"></td>
				<td style="font-family: helvetica;"></td>
			</tr>
			'.$activity_rows.'
		</tbody>
		</table>';


		
		$pdf->WriteHTMLCell(0, 0, '', '', $activity_detail, 0, 1, 0, true, '', true);


		// $pdf->WriteHTML($remarks, true, false, false, false, '');
		// move pointer to last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		ob_clean();
		//Close and output PDF document
		$pdf->Output('report.pdf', 'I');
	}




}

