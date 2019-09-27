<?php   //Site.php ... /models
 
/**
 * @package CodeIgniter provinceCity
 *
 * @author Ayat Ullah Khan
 *
 * @email  pm_developer@yahoo.com
 *   
 * Description of provinceCity Controller
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class All_setups_model extends CI_Model {
    private $provinceID;
    private $_cityID;
    private $areapositionID;
    private $_ucID;
    private $_AreaID;

    private $districtID;
    private $tehsilID;



    // set country id
    public function setProvinceID($provinceID) {
        return $this->provinceID = $provinceID;
    }
    // set city id
    public function settheCityID($thecityID) {
        return $this->_cityID = $thecityID;
    }

// set area position
    public function setthepositiondeptID($theAreaID) {
        return $this->areapositionID = $theAreaID;
    }

    // set city id
    public function settheucID($theucID) {
        return $this->_ucID = $theucID;
    }
    
    public function settheareaID($theareaID) {
            return $this->_AreaID = $theareaID;
        }
    // set district id
    public function setthedistrictID($thedistrictID) {
        return $this->districtID = $thedistrictID;
    }

    // set district id
    public function settehsilID($tehsilID) {
        return $this->tehsilID = $tehsilID;
    }

    public function getAllProvinces() {
        $this->db->select(array('c.id as province_id', 'c.slug', 'c.sortname', 'c.name as province_name'));
        $this->db->from('provinces as c');
        $query = $this->db->get();
        return $query->result_array();
    }



    public function read_province_information($id) {
        $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('provinces');
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

    public function read_district_information($id) {
        $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('district');
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

    public function read_tehsil_information($id) {
        $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('tehsil');
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

    public function all_tehsil() {
       // $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('tehsil');
        //$this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get(); 

        
        return $query->result_array();

    }


    public function allareas() {
       // $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('areas');
        //$this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get(); 

        
        return $query->result_array();

    }


    public function all_sub_areas() {
       // $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('sub_area');
        //$this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get(); 

        
        return $query->result_array();

    }    
 
    public function all_uc() {
       // $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('union_councel');
        //$this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get(); 

        
        return $query->result_array();

    }   


 
    public function all_district() {
       // $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('district');
        //$this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get(); 

        
        return $query->result_array();

    }


 
    public function all_provinces() {
       // $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('provinces');
        //$this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get(); 

        
        return $query->result_array();

    }


    public function read_union_councel_information($id) {
        $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('union_councel');
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

    public function read_area_information($id) {
        $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('areas');
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

    public function read_sub_area_information($id) {
        $condition = "id =" . "'" . $id . "'";
        $this->db->select('*');
        $this->db->from('sub_area');
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



    // get state method
    public function getCity() {
        $this->db->select(array('s.id as city_id', 's.province_id', 's.name as city_name'));
        $this->db->from('city as s');
        $this->db->where('s.province_id', $this->provinceID);
        $query = $this->db->get();
        return $query->result_array();
    }

    // get city method
    public function getAreas() {
        $this->db->select(array('i.id as area_id', 'i.name as area_name', 'i.city_id'));
        $this->db->from('areas as i');
        $this->db->where('i.city_id', $this->_cityID);
        $query = $this->db->get();
        return $query->result_array();
    }


    // get area position
   /* public function getAreas_positionDept() {
        $this->db->select(array('area_id', 
                                'department_id',
                                'total_job_positions',
                                'designation_id'));

        $this->db->from('location_job_position');
        $this->db->where('area_id', $this->areapositionID);
        //$this->db->join('xin_departments', 'xin_departments.department_id = location_job_position.department_id');
        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result_array();
    }*/

     public function getAreas_positionDept() {
        $this->db->select(array('COUNT(area_id) AS total_job_positions'));

        $this->db->from('location_job_position');
        $this->db->where('area_id', $this->areapositionID);
        //$this->db->join('xin_departments', 'xin_departments.department_id = location_job_position.department_id');
        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result_array();
    }

    // get city method
    public function getCBVAreas() {
        $this->db->select(array('i.id as area_id', 'i.name as area_name', 'i.uc_id'));
        $this->db->from('areas as i');
        $this->db->where('i.uc_id', $this->_ucID); 
        $query = $this->db->get();
        //echo $this->db->last_query();

        return $query->result_array();
    }

    public function getCBVSubAreas() {
        $this->db->select(array('i.id as sub_area_id', 'i.name as sub_area_name', 'i.area_id'));
        $this->db->from('sub_area as i');
        $this->db->where('i.area_id', $this->_AreaID); 
        $query = $this->db->get();
        //echo $this->db->last_query();

        return $query->result_array();
    }



    // get District 
    public function getDistrict() {
        $this->db->select(array('s.id as district_id', 's.province_id', 's.name as district_name'));
        $this->db->from('district as s');
        $this->db->where('s.province_id', $this->provinceID);
        $query = $this->db->get();
        return $query->result_array();
    }

    // get Tehsil 
    public function getTehsil() {
        $this->db->select(array('s.id as Tehsil_id', 's.district_id', 's.name as Tehsil_name'));
        $this->db->from('tehsil as s');
        $this->db->where('s.district_id', $this->districtID);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

        // get UC 
    public function getuc() {
        $this->db->select(array('s.id as uc_id', 's.tehsil_id', 's.name as uc_name'));
        $this->db->from('union_councel as s');
        $this->db->where('s.tehsil_id', $this->tehsilID);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    public function getAllCity() {
        $this->db->select(array('s.id as city_id', 's.province_id', 's.name as city_name'));
        $this->db->from('city as s');
        //$this->db->where('s.province_id', $this->provinceID);
        $query = $this->db->get();
        return $query->result_array();
    }


}
?>