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
                <div class="col-md-12">
                  <div class="tabelHeading">
                      <h3>list of all expired contracts | <small><a href="javascript:history.go(-1);"><div class="label label-primary">back</div></a></small></h3>
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
                                        <th>sr #</th>
        				                        <th>manager</th>
        				                        <th>type</th>
        				                        <th>days left</th>
        				                        <th>status</th>
        				                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>
			                        <?php foreach($expired_contracts as $exp_cont): ?>
			                        <?php
                                if($exp_cont->contract_type != 1):
			                          $date1=date_create(date('Y-m-d'));
			                          $date2=date_create(date('Y-m-d', strtotime($exp_cont->to_date)));
			                          $diff=date_diff($date1, $date2);
			                        ?>
			                        <tr>
			                          <td>CTC-0<?= $exp_cont->user_id; ?></td>
			                          <td><?= $exp_cont->contract_manager; ?></td>
			                          <td><?= $exp_cont->name; ?></td>
			                          <td>
			                            <?php echo $diff->format("%a days"); ?>
			                          </td>
			                          <td>
			                          	<div class="label label-warning">Expiring</div>
			                          </td>
			                          <td>
			                            <a data-toggle="tooltip" title="<?= date('M d, Y', strtotime($exp_cont->from_date)).' - '.date('M d, Y', strtotime($exp_cont->to_date)); ?>" href="<?= base_url(); ?>contract/extend/<?= $exp_cont->user_id; ?>">
				                            <div class="label label-primary">
				                              Extend
				                            </div> &nbsp;
			                            </a>
			                            <a href="#finishContract" data-toggle="modal" data-target="#finishModal<?= $exp_cont->id; ?>">
			                            <div class="label label-danger">
			                              &nbsp;Finish
			                            </div>
			                            </a>
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
			                          <?php endif; endforeach; ?>
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