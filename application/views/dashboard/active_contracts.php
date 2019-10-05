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
<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable">
    <div class="mainTableWhite">
      <div class="row">
        <div class="col-md-4">
          <div class="tabelHeading">
            <h3>active contracts' list | <small><a href="javascript:history.go(-1);"><div class="label label-warning">back</div></a>&nbsp;<a href=""><div class="label label-primary">active</div></a></small></h3>
          </div>
        </div>
        <div class="col-md-5 text-right">
          <div class="tabelTopBtn status-btns">
            <span id="active" class="btn">Active</span>
            <span id="printed" class="btn">Printed</span>
            <span id="distributed" class="btn">Distributed</span>
            <span id="attached" class="btn">Attached to File</span>
          </div>
        </div>
        <div class="col-md-3 text-right" id="printBtn" style="display: none; font-size: 30px; margin-top: 5px; margin-left: -14px;">
          <a data-toggle="tooltip" title="Activated contracts, no further action needed, you can print them if not printed !" data-placement="left" href="javascript:void(0)"><i class="fa fa-arrow-circle-right" style="color: green;"></i></a>
          <a target="blank" data-toggle="tooltip" title="Print Contracts" href="<?= base_url('contract/print_all_contracts'); ?>"><i class="fa fa-print"></i></a>
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
                    <th>name</th>
                    <th>project</th>
                    <th>designation</th>
                    <th>address</th>
                    <th>contract duration</th>
                    <th>manger</th>
                    <th>type</th>
                    <th>submission date</th>
                    <th>status</th>
                  </tr>
                </thead>
                <tbody id="filter_results">
                <?php
                  foreach ($active_contracts as $contract){
                  $userDetails = $this->Contract_model->applicantdetails($contract->user_id);
                  if($contract->status == 1 OR $contract->status == 2 OR $contract->status == 3 OR $contract->status == 4){
                ?>
                  <tr>
                    <td>
                      <input type="checkbox" name="print" id="checkPrint">
                    </td>
                    <td>
                      <?php echo $contract->first_name.' '.$contract->last_name;?>
                    </td>
                    <td>
                      <?php echo $contract->name; ?>
                    </td>
                    <td>
                      <?php echo $contract->designation_name; ?>
                    </td>
                    <td>
                      <?php echo $contract->address; ?>
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
                    <?php
                      if($contract->status == 0): ?>
                        <a href="<?= base_url() ?>contract/activatecontract/<?= $contract->user_id; ?>"><i class="fa fa-arrow-circle-right"></i></a>
                        <a href="<?= base_url(); ?>contract/verify/<?= $contract->user_id; ?>"><i class="fa fa-check-circle"></i></a>
                        <a href="<?= base_url(); ?>contract/create_contract/<?= $contract->user_id; ?>"><i class="fa fa-plus-circle"></i></a>
                      <?php elseif($contract->status == 1): ?>
                        <i class="fa fa-check-circle" data-toggle="tooltip" title="Activated, but no further actions performed yet."></i>
                        <a href="<?= base_url(); ?>contract/print_contract/<?= $contract->user_id; ?>"><i class="fa fa-print"></i></a>
                      <?php elseif($contract->status == 2): ?>
                        <a data-toggle="tooltip" title="Add to distributed." href="<?= base_url(); ?>contract/distribute/<?= $contract->user_id; ?>"><i class="fa fa-share"></i></a>
                      <?php elseif($contract->status == 3): ?>
                        <i data-toggle="tooltip" title="Activated" class="fa fa-check-circle" style="color: green;"></i>
                        <i data-toggle="tooltip" title="Printed" class="fa fa-print" style="color: green;"></i>
                        <i data-toggle="tooltip" title="Distributed" class="fa fa-share" style="color: green;"></i>
                        <a data-toggle="tooltip" title="Attach to personal file" href="<?= base_url(); ?>contract/attach/<?= $contract->user_id; ?>"><i class="fa fa-forward"></i></a>
                      <?php elseif($contract->status == 4): ?>
                        <i data-toggle="tooltip" title="Everything's done, no further actions needed. Enjoy !" class="fa fa-bed" style="color: green;"></i>
                      <?php else: ?>
                        <i data-toggle="tooltip" title="No actions performed yet, status is Pending." class="fa fa-arrow-circle-right" style="color: red;"></i>
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
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
          <?php echo $this->pagination->create_links(); ?>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </section>
</section>
<?php } ?>
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
            result += `
              <tr>
                <td><input type="checkbox" name="print" id="checkPrint"></td>
                <td>${val.first_name} ${val.last_name}</td>
                <td>${val.name}</td>
                <td>${val.designation_name}</td>
                <td>${val.address}</td>
                <td>${val.from_date} - ${val.to_date}</td>
                <td>${val.contract_manager}</td>
                <td>${val.cont_type}</td>
                <td>${val.sdt}</td>
                <td>
                  <i data-toggle="tooltip" title="Activated" class="fa fa-check-circle" style="color: green;"></i>
                  <i data-toggle="tooltip" title="Printed" class="fa fa-print" style="color: green;"></i>
                  <a data-toggle="tooltip" title="Add to distributed" href="<?= base_url(); ?>/contract/distribute/${val.user_id}"><i class="fa fa-share"></i></a>
                  <a data-toggle="tooltip" title="Attach to personal file" href="<?= base_url(); ?>/contract/attach/${val.user_id}"><i class="fa fa-forward"></i></a>
                </td>
              </tr>
            `;
          });
          $('#filter_results').append(result);
        }
      });
    });
  });
</script>