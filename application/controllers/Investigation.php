<?php 


/**
 * 
 */
class Investigation extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// if(!isset($this->session->user_id))
		// 	redirect(base_url());
		$this->load->model(array(
							'User_panel_model',
							'Investigation_model',
							'Designation_model'
						));

		$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
	}

	function index()
	{
		$data['title'] = 'User Complaint Form';

		$data['province'] = $this->User_panel_model->get_province();
		$data['content'] = $this->load->view('Investigation/complaint', $data, TRUE);
		$this->load->view('Investigation/_template', $data);
	}


	/* Area/Project Manager */
	
	function view($offset="")
	{
		$total_rows = $this->Investigation_model->get_complaints()->num_rows();
		$url = 'Investigation/view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Investigation_model->get_complaints(FALSE, $this->limit, $offset)->result();
		$data['table_id'] = "complaints-table";
		$data['view_print'] = 'view';
		$data['complaints_table'] = $this->load->view('investigation/tables/complaints-table', $data, TRUE);
		$data['content'] = $this->load->view('investigation/view-complaints', $data, TRUE);

		$this->load->view('investigation/_template', $data);
	}

	function get_complaints_table()
    {
    	$status = $this->input->get('status');
    	$total_rows = $this->Investigation_model->get_complaints($status)->num_rows();
    	$url = 'Investigation/view';

    	$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
    	$data['title'] = 'List of Complaints';
		$data['complaints'] = $this->Investigation_model->get_complaints($status, $this->limit)->result();
		$data['table_id'] = "complaints-table";
		$output = $this->load->view('investigation/tables/complaints-table', $data, TRUE);
		echo $output;																																	  
    }



	function view_detail($id=FALSE)
	{
		if($id === FALSE)
		{
			show_404();
				
		}
		else
		{
			$data['title'] = 'Investigation Detail';
			$data['detail'] = $this->Investigation_model->get_complaint_detail($id);
			//get_files_and_reviews($complint_id, $sender, $receiver) takes these three arguments
			$data['remarks'] = $this->Investigation_model->get_remarks($id);
			
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
			

			// var_dump($data['detail']); exit;
			$data['content'] = $this->load->view('Investigation/complaint-detail', $data, TRUE);
			if(empty($data['detail']))
				show_404();
		}

		$this->load->view('Investigation/_template', $data);
	}

	/* End Area/Project Manager */

	/* Legal Team */

	function legal_view($offset="")
	{
		$total_rows = $this->Investigation_model->get_complaints()->num_rows();
		$url = 'Investigation/legal_view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['title'] = 'List of Investigations';
		$data['complaints'] = $this->Investigation_model->get_complaints_legal(FALSE, FALSE, $this->limit, $offset)->result();
		
		$data['table_id'] = "legal-table";
		$data['complaints_table'] = $this->load->view('investigation/tables/legal-table', $data, TRUE);
		$data['content'] = $this->load->view('investigation/legal-view', $data, TRUE);

		$this->load->view('investigation/_template', $data);

		// $data['title'] = 'List of Investigations';

		// $data['complaints'] = $this->Investigation_model->get_complaints_legal()->result();
		// $data['content'] = $this->load->view('Investigation/legal-view', $data, TRUE);
	}

	function legal_detail($id=FALSE)
	{
		
		if($id === FALSE)
		{
			show_404();
		}
		else
		{
			$data['title'] = 'Investigation Detail';
			$data['detail'] = $this->Investigation_model->get_complaints_legal($id)->row();

			$data['province'] = $this->User_panel_model->get_province();
			$data['designations'] = $this->Designation_model->get_designations()->result();

			$data['remarks'] = $this->Investigation_model->get_remarks($id);
			
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

			$data['content'] = $this->load->view('Investigation/legal-detail', $data, TRUE);
			// var_dump($data['remarks_and_files']); exit;
			if(empty($data['detail']))
				show_404();
		}

		$this->load->view('Investigation/_template', $data);
	}

	/* Legal Team */

	function json_response($data)
	{
		$this->output
			 ->set_content_type('application/json')
			 ->set_output(json_encode(array('data' => $data)));
	}

	function get_districts()
	{
		$this->ajax_check();
		$province_id = $this->input->post('province_id');
		$districts = $this->User_panel_model->get_district_province($province_id);

		$this->json_response($districts);
	}

	function get_tehsils()
	{
		$this->ajax_check();
		$district_id = $this->input->post('district_id');
		$tehsils = $this->User_panel_model->get_tehsil_district($district_id);

		$this->json_response($tehsils);
	}

	function get_union_councils()
	{
		$this->ajax_check();
		$tehsil_id = $this->input->post('tehsil_id');
		$union_councils = $this->User_panel_model->get_uc_tehsil($tehsil_id);

		$this->json_response($union_councils);
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

				$data['province'] = $this->User_panel_model->get_province();
				$data['content'] = $this->load->view('Investigation/complaint', $data, TRUE);
				
				$this->load->view('Investigation/_template', $data);
			}
			else
			{
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
			$remarks = $this->input->post('remarks');
			$today = date('Y-m-d H:i:s');

			$data = array(
				'closing_remarks' => $remarks,
				'remarks_by' => $employee_id,
				'remarks_at' => $today,
				'status' => 'resolved'
			);
			
			$updated = $this->Investigation_model->close_investigation($data, $complaint_id);

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
				redirect('Investigation/view', 'refresh');
			}
			else
			{
				exit('Error! There is something wrong with the server. Contact your site developer');

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
			$remarks = $this->input->post('remarks');
			$rows = $this->Investigation_model->check_complaint_existence($complaint_id)->num_rows();

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

			$investigate = $this->Investigation_model->add($data);
			if($investigate)
			{
				$this->Investigation_model->update_complaint_status($complaint_id, 'process');
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
			$remarks = $this->input->post('remarks');
			$receiver = $this->input->post('employee_id');
			$rows = $this->Investigation_model->investigation_local_existence($complaint_id, $receiver)->num_rows();

			if($rows > 0)
			{
				$this->session->set_flashdata('error', 'Server Error! The investigation wasn\'t assigned.');
				redirect('Investigation/legal_view', 'refresh');
			}

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

			$investigate = $this->Investigation_model->add($data);
			$investigation_id = $this->db->insert_id();

			if($_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $complaint_id, $investigation_id, 'legal');

			if($investigate)
			{
				$this->Investigation_model->update_status($complaint_id, 'process', 'legal');
				$this->session->set_flashdata('success', 'Success! The investigation was assigned successfully.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Server Error! The investigation wasn\'t assigned.');
			}
		}
		else
		{
			show_404();
		}

		redirect('Investigation/legal_view', 'refresh');
	}

	function ajax_check()
	{
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
	}


	/*** Investigation functions of Legal Department starts here ***/



	function legal_resolve()
	{
		
		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;
			$employee_id = 4;

			$complaint_id = $this->input->post('complaint_id');
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
				'status' => 'resolved'
			);

			$updated = $this->Investigation_model->add($data);
			$investigation_id = $this->db->insert_id();
			if($_FILES['docs']['size'][0] != 0)
				$uploaded = $this->upload_files($_FILES, $complaint_id, $investigation_id, 'legal');

			$status_changed = FALSE;

			if($updated)
			{
				$inv_status = $this->Investigation_model->update_investigation_status($complaint_id, 'resolved');
				$status_changed = $this->Investigation_model->update_complaint_status($complaint_id, 'review');

				$this->session->set_flashdata('success', 'Investigation closed successfully.');
			}
			else
			{
				exit('Error! There seems to be a problem at your server. Contact developer of the site');
			}

		}

		redirect('Investigation/legal_view', 'refresh');
	}


	private function upload_files($files, $complaint_id, $investigation_id, $sender)
    {
    	  $data = array();
        // If file upload form submitted
	        // if($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])){
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

	/*** ./ Legal Department ***/


	/** ./ Local Investigation **/
	function local_view($id=FALSE)
	{
		if($id === FALSE)
		{
			$total_rows = $this->Investigation_model->get_complaints_local()->num_rows();
			$url = 'Investigation/local_view';

			$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

			$data['title'] = 'List of Investigations';

			$data['complaints'] = $this->Investigation_model->get_complaints_local()->result();
			$data['content'] = $this->load->view('Investigation/local-view', $data, TRUE);
				
		}
		else
		{
			$data['title'] = 'Investigation Detail';
			$data['detail'] = $this->Investigation_model->get_complaints_local($id)->row();
			$data['province'] = $this->User_panel_model->get_province();
			$data['designations'] = $this->Designation_model->get_designations()->result();

			$data['remarks'] = $this->Investigation_model->get_remarks($id);
			
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
			// var_dump($data['detail']); exit;
			$data['content'] = $this->load->view('Investigation/local-detail', $data, TRUE);
			
			if(empty($data['detail']))
				show_404();
		}

		$this->load->view('Investigation/_template', $data);
	}


	function local_resolve()
	{
		
		if(isset($_POST))
		{
			// $employee_id = $this->session->user_id;

			$complaint_id = $this->input->post('complaint_id');
			$investigation_id = $this->input->post('investigation_id');
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

			$updated = $this->Investigation_model->add($data);

			$investigation_id = $this->db->insert_id();
			
			if($_FILES['docs']['size'][0] != 0)
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

		redirect('Investigation/local_view', 'refresh');
	}

	
	// function get_complaints_table()
	// {
	// 	$this->ajax_check();

	// 	$status = $this->input->get('status');
	// 	$complaints = $this->Investigation_model->get_complaints($status)->result();
	// 	$no_of_rows = $this->Investigation_model->get_complaints()->num_rows();


	// 	$data = array();
	// 	$count = 1;

	// 	foreach ($complaints as $complaint) {
	// 		$label = '';
	// 		if($complaint->status == "pending") 
	// 			$label = "label label-warning";
	// 		elseif($complaint->status == "resolved")
	// 			$label = "label label-primary";
	// 		elseif($complaint->status == "review")
	// 			$label = "label label-success";
	// 		elseif($complaint->status == "process")
	// 			$label = "label label-info";

	// 		$data[] = array(
	// 			$complaint->id,
	// 			$count,
	// 			$complaint->complaint_no,
	// 			$complaint->subject,
	// 			$complaint->contact_no,
	// 			$complaint->email,
	// 			$complaint->province,
	// 			date('d-m-Y', strtotime($complaint->created_at)),
	// 			'<td>
	// 				<label class="'. $label .'">'. $complaint->status.'</label>
	// 			</td>'
	// 		);

	// 		$count++;
	// 	}

	// 	$draw = intval($this->input->get('draw'));
	// 	$output = array(
	// 		'draw' => $draw,
	// 		'records_total' => $no_of_rows,
	// 		'records_filtered' => $no_of_rows,
	// 		'data' => $data
	// 	);
		
	// 	echo json_encode($output);
	// }


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

	public function complaints($offset="")
	{

		$total_rows = $this->Investigation_model->get_complaints()->num_rows();
		$url = 'Investigation/complaints';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		
		$data['title'] = 'Print Complaints';
		$data['complaints'] = $this->Investigation_model->get_complaints(FALSE, $this->limit, $offset)->result();
		$data['table_id'] = "complaints-table";
		$data['view_print'] = 'print';
		$data['complaints_table'] = $this->load->view('investigation/tables/complaints-table', $data, TRUE);
		$data['content'] = $this->load->view('investigation/list-complaints', $data, TRUE);
		

		$this->load->view('Investigation/_template', $data);
	}


	function complaint_detail($id)
	{
		$data['title'] = 'Investigation Detail';

		$data['project_head'] = $this->Investigation_model->get_project_head($id);
		$data['detail'] = $this->Investigation_model->get_complaint_detail($id);
		//get_files_and_reviews($complint_id, $sender, $receiver) takes these three arguments
		$data['remarks'] = $this->Investigation_model->get_remarks($id);
		
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
		

		// var_dump($data['detail']); exit;
		$data['content'] = $this->load->view('Investigation/print-view', $data, TRUE);

		if(empty($data['detail']))
			show_404();

		$this->load->view('investigation/_template', $data);
		
	}


	function report($id=FALSE)
	{
		if($id === FALSE)
			show_404();
		
		$data['project_head'] = $this->Investigation_model->get_project_head($id);
		$detail = $this->Investigation_model->get_complaint_detail($id);

		$remarks = $this->Investigation_model->get_remarks($id);

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
			<strong style="font-size: 16px;">CHIP Training &amp; Consulting Pvt Ltd.</strong>';
		
		$pdf->WriteHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);


		$title = '<div></div><h3 style="font-family: helvetica;">Complaint detail and remarks</h3>';
		$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, '', true);
		
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

}