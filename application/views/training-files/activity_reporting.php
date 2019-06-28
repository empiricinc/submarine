<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/*  Filename : activity_reporting.php
*	Author: Saddam
*	Filepath: views / training-files / activity_reporting.php
*	Displaying the report. 
*/
?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>
								training activity reporting
								<span>
									(monthly training activity report summary) 
								</span><br><br>
								<?php if(!empty($reports)): ?>
								<span>Province: </span>
								<div class="label label-primary">
									<?php echo $reports['name']; ?>
								</div>
							<?php endif; ?>
							</h3>
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
								<?php if(!empty($reports)): ?>
								<table class="table">
									<thead>
										<tr>
											<th colspan="0">district</th>
											<th colspan="0">town/uc/included in the trg</th>
											<th colspan="0">cadre</th>
											<th colspan="0">type of trg (refresher / induction)</th>
											<th colspan="0">plan (# of participants)</th>
											<th colspan="3">accomplishements (# of participants)</th>
											<th colspan="0">trg date</th>
											<th colspan="0">remark</th>
										</tr>
										<tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th style="padding: 0px; border-top: none;">male</th>
											<th style="padding: 0px;">female</th>
											<th style="padding: 0px;">total</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php echo $reports['cityName']; ?></td>
											<td>Town One</td>
											<td><?php echo "Finance Manger"; ?></td>
											<td><?php echo $reports['type']; ?></td>
											<td><?php echo "25"; ?></td>
											<td><?php echo $male; ?></td>
											<td><?php echo $female; ?></td>
											<td><?php echo $male + $female; ?></td>
											<td><?php echo date('M d, Y', strtotime($reports['start_date'])); ?></td>
											<td>
												<?php //echo $checklist; ?>
											</td>
										</tr>
									</tbody>
								</table>
								<?php else: ?>
									<div class="col-lg-8 col-lg-offset-2">
										<div class="alert alert-danger text-center">
											<p class="lead"><strong>Oops! </strong>Either record not found OR no activity report has been made yet !</p>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="tabelSideListing text-center">
							<span>
								<?php //echo $this->pagination->create_links(); endif; ?>
							</span>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
</section>