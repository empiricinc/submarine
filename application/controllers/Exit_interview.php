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
        $this->load->model('Resignations_model');
        $conditions = [
                        'xe.company_id' => $this->session_data['project_id'],
                        'xe.provience_id' => $this->session_data['province_id'],
                        'xer.resignation_id' => $resignation_id,
                        'xer.exit_interview_status !=' => '1'
                    ];

        $filtered_conditions = $this->remove_empty_entries($conditions);
 
        $data['title'] = 'Exit Interview Form';
        $data['detail'] = $this->Exit_interview_model->resignation_detail($filtered_conditions)->row();
        
        if(empty($data['detail']))
            show_404();

		$data['content'] = $this->load->view('exit_interview/interview-form', $data, TRUE);
		$this->load->view('exit_interview/_template', $data);
	}


}

 ?>