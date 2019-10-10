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
							'Projects_model',
							'Locations_model'
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

	private function sc_employees($search_query, $table)
	{
		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.is_active' => '1',
					'xe.status !=' => '0'
				];


		if(isset($_GET['search']))
		{
			$employeeID = (int) $this->input->get('employee_id');
			$employeeName = $this->input->get('employee_name');
			$province = (int) $this->input->get('province');
			// $district = (int) $this->input->get('district');
			// $tehsil = (int) $this->input->get('tehsil');
			// $uc = (int) $this->input->get('uc');
			$project = (int) $this->input->get('project');
			$designation = (int) $this->input->get('designation');
			// $location = (int) $this->input->get('location');
			$status = $this->input->get('status');
			
			if($employeeName != '')
				$employeeName = '%'.$employeeName.'%';

			$conditions['xe.employee_id'] = $employeeID;
			$conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
			if($province != 0)
				$conditions['xe.provience_id'] = $province;
			if($project != 0)
				$conditions['xe.company_id'] = $project;
			$conditions['xe.designation_id'] = $designation;

			if($status != "")
			{
				if($table == 'insurance')
					$conditions['i.status'] = $status;
				elseif($table == 'insurance_claims')
					$conditions['ic.status'] = $status;
			}
			
		} 

			
		return $this->remove_empty_entries($conditions);

	}


	public function list_employees($offset="")
	{
		$this->load->library('pagination');

		$query_string = $data['query_string'] = $_SERVER['QUERY_STRING'];
		$conditions = $this->sc_employees($query_string, 'insurance');

		/* Pagination */

		$total_rows = $this->Insurance_model->get_employees($conditions)->num_rows();
		$url = 'Insurance/list_employees';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		/* end pagination */

		$data['title'] = 'Employees Insurance List';
		$data['employees'] = $this->Insurance_model->get_employees($conditions, $this->limit, $offset)->result();

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['locations'] = $this->Locations_model->get_by_project($this->session_data['project_id']);

		$data['content'] = $this->load->view('insurance/index', $data, TRUE);
		$this->load->view('insurance/_template', $data);
	}

	public function dashboard()
	{
		$data['title'] = 'Insurance Dashboard';

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'i.status' => 'pending'
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

	public function view_claims($offset="")
	{
		$this->load->library('pagination');

		$query_string = $data['query_string'] = $_SERVER['QUERY_STRING'];
		$conditions = $this->sc_employees($query_string, 'insurance_claims');

		/* Pagination */

		$total_rows = $this->Insurance_model->get_insurance_claims($conditions)->num_rows();
		$url = 'Insurance/view_claims';
		
		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		/* end pagination */

		$data['title'] = 'Employees Insurance List';
		$data['insurance_claims'] = $this->Insurance_model->get_insurance_claims($conditions, $this->limit, $offset)->result();
		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
		$data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['provinces'] = $this->Province_model->get_by_project($this->session_data['project_id']);
		$data['locations'] = $this->Locations_model->get_by_project($this->session_data['project_id']);

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

			$data['detail'] = $this->Insurance_model->get_insurance_claims($filtered_conditions)->row();
			$data['files'] = $this->Insurance_model->get_insurance_files($claim_id)->result();

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

			$url = $this->input->post('url');

			if($reported_by == '')
				$reported_by = $employee_name;

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

			if($add)
			{
				$this->session->set_flashdata('success', '<strong>Success!</strong> Insurance claim submitted');
			}
			else
			{
				$this->session->set_flashdata('error', '<strong>Error!</strong> Insurance claim wasn\'t submitted');
			}

			redirect($url, 'refresh');
		}
		else
		{
			show_404();
		}
	}

	public function update_status()
	{
		$employee_id = $this->input->post('employee_id');
		$status = $this->input->post('status');

		if($status == 'insured')
			$status = 'uninsured';
		elseif($status == 'uninsured')
			$status = 'insured';

		$updated_by = $this->session_data['user_id'];
		$updated_at = date('Y-m-d');

		$data = array(
				'status' => $status,
				'updated_by' => $updated_by,
				'updated_at' => $updated_at
			);

		$rec_update = $this->Insurance_model->update($data, $employee_id);
		$insurance = $this->db->get_where('insurance', array('employee_id' => $employee_id))->row();

		if($rec_update) {

				$data = array(
					'insurance_id' => $insurance->id,
					'from_date' => $insurance->from_date,
					'to_date' => $insurance->to_date,
					'status' => $status,
					'entry_by' => $updated_by,
					'entry_at' => $updated_at
				);
			$this->Insurance_model->insurance_log($data);
		}

		if($rec_update)
			echo '1';
		else
			echo '0';
	}

	public function add()
	{
		if(isset($_POST))
		{
			$employee_id = $this->input->post('employee_id');
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');

			$updated_by = $this->session_data['user_id'];
			$updated_at = date('Y-m-d');

			$data = array(
					'from_date' => $from_date,
					'to_date' => $to_date,
					'status' => 'insured',
					'updated_by' => $updated_by,
					'updated_at' => $updated_at
				);

			$rec_update = $this->Insurance_model->update($data, $employee_id);
			$insurance_id = $this->db->get_where('insurance', array('employee_id' => $employee_id))->row()->id;
			if($rec_update) {

					$data = array(
						'insurance_id' => $insurance_id,
						'from_date' => $from_date,
						'to_date' => $to_date,
						'status' => 'insured',
						'entry_by' => $updated_by,
						'entry_at' => $updated_at
					);
				$this->Insurance_model->insurance_log($data);
				$this->session->set_flashdata('success', 'Insurance added Successfully');
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
						$insurance_id = $this->db->get_where('insurance', array('employee_id' => $employee_ids[$i]))->row()->id;

						if($rec_update) {
							$data = array(
								'insurance_id' => $insurance_id,
								'from_date' => $from_date,
								'to_date' => $to_date,
								'status' => 'insured',
								'entry_by' => $updated_by,
								'entry_at' => $updated_at
							);

							$this->Insurance_model->insurance_log($data);
						}
				} 

				// elseif($status == 'insured') 
				// {
				// 	$data = array(
				// 			'status' => $status,
				// 			'updated_by' => $updated_by,
				// 			'updated_at' => $updated_at
				// 		);

				// 	$rec_update = $this->Insurance_model->update($data, $employee_ids[$i]);
				// 	$insurance = $this->db->get_where('insurance', array('employee_id' => $employee_ids[$i]))->row();

				// 	if($rec_update) {
				// 		$data = array(
				// 			'insurance_id' => $insurance->id,
				// 			'from_date' => $insurance->from_date,
				// 			'to_date' => $insurance->to_date,
				// 			'status' => $status,
				// 			'entry_by' => $updated_by,
				// 			'entry_at' => $updated_at
				// 		);

				// 		$this->Insurance_model->insurance_log($data);
						
				// 	}
				// }

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

	public function update_claim()
	{
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
			
			if(!empty($_FILES) && $_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $claim_id, $status);

			if($update)
			{
				$this->session->set_flashdata('success', 'Record Updated Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Record Updation Failed');
			}

			redirect('Insurance/view_claims', 'refresh');
		}
		else
		{
			show_404();
		}
	}


	private function upload_files($files, $id, $status="")
    {
    	$data = array();
        
        $filesCount = count($_FILES['docs']['name']);
        for($i = 0; $i < $filesCount; $i++){
            $_FILES['file']['name']     = $_FILES['docs']['name'][$i];
            $_FILES['file']['type']     = $_FILES['docs']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['docs']['tmp_name'][$i];
            $_FILES['file']['error']    = $_FILES['docs']['error'][$i];
            $_FILES['file']['size']     = $_FILES['docs']['size'][$i];
            
            // File upload configuration
            $uploadPath = './uploads/insurance_claims/';
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
                $uploadData[$i]['uploaded_by'] = $this->session_data['user_id'];
                $uploadData[$i]['insurance_claim_id'] = $id;
                $uploadData[$i]['file_type'] = $status;
            }
            else
            {
            	echo $this->upload->display_errors();
            }
        }
        
        if(!empty($uploadData)){
            $insert = $this->Insurance_model->upload($uploadData);

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
					'i.status' => $this->input->get('status')
				];

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
        $sheet->SetCellValue('F1', 'Location'); 
        $sheet->SetCellValue('G1', 'Contact No'); 
        $sheet->SetCellValue('H1', 'DOB'); 
        $sheet->SetCellValue('I1', 'From Date'); 
        $sheet->SetCellValue('J1', 'To Date'); 
        $sheet->SetCellValue('K1', 'Status'); 

        // set Row
        $rowCount = 2;
        foreach ($employees as $element) {
        
            $sheet->SetCellValue('A' . $rowCount, ucwords($element->employee_id));
            $sheet->SetCellValue('B' . $rowCount, ucwords($element->emp_name));
            $sheet->SetCellValue('C' . $rowCount, ucwords($element->project_name));
            $sheet->SetCellValue('D' . $rowCount, ucwords($element->department_name));
            $sheet->SetCellValue('E' . $rowCount, ucwords($element->designation_name));
            $sheet->SetCellValue('F' . $rowCount, ucwords($element->location_name));
            $sheet->SetCellValue('G' . $rowCount, $element->contact_number);
            $sheet->SetCellValue('H' . $rowCount, $element->date_of_birth);
            $sheet->SetCellValue('I' . $rowCount, $element->from_date);
            $sheet->SetCellValue('J' . $rowCount, $element->to_date);
            $sheet->SetCellValue('K' . $rowCount, $element->status);
            
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

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$claims = $this->Insurance_model->get_insurance_claims($filtered_conditions)->result();
	
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
        $sheet->SetCellValue('L1', 'Location'); 
        $sheet->SetCellValue('M1', 'Incident Type'); 
        $sheet->SetCellValue('N1', 'Incident Date'); 
        $sheet->SetCellValue('O1', 'Reported By'); 
        $sheet->SetCellValue('P1', 'Reporting Date'); 
        $sheet->SetCellValue('Q1', 'Subject'); 
        $sheet->SetCellValue('R1', 'Description'); 
        $sheet->SetCellValue('S1', 'Remarks'); 
        $sheet->SetCellValue('T1', 'Remarks By'); 
        $sheet->SetCellValue('U1', 'Remarks Date'); 
        $sheet->SetCellValue('V1', 'Decision'); 
        $sheet->SetCellValue('W1', 'Decision Detail'); 
        $sheet->SetCellValue('X1', 'Decision By'); 
        $sheet->SetCellValue('Y1', 'Decision Date'); 
        $sheet->SetCellValue('Z1', 'Status'); 

        // set Row
        $rowCount = 2;
        foreach ($claims as $element) {
        
            $sheet->SetCellValue('A' . $rowCount, $element->employee_id);
            $sheet->SetCellValue('B' . $rowCount, ucwords($element->emp_name));
            $sheet->SetCellValue('C' . $rowCount, ucwords($element->father_name));
            $sheet->SetCellValue('D' . $rowCount, ucwords($element->gender_name));
            $sheet->SetCellValue('E' . $rowCount, $element->personal_contact);
            $sheet->SetCellValue('F' . $rowCount, $element->contact_number);
            $sheet->SetCellValue('G' . $rowCount, date('d-m-Y', strtotime($element->date_of_birth)));
            $sheet->SetCellValue('H' . $rowCount, $element->cnic);
            $sheet->SetCellValue('I' . $rowCount, ucwords($element->project_name));
            $sheet->SetCellValue('J' . $rowCount, ucwords($element->department_name));
            $sheet->SetCellValue('K' . $rowCount, ucwords($element->designation_name));
            $sheet->SetCellValue('L' . $rowCount, ucwords($element->location_name));
            $sheet->SetCellValue('M' . $rowCount, ucwords($element->type));
            $sheet->SetCellValue('N' . $rowCount, date('d-m-Y', strtotime($element->incident_date)));
            $sheet->SetCellValue('O' . $rowCount, ucwords($element->reported_by));
            $sheet->SetCellValue('P' . $rowCount, date('d-m-Y', strtotime($element->reporting_date)));
            $sheet->SetCellValue('Q' . $rowCount, $element->subject);
            $sheet->SetCellValue('R' . $rowCount, $element->description);
            $sheet->SetCellValue('S' . $rowCount, $element->remarks);
            $sheet->SetCellValue('T' . $rowCount, ucwords($element->remarks_by_name));
            $sheet->SetCellValue('U' . $rowCount, date('d-m-Y', strtotime($element->remarks_date)));
            $sheet->SetCellValue('V' . $rowCount, '');
            $sheet->SetCellValue('W' . $rowCount, $element->decision);
            $sheet->SetCellValue('X' . $rowCount, ucwords($element->decision_by_name));
            $sheet->SetCellValue('Y' . $rowCount, date('d-m-Y', strtotime($element->decision_date)));
            $sheet->SetCellValue('Z' . $rowCount, $element->status);
            
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="claims_report.xlsx"');
        $objWriter->save('php://output'); 

    }

}

