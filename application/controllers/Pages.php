<?php 

/**
 * 
 */
class Pages extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
							'Groups_model',
							'Pages_model',
							'Permissions_model'
						));
	}

	function index()
	{
		$data['title'] = 'New Page/Menu';
		$data['pages'] = $this->Pages_model->get_pages();
		$data['content'] = $this->load->view('pages/index', $data, TRUE);
		$this->load->view('pages/_template', $data);
	}

	function add()
	{
		// $employee_id = $this->session->user_id;
		$employee_id = 1;
		if(isset($_POST))
		{
			$name = $this->input->post('page_name');
			$url = $this->input->post('url');
			$parent = $this->input->post('parent');
			$slug = str_replace(' ', '_', trim(strtolower($name)));
			// var_dump($_POST); exit;
			$data = array(
				'name' => strtolower($name), 
				'slug' => $slug,
				'parent' => $parent,
				'url' => $url,
				'created_by' => $employee_id
			);

			$result = $this->Pages_model->add_page($data);
			$page_id = $this->db->insert_id();

			if($result)
			{
				/* If Page is created than add permissions for each group */
				$permissions_array = array();
				$groups = $this->Groups_model->get_groups();
				foreach ($groups as $g) {
					$permission = array(
								'page_id' => $page_id,
								'group_id' => $g->id,
								'create' => 1,
								'read' => 1,
								'update' => 1,
								'delete' => 1
								);
					array_push($permissions_array, $permission);
				}
				
				$this->Permissions_model->add_permissions($permissions_array);
				$this->session->set_flashdata('success', '<label>Success!</label> Page Added Successfully');
			}
			else
			{
				$this->session->set_flashdata('error', '<label>Error!</label> Page Insertion Failed');
			}
		}
		else
		{
			show_404();
		}

		redirect('Pages/index', 'refresh');
	}





}


 ?>