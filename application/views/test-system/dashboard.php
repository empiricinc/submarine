<?php 
/*  Filename : dashboard.php
*	Author: Saddam
*	Location : views / test-system / dashboard.php 
*/
?>
<section class="secMainWidth">
	<section class="secIndex">
		<div class="row">
			<div class="col-md-12">
				<div class="headingMain">
					<h1>
						Exams & Tests Management's Dashboard
						<span>statistics and more...</span>
					</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="secIndexTable margint-top-0">
		<div class="row">
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Upcoming Exams / Tests</h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn">
								<a class="btn" href="<?php echo base_url('tests/add_questions'); ?>">
									<img src="<?php echo base_url('assets/img/plus.png'); ?>" alt=""> 
									Create Exam
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
												<th>Name</th>
												<th>Project</th>
												<th>email</th>
												<th>exam date</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($applicants as $applicant): ?>
											<tr>
												<td>
													<a href="<?php echo base_url(); ?>tests/detail_applicant/<?php echo $applicant->application_id; ?>"><?php echo $applicant->fullname; ?></a>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>tests/detail_job/<?php echo $applicant->job_id; ?>"><?php echo $applicant->job_title; ?></a>
												</td>
												<td>
													<a href="mailto:<?php echo $applicant->email; ?>"><?php echo $applicant->email; ?></a>
												</td>
												<td>
													<?php echo date('M d, Y - h:i a', strtotime($applicant->exam_date)); ?>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1">
							
						</div>
						<div class="col-md-10">
							<div class="tabelSideListing text-center">
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>
						<div class="col-md-1">
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-9">
							<div class="tabelHeading">
								<h3>total applicants <span>(appeared last month)</span></h3>
							</div>
						</div>
						<div class="col-md-3">
							<div class="tabelTopBtn">
								<a class="btn" href="<?php echo base_url('tests/total_appeared'); ?>">
									View All
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
												<th>name</th>
												<th>project</th>
												<th>email</th>
												<th>date applied</th>
												<th>exam taken</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($appeared as $app): ?>
											<tr>
												<td>
													<a href="<?php echo base_url(); ?>tests/detail_applicant/<?php echo $app->application_id; ?>"><?php echo $app->fullname; ?></a>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>tests/detail_project/<?php echo $app->company_id; ?>">
														<?php echo $app->compName; ?></a>
												</td>
												<td>
													<a href="mailto:<?php echo $app->email; ?>">
														<?php echo $app->email; ?>
													</a>
												</td>
												<td>
													<?php echo date('M d, Y', strtotime($app->created_at)); ?>
												</td>
												<td>
													<?php echo date('M d, Y', strtotime($app->exam_date)); ?>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							
						</div>
						<div class="col-md-6">
							<div class="tabelSideListing text-center">
								
							</div>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="secIndexTable">
		<div class="mainTableWhite">
			<div class="row">
				<div class="col-md-6">
					<div class="tabelHeading">
						<h3>jobs list <span>(In Progress)</span></h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="tabelTopBtn">
						<a class="btn" href="<?php echo base_url('tests/jobs'); ?>">
							<img src="<?php echo base_url('assets/img/icon2.png'); ?>" alt=""> 
							View All
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
										<th>job title</th>
										<th>location</th>
										<th>project</th>
										<th>date posted</th>
										<th>date closing</th>
										<th>recruitment type</th>
										<th>positions available</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($jobs as $job): ?>
									<tr>
										<td>
											<a href="<?php echo base_url(); ?>tests/detail_job/<?php echo $job->job_id; ?>"><?php echo $job->job_title; ?></a>
										</td>
										<td>
											<?php echo $job->prov_name; ?>
										</td>
										<td>
											<a href="<?php echo base_url(); ?>tests/detail_project/<?php echo $job->company_id; ?>"><?php echo $job->comp_name; ?></a>
										</td>
										<td>
											<?php echo date('M d, Y', strtotime($job->created_at)); ?>
										</td>
										<td>
											<?php echo date('M d, Y', strtotime($job->date_of_closing)); ?>
										</td>
										<td>
											<?php echo $job->type; ?>
										</td>
										<td>
											<?php echo $job->job_vacancy; ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="tabelSideListing">
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="tabelCenterListing">
						<?php //echo $pagination_link_two; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
