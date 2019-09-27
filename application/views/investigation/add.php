<section class="secMainWidth">
<section class="col-lg-10 col-lg-offset-1">
<section class="secFormLayout">
	<div class="mainInputBg">

		<div class="row" style="padding: 30px;">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
			</div>
			<div id="complaint-form-container">
				
				<div class="col-lg-12">
					<?php if(isset($errors)): ?>
						<div class="alert alert-danger" data-dismiss="alert">
							<?php echo $errors; ?>
						</div>
					<?php endif; ?>
					
					<?php if($this->session->flashdata('success')): ?>
						<div class="alert alert-info" data-dismiss="alert">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
					<?php endif; ?>
				</div>
				
				<?php echo form_open('Investigation/add_investigation'); ?>
				
				<!-- <form method="POST" action="<?= base_url(); ?>Investigation/add_investigation" id="investigation-form"> -->
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="hidden" name="employee_id" value="<?= $employee->id; ?>">
							<input type="hidden" name="department_id" value="<?= $employee->department_id; ?>">
							<input type="hidden" name="designation_id" value="<?= $employee->designation_id; ?>">
							<input type="hidden" name="project_id" value="<?= $employee->company_id; ?>">
							<input type="text" name="name" value="<?= $employee->name; ?>" id="inv-name" class="form-control" placeholder="Name" data-toggle="tooltip" title="Name" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="designation" value="<?= $employee->designation_name; ?>" id="inv-designation" class="form-control" placeholder="Designation"  data-toggle="tooltip" title="Designation" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="reason" id="inv-reason" class="form-control" required="required">
								<option value="">Reason</option>
								<?php foreach($reasons AS $r): ?>
								<?php if($r->parent_id == '0'): ?>

								<?php endif; ?>
								<option value="<?= $r->id; ?>"><?= $r->reason_text; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="other_reason" value="" id="inv-other-reason" class="form-control" placeholder="Other Reason"  data-toggle="tooltip" title="Other Reason" >
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="reported_by" value="" id="inv-reported-by" class="form-control" placeholder="Reported By"  data-toggle="tooltip" title="Reported By" >
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="reported_date" value="" id="inv-reported-date" class="form-control date" placeholder="Reporting Date"  data-toggle="tooltip" title="Reporting Date" >
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="evidence" id="inv-evidence" class="form-control" required="required">
								<option value="">Evidence</option>
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="evidence_date" value="" id="inv-reported-date" class="form-control date" placeholder="Evidence Date"  data-toggle="tooltip" title="Evidence Date" >
						</div>
					</div>
					
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="description" id="inv-description" class="form-control" rows="5" placeholder="Investigation Detail..." style="resize:vertical;" required></textarea>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="submitBtn">
							<button type="submit" name="submit" class="btn btn-block btnSubmit">Submit</button>		
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
</section>
</section>