<?php 

/**
 * 
 */
class Permissions extends MY_Controller
{
	var $session_data;
	function __construct()
	{
		parent::__construct();
		if(empty($this->session->username))
            redirect(base_url());

        $roles = array(1, 2, 3);
        if(!in_array($this->session->username['user_role'], $roles))
			redirect(base_url().'dashboard');

        $this->session_data = array(
					        	'user_id' => $this->session->username['employee_id'], 
					        	'project_id' => $this->session->username['project_id'], 
					        	'province_id' => $this->session->username['provience_id']
					        );
		
		$this->load->model(array(
							'Groups_model',
							'Pages_model',
							'Permissions_model'
						));
		$this->list_permissions();
	}

	function remove_empty_entries($conditions)
	{
		foreach ($conditions as $key => $value) {
			if($value == '')
				unset($conditions[$key]);

		}

		return $conditions;
	}

	function view($group_id="")
	{
		if($group_id=="")
		{
			redirect(base_url().'Groups');
		}

		$conditions = [
					'xe.company_id' => $this->session_data['project_id'],
					'xe.provience_id' => $this->session_data['province_id'],
					'xe.group_id' => $group_id
				];
				
		$filtered_conditions = $this->remove_empty_entries($conditions);

		$data['title'] = 'Assign Permissions';
		$data['permissions'] = $this->Permissions_model->get_permissions($filtered_conditions);
		
		if(empty($data['permissions']))
		{
			show_404();
		}
		$data['role'] = $data['permissions'][0]->group_name;
		$data['department'] = $data['permissions'][0]->department_name;
		
		$data['content'] = $this->load->view('permissions/index', $data, TRUE);
		$this->load->view('permissions/_template', $data);
	}

	function update()
	{
		$this->ajax_check();

		$page = $this->input->post('page');
		$action = $this->input->post('action');
		$group = $this->input->post('group');
		$status = $this->input->post('status');

		$data = array($action => $status);

		if($page != "")
			$result = $this->Permissions_model->update_permissions($data, $page, $group);
		elseif($page == "")
			$result = $this->Permissions_model->update_permissions($data, $page, $group);

		if($result)
			echo '1';
		else
			echo '0';
	}



}


 ?>