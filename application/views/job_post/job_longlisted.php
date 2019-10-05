<?php

/* Announcement view

*/

?>

<?php $session = $this->session->userdata('username');


    //$this->load->model("Job_post_model");
    //$job = $this->Job_post_model->read_job_information($r->job_id);

$get_total_segments = $this->uri->total_segments();
$theJobId = $this->uri->segment($get_total_segments);


$viewTab =  $this->uri->segment(2);
$segmentID =  $this->uri->segment(3);


/*
elseif($viewTab=='getlonglistedsinglerecord'){ $activeTab = 'class="active"'; }
elseif($viewTab=='getshortlistedrecord'){ $activeTab = 'class="active"'; }*/

//$activeTab = 'class="active"';

$message = $this->session->flashdata('message');

if ($message) {
                  echo $message = '<div class="alert alert-success text-center"><strong>Success!</strong> Successfully Shortlisted.</div>';
}

$testmessage = $this->session->flashdata('testmessage');

if ($testmessage) {
                  echo $testmessage = '<div class="alert alert-success text-center"><strong>Success!</strong> Test Successfully Created.</div>';
}

$interviewmessage = $this->session->flashdata('interviewmessage');

if ($interviewmessage) {
                  echo $interviewmessage = '<div class="alert alert-success text-center"><strong>Success!</strong> Interview Successfully Created.</div>';
}

$appformmessage = $this->session->flashdata('appformmessage');

if ($appformmessage) {
                  echo $appformmessage = '<div class="alert alert-success text-center"><strong>Success!</strong> Application Form Created Successfully.</div>';
}

$userselectedmessage = $this->session->flashdata('userselectedmessage');
if ($userselectedmessage) { echo $userselectedmessage = '<div class="alert alert-success text-center"><strong>Success!</strong> '.$userselectedmessage.' </div>'; }

$positionsLimitMessage = $this->session->flashdata('positionsLimitMessage');
if ($positionsLimitMessage) { echo $positionsLimitMessage = '<div class="alert alert-danger text-center"><strong>Alert!</strong> '.$positionsLimitMessage.' </div>'; }


$contactmessage = $this->session->flashdata('contactmessage');
if ($contactmessage) { echo $contactmessage = '<div class="alert alert-success text-center"><strong>Success!</strong> '.$contactmessage.' </div>'; }



//print_r($posts);


      $this->load->model('provinceCity');
      $AllCities = $this->provinceCity->getAllCity();  




      $this->load->model('employees_model');
      $all_employees = $this->employees_model->getEmpName(); 
     

     

 

?>
<?php
 

 $jobdetails = $this->Job_longlisted_model->getjobshortdetails($segmentID);

    $this->load->model("Designation_model");

 foreach($jobdetails as $jobd){ 

    $designation = $this->Designation_model->read_designation_information($jobd->designation_id);

    if(!is_null($designation)){ $designation_name = $designation[0]->designation_name; } else { $designation_name = '--'; }

          $jobTitle = $jobd->job_title;
          $designation = $designation_name;     
          $NoOfVacancy = $jobd->job_vacancy;
}

?>



<!-- <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
 <style type="text/css"> .ui-datepicker{display: none !important;} .form-control.ddfield{ height: 36px !important; width: 300px; border: 1px solid #ccc; } .inputfield{ width: 300px; margin-top: -6px; padding: 10px; line-height: 1rem; background-color: #f6f7f8; border: 1px solid #e1e4e7; } .datefldset{ background: none !important; border: 0px !important; } .lablewidth{ width: 180px; text-align: right; font-size: 15px; } </style>


<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />







<div class="box box-block bg-white">

<ul class="nav nav-tabs">
      

 
 <?php if($viewTab=='getReservedRecords' || $viewTab=='reserveselectedrecord'){ ?>
       
      <li <?php echo (($viewTab=='getReservedRecords') ? 'class="active"' : ''); ?>>
        <a href="<?php echo base_url(); ?>job_longlisted/getReservedRecords/<?php echo $theJobId; ?>" >Short Listing</a>
      </li>
      <li <?php echo (($viewTab=='reserveselectedrecord') ? 'class="active"' : ''); ?>>
        <a href="<?php echo base_url(); ?>job_longlisted/reserveselectedrecord/<?php echo $theJobId; ?>" >Selected</a>
      </li>

 <?php }else{ ?>

      <li <?php echo (($viewTab=='getsinglejoballapplication') ? 'class="active"' : ''); ?>>
        <a  href="<?php echo base_url(); ?>job_longlisted/getsinglejoballapplication/<?php echo $theJobId; ?>" >All Applications</a>
      </li> 
      <li <?php echo (($viewTab=='getlonglistedsinglerecord') ? 'class="active"' : ''); ?>>
        <a href="<?php echo base_url(); ?>job_longlisted/getlonglistedsinglerecord/<?php echo $theJobId; ?>" >Long Listing(Auto)</a>
      </li>
      <li <?php echo (($viewTab=='getshortlistedrecord') ? 'class="active"' : ''); ?>>
        <a href="<?php echo base_url(); ?>job_longlisted/getshortlistedrecord/<?php echo $theJobId; ?>" >Short Listing</a>
      </li>
      <li <?php echo (($viewTab=='getselectedrecord') ? 'class="active"' : ''); ?>>
        <a href="<?php echo base_url(); ?>job_longlisted/getselectedrecord/<?php echo $theJobId; ?>" >Selected</a>
      </li>

 <?php } ?>

</ul>
<!-- 

  <h2><strong><?php //echo $this->lang->line('xin_list_all');?></strong> 
      
     <a href="<?php echo base_url(); ?>job_longlisted/getsinglejoballapplication/<?php echo $theJobId; ?>">All Applications </a> | 
     <a href="<?php echo base_url(); ?>job_longlisted/getlonglistedsinglerecord/<?php echo $theJobId; ?>"> Long list </a> | 
     <a href="<?php echo base_url(); ?>job_longlisted/getshortlistedrecord/<?php echo $theJobId; ?>"> Short list </a> | 
     <a href=""> Slected </a> | 
  </h2> -->
<!-- 
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
 -->




<script type="text/javascript">
  $(document).ready(function() {
    $('#job_listing').DataTable();
} );
</script>

<div class="table-responsive">

<?php if ($allCandidates){ ?>
    <table id="job_listing" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Education</th>
                <th>Domicile</th>
                <th>Province</th>
                <th>City</th>
                <th>Action</th>
                 
            </tr>
        </thead>
        <tbody>


           <?php 
                $i = 0;
                $candidate = '';
                foreach($allCandidates as $candidate){
                  $i++;
                  $gender = (($candidate->gender==0)?'Male':(($candidate->gender==1)?'Female':'No'));
            ?>
            <tr>
                <td><?php echo $i; ?></td>                
                <td><?php echo $candidate->fullname;?></td>
                <td><?php echo $candidate->email;?></td>
                <td><?php echo $gender; ?></td>
                <td><?php foreach($getage as $ag){ echo $ag->name;  } ;?></td>
                <td><?php foreach($getEducation as $ed){ echo  $ed->name;  } ;?></td>
                <td><?php foreach($getProvince as $domic){ echo  $domic->name;  } ;?></td>
                <td><?php foreach($getProvince as $prov){ echo  $prov->name;  } ;?></td>
                <td><?php foreach($getcityName as $citi){ echo  $citi->name;  } ;?></td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCart">View</button>

<?php if($viewTab=='getshortlistedrecord'){?>   

                    
    <?php
    // $this->load->model('Job_longlisted_model');
          $testAssigned = $this->Job_longlisted_model->test_exists('assign_test','rollnumber',$candidate->application_id); 
          $checktestresult = $this->Job_longlisted_model->test_result_exists('test_result','rollnumber',$candidate->application_id); 
           
          if($testAssigned==0){ // yar gahr test nhe dia to zero condition use krnegy

                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#testdate'.$i.'">Test</button>';
                }else{ 
                  
                       if($checktestresult==0){ // if test not given then zero and jsut show test tab else text result marks 
                                echo '<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Test</button>';
                          }else{ $testmarks = $this->Job_longlisted_model->test_result_byjobId($candidate->application_id); foreach ($testmarks as $row){  $testPM = $row->obtain_marks*100/$row->total_marks; }
                                  
                                echo '<button type="button" class="btn btn-success" >'.round($testPM).'%'.'</button>';
                          }
                    }

    ?>
         
    <?php
    // $this->load->model('Job_longlisted_model');
          $interviewAssigned = $this->Job_longlisted_model->interview_exists('assign_interview','rollnumber',$candidate->application_id); 
          $checkinterviewresult = $this->Job_longlisted_model->interview__result_exists('interview_result','rollnumber',$candidate->application_id); 
         
          if($interviewAssigned==0){ // yar aghr interview nhe dia to zero condition use krnegy
                             echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#interviewdialog'.$i.'">Interview</button>';
                  }else{ 
                    
                     if($checkinterviewresult==0){ // aghr interview result nhe dia to zero condition ma serf tab show ho jay
                             echo '<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Interview</button>';
                            }else{ $interviewmarks = $this->Job_longlisted_model->interview_result_byjobId($candidate->application_id); foreach ($interviewmarks as $intr){  $interviewPM = $intr->obtain_marks*100/$intr->total_marks; }
                             echo '<button type="button" class="btn btn-success" >'.round($interviewPM).'%'.'</button>';
                            }
                  }
         
        //if(!empty($checkinterviewresult) && !empty($checktestresult)){     
            echo ' <a href="'. base_url().'job_longlisted/selectedtopermanant/'. $candidate->job_id.'/'. $candidate->application_id.'/'. $NoOfVacancy.'"><button type="button" class="btn btn-primary">Select Applicant</button></a>';   
        //  }

        if(!empty($checkinterviewresult) && !empty($checktestresult)){     
            echo ' <a href="'. base_url().'job_longlisted/addapplicationtoReserve/'. $candidate->job_id.'/'. $candidate->application_id.'"><button type="button" class="btn btn-warning">Add To Reserve</button></a>';  
              //echo $candidate->application_status; // the reserve status shoulb be 20
          }          
      
 ?>
                     


<?php }elseif($viewTab=='getReservedRecords'){?>   

                    
    <?php
    // $this->load->model('Job_longlisted_model');
          $testAssigned = $this->Job_longlisted_model->test_exists('assign_test','rollnumber',$candidate->application_id); 
          $checktestresult = $this->Job_longlisted_model->test_result_exists('test_result','rollnumber',$candidate->application_id); 
           
          if($testAssigned==0){ // yar gahr test nhe dia to zero condition use krnegy

                        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#testdate'.$i.'">Test</button>';
                }else{ 
                  
                       if($checktestresult==0){ // if test not given then zero and jsut show test tab else text result marks 
                                echo '<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Test</button>';
                          }else{ $testmarks = $this->Job_longlisted_model->test_result_byjobId($candidate->application_id); foreach ($testmarks as $row){  $testPM = $row->obtain_marks*100/$row->total_marks; }
                                  
                                echo '<button type="button" class="btn btn-success" >'.round($testPM).'%'.'</button>';
                          }
                    }

    ?>
         
    <?php
    // $this->load->model('Job_longlisted_model');
          $interviewAssigned = $this->Job_longlisted_model->interview_exists('assign_interview','rollnumber',$candidate->application_id); 
          $checkinterviewresult = $this->Job_longlisted_model->interview__result_exists('interview_result','rollnumber',$candidate->application_id); 
         
          if($interviewAssigned==0){ // yar aghr interview nhe dia to zero condition use krnegy
                             echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#interviewdialog'.$i.'">Interview</button>';
                  }else{ 
                    
                     if($checkinterviewresult==0){ // aghr interview result nhe dia to zero condition ma serf tab show ho jay
                             echo '<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Interview</button>';
                            }else{ $interviewmarks = $this->Job_longlisted_model->interview_result_byjobId($candidate->application_id); foreach ($interviewmarks as $intr){  $interviewPM = $intr->obtain_marks*100/$intr->total_marks; }
                             echo '<button type="button" class="btn btn-success" >'.round($interviewPM).'%'.'</button>';
                            }
                  }
         
        //if(!empty($checkinterviewresult) && !empty($checktestresult)){     
            echo ' <a href="'. base_url().'job_longlisted/selectedtopermanantR/'. $candidate->job_id.'/'. $candidate->application_id.'/'. $NoOfVacancy.'"><button type="button" class="btn btn-primary">Select Applicant</button></a>';   
        //  }

        /*if(!empty($checkinterviewresult) && !empty($checktestresult)){     
            echo ' <a href="'. base_url().'job_longlisted/addapplicationtoReserve/'. $candidate->job_id.'/'. $candidate->application_id.'"><button type="button" class="btn btn-warning">Add To Reserve</button></a>';  
               
          } */
          echo ' <button type="button" class="btn btn-warning">Reserved</button>';         
      
 ?>
                     





<?php }elseif($viewTab=='getsinglejoballapplication'){?>

                <a href="<?php echo base_url(); ?>job_longlisted/addtolonglisted/<?php echo $candidate->application_id;?>"><button type="button" class="btn btn-primary">Add Long List</button></a>


<?php }elseif($viewTab=='getselectedrecord' || $viewTab=='reserveselectedrecord'){

 
 
 //$ql = $this->db->select('user_id')->from('selected_candidates')->where('user_id',$candidate->application_id)->get();
$CheckContract='';
$ContractR=''; 
$CheckContract = $this->db->select('user_id,status')->from('employee_contract')->where(array('user_id'=>$candidate->application_id))->get();
$ContractR = $CheckContract->result();
   
 //echo $this->db->last_query(); 
$CheckContractStatus='';
$contractrow='';
foreach ($ContractR as $contractrow)
{
        $CheckContractRow = $contractrow->user_id;
        $CheckContractStatus = $contractrow->status;
}

//exit();

$CheckApplicationForm = $this->db->select('user_id')->from('employee_basic_info')->where('user_id',$candidate->application_id)->get();
$ApplicationFormComp = $CheckApplicationForm->result();

if(!empty($ContractR)){ // add contract form 
       
        if($CheckContractStatus=='1'){   
                  if(!empty($ApplicationFormComp)){        
                                echo '<button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Hired </button> '; 
                                //echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalformapplication'.$i.'">Application Form</button>';  
                              }else{
                                echo '<button type="button" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Contract Approved</button> ';
                                echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalformapplication'.$i.'">Add Application Form</button>';  
                              }

          }elseif($CheckContractStatus=='0'){
                  echo '<button type="button" class="btn btn-warning">Contract Waiting for Approval</button>'; 

               }                       
     }else{
            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contractform'.$i.'">Add Contract</button>'; 
            
      }    

?>
 <div class="modal fade" id="contractform<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document"  style="width: 100%; max-width: 60%;">
            <div class="modal-content">
             <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Contract Form... </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="container">
          <form action="<?php echo site_url("job_post/assign_employee_contract") ?>" method="post" name="add_job" id="xin-form">
                        
                      <input type="hidden" name="rollnumber" value="<?php echo $candidate->application_id;?>">
                    <br>
                     
                    <!-- <div class="row text-center">
                        <div class="col-lg-10">
                          <div class="form-group">
                            <label for="" class="control-label lablewidth">Basic Salery: </label>
                            <input type="text" name="basic_salery" value="" class="inputfield">
                          </div>
                    </div>
                    </div>
                    <br> -->

                      <div class="row text-center">
                        <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="date_of_closing" class="control-label lablewidth">From Date: </label>
                                    <input id="from_date" name="from_date" class="form-control fcn" required="required" />
                                </div>
                      </div>
                    </div>                    
                    <br>

                    <div class="row text-center">
                        <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="date_of_closing" class="control-label lablewidth">To Date: </label>
                                    <input id="to_date" name="to_date" class="form-control fcn" required="required" />
                                </div>
                      </div>
                    </div>                    
                    <br>

                    <div class="row text-center">
                        <div class="col-lg-10">
                        <div class="form-group">
                              <label class="control-label lablewidth">Contract Manager: </label>
                              <select title="Select Contract Manager" name="contract_manager" data-plugin="select_hrm" class="form-control ddfield">      
                                  <option value="">Select Contract Manager</option>
                                  <?php
                                  foreach ($all_employees as $employee) {
                                      echo '<option value="'.$employee->user_id.'">'.$employee->first_name.'</option>';
                                  }
                                  ?>
                              </select>
                          </div>
                    </div>
                    </div>
                    <br>
                     <!-- <div class="row text-center">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label class="control-label lablewidth">Contract Type: </label>
                                <select title="Select Type" name="contract_type" data-plugin="select_hrm" class="form-control ddfield">      
                                    <option value="">Select Type</option>
                                    <?php
                                    foreach ($all_employees as $employee) {
                                        echo '<option value="'.$employee->user_id.'">'.$employee->first_name.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                    </div>
                    </div>
                    <br> -->

                    <!-- <div class="row text-center">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label for="long_description"><?php echo $this->lang->line('xin_long_description');?></label>
                                <textarea class="form-control textarea" placeholder="" name="long_description" cols="30" rows="15" id="long_description"></textarea>
                            </div>
                        </div>
                    </div> -->

                    <div class="row text-center">
                        <div class="col-lg-10">
                             <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?></button>
                        </div>
                    </div>
                    <br>

                    </form>
                    </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>   



                 
        <div class="modal fade" id="modalformapplication<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="FormApplicationModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document" style="width: 100%; max-width: 90%;">
            <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Applicant Form... </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <!--Body-->
            <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>  Employee Form
                            </div>                            
                        </div>
                        <div class="portlet-body form">
                          <form action="<?php echo site_url("job_post/add_application_form") ?>" class="form-horizontal" id="Form_Employee_Edit" method="post" accept-charset="utf-8">
                            <div class="form-body">
                                <input type="hidden" name="application_id" value="<?php echo $candidate->application_id; ?>">

                                <input type="hidden" name="company_id" value="<?php  echo $company_id; ?>">
                                <input type="hidden" name="designation_id" value="<?php  echo $designation_id; ?>">
                                <input type="hidden" name="department_id" value="<?php  echo $department_id; ?>">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Job Applied for:<span class="text-info"></span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="job_title" class="form-control fcn" value="<?php echo $jobTitle; ?>" placeholder="" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Department:<span class="text-info"></span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="department_name" class="form-control fcn" value="" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Employee Name:<span class="text-info"></span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="emp_name" class="form-control fcn" value="<?php echo $candidate->fullname; ?>" placeholder="Name of Employee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Father Name:<span class="text-info"></span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="father_name" class="form-control fcn" value="" placeholder="Employees's Father Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Relation With Applicant:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="relation_id" id="relation_id" class="form-control fcn select input-large">
                                                    <option value="">Select relation</option>
                                                    <option value="1">Father</option>
                                                    <option value="2">Husband</option>
                                                    <option value="3">Brother</option>
                                                    <option value="4">Uncle/Aunt</option>
                                                    <option value="5">Info Not Available</option>                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Gender:<span class="text-info"></span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="gender" class="form-control fcn select input-large">
                                                    <option value="">Select Gender</option>
                                                    <option value="0" <?php echo ($candidate->gender == 0)? 'selected="selected"':''; ?> >Male</option>
                                                    <option value="1" <?php echo ($candidate->gender == 1)? 'selected="selected"':''; ?>>Female</option>                                                
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Date of birth:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                
                                                <input id="date_of_birth" name="date_of_birth" class="form-control fcn" required="required" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <!-- <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Check Date of birth:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="check_dob" id="check_dob" class="form-control fcn select input-large">
                                                    <option value="">Select DOB Check Digit</option>
                                                    <option value="1" selected="selected">1-Day,Month and Year available</option><option value="2">2-Only Year available</option><option value="3">3-Date of Birth not mentioned </option>                                                </select>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Marital Status:<span class="text-info"></span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="marital_status" class="form-control fcn select input-large">
                                                    <option value="">Select Marital Status</option>
                                                    <option value="1">Married</option>
                                                    <option value="2">Un-Married</option>
                                                    <option value="3">Divorced</option>
                                                    <option value="4">Widowed</option>
                                                    <option value="5">Seperated</option>
                                                    <option value="6">Info not available </option>                                                
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Date of Joining:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="date_of_joining" id="date_of_joining" class="form-control fcn date-picker" placeholder="Date of birth" format="dd-MM-yyyy" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                CNIC:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" name="cnic" class="form-control fcn mask_number13" placeholder="Employee's CNIC" value="1730174788420">
                                                <div class="help-block">
                                                    Enter CNIC with out any space or dash
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                CNIC Expiry Date:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="cnic_expiry_date" name="cnic_expiry_date" class="form-control fcn date-picker" placeholder="CNIC Expiry Date" format="dd-MM-yyyy" value="02-May-2019">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                CNIC Type:<span></span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="other_cnic_type_id" id="other_cnic_type_id" class="form-control fcn select2me input-large select2-offscreen" tabindex="-1">
                                                        <option value="">Select Type</option>
                                                        <option value="0" selected="selected">CNIC</option>
                                                        <option value="1">Afghan Card</option>
                                                        <option value="2">Token</option>
                                                        <option value="3">Employee Code as CNIC</option>
                                                        <option value="4">Area Code as CNIC</option>
                                                        <option value="5">CNIC Expire</option>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Contract Type:
                                            </label>
                                            <div class="col-md-6">
                                                <select name="employee_contract_type" class="form-control fcn" disabled="">
                                                    <option value="">Contract Type</option>
                                                    <option value="1">1-Probation Contract</option>
                                                    <option value="2">2-Regular Contract</option>
                                                    <option value="3">3-Extension</option>
                                                    <option value="4">4-Spinsaree</option>
                                                    <option value="5">5-Temporary</option>                                                
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Identification Name:<span></span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="other_id_name" name="other_id_name" class="form-control fcn " placeholder="Other id" value="Cnic">
                                                <div class="help-block">
                                                    (e.g, if Passport then write passport)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Other Id No:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="other_passport_id" name="other_passport_id" class="form-control fcn" placeholder="Applicant's other id no" value="">
                                                <div class="help-block">
                                                    e.g Passport Number
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Applicant Tribe:<span></span>
                                            </label>
                                            <div class="col-md-6">
                                              <select name="tribe" id="tribe" class="form-control fcn select2me input-large select2-offscreen" tabindex="-1">
                                                    <option value="">Select Tribe</option>
                                                    <option value="1">1-Yousaf Zai</option>
                                                    <option value="2">2-Mughal</option>
                                                    <option value="3">3-Mangrio</option>
                                                    <option value="5">5-Rajpoot</option>
                                                    <option value="6">6-Chughtai</option>
                                                    <option value="7">7-Khattak</option>
                                                    <option value="8">8-Naul (Rajput)</option>
                                                    <option value="10">10-Arain</option>
                                                    <option value="11">11-Jatt</option>
                                                    <option value="12">12-Bhutta</option>
                                                    <option value="13">13-Niazi</option>
                                                    <option value="14">14-Khan</option>
                                                    <option value="15">15-Laang</option>
                                                    <option value="16">16-Noon</option>
                                                    <option value="17">17-Bukhari</option>
                                                    <option value="18">18-Khokhar</option>
                                                    <option value="19">19-Malik</option>
                                                    <option value="20">20-Chaudhry</option>
                                                    <option value="21">21-Qazi</option>
                                                    <option value="22">22-Alyani</option>
                                                    <option value="23">23-Khoja</option>
                                                    <option value="24">24-Manjotha</option>
                                                    <option value="25">25-Bubar</option>
                                                    <option value="26">26-Wattoo</option>
                                                    <option value="27">27-Gujjar</option>
                                                    <option value="28">28-Awan</option>
                                                    <option value="29">29-Mohmand</option>
                                                    <option value="30">30-Sheikh</option>
                                                    <option value="31">31-Dhoon Awan</option>
                                                    <option value="32">32-Kassar</option>
                                                    <option value="33">33-Saraiki</option>
                                                    <option value="34">34-Sayed</option>
                                                    <option value="35">35-Tajra</option>
                                                    <option value="36">36-Nonari</option>
                                                    <option value="37">37-Hashmi</option>
                                                    <option value="38">38-Jatoi</option>
                                                    <option value="39">39-kashmiri</option>
                                                    <option value="40">40-Siddiqui</option>
                                                    <option value="41">41-Sardar</option>
                                                    <option value="42">42-Bhatti</option>
                                                    <option value="43">43-Butt</option>
                                                    <option value="44">44-Safi</option>
                                                    <option value="46">46-Rana</option>
                                                    <option value="47">47-Qureshi</option>
                                                    <option value="48">48-Moucher</option>
                                                    <option value="49">49-Bohar</option>
                                                    <option value="50">50-Rao</option>
                                                    <option value="51">51-Naqvi</option>
                                                    <option value="52">52-Sindila</option>
                                                    <option value="53">53-Khaki</option>
                                                    <option value="54">54-kohkhar</option>
                                                    <option value="55">55-Kazmi</option>
                                                    <option value="56">56-Baloch</option>
                                                    <option value="57">57-Marha</option>
                                                    <option value="58">58-Gazar</option>
                                                    <option value="59">59-Jutt odhana</option>
                                                    <option value="60">60-Shah</option>
                                                    <option value="61">61-Daha</option>
                                                    <option value="62">62-Jam</option>
                                                    <option value="63">63-Taragar</option>
                                                    <option value="64">64-Dharkan</option>
                                                    <option value="65">65-Mughlani</option>
                                                    <option value="66">66-Jogyani</option>
                                                    <option value="67">67-Zohrani</option>
                                                    <option value="68">68-Lashair</option>
                                                    <option value="69">69-Mithwani</option>
                                                    <option value="70">70-Khosa</option>
                                                    <option value="71">71-Nutkani</option>
                                                    <option value="72">72-Lagrana</option>
                                                    <option value="73">73-Mulghani Baloch</option>
                                                    <option value="74">74-Ansari</option>
                                                    <option value="75">75-Kitchi</option>
                                                    <option value="76">76-Afridi</option>
                                                    <option value="77">77-Chatta</option>
                                                    <option value="78">78-Khalil</option>
                                                    <option value="79">79-Swati</option>
                                                    <option value="80">80-Muhammad zai</option>
                                                    <option value="81">81-Mumakzai</option>
                                                    <option value="82">82-Bahacher</option>
                                                    <option value="83">83-Mian</option>
                                                    <option value="84">84-Wali Khel</option>
                                                    <option value="85">85-Hassan Khel</option>
                                                    <option value="86">86-Meo</option>
                                                    <option value="87">87-Sial</option>
                                                    <option value="88">88-Abbasi</option>
                                                    <option value="91">91-Meyo</option>
                                                    <option value="92">92-Kambho</option>
                                                    <option value="93">93-Sawati</option>
                                                    <option value="94">94-Mehar</option>
                                                    <option value="95">95-Chachar</option>
                                                    <option value="96">96-Sheen</option>
                                                    <option value="97">97-Chinoti</option>
                                                    <option value="98">98-Khoso</option>
                                                    <option value="99">99-Hashmi syed</option>
                                                    <option value="100">100-Mahsud</option>
                                                    <option value="101">101-Jadoon</option>
                                                    <option value="102">102-Momand</option>
                                                    <option value="103">103-Gadani</option>
                                                    <option value="104">104-Memon</option>
                                                    <option value="105">105-Magsi</option>
                                                    <option value="106">106-Soomro</option>
                                                    <option value="107">107-Abro</option>
                                                    <option value="108">108-Mahar</option>
                                                    <option value="109">109-Mallah</option>
                                                    <option value="110">110-Unar</option>
                                                    <option value="111">111-Ahmedani</option>
                                                    <option value="112">112-Laghari</option>
                                                    <option value="113">113-Chandia</option>
                                                    <option value="114">114-Wagan</option>
                                                    <option value="115">115-Syed</option>
                                                    <option value="116">116-Bhutto</option>
                                                    <option value="117">117-Baldai</option>
                                                    <option value="118">118-Bungash</option>
                                                    <option value="119">119-Langar</option>
                                                    <option value="120">120-Pechuho</option>
                                                    <option value="121">121-Lashari</option>
                                                    <option value="122">122-Kohistani</option>
                                                    <option value="123">123-Mangi</option>
                                                    <option value="124">124-Hashmani</option>
                                                    <option value="125">125-Atman Zai</option>
                                                    <option value="126">126-Quresh Sayyad</option>
                                                    <option value="127">127-Barakzai</option>
                                                    <option value="128">128-Shinwari</option>
                                                    <option value="129">129-Durrani</option><option value="130">130-Akbari</option><option value="131">131-Arbab</option><option value="132">132-Jamali</option><option value="133">133-Meghwar</option><option value="134">134-Sawand</option><option value="135">135-Jafri</option><option value="136">136-Popalzai</option><option value="137">137-Khawaja</option><option value="138">138-Veesar</option><option value="139">139-Marwat</option><option value="140">140-Khuhawar</option><option value="141">141-Nahyoon</option><option value="142">142-Lodo</option><option value="143">143-Gopang</option><option value="144">144-Awan Malik</option><option value="145">145-Mehmoodani</option><option value="146">146-Mastoi</option><option value="147">147-Halipoto</option><option value="148">148-Alwi</option><option value="149">149-Bhakhatri</option><option value="150">150-Arani</option><option value="151">151-Wazir</option><option value="152">152-Saleh Khail</option><option value="153">153-Lodhi</option><option value="154">154-Godhra</option><option value="155">155-Usman Khel</option><option value="156">156-Behari</option><option value="157">157-Qaimkhani</option><option value="158">158-Salarzai</option><option value="159">159-Channa</option><option value="160">160-Akakheel</option><option value="161">161-Qurashi</option><option value="162">162-Bangash</option><option value="163">163-Shirazi</option><option value="164">164-Mnalak</option><option value="165">165-Golani</option><option value="166">166-Lasi</option><option value="167">167-Khan khel</option><option value="168">168-Tanoli</option><option value="169">169-Suneer</option><option value="170">170-Sindhi</option><option value="171">171-KhasKelli</option><option value="172">172-Durzada</option><option value="173">173-Toori Bangash</option><option value="174">174-Farooqi</option><option value="175">175-Qutteawal</option><option value="176">176-syed hashmi</option><option value="177">177-Pitafi </option><option value="178">178-Lund</option><option value="179">179-Rind</option><option value="181">181-Samat</option><option value="182">182-Lasahri</option><option value="183">183-Dasti</option><option value="184">184-Naich</option><option value="185">185-Sethi</option><option value="186">186-Syed Qazi</option><option value="187">187-Dayo</option><option value="188">188-Kalwar</option><option value="189">189-Golo</option><option value="190">190-khyber</option><option value="191">191-Chandio</option><option value="192">192-Khalhi</option><option value="193">193-Uthman khel</option><option value="194">194-Dahri</option><option value="195">195-Mirza</option><option value="196">196-Halim zai</option><option value="197">197-Mithani</option><option value="198">198-Khashkelly </option><option value="199">199-Achakzai</option><option value="200">200-Bugho</option><option value="201">201-barohi</option><option value="202">202-peshaweri</option><option value="203">203-merwat</option><option value="204">204-Solangi</option><option value="205">205-Khalil Mohmand</option><option value="206">206-Mohammadzai</option><option value="207">207-Bittani</option><option value="208">208-Maleezai</option><option value="210">210-Nawab Khel</option><option value="211">211-Daudzai</option><option value="212">212-Ahmad Zai</option><option value="213">213-Orakzai</option><option value="214">214-Sadaat</option><option value="215">215-Khaikhwankhail</option><option value="216">216-Waraich</option><option value="217">217-Gigyani</option><option value="219">219-Taran</option><option value="220">220-Kaka khel</option><option value="221">221-Batakzai</option><option value="222">222-Tahi Khel</option><option value="223">223-Batoor Khel</option><option value="224">224-Banochi</option><option value="225">225-Banusi</option><option value="226">226-Sahi</option><option value="227">227-Singhar</option><option value="228">228-Kundi</option><option value="229">229-Quraish</option><option value="230">230-Bajaj</option><option value="231">231-Gandapur</option><option value="232">232-Parachgan</option><option value="233">233-Dagwal</option><option value="234">234-Kakar</option><option value="235">235-Sahibzadgan</option><option value="236">236-Sayyed</option><option value="237">237-Akka Khel</option><option value="238">238-Mast Khel</option><option value="239">239-Sultan Khel</option><option value="240">240-Tarkalani</option><option value="241">241-Gorsain</option><option value="242">242-Sardar khel</option><option value="243">243-Umarzai</option><option value="244">244-Kamal Khel</option><option value="245">245-Miagan</option><option value="246">246-Lohar</option><option value="247">247-Sabz Khel</option><option value="248">248-Peeran</option><option value="249">249-Sarwan</option><option value="250">250-Taizai</option><option value="251">251-Uthmanzai</option><option value="252">252-Mahajir</option><option value="253">253-Hashnaghri</option><option value="254">254-Mohajar</option><option value="255">255-Uttra</option><option value="256">256-Hargan</option><option value="257">257-Siyal</option><option value="258">258-Kanera</option><option value="259">259-Sipra</option><option value="260">260-Chinwar</option><option value="261">261-Malana</option><option value="262">262-Sakhani Baloch</option><option value="263">263-Issar</option><option value="264">264-Machi</option><option value="265">265-Jara</option><option value="266">266-Kati Khail</option><option value="267">267-Babu Khel</option><option value="268">268-Saggu</option><option value="269">269-Mehsud</option><option value="270">270-Gandroya</option><option value="271">271-Azam khel</option><option value="272">272-Bhittani</option><option value="273">273-Burki</option><option value="274">274-Dawar</option><option value="275">275-Tarakzai</option><option value="276">276-Mula khel</option><option value="277">277-Syed khel</option><option value="278">278-Satti</option><option value="279">279-Bajouri</option><option value="280">280-Saafi</option><option value="281">281-Sumalani</option><option value="282">282-Lehri</option><option value="283">283-Kasi</option><option value="284">284-Miani</option><option value="285">285-Marri</option><option value="286">286-Harrifal</option><option value="287">287-Nasar</option><option value="288">288-Langov</option><option value="289">289-Sasoli</option><option value="290">290-Mengal</option><option value="291">291-Bughti</option><option value="292">292-Mandokhail</option><option value="293">293-Pirkani</option><option value="294">294-Barech</option><option value="295">295-Tareen</option><option value="296">296-Bhanger</option><option value="297">297-Pechuha</option><option value="298">298-Khajak</option><option value="299">299-Khilji</option><option value="300">300-Bangulzai</option><option value="301">301-Ayuobi</option><option value="302">302-Badini</option><option value="303">303-Muhammad Hassni</option><option value="304">304-Samulani</option><option value="305">305-Khorasani</option><option value="306">306-Zehri</option><option value="307">307-Domar</option><option value="308">308-Batani</option><option value="309">309-Noorzai</option><option value="310">310-kakezai</option><option value="311">311-Rakhshani</option><option value="312">312-Muhammad Shai</option><option value="313">313-Batti</option><option value="314">314-Luni</option><option value="315">315-Pechwa</option><option value="316">316-Umrani</option><option value="317">317-Mastio</option><option value="318">318-Chukhra</option><option value="319">319-Behrani</option><option value="320">320-Chalgari</option><option value="321">321-Mostoi</option><option value="322">322-Ghunia</option><option value="323">323-Katbar</option><option value="324">324-Babar</option><option value="325">325-Khostai</option><option value="326">326-Satakzai</option><option value="327">327-Thari wall</option><option value="328">328-Adi Zai</option><option value="329">329-Koki Khel</option><option value="330">330-Oba Khel</option><option value="331">331-Wora Bacha Khel</option><option value="332">332-Bacha Khel</option><option value="333">333-Sarmat Khel</option><option value="334">334-Ostaryani</option><option value="335">335-Khewzai Mohman</option><option value="336">336-Rabia Khel</option><option value="337">337-Ali Sherzai</option><option value="338">338-Tori</option><option value="339">339-Yar gul Khel</option><option value="340">340-Mulaghori</option><option value="341">341-Loyi Shalman</option><option value="342">342-Qalaqai Khewzai</option><option value="343">343-Halmzai</option><option value="344">344-Khewzai Khalodaq</option><option value="345">345-Burhan Khel</option><option value="346">346-Shinwari Safi</option><option value="347">347-Gurbaz safi</option><option value="348">348-Ala Khel</option><option value="349">349-Tor Khel</option><option value="350">350-Sadat Khel</option><option value="351">351-Sarkani Khel</option><option value="352">352-Tarkani</option><option value="353">353-Prachamkani</option><option value="354">354-Ghalji</option><option value="355">355-Musaki</option><option value="356">356-Sher Khel</option><option value="357">357-Miami Kabal Khel</option><option value="358">358-Dottani</option><option value="359">359-Malak Khan</option><option value="360">360-Malak din khel</option><option value="361">361-Kamar Khel</option><option value="362">362-Sandokhel</option><option value="363">363-Darwazgai</option><option value="364">364-Tokhti Khel</option><option value="365">365-Karmat Khel</option><option value="366">366-Otizai</option><option value="367">367-Ganda Pur</option><option value="368">368-Hindo</option><option value="369">369-Not Available</option><option value="370">370-Mian Khel</option><option value="371">371-Ghani Khel</option><option value="372">372-Dogar</option><option value="373">373-Saidgi</option><option value="375">374-Lghari</option><option value="376">375-Malghani</option><option value="377">376-Qaisrani</option><option value="378">377-Hashmi Makhdom</option><option value="379">378-Babbar</option><option value="380">379-Punjabi</option><option value="381">380-Pathan</option><option value="382">381-Khangor Mian</option><option value="383">382-Sewera</option><option value="384">383-Khitran</option><option value="385">384-Sikhani</option><option value="386">385-Langrana</option><option value="387">386-Khalung</option><option value="388">387-Orangzai</option><option value="389">388-Wazeer</option><option value="390">389-Rehmani</option><option value="391">390-Kutt</option><option value="392">391-Chohan</option><option value="393">392-Ronga</option><option value="394">393-Christian</option><option value="395">394-ghori</option><option value="396">395-Dado Khel</option><option value="397">396-Kakayzai</option><option value="398">397-Jaitoi</option><option value="399">398-Qasisrani</option><option value="400">399-Musa Khel</option><option value="401">400-Langha</option><option value="402">401-Lakhani</option><option value="403">402-Ahmadani</option><option value="404">403-Dhandla</option><option value="405">404-Dashti</option><option value="406">405-Mohana</option><option value="407">406-Sangi</option><option value="408">407-Achakzai</option><option value="409">408-Hazara</option><option value="410">409-Afghani</option><option value="411">410-Bajwa</option><option value="412">411-Bakarzai(Syed Tribe)</option><option value="413">412-Alkozai</option><option value="414">413-Ishaqzai</option><option value="415">414-Jatak</option><option value="416">415-Kharooti</option><option value="417">416-Meerani</option><option value="418">417-Saagzai</option><option value="419">418-Sherani</option><option value="420">419-Suleman Khel</option><option value="421">420-Tarakai</option><option value="422">421-Wardag</option><option value="430">-99-Info not available </option><option value="432">422-Watak</option><option value="433">423-Ghakkar</option><option value="434">424-Kiyani</option><option value="435">425-Yashkin</option><option value="436">426-Virk</option><option value="438">427-Shahwani</option><option value="439">428-Mishwani </option><option value="440">429-sulemani</option><option value="441">430-Khurasani</option><option value="442">431-Dehwar</option><option value="443">432-Azasani</option><option value="444">433-Raisani</option><option value="445">434-Kurd</option><option value="446">435-Kolojat</option><option value="447">436-Qambrani</option><option value="448">437-M.Shahi</option><option value="449">440-Ababaki</option><option value="450">441-zinran pashto</option><option value="451">442-Adrakzai</option><option value="452">443-Zarkon</option><option value="453">444-Ali zai</option><option value="454">445-Yar Muhammadzai</option><option value="455">446-Arozai</option><option value="456">447-urduzai</option><option value="457">448-Tamarzai</option><option value="458">449-Awan zai</option><option value="459">450-Tajak</option><option value="460">451-Badezai</option><option value="461">452-surkhani</option><option value="462">453-Baloch umarani</option><option value="463">454-sumrani</option><option value="464">455-Barozai</option><option value="465">456-saypad</option><option value="466">457-Bazai</option><option value="467">458-Sarpara</option><option value="468">459-Bilalzai ashezai</option><option value="469">460-sarangzai</option><option value="470">461-biyanzai</option><option value="471">462-Bulaida</option><option value="472">463-Santra</option><option value="473">464-Buzdar</option><option value="474">465-Salmanzai</option><option value="475">466-Cheema</option><option value="476">467-Dar</option><option value="477">468-Rodani</option><option value="478">470-Reki</option><option value="479">471-Rehmatzai</option><option value="480">469-Denarzai</option><option value="481">472-Rahes</option><option value="482">473-Qalandarani</option><option value="483">474-Farsi</option><option value="484">475-Pnazai</option><option value="485">476-Garmani</option><option value="486">477-Gashkori</option><option value="487">478-Pandrani</option><option value="488">479-Ghabzai</option><option value="489">480-Ghazi Khail</option><option value="490">481-Uzbeq</option><option value="491">482-Ghramzai</option><option value="492">483-noorani baloch</option><option value="493">484-Gill</option><option value="494">485-Nosherwani</option><option value="495">486-Nichari</option><option value="496">487-Gull</option><option value="497">488-Gull Mani</option><option value="498">489-Nazarzai</option><option value="499">490-Hamedzai</option><option value="500">491-Naai</option><option value="501">492-Hindko</option><option value="502">493-Miralizai</option><option value="503">494-jagro</option><option value="504">495-Metarzai</option><option value="505">496-Jamot</option><option value="506">497-Kabul</option><option value="507">498-Mankazai</option><option value="508">499-Kamrani</option><option value="509">500-Mahterzai</option><option value="510">501-Mahal</option><option value="511">502-kerahi</option><option value="512">503-Madkhanzai</option><option value="513">504-Khosa</option><option value="514">505-Kujazai</option><option value="515">506-Kujakhel</option><option value="516">507-Boda Khel</option><option value="517">508-Chitrali</option><option value="518">509-Kada khel</option><option value="519">510-Koi Khel</option><option value="520">511-Sebadin Khel</option><option value="521">512-Utizai</option><option value="522">513-Adam Khel</option><option value="523">514-Akhoonzada</option><option value="524">515-Baghwanan</option><option value="525">516-Barki</option><option value="526">517-Sadozai</option><option value="527">518-Samezai</option><option value="528">519-Sanzerkhail</option><option value="529">520-Babai</option><option value="530">521-Baltistani</option><option value="531">522-Chamdir </option><option value="532">523-Derawal</option><option value="533">524-Durakzai</option><option value="534">525-Elaka</option><option value="535">526-Ghosti</option><option value="536">527-Harai</option><option value="537">528-Hassani</option><option value="538">529-Jamaldini</option><option value="539">530-Jogezai</option><option value="540">531-Juiya</option><option value="541">532-Karlal</option><option value="542">533-Kulachi</option><option value="543">534-Kumar</option><option value="544">535-mamshai</option><option value="545">536-Marghzani</option><option value="546">537-Meer</option><option value="547">538-Merwani</option><option value="548">539-Metezai</option><option value="549">540-Mullazai</option><option value="550">541-Mutkani</option><option value="551">542-Raghi</option><option value="552">543-Zandran</option><option value="553">544-Narooi</option><option value="554">545-Teli</option><option value="555">546-Thaheem</option>                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Ethincity:<span></span>
                                            </label>
                                            <div class="col-md-6">                                              
                                                <select name="ethnicity" id="ethnicity" class="form-control fcn select2me input-large select2-offscreen" tabindex="-1">
                                                    <option value="">Select Ethnicity</option>
                                                    <option value="1">Baloch</option>
                                                    <option value="2">Pashtuns</option>
                                                    <option value="3">Punjabis</option>
                                                    <option value="4">Sindhis</option>
                                                    <option value="5">Muhajirs</option>
                                                    <option value="6">Kashmiris</option>
                                                    <option value="7">Saraikis</option>
                                                    <option value="8">HAZARA</option>
                                                    <option value="9">Info  not available</option>
                                                    <option value="11">Hindko</option>                                                
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Language :<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">                                                
                                                <select name="language" id="language" class="form-control fcn select2me input-large select2-offscreen" tabindex="-1">
                                                    <option value="">Select Language</option>
                                                    <option value="1">Punjabi</option>
                                                    <option value="2">Pashto</option>
                                                    <option value="3">Hindko</option>
                                                    <option value="4">Saraiki</option>
                                                    <option value="5">Potohari</option>
                                                    <option value="6">Urdu</option>
                                                    <option value="7">Sindhi</option>
                                                    <option value="8">Shina</option>
                                                    <option value="9">Kashmiri</option>
                                                    <option value="10">Balochi</option>
                                                    <option value="11">Gujrati</option>
                                                    <option value="12">Brushaski</option>
                                                    <option value="13">Brohi</option>
                                                    <option value="14">Persian</option>
                                                    <option value="15">Ranghar</option>
                                                    <option value="16">English</option>
                                                    <option value="17">Chitrali</option>
                                                    <option value="19">Astori</option>
                                                    <option value="30">Not Available</option>
                                                    <option value="31">Tajki</option>
                                                    <option value="32">Uzbaki</option>                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Other Languages:
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="other_languages" name="other_languages" class="form-control fcn" placeholder="Other Language" value="Urdu">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Nationality :<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="nationality" name="nationality" class="form-control fcn" placeholder="Nationality" value="Pakistani">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Religion:
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="religion" name="religion" class="form-control fcn" placeholder="religion" value="Islam">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                CTC Mobile # :<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="contact_number" name="contact_number" class="form-control fcn mask_number13" placeholder="Mobile Number" value="">
                                                <div class="help-block">
                                                    Mobile No format. i.e. 03122213163
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Personal Contact:
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="personal_contact" name="personal_contact" class="form-control fcn" placeholder="Phone Number" value="0310-9873197">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Other Contact:
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="contact_other" name="contact_other" class="form-control fcn" placeholder="Phone Number" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Blood Group:
                                            </label>
                                            <div class="col-md-6">
                                                <select id="bloodgroup" name="bloodgroup" class="form-control fcn">
                                                    <option value="">Blood Group</option>
                                                    <option value="1">A+</option>
                                                    <option value="2">A-</option>
                                                    <option value="3">B+</option>
                                                    <option value="4">B-</option>
                                                    <option value="5">O+</option>
                                                    <option value="6">O-</option>
                                                    <option value="7">AB+</option>
                                                    <option value="8">AB-</option>                                               
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Email (If any):
                                            </label>
                                            <div class="col-md-6">
                                                <input type="email" name="email_address" class="form-control fcn" placeholder="Email Address" value="<?php echo $candidate->email;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Contract Expiry Date:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="contract_expiry_date" name="contract_expiry_date" class="form-control fcn date-picker" placeholder="CNIC Expiry Date" format="dd-MM-yyyy" disabled="" value="01-Jan-1970">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>












                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title ">Employee's Residential Location Details</h3>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-6 lcn">Province:<span class="required">*</span></label>
                                            <div class="col-md-6">
                                                <select name="resident_province" id="resident_province" class="form-control fcn">
                                                    <option value="">Select Province of Resident</option>
                                                    <option value="9">Not Applicable</option>
                                                    <option value="1">Punjab</option>
                                                    <option value="2">Sindh</option>
                                                    <option value="3">KPK</option>
                                                    <option value="4">Balochistan</option>
                                                    <option value="5">AJK</option>
                                                    <option value="6">GB</option>
                                                    <option value="7">Islamabad</option>
                                                    <option value="8">KP-TD</option>                                               
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="district_section">
                                            <label for="s2id_autogen5" class="col-md-6 control-label lcn">District:<span class="required">*</span></label>
                                            <div class="col-md-6">
                                              <select name="resident_district" id="resident_district" class="form-control fcn select2me input-large select2-offscreen" tabindex="-1">
                                                    <option value="">Select District of Resident</option>
                                                    <option value="37">ABBOTTABAD</option>
                                                    <option value="38">BATAGRAM</option>
                                                    <option value="39">HARIPUR</option>
                                                    <option value="40">KOHISTAN</option>
                                                    <option value="41">MANSEHRA</option>
                                                    <option value="42">TORGHAR</option>
                                                    <option value="43">MALAKAND</option>
                                                    <option value="44">CHITRAL</option>
                                                    <option value="45">BUNER</option>
                                                    <option value="46">DIRLOWER</option>
                                                    <option value="47">SWAT</option>
                                                    <option value="48">DIRUPPER</option>
                                                    <option value="49">SHANGLA</option>
                                                    <option value="50">PESHAWAR</option>
                                                    <option value="51">CHARSADA</option>
                                                    <option value="52">NOWSHERA</option>
                                                    <option value="53">MARDAN</option>
                                                    <option value="54">SWABI</option>
                                                    <option value="55">KOHAT</option>
                                                    <option value="56">KARAK</option>
                                                    <option value="57">HANGU</option>
                                                    <option value="58">DIKHAN</option>
                                                    <option value="59">TANK</option>
                                                    <option value="60">BANNU</option>
                                                    <option value="61">LAKKIMRWT</option>                                                    <!-- option will populated from ajax call -->
                                              </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="resident_tehsil_section">
                                            <label for="s2id_autogen6" class="col-md-6 control-label lcn">Tehsil:<span class="required">*</span></label>
                                            <div class="col-md-6">
                                                <select name="resident_tehsil" id="resident_tehsil" class="form-control fcn select2me select2-offscreen" tabindex="-1">
                                                    <option value="">Select Tehsil of Resident</option>
                                                    <option value="189">PESHAWAR</option>
                                                    <option value="344">Peshawar Town 1</option>
                                                    <option value="345">Peshawar Town 2</option>
                                                    <option value="346">Peshawar Town 3</option>
                                                    <option value="347">Peshawar Town 4</option>
                                                    <option value="357">U-S.D Hassan Khel</option>                                                    <!-- option will populated from ajax call -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="resident_uc_section">
                                            <label for="uc_id" class="col-md-6 control-label lcn">UC/Area:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="resident_uc" id="resident_uc" class="form-control fcn select2me select2-offscreen" tabindex="-1">
                                                    <option value="">Select UC of Resident</option>
                                                    <option value="4283">ACHINI</option>
                                                    <option value="4291">BAZID KHEL</option>
                                                    <option value="4297">DEH BAHADAR</option>
                                                    <option value="4298">DERI BAGHBANAN</option>
                                                    <option value="4307">HAYAT ABAD 1</option>
                                                    <option value="4308">HAYAT ABAD 2</option>
                                                    <option value="4324">LANDI ARBAB</option>
                                                    <option value="4326">MALAKANDHER</option>
                                                    <option value="4337">NOTHIA JADEED</option>
                                                    <option value="4338">NOTHIA QADEEM</option>
                                                    <option value="4341">PALOSI</option>
                                                    <option value="4343">PAWAKA</option>
                                                    <option value="4344">PISHTAKHARA</option>
                                                    <option value="4345">REGI</option>
                                                    <option value="4347">SARBAND</option>
                                                    <option value="4350">SHAHEEN TOWN</option>
                                                    <option value="4358">SUFAID DHERI</option>
                                                    <option value="4362">TEHKAL BALA</option>
                                                    <option value="4363">TEHKAL PAYAN</option>
                                                    <option value="4364">TEHKAL PAYAN 2 IRRIG</option>
                                                    <option value="4366">UNIVERSITY TOWN</option>
                                                    <option value="4375">Cantt Ward - 1</option>
                                                    <option value="4376">Cantt Ward - 2</option>
                                                    <option value="4377">Cantt Ward - 3</option>
                                                    <option value="4378">Cantt Ward - 4</option>
                                                    <option value="4379">Cantt Ward - 5</option>
                                                    <option value="6225">Transit Points</option>                                                    <!-- option will populated from ajax call -->
                                                </select>
                                                <div class="help-block">
                                                    Note: In FATA UC is called Area
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Residential Address:
                                            </label>
                                            <div class="col-md-6">
                                                    <textarea id="resident_address_details" name="resident_address_details" rows="4" cols="30" class="form-control" placeholder="Address Details" value="">Gulababad, Luwar Lakhti, Sufaid Dheri</textarea>
                                                <div class="help-block">
                                                    Complete Residential Address of Applicant (Mohalla/Village/Street/City etc)
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>



                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title ">Employee's Permanent Location Details</h3>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="control-label col-md-10">
                                                Does Applicant's permanent address different,above Residentail Details ?
                                                <div class="help-block">
                                                    If yes then please fill below details
                                                </div>
                                            </label>
                                            <div class="col-md-2">
                                                <select id="permanent_yesno" name="permanent_yesno" class="form-control fcn select2-arrow input-medium">
                                                    <option value="">Select</option>
                                                    <option value="1">1-Yes</option>
                                                    <option value="2" selected="selected">2-No</option>                                                
                                                  </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="permanent_province_section">
                                            <label class="control-label col-md-6 lcn">Permanent Province:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="permanent_province" id="permanent_province" class="form-control fcn select2me input-medium select2-offscreen" tabindex="-1">
                                                    <option value="">Select Permanent Province</option>
                                                    <option value="9">Not Applicable</option>
                                                    <option value="1">Punjab</option>
                                                    <option value="2">Sindh</option>
                                                    <option value="3">KPK</option>
                                                    <option value="4">Balochistan</option>
                                                    <option value="5">AJK</option>
                                                    <option value="6">GB</option>
                                                    <option value="7">Islamabad</option>
                                                    <option value="8">KP-TD</option>                                                
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="permanent_district_section">
                                            <label for="district_id" class="col-md-6 control-label lcn"> Permanent District:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="permanent_district" id="permanent_district" class="form-control fcn select2me input-medium select2-offscreen" tabindex="-1">
                                                    <option value="">Select Permanent District</option>
                                                    <option value="37">ABBOTTABAD</option>
                                                    <option value="38">BATAGRAM</option>
                                                    <option value="39">HARIPUR</option>
                                                    <option value="40">KOHISTAN</option>
                                                    <option value="41">MANSEHRA</option>
                                                    <option value="42">TORGHAR</option>
                                                    <option value="43">MALAKAND</option>
                                                    <option value="44">CHITRAL</option>
                                                    <option value="45">BUNER</option>
                                                    <option value="46">DIRLOWER</option>
                                                    <option value="47">SWAT</option>
                                                    <option value="48">DIRUPPER</option>
                                                    <option value="49">SHANGLA</option>
                                                    <option value="50">PESHAWAR</option>
                                                    <option value="51">CHARSADA</option>
                                                    <option value="52">NOWSHERA</option>
                                                    <option value="53">MARDAN</option>
                                                    <option value="54">SWABI</option>
                                                    <option value="55">KOHAT</option>
                                                    <option value="56">KARAK</option>
                                                    <option value="57">HANGU</option>
                                                    <option value="58">DIKHAN</option>
                                                    <option value="59">TANK</option>
                                                    <option value="60">BANNU</option>
                                                    <option value="61">LAKKIMRWT</option>  
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="permanent_tehsil_section">
                                            <label for="tehsil_id" class="col-md-6 control-label lcn"> Permanent Tehsil:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                              <select name="permanent_tehsil" id="permanent_tehsil" class="form-control fcn select2me input-medium select2-offscreen" tabindex="-1">
                                                    <option value="">Select Permanent Tehsil</option>
                                                    <option value="344">Peshawar Town 1</option>
                                                    <option value="345">Peshawar Town 2</option>
                                                    <option value="346">Peshawar Town 3</option>
                                                    <option value="347">Peshawar Town 4</option>
                                                    <option value="357">U-S.D Hassan Khel</option> 
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="permanent_uc_section">
                                            <label for="uc_id" class="col-md-6 control-label lcn"> Permanent UC/Area:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                              <select name="permanent_uc" id="permanent_uc" class="form-control fcn select2me input-medium select2-offscreen" tabindex="-1">
                                                    <option value="">Select Permanent UC</option>
                                                    <option value="4283">ACHINI</option>
                                                    <option value="4291">BAZID KHEL</option>
                                                    <option value="4297">DEH BAHADAR</option>
                                                    <option value="4298">DERI BAGHBANAN</option>
                                                    <option value="4307">HAYAT ABAD 1</option>
                                                    <option value="4308">HAYAT ABAD 2</option>
                                                    <option value="4324">LANDI ARBAB</option>
                                                    <option value="4326">MALAKANDHER</option>
                                                    <option value="4337">NOTHIA JADEED</option>
                                                    <option value="4338">NOTHIA QADEEM</option>
                                                    <option value="4341">PALOSI</option>
                                                    <option value="4343">PAWAKA</option>
                                                    <option value="4344">PISHTAKHARA</option>
                                                    <option value="4345">REGI</option>
                                                    <option value="4347">SARBAND</option>
                                                    <option value="4350">SHAHEEN TOWN</option>
                                                    <option value="4358">SUFAID DHERI</option>
                                                    <option value="4362">TEHKAL BALA</option>
                                                    <option value="4363">TEHKAL PAYAN</option>
                                                    <option value="4364">TEHKAL PAYAN 2 IRRIG</option>
                                                    <option value="4366">UNIVERSITY TOWN</option>
                                                    <option value="4375">Cantt Ward - 1</option>
                                                    <option value="4376">Cantt Ward - 2</option>
                                                    <option value="4377">Cantt Ward - 3</option>
                                                    <option value="4378">Cantt Ward - 4</option>
                                                    <option value="4379">Cantt Ward - 5</option>
                                                    <option value="6225">Transit Points</option>  
                                
                                                </select>
                                                <div class="help-block">
                                                    Note: In FATA UC is called Area
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>

          <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="control-label col-md-6 lcn">
                          Permanent Address:
                      </label>
                      <div class="col-md-6">
                              <textarea id="permanent_address_details" name="permanent_address_details" rows="4" cols="30" class="form-control" placeholder="Address Details" value=""></textarea>
                          <div class="help-block">
                              Complete Permanent Address of Applicant (Mohalla/Village/Street/City etc)
                          </div>
                      </div>

                  </div>
              </div>
          </div>
          <br>
                              <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-6 lcn">
                                                Is the Employee local?
                                                <div class="help-block">
                                                    Analyze resume info and fill this field
                                                </div>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="local_id" id="local_id" class="form-control fcn input-medium select" readonly="readonly">
                                                    <option value="">Select...</option>
                                                    <option value="1">Local</option>
                                                    <option value="2">Non-Local</option>
                                                    <option value="3">Cant be determined</option>
                                                    <option value="4">Adjacent/Catchment Area</option>
                                                    <option value="5">Catchment Area</option>                                                
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-6">
                                                Verify the Employee is local?
                                                
                                            </label>
                                            <div class="col-md-6">
                                                <select name="verify_local_id" id="verify_local_id" class="form-control fcn input-medium select">
                                                    <option value="">Select...</option>
                                                    <option value="1">Local</option>
                                                    <option value="2">Non-Local</option>
                                                    <option value="3">Cant be determined</option>
                                                    <option value="4">Adjacent/Catchment Area</option>
                                                    <option value="5">Catchment Area</option>                                                
                                                  </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>













                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title ">Applied For Location/Area Details</h3>
                                    </div>
                                </div>
                                <div class="row" hidden="">
                                    <div class="col-md-6">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-6 lcn">
                                                Province:
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" value="<?php echo  $prov->name; ?>" class="form-control fcn" readonly="">
                                            </div>

                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="region_id" class="col-md-6 control-label">Division</label>
                                            <div class="col-md-6">
                                                <input type="text" id="region_name_info" name="region_name_info" value="" class="form-control fcn" readonly="">
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <br>

                                <div class="row" hidden="">
                                    <div class="col-md-6">
                                        <div class="form-group" id="province_section">
                                            <label for="district_id" class="col-md-6 control-label">
                                                City:
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" value="<?php echo  $citi->name; ?>" class="form-control fcn" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="tehsil_section">
                                            <label for="tehsil_id" class="col-md-6 control-label">
                                                Tehsil:
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" value="" class="form-control fcn" readonly="">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>

                                <div class="row" hidden="">
                                    <div class="col-md-6">
                                        <div class="form-group" id="uc_section">
                                            <label for="uc_id" class="col-md-4 control-label">
                                                UC/Area:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" value="" class="form-control fcn" readonly="">
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <br>

                                <div class="row" hidden="">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Other Details of Applied for (if any):
                                            </label>
                                            <div class="col-md-6">
                                                    <textarea rows="4" cols="30" class="form-control" placeholder="Applied for Location Details" value=""></textarea>
                                                <div class="help-block">
                                                    If there is any other information about applied for area of this applicant
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                               <!--  //////// Only for read job details //////////// -->
 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label lcn">
                                                Province:
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control fcn select2me select2-offscreen" tabindex="-1">
                                                    <option>Select Province</option>
                                                    <option value="9">Not Applicable</option>
                                                    <option value="1">Punjab</option>
                                                    <option value="2">Sindh</option>
                                                    <option value="3">KPK</option>
                                                    <option value="4">Balochistan</option>
                                                    <option value="5">AJK</option>
                                                    <option value="6">GB</option>
                                                    <option value="7">Islamabad</option>
                                                    <option value="8">KP-TD</option>                                                   

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="district_id" class="col-md-6 control-label lcn">
                                                 District:
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control fcn select2me select2-offscreen" tabindex="-1">
                                                    <option value="50" selected="selected">330-PESHAWAR</option>
                                                    <option value="51">331-CHARSADA</option>
                                                    <option value="52">332-NOWSHERA</option>                                                    
                                                    <!-- option will populated from ajax call -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                 Tehsil:
                                            </label>
                                            <div class="col-md-6">
                                                <select class="form-control fcn select2me disabled select2-offscreen" tabindex="-1">
                                                    <option value="189">33002-PESHAWAR</option>
                                                    <option value="344">33002-1-Peshawar Town 1</option>
                                                    <option value="345">33002-2-Peshawar Town 2</option>
                                                    <option value="346" selected="selected">33002-3-Peshawar Town 3</option>
                                                    <option value="347">33002-4-Peshawar Town 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                 UC:
                                            </label>
                                            <div class="col-md-6">
                                                <select id="job_uc_id" class="form-control fcn select2me disabled select2-offscreen" tabindex="-1">
                                                    <option value="4283">33002001-ACHINI</option>
                                                    <option value="4291">33002009-BAZID KHEL</option>
                                                    <option value="4297">33002015-DEH BAHADAR</option>
                                                    <option value="4298">33002016-DERI BAGHBANAN</option>
                                                    <option value="4307">33002025-HAYAT ABAD 1</option>
                                                    <option value="4308">33002026-HAYAT ABAD 2</option>
                                                    <option value="4324">33002042-LANDI ARBAB</option>
                                                    <option value="4326">33002044-MALAKANDHER</option>
                                                    <option value="4337">33002055-NOTHIA JADEED</option>
                                                    <option value="4338">33002056-NOTHIA QADEEM</option>
                                                    <option value="4341">33002059-PALOSI</option>
                                                    <option value="4343">33002061-PAWAKA</option>
                                                    <option value="4344">33002063-PISHTAKHARA</option>
                                                    <option value="4345">33002064-REGI</option>
                                                    <option value="4347">33002066-SARBAND</option>
                                                    <option value="4350">33002069-SHAHEEN TOWN</option>
                                                    <option value="4358">33002077-SUFAID DHERI</option>
                                                    <option value="4362">33002081-TEHKAL BALA</option>
                                                    <option value="4363">33002082-TEHKAL PAYAN</option>
                                                    <option value="4364">33002083-TEHKAL PAYAN 2 IRRIG</option>
                                                    <option value="4366">33002085-UNIVERSITY TOWN</option>
                                                    <option value="4375">33002094-Cantt Ward - 1</option>
                                                    <option value="4376">33002095-Cantt Ward - 2</option>
                                                    <option value="4377">33002096-Cantt Ward - 3</option>
                                                    <option value="4378">33002097-Cantt Ward - 4</option>
                                                    <option value="4379">33002098-Cantt Ward - 5</option>
                                                    <option value="6225">33002099-Transit Points</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                 Area:
                                            </label>
                                            <div class="col-md-6">
                                                <select id="job_area_id" class="form-control fcn select2me disabled select2-offscreen" tabindex="-1">
                                                    <option value="391">33002077-1-SUFAID DHERI 1</option>
                                                    <option value="392">33002077-2-SUFAID DHER  2</option>
                                                    <option value="393">33002077-3-SUFAID DHERI  3</option>
                                                    <option value="394">33002077-4-NOUDEA BALA</option>
                                                    <option value="395">33002077-5-ACADMY TOEN</option>
                                                    <option value="396">33002077-6-MUZAFARABAAD</option>
                                                    <option value="397">33002077-7-TAJABAAD 1</option>
                                                    <option value="398">33002077-8-TAJABAAD 2</option>
                                                    <option value="399">33002077-9-TAJABAAD 3</option>
                                                    <option value="400">33002077-10-TAJABAAD 4</option>
                                                    <option value="401">33002077-11-ACHINI PAYAN</option>
                                                    <option value="2449">33002077-12-NOUDEA PAYAN </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Unique Job Area Code<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="job_area_identification_code" class="form-control fcn" placeholder="Area Code" value="97A">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Unique New Job Area Code<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="jpic" class="form-control fcn" placeholder="New Area Code" value="97A">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Other Details of Applied for (if any):
                                            </label>
                                            <div class="col-md-6">
                                                    <textarea id="applied_for_location_details" name="applied_for_location_details" rows="4" cols="30" class="form-control" placeholder="Applied for Location Details"></textarea>
                                                <div class="help-block">
                                                    If there is any other information about applied for area of this applicant
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-2 lcn">
                                                Job Title:
                                            </label>
                                            <div class="col-md-6">
                                                <select name="job_job_position_id" id="job_job_position_id" class="form-control fcn select2me select2-offscreen" tabindex="-1">
                                                    <option value="1551" selected="selected"><?php echo $jobTitle; ?></option>
                                                </select>
                                                    <div class="help-block">
                                                        <p style="color: red">You can not edit Job Location because this employee comes from Recruitment</p>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>







          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title ">Educational Details</h3>
              </div>
          </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-6 lcn">
                                                Last Qualification Name<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" id="last_qualification_name" name="last_qualification_name" class="form-control fcn" placeholder="Last Qualification Name" value="<?php echo  $ed->name; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-6 lcn">
                                                Qualification:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                              <select name="qualification_id" id="qualification_id" class="form-control fcn select2me select2-offscreen" tabindex="-1">
                                                    <option value="">Select qualification</option>
                                                    <option value="1">1-Master</option>
                                                    <option value="2">2-Graduate</option>
                                                    <option value="3">3-Intermediate</option>
                                                    <option value="4">4-Matric</option>
                                                    <option value="5">5-Middle</option>
                                                    <option value="6">6-Literate</option>
                                                    <option value="7">7-Illiterate</option>
                                                    <option value="8">8-Diploma</option>
                                                    <option value="9">9-ALem (Islamic Taleem)</option>
                                                    <option value="10">10-MPhil/MS</option>
                                                    <option value="11">11-BS (4Years)</option>
                                                    <option value="12">12-Madrassa Educated</option>
                                                    <option value="13">13-DVM</option>
                                                    <option value="14">14-DAE</option>
                                                    <option value="15">-99-Info Not Available</option>
                                                    <option value="16">15-PHD</option>                                                
                                              </select>
                                                <div class="help-block">
                                                    Please select highest qualification
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="province_section">
                                            <label for="district_id" class="col-md-6 control-label lcn">
                                                Discipline:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <select name="discipline_id" id="discipline_id" class="form-control fcn select2me input-large select2-offscreen" tabindex="-1">
                                                    <option value="">Select qualification</option>
                                                    <option value="1">1-Social Sciences</option>
                                                    <option value="2">2-Communication</option>
                                                    <option value="3">3-Business Administration</option>
                                                    <option value="4">4-Science </option>
                                                    <option value="5" selected="selected">5-Arts</option>
                                                    <option value="6">6-Computer Sciences </option>
                                                    <option value="7">7-Civil Engineering </option>
                                                    <option value="8">8-Electrical Engineering </option>
                                                    <option value="9">9-English</option>
                                                    <option value="10">10-Education</option>
                                                    <option value="11">11-Commerce </option>
                                                    <option value="12">12-Mechanical Engineering </option>
                                                    <option value="13">13-Chemistry</option>
                                                    <option value="14">14-Biology</option>
                                                    <option value="15">15-Mathematics </option>
                                                    <option value="16">16-Statistics</option>
                                                    <option value="17">17-Accountancy</option>
                                                    <option value="18">-99-Info not available</option>
                                                    <option value="19">18-Madrassa Education/Quarnic Education</option>
                                                    <option value="20">19-veterinary degree</option>
                                                    <option value="21">20-Health education</option>
                                                    <option value="22">21-Engineering</option><option value="23">22-LAW</option><option value="24">23-Public Administration</option><option value="25">24-Islamiat</option><option value="26">25-Urdu</option><option value="27">26-Political Science</option><option value="28">27-Economics</option><option value="29">28-Primary</option><option value="30">29-Nursing</option><option value="31">30-LHV</option><option value="32">31-Pharmacy</option>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title ">Total Experience</h3>
              </div>
          </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Polio Experience Year:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="total_polio_experience_year" name="total_polio_experience_year" value="2" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Polio Experience Month:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="total_polio_experience_month" name="total_polio_experience_month" value="0" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Polio Experience Day:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="total_polio_experience_day" name="total_polio_experience_day" value="0" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Other Experience Year:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="other_experience_year" name="other_experience_year" value="0" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Other Experience Month:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="other_experience_month" name="other_experience_month" value="0" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Other Experience Day:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="other_experience_day" name="other_experience_day" value="0" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Total Experience Year:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="summary_total_experience_year" name="summary_total_experience_year" value="2" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Total Experience Month:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="summary_total_experience_month" name="summary_total_experience_month" value="0" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Total Experience Day:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="summary_total_experience_day" name="summary_total_experience_day" value="0" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>



<div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title ">Salary Details...</h3>
              </div>
          </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Basic Salary:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="basic_salary" name="basic_salary" value="200" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Gross Salary:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="gross_salary" name="gross_salary" value="400" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Security Deposit:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="security_deposit" name="security_deposit" value="300" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>

<div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title ">Employee Allowances...</h3>
              </div>
          </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                house_rent_allowance:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="house_rent_allowance" name="house_rent_allowance" value="200" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                medical_allowance:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="medical_allowance" name="medical_allowance" value="400" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                travelling_allowance:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="travelling_allowance" name="travelling_allowance" value="300" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>                                

                                 
 <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title ">Employee Deductions...</h3>
              </div>
          </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                EOBI:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="eobi" name="eobi" value="200" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Provident Fund:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="provident_fund" name="provident_fund" value="400" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group" id="province_section">
                                            <label class="control-label col-md-4">
                                                Tax Deduction:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="tax_deduction" name="tax_deduction" value="300" class="form-control fcn2 ">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <br>                                

                                






                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title ">Bank Information</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">
                                                Bank Name:
                                            </label>
                                            <div class="col-md-8">
                                                <!-- <div class="select2-container form-control fcn select2me" id="s2id_bank_id"><a href="javascript:void(0)" onclick="return false;" class="select2-choice" tabindex="-1">   <span class="select2-chosen">Select Bank</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input class="select2-focusser select2-offscreen" type="text" id="s2id_autogen20"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input">   </div>   <ul class="select2-results">   </ul></div>
                                              </div> -->
                                              <select name="bank_id" id="bank_id" class="form-control fcn2 select2me select2-offscreen" tabindex="-1">
                                                    <option value="">Select Bank</option>
                                                    <option value="1">639530-AlBaraka Bank</option>
                                                    <option value="2">589430-Allied Bank (ABL)</option>
                                                    <option value="3">581862-Apna Microfinance Bank</option>
                                                    <option value="4">603011-Askari Bank</option>
                                                    <option value="5">627197-Bank Alhabib</option>
                                                    <option value="6">627100-Bank Alfalah</option>
                                                    <option value="7">639357-BankIslami</option>
                                                    <option value="8">623977-Bank of Punjab</option>
                                                    <option value="9">604786-Burj Bank</option>
                                                    <option value="10">508117-Citi Bank</option>
                                                    <option value="11">428273-Dubai Islamic bank (DIB)</option>
                                                    <option value="12">601373-Faysal Bank</option>
                                                    <option value="13">600648-Habib Bank (HBL)</option>
                                                    <option value="14">603733-JS Bank</option>
                                                    <option value="15">628999-KASB Bank</option>
                                                    <option value="16">627873-Meezan Bank</option>
                                                    <option value="17">999100-NIB Bank</option>
                                                    <option value="18">606101-Samba Bank</option>
                                                    <option value="19">627544-Silk Bank</option>
                                                    <option value="20">505439-Sindh Bank</option>
                                                    <option value="21">786110-Soneri Bank</option>
                                                    <option value="22">604781-Summit Bank</option>
                                                    <option value="23">639390-Tameer Bank</option>
                                                    <option value="24">588974-United Bank (UBL)</option>
                                                    <option value="25">627408-HMB</option>
                                                    <option value="26">589388-MCB</option>
                                                    <option value="27">SCB-Standard Chartered Bank (SCB)</option>
                                                    <option value="28">MCA-Mobi Cash ATM</option>
                                                    <option value="29">WC-Waseela Card</option>                                                
                                              </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">
                                                Account No:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="account_id" name="account_id" value="" class="form-control fcn2">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">
                                                Branch Code:
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" id="branch_code" name="branch_code" value="0" class="form-control fcn2">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title ">Supervisor's Details</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" id="ds_id">
                                            <label class="control-label col-md-4">
                                                District Supervisor:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="ds_id" id="ds_id" class="form-control fcn input-medium">
                                                    <option value="">Select District Supervisor</option>
                                                    
                                                </select>
                                                <!--<div class="help-block">
                                                    Please select highest qualification
                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="form-group" id="ts_id">
                                            <label for="district_id" class="col-md-4 control-label">
                                                Tehsil Supervisor:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <!-- <div class="select2-container form-control fcn select2me input-medium" id="s2id_ts_id"><a href="javascript:void(0)" onclick="return false;" class="select2-choice" tabindex="-1">   <span class="select2-chosen">5-Arts</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input class="select2-focusser select2-offscreen" type="text" id="s2id_autogen21"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input">   </div>   <ul class="select2-results">   </ul></div>
                                                </div> -->
                                                <select name="ts_id" id="ts_id" class="form-control fcn select2me input-medium select2-offscreen" tabindex="-1">
                                                    <option value="">Select TS</option>
                                                    <option value="1">1-Social Sciences</option>
                                                    <option value="2">2-Communication</option>
                                                    <option value="3">3-Business Administration</option>
                                                    <option value="4">4-Science </option>
                                                    <option value="5" selected="selected">5-Arts</option>
                                                    <option value="6">6-Computer Sciences </option>
                                                    <option value="7">7-Civil Engineering </option>
                                                    <option value="8">8-Electrical Engineering </option>
                                                    <option value="9">9-English</option>
                                                    <option value="10">10-Education</option>
                                                    <option value="11">11-Commerce </option>
                                                    <option value="12">12-Mechanical Engineering </option>
                                                    <option value="13">13-Chemistry</option>
                                                    <option value="14">14-Biology</option>
                                                    <option value="15">15-Mathematics </option>
                                                    <option value="16">16-Statistics</option>
                                                    <option value="17">17-Accountancy</option>
                                                    <option value="18">-99-Info not available</option>
                                                    <option value="19">18-Madrassa Education/Quarnic Education</option>
                                                    <option value="20">19-veterinary degree</option>
                                                    <option value="21">20-Health education</option>
                                                    <option value="22">21-Engineering</option>
                                                    <option value="23">22-LAW</option>
                                                    <option value="24">23-Public Administration</option>
                                                    <option value="25">24-Islamiat</option><option value="26">25-Urdu</option><option value="27">26-Political Science</option><option value="28">27-Economics</option><option value="29">28-Primary</option><option value="30">29-Nursing</option><option value="31">30-LHV</option><option value="32">31-Pharmacy</option>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="col-md-6">
                                        <div class="form-group" id="us_id">
                                            <label for="s2id_autogen22" class="col-md-4 control-label">
                                                UC Supervisor:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="us_id" id="us_id" class="form-control fcn select2me input-medium select2-offscreen" tabindex="-1">
                                                    <option value="">Select US</option>
                                                    <option value="1">1-Social Sciences</option><option value="2">2-Communication</option><option value="3">3-Business Administration</option><option value="4">4-Science </option><option value="5" selected="selected">5-Arts</option><option value="6">6-Computer Sciences </option><option value="7">7-Civil Engineering </option><option value="8">8-Electrical Engineering </option><option value="9">9-English</option><option value="10">10-Education</option><option value="11">11-Commerce </option><option value="12">12-Mechanical Engineering </option><option value="13">13-Chemistry</option><option value="14">14-Biology</option><option value="15">15-Mathematics </option><option value="16">16-Statistics</option><option value="17">17-Accountancy</option><option value="18">-99-Info not available</option><option value="19">18-Madrassa Education/Quarnic Education</option><option value="20">19-veterinary degree</option><option value="21">20-Health education</option><option value="22">21-Engineering</option><option value="23">22-LAW</option><option value="24">23-Public Administration</option><option value="25">24-Islamiat</option><option value="26">25-Urdu</option><option value="27">26-Political Science</option><option value="28">27-Economics</option><option value="29">28-Primary</option><option value="30">29-Nursing</option><option value="31">30-LHV</option><option value="32">31-Pharmacy</option>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="form-group" id="as_id">
                                            <label for="s2id_autogen23" class="col-md-4 control-label">
                                                Area Supervisor:<span class="required">*</span>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="as_id" id="as_id" class="form-control fcn select2me input-medium select2-offscreen" tabindex="-1">
                                                    <option value="">Select AS</option>
                                                    <option value="1">1-Social Sciences</option><option value="2">2-Communication</option><option value="3">3-Business Administration</option><option value="4">4-Science </option><option value="5" selected="selected">5-Arts</option><option value="6">6-Computer Sciences </option><option value="7">7-Civil Engineering </option><option value="8">8-Electrical Engineering </option><option value="9">9-English</option><option value="10">10-Education</option><option value="11">11-Commerce </option><option value="12">12-Mechanical Engineering </option><option value="13">13-Chemistry</option><option value="14">14-Biology</option><option value="15">15-Mathematics </option><option value="16">16-Statistics</option><option value="17">17-Accountancy</option><option value="18">-99-Info not available</option><option value="19">18-Madrassa Education/Quarnic Education</option><option value="20">19-veterinary degree</option><option value="21">20-Health education</option><option value="22">21-Engineering</option><option value="23">22-LAW</option><option value="24">23-Public Administration</option><option value="25">24-Islamiat</option><option value="26">25-Urdu</option><option value="27">26-Political Science</option><option value="28">27-Economics</option><option value="29">28-Primary</option><option value="30">29-Nursing</option><option value="31">30-LHV</option><option value="32">31-Pharmacy</option>                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <br>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title ">Additional Remarks (If any)</h3>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-4">
                                                Additional Remarks:
                                            </label>
                                            <div class="col-md-8">
                                                 <textarea id="remarks" name="remarks" rows="4" cols="50" class="form-control" placeholder="General Remarks if any" value="">2-years Polio worker experience.</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <br>


                                <div class="form-actions fluid">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="#" data-dismiss="modal" class="btn btn-default">
                                            <i class="fa fa-mail-reply"></i> Close
                                        </a>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-save"></i> Save
                                        </button>

                                        <label>
                                            <div id="loader">
                                                <!--<img src=""/>-->
                                            </div>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            </form>                        
                          </div>
                    </div>
                </div>
            </div>
              </div>
              <!--Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal: modalCart -->

             <?php }else{ ?>
                <a href="<?php echo base_url(); ?>job_longlisted/longlisttoshortlist/<?php echo $candidate->application_id;?>"><button type="button" class="btn btn-primary">Add Short List</button></a>
             <?php } ?>


        <!-- Modal: testdate -->
        <div class="modal fade" id="testdate<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Select Location For Test... </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="container">
              <form action="<?php echo site_url("job_post/assign_test") ?>" method="post" name="add_job" id="xin-form">
                      <input type="hidden" name="email" value="<?php echo $candidate->email;?>"> <!-- // email address where sent auto email to interviewr person // --> 
                      <input type="hidden" name="rollnumber" value="<?php echo $candidate->application_id;?>">
                    <br>

                    <div class="row text-center">
                      <div class="col-lg-12">
                      <div class="form-group">
                          <label for="date_of_closing" class="control-label lablewidth">Roll Number: </label>
                          <input type="text" value="CTC-<?php echo $candidate->application_id;?>" class="inputfield">
                      </div>
                      </div>
                    </div>
                    <br>

                    <div class="row text-center">
                      <div class="col-lg-12">
                      <div class="form-group">
                          <label for="date_of_closing" class="control-label lablewidth">Test Date: </label>
                          <div class="form-control controls input-append date form_datetime datefldset" data-date="2019-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1<?php echo $i; ?>">
                              <input size="16" type="text" value="" readonly class="inputfield" >
                              <span class="add-on"><i class="icon-remove"></i></span>
                              <span class="add-on"><i class="icon-th"></i></span>
                          </div>
                          <input type="hidden" name="test_date" id="dtp_input1<?php echo $i; ?>" value="" /><br/>
                      </div>
                      </div>
                    </div>
                    <br>
                     <div class="row text-center">
                        <div class="col-lg-12">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label lablewidth">City: </label>
                            <select title="Select City" name="city_id" data-plugin="select_hrm" class="form-control ddfield">      
                                <option value="">Select City</option>
                                <?php
                                foreach ($AllCities as $key => $element) {
                                    echo '<option value="'.$element['city_id'].'">'.$element['city_name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        </div>
                    </div>
                    <br>
                     <div class="row text-center">
                        <div class="col-lg-12">
                             <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?></button>
                        </div>
                    </div>
                  </form>
                  </div>
              
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal: testdate -->

        <!-- Modal: interview -->
        <div class="modal fade" id="interviewdialog<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Select Location For Interview... </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <!--Body-->
                    <div class="container">
                    <form action="<?php echo site_url("job_post/assign_interview") ?>" method="post" name="add_job" id="xin-form">
                      <input type="hidden" name="email" value="<?php echo $candidate->email;?>"> <!-- // email address where sent auto email to interviewr person // --> 
                      <input type="hidden" name="rollnumber" value="<?php echo $candidate->application_id;?>">
                    <br>

                    <div class="row text-center">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="date_of_closing" class="control-label lablewidth">Roll Number: </label>
                            <input type="text" value="CTC-<?php echo $candidate->application_id;?>" class="inputfield">
                          </div>
                    </div>
                    </div>
                    <br>

                      <div class="row text-center">
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <!-- <label class="control-label">DateTime Picking</label> -->
                                    <label for="date_of_closing" class="control-label lablewidth">Date: </label>
                                    <div class="form-control controls input-append date form_datetime datefldset" data-date="2019-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1interv<?php echo $i; ?>">
                                        <input size="16" type="text" value="" readonly class="inputfield" >
                                        <span class="add-on"><i class="icon-remove"></i></span>
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                    <input type="hidden" name="interview_date" id="dtp_input1interv<?php echo $i; ?>" value="" /><br/>
                                </div>
                      </div>
                    </div>
                    <br>
                     <div class="row text-center">
                        <div class="col-lg-12">
                                  <div class="form-group">
                                                <label class="control-label lablewidth">Interview City: </label>
                                                <select title="Select City" name="city_id" data-plugin="select_hrm" class="form-control ddfield">      
                                                    <option value="">Select City</option>
                                                    <?php
                                                    foreach ($AllCities as $key => $element) {
                                                        echo '<option value="'.$element['city_id'].'">'.$element['city_name'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                    </div>
                    </div>
                    <br>

                    <div class="row text-center">
                        <div class="col-lg-12">
                                  <div class="form-group">
                                                <label class="control-label lablewidth">Interview Person: </label>
                                                <select title="Select User" name="interview_person" data-plugin="select_hrm" class="form-control ddfield">      
                                                    <option value="">Select User</option>
                                                    <?php
                                                    foreach ($all_employees as $employee) {
                                                        echo '<option value="'.$employee->user_id.'">'.$employee->first_name.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                    </div>
                    </div>
                    <br>

                    <div class="row text-center">
                        <div class="col-lg-12">
                             <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?></button>
                        </div>
                    </div>
                    <br>

                    </form>
                    </div>
              <!--Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal: interview -->

        <!-- Modal: modalCart -->
        <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Applicant Details... </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                       
                      <td> Email 1</td>
                      <td><?php echo $candidate->email;?>0$</td>
                       
                    </tr>
                    <tr>
                      
                      <td> Gender</td>
                      <td><?php echo $gender; ?></td>
                       
                    </tr>
                    <tr>
                      <td> Age </td>
                      <td><?php echo  $ag->name; ?></td>
                    </tr>


                    <tr>
                      <td> Education </td>
                      <td><?php echo  $ed->name;; ?></td>
                    </tr>
                    <tr>
                      <td> Domicile </td>
                      <td><?php  echo  $domic->name;; ?></td>
                    </tr>
                    <tr>
                      <td>Province </td>
                      <td><?php echo  $prov->name; ?></td>
                    </tr>
                    <tr>
                      <td>City </td>
                      <td><?php echo  $citi->name; ?></td>
                    </tr>
                    <tr>
                      <td> Message </td>
                      <td><?php echo  $candidate->message; ?></td>
                    </tr>
                    <tr>
                      <td>Resume </td>
                      <td> <a href="<?php echo base_url(); ?>uploads/resume/<?php echo  $candidate->job_resume; ?>" target="_blank">View Resume</a> </td>
                    </tr>
                    
                  </tbody>
                </table>

              </div>
              <!--Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal: modalCart -->


</td>
                 
            </tr>













<?php 

 if($viewTab=='getlonglistedsinglerecord'){/*

if ($allCandidatesnn){ ?>
     
           <?php 
                //$i = 0;
                $candidate = '';
                foreach($allCandidatesnn as $candidate){
                  $i++;
                  $gender = (($candidate->gender==0)?'Male':(($candidate->gender==1)?'Female':'No'));
            ?>
            <tr>
                <td><?php echo $i; ?></td>                
                <td><?php echo $candidate->fullname;?></td>
                <td><?php echo $candidate->email;?></td>
                <td><?php echo $gender; ?></td>
                <td><?php foreach($getage as $ag){ echo $ag->name;  } ;?></td>
                <td><?php foreach($getEducation as $ed){ echo  $ed->name;  } ;?></td>
                <td><?php foreach($getProvince as $domic){ echo  $domic->name;  } ;?></td>
                <td><?php foreach($getProvince as $prov){ echo  $prov->name;  } ;?></td>
                <td><?php foreach($getcityName as $citi){ echo  $citi->name;  } ;?></td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCart">View</button>
                <a href="<?php echo base_url(); ?>job_longlisted/longlisttoshortlist/<?php echo $candidate->application_id;?>"><button type="button" class="btn btn-primary">Add Short List</button></a>
        <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Applicant Details... </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <!--Body-->
              <div class="modal-body">

                <table class="table table-hover">
                   
                  <tbody>
                    <tr>
                       
                      <td> Email 1</td>
                      <td><?php echo $candidate->email;?>0$</td>
                       
                    </tr>
                    <tr>
                      
                      <td> Gender</td>
                      <td><?php echo $gender; ?></td>
                       
                    </tr>
                    <tr>
                      <td> Age </td>
                      <td><?php echo  $ag->name; ?></td>
                    </tr>


                    <tr>
                      <td> Education </td>
                      <td><?php echo  $ed->name;; ?></td>
                    </tr>
                    <tr>
                      <td> Domicile </td>
                      <td><?php  echo  $domic->name;; ?></td>
                    </tr>
                    <tr>
                      <td>Province </td>
                      <td><?php echo  $prov->name; ?></td>
                    </tr>
                    <tr>
                      <td>City </td>
                      <td><?php echo  $citi->name; ?></td>
                    </tr>
                    <tr>
                      <td> Message </td>
                      <td><?php echo  $candidate->message; ?></td>
                    </tr>
                    <tr>
                      <td>Resume </td>
                      <td> <a href="<?php echo base_url(); ?>uploads/resume/<?php echo  $candidate->job_resume; ?>" target="_blank">View Resume</a> </td>
                    </tr>
                    
                  </tbody>
                </table>

              </div>
              <!--Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
</td>
</tr>
            <?php } ?>
<?php } */}  ?> 












            <?php } ?>
        </tbody>
    </table>






















<?php }else{ echo '<div class="alert alert-warning text-center" role="alert"> No Record Found </div>';} ?>


</div>
</div>
















<?php 

 if($viewTab=='getlonglistedsinglerecord'){
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#job_listing1').DataTable();
} );
</script>
<div class="box box-block bg-white">

<ul class="nav nav-tabs">
       
      <li <?php echo (($viewTab=='getlonglistedsinglerecord') ? 'class="active"' : ''); ?>>
        <a href="<?php echo base_url(); ?>job_longlisted/getlonglistedsinglerecord/<?php echo $theJobId; ?>" >Long Listed Candidates(Manually)</a>
      </li>
       
</ul>

<div class="table-responsive">
  
 <table id="job_listing1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Education</th>
                <th>Domicile</th>
                <th>Province</th>
                <th>City</th>
                <th>Action</th>
                 
            </tr>
        </thead>
        <tbody>


         
<?php 

 //if($viewTab=='getlonglistedsinglerecord'){

if ($allCandidatesnn){ ?>
     
           <?php 
                $i = 0;
                $candidate = '';
                foreach($allCandidatesnn as $candidate){
                  $i++;
                  $gender = (($candidate->gender==0)?'Male':(($candidate->gender==1)?'Female':'No'));
            ?>
            <tr>
                <td><?php echo $i; ?></td>                
                <td><?php echo $candidate->fullname;?></td>
                <td><?php echo $candidate->email;?></td>
                <td><?php echo $gender; ?></td>
                <td><?php foreach($getage as $ag){ echo $ag->name;  } ;?></td>
                <td><?php foreach($getEducation as $ed){ echo  $ed->name;  } ;?></td>
                <td><?php foreach($getProvince as $domic){ echo  $domic->name;  } ;?></td>
                <td><?php foreach($getProvince as $prov){ echo  $prov->name;  } ;?></td>
                <td><?php foreach($getcityName as $citi){ echo  $citi->name;  } ;?></td>
                <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCart">View</button>
                <a href="<?php echo base_url(); ?>job_longlisted/longlisttoshortlist/<?php echo $candidate->application_id;?>"><button type="button" class="btn btn-primary">Add Short List</button></a>
        <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!--Header-->
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Applicant Details... </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <!--Body-->
              <div class="modal-body">

                <table class="table table-hover">
                   
                  <tbody>
                    <tr>
                       
                      <td> Email 1</td>
                      <td><?php echo $candidate->email;?>0$</td>
                       
                    </tr>
                    <tr>
                      
                      <td> Gender</td>
                      <td><?php echo $gender; ?></td>
                       
                    </tr>
                    <tr>
                      <td> Age </td>
                      <td><?php echo  $ag->name; ?></td>
                    </tr>


                    <tr>
                      <td> Education </td>
                      <td><?php echo  $ed->name;; ?></td>
                    </tr>
                    <tr>
                      <td> Domicile </td>
                      <td><?php  echo  $domic->name;; ?></td>
                    </tr>
                    <tr>
                      <td>Province </td>
                      <td><?php echo  $prov->name; ?></td>
                    </tr>
                    <tr>
                      <td>City </td>
                      <td><?php echo  $citi->name; ?></td>
                    </tr>
                    <tr>
                      <td> Message </td>
                      <td><?php echo  $candidate->message; ?></td>
                    </tr>
                    <tr>
                      <td>Resume </td>
                      <td> <a href="<?php echo base_url(); ?>uploads/resume/<?php echo  $candidate->job_resume; ?>" target="_blank">View Resume</a> </td>
                    </tr>
                    
                  </tbody>
                </table>

              </div>
              <!--Footer-->
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
</td>
</tr>
            <?php } ?>
<?php 
      } 

     
  ?> 

             
        </tbody>
    </table>


</div>

</div>
<?php } ?>



<!-- 
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
 -->
 <script type="text/javascript">
  $('#from_date').datepicker({
            uiLibrary: 'bootstrap4'
        });
  $('#to_date').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>
<script type="text/javascript">
  $('#date_of_birth').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>
<script type="text/javascript">
  $('#date_of_joining').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>
<script type="text/javascript">
  $('#cnic_expiry_date').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>
<script type="text/javascript">
  $('#contract_expiry_date').datepicker({
            uiLibrary: 'bootstrap4'
        });
</script>
<style type="text/css">.input-group-append { display: none; }</style>






<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js" charset="UTF-8"></script>
 --><!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script> -->
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
</script>