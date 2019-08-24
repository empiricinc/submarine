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
		// $this->db->where('ex_questions.project_id', 4);
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
	// Count applicants' marks on the basis of answers submitted.
	public function count_applicants($appli_id, $date_from ='', $date_to='', $designation, $name, $job_id, $project){
		$this->db->select('COUNT(ex_applicants.applicant_id) as marks,
							ex_applicants.applicant_id,
								ex_applicants.question_id,
								ex_applicants.answer_id,
								ex_applicants.exam_date,
								ex_questions.id,
								ex_questions.project_id,
								ex_questions.designation_id,
								ex_answers.ans_id,
								ex_answers.status,
								xin_job_applications.application_id,
								xin_job_applications.fullname,
								xin_companies.company_id,
								xin_companies.name,
								xin_designations.designation_id,
								xin_designations.designation_name,
								xin_jobs.job_id,
								xin_jobs.job_title');
		$this->db->from('ex_applicants');
		$this->db->join('ex_answers', 'ex_applicants.answer_id = ex_answers.ans_id AND ex_answers.status = 1');
		$this->db->join('ex_questions', 'ex_applicants.question_id = ex_questions.id');
		$this->db->join('xin_job_applications', 'ex_applicants.applicant_id = xin_job_applications.application_id');
		$this->db->join('xin_companies'
			, 'ex_questions.project_id = xin_companies.company_id');
		$this->db->join('xin_designations', 'ex_questions.designation_id = xin_designations.designation_id');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id');
		$this->db->where(array('ex_answers.status' => 1, 'applicant_id' => $appli_id));
		$this->db->or_where('ex_applicants.exam_date >=', $date_from);
		$this->db->where('ex_applicants.exam_date <=', $date_to);
		$this->db->or_where('ex_questions.designation_id', $designation);
		$this->db->or_where('xin_job_applications.fullname', $name);
		$this->db->or_where(array('ex_questions.project_id' => $project));
		$this->db->or_where('xin_job_applications.job_id', $job_id);
		$this->db->group_by('ex_applicants.applicant_id');
		$query = $this->db->get();
		return $query->result();
	}
	// Calculate the applicant's marks and show it on the page to the applicant or admin.
	function applicant_result_search($appli_id){ // Passed $app_id as argument to search for result
		$this->db->select('ex_applicants.applicant_id');
		$this->db->from('ex_answers');
		$this->db->join('ex_applicants', 'ex_applicants.answer_id = ex_answers.ans_id AND ex_answers.status = 1', 'right');
		$this->db->where(array('applicant_id' => $appli_id, 'ex_answers.status' => 1)); // Added ID and status match here... (if status in the answers table is 1, it'll add a mark to the applicant's result else not).
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
		$this->db->select('xin_companies.*,
							xin_designations.designation_id,
							xin_designations.designation_name');
		$this->db->from('xin_companies');
		$this->db->join('xin_designations', 'xin_companies.designation_id = xin_designations.designation_id');
		$this->db->where('xin_companies.company_id', $proj_id);
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
		$this->db->join('xin_designations', 'ex_questions.designation_id = xin_designations.designation_id');
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
		$this->db->select('id, rollnumber, test_date, sdt, status');
		$this->db->where('rollnumber', $post_data['roll_no']);
		$this->db->where('test_date >=', date('Y-m-d', strtotime($post_data['test_date'])));
		$this->db->from('assign_test');
		$query = $this->db->get();
		if($query->num_rows() == 0)
			return false;
		else
			return $query->result();
	}
	// count all applicants...
	public function count_all_records(){
		return $this->db->count_all('xin_job_applications');
	}
	// Total applicants, get all applicants and display them on the dashboard.
	public function total_applicants($limit ='', $offset=''){
		$this->db->select('xin_job_applications.user_id,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.created_at,
							xin_job_applications.job_id,
							xin_job_applications.email,
							xin_jobs.job_id,
							xin_jobs.job_title');
		$this->db->from('xin_job_applications');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id');
		$this->db->order_by('xin_job_applications.created_at', 'DESC');
		$this->db->where('application_id NOT IN (SELECT applicant_id FROM ex_applicants)');
		$this->db->limit($limit, $offset);
		$exams = $this->db->get();
		return $exams->result();
	}
	// count all jobs and return them.
	public function count_all_jobs(){
		return $this->db->count_all('xin_jobs');
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
		$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id');
		$this->db->join('provinces', 'provinces.id = xin_jobs.province');
		$this->db->join('xin_companies', 'xin_companies.company_id = xin_jobs.company');
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
		$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id');
		$this->db->join('provinces', 'provinces.id = xin_jobs.province');
		$this->db->join('xin_companies', 'xin_companies.company_id = xin_jobs.company');
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
		$this->db->join('xin_company_type', 'xin_companies.type_id = xin_company_type.type_id');
		$this->db->limit($limit, $offset);
		return $this->db->get()->result();
	}
	// applicant results
	public function results_of_applicants(){
		$this->db->select('*');
		$this->db->from('xin_applicants');
		$this->db->where(array('company_id' => $project_id,
								'designation_id' => $designation_id,
								'job_id' => $job_id,
								'username' => $username,
								'employee_id' => $employee_id,
								'created_at' => $date
								));
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
		$this->db->join('xin_company_type', 'xin_companies.type_id = xin_company_type.type_id');
		$this->db->like('xin_companies.name', $project);
		$this->db->or_like('registration_no', $project);
		$this->db->or_like('email', $project);
		$this->db->or_like('contact_number', $project);
		$this->db->or_like('website_url', $project);
		$this->db->or_like('xin_company_type.name', $project);
		return $this->db->get()->result();
	}
	// search applicants
	public function search_applicants($applicant){
		$this->db->select('xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.created_at,
							xin_job_applications.exam_date,
							xin_jobs.job_id,
							xin_jobs.job_title');
		$this->db->from('xin_job_applications');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id');
		$this->db->like('fullname', $applicant);
		$this->db->or_like('email', $applicant);
		$this->db->or_like('xin_job_applications.created_at', $applicant);
		$this->db->or_like('xin_jobs.job_title', $applicant);
		return $this->db->get()->result();
	}
	// Search Jobs
	public function search_jobs($job){
		$this->db->select('xin_jobs.*,
							xin_job_type.job_type_id,
							xin_job_type.type,
							provinces.id,
							provinces.name as prov_name,
							xin_companies.company_id,
							xin_companies.name as comp_name');
		$this->db->from('xin_jobs');
		$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id');
		$this->db->join('provinces', 'provinces.id = xin_jobs.province');
		$this->db->join('xin_companies', 'xin_companies.company_id = xin_jobs.company');
		$this->db->where(array('xin_jobs.status' => 1));
		$this->db->like('xin_jobs.job_title', $job);
		$this->db->or_like('provinces.name', $job);
		$this->db->or_like('xin_companies.name', $job);
		$this->db->or_like('xin_job_type.type', $job);
		$this->db->or_like('xin_jobs.job_vacancy', $job);
		$jobs = $this->db->get();
		return $jobs->result();
	}
	// Search appeared.
	public function search_appeared($appeared){
		$this->db->select('ex_applicants.applicant_id,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.created_at,
							xin_job_applications.exam_date,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_companies.company_id,
							xin_companies.name as compName');
		$this->db->from('ex_applicants');
		$this->db->join('xin_job_applications', 'ex_applicants.applicant_id = xin_job_applications.application_id');
		$this->db->join('xin_jobs', 'xin_jobs.job_id = xin_job_applications.job_id');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id');
		$this->db->like('xin_job_applications.fullname', $appeared);
		$this->db->or_like('xin_job_applications.email', $appeared);
		$this->db->or_like('xin_jobs.job_title', $appeared);
		$this->db->or_like('xin_companies.name', $appeared);
		$this->db->group_by('ex_applicants.applicant_id');
		return $this->db->get()->result();
	}
	// applicants appeared in exam .
	public function appeared_applicants(){
		$this->db->select('ex_applicants.applicant_id,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.created_at,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_companies.company_id,
							xin_companies.name as compName');
		$this->db->from('ex_applicants');
		$this->db->join('xin_job_applications', 'ex_applicants.applicant_id = xin_job_applications.application_id');
		$this->db->join('xin_jobs', 'xin_jobs.job_id = xin_job_applications.job_id');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id');
		$this->db->group_by('ex_applicants.applicant_id');
		$this->db->order_by('xin_job_applications.exam_date', 'DESC');
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	// count all appeared
	public function count_all_appeared(){
		return $this->db->count_all('ex_applicants');
	}
	// all appeared applicants
	public function all_appeared($limit='', $offset=''){
		$this->db->select('ex_applicants.applicant_id,
							xin_job_applications.application_id,
							xin_job_applications.fullname,
							xin_job_applications.email,
							xin_job_applications.created_at,
							xin_job_applications.exam_date,
							xin_jobs.job_id,
							xin_jobs.job_title,
							xin_companies.company_id,
							xin_companies.name as compName');
		$this->db->from('ex_applicants');
		$this->db->join('xin_job_applications', 'ex_applicants.applicant_id = xin_job_applications.application_id');
		$this->db->join('xin_jobs', 'xin_jobs.job_id = xin_job_applications.job_id');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id');
		$this->db->group_by('ex_applicants.applicant_id');
		$this->db->order_by('xin_job_applications.exam_date', 'DESC');
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
		$this->db->join('xin_countries', 'xin_companies.country = xin_countries.country_id');
		$this->db->join('xin_company_type', 'xin_companies.type_id = xin_company_type.type_id');
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
							city.id,
							city.name as city_name1,
							provinces.id,
							provinces.name as prov_name,
							domicile.id,
							domicile.name as dom_name');
		$this->db->from('xin_job_applications');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id');
		$this->db->join('age', 'xin_job_applications.age = age.id');
		$this->db->join('education', 'xin_job_applications.education = education.id');
		$this->db->join('city', 'xin_job_applications.city_name = city.id');
		$this->db->join('provinces', 'xin_job_applications.province = provinces.id');
		$this->db->join('domicile', 'xin_job_applications.domicile = domicile.id');
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
							city.id,
							city.name as cityName,
							areas.id,
							areas.name as areaName,
							domicile.id,
							domicile.name as domName,
							education.id,
							education.name as eduName,
							age.id,
							age.name as ageName');
		$this->db->from('xin_jobs');
		$this->db->join('xin_job_type', 'xin_jobs.job_type = xin_job_type.job_type_id');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id');
		$this->db->join('provinces', 'xin_jobs.province = provinces.id');
		$this->db->join('city', 'xin_jobs.city_name = city.id');
		$this->db->join('areas', 'xin_jobs.area_name = areas.id');
		$this->db->join('domicile', 'xin_jobs.domicile = domicile.id');
		$this->db->join('education', 'xin_jobs.education = education.id');
		$this->db->join('age', 'xin_jobs.age = age.id');
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
		$this->db->join('xin_companies', 'ex_questions.project_id = xin_companies.company_id');
		$this->db->join('xin_designations', 'ex_questions.designation_id = xin_designations.designation_id');
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
							xin_companies.name as compName');
		$this->db->from('xin_job_applications');
		$this->db->join('xin_jobs', 'xin_job_applications.job_id = xin_jobs.job_id');
		$this->db->join('xin_companies', 'xin_jobs.company = xin_companies.company_id');
		$this->db->join('xin_designations', 'xin_jobs.designation_id = xin_designations.designation_id');
		$this->db->where('xin_job_applications.created_at >=', $date_from);
		$this->db->where('xin_job_applications.created_at <=', $date_to);
		$this->db->or_where('xin_job_applications.job_id', $job_id);
		$this->db->or_where('xin_companies.company_id', $project);
		$this->db->or_where('xin_designations.designation_id', $designation);
		$results =  $this->db->get();
		return $results->result();
	}
}

?>