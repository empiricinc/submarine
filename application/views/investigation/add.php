<section class="secMainWidth">
<section class="col-lg-12">
<section class="secFormLayout">
	<div class="mainInputBg">
		
		<div class="row" style="padding: 30px 15px;">
			<div class="col-lg-8">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
			</div>
			<div class="col-lg-4 text-right">
				<a href="javascript:void(0);" id="previous-inquiry-btn" class="label label-primary" data-id="<?= $basic_info->employee_id; ?>" style="font-size: 12px; font-weight: normal; padding: 5px 7px;"><i class="fa fa-info-circle"></i> View Previous Inquiries</a>
			</div>
			
			<div class="col-lg-12">
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
			</div>
		</div>

		<div class="row">
			<div class="col-lg-7">
				<div id="complaint-form-container">	
					<form method="POST" action="<?= base_url(); ?>Investigation/add_investigation" enctype="multipart/form-data">
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="hidden" name="employee_id" value="<?= $basic_info->employee_id; ?>">
								<input type="hidden" name="department_id" value="<?= $basic_info->department_id; ?>">
								<input type="hidden" name="designation_id" value="<?= $basic_info->designation_id; ?>">
								<input type="hidden" name="project_id" value="<?= $basic_info->company_id; ?>">
								<input type="hidden" name="province_id" value="<?= $basic_info->provience_id; ?>">
								<input type="text" name="name" value="<?= ucwords($basic_info->emp_name); ?>" id="inv-name" class="form-control" placeholder="Name" data-toggle="tooltip" title="Name" readonly>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="designation" value="<?= $basic_info->designation_name; ?>" id="inv-designation" class="form-control" placeholder="Designation"  data-toggle="tooltip" title="Designation" readonly>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<select name="reason" id="inv-reason" class="form-control reason" required="required">
									<option value="">Select Reason</option>
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
								<input type="text" name="other_reason" value="" id="inv-other-reason" class="form-control other-reason" placeholder="Other Reason"  data-toggle="tooltip" title="Other Reason" disabled>
							</div>
						</div>
						
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="reported_by" value="" id="inv-reported-by" class="form-control" placeholder="Reported By"  data-toggle="tooltip" title="Reported By" >
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="reported_date" value="" id="inv-reported-date" class="form-control date" placeholder="Reporting Date"  data-toggle="tooltip" title="Reporting Date">
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
								<input type="text" name="evidence_date" value="" id="inv-evidence-date" class="form-control date" placeholder="Evidence Date"  data-toggle="tooltip" title="Evidence Date" disabled>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="inputFormMain">
								<select name="complaint_mode" id="complaint-mode" class="form-control" required="required">
									<option value="">Select Complaint Mode</option>
									<option value="email">Email</option>
									<option value="post">Through Post</option>
									<option value="phone">Phone Call/SMS</option>
								</select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="inputFormMain">
								<select name="intensity" id="complaint-intensity" class="form-control" required="required">
									<option value="">Select Case Intensity</option>
									<option value="low">Low</option>
									<option value="moderate">Moderate</option>
									<option value="high">High</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="file" name="files[]" value="" id="inv-files" class="form-control" placeholder="files" data-toggle="tooltip" title="Attach Files" multiple>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="title" value="" id="inv-title" class="form-control" placeholder="Title" data-toggle="tooltip" title="Title" >
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<textarea name="description" id="inv-description" class="form-control" rows="5" placeholder="Preliminary Analysis of Complaint" style="resize:vertical;" required></textarea>
							</div>
						</div>
						
						
						<div class="col-lg-4">
							<div class="submitBtn">
								<button type="submit" name="submit" class="btn btnSubmit">Submit</button>		
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-5">
				<div id="basic-info" style="height: 570px; margin-right: 15px; border: 1px solid #e1e4e7; background: #f6f7f8; border-radius: 3px; overflow-y: scroll; padding: 15px;">
					 	
					 	<div class="row text-center">
					 		<?php $profile_img = ($basic_info->profile_picture == '') ? base_url().'assets/img/no-photo.png' : base_url().'uploads/profile/'.$basic_info->profile_picture; ?>
					 		<img src="<?= $profile_img; ?>" id="profile" alt="Profile Picture" width="100px" height="100px" class="img-circle" style="position: relative;">
					 	</div>

						<div class="row" style="margin-top: 15px;">
							<div class="col-lg-4"><strong>Name</strong></div>
							<div class="col-lg-8"><?= ucwords($basic_info->emp_name); ?></div>
						</div>
							
						<div class="row">
							<div class="col-lg-4"><strong>Father Name</strong></div>
							<div class="col-lg-8"><?= ucwords($basic_info->father_name); ?></div>
						</div>
							
						<div class="row">
							<div class="col-lg-4"><strong>Company</strong></div>
							<div class="col-lg-8"><?= ucwords($basic_info->company_name); ?></div>
						</div>
	
						<div class="row">
							<div class="col-lg-4"><strong>Department</strong></div>
							<div class="col-lg-8"><?= ucwords($basic_info->department_name); ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Designation</strong></div>
							<div class="col-lg-8"><?= ucwords($basic_info->designation_name); ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Gender</strong></div>
							<div class="col-lg-8"><?= ucwords($basic_info->gender_name); ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Blood Group</strong></div>
							<div class="col-lg-8"><?= $basic_info->blood_group_name; ?></div>
						</div>

						<div class="row">
						<div class="col-lg-4"><strong>DOB</strong></div>
							<div class="col-lg-8"><?= date('d-m-Y', strtotime($basic_info->date_of_birth)); ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Email</strong></div>
							<div class="col-lg-8"><?= $basic_info->email_address; ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Personal Contact</strong></div>
							<div class="col-lg-8"><?= $basic_info->personal_contact; ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Other Contact</strong></div>
							<div class="col-lg-8"><?= $basic_info->contact_other; ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>CTC Mobile No</strong></div>
							<div class="col-lg-8"><?= $basic_info->contact_number; ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Marital Status</strong></div>
							<div class="col-lg-8"><?= ucwords($basic_info->marital_name); ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>CNIC</strong></div>
							<div class="col-lg-8"><?= $basic_info->cnic; ?></div>
						</div>

						<div class="row">
						<div class="col-lg-4"><strong>CNIC Expiry</strong></div>
							<div class="col-lg-8"><?= date('d-m-Y', strtotime($basic_info->cnic_expiry_date)); ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Ethnicity</strong></div>
							<div class="col-lg-8"><?= $basic_info->ethnicity_name; ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Tribe</strong></div>
							<div class="col-lg-8"><?= $basic_info->tribe_name; ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Language</strong></div>
							<div class="col-lg-8"><?= $basic_info->language_name; ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Nationality</strong></div>
							<div class="col-lg-8"><?= $basic_info->country_name; ?></div>
						</div>

						<div class="row">
							<div class="col-lg-4"><strong>Religion</strong></div>
							<div class="col-lg-8"><?= $basic_info->religion_name; ?></div>
						</div>
				</div>
			</div>
		</div>
	</div>
</section>
</section>
</section>