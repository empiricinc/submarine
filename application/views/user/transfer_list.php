<?php
/* Transfer view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="box box-block bg-white">
  <h2><strong><?php echo $this->lang->line('xin_list_all');?></strong> <?php echo $this->lang->line('xin_transfers');?> </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="xin_table">
      <thead>
        <tr>
          <th><?php echo $this->lang->line('xin_action');?></th>
          <th><?php echo $this->lang->line('xin_employee_name');?></th>
          <th><?php echo $this->lang->line('xin_transfer_date');?></th>
          <th><?php echo $this->lang->line('xin_transfer_to_department');?></th>
          <th><?php echo $this->lang->line('xin_transfer_to_location');?></th>
          <th><?php echo $this->lang->line('dashboard_xin_status');?></th>
          <th><?php echo $this->lang->line('xin_added_by');?></th>
        </tr>
      </thead>
    </table>
  </div>
</div>
