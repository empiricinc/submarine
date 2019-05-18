<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: trainings_list.php
*  Author: Saddam
*  Filepath: views / training-files / trainings_list.php
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
									all trainings
									<span>
										(list of trainings to be held) 
									</span> |
									<small>
										<a href="<?php echo base_url('trainings/add_trainings'); ?>"><i class="fa fa-plus"></i> add new training</a>
									</small>
							</h3>
							<?php else: ?> 
								<h3>training detail <span>(see training's detail)</span></h3>
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
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr <?php if(!empty($training_detail)): ?> style="display: none;"<?php endif; ?>>
											<th>training type</th>
											<th>trainer one</th>
											<th>trainer two</th>
											<th>facilitator name</th>
											<th>starts on</th>
											<th>ends on</th>
											<th>venue</th>
											<th>hall detail</th>
											<th>session</th>
											<th>approval type</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($list_trainings)):
										foreach($list_trainings as $training): ?>
										<tr>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trg_id; ?>"><?=$training->type; ?></a>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $training->trg_id; ?>"><?=$training->first_name." ".$training->last_name; ?></a>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $training->trg_id; ?>"><?=$training->first_name." ".$training->last_name; ?></a>
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
												<?=$training->session; ?>
											</td>
											<td>
												<?=$training->approval_type;?>
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
								<?php echo $this->pagination->create_links(); endif; ?>
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
											<th>employee name</th>
											<th>training type</th>
											<th>trainer</th>
											<th>training cost</th>
											<th>starts on</th>
											<th>ends on</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($results as $result): ?>
										<tr>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $result->training_id; ?>">
													<?=$result->efirst_name." ".$result->elast_name; ?></a>
											</td>
											<td>
												<?=$result->type; ?>
											</td>
											<td>
												<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $result->trainer_id; ?>"><?=$result->first_name." ".$result->last_name; ?></a>
											</td>
											<td>
												<?=$result->training_cost; ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($result->start_date)); ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($result->finish_date)); ?>
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
	</div>
</section>
<?php endif; ?>
<?php if(isset($training_detail)): ?>
<div class="col-lg-8 col-lg-offset-1">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>
				<div class="row">
					<div class="col-lg-6">
						<small><strong>Training Type:</strong></small><?php echo $training_detail['type']; ?>
					</div>
					<div class="col-lg-6 text-right">
						<small>
							<strong>Venue:</strong> <?php echo $training_detail['location']; ?><br> 
							<strong>Hall Detail:</strong> <?php echo $training_detail['hall_detail']; ?>
						</small>
					</div>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-12">
					<p>
						<strong>Who's coming: </strong><?php echo $employee_names; ?>
						<strong>Designation: </strong> <?php //echo $training_detail['desination_name']; ?>
						<strong>Project: </strong><?php echo $training_detail['name']; ?>
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