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
				<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-info" data-dismiss="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				<?php if($this->session->flashdata('error')): ?>
				<div class="alert alert-danger" data-dismiss="alert">
					<?php echo $this->session->flashdata('error'); ?>
				</div>
				<?php endif; ?>
			</div>
			
			<form method="post" action="<?= base_url(); ?>Terminations/terminate" id="termination-form">
				<div class="col-lg-12">
					<div class="inputFormMain">
						<select name="employee" id="employee" class="form-control" data-plugin="select_hrm" required="required">
							<option value="">SELECT EMPLOYEE</option>
							<?php foreach($employees as $e): ?>
							<option value="<?= $e->user_id; ?>"><?= ucwords($e->employee_name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="col-lg-12">
					<div class="inputFormMain">
						<select name="reason" id="resg-reason" class="form-control" data-plugin="select_hrm" required="required">
							<option value="">SELECT REASON OF TERMINATION</option>
							<?php foreach($reasons as $r): ?>
							<option value="<?= $r->id; ?>"><?= ucfirst($r->reason_text); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<input type="text" name="other_reason" class="form-control" id="termination-other-reason" placeholder="Other Reason">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<input type="text" name="termination_date" class="form-control date" id="termination-date" placeholder="Termination Date" required>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<textarea name="description" id="termination-desc" class="form-control vresize" rows="5" placeholder="Description" required></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="submitBtn">
						<button type="submit" class="btn btnSubmit btn-block" id="terminate-btn">Terminate</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
</section>
</section>

