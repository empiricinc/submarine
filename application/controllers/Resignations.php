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
            $status = (int) $this->input->get('status');
            
            if($employeeName != '')
                $employeeName = '%'.$employeeName.'%';

            $conditions['xer.resignation_date >='] = $fromDate;
            $conditions['xer.resignation_date <='] = $toDate;
            $conditions['CONCAT_WS(" ", xe.first_name, xe.last_name) LIKE'] = $employeeName;
            $conditions['xe.designation_id'] = $designation;
            $conditions['xer.status'] = $status;
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

		$data['title'] = 'Resignations';
        $data['query_string'] = $_SERVER['QUERY_STRING'];

        $data['projects'] = $this->Projects_model->get($this->session_data['project_id']); 
        $data['designations'] = $this->Designations_model->get_by_project($this->session_data['project_id']);
        $data['resignation_status'] = $this->Resignations_model->get_status();

		$data['content'] = $this->load->view('resignations/view', $data, TRUE);
		$this->load->view('resignations/_template', $data);
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
            $data['comments'] = $this->Resignations_model->get_status_comments($resignation_id);
            $data['reasons'] = $this->Resignations_model->resignation_reversion_reasons();

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


    function update_status()
    {
        if(!isset($_POST))
            show_404();

        $added_by = $this->session_data['user_id'];
        $resignation_id = $this->input->post('resignation_id');
        $resignation_date = $this->input->post('resignation_date');
        $employee_id = $this->input->post('employee_id');
        $status_text = $this->input->post('status_text');
        $added_date = $this->input->post('added_date');
        $description = $this->input->post('description'); 
        $status_id = $this->Resignations_model->get_status_id($status_text)->id;

        $updated_data = array(
                        'status' => $status_id,
                        );

        if($status_text == 'issued' || $status_text == 'delete')
        {
            $updated_data['decision_by'] = $added_by;
            $updated_data['decision_date'] = $added_date;

        }

        $update_resignation = $this->Resignations_model->update($resignation_id, $updated_data);

        $data = array(
                    'resignation_id' => $resignation_id,
                    'comment_text' => $description,
                    'status_id' => $status_id,
                    'added_by' => $added_by,
                    'added_date' => $added_date
                );

        $add_comment = $this->Resignations_model->add($data);

        if($status_text == 'issued')
        {
            $this->update_job_position($resignation_id, '0');

            if(date('Y-m-d') == $resignation_date)
                $this->Resignations_model->update_employee_resignation_status($employee_id, '5', '0');
            
        }
      
        if($add_comment)
            $this->session->set_flashdata('success', 'Status updated successfully.');
        else
            $this->session->set_flashdata('error', 'Status updation failed.');

        redirect('Resignations/detail/'.$resignation_id, 'refresh');
        
    }

    public function reversion()
    {
        if(!isset($_POST))
            show_404();

        $added_by = $this->session_data['user_id'];

        $resignation_id = $this->input->post('resignation_id');
        $employee_id = $this->input->post('employee_id');
        $added_date = $this->input->post('added_date');
        $status_text = $this->input->post('status_text');
        $status_id = $this->Resignations_model->get_status_id($status_text)->id;

        $reason = $this->input->post('reason');
        $request_date = $this->input->post('request_date');
        $approval_date = $this->input->post('approval_date');
        $comment_text = $this->input->post('description');

        $data = array(
                    'status' => $status_id,
                    'reversion_request_date' => $request_date,
                    'reversion_reason' => $reason,
                    'reversion_approval_date' => $approval_date,
                    'reversion_approved_by' => $added_by
                );

        $this->Resignations_model->update($resignation_id, $data);

        $data = array(
                    'resignation_id' => $resignation_id,
                    'comment_text' => $comment_text,
                    'status_id' => $status_id,
                    'added_by' => $added_by,
                    'added_date' => $added_date
                );
        
        $added = $this->Resignations_model->add($data);

        if($added)
        {
            $this->update_job_position($resignation_id, '1');
            /* On resignation reversion status => 1, is_active => 1 */
            $this->Resignations_model->update_employee_resignation_status($employee_id, '1', '1');
            $this->session->set_flashdata('success', 'Resignation was reversed successfully.');
        }
        else
        {
            $this->session->set_flashdata('error', 'Resignation reversion failed.');
        }

        redirect('Resignations/detail/'.$resignation_id, 'refresh');
    }

    public function cron_resignations()
    {
        if(!$this->input->is_cli_request())
            show_404();
        
        $current_date = date('Y-m-d');

        $this->db->select('xer.resignation_id, xer.employee_id, xe.job_code');
        $this->db->join('xin_employees xe', 'xer.employee_id = xe.employee_id', 'left');
        $this->db->where(array('xer.resignation_date =' => $current_date, 'exit_interview_status' => '1'));
        $result = $this->db->get('xin_employee_resignations xer')->result();

        foreach ($result as $r) {
            $employee_id = $r->employee_id;
            $resignation_id = $r->resignation_id;
            $job_code = $r->job_code;

            $this->db->where(array('employee_id' => $employee_id, 'is_active' => '1'));
            $this->db->update('xin_employees', array('is_active' => '0', 'status' => '5'));

            $this->db->where(array('job_code' => $job_code));
            $this->db->update('location_job_position', array('status' => '0'));
        }
    }

    public function acceptance_letter()
    {
        $this->ajax_check();
        
        $this->load->model('Disciplinary_model');
        $resignation_id = $this->input->post('resignation_id');

        $detail = $this->Resignations_model->employee_detail_for_letter($resignation_id);
        $data = $this->Resignations_model->acceptance_letter_template();

        $name = ucwords($detail->emp_name);
        $title = $detail->job_title;
        $cnic = $detail->cnic;

        $letter_no = '';
        $notice_date = date('d-m-Y', strtotime($detail->notice_date));
        $resignation_date = date('d-m-Y', strtotime($detail->resignation_date));

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
            $short_title = (isset($title_array[1])) ? $title_array[1] : '';
            $province = (isset($title_array[2])) ? ucwords($title_array[2]) : '';
            $district = (isset($title_array[3])) ? ucwords($title_array[3]) : '';
            $tehsil = (isset($title_array[4])) ? ucwords($title_array[4]) : '';
            $uc = (isset($title_array[5])) ? ucwords($title_array[5]) : '';

            $this->db->select('MAX(id) AS id');
            $disciplinary_id = $this->db->get('disciplinary')->row()->id;

            /* 'RL' initials for Resignation Letter.
             * '/N' because there is no category unlike in Disciplinary actions.
             * Its basically Non Disciplinary Category
            */
            $letter_no = 'RL-' . $province . '-' . $disciplinary_id . '/' . date('M') . '/N';

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
            $template = str_replace('[[reporting_date]]', $notice_date, $template);
            $template = str_replace('[[last_working_date]]', $resignation_date, $template);

            $template = str_replace('[[cnic]]', $cnic, $template);
            $template = str_replace('[[letter_no]]', $letter_no, $template);

            $template = str_replace('[[province]]', $province, $template);
            $template = str_replace('[[district]]', $district, $template);
            $template = str_replace('[[tehsil]]', $tehsil, $template);
            $template = str_replace('[[uc]]', $uc, $template);
        }
        $this->json_response($template);
    }

    public function update()
    {
        $resignation_id = $this->input->post('id');
        $acceptance_letter = $this->input->post('acceptance_letter');
        
        $data = array(
                    'acceptance_letter' => $acceptance_letter
                );

        $update = $this->Resignations_model->update($resignation_id, $data);
        if($update)
            echo '1';
        else
            echo '0';
    }


    private function update_job_position($resignation_id="", $status)
    {
        $resignation_date = '';

        $data = $this->Resignations_model->get_resignation_date($resignation_id);

        $job_code = $data->job_code;

        if($status == 0)
            $resignation_date = $data->resignation_date;

        $update = array(
                'resignation_date' => $resignation_date, 
                'status' => $status
            );

       
        if($job_code != '')
            return $this->Resignations_model->update_location_job_position($update, $job_code);
        else
            return false;

    }

}

