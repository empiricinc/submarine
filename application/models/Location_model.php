<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class location_model extends CI_Model

	{

 

    public function __construct()

    {

        parent::__construct();

        $this->load->database();

    }

 

	public function get_locations()

	{

	  return $this->db->get("xin_office_location");

	}

	 

	 public function read_location_information($id) {

	

		$condition = "location_id =" . "'" . $id . "'";

		$this->db->select('*');

		$this->db->from('xin_office_location');

		$this->db->where($condition);

		$this->db->limit(1);

		$query = $this->db->get();

		

		if ($query->num_rows() == 1) {

			return $query->result();

		} else {

			return null;

		}

	}

	

	

	// Function to add record in table

	public function add($data){

		$this->db->insert('xin_office_location', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}


	public function add_sub_areas($data){

		$this->db->insert('sub_area', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}


	public function add_areas($data){

		$this->db->insert('areas', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}



	public function add_uc($data){

		$this->db->insert('union_councel', $data);

		if ($this->db->affected_rows() > 0) {

			return true;

		} else {

			return false;

		}

	}

	public function add_district($data){

			$this->db->insert('district', $data);

			if ($this->db->affected_rows() > 0) {

				return true;

			} else {

				return false;

			}

		}	

public function add_tehsil($data){

			$this->db->insert('tehsil', $data);

			if ($this->db->affected_rows() > 0) {

				return true;

			} else {

				return false;

			}

		}			



	public function add_job_positions($data){
		$this->db->insert('location_job_position', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	

	// Function to Delete selected record from table

	public function delete_record($id){

		$this->db->where('location_id', $id);

		$this->db->delete('xin_office_location');

		

	}

	

	// Function to update record in table

	public function update_record($data, $id){

		$this->db->where('location_id', $id);

		if( $this->db->update('xin_office_location',$data)) {

			return true;

		} else {

			return false;

		}		

	}

	

	// Function to update record without logo > in table

	public function update_record_no_logo($data, $id){

		$this->db->where('location_id', $id);

		if( $this->db->update('xin_office_location',$data)) {

			return true;

		} else {

			return false;

		}		

	}

	

	// get all office locations

	public function all_office_locations() {

	  $query = $this->db->query("SELECT * from xin_office_location ORDER BY location_id DESC limit 50 ");

  	  return $query->result();

	}




	public function all_office_locationsCondi($company,$province) {

	  $query = $this->db->query("SELECT * from xin_office_location where company_id = ".$company." AND province_id = ".$province." ");
//echo $this->db->last_query();
  	  return $query->result();

	}

public function all_office_locationsCondiall($company) {

	  $query = $this->db->query("SELECT * from xin_office_location where company_id = ".$company." ");
//echo $this->db->last_query();
  	  return $query->result();

	}


	public function all_location_job_positionCondiall($company) {

	  $query = $this->db->query("SELECT `id`, `location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt` from location_job_position where status = 0 AND company_id = ".$company." ");	 
	 
  	  return $query->result(); 

	}



	public function all_location_area_code($job_code) {

	  $query = $this->db->query("SELECT `id`, `location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt` from location_job_position where job_code = '".$job_code."' ORDER BY id DESC LIMIT 10 ");	 
	 
  	  return $query->result(); 

	}


	public function all_location_area_code_proj_prov($projid,$provid) {

	  $query = $this->db->query("SELECT `id`, `location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt` from location_job_position where company_id=".$projid." AND province_id=".$provid." ORDER BY id DESC LIMIT 10 ");
	
  	  return $query->result(); 

	}


	public function all_location_area_code_all() {

	  $query = $this->db->query("SELECT `id`, `location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt` from location_job_position ORDER BY id DESC LIMIT 10 ");	 
	 
  	  return $query->result(); 

	}	

	public function all_location_job_positionCondi($company,$province) {

	  $query = $this->db->query("SELECT `id`, `location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt` from location_job_position where status = 0 AND company_id = ".$company." AND province_id = ".$province." ");

  	  return $query->result(); 

	}


	public function all_location_job_positionn($projid,$provid) {

	  $query = $this->db->query("SELECT `id`, `location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt` from location_job_position where status = 0 AND company_id=".$projid." AND province_id=".$provid." ");
	
	 
	//echo $this->db->last_query();

  	  return $query->result(); 

	}


	public function all_location_job_position() {

	  $query = $this->db->query("SELECT `id`, `location_id`, `company_id`, `province_id`, `city_id`, `district_id`, `tehsil_id`, `uc_id`, `area_id`, `sub_area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt` from location_job_position where status = 0 ORDER BY `id` DESC LIMIT 50");

  	  return $query->result();

	}


	public function get_all_area_code($location_id) {

	  $query = $this->db->query("SELECT `id`, `area_id`, `designation_id`, `department_id`, `job_code`, `status`, `sdt` from location_job_position where location_id = " . $location_id . " ");

	  //$condition = "location_id =" . "'" . $location_id . "'";

	  //$this->db->where($condition);

  	  return $query->result(); 
  	  //echo $this->db->last_query();

	}


/*	public function get_all_area_code($area_id) {
        $condition = "area_id =" . "'" . $area_id . "'";
        $this->db->select('*');
        $this->db->from('location_job_position');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get(); 
        //echo $this->db->last_query();
            if ($query->num_rows() == 1) {
                return $query->result();
            } else {
                return false;
            }
    }
*/















}

?>