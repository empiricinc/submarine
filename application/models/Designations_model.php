<?php 

/**
 * 
 */
class Designations_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	function get()
    {
        return $this->db->get('xin_designations')->result();
    }

    function get_by_project($project_id=FALSE)
    {
        if($project_id == FALSE)
            return $this->db->get('xin_designations')->result();
        
    	$this->db->select('xd.designation_id, xd.designation_name');
    	$this->db->join('xin_employees xe', 'xd.designation_id = xe.designation_id', 'left');
    	return $this->db->get_where('xin_designations xd', array('xe.company_id' => $project_id))->result();
    }

    
}





 ?>