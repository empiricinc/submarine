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
									<div class="col-lg-4">
										<div class="form-group">
											<label>Employee name</label>
											<div class="inputFormMain">
												<input type="text" name="employee_name" class="form-control" id="employee-name" value="" readonly>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Job title</label>
											<div class="inputFormMain">
												<input type="text" name="job_title" class="form-control" id="job-title" value="" readonly>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>UC/District</label>
											<div class="inputFormMain">
												<input type="text" name="uc_district" class="form-control" id="uc-district" value="" readonly>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<label>Supervisor name</label>
											<div class="inputFormMain">
												<input type="text" name="supervisor_name" class="form-control" id="supervisor-name" value="" required>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Last working date</label>
											<div class="inputFormMain">
												<input type="text" name="last_working_date" class="form-control date" id="last-working-date" value="" required>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Exit interview date</label>
											<div class="inputFormMain">
												<input type="text" name="interview_date" class="form-control date" id="exit-interview-date" value="" required>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<label>Have you found the respondent?</label>
											<div class="inputFormMain">
												<select name="respondent_found" id="respondent-found" class="form-control" required>
													<option value="">Select option</option>
													<option value="1">Yes</option>
													<option value="0">No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Specify reason if not found</label>
											<div class="inputFormMain">
												<select name="not_found_reason" id="not-found-reason" class="form-control" required>
													<option value="">Select option</option>	
													<option value="1">Mobile not responding</option>
													<option value="2">Network issue/ Mobile unreachable</option>
													<option value="3">Other</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Other</label>
											<div class="inputFormMain">
												<input type="text" name="other_reason" class="form-control" id="other-reason" disabled>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="form-group">
											<label>Has the resignation endorsed by authority?</label>
											<div class="inputFormMain">
												<select name="endorsed_by_authority" class="form-control" id="endorsed-by-authority" required>
													<option value="">Select option</option>
													<option value="1">Yes</option>
													<option value="0">No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Authority name</label>
											<div class="inputFormMain">
												<input type="text" name="authority_name" id="authority-name" class="form-control" value="" required>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="form-group">
											<label>Designation name</label>
											<div class="inputFormMain">
												<select name="designation" id="designation" class="form-control" required>
													<option value="">Select designation</option>
													<option value=""></option>
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
												<select name="is_resignation_enforced" id="is-resignation-enforced" class="form-control" required>
													<option value="">Select option</option>
													<option value="1">Yes</option>
													<option value="0">No</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>If yes, please provide details</label>
											<div class="inputFormMain">
												<textarea name="is_resignation_enforced_detail" id="is_resignation_enforced_detail" class="form-control" rows="3" required="required"></textarea>
											</div>
										</div>
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label>The reason that you are leaving your position.</label>
											<div class="inputFormMain">
												<select name="position_leaving_reason" id="position-leaving-reason" class="form-control" required="required">
													<option value="">Select option</option>
													<option value="1">Inadequate Pay</option>
													<option value="2">Field Difficulty / Security reasons</option>
													<option value="3">Personal / Domestic reasons</option>
													<option value="4">For better career opportunities</option>
													<option value="5">Unhappy with supervisor</option>
													<option value="6">Maternity</option>
													<option value="7">Other</option>
													<option value="8">Got New Job Position in CBV/COMNet</option>
													<option value="9">Further Studies</option>
													<option value="10">Relocation</option>
													<option value="11">Health Issues</option>
													<option value="12">Marriage</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label>Other Reason</label>
											<div class="inputFormMain">
												<input type="text" name="position_leaving_other_reason" id="position-leaving-other-reason" class="form-control" value="" readonly>
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="form-group">
											<label>Leaving comments</label>
											<div class="inputFormMain">
												<textarea name="leaving_comments" id="leaving-comments" class="form-control" rows="3" required></textarea>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label>Have you returned the Program tools and the Program ID card to your respective supervisor ?</label>
											<div class="inputFormMain">
												<select name="returned_tools" id="returned-tools" class="form-control" required>
													<option value="">Select option</option>
													<option value="1">Yes</option>
													<option value="0">No</option>
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
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<label>Was your supervisor supportive in improving your performance and capabilities</label>
										<div class="inputFormMain">
											<select name="support" id="support" class="form-control" required="required">
												<option value="">Select option</option>
												<option value="1">Yes</option>
												<option value="0">No</option>
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
												<select name="rejoin" id="rejoin" class="form-control" required="required">
													<option value="">Select option</option>
													<option value="1">Yes</option>
													<option value="0">No</option>
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