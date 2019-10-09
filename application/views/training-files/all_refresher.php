<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: all_refresher.php
*  Author: Saddam
*  Filepath: views / training-files / all_refresher.php
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
							<?php if(empty($training_detail)): ?>
							<h3>
									all refresher trainings
									<span>
										(list of refresher trainings to be held & done) 
									</span> |
									<small>
										<a href="<?php echo base_url('trainings/add_trainings'); ?>"><i class="fa fa-plus"></i> add new training</a>
									</small><br>
									<small>
										<span class="label label-warning">
											no refresher.
										</span> &nbsp;
										<span class="label label-success">
											refresher done - once.
										</span> &nbsp;
										<span class="label label-primary">
											refresher done - twice.
										</span>
									</small>
							</h3>
							<?php else: ?> 
								<h3>training detail <span>(see training's detail & move to attendance)</span></h3>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('trainings/refresher_search'); ?>" method="get">
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
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr <?php if(!empty($training_detail)): ?> style="display: none;"<?php endif; ?>>
											<th>trg type</th>
											<th>location</th>
											<th>trainer one</th>
											<th>trainer two</th>
											<th>facilitator</th>
											<th>starts on</th>
											<th>ends on</th>
											<th>venue</th>
											<th>hall detail</th>
											<th>status</th>
										</tr>
									</thead>
									<tbody>
										<?php if($sl3['accessLevel3']): // Check Access Level.
										if(!empty($list_trainings)):
										foreach($list_trainings as $training): ?>
										<tr>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trg_id; ?>"><?=$training->type; ?></a>
											</td>
											<td>
												<?= $training->prov_name; ?>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $training->trainer_id; ?>"><?=$training->first_name." ".$training->last_name; ?></a>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $training->trainer_id; ?>"><?=$training->first_name." ".$training->last_name; ?></a>
											</td>
											<td>
												<?=$training->facilitator_name; ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($training->start_date)); ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($training->end_date)); ?>
											</td>
											<td>
												<?=$training->location; ?>
											</td>
											<td>
												<?=$training->hall_detail; ?>
											</td>
											<td>
												<?php if($training->status == 2): ?>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trg_id; ?>">
														<span class="label label-warning">Complete</span>
													</a>
												<?php elseif($training->status == 3): ?>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trg_id; ?>">
														<span class="label label-success">Complete</span>
													</a>
												<?php elseif($training->status == 4): ?>
													<a href="<?php echo base_url(); ?>trainings/expenses/<?php echo $training->trg_id; ?>">
														<span class="label label-primary">Completed</span>
													</a>
												<?php endif; ?>
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
							<form class="form-inline" action="<?php echo base_url('trainings/refresher_search'); ?>" method="get">
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
											<th>trg type</th>
											<th>location</th>
											<th>trainer one</th>
											<th>trainer two</th>
											<th>facilitator</th>
											<th>starts on</th>
											<th>ends on</th>
											<th>venue</th>
											<th>hall detail</th>
											<th>status</th>
										</tr>
									</thead>
									<tbody>
										<?php if($sl3['accessLevel3']): # Check Access Level.
										foreach($results as $result): ?>
										<tr>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $result->trg_id; ?>"><?=$result->type; ?></a>
											</td>
											<td>
												<?= $result->prov_name; ?>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $result->trainer_id; ?>"><?=$result->first_name." ".$result->last_name; ?></a>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $result->trainer_id; ?>"><?=$result->first_name." ".$result->last_name; ?></a>
											</td>
											<td>
												<?=$result->facilitator_name; ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($result->start_date)); ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($result->end_date)); ?>
											</td>
											<td>
												<?=$result->location; ?>
											</td>
											<td>
												<?=$result->hall_detail; ?>
											</td>
											<td>
												<?php if($result->status == 2): ?>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $result->trg_id; ?>">
														<span class="label label-warning">Complete</span>
													</a>
												<?php elseif($result->status == 3): ?>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $result->trg_id; ?>">
														<span class="label label-success">Complete</span>
													</a>
												<?php elseif($result->status == 4): ?>
													<a href="<?php echo base_url(); ?>trainings/expenses/<?php echo $result->trg_id; ?>">
														<span class="label label-primary">Completed</span>
													</a>
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
						<small><strong>Project Name: </strong><?php echo $training_detail['name']; ?></small>
					</div>
					<div class="col-lg-4 text-right">
						<small>
							<strong>Location/ Province: </strong><?php echo $training_detail['provName']; ?><br>
							<strong>Venue: </strong><?php echo $training_detail['location']; ?><br> 
							<strong>Hall Detail: </strong><?php echo $training_detail['hall_detail']; ?>
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