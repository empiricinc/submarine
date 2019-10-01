<section class="secMainWidth">
<section class="secIndex">
	<div class="row">
		<div class="col-md-10">
			<div class="headingMain">
				<h1>
					<?= $title; ?>
					<span></span>
				</h1>
			</div>
		</div>
		<!-- <div class="col-md-2">
			<div class="headingMain text-right" style="margin-top: 40px;">
				<a href="#field-modal" data-toggle="modal" class="label label-primary"><i class="fa fa-plus-circle"></i> Field Joining Report</a>
			</div>
		</div> -->
	</div>
</section>
<section class="secIndexTable margint-top-0">
		<div class="row">
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Events And News <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>User_panel/trainings" class="btn">
									<i class="fa fa-eye"></i> View All
								</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="tableMain">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Training Type</th>
												<!-- <th>City</th>
												<th>Venue</th> -->
												<th>Start Date</th>
												<th>End Date</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($trainings as $t): ?>
											<tr>
												<td><?= $t->training_type; ?></td>
												<!-- <td><?= ucfirst($t->training_city); ?></td>
												<td><?= $t->training_location; ?></td> -->
												<td><?= date('d-m-Y', strtotime($t->start_date)); ?></td>
												<td><?= date('d-m-Y', strtotime($t->end_date)); ?></td>
												<td><?php
													$startDate = date(strtotime($t->start_date));
													$endDate = date(strtotime($t->end_date));
													$currentDate = strtotime(date('d-m-Y'));

													if($endDate < $currentDate) { 
														echo '<span class="label label-danger">complete</span>'; 
													}
													
													elseif(($startDate <= $currentDate) && ($endDate >= $currentDate)) { 
														echo '<span class="label label-primary">ongoing</span>'; 
													} 

													elseif($startDate > $currentDate) { 
														echo '<span class="label label-success">upcoming</span>'; 
													}
													?>
													
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Salary Info <span></span></h3>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="tableMain">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Basic Salary</th>
												<th>Allowances</th>
												<th>Deduction</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
</section>

<section class="secIndexTable">
		<div class="mainTableWhite">
			<div class="row">
				<div class="col-md-8">
					<div class="tabelHeading">
						<h3>Leaves <span></span></h3>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="tabelTopBtn" style="padding-top: 12px !important;">
						<a href="<?= base_url(); ?>User_panel/leaveManagement" class="btn">
							<i class="fa fa-eye"></i> View All
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="tableMain">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Leave Title</th>
										<th>Reason</th>
										<th>From Date</th>
										<th>To Date</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($leave_application AS $application): ?>
									<tr>
										<td><?= $application->type_name; ?></td>
										<td><?= $application->reason; ?></td>
										<td><?= $application->from_date; ?></td>
										<td><?= $application->to_date; ?></td>
										<td><?php
										 		if($application->status == '1') {
										 			echo '<span class="label label-warning">pending</span>';
										 		} elseif($application->status == '2') {
										 			echo '<span class="label label-primary">approved</span>';
										 		} else {
										 			echo '<span class="label label-danger">rejected</span>';
										 		}

										  ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>

</section>