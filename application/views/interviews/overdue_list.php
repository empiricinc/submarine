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
            <form method="get" action="<?= base_url('interview/search_overdue'); ?>">
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
                <button data-toggle="tooltip" title="Click to search" data-placement="right" type="submit" name="submit" class="btn btnSubmit">Search</button>
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
                <h3>list of overdue interviews<br>
                  <small style="text-transform: lowercase;">
                    <div class="label label-info">
                      overdue interviews can be re-scheduled &hellip;
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
                <?php if(!empty($all_overdue)): ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Roll No.</th>
                      <th>name</th>
                      <th>project</th>
                      <th>designation</th>
                      <th>province</th>
                      <th>district</th>
                      <th>interview date</th>
                      <th>actions | operations</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_overdue as $overdue): ?>
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
                                      <td><?= date('M d, Y', strtotime($row->assigned_date)) .', '.$diff->format('%a days passed.'); ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Resume </td>
                                      <td><a href="<?php echo base_url(); ?>uploads/resume/<?php echo  $row->job_resume; ?>" target="_blank">View Resume</a></td>
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
                      <td><?= date('l, M jS, Y', strtotime($overdue->sdt)); ?></td>
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
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 text-center">
            <?php echo $this->pagination->create_links(); ?>
          </div>
          <div class="col-md-2"></div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tableMain">
              <div class="table-responsive">
                <?php elseif(!empty($search_results)): ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Roll No.</th>
                      <th>name</th>
                      <th>project</th>
                      <th>designation</th>
                      <th>province</th>
                      <th>district</th>
                      <th>interview date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($search_results as $result): ?>
                    <?php $overdue_data = $this->Interview_model->applicantdetails($result->rollnumber); ?>
                    <tr>
                      <td>
                        <a data-toggle="modal" data-target="#overdue_detail<?= $result->rollnumber; ?>" href="#overdueModal"><?= $result->rollnumber.'-'.$rolnumberFormat; ?></a>
                        <div class="modal fade" id="overdue_detail<?= $result->rollnumber; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
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
                                      <td><?= date('M d, Y', strtotime($row->assigned_date)) .', '.$diff->format('%a days passed.'); ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Resume </td>
                                      <td><a href="<?php echo base_url(); ?>uploads/resume/<?php echo  $row->job_resume; ?>" target="_blank">View Resume</a></td>
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
                      <td><?= $result->fullname; ?></td>
                      <td><?= $result->compName; ?></td>
                      <td><?= $result->designation_name; ?></td>
                      <td><?= $result->provName; ?></td>
                      <td><?= $result->cityName; ?></td>
                      <td><?= date('l, M jS, Y', strtotime($result->sdt)); ?></td>
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