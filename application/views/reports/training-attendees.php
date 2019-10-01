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
										<a href="<?= base_url(); ?>Reports/attendance_detail_pdf/<?= $detail->trg_id; ?>" target="_blank" class="btn"><i class="fa fa-file"></i> PDF</a>
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
									<center><h5>Training Attendance Detail</h5></center>
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
									<?= date('d-m-Y', strtotime($detail->start_date)); ?>
								</div>
								<div class="col-lg-2 col-print-2"></div>
								<div class="col-lg-2 col-print-2">
									<label>End Date</label>
								</div>
								<div class="col-lg-3 col-print-3">
									<?= date('d-m-Y', strtotime($detail->end_date)); ?>
								</div>
							</div>
						</div>
					</div>
					<!-- ./ Training Detail -->
					
					<!-- Attendance Detail -->
					<?php if(!empty($attendees)): ?>
					<div class="row"><hr></div>
					<!-- <div class="row">
						<div class="col-md-12">
							<div class="">
								<label>Employee's Attendance</label>
							</div>
						</div>
					</div> -->
					<div class="attendance-detail">
						<div class="row">
							<div class="col-lg-12">

								<table class="table table-condensed table-bordered">
									<thead>
										<tr>
											<!-- <th>#</th> -->
											<th>Name</th>
											<th>Designation</th>
											<!-- <th>Attendance</th> -->
											<?php foreach($attendance_date AS $ad): ?>
											<th>
												<?= date('d,M', strtotime($ad->attendance_date)); ?>
											</th>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php for($i=0; $i<count($attendees); $i++): ?>
										<tr>
											<td><?= ucwords($attendees[$i]['employee_name']); ?></td>
											<td><?= $attendees[$i]['designation_name']; ?></td>
											<?php foreach($attendance_date AS $ad): ?>
											<td>
												<?php $attRow = $this->Reports_model->datewise_attendance($attendees[$i]['training_id'], $attendees[$i]['employee_id'], date('Y-m-d', strtotime($ad->attendance_date))); ?>
												<?php if(!empty($attRow)) { echo $attRow->status; } ?>
											</td>
											<?php endforeach; ?>
										</tr>
										<?php endfor; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</section>
		
		</div>

	</div>
</section>