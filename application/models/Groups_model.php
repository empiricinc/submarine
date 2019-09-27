<?php 

/**
 * 
 */
class Groups_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_groups()
	{
		$this->db->select('ug.id, ug.name, ug.department_id, xd.department_name');
		$this->db->join('xin_departments xd', 'ug.department_id = xd.department_id', 'left');
		// $this->db->join('user_group pg', 'ug.parent = pg.id', 'left');
		$this->db->order_by('ug.id', 'ASC');
		return $this->db->get('user_group ug')->result();
	}

	function add_group($data)
	{
		return $this->db->insert('user_group', $data);
	}


}

 ?>