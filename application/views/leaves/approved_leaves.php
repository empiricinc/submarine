<?php 
/*  Filename : approved_leaves.php
*	Author: Saddam
*	Filepath : views / leaves / approved_leaves.php 
*/
?>
<section class="secMainWidth">
	<section class="secIndexTable margint-top-0">
		<div class="row">
			<div class="col-md-12">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-8">
							<div class="tabelHeading">
								<?php if(empty($results)): ?>
								<h3>list of approved leave requests <span>(approved requests)</span> | <small><a href="javascript:history.go(-1);">&laquo; Back</a></small></h3>
								<?php else: ?>
								<h3>Search results for: <small><?php echo $_GET['search_approved']; ?></small></h3>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="tabelTopBtn">
								<form class="form-inline" action="<?php echo base_url('leaves/approved_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_approved" class="form-control" placeholder="Search by name or type" required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form><small>Search by employee name of leave type....</small>
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
												<th>requester iD</th>
												<th>Requested by</th>
												<th>leave type</th>
												<th>request from</th>
												<th>request to</th>
												<th>date applied</th>
												<th>status</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($app_leaves)): foreach($app_leaves as $approved): ?>
											<tr>
												<td>
													<?php echo 'CTC-'.$approved->employee_id.'-'.date('Y'); ?>
												</td>
												<td>
													<?php echo $approved->first_name; ?>
												</td>
												<td>
													<?php echo $approved->type_name; ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($approved->from_date)); ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($approved->to_date)); ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($approved->applied_on)); ?>
												</td>
												<td>
													<button data-toggle="tooltip" title="<?= date('d M, Y', strtotime($approved->from_date)).' - '.date('d M, Y', strtotime($approved->to_date)); ?>" class="btn btn-success btn-xs">Approved <i class="fa fa-check"></i></button>
												</td>
											</tr>
											<?php endforeach; endif; ?>
											<?php if(!empty($results)): foreach($results as $result): ?>
												<tr>
												<td>
													<?php echo 'CTC-'.$result->employee_id.'-'.date('Y'); ?>
												</td>
												<td>
													<?php echo $result->first_name; ?>
												</td>
												<td>
													<?php echo $result->type_name; ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($result->from_date)); ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($result->to_date)); ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($result->applied_on)); ?>
												</td>
												<td>
													<button data-toggle="tooltip" title="<?= date('d M, Y', strtotime($result->from_date)).' - '.date('d M, Y', strtotime($result->to_date)); ?>" class="btn btn-success btn-xs">Approved <i class="fa fa-check"></i></button>
												</td>
											</tr>
											<?php endforeach; endif; ?>
											<?php if(empty($app_leaves) AND empty($results)): ?>
											<div class="alert alert-danger text-center">
												<p><strong>Aww snap! </strong>The keyword you're looking for doesn't exist. Try something that do exist instead.</p>
											</div>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-8 text-center">
								<?php if(!empty($app_leaves) AND empty($results)){ echo $this->pagination->create_links(); } ?>
							</div>
							<div class="col-md-2"></div>
						</div>
				</div>
			</div>
		</div>
	</section>
</section>
