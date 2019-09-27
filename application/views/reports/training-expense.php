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
										<a href="<?= base_url(); ?>Reports/expenses_detail_pdf/<?= $detail->trg_id; ?>" target="_blank" class="btn"><i class="fa fa-file"></i> PDF</a>
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
									<center><h5>Training Allowances Detail</h5></center>
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
					<?php if(!empty($expenses)): ?>
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
											<th>DSA/Day</th>
											<th>Travel/Day</th>
											<th>Stay Allowance/Day</th>
											<th># of Days</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										 $grand_total = 0;
										 foreach($expenses AS $e):
										 	$e->dsa = (empty($e->dsa)) ? 0 : $e->dsa;
										 	$e->travel = (empty($e->travel)) ? 0 : $e->travel;
										 	$e->stay_allowance = (empty($e->dsa)) ? 0 : $e->stay_allowance;
											$total_expense = $e->dsa + $e->travel + $e->stay_allowance; 
											$grand_total += $total_expense;
										?>
										<tr>
											<td><?= $e->employee_name; ?></td>
											<td><?= $e->designation_name; ?></td>
											<td><?= $e->dsa; ?></td>
											<td><?= $e->travel; ?></td>
											<td><?= $e->stay_allowance; ?></td>
											<td><?= $e->presence_count; ?></td>
											<td><?= $total_expense * $e->presence_count; ?></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<span style="float: right; padding-right: 5px;">
									<label>Grand Total :</label> Rs. <?= $grand_total; ?>
								</span>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</section>
		
		</div>

	</div>
</section>