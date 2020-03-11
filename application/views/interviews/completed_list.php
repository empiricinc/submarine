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
            <form method="get" action="<?= base_url('interview/search_completed'); ?>">
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
              <h3>list of completed interviews <br><small style="text-transform: lowercase;">the link on the name indicates that the interview's been conducted by one or two interviewers.</small></h3>
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
              <?php if(!empty($all_completed)): ?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Roll No.</th>
                      <th>name</th>
                      <th>project</th>
                      <th>designation</th>
                      <th>province</th>
                      <th>district</th>
                      <th>marks</th>
                      <th>interview date</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_completed as $completed): ?>
                    <?php $com_data = $this->Interview_model->applicantdetails($completed->rollnumber); ?>
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
                                   <?php foreach ($com_data as $row){ ?>
                                    <tr>
                                      <td>Full Name</td>
                                      <td><?php echo $row->fullname; ?></td> 
                                    </tr>
                                    <tr>
                                      <td>Email</td>
                                      <td><?php echo $row->email;?></td> 
                                    </tr>
                                    <tr>
                                      <td>Gender</td>
                                      <td><?php echo  $row->genderName; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Age</td>
                                      <td><?php echo  $row->age_name; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Education</td>
                                      <td><?php echo  $row->edu_name;; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Experience</td>
                                      <td><?php  echo  $row->minimum_experience;; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Province</td>
                                      <td><?php echo  $row->prov_name; ?></td>
                                    </tr>
                                    <tr>
                                      <td>District</td>
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
                                      <td>Result submission date</td>
                                      <td><?= date('M d, Y', strtotime($row->int_date)); ?></td>
                                    </tr>
                                    <tr>
                                      <td>Resume</td>
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
                        <?php if($completed->total_marks < 150): ?>
                          <a target="_blank" data-toggle="tooltip" title="Click to update interview result." href="<?php if($completed->designation_id == 12 OR $completed->designation_id == 13){ echo base_url("interview/form_sm/{$completed->rollnumber}"); }elseif($completed->designation_id == 5){ echo base_url("interview/form_dhcso/{$completed->rollnumber}"); }elseif($completed->designation_id == 8 OR $completed->designation_id == 14){ echo base_url("interview/form_fcm/{$completed->rollnumber}"); }else{ echo base_url("interview/form_dhcso/{$completed->rollnumber}"); } ?>"><?= $completed->fullname; ?></a>
                          <?php else: ?>
                            <?= $completed->fullname; ?>
                          <?php endif; ?>
                      </td>
                      <td><?= $completed->comp_name; ?></td>
                      <td><?= $completed->designation_name; ?></td>
                      <td><?= $completed->prov_name; ?></td>
                      <td><?= $completed->city_name; ?></td>
                      <td>
                        <button class="btn btn-success btn-xs">
                        <?= round($completed->obtain_marks/$completed->total_marks*100).'%'; ?>
                        </button>
                      </td>
                      <td><?= date('l, M jS, Y', strtotime($completed->sdt)); ?></td>
                      <td><a target="_blank" href="<?php if($completed->designation_id == 12 OR $completed->designation_id == 13){ echo base_url("interview/print_sheet_sm/{$completed->rollnumber}"); }elseif($completed->designation_id == 5){ echo base_url("interview/print_sheet_dhcso/{$completed->rollnumber}"); }elseif($completed->designation_id == 8 OR $completed->designation_id == 14){ echo base_url("interview/print_sheet_fcm/{$completed->rollnumber}"); }else{ echo base_url("interview/print_sheet_dhcso/{$completed->rollnumber}"); } ?>" class="btn btn-primary btn-xs"><i class="fa fa-print"></i></a></td>
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
                      <th>project</th>
                      <th>designation</th>
                      <th>province</th>
                      <th>district</th>
                      <th>marks</th>
                      <th>interview date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach($search_results as $result): ?>
                  <?php $com_data = $this->Interview_model->applicantdetails($result->rollnumber); ?>
                    <tr>
                      <td><a data-toggle="modal" data-target="#view_detail<?= $result->rollnumber; ?>" href="#detailModal"><?= $result->rollnumber.'-'.$rolnumberFormat; ?></a>
                        <div class="modal fade" id="view_detail<?= $result->rollnumber; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" tabindex="-1">
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
                                   <?php foreach ($com_data as $row){ ?>
                                    <tr>
                                      <td>Full Name</td>
                                      <td><?php echo $row->fullname; ?></td> 
                                    </tr>
                                    <tr>
                                      <td>Email </td>
                                      <td><?php echo $row->email;?></td> 
                                    </tr>
                                    <tr>
                                      <td>Gender </td>
                                      <td><?php echo  $row->genderName; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Age </td>
                                      <td><?php echo  $row->age_name; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Education </td>
                                      <td><?php echo  $row->edu_name;; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Experience </td>
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
                      <td>
                        <?php if($result->total_marks < 150): ?>
                          <a data-toggle="tooltip" title="Click to update interview result." href="<?php if($result->designation_id == 12 OR $result->designation_id == 13){ echo base_url("interview/form_sm/{$result->rollnumber}"); }elseif($result->designation_id == 5){ echo base_url("interview/form_dhcso/{$result->rollnumber}"); }elseif($result->designation_id == 8 OR $result->designation_id == 14){ echo base_url("interview/form_fcm/{$result->rollnumber}"); }else{ echo base_url("interview/form_dhcso/{$result->rollnumber}"); } ?>"><?= $result->fullname; ?></a>
                          <?php else: ?>
                            <?= $result->fullname; ?>
                          <?php endif; ?>
                      </td>
                      <td><?= $result->comp_name; ?></td>
                      <td><?= $result->designation_name; ?></td>
                      <td><?= $result->prov_name; ?></td>
                      <td><?= $result->city_name; ?></td>
                      <td>
                        <div class="label label-success" style="display: inline-block;">
                        <?= round($result->obtain_marks/$result->total_marks*100).'%'; ?>
                        </div>
                      </td>
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