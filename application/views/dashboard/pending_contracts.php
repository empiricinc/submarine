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
            <form method="post" action="<?= base_url('contract/search_pending_contracts'); ?>">
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
    <section class="secMainWidthFilter">
      <section class="secIndexTable margint-top-0">
        <section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
          <form action="<?php echo base_url('contract/activate_all_contracts'); ?>" method="post">
            <section class="secIndexTable">
              <div class="mainTableWhite">
                <div class="col-lg-12">
                  <div class="row">
                  <div class="col-md-5">
                    <div class="tabelHeading">
                      <?php $count = $this->Contract_model->count_contracts(); ?>
                      <h3><?php if(empty($search_results)): ?>list of all pending contracts <?php else: ?> search results <?php endif; ?> | <small><a href="javascript:history.go(-1);">Back &laquo;</a>
                        <div class="label label-info">total no. of contracts pending currently: <?php echo $count; ?></div>
                      </small></h3>
                    </div>
                  </div>
                  <div class="col-lg-7 text-right" id="printBtn" style="display: block; font-size: 30px; margin-top: 5px;">
                      <button data-toggle="tooltip" title="Activate Contracts." data-placement="left" type="submit" name="activate_bulk" class="btn btn-primary"><i class="fa fa-arrow-right"></i></button>
                      <button data-toggle="tooltip" title="Generate Contracts" type="submit" name="generate_bulk" class="btn btn-info">Generate</button>
                    <button data-toggle="tooltip" title="Print all Contracts" type="submit" name="print_bulk" class="btn btn-primary"><i class="fa fa-print"></i></button>
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
                            <?php if(empty($search_results) AND !empty($pen_contracts)){
                              $i=0;
                              foreach ($pen_contracts as $contract){
                              $i++;
                              $userDetails = $this->Contract_model->applicantdetails($contract->user_id);
                              if($contract->status == 0){
                            ?>
                            <tr>
                              <td>
                                <input type="checkbox" name="print[]" id="checkPrint" style="display: block;" value="<?php echo $contract->user_id; ?>">
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
                                <?php if($contract->gender == 0){ echo "Male"; }else{ echo "Female"; } ?>
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
                                  <a data-toggle="tooltip" data-placement="left" title="Activate Contract, the RED color indicates that it's not activated yet. If activated, it'll be disappeared from here." href="<?php if($contract->long_description === NULL){ echo base_url('contract/activate_first'); }else{ echo base_url() ?>contract/activatecontract/<?= $contract->user_id; } ?>" onclick="javascript:return confirm('Are you sure to activate the contract ?');"><i class="fa fa-arrow-circle-right" id=<?php if($contract->long_description == NULL): ?>"activate"<?php  else: ?>id="activated"<?php endif; ?>></i></a>
                                  <a data-toggle="tooltip" data-placement="left" title="Reject Contract. The reject operation can't be reverted." href="<?php echo base_url("contract/reject/{$contract->user_id}"); ?>" onclick="javascript: return confirm('Are you sure to reject this contract ?');">
                                    <i class="fa fa-close"></i>
                                  </a>
                               <?php else: ?>
                                  Contract Activated
                               <?php endif; ?>                  
                              </td>
                            </tr>
                            <?php } } } ?>
                              <?php if(!empty($search_results)){
                              $i=0;
                              foreach ($search_results as $result){
                              $i++;
                              $userDetails = $this->Contract_model->applicantdetails($result->user_id);
                              if($result->status == 0){
                            ?>
                            <tr>
                              <td>
                                <input type="checkbox" name="print[]" id="checkPrint" style="display: block;" value="<?php echo $result->user_id; ?>">
                              </td>
                              <td>
                                <?php echo $result->compName.'-'.$result->designation_name.'-'.$result->user_id; ?>
                              </td>
                              <td>
                                <?php echo $result->fullname; ?>
                              </td>
                              <td>
                                <?php echo $result->compName; ?>
                              </td>
                              <td>
                                <?php echo $result->designation_name; ?>
                              </td>
                              <td>
                                <?php echo $result->name; ?>
                              </td>
                              <td>
                                <?php echo $result->city_name; ?>
                              </td>
                              <td>
                                <?php echo $result->dom_name; ?>
                              </td>
                              <td>
                                <?php if($result->gender == 0){ echo "Male"; }else{ echo "Female"; } ?>
                              </td>
                              <td>
                                <?php echo $result->cont_type; ?>
                              </td>
                              <td>
                                <?php $history = $this->Contract_model->contract_history($result->user_id); ?>
                                <a data-toggle="modal" data-target="#view_history<?php echo $result->user_id; ?>" href="#" class="btn btn-primary btn-xs">History</a>
                                  <div class="modal fade" id="view_history<?php echo $result->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="view_history" aria-hidden="true">
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
                                              <strong>Applicant's contract history for: <?php echo ucwords($result->fullname); ?></strong>
                                              <div class="table">
                                                <table class="table table-hover">
                                                  <thead>
                                                    <tr>
                                                      <th>Serial</th>
                                                      <th>Emp ID</th>
                                                      <th>Contract Type</th>
                                                      <th>Date From</th>
                                                      <th>Date To</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                  <?php $counter = 1; foreach($history as $hist): ?>
                                                    <tr>
                                                      <td><?php echo $counter++; ?></td>
                                                      <td><?= $result->compName.'-'.$result->designation_name.'-'.$hist->user_id; ?></td>
                                                      <td><?= $hist->name; ?></td>
                                                      <td><?= date('M d, Y', strtotime($hist->from_date));?></td>
                                                      <td><?= date('M d, Y', strtotime($hist->to_date));?></td>
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
                                <?php echo date('M d, Y', strtotime($result->created_at)); ?>
                              </td>
                              <td id="allChecked">
                              <?php
                                if($result->status == 0): ?>
                                  <a data-toggle="tooltip" title="Create new contract or make changes in the existing one." href="<?= base_url(); ?>contract/create_contract/<?= $result->user_id; ?>"><i class="fa fa-plus-circle"></i></a>
                                  <a data-toggle="tooltip" data-placement="left" title="Upload scanned copies of contract to verify it." href="<?= base_url(); ?>contract/verify/<?= $result->user_id; ?>">
                                    <i class="fa fa-check-circle"></i></a>
                                  <a data-toggle="tooltip" data-placement="left" title="Activate Contract, the RED color indicates that it's not activated yet. If activated, it'll be disappeared from here." href="<?php if($result->long_description === NULL){ echo base_url('contract/activate_first'); }else{ echo base_url() ?>contract/activatecontract/<?= $result->user_id; } ?>" onclick="javascript:return confirm('Are you sure to activate the contract ?');"><i class="fa fa-arrow-circle-right" id=<?php if($result->long_description == NULL): ?>"activate"<?php  else: ?>id="activated"<?php endif; ?>></i></a>
                                  <a data-toggle="tooltip" data-placement="left" title="Reject Contract. The reject operation can't be reverted." href="<?php echo base_url("contract/reject/{$result->user_id}"); ?>" onclick="javascript: return confirm('Are you sure to reject this contract ?');">
                                    <i class="fa fa-close"></i>
                                  </a>
                               <?php else: ?>
                                  Contract Activated
                               <?php endif; ?>                  
                              </td>
                            </tr>
                            <?php } } } ?>
                            <?php if(empty($search_results) AND empty($pen_contracts)): ?>
                              <div class="alert alert-danger">
                                <p class="text-center"><strong>Aww Snap! </strong> We couldn't find what you're looking for at the moment. Try again.</p>
                              </div>
                            <?php endif; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-1"></div>
                  <div class="col-lg-10 text-center">
                    <?php if(!empty($pen_contracts) AND empty($search_results)){ echo $this->pagination->create_links(); } ?>
                  </div>
                  <div class="col-lg-1"></div>
                </div>
              </div>
            </section>
          </form>
        </section>
      </section>
    </section>
  </div>
</div>
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