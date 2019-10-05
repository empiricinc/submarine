<?php 

/**
 * 
 */
class Groups extends MY_Controller
{
	var $session_data;
	function __construct()
	{
		parent::__construct();
		if(empty($this->session->username))
            redirect(base_url());

        $roles = array(1);
        if(!in_array($this->session->username['user_role'], $roles))
			redirect(base_url().'dashboard');

		$this->session_data = array(
					        	'user_id' => $this->session->username['employee_id'], 
					        	'project_id' => $this->session->username['project_id'], 
					        	'province_id' => $this->session->username['province_id']
					        );
		
		$this->load->model(array(
							'Groups_model',
							'Pages_model',
							'Permissions_model'
						));
	}

	function index()
	{
		$data['title'] = 'Department Roles';
		$data['departments'] = $this->db->get('xin_departments')->result();
		$data['groups'] = $this->Groups_model->get_groups();
		$data['controller'] = $this;
		$data['content'] = $this->load->view('groups/index', $data, TRUE);
		$this->load->view('groups/_template', $data);
	}

	function add()
	{
		$employee_id = $this->session->user_id;

		if(isset($_POST))
		{
			$name = $this->input->post('group_name');
			$department_id = $this->input->post('department');
			
			$data = array(
				'name' => strtolower($name), 
				'department_id' => $department_id,
				'created_by' => $employee_id
			);

			$result = $this->Groups_model->add_group($data);
			$group_id = $this->db->insert_id();

			if($result)
			{
				/* If Group is created than add permissions for each page */
				$permissions_array = array();
				$pages = $this->Pages_model->get_pages();
				foreach ($pages as $p) {
					$permission = array(
								'page_id' => $p->id,
								'group_id' => $group_id,
								'create' => 1,
								'read' => 1,
								'update' => 1,
								'delete' => 1
								);
					array_push($permissions_array, $permission);
				}
				
				$this->Permissions_model->add_permissions($permissions_array);

				$this->session->set_flashdata('success', '<label>Success!</label> Role Added Successfully');
				$this->session->set_flashdata('department', $department_id);
			}
			else
			{
				$this->session->set_flashdata('error', '<label>Error!</label> Role Insertion Failed');
			}
		}
		else
		{
			show_404();
		}

		redirect('Groups/index', 'refresh');
	}


	function department_roles($department_id)
	{
		return $this->db->get_where('user_group', array('department_id' => $department_id))->result();
	}


}


 ?>