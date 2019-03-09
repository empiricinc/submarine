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
		$this->db->select('id, question, status');
		$this->db->from('ex_questions');
		$query = $this->db->get();
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
	// Creating answers for the questions 
	public function create_answers($data){
		$this->db->insert('ex_answers', $data);
		if($this->db->affected_rows() > 0 ){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	// View single record ... 
	public function get_single($id){
		// $this->db->where('id', $id);
		// $query = $this->db->get('ex_questions');
		// return $query->row_array();
		$this->db->select('ex_answers.ans_id, ex_answers.q_id, ex_answers.ans_name, ex_answers.status as ans_status, ex_questions.id as que_id, ex_questions.question, ex_questions.status as que_status');
		$this->db->from('ex_answers');
		$this->db->join('ex_questions', 'ex_questions.id = ex_answers.q_id');
		$this->db->where(array('ex_questions.id' => $id));
		$query = $this->db->get();
		// echo $this->db->last_query(); exit();
		return $query->result();
	}
	// Delete questions...
	public function delete_question($id){
		$this->db->where('id', $id);
		$this->db->delete('ex_questions');
		return TRUE;
	}
	// Get random questions...
	public function test_questions(){
		$this->db->order_by('id', 'RANDOM');
		$this->db->where('id > ', 2);
		$this->db->limit(3);
		$query = $this->db->get('ex_questions');
		return $query->result();
	}
}

?>