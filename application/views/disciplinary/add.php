<section class="secMainWidth hide-from-print">
	<section class="secFormLayout">
		<div class="mainInputBg">

			<div class="row">
				<div class="col-lg-10">
					<div class="tabelHeading" style="margin-bottom: 0px;">
						<h3>
							<?= $title; ?>
						</h3>
					</div>
				</div>
			</div>

			<div class="solidLine"></div>

			<div class="row">
				<form action="<?= base_url(); ?>Disciplinary/add" method="POST">
	    			<div class="col-lg-12">
	    				<div class="col-lg-6">
	    					<input type="hidden" name="employee_id" id="employee-id" value="<?= $detail->employee_id; ?>">
	    					<input type="hidden" name="project_id" id="project-id" value="<?= $detail->company_id; ?>">
	    					<input type="hidden" name="province_id" id="province-id" value="<?= $detail->provience_id; ?>">
	    					<input type="hidden" name="department_id" id="department-id" value="<?= $detail->department_id; ?>">
	    					<input type="hidden" name="designation_id" id="designation-id" value="<?= $detail->designation_id; ?>">
							<div class="inputFormMain">
								<label>Employee Name</label>
								<input type="text" name="employee_name" id="employee-name" class="form-control" value="<?= ucwords($detail->emp_name); ?>" readonly>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Designation</label>
								<input type="text" name="designation_name" id="designation-name" class="form-control" value="<?= ucwords($detail->designation_name); ?>" readonly>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Type</label>
								<select name="type_id" id="type" class="form-control" required="required">
									<option value="">SELECT TYPE</option>
									<?php foreach($type AS $t): ?>
										<option value="<?= $t->id; ?>"><?= ucwords($t->type_name); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Reason</label>
								<select name="reason" id="reason" class="form-control" required="required">
									<option value="">SELECT REASON</option>
									<?php foreach($reasons AS $r): ?>
										<?php if($r->parent_id == '0') { ?>
											<optgroup label="<?= $r->reason_text; ?>">
										<?php } else { ?>
												<option value="<?= $r->id; ?>"><?= $r->reason_text; ?></option>
										<?php } ?>
										<?php endforeach; ?>
									<option value="other">Other</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Other Reason</label>
								<input type="text" name="other_reason" id="other-reason" class="form-control" disabled>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Reported By</label>
								<input type="text" name="reported_by" class="form-control">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Reporting Date</label>
								<input type="text" name="reporting_date" class="form-control date">
							</div>
						</div>


						<div class="disciplinary">
							
						</div>


						<div class="col-lg-12">
							<div class="inputFormMain">
								<label>Subject</label>
								<input type="text" name="subject" class="form-control">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<label>Description</label>
								<textarea name="description" id="description" class="form-control" rows="3" required="required"></textarea>
							</div>
						</div>
						
						<div class="col-lg-3">
							<div class="submitBtn">
								<button type="submit" class="btn btnSubmit" name="submit"> Add </button> 
							</div>
						</div>
						
	    			</div>			
		    	</form>
		    </div>

		</div>
	</section>
</section>

