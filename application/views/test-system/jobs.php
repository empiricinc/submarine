<?php 
/* Filename: jobs.php
*  Author: Saddam
*  Location: views / test-system / jobs.php
*/
?>
<?php if(empty($results)): ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<?php if(empty($job_detail)): ?>
								<h3>all jobs 
									<span>(list of the jobs)</span> |
									<small>search by job title, location, project, recruitement type, or available positions &hellip;</small>
								</h3>
							<?php else: ?>
								<h3>job detail 
									<span>(see the job in detail)</span>
								</h3>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/job_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_job" class="form-control" placeholder="Search jobs..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr <?php if(!empty($job_detail)): ?> style="display: none;" <?php endif; ?>>
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
									<?php if(!empty($jobs_list)):
									foreach($jobs_list as $job): ?>
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
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="tabelSideListing text-center">
							<span><?php echo $this->pagination->create_links(); endif; ?></span>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php else: ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>you've searched for : <span><?php echo $_GET['search_job']; ?></span></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/job_search'); ?>" method="get">
								<div class="inputFormMain">
									<a href="javascript:history.go(-1);" class="form-control">Go back</a>
									<div class="input-group">
										<input type="text" name="search_job" class="form-control" placeholder="Search jobs..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
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
										<?php if(!empty($results)) :
										foreach($results as $job): ?>
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
<?php endif; ?>
<?php if(isset($job_detail)): ?>
<div class="col-lg-8 col-lg-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Job Detail</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-6">
					<p>
						<strong>Company: </strong><?php echo $job_detail['compName']; ?>
					</p>
					<p>
						<strong>Job Title: </strong><?php echo $job_detail['job_title']; ?>
					</p>
					<p>
						<strong>Designation: </strong><?php echo $job_detail['designation_name']; ?>
					</p>
					<p>
						<strong>Job Type: </strong><?php echo $job_detail['type']; ?>
					</p>
					<p>
						<strong>No. of vacancies: </strong><?php echo $job_detail['job_vacancy']; ?>
					</p>
					<p>
						<strong>Experience: </strong><?php echo $job_detail['minimum_experience']; ?>
					</p>
					<p>
						<strong>Date Posted: </strong><?php echo date('M d, Y', strtotime( $job_detail['created_at'])); ?>
					</p>
					<p>
						<strong>Closing Date: </strong><?php echo date('M d, Y', strtotime($job_detail['date_of_closing'])); ?>
					</p>
				</div>
				<div class="col-lg-6">
					<p>
						<strong>Province: </strong><?php echo $job_detail['provName']; ?>
					</p>
					<p>
						<strong>City: </strong><?php echo $job_detail['cityName']; ?>
					</p>
					<p>
						<strong>Area: </strong><?php echo $job_detail['areaName']; ?>
					</p>
					<p>
						<strong>Domicile: </strong><?php echo $job_detail['domName']; ?>
					</p>
					<p>
						<strong>Education: </strong><?php echo $job_detail['eduName']; ?>
					</p>
					<p>
						<strong>Age: </strong><?php echo $job_detail['ageName']; ?>
					</p>
					<p>
						<strong>Short Description: </strong><?php echo $job_detail['short_description']; ?>
					</p>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<?php echo date('Y') ." - ". $job_detail['job_title']; ?> | <a href="javascript:history.go(-1);">Go Back &laquo;</a>
		</div>
	</div>
</div>
<?php endif; ?>