<?php 

/**
 * 
 */
class Disciplinary extends MY_Controller
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
						'Disciplinary_model',
						'Designation_model',
						'Reports_model',
						'Province_model',
						'Departments_model',
						'Designations_model',
						'Projects_model',
						'Locations_model',
						'Disciplinary_model'
					));

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}


	function remove_empty_entries($conditions)
	{
		foreach ($conditions as $key => $value) {
			if($value == '')
				unset($conditions[$key]);

		}

		return $conditions;
	}

	// function index()
	// {
	// 	$data['title'] = 'Investigation Dashboard';
	// 	$project = $this->session_data['project_id'];
	// 	$province = $this->session_data['province_id'];

	// 	$conditions = ['di.project_id' => $project, 'di.province_id' => $province];
	// 	$filtered_conditions = $this->remove_empty_entries($conditions);

	// 	$data['complaints'] = $this->Disciplinary_model->get_complaints($filtered_conditions, 5, "")->result();
	// 	$conditions = ['di.project_id' => $this->session_data['project_id']];
	// 	$filtered_conditions = $this->remove_empty_entries($conditions);

	// 	$data['investigation'] = $this->Disciplinary_model->get_complaints_internal($filtered_conditions, 5, "")->result();
	// 	$data['content'] = $this->load->view('disciplinary/index', $data, TRUE);
	// 	$this->load->view('disciplinary/_template', $data);
	// }


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

		$total_rows = $this->Disciplinary_model->employee_info($filtered_conditions, "", "", $exclude_user_roles)->num_rows();
		$url = 'disciplinary/employees';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		/* end pagination */

		$data['title'] = 'List of Employees';
		$data['employees'] = $this->Disciplinary_model->employee_info($filtered_conditions, $this->limit, $offset, $exclude_user_roles)->result();
		
		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['locations'] = $this->Locations_model->get_by_project($this->session_data['project_id']);
		$data['reasons'] = $this->db->get_where('investigation_reasons')->result();
		$data['type'] = $this->Disciplinary_model->get_disciplinary_type(); 

		$data['content'] = $this->load->view('disciplinary/employees', $data, TRUE);
		$this->load->view('disciplinary/_template', $data);
	}


	function employee_disciplinary($employee_id)
	{
		$conditions = [
				'xe.company_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id'],
				'xe.employee_id' => $employee_id
				];

		$filtered_conditions = $this->remove_empty_entries($conditions);
		$exclude_user_roles = array(1, 2);

		$data['title'] = 'Add Disciplinary';
		$data['detail'] = $this->Disciplinary_model->employee_info($filtered_conditions, "", "", $exclude_user_roles)->row();
	
		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $provinces = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['locations'] = $this->Locations_model->get_by_project($this->session_data['project_id']);
		$data['reasons'] = $this->db->get_where('investigation_reasons')->result();
		$data['type'] = $this->Disciplinary_model->get_disciplinary_type(); 
		$province_string = '';

		foreach ($provinces as $p) {
			$province_string .="'<option value='".$p->id."'>".$p->name."</option>";
		}

		$data['province_string'] = $province_string;
		$data['content'] = $this->load->view('disciplinary/add', $data, TRUE);
		$this->load->view('disciplinary/_template', $data);
	}


	function employee_detail()
	{
		$employee_id = $this->input->post('employee_id');

		$this->db->select('xe.employee_id, CONCAT(xe.first_name, " ", IFNULL(xe.last_name, "")) AS emp_name, xe.provience_id, xe.company_id AS project_id, xe.department_id, xe.designation_id, xd.designation_name');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->where('xe.employee_id', $employee_id);
		$data = $this->db->get('xin_employees xe')->row();

		$this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('data' => $data)));
	}


	function add()
	{
		$entry_by = $this->session_data['user_id'];

		if(isset($_POST['submit']))
		{
			$employee_id = $this->input->post('employee_id');
			$designation = $this->input->post('designation_id');
			$department = $this->input->post('department_id');
			$project = $this->input->post('project_id');
			$province = $this->input->post('province_id');

			$type_id = $this->input->post('type_id');

			$reason = $this->input->post('reason');
			$other_reason = $this->input->post('other_reason');
			$reported_by = $this->input->post('reported_by');
			$reported_date = $this->input->post('reported_date');
			$evidence = $this->input->post('evidence');
			$evidence_date = $this->input->post('evidence_date');
			$description = $this->input->post('description');

			$complaint_mode = $this->input->post('complaint_mode');
			$intensity = $this->input->post('intensity');
			$title = $this->input->post('title');

			// $status = $this->input->post('status');
			$created_by = $this->input->post('created_by');
			$created_date = $this->input->post('created_date');

			$salary_hold = $this->input->post('salary_hold');
			$suspend_from_duty = $this->input->post('suspend_from_duty');
			$resignation_date = $this->input->post('resignation_date');

			$reported_by = $this->input->post('reported_by');
			$reported_date = $this->input->post('reported_date');
			$reported_date_ctc = $this->input->post('reported_date_ctc');

			$prior_notice = $this->input->post('prior_notice');
			$last_working_date = $this->input->post('last_working_date');
			$issue_reporting_date = $this->input->post('issue_reporting_date');
			$transfer_type = $this->input->post('transfer_type');

			$position_abolish = $this->input->post('position_abolish');
			$abolish_date = $this->input->post('abolish_date');
			$position_filled_against = $this->input->post('position_filled_against');
			
			$job_position = $this->input->post('job_position');
			$transfer_effective_date = $this->input->post('transfer_effective_date');

			$province = $this->input->post('province');
			$district = $this->input->post('district');
			$tehsil = $this->input->post('tehsil');
			$uc = $this->input->post('uc');


			// $this->db->select('id');
			// $this->db->order_by('id', 'DESC');
			// $last_complaint = $this->db->get('disciplinary')->row();
			// $last_complaint++;
			// $complaint_no = 'CTC/I-00'.$last_complaint->id;

			$today = date('Y-m-d');
			
			$data = array(
						// 'complaint_no' => $complaint_no,
						'employee_id' => $employee_id,
						'project_id' => $project,
						'province_id' => $province,
						'district_id' => $district,
						'tehsil_id' => $tehsil,
						'uc_id' => $uc,
						'department_id' => $department,
						'designation_id' => $designation,
						'reason_id' => $reason,
						'other_reason' => $other_reason,
						'reported_by' => $entry_by,
						'reported_date' => $reported_date,
						'evidence' => $evidence,
						'evidence_date' => $evidence_date,
						'mode' => $complaint_mode,
						'intensity' => $intensity,
						'title' => $title,
						'description' => $description,
						// 'status_id' => $status_id,
						'created_by' => $entry_by,
						'created_date' => $today,
						'type_id' => $type_id,
						'salary_hold' => $salary_hold,
						'suspend_from_duty' => $suspend_from_duty,
						'resignation_date' => $resignation_date,
						'reported_by' => $reported_by,
						'reported_date' => $reported_date,
						'reported_date_ctc' => $reported_date_ctc,
						'prior_notice' => $prior_notice,
						'last_working_date' => $last_working_date,
						'issue_reporting_date' => $issue_reporting_date,
						'transfer_type' => $transfer_type,
						'position_abolish' => $position_abolish,
						'abolish_date' => $abolish_date,
						'position_filled_against' => $position_filled_against,
						'job_position' => $job_position,
						'transfer_effective_date' => $transfer_effective_date

					);

			$inv_added = $this->Disciplinary_model->add($data);
			$disciplinary_id = $this->db->insert_id();
			
			if(!empty($_FILES['files']) && $_FILES['files']['size'][0] != 0)
				$this->upload_files($_FILES, $employee_id, $disciplinary_id);

			
			if($inv_added)
			{
				$this->session->set_flashdata('success', 'Investigation initiated successfully.');
				redirect('Disciplinary/employees', 'refresh');
			}
		}
	}

	
	function view($offset="")
	{
		$conditions = [
				'di.project_id' => $this->session_data['project_id'],
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
			$status = $this->input->get('status');

			if($complaintNo != '')
				$complaintNo = '%'.$complaintNo.'%';

			$conditions['di.reported_date >='] = $fromDate;
			$conditions['di.reported_date <='] = $toDate;
			$conditions['di.department_id'] = $department;
			$conditions['di.designation_id'] = $designation;
			$conditions['di.status_id'] = $status;

			if($project != 0)
				$conditions['di.project_id'] = $project;

		}  

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Disciplinary_model->disciplinary_actions($filtered_conditions)->num_rows();

		$url = 'Disciplinary/view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$data['title'] = 'List Employee Actions';
		$data['complaints'] = $this->Disciplinary_model->disciplinary_actions($filtered_conditions, $this->limit, $offset)->result();
		
		$data['project'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['designation'] = $this->Designations_model->get_by_project($this->session_data['project_id']);

		$data['status'] = $this->Disciplinary_model->disciplinary_status()->result();

		$data['content'] = $this->load->view('disciplinary/view', $data, TRUE);

		$this->load->view('disciplinary/_template', $data);
	}

	
	function view_detail($id=FALSE)
	{
		$conditions = [
			'di.project_id' => $this->session_data['project_id'],
			'xe.proveince_id' => $this->session_data['province_id'],
			'di.id' => $id
			];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'View Detail';
		$data['detail'] = $this->Disciplinary_model->disciplinary_actions($filtered_conditions)->row();
		
		if(empty($data['detail']))
		{
			show_404();
		}
	
		$data['comments'] = $this->Disciplinary_model->get_comments($id);
		$data['status'] = $this->Disciplinary_model->disciplinary_status()->result();

		// $status = $this->Disciplinary_model->get_max_status($id);

		// $data['status'] = $this->db->get_where('disciplinary_status', array('id' => $status->status_id + 1))->row();
		
		$data['content'] = $this->load->view('disciplinary/investigation-detail', $data, TRUE);
		$this->load->view('disciplinary/_template', $data);
	}


	private function upload_files($files, $employee_id, $disciplinary_id)
    {
    	$data = array();

        $filesCount = count($_FILES['files']['name']);
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['file']['name']     = $_FILES['files']['name'][$i];
            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['files']['error'][$i];
            $_FILES['file']['size']     = $_FILES['files']['size'][$i];
            
            // File upload configuration
            $uploadPath = './uploads/disciplinary_files/';
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
                $uploadData[$i]['disciplinary_id'] = $disciplinary_id;
                $uploadData[$i]['uploaded_by'] = $employee_id;
            }
            else
            {
            	echo $this->upload->display_errors();
            }
        }
        
        if(!empty($uploadData)){
            $insert = $this->Disciplinary_model->upload_files($uploadData);

        }
    }

    function update_status()
    {
    	$id = $this->input->post('id');
    	$type_name = $this->input->post('type');
    	$val = $this->input->post('value');

    	if($type_name == 'analysis')
    		$data[$type_name] = $val;
    	if($type_name == 'investigation')
    		$data[$type_name] = $val;
    	if($type_name == 'conclusion')
    		$data[$type_name] = $val;

    	$result = $this->Disciplinary_model->update_status($id, $data);

    	if($result)
    		echo '1';
    	else
    		echo '0';
    }

    function add_comments()
    {
    	$employee_id = $this->session_data['user_id'];

    	$status_id = $this->input->post('status_id');
    	$disciplinary_id = $this->input->post('disciplinary_id');
    	$comments = $this->input->post('comments');
    	$date = date('Y-m-d');

    	if(!empty($_FILES['files']) && $_FILES['files']['size'][0] != 0)
			$this->upload_files($_FILES, $employee_id, $disciplinary_id);


		// $previous_comments = $this->Disciplinary_model->get_max_status($disciplinary_id);
		// $previous_status = $previous_comments->status_id;

		// if($previous_status == NULL)
		// 	$status = 1;
		// else
		// 	$status = $previous_status++;

		$data = array(
					'disciplinary_id' => $disciplinary_id,
					'comment_text' => $comments,
					'added_by' => $employee_id,
					'added_date' => $date,
					'status_id' => $status_id
				);
	
		$res = $this->Disciplinary_model->add_comments($data);


		if($res)
			$this->session->set_flashdata('success', 'Investigation initiated successfully.');
		else
			$this->session->set_flashdata('error', 'Investigation initiated successfully.');


		redirect('Disciplinary/view_detail/'.$disciplinary_id, 'refresh');
    }




}