<?php defined("BASEPATH") OR exit('No direct script access allowed!');
/**
 * Filename: Leaves.php
 * Filepath: controllers / Leaves.php
 * Author: Saddam
 */
class Leaves extends CI_Controller
{
    /**
     * This controller is responsible for all the management of leaves i.e. Approve, reject, in process, forward 
     * and other operations over the leave requests.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('leaves_model');
        $this->load->model('Xin_model');
        $this->load->library('session');
    }
    // Load the index function.
    public function index($offset = NULL){
    	$limit = 10;
    	if(!empty($offset)){
    		$this->uri->segment(3);
    	}
    	$this->load->library('pagination');
    	$config['uri_segment'] = 3;
		$config['base_url'] = base_url('leaves/index');
		$config['total_rows'] = $this->leaves_model->count_pending_leaves();
		$config['per_page'] = $limit;
		$config['num_links'] = 3;
		$config["full_tag_open"] = '<ul class="pagination">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li>';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li>';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = 'next &raquo;';
	    $config["next_tag_open"] = '<li>';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = "prev &laquo;";
	    $config["prev_tag_open"] = "<li>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li>";
	    $config["num_tag_close"] = "</li>";
		$this->pagination->initialize($config);
    	$data['pen_leaves'] = $this->leaves_model->pending_leaves($limit, $offset);
    	$data['app_leaves'] = $this->leaves_model->approved_leaves($limit, $offset);
    	$data['rej_leaves'] = $this->leaves_model->rejected_leaves($limit, $offset);
    	// $data['path_url'] = 'leaves_dashboard';
    	$data['subview'] = $this->load->view('leaves/leaves_dashboard', $data, TRUE);
    	$this->load->view('layout_main', $data); // Page load.
    }
    // List of pending leaves.
    public function list_pending($offset = NULL){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $this->load->library('pagination');
        $config['uri_segment'] = 3;
        $config['base_url'] = base_url('leaves/list_pending');
        $config['total_rows'] = $this->leaves_model->count_pending_leaves();
        $config['per_page'] = $limit;
        $config['num_links'] = 3;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = 'next &raquo;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "prev &laquo;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $data['pen_leaves'] = $this->leaves_model->pending_leaves($limit, $offset);
        // $data['path_url'] = 'leaves_dashboard';
        $data['subview'] = $this->load->view('leaves/pending_leaves', $data, TRUE);
        $this->load->view('layout_main', $data); // Page load.
    }
    // List of approved leaves.
    public function list_approved($offset = NULL){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $this->load->library('pagination');
        $config['uri_segment'] = 3;
        $config['base_url'] = base_url('leaves/list_approved');
        $config['total_rows'] = $this->leaves_model->count_approved_leaves();
        $config['per_page'] = $limit;
        $config['num_links'] = 3;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = 'next &raquo;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "prev &laquo;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $data['app_leaves'] = $this->leaves_model->approved_leaves($limit, $offset);
        // $data['path_url'] = 'leaves_dashboard';
        $data['subview'] = $this->load->view('leaves/approved_leaves', $data, TRUE);
        $this->load->view('layout_main', $data); // Page load.
    }
    // Rejected leaves
    public function list_rejected($offset = NULL){
        $limit = 10;
        if(!empty($offset)){
            $this->uri->segment(3);
        }
        $this->load->library('pagination');
        $config['uri_segment'] = 3;
        $config['base_url'] = base_url('leaves/list_rejected');
        $config['total_rows'] = $this->leaves_model->count_rejected_leaves();
        $config['per_page'] = $limit;
        $config['num_links'] = 3;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config['next_link'] = 'next &raquo;';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = "prev &laquo;";
        $config["prev_tag_open"] = "<li>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='active'><a href='javascript:void(0);'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        $this->pagination->initialize($config);
        $data['rej_leaves'] = $this->leaves_model->rejected_leaves($limit, $offset);
        // $data['path_url'] = 'leaves_dashboard';
        $data['subview'] = $this->load->view('leaves/rejected_leaves', $data, TRUE);
        $this->load->view('layout_main', $data); // Page load.
    }
    // Approve leave request. [Paid leave]
    public function approve_leave($leave_id){
    	$data = array(
    		'status' => 2
    	);
    	if($this->leaves_model->approve_leave($leave_id, $data)){
    		$this->session->set_flashdata('success', '<strong>Success !</strong> The leave request has been approved.');
    		redirect('leaves');
    	}else{
    		echo "The operation wasn't successful.";
    	}
    }
    // Approve leave request. [Unpaid leave].
    public function approve_leave_unpaid($leave_id){
        echo "You're not authorized to approve this type of leaves yet...<br>"; //exit;
        $data = array(
            'status' => 4
        );
        // Check for employee_id and deduct salary accordingly! [while granting unpaid leave.]
        $unpaid = $this->db->select('user_id, basic_salary')->from('employee_salary')->where('user_id', 248)->get()->row();
        echo 'Basic salary: '.$unpaid->basic_salary.'<br>';
        $basic_salary = $unpaid->basic_salary .'<br>';
        $leaves = 1;
        $per_day = (int)$basic_salary / 30;
        echo 'Per day salary: '.$per_day * $leaves .'<br>';
        $deduction = (int)$basic_salary - $per_day;
        echo 'Salary after deduction of a day leave: '.$deduction;
        var_dump($unpaid);
        exit;
        if($this->leaves_model->approve_leave_unpaid($leave_id)){            
            $this->session->set_flashdata('success', '<strong>Success !</strong> The leave request has been approved. The leave granted with the deduction is salary.');
            redirect('leaves');
        }else{
            echo "The operation wasn't successful.";
        }
    }
    // Reject leave request. [Any type of leave request]
    public function reject_leave($leave_id){
    	$data = array(
    		'status' => 3
    	);
    	if($this->leaves_model->reject_leave($leave_id, $data)){
    		$this->session->set_flashdata('success', '<strong>Success !</strong> The leave request has been rejected.');
    		redirect('leaves');
    	}else{
    		echo "The operation wasn't successful.";
    	}
    }
    // ------------------------------------- Search forms ------------------------------ //
    // Pending Search.
    public function pending_search(){
        $keyword = $this->input->get('search_pending');
        $data['results'] = $this->leaves_model->search_pending($keyword);
        // $data['path_url'] = 'leaves_dashboard';
        $data['subview'] = $this->load->view('leaves/pending_leaves', $data, TRUE);
        $this->load->view('layout_main', $data); // Page load.
    }
    // Approved Search.
    public function approved_search(){
        $keyword = $this->input->get('search_approved');
        $data['results'] = $this->leaves_model->search_approved($keyword);
        // $data['path_url'] = 'leaves_dashboard';
        $data['subview'] = $this->load->view('leaves/approved_leaves', $data, TRUE);
        $this->load->view('layout_main', $data); // Page load.
    }
    // Rejected Search.
    public function rejected_search(){
        $keyword = $this->input->get('search_rejected');
        $data['results'] = $this->leaves_model->search_rejected($keyword);
        // $data['path_url'] = 'leaves_dashboard';
        $data['subview'] = $this->load->view('leaves/rejected_leaves', $data, TRUE);
        $this->load->view('layout_main', $data); // Page load.
    }

    // ---------------------------------- Leaves policy ------------------------------------------ //
    // Get to the setup page.
    public function leaves_policy(){
        $data['path_url'] = '';
        $data['subview'] = $this->load->view('leaves/leaves_policy', $data, TRUE);
        $this->load->view('layout_main', $data); // Page load.
    }
}

?>