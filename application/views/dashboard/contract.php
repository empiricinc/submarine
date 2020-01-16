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
#activate{
  color: red;
}
#activated{
  color: #ffac43;
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
<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndex">
      <div class="row">
        <div class="col-md-12">
          <div class="headingMain">
            <h1>
              Contract Management Dashboard | <small><a href="<?php echo base_url('contract/contract_setup'); ?>"><i class="fa fa-plus"></i> Templates</a></small>
            </h1>
          </div>
        </div>
      </div>
  </section>
  <section class="secIndexTable">
    <form action="<?php echo base_url('contract/activate_all_contracts'); ?>" method="post">
      <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-7">
            <div class="tabelHeading">
              <?php $count = $this->Contract_model->count_contracts(); ?>
                <a href="<?= base_url('contract/pending_contracts'); ?>"><h3>contract list <span>( <?= $count; ?>, pending ) </span>
                  <small style="text-transform: lowercase;">You can't print contract unless and until you activate it.</small>
                </h3></a>
            </div>
          </div>
          <div class="col-md-3 text-right" id="printBtn" style="font-size: 30px; margin-top: 8px; display: block;">
            <button data-toggle="tooltip" title="Activate Multiple contracts." type="submit" name="activate_bulk" class="btn btn-primary"><i class="fa fa-arrow-right"></i></button>
            <button data-toggle="tooltip" title="Generate Contracts" type="submit" name="generate_bulk" class="btn btn-info">Generate</button>
            <button data-toggle="tooltip" title="Print all Contracts" type="submit" name="print_bulk" class="btn btn-primary"><i class="fa fa-print"></i></button>
          </div>
            <div class="col-md-2 text-right">
              <div class="tabelTopBtn">
                <a href="<?= base_url('contract/pending_contracts'); ?>" class="btn">View All Pending</a>
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
                      <th><input type="checkbox" id="checkAll"></th>
                      <th>emp iD</th>
                      <th>name</th>
                      <th>project</th>
                      <th>designation</th>
                      <th>province</th>
                      <th>district</th>
                      <th>domicile</th>
                      <th>gender</th>
                      <th>type</th>
                      <th>history</th>
                      <th>application date</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; //if($sl3['accessLevel3']){ // IF condition for Access Levels.
                      $check_copies = $this->db->select('employee_id')->from('xin_employees')->where('employee_id IN(SELECT emp_id FROM employee_contract_files)')->get()->result();
                      foreach ($pending_contracts as $contract){
                      $i++;
                      $userDetails = $this->Contract_model->applicantdetails($contract->user_id);
                      if($contract->status == 0){
                    ?>
                    <?php if($contract->user_id): ?>
                      <tr>
                        <td>
                            <input type="checkbox" name="print[]" style="display: block;" value="<?php echo $contract->user_id; ?>">
                        </td>
                        <td>
                          <?php echo $contract->compName.'-'.$contract->designation_name.'-'.$contract->user_id; ?>
                        </td>
                        <td>
                          <?php echo $contract->fullname; ?>
                        </td>
                        <td>
                          <?php echo $contract->compName; ?>
                        </td>
                        <td>
                          <?php echo $contract->designation_name; ?>
                        </td>
                        <td>
                          <?php echo $contract->name; ?>
                        </td>
                        <td>
                          <?php echo $contract->city_name; ?>
                        </td>
                        <td>
                          <?php echo $contract->dom_name; ?>
                        </td>
                        <td>
                          <?php if($contract->gender == 0){ echo 'Male'; }else{ echo 'Female'; } ?>
                        </td>
                        <td>
                          <?php echo $contract->cont_type; ?>
                        </td>
                        <td>
                          <?php $history = $this->Contract_model->contract_history($contract->user_id); ?>
                          <a data-toggle="modal" data-target="#view_history<?php echo $contract->user_id; ?>" href="#" class="btn btn-primary btn-xs">History</a>
                            <div class="modal fade" id="view_history<?php echo $contract->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="view_history" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <!--Header-->
                                  <div class="modal-header">
                                    <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Applicant's Contract history... </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <!--Body-->
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <strong>Applicant's contract history for: <?php echo ucwords($contract->fullname); ?></strong>
                                        <div class="table">
                                          <table class="table table-hover">
                                            <thead>
                                              <tr>
                                                <th>Serial</th>
                                                <th>Emp ID</th>
                                                <th>Contract Type</th>
                                                <th>Date From</th>
                                                <th>Date To</th>
                                                <th>Action</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <?php $counter = 1; foreach($history as $hist): ?>
                                              <tr>
                                                <td><?php echo $counter++; ?></td>
                                                <td><?= $contract->compName.'-'.$contract->designation_name.'-'.$hist->user_id; ?></td>
                                                <td><?= $hist->name; ?></td>
                                                <td><?= date('M d, Y', strtotime($hist->from_date));?></td>
                                                <td><?= date('M d, Y', strtotime($hist->to_date));?></td>
                                                <td><a href="<?php echo base_url("contract/view_previous/{$hist->id}"); ?>" class="btn btn-primary btn-sm">View</a></td>
                                              </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
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
                          <?php echo date('M d, Y', strtotime($contract->created_at)); ?>
                        </td>
                        <td id="allChecked">
                        <?php
                          if($contract->status == 0): ?>
                            <a data-toggle="tooltip" title="Create new contract or make changes in the existing one." href="<?= base_url(); ?>contract/create_contract/<?= $contract->user_id; ?>"><i class="fa fa-plus-circle"></i></a>
                            <a data-toggle="tooltip" data-placement="left" title="Upload scanned copies of contract to verify it." href="<?= base_url(); ?>contract/verify/<?= $contract->user_id; ?>">
                              <i class="fa fa-check-circle"></i></a>
                            <a data-toggle="tooltip" data-placement="left" title="Activate Contract, the RED color indicates that it's not activated yet. If activated, it'll be disappeared from here." href="<?php if($contract->long_description === NULL){ echo base_url('contract/activate_first'); if($check_copies == false){ echo base_url('contract/verify_first'); } }else{ echo base_url() ?>contract/activatecontract/<?= $contract->user_id; } ?>" onclick="javascript:return confirm('Are you sure to activate the contract ?');"><i class="fa fa-arrow-circle-right" id=<?php if($contract->long_description == NULL): ?>"activate"<?php  else: ?>id="activated"<?php endif; ?>></i></a>
                            <a data-toggle="tooltip" data-placement="left" title="Reject contract. The reject operation can't be reverted." href="<?php echo base_url("contract/reject/{$contract->user_id}"); ?>" onclick="javascript: return confirm('Are you sure to reject this contract ?');">
                              <i class="fa fa-close"></i>
                            </a>
                         <?php else: ?>
                            Contract Activated
                         <?php endif; ?>                  
                        </td>
                      </tr>
                    <?php endif; ?>
                    <?php } } //} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8 text-center">
            <?php echo $this->pagination->create_links(); ?>
          </div>
          <div class="col-lg-2"></div>
        </div>
      </div>
    </form>
  </section>
  <section class="secIndexTable margint-top-0">
    <div class="row">
      <div class="col-md-6">
        <div class="mainTableWhite">
          <div class="row">
            <div class="col-md-9">
              <div class="tabelHeading">
                <h3>contracts active</h3>
              </div>
            </div>
            <div class="col-md-3">
              <div class="tabelTopBtn">
                <a href="<?= base_url('contract/all_active'); ?>" class="btn">View All</a>
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tableMain">
              <div class="table-responsive">
                <table class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th>emp iD</th>
                      <th>Detail</th>
                      <th>name</th>
                      <th>project</th>
                      <th>designation</th>
                      <th>till</th>
                      <!-- <th>type</th> -->
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; //if($sl3['accessLevel3']){ // IF condition for Access Level.
                    foreach ($all_contract as $contract){
                    $i++;
                    $userDetails = $this->Contract_model->applicantdetails($contract->user_id);
                      if($contract->status == 1 OR $contract->status == 2 OR $contract->status == 3 OR $contract->status == 4 AND strtotime($contract->to_date) > time()){
                    ?>
                    <tr>
                      <td><!-- Project name and user_id will create Employee ID. -->
                        CTC-<?php echo $contract->name.'-'.$contract->user_id; ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalviewDetail<?php echo $i; ?>">View Contract</button>
                          <div class="modal fade" id="modalviewDetail<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <!--Header-->
                                <div class="modal-header">
                                  <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Applicant's Contract Detail... </h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <!--Body-->
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-10 col-md-offset-1" id="printThis" style="font-family: book antiqua;">
                                      <!-- <h3 class="text-center"><strong>Description</strong></h3> -->
                                     <?php echo $contract->long_description; ?>
                                    </div>
                                  </div>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                  <!-- <?php //if($contract->status == 1): ?>
                                    <a target="blank" href="<?php //echo base_url(); ?>contract/print_contract/<?php //echo $contract->user_id; ?>" class="btn btn-primary">Print</a>
                                  <?php //endif; ?> -->
                                  <button onclick="printDiv('printThis');" class="btn btn-primary">Print</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </td>
                      <td>
                        <?php echo $contract->fullname;?>
                      </td>
                      <td>
                        <?php echo $contract->name;?>
                      </td>
                      <td>
                        <?php echo $contract->designation_name; ?>
                      </td>
                      <td>
                        <?php echo date('M d, Y', strtotime($contract->to_date)); ?>
                      </td>
                      <td>
                        <?php if($contract->status != 0): ?>
                          <button class="btn btn-success btn-xs">Active <i class="fa fa-check-circle"></i></button>
                            <?php else: ?>
                          <button class="btn btn-info btn-xs">Inactive</button>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php } } //} ?>
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
              <div class="col-md-6">
                  <div class="tabelHeading">
                    <h3>contracts to be expired</h3>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="tabelTopBtn">
                  <a data-toggle="modal" data-target="#extendContracts" href="#extendContracts" class="btn">Extend</a>
                  <a href="<?= base_url('contract/all_expired'); ?>" class="btn">View All</a>
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
                                <th><input type="checkbox" name="" id="extendBulkModal"></th>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Designation</th>
                                <th>Previous Contract Expiry</th>
                              </thead>
                              <tbody>
                                <?php foreach($expired_contracts as $employee): ?>
                                  <tr>
                                    <td><input type="checkbox" name="user_id" value="<?php echo $employee->user_id; ?>" class="modalCheckboxes"></td>
                                    <td><?php echo $employee->name.'-'.$employee->designation_name.'-'. $employee->user_id; ?></td>
                                    <td><?php echo $employee->first_name; ?></td>
                                    <td><?php echo $employee->designation_name; ?></td>
                                    <td><?php echo date('D, F jS, Y', strtotime($employee->to_date)); ?></td>
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
                    <table class="table">
                      <thead>
                        <tr>
                          <th><input type="checkbox" name="" id="extendMultiple"></th>
                          <th>emp iD</th>
                          <th>name</th>
                          <th>type</th>
                          <th>days left</th>
                          <th>actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php //if($sl3['accessLevel3']): // IF condition for Access Level. 
                          foreach($expired_contracts as $exp_cont): ?>
                        <?php
                          if($exp_cont->contract_type != 1 AND $exp_cont->status != 5 AND $exp_cont->status != 6):
                          $date1 = date_create(date('Y-m-d'));
                          $date2 = date_create(date('Y-m-d', strtotime($exp_cont->to_date))); 
                          $diff = date_diff($date1, $date2);
                        ?>
                        <tr>
                          <td><input type="checkbox" name="extendAll[]" value="<?php echo $exp_cont->user_id; ?>"></td>
                          <td>CTC-<?= $contract->name.'-'.$exp_cont->user_id; ?></td>
                          <td><?php echo $exp_cont->first_name; ?></td>
                          <td><?= $exp_cont->contType; ?></td>
                          <td>
                            <?php if($date2 > $date1): ?>
                            <?php echo $diff->format("%a day(s) left"); elseif($date2 <= $date1): echo '<button data-toggle="tooltip" title='.$diff->format('"%mm %dd ago."').' class="btn btn-warning btn-xs">Expired</button>'; endif; ?>
                          </td>
                          <td>
                            <a data-toggle="tooltip" title="<?php echo date('M d, Y', strtotime($exp_cont->from_date)).' - '.date('M d, Y', strtotime($exp_cont->to_date)); ?>" href="<?= base_url(); ?>contract/extend/<?= $exp_cont->user_id; ?>" class="btn btn-primary btn-xs">Extend</a>
                            <a data-toggle="modal" data-target="#finishModal<?= $exp_cont->user_id; ?>" href="#finishContract" class="btn btn-danger btn-xs">Finish</a>
                            <!-- Finish contract modal starts. -->
                            <div class="modal fade" id="finishModal<?php echo $exp_cont->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                      <input type="hidden" name="id" value="<?= $exp_cont->user_id; ?>">
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
                          <?php endif; endforeach; //endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
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
            <h3>contracts finished / rejected</h3>
          </div>
        </div>
        <div class="col-md-6 text-right">
          <div class="tabelTopBtn">
            <a href="<?= base_url('contract/all_rejected'); ?>" class="btn">View All</a>
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
                    <th>emp iD</th>
                    <th>name</th>
                    <th>project</th>
                    <th>designation</th>
                    <th>location</th>
                    <th>contract type</th>
                    <th>status</th>
                    <th>rejection reason / finish date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php //if($sl3['accessLevel3']): // IF condition for Access Level.
                   foreach($rejected_contracts as $cont): ?>
                    <?php if(strtotime($cont->to_date) < time() AND $cont->status == 5 OR $cont->status == 6 AND $cont->contract_type != 1): ?>
                  <tr>
                    <td>
                      CTC-<?php echo $cont->user_id; ?>
                    </td>
                    <td>
                      <?php echo $cont->fullname; ?>
                    </td>
                    <td>
                      <?php echo $cont->name; ?>
                    </td>
                    <td>
                      <?php echo $cont->designation_name; ?>
                    </td>
                    <td>
                      <?php echo $cont->provName; ?>
                    </td>
                    <td>
                      <?php echo 'N/A'; ?>
                    </td>
                    <td>
                      <?php if($cont->status == 5): ?>
                        <button data-toggle="modal" data-target="#finishReason<?= $cont->user_id; ?>" class="btn btn-warning btn-xs">Finished</button>
                        <div class="modal fade" id="finishReason<?= $cont->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!--Header-->
                              <div class="modal-header">
                                <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Reason to finishing contract...</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <!--Body-->
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6 col-md-offset-3 text-center">
                                    <p><?php echo $cont->rejection_reason; ?></p>
                                  </div>
                                </div>
                              </div>
                              <!--Footer-->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php elseif($cont->status == 6): ?>
                        <button class="btn btn-danger btn-xs">Rejected</button>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if($cont->status == 6): ?>
                      <a data-toggle="modal" data-target="#reason<?= $cont->user_id; ?>" href="#reason"><?php echo substr($cont->rejection_reason, 0, 15).'...'; ?></a>
                      <div class="modal fade" id="reason<?= $cont->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <!--Header-->
                            <div class="modal-header">
                              <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Rejection Reason... </h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <!--Body-->
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6 col-md-offset-3 text-center">
                                  <p><?php echo $cont->rejection_reason; ?></p>
                                </div>
                              </div>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php else: ?>
                        <?php echo date('M d, Y', strtotime($cont->to_date)); ?>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endif; endforeach; //endif; ?>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });
  // Check all checkboxes at once.
  $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
  $('#extendMultiple').click(function(){
    $("input:checkbox[name='extendAll[]']").not(this).prop('checked', this.checked);
  });
  $('#extendBulkModal').click(function(){
    $('input:checkbox[class="modalCheckboxes"]').not(this).prop('checked', this.checked);
  });
// Show and hide buttons for printing and activating contracts.
$(function () {
  $("#checkAll").click(function () {
    if ($(this).is(":checked")) {
      $("#printBtn").hide(1000, "linear");
      $("#printBtn").show(1000, "linear");
    } else {
      $("#printBtn").show(1000, "linear");
      $("#printBtn").hide(1000, "linear");
    }
  });
});
</script>
<script type="text/javascript">
  function printDiv(printThis){
    // var printContent = document.getElementById(printThis).innerHTML;
    // var originalContent = document.body.innerHTML;
    // document.body.innerHTML = printContent;
    // window.print();
    // document.body.innerHTML = originalContent;

    var content = document.getElementById('printThis').innerHTML;
    var win = window.open();
    win.document.write(content);
    win.document.body.style.fontFamily="book antiqua";  
    // win.document.body.status.fontSize="14px";
    win.print();
    win.close();
  }
</script>