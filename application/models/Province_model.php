<?php 

/**
 * 
 */
class Province_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get()
	{
		return $this->db->get('provinces')->result();
	}

	function get_by_project($project_id = "")
    {
    	if($project_id == "")
    		return $this->db->get('provinces')->result();
    	
        $this->db->select('DISTINCT(p.id), p.name');
        $this->db->join('xin_office_location xol', 'p.id = xol.province_id', 'left');
        $this->db->where('xol.company_id', $project_id);
        return $this->db->get('provinces p')->result();

    }

    
}





 ?>