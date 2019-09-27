<?php 

/**
 * 
 */
class Resg_users extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	function view()
	{
		$this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
		// $this->db->join('xin_designations xd', 'xer.designation_id = xd.designation_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$data['r_employees'] = $this->db->get('xin_employee_resignations xer')->result();
		// print_r($data); exit;
		$data['title'] = 'Resigned List';
		$data['content'] = $this->load->view('resignations/resigned-list', $data, TRUE);
		$this->load->view('resignations/_template', $data);
	}

	function detail()
	{
		$this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
		$this->db->join('xin_designations xd', 'xe.designation_id = xd.designation_id', 'left');
		$this->db->join('resignation_reasons rr', 'xer.reason_id = rr.reason_id', 'left');
		$this->db->join('xin_companies xc', 'xe.company_id = xc.company_id', 'left');
		$resignation = $this->db->get('xin_employee_resignations xer')->row();


		// $this->ajax_check();
		$resignation_id = $this->input->post('id');

		$output = '<div class="row">
        				<div class="col-md-3">
        					<label for="">Employee Name</label>
        				</div>
        				<div class="col-md-9">
        				'. ucwords($resignation->first_name." ".$resignation->last_name) .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Reason</label>
        				</div>
        				<div class="col-md-9">
        				'. $resignation->reason_text .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Other Reason</label>
        				</div>
        				<div class="col-md-9">
        				'. $resignation->reason .'
        					
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Notice Date</label>
        				</div>
        				<div class="col-md-9">
							'. $resignation->notice_date .'
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Subject</label>
        				</div>
        				<div class="col-md-9">
							'. $resignation->subject .'
        				</div>
        			</div>
        			<div class="row">
        				<div class="col-md-3">
        					<label for="">Description</label>
        				</div>
        				<div class="col-md-9">
							'. $resignation->description .'
        				</div>
        			</div>';



        echo $output;
	}

}

