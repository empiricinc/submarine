<?php
/* Filename: results.php
*  Location: views/test-system/results.php
*  Author: Saddam
*/
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.date').datepicker();
	});
</script>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="<?php echo base_url('tests/results'); ?>" class="fa fa-refresh"></a></h3>
				</div>
				<form action="<?php echo base_url('tests/applicant_result'); ?>" method="post">
					<div class="selectBoxMain">
						<small style="color: #aeafaf;">Select or type whatever you need and hit the blue button.</small>
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
							<select name="job" class="form-control">
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
							<input type="text" name="applicant_name" class="form-control" placeholder="Search by name">
						</div>
						<div class="filterSelect">
							<input type="text" name="roll" class="form-control" placeholder="Search by roll number">
						</div>
						<div class="filterSelect">
							<input type="text" name="date_from" class="form-control date" placeholder="From date">
						</div>
						<div class="filterSelect">
							<input type="text" name="date_to" class="form-control date" placeholder="To date">
						</div>
						<div class="filterSelectBtn">
							<button type="submit" class="btn btnSubmit">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="col-lg-10">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>you'll see results here <span>(search anything on the left side of the page)</span></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<a href="<?php echo base_url('tests/add_questions'); ?>" class="btn">
								<img src="<?php echo base_url('assets/img/plus.png'); ?>" alt=""> Create Exam
							</a>
							<a href="<?php echo base_url('tests'); ?>" class="btn">
								<i class="fa fa-home"></i> Home
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
											<th>applicant's name</th>
											<th>project</th>
											<th>designation</th>
											<th>job ID / title</th>
											<th>applicant's roll no.</th>
											<th>exam date</th>
											<th>marks</th>
											<th>status</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($calc_result)) :
										foreach($calc_result as $result): ?>
										<tr>
											<td><?php echo $result->fullname; ?></td>
											<td><?php echo $result->name; ?></td>
											<td><?php echo $result->designation_name; ?></td>
											<td><?php echo $result->job_title; ?></td>
											<td>CTC-2019-0<?php echo $result->rollnumber; ?></td>
											<td><?php echo date('M d, Y', strtotime($result->sdt)); ?></td>
											<td>
												<?php echo $total_marks = $result->obtain_marks + $result->marks; ?>
											</td>
											<td>
												<?php if($total_marks >= 15): ?>
													<button class="btn btn-success btn-xs">Passed</button>
												<?php else: ?>
													<button class="btn btn-danger btn-xs">Failed</button>
												<?php endif; ?>
											</td>
										</tr>
										<?php endforeach; endif; ?>
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