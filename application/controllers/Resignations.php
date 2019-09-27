<?php 

/**
 * 
 */
class Resignations extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
                // if(!isset($this->session->user_id))
                //         redirect(base_url());
		$this->load->model('Resignations_model');
	}

	function view()
	{
		$data['r_employees'] = $this->Resignations_model->get_resignations()->result();
		// print_r($data); exit;
                $total_rows = $this->Resignations_model->get_resignations()->num_rows();
                $url = 'Resignations/view';

                $this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
		$data['title'] = 'List of Resigned Employees';
		$data['content'] = $this->load->view('resignations/resigned-list', $data, TRUE);
		$this->load->view('resignations/_template', $data);
	}

	function detail()
	{
        $resignation_id = $this->input->post('id');
		$resignation = $this->Resignations_model->get_detail($resignation_id)->row();

		// $this->ajax_check();

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

