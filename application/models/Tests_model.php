<?php 
/* File name : Tests_model.php
* Author : Saddam
* Location : Models / Tests_model
*/

if(! defined("BASEPATH")) exit ("No direct script access allowed!");

class tests_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	// Get all questions to display to the user ... 
	public function get_questions()
	{
		$query = $this->db->get('ex_questions');
		return $query->result();
	}
	// Creating new questions ...
	public function create_questions($data){
		$this->db->insert('ex_questions', $data);
		if($this->db->affected_rows() > 0 ){
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

?>