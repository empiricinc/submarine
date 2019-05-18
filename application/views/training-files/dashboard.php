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
								<h3>Upcoming trainings <small>(trainings to be held)</small>
								<small>click the training type to view training detail</small></h3>
							</div>
						</div>
						<div class="col-md-4">
							<div class="tabelTopBtn">
								<a class="btn" href="<?php echo base_url('trainings/add_trainings'); ?>">
									<img src="<?php echo base_url('dashboardDesign/assets/img/plus.png'); ?>" alt=""> 
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
										<?php $serial = 1; foreach($trainings_list as $training): ?>
											<tr>
												<td>
													<?php echo $serial++; ?>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trainer_one; ?>"><?=$training->first_name." ".$training->last_name; ?></a>
												</td>
												<td>
													<a href="<?php echo base_url(); ?>trainings/detail_training/<?php echo $training->trainer_one; ?>">
													<?php echo $training->type; ?></a>
												</td>
												<td>
													<?php echo date('M d, Y', strtotime($training->start_date)); ?>
												</td>
												<td>
													<?php echo date('M d, Y', strtotime($training->end_date)); ?>
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
						<div class="col-md-1">
							
						</div>
						<div class="col-md-10">
							<div class="tabelSideListing text-center">
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>
						<div class="col-md-1">
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-9">
							<div class="tabelHeading">
								<h3>refreshers <small>(two trainings in a year are compulsory)</small></h3>
							</div>
						</div>
						<div class="col-md-3">
							<div class="tabelTopBtn">
								<a class="btn" href="<?php echo base_url('tests/total_trainings'); ?>">
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
												<th>employee</th>
												<th>training type</th>
												<th>trainer</th>
												<th>starting date</th>
											</tr>
										</thead>
										<tbody>
											
											<tr>
												<td>
													
												</td>
												<td>
													
												</td>
												<td>
													
													</a>
												</td>
												<td>
													
												</td>
												<td>
													
												</td>
											</tr>
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
								
							</div>
						</div>
						<div class="col-md-3">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="secIndexTable">
		<div class="mainTableWhite">
			<div class="row">
				<div class="col-md-6">
					<div class="tabelHeading">
						<h3>decision pending... <small>(decision pending ...)</small></h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="tabelTopBtn">
						<a class="btn" href="<?php echo base_url('tests/pending'); ?>">
							<img src="<?php echo base_url('dashboardDesign/assets/img/icon2.png'); ?>" alt=""> 
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
										<th>decision pending...</th>
										<th>decision pending...</th>
										<th>decision pending...</th>
										<th>decision pending...</th>
										<th>decision pending...</th>
										<th>decision pending...</th>
										<th>decision pending...</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
									</tr>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="tabelSideListing">
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="tabelCenterListing">
						<?php //echo $pagination_link_two; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
