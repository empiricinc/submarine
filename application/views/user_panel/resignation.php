<section class="secMainWidth">
<section class="col-lg-8 col-lg-offset-2">
<section class="secFormLayout">
	<div class="mainInputBg">
		<div class="row" style="padding: 30px;">
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
			
			<form method="POST" action="<?= base_url(); ?>User_panel/add_resignation">
				<div class="col-lg-6">
					<div class="inputFormMain">
						<input type="text" name="employee_name" value="<?= ucwords($emp->emp_name); ?>" class="form-control" id="resg-name" readonly>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="inputFormMain">
						<input type="text" name="designation" value="<?= $emp->designation_name; ?>" id="resg-designation" class="form-control"  required readonly>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="inputFormMain">
						<select data-plugin="select_hrm" name="reason" id="resg-reason" class="form-control" required="required">
							<option value="">SELECT REASON OF RESIGNATION</option>
							<?php foreach($reasons AS $r): ?>
							<option value="<?= $r->reason_id; ?>"><?= $r->reason_text; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="inputFormMain">
						<input type="text" name="other_reason" class="form-control" id="resg-other-reason" placeholder="Other Reason">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="inputFormMain">
						<input type="text" name="notice_date" class="form-control date" id="notice-date" placeholder="Notice Date" required>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="inputFormMain">
						<input type="text" name="resignation_date" class="form-control date" id="resignation-date" placeholder="Resignation Date" required>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<input type="text" name="subject" class="form-control" id="resg-subject" placeholder="Subject" required>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="inputFormMain">
						<textarea name="description" id="resg-desc" class="form-control noresize" rows="3" placeholder="Description" required></textarea>
					</div>
				</div>
				<div class="col-lg-6"></div>
				<div class="col-lg-6">
					<div class="submitBtn">
						<button type="submit" class="btn btnSubmit btn-block" id="resg-submit">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
</section>
</section>

