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
                     <h3>list of all rejected offer letters | <small><a href="javascript:history.go(-1);"><div class="label label-primary">back</div></a></small></h3>
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
                          <th>date sent</th>
                          <th>status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if($sl3['accessLevel3']): // IF condition for Access Level. 
                          foreach($rejected_letters as $rejected): 
                            if($rejected->status == 2): ?>
                        <tr>
                          <td>CTC-<?= $rejected->user_id; ?></td>
                          <td><?= $rejected->fullname; ?></td>
                          <td><?= $rejected->name; ?></td>
                          <td><?php echo $rejected->designation_name; ?></td>
                          <td><?php echo date('M d, Y', strtotime($rejected->sdt)); ?></td>
                          <td>
                           <?php if($rejected->status != 0 AND $rejected->status != 1): ?>
                            <button class="btn btn-danger btn-xs">Rejected</button>
                            <?php else: ?>
                            <button class="btn btn-warning btn-xs">Pending</button>
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
            <div class="row">
              <div class="col-md-1"></div>
              <div class="col-md-10 text-center">
                <?php echo $this->pagination->create_links(); ?>
              </div>
              <div class="col-md-1"></div>
            </div>
        </div>
        </div>
    </section>
</section>
<?php } ?>