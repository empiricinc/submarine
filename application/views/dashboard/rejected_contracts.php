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
    <section class="secIndexTable">
      <div class="mainTableWhite">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-md-6">
              <div class="tabelHeading">
                <h3>list of all rejected / finished contracts | <small><a href="javascript:history.go(-1);">Go Back &laquo;</a></small></h3>
              </div>
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
                      <th>Emp iD</th>
                      <th>name</th>
                      <th>project</th>
                      <th>designation</th>
                      <th>location</th>
                      <th>contract type</th>
                      <th>status</th>
                      <th>reason / finish date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if($sl3['accessLevel3']){
                    $i=0;
                    foreach ($rej_contracts as $contract){
                    $i++;
                    $userDetails = $this->Contract_model->applicantdetails($contract->user_id);
                    if($contract->status == 5 OR $contract->status == 6){
                  ?>
                  <tr>
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
                      <?php echo $contract->designation_name; ?>
                    </td>
                    <td>
                      <?php echo $contract->provName; ?>
                    </td>
                    <td>
                      <?php echo 'N/A'; ?>
                    </td>
                    <td>
                      <?php if($contract->status == 5): ?>
                        <button data-toggle="modal" data-target="#finishReason<?= $contract->user_id; ?>" class="btn btn-warning btn-xs">Finished</button>
                        <div class="modal fade" id="finishReason<?= $contract->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <p><?php echo $contract->rejection_reason; ?></p>
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
                        <?php elseif($contract->status == 6): ?>
                        <button class="btn btn-danger btn-xs">Rejected</button>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if($contract->status == 6): ?>
                      <a data-toggle="modal" data-target="#reason<?= $contract->user_id; ?>" href="#reason"><?php echo substr($contract->rejection_reason, 0, 15).'...'; ?></a>
                      <div class="modal fade" id="reason<?= $contract->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <!--Header-->
                            <div class="modal-header">
                              <h4 style="display: inline-block;" class="modal-title" id="myModalLabel"><?php if($contract->status == 5): ?>Rejection Reason... <?php elseif($contract->status == 6): ?>Reason to finish contract... <?php endif; ?></h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                            <!--Body-->
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-md-6 col-md-offset-3 text-center">
                                  <p><?php echo $contract->rejection_reason; ?></p>
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
                        <?php echo date('M d, Y', strtotime($contract->to_date)); ?>
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
          <div class="col-lg-1"></div>
          <div class="col-lg-10 text-center">
            <?php echo $this->pagination->create_links(); ?>
          </div>
          <div class="col-lg-1"></div>
        </div>
      </div>
    </section>
</section>
<?php } ?>
<script type="text/javascript">
// Check all checkboxes at once.
$(document).ready(function(){
  $("#checkAll").click(function(){
   $('input:checkbox').not(this).prop('checked', this.checked);
  });
});
// Show and hide buttons for printing and activating contracts.
$(function () {
  $("#checkAll").click(function () {
    if ($(this).is(":checked")) {
      $("#printBtn").hide(1500, "swing");
      $("#printBtn").show(1500, "swing");
    } else {
      $("#printBtn").show(1500, "linear");
      $("#printBtn").hide(1500, "linear");
    }
  });
});
</script>