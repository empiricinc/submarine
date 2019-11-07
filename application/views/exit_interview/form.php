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

					<!-- Employee Info -->
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2">
								<label>Name</label>
							</div>
							<div class="col-lg-3">
								<input type="hidden" id="resignation-id" name="resignation_id" value="<?= $detail->resignation_id; ?>">
								<?= ucwords($detail->employee_name); ?>
							</div>
							<div class="col-lg-2"></div>
							<div class="col-lg-2">
								<label>Father Name</label>
							</div>
							<div class="col-lg-3">
								<?= ucwords($detail->father_name); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2">
								<label>CNIC</label>
							</div>
							<div class="col-lg-3">
								<?= $detail->cnic; ?>
							</div>
							<div class="col-lg-2"></div>
							<div class="col-lg-2">
								<label>Email</label>
							</div>
							<div class="col-lg-3">
								<?= $detail->email; ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2">
								<label>Personal Contact</label>
							</div>
							<div class="col-lg-3">
								<?= $detail->personal_contact; ?>
							</div>
						
							<div class="col-lg-2"></div>
							<div class="col-lg-2">
								<label>Other Contact</label>
							</div>
							<div class="col-lg-3">
								<?= $detail->contact_other; ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2">
								<label>Project</label>
							</div>
							<div class="col-lg-3">
								<?= ucwords($detail->project_name); ?>
							</div>
							<div class="col-lg-2"></div>
							<div class="col-lg-2">
								<label>Department</label>
							</div>
							<div class="col-lg-3">
								<?= ucwords($detail->department_name); ?>
							</div>
							
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2">
								<label>Designation</label>
							</div>
							<div class="col-lg-3">
								<?= ucwords($detail->designation_name); ?>
							</div>
							<div class="col-lg-2"></div>
							<div class="col-lg-2">
								<label></label>
							</div>
							<div class="col-lg-3"></div>
						</div>
					</div>
	
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2">
								<label>Reason</label>
							</div>
							<div class="col-lg-3">
								<?= $detail->reason_text; ?>
							</div>
							<div class="col-lg-2"></div>
							<div class="col-lg-2">
								<label>Other Reason</label>
							</div>
							<div class="col-lg-3">
								<?= ($detail->reason) ? ucwords($detail->reason) : 'N/A'; ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2">
								<label>Resignation Date</label>
							</div>
							<div class="col-lg-3">
								<?= ($detail->resignation_date) ? date('d-m-Y', strtotime($detail->resignation_date)) : ''; ?>
							</div>
							<div class="col-lg-2"></div>
							<div class="col-lg-2">
								<label></label>
							</div>
							<div class="col-lg-3">
								
							</div>
						</div>
					</div>
					<!-- ./ Employee Info -->
					
					<div class="solidLine"></div>
					<div class="row">
						<div class="col-lg-12">
							
						</div>
					</div>

				</div>
			</section>
		<!-- </section> -->
		</div>

	</div>
</section>