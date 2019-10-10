<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: trainings_list.php
*  Author: Saddam
*  Filepath: views / training-files / trainings_list.php
*/
?>
<style type="text/css">
	.label{
		cursor: pointer;
	}
</style>
<?php if(empty($results)): ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<?php if(empty($training_detail)): ?>
							<h3>
								trainings completed <small>click on the training type to view detail, i.e, expenses, employees' names etc...</small>
							</h3>
							<?php else: ?> 
								<h3>training detail <span>(see training's detail & expenses)</span></h3>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('trainings/completed_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_training" class="form-control" placeholder="Search trainings..." required="" autocomplete="off">
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
					<div class="col-lg-8 col-lg-offset-2">
						<?php if($success = $this->session->flashdata('success')): ?>
						<div class="alert alert-success alert-dismissable text-center">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<p><?php echo $success; ?></p>
						</div>
						<?php endif; ?>
					</div>
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr <?php if(!empty($training_detail)): ?> style="display: none;"<?php endif; ?>>
											<th>training type</th>
											<th>province</th>
											<th>district</th>
											<th>trainers</th>
											<th>target group</th>
											<th>started on</th>
											<th>ended on</th>
											<th>venue</th>
											<th>sessions</th>
											<th>participants</th>
										</tr>
									</thead>
									<tbody id ='filter_results'>
									<?php if($sl3['accessLevel3']): // Check Access Level.
									if(!empty($completed_trainings)):
									foreach($completed_trainings as $completed): ?>
									<tr>
										<td>
											<a href="<?= base_url(); ?>trainings/expenses/<?= $completed->trg_id; ?>"><?= $completed->type; ?></a>
										</td>
										<td>
											<?= $completed->name; ?>
										</td>
										<td>
											<?= $completed->city_name; ?>
										</td>
										<td>
											<?= $completed->first_name." ".$completed->last_name; ?>
										</td>
										<td>
											<?= $completed->target_group; ?>
										</td>
										<td>
											<?= date('M d, Y', strtotime($completed->start_date)); ?>
										</td>
										<td>
											<?= date('M d, Y', strtotime($completed->end_date)); ?>
										</td>
										<td>
											<?= $completed->location; ?>
										</td>
										<td>
											<?= $completed->session; ?>
										</td>
										<td>
											<?= $completed->attendees; ?>
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
							<span>
								<?php echo $this->pagination->create_links(); endif; endif; ?>
							</span>
						</div>
					</div>
					<div class="col-md-1"></div>
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
									<?php echo $_GET['search_training']; ?>
								</span>
							</h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/completed_search'); ?>" method="get">
								<div class="inputFormMain">
									<a href="javascript:history.go(-1);" class="form-control">Go back</a>
									<div class="input-group">
										<input type="text" name="search_training" class="form-control" placeholder="Search trainings..." required="" autocomplete="off">
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
											<th>training type</th>
											<th>province</th>
											<th>district</th>
											<th>trainers</th>
											<th>target group</th>
											<th>started on</th>
											<th>ended on</th>
											<th>venue</th>
											<th>sessions</th>
											<th>participants</th>
										</tr>
									</thead>
									<tbody>
										<?php if($sl3['accessLevel3']): // Check Access Level.
										foreach($results as $result): ?>
										<tr>
											<td>
												<a href="<?= base_url(); ?>trainings/expenses/<?= $result->trg_id; ?>"><?= $result->type; ?></a>
											</td>
											<td>
												<?= $result->name; ?>
											</td>
											<td>
												<?= $result->city_name; ?>
											</td>
											<td>
												<?= $result->first_name." ".$result->last_name; ?>
											</td>
											<td>
												<?= $result->target_group; ?>
											</td>
											<td>
												<?= date('M d, Y', strtotime($result->start_date)); ?>
											</td>
											<td>
												<?= date('M d, Y', strtotime($result->end_date)); ?>
											</td>
											<td>
												<?= $result->location; ?>
											</td>
											<td>
												<?= $result->session; ?>
											</td>
											<td>
												<?= $result->attendees; ?>
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
<?php if(isset($training_detail)): ?>
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>
				<div class="row">
					<div class="col-lg-4">
						<small>
							<h3>Training Information</h3>
							<a href="<?php echo base_url(); ?>trainings/attendance/<?= $training_detail['trg_id']; ?>"><i class="fa fa-plus"></i> Attendance</a>
						</small>
					</div>
					<div class="col-lg-4 text-right">
						<small><strong>Training Type: </strong><?php echo $training_detail['type']; ?></small><br>
						<small><strong>Project Name: </strong><?php echo $training_detail['name']; ?></small><br>
						<small><strong>District: </strong><?php echo $training_detail['cityName']; ?></small><br>
						<small><strong>Tehsil: </strong><?php if($training_detail['teh_name'] == NULL){ echo "N/A"; }else{ echo $training_detail['teh_name']; } ?></small>
					</div>
					<div class="col-lg-4 text-right">
						<small>
							<strong>Location/ Province: </strong><?php echo $training_detail['provName']; ?><br>
							<strong>Venue: </strong><?php echo $training_detail['location']; ?><br> 
							<strong>Hall Detail: </strong><?php echo $training_detail['hall_detail']; ?><br>
							<strong>Union Council: </strong><?php if($training_detail['uc_name'] == NULL){ echo "N/A"; }else{ echo $training_detail['uc_name']; } ?>
						</small>
					</div>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-2"><h3>Employee Name</h3></div>
						<div class="col-lg-3"><h3>Designation</h3></div>
						<div class="col-lg-2"><h3>Project</h3></div>
						<div class="col-lg-2"><h3>Contact</h3></div>
						<div class="col-lg-3"><h3>Address</h3></div>
					</div>
					<p class="lead">
						<?php echo $employee_names; ?>
					</p>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			<?php echo date('Y') ." - ". $training_detail['type']; ?> | <a href="javascript:history.go(-1);">Go Back &laquo; </a>
		</div>
	</div>
</div>
<?php endif; ?>