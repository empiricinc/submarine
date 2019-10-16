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
			<div class="col-lg-12">
				<div class="alert alert-info" data-dismiss="alert" style="display: none;">
					<strong>Done!</strong> Your card request is submitted successfully
				</div>
			</div>
			
			<div id="card-form">
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
						<select data-plugin="select_hrm" name="reason" id="card-reason" class="form-control" required="required">
							<option value="">SELECT REASON</option>
							<?php foreach($reason AS $r): ?>
							<option value="<?= $r->id; ?>"><?= $r->reason_text; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				
				<div class="col-lg-12">
					<div class="submitBtn">
						<button class="btn btnSubmit btn-block" id="card-request-btn">Submit</button>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
</section>
</section>

