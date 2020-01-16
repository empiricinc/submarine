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
$messageactive = $this->session->flashdata('messageactive');
if ($messageactive) {
                  echo $messageactive = '<div class="alert alert-success text-center"><strong>Woohoo !</strong> '.$messageactive.' </div>';
}
$finished = $this->session->flashdata('finished');
if($finished){
  echo $finished = '<div class="alert alert-success text-center"><strong>Woohoo !</strong>'.$finished.'</div>';
}
?>
<style type="text/css">
.ui-datepicker {
    display: block;
}
.form-control.ddfield {
    height: 36px !important;
    width: 300px;
    border: 1px solid #ccc;
}
.inputfield {
    width: 300px;
    margin-top: -6px;
    padding: 10px;
    line-height: 1rem;
    background-color: #f6f7f8;
    border: 1px solid #e1e4e7;
}
.datefldset {
    background: none !important;
    border: 0px !important;
}
.lablewidth {
    width: 180px;
    text-align: right;
    font-size: 15px;
}
</style>
<style type="text/css">
.breadcrumb.no-bg {
    display: none;
}
h4 {
    display: none;
}
</style>
<script type="text/javascript">
  $(document).ready(function() {
      $('#contact_list1').DataTable();
  });
  $(document).ready(function() {
      $('#contact_list2').DataTable();
  });
   $(document).ready(function(){
    $('.date').ui-datepicker();
  });
</script>
<div class="row">
  <section class="secMainWidthFilter">
    <section class="secIndexTable margint-top-0">
      <div class="col-lg-2 no-leftPad">
        <div class="main-leftFilter">
          <div class="tabelHeading">
            <h3>Search Contracts <a data-toggle="tooltip" title="Click to refresh" data-placement="right" onclick="document.location.reload(true);" class="fa fa-refresh"></a></h3>
          </div>
          <div class="selectBoxMain">
            <form method="post" action="<?= base_url('contract/search_expiring_contracts'); ?>">
              <div class="filterSelect">
                <input type="text" name="applicant_name" class="form-control" placeholder="Applicant name">
                <span></span>
              </div>
              <div class="filterSelect">
                <select class="form-control" name="project">
                  <option value="">Select project...</option>
                  <?php foreach($projects as $project): ?>
                    <option value="<?php echo $project->name; ?>">
                      <?php echo $project->name; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <span></span>
              </div>
              <div class="filterSelect">
                <select class="form-control" name="designation">
                  <option value="">Select designation...</option>
                  <?php foreach($designations as $designation): ?>
                    <option value="<?php echo $designation->designation_name; ?>">
                      <?php echo $designation->designation_name; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <span></span>
              </div>
              <div class="filterSelect">
                <select class="form-control" name="province">
                  <option value="">Select province...</option>
                  <?php foreach($provinces as $province): ?>
                    <option value="<?php $province->name; ?>">
                      <?php echo $province->name; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <span></span>
              </div>
              <div class="filterSelect">
                <input type="date" name="from_date" class="form-control" placeholder="From" autocomplete="off">
              </div>
              <div class="filterSelect">
                <input type="date" name="to_date" class="form-control" placeholder="To" autocomplete="off">
              </div>
              <div class="filterSelectBtn">
                <button data-toggle="tooltip" title="Click to search" data-placement="right" type="submit" class="btn btnSubmit">Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </section>
  <div class="col-lg-10">
    <section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
      <section class="secIndexTable">
          <div class="mainTableWhite">
              <div class="row">
                <div class="col-md-10"><br>
                  <div class="tabelHeading">
                      <h3><?php if(empty($search_results)): ?>list of contracts to be expired<?php else: ?>search results<?php endif; ?> | <small><a href="javascript:history.go(-1);"><div class="label label-primary">back</div></a></small></h3>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="tabelHeading">
                    <div class="tabelTopBtn">
                      <a data-toggle="modal" data-target="#extendContracts" href="#extendContracts" class="btn">Extend</a>
                    </div>
                  </div>
                </div>
                 <!--Extend contract modal starts. -->
                <div class="modal fade" id="extendContracts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <!--Header-->
                      <div class="modal-header">
                        <h4 style="display: inline;">Select employees who you wanna extend contracts for, enter dates and hit <strong>Submit</strong> button in the bottom.</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <!--Body-->
                      <div class="modal-body">
                        <form action="<?= base_url('contract/extend_all'); ?>" method="post">
                          <div class="row">
                            <div class="col-md-12">
                              <table class="table table-hover">
                                <thead>
                                  <th><input type="checkbox" name="" id="extendBulkModal" onclick="selectAllModal();"></th>
                                  <th>Employee ID</th>
                                  <th>Employee Name</th>
                                  <th>Designation</th>
                                  <th>Previous Contract Expiry</th>
                                </thead>
                                <tbody>
                                  <?php foreach($expired_contracts as $expired): ?>
                                    <tr>
                                      <td><input type="checkbox" name="user_id[]" value="<?php echo $expired->user_id; ?>" class="modalExtend"></td>
                                      <td><?php echo $expired->name.'-'.$expired->designation_name.'-'. $expired->user_id; ?></td>
                                      <td><?php echo $expired->first_name; ?></td>
                                      <td><?php echo $expired->designation_name; ?></td>
                                      <td><?php echo date('D, F jS, Y', strtotime($expired->to_date)); ?></td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <label>Date From</label>
                              <input type="text" name="date_from" class="form-control date" autocomplete="off" placeholder="Starting date">
                            </div>
                            <div class="col-md-6">
                              <label>Date To</label>
                              <input type="text" name="date_to" class="form-control date" autocomplete="off" placeholder="Ending date">
                            </div>
                          </div><br>
                          <div class="row">
                            <div class="col-md-6 text-left">
                              <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Submit">
                              <input type="reset" name="reset" class="btn btn-warning btn-sm" value="Reset">
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
                <!-- Extend contract modal ends. -->
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="tableMain">
                      <div class="table-responsive">
                        <table class="table table-condensed">
                          <thead>
                              <tr>
                                <th><input type="checkbox" name="" id="extendMultiple" onclick="selectAll();"></th>
                                <th>employee iD</th>
                                <th>name</th>
                                <th>project</th>
                                <th>designation</th>
                                <th>province</th>
                                <th>district</th>
                                <th>type</th>
                                <th>days left</th>
                                <th>status</th>
                                <th>actions</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php if(!empty($expired_contracts)): foreach($expired_contracts as $exp_cont): ?>
                          <?php
                            if($exp_cont->contract_type != 1 AND $exp_cont->status != 5 AND $exp_cont->status != 6):
                            $date1=date_create(date('Y-m-d'));
                            $date2=date_create(date('Y-m-d', strtotime($exp_cont->to_date)));
                            $diff=date_diff($date1, $date2);
                          ?>
                          <tr>
                            <td><input type="checkbox" name="extendAll[]" value="<?php echo $exp_cont->user_id; ?>" class="checkAll"></td>
                            <td><?= $exp_cont->name.'-'.$exp_cont->designation_name.'-'. $exp_cont->user_id; ?></td>
                            <td><?= $exp_cont->first_name.' '.$exp_cont->last_name; ?></td>
                            <td><?= $exp_cont->name; ?></td>
                            <td><?= $exp_cont->designation_name; ?></td>
                            <td><?= $exp_cont->provName; ?></td>
                            <td><?= $exp_cont->distName; ?></td>
                            <td><?= $exp_cont->contType; ?></td>
                            <td>
                              <?php if($date2 > $date1): ?>
                              <?php echo $diff->format("%a day(s) left"); elseif($date2 <= $date1): echo '<button data-toggle="tooltip" title='.$diff->format('"%mm %dd ago."').' class="btn btn-warning btn-xs">Expired</button>'; endif; ?>
                            </td>
                            <td>
                              <?php if($exp_cont->status == 1): ?>
                                <button class="btn btn-success btn-xs">Active</button>
                              <?php elseif($exp_cont->status == 2): ?>
                                <button class="btn btn-info btn-xs">Printed</button>
                              <?php elseif($exp_cont->status == 3): ?>
                                <button class="btn btn-info btn-xs">Distributed</button>
                              <?php elseif($exp_cont->status == 4): ?>
                                <button class="btn btn-info btn-xs">Attached</button>
                              <?php elseif($exp_cont->status == 5): ?>
                                <button class="btn btn-info btn-xs">Finished</button>
                              <?php endif; ?>
                            </td>
                            <td>
                              <a data-toggle="tooltip" title="<?= date('M d, Y', strtotime($exp_cont->from_date)).' - '.date('M d, Y', strtotime($exp_cont->to_date)); ?>" href="<?= base_url(); ?>contract/extend/<?= $exp_cont->user_id; ?>" class="btn btn-primary btn-xs">Extend</a>
                              <a href="#finishContract" data-toggle="modal" data-target="#finishModal<?= $exp_cont->id; ?>" class="btn btn-danger btn-xs">Finish</a>
                              <!-- Finish contract modal starts. -->
                              <div class="modal fade" id="finishModal<?php echo $exp_cont->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <!--Header-->
                                    <div class="modal-header">
                                      <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Reason to Finish contract... </h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <!--Body-->
                                    <div class="modal-body">
                                      <form action="<?= base_url('contract/finish'); ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $exp_cont->id; ?>">
                                        <label for="reason">Reason to finish contract.</label>
                                        <textarea name="reason" class="form-control" rows="5" placeholder="Start typing here...."></textarea><br>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                        <input type="reset" name="reset" class="btn btn-warning" value="Reset">
                                      </form>
                                    </div>
                                    <!--Footer-->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <!-- Finish contract modal ends. -->
                            </td>
                          </tr>
                            <?php endif; endforeach; endif; ?>
                            <?php if(!empty($search_results)): foreach($search_results as $result): ?>
                          <?php
                            if($result->contract_type != 1 AND $result->status != 5 AND $result->status != 6):
                            $date1=date_create(date('Y-m-d'));
                            $date2=date_create(date('Y-m-d', strtotime($result->to_date)));
                            $diff=date_diff($date1, $date2);
                          ?>
                          <tr>
                            <td><input type="checkbox" name="extendAll[]" value="<?php echo $result->user_id; ?>"></td>
                            <td><?= $result->name.'-'.$result->designation_name.'-'. $result->user_id; ?></td>
                            <td><?= $result->first_name.' '.$result->last_name; ?></td>
                            <td><?= $result->name; ?></td>
                            <td><?= $result->designation_name; ?></td>
                            <td><?= $result->provName; ?></td>
                            <td><?= $result->distName; ?></td>
                            <td><?= $result->contType; ?></td>
                            <td>
                              <?php if($date2 > $date1): ?>
                              <?php echo $diff->format("%a day(s) left"); elseif($date2 <= $date1): echo '<button data-toggle="tooltip" title='.$diff->format('"%mm %dd ago."').' class="btn btn-warning btn-xs">Expired</button>'; endif; ?>
                            </td>
                            <td>
                              <?php if($result->status == 1): ?>
                                <button class="btn btn-success btn-xs">Active</button>
                              <?php elseif($result->status == 2): ?>
                                <button class="btn btn-info btn-xs">Printed</button>
                              <?php elseif($result->status == 3): ?>
                                <button class="btn btn-info btn-xs">Distributed</button>
                              <?php elseif($result->status == 4): ?>
                                <button class="btn btn-info btn-xs">Attached</button>
                              <?php elseif($result->status == 5): ?>
                                <button class="btn btn-info btn-xs">Finished</button>
                              <?php endif; ?>
                            </td>
                            <td>
                              <a data-toggle="tooltip" title="<?= date('M d, Y', strtotime($result->from_date)).' - '.date('M d, Y', strtotime($result->to_date)); ?>" href="<?= base_url(); ?>contract/extend/<?= $result->user_id; ?>" class="btn btn-primary btn-xs">Extend</a>
                              <a href="#finishContract" data-toggle="modal" data-target="#finishModal<?= $result->id; ?>" class="btn btn-danger btn-xs">Finish</a>
                              <!-- Finish contract modal starts. -->
                              <div class="modal fade" id="finishModal<?php echo $result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <!--Header-->
                                    <div class="modal-header">
                                      <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Reason to Finish contract... </h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                                    <!--Body-->
                                    <div class="modal-body">
                                      <form action="<?= base_url('contract/finish'); ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $result->id; ?>">
                                        <label for="reason">Reason to finish contract.</label>
                                        <textarea name="reason" class="form-control" rows="5" placeholder="Start typing here...."></textarea><br>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                        <input type="reset" name="reset" class="btn btn-warning" value="Reset">
                                      </form>
                                    </div>
                                    <!--Footer-->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <!-- Finish contract modal ends. -->
                            </td>
                          </tr>
                            <?php endif; endforeach; endif; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 text-center">
                  <?php if(!empty($expired_contracts) AND empty($search_results)){ echo $this->pagination->create_links(); } ?>
                </div>
                <div class="col-md-3"></div>
              </div>
          </div>
      </section>
    </section>
  </div>
</div>
<?php } ?>
<script type="text/javascript">
  function selectAll(){
    var blnChecked = document.getElementById("extendMultiple").checked;
    var check_invoices = document.getElementsByClassName("checkAll");
    var intLength = check_invoices.length;
    for(var i = 0; i < intLength; i++){
      var check_invoice = check_invoices[i];
      check_invoice.checked = blnChecked;
    }
  }
  // Check all in bootstrap modal.
  function selectAllModal(){
    var blnChecked = document.getElementById("extendBulkModal").checked;
    var check_invoices = document.getElementsByClassName("modalExtend");
    var intLength = check_invoices.length;
    for(var i = 0; i < intLength; i++){
      var check_invoice = check_invoices[i];
      check_invoice.checked = blnChecked;
    }
  }
</script>