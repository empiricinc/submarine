<section class="secMainWidth remove-padding-print">
	<div class="row">
		<div class="col-lg-12">
			<section class="secFormLayout">
				<div class="mainInputBg remove-padding-print remove-margin-print no-border-print">
					<!-- Training Detail -->
					<div class="training-detail">
						<div class="row hide-from-print">
							<div class="col-lg-10">
								<div class="tabelHeading">
									<h3 id="detail-box-title"><?= $title; ?></h3>
								</div>
							</div>
							<div class="col-md-2 text-right">
								<div class="tabelTopBtn">
									<div class="btn-group">
										<a href="javascript:void(0);" onclick="window.print();" class="btn"><i class="fa fa-print"></i> Print</a>
										<a href="<?= base_url(); ?>Reports/training_detail_pdf/<?= $detail->trg_id; ?>" target="_blank" class="btn"><i class="fa fa-file"></i> PDF</a>
									</div>
								
								</div>
							</div>
						</div>
						<div class="print-header hide-from-screen">
							<div class="row">
								<div class="col-md-12">
									<center><img src="<?= base_url(); ?>uploads/logo/chip.png" height="50px" alt="CHIP Logo"></center>
								</div>
								<div class="col-md-12">
									<center><h4>CHIP Training &amp; Consulting Pvt Ltd.</h4></center>
									<center><h5>Training Detail</h5></center>
								</div>
								<div class="col-md-12">
									<hr>
								</div>	
							</div>
						</div>
						<div class="solidLine hide-from-print"></div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Project</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= ucwords($detail->company); ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>Training Type</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->training_type; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Target Group</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->target_group; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>Participants</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= count(explode(',', $detail->trainee_employees)); ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Approval Type</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->approval_type; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>Session</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->session; ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Start Date</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= ($detail->start_date) ? date('d-m-Y', strtotime($detail->start_date)) : ''; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>End Date</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= ($detail->end_date) ? date('d-m-Y', strtotime($detail->end_date)) : ''; ?>
								</div>
							</div>
						</div>

						<div class="row"><hr></div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Province</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->province_name; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>District</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->district_name; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Hall Detail</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->hall_detail; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label></label>
								</div>
								<div class="col-lg-3 col-print-3">
									
								</div>
							</div>
						</div>
						
						<div class="row"><hr></div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-3 col-print-3">
									<label>Trainer 1</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Name</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->t1_name; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>Contact</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->t1_contact; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Email</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->t1_email; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>Address</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->t1_address; ?>
								</div>
							</div>
						</div>


						<div class="row"><hr></div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-3 col-print-3">
									<label>Trainer 2</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Name</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->t2_name; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>Contact</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->t2_contact; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Email</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->t2_email; ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>Address</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= $detail->t2_address; ?>
								</div>
							</div>
						</div>
					</div>
					<!-- ./ Training Detail -->
					


				</div>
			</section>
		
		</div>

	</div>
</section>