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
  <form action="<?php echo base_url('contract/activate_all_contracts'); ?>" method="post">
    <section class="secIndexTable">
      <div class="mainTableWhite">
        <div class="col-lg-12">
          <div class="row">
          <div class="col-md-4">
            <div class="tabelHeading">
              <?php $count = $this->Contract_model->count_contracts(); ?>
              <h3>list of all pending contracts | <small><a href="javascript:history.go(-1);">Back &laquo;</a>
                <div class="label label-info">total no. of contracts pending currently: <?php echo $count; ?></div>
              </small></h3>
            </div>
          </div>
          <div class="col-lg-8 text-right" id="printBtn" style="display: block; font-size: 30px; margin-top: 5px;">
              <button data-toggle="tooltip" title="Activate Contracts." data-placement="left" type="submit" name="activate_bulk" class="btn btn-primary"><i class="fa fa-arrow-right"></i></button>
              <button data-toggle="tooltip" title="Generate Contracts" type="submit" name="generate_bulk" class="btn btn-info">Generate</button>
            <a target="blank" data-toggle="tooltip" title="Print Contracts" data-placement="left" href="<?= base_url('contract/print_all_contracts'); ?>" class="btn btn-primary"><i class="fa fa-print"></i></a>
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
                      <th>Emp iD</th>
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
                  <?php  
                    $i=0;
                    foreach ($pen_contracts as $contract){
                    $i++;
                    $userDetails = $this->Contract_model->applicantdetails($contract->user_id);
                    if($contract->status == 0){
                  ?>
                  <tr>
                    <td>
                      <input type="checkbox" name="print[]" id="checkPrint" style="display: block;" value="<?php if($contract->long_description == ''){ echo 'Nothing'; }else{ echo $contract->user_id; } ?>" <?php if($contract->long_description == ''): ?> disabled <?php endif; ?>>
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
                      <?php if($contract->gender == 0){ echo "Male"; }else{ echo "Female"; } ?>
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
                      <a data-toggle="tooltip" title="Pending">
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
                        <a data-toggle="tooltip" title="Activate Contract, the RED color indicates that it's not activated yet. If activated, it'll be disappeared from here." href="<?php if($contract->long_description === NULL){ echo base_url('contract/activate_first'); }else{ echo base_url() ?>contract/activatecontract/<?= $contract->user_id; } ?>" onclick="javascript:return confirm('Are you sure to activate the contract ?');"><i class="fa fa-arrow-circle-right" id=<?php if($contract->long_description == NULL): ?>"activate"<?php  else: ?>id="activated"<?php endif; ?>></i></a>
                        <a data-toggle="tooltip" title="Reject Contract. The reject operation can't be reverted." href="<?php echo base_url("contract/reject/{$contract->user_id}"); ?>" onclick="javascript: return confirm('Are you sure to reject this contract ?');">
                          <i class="fa fa-close"></i>
                        </a>
                     <?php else: ?>
                        Contract Activated
                     <?php endif; ?>                  
                    </td>
                  </tr>
                  <?php } } ?>
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
  </form>
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