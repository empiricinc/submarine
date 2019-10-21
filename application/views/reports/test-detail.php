<section class="secMainWidth remove-padding-print">
	<div class="row">
		
		<?php //var_dump($detail); exit; ?>
		<div class="col-lg-12">
		<!-- <section class="secMainWidth"> -->
			<section class="secFormLayout">
				<div class="mainInputBg remove-padding-print remove-margin-print no-border-print">

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
									<a href="<?= base_url(); ?>Reports/applicant_report_pdf/<?= $detail->rollnumber; ?>" target="_blank" class="btn"><i class="fa fa-file"></i> PDF</a>
								</div>
							
							</div>
						</div>

					</div>
					<div class="employee-detail-print-header hide-from-screen">
						<div class="row">
							<div class="col-md-12">
								<center><img src="http://localhost/submarine/uploads/logo/chip.png" height="50px" alt="CHIP Logo"></center>
							</div>
							<div class="col-md-12">
								<center><h4>CHIP Training &amp; Consulting Pvt Ltd.</h4></center>
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
								<label>Name</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->fullname); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Applicant ID</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->rollnumber; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Gender</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->applicant_gender; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>

						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Email</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->email; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Education</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->applicant_education; ?>
							</div>
						</div>
					</div>

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
								<label>City</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->city_name; ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Company</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->company_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>
					<br>

					<div class="row"><hr></div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Exam Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->exam_date)); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Obtain Marks</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->obtain_marks; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Total Marks</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->total_marks; ?>
							</div>
						</div>
					</div>

				</div>
			</section>
		<!-- </section> -->
		</div>

	</div>
</section>