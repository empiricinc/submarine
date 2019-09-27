<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Terminations extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// if(!isset($this->session->user_id))
		// 	redirect(base_url());
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('form', 'url', 'html'));
		$this->load->model('Terminations_model');
	}


	public function add()
	{

		$data['title'] = "Employee Termination Form";
		$data['employees'] = $this->Terminations_model->get_employees();
		$data['reasons'] = $this->Terminations_model->get_termination_reasons();
		$data['content'] = $this->load->view("terminations/add", $data, TRUE);
		$this->load->view('terminations/_template', $data);
	}

	public function terminate()
	{
		// $terminated_by = $this->session->user_id;
		$terminated_by = 5;

		$this->form_validation->set_rules('employee', 'Employee', 'required');
		$this->form_validation->set_rules('reason', 'Reason', 'required');
		// $this->form_validation->set_rules('other_reason', 'Other reason', 'required');
		$this->form_validation->set_rules('notice_date', 'Notice Date', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('error', '<strong>Error!</strong> All fields are required.');
			redirect('Terminations/add', 'refresh');
		}

		$employee = $this->input->post('employee');
		$reason = $this->input->post('reason');
		$other_reason_text = $this->input->post('other_reason');
		$notice_date = $this->input->post('notice_date');
		$description = $this->input->post('description');

		$notice_date = date("Y-m-d");
		$status = '0';

		$data = array(
					'employee_id' => $employee,
					'reason_id' => $reason,
					'other_reason' => $other_reason_text,
					'notice_date' => $notice_date,
					'description' => $description,
					'terminated_by' => $terminated_by,
					'status' => $status
					
				);

		if($this->Terminations_model->add_new($data))
		{
			$this->session->set_flashdata('success', '<strong>Success!</strong> Employee terminated successfully.');
		}
		else
		{
			$this->session->set_flashdata('error', '<strong>Error!</strong> Employee termination failed.');
		}

		redirect('Terminations/add', 'refresh');
	}


	function view()
	{
		$total_rows = $this->Terminations_model->get_terminations()->num_rows();
		$url = 'Terminations/view';

		$this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		$data['title'] = "List of terminated employees";
		$data['terminated'] = $this->Terminations_model->get_terminations()->result();
		$data['content'] = $this->load->view("terminations/view", $data, TRUE);
		$this->load->view('terminations/_template', $data);
	}

	function detail()
	{
		$this->db->join('xin_employees xe', 't.employee_id = xe.employee_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('termination_reasons rr', 't.reason_id = rr.id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$termination = $this->db->get('termination t')->row();


		// $this->ajax_check();
		$termination_id = $this->input->post('id');

		$output = '<div class="row">
        				<div class="col-md-3">
        					<label for="">Employee Name</label>
        				</div>
        				<div class="col-md-9">
        				'. ucwords($termination->first_name." ".$termination->last_name) .'			
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Reason</label>
        				</div>
        				<div class="col-md-9">
        				'. $termination->reason_text .'			
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Other Reason</label>
        				</div>
        				<div class="col-md-9">
        				'. $termination->other_reason .'		
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Notice Date</label>
        				</div>
        				<div class="col-md-9">
							'. $termination->notice_date .'
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Description</label>
        				</div>
        				<div class="col-md-9">
							'. $termination->description .'
        				</div>
        			</div>';



        echo $output;
	}


}