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
	small#attendance{
		color: red;
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
								all trainings
								<span>
									(list of trainings to be held & done) 
								</span> |
								<small>
									<a href="<?php echo base_url('trainings/add_trainings'); ?>"><i class="fa fa-plus"></i> add new training</a>
									<a href="<?php echo base_url('trainings/export_trainings'); ?>" class="btn btn-success btn-xs">Download CSV</a>
								</small><br>
								<small id="status-btns">
									<a href="<?= base_url('trainings/all_trainings'); ?>">
										<span class="label label-danger">
											All Trainings
										</span> &nbsp;
									</a>
									<span id="progress" class="label label-info">
										In Progress
									</span> &nbsp;
									<span id="induction" class="label label-warning">
										Induction
									</span> &nbsp;
									<span id="refresher" class="label label-success">
										Refresher
									</span> &nbsp;
									<span id="complete" class="label label-primary">
										Completed
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
							<form class="form-inline" action="<?php echo base_url('trainings/training_search'); ?>" method="get">
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
											<th>trg type</th>
											<th>location</th>
											<th>trainer one</th>
											<th>trainer two</th>
											<th>facilitator</th>
											<th>starts on</th>
											<th>ends on</th>
											<th>venue</th>
											<th>hall detail</th>
											<th>status - progress | completed</th>
										</tr>
									</thead>
									<tbody id ='filter_results'>
										<?php if($sl3['accessLevel3']): // Check Access Level.
										if(!empty($list_trainings)):
										foreach($list_trainings as $training): ?>
										<tr>
											<td>
												<?php if($training->training_id != $training->trg_id): ?>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trg_id; ?>"><?=$training->type; ?></a>
												<?php else: ?>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trg_id; ?>"><?=$training->type; ?></a>
												<?php endif; ?>
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
												<a href="<?php echo base_url(); ?>trainings/activity_reporting/<?php echo $training->trg_id; ?>">
													<span class="label label-warning">
														Acty Rpt
													</span>&nbsp;
												</a>
												<a href="<?php echo base_url(); ?>trainings/get_activity_reporting/<?php echo $training->trg_id; ?>">
													<span class="label label-danger">
														View
													</span> &nbsp;
												</a>
												<a href="<?php echo base_url(); ?>trainings/attendance/<?php echo $training->trg_id; ?>">
													<span class="label label-success">
														Atdnc
													</span> &nbsp;
												</a>
												<a href="">
													<span class="label label-info">
														Trg Mtrl
													</span> &nbsp;
												</a>
												<a href="">
													<span class="label label-primary">
														Comp
													</span>
												</a>
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
							<form class="form-inline" action="<?php echo base_url('tests/training_search'); ?>" method="get">
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
											<th>location</th>
											<th>trainer</th>
											<th>facilitator name</th>
											<th>starts on</th>
											<th>ends on</th>
											<th>venue</th>
											<th>hall detail</th>
										</tr>
									</thead>
									<tbody>
										<?php if($sl3['accessLevel3']): // Check Access Level.
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
												<?=$result->facilitator_name; ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($result->start_date)); ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($result->end_date)); ?>
											</td>
											<td>
												<?= $result->location; ?>
											</td>
											<td>
												<?= $result->hall_detail; ?>
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
							<?php if($employee_names): ?>
								<a href="<?php echo base_url(); ?>trainings/attendance/<?= $training_detail['trg_id']; ?>"><i class="fa fa-plus"></i> Attendance</a>
							<?php else: ?>
								 <i class="fa fa-plus"></i> Attendance |<small id='attendance'> Can't be taken because of no trainees registered! <a href="<?= base_url(); ?>trainings/delete_trg/<?= $training_detail['trg_id']; ?>" class="btn btn-danger btn-xs" onclick="javascript:return confirm('Are you sure to remove this ?');">Remove</a></small>
							<?php endif; ?>
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
				<div class="col-lg-10 col-lg-offset-1">
					<div class="row">
						<div class="col-lg-4"><h3>Employee Name</h3></div>
						<div class="col-lg-4"><h3>Designation</h3></div>
						<div class="col-lg-4"><h3>Project</h3></div>
					</div>
					<p class="lead">
						<?php if($employee_names){ echo $employee_names; }else{ echo $no_employees; } ?>
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
<script type="text/javascript">
	$(document).ready(function(){
		var status = 0;
		$('#status-btns>.label').on('click', function(){
			$('#filter_results').html('');
			status = $(this).attr('id');
			if(status == 'progress')
				status = 0;
			else if(status == 'induction')
				status = 1;
			else if(status == 'refresher')
				status = 2;
			else if(status == 'complete')
				status = 3;
			else
				status = 4;
			
			$.ajax({
				url: '<?= base_url(); ?>trainings/get_by_trg_status/' + status,
				type: 'post',
				dataType: 'json',
				data: {status: status},
				success: function(res)
				{
					result = "";
					$.each(res, function(key, val) {
						result += `
							<tr>
								<td>
									<a href='<?= base_url(); ?>trainings/detail_training/${val.trg_id}'>${val.type}</a>
								</td>
								<td>${val.prov_name}</td>
								<td>${val.first_name} ${val.last_name}</td>
								<td>${val.first_name} ${val.last_name}</td>
								<td>${val.facilitator_name}</td>
								<td>${val.start_date}</td>
								<td>${val.end_date}</td>
								<td>${val.location}</td>
								<td>${val.hall_detail}</td>
								<td>
									<a href="<?php echo base_url(); ?>trainings/activity_reporting/${val.trg_id}">
										<span class="label label-warning">
											Acty Rpt
										</span>&nbsp;
									</a>
									<a href="<?php echo base_url(); ?>trainings/get_activity_reporting/${val.trg_id}">
										<span class="label label-danger">
											View
										</span> &nbsp;
									</a>
									<a href="<?php echo base_url(); ?>trainings/attendance/${val.trg_id}">
										<span class="label label-success">
											Attendance
										</span> &nbsp;
									</a>
									<a href="">
										<span class="label label-info">
											Trg Mtrl
										</span> &nbsp;
									</a>
									<a href="">
										<span class="label label-primary">
											Comp
										</span>
									</a>
								</td>
							</tr>
						`;
					});
					$('#filter_results').append(result);
				}
			});
		});
	});
</script>