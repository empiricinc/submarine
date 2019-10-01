<?php 

/**
 * 
 */
class Projects_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get($project_id=FALSE)
    {
        if($project_id == FALSE)
            return $this->db->get('xin_companies')->result();

    	$this->db->select('xin_companies.company_id, xin_companies.name');
    	if($project_id == FALSE)
        	return $this->db->get('xin_companies')->result();
        else
        	return $this->db->get_where('xin_companies', array('company_id' => $project_id))->result();
    }

    
}





 ?>