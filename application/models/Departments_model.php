<?php 

/**
 * 
 */
class Departments_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get()
    {
        return $this->db->get('xin_departments')->result();
    }

    function get_by_project($project_id=FALSE)
    {
        if($project_id == FALSE)
            return $this->db->get('xin_departments')->result();
        
    	$this->db->select('xd.department_id, xd.department_name');
    	return $this->db->get_where('xin_departments xd', array('xd.company_id' => $project_id))->result();
    }

    
}





 ?>