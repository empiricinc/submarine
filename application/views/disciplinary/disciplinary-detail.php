<div class="col-lg-12">
	<div class="col-lg-2"><strong>Employee Name</strong></div>
	<div class="col-lg-2"><strong>Project</strong></div>
	<div class="col-lg-2"><strong>Department</strong></div>
	<div class="col-lg-2"><strong>Designation</strong></div>
	<div class="col-lg-2"><strong>CNIC</strong></div>
</div>
<div class="col-lg-12 pb-5">
	<div class="col-lg-2"><?= ucwords($detail->emp_name); ?></div>
	<div class="col-lg-2"><?= ucwords($detail->project_name); ?></div>
	<div class="col-lg-2"><?= ucwords($detail->department_name); ?></div>
	<div class="col-lg-2"><?= ucwords($detail->designation_name); ?></div>
	<div class="col-lg-2"><?= ucwords($detail->cnic); ?></div>
</div>

<div class="col-lg-12 pt-5">
	<div class="col-lg-2"><strong>Type</strong></div>
	<div class="col-lg-2"><strong>Status</strong></div>
	<div class="col-lg-2"><strong>Reason</strong></div>
	<div class="col-lg-2"><strong>Other reason</strong></div>
	<div class="col-lg-2"><strong>Reported by</strong></div>
	<div class="col-lg-2"><strong>Reported date</strong></div>
</div>

<div class="col-lg-12 pb-5">
	<div class="col-lg-2">
		<label class="primary-label"><?= ucwords($detail->type_name); ?></label>
	</div>
	<div class="col-lg-2">
		<label class="warning-label"><?= ucwords($detail->status_text); ?></label>
	</div>
	<div class="col-lg-2">
		<?= ($detail->reason_text) ? '<label class="success-label">'.$detail->reason_text.'</label>' : ''; ?>
	</div>
	<div class="col-lg-2"><?= $detail->other_reason; ?></div>
	<div class="col-lg-2"><?= ucwords($detail->reported_by); ?></div>
	<div class="col-lg-2">
		<?= ($detail->reported_date) ? date('d-m-Y', strtotime($detail->reported_date)) : ''; ?>
	</div>
</div>

<div class="col-lg-12 pt-5">
	<div class="col-lg-2"><strong>Created by</strong></div>
	<div class="col-lg-2"><strong>Created date</strong></div>
</div>

<div class="col-lg-12 pb-5">
	<div class="col-lg-2"><?= ucwords($detail->created_by); ?></div>
	<div class="col-lg-2">
		<?= ($detail->created_date) ? date('d-m-Y', strtotime($detail->created_date)) : ''; ?>
	</div>
</div>

<?php if($type == 'Warning' || $type == 'Final Warning' || $type == 'Explanation' || $type == 'Suspension' || $type == 'Query' || $type == 'Show Cause' || $type == 'Resign'): ?>

	<div class="col-lg-12 pt-5">
		<div class="col-lg-2"><strong>Evidence</strong></div>
		<div class="col-lg-2"><strong>Evidence date</strong></div>
		<div class="col-lg-2"><strong>Salary hold</strong></div>
	</div>

	<div class="col-lg-12 pb-5">
		<div class="col-lg-2">
			<?= ($detail->evidence) ? 'Yes' : 'No'; ?>
		</div>
		<div class="col-lg-2">
			<?= ($detail->evidence_date) ? date('d-m-Y', strtotime($detail->evidence_date)) : ''; ?>
		</div>
		<div class="col-lg-2">
			<?= ($detail->salary_hold) ? 'Yes' : 'No'; ?>
		</div>
	</div>

<?php elseif($type == 'Show Cause' || $type == 'Resign'): ?>

	<div class="col-lg-12 pt-5">
		<div class="col-lg-2">
			<?= ($detail->suspend_from_duty) ? 'Yes' : 'No'; ?>
		</div>
	</div>

<?php elseif($type == 'Contract Closure' || $type == 'Refusal'): ?>

	<div class="col-lg-12">
		<div class="col-lg-2"></div>
	</div>

<?php endif; ?>