<?php $rolnumberFormat = 'CTC-ORG-PK'; ?>
<section class="secMainWidthFilter" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable margint-top-0">
    <section class="secIndexTable">
      <div class="col-lg-2 no-leftPad">
        <div class="main-leftFilter">
          <div class="tabelHeading">
            <h3>Search Interviews <a data-toggle="tooltip" title="Click to refresh" data-placement="right" onclick="document.location.reload(true);" class="fa fa-refresh"></a></h3>
          </div>
          <div class="selectBoxMain">
            <form method="get" action="<?= base_url('interview/search_scheduled'); ?>">
              <div class="filterSelect">
                <input type="text" name="rollno" class="form-control" placeholder="Roll Number">
                <span></span>
              </div>
              <div class="filterSelect">
                <input type="text" name="name" class="form-control" placeholder="Applicant's Name">
                <span></span>
              </div>
              <div class="filterSelect">
                <input type="text" name="project" class="form-control" placeholder="Project's Name">
              </div>
              <div class="filterSelect">
                <input type="text" name="designation" class="form-control" placeholder="Designation's Name">
              </div>
              <div class="filterSelect">
                <input type="text" name="province" class="form-control" placeholder="Province">
              </div>
              <div class="filterSelect">
                <input type="text" name="district" class="form-control" placeholder="District">
              </div>
              <div class="filterSelectBtn">
                <button data-toggle="tooltip" title="Click to search" data-placement="right" type="submit" class="btn btnSubmit">Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-10">
        <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-8">
            <div class="tabelHeading">
              <?php if(empty($search_results)): ?>
              <h3>list of scheduled interviews<br>
                <small>
                  <div class="label label-info">
                    list of all scheduled interviews, in case if someone misses interview, can be re-scheduled &hellip;
                  </div>
                </small>
              </h3>
              <?php else: ?>
                <h3>search results</h3>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tabelTopBtn">
              <div class="input-group-btn">
                <a data-toggle="tooltip" title="Go Back" data-placement="left" class="btn btn-defaul" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tableMain">
              <div class="table-responsive">
                <?php if(!empty($all_scheduled)): ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Roll No.</th>
                      <th>name</th>
                      <th>detail</th>
                      <th>action</th>
                      <th>project</th>
                      <th>designation</th>
                      <th>province</th>
                      <th>district</th>
                      <th>interview date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_scheduled as $scheduled): ?>
                    <?php $userDetails = $this->Interview_model->applicantdetails($scheduled->rollnumber); ?>
                    <tr>
                      <td><?= $scheduled->rollnumber.'-'.$rolnumberFormat; ?></td>
                      <td><?= $scheduled->fullname; ?></td>
                      <td>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalviewDetail<?= $scheduled->rollnumber; ?>" style="display: block;">View Detail</button>
                        <div class="modal fade" id="modalviewDetail<?= $scheduled->rollnumber; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                          $interviewresult = $this->Interview_model->interview_result_exists('interview_result','rollnumber',$scheduled->rollnumber); 
                          if($interviewresult==0){ 
                            echo '<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#assigninterview'.$scheduled->rollnumber.'" style="display: block;">Add Result</button>';
                          }else{ 
                           // echo '<button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span> Interview Result</button>';
                          //}
                          $checkinterviewresult = $this->job_longlisted_model->interview__result_exists('interview_result','rollnumber',$scheduled->rollnumber); 
                          if($checkinterviewresult==0){ // aghr interview result nhe dia to zero condition ma serf tab show ho jay
                             echo '<button type="button" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-ok"></span> Interview</button>';
                            }else{ $interviewmarks = $this->job_longlisted_model->interview_result_byjobId($scheduled->rollnumber); foreach ($interviewmarks as $intr){  $interviewPM = $intr->obtain_marks*100/$intr->total_marks; }
                             echo '<button type="button" class="btn btn-success btn-xs" >'.round($interviewPM).'%'.'</button>';
                            }
                          }
                        ?>
                        <div class="modal fade" id="assigninterview<?php echo $scheduled->rollnumber; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <input type="hidden" name="rollnumber" value="<?php echo $scheduled->rollnumber;?>">
                            <br>
                              <div class="row">
                                <div class="form-group">
                                  <div class="col-lg-4">
                                    <label for="date_of_closing" class="control-label lablewidth">Roll Number: </label>
                                  </div>
                                  <div class="col-lg-8">
                                    <input type="text" value="CTC-<?php echo $scheduled->rollnumber;?>" class="form-control" readonly="readonly">
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
                                  <input type="text" name="communication" value="10" class="form-control">
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
                                  <input type="text" name="experience" value="10" class="form-control">
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
                                    <input type="text" name="aptitude" value="10" class="form-control">
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
                                    <input type="text" name="personality" value="10" class="form-control">
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
                                    <input type="text" name="language" value="10" class="form-control">
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
                                    <input type="text" name="education" value="10" class="form-control">
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
                                    <input type="text" name="general_knowledge" value="10" class="form-control">
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
                                    <input type="text" name="total_marks" value="70" class="form-control">
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
                                    <textarea name="comments" class="form-control" rows="5" placeholder="Additional info, comments about the candidate."></textarea>
                                  </div>
                                </div>
                              </div>
                            <br>
                             <div class="row">
                              <div class="col-lg-8 col-lg-offset-4">
                                <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?></button>
                                <button type="button" class="btn btn-warning reset">Cancel</button>
                                <br><br>
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
                      <td><?= $scheduled->compName; ?></td>
                      <td><?= $scheduled->designation_name; ?></td>
                      <td><?= $scheduled->provName; ?></td>
                      <td><?= $scheduled->cityName; ?></td>
                      <td><?= date('l, M jS, Y', strtotime($scheduled->interview_date)); ?></td>
                    </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 text-center">
            <?php echo $this->pagination->create_links(); ?>
          </div>
          <div class="col-md-2"></div>
        </div>
        <?php elseif(!empty($search_results)): ?>
          <div class="row">
            <div class="col-md-12">
              <div class="tableMain">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Roll No.</th>
                        <th>name</th>
                        <th>detail</th>
                        <th>action</th>
                        <th>project</th>
                        <th>designation</th>
                        <th>province</th>
                        <th>district</th>
                        <th>interview date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($search_results as $result): ?>
                      <?php $userDetails = $this->Interview_model->applicantdetails($result->rollnumber); ?>
                      <tr>
                        <td><?= $result->rollnumber.'-'.$rolnumberFormat; ?></td>
                        <td><?= $result->fullname; ?></td>
                        <td>
                          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalviewDetail<?= $result->rollnumber; ?>" style="display: block;">View Detail</button>
                            <div class="modal fade" id="modalviewDetail<?= $result->rollnumber; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            $interviewresult = $this->Interview_model->interview_result_exists('interview_result','rollnumber',$result->rollnumber); 
                            if($interviewresult==0){ 
                              echo '<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#assigninterview'.$result->rollnumber.'" style="display: block;">Add Result</button>';
                            }else{
                            $checkinterviewresult = $this->job_longlisted_model->interview__result_exists('interview_result','rollnumber',$result->rollnumber); 
                            if($checkinterviewresult==0){ // aghr interview result nhe dia to zero condition ma serf tab show ho jay
                               echo '<button type="button" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-ok"></span> Interview</button>';
                              }else{ $interviewmarks = $this->job_longlisted_model->interview_result_byjobId($result->rollnumber); foreach ($interviewmarks as $intr){  $interviewPM = $intr->obtain_marks*100/$intr->total_marks; }
                               echo '<button type="button" class="btn btn-success btn-xs" >'.round($interviewPM).'%'.'</button>';
                              }
                            }
                          ?>
                          <div class="modal fade" id="assigninterview<?php echo $result->rollnumber; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <input type="hidden" name="rollnumber" value="<?php echo $result->rollnumber;?>">
                              <br>
                                <div class="row">
                                  <div class="form-group">
                                    <div class="col-lg-4">
                                      <label for="date_of_closing" class="control-label lablewidth">Roll Number: </label>
                                    </div>
                                    <div class="col-lg-8">
                                      <input type="text" value="CTC-<?php echo $result->rollnumber;?>" class="form-control" readonly="readonly">
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
                                    <input type="text" name="communication" value="10" class="form-control">
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
                                    <input type="text" name="experience" value="10" class="form-control">
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
                                      <input type="text" name="aptitude" value="10" class="form-control">
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
                                      <input type="text" name="personality" value="10" class="form-control">
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
                                      <input type="text" name="language" value="10" class="form-control">
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
                                      <input type="text" name="education" value="10" class="form-control">
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
                                      <input type="text" name="general_knowledge" value="10" class="form-control">
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
                                      <input type="text" name="total_marks" value="70" class="form-control">
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
                                      <textarea name="comments" class="form-control" rows="5" placeholder="Additional info, comments about the candidate."></textarea>
                                    </div>
                                  </div>
                                </div>
                              <br>
                               <div class="row">
                                <div class="col-lg-8 col-lg-offset-4">
                                  <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?></button>
                                  <button type="button" class="btn btn-warning reset">Cancel</button>
                                  <br><br>
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
                        <td><?= $result->compName; ?></td>
                        <td><?= $result->designation_name; ?></td>
                        <td><?= $result->provName; ?></td>
                        <td><?= $result->cityName; ?></td>
                        <td><?= date('l, M jS, Y', strtotime($result->interview_date)); ?></td>
                      </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php else: ?>
        <div class="alert alert-danger text-center">
          <p><strong>Oops ! </strong>No match found according to your search keyword !</p>
        </div>
      <?php endif; ?>
      </div>
      </div>
    </section>
  </section>
</section>