<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_longlisted_model extends CI_Model 
{




    public function __construct()

    {

        parent::__construct();

        $this->load->database();

    }




 
 public function getCandidates($job_id,$gender,$age,$education,$minimum_experience,$province,$city_name){
  
  ($age>0) ? $condition1 = " age >= ". $age : '';
  
  ($education>0) ? $condition2 = " education>=" . $education : '';
  
  ($minimum_experience>0) ? $condition3 = " minimum_experience>=" . $minimum_experience : '';                                    
  //($province>0) ? $condition4 = " province=" . $province : '';
                     
  //($city_name>0) ? $condition5 = " city_name=" . $city_name : '';
                               
   $condition6 =    " job_id =" . $job_id . 
                    " AND gender =" . $gender .                     
                    " AND application_status=1"; 

  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');

  ($age>0) ? $this->db->where($condition1) : '';
  ($education>0) ? $this->db->where($condition2) : '';
  ($minimum_experience>0) ? $this->db->where($condition3) : '';
  //($province>0) ? $this->db->where($condition4) : '';
  //($city_name>0) ? $this->db->where($condition5) : '';
   $this->db->where($condition6);
   
  //$this->db->where($condition);
 //	$this->db->limit(1);
  
		$query = $this->db->get(); 
    //echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				return $query->result();

			} else {
				return null;
			}

 }




 public function getCandidatesAuto($job_id,$gender,$age,$education,$minimum_experience,$province,$city_name){
  
  ($age>0) ? $condition1 = " age >= ". $age : '';
  
  ($education>0) ? $condition2 = " education>=" . $education : '';
  
  ($minimum_experience>0) ? $condition3 = " minimum_experience>=" . $minimum_experience : ''; 

  ($gender==2) ? '' : $condition4 = " gender=" . $gender;                                    
  //($province>0) ? $condition4 = " province=" . $province : '';
                     
  //($city_name>0) ? $condition5 = " city_name=" . $city_name : '';
                               
   $condition6 =    " job_id =" . $job_id .                      
                    " AND application_status=1"; 

  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');

  ($age>0) ? $this->db->where($condition1) : '';
  ($education>0) ? $this->db->where($condition2) : '';
  ($minimum_experience>0) ? $this->db->where($condition3) : '';
  ($gender) ? $this->db->where($condition4) : '';
  //($province>0) ? $this->db->where($condition4) : '';
  //($city_name>0) ? $this->db->where($condition5) : '';
   $this->db->where($condition6);
   
  //$this->db->where($condition);
 // $this->db->limit(1);
  
    $query = $this->db->get(); 
    //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();

      } else {
        return null;
      }

 }




public function getCandidatesnn($job_id){
  
  $condition =      " job_id =" . $job_id .                     
                    " AND application_status=11";
   

  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');

  $this->db->where($condition);
   
  //$this->db->where($condition);
 // $this->db->limit(1);
  
    $query = $this->db->get(); 
    //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();

      } else {
        return null;
      }

 }







public function singlejoballCandidates($job_id){
  
  $condition =      " job_id =" . $job_id . " AND application_status=1";
   
  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');
  $this->db->where($condition);
    
    $query = $this->db->get();  //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }

 }


/*
public function showReservePositions($location_detail->location_id){
  
  $condition =      "application_status=1";
   
  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  //$this->db->order_by('application_id', 'DESC');
  $this->db->where($condition);
    
    $query = $this->db->get();  //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }

 }
*/





public function getShortlistCandidates($job_id,$gender,$age,$education,$minimum_experience,$domicile,$province,$city_name){
  
  $condition =      " job_id =" . $job_id . 
                    " AND gender =" . $gender . 
                    " AND age = ". $age . 
                    " AND education=" . $education .
                    " AND minimum_experience=" . $minimum_experience .
                    " AND domicile=" . $domicile .
                    " AND province=" . $province .
                    " AND city_name=" . $city_name .
                    " AND application_status=2";
   
  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');
  $this->db->where($condition);
    
    $query = $this->db->get();  //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }

 }


public function getShortlistCandidatesnn($job_id){
  
  $condition =      " job_id =" . $job_id . 
                  
                    " AND application_status=2";
   
  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');
  $this->db->where($condition);
    
    $query = $this->db->get();  //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }

 }


public function getReservedCandidates($job_id){
  
  $condition =      " job_id =" . $job_id . 
                  
                    " AND application_status=20";
   
  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');
  $this->db->where($condition);
    
    $query = $this->db->get();  //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }

 }




public function getSelectedCandidates($job_id,$gender,$age,$education,$minimum_experience,$domicile,$province,$city_name){
  
  $condition =      " job_id =" . $job_id . 
                    " AND gender =" . $gender . 
                    " AND age = ". $age . 
                    " AND education=" . $education .
                    " AND minimum_experience=" . $minimum_experience .
                    " AND domicile=" . $domicile .
                    " AND province=" . $province .
                    " AND city_name=" . $city_name .
                    " AND application_status=12";
   
  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');
  $this->db->where($condition);
    
    $query = $this->db->get(); // echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }

 }




public function getSelectedCandidatesnn2($job_id){
  
  $condition =      " job_id =" . $job_id . 
                    " AND application_status=12";
   
  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');
  $this->db->where($condition);
    
    $query = $this->db->get();  //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }

 }


 public function getReserveSelectedCandidates($job_id){
  
  $condition =      " job_id =" . $job_id . 
                    " AND application_status=13";
   
  $this->db->select("application_id, job_id, user_id, fullname, email, gender, age, education, minimum_experience, domicile, province, city_name, message, job_resume, application_status, application_remarks, created_at"); 

  $this->db->from('xin_job_applications');
  $this->db->order_by('application_id', 'DESC');
  $this->db->where($condition);
    
    $query = $this->db->get();  //echo $this->db->last_query();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return null;
      }

 }




public function updatelonglist($jobId) {
    //extract($data);
    $this->db->where('application_id', $jobId);
    //echo $this->db->last_query(); exit();
    $this->db->update('xin_job_applications', array('application_status' => '2')); // status for short list
    return true;
}



public function addtolonglist($jobId) {
    //extract($data);
    $this->db->where('application_id', $jobId);
    //echo $this->db->last_query(); exit();
    $this->db->update('xin_job_applications', array('application_status' => '11')); // status for short list
    return true;
}


public function addtoclosedjob($jobId) {
    //extract($data);
    $this->db->where('job_id', $jobId);
    //echo $this->db->last_query(); exit();
    $this->db->update('xin_jobs', array('status' => '0'));
    return true;
}


public function getjobdetails($jobId){
  $condition = " job_id =" . $jobId;

  $this->db->select("`job_id`, `company`, `job_title`, `designation_id`, `department_id`, `job_type`, `job_vacancy`,  `gender`, `minimum_experience`, `province`, `city_name`, `education`, `age`, `date_of_closing`, `area_name`, `domicile`, `cnic`, `short_description`, `long_description`, `status`, `created_at`"); 

  $this->db->from('xin_jobs');

  $this->db->where($condition);

   $query = $this->db->get();
   
    //echo $this->db->last_query();

  return $query->result();
 }





   public function update_shift_areas_code($id,$data){

        $this->db->where('id', $id);

        if( $this->db->update('location_job_position',$data)) {

          return true;

        } else {

          return false;

        }   

      }




     public function read_postedjob_information($jobId) {

        $condition = "job_id =" . "'" . $jobId . "'";

        $this->db->select('*');

        $this->db->from('xin_jobs');

        $this->db->where($condition);

        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {

          return $query->result();

        } else {

          return null;

        }

      }














 public function checkReserveJobs($locationId){
  
  $condition = " location_id =" . $locationId;

  $this->db->select("`job_id`, `location_id`"); 

  $this->db->from('xin_jobs');

  $this->db->where($condition);
  
  $this->db->limit(1);

   $query = $this->db->get();
   
    //echo $this->db->last_query();

  return $query->result();
 }


 public function checkReserveJobs2($job_id){
  
  $condition = " job_id =" . $job_id." AND application_status=20";

  $this->db->select("`job_id`, `application_id`, `fullname`, `email`, `application_status`, `created_at`"); 

  $this->db->from('xin_job_applications');

  $this->db->where($condition);
  
  //$this->db->limit(1);

   $query = $this->db->get();
   
    //echo $this->db->last_query();

  return $query->result();
 }

public function getjobshortdetails($jobId){
    $condition = " job_id =" . $jobId;
  
  $this->db->select("`job_id`, `job_title`, `designation_id`, `job_type`, `job_vacancy`"); 
  $this->db->from('xin_jobs');
  $this->db->where($condition);
  $this->db->limit(1);
   $query = $this->db->get();

  return $query->result();
 }







public function getJobPosted(){
  $condition = "status = 1";

  $this->db->select("`job_id`, `company`, `job_title`, `designation_id`, `job_type`, `job_vacancy`,  `gender`, `minimum_experience`, `province`, `city_name`, `education`, `age`, `date_of_closing`, `area_name`, `domicile`, `cnic`, `short_description`, `long_description`, `reserve`, `status`, `created_at`"); 

  $this->db->from('xin_jobs');
  $this->db->where($condition);
  $this->db->order_by("job_id", "DESC");
  $this->db->limit(100);

   $query = $this->db->get();
   
    // echo $this->db->last_query();

  return $query->result();
 }




public function getJobPostedn($projid,$provid){
  $condition1 = "company =".$projid;
  $condition2 = "province =".$provid;
  $condition3 = "status = 1";

  $this->db->select("`job_id`, `company`, `job_title`, `designation_id`, `job_type`, `job_vacancy`,  `gender`, `minimum_experience`, `province`, `city_name`, `education`, `age`, `date_of_closing`, `area_name`, `domicile`, `cnic`, `short_description`, `long_description`, `reserve`, `status`, `created_at`"); 

  $this->db->from('xin_jobs');

  $this->db->where($condition1);
  $this->db->where($condition2);
  $this->db->where($condition3);


   $query = $this->db->get();
   
    // echo $this->db->last_query();

  return $query->result();
 }



public function getJobPostedBycondition($company,$province){
  $condition = "status = 1 AND company = ".$company." AND province = ".$province." ";

  $this->db->select("`job_id`, `company`, `job_title`, `designation_id`, `job_type`, `job_vacancy`,  `gender`, `minimum_experience`, `province`, `city_name`, `education`, `age`, `date_of_closing`, `area_name`, `domicile`, `cnic`, `short_description`, `long_description`, `reserve`, `status`, `created_at`"); 

  $this->db->from('xin_jobs');

  $this->db->where($condition);

   $query = $this->db->get();
   
     //echo $this->db->last_query();

  return $query->result();
 }


public function getJobPostedBycondition4all($company){
  $condition = "status = 1 AND company = ".$company." ";

  $this->db->select("`job_id`, `company`, `job_title`, `designation_id`, `job_type`, `job_vacancy`,  `gender`, `minimum_experience`, `province`, `city_name`, `education`, `age`, `date_of_closing`, `area_name`, `domicile`, `cnic`, `short_description`, `long_description`, `reserve`, `status`, `created_at`"); 

  $this->db->from('xin_jobs');

  $this->db->where($condition);

   $query = $this->db->get();
   
     //echo $this->db->last_query();

  return $query->result();
 }

public function test_exists($table,$field,$value)
{
    $this->db->where($field,$value);
    $query = $this->db->get($table);
    if (!empty($query->result_array())){
        return 1;
    }
    else{
        return 0;
    }
}


public function test_result_exists($table,$field,$value)
  {
      $this->db->where($field,$value);
      $query = $this->db->get($table);
      if (!empty($query->result_array())){
          return 1;
      }
      else{
          return 0;
      }
  }



public function test_result_byjobId($jobId){
    $condition = " rollnumber =" . $jobId;
  
  $this->db->select("`rollnumber`, `obtain_marks`, `total_marks`"); 
  $this->db->from('test_result');
  $this->db->where($condition);
  $this->db->limit(1);
   $query = $this->db->get();
//echo $this->db->last_query();
  return $row = $query->result();
 }


public function interview_result_byjobId($jobId){
    $condition = " rollnumber =" . $jobId;
  
  $this->db->select("`rollnumber`, `obtain_marks`, `total_marks`"); 
  $this->db->from('interview_result');
  $this->db->where($condition);
  $this->db->limit(1);
   $query = $this->db->get();

  return $query->result();
 }






  public function interview_exists($table,$field,$value)
    {
        $this->db->where($field,$value);
        $query = $this->db->get($table);
        if (!empty($query->result_array())){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function interview__result_exists($table,$field,$value)
    {
        $this->db->where($field,$value);
        $query = $this->db->get($table);
        if (!empty($query->result_array())){
            return 1;
        }
        else{
            return 0;
        }
    }



    public function select_candidate($data){

              $this->db->insert('selected_candidates', $data);
              if ($this->db->affected_rows() > 0) {
                return true;
              } else {
                return false;
              }
    }

    public function update_user_to_select($job_id) {
     
        $this->db->where('application_id', $job_id);
         
        $this->db->update('xin_job_applications', array('application_status' => '12')); // means user selected
        
        return true;
    }

    public function update_user_to_select2($job_id) {
     
        $this->db->where('application_id', $job_id);
         
        $this->db->update('xin_job_applications', array('application_status' => '13')); // means user selected
        
        return true;
    }


    public function addapplicationtoReserve($application_id) {
     
        $this->db->where('application_id', $application_id);
         
        $this->db->update('xin_job_applications', array('application_status' => '20'));  // for reserve applicant 
        
        return true;
    }

     public function addjobtoReserve($job_id) {
     
        $this->db->where('job_id', $job_id);
         
        $this->db->update('xin_jobs', array('reserve' => '1'));  // for reserve job 
        
        return true;
    }

    public function openReserve($job_id) {
         
            $this->db->where('job_id', $job_id);
             
            $this->db->update('xin_jobs', array('status' => '1'));  // for reserve job 
            
            return true;
        }



    public function locationClosed($locationId) {
         
            $this->db->where('id', $locationId);
             
            $this->db->update('location_job_position', array('status' => '1'));  // for locastion filled
            
            return true;
        }    





 
}
?>