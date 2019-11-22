<section class="secMainWidth">
<section class="col-lg-6 col-lg-offset-3">
<section class="secFormLayout">
	<div class="mainInputBg">
		<div class="row" style="padding: 30px;">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
			</div>
			<?php if($this->session->flashdata('success')) { ?>
			<div class="col-lg-12">
				<div class="alert alert-info" data-dismiss="alert">
					<strong>Success!</strong> <?= $this->session->flashdata('success'); ?>
				</div>
			</div>
			<?php } elseif($this->session->flashdata('error')) {  ?>
			<div class="col-lg-12">
				<div class="alert alert-danger" data-dismiss="alert">
					<?= $this->session->flashdata('error'); ?>
				</div>
			</div>
			<?php } ?>
			
			<form action="<?= base_url(); ?>User_panel/request_card" method="POST">
				<input type="hidden" name="employee_id" value="<?= $employee->employee_id; ?>">
				<div class="col-lg-12">
					<div class="inputFormMain">
						<input type="text" name="employee_name" value="<?= ucwords($employee->emp_name); ?>" class="form-control" id="card-name" placeholder="Employee name" readonly>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<input type="text" name="designation" value="<?= $employee->designation_name; ?>" id="card-designation" class="form-control" placeholder="Designation"  required readonly>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<input type="text" name="project" value="<?= $employee->project_name; ?>" id="card-project" class="form-control" placeholder="Project"  required readonly>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<select name="reason" id="card-reason" class="form-control" required="required">
							<option value="">SELECT REASON</option>
							<?php foreach($reason AS $r): ?>
							<option value="<?= $r->id; ?>"><?= $r->reason_text; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<div class="col-lg-12">
					<div class="submitBtn">
						<button type="submit" class="btn btnSubmit btn-block" id="card-request-btn">Submit</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</section>
</section>
</section>

