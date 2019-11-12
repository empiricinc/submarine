<?php 

/**
 * 
 */
class Complaint extends MY_Controller
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
						'Complaint_model',
						'Designation_model',
						'Reports_model',
						'Province_model',
						'Departments_model',
						'Designations_model',
						'Projects_model'
					));

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}


	function index()
	{
		$data['title'] = 'User Complaint Form';

		$data['province'] = $this->Province_model->get();
		$data['projects'] = $this->Projects_model->get();
		$data['content'] = $this->load->view('complaint/complaint-form', $data, TRUE);
		$this->load->view('complaint/_template', $data);
	}

	function remove_empty_entries($conditions)
	{
		foreach ($conditions as $key => $value) {
			if($value == '')
				unset($conditions[$key]);

		}

		return $conditions;
	}

	// function dashboard()
	// {
	// 	$data['title'] = 'Complaints Dashboard';
	// 	$project = $this->session_data['project_id'];
	// 	$province = $this->session_data['province_id'];

	// 	$conditions = ['c.project_id' => $project, 'c.province_id' => $province];
	// 	$filtered_conditions = $this->remove_empty_entries($conditions);

	// 	$data['complaints'] = $this->Complaint_model->get_complaints($filtered_conditions, 5, "")->result();

	// 	$data['content'] = $this->load->view('complaint/dashboard', $data, TRUE);
	// 	$this->load->view('complaint/_template', $data);
	// }


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

		$total_rows = $this->Complaint_model->get_complaints($filtered_conditions)->num_rows();
		$url = 'Compalint/view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Complaint_model->get_complaints($filtered_conditions, $this->limit, $offset)->result();
		
		$data['content'] = $this->load->view('complaint/view-complaints', $data, TRUE);

		$this->load->view('complaint/_template', $data);
	}


	function view_detail($complaint_id)
	{
		$data['title'] = 'Complaint Detail & Remarks';

		$conditions = [
				'c.id' => $complaint_id,
				'c.project_id' => $this->session_data['project_id'],
				'c.province_id' => $this->session_data['province_id']
				];

		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['detail'] = $this->Complaint_model->get_complaints($filtered_conditions);

		if(empty($data['detail']))
		{
			show_404();
		}

		$data['remarks'] = $this->Complaint_model->get_remarks($complaint_id);

		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{
			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$remarks_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Complaint_model->get_files($remarks_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}
		

		$data['content'] = $this->load->view('complaint/complaint-detail', $data, TRUE);
		$this->load->view('complaint/_template', $data);
	}


	function complaint_detail($complaint_id)
	{
		$conditions = [
						'c.id' => $complaint_id,
						'c.project_id' => $this->session_data['project_id'],
						'c.province_id' => $this->session_data['province_id']
						];
		
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['project_head'] = $this->Complaint_model->get_project_head($complaint_id);
		$data['detail'] = $this->Complaint_model->get_complaints($filtered_conditions);
		if(empty($data['detail']))
		{
			show_404();
		}
		//get_files_and_reviews($complint_id, $sender, $receiver) takes these three arguments
		$data['remarks'] = $this->Complaint_model->get_remarks($complaint_id);

		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$remarks_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Complaint_model->get_files($remarks_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}
		

		$data['title'] = 'Complaint Detail & Remarks';
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

		
			$conditions['cr.status'] = $status;
			$conditions['c.complaint_no LIKE'] = $complaintNo;
			$conditions['c.created_at >='] = $fromDate;
			$conditions['c.created_at <='] = $toDate;
			

		}
		
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$total_rows = $this->Complaint_model->get_complaints_legal($filtered_conditions)->num_rows();
		$url = 'Complaint/legal_view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Complaint_model->get_complaints_legal($filtered_conditions, $this->limit, $offset)->result();
	
		$data['content'] = $this->load->view('complaint/legal-view', $data, TRUE);

		$this->load->view('complaint/_template', $data);
	}


	function legal_detail($id=FALSE)
	{
		$conditions = [
				'cr.complaint_id' => $id,
				'c.project_id' => $this->session_data['project_id'],
				'c.province_id' => $this->session_data['province_id']
			];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Complaint Detail & Remarks';
		$data['detail'] = $this->Complaint_model->get_complaints_legal($filtered_conditions)->row();
		
		if(empty($data['detail']))
		{
			show_404();
		}

		$data['projects'] = $this->Projects_model->get($this->session_data['project_id']);

		$data['remarks'] = $this->Complaint_model->get_remarks($id);
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{
			// $complaint_id = $data['remarks'][0]['complaint_id'];
			// $file_sender = 'legal';

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$remarks_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Complaint_model->get_files($remarks_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}

		$data['content'] = $this->load->view('complaint/legal-detail', $data, TRUE);
		$this->load->view('complaint/_template', $data);
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

		$total_rows = $this->Complaint_model->get_complaints_local($filtered_conditions)->num_rows();
		$url = 'Complaint/local_view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

		$data['title'] = 'List of Complaints';

		$data['complaints'] = $this->Complaint_model->get_complaints_local($filtered_conditions, $this->limit, $offset)->result();
		$data['content'] = $this->load->view('complaint/local-view', $data, TRUE);
				

		$this->load->view('complaint/_template', $data);
	}

	function local_detail($complaint_id)
	{
		$conditions = [
					'c.project_id' => $this->session_data['project_id'],
					'c.province_id' => $this->session_data['province_id'],
					'cr.complaint_id' => $complaint_id
					];
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Complaint Detail & Remarks';

		$data['detail'] = $this->Complaint_model->get_complaints_local($filtered_conditions)->row();
		if(empty($data['detail']))
		{
			show_404();
		}
		// $data['province'] = $this->User_panel_model->get_province();
		// $data['designations'] = $this->Designation_model->get_designations()->result();

		$data['remarks'] = $this->Complaint_model->get_remarks($complaint_id, 'external');
		$data['remarks_and_files'] = [];
		if(!empty($data['remarks']))
		{

			$data['remarks_and_files'] = array();
			for ($i=0; $i < count($data['remarks']); $i++) { 
				$remarks_id = $data['remarks'][$i]['id'];
				$file_counter = 0;

				$data['remarks_and_files'][$i] = $data['remarks'][$i];
				$files = $this->Complaint_model->get_files($remarks_id);

				for ($j=0; $j < count($files); $j++) {
					$data['remarks_and_files'][$i][$j] = $files[$j];
					$file_counter++;
				}

				$data['remarks_and_files'][$i]['number_of_files'] = $file_counter;
			}
		}

		$data['content'] = $this->load->view('complaint/local-detail', $data, TRUE);
		$this->load->view('complaint/_template', $data);
	}

	
	function add()
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

				$data['project'] = $this->Projects_model->get();
				$data['province'] = $this->Province_model->get();
				$data['content'] = $this->load->view('complaint/complaint-form', $data, TRUE);
				
				$this->load->view('complaint/_template', $data);
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

				$complaint_no = $this->Complaint_model->get_last_id();
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

				$added = $this->Complaint_model->add_complaint($data);
				
				if($added) 
				{
					$this->session->set_flashdata('success', 'Your complaint has been submitted successfully.');
					redirect('Complaint/index', 'refresh');
				}

			}

			
		} 
		else
		{
			show_404();
		}
	}


	function forward()
	{
		if(isset($_POST))
		{
			$employee_id = $this->session_data['user_id'];
		
			$complaint_id = $this->input->post('complaint_id');
			$remarks = $this->input->post('remarks');
			
			$rows = $this->Complaint_model->check_complaint_existence($complaint_id)->num_rows();

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
				'status' => 'pending'
			);

			$rec_added = $this->Complaint_model->add_detail($data);
			if($rec_added)
			{
				$this->Complaint_model->update_complaint_status($complaint_id, 'process');

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
			// $employee_id = $this->session_data['user_id'];
			$employee_id = 2;
			$remarks_id = $this->input->post('remarks_id');
			$complaint_id = $this->input->post('complaint_id');
			$complaint_type = $this->input->post('complaint_type');

			$remarks = $this->input->post('remarks');
			$receiver = $this->input->post('employee_id');

			// $rows = $this->Complaint_model->check_complaint_existence($complaint_id, 'local')->num_rows();

			// if($rows > 0)
			// {
			// 	$this->session->set_flashdata('error', 'Complaint was not forwarded');
			// }

			$data = array(
				'complaint_id' => $complaint_id,
				'sender' => $employee_id,
				'sender_remarks' => $remarks,
				'receiver' => $receiver,
				'send_from' => 'legal',
				'intended_for' => 'local',
				'r_date' => date('Y-m-d H:i:s'),
				'status' => 'pending'
			);


			$rec_added = $this->Complaint_model->add_detail($data);
			$remarks_id = $this->db->insert_id();

			if(!empty($_FILES['docs']) && $_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $remarks_id, $employee_id);

			if($rec_added)
			{

				$this->Complaint_model->update_complaint_status($complaint_id, 'process');
				$this->Complaint_model->update_status($complaint_id, 'process', 'legal');
				$this->session->set_flashdata('success', 'Complaint forwarded successfully.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Complaint was not forwarded');
			}
		}
		else
		{
			show_404();
		}

		redirect('Complaint/legal_view', 'refresh');

	}


	function legal_resolve()
	{		
		if(isset($_POST))
		{
			// $employee_id = $this->session_data['user_id'];
			$employee_id = 4;

			$complaint_id = $this->input->post('complaint_id');
			$remarks_id = $this->input->post('remarks_id');
			$remarks = $this->input->post('remarks');
			$today = date('Y-m-d H:i:s');

			$data = array(
				'complaint_id' => $complaint_id,
				'sender' => $employee_id,
				'sender_remarks' => $remarks,
				'send_from' => 'legal',
				'intended_for' => 'head',
				'r_date' => $today,
				'status' => 'resolved'
			);

			$updated = $this->Complaint_model->add_detail($data);
			$remarks_id = $this->db->insert_id();
			if(!empty($_FILES) && $_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $remarks_id, $employee_id);


			if($updated)
			{
				$this->Complaint_model->update_complaint_status($complaint_id, 'review');
				$this->Complaint_model->update_detail_status($complaint_id, 'resolved');

				$this->session->set_flashdata('success', 'Investigation closed successfully.');
			}
			else
			{
				exit('Error! There seems to be a problem at your server. Contact developer of the site');
			}

		}


		redirect('Complaint/legal_view', 'refresh');
	}



	function local_resolve()
	{
		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;

			$complaint_id = $this->input->post('complaint_id');
			$remarks_id = $this->input->post('remarks_id');
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
				'status' => 'review'
			);

			$updated = $this->Complaint_model->add_detail($data);
			$remarks_id = $this->db->insert_id();
			
			if(!empty($_FILES) && $_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $remarks_id, $sender);


			if($updated)
			{
				$inv_status = $this->Complaint_model->update_local_status($complaint_id, $sender, 'resolved');
				$status_changed = $this->Complaint_model->update_status($complaint_id, 'review', 'legal');

				$this->session->set_flashdata('success', 'Investigation closed successfully.');
			}
			else
			{
				exit('Error! There seems to be a problem at your server. Contact developer of the site');
			}

		}

		redirect('Complaint/local_view', 'refresh');
	}


	function resolve()
	{
		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;
			$employee_id = 6;

			$complaint_id = $this->input->post('complaint_id');
			$remarks = $this->input->post('remarks');
			$today = date('Y-m-d H:i:s');

			$data = array(
				'closing_remarks' => $remarks,
				'remarks_by' => $employee_id,
				'remarks_at' => $today,
				'status' => 'resolved'
			);
			

			$updated = $this->Complaint_model->resolve_complaint($data, $complaint_id);

			if($updated)
			{
				$status_changed = $this->Complaint_model->update_complaint_status($complaint_id, 'resolved');
				$this->session->set_flashdata('success', 'Complaint was resolved successfully.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Complaint wasn\'t resolved.');
			}

			redirect('Complaint/view', 'refresh');

		}
		else
		{
			show_404();
		}
	}


    private function upload_files($files, $remarks_id, $employee_id)
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
            $uploadPath = './uploads/complaint_files/';
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
                $uploadData[$i]['complaint_remarks_id'] = $remarks_id;
                $uploadData[$i]['uploaded_by'] = $employee_id;
                $uploadData[$i]['upload_date'] = date("Y-m-d H:i:s");
            }
            else
            {
            	echo $this->upload->display_errors();
            }
        }
        
        if(!empty($uploadData)){
            $insert = $this->Complaint_model->upload_files($uploadData);

        }
    }


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

		$data['project_head'] = $this->Complaint_model->get_project_head($id);
		$detail = $this->Complaint_model->get_complaints($filtered_conditions);

		if(empty($detail))
		{
			show_404();
		}

		$remarks = $this->Complaint_model->get_remarks($id);
		
		if(!empty($remarks))
			{

				$remarks_and_files = array();
				for ($i=0; $i < count($remarks); $i++) { 
					$remarks_id = $remarks[$i]['id'];
					$file_counter = 0;

					$remarks_and_files[$i] = $remarks[$i];
					$files = $this->Complaint_model->get_files($remarks_id);

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
		$pdf->SetTitle('Complaint Report');
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

		$heading = '<img src="'.base_url().'uploads/logo/chip.png" height="50px">
			<br>
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong><br>
			<strong style="font-size: 14px;">Complaint Detail And Remarks</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		
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
				<h3 style="font-family: helvetica;">Complaint Remarks</h3>';
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



}