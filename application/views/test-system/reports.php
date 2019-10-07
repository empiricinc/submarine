<?php 
/* Filename: reports.php
*  Author: Saddam
*  File location: views / test-system / reports.php
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
					<h3>Generate Reports <a href="<?php echo base_url('tests/reports'); ?>" class="fa fa-refresh"></a></h3>
				</div>
				<form action="<?php echo base_url('tests/generate_by_date'); ?>" method="post">
					<div class="selectBoxMain">
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
							<input type="text" name="date_from" class="form-control date" placeholder="From date...">
						</div>
						<div class="filterSelect">
							<input type="text" name="date_to" class="form-control date" placeholder="To date...">
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
					<div class="col-lg-8">
						<div class="tabelHeading">
							<h3>reports <span></span></h3>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="tabelTopBtn" <?php if(empty($report_gen)): ?> style="display: none;" <?php endif; ?>>
							<a href="<?php echo base_url('tests/print_data'); ?>" class="btn"><img src="<?php echo base_url('dashboardDesign/assets/img/print.png'); ?>" alt=""> Print</a>
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
											<th>project registered in</th>
											<th>job applied for</th>
											<th>email</th>
											<th>message</th>
											<th>applicant's roll no.</th>
											<th>date applied</th>
											<th>exam date</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($report_gen)) :
										foreach($report_gen as $result): ?>
										<tr>
											<td><?php echo $result->fullname; ?></td>
											<td><?php echo $result->compName; ?></td>
											<td><?php echo $result->job_title; ?></td>
											<td><?php echo $result->email; ?></td>
											<td><?php echo $result->message; ?></td>
											<td>CTC-2019-0<?php echo $result->application_id; ?></td>
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
			</div>
		</div>
	</div>
</section>