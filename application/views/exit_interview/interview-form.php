<section class="secMainWidth remove-padding-print">
	<div class="row">
		
		<div class="col-lg-12">
		<!-- <section class="secMainWidth"> -->
			<section class="secFormLayout">
				<div class="mainInputBg">
					<div class="row">
						<div class="col-lg-12">
							<div class="tabelHeading">
								<h3>
									<?= $title; ?>
								</h3>

								<br>

								<div class="row">
									<div class="col-lg-12">
										<?php if($this->session->flashdata('success')) { ?>
										<div class="alert alert-info" data-dismiss="alert">
											<strong>Success!</strong> <?= $this->session->flashdata('success'); ?>
										</div>
										<?php } elseif($this->session->flashdata('error')) { ?>
										<div class="alert alert-danger" data-dismiss="alert">
											<strong>Error!</strong> <?= $this->session->flashdata('error'); ?>
										</div>
										<?php } ?>
									</div>
								</div>

								<div class="solidLine"></div>
							</div>
						</div>
					</div>
					
					<form action="<?= base_url(); ?>Exit_interview/save" method="POST">

						<div id="employee-detail">
							<div class="panel panel-default">
								<div class="panel-heading">
									<label class="mtb-0">Employee Detail</label>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12">
									<div class="col-lg-6">
										<div class="form-group">
											<label>Employee name</label>
											<div class="inputFormMain">
												<input type="hidden" name="employee_id" value="<?= $detail->employee_id; ?>">
												<input type="hidden" name="resignation_id" value="<?= $detail->resignation_id; ?>">
												<input type="text" name="employee_name" class="form-control" id="employee-name" value="<?= ucwords($detail->employee_name); ?>" readonly>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Job title</label>
											<div class="inputFormMain">
												<input type="text" name="job_title" class="form-control" id="job-title" value="<?= $detail->job_title; ?>" readonly>
											</div>
										</div>
									</div>
									<!-- <div class="col-lg-4">
										<div class="form-group">
											<label>UC/District</label>
											<div class="inputFormMain">
												<input type="text" name="uc_district" class="form-control" id="uc-district" value="" readonly>
											</div>
										</div>
									</div> -->

									<div class="col-lg-4">
										<div class="form-group">
											<label>Supervisor name</label>
											<div class="inputFormMain">
												<input type="text" name="supervisor_name" class="form-control" id="supervisor-name" value="<?= $detail->supervisor_name; ?>" required>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Last working date</label>
											<div class="inputFormMain">
												<input type="text" name="last_working_date" class="form-control date" id="last-working-date" value="<?= $detail->last_working_date; ?>" required>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Exit interview date</label>
											<div class="inputFormMain">
												<input type="text" name="interview_date" class="form-control date" id="exit-interview-date" value="<?= $detail->interview_date; ?>" required>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<label>Have you found the respondent?</label>
											<div class="inputFormMain">
												<select name="respondent_found" id="respondent-found" class="form-control" required>
													<option value="">Select option</option>
													<option value="1" 
													<?php if($detail->respondent_found == '1') { ?> selected <?php } ?>
													>Yes</option>
													<option value="0"
													<?php if($detail->respondent_found == '0') { ?> selected <?php } ?>
													>No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Specify reason if not found</label>
											<div class="inputFormMain">
												<select name="respondent_not_found_reason" id="respondent-not-found-reason" class="form-control" required>
													<option value="">Select option</option>	
													<?php foreach ($respondent_not_found_reasons as $r): ?>
													<option value="<?= $r->id; ?>"
													<?php if($detail->respondent_not_found_reason == $r->id) { ?> selected <?php } ?>
														><?= ucwords($r->reason_text); ?></option>
													<?php endforeach; ?>
													<option value="0"
													<?php if($detail->respondent_not_found_reason == '0') { ?> selected <?php } ?>
													>Other</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Other</label>
											<div class="inputFormMain">
												<input type="text" name="respondent_not_found_other_reason" class="form-control" id="respondent-not-found-other-reason" value="<?= $detail->respondent_not_found_other_reason; ?>" <?php if($detail->respondent_not_found_reason != '0') { ?> readonly <?php } ?>>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<label>Has the resignation endorsed by authority?</label>
											<div class="inputFormMain">
												<select name="endorsed_by_authority" class="form-control" id="endorsed-by-authority" required>
													<option value="">Select option</option>
													<option value="1"
													<?php if($detail->endorsed_by_authority == '1') { ?> selected <?php } ?>
													>Yes</option>
													<option value="0"
													<?php if($detail->endorsed_by_authority == '0') { ?> selected <?php } ?>
													>No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Authority name</label>
											<div class="inputFormMain">
												<input type="text" name="authority_name" id="authority-name" class="form-control" value="<?= $detail->authority_name; ?>" required>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Designation name</label>
											<div class="inputFormMain">
												<select name="designation" id="designation" class="form-control" required>
													<option value="">Select designation</option>
													<?php foreach($designations AS $d): ?>
													<option value="<?= $d->designation_id; ?>"
													<?php if($detail->designation_id == $d->designation_id) { ?> selected <?php } ?>
														><?= ucwords($d->designation_name); ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div id="resignation-verification">
							<div class="panel panel-default">
								<div class="panel-heading">
									<label class="mtb-0">Section A: Resignation Verification</label>
								</div>
							</div>
							
							<div class="row">
								<div class="col-lg-12">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Have you submitted your resignation under any influence/ fear or is it a forced resignation?</label>
											<div class="inputFormMain">
												<select name="resignation_enforced" id="resignation-enforced" class="form-control" required>
													<option value="">Select option</option>
													<option value="1"
													<?php if($detail->resignation_enforced == '1') { ?> selected <?php } ?>
													>Yes</option>
													<option value="0"
													<?php if($detail->resignation_enforced == '0') { ?> selected <?php } ?>
													>No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>If yes, please provide details</label>
											<div class="inputFormMain">
												<textarea name="resignation_enforced_detail" id="resignation_enforced_detail" class="form-control" rows="3" required="required"><?= trim($detail->resignation_enforced_detail); ?></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label>The reason that you are leaving your position.</label>
											<div class="inputFormMain">
												<select name="position_leaving_reason" id="position-leaving-reason" class="form-control" required="required">
													<option value="">Select option</option>
													<?php foreach($position_leaving_reasons AS $r): ?>
													<option value="<?= $r->id; ?>"
													<?php if($detail->position_leaving_reason == $r->id) { ?> selected <?php } ?>
														><?= ucwords($r->reason_text); ?></option>
													<?php endforeach; ?>
													<option value="0"
													<?php if($detail->position_leaving_reason == '0') { ?> selected <?php } ?>
													>Other</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Other Reason</label>
											<div class="inputFormMain">
												<input type="text" name="position_leaving_other_reason" id="position-leaving-other-reason" class="form-control" value="" 
												<?php if($detail->position_leaving_reason != '0') { ?> readonly <?php } ?>
												>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="form-group">
											<label>Leaving comments</label>
											<div class="inputFormMain">
												<textarea name="position_leaving_comments" id="leaving-comments" class="form-control" rows="3" required><?= trim($detail->position_leaving_comments); ?></textarea>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Have you returned the Program tools and the Program ID card to your respective supervisor ?</label>
											<div class="inputFormMain">
												<select name="company_property_returned" id="returned-tools" class="form-control" required>
													<option value="">Select option</option>
													<option value="1"
													<?php if($detail->company_property_returned == '1') { ?> selected <?php } ?>
													>Yes</option>
													<option value="0"
													<?php if($detail->company_property_returned == '0') { ?> selected <?php } ?>
													>No</option>
												</select>
											</div>
										</div>
									</div>


								</div>
							</div>
						</div>

						<div id="supervision">
							<div class="panel panel-default">
								<div class="panel-heading">
									<label class="mtb-0">Section B: Supportive Supervision</label>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12">
									<div class="col-lg-6">
										<label>Did your supervisor monitor your performance during your field activities</label>
										<div class="inputFormMain">
											<select name="supervision" id="supervision" class="form-control" required>
												<option value="">Select option</option>
												<option value="1"
												<?php if($detail->supervision == '1') { ?> selected <?php } ?>
												>Yes</option>
												<option value="0"
												<?php if($detail->supervision == '0') { ?> selected <?php } ?>
												>No</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<label>Was your supervisor supportive in improving your performance and capabilities</label>
										<div class="inputFormMain">
											<select name="supervisor_support" id="support" class="form-control" required="required">
												<option value="">Select option</option>
												<option value="1"
												<?php if($detail->supervisor_support == '1') { ?> selected <?php } ?>
												>Yes</option>
												<option value="0"
												<?php if($detail->supervisor_support == '0') { ?> selected <?php } ?>
												>No</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div id="work-environment">
							<div class="panel panel-default">
								<div class="panel-heading">
									<label class="mtb-0">Section C: Working Environment</label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<div class="col-lg-12">
										<div class="form-group">
											<label>If a given an opportunity would you like to rejoin this project in future</label>
											<div class="inputFormMain">
												<select name="like_to_rejoin" id="rejoin" class="form-control" required="required">
													<option value="">Select option</option>
													<option value="1"
													<?php if($detail->like_to_rejoin == '1') { ?> selected <?php } ?>
													>Yes</option>
													<option value="0"
													<?php if($detail->like_to_rejoin == '0') { ?> selected <?php } ?>
													>No</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-4">
									<div class="submitBtn">
										<button type="submit" name="submit" class="btn btnSubmit">Save</button>
									</div>
								</div>
							</div>
						</div>

					</form>

				</div>
			</section>
		<!-- </section> -->
		</div>

	</div>
</section>