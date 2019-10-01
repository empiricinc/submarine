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
									<!-- <a href="<?= base_url(); ?>Reports/employee_detail_pdf/<?= $detail->employee_id; ?>" target="_blank" class="btn"><i class="fa fa-file"></i> PDF</a> -->
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
								<center><h5>Insurance Claim Detail</h5></center>
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
								<?= ucwords($detail->emp_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Father Name</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->father_name); ?>
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
								<label>Department</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->department_name); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Designation</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->designation_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Location</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->location_name); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Gender</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->gender_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>DOB</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->date_of_birth)); ?>
							</div>
						</div>
					</div>
					
					<div class="row"><div class="col-lg-12"><hr></div></div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Incident Type</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucfirst($detail->type); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Incident Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->incident_date)); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Reported By</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucfirst($detail->reported_by); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Reported Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->reporting_date)); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Subject</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->subject; ?>
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
								<label>Description</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->description; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>
					
					<?php if($detail->remarks != ""): ?>
					<div class="row"><div class="col-lg-12"><hr></div></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Remarks By</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->remarks_by_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Remarks Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->remarks_date)); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Remarks</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->remarks; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>

						<?php if(!empty($files)): ?>
						<div class="row hide-from-print">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Files</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?php foreach($files AS $f): ?>
										<?php if($f->file_type == 'inprogress'): ?>
										<a href="<?= base_url(); ?>uploads/insurance_claims/<?= $f->file_name; ?>" class="label label-primary"><?= $f->original_name; ?></a>
									<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<?php endif; ?>

					<?php endif; ?>

					<?php if($detail->decision != ""): ?>
					<div class="row"><div class="col-lg-12"><hr></div></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Decision By</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->decision_by_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Decision Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->decision_date)); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Decision</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->decision); ?>
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
								<label>Decision Detail</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->decision_text; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>

						<?php if(!empty($files)): ?>
						<div class="row hide-from-print">
							<div class="col-lg-12">
								<div class="col-lg-2 col-print-2">
									<label>Files</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?php foreach($files AS $f): ?>
										<?php if($f->file_type == 'completed'): ?>
										<a href="<?= base_url(); ?>uploads/insurance_claims/<?= $f->file_name; ?>" class="label label-primary"><?= $f->original_name; ?></a>
									<?php endif; ?>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
						<?php endif; ?>
					<?php endif; ?>

					

				</div>
			</section>
		<!-- </section> -->
		</div>

	</div>
</section>