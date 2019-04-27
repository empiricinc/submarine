<?php 
/* Filename: appeared.php
*  Author: Saddam
*  File location: views / test-system / appeared.php
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
							<?php if(empty($applicant_detail)): ?>
							<h3>
									all applicants 
									<span>
										(list of the applicants appeared in the last exam) 
									</span>
							</h3>
							<?php else: ?> 
								<h3>applicant detail 
									<span>(see applicant's detail)</span>
								</h3>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/appeared_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_appeared" class="form-control" placeholder="Search applicants..." required="" autocomplete="off">
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
										<tr <?php if(!empty($applicant_detail)): ?> style="display: none;"<?php endif; ?>>
											<th>applicant's name</th>
											<th>project</th>
											<th>job title</th>
											<th>email</th>
											<th>date applied</th>
											<th>exam date</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($appeared_list)):
										foreach($appeared_list as $applicant): ?>
										<tr>
											<td>
												<a href="<?php echo base_url(); ?>tests/detail_applicant/<?php echo $applicant->application_id; ?>"><?=$applicant->fullname; ?></a>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>tests/detail_project/<?php echo $applicant->company_id; ?>"><?php echo $applicant->compName; ?></a>
											</td>
											<td>
												<?php echo $applicant->job_title; ?>
											</td>
											<td>
												<a href="mailto:<?php echo $applicant->email; ?>"><?php echo $applicant->email; ?></a>
											</td>
											<td>
												<?=date('M d, Y', strtotime($applicant->created_at)); ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($applicant->exam_date)); ?>
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
								<span>
									<?php echo $this->pagination->create_links(); endif; ?>
								</span>
							</div>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>
			</div>
		</div>
	</div>
</section>
<?php else:  ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>you've searched for:  
								<span>
									<?php echo $_GET['search_appeared']; ?>
								</span>
							</h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/appeared_search'); ?>" method="get">
								<div class="inputFormMain">
									<a href="javascript:history.go(-1);" class="form-control">Go back</a>
									<div class="input-group">
										<input type="text" name="search_appeared" class="form-control" placeholder="Search applicants..." required="" autocomplete="off">
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
											<th>applicant's name</th>
											<th>project</th>
											<th>job title</th>
											<th>email</th>
											<th>date applied</th>
											<th>exam date</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($results as $applicant): ?>
										<tr>
											<td>
												<a href="<?php echo base_url(); ?>tests/detail_applicant/<?php echo $applicant->application_id; ?>"><?=$applicant->fullname; ?></a>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>tests/detail_project/<?php echo $applicant->company_id; ?>"><?php echo $applicant->compName; ?></a>
											</td>
											<td>
												<?=$applicant->job_title; ?>
											</td>
											<td>
												<a href="mailto:<?php echo $applicant->email; ?>"><?php echo $applicant->email; ?></a>
											</td>
											<td>
												<?=date('M d, Y', strtotime($applicant->created_at)); ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($applicant->exam_date)); ?>
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
							
						</div>
						<div class="col-md-4">
							<div class="tabelSideListing text-center">
								
							</div>
						</div>
						<div class="col-md-4">
							
						</div>
					</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if(isset($applicant_detail)): ?>
	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="text-right">Applicant Detail</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-6">
					<p>
						<strong>Name: </strong><?php echo $applicant_detail['fullname']; ?>
					</p>
					<p>
						<strong>Email: </strong><?php echo $applicant_detail['email']; ?>
					</p>
					<p>
						<strong>Gender: </strong><?php echo $applicant_detail['gender']; ?>
					</p>
					<p>
						<strong>Education: </strong><?php echo $applicant_detail['edu_name']; ?>
					</p>
					<p>
						<strong>Domicile: </strong><?php echo $applicant_detail['dom_name']; ?>
					</p>
					<p>
						<strong>Message: </strong><?php echo $applicant_detail['message']; ?>
					</p>
					<p>
						<strong>Remarks: </strong><?php echo $applicant_detail['application_remarks']; ?>
					</p>
					<p>
						<strong>Date Applied: </strong><?php echo date('M d, Y', strtotime( $applicant_detail['created_at'])); ?>
					</p>
					<p>
						<strong>Exam Date: </strong><?php echo date('M d, Y', strtotime($applicant_detail['exam_date'])); ?>
					</p>
				</div>
				<div class="col-lg-6">
					<p>
						<strong>Job Title: </strong><?php echo $applicant_detail['job_title']; ?>
					</p>
					<p>
						<strong>Status: </strong>
						<?php
							$status = $applicant_detail['application_status'];
								switch($status) {
									case $applicant_detail['application_status'] = 1:
										echo "In Progress";
										break;
									case $applicant_detail['application_status'] = 2:
										echo "Shortlisted";
										break;
									case $applicant_detail['application_status'] = 3:
										echo "Interview";
										break;
									default:
										echo "Nothing to show"; 
								}
						?>
					</p>
					<p>
						<strong>Experience: </strong><?php echo $applicant_detail['minimum_experience']; ?>
					</p>
					<p>
						<strong>Age: </strong><?php echo $applicant_detail['age_name']; ?>
					</p>
					<p>
						<strong>City: </strong><?php echo $applicant_detail['city_name1']; ?>
					</p>
					<p>
						<strong>Province: </strong><?php echo $applicant_detail['prov_name']; ?>
					</p>
					<p>
						<strong>Resume: </strong><a href="<?php echo base_url(); ?>uploads/resume/<?php echo $applicant_detail['job_resume']; ?>"><?php echo $applicant_detail['job_resume']; ?></a>
					</p>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<?php echo date('Y') ." - ". $applicant_detail['fullname']; ?> | <a href="javascript:history.go(-1);">Go Back &laquo; </a>
		</div>
	</div>
	</div>
<?php endif; ?>