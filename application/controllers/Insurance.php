<?php 

/**
 * 
 */
class Insurance extends MY_Controller
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
							'Insurance_model',
							'Reports_model',
							'Province_model',
							'Departments_model',
							'Designations_model',
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


	public function dashboard()
	{
		$data['title'] = 'Insurance Dashboard';

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'i.status' => 'pending',
					'xe.status' => '1'
				];

		$data['insurances'] = $this->Insurance_model->get_pending_insurances($this->remove_empty_entries($conditions), 5, "")->result();

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ic.status' => 'pending'
				];

		$data['pending'] = $this->Insurance_model->get_insurance_claims($this->remove_empty_entries($conditions), 5, "")->result();

		$conditions['ic.status'] = 'inprogress';
		$data['inprogress'] = $this->Insurance_model->get_insurance_claims($this->remove_empty_entries($conditions), 5, "")->result();

		$conditions['ic.status'] = 'completed';
		$data['completed'] = $this->Insurance_model->get_insurance_claims($this->remove_empty_entries($conditions), 5, "")->result();

		$data['content'] = $this->load->view('insurance/dashboard', $data, TRUE);
		$this->load->view('insurance/_template', $data);
	}


	public function list_employees()
	{
		$this->load->library('pagination');

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.status' => '1'
				];

		$data['query_string'] = $_SERVER['QUERY_STRING'];

		if(isset($_GET))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			$designation = (int) $this->input->get('designation');
			$project = (int) $this->input->get('project');
			$status = $this->input->get('status');
			$employee_status = $this->input->get('employee_status');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;
			if($project != 0)
				$conditions['xe.company_id'] = $project;
			$conditions['xe.designation_id'] = $designation;

			if($employee_status != "")
			{
				$conditions['xe.status'] = $employee_status;
			}

			$conditions['i.status'] = $status;
			
		} 

		$filtered_conditions = $this->remove_empty_entries($conditions);

		/* Pagination */
		
		$total_rows = $this->Insurance_model->get_employees($filtered_conditions)->num_rows();
		$url = 'Insurance/list_employees';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url, TRUE);
		/* end pagination */

		$offset = $this->input->get('page');
		$data['title'] = 'Employees Insurance List';
		$data['employees'] = $this->Insurance_model->get_employees($filtered_conditions, $this->limit, $offset)->result();
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['content'] = $this->load->view('insurance/index', $data, TRUE);
		$this->load->view('insurance/_template', $data);
	}


	public function view_claims($offset="")
	{
		$this->load->library('pagination');

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id']
				];

		$data['query_string'] = $_SERVER['QUERY_STRING'];

		if(isset($_GET))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			$designation = (int) $this->input->get('designation');
			$project = (int) $this->input->get('project');
			$status = $this->input->get('status');
			$employee_status = $this->input->get('employee_status');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;
			if($project != 0)
				$conditions['xe.company_id'] = $project;
			$conditions['xe.designation_id'] = $designation;

			if($employee_status != "")
			{
				$conditions['xe.status'] = $employee_status;
			}

			$conditions['ic.status'] = $status;
			
		} 

		$filtered_conditions = $this->remove_empty_entries($conditions);

		/* Pagination */

		$total_rows = $this->Insurance_model->get_insurance_claims($filtered_conditions)->num_rows();
		$url = 'Insurance/view_claims';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url, TRUE);
		/* end pagination */

		$data['title'] = 'Insurance Claims';
		$data['insurance_claims'] = $this->Insurance_model->get_insurance_claims($filtered_conditions, $this->limit, $offset)->result();
		
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);

		$data['content'] = $this->load->view('insurance/claims', $data, TRUE);
		$this->load->view('insurance/_template', $data);
	}

	public function claim_detail($claim_id = FALSE)
	{

		if($claim_id != FALSE) {
			$data['title'] = 'Employee Insurance Claim';

			$conditions = [
						'xe.company_id' => $this->session_data['project_id'],
						'xe.provience_id' => $this->session_data['province_id'],
						'ic.id' => $claim_id
						];

			$filtered_conditions = $this->remove_empty_entries($conditions);

			$data['detail'] = $this->Insurance_model->get_insurance_claim_detail($filtered_conditions)->row();
			if(empty($data['detail']))
				show_404();

			$data['files'] = $this->Insurance_model->get_insurance_files($claim_id)->result();

			$data['file_checklist'] = $this->Insurance_model->get_files_checklist($claim_id);
		
			$data['content'] = $this->load->view('insurance/claim-detail', $data, TRUE);
			$this->load->view('insurance/_template', $data);
		}
		else
		{
			show_404();
		}
		
	}

	public function add_claim()
	{
		$entry_by = $this->session_data['user_id'];
		if(isset($_POST))
		{
			$employee_id = $this->input->post('employee_id');
			$employee_name = $this->input->post('employee_name');
			$designation = $this->input->post('designation');
			$type = $this->input->post('type');
			$incident_date = $this->input->post('incident_date');
			$reporting_date = $this->input->post('reporting_date');
			$reported_by = $this->input->post('reported_by');
			$subject = $this->input->post('subject');
			$description = $this->input->post('description');

			$previous_claim = $this->Insurance_model->check_claim_existence($employee_id);
			if($previous_claim > 0)
			{
				$this->session->set_flashdata('error', '<strong>Previous claim!</strong> Claim already in progress.');
				redirect('Insurance/list_employees', 'refresh');

			}


			$data = array(
						'employee_id' => $employee_id,
						'type' => $type,
						'incident_date' => $incident_date,
						'reporting_date' => $reporting_date,
						'reported_by' => $reported_by,
						'subject' => $subject,
						'description' => $description,
						'status' => 'pending',
						'entry_by' => $entry_by
					);

			$add = $this->Insurance_model->add_claim($data);
			$insurance_claim_id = $this->db->insert_id();

			if($add)
			{
				if(!empty($_FILES['attachments']) OR $_FILES['attachments']['size'][0] != 0)
					$this->upload_files($_FILES['attachments'], $insurance_claim_id, $entry_by);

				$data = array();

				$file_type = $this->Insurance_model->get_file_types();
				foreach ($file_type as $file_type) {
					array_push($data, array('insurance_claim_id' => $insurance_claim_id, 'file_type_id' => $file_type->id));
				}

				$this->Insurance_model->add_files_checklist($data);

				$this->session->set_flashdata('success', '<strong>Success!</strong> Insurance claim submitted');

				if($type == 'death')
					$this->Insurance_model->update_employee_status($employee_id, array('status' => '7', 'is_active' => '0'));

			}
			else
			{
				$this->session->set_flashdata('error', '<strong>Error!</strong> Insurance claim wasn\'t submitted');
			}

			redirect('Insurance/list_employees', 'refresh');
		}
		else
		{
			show_404();
		}
	}


	public function update_status()
	{
		if(isset($_POST))
		{
			$employee_id = $this->input->post('employee_id');
			$status = $this->input->post('status');
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');

			$updated_at = $this->input->post('updated_at');
			$updated_by = $this->session_data['user_id'];

			$new_status = '';

			if($status == 'insured')
				$new_status = 'uninsured';
			else
				$new_status = 'insured';

			$employee_row = $this->Insurance_model->get_employee_status($employee_id)->row();
			if($new_status == 'uninsured' && $employee_row->status > 0 && $employee_row->status < 5)
			{
				$this->session->set_flashdata('error', 'Active employee\'s can\'t be uninsured');
				redirect('Insurance/list_employees', 'refresh');
			}

			$data = array(
					'from_date' => $from_date,
					'to_date' => $to_date,
					'status' => $new_status,
					'updated_at' => $updated_at,
					'updated_by' => $updated_by	
				);

			
			$rec_update = $this->Insurance_model->update($data, $employee_id);
			$insurance_row = $this->db->get_where('insurance', array('employee_id' => $employee_id))->row();
			$insurance_id = $insurance_row->id;

			if($rec_update) {

					$new_status = ($status == 'insured') ? '0' : '1';
					$data = array(
						'insurance_id' => $insurance_id,
						'from_date' => $from_date,
						'to_date' => $to_date,
						'status' => $new_status,
						'status_date' => $updated_at,
						'entry_by' => $updated_by
					);
				$this->Insurance_model->insurance_log($data);
				$this->session->set_flashdata('success', 'Insurance status updated successfully');
			}
			else{
				$this->session->set_flashdata('error', 'Server Problem');
			}


			redirect('Insurance/list_employees', 'refresh');
		}
		else
		{
			show_404();
		}
	}

	public function bulk_update()
	{
		$ids = $this->input->post('employee_ids');
		$employee_ids = explode('-', $ids);

		$employees = array();

		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$updated_by = $this->session_data['user_id'];
		$updated_at = date('Y-m-d');
		$rec_update = false;

		if(!empty($employee_ids))
		{
			for ($i=0; $i < count($employee_ids); $i++) { 
				$status = $this->Insurance_model->check_insurance_status($employee_ids[$i])->status;

				if($status == 'uninsured' || $status == 'pending') 
				{
						$data = array(
							'from_date' => $from_date,
							'to_date' => $to_date,
							'status' => 'insured',
							'updated_by' => $updated_by,
							'updated_at' => $updated_at
						);
						
						$rec_update = $this->Insurance_model->update($data, $employee_ids[$i]);
						$insurance_id = $this->Insurance_model->get_insurance_id($employee_ids[$i]); 

						if($rec_update) {
							$data = array(
								'insurance_id' => $insurance_id,
								'from_date' => $from_date,
								'to_date' => $to_date,
								'status' => '1',
								'entry_by' => $updated_by,
								'entry_at' => $updated_at
							);

							$this->Insurance_model->insurance_log($data);
						}
				} 

			}

			if($rec_update)
			{
				$this->session->set_flashdata('success', 'Insurance added Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Server Problem');
			}

		}

		redirect('Insurance/list_employees', 'refresh');
	}

	/* Status and Remarks */
	public function update_claim()
	{
		$entry_by = $this->session_data['user_id'];

		if(isset($_POST))
		{
			$claim_id = $this->input->post('claim_id');
			$status = $this->input->post('status');
			$decision = $this->input->post('decision');
			$remarks = $this->input->post('remarks');
			$remarks_by = $this->session_data['user_id'];
			$remarks_date = date('Y-m-d');
			$file_type = '';
			
			if($status == 'pending')
			{
				$status = 'inprogress';
				$data = array(
					'status' => $status,
					'remarks' => $remarks,
					'remarks_by' => $remarks_by,
					'remarks_date' => $remarks_date
				);
			}
			elseif($status == 'inprogress')
			{
				$status = 'completed';
				$data = array(
					'status' => $status,
					'decision' => $decision,
					'decision_text' => $remarks,
					'decision_by' => $remarks_by,
					'decision_date' => $remarks_date
				);
			}

			$update = $this->Insurance_model->update_insurance_claim($data, $claim_id);
			if(!empty($_FILES) && $_FILES['attachments']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES['attachments'], $claim_id, $entry_by);

			if($update)
				$this->session->set_flashdata('success', 'Record Updated Successfully');
			else
				$this->session->set_flashdata('error', 'Record Updation Failed');

			redirect('Insurance/view_claims', 'refresh');
		}
		else
		{
			show_404();
		}
	}

	public function update_claim_detail()
	{
		$claim_id = $this->input->post('claim_id');
		$type = $this->input->post('type');
		$incident_date = $this->input->post('incident_date');
		$reported_by = $this->input->post('reported_by');
		$reported_date = $this->input->post('reported_date');
		$subject = $this->input->post('subject');
		$description = $this->input->post('description');

		$data = array(
					'type' => $type,
					'incident_date' => $incident_date,
					'reported_by' => $reported_by,
					'reporting_date' => $reported_date,
					'subject' => $subject,
					'description' => $description
				);

		$updated = $this->Insurance_model->update_insurance_claim($data, $claim_id);

		if($updated)
			$this->session->set_flashdata('success', 'Record updated successfully.');
		else
			$this->session->set_flashdata('error', 'Record updation failed');

		redirect('Insurance/claim_detail/'.$claim_id, 'refresh');
	}

	public function update_checklist()
	{
		$this->ajax_check();

		$file_type_id = $this->input->post('file_type');
		$insurance_claim_id = $this->input->post('claim_id');
		$status = $this->input->post('status');

		$conditions = ['insurance_claim_id' => $insurance_claim_id, 'file_type_id' => $file_type_id];
		$data = ['status' => $status];
		$updated = $this->Insurance_model->update_files_checklist($conditions, $data);

		if($updated)
			echo '1';
		else
			echo '0';
	}

	public function add_new_files()
	{
		$uploaded_by = $this->session_data['user_id'];
		$claim_id = $this->input->post('claim_id');

		if(!empty($_FILES) && $_FILES['attachments']['size'][0] != 0)
		{
			$uploaded = $this->upload_files($_FILES['attachments'], $claim_id, $uploaded_by);
			if($uploaded)
				$this->session->set_flashdata('success', 'Files uploaded successfully.');
			else
				$this->session->set_flashdata('error', 'Files uploading failed.'. $this->upload->display_errors());
		}

		redirect('Insurance/claim_detail/'.$claim_id, 'refresh');
	}

	private function upload_files($files, $claim_id, $uploaded_by)
    {
    	$data = array();

        $filesCount = count($files['name']);
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['file']['name']     = $files['name'][$i];
            $_FILES['file']['type']     = $files['type'][$i];
            $_FILES['file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['file']['error']    = $files['error'][$i];
            $_FILES['file']['size']     = $files['size'][$i];
            
            // File upload configuration
            $uploadPath = './uploads/insurance_claims/';
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
                $uploadData[$i]['uploaded_by'] = $uploaded_by;
                $uploadData[$i]['insurance_claim_id'] = $claim_id;
            }
            else
            {
            	 $this->upload->display_errors();
            	 return false;
            }
        }
        
        if(!empty($uploadData)){
            return $this->Insurance_model->upload($uploadData);

        }
    }


    function reportXLS()
    {
    	$fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.status' => '1',
					'i.status' => $this->input->get('status')
				];

		if(isset($_GET))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			$designation = (int) $this->input->get('designation');
			$project = (int) $this->input->get('project');
			$status = $this->input->get('status');
			$employee_status = $this->input->get('employee_status');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;
			if($project != 0)
				$conditions['xe.company_id'] = $project;
			$conditions['xe.designation_id'] = $designation;

			if($employee_status != "")
			{
				$conditions['xe.status'] = $employee_status;
			}

			$conditions['i.status'] = $status;
			
		} 


		$filtered_conditions = $this->remove_empty_entries($conditions);
		$employees = $this->Insurance_model->get_employees($filtered_conditions)->result();
		
		if(count($employees) == 0)
        	exit('No Records found');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','K') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:K1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'ID');
        $sheet->SetCellValue('B1', 'Name');
        $sheet->SetCellValue('C1', 'Project');
        $sheet->SetCellValue('D1', 'Department');
        $sheet->SetCellValue('E1', 'Designation');  
        $sheet->SetCellValue('F1', 'Contact No'); 
        $sheet->SetCellValue('G1', 'DOB'); 
        $sheet->SetCellValue('H1', 'From Date'); 
        $sheet->SetCellValue('I1', 'To Date'); 
        $sheet->SetCellValue('J1', 'Status'); 

        // set Row
        $rowCount = 2;
        foreach ($employees as $element) {
        
            $sheet->SetCellValue('A' . $rowCount, ucwords($element->employee_id));
            $sheet->SetCellValue('B' . $rowCount, ucwords($element->emp_name));
            $sheet->SetCellValue('C' . $rowCount, ucwords($element->project_name));
            $sheet->SetCellValue('D' . $rowCount, ucwords($element->department_name));
            $sheet->SetCellValue('E' . $rowCount, ucwords($element->designation_name));
            $sheet->SetCellValue('F' . $rowCount, $element->contact_number);
            $sheet->SetCellValue('G' . $rowCount, $element->date_of_birth);
            $sheet->SetCellValue('H' . $rowCount, $element->from_date);
            $sheet->SetCellValue('I' . $rowCount, $element->to_date);
            $sheet->SetCellValue('J' . $rowCount, $element->status);
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="insurance_report.xlsx"');
        $objWriter->save('php://output'); 
    }

    function claimsReportXLS()
    {
    	$fileName = 'data-'.time().'.xlsx';  
		// load excel library
        $this->load->library('excel');

        $conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'ic.status' => $this->input->get('status')
				];

		if(isset($_GET))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			$designation = (int) $this->input->get('designation');
			$project = (int) $this->input->get('project');
			$status = $this->input->get('status');
			$employee_status = $this->input->get('employee_status');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;
			if($project != 0)
				$conditions['xe.company_id'] = $project;
			$conditions['xe.designation_id'] = $designation;

			if($employee_status != "")
			{
				$conditions['xe.status'] = $employee_status;
			}

			$conditions['ic.status'] = $status;
			
		} 

		$filtered_conditions = $this->remove_empty_entries($conditions);
		$claims = $this->Insurance_model->insurance_claims_report($filtered_conditions);
		
		if(count($claims) == 0)
        	exit('No Records found');
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheet = $objPHPExcel->getActiveSheet();
        
        foreach(range('A','Z') as $columnID) {
		    $sheet->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}  

		$sheet->getStyle('A1:Z1')->getFont()->setBold(true);
        // set Header
        $sheet->SetCellValue('A1', 'ID');
        $sheet->SetCellValue('B1', 'Name');
        $sheet->SetCellValue('C1', 'Father Name');
        $sheet->SetCellValue('D1', 'Gender');
        $sheet->SetCellValue('E1', 'Personal Contact');
        $sheet->SetCellValue('F1', 'Other Contact');
        $sheet->SetCellValue('G1', 'DOB'); 
        $sheet->SetCellValue('H1', 'CNIC'); 
        $sheet->SetCellValue('I1', 'Project');
        $sheet->SetCellValue('J1', 'Department');
        $sheet->SetCellValue('K1', 'Designation');   
        $sheet->SetCellValue('L1', 'Incident Type'); 
        $sheet->SetCellValue('M1', 'Incident Date'); 
        $sheet->SetCellValue('N1', 'Reported By'); 
        $sheet->SetCellValue('O1', 'Reporting Date'); 
        $sheet->SetCellValue('P1', 'Subject'); 
        $sheet->SetCellValue('Q1', 'Description'); 
        $sheet->SetCellValue('R1', 'Remarks'); 
        $sheet->SetCellValue('S1', 'Remarks By'); 
        $sheet->SetCellValue('T1', 'Remarks Date'); 
        $sheet->SetCellValue('U1', 'Decision'); 
        $sheet->SetCellValue('V1', 'Decision Detail'); 
        $sheet->SetCellValue('W1', 'Decision By'); 
        $sheet->SetCellValue('X1', 'Decision Date'); 
        $sheet->SetCellValue('Y1', 'Status'); 

        // set Row
        $rowCount = 2;
        foreach ($claims as $element) {

        	if($element->decision == '1')
        		$decision = 'Accepted';
        	elseif($element->decision == '0')
        		$decision = 'Rejected';
        
            $sheet->SetCellValue('A' . $rowCount, $element->employee_id);
            $sheet->SetCellValue('B' . $rowCount, ucwords($element->emp_name));
            $sheet->SetCellValue('C' . $rowCount, ucwords($element->father_name));
            $sheet->SetCellValue('D' . $rowCount, ucwords($element->gender_name));
            $sheet->SetCellValue('E' . $rowCount, $element->personal_contact);
            $sheet->SetCellValue('F' . $rowCount, $element->contact_number);
            $sheet->SetCellValue('G' . $rowCount, ($element->date_of_birth) ? date('d-m-Y', strtotime($element->date_of_birth)) : '');
            $sheet->SetCellValue('H' . $rowCount, $element->cnic);
            $sheet->SetCellValue('I' . $rowCount, ucwords($element->project_name));
            $sheet->SetCellValue('J' . $rowCount, ucwords($element->department_name));
            $sheet->SetCellValue('K' . $rowCount, ucwords($element->designation_name));
            $sheet->SetCellValue('L' . $rowCount, ucwords($element->type));
            $sheet->SetCellValue('M' . $rowCount, date('d-m-Y', strtotime($element->incident_date)));
            $sheet->SetCellValue('N' . $rowCount, ucwords($element->reported_by));
            $sheet->SetCellValue('O' . $rowCount, ($element->reporting_date) ? date('d-m-Y', strtotime($element->reporting_date)) : '');
            $sheet->SetCellValue('P' . $rowCount, $element->subject);
            $sheet->SetCellValue('Q' . $rowCount, $element->description);
            $sheet->SetCellValue('R' . $rowCount, $element->remarks);
            $sheet->SetCellValue('S' . $rowCount, ucwords($element->remarks_by));
            $sheet->SetCellValue('T' . $rowCount, ($element->remarks_date) ? date('d-m-Y', strtotime($element->remarks_date)) : '');
            $sheet->SetCellValue('U' . $rowCount, '');
            $sheet->SetCellValue('V' . $rowCount, $decision);
            $sheet->SetCellValue('W' . $rowCount, ucwords($element->decision_by));
            $sheet->SetCellValue('X' . $rowCount, ($element->decision_date) ? date('d-m-Y', strtotime($element->decision_date)) : '');
            $sheet->SetCellValue('Y' . $rowCount, $element->status);
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="claims_report.xlsx"');
        $objWriter->save('php://output'); 

    }

    // function populate_insurance()
    // {
    // 	$this->db->select('xe.employee_id');
    // 	$this->db->where_not_in('xe.user_role_id', array(1, 2));
    // 	$employees = $this->db->get('xin_employees xe')->result();

    // 	foreach ($employees as $employee) {
    // 		$this->db->insert('insurance', array('employee_id' => $employee->employee_id));
    // 	}
    // }

}

