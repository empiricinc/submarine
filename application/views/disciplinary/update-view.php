<div class="col-lg-4">
	<input type="hidden" name="disciplinary_id" value="<?= $detail->id; ?>">
	<div class="inputFormMain">
		<label>Employee Name</label>
		<input type="text" name="employee_name" id="employee-name" class="form-control" value="<?= ucwords($detail->emp_name); ?>" readonly>
	</div>
</div>
<div class="col-lg-4">
	<div class="inputFormMain">
		<label>Designation</label>
		<input type="text" name="designation_name" id="designation-name" class="form-control" value="<?= ucwords($detail->designation_name); ?>" readonly>
	</div>
</div>

<div class="col-lg-4">
	<div class="inputFormMain">
		<label>Type</label>
		<select name="type_id" id="type" class="form-control" required="required" disabled>
			<option value="">SELECT TYPE</option>
			<?php foreach($disciplinary_types AS $dt): ?>
				<option value="<?= $dt->id; ?>"
					<?php if($detail->type_id == $dt->id) { ?> selected <?php } ?>
					><?= ucwords($dt->type_name); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

<div class="col-lg-4">
	<div class="inputFormMain">
		<label>Reason</label>
		<select name="reason" id="reason" class="form-control reason" required="required">
			<option value="">SELECT REASON</option>
			<?php foreach($reasons AS $r): ?>
				<?php if($r->parent_id == '0') { ?>
					<optgroup label="<?= $r->reason_text; ?>">
				<?php } else { ?>
						<option value="<?= $r->id; ?>"
							<?php if($detail->reason_id == $r->id) { ?> selected <?php } ?>
							><?= $r->reason_text; ?></option>
				<?php } ?>
				<?php endforeach; ?>
			<option value="other">Other</option>
		</select>
	</div>
</div>
<div class="col-lg-4">
	<div class="inputFormMain">
		<label>Other Reason</label>
		<input type="text" name="other_reason" id="other-reason" class="form-control other-reason" value="<?= $detail->other_reason; ?>" <?php if($detail->reason_text != 'other') { ?> disabled <?php } ?>>
	</div>
</div>

<div class="col-lg-4">
	<div class="inputFormMain">
		<label>Reported By</label>
		<input type="text" name="reported_by" class="form-control" value="<?= ucwords($detail->reported_by); ?>">
	</div>
</div>
<div class="col-lg-4">
	<div class="inputFormMain">
		<label>Reporting Date</label>
		<input type="text" name="reported_date" class="form-control date" value="<?= ($detail->reported_date) ? date('Y-m-d', strtotime($detail->reported_date)) : ''; ?>">
	</div>
</div>

<?php if($type == 'Warning' || $type == 'Final Warning' || $type == 'Explanation' || $type == 'Suspension' || $type == 'Query' || $type == 'Show Cause' || $type == 'Resign'): ?>
	
	<div class="">
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Evidence</label>
				<select name="evidence" id="evidence" class="form-control" required>
					<option value="">SELECT EVIDENCE</option>
					<option value="1"
						<?php if($detail->evidence == '1') { ?> selected <?php } ?>
					>Yes</option>
					<option value="0"
						<?php if($detail->evidence == '0') { ?> selected <?php } ?>
					>No</option>
				</select>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Evidence Date</label>
				<input type="text" name="evidence_date" class="form-control date" value="<?= ($detail->evidence_date) ? date('Y-m-d', strtotime($detail->evidence_date)) : ''; ?>">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Salary Hold</label>
				<select name="salary_hold" id="salary" class="form-control" required="required">
					<option value="">SALARY HOLD</option>
					<option value="1"
						<?php if($detail->salary_hold == '1') { ?> selected <?php } ?>
					>Yes</option>
					<option value="0"
						<?php if($detail->salary_hold == '0') { ?> selected <?php } ?>
					>No</option>
				</select>
			</div>
		</div>
	</div>
	

	<?php elseif($type == 'Show Cause' || $type == 'Resign'): ?>
	<div class="">
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Suspend from Duty</label>
				<select name="suspend_from_duty" id="suspend" class="form-control" required="required">
					<option value="">SELECT OPTION</option>
					<option value="1"
						<?php if($detail->suspend_from_duty == '1') { ?> selected <?php } ?>
					>Yes</option>
					<option value="0"
						<?php if($detail->suspend_from_duty == '0') { ?> selected <?php } ?>
					>No</option>
				</select>
			</div>
		</div>
	</div>


	<?php elseif($type == 'Contract Closure' || $type == 'Refusal'): ?>
	<div class="">
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Issue Reporting Date</label>
				<input type="text" name="issue_reporting_date" class="form-control date" value="<?= $detail->issue_reporting_date; ?>">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Salary Hold</label>
				<select name="salary_hold" id="salary" class="form-control" required="required">
					<option value="">SELECT OPTION</option>
					<option value="1"
						<?php if($detail->salary_hold == '1') { ?> selected <?php } ?>
					>Yes</option>
					<option value="0"
						<?php if($detail->salary_hold == '0') { ?> selected <?php } ?>
					>No</option>
				</select>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Last Working Date</label>
				<input type="text" name="last_working_date" class="form-control date" value="<?= $detail->last_working_date; ?>">
			</div>
		</div>

		<?php if($type == 'Contract Closure'): ?>
			<div class="col-lg-4">
				<div class="inputFormMain">
					<label>Position Abolish</label>
					<select name="position_abolish" id="position_abolish" class="form-control" required="required">
						<option value="">SELECT OPTION</option>
						<option value="1"
							<?php if($detail->position_abolish == '1') { ?> selected <?php } ?>
						>Yes</option>
						<option value="0"
							<?php if($detail->position_abolish == '0') { ?> selected <?php } ?>
						>No</option>
					</select>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="inputFormMain">
					<label>Abolish Date</label>
					<input type="text" name="abolish_date" class="form-control date" value="<?= $detail->abolish_date; ?>">
				</div>
			</div>
		<?php endif; ?>
	</div>
	

	<?php elseif($type == 'Transfer'): ?>
	<div class="">
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Transfer Type</label>
				<select name="salary_hold" id="salary" class="form-control" required="required">
					<option value="">SELECT OPTION</option>
					<?php foreach ($transfer_type as $tt): ?>
					<option value="<?= $tt->id; ?>" 
						<?php if($detail->transfer_type == $tt->id) { ?> selected <?php } ?>
						><?= ucwords($tt->name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Position Abolish</label>
				<select name="position_abolish" id="position_abolish" class="form-control" required="required">
					<option value="">SELECT OPTION</option>
					<option value="1" 
						<?php if($detail->position_abolish == '1') { ?> selected <?php } ?>
					>Yes</option>
					<option value="0"
						<?php if($detail->position_abolish == '0') { ?> selected <?php } ?>
					>No</option>
				</select>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Abolish Date</label>
				<input type="text" name="abolish_date" class="form-control date" value="<?= ($detail->abolish_date) ? date('Y-m-d', strtotime($detail->abolish_date)) : ''; ?>">
			</div>
		</div>

		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Reporting Date To CTC</label>
				<input type="text" name="reported_date_ctc" class="form-control date" value="<?= ($detail->reported_date_ctc) ? date('Y-m-d', strtotime($detail->reported_date_ctc)) : ''; ?>">
			</div>
		</div>

		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Province</label>
				<select name="province" id="province" class="form-control province" required="required">
					<option value="">SELECT OPTION</option>
					<?php foreach ($provinces as $p): ?> 
					<option value="<?= $p->id; ?>" 
						<?php if($detail->province_id == $p->id) { ?> selected <?php } ?>
						><?= ucwords($p->name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>District</label>
				<select name="district" id="district" class="form-control district" required="required">
					<option value="">SELECT OPTION</option>
					<?php foreach($districts AS $d): ?>
					<option value="<?= $d->id; ?>"
						<?php if($detail->district_id == $d->id) { ?> selected <?php } ?>
						><?= ucwords($d->name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Tehsil</label>
				<select name="tehsil" id="tehsil" class="form-control tehsil" required="required">
					<option value="">SELECT OPTION</option>
					<?php foreach($tehsils AS $t): ?>
					<option value="<?= $t->id; ?>"
						<?php if($detail->tehsil_id == $t->id) { ?> selected <?php } ?>
						><?= ucwords($t->name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>UC</label>
				<select name="uc" id="uc" class="form-control" required="required">
					<option value="">SELECT OPTION</option>
					<?php foreach($union_councils AS $uc): ?>
					<option value="<?= $uc->id; ?>"
						<?php if($detail->uc_id == $uc->id) { ?> selected <?php } ?>
						><?= ucwords($uc->name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Position Filled Against</label>
				<select name="position_filled_against" id="position_filled_against" class="form-control" required="required">
					<option value="">SELECT OPTION</option>
					<?php foreach ($position_filled_against as $pfa): ?>
					<option value="<?= $pfa->id; ?>" 
						<?php if($detail->position_filled_against == $pfa->id) { ?> selected <?php } ?>
						><?= ucwords($pfa->name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>New Job Position</label>
				<select name="job_position" id="job_position" class="form-control" required="required">
					<option value="">SELECT OPTION</option>
					<?php foreach($job_positions AS $jp): ?>
					<option value="<?= $jp->designation_id; ?>"
						<?php if($detail->job_position == $jp->designation_id) { ?> selected <?php } ?>
						><?= $jp->designation_name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="inputFormMain">
				<label>Transfer Effective Date</label>
				<input type="text" name="transfer_effective_date" class="form-control date" value="<?= ($detail->transfer_effective_date) ? date('Y-m-d', strtotime($detail->transfer_effective_date)) : ''; ?>">
			</div>
		</div>
	</div>

<?php endif; ?>

<div class="col-lg-4">
	<div class="inputFormMain">
		<label>Category</label>
		<select name="category" class="form-control" required>
			<option value="">SELECT CATEGORY</option>
			<?php foreach($category AS $cat): ?>
			<option value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
</div>

<div class="col-lg-12">
	<div class="inputFormMain">
		<label>Subject</label>
		<input type="text" name="subject" class="form-control" value="<?= $detail->subject; ?>">
	</div>
</div>
<div class="col-lg-12">
	<div class="inputFormMain">
		<label>Description</label>
		<textarea name="description" id="description" class="form-control" rows="3" required="required"><?= $detail->description; ?>
		</textarea>
	</div>
</div>