<?php 

/**
 * 
 */
class Investigation extends MY_Controller
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
        
		$this->load->model(array(
						'User_panel_model',
						'Investigation_model',
						'Designation_model',
						'Reports_model',
						'Province_model',
						'Departments_model',
						'Designations_model',
						'Projects_model',
						'Locations_model'
					));

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}


	function index()
	{
		$data['title'] = 'User Complaint Form';

		$data['province'] = $this->Province_model->get();
		$data['projects'] = $this->Projects_model->get();
		$data['content'] = $this->load->view('investigation/complaint', $data, TRUE);
		$this->load->view('investigation/_template', $data);
	}

	function remove_empty_entries($conditions)
	{
		foreach ($conditions as $key => $value) {
			if($value == '')
				unset($conditions[$key]);

		}

		return $conditions;
	}

	function dashboard()
	{
		$data['title'] = 'Investigation Dashboard';
		$project = $this->session_data['project_id'];
		$province = $this->session_data['province_id'];

		$conditions = ['c.project_id' => $project, 'c.province_id' => $province];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['complaints'] = $this->Investigation_model->get_complaints($filtered_conditions, 5, "")->result();
		$conditions = ['ci.project_id' => $this->session_data['project_id']];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['investigation'] = $this->Investigation_model->get_complaints_internal($filtered_conditions, 5, "")->result();
		$data['content'] = $this->load->view('investigation/dashboard', $data, TRUE);
		$this->load->view('investigation/_template', $data);
	}


	/** Complaints **/

	function view($offset="")
	{		
		$conditions = array();

		$conditions = [
				'c.project_id' => $this->session_data['project_id'], 
				'c.province_id' => $this->session_data['province_id']
			];

		if(isset($_GET['search']))
		{
			$complaintNo = $this->input->get('complaint_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$status = $this->input->get('complaint_status');

			if($complaintNo != '')
				$complaintNo = '%'.$complaintNo.'%';

			$conditions['c.complaint_no LIKE'] = $complaintNo;
			$conditions['c.created_at >='] = $fromDate;
			$conditions['c.created_at <='] = $toDate;
			$conditions['c.status'] = $status;
		}

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Investigation_model->get_complaints($filtered_conditions)->num_rows();
		$url = 'Investigation/view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Investigation_model->get_complaints($filtered_conditions, $this->limit, $offset)->result();
		
		$data['content'] = $this->load->view('investigation/view-complaints', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}


	function view_detail($complaint_id)
	{
		$data['title'] = 'Investigation Detail';

		$conditions = [
				'c.id' => $complaint_id,
				'c.project_id' => $this->session_data['project_id'],
				'c.province_id' => $this->session_data['province_id']
				];

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['detail'] = $this->Investigation_model->get_complaints($filtered_conditions);
		if(empty($data['detail']))
		{
			show_404();
		}

		$data['remarks'] = $this->Investigation_model->get_remarks($complaint_id, 'external');
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{
			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Investigation_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}
		

		$data['content'] = $this->load->view('investigation/complaint-detail', $data, TRUE);
		$this->load->view('investigation/_template', $data);
	}


	function complaint_detail($complaint_id)
	{
		$conditions = [
						'c.id' => $complaint_id,
						'c.project_id' => $this->session_data['project_id'],
						'c.province_id' => $this->session_data['province_id']
						];
		
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['project_head'] = $this->Investigation_model->get_project_head($complaint_id);
		$data['detail'] = $this->Investigation_model->get_complaints($filtered_conditions);
		if(empty($data['detail']))
		{
			show_404();
		}
		//get_files_and_reviews($complint_id, $sender, $receiver) takes these three arguments
		$data['remarks'] = $this->Investigation_model->get_remarks($complaint_id);
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Investigation_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}
		

		$data['title'] = 'Investigation Detail';
		$data['content'] = $this->load->view('investigation/print-view', $data, TRUE);


		$this->load->view('investigation/_template', $data);	
	}


	function legal_view($offset="")
	{
		// if($this->session->userdata('departmentLevel')['departmentLevel7'] == false)
		// 	redirect(base_url().'dashboard');
		
		$conditions = [
					'c.project_id' => $this->session_data['project_id'],
					'c.province_id' => $this->session_data['province_id']
					];

		if(isset($_GET['search']))
		{
			$complaintNo = $this->input->get('complaint_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$status = $this->input->get('status');

			if($complaintNo != '')
				$complaintNo = '%'.$complaintNo.'%';

		
			$conditions['i.status'] = $status;
			$conditions['c.complaint_no LIKE'] = $complaintNo;
			$conditions['c.created_at >='] = $fromDate;
			$conditions['c.created_at <='] = $toDate;
			

		}
		
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Investigation_model->get_complaints_legal($filtered_conditions)->num_rows();
		$url = 'Investigation/legal_view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['title'] = 'List of Investigations';
		$data['complaints'] = $this->Investigation_model->get_complaints_legal($filtered_conditions, $this->limit, $offset)->result();
		
		$data['content'] = $this->load->view('investigation/legal-view', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}


	function legal_detail($id=FALSE)
	{
		$conditions = [
				'i.complaint_id' => $id,
				'c.project_id' => $this->session_data['project_id'],
				'c.province_id' => $this->session_data['province_id']
			];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Investigation Detail';
		$data['detail'] = $this->Investigation_model->get_complaints_legal($filtered_conditions)->row();
		
		if(empty($data['detail']))
		{
			show_404();
		}

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']);

		$data['remarks'] = $this->Investigation_model->get_remarks($id, 'external');
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{
			// $complaint_id = $data['remarks'][0]['complaint_id'];
			// $file_sender = 'legal';

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Investigation_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}

		$data['content'] = $this->load->view('investigation/legal-detail', $data, TRUE);
		$this->load->view('investigation/_template', $data);
	}


	function local_view($offset="")
	{
		$conditions = array();

		$conditions = [
				'c.project_id' => $this->session_data['project_id'], 
				'c.province_id' => $this->session_data['province_id']
			];

		if(isset($_GET['search']))
		{
			$complaintNo = $this->input->get('complaint_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');

			if($complaintNo != '')
				$complaintNo = '%'.$complaintNo.'%';

			$conditions['c.complaint_no LIKE'] = $complaintNo;
			$conditions['c.created_at >='] = $fromDate;
			$conditions['c.created_at <='] = $toDate;
		}

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Investigation_model->get_complaints_local($filtered_conditions)->num_rows();
		$url = 'Investigation/local_view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

		$data['title'] = 'List of Investigations';

		$data['complaints'] = $this->Investigation_model->get_complaints_local($filtered_conditions, $this->limit, $offset)->result();
		$data['content'] = $this->load->view('investigation/local-view', $data, TRUE);
				

		$this->load->view('investigation/_template', $data);
	}

	function local_detail($complaint_id)
	{
		$conditions = [
					'c.project_id' => $this->session_data['project_id'],
					'c.province_id' => $this->session_data['province_id'],
					'i.complaint_id' => $complaint_id
					];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Investigation Detail';

		$data['detail'] = $this->Investigation_model->get_complaints_local($filtered_conditions)->row();
		if(empty($data['detail']))
		{
			show_404();
		}
		// $data['province'] = $this->User_panel_model->get_province();
		// $data['designations'] = $this->Designation_model->get_designations()->result();

		$data['remarks'] = $this->Investigation_model->get_remarks($complaint_id, 'external');
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Investigation_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}

		$data['content'] = $this->load->view('investigation/local-detail', $data, TRUE);
		$this->load->view('investigation/_template', $data);
	}

	function view_internal($offset="")
	{
		$conditions = [
				'ci.project_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			$complaintNo = $this->input->get('complaint_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$project = (int) $this->input->get('project');
			$department = (int) $this->input->get('department');
			$designation = (int) $this->input->get('designation');
			// $action = $this->input->get('action');
			$status = $this->input->get('complaint_status');

			if($complaintNo != '')
				$complaintNo = '%'.$complaintNo.'%';
			
			$conditions['ci.complaint_no LIKE'] = $complaintNo;
			$conditions['ci.reported_date >='] = $fromDate;
			$conditions['ci.reported_date <='] = $toDate;
			$conditions['ci.department_id'] = $department;
			$conditions['ci.designation_id'] = $designation;
			$conditions['ci.status'] = $status;

			if($project != 0)
				$conditions['ci.project_id'] = $project;

		}  

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Investigation_model->get_complaints_internal($filtered_conditions)->num_rows();
		$url = 'Investigation/view_internal';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Investigation_model->get_complaints_internal($filtered_conditions, $this->limit, $offset)->result();
		
		$data['project'] = $this->Projects_model->get($this->session_data['project_id']); 

		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['designation'] = $this->Designations_model->get_by_project($this->session_data['project_id']); 

		$data['content'] = $this->load->view('investigation/internal/view-complaints', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}

	function view_detail_internal($id=FALSE)
	{
		$conditions = [
				'ci.project_id' => $this->session_data['project_id'],
				'xe.proveince_id' => $this->session_data['province_id'],
				'ci.id' => $id
				];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Investigation Detail';
		$data['detail'] = $this->Investigation_model->get_complaints_internal($filtered_conditions)->row();
		
		if(empty($data['detail']))
		{
			show_404();
		}
		//get_files_and_reviews($complint_id, $sender, $receiver) takes these three arguments
		$data['remarks'] = $this->Investigation_model->get_remarks($id, 'internal');
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Investigation_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}
		
		$data['complainee_reply'] = $this->Investigation_model->get_complainee_reply($id);
		$data['content'] = $this->load->view('investigation/internal/complaint-detail', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}

	function legal_internal($offset="")
	{
		$conditions = [
				'ci.project_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			$complaintNo = $this->input->get('complaint_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$project = $this->input->get('project');
			$department = $this->input->get('department');
			$designation = $this->input->get('designation');
			$status = $this->input->get('complaint_status');

			if($complaintNo != '')
				$complaintNo = '%'.$complaintNo.'%';
			
			$conditions['ci.complaint_no LIKE'] = $complaintNo;
			$conditions['ci.reported_date >='] = $fromDate;
			$conditions['ci.reported_date <='] = $toDate;
			$conditions['ci.department_id'] = $department;
			$conditions['ci.designation_id'] = $designation;
			$conditions['i.status'] = $status;

			if($project != '')
				$conditions['ci.project_id'] = $project;

		}  

		$filtered_conditions = $this->remove_empty_entries($conditions);
		
		$total_rows = $this->Investigation_model->get_legal_internal($filtered_conditions)->num_rows();
		$url = 'Investigation/legal_internal';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Investigation_model->get_legal_internal($filtered_conditions, $this->limit, $offset)->result();
		
		$data['project'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['designation'] = $this->Designations_model->get_by_project($this->session_data['project_id']); 

		$data['content'] = $this->load->view('investigation/internal/legal-view', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}

	function legal_detail_internal($id=FALSE)
	{
		$conditions = [
				'ci.project_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id'],
				'i.complaint_id' => $id
				];

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Investigation Detail';
		$data['detail'] = $this->Investigation_model->get_legal_internal($filtered_conditions)->row();
		if(empty($data['detail']))
		{
			show_404();
		}

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']);

		$data['remarks'] = $this->Investigation_model->get_remarks($id, 'internal');
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{
			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Investigation_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}

		$data['complainee_reply'] = $this->Investigation_model->get_complainee_reply($id);
		$data['content'] = $this->load->view('investigation/internal/legal-detail', $data, TRUE);


		$this->load->view('investigation/_template', $data);
	}

	function local_internal($offset="")
	{
		$conditions = [
				'ci.project_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			$complaintNo = $this->input->get('complaint_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$project = $this->input->get('project');
			$department = $this->input->get('department');
			$designation = $this->input->get('designation');

			if($complaintNo != '')
				$complaintNo = '%'.$complaintNo.'%';
			
			$conditions['ci.complaint_no LIKE'] = $complaintNo;
			$conditions['ci.reported_date >='] = $fromDate;
			$conditions['ci.reported_date <='] = $toDate;
			$conditions['ci.department_id'] = $department;
			$conditions['ci.designation_id'] = $designation;

			if($project != '')
				$conditions['ci.project_id'] = $project;

		}  


		$filtered_conditions = $this->remove_empty_entries($conditions);
		$total_rows = $this->Investigation_model->get_local_internal($filtered_conditions)->num_rows();
		$url = 'Investigation/local_internal';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Investigation_model->get_local_internal($filtered_conditions, $this->limit, $offset)->result();

		
		$data['project'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['designation'] = $this->Designations_model->get_by_project($this->session_data['project_id']); 

		$data['content'] = $this->load->view('investigation/internal/local-view', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}

	function local_detail_internal($id=FALSE)
	{
		$conditions = [
					'ci.project_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'i.complaint_id' => $id
				];

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Investigation Detail';
		$data['detail'] = $this->Investigation_model->get_local_internal($filtered_conditions)->row();
		if(empty($data['detail']))
		{
			show_404();
		}

		$data['remarks'] = $this->Investigation_model->get_remarks($id, 'internal');
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Investigation_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}

		$data['complainee_reply'] = $this->Investigation_model->get_complainee_reply($id);
		$data['content'] = $this->load->view('investigation/internal/local-detail', $data, TRUE);

		
		$this->load->view('investigation/_template', $data);
	}


	function employees($offset="")
	{
		$conditions = [
				'xe.company_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id']
				];


		if(isset($_GET['search']))
		{
			$employeeID = $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			// $district = $this->input->get('district');
			// $tehsil = $this->input->get('tehsil');
			// $uc = $this->input->get('uc');
			$project = (int) $this->input->get('project');
			$designation = (int) $this->input->get('designation');
			$location = (int) $this->input->get('location');

			$employee_type = $this->input->get('employee_type');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			$conditions['xe.designation_id'] = $designation;
			$conditions['xol.location_id'] = $location;

			if($project != 0)
				$conditions['xe.company_id'] = $project;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;

		}
		
		$filtered_conditions = $this->remove_empty_entries($conditions);
		$exclude_user_roles = array(1, 2);
		/* Pagination */

		$total_rows = $this->Investigation_model->employee_info($filtered_conditions, "", "", $exclude_user_roles)->num_rows();
		$url = 'Investigation/employees';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		/* end pagination */

		$data['title'] = 'List of Employees';
		$data['employees'] = $this->Investigation_model->employee_info($filtered_conditions, $this->limit, $offset, $exclude_user_roles)->result();
		
		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['locations'] = $this->Locations_model->get_by_project($this->session_data['project_id']);

		$data['content'] = $this->load->view('investigation/employees', $data, TRUE);
		$this->load->view('investigation/_template', $data);
	}

	function create($employee_id="")
	{
		if($employee_id == "")
			show_404();

		$data['title'] = 'Create Investigation';

		$conditions = [
				'xe.employee_id' => $employee_id,
				'xe.company_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id']
			];

		$filtered_conditions = $this->remove_empty_entries($conditions);
		$exclude_user_roles = array(1, 2);

		$data['basic_info'] = $this->Investigation_model->employee_info($filtered_conditions, $exclude_user_roles)->row();
		
		$data['reasons'] = $this->db->get_where('investigation_reasons')->result();
		if(empty($data['basic_info']))
			redirect('Investigation/employees');
		$data['content'] = $this->load->view('investigation/add', $data, TRUE);
		$this->load->view('investigation/_template', $data);
	}

	function add_investigation()
	{
		// $entry_by = $this->session->user_id;
		$entry_by = 1;

		if(isset($_POST['submit']))
		{
			$employee_id = $this->input->post('employee_id');
			$designation = $this->input->post('designation_id');
			$department = $this->input->post('department_id');
			$project = $this->input->post('project_id');
			$province = $this->input->post('province_id');

			$reason = $this->input->post('reason');
			$other_reason = $this->input->post('other_reason');
			$reported_date = $this->input->post('reported_date');
			$evidence = $this->input->post('evidence');
			$evidence_date = $this->input->post('evidence_date');
			$description = $this->input->post('description');

			$complaint_mode = $this->input->post('complaint_mode');
			$intensity = $this->input->post('intensity');
			$title = $this->input->post('title');

			$this->db->select('id');
			$this->db->order_by('id', 'DESC');
			$last_complaint = $this->db->get('complaint_internal')->row();
			$last_complaint++;
			$complaint_no = 'CTC/I-00'.$last_complaint->id;

			$today = date('Y-m-d');
			
			$data = array(
						'complaint_no' => $complaint_no,
						'employee_id' => $employee_id,
						'project_id' => $project,
						'province_id' => $province,
						'department_id' => $department,
						'designation_id' => $designation,
						'reason_id' => $reason,
						'other_reason' => $other_reason,
						// 'reported_by' => $entry_by,
						'reported_date' => $reported_date,
						'evidence' => $evidence,
						'evidence_date' => $evidence_date,
						'complaint_mode' => $complaint_mode,
						'intensity' => $intensity,
						'title' => $title,
						'description' => $description,
						'status' => 'pending',
						'entry_by' => $entry_by,
						'entry_at' => $today
					);


			$inv_added = $this->Investigation_model->add_investigation($data);
			$complaint_id = $this->db->insert_id();
			
			if(!empty($_FILES['files']) && $_FILES['files']['size'][0] != 0)
				$this->upload_complaint_files($_FILES, $complaint_id, $entry_by, "internal");

			
			if($inv_added)
			{
				$this->session->set_flashdata('success', 'Investigation initiated successfully.');
				redirect('Investigation/employees', 'refresh');
			}
		}
		else
		{
			show_404();
		}		
	}

	function previous_inquiries()
	{
		$this->ajax_check();

		$employee_id = $this->input->post('employee_id');
		$inquiries = $this->Investigation_model->get_previous_inquiries($employee_id);

		$this->json_response($inquiries);

	}


	function print_view($offset="")
	{
		$conditions = [
				'ci.project_id' => $this->session_data['project_id'],
				'ci.province_id' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			$complaintNo = $this->input->get('complaint_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$project = (int) $this->input->get('project');
			$department = (int) $this->input->get('department');
			$designation = (int) $this->input->get('designation');
			$status = $this->input->get('complaint_status');

			if($complaintNo != '')
				$complaintNo = '%'.$complaintNo.'%';
			
			$conditions['ci.complaint_no LIKE'] = $complaintNo;
			$conditions['ci.reported_date >='] = $fromDate;
			$conditions['ci.reported_date <='] = $toDate;
			$conditions['ci.department_id'] = $department;
			$conditions['ci.designation_id'] = $designation;
			$conditions['ci.status'] = $status;

			if($project != 0)
				$conditions['ci.project_id'] = $project;

		}  
		
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Investigation_model->get_complaints_internal($filtered_conditions)->num_rows();
		$url = 'Investigation/view_internal';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Investigation_model->get_complaints_internal($filtered_conditions, $this->limit, $offset)->result();
		
		$data['project'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['designation'] = $this->Designations_model->get_by_project($this->session_data['project_id']);

		$data['content'] = $this->load->view('investigation/internal/print-view', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}

	function print_detail($id=FALSE)
	{
		$conditions = [
				'ci.project_id' => $this->session_data['project_id'],
				'ci.province_id' => $this->session_data['province_id'],
				'ci.id' => $id
				];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Investigation Detail';
		$data['detail'] = $this->Investigation_model->get_complaints_internal($filtered_conditions)->row();
			

		if(empty($data['detail']))
		{
			show_404();
		}
		//get_files_and_reviews($complint_id, $sender, $receiver) takes these three arguments
		$data['remarks'] = $this->Investigation_model->get_remarks($id, 'internal');
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$investigation_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Investigation_model->get_files($investigation_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}
		

		$data['content'] = $this->load->view('investigation/internal/print-detail', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}


	
	function get_provinces()
	{
		$this->ajax_check();
		$project_id = $this->input->post('project_id');
		$provinces = $this->Investigation_model->get_project_provinces($project_id);
		$designations = $this->Investigation_model->get_project_designations($project_id);
		$employees = $this->Investigation_model->get_project_employees($project_id);
		$query = $this->db->last_query();
		$this->json_response(array('provinces' => $provinces, 'designations' => $designations, 'employees' => $employees, 'query' => $query));
	}

	function get_districts()
	{
		$this->ajax_check();
		$project_id = $this->input->post('project_id');
		$province_id = $this->input->post('province_id');

		$districts = $this->Investigation_model->get_project_districts($province_id, $project_id);
		$designations = $this->Investigation_model->get_project_designations($project_id, $province_id, 'province');
		$employees = $this->Investigation_model->get_project_employees($project_id, $province_id, 'province');

		$this->json_response(array('districts' => $districts, 'designations' => $designations, 'employees' => $employees));
	}

	function get_tehsils()
	{
		$this->ajax_check();
		$project_id = $this->input->post('project_id');
		$district_id = $this->input->post('district_id');
		$tehsils = $this->Investigation_model->get_project_tehsils($district_id, $project_id);
		$designations = $this->Investigation_model->get_project_designations($project_id, $district_id, 'district');
		$employees = $this->Investigation_model->get_project_employees($project_id, $district_id, 'district');

		$this->json_response(array('tehsils' => $tehsils, 'designations' => $designations, 'employees' => $employees));
	}

	function get_union_councils()
	{
		$this->ajax_check();
		$project_id = $this->input->post('project_id');
		$tehsil_id = $this->input->post('tehsil_id');
		$union_councils = $this->Investigation_model->get_project_ucs($tehsil_id, $project_id);
		$designations = $this->Investigation_model->get_project_designations($project_id, $tehsil_id, 'tehsil');
		$employees = $this->Investigation_model->get_project_employees($project_id, $tehsil_id, 'tehsil');

		$this->json_response(array('ucs' => $union_councils, 'designations' => $designations, 'employees' => $employees));
	}

	function get_uc_designations()
	{
		$this->ajax_check();
		$project_id = $this->input->post('project_id');
		$uc_id = $this->input->post('uc_id');
		$designations = $this->Investigation_model->get_project_designations($project_id, $uc_id, 'uc');
		$employees = $this->Investigation_model->get_project_employees($project_id, $uc_id, 'uc');

		$this->json_response(array('designations' => $designations, 'employees' => $employees));
	}

	function get_employees()
	{
		$this->ajax_check();
		$designation_id = $this->input->post('designation_id');
		$employees = $this->Investigation_model->get_employees_by_designation($designation_id);

		$this->json_response($employees);
	}

	function add_complaint()
	{

		if(isset($_POST['submit']))
		{
			$this->form_validation->set_rules('project', 'Project', 'required');
			$this->form_validation->set_rules('province', 'Province', 'required');
			$this->form_validation->set_rules('district', 'District', 'required');
			$this->form_validation->set_rules('tehsil', 'Tehsil', 'required');
			$this->form_validation->set_rules('uc', 'Union Council', 'required');
			$this->form_validation->set_rules('name', 'Name', 'required|trim');
			$this->form_validation->set_rules('contact', 'Contact', 'required|trim|integer|min_length[11]|max_length[11]|is_natural');
			$this->form_validation->set_rules('email', 'Email address', 'valid_email|trim');
			$this->form_validation->set_rules('subject', 'Subject', 'required|trim');
			$this->form_validation->set_rules('complaint', 'Complaint Detail', 'required|trim');

			// $this->form_validation->set_error_delimiters('<p style="margin-bottom: 0px;">', '</p>'); 

			if($this->form_validation->run() == FALSE)
			{
				$data['errors'] = $str_errors = validation_errors(); 
				// $errors = explode('.', $str_errors);
				$data['title'] = 'User Complaint Form';

				$data['project'] = $this->Reports_model->get_projects();
				$data['province'] = $this->User_panel_model->get_province();
				$data['content'] = $this->load->view('investigation/complaint', $data, TRUE);
				
				$this->load->view('investigation/_template', $data);
			}
			else
			{
				$project = $this->input->post('project');
				$province = $this->input->post('province');
				$district = $this->input->post('district');
				$tehsil = $this->input->post('tehsil');
				$uc = $this->input->post('uc');
				$name = $this->input->post('name');
				$contact = $this->input->post('contact');
				$email = $this->input->post('email');
				$subject = $this->input->post('subject');
				$complaint = $this->input->post('complaint');

				$complaint_no = $this->Investigation_model->get_last_id();
				$complaint_no++;

				$data = array(
							'project_id' => $project,
							'province_id' => $province,
							'district_id' => $district,
							'tehsil_id' => $tehsil,
							'uc_id' => $uc,
							'name' => $name,
							'contact_no' => $contact,
							'email' => $email,
							'subject' => $subject,
							'complaint_desc' => $complaint,
							'created_at' => date('Y-m-d H:i:s'),
							'status' => 'pending',
							'complaint_no' => 'CTC-00'.$complaint_no
						);

				$added = $this->Investigation_model->add_complaint($data);
				
				if($added) 
				{
					$this->session->set_flashdata('success', 'Your complaint has been submitted successfully.');
					redirect('Investigation/index', 'refresh');
				}

			}

			
		} 
		else
		{
			show_404();
		}
	}

	function close_investigation()
	{
		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;
			$employee_id = 6;

			$complaint_id = $this->input->post('complaint_id');
			$complaint_type = $this->input->post('complaint_type');
			$remarks = $this->input->post('remarks');
			$today = date('Y-m-d H:i:s');

			$data = array(
				'closing_remarks' => $remarks,
				'remarks_by' => $employee_id,
				'remarks_at' => $today,
				'status' => 'resolved'
			);
			
			if($complaint_type == 'external')
			{
				$view = 'view';
				$updated = $this->Investigation_model->close_investigation($data, $complaint_id);
			}
			elseif($complaint_type == 'internal')
			{
				$view = 'view_internal';
				$updated = $this->Investigation_model->close_investigation_internal($data, $complaint_id);
			}
			

			$status_changed = FALSE;

			
			
			if($updated)
			{
				$status_changed = $this->Investigation_model->update_investigation_status($complaint_id, 'resolved');
			}
			else
			{
				exit('Error! Server error occured. Contact developer of the site');
			}

			if($status_changed)
			{
				$this->session->set_flashdata('success', 'Investigation closed successfully.');
				redirect('Investigation/'.$view, 'refresh');
			}
			else
			{
				exit('Error! There is something wrong with the server. Contact your site developer');

			}

		}
	}

	function add_disciplinary()
	{
		$employee_id = $this->session->user_id;
		$employee_id = 4;

		if(isset($_POST))
		{
			$complaint_id = $this->input->post('complaint_id');
			$disciplinary = $this->input->post('disciplinary');

			$data = array(
						'action' => $disciplinary,
						'action_by' => $employee_id,
						'action_at' => date('Y-m-d')
						);

			$update = $this->Investigation_model->add_disciplinary_action($complaint_id, $data);

			if($update)
			{
				$status = '';
				$is_active = '1';

				if($disciplinary == 'terminate') {
					$status = '6';
					$is_active = '0';
				}

				$data = array(
							'status' => $status,
							'is_active' => $is_active
						);

				$this->Investigation_model->update_employee_status($employee_id, $data);
				redirect('Investigation/view_detail_internal/'.$complaint_id);
			}
		}
	}

	function forward()
	{
		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;
			$employee_id = 4;
			$complaint_id = $this->input->post('complaint_id');
			$complaint_type = $this->input->post('type');
			$remarks = $this->input->post('remarks');
			if($complaint_type == 'external')
				$rows = $this->Investigation_model->check_complaint_existence($complaint_id)->num_rows();
			elseif($complaint_type == 'internal')
				$rows = $this->Investigation_model->check_complaint_existence_internal($complaint_id)->num_rows();

			if($rows > 0)
			{
				echo '2';
				exit;
			}

			$data = array(
				'complaint_id' => $complaint_id,
				'sender' => $employee_id,
				'sender_remarks' => $remarks,
				'receiver' => '0',
				'send_from' => 'head',
				'intended_for' => 'legal',
				'r_date' => date('Y-m-d H:i:s'),
				'status' => 'pending',
				'type' => $complaint_type
			);

			$investigate = $this->Investigation_model->add($data);
			if($investigate)
			{
				if($complaint_type == 'external')
				{
					$this->Investigation_model->update_complaint_status($complaint_id, 'process');
				}
				elseif($complaint_type == 'internal')
				{
					$this->Investigation_model->update_complaint_status_internal($complaint_id, 'process');
				}


				echo '1';
			}
			else
			{
				echo '0';
			}
		}
		else
		{
			show_404();
		}
	}

	function forward_complainee()
	{
		$this->ajax_check();
		if(isset($_POST))
		{
			$complaint_id = $this->input->post('complaint_id');

			$rows = $this->db->get_where('complaint_internal', array('id' => $complaint_id, 'contact_complainee' => '1'))->num_rows();
			if($rows > 0)
			{
				echo '2';
				exit;
			}

			
			$date = date('Y-m-d');
			$this->db->where('id', $complaint_id);
			$forward = $this->db->update('complaint_internal', array('contact_complainee' => '1', 'forward_date' => $date));

			if($forward)
			{

				echo '1';
			}
			else
			{
				echo '0';
			}
		}
		else
		{
			show_404();
		}
	}

	function forward_local()
	{

		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;
			$employee_id = 6;
			$investigation_id = $this->input->post('investigation_id');
			$complaint_id = $this->input->post('complaint_id');
			$complaint_type = $this->input->post('complaint_type');

			if($complaint_type == 'external')
				$rows = $this->Investigation_model->investigation_local_existence($complaint_id)->num_rows();
			elseif($complaint_type == 'internal')
				$rows = $this->Investigation_model->investigation_local_existence_internal($complaint_id)->num_rows();

			$remarks = $this->input->post('remarks');
			$receiver = $this->input->post('employee_id');


			if($rows > 0)
			{
				echo '2';
				exit;
			}

			$data = array(
				'complaint_id' => $complaint_id,
				'sender' => $employee_id,
				'sender_remarks' => $remarks,
				'receiver' => $receiver,
				'send_from' => 'legal',
				'intended_for' => 'local',
				'r_date' => date('Y-m-d H:i:s'),
				'status' => 'pending',
				'type' => $complaint_type
			);

			$investigate = $this->Investigation_model->add($data);
			$investigation_id = $this->db->insert_id();

			if(!empty($_FILES['docs']) && $_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $complaint_id, $investigation_id, 'legal');

			if($investigate)
			{

				if($complaint_type == 'external')
				{
					$view = 'local_view';
					$this->Investigation_model->update_complaint_status($complaint_id, 'process');
				}
				elseif($complaint_type == 'internal')
				{
					$view = 'local_internal';
					$this->Investigation_model->update_complaint_status_internal($complaint_id, 'process');
				}

				$this->Investigation_model->update_status($complaint_id, 'process', 'legal');
				echo '1';
				exit;
			}
			else
			{
				echo '0';
				exit;
			}
		}
		else
		{
			show_404();
		}

		redirect('Investigation/legal_view', 'refresh');
	}



	/*** Investigation functions of Legal Department starts here ***/



	function legal_resolve()
	{
		
		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;
			$employee_id = 4;

			$complaint_id = $this->input->post('complaint_id');
			$complaint_type = $this->input->post('complaint_type');
			$investigation_id = $this->input->post('investigation_id');
			$remarks = $this->input->post('remarks');
			$today = date('Y-m-d H:i:s');

			$data = array(
				'complaint_id' => $complaint_id,
				'sender' => $employee_id,
				'sender_remarks' => $remarks,
				'send_from' => 'legal',
				'intended_for' => 'head',
				'r_date' => $today,
				'status' => 'resolved',
				'type' => $complaint_type
			);

			$updated = $this->Investigation_model->add($data);
			$investigation_id = $this->db->insert_id();
			if(!empty($_FILES) && $_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $complaint_id, $investigation_id, 'legal');

			$status_changed = FALSE;

			if($updated)
			{
				if($complaint_type == 'external')
				{
					$view = 'legal_view';
					$this->Investigation_model->update_complaint_status($complaint_id, 'review');
				}
				elseif($complaint_type == 'internal')
				{
					$view = 'legal_internal';
					$this->Investigation_model->update_complaint_status_internal($complaint_id, 'review');
				}
				
				$inv_status = $this->Investigation_model->update_investigation_status($complaint_id, 'resolved');
				$this->session->set_flashdata('success', 'Investigation closed successfully.');
			}
			else
			{
				exit('Error! There seems to be a problem at your server. Contact developer of the site');
			}

		}


		redirect('Investigation/'.$view, 'refresh');
	}


	private function upload_files($files, $complaint_id, $investigation_id, $sender)
    {
    	$data = array();
        
        $filesCount = count($_FILES['docs']['name']);
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['file']['name']     = $_FILES['docs']['name'][$i];
            $_FILES['file']['type']     = $_FILES['docs']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['docs']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['docs']['error'][$i];
            $_FILES['file']['size']     = $_FILES['docs']['size'][$i];
            
            // File upload configuration
            $uploadPath = './uploads/investigation_files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
            $config['encrypt_name'] = TRUE;
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            // Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $fileData = $this->upload->data();

                $uploadData[$i]['original_name'] = $fileData['orig_name'];
                $uploadData[$i]['file_name'] = $fileData['file_name'];
                $uploadData[$i]['upload_date'] = date("Y-m-d H:i:s");
                $uploadData[$i]['complaint_id'] = $complaint_id;
                $uploadData[$i]['investigation_id'] = $investigation_id;
                $uploadData[$i]['file_sender'] = $sender;
            }
            else
            {
            	echo $this->upload->display_errors();
            }
        }
        
        if(!empty($uploadData)){
            $insert = $this->Investigation_model->upload($uploadData);

        }
    }

    private function upload_complaint_files($files, $complaint_id, $employee_id, $complaint_type)
    {

    	$data = array();

        $filesCount = count($_FILES['files']['name']);
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['file']['name']     = $_FILES['files']['name'][$i];
            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error']     = $_FILES['files']['error'][$i];
            $_FILES['file']['size']     = $_FILES['files']['size'][$i];
            
            // File upload configuration
            $uploadPath = './uploads/complaint_files/';
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|doc|docx';
            $config['encrypt_name'] = TRUE;
            
            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            // Upload file to server
            if($this->upload->do_upload('file')){
                // Uploaded file data
                $fileData = $this->upload->data();

                $uploadData[$i]['original_name'] = $fileData['orig_name'];
                $uploadData[$i]['file_name'] = $fileData['file_name'];
                $uploadData[$i]['upload_date'] = date("Y-m-d H:i:s");
                $uploadData[$i]['complaint_id'] = $complaint_id;
                $uploadData[$i]['uploaded_by'] = $employee_id;
                $uploadData[$i]['complaint_type'] = $complaint_type;
            }
            else
            {
            	echo $this->upload->display_errors();
            }
        }
        
        if(!empty($uploadData)){
            $insert = $this->Investigation_model->upload_files($uploadData);

        }

    }



	function local_resolve()
	{
		
		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;

			$complaint_id = $this->input->post('complaint_id');
			$investigation_id = $this->input->post('investigation_id');
			$complaint_type = $this->input->post('complaint_type');
			$remarks = $this->input->post('remarks');
			// Can also get sender from session but currently its not implemented
			$sender = $this->input->post('employee_id'); 
			$today = date('Y-m-d H:i:s');

			$data = array(
				'complaint_id' => $complaint_id,
				'sender' => $sender,
				'sender_remarks' => $remarks,
				'send_from' => 'local',
				'intended_for' => 'legal',
				'r_date' => $today,
				'status' => 'review',
				'type' => $complaint_type
			);

			$updated = $this->Investigation_model->add($data);

			$investigation_id = $this->db->insert_id();
			
			if(!empty($_FILES) && $_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $complaint_id, $investigation_id, 'local');

			$status_changed = FALSE;

			if($updated)
			{
				$inv_status = $this->Investigation_model->update_local_status($complaint_id, $sender, 'resolved');
				$status_changed = $this->Investigation_model->update_status($complaint_id, 'review', 'legal');

				$this->session->set_flashdata('success', 'Investigation closed successfully.');
			}
			else
			{
				exit('Error! There seems to be a problem at your server. Contact developer of the site');
			}

		}

		redirect('Investigation/local_internal', 'refresh');
	}



	function get_legal_table()
	{
		$this->ajax_check();

		$status = $this->input->get('status');
		$complaints = $this->Investigation_model->get_complaints_legal(FALSE, $status)->result();
		$no_of_rows = $this->Investigation_model->get_complaints_legal()->num_rows();


		$data = array();
		$count = 1;
		$previous_ids=array(); 

		foreach ($complaints as $c) {
			if(in_array($c->complaint_id, $previous_ids)) 
				continue;

			$label = '';
			if($c->status == "pending") 
				$label = "label label-warning";
			elseif($c->status == "resolved")
				$label = "label label-primary";
			elseif($c->status == "review")
				$label = "label label-success";
			elseif($c->status == "process")
				$label = "label label-info";

			$data[] = array(
				$c->complaint_id,
				$count,
				$c->complaint_no,
				$c->subject,
				$c->name,
				$c->contact_no,
				$c->province,
				date('d-m-Y', strtotime($c->r_date)),
				'<td>
					<label class="'. $label .'">'. $c->status.'</label>
				</td>'
			);

			$count++;
			array_push($previous_ids, $c->complaint_id);
		}

		$draw = intval($this->input->get('draw'));
		$output = array(
			'draw' => $draw,
			'records_total' => $no_of_rows,
			'records_filtered' => $no_of_rows,
			'data' => $data
		);
		
		echo json_encode($output);
	}

	// public function complaints($offset="")
	// {

	// 	$total_rows = $this->Investigation_model->get_complaints()->num_rows();
	// 	$url = 'Investigation/complaints';

	// 	$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
	// 	$data['title'] = 'Print Complaints';
	// 	$data['complaints'] = $this->Investigation_model->get_complaints(FALSE, $this->limit, $offset)->result();
	// 	$data['table_id'] = "complaints-table";
	// 	$data['view_print'] = 'print';
	// 	$data['complaints_table'] = $this->load->view('investigation/tables/complaints-table', $data, TRUE);
	// 	$data['content'] = $this->load->view('investigation/list-complaints', $data, TRUE);
		

	// 	$this->load->view('investigation/_template', $data);
	// }





	function report($id=FALSE)
	{
		if($id === FALSE)
			show_404();
		
		$conditions = [
						'c.id' => $id,
						'c.project_id' => $this->session_data['project_id'],
						'c.province_id' => $this->session_data['province_id']
						];
		
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['project_head'] = $this->Investigation_model->get_project_head($id);
		$detail = $this->Investigation_model->get_complaints($filtered_conditions);

		if(empty($detail))
		{
			show_404();
		}

		$remarks = $this->Investigation_model->get_remarks($id, 'external');
		
		if(!empty($remarks))
			{

				$remarks_and_files = array();
				for ($i=0; $i < count($remarks); $i++) { 
					$investigation_id = $remarks[$i]['id'];
					$file_counter = 0;

					$remarks_and_files[$i] = $remarks[$i];
					$files = $this->Investigation_model->get_files($investigation_id);

					for ($j=0; $j < count($files); $j++) {
						$remarks_and_files[$i][$j] = $files[$j];
						$file_counter++;
					}

					$remarks_and_files[$i]['number_of_files'] = $file_counter;
				}
			}

		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Investigation Report');

		// set default header data
		// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

		// set header and footer fonts
		// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong><br>
			<strong style="font-size: 14px;">Investigation Detail And Remarks</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		// $title = '<div></div><h3 style="font-family: helvetica;">Complaint detail and remarks</h3>';
		// $pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
		$complaint_detail = '<table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Complaint No</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->complaint_no.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Date</td>
				<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->created_at)).'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Name</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->name.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Contact</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->contact_no.'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Email</td>
				<td style="width: 82%; font-family: helvetica;">'.$detail->email.'</td>
			</tr>
			
			<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Province</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->province.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">District</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->district.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Tehsil</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->tehsil.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">UC</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->uc.'</td>
				</tr>

				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Subject</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->subject.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Description</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->complaint_desc.'</td>
				</tr>
						
		</tbody>
		</table>';



		$remarks = '<div>';
		if(!empty($remarks_and_files)) {
		$remarks .= '
				<h3 style="font-family: helvetica;">Investigation Remarks</h3>';
		$marginLeft=0;

		for ($i=0; $i < count($remarks_and_files); $i++) { 
				$employee_name = ucfirst($remarks_and_files[$i]['first_name'])." ".ucfirst($remarks_and_files[$i]['last_name']);
			
				 if($remarks_and_files[$i]['send_from'] == 'head'):
					$sender = $employee_name . ' (Project Head)';
					$marginLeft = 0;
				  elseif($remarks_and_files[$i]['send_from'] == 'legal'):
				  	$sender = $employee_name . ' (Legal)';
				  	$marginLeft = 10;
				  elseif($remarks_and_files[$i]['send_from'] == 'local'):
				  	$sender = $employee_name . ' (Investigator)';
				  	$marginLeft = 20;
				  endif;
				
			$remarks .= '<div style="font-family: helvetica;">
							<strong>'. $sender .'</strong>
						<br>'
							 . $remarks_and_files[$i]['sender_remarks'] . 
						'<br>
						<span style="font-size: 10px;">'
							. date('d-m-Y', strtotime($remarks_and_files[$i]['r_date'])) . 
						'</span>
						</div>';

		} 

		
			if($detail->status == 'resolved') {
				$remarks .= '<div>
							<strong>Closing remarks by project head</strong><br>'
							. $detail->closing_remarks .
						'<br><span>'
								. date('d-m-Y', strtotime($detail->remarks_at)) .
							'</span>
						</div>';
			}

		} 

		$remarks .= '</div>';
		
			$pdf->WriteHTMLCell(0, 0, '', '', $complaint_detail, 0, 1, 0, true, '', true);
			$pdf->WriteHTMLCell(180, 0, '', '', $remarks, 0, 1, 0, true, '', true);


			// $pdf->WriteHTML($remarks, true, false, false, false, '');
			// move pointer to last page
			$pdf->lastPage();

			// ---------------------------------------------------------

			ob_clean();
			//Close and output PDF document
			$pdf->Output('report.pdf', 'I');
	}

	function report_internal($id=FALSE)
	{
		if($id === FALSE)
			show_404();

		$conditions = [
				'ci.project_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id'],
				'ci.id' => $id
				];
		$filtered_conditions = $this->remove_empty_entries($conditions);
		$detail = $this->Investigation_model->get_complaints_internal($filtered_conditions)->row();
		
		$data['project_head'] = $this->Investigation_model->get_project_head_internal($id);

		$complainee_reply = $this->Investigation_model->get_complainee_reply($id);

		if(empty($detail))
		{
			show_404();
		}

		$remarks = $this->Investigation_model->get_remarks($id, 'internal');

		if(!empty($remarks))
			{

				$remarks_and_files = array();
				for ($i=0; $i < count($remarks); $i++) { 
					$investigation_id = $remarks[$i]['id'];
					$file_counter = 0;

					$remarks_and_files[$i] = $remarks[$i];
					$files = $this->Investigation_model->get_files($investigation_id);

					for ($j=0; $j < count($files); $j++) {
						$remarks_and_files[$i][$j] = $files[$j];
						$file_counter++;
					}

					$remarks_and_files[$i]['number_of_files'] = $file_counter;
				}
			}

		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		// set document information
		$pdf->SetTitle('Investigation Report');

		// set default header data
		// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

		// set header and footer fonts
		// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
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
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong><br>
			<strong style="font-size: 14px;">Investigation Detail And Remarks</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		// $title = '<div></div><h3 style="font-family: helvetica;">Complaint detail and remarks</h3>';
		// $pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
		$evidence = ($detail->evidence) ? 'Yes' : 'No';
		$complaint_detail = '<table border="1px" style="border: 1px solid black; padding: 5px;">
		<tbody>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Complaint No</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->complaint_no.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Date</td>
				<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->reported_date)).'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Employee Name</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->employee_id.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Project</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->project_name.'</td>
			</tr>
			<tr>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Department</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->department_name.'</td>
				<td style="width: 18%; font-family: helvetica; font-weight: bold;">Designation</td>
				<td style="width: 32%; font-family: helvetica;">'.$detail->designation_name.'</td>
			</tr>
			
			<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Reason</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->reason_text.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Other Reason</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->other_reason.'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Description</td>
					<td style="width: 82%; font-family: helvetica;">'.$detail->description.'</td>
				</tr>

				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Evidence</td>
					<td style="width: 32%; font-family: helvetica;">'.$evidence.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Evidence Date</td>
					<td style="width: 32%; font-family: helvetica;">'.date('d-m-Y', strtotime($detail->evidence_date)).'</td>
				</tr>
				<tr>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Reported By</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->reported_by.'</td>
					<td style="width: 18%; font-family: helvetica; font-weight: bold;">Reported Date</td>
					<td style="width: 32%; font-family: helvetica;">'.$detail->reported_date.'</td>
				</tr>
						
		</tbody>
		</table>';



		$remarks = '<div>';
		if(!empty($remarks_and_files)) {
		$remarks .= '
				<h3 style="font-family: helvetica;">Investigation Remarks</h3>';
		$marginLeft=0;

		for ($i=0; $i < count($remarks_and_files); $i++) { 
				$employee_name = ucfirst($remarks_and_files[$i]['first_name'])." ".ucfirst($remarks_and_files[$i]['last_name']);
			
				 if($remarks_and_files[$i]['send_from'] == 'head'):
					$sender = $employee_name . ' (Project Head)';
					$marginLeft = 0;
				  elseif($remarks_and_files[$i]['send_from'] == 'legal'):
				  	$sender = $employee_name . ' (Legal)';
				  	$marginLeft = 10;
				  elseif($remarks_and_files[$i]['send_from'] == 'local'):
				  	$sender = $employee_name . ' (Investigator)';
				  	$marginLeft = 20;
				  endif;
				
			$remarks .= '<div style="font-family: helvetica;">
							<strong>'. $sender .'</strong>
						<br>'
							 . $remarks_and_files[$i]['sender_remarks'] . 
						'<br>
						<span style="font-size: 10px;">'
							. date('d-m-Y', strtotime($remarks_and_files[$i]['r_date'])) . 
						'</span>
						</div>';

		} 

			if($complainee_reply->complainee_reply != '')
			{
				$remarks .= '<div style="font-family: helvetica;">
							<strong>'. ucwords($complainee_reply->emp_name) .' (Complainee Reply)</strong><br>'
							. $complainee_reply->complainee_reply .
						'<br><span style="font-size: 10px;">'
								. date('d-m-Y', strtotime($complainee_reply->reply_date)) .
							'</span>
						</div>';
			}
		
			if($detail->status == 'resolved') 
			{
				$remarks .= '<div>
							<strong>Closing remarks by project head</strong><br>'
							. $detail->closing_remarks .
						'<br><span>'
								. date('d-m-Y', strtotime($detail->remarks_at)) .
							'</span>
						</div>';
			}

		} 

		$remarks .= '</div>';
		
			$pdf->WriteHTMLCell(0, 0, '', '', $complaint_detail, 0, 1, 0, true, '', true);
			$pdf->WriteHTMLCell(180, 0, '', '', $remarks, 0, 1, 0, true, '', true);


			// $pdf->WriteHTML($remarks, true, false, false, false, '');
			// move pointer to last page
			$pdf->lastPage();

			// ---------------------------------------------------------

			ob_clean();
			//Close and output PDF document
			$pdf->Output('report.pdf', 'I');
	}




}