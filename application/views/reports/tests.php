<?php 
/* Filename: reports.php
*  Author: Saddam
*  File location: views / test-system / reports.php
*/
?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="javascript:void(0);" onclick="$('#test-search-form')[0].reset();" class="fa fa-refresh"></a></h3>
				</div>
				<form action="<?php echo base_url('Reports/tests'); ?>" method="GET" id="test-search-form">
					<div class="selectBoxMain">
						<div class="filterSelect">
							<input type="text" name="rollno" class="form-control" placeholder="Roll No">
						</div>
						<div class="filterSelect">
							<input type="text" name="applicant_name" class="form-control" placeholder="Applicant Name">
						</div>
						<div class="filterSelect">
							<select name="project" class="form-control">
								<option value="">Project</option>
								<?php foreach($projects as $project): ?>
									<option value="<?php echo $project->company_id; ?>"><?php echo $project->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<select name="designation" class="form-control">
								<option value="">Designation</option>
								<?php foreach($designations as $designation): ?>
									<option value="<?php echo $designation->designation_id; ?>">
										<?php echo $designation->designation_name; ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<select name="job_id" class="form-control">
								<option value="">Job ID</option>
								<?php foreach($jobs as $job): ?>
									<option value="<?php echo $job->job_id; ?>">
										<?php echo $job->job_title; ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<input type="text" name="date_from" class="form-control date" placeholder="From Date">
						</div>
						<div class="filterSelect">
							<input type="text" name="date_to" class="form-control date" placeholder="To Date">
						</div>
						<div class="filterSelectBtn">
							<button type="submit" class="btn btnSubmit">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-lg-10">
			<div class="topNavFilter">
				
			</div>
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-12">
							<div class="tabelHeading">
								<div class="col-md-10">
									<h3><?= $title; ?> <span></span></h3>
								</div>
								<div class="col-md-2 text-right">
									<div class="tabelTopBtn">
									<a href="http://localhost/submarine/Reports/testsXLS?<?= $query_string; ?>" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
									</div>
								</div>
							</div>
						</div>
					<!-- <div class="col-lg-12">
						<div class="col-lg-10">
							<div class="tabelHeading">
								<h3>reports <span></span></h3>
							</div>
						</div>
						
						<div class="col-lg-2">
							<div class="tabelTopBtn" <?php if(empty($report_gen)): ?> style="display: none;" <?php endif; ?>>
								<a href="<?php echo base_url('tests/print_data'); ?>" class="btn"><img src="<?php echo base_url('dashboardDesign/assets/img/print.png'); ?>" alt=""> Print</a>
							</div>
						</div>
					</div> -->
					
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table table-hover" id="tests-table">
									<thead>
										<tr>
											<th>Applicant's name</th>
											<th>Project</th>
											<th>Job</th>
											<th>Email</th>
											<th>Message</th>
											<th>Roll No</th>
											<th>Date Applied</th>
											<th>Exam Date</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($report_gen)) :
										foreach($report_gen as $result): ?>
										<tr data="<?= $result->application_id; ?>">
											<td><?php echo ucwords($result->fullname); ?></td>
											<td><?php echo $result->compName; ?></td>
											<td><?php echo $result->job_title; ?></td>
											<td><?php echo $result->email; ?></td>
											<td><?php echo $result->message; ?></td>
											<td><?php echo $result->application_id; ?></td>
											<td><?php echo date('M d, Y', strtotime($result->created_at)); ?></td>
											<td><?php echo date('M d, Y', strtotime($result->exam_date)); ?></td>
											<td></td>
										</tr>
										<?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<?php echo $this->pagination->create_links(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>