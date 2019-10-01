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
								<center><h5>Employee Resignation Detail</h5></center>
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
								<?= ucwords($detail->employee_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Designation</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->designation_name); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Project</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->project_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Reason</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->reason_text; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Other Reason</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->reason; ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Resignation Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->resignation_date; ?>
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
								<label>Subject</label>
							</div>
							<div class="col-lg-10 col-print-10">
								<?= ucwords($detail->subject); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Description</label>
							</div>
							<div class="col-lg-10 col-print-10">
								<?= $detail->description; ?>
							</div>	
						</div>
					</div>
					<hr>
					
					<?php if($detail->decision_by != ''): ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Accepted By</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->decision_by); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Acceptance Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->decision_date; ?>
							</div>
						</div>
					</div>

					
					<?php endif; ?>
					

					<!-- <div class="row">
						<div class="col-lg-12">
							<div class="col-lg-3 col-print-3">
								<label>Confirmation Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->confirmed_date; ?>
							</div>
						</div>
					</div> -->
					

				</div>
			</section>
		<!-- </section> -->
		</div>

	</div>
</section>