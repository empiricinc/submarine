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
              Offer Letters Management Dashboard | <small><a href="<?php echo base_url('contract/offer_letter_setup'); ?>"><i class="fa fa-plus"></i> Templates</a></small>
            </h1>
            <?php if($success = $this->session->flashdata('success')): ?>
              <div class="alert alert-success">
                <p class="text-center"><?php echo $success; ?></p>
              </div>
            <?php endif; ?>
          </div>
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
                <h3>pending letters</h3>
              </div>
            </div>
            <div class="col-md-3">
              <div class="tabelTopBtn">
                <a href="<?= base_url('contract/list_pending_letters'); ?>" class="btn">View All</a>
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tableMain">
              <div class="table">
                <table class="table table-condensed" style="width:100%">
                  <thead>
                    <tr>
                      <th>emp iD</th>
                      <th>name</th>
                      <th>project</th>
                      <th>designation</th>
                      <th>date sent</th>
                      <th>options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=0; //if($sl3['accessLevel3']){ // IF condition for Access Level.
                    foreach ($pen_letters as $letter){
                    $i++;
                    $userDetails = $this->Contract_model->applicantdetails($letter->user_id);
                      if($letter->status == 0){
                    ?>
                    <tr>
                      <td>CTC-<?php echo $letter->user_id; ?></td>
                      <td><?php echo $letter->fullname;?></td>
                      <td><?php echo $letter->name;?></td>
                      <td><?php echo $letter->designation_name; ?></td>
                      <td><?php echo date('M d, Y', strtotime($letter->sdt)); ?></td>
                      <td>
                        <?php if($letter->status != 0): ?>
                          <a href="javascript:void(0)" class="btn btn-success btn-xs">Accepted</a>
                            <?php else: ?>
                          <a href="<?php echo base_url(); ?>contract/upload_offer_letter/<?php echo $letter->user_id; ?>" class="btn btn-info btn-xs">Gen</a>
                          <a href="<?php if($letter->attachment == ''){ ?> javascript:void(0); <?php }else{ echo base_url(); ?>contract/accept_offer_letter/<?php echo $letter->user_id; } ?>" class="btn btn-primary btn-xs">Fwd</a>
                          <a href="<?php echo base_url(); ?>contract/reject_offer_letter/<?php echo $letter->user_id; ?>" class="btn btn-primary btn-xs">Rej</a>
                          <a data-toggle="modal" data-target="#attachment<?php echo $letter->user_id; ?>" href="#" class="btn btn-warning btn-xs">View</a>
                          <div class="modal fade" id="attachment<?= $letter->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                  <!--Header-->
                                <div class="modal-header">
                                  <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Offer Letter Description</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <!--Body-->
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <p><?php echo $letter->attachment; ?></p>
                                    </div>
                                  </div>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <a target="blank" href="<?php echo base_url(); ?>contract/print_offer_letter/<?php echo $letter->user_id; ?>" class="btn btn-primary">Print</a>
                                </div>
                              </div>
                            </div>
                          </div>
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
            <div class="col-md-5">
                <div class="tabelHeading">
                  <h3>accepted letters</h3>
                </div>
            </div>
            <div class="col-md-7">
              <div class="tabelTopBtn">
                <a href="<?= base_url('contract/list_accepted_letters'); ?>" class="btn">View All</a>
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
                      <?php //if($sl3['accessLevel3']): // IF condition for Access Level. 
                        foreach($letters as $accepted): 
                          if($accepted->status == 1 OR $accepted->status == 2):
                          ?>
                      <tr>
                        <td>CTC-<?= $accepted->user_id; ?></td>
                        <td><?= $accepted->fullname; ?></td>
                        <td><?= $accepted->name; ?></td>
                        <td><?php echo $accepted->designation_name; ?></td>
                        <td><?php echo date('M d, Y', strtotime($accepted->sdt)); ?></td>
                        <td>
                          <?php if($accepted->status != 0): ?>
                            <button class="btn btn-success btn-xs">Accepted</button>
                            <?php else: ?>
                            <button class="btn btn-warning btn-xs">Pending</button>
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
      </div>
    </div><br>
    <div class="row">
      <div class="col-md-12">
        <div class="mainTableWhite">
            <div class="row">
              <div class="col-md-5">
                  <div class="tabelHeading">
                    <h3>rejected letters</h3>
                  </div>
              </div>
              <div class="col-md-7">
                <div class="tabelTopBtn">
                  <a href="<?php echo base_url('contract/list_rejected_letters'); ?>" class="btn">View All</a>
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
                          <th>employee iD</th>
                          <th>employee name</th>
                          <th>project</th>
                          <th>designation</th>
                          <th>date sent</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php //if($sl3['accessLevel3']): // IF condition for Access Level. 
                          foreach($rej_letters as $rejected): 
                            if($rejected->status == 3):
                            ?>
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
</section>
<?php } ?>