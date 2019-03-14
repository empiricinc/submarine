<?php
/* Filename: questions_list.php
*  Location: Views/test-system/questions_list.php
*  Author: Saddam
*/
?>
<div class="container">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4 text-left">
				<h1>Questions List</h1>
			</div>
			<div class="col-md-6 text-right">
				<form class="form-inline" action="<?php echo base_url('tests/search') ?>" method="post">
				<select name="designation" class="form-control">
					<option value="">--Select Title--</option>
					<option value="CM">Community Mobilizer</option>
					<option value="PM">Polio</option>
					<option value="who">UNICEF</option>
				</select>
					<input type="text" name="keyword" class="form-control" placeholder="Search this page ...">
					<input type="submit" name="submit" class="btn btn-success" value="Search">
				</form>
			</div>
			<div class="col-md-2 text-right">
				<a class="btn btn-info" href="<?=base_url('tests/questions_for_test'); ?>">GO TO PAPER &raquo;</a>
			</div>
		</div>
		<hr>
		<?php if($this->session->flashdata('success')) : ?>
			<div class="alert alert-success text-center">
				<?php echo $this->session->flashdata('success'); ?>
			</div>
		<?php endif; ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Serial</th>
					<th>Question description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $counter = 1; ?>
				<?php foreach($questions as $que) : ?>
					<tr>
						<td><?php echo $counter++; ?></td>
						<td><a href="<?= base_url(); ?>tests/view_single/<?php echo $que->id; ?>"><?php echo $que->question; ?></a></td>
						<td>
							<a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>tests/view_single/<?php echo $que->id; ?>">View</a>
							<a class="btn btn-primary btn-xs" href="<?php echo base_url(); ?>tests/edit/<?php echo $que->id; ?>">Edit</a>
							<a class="btn btn-danger btn-xs" onclick="javascript: return confirm('Are you sure to delete this?')" href="<?php echo base_url(); ?>tests/delete/<?php echo $que->id; ?>">Delete</a>
							<a class="btn btn-warning btn-xs" href="<?php echo base_url(); ?>tests/add_options/<?php echo $que->id; ?>">Add</span></a>
						</td>

					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php //echo $this->pagination->create_links(); ?>
	</div>
</div>