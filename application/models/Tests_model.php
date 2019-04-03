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
	// Count all questions -- For pagination but still pagination doesn't work !
	public function get_total(){
		return $this->db->get('ex_questions')->num_rows();
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
	// View single record ...
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
	// Get all questions/answers with their respective IDs stored on the database.
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
	function count_uploads($app_id){ // Passed $app_id as argument to search for result
		$this->db->select('ex_applicants.*, ex_answers.*');
		$this->db->from('ex_answers');
		$this->db->join('ex_applicants', 'ex_applicants.answer_id = ex_answers.ans_id AND ex_answers.status = 1', 'right');
		$this->db->where(array('applicant_id' => $app_id, 'ex_answers.status' => 1)); // Added ID and status match here... (if status in the answers table is 1, it'll return value else not)
		$query = $this->db->get();
		return $query->result();
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
		$query = $this->db->get('xin_designations');
		return $query->result();
	}
	// Get data by join, table designation and table questions.
	public function desig_questions($designation_id){
		$this->db->select('id, question, designation_id, project_id');
		$this->db->from('ex_questions');
		$this->db->where('designation_id', $designation_id);
		$res = $this->db->get();
		return $res->result();
	}
	// Question paper, get questions and answers separately...
	public function quest_paper(){
		$this->db->select('id, question');
		$this->db->from('ex_questions');
		$query = $this->db->get();
		return $query->result();
	}
	// Get questions and answers separately... 
	public function get_answers(){
		$this->db->select('ans_id, ans_name, q_id');
		$this->db->from('ex_answers');
		$this->db->where('q_id', 1);
		$query = $this->db->get();
		// echo $this->db->last_query(); exit();
		return $query->result_array();
	}
	// Submit paper after attempting, send it to the database and display user a message
	public function submit_paper($data){
		$this->db->insert('ex_applicants', $data);
		if($this->db->affected_rows() > 0 ){
			return true;
		} else {
			return false;
		}
		return $this->db->insert_id();
	}
	// Get data from projects table to display them on the questions adding page and save it to DB.
	public function get_projects(){
		$this->db->select('company_id, name');
		$this->db->from('xin_companies');
		return $this->db->get()->result();
	}
	// Get data from designations table to display on the questions adding page and save it to DB.
	public function get_designations(){
		$this->db->select('designation_id, designation_name');
		$this->db->from('xin_designations');
		return $this->db->get()->result();
	}
	// Get all answers and display them to the admin to perform actions.
	public function get_all_answers(){
		return $this->db->get('ex_answers')->result(); // No need to display all the answers at once.
	}
	// Edit answers.
	public function get_ans_for_edit($id){
		$this->db->where('ans_id', $id);
		$edit = $this->db->get('ex_answers');
		return $edit->row_array();
	}
	// Update answers.
	public function update_answers($ans_id, $data){
		$this->db->where('ans_id', $ans_id);
		$modify = $this->db->update('ex_answers', $data);
		if($this->db->affected_rows() > 0 ){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	// Delete answers from database.
	public function delete_answers($ans_id){
		$this->db->where('ans_id', $and_id);
		$this->db->delete('ex_answers');
		return TRUE;
	}
}

?>