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
    display: none !important;
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
</style>
<script type="text/javascript">
  $(document).ready(function() {
      $('#contact_list1').DataTable();
  });
  $(document).ready(function() {
      $('#contact_list2').DataTable();
  });
</script>
<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndex">
      <div class="row">
        <div class="col-md-12">
          <div class="headingMain">
            <h1>
              Contract Management Dashboard
            </h1>
          </div>
        </div>
      </div>
  </section>
  <section class="secIndexTable">
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
        <div class="col-md-3 text-right" id="printBtn" style="font-size: 30px; margin-top: 8px; display: none;">
          <a data-toggle="tooltip" title="Activate all Contracts" href="<?= base_url('contract/activate_all_contracts'); ?>"><i class="fa fa-arrow-circle-right"></i></a>
          <a data-toggle="tooltip" title="Print all Contracts" target="blank" href="<?= base_url('contract/print_all_contracts'); ?>"><i class="fa fa-print"></i></a>
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
                    <th><input type="checkbox" name="checkPrint" id="checkAll"></th>
                    <th>emp iD</th>
                    <th>name</th>
                    <th>province</th>
                    <th>district</th>
                    <th>domicile</th>
                    <th>gender</th>
                    <th>email</th>
                    <th>message</th>
                    <th>status</th>
                    <th>application date</th>
                    <th>process date</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=0; if($sl3['accessLevel3']){ // IF condition for Access Levels.
                    foreach ($pending_contracts as $contract){
                    $i++;
                    $userDetails = $this->Contract_model->applicantdetails($contract->user_id);
                    if($contract->status == 0){
                  ?>
                  <tr>
                    <td>
                      <input type="checkbox" name="print" id="checkPrint" style="display: block;">
                    </td>
                    <td>
                      CTC-<?php echo '0'.$contract->user_id; ?>
                    </td>
                    <td>
                      <?php echo $contract->fullname; ?>
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
                      <?php echo $contract->gender_name; ?>
                    </td>
                    <td>
                      <?php echo $contract->email; ?>
                    </td>
                    <td>
                      <a data-toggle="modal" data-target="#message<?= $contract->application_id; ?>" href="#message">
                        <?php echo substr($contract->message, 0, 20).'...'; ?>
                      </a>
                      <div class="modal fade" id="message<?= $contract->application_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <!--Header-->
                                <div class="modal-header">
                                  <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Applicant's Message... </h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <!--Body-->
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-6 col-md-offset-3 text-center">
                                      <strong>Message Description</strong>
                                      <p><?php echo $contract->message; ?></p>
                                    </div>
                                  </div>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                  <?php if($contract->status == 1): ?>
                                    <a target="blank" href="<?= base_url(); ?>contract/print_contract/<?= $contract->user_id; ?>" class="btn btn-primary">Print</a>
                                  <?php endif; ?>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    </td>
                    <td align="center">
                      <?php if($contract->status == 0): ?>
                      <a data-toggle="tooltip" title="Pending" data-placement="top" href="<?= base_url('contract/pending_contracts'); ?>">
                        <i class="fa fa-spinner"></i>
                        <?php else: ?>
                        <div class="label label-danger">
                          Rejected
                        </div>
                      <?php endif; ?>
                      </a>
                    </td>
                    <td>
                      <?php echo date('M d, Y', strtotime($contract->created_at)); ?>
                    </td>
                    <td>
                      <?php echo date('M d, Y', strtotime($contract->sdt)); ?>
                    </td>
                    <td id="allChecked">
                    <?php
                      if($contract->status == 0): ?>
                        <a data-toggle="tooltip" title="Create new contract or make changes in the existing one." href="<?= base_url(); ?>contract/create_contract/<?= $contract->user_id; ?>"><i class="fa fa-plus-circle"></i></a>
                        <a data-toggle="tooltip" title="Upload scanned copies of contract to verify it." href="<?= base_url(); ?>contract/verify/<?= $contract->user_id; ?>">
                          <i class="fa fa-check-circle"></i></a>
                        <a data-toggle="tooltip" title="Activate Contract, the RED color indicates that it's not activated yet. If activated, it'll be disappeared from here." href="<?= base_url() ?>contract/activatecontract/<?= $contract->user_id; ?>" onclick="javascript:return confirm('Are you sure to activate the contract ?');"><i class="fa fa-arrow-circle-right" id="activate"></i></a>
                        <a data-toggle="modal" data-target="#rejectContract<?= $contract->user_id; ?>" href="#rejectModal">
                          <i class="fa fa-close"></i>
                        </a>
                        <!-- Reject Modal starts. -->
                        <div class="modal fade" id="rejectContract<?php echo $contract->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <form action="<?= base_url('contract/reject'); ?>" method="post">
                                  <input type="hidden" name="user_id" value="<?= $contract->user_id; ?>">
                                  <label for="reason">Rejection Reason</label>
                                  <textarea name="reason" class="form-control" rows="5" placeholder="Start typing here...." required=""></textarea><br>
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
                        <!-- Reject modal ends. -->
                     <?php else: ?>
                        Contract Activated
                     <?php endif; ?>                  
                    </td>
                  </tr>
                  <?php } } } ?>
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
                    <?php $i=0; if($sl3['accessLevel3']){ // IF condition for Access Level.
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
                            <div class="modal-dialog" role="document">
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
                                    <div class="col-md-10 col-md-offset-1">
                                      <h3 class="text-center"><strong>Description</strong></h3>
                                      <p><?php echo $contract->long_description; ?></p>
                                    </div>
                                  </div>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                  <?php if($contract->status == 1): ?>
                                    <a target="blank" href="<?= base_url(); ?>contract/print_contract/<?= $contract->user_id; ?>" class="btn btn-primary">Print</a>
                                  <?php endif; ?>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </td>
                      <td>
                        <?php echo $contract->first_name.' '.$contract->last_name;?>
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
                    <?php } } } ?>
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
                    <h3>contracts to be expired</h3>
                  </div>
              </div>
              <div class="col-md-5">
                <div class="tabelTopBtn">
                  <a href="<?= base_url('contract/all_expired'); ?>" class="btn">View All</a>
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
                          <th>type</th>
                          <th>days left</th>
                          <th>actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($sl3['accessLevel3']): // IF condition for Access Level. 
                          foreach($expired_contracts as $exp_cont): ?>
                        <?php
                          if($exp_cont->contract_type != 1 AND $exp_cont->status != 5 AND $exp_cont->status != 6):
                          $date1=date_create(date('Y-m-d'));
                          $date2=date_create(date('Y-m-d', strtotime($exp_cont->to_date)));
                          $diff=date_diff($date1, $date2);
                        ?>
                        <tr>
                          <td>CTC-<?= $contract->name.'-'.$exp_cont->user_id; ?></td>
                          <td><?= $exp_cont->name; ?></td>
                          <td>
                            <?php echo $diff->format("%a day(s)"); ?>
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
                          <?php endif; endforeach; endif; ?>
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
                  <?php if($sl3['accessLevel3']): // IF condition for Access Level.
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
                        <button class="btn btn-warning btn-xs">Finished</button>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if($cont->status == 5): ?>
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
                <?php endif; endforeach; endif; ?>
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