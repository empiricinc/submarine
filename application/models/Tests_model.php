<?php 
/* Filename: Tests_model.php
* Author: Saddam
* Location: Models / Tests_model / Tests_model.php
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
		$this->db->insert_id();
    }
	// View single record ...  ---> It's buggy, do it later...
	public function get_single($id){
		$this->db->select('ex_answers.q_id as que_id, 
							ex_answers.ans_id, 
							ex_answers.ans_name, 
							ex_answers.status as ans_status, 
							ex_questions.id as ques_id, 
							ex_questions.question as ques');
		$this->db->from('ex_answers');
		$this->db->join('ex_questions', 'ex_questions.id = ex_answers.q_id');
		$this->db->where(array('ex_answers.q_id' => $id));
		$query = $this->db->get();
		return $query->result_array();
	}
	// Delete questions...
	public function delete_question($id){
		$this->db->where('id', $id);
		$this->db->delete('ex_questions');
		return TRUE;
	}
	// Get random questions...
	public function test_questions(){
		$this->db->select('ex_answers.q_id as ques_id, 
								ex_answers.ans_id, 
								ex_answers.ans_name, 
								ex_answers.status as status_ans, 
								ex_questions.id as quest_id, 
								ex_questions.question as quest');
		$this->db->from('ex_answers');
		$this->db->join('ex_questions', 'ex_questions.id = ex_answers.q_id');
		// $this->db->order_by('ex_questions.id', 'RANDOM');
		// $this->db->where('ex_questions.id >', 2);
		// $this->db->limit(4);
		$query = $this->db->get();
		return $query->result();
	}
	// Edit questions ... 
	public function edit_question($id){
		$this->db->where('id', $id);
		$edit = $this->db->get('ex_questions');
		return $edit->row_array();
	}
	// Update questions ...
	public function update_question($id, $data){
		$this->db->where('id', $id);
		$update = $this->db->update('ex_questions', $data);
		if($this->db->affected_rows() > 0 ){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	// Count all columns in DB table. We'll use this function to count the score of an individual cadidate who take the test according to the correct answers ...
	function count_uploads(){
	  $this->db->select('COUNT(ans_name) as count');
	  $this->db->from('ex_answers');
	  $this->db->where(array('status' => 0));
	  $query = $this->db->get();
	  if ($query->num_rows() > 0 ){
	    $row = $query->row();
	    return $row->count;
	  }
	  return 0;
	}
	// Add Options to questions ... 
	public function add_choices($id){
		$this->db->where('id', $id);
		$query = $this->db->get('ex_questions');
		return $query->row_array();
	}
	// Search for specific questions in the database...
	public function search_questions($keyword){
		$this->db->like('question', $keyword);
		$query = $this->db->get('ex_questions');
		return $query->result();
	}
	// Get selected data from database... 
	public function onchange(){
		//$this->db->where('id', $id);
		$query = $this->db->get('xin_designations');
		return $query->result();
	}
	// Question paper, get questions and answers separately...
	public function quest_paper(){
		$this->db->select('id, question');
		$this->db->from('ex_questions');
		$query = $this->db->get();
		return $query->result();
	}
	// Get questions and answers separately... 
	public function get_answers($id=null){
		$this->db->select('ans_id, ans_name, q_id');
		$this->db->from('ex_answers');
		$this->db->where('q_id', 1);
		$query = $this->db->get();
		// echo $this->db->last_query(); exit();
		return $query->result_array();
	}
}

?>