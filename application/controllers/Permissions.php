<?php 

/**
 * 
 */
class Permissions extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
							'Groups_model',
							'Pages_model',
							'Permissions_model'
						));
		$this->list_permissions();
	}

	function view($group_id="")
	{
		// var_dump($this->permissions); exit;
		// if($this->permissions['investigation']['read'] != 1)
		// 	exit('Not allowed');
		if($group_id=="")
		{
			redirect(base_url().'Groups');
		}
		
		$data['title'] = 'Assign Permissions';
		$data['permissions'] = $this->Permissions_model->get_permissions($group_id);
		$data['role'] = $data['permissions'][0]->group_name;
		$data['department'] = $data['permissions'][0]->department_name;
		if(empty($data['permissions']))
		{
			show_404();
		}
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