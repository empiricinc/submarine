<?php 

/**
 * 
 */
class Permissions_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_permissions($conditions=array())
	{
		$this->db->select('p.name AS page_name, up.*, ug.name AS group_name, xd.department_name');
		$this->db->join('permissions up', 'p.id = up.page_id', 'left');
		$this->db->join('user_group ug', 'up.group_id = ug.id', 'left');
		$this->db->join('xin_employees xe', 'ug.id = xe.group_id', 'left');
		$this->db->join('xin_departments xd', 'ug.department_id = xd.department_id', 'left');

		// $this->db->join('xin_office_location xol', 'ug.project_id = xol.company_id', 'left');
		$this->db->where($conditions);
		return $this->db->get('pages p')->result();
	}

	function add_permissions($data)
	{
		return $this->db->insert_batch('permissions', $data);
	}

	function update_permissions($data, $page="", $group)
	{
		if($page != "")
			$this->db->where(array('page_id' => $page, 'group_id' => $group));
		else
			$this->db->where(array('group_id' => $group));

		return $this->db->update('permissions', $data);
	}

	function get_page_permissions($page_id, $group_id)
	{
		$this->db->select('p.create, p.read, p.update, p.delete');
		// $this->db->join('user_group ug', 'p.group_id = ug.id', 'left');
		// $this->db->join('xin_office_location xol', 'ug.project_id = xol.company_id', 'left');
		$this->db->where(array('p.page_id' => $page_id, 'p.group_id' => $group_id));
		return $this->db->get('permissions p')->row_array();
	}

	// function get_page_permissions($page_id, $group_id)
	// {
	// 	$this->db->select('p.create, p.read, p.update, p.delete');
	// 	$this->db->where(array('p.page_id' => $page_id, 'p.group_id' => $group_id));
	// 	return $this->db->get('permissions p')->row_array();
	// }



}

 ?>