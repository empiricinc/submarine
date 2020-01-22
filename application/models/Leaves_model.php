<?php defined("BASEPATH") OR exit('No direct script access allowed!');
/**
 * Filename: Leaves_model.php
 * Filepath: models/Leaves_model.php
 * Author: Saddam
 */
class Leaves_model extends CI_Model
{
    /**
     * This file is responsible for all the CRUD in the leaves management.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // Count pending leaves.
    public function count_pending_leaves(){
    	return $this->db->where(array('status'=> 1))->from('xin_leave_applications')->count_all_results();
    }
    // Count approved leaves.
    public function count_approved_leaves(){
        return $this->db->where(array('status'=> 2))->from('xin_leave_applications')->count_all_results();
    }
    // Count rejected leaves.
    public function count_rejected_leaves(){
        return $this->db->where(array('status'=> 3))->from('xin_leave_applications')->count_all_results();
    }
    public function pending_leaves($limit= '', $offset = ''){
    	$this->db->select('xin_leave_applications.*,
    						xin_employees.employee_id,
    						xin_employees.first_name,
    						xin_leave_type.leave_type_id,
    						xin_leave_type.type_name');
    	$this->db->from('xin_leave_applications');
    	$this->db->join('xin_employees', 'xin_leave_applications.employee_id = xin_employees.employee_id', 'left');
    	$this->db->join('xin_leave_type', 'xin_leave_applications.leave_type_id = xin_leave_type.leave_type_id', 'left');
    	$this->db->limit($limit, $offset);
    	$this->db->where(array('xin_leave_applications.status' => 1));
    	return $this->db->get()->result();
    }
    public function approved_leaves($limit= '', $offset = ''){
    	$this->db->select('xin_leave_applications.*,
    						xin_employees.employee_id,
    						xin_employees.first_name,
    						xin_leave_type.leave_type_id,
    						xin_leave_type.type_name');
    	$this->db->from('xin_leave_applications');
    	$this->db->join('xin_employees', 'xin_leave_applications.employee_id = xin_employees.employee_id', 'left');
    	$this->db->join('xin_leave_type', 'xin_leave_applications.leave_type_id = xin_leave_type.leave_type_id', 'left');
    	$this->db->limit($limit, $offset);
    	$this->db->where(array('xin_leave_applications.status' => 2));
    	return $this->db->get()->result();
    }
    public function rejected_leaves($limit= '', $offset = ''){
    	$this->db->select('xin_leave_applications.*,
    						xin_employees.employee_id,
    						xin_employees.first_name,
    						xin_leave_type.leave_type_id,
    						xin_leave_type.type_name');
    	$this->db->from('xin_leave_applications');
    	$this->db->join('xin_employees', 'xin_leave_applications.employee_id = xin_employees.employee_id', 'left');
    	$this->db->join('xin_leave_type', 'xin_leave_applications.leave_type_id = xin_leave_type.leave_type_id', 'left');
    	$this->db->limit($limit, $offset);
    	$this->db->where(array('xin_leave_applications.status' => 3));
    	return $this->db->get()->result();
    }
    // Approve leave request, paid leave.
    public function approve_leave($leave_id, $data){
    	$this->db->where('leave_id', $leave_id);
    	$this->db->update('xin_leave_applications', $data);
    	if($this->db->affected_rows() > 0){
    		return true;
    	}else{
    		return false;
    	}
    }
    // Approve leave request, unpaid leave.
    public function approve_leave_unpaid($employee_id, $data){
        $this->db->where('employee_id', $employee_id);
        $this->db->update('xin_leave_applications', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    // Reject leave request.
    public function reject_leave($leave_id, $data){
    	$this->db->where('leave_id', $leave_id);
    	$this->db->update('xin_leave_applications', $data);
    	if($this->db->affected_rows() > 0){
    		return true;
    	}else{
    		return false;
    	}
    }
    // --------------------------------- Search in leaves ---------------------------------------------- //
    // Search in pending leave requests.
    public function search_pending($keyword){
        $this->db->select('xin_leave_applications.*,
                            xin_employees.employee_id,
                            xin_employees.first_name,
                            xin_leave_type.leave_type_id,
                            xin_leave_type.type_name');
        $this->db->from('xin_leave_applications');
        $this->db->join('xin_employees', 'xin_leave_applications.employee_id = xin_employees.employee_id', 'left');
        $this->db->join('xin_leave_type', 'xin_leave_applications.leave_type_id = xin_leave_type.leave_type_id', 'left');
        $this->db->like('xin_employees.first_name', $keyword);
        $this->db->where(array('xin_leave_applications.status' => 1));
        $this->db->or_like('xin_leave_type.type_name', $keyword);
        $this->db->where(array('xin_leave_applications.status' => 1));
        return $this->db->get()->result();
    }
    // Search in approved leave requests.
    public function search_approved($keyword){
        $this->db->select('xin_leave_applications.*,
                            xin_employees.employee_id,
                            xin_employees.first_name,
                            xin_leave_type.leave_type_id,
                            xin_leave_type.type_name');
        $this->db->from('xin_leave_applications');
        $this->db->join('xin_employees', 'xin_leave_applications.employee_id = xin_employees.employee_id', 'left');
        $this->db->join('xin_leave_type', 'xin_leave_applications.leave_type_id = xin_leave_type.leave_type_id', 'left');
        $this->db->like('xin_employees.first_name', $keyword);
        $this->db->where(array('xin_leave_applications.status' => 2));
        $this->db->or_like('xin_leave_type.type_name', $keyword);
        $this->db->where(array('xin_leave_applications.status' => 2));
        return $this->db->get()->result();
    }
    // Search in rejected leave requests.
    public function search_rejected($keyword){
        $this->db->select('xin_leave_applications.*,
                            xin_employees.employee_id,
                            xin_employees.first_name,
                            xin_leave_type.leave_type_id,
                            xin_leave_type.type_name');
        $this->db->from('xin_leave_applications');
        $this->db->join('xin_employees', 'xin_leave_applications.employee_id = xin_employees.employee_id', 'left');
        $this->db->join('xin_leave_type', 'xin_leave_applications.leave_type_id = xin_leave_type.leave_type_id', 'left');
        $this->db->like('xin_employees.first_name', $keyword);
        $this->db->where(array('xin_leave_applications.status' => 3));
        $this->db->or_like('xin_leave_type.type_name', $keyword);
        $this->db->where(array('xin_leave_applications.status' => 3));
        return $this->db->get()->result();
    }
}
?>