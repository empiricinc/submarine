<?php 

/**
 * 
 */
class Exit_interview extends MY_Controller
{
	
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

        $this->load->database();
        $this->load->model('Exit_interview_model');
        $this->load->model('Resignations_model');
	}

    public function remove_empty_entries($conditions)
    {
        foreach ($conditions as $key => $value) {
            if($value == '')
                unset($conditions[$key]);
        }

        return $conditions;
    }

	function form($resignation_id="")
	{
        if($resignation_id == "")
            show_404();

        $this->load->model('Designations_model');

        $conditions = [
                        'xe.company_id' => $this->session_data['project_id'],
                        'xe.provience_id' => $this->session_data['province_id'],
                        'xer.resignation_id' => $resignation_id
                    ];

        $filtered_conditions = $this->remove_empty_entries($conditions);
 
        $data['title'] = 'Exit Interview Form';
        $data['detail'] = $this->Exit_interview_model->get_detail($filtered_conditions)->row();

        $data['designations'] = $this->Designations_model->get();
        $data['position_leaving_reasons'] = $this->Exit_interview_model->position_leaving_reasons();
        $data['respondent_not_found_reasons'] = $this->Exit_interview_model->respondent_not_found_reasons();
        if(empty($data['detail']))
            show_404();

		$data['content'] = $this->load->view('exit_interview/interview-form', $data, TRUE);
		$this->load->view('exit_interview/_template', $data);
	}

    public function save()
    {
        if(!isset($_POST))
            show_404();

        $employee_id = $this->input->post('employee_id');
        $resignation_id = $this->input->post('resignation_id');
        $supervisor_name = $this->input->post('supervisor_name');
        $last_working_date = $this->input->post('last_working_date');
        $interview_date = $this->input->post('interview_date');
        $respondent_found = $this->input->post('respondent_found');
        $respondent_not_found_reason = $this->input->post('respondent_not_found_reason');
        $respondent_not_found_other_reason = $this->input->post('respondent_not_found_other_reason');
        $endorsed_by_authority = $this->input->post('endorsed_by_authority');
        $authority_name = $this->input->post('authority_name');
        $designation_id = $this->input->post('designation');
        $resignation_enforced = $this->input->post('resignation_enforced');
        $resignation_enforced_detail = $this->input->post('resignation_enforced_detail');
        $position_leaving_reason =  $this->input->post('position_leaving_reason');
        $position_leaving_other_reason = $this->input->post('position_leaving_other_reason');
        $position_leaving_comments = $this->input->post('position_leaving_comments');
        $company_property_returned = $this->input->post('company_property_returned');
        $supervision = $this->input->post('supervision');
        $supervisor_support = $this->input->post('supervisor_support');
        $like_to_rejoin = $this->input->post('like_to_rejoin');

        $added_by = $this->session_data['user_id'];
        $added_date = date('Y-m-d');


        $data = array(
                    'employee_id' => $employee_id,
                    'resignation_id' => $resignation_id,
                    'supervisor_name' => $supervisor_name,
                    'last_working_date' => date('Y-m-d', strtotime($last_working_date)),
                    'interview_date' => date('Y-m-d', strtotime($interview_date)),
                    'respondent_found' => $respondent_found,
                    'respondent_not_found_reason' => $respondent_not_found_reason,
                    'respondent_not_found_other_reason' => $respondent_not_found_other_reason,
                    'endorsed_by_authority' => $endorsed_by_authority,
                    'authority_name' => $authority_name,
                    'designation_id' => $designation_id,
                    'resignation_enforced' => $resignation_enforced,
                    'resignation_enforced_detail' => $resignation_enforced_detail,
                    'position_leaving_reason' => $position_leaving_reason,
                    'position_leaving_other_reason' => $position_leaving_other_reason,
                    'position_leaving_comments' => $position_leaving_comments,
                    'company_property_returned' => $company_property_returned,
                    'supervision' => $supervision,
                    'supervisor_support' => $supervisor_support,
                    'like_to_rejoin' => $like_to_rejoin,
                    'added_by' => $added_by,
                    'added_date' => $added_date
                );

        $query = $this->Exit_interview_model->check_record_existence($resignation_id);
        if($query->num_rows() > 0)
        {
            $interview_id = $query->row()->id;

            $data['updated_by'] = $this->session_data['user_id'];
            $data['updated_date'] = date('Y-m-d');
            $this->update($interview_id, $resignation_id, $data);
        }
        else
        {
            $this->add($resignation_id, $data);
        }

    }


    private function add($resignation_id, $data)
    {

        if($this->Exit_interview_model->add($data))
        {
            $this->Resignations_model->update($resignation_id, array('exit_interview_status' => '1'));
            $this->session->set_flashdata('success', 'Exit interview added successfully.');
        }
        else
        {
            $this->session->set_flashdata('error', 'Exit interview was not added.');
        }

        redirect('Exit_interview/form/'.$resignation_id, 'refresh');

    }

    private function update($interview_id, $resignation_id, $data)
    {
        if($this->Exit_interview_model->update($interview_id, $data))
        {
            $this->Resignations_model->update($resignation_id, array('exit_interview_status' => '1'));
            $this->session->set_flashdata('success', 'Record updated successfully.');
        }
        else
        {
            $this->session->set_flashdata('error', 'Record updation failed.');
        }
        
        redirect('Exit_interview/form/'.$resignation_id, 'refresh');
    }


}

 ?>