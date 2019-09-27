<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Job_criteria_model extends CI_Model {
 





 function getAge($id){
  
  $condition =      " id =" . $id;
  $this->db->select("id, name"); 
  $this->db->from('age');
  //$this->db->order_by('id', 'DESC');
  $this->db->where($condition);
  $this->db->limit(1);
		$query = $this->db->get(); 
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return null;
			}
 }



 function education($id){
  
  $condition = " id =" . $id;
  $this->db->select("id, name"); 
  $this->db->from('education');
  //$this->db->order_by('application_id', 'DESC');
  $this->db->where($condition); 
  $this->db->limit(1);
    $query = $this->db->get(); 
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }
 }


function domicile($id){
  
  $condition = " id =" . $id;
  $this->db->select("id, name"); 
  $this->db->from('domicile');
  //$this->db->order_by('id', 'DESC');
  $this->db->where($condition); 
  $this->db->limit(1);
    $query = $this->db->get(); 
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }
 }


function province($id){
  
  $condition = " id =" . $id;
  $this->db->select("id, name"); 
  $this->db->from('provinces');
  //$this->db->order_by('id', 'DESC');
  $this->db->where($condition); 
  $this->db->limit(1);
    $query = $this->db->get(); 
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }
 }

function getcity($id){
  
  $condition = " id =" . $id;
  $this->db->select("id, name"); 
  $this->db->from('city');
  //$this->db->order_by('application_id', 'DESC');
  $this->db->where($condition); 
  $this->db->limit(1);
    $query = $this->db->get(); 
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }
 }


 








 
}
?>