<?php 

/**
 * 
 */
class Locations_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get()
	{
		return $this->db->get('xin_office_location')->result();
	}

	function get_by_project($project_id=FALSE)
    {
    	if($project_id == FALSE)
    		return $this->db->get('xin_office_location')->result();
    	
        $this->db->select('xol.location_id, xol.location_name');
        $this->db->where('xol.company_id', $project_id);
        return $this->db->get('xin_office_location xol')->result();

    }

    
}





 ?>