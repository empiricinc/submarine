<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename : dashboard.php
*  Author: Saddam
*  Filepath : views / training-files / dashboard.php 
*/
?>
<section class="secMainWidth">
	<section class="secIndex">
		<div class="row">
			<div class="col-md-12">
				<div class="headingMain">
					<h1>
						Trainings & Trainers' Management Dashboard
						<span>statistics and more...</span>
					</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="secIndexTable margint-top-0">
		<div class="row">
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-8">
							<div class="tabelHeading">
								<h3>induction trainings 
									<small>trainings to be held</small>
								</h3>
							</div>
						</div>
						<div class="col-md-4">
							<div class="tabelTopBtn">
								<a class="btn" href="<?php echo base_url('trainings/add_trainings'); ?>">
									<img src="<?php echo base_url('assets/img/plus.png'); ?>" alt=""> 
									Create Training
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
												<th>serial</th>
												<th>trainers</th>
												<th>training type</th>
												<th>starts on</th>
												<th>ends on</th>
											</tr>
										</thead>
										<tbody>
										<?php $serial = 1; if($sl3['accessLevel3']): // Check Access Level.
										foreach($trainings_list as $training): ?>
											<tr>
												<td>
													<?php echo $serial++; ?>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $training->trainer_one; ?>"><?=$training->first_name." ".$training->last_name; ?></a>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trg_id; ?>">
													<?php echo $training->type; ?></a>
												</td>
												<td>
													<?php echo date('M d, Y', strtotime($training->start_date)); ?>
												</td>
												<td>
													<?php echo date('M d, Y', strtotime($training->end_date)); ?>
												</td>
											</tr>
										<?php endforeach; endif; ?>
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
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>
						<div class="col-md-1"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-9">
							<div class="tabelHeading">
								<h3>refreshers <small>two trainings in a year are compulsory</small></h3>
							</div>
						</div>
						<div class="col-md-3">
							<div class="tabelTopBtn">
								<a class="btn" href="<?php echo base_url('trainings/all_refresher'); ?>">
									View All
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
												<th>serial</th>
												<th>training type</th>
												<th>trainer</th>
												<th>starts on</th>
												<th>ends on</th>
											</tr>
										</thead>
										<tbody>
											<?php $sno =1; if($sl3['accessLevel3']):
											foreach($refreshers as $refresh): ?>
											<tr>
												<td>
													<?php echo $sno++; ?>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $refresh->trg_id; ?>">
													<?php echo $refresh->type; ?></a>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>trainings/detail_trainer/<?php echo $refresh->trainer_one; ?>"><?=$refresh->first_name." ".$refresh->last_name; ?></a>
												</td>
												<td>
													<?php echo date('M d, Y', strtotime($refresh->start_date)); ?>
												</td>
												<td>
													<?php echo date('M d, Y', strtotime($refresh->end_date)); ?>
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
	<section class="secIndexTable">
		<div class="mainTableWhite">
			<div class="row">
				<div class="col-md-8">
					<div class="tabelHeading">
						<h3>trainings completed <small>click on the training type to view detail, i.e, expenses, employees' names etc...</small></h3>
					</div>
				</div>
				<div class="col-md-4">
					<div class="tabelTopBtn">
						<a class="btn" href="<?php echo base_url('trainings/all_completed'); ?>">
							View All
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
									<?php endforeach; endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>