<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: trainers_list.php
*  Author: Saddam
*  Filepath: views / training-files / trainers_list.php
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
							<?php if(empty($trainer_detail)): ?>
								<h3>all trainers <span>(list of the trainers working for the company)</span> |
									<small><a href="<?php echo base_url('trainings/add_trainer'); ?>"><i class="fa fa-plus"></i> add new trainer</a></small>
								</h3>
							<?php else: ?>
								<h3>trainer's detail <span>(see trainer's detail)</span></h3>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('trainings/trainer_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_trainer" class="form-control" placeholder="Search trainers..." required="" autocomplete="off">
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
										<tr <?php if(!empty($trainer_detail)): ?> style="display: none;" <?php endif; ?>>
											<th>trainer name</th>
											<th>contact</th>
											<th>email</th>
											<th>expertise</th>
											<th>address</th>
											<th>joined on</th>
											<th>status</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($trainers_list)):
										foreach($trainers_list as $trainer): ?>
										<tr>
											<td><a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $trainer->trainer_id; ?>"><?=$trainer->first_name." ".$trainer->last_name; ?></a></td>
											<td><?=$trainer->contact_number; ?></td>
											<td><a href="mailto:<?=$trainer->email; ?>"><?=$trainer->email; ?></a></td>
											<td>
												<?=$trainer->expertise; ?>
											</td>
											<td>
												<?=$trainer->address; ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($trainer->created_at)); ?>
											</td>
											<td>
												<?php if($trainer->status == 1): ?>
													<a href="<?php echo base_url(); ?>trainings/trainer_status/<?php echo $trainer->trainer_id; ?>">
														<div class="label label-warning">
															Deactivate
														</div>
													</a>
												<?php else: ?>
													<a href="<?php echo base_url(); ?>trainings/trainer_status/<?php echo $trainer->trainer_id; ?>">
														<div class="label label-primary">
															Activate
														</div>
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
							<span><?php echo $this->pagination->create_links(); 
							endif; ?></span>
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
							<h3>you've searched for : <span><?php echo $_GET['search_trainer']; ?></span></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('trainings/trainer_search'); ?>" method="get">
								<div class="inputFormMain">
									<a href="javascript:history.go(-1);" class="form-control">Go back</a>
									<div class="input-group">
										<input type="text" name="search_trainer" class="form-control" placeholder="Search trainers..." required="" autocomplete="off">
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
											<th>trainer name</th>
											<th>contact</th>
											<th>email</th>
											<th>expertise</th>
											<th>address</th>
											<th>joined on</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($results)) :
										foreach($results as $result): ?>
										<tr>
											<td><a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $result->trainer_id; ?>"><?=$result->first_name." ".$result->last_name; ?></a></td>
											<td><?=$result->contact_number; ?></td>
											<td><a href="mailto:<?=$result->email; ?>"><?=$result->email; ?></a></td>
											<td>
												<?=$result->expertise; ?>
											</td>
											<td>
												<?=$result->address; ?>
											</td>
											<td>
												<?=date('M d, Y', strtotime($result->created_at)); ?>
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
<?php if(isset($trainer_detail)): ?>
<div class="col-lg-8 col-lg-offset-1">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Trainer's Detail</h3>
		</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-8">
						<p>
							<strong>Trainer's Name: </strong> <?php echo $trainer_detail['first_name']." ".$trainer_detail['last_name']; ?>
						</p>
						<p>
							<strong>Contact: </strong> <?php echo $trainer_detail['contact_number']; ?>
						</p>
						<p>
							<strong>Email: </strong> <?php echo $trainer_detail['email']; ?>
						</p>
						<p>
							<strong>Expertise: </strong> <?php echo $trainer_detail['expertise']; ?>
						</p>
						<p>
							<strong>Address: </strong> <?php echo $trainer_detail['address']; ?>
						</p>
						<p>
							<strong>Joined on: </strong> <?php echo date('M d, Y', strtotime($trainer_detail['created_at'])); ?>
						</p>
					</div>
				</div>
			</div>
		<div class="panel-footer text-right">
			<?php echo date('Y') . " - " . $trainer_detail['first_name']; ?> | <a href="javascript:history.go(-1);">Go Back &laquo;</a>
		</div>
	</div>
</div>
<?php endif; ?>