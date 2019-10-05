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
		$data['reasons'] = $this->db->get_where('investigation_reasons')->result(); 

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

	function previous_inquiries()
	{
		$this->ajax_check();

		$employee_id = $this->input->post('employee_id');
		$inquiries = $this->Investigation_model->get_previous_inquiries($employee_id);

		$this->json_response($inquiries);

	}

	function add_investigation()
	{
		$entry_by = $this->session_data['user_id'];

		if(isset($_POST['submit']))
		{
			$employee_id = $this->input->post('employee_id');
			$designation = $this->input->post('designation_id');
			$department = $this->input->post('department_id');
			$project = $this->input->post('project_id');
			$province = $this->input->post('province_id');

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

			$this->db->select('id');
			$this->db->order_by('id', 'DESC');
			$inv_row = $this->db->get('investigation')->row();
			
			$inv_id = ($inv_row == null) ? 0 : $inv_row->id;
			$next_id = $inv_id + 1;

			$case_no = 'CTC/I-00'. $next_id;
			
			$today = date('Y-m-d');
			
			$data = array(
						'case_no' => $case_no,
						'employee_id' => $employee_id,
						'project_id' => $project,
						'province_id' => $province,
						'department_id' => $department,
						'designation_id' => $designation,
						'reason_id' => $reason,
						'other_reason' => $other_reason,
						'reported_by' => $reported_by,
						'reported_date' => $reported_date,
						'evidence' => $evidence,
						'evidence_date' => $evidence_date,
						'complaint_mode' => $complaint_mode,
						'intensity' => $intensity,
						'title' => $title,
						'description' => $description,
						'status' => 'initiated',
						'entry_by' => $entry_by,
						'entry_at' => $today
					);


			$inv_added = $this->Investigation_model->add_investigation($data);
			$investigation_id = $this->db->insert_id();
			
			if(!empty($_FILES['files']) && $_FILES['files']['size'][0] != 0)
				$this->upload_files($_FILES, $investigation_id, $entry_by);

			
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


	function view($offset="")
	{
		$conditions = [
				'i.project_id' => $this->session_data['project_id'],
				'xe.provience_id' => $this->session_data['province_id']
				];

		if(isset($_GET['search']))
		{
			$caseNo = $this->input->get('case_no');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$project = (int) $this->input->get('project');
			$department = (int) $this->input->get('department');
			$designation = (int) $this->input->get('designation');
			// $action = $this->input->get('action');
			$status = $this->input->get('investigation_status');

			if($caseNo != '')
				$caseNo = '%'.$caseNo.'%';
			
			$conditions['i.case_no LIKE'] = $caseNo;
			$conditions['i.reported_date >='] = $fromDate;
			$conditions['i.reported_date <='] = $toDate;
			$conditions['i.department_id'] = $department;
			$conditions['i.designation_id'] = $designation;
			$conditions['i.status'] = $status;

			if($project != 0)
				$conditions['i.project_id'] = $project;

		}  

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Investigation_model->get_investigations($filtered_conditions)->num_rows();
		$url = 'Investigation/view_internal';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$data['title'] = 'List of Complaints';
		$data['investigation'] = $this->Investigation_model->get_investigations($filtered_conditions, $this->limit, $offset)->result();
		
		$data['project'] = $this->Projects_model->get($this->session_data['project_id']); 

		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['designation'] = $this->Designations_model->get_by_project($this->session_data['project_id']); 

		$data['content'] = $this->load->view('investigation/view', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}


	function detail($investigation_id="")
	{
		$conditions = [
			'di.project_id' => $this->session_data['project_id'],
			'xe.proveince_id' => $this->session_data['province_id'],
			'i.id' => $investigation_id
			];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'View Detail';
		$data['detail'] = $this->Investigation_model->get_investigations($filtered_conditions)->row();
		
		if(empty($data['detail']))
		{
			show_404();
		}
	
		$data['comments'] = $this->Investigation_model->get_comments($investigation_id);
		$data['files'] = $this->Investigation_model->investigation_files($investigation_id)->result();
		
		$data['content'] = $this->load->view('investigation/investigation-detail', $data, TRUE);
		$this->load->view('investigation/_template', $data);
	}


	public function update_checkboxes()
	{
		$this->ajax_check();
		$investigation_id = $this->input->post('id');
		$attribute = $this->input->post('attribute');
		$status = $this->input->post('status');

		$this->db->where('id', $investigation_id);
		$res = $this->db->update('investigation', array($attribute => $status));

		if($res)
			echo '1';
		else
			echo '0';
	}


	public function upload_attachments()
	{
		$employee_id = $this->session_data['user_id'];
		$investigation_id = $this->input->post('investigation_id');

		if(!empty($_FILES['files']) && $_FILES['files']['size'][0] != 0)
		{
			$uploaded = $this->upload_files($_FILES, $investigation_id, $employee_id);

			if($uploaded)
				$this->session->set_flashdata('success', 'Files uploaded successfully.');
			else
				$this->session->set_flashdata('error', 'Files uploading failed.');
				
		} else {
			$this->session->set_flashdata('error', 'There is a problem on server.');
		}

		redirect('Investigation/detail/'.$investigation_id, 'refresh');
	}

	public function add_comments()
	{
		$employee_id = $this->session_data['user_id'];

		$investigation_id = $this->input->post('investigation_id');
    	$status = $this->input->post('status');
    	$comments = $this->input->post('comments');
    	$date = date('Y-m-d H:i:s');

		$data = array(
					'investigation_id' => $investigation_id,
					'comment_text' => $comments,
					'added_by' => $employee_id,
					'added_date' => $date,
					'status' => $status
				);
	
		$res = $this->Investigation_model->add_comments($data);


		if($res)
			$this->session->set_flashdata('success', 'Comments added successfully.');
		else
			$this->session->set_flashdata('error', 'Failed to add comments.');


		redirect('Investigation/detail/'.$investigation_id, 'refresh');
	}


	public function update_investigation_status()
	{
		$employee_id = $this->session_data['user_id'];

		$investigation_id = $this->input->post('investigation_id');
    	$status = $this->input->post('status');
    	$comments = $this->input->post('comments');
    	$added_date = $this->input->post('added_date');
    	$date = date('Y-m-d H:i:s');

    	switch (trim($status)) {
    		case 'initiated':
    			$status = 'in-progress';
    			break;
    		case 'in-progress':
    			$status = 'completed';
    			break;
			case 'completed':
				$status = 'submitted';
			break;
    	}

		$data = array(
					'investigation_id' => $investigation_id,
					'comment_text' => $comments,
					'added_by' => $employee_id,
					'added_date' => $added_date,
					'status' => $status
				);
		
		$res = $this->Investigation_model->add_comments($data);


		if($res)
		{
			$this->Investigation_model->update_status($investigation_id, array('status' => $status));
			$this->session->set_flashdata('success', 'Status updated successfully.');
		}
		else
		{
			$this->session->set_flashdata('error', 'Failed to update status.');
		}


		redirect('Investigation/detail/'.$investigation_id, 'refresh');
	}


	private function upload_files($files, $investigation_id, $uploaded_by)
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
                $uploadData[$i]['investigation_id'] = $investigation_id;
                $uploadData[$i]['uploaded_by'] = $uploaded_by;
            }
            else
            {
            	echo $this->upload->display_errors();
            }
        }
        
        if(!empty($uploadData))
            return $this->Investigation_model->upload($uploadData);
        else
        	return false;        
    }





}