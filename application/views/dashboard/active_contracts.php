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
</style>
<script type="text/javascript">
$(document).ready(function() {
    $('#contact_list1').DataTable();
});
$(document).ready(function() {
    $('#contact_list2').DataTable();
});
</script>
<?php
  $active = $this->Contract_model->count_active_contracts();
  $printed = $this->Contract_model->count_printed_contracts();
  $distributed = $this->Contract_model->count_distributed_contracts();
  $attached = $this->Contract_model->count_attached_contracts();
?>
<div class="row">
  <section class="secMainWidthFilter">
    <section class="secIndexTable margint-top-0">
      <div class="col-lg-2 no-leftPad">
        <div class="main-leftFilter">
          <div class="tabelHeading">
            <h3>Search Contracts <a data-toggle="tooltip" title="Click to refresh" data-placement="right" onclick="document.location.reload(true);" class="fa fa-refresh"></a></h3>
          </div>
          <div class="selectBoxMain">
            <form method="post" action="<?= base_url('contract/search_active_contracts'); ?>">
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
<form action="<?php echo base_url('contract/bulk_update'); ?>" method="post">
  <div class="col-lg-10">
    <section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
      <section class="secIndexTable">
        <div class="mainTableWhite">
          <div class="row">
            <div class="col-md-4">
              <div class="tabelHeading">
                <h3><?php if(empty($search_results)): ?>active contracts <?php else: ?> search results <?php endif; ?> | <small><a href="javascript:history.go(-1);"><div class="label label-warning">back</div></a>&nbsp;<a href=""><div class="label label-primary">active</div></a></small></h3>
              </div>
            </div>
            <div class="col-md-5 text-right">
              <div class="tabelTopBtn status-btns">
                <span id="active" class="btn"><b><?= $active; ?></b> Active</span>
                <span id="printed" class="btn"><b><?= $printed; ?></b> Printed</span>
                <span id="distributed" class="btn"><b><?= $distributed; ?></b> Distributed</span>
                <span id="attached" class="btn"><b><?= $attached; ?></b> Attached</span>
              </div>
            </div>
            <div class="col-md-3 text-right" id="printBtn" style="display: block; font-size: 30px; margin-top: 5px; margin-left: -14px;">
              <button class="btn btn-success" disabled><i class="fa fa-arrow-right"></i></button>
              <button data-toggle="tooltip" title="Print all Contracts" type="submit" name="print_bulk" class="btn btn-primary"><i class="fa fa-print"></i></button>
              <button data-toggle="tooltip" title="Distribute contracts." data-placement="left" type="submit" name="distribute_bulk" class="btn btn-info"><i class="fa fa-share"></i></button>
              <button data-toggle="tooltip" title="Attach to personal file." data-placement="left" type="submit" name="attach_bulk" class="btn btn-primary"><i class="fa fa-forward"></i></button>
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
                        <th>contract duration</th>
                        <th>manger</th>
                        <th>type</th>
                        <th>submission date</th>
                        <th>action | operations</th>
                      </tr>
                    </thead>
                    <tbody id="filter_results">
                    <?php if(empty($search_results) AND !empty($active_contracts)){
                      foreach ($active_contracts as $contract){
                      $userDetails = $this->Contract_model->applicantdetails($contract->user_id);
                      if($contract->status == 1){
                    ?>
                    <?php if($contract->user_id): ?>
                      <tr>
                        <td>
                          <input type="checkbox" id="checkPrint" name="print[]" value="<?php echo $contract->user_id; ?>">
                        </td>
                        <td>
                          CTC-<?= $contract->name.'-'.$contract->user_id; ?>
                        </td>
                        <td>
                          <?php echo $contract->fullname;?>
                        </td>
                        <td>
                          <?php echo $contract->name; ?>
                        </td>
                        <td>
                          <?php echo $contract->designation_name; ?>
                        </td>
                        <td>
                          <?php echo date('M d, Y', strtotime($contract->from_date)).' - '.date('M d, Y', strtotime($contract->to_date)); ?>
                        </td>
                        <td>
                          <?php echo $contract->contract_manager; ?>
                        </td>
                        <td>
                          <?php echo $contract->cont_type; ?>
                        </td>
                        <td>
                          <?php echo date('M d, Y', strtotime($contract->sdt)); ?>
                        </td>
                        <td>
                          <a target="blank" data-toggle="tooltip" title="Print contract" href="<?= base_url(); ?>contract/print_contract/<?= $contract->user_id; ?>" class="btn btn-primary btn-xs">Print</a>
                        </td>
                      </tr>
                    <?php endif; ?>
                      <?php } } } ?>
                      <?php if(!empty($search_results) AND empty($active_contracts)){
                      foreach ($search_results as $result){
                      $userDetails = $this->Contract_model->applicantdetails($result->user_id);
                      if($result->status == 1){
                    ?>
                    <?php if($result->user_id): ?>
                      <tr>
                        <td>
                          <input type="checkbox" id="checkPrint" name="print[]" value="<?php echo $result->user_id; ?>">
                        </td>
                        <td>
                          CTC-<?= $result->name.'-'.$result->user_id; ?>
                        </td>
                        <td>
                          <?php echo $result->fullname;?>
                        </td>
                        <td>
                          <?php echo $result->compName; ?>
                        </td>
                        <td>
                          <?php echo $result->designation_name; ?>
                        </td>
                        <td>
                          <?php echo date('M d, Y', strtotime($result->from_date)).' - '.date('M d, Y', strtotime($result->to_date)); ?>
                        </td>
                        <td>
                          <?php echo $result->contract_manager; ?>
                        </td>
                        <td>
                          <?php echo $result->cont_type; ?>
                        </td>
                        <td>
                          <?php echo date('M d, Y', strtotime($result->sdt)); ?>
                        </td>
                        <td>
                          <a target="blank" data-toggle="tooltip" title="Print contract" href="<?= base_url(); ?>contract/print_contract/<?= $result->user_id; ?>" class="btn btn-primary btn-xs">Print</a>
                        </td>
                      </tr>
                    <?php endif; ?>
                      <?php } } } ?>
                      <?php if(empty($search_results) AND empty($active_contracts)): ?>
                        <div class="alert alert-danger">
                          <p><strong>Aww snap! </strong>We couldn't find what you're looking for at the moment. Try again.</p>
                        </div>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-center">
              <?php if(empty($search_results) AND !empty($active_contracts)){ echo $this->pagination->create_links(); } ?>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
      </section>
    </section>
    <?php } ?>
    </div>
</div>  
  <script type="text/javascript">
    $(document).ready(function(){
      $('#checkAll').click(function(){
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
  <!-- Change data with status change -->
  <script type="text/javascript">
    $(document).ready(function(){
      var status = 0;
      $('.btn').on('click', function(){
        $('#filter_results').html('');
        status = $(this).attr('id');
        if(status == 'active')
          status = 1;
        else if(status == 'printed')
          status = 2;
        else if(status == 'distributed')
          status = 3;
        else if(status == 'attached')
          status = 4;
        else
          status = 1;
        $.ajax({
          url: '<?= base_url(); ?>contract/get_printed/' + status,
          type: 'post',
          dataType: 'json',
          data: {status: status},
          success: function(res){
            result = "";
            $.each(res, function(key, val){
              var fromDate = new Date(val.from_date).toDateString();
              var toDate = new Date(val.to_date).toDateString();
              var subDate = new Date(val.sdt).toDateString();
              if(val.status == 1){
                result += `
                <tr>
                  <td><input type="checkbox" name="print[]" id="checkPrint" value="${val.user_id}"></td>
                  <td>CTC-${val.name}-${val.user_id}</td>
                  <td>${val.fullname}</td>
                  <td>${val.name}</td>
                  <td>${val.designation_name}</td>
                  <td>${fromDate} - ${toDate}</td>
                  <td>${val.contract_manager}</td>
                  <td>${val.cont_type}</td>
                  <td>${subDate}</td>
                  <td>
                    <a data-toggle="tooltip" title="Print contract" href="<?= base_url(); ?>contract/print_contract/${val.user_id}" class="btn btn-primary btn-xs">Print</a>
                  </td>
                </tr>
              `;
              }else if(val.status == 2){
                result += `
                <tr>
                  <td><input type="checkbox" name="print[]" id="checkPrint" value="${val.user_id}"></td>
                  <td>CTC-${val.name}-${val.user_id}</td>
                  <td>${val.fullname}</td>
                  <td>${val.name}</td>
                  <td>${val.designation_name}</td>
                  <td>${fromDate} - ${toDate}</td>
                  <td>${val.contract_manager}</td>
                  <td>${val.cont_type}</td>
                  <td>${subDate}</td>
                  <td>
                    <a data-toggle="tooltip" title="Add to distributed" href="<?= base_url(); ?>contract/distribute/${val.user_id}" class="btn btn-primary btn-xs">Distribute</a>
                  </td>
                </tr>
              `;
            }else if(val.status == 3){
              result += `
                <tr>
                  <td><input type="checkbox" name="print[]" id="checkPrint" value="${val.user_id}"></td>
                  <td>CTC-${val.name}-${val.user_id}</td>
                  <td>${val.fullname}</td>
                  <td>${val.name}</td>
                  <td>${val.designation_name}</td>
                  <td>${fromDate} - ${toDate}</td>
                  <td>${val.contract_manager}</td>
                  <td>${val.cont_type}</td>
                  <td>${subDate}</td>
                  <td>
                    <a data-toggle="tooltip" title="Attach to personal file" href="<?= base_url(); ?>contract/attach/${val.user_id}" class="btn btn-primary btn-xs">Attach to File</a>
                  </td>
                </tr>
              `;
            }else if(val.status == 4){
              result += `
                <tr>
                  <td><input type="checkbox" name="print[]" id="checkPrint" value="${val.user_id}"></td>
                  <td>CTC-${val.name}-${val.user_id}</td>
                  <td>${val.fullname}</td>
                  <td>${val.name}</td>
                  <td>${val.designation_name}</td>
                  <td>${fromDate} - ${toDate}</td>
                  <td>${val.contract_manager}</td>
                  <td>${val.cont_type}</td>
                  <td>${subDate}</td>
                  <td><button type="button" data-toggle="tooltip" title="Attached to personal file, no further actions needed!" class="btn btn-success btn-xs">Completed !</button>
                    <a href="<?php echo base_url(); ?>contract/verify/${val.user_id}" class="btn btn-primary btn-xs">View Copies</a>
                  </td>
                </tr>
              `;
            }
            });
            $('#filter_results').append(result);
          }
        });
      });
    });
  </script>
</form>