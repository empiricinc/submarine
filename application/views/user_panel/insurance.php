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
			<div class="col-lg-12 pt-10">
				<?php if($this->session->flashdata('success')): ?>
					<div class="alert alert-info" data-dismiss="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>
				<?php elseif($this->session->flashdata('error')): ?>
					<div class="alert alert-danger" data-dismiss="alert">
						<?php echo $this->session->flashdata('error'); ?>
					</div> 
				<?php endif; ?>
			</div>
			<div class="col-lg-12">
				<form action="<?= base_url(); ?>Insurance/add_claim" method="POST">
					<input type="hidden" name="employee_id" id="employee-id" value="<?= $employee->employee_id; ?>">
					<input type="hidden" name="url" value="<?= current_url(); ?>">
					<div class="row">
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="employee_name" value="<?= ucwords($employee->emp_name); ?>" id="employee-name" class="form-control" placeholder="Employee name" data-toggle="tooltip" title="Employee name" readonly>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="designation" value="<?= $employee->designation_name; ?>" id="designation" class="form-control" placeholder="Designation" data-toggle="tooltip" title="Designation" readonly>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="type" id="type" class="form-control" required>
									<!-- <option value="">SELECT TYPE</option> -->
									<option value="accident">Accident</option>
									<!-- <option value="death">Death</option> -->
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="incident_date" value="" id="incident-date" class="form-control date" placeholder="Incident Date" data-toggle="tooltip" title="Incident Date" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="reporting_date" value="" id="reporting-date" class="form-control date" placeholder="Reporting Date" data-toggle="tooltip" title="Reporting Date" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="subject" value="" id="subject" class="form-control" placeholder="Subject" data-toggle="tooltip" title="Subject" required>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="inputFormMain">
								<textarea name="description" id="description" class="form-control" rows="5" placeholder="Description" required></textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 submitBtn">
							<button type="submit" class="btn btnSubmit btn-block"> 
			    				Submit 
			    			</button>
						</div>
					</div>
				</form>
			</div>
		</div>
			
	</div>
</section>
</section>
</section>
