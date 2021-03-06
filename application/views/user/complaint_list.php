<?php
/* Complaints view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="box box-block bg-white">
  <h2><strong><?php echo $this->lang->line('xin_list_all');?></strong> <?php echo $this->lang->line('left_complaints');?> </h2>
  <div class="table-responsive" data-pattern="priority-columns">
    <table class="table table-striped table-bordered dataTable" id="xin_table">
      <thead>
        <tr>
         <th><?php echo $this->lang->line('xin_action');?></th>
          <th><?php echo $this->lang->line('xin_complaint_from');?></th>
          <th><?php echo $this->lang->line('xin_complaint_against');?></th>
          <th><?php echo $this->lang->line('xin_complaint_title');?></th>
          <th><?php echo $this->lang->line('xin_complaint_date');?></th>
          <th><?php echo $this->lang->line('xin_approval_status');?></th>
          <th><?php echo $this->lang->line('xin_details');?></th>
        </tr>
      </thead>
    </table>
  </div>
</div>
