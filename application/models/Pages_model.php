<?php 

/**
 * 
 */
class Pages_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_pages()
	{
		$this->db->select('p.id, p.name, p.slug, p.url, p.parent, pp.name AS parent_page');
		$this->db->join('pages pp', 'p.parent = pp.id', 'left');
		$this->db->order_by('p.id', 'ASC');
		return $this->db->get('pages p')->result();
	}

	function add_page($data)
	{
		return $this->db->insert('pages', $data);
	}


}

 ?>