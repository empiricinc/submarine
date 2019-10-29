<?php
$rolnumberFormat = 'CTC-ORG-PK';

$session = $this->session->userdata('username');

$system = $this->Xin_model->read_setting_info(1);

$user_info = $this->Xin_model->read_user_info($session['user_id']);

$role = $this->Xin_model->read_user_role_info($user_info[0]->user_role_id);

          if(!is_null($role)){

          	$role_name = $role[0]->role_name;

          } else {

          	$role_name = '--';	

          }

          // get designation
          $department = $this->Department_model->read_department_information($user_info[0]->department_id);

              if(!is_null($department)){

              	$department_id = $department[0]->department_id;

              } else {

              	$department_id = '--';	

              }

?>

<?php if($user_info[0]->user_role_id=='1'){   ?>

<?php

$interviewResult = $this->session->flashdata('interviewResult');

if ($interviewResult) {
                  echo $interviewResult = '<div class="alert alert-success text-center"><strong>Success!</strong> Successfully...</div>';
}


?>


<style type="text/css"> .ui-datepicker{display: block;} .form-control.ddfield{ height: 36px !important; width: 300px; border: 1px solid #ccc; } .inputfield{ width: 300px; margin-top: -6px; padding: 10px; line-height: 1rem; background-color: #f6f7f8; border: 1px solid #e1e4e7; } .datefldset{ background: none !important; border: 0px !important; } .lablewidth{ width: 180px; text-align: right; font-size: 15px; } </style>

<style type="text/css">.breadcrumb.no-bg{ display: none; } h4{ display: none; }</style>
<script type="text/javascript">
 $(document).ready(function(){
    $('.date').ui-datepicker();
  });
</script>
<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndex">
    <div class="row">
      <div class="col-md-12">
        <div class="headingMain">
          <h1>
            Interviews Management Dashboard
            <span>statistics and more&hellip;</span>
          </h1>
        </div>
        <?php if($success = $this->session->flashdata('success')): ?>
          <div class="alert alert-success text-center">
            <?php echo $success; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <section class="secIndexTable margint-top-0">
    <div class="row">
      <div class="col-md-6">
        <div class="mainTableWhite">
          <div class="row">
            <div class="col-md-7">
              <div class="tabelHeading">
                <h3>scheduled interviews</h3>
              </div>
            </div>
            <div class="col-md-5">
              <div class="tabelTopBtn">
                  <a data-toggle='tooltip' title="Add interview marks here." href="<?= base_url('interview/add_marks'); ?>" class="btn"><img src="<?= base_url('assets/img/plus.png'); ?>"> Marks</a>
                  <a href="<?= base_url('interview/list_scheduled'); ?>" class="btn">
                    View All
                  </a>
              </div>
            </div>
          </div>
        <script type="text/javascript">
        //   $(document).ready(function() {
        //     $('#job_listing').DataTable();
        // } );
        </script>

          <div class="row">
            <div class="col-md-12">
              <div class="tableMain">
                <div class="table-responsive">
                  <!-- <table class="table"> -->

    <table id="job_listing" class="table table-striped">
      <thead>
        <tr>
          <th>RNo.</th>
          <th>Detail</th>
          <th>Action</th>
          <th>project</th>
          <th>designation</th>
          <th>location</th>
          <th>Interview</th>
        </tr>
      </thead>
      <tbody>

<?php //foreach($all_interviews as $interview) {
$i=0; 
//$this->load->model('job_longlisted_model'); // load model

foreach ($all_interviews as $interview){
$i++;
$userDetails = $this->Interview_model->applicantdetails($interview->rollnumber);

//foreach ($userDetails as $row){
//echo $row->fullname;
//echo $row->user_id;
//}
?>
          <tr>
            <td><?php echo $interview->rollnumber.'-'.$rolnumberFormat;?></td>
            <td>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalviewDetail<?= $i; ?>" style="display: block;">View</button>
                <div class="modal fade" id="modalviewDetail<?= $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <!--Header-->
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel" style="display: inline-block;">Applicant Details... </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <!--Body-->
                      <div class="modal-body">
                        <table class="table table-hover">
                          <tbody>
                   <?php foreach ($userDetails as $row){ ?>
                            <tr>
                              <td> Fullname</td>
                              <td><?php echo $row->fullname; ?></td>
                            </tr>
                            <tr>
                              <td> Email 1</td>
                              <td><?php echo $row->email;?></td>
                            </tr>
                            <tr>
                              <td> Gender </td>
                              <td><?php echo  $row->genderName; ?></td>
                            </tr>
                            <tr>
                              <td> Age </td>
                              <td><?php echo  $row->age_name; ?></td>
                            </tr>
                            <tr>
                              <td> Education </td>
                              <td><?php echo  $row->edu_name;; ?></td>
                            </tr>
                            <tr>
                              <td> Experience </td>
                              <td><?php  echo  $row->minimum_experience;; ?></td>
                            </tr>
                            <tr>
                              <td>Province </td>
                              <td><?php echo  $row->prov_name; ?></td>
                            </tr>
                            <tr>
                              <td>District </td>
                              <td><?php echo  $row->cityName; ?></td>
                            </tr>
                            <tr>
                              <td> Message </td>
                              <td><?php echo  $row->message; ?></td>
                            </tr>
                            <tr>
                              <td>Resume </td>
                              <td> <a href="<?php echo base_url(); ?>uploads/resume/<?php echo  $row->job_resume; ?>" target="_blank">View Resume</a> </td>
                            </tr>
                    <?php } ?>  
                          </tbody>
                        </table>

                      </div>
                      <!--Footer-->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
            </td>
            <td>
<?php

      $interviewresult = $this->Interview_model->interview_result_exists('interview_result','rollnumber',$interview->rollnumber); 
      if($interviewresult==0){ 
        echo '<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#assigninterview'.$i.'" style="display: block;">Add Result</button>';
      }else{ 
       // echo '<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Interview Result</button>';
      //}

      $checkinterviewresult = $this->job_longlisted_model->interview__result_exists('interview_result','rollnumber',$interview->rollnumber); 
      if($checkinterviewresult==0){ // aghr interview result nhe dia to zero condition ma serf tab show ho jay
                             echo '<button type="button" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-ok"></span> Interview</button>';
                            }else{ $interviewmarks = $this->job_longlisted_model->interview_result_byjobId($interview->rollnumber); foreach ($interviewmarks as $intr){  $interviewPM = $intr->obtain_marks*100/$intr->total_marks; }
                             echo '<button type="button" class="btn btn-success btn-xs" >'.round($interviewPM).'%'.'</button>';
                            }
            }
?>                            
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assigninterview<?php echo $i; ?>">Result</button> -->

                            <div class="modal fade" id="assigninterview<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel" style="display: inline-block;">Add Interview Result & comments</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="container">
                               <form action="<?php echo site_url("job_post/add_interview_result") ?>" method="post" name="add_job" id="xin-form">
                                  <!-- <input type="hidden" name="email" value="<?php echo $candidate->email;?>"> --> <!-- // email address where sent auto email to interviewr person // --> 
                                  <input type="hidden" name="rollnumber" value="<?php echo $interview->rollnumber;?>">
                                <br>

                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-lg-4">
                                        <label for="date_of_closing" class="control-label lablewidth">Roll Number: </label>
                                      </div>
                                      <div class="col-lg-8">
                                        <input type="text" value="CTC-<?php echo $interview->rollnumber;?>" class="inputfield" readonly="readonly">
                                      </div>
                                    </div>
                                  </div>
                                <br>

                                <div class="row">
                                  <div class="form-group">
                                    <div class="col-lg-4">
                                      <label for="date_of_closing" class="control-label lablewidth">Communication: </label>
                                    </div>
                                    <div class="col-lg-8">
                                      <input type="text" name="communication" value="10" class="inputfield">
                                    </div>
                                  </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="form-group">
                                    <div class="col-lg-4">
                                      <label for="date_of_closing" class="control-label lablewidth">Experience: </label>
                                    </div>
                                    <div class="col-lg-8">
                                      <input type="text" name="experience" value="10" class="inputfield">
                                    </div>
                                  </div>
                                </div>
                                <br>
                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-lg-4">
                                        <label for="date_of_closing" class="control-label lablewidth">Aptitude: </label>
                                      </div>
                                      <div class="col-lg-8">
                                        <input type="text" name="aptitude" value="10" class="inputfield">
                                      </div>
                                    </div>
                                  </div>
                                <br>
                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-lg-4">
                                        <label for="date_of_closing" class="control-label lablewidth">Personality: </label>
                                      </div>
                                      <div class="col-lg-8">
                                        <input type="text" name="personality" value="10" class="inputfield">
                                      </div>
                                    </div>
                                  </div>
                                <br>
                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-lg-4">
                                        <label for="date_of_closing" class="control-label lablewidth">Language: </label>
                                      </div>
                                      <div class="col-lg-8">
                                        <input type="text" name="language" value="10" class="inputfield">
                                      </div>
                                    </div>
                                  </div>
                                <br>
                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-lg-4">
                                        <label for="date_of_closing" class="control-label lablewidth">Education: </label>
                                      </div>
                                      <div class="col-lg-8">
                                        <input type="text" name="education" value="10" class="inputfield">
                                      </div>
                                    </div>
                                  </div>
                                <br>
                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-lg-4">
                                        <label for="date_of_closing" class="control-label lablewidth">General Knowledge: </label>
                                      </div>
                                      <div class="col-lg-8">
                                        <input type="text" name="general_knowledge" value="10" class="inputfield">
                                      </div>
                                    </div>
                                  </div>
                                <br>
                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-lg-4">
                                        <label for="date_of_closing" class="control-label lablewidth">Total Marks: </label>
                                      </div>
                                      <div class="col-lg-8">
                                        <input type="text" name="total_marks" value="70" class="inputfield">
                                      </div>
                                    </div>
                                  </div>
                                <br>
                                  <div class="row">
                                    <div class="form-group">
                                      <div class="col-lg-4">
                                        <label for="comments" class="control-label lablewidth">Comments: </label>
                                      </div>
                                      <div class="col-lg-8">
                                        <textarea name="comments" class="inputfield" rows="5" placeholder="Additional info, comments about the candidate."></textarea>
                                      </div>
                                    </div>
                                  </div>
                                <br>
                                <div class="row">
                                  <div class="col-lg-8 col-lg-offset-4">
                                    <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?></button>
                                    <button type="button" class="btn btn-warning reset">Cancel</button><br><br>
                                  </div>
                                </div>
                                </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td><?php echo $interview->compName; ?></td>
                          <td><?php echo $interview->designation_name; ?></td>
                          <td><?php echo $interview->provName;?></td>
                          <td><?php echo date('M d, Y', strtotime($interview->interview_date)); ?></td>
                      </tr>
        <?php } ?>               
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mainTableWhite">
          <div class="row">
            <div class="col-md-7">
              <div class="tabelHeading">
                <h3>completed interviews</h3>
              </div>
            </div>
            <div class="col-md-5">
              <div class="tabelTopBtn">
                <a href="<?= base_url('interview/list_completed'); ?>" class="btn">
                  View All
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="tableMain">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>roll no.</th>
                        <th>name</th>
                        <th>project</th>
                        <th>designation</th>
                        <th>location</th>
                        <th>marks</th>
                        <th>date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($completed_interviews as $completed): ?>
                      <?php $appData = $this->Interview_model->applicantdetails($completed->rollnumber); ?>
                      <tr>
                        <td><a data-toggle="modal" data-target="#view_detail<?= $completed->rollnumber; ?>" href="#detailModal"><?= $completed->rollnumber.'-'.$rolnumberFormat; ?></a>
                          <div class="modal fade" id="view_detail<?= $completed->rollnumber; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <!--Header-->
                                <div class="modal-header">
                                  <h4 class="modal-title" id="myModalLabel" style="display: inline-block;">Applicant Detail, interview result and more... </h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <!--Body-->
                                <div class="modal-body">
                                  <table class="table table-hover">
                                    <tbody>
                                     <?php foreach ($appData as $row){ ?>
                                      <tr>
                                        <td> Full Name</td>
                                        <td><?php echo $row->fullname; ?></td> 
                                      </tr>
                                      <tr>
                                        <td> Email </td>
                                        <td><?php echo $row->email;?></td> 
                                      </tr>
                                      <tr>
                                        <td> Gender </td>
                                        <td><?php echo  $row->genderName; ?></td>
                                      </tr>
                                      <tr>
                                        <td> Age </td>
                                        <td><?php echo  $row->age_name; ?></td>
                                      </tr>
                                      <tr>
                                        <td> Education </td>
                                        <td><?php echo  $row->edu_name;; ?></td>
                                      </tr>
                                      <tr>
                                        <td> Experience </td>
                                        <td><?php  echo  $row->minimum_experience;; ?></td>
                                      </tr>
                                      <tr>
                                        <td>Province </td>
                                        <td><?php echo  $row->prov_name; ?></td>
                                      </tr>
                                      <tr>
                                        <td>District </td>
                                        <td><?php echo  $row->cityName; ?></td>
                                      </tr>
                                      <tr>
                                        <td>Job Title</td>
                                        <td><?= $row->job_title; ?></td>
                                      </tr>
                                      <tr>
                                        <td>Project</td>
                                        <td><?= $row->comp_name; ?></td>
                                      </tr>
                                      <tr>
                                        <td>Designation</td>
                                        <td><?= $row->designation_name; ?></td>
                                      </tr>
                                      <tr>
                                        <td>Marks</td>
                                        <td>
                                          <?= '<strong>'.$row->obtain_marks.'</strong> out of <strong>'.$row->total_marks.'</strong> with the percentage of <strong>'.round($row->obtain_marks/$row->total_marks*100).'.</strong>'; ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>Comments</td>
                                        <td><?= $row->comments; ?></td>
                                      </tr>
                                      <tr>
                                        <td>Result submission date</td>
                                        <td><?= date('M d, Y', strtotime($row->int_date)); ?></td>
                                      </tr>
                                      <tr>
                                        <td>Resume </td>
                                        <td> <a href="<?php echo base_url(); ?>uploads/resume/<?php echo  $row->job_resume; ?>" target="_blank">View Resume</a> </td>
                                      </tr>
                                      <?php } ?>  
                                    </tbody>
                                  </table>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td><?= $completed->fullname; ?></td>
                        <td><?= $completed->comp_name; ?></td>
                        <td><?= $completed->designation_name; ?></td>
                        <td><?= $completed->prov_name; ?></td>
                        <td>
                          <div class="label label-success" style="display: inline-block;">
                            <?= round($completed->obtain_marks / $completed->total_marks *100).'%'; ?>
                          </div>
                        </td>
                        <td><?= date('M d, Y', strtotime($completed->sdt)); ?></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <div class="tabelSideListing text-center">
                <?php echo $this->pagination->create_links(); ?>
              </div>
            </div>
            <div class="col-md-4"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="secIndexTable">
    <div class="mainTableWhite">
      <div class="row">
        <div class="col-md-6">
          <div class="tabelHeading">
            <h3>overdue interviews <span>(incomplete)</span> <small style="text-transform: lowercase;">It can be re-scheduled</small></h3>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tabelTopBtn">
            <a href="<?= base_url('interview/list_overdue'); ?>" class="btn">
              View All
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tableMain">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Roll No.</th>
                    <th>name</th>
                    <th>project</th>
                    <th>designation</th>
                    <th>location</th>
                    <th>district</th>
                    <th>interview date</th>
                    <th>options | operations</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($overdue_interviews as $overdue): ?>
                  <?php $overdue_data = $this->Interview_model->applicantdetails($overdue->rollnumber); ?>
                  <tr>
                    <td>
                      <a data-toggle="modal" data-target="#overdue_detail<?= $overdue->rollnumber; ?>" href="#overdueModal"><?= $overdue->rollnumber.'-'.$rolnumberFormat; ?></a>
                      <div class="modal fade" id="overdue_detail<?= $overdue->rollnumber; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <!--Header-->
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel" style="display: inline-block;">Applicant Detail... </h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <!--Body-->
                            <div class="modal-body">
                              <table class="table table-hover">
                                <tbody>
                                 <?php foreach ($overdue_data as $row){ ?>
                                  <tr>
                                    <td> Full Name</td>
                                    <td><?php echo $row->fullname; ?></td> 
                                  </tr>
                                  <tr>
                                    <td> Email </td>
                                    <td><?php echo $row->email;?></td> 
                                  </tr>
                                  <tr>
                                    <td> Gender </td>
                                    <td><?php echo  $row->genderName; ?></td>
                                  </tr>
                                  <tr>
                                    <td> Age </td>
                                    <td><?php echo  $row->age_name; ?></td>
                                  </tr>
                                  <tr>
                                    <td> Education </td>
                                    <td><?php echo  $row->edu_name;; ?></td>
                                  </tr>
                                  <tr>
                                    <td> Experience </td>
                                    <td><?php  echo  $row->minimum_experience;; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Province </td>
                                    <td><?php echo  $row->prov_name; ?></td>
                                  </tr>
                                  <tr>
                                    <td>District </td>
                                    <td><?php echo $row->cityName; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Job Title</td>
                                    <td><?= $row->job_title; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Project</td>
                                    <td><?= $row->comp_name; ?></td>
                                  </tr>
                                  <tr>
                                    <td>Designation</td>
                                    <td><?= $row->designation_name; ?></td>
                                  </tr>
                                  <tr>
                                  <?php $date1=date_create(date('Y-m-d'));
                                        $date2=date_create(date('Y-m-d', strtotime($row->assigned_date)));
                                        $diff=date_diff($date1, $date2); ?>
                                    <td>Interview Date</td>
                                    <td><?= date('M d, Y', strtotime($row->assigned_date)) .', scheduled '.$diff->format('%a days ago.'); ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>Resume </td>
                                    <td> <a href="<?php echo base_url(); ?>uploads/resume/<?php echo  $row->job_resume; ?>" target="_blank">View Resume</a> </td>
                                  </tr>
                                  <?php } ?>  
                                </tbody>
                              </table>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td><?= $overdue->fullname; ?></td>
                    <td><?= $overdue->compName; ?></td>
                    <td><?= $overdue->designation_name; ?></td>
                    <td><?= $overdue->provName; ?></td>
                    <td><?= $overdue->cityName; ?></td>
                    <td><?= date('M d, Y', strtotime($overdue->interview_date)); ?></td>
                    <td>
                      <a href="#" data-toggle="modal" data-target="#re_schedule<?= $overdue->rollnumber; ?>" class="btn btn-primary btn-xs">Re-schedule</a>
                      <a href="<?= base_url(); ?>interview/delete_interview/<?= $overdue->rollnumber; ?>" class="btn btn-danger btn-xs" onclick="javascript:return confirm('Are you sure to delete ?');">Delete</a>
                      <div class="modal fade" id="re_schedule<?= $overdue->rollnumber; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <!--Header-->
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel" style="display: inline-block;">Re-schedule an Interview... </h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <!--Body-->
                            <div class="modal-body">
                              <form action="<?= base_url('interview/re_schedule'); ?>" method="post">
                                <input type="hidden" name="rollnumber" value="<?= $overdue->rollnumber; ?>">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label>Interview Date</label>
                                    <input type="text" name="interview_date" class="form-control date" value="<?php echo date('Y-m-d', strtotime($overdue->interview_date)); ?>"><br>
                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                    <button type="reset" class="btn btn-default btn-sm">Cancel</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</section>
 
<?php } ?>