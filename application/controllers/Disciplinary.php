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
            redirect(base_url().'dashboard');

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
						'Disciplinary_model',
						'Province_model',
						'Departments_model',
						'Designations_model',
						'Projects_model'
					));

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->database();
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
		$data['reasons'] = $this->Disciplinary_model->disciplinary_reasons()->result();
		$data['type'] = $this->Disciplinary_model->get_disciplinary_type()->result(); 

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
		$data['reasons'] = $this->Disciplinary_model->disciplinary_reasons()->result();
		$data['type'] = $this->Disciplinary_model->get_disciplinary_type()->result(); 

		$position_filled_against = $this->Disciplinary_model->position_filled_against();
		$transfer_type = $this->Disciplinary_model->transfer_types();

		$province_string = '';
		$position_filled_against_string = '';
		$transfer_type_string = '';

		foreach ($provinces as $p) {
			$province_string .= "'<option value='".$p->id."'>".ucwords($p->name)."</option>";
		}

		foreach ($position_filled_against as $pfa) {
			$position_filled_against_string .= "'<option value='".$pfa->id."'>".ucwords($pfa->name)."</option>";
		}

		foreach ($transfer_type as $tt) {
			$transfer_type_string .= "'<option value='".$tt->id."'>".ucwords($tt->name)."</option>";
		}



		$data['province_string'] = $province_string;
		$data['position_filled_against_string'] = $position_filled_against_string;
		$data['transfer_type_string'] = $transfer_type_string;
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
			
			$evidence = $this->input->post('evidence');
			$evidence_date = $this->input->post('evidence_date');
			$description = $this->input->post('description');

			$complaint_mode = $this->input->post('complaint_mode');
			$intensity = $this->input->post('intensity');
			$subject = $this->input->post('subject');

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

			$today = date('Y-m-d');
			
			$data = array(
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
						'reported_by' => $reported_by,
						'reported_date' => $reported_date,
						'evidence' => $evidence,
						'evidence_date' => $evidence_date,
						'mode' => $complaint_mode,
						'intensity' => $intensity,
						'subject' => $subject,
						'description' => $description,
						'created_by' => $entry_by,
						'created_date' => $today,
						'type_id' => $type_id,
						'salary_hold' => $salary_hold,
						'suspend_from_duty' => $suspend_from_duty,
						'resignation_date' => $resignation_date,
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

			$filtered_data = $this->remove_empty_entries($data);
			
			$inv_added = $this->Disciplinary_model->add($data);
			$disciplinary_id = $this->db->insert_id();
			
			if(!empty($_FILES['files']) && $_FILES['files']['size'][0] != 0)
				$this->upload_files($_FILES, $employee_id, $disciplinary_id);

			
			if($inv_added)
			{
				$this->session->set_flashdata('success', 'Disciplinary initiated successfully.');
				redirect('Disciplinary/employees', 'refresh');
			}
		}
	}


	function update()
	{
		$updated_by = $this->session_data['user_id'];

		if(isset($_POST['submit']))
		{
			$disciplinary_id = $this->input->post('disciplinary_id');
			$employee_id = $this->input->post('employee_id');
			$designation = $this->input->post('designation_id');
			$department = $this->input->post('department_id');
			$project = $this->input->post('project_id');

			$type_id = $this->input->post('type_id');

			$reason = $this->input->post('reason');
			$other_reason = $this->input->post('other_reason');

			$evidence = $this->input->post('evidence');
			$evidence_date = $this->input->post('evidence_date');
			$description = $this->input->post('description');

			$complaint_mode = $this->input->post('complaint_mode');
			$intensity = $this->input->post('intensity');
			$subject = $this->input->post('subject');

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

			$category = $this->input->post('category');

			$province = $this->input->post('province');
			$district = $this->input->post('district');
			$tehsil = $this->input->post('tehsil');
			$uc = $this->input->post('uc');

			$today = date('Y-m-d');
			
			$data = array(
						'project_id' => $project,
						'province_id' => $province,
						'district_id' => $district,
						'tehsil_id' => $tehsil,
						'uc_id' => $uc,
						'department_id' => $department,
						'designation_id' => $designation,
						'reason_id' => $reason,
						'other_reason' => $other_reason,
						'evidence' => $evidence,
						'evidence_date' => $evidence_date,
						'mode' => $complaint_mode,
						'intensity' => $intensity,
						'subject' => $subject,
						'description' => $description,
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
						'transfer_effective_date' => $transfer_effective_date,
						'category_id' => $category
					);

			$updated_data = $this->remove_empty_entries($data);
			
			$rec_update = $this->Disciplinary_model->update($disciplinary_id, $updated_data);

			if($rec_update)
			{
				$this->session->set_flashdata('success', 'Disciplinary updated successfully.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Disciplinary updation failed.');
			}

			redirect('Disciplinary/detail/'.$disciplinary_id, 'refresh');

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
			$employeeID = $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$fromDate = $this->input->get('from_date');
			$toDate = $this->input->get('to_date');
			$project = (int) $this->input->get('project');
			$department = (int) $this->input->get('department');
			$designation = (int) $this->input->get('designation');
			$province = (int) $this->input->get('province');
			
			$status = $this->input->get('status');
			$type = $this->input->get('type');

			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;

			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			$conditions['di.created_date >='] = $fromDate;
			$conditions['di.created_date <='] = $toDate;
			$conditions['di.department_id'] = $department;
			$conditions['di.designation_id'] = $designation;
			$conditions['di.status_id'] = $status;
			$conditions['di.type_id'] = $type;
			$conditions['xe.provience_id'] = $province;

			if($project != 0)
				$conditions['di.project_id'] = $project;

		}  

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Disciplinary_model->disciplinary_actions($filtered_conditions)->num_rows();

		$url = 'Disciplinary/view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		

		$data['title'] = 'Disciplinary Actions';
		$data['disciplinary_actions'] = $this->Disciplinary_model->disciplinary_actions($filtered_conditions, $this->limit, $offset)->result();

		$data['project'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['department'] = $this->Departments_model->get_by_project($this->session_data['project_id']); 
		$data['designation'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['province'] = $this->Province_model->get();

		$data['status'] = $this->Disciplinary_model->disciplinary_status()->result();
		$data['type'] = $this->Disciplinary_model->get_disciplinary_type()->result();

		$data['content'] = $this->load->view('disciplinary/view', $data, TRUE);

		$this->load->view('disciplinary/_template', $data);
	}

	
	function detail($id=FALSE)
	{
		$this->load->model('Terminations_model');

		$conditions = [
			'di.project_id' => $this->session_data['project_id'],
			'xe.proveince_id' => $this->session_data['province_id'],
			'di.id' => $id
			];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'View Detail';
		$data['detail'] = $detail = $this->Disciplinary_model->disciplinary_actions($filtered_conditions)->row();
		
		if(empty($data['detail']))
		{
			show_404();
		}
	
		$data['status_comments'] = $this->Disciplinary_model->get_comments($id, 'status');
		$data['comments'] = $this->Disciplinary_model->get_comments($id, 'comment');
		$data['files'] = $this->Disciplinary_model->disciplinary_files($id)->result(); 

		$data['status'] = $this->Disciplinary_model->disciplinary_status()->result();
		$data['reason_description'] = $this->Disciplinary_model->reason_descriptions($data['detail']->type_id);

		$provinces = $this->Province_model->get($this->session_data['project_id']);
		
		/* Districts */
		$conditions = [
    			'location_job_position.province_id' => $detail->province_id, 
    			'location_job_position.company_id' => $this->session_data['project_id'],
    			'location_job_position.status !=' => '0' 
    		];

    	$filtered_conditions = $this->remove_empty_entries($conditions);
    	$districts = $this->Disciplinary_model->get_districts($filtered_conditions);

    	/* Tehsils */
    	$conditions['location_job_position.district_id'] = $detail->district_id;
    	$filtered_conditions = $this->remove_empty_entries($conditions);
    	$tehsils = $this->Disciplinary_model->get_tehsils($filtered_conditions);

    	/* Union Councils */
    	$conditions['location_job_position.tehsil_id'] = $detail->tehsil_id;
    	$filtered_conditions = $this->remove_empty_entries($conditions);
    	$union_councils = $this->Disciplinary_model->get_union_councils($filtered_conditions);

    	/* Job Positions */
    	$job_positions = $this->Disciplinary_model->job_positions($filtered_conditions);
    	
		$position_filled_against = $this->Disciplinary_model->position_filled_against();
		$transfer_type = $this->Disciplinary_model->transfer_types();

		$disciplinary_types = $this->Disciplinary_model->get_disciplinary_type()->result();
		$reasons = $this->Disciplinary_model->disciplinary_reasons()->result();
		
		$categories = $this->Disciplinary_model->categories();
		
		$previous_disciplinary = NULL;
		if($detail->previous_disciplinary !== NULL)
			$previous_disciplinary = $this->Disciplinary_model->previous_action($detail->previous_disciplinary);

		$previous_type = (!empty($previous_disciplinary)) ? $previous_disciplinary->type_name : '';
		$previous_status = (!empty($previous_disciplinary)) ? $previous_disciplinary->status_text : '';
		$previous_action_status = ($previous_type) ? '<label class="purple-label">'.ucwords($previous_type) .' | '.ucwords($previous_status).'</label>' : '<label class="purple-label">N/A</label>';

		$data['previous_action'] = $previous_action_status;

		$update_data = [
			'detail' => $detail, 
			'provinces' => $provinces, 
			'districts' => $districts,
			'tehsils' => $tehsils,
			'union_councils' => $union_councils,
			'job_positions' => $job_positions,
			'position_filled_against' => $position_filled_against,
			'transfer_type' => $transfer_type,
			'disciplinary_types' => $disciplinary_types,
			'reasons' => $reasons,
			'type' => ucwords($detail->type_name),
			'category' => $categories
		];

		$data['form_fields'] = $this->load->view('disciplinary/update-view', $update_data, TRUE);
		$data['disciplinary_detail'] = $this->load->view('disciplinary/disciplinary-detail', $update_data, TRUE);


		$termination_reasons = $this->Terminations_model->get_termination_reasons();
		$t_reasons = '';
		foreach($termination_reasons AS $tr) {
			$t_reasons .= '<option value="'.$tr->id.'">'.ucwords($tr->reason_text).'</option>';
		}
		$data['termination_reasons'] = $t_reasons;
		$data['content'] = $this->load->view('disciplinary/detail', $data, TRUE);
		$this->load->view('disciplinary/_template', $data);
	}


	public function status_fields()
	{
		$this->ajax_check();

		$status = $this->input->post('status_text');
		$disciplinary_type_name = $this->input->post('type_name');
		$employee_id = $this->input->post('employee_id');

		$type = $this->Disciplinary_model->get_disciplinary_type()->result();
		$status_row = $this->Disciplinary_model->get_status_id($status);
		$status_id = $status_row->id;

		$output = '<input type="hidden" name="status_id" id="status-id" value="'.$status_id.'">';

		$resg_data = '';
		if(strtolower($disciplinary_type_name) == 'resignation')
		{
			$this->db->select('resignation_date, exit_interview_status');
			$resg_data = $this->db->get_where('xin_employee_resignations', array('employee_id' => $employee_id))->row();
		}

		if($status == 'pending' && $resg_data != '')
		{
			$exit_interview_status = ($resg_data->exit_interview_status) ? 'Yes' : 'No';
			$resignation_date = ($resg_data->resignation_date) ? date('d-m-Y', strtotime($resg_data->resignation_date)) : '';
			$output .= '
					<div class="row">
						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Exit Interview</label>
								<input type="text" name="exit_interview" value="'.$exit_interview_status.'" class="form-control" readonly>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Resignation Date</label>
								<input type="text" name="resignation_date" value="'.$resignation_date.'" class="form-control" readonly>
							</div>
						</div>
					</div>
			';
		}
		elseif($status == 'pending' && $resg_data == '')
		{
			$output .= '
				<div class="row">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<label>Action Approval Date</label>
							<input type="text" name="approval_date" class="form-control date" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<label>Approval Receive Date</label>
							<input type="text" name="approval_receive_date" class="form-control date" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<label>Approved By</label>
							<input type="text" name="approved_by" class="form-control" required>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="inputFormMain">
							<label>Approved Action</label>
							<select name="approved_action" class="form-control" required="required">
								<option value="">SELECT ACTION</option>';
	
							foreach($type AS $t) {
								$output .= '<option value="'.$t->id.'">'.ucwords($t->type_name).'</option>';
							}

			$output .= '</select>
						</div>
					</div>
				</div>';
		} 
		elseif($status == 'not received' OR $status == 'unsatisfactory' OR $status == 'admitted')
		{
			$output .= '<div class="row">
							<div class="col-lg-12">
								<div class="inputFormMain">
									<label>Next Action</label>
									<select name="next_action" class="form-control" required="required">
										<option value="">SELECT ACTION</option>';
	
							foreach($type AS $t) {
								$output .= '<option value="'.$t->id.'">'.ucwords($t->type_name).'</option>';
							}

					$output .= '</div>
							</div>
						</div>';
		}

		$this->json_response(array('output' => $output, 'status' => $status));
	}


	private function upload_files($files, $disciplinary_id, $employee_id)
    {
    	$data = array();

        $filesCount = count($_FILES['files']['name']);
        for($i = 0; $i < $filesCount; $i++) {
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
            	 // $this->upload->display_errors();
            	return false;
            }
        }
        
        if(!empty($uploadData)){
            return $this->Disciplinary_model->upload_files($uploadData);

        }
    }


    public function upload_attachments()
	{
		$employee_id = $this->session_data['user_id'];
		$disciplinary_id = $this->input->post('disciplinary_id');

		if(!empty($_FILES['files']) && $_FILES['files']['size'][0] != 0)
		{
			$uploaded = $this->upload_files($_FILES, $disciplinary_id, $employee_id);

			if($uploaded)
				$this->session->set_flashdata('success', 'Files uploaded successfully.');
			else
				$this->session->set_flashdata('error', 'Files uploading failed.'. $this->upload->display_errors());
				
		} else {
			$this->session->set_flashdata('error', 'There is a problem on server.');
		}

		redirect('Disciplinary/detail/'.$disciplinary_id, 'refresh');
	}


    function add_comments()
    {
    	$employee_id = $this->session_data['user_id'];

    	$status_id = $this->input->post('status_id');
    	$disciplinary_id = $this->input->post('disciplinary_id');
    	$comments = $this->input->post('comments');
    	$date = date('Y-m-d H:i:s');

    	if(!empty($_FILES['files']) && $_FILES['files']['size'][0] != 0)
			$this->upload_files($_FILES, $employee_id, $disciplinary_id);

		$data = array(
					'disciplinary_id' => $disciplinary_id,
					'comment_text' => $comments,
					'added_by' => $employee_id,
					'added_date' => $date,
					'status_id' => $status_id,
					'type' => 'comment'
				);
	
		$res = $this->Disciplinary_model->add_comments($data);


		if($res)
			$this->session->set_flashdata('success', 'Comments added successfully.');
		else
			$this->session->set_flashdata('error', 'Server error.');


		redirect('Disciplinary/detail/'.$disciplinary_id, 'refresh');
    }


    function update_disciplinary_status()
    {
    	$employee_id = $this->session_data['user_id'];

    	$status_id = $this->input->post('status_id');
    	$disciplinary_id = $this->input->post('disciplinary_id');
    	$comments = $this->input->post('comments');
    	$date = $this->input->post('added_date');

    	$next_action = $this->input->post('next_action');

    	$data = array(
					'disciplinary_id' => $disciplinary_id,
					'comment_text' => $comments,
					'added_by' => $employee_id,
					'added_date' => $date,
					'status_id' => $status_id,
					'type' => 'status'
				);

		$res = $this->Disciplinary_model->add_comments($data);

		/** Action Approval **/
		$action_approval_date = $this->input->post('approval_date');
    	$approval_receive_date = $this->input->post('approval_receive_date');
    	$approved_by = $this->input->post('approved_by');
    	$approved_action = $this->input->post('approved_action');

    	$approval_data = array(
    				'action_approval_date' => $action_approval_date,
    				'approval_receive_date' => $approval_receive_date,
    				'approved_by' => $approved_by,
    				'approved_action' => $approved_action,
    				'status_id' => $status_id
    			);

    	if($action_approval_date != '')
			$update = $this->Disciplinary_model->update($disciplinary_id, $approval_data);
		else
			$update = $this->Disciplinary_model->update($disciplinary_id, array('status_id' => $status_id));

		if($update)
		{
			if($next_action != '')
				$this->next_disciplinary_action($disciplinary_id, $next_action, $comments);
			$this->session->set_flashdata('success', 'Status updated successfully.');
		}
		else
		{
			$this->session->set_flashdata('error', 'Status updation failed.');
		}


		redirect('Disciplinary/detail/'.$disciplinary_id, 'refresh');
    }


    private function next_disciplinary_action($disciplinary_id, $next_action, $comments)
    {
    	$disciplinary = $this->db->get_where('disciplinary', array('disciplinary.id' => $disciplinary_id))->row();
 
    	$created_by = $this->session_data['user_id'];
    	$created_date = date('Y-m-d');

    	$data = array(
    				'employee_id' => $disciplinary->employee_id,
    				'project_id' => $disciplinary->project_id,
    				'designation_id' => $disciplinary->designation_id,
    				'department_id' => $disciplinary->department_id,
    				'reason_id' => $disciplinary->reason_id,
    				'other_reason' => $disciplinary->other_reason,
    				'subject' => $disciplinary->subject,
    				'description' => $comments,
    				'type_id' => $next_action,
    				'status_id' => '1',
    				'reported_by' => $disciplinary->reported_by,
    				'reported_date' => $disciplinary->reported_date,
    				'category_id' => $disciplinary->category_id,
    				'created_by' => $created_by,
    				'created_date' => $created_date,
    				'previous_disciplinary' => $disciplinary_id
    			);

    	return $this->Disciplinary_model->add($data);
    }

 
    function load_template()
    {
    	$this->ajax_check();

    	$type_id = $this->input->post('type_id');
    	$disciplinary_id = $this->input->post('disciplinary_id');

    	$data = $this->Disciplinary_model->get_template($type_id);
    	$detail = $this->Disciplinary_model->disciplinary_actions(array('di.id' => $disciplinary_id))->row();
    	
    	$name = ucwords($detail->emp_name);
    	$title = $detail->job_title;
    	$cnic = $detail->cnic;
    	$letter_no = ($detail->letter_no) ? $detail->letter_no : $this->generate_letter_no($disciplinary_id);
    	$reporting_date = $detail->reported_date;

    	$title = str_replace('—', '-', $title);
    	$title_array = explode('-', $title);
    	$month_year = date('M, Y');
    	$current_date = date('d-m-Y');

    	$user_row = $this->Disciplinary_model->get_employee_name($this->session_data['user_id']);
    	$employee_name = ucwords($user_row->employee_name);
    	$empName = explode(' ', $employee_name);
    	$initials = '';

    	foreach ($empName as $n) {
    		$initials .= $n[0];
    	}
    	
    	$template = '';
    	if(!empty($title_array[0]))
    	{
	    	$short_title = $title_array[1];
	    	$province = ucwords($title_array[2]);
	    	$district = ucwords($title_array[3]);
	    	$tehsil = ucwords($title_array[4]);
	    	$uc = ucwords($title_array[5]);

	    	$imgName = $this->Disciplinary_model->get_employee_signature($this->session_data['user_id'])->image_name;
	    	
	    	$image_path = base_url().'uploads/signatures/'.$imgName;

	    	$template = $data->description;
	    	$template = str_replace('[[name]]', $name, $template);
	    	$template = str_replace('[[initial]]', strtoupper($initials), $template);
	    	
	    	$template = str_replace('[[signature_disciplinary_name]]', $employee_name, $template);
	    	$template = str_replace('[[signature_disciplinary]]', '<img src="'.$image_path.'" />', $template);
	    	$template = str_replace('[[current_month_year]]', $month_year, $template);
	    	$template = str_replace('[[current_date]]', $current_date, $template);
	    	$template = str_replace('[[title]]', $title, $template);
	    	$template = str_replace('[[job_type_long_desc]]', $title, $template);
	    	$template = str_replace('[[job_type_short]]', $short_title, $template);
	    	$template = str_replace('[[reporting_date]]', $reporting_date, $template);

	    	$template = str_replace('[[cnic]]', $cnic, $template);
	    	$template = str_replace('[[letter_no]]', $letter_no, $template);

	    	$template = str_replace('[[province]]', $province, $template);
	    	$template = str_replace('[[district]]', $district, $template);
	    	$template = str_replace('[[tehsil]]', $tehsil, $template);
	    	$template = str_replace('[[uc]]', $uc, $template);
    	}

    	$this->json_response($template);
    }


    function districts($province_id)
    {
    	$conditions = [
    			'location_job_position.province_id' => $province_id, 
    			'location_job_position.company_id' => $this->session_data['project_id'],
    			'location_job_position.status !=' => '0' 
    		];

    	$filtered_conditions = $this->remove_empty_entries($conditions);
    	$job_positions = $this->Disciplinary_model->job_positions($filtered_conditions);
    	$districts = $this->Disciplinary_model->get_districts($filtered_conditions);
    	
    	$this->json_response(array('districts' => $districts, 'job_positions' => $job_positions));

    }

    function tehsils($district_id)
    {
    	$conditions = [
    			'location_job_position.district_id' => $district_id, 
    			'location_job_position.company_id' => $this->session_data['project_id'],
    			'location_job_position.status !=' => '0' 
    		];

    	$filtered_conditions = $this->remove_empty_entries($conditions);
    	$job_positions = $this->Disciplinary_model->job_positions($filtered_conditions);
    	$tehsils = $this->Disciplinary_model->get_tehsils($filtered_conditions);
    	
    	$this->json_response(array('tehsils' => $tehsils, 'job_positions' => $job_positions));

    }

    function union_councils($tehsil_id)
    {
    	$conditions = [
    			'location_job_position.tehsil_id' => $tehsil_id, 
    			'location_job_position.company_id' => $this->session_data['project_id'],
    			'location_job_position.status !=' => '0' 
    		];

    	$filtered_conditions = $this->remove_empty_entries($conditions);
    	$job_positions = $this->Disciplinary_model->job_positions($filtered_conditions);
    	$ucs = $this->Disciplinary_model->get_union_councils($filtered_conditions);
    	
    	$this->json_response(array('ucs' => $ucs, 'job_positions' => $job_positions));

    }

    function add_reason_description()
    {
    	$disciplinary_id = $this->input->post('disciplinary_id');
    	$reason_description_id = $this->input->post('disciplinary_reason_desc');
    	$data = array('reason_desc_id' => $reason_description_id);

    	$updated = $this->Disciplinary_model->update($disciplinary_id, $data);
    	if($updated)
		{
			$this->session->set_flashdata('success', 'Reason Description added successfully.');
		}
		else
		{
			$this->session->set_flashdata('error', 'Reason Description insertion failed.');
		}


		redirect('Disciplinary/detail/'.$disciplinary_id, 'refresh');

    }

    function save_template()
    {
    	$disciplinary_id = $this->input->post('disciplinary_id');
    	$template_content = $this->input->post('template_content');

  		$letter_no = $this->generate_letter_no($disciplinary_id);
    	$data = array('template_content' => $template_content, 'letter_no' => $letter_no);
    	$updated = $this->Disciplinary_model->update($disciplinary_id, $data);

    	if($updated)
    		echo '1';
    	else
    		echo '0';
    }

    private function generate_letter_no($disciplinary_id)
    {
    	$this->db->select('dt.type_name, p.name AS province_name, dc.name AS category_name');
    	$this->db->join('xin_employees xe', 'd.employee_id = xe.employee_id', 'left');
    	$this->db->join('provinces p', 'xe.provience_id = p.id', 'left');
    	$this->db->join('disciplinary_type dt', 'd.type_id = dt.id', 'left');
    	$this->db->join('disciplinary_category dc', 'd.category_id = dc.id', 'left');
    	$res = $this->db->get_where('disciplinary d', array('d.id' => $disciplinary_id))->row();

    	$type_name = $res->type_name;
    	$string_array = explode(' ', $type_name);
    	$acronym = '';

    	foreach ($string_array as $s) {
    		$acronym .= $s[0];
    	}

    	$category = (ucfirst(substr($res->category_name, 0, 1))) ? ucfirst(substr($res->category_name, 0, 1)) : 'N';
    	$letter_no = strtoupper($acronym) . 'L-' . $res->province_name . '-' . $disciplinary_id . '/' . date('M') . '/' . $category;
    	
    	return $letter_no;
    }


    function form_fields()
    {
    	$this->ajax_check();
    	$type = $this->input->post('type');

    	$output = '';
    	$provinces_string = '';
		$position_filled_against_string = '';
		$transfer_type_string = '';

		$provinces = $this->Province_model->get($this->session_data['project_id']);
		$position_filled_against = $this->Disciplinary_model->position_filled_against();
		$transfer_type = $this->Disciplinary_model->transfer_types();

		foreach ($provinces as $p) {
			$selected = '';
			$provinces_string .= "'<option value='".$p->id."' ".$selected.">".ucwords($p->name)."</option>";
		}

		foreach ($position_filled_against as $pfa) {
			$selected = '';
			$position_filled_against_string .= "'<option value='".$pfa->id."' ".$selected.">".ucwords($pfa->name)."</option>";
		}

		foreach ($transfer_type as $tt) {
			$selected = '';
			$transfer_type_string .= "'<option value='".$tt->id."' ".$selected.">".ucwords($tt->name)."</option>";
		}


    	if($type == 'Warning' || $type == 'Final Warning' || $type == 'Explanation' || $type == 'Suspension' || $type == 'Query')
		{
			$output .= '<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence</label>
									<select name="evidence" id="evidence" class="form-control" required>
										<option value="">SELECT EVIDENCE</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence Date</label>
									<input type="text" name="evidence_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SALARY HOLD</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>';
		}
		elseif($type == 'Show Cause') {
			$output .= '<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence</label>
									<select name="evidence" id="evidence" class="form-control" required="required">
										<option value="">SELECT EVIDENCE</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence Date</label>
									<input type="text" name="evidence_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SALARY HOLD</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Suspende from Duty</label>
									<select name="suspend_from_duty" id="suspend" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>';
		} elseif($type == 'Resign') {
			$output .= '<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence</label>
									<select name="evidence" id="evidence" class="form-control" required="required">
										<option value="">SELECT EVIDENCE</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence Date</label>
									<input type="text" name="evidence_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SALARY HOLD</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Suspende from Duty</label>
									<select name="suspend_from_duty" id="suspend" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>';
		} elseif($type == 'Contract Closure') {
			$output .= '<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Issue Reporting Date</label>
									<input type="text" name="issue_reporting_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Last Working Date</label>
									<input type="text" name="last_working_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Position Abolish</label>
									<select name="position_abolish" id="position_abolish" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Abolish Date</label>
									<input type="text" name="abolish_date" class="form-control date">
								</div>
							</div>';
		} elseif($type == 'Refusal') {
			$output .= '<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Issue Reporting Date</label>
									<input type="text" name="issue_reporting_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary" id="salary" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Last Working Date</label>
									<input type="text" name="last_working_date" class="form-control date">
								</div>
							</div>';
		} elseif($type == 'Transfer') {
			$output .= '<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Transfer Type</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										'.$transfer_type_string.'
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Position Abolish</label>
									<select name="position_abolish" id="position_abolish" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Abolish Date</label>
									<input type="text" name="abolish_date" class="form-control date">
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Reporting Date To CTC</label>
									<input type="text" name="reported_date_ctc" class="form-control date">
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Province</label>
									<select name="province" id="province" class="form-control province" required="required">
										<option value="">SELECT OPTION</option>
										'.$provinces_string.'
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>District</label>
									<select name="district" id="district" class="form-control district" required="required">
										<option value="">SELECT OPTION</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Tehsil</label>
									<select name="tehsil" id="tehsil" class="form-control tehsil" required="required">
										<option value="">SELECT OPTION</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>UC</label>
									<select name="uc" id="uc" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Position Filled Against</label>
									<select name="position_filled_against" id="position_filled_against" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										'.$position_filled_against_string.'
									</select>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>New Job Position</label>
									<select name="job_position" id="job_position" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
									</select>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Transfer Effective Date</label>
									<input type="text" name="transfer_effective_date" class="form-control date">
								</div>
							</div>';
		}

		echo $output;
    }

    private function format_date($date="")
    {
    	if($date != NULL OR $date != "")
    		return date('d-m-Y', strtotime($date));
    	else
    		return false;
    }

    private function replace_null($string="")
    {
    	if($string != NULL OR $string != "")
    		return ucwords($string);
    	else
    		return 'N/A';
    }

    public function report($disciplinary_id=FALSE)
    {
    	if($disciplinary_id === FALSE)
    		show_404();

    	/* Employee Info */
    	$this->db->select('employee_id');
    	$this->db->where('id', $disciplinary_id);
    	$result = $this->db->get('disciplinary')->row();
    	$employee_id = $result->employee_id;

    	$employee_info = $this->Disciplinary_model->employee_info(array('xe.employee_id' => $employee_id))->row();

    	if(empty($employee_info))
    		show_404();

    	$job_title = explode('-', $employee_info->job_title);

    	$project = (isset($job_title[0])) ? ucwords($job_title[0]) : '';
    	$province = (isset($job_title[1])) ? ucwords($job_title[1]) : '';
    	$district = (isset($job_title[2])) ? ucwords($job_title[2]) : '';
    	$tehsil = (isset($job_title[3])) ? ucwords($job_title[3]) : '';
    	$uc = (isset($job_title[4])) ? ucwords($job_title[4]) : '';


    	/* Disciplinary Detail */
    	$conditions = [
    		'xe.company_id' => $this->session_data['project_id'],
    		'xe.provience_id' => $this->session_data['province_id'],
    	];

    	$conditions['di.id'] = $disciplinary_id;
    	$filtered_conditions = $this->remove_empty_entries($conditions);

    	$disciplinary = $this->Disciplinary_model->disciplinary_actions($filtered_conditions)->row();
    	$status_comments = $this->Disciplinary_model->get_comments($disciplinary_id, 'status');


    	$suspend_from_duty = ($disciplinary->suspend_from_duty) ? 'Yes' : 'No';
    	$salary_hold = ($disciplinary->salary_hold) ? 'Yes' : 'No';
    	$position_abolish = ($disciplinary->position_abolish) ? 'Yes' : 'No';

    	/* PDF */
    	$this->load->library('Pdf');
    	$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    	$pdf->SetTitle('Disciplinary Action Detail');

    	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetPrintHeader(false);

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		$pdf->SetFont('times', '', 10);

		$pdf->AddPage();
		$pdf->setCellPaddings(1, 1, 1, 1);
		$pdf->setCellMargins(1, 1, 1, 1);
		$pdf->SetFillColor(255, 255, 127);


    	$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">';
    	$heading .= '<br>';
    	$heading .= '<strong style="font-size: 16px;">Chip Training &amp; Consulting</strong><br>';
    	$heading .= '<strong style="font-size: 14px;">Disciplinary Action Detail</strong>';
    	
    	$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);

    	$employee_detail = '<h3 style="font-family:helvitica;">Employee Basic Info</h3>';
    	$employee_detail .= '<table border="0px" style="padding: 5px;">
			<tbody>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Employee ID</td>
					<td style="width: 28%; font-family: helvitica;">'.$employee_info->employee_id.'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Employee Name</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($employee_info->emp_name).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">CNIC</td>
					<td style="width: 28%; font-family: helvitica;">'.$employee_info->cnic.'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Personal Contact</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($employee_info->personal_contact).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">CTC Contact</td>
					<td style="width: 28%; font-family: helvitica;">'.$employee_info->contact_number.'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Other Contact</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($employee_info->contact_other).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">DOB</td>
					<td style="width: 28%; font-family: helvitica;">'.$this->format_date($employee_info->date_of_birth).'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Other Contact</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($employee_info->contact_other).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-fmaily: helvitica; font-weight: bold;">Project</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($employee_info->company_name).'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Department</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($employee_info->department_name).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-fmaily: helvitica; font-weight: bold;">Designation</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($employee_info->designation_name).'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Province</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($province).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">District</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($district).'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Tehsil</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($tehsil).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Union Council</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($uc).'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;"></td>
					<td style="width: 28%; font-family: helvitica;"></td>
				</tr>
				
			</tbody>
		</table>
    		';

    	$disciplinary_detail = '<h3 style="font-family: helvitica;">Disciplinary Action</h3>';
    	$disciplinary_detail .= '<table border="0px" style="padding: 5px">
			<tbody>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Disciplinary Type</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($disciplinary->type_name).'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Status</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($disciplinary->status_text).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Reason</td>
					<td style="width: 28%; font-family: helvitica;">'.$disciplinary->reason_text.'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Other Reason</td>
					<td style="width: 28%; font-family: helvitica;">'.$disciplinary->other_reason.'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Suspended</td>
					<td style="width: 28%; font-family: helvitica;">'.$suspend_from_duty.'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Salary Hold</td>
					<td style="width: 28%; font-family: helvitica;">'.$salary_hold.'</td>
				</tr>

				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Position Abolish</td>
					<td style="width: 28%; font-family: helvitica;">'.$position_abolish.'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Abolish Date</td>
					<td style="width: 28%; font-family: helvitica;">'.$this->format_date($disciplinary->abolish_date).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Position Abolish</td>
					<td style="width: 28%; font-family: helvitica;">'.$position_abolish.'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Abolish Date</td>
					<td style="width: 28%; font-family: helvitica;">'.$this->format_date($disciplinary->abolish_date).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Approved By</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($disciplinary->approved_by).'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Action Approval Date</td>
					<td style="width: 28%; font-family: helvitica;">'.$this->format_date($disciplinary->action_approval_date).'</td>
				</tr>
				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Approval Receive Date</td>
					<td style="width: 28%; font-family: helvitica;">'.$this->format_date($disciplinary->approval_receive_date).'</td>
				</tr>

				<tr>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Reported By</td>
					<td style="width: 28%; font-family: helvitica;">'.ucwords($disciplinary->reported_by).'</td>
					<td style="width: 22%; font-family: helvitica; font-weight: bold;">Reported Date</td>
					<td style="width: 28%; font-family: helvitica;">'.$this->format_date($disciplinary->reported_date).'</td>
				</tr>

			</tbody>
    	</table>
    	';

    	$status_rows = '';
    	foreach ($status_comments as $comment) {
    		$status_rows .= '<tr>
					<td style="width: 15%; font-family: helvitica;"><strong>'.ucwords($comment->status_text).'</strong></td>
					<td style="width: 50%; font-family: helvitica;">'.$comment->comment_text.'</td>
					<td style="width: 20%; font-family: helvitica;">'.ucwords($comment->emp_name).'</td>
					<td style="width: 15%; font-family: helvitica;">'.$this->format_date($comment->added_date).'</td>
				</tr>';
    	}

    	$status_comments = '<h3 style="font-family: helvitica;">Status History</h3>';
    	$status_comments .= '<table border="1px" style="padding: 5px;">
			<tbody>
				<tr>
					<td style="width: 15%; font-family: helvitica;"><strong>Open</strong></td>
					<td style="width: 50%; font-family: helvitica;">'.$disciplinary->description.'</td>
					<td style="width: 20%; font-family: helvitica;">'.ucwords($disciplinary->created_by).'</td>
					<td style="width: 15%; font-family: helvitica;">'.$this->format_date($disciplinary->created_date).'</td>
				</tr>
				'.$status_rows.'
			</tbody>
    	</table>';

    	$pdf->WriteHTMLCell(0, 0, '', '', $employee_detail, 0, 1, 0, true, '', true);
    	$pdf->WriteHTMLCell(0, 0, '', '', $disciplinary_detail, 0, 1, 0, true, '', true);
    	$pdf->WriteHTMLCell(0, 0, '', '', $status_comments, 0, 1, 0, true, '', true);
    	ob_clean();
    	$pdf->Output('Report.pdf', 'I');

    }


    function reportXLS()
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
		$disciplinary = $this->Disciplinary_model->disciplinary_actions($filtered_conditions)->result();

		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		$sheet = $objPHPExcel->getActiveSheet();

		$range = range('A', 'Z');
		array_push($range, 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

		foreach ($range as $columnID) {
			$sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}

		$sheet->getStyle('A1:AZ1')->getFont()->setBold(true);

		$sheet->SetCellValue('A1', 'Employee ID');
		$sheet->SetCellValue('B1', 'Name');
		$sheet->SetCellValue('C1', 'Father Name');
		$sheet->SetCellValue('D1', 'Personal No');
		$sheet->SetCellValue('E1', 'Contact No');
		$sheet->SetCellValue('F1', 'CTC Contact');
		$sheet->SetCellValue('G1', 'Date of Birth');
		$sheet->SetCellValue('H1', 'CNIC');
		$sheet->SetCellValue('I1', 'Job Title');
		$sheet->SetCellValue('J1', 'Project');
		$sheet->SetCellValue('K1', 'Department');
		$sheet->SetCellValue('L1', 'Designation');
		$sheet->SetCellValue('M1', 'Province');
		$sheet->SetCellValue('N1', 'District');
		$sheet->SetCellValue('O1', 'Tehsil');
		$sheet->SetCellValue('P1', 'Union Council');
		$sheet->SetCellValue('Q1', 'Type');
		$sheet->SetCellValue('R1', 'Status');
		$sheet->SetCellValue('S1', 'Reported By');
		$sheet->SetCellValue('T1', 'Reported Date');
		$sheet->SetCellValue('U1', 'Repoted Date CTC');
		$sheet->SetCellValue('V1', 'Created By');
		$sheet->SetCellValue('W1', 'Created Date');
		$sheet->SetCellValue('X1', 'Reason');
		$sheet->SetCellValue('Y1', 'Other Reason');
		$sheet->SetCellValue('Z1', 'Subject');
		$sheet->SetCellValue('AA1', 'Description');
		$sheet->SetCellValue('AB1', 'Evidence');
		$sheet->SetCellValue('AC1', 'Evidence Date');
		$sheet->SetCellValue('AD1', 'Mode');
		$sheet->SetCellValue('AE1', 'Intensity');
		$sheet->SetCellValue('AF1', 'Salary Hold');
		$sheet->SetCellValue('AG1', 'Salary Deduction Days');
		$sheet->SetCellValue('AH1', 'Salary Deduction Month');
		$sheet->SetCellValue('AI1', 'Issue Reporting Date');
		$sheet->SetCellValue('AJ1', 'Suspend from Duty');
		$sheet->SetCellValue('AK1', 'Resignation Date');
		$sheet->SetCellValue('AL1', 'Prior Notice');
		$sheet->SetCellValue('AM1', 'Last Working Date');
		$sheet->SetCellValue('AN1', 'Transfer Type');
		$sheet->SetCellValue('AO1', 'Position Aboish');
		$sheet->SetCellValue('AP1', 'Abolish Date');
		$sheet->SetCellValue('AQ1', 'Position Filled Against');
		$sheet->SetCellValue('AR1', 'Transfer Effective Date');
		$sheet->SetCellValue('AS1', 'Action Approval Date');
		$sheet->SetCellValue('AT1', 'Approval Receive Date');
		$sheet->SetCellValue('AU1', 'Approved By');
		$sheet->SetCellValue('AV1', 'Approved Action');
		$sheet->SetCellValue('AW1', 'Issue Date');
		$sheet->SetCellValue('AX1', 'Delivered Date');
		$sheet->SetCellValue('AY1', 'Letter No');
		$sheet->SetCellValue('AZ1', 'Security Deposit Paid');


		$rowCount = 2;
		foreach ($disciplinary as $element) {
			$sheet->SetCellValue('A' . $rowCount, $element->employee_id);
			$sheet->SetCellValue('B' . $rowCount, ucwords($element->emp_name));
			$sheet->SetCellValue('C' . $rowCount, ucwords($element->father_name));
			$sheet->SetCellValue('D' . $rowCount, $element->personal_contact);
			$sheet->SetCellValue('E' . $rowCount, $element->contact_number);
			$sheet->SetCellValue('F' . $rowCount, $element->contact_other);
			$sheet->SetCellValue('G' . $rowCount, ($element->date_of_birth) ? date('d-m-Y', strtotime($element->date_of_birth)) : '');
			$sheet->SetCellValue('H' . $rowCount, $element->cnic);
			$sheet->SetCellValue('I' . $rowCount, $element->job_title);
			$sheet->SetCellValue('J' . $rowCount, $element->project_name);
			$sheet->SetCellValue('K' . $rowCount, $element->department_name);
			$sheet->SetCellValue('L' . $rowCount, $element->designation_name);
			$sheet->SetCellValue('M' . $rowCount, $element->province_id);
			$sheet->SetCellValue('N' . $rowCount, $element->district_id);
			$sheet->SetCellValue('O' . $rowCount, $element->tehsil_id);
			$sheet->SetCellValue('P' . $rowCount, $element->uc_id);
			$sheet->SetCellValue('Q' . $rowCount, ucwords($element->type_name));
			$sheet->SetCellValue('R' . $rowCount, ucwords($element->status_text));
			$sheet->SetCellValue('S' . $rowCount, $element->reported_by);
			$sheet->SetCellValue('T' . $rowCount, ($element->reported_date) ? date('d-m-Y', strtotime($element->reported_date)) : '');
			$sheet->SetCellValue('U' . $rowCount, ($element->reported_date_ctc) ? date('d-m-Y', strtotime($element->reported_date_ctc)) : '');
			$sheet->SetCellValue('V' . $rowCount, ucwords($element->created_by_name));
			$sheet->SetCellValue('W' . $rowCount, ($element->created_date) ? date('d-m-Y', strtotime($element->created_date)) : '');
			$sheet->SetCellValue('X' . $rowCount, ucwords($element->reason_text));
			$sheet->SetCellValue('Y' . $rowCount, $element->other_reason);
			$sheet->SetCellValue('Z' . $rowCount, $element->subject);
			$sheet->SetCellValue('AA' . $rowCount, $element->description);
			$sheet->SetCellValue('AB' . $rowCount, ($element->evidence) ? 'Yes' : 'No');
			$sheet->SetCellValue('AC' . $rowCount, ($element->evidence_date) ? date('d-m-Y', strtotime($element->evidence_date)) : '');
			$sheet->SetCellValue('AD' . $rowCount, ($element->mode) ? 'Yes' : 'No');
			$sheet->SetCellValue('AE' . $rowCount, $element->intensity);
			$sheet->SetCellValue('AF' . $rowCount, ($element->salary_hold) ? 'Yes' : 'No');
			$sheet->SetCellValue('AG' . $rowCount, $element->salary_deduction_days);
			$sheet->SetCellValue('AH' . $rowCount, $element->salary_deduction_month);
			$sheet->SetCellValue('AI' . $rowCount, ($element->issue_reporting_date) ? date('d-m-Y', strtotime($element->issue_reporting_date)) : '');
			$sheet->SetCellValue('AJ' . $rowCount, ($element->suspend_from_duty) ? 'Yes' : 'No');
			$sheet->SetCellValue('AK' . $rowCount, ($element->resignation_date) ? date('d-m-Y', strtotime($element->resignation_date)) : '');
			$sheet->SetCellValue('AL' . $rowCount, ($element->prior_notice) ? 'Yes' : 'No');
			$sheet->SetCellValue('AM' . $rowCount, ($element->last_working_date) ? date('d-m-Y', strtotime($element->last_working_date)) : '');
			$sheet->SetCellValue('AN' . $rowCount, $element->transfer_type);
			$sheet->SetCellValue('AO' . $rowCount, $element->position_abolish);
			$sheet->SetCellValue('AP' . $rowCount, ($element->abolish_date) ? date('d-m-Y', strtotime($element->abolish_date)) : '');
			$sheet->SetCellValue('AQ' . $rowCount, $element->position_filled_against);
			$sheet->SetCellValue('AR' . $rowCount, ($element->transfer_effective_date) ? date('d-m-Y', strtotime($element->transfer_effective_date)) : '');
			$sheet->SetCellValue('AS' . $rowCount, ($element->action_approval_date) ? date('d-m-Y', strtotime($element->action_approval_date)) : '');
			$sheet->SetCellValue('AT' . $rowCount, ($element->approval_receive_date) ? date('d-m-Y', strtotime($element->approval_receive_date)) : '');
			$sheet->SetCellValue('AU' . $rowCount, ($element->approved_by));
			$sheet->SetCellValue('AV' . $rowCount, $element->approved_action);
			$sheet->SetCellValue('AW' . $rowCount, ($element->issued_date) ? date('d-m-Y', strtotime($element->issued_date)) : '');
			$sheet->SetCellValue('AX' . $rowCount, ($element->delivered_date) ? date('d-m-Y', strtotime($element->delivered_date)) : '');
			$sheet->SetCellValue('AY' . $rowCount, $element->letter_no);
			$sheet->SetCellValue('AZ' . $rowCount, $element->security_deposit_paid);

			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="disciplinary_report.xlsx"');
		$objWriter->save('php://output');
    }


    function cron_disciplinary()
    {
    	if(!$this->input->is_cli_request())
    		show_404();

    	$date = date('Y-m-d');
    	$this->db->select('d.employee_id');
    	$this->db->join('disciplinary_status ds', 'd.status_id = ds.id', 'left');
    	$this->db->where(array('ds.status_text' => 'issued', 'd.last_working_date' => $date));
    	$result = $this->db->get('disciplinary d')->result();
    	
    	foreach ($result as $r) {
    		$this->db->where('employee_id', $r->employee_id);
    		$this->db->update('xin_employees xe', array('status' => '9', 'is_active' => '0'));
    	}

    }


}