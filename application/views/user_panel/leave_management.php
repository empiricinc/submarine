<section class="secMainWidth">
<section class="secFormLayout">
	<div class="mainInputBg">
		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
			</div>
			<div class="col-lg-12">
				<?php if($this->session->flashdata('success')) { ?>
				<div class="alert alert-info" data-dismiss="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php } elseif($this->session->flashdata('error')) { ?>
				<div class="alert alert-danger" data-dismiss="alert">
					<?php echo $this->session->flashdata('error'); ?>
				</div>
				<?php } ?>
			</div>
			
			<form action="<?= base_url(); ?>User_panel/leave_request" method="POST">
				<div class="col-lg-4">
					<div class="inputFormMain">
						<select data-plugin="select_hrm" name="leave_type" id="leave-type" class="form-control" required="required">
							<option value="">SELECT LEAVE TYPE</option>
							<?php foreach($leave_type AS $lt): ?>
							<option value="<?= $lt->leave_type_id ?>"><?= $lt->type_name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="inputFormMain">
						<input type="text" name="from_date" class="form-control date-onward" value="" placeholder="From Date" autocomplete="off" required>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="inputFormMain">
						<input type="text" name="to_date" class="form-control date-onward" value="" placeholder="To Date" autocomplete="off" required>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<textarea name="reason" class="form-control noresize" rows="3" placeholder="Write your reason." required></textarea>
					</div>
				</div>
				<div class="col-lg-12" style="padding-left: 0px;">
					<div class="col-lg-2">
						<div class="submitBtn">
							<button class="btn btnSubmit">Submit</button>
						</div>
					</div>
					<div class="col-lg-2" style="padding-left: 70px;">
						<div class="submitBtn dropdown">
							<button type="button" class="btn btnSubmit" id="elm-xls">Export Data</button>
						</div>
					</div>
					
				</div>
			</form>
		</div>
		
		<div class="solidLine"></div>

		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3>Leaves Available</h3>
				</div>
			</div>
			<div class="col-lg-12">
				<!-- List for number of leaves available -->	
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>#</th>
							<th>LEAVE TITLE</th>
							<th>DAYS PER YEAR</th>
							<th>DAYS AVAILED</th>
							<th>DAYS AVAILABLE</th>
						</tr>
					</thead>
					<tbody>
						<?php $c = 1; foreach($leave_available AS $la): ?>
						<?php 
							$days_per_year = ($la->identifier == 'casual') ? $la->leaves_earned : $la->days_per_year;
							$leaves_available = ($la->identifier == 'casual') ? $la->leaves_earned - $la->leave_taken : $la->days_per_year - $la->leave_taken; ?>
						<tr>
							<td><?= $c; ?></td>
							<td><?= $la->type_name; ?></td>
							<td><?= $days_per_year; ?></td>
							<td><?= $la->leave_taken; ?></td>
							<td><?= $leaves_available; ?></td>
						</tr>
						<?php $c++; endforeach; ?>
					</tbody> 
				</table>
				<!-- ./End List for number of leaves available -->
			</div>
		</div>

		<div class="solidLine"></div>

		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3>Previous Applications</h3>
				</div>
			</div>
			<div class="col-lg-12">
				<!-- List of submitted applications -->	
				<table class="table table-bordered table-striped table-hover dataTable leave-application-table">
					<thead>
						<tr>
							<th>#</th>
							<th>LEAVE TITLE</th>
							<th>REASON</th>
							<th>FROM DATE</th>
							<th>TO DATE</th>
							<th>STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php $c = 1; foreach($leave_application AS $application): ?>
						<tr data="<?= $application->leave_id; ?>" style="cursor: pointer;">
							<td><?= $c; ?></td>
							<td><?= $application->type_name; ?></td>
							<td><?= $application->reason; ?></td>
							<td><?= date('d-m-Y', strtotime($application->from_date)); ?></td>
							<td><?= date('d-m-Y', strtotime($application->to_date)); ?></td>
							<td><?php

						 		if($application->status == '1') {
						 			echo '<span class="label label-warning">pending</span>';
						 		} elseif($application->status == '2') {
						 			echo '<span class="label label-primary">approved</span>';
						 		} else {
						 			echo '<span class="label label-danger">rejected</span>';
						 		}

							  ?></td>
						</tr>
						<?php $c++; endforeach; ?>
					</tbody>

				</table>
				<!-- ./End List of submitted applications -->
			</div>
		</div>
			
	</div>
</section>
</section>
