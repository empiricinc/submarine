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


<style type="text/css"> .ui-datepicker{display: none !important;} .form-control.ddfield{ height: 36px !important; width: 300px; border: 1px solid #ccc; } .inputfield{ width: 300px; margin-top: -6px; padding: 10px; line-height: 1rem; background-color: #f6f7f8; border: 1px solid #e1e4e7; } .datefldset{ background: none !important; border: 0px !important; } .lablewidth{ width: 180px; text-align: right; font-size: 15px; } </style>

<style type="text/css">.breadcrumb.no-bg{ display: none; } h4{ display: none; }</style>

<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndex">
    <div class="row">
      <div class="col-md-12">
        <div class="headingMain">
          <h1>
            Interview Dashboard
            <span>statics and more</span>
          </h1>
        </div>
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
                <h3>Job Application List <span>(Long List)</span></h3>
              </div>
            </div>
           <!--  <div class="col-md-5">
              <div class="tabelTopBtn">
                <button class="btn">
                  <img src="assets/img/plus.png" alt=""> 
                  Create Job Recuritment
                </button>
              </div>
            </div> -->
          </div>
  


        <script type="text/javascript">
          $(document).ready(function() {
            $('#job_listing').DataTable();
        } );
        </script>

          <div class="row">
            <div class="col-md-12">
              <div class="tableMain">
                <div class="table-responsive">
                  <!-- <table class="table"> -->

    <table id="job_listing" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>#sr</th>
                        <th>View Detail</th>
                        <th>Action</th>
                        <th>Roll Number</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Interview Date</th>
                        <!-- <th>User Name</th> -->
                        <th>status</th>
                        <th>Date</th>
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

                          <td><?php echo $i; ?></td>
                          <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalviewDetail">View</button>
                              <div class="modal fade" id="modalviewDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                                 <?php foreach ($userDetails as $row){ ?>         
                                          
                                          <tr>
                                            
                                            <td> fullname</td>
                                            <td><?php echo $row->fullname; ?></td>
                                             
                                          </tr>
                                          <tr>
                                             
                                            <td> Email 1</td>
                                            <td><?php echo $row->email;?></td>
                                             
                                          </tr>

                                          <tr>
                                            <td> Gender </td>
                                            <td><?php echo  $row->gender; ?></td>
                                          </tr>

                                          <tr>
                                            <td> Age </td>
                                            <td><?php echo  $row->age; ?></td>
                                          </tr>


                                          <tr>
                                            <td> Education </td>
                                            <td><?php echo  $row->education;; ?></td>
                                          </tr>
                                          <tr>
                                            <td> Experience </td>
                                            <td><?php  echo  $row->minimum_experience;; ?></td>
                                          </tr>
                                          <tr>
                                            <td>province </td>
                                            <td><?php echo  $row->province; ?></td>
                                          </tr>
                                          <tr>
                                            <td>City </td>
                                            <td><?php echo  $row->city_name; ?></td>
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
                                      <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </td>
                          <td>
<?php

      $interviewresult = $this->Interview_model->interview_result_exists('interview_result','rollnumber',$interview->rollnumber); 
      if($interviewresult==0){ 
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assigninterview'.$i.'">Add Interview Result</button>';
      }else{ 
       // echo '<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Interview Result</button>';
      //}

      $checkinterviewresult = $this->job_longlisted_model->interview__result_exists('interview_result','rollnumber',$interview->rollnumber); 
      if($checkinterviewresult==0){ // aghr interview result nhe dia to zero condition ma serf tab show ho jay
                             echo '<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Interview</button>';
                            }else{ $interviewmarks = $this->job_longlisted_model->interview_result_byjobId($interview->rollnumber); foreach ($interviewmarks as $intr){  $interviewPM = $intr->obtain_marks*100/$intr->total_marks; }
                             echo '<button type="button" class="btn btn-success" >'.round($interviewPM).'%'.'</button>';
                            }
            }
?>                            
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#assigninterview<?php echo $i; ?>">Result</button> -->

                            <div class="modal fade" id="assigninterview<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Interview Result Detail... </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="container">
                               <form action="<?php echo site_url("job_post/add_interview_result") ?>" method="post" name="add_job" id="xin-form">
                                          <!-- <input type="hidden" name="email" value="<?php echo $candidate->email;?>"> --> <!-- // email address where sent auto email to interviewr person // --> 
                                          <input type="hidden" name="rollnumber" value="<?php echo $interview->rollnumber;?>">
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Roll Number: </label>
                                              <input type="text" value="CTC-<?php echo $interview->rollnumber;?>" class="inputfield" readonly="readonly">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Communication: </label>
                                              <input type="text" name="communication" value="10" class="inputfield">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Experience: </label>
                                              <input type="text" name="experience" value="10" class="inputfield">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Aptitude: </label>
                                              <input type="text" name="aptitude" value="10" class="inputfield">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Personality: </label>
                                              <input type="text" name="personality" value="10" class="inputfield">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Language: </label>
                                              <input type="text" name="language" value="10" class="inputfield">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Education: </label>
                                              <input type="text" name="education" value="10" class="inputfield">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">General Knowledge: </label>
                                              <input type="text" name="general_knowledge" value="10" class="inputfield">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Total Marks: </label>
                                              <input type="text" name="total_marks" value="70" class="inputfield">
                                          </div>
                                          </div>
                                        </div>
                                        <br>

                                        <!-- <div class="row text-center">
                                          <div class="col-lg-12">
                                          <div class="form-group">
                                              <label for="date_of_closing" class="control-label lablewidth">Test Date: </label>
                                              <div class="form-control controls input-append date form_datetime datefldset" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                                                  <input size="16" type="text" value="" readonly class="inputfield" >
                                                  <span class="add-on"><i class="icon-remove"></i></span>
                                                  <span class="add-on"><i class="icon-th"></i></span>
                                              </div>
                                              <input type="hidden" name="test_date" id="dtp_input1" value="" /><br/>
                                          </div>
                                          </div>
                                        </div> -->
                                         
                                        <!--  <div class="row text-center">
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
                                        </div> -->
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
                          </td>
                          <td><?php echo $interview->rollnumber.'-'.$rolnumberFormat;?></td>
                          <td><?php echo $interview->email;?></td>
                          <td><?php echo $interview->city_id; ?></td>
                          <td><?php echo $interview->interview_date; ?></td>
                          <!-- <td><?php echo $interview->user_id; ?></td> -->
                          <td><?php //echo $interview->status; ?>Active</td>
                          <td><?php echo $interview->sdt; ?></td>

                                   
                         
                      </tr>
        <?php } ?>               
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              
            </div>
            <div class="col-md-4">
              <div class="tabelSideListing text-center">
                <!-- <a href="#"><img src="assets/img/single-arrow-left.png" alt=""></a>
                <span>1</span>
                to
                <span>7</span>
                <a href="#"><img src="assets/img/single-arrow-right.png" alt=""></a> -->
              </div>
            </div>
            <div class="col-md-4">
              
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mainTableWhite">
          <div class="row">
            <div class="col-md-7">
              <div class="tabelHeading">
                <h3>Job Application List <span>(Short List)</span></h3>
              </div>
            </div>
            <div class="col-md-5">
              <div class="tabelTopBtn">
                <button class="btn">
                  <img src="assets/img/plus.png" alt=""> 
                  Create Job Recuritment
                </button>
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
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>D.O.B</th>
                        <th>CNIC</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          Noman Ansari
                        </td>
                        <td>
                          Ilyas Ansari
                        </td>
                        <td>
                          1978-19-06
                        </td>
                        <td>
                          154684-1547896-8
                        </td>
                      </tr>
                       
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              
            </div>
            <div class="col-md-4">
              <div class="tabelSideListing text-center">
                <a href="#"><img src="assets/img/single-arrow-left.png" alt=""></a>
                <span>1</span>
                to
                <span>7</span>
                <a href="#"><img src="assets/img/single-arrow-right.png" alt=""></a>
              </div>
            </div>
            <div class="col-md-4">
              
            </div>
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
            <h3>Job Recuritment List <span>(In Progress)</span></h3>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tabelTopBtn">
            <button class="btn">
              <img src="assets/img/plus.png" alt=""> 
              Create Job Recuritment
            </button>
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
                    <th>Job title</th>
                    <th>advertise date</th>
                    <th>submission date</th>
                    <th>recuirtment type</th>
                    <th>required position</th>
                    <th>total position</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      CBV-CW-Balochistan-QUETTA
                    </td>
                    <td>
                      2019-19-03
                    </td>
                    <td>
                      2019-19-06
                    </td>
                    <td>
                      Reserved Only
                    </td>
                    <td>
                      1
                    </td>
                    <td>
                      2
                    </td>
                    <td class="action">
                      <a href="#"><img src="assets/img/pencile.png" alt=""></a>
                      <a href="#"><img src="assets/img/trash.png" alt=""></a>
                    </td>
                  </tr>
                   
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="tabelSideListing">
            <a href="#"><img src="assets/img/single-arrow-left.png" alt=""></a>
            <span>1</span>
            to
            <span>6</span>
            <a href="#"><img src="assets/img/single-arrow-right.png" alt=""></a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="tabelCenterListing">
            <a href="#" class="arrowIcons">
              <img src="assets/img/arrow-left.png" alt="">
            </a>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#" class="arrowIcons">
              <img src="assets/img/arrow-right.png" alt="">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</section>


  
<?php } ?>

  

 
  
