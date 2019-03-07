<?php

/*

* Bank/Cash - Accounting View

*/

$session = $this->session->userdata('username');


?>



<div class="row m-b-1 animated fadeInRight">

  <div class="col-md-4">

    <div class="box box-block bg-white">

      <h2><strong><?php echo $this->lang->line('xin_add_new');?></strong> <?php echo $this->lang->line('xin_acc_payroll');?></h2>

      <form class="m-b-1" action="<?php echo site_url("Payroll_settings/add") ?>" method="post" name="add_bankcash" id="xin-form">

        <div class="form-group">

          <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">

          <label for="account_name"><?php echo $this->lang->line('xin_acc_title');?></label>

          <input type="text" class="form-control" name="name" placeholder="<?php echo $this->lang->line('xin_acc_title');?>">

        </div>

      

  

        <div class="form-group">

          <label for="bankcash_id"><?php echo $this->lang->line('xin_acc_accounts');?></label>

           <select class="form-control" name="bankcash_id" id="bankcash_id">
            <?php foreach ($bank_cashes as $bank_cash) : ?>
            <option value="<?= $bank_cash['bankcash_id']; ?>"><?= ucfirst($bank_cash['account_name']); ?></option>
            <?php endforeach; ?>
          </select>

        </div>
        <div class="form-group">

          <label for="bankcash_id"><?php echo $this->lang->line('xin_acc_payroll_items');?></label>

           <select class="form-control" name="payroll_item" id="payroll_item">
            <option value="addition">Addition</option>
            <option value="deduction">Deduction</option>
          </select>

        </div>
        <div class="text-right">

          <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>

        </div>

      </form>

    </div>

  </div>

  <div class="col-md-8">

    <div class="box box-block bg-white">

      <h2><strong><?php echo $this->lang->line('xin_list_all');?></strong> <?php echo $this->lang->line('xin_acc_payrolls');?></h2>

      <div class="table-responsive" data-pattern="priority-columns">

        <table class="table table-striped table-bordered dataTable" id="xin_table">

          <thead>

            <tr>

              <th><?php echo $this->lang->line('xin_action');?></th>

              <th><?php echo $this->lang->line('xin_acc_title');?></th>

              <th><?php echo $this->lang->line('xin_acc_accounts');?></th>
              
              <th><?php echo $this->lang->line('xin_acc_payroll_items');?></th>


            </tr>

          </thead>

        </table>

      </div>

      <!-- responsive --> 

    </div>

  </div>

</div>

