<?php 

/**
 * 
 */
class Resignations extends MY_Controller
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

		$this->load->model(array('Resignations_model', 'Projects_model', 'Designations_model'));
	}


    function remove_empty_entries($conditions)
    {
        foreach ($conditions as $key => $value) {
            if($value == '')
                unset($conditions[$key]);

        }

        return $conditions;
    }


	function view($offset="")
	{
		
        $conditions = [
                    'xe.company_id' => $this->session_data['project_id'],
                    'xe.provience_id' => $this->session_data['province_id']
                ];

        if(isset($_GET['search']))
        {
            $fromDate = $this->input->get('from_date');
            $toDate = $this->input->get('to_date');
            $employeeName = $this->input->get('employee_name');
            $project = (int) $this->input->get('project');
            $designation = (int) $this->input->get('designation');
            
            if($employeeName != '')
                $employeeName = '%'.$employeeName.'%';

            $conditions['xer.resignation_date >='] = $fromDate;
            $conditions['xer.resignation_date <='] = $toDate;
            $conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
            $conditions['xe.designation_id'] = $designation;
            if($project != 0)
                $conditions['xe.company_id'] = $project;
            
        } 

        $filtered_conditions = $this->remove_empty_entries($conditions);
        $total_rows = $this->Resignations_model->get_resignations($filtered_conditions)->num_rows();
        $url = 'Reports/resignations';

        $this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);
        $data['r_employees'] = $this->Resignations_model->get_resignations($filtered_conditions, $this->limit, $offset)->result();
        
        $data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
        $data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);

		$data['title'] = 'List of Resigned Employees';
        $data['query_string'] = $_SERVER['QUERY_STRING'];

        $data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
        $data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
		$data['content'] = $this->load->view('resignations/resigned-list', $data, TRUE);
		$this->load->view('resignations/_template', $data);
	}

    function requests($offset="")
    {
        $conditions = [
                    'xe.company_id' => $this->session_data['project_id'],
                    'xe.provience_id' => $this->session_data['province_id']
                ];

        if(isset($_GET['search']))
        {
            $fromDate = $this->input->get('from_date');
            $toDate = $this->input->get('to_date');
            $employeeName = $this->input->get('employee_name');
            $project = (int) $this->input->get('project');
            $designation = (int) $this->input->get('designation');
            
            if($employeeName != '')
                $employeeName = '%'.$employeeName.'%';

            $conditions['xer.resignation_date >='] = $fromDate;
            $conditions['xer.resignation_date <='] = $toDate;
            $conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
            $conditions['xe.designation_id'] = $designation;
            if($project != 0)
                $conditions['xe.company_id'] = $project;
            
        } 

        $filtered_conditions = $this->remove_empty_entries($conditions);
        $data['r_employees'] = $this->Resignations_model->get_requests($filtered_conditions, $this->limit, $offset)->result();
        
        $total_rows = $this->Resignations_model->get_requests($filtered_conditions)->num_rows();
        $url = 'Resignations/requests';
        $this->pagination_initializer($this->limit, $this->num_links, $total_rows, $url);

        $data['title'] = 'Resignation Requests';
        $data['query_string'] = $_SERVER['QUERY_STRING'];

        $data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
        $data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
        $data['content'] = $this->load->view('resignations/requests', $data, TRUE);
        $this->load->view('resignations/_template', $data);
    }

    function accept_resignation($resignation_id)
    {
        $employee_id = $this->session_data['user_id'];

        $date = date('Y-m-d');

        $data = array(
                    'decision_by' => $employee_id,
                    'decision_date' => $date,
                    'status' => '1'
                );

        $res = $this->Resignations_model->accept_resignation($resignation_id, $data);

        if($res)
        {
            $this->session->set_flashdata('success', '<strong>Done!</strong> Resignation Accepted');
            redirect('Resignations/requests');
        }
        else
        {
            $this->session->set_flashdata('success', '<strong>Error!</strong> Server Problem');
            redirect('Resignations/requests');
        }

    }

    function reject_resignation($resignation_id)
    {
        $employee_id = $this->session_data['user_id'];

        $date = date('Y-m-d');

        $data = array(
                    'decision_by' => $employee_id,
                    'decision_date' => $date,
                    'status' => '-1'
                );

        $res = $this->Resignations_model->accept_resignation($resignation_id, $data);

        if($res)
        {
            $this->session->set_flashdata('success', '<strong>Done!</strong> Resignation Rejected');
            redirect('Resignations/requests');
        }
        else
        {
            $this->session->set_flashdata('success', '<strong>Error!</strong> Server Problem');
            redirect('Resignations/requests');
        }

    }


    function detail($resignation_id)
    {
    
        if(!empty($resignation_id))
        {
            $conditions = [
                        'xe.company_id' => $this->session_data['project_id'],
                        'xe.provience_id' => $this->session_data['province_id'],
                        'xer.resignation_id' => $resignation_id
                    ];
            $filtered_conditions = $this->remove_empty_entries($conditions);
            
            $this->load->model('Resignations_model');
            $data['title'] = "Employee Resignation Detail";

            $data['detail'] = $this->Resignations_model->get_detail($filtered_conditions)->row();
            if(empty($data['detail']))
            {
                show_404();
            }
            $data['content'] = $this->load->view('resignations/detail', $data, TRUE);
            $this->load->view('resignations/_template', $data);
        }
        else
        {
            show_404();
        }
        
    }

    public function cron_resignations()
    {
        $current_date = date('Y-m-d');

        $this->db->select('resignation_id, employee_id');
        $this->db->where(array('resignation_date <=' => $current_date, 'status' => '1'));
        $result = $this->db->get('xin_employee_resignations')->result();

        foreach ($result as $r) {
            $employee_id = $r->employee_id;
            $resignation_id = $r->resignation_id;

            $this->db->where(array('employee_id' => $employee_id, 'is_active' => '1'));
            $this->db->update('xin_employees', array('is_active' => '0', 'status' => '5'));

            $this->db->where(array('resignation_id' => $resignation_id));
            $this->db->update('xin_employee_resignations', array('status' => '2'));
        }
    }

}

