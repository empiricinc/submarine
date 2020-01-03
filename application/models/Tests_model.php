<?php 
/* Filename: Tests_model.php
* Author: Saddam
* Location: Models / Tests_model / Tests_model.php
*/

if(! defined("BASEPATH")) exit ("No direct script access allowed!");

class Tests_model extends CI_Model{
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
	// Check database for answers if exist.
	public function options_exist(){
		$this->db->select('ans_id, q_id, ans_name, status');
		$this->db->from('ex_answers');
		$this->db->where('q_id', $this->uri->segment(3));
		return $this->db->get()->result();
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
								exam_paper.que_id as quest_id,
								ex_questions.id, 
								ex_questions.question as quest,
								xin_jobs.job_id');
		$this->db->from('ex_answers');
		$this->db->join('ex_questions', 'ex_questions.id = ex_answers.q_id', 'left');
		$this->db->join('exam_paper', 'ex_questions.id = exam_paper.que_id', 'left');
		$this->db->join('xin_jobs', 'exam_paper.job_id = xin_jobs.job_id', 'left');
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
	// Count applicants' marks on the basis of answers submitted.
	public function count_applicants($appli_id, $date_from ='', $date_to='', $designation, $name, $job_id, $project){
		$this->db->select('test_result.rollnumber,
							test_result.obtain_marks,
							test_result.total_marks,
							test_result.sdt,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.job_id,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_jobs.company,
							xin_jobs.designation_id,
							subjective_test_result.id,
							subjective_test_result.applicant_id,
							subjective_test_result.marks');
		$this->db->from('test_result');
		$this->db->join('xin_job_applications', 'test_result.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies' , 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('subjective_test_result', 'test_result.rollnumber = subjective_test_result.applicant_id', 'left');
		$this->db->where(array('test_result.rollnumber' => $appli_id));
		$this->db->or_where('test_result.sdt >=', $date_from);
		$this->db->where('test_result.sdt <=', $date_to);
		$this->db->or_where('xin_jobs.designation_id', $designation);
		$this->db->or_where('xin_job_applications.fullname', $name);
		$this->db->or_where(array('xin_jobs.company' => $project));
		$this->db->or_where('xin_job_applications.job_id', $job_id);
		$this->db->order_by('test_result.rollnumber', 'DESC');
		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}
	// Insert the applicant's total marks into another table.
	// public function save_test_result(){
	// 	$query = $this->db->query('SELECT COUNT(ex_applicants.applicant_id) AS marks FROM ex_applicants JOIN ex_answers ON ex_applicants.answer_id = ex_answers.ans_id AND ex_answers.status = 1 WHERE ex_applicants.applicant_id = 1');
	// 	echo $this->db->last_query();
	// 	return $query->row_array();
	// }
	// Calculate the applicant's marks and show it on the page to the applicant or admin.
	function applicant_result_search($appli_id){ // Passed $app_id as argument to search for result
		$this->db->select('rollnumber');
		$this->db->from('test_result');
		$this->db->where(array('rollnumber' => $appli_id)); // Added ID and status match here... (if status in the answers table is 1, it'll add a mark to the applicant's result else not).
		// $this->db->group_by('applicant_id');
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
		$this->db->select('ex_questions.*,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('xin_designations');
		$this->db->join('ex_questions', 'ex_questions.designation_id = xin_designations.designation_id', 'left');
		$this->db->where(array('ex_questions.designation_id' => $designation_id));
		$res = $this->db->get();
		return $res->result();
	}
	// Change data for creating exams, get designations for project.
	public function get_pro_designations($proj_id){
		$this->db->select('location_job_position.company_id,
							location_job_position.designation_id,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('location_job_position');
		$this->db->join('xin_designations', 'location_job_position.designation_id = xin_designations.designation_id', 'left');
		$this->db->group_by('location_job_position.designation_id');
		$this->db->where('company_id', $proj_id);
		return $this->db->get()->result();
	}
	// Select project from the list, change in designations will occur.
	public function project_questions($project_id){
		$this->db->select('ex_questions.id,
							ex_questions.question,
							ex_questions.designation_id,
							ex_questions.project_id,
							xin_designations.designation_id as desig_id,
							xin_designations.designation_name');
		$this->db->from('ex_questions');
		$this->db->join('xin_designations', 'ex_questions.designation_id = xin_designations.designation_id', 'left');
		$this->db->where('ex_questions.project_id', $project_id);
		$this->db->group_by('designation_id'); // To view the desig_id once in the DD.
		$result = $this->db->get();
		return $result->result();
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
	// Get data from jobs table to display them in the dropdown.
	public function get_jobs(){
		$this->db->select('job_id, job_title');
		$this->db->from('xin_jobs');
		return $this->db->get()->result();
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
	// Validate applicant to get access to the paper.
	public function validate_applicant($post_data){
		$this->db->select('id, rollnumber, test_date, sdt');
		$this->db->where('rollnumber', $post_data['roll_no']);
		$this->db->where('test_date', date('Y-m-d', strtotime($post_data['test_date'])));
		$this->db->where('rollnumber NOT IN(SELECT applicant_id from ex_applicants)');
		$this->db->from('assign_test');
		$query = $this->db->get();
		if($query->num_rows() == 0)
			return false;
		else
			return $query->result();
	}
	// Get rollnumber from assign_test so that we can submit it with Paper.
	public function get_applicant_id(){
		$this->db->select('id, rollnumber, test_date, sdt, status');
		$this->db->from('assign_test');
		return $this->db->get()->row_array();
	}
	// count all applicants...
	public function count_all_records(){
		return $this->db->where('rollnumber NOT IN(SELECT rollnumber FROM test_result)')->from('assign_test')->count_all_results();
	}
	// Total applicants, get all applicants and display them on the dashboard.
	public function total_applicants($limit ='', $offset=''){
		$this->db->select('assign_test.rollnumber,
							assign_test.test_date,
							xin_job_applications.user_id,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.created_at,
							xin_job_applications.job_id,
							xin_job_applications.email,
							xin_jobs.job_id,
							xin_jobs.job_title');
		$this->db->from('assign_test');
		$this->db->join('xin_job_applications', 'assign_test.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->where('rollnumber NOT IN (SELECT rollnumber FROM test_result)');
		$this->db->limit($limit, $offset);
		$this->db->order_by('assign_test.test_date', 'DESC');
		$exams = $this->db->get();
		return $exams->result();
	}
	// count all jobs and return them.
	public function count_all_jobs(){
		return $this->db->where('status', 1)->from('xin_jobs')->count_all_results();
	}
	// Jobs list. In progress jobs
	public function jobs_list($limit = '', $offset =''){
		$this->db->select('xin_jobs.*,
							xin_job_type.job_type_id,
							xin_job_type.type,
							provinces.id,
							provinces.name as prov_name,
							xin_companies.company_id,
							xin_companies.name as comp_name');
		$this->db->from('xin_jobs');
		$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id', 'left');
		$this->db->join('provinces', 'provinces.id = xin_jobs.province', 'left');
		$this->db->join('xin_companies', 'xin_companies.company_id = xin_jobs.company', 'left');
		$this->db->where(array('xin_jobs.status' => 1));
		$this->db->order_by('xin_jobs.created_at', 'DESC');
		$this->db->limit($limit, $offset);
		$jobs = $this->db->get();
		return $jobs->result();
	}
	// Jobs list for dashboard.
	public function jobs_list_dashboard(){
		$this->db->select('xin_jobs.*,
							xin_job_type.job_type_id,
							xin_job_type.type,
							provinces.id,
							provinces.name as prov_name,
							xin_companies.company_id,
							xin_companies.name as comp_name');
		$this->db->from('xin_jobs');
		$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id', 'left');
		$this->db->join('provinces', 'provinces.id = xin_jobs.province', 'left');
		$this->db->join('xin_companies', 'xin_companies.company_id = xin_jobs.company', 'left');
		$this->db->where(array('xin_jobs.status' => 1));
		$this->db->order_by('xin_jobs.created_at', 'DESC');
		$this->db->limit(10);
		$jobs = $this->db->get();
		return $jobs->result();
	}
	// count all projects so that it'd be easy to create pagination
	public function count_all_projects(){
		return $this->db->count_all('xin_companies');
	}
	// List of all projects.
	public function projects_list($limit ='', $offset=''){
		$this->db->select('xin_companies.*,
							xin_company_type.type_id,
							xin_company_type.name as type_name');
		$this->db->from('xin_companies');
		$this->db->join('xin_company_type', 'xin_companies.type_id = xin_company_type.type_id', 'left');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// search projects
	public function search_projects($project){
		$this->db->select('xin_companies.company_id,
							xin_companies.name,
							xin_companies.registration_no,
							xin_companies.email,
							xin_companies.logo,
							xin_companies.contact_number,
							xin_companies.website_url,
							xin_company_type.type_id,
							xin_company_type.name as type_name');
		$this->db->from('xin_companies');
		$this->db->join('xin_company_type', 'xin_companies.type_id = xin_company_type.type_id', 'left');
		$this->db->like('xin_companies.name', $project);
		$this->db->or_like('registration_no', $project);
		$this->db->or_like('email', $project);
		$this->db->or_like('contact_number', $project);
		$this->db->or_like('website_url', $project);
		$this->db->or_like('xin_company_type.name', $project);
		return $this->db->get()->result();
	}
	// search applicants
	public function search_applicants($project, $designation, $keyword, $job_title, $rollnumber, $date_from, $date_to){
		$this->db->select('assign_test.rollnumber,
							assign_test.test_date,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.created_at,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_jobs.designation_id,
							xin_jobs.company,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('assign_test');
		$this->db->join('xin_job_applications', 'assign_test.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->where('xin_job_applications.fullname', $keyword);
		$this->db->or_where('xin_companies.name', $project);
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM test_result)');
		$this->db->or_where('xin_designations.designation_name', $designation);
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM test_result)');
		$this->db->or_where('xin_jobs.job_title', $job_title);
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM test_result)');
		$this->db->or_where('assign_test.rollnumber', $rollnumber);
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM test_result)');
		$this->db->or_where('assign_test.test_date >=', $date_from);
		$this->db->where('assign_test.test_date <=', $date_to);
		$this->db->where('rollnumber NOT IN(SELECT rollnumber FROM test_result)');
		return $this->db->get()->result();
	}
	// Search Jobs
	public function search_jobs($project, $designation, $province, $date_from, $date_to){
		$this->db->select('xin_jobs.*,
							xin_job_type.job_type_id,
							xin_job_type.type,
							provinces.id,
							provinces.name as prov_name,
							xin_companies.company_id,
							xin_companies.name as comp_name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('xin_jobs');
		$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id', 'left');
		$this->db->join('provinces', 'provinces.id = xin_jobs.province', 'left');
		$this->db->join('xin_companies', 'xin_companies.company_id = xin_jobs.company', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->where(array('xin_jobs.status' => 1));
		$this->db->where('xin_designations.designation_name', $designation);
		$this->db->or_where('provinces.name', $province);
		$this->db->where('xin_jobs.status', 1);
		$this->db->or_where('xin_companies.name', $project);
		$this->db->where('xin_jobs.status', 1);
		$this->db->or_where('xin_jobs.created_at >=', $date_from);
		$this->db->where('xin_jobs.created_at <=', $date_to);
		// $this->db->where('xin_jobs.status', 1);
		$jobs = $this->db->get();
		return $jobs->result();
	}
	// Search appeared.
	public function search_appeared($project, $designation, $keyword, $rollnumber, $date_from, $date_to){
		$this->db->select('test_result.rollnumber,
							test_result.sdt,
							test_result.obtain_marks,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.created_at,
							test_result.sdt as exam_date,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_companies.company_id,
							xin_companies.name as compName,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('test_result');
		$this->db->join('xin_job_applications', 'test_result.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_jobs.job_id = xin_job_applications.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->where('xin_job_applications.fullname', $keyword);
		$this->db->or_where('xin_companies.name', $project);
		$this->db->where('rollnumber IN(SELECT rollnumber FROM assign_test)');
		$this->db->or_where('xin_designations.designation_name', $designation);
		$this->db->where('rollnumber IN(SELECT rollnumber FROM assign_test)');
		$this->db->or_where('test_result.rollnumber', $rollnumber);
		$this->db->where('rollnumber IN(SELECT rollnumber FROM assign_test)');
		$this->db->or_where('test_result.sdt >=', $date_from);
		$this->db->where('test_result.sdt <=', $date_to);
		$this->db->where('rollnumber IN(SELECT rollnumber FROM assign_test)');
		$query = $this->db->get();
		return $query->result();
	}
	// applicants appeared in exam .
	public function appeared_applicants(){
		$this->db->select('test_result.rollnumber,
							test_result.sdt as exam_date,
							test_result.obtain_marks,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.created_at,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_companies.company_id,
							xin_companies.name as compName');
		$this->db->from('test_result');
		$this->db->join('xin_job_applications', 'test_result.rollnumber = xin_job_applications.application_id');
		$this->db->join('xin_jobs', 'xin_jobs.job_id = xin_job_applications.job_id');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id');
		$this->db->order_by('test_result.sdt', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	// count all appeared
	public function count_all_appeared(){
		return $this->db->count_all('test_result');
	}
	// all appeared applicants
	public function all_appeared($limit='', $offset=''){
		$this->db->select('test_result.rollnumber,
							test_result.sdt as exam_date,
							test_result.obtain_marks,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.created_at,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_companies.company_id,
							xin_companies.name as compName');
		$this->db->from('test_result');
		$this->db->join('xin_job_applications', 'test_result.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_jobs.job_id = xin_job_applications.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->order_by('test_result.sdt', 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Project detail, view single project.
	public function project_detail($proj_id){
		$this->db->select('xin_companies.*,
							xin_countries.country_id,
							xin_countries.country_name,
							xin_company_type.type_id,
							xin_company_type.name as type_name');
		$this->db->from('xin_companies');
		$this->db->join('xin_countries', 'xin_companies.country = xin_countries.country_id', 'left');
		$this->db->join('xin_company_type', 'xin_companies.type_id = xin_company_type.type_id', 'left');
		$this->db->where('company_id', $proj_id);
		return $this->db->get()->row_array();
	}
	// Applicant detail, view single applicant.
	public function applicant_detail($applicant_id){
		$this->db->select('xin_job_applications.*,
							xin_jobs.job_id,
							xin_jobs.job_title,
							age.id,
							age.name as age_name,
							education.id,
							education.name as edu_name,
							district.id,
							district.name as city_name1,
							provinces.id,
							provinces.name as prov_name,
							domicile.id,
							domicile.name as dom_name');
		$this->db->from('xin_job_applications');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('age', 'xin_job_applications.age = age.id', 'left');
		$this->db->join('education', 'xin_job_applications.education = education.id', 'left');
		$this->db->join('district', 'xin_job_applications.city_name = district.id', 'left');
		$this->db->join('provinces', 'xin_job_applications.province = provinces.id', 'left');
		$this->db->join('domicile', 'xin_job_applications.domicile = domicile.id', 'left');
		$this->db->where('xin_job_applications.application_id', $applicant_id);
		$exams = $this->db->get();
		return $exams->row_array();
	}
	// Job detail, view single job.
	public function job_detail($job_id){
		$this->db->select('xin_jobs.*,
							xin_job_type.job_type_id,
							xin_job_type.type,
							xin_designations.designation_id,
							xin_designations.designation_name,
							xin_companies.company_id,
							xin_companies.name as compName,
							provinces.id,
							provinces.name as provName,
							district.id,
							district.name as cityName,
							areas.id,
							areas.name as areaName,
							domicile.id,
							domicile.name as domName,
							education.id,
							education.name as eduName,
							age.id,
							age.name as ageName');
		$this->db->from('xin_jobs');
		$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('provinces', 'xin_jobs.province = provinces.id', 'left');
		$this->db->join('district', 'xin_jobs.district_id = district.id', 'left');
		$this->db->join('areas', 'xin_jobs.area_name = areas.id', 'left');
		$this->db->join('domicile', 'xin_jobs.domicile = domicile.id', 'left');
		$this->db->join('education', 'xin_jobs.education = education.id', 'left');
		$this->db->join('age', 'xin_jobs.age = age.id', 'left');
		$this->db->where('xin_jobs.job_id', $job_id);
		$result = $this->db->get();
		return $result->row_array();
	}
	// Get question added recently.
	public function get_recent_questions(){
		$this->db->select('ex_questions.*,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('ex_questions');
		$this->db->join('xin_companies', 'ex_questions.project_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'ex_questions.designation_id = xin_designations.designation_id', 'left');
		$this->db->order_by('ex_questions.id', 'DESC');
		$this->db->limit(5);
		return $this->db->get()->result();
	}
	// Reports
	public function applicants_report($date_from, $date_to, $job_id, $project, $designation){
		$this->db->select('xin_job_applications.*,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_jobs.company,
							xin_jobs.designation_id,
							xin_companies.company_id,
							xin_companies.name as compName,
							assign_test.rollnumber,
							assign_test.test_date as exam_date');
		$this->db->from('xin_job_applications');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('assign_test', 'xin_job_applications.application_id = assign_test.rollnumber', 'left');
		$this->db->where('xin_job_applications.created_at >=', $date_from);
		$this->db->where('xin_job_applications.created_at <=', $date_to);
		$this->db->or_where('xin_job_applications.job_id', $job_id);
		$this->db->or_where('xin_companies.company_id', $project);
		$this->db->or_where('xin_designations.designation_id', $designation);
		$results =  $this->db->get();
		return $results->result();
	}
	// --------------------------- Adding result, creating and viewing paper ---------------------- //
	// Get data by rollnumber.
	public function get_rollnumber_detail($rollnumber){
		$this->db->select('assign_test.rollnumber,
									xin_job_applications.application_id,
									xin_job_applications.job_id,
									xin_job_applications.fullname,
									xin_jobs.job_id,
									xin_jobs.company,
									xin_jobs.designation_id,
									xin_companies.company_id,
									xin_companies.name,
									xin_designations.designation_id,
									xin_designations.designation_name');
		$this->db->from('assign_test');
		$this->db->join('xin_job_applications', 'assign_test.rollnumber = xin_job_applications.application_id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id', 'left');
		$this->db->where('assign_test.rollnumber', $rollnumber);
		$query = $this->db->get();
		return $query->row();
	}
	// Save the test result manually.
	public function add_result($data){
		$this->db->insert('test_result', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Get questions to create paper for specific job and designation.
	public function get_for_paper($project = '', $designation = ''){
		$this->db->select('ex_questions.*,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('ex_questions');
		$this->db->join('xin_companies', 'ex_questions.project_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'ex_questions.designation_id = xin_designations.designation_id', 'left');
		$this->db->where(array('ex_questions.project_id' => $project, 'ex_questions.designation_id' => $designation));
		$this->db->group_by('ex_questions.id');
		$this->db->order_by('ex_questions.id', 'RANDOM');
		$this->db->limit(100);
		$query = $this->db->get();
		return $query->result();
	}
	// Create paper.
	public function create_paper($data){
		$this->db->insert('exam_paper', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Get paper pattern. Answers for questions saved previously.
	public function get_paper_pattern($job_id){
		$this->db->select('exam_paper.*,
							ex_answers.ans_id,
							ex_answers.ans_name,
							ex_answers.q_id,
							xin_companies.company_id,
							xin_designations.designation_id,
							xin_jobs.job_id,
							xin_jobs.job_title');
		$this->db->from('exam_paper');
		$this->db->join('ex_answers', 'exam_paper.que_id = ex_answers.q_id', 'left');
		$this->db->join('xin_companies', 'exam_paper.project_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'exam_paper.designation_id = xin_designations.designation_id', 'left');
		$this->db->join('xin_jobs', 'xin_jobs.job_id = exam_paper.job_id', 'left');
		$this->db->where('xin_jobs.job_id', $job_id);
		$query = $this->db->get();
		return $query->result();
	}
	// Count questions.
	public function count_jobs(){
		return $this->db->where('job_id IN(SELECT job_id FROM xin_jobs)')->from('exam_paper')->group_by('job_id')->count_all_results();
	}
	// Get questions present in the exam_paper table.
	public function question_paper($job_id){
		$this->db->select('ex_questions.id,
							ex_questions.question,
							exam_paper.que_id,
							exam_paper.marks');
		$this->db->from('ex_questions');
		$this->db->join('exam_paper', 'ex_questions.id = exam_paper.que_id');
		$this->db->where('exam_paper.job_id', $job_id);
		return $this->db->get()->result();
	}
	// List all jobs' papers.
	public function get_jobs_papers($limit, $offset){
		$this->db->select('exam_paper.*,
							xin_jobs.job_id,
							xin_jobs.job_title');
		$this->db->join('xin_jobs', 'exam_paper.job_id = xin_jobs.job_id', 'left');
		$this->db->from('exam_paper');
		$this->db->group_by('exam_paper.job_id');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// Search papers.
	public function search_papers($keyword){
		$this->db->select('exam_paper.*,
							xin_jobs.job_id,
							xin_jobs.job_title');
		$this->db->from('exam_paper');
		$this->db->join('xin_jobs', 'exam_paper.job_id = xin_jobs.job_id', 'left');
		$this->db->like('xin_jobs.job_title', $keyword);
		$this->db->group_by('exam_paper.job_id');
		return $this->db->get()->result();
	}
	// Get all provinces.
	public function get_provinces(){
		$this->db->select('id, name');
		$this->db->from('provinces');
		return $this->db->get()->result();
	}

	// ------------------------ Subjective Questions ----------------------------------//
	// Add subjective questions.
	public function add_subjective_questions($data){
		$this->db->insert('ex_questions_subjective', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	// Count all subjective questions.
	public function count_subjective(){
		return $this->db->from('ex_questions_subjective')->count_all_results();
	}
	// Get/List subjective questions.
	public function get_subjective_questions($limit, $offset){
		$this->db->select('ex_questions_subjective.*,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('ex_questions_subjective');
		$this->db->join('xin_companies', 'ex_questions_subjective.project_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'ex_questions_subjective.designation = xin_designations.designation_id', 'left');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// View question detail.
	public function single_subjective($id){
		$this->db->select('id, question_text');
		$this->db->from('ex_questions_subjective');
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	// Edit subjective question.
	public function edit_subjective($id){
		$this->db->select('ex_questions_subjective.*,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('ex_questions_subjective');
		$this->db->join('xin_companies', 'ex_questions_subjective.project_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'ex_questions_subjective.designation = xin_designations.designation_id', 'left');
		$this->db->where('ex_questions_subjective.id', $id);
		return $this->db->get()->row();
	}
	// Update a subjective question.
	public function update_subjective($id, $data){
		$this->db->where('id', $id);
		$this->db->update('ex_questions_subjective', $data);
		return true;
	}
	// Delete subjective question.
	public function delete_subjective($id){
		$this->db->where('id', $id);
		$this->db->delete('ex_questions_subjective');
		return true;
	}
	// Search subjective questions.
	public function search_subjective($keyword){
		$this->db->select('ex_questions_subjective.*,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('ex_questions_subjective');
		$this->db->join('xin_companies', 'ex_questions_subjective.project_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'ex_questions_subjective.designation = xin_designations.designation_id', 'left');
		$this->db->like('ex_questions_subjective.question_text', $keyword);
		$this->db->or_like('xin_companies.name', $keyword);
		$this->db->or_like('xin_designations.designation_name', $keyword);
		return $this->db->get()->result();
	}
	// Subjective paper view.
	public function subjective_question_paper(){
		$this->db->select('ex_questions_subjective.*,
							xin_companies.company_id,
							xin_companies.name,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('ex_questions_subjective');
		$this->db->join('xin_companies', 'ex_questions_subjective.project_id = xin_companies.company_id', 'left');
		$this->db->join('xin_designations', 'ex_questions_subjective.designation = xin_designations.designation_id', 'left');
		$this->db->limit(5);
		return $this->db->get()->result();
	}
	// Save subjective paper after attempting.
	public function applicant_test_subjective($data){
		$this->db->insert('subjective_papers', $data);
		if($this->db->affected_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	// Get attempted papers (Subjective).
	public function get_attempted_papers(){
		$this->db->select('subjective_papers.*,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.job_id,
							ex_questions_subjective.id,
							ex_questions_subjective.question_text,
							xin_jobs.job_id,
							xin_jobs.job_title');
		$this->db->from('subjective_papers');
		$this->db->join('xin_job_applications', 'subjective_papers.applicant_id = xin_job_applications.application_id', 'left');
		$this->db->join('ex_questions_subjective', 'subjective_papers.question_id = ex_questions_subjective.id', 'left');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id', 'left');
		$this->db->group_by('subjective_papers.applicant_id');
		return $this->db->get()->result();
	}
	// Get subjective answers by applicant_id.
	public function subjective_result($applicant_id){
		$this->db->select('*');
		$this->db->from('subjective_papers');
		$this->db->where('applicant_id', $applicant_id);
		return $this->db->get()->result();
	}
	// Save subjective part result.
	public function save_subjective_result($data){
		$this->db->insert('subjective_test_result', $data);
		if($this->db->affected_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

?>