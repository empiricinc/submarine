<?php 
/*  Filename : leaves_dashboard.php
*	Author: Saddam
*	Filepath : views / leaves / leaves_dashboard.php 
*/
?>
<section class="secMainWidth">
	<section class="secIndex">
		<div class="row">
			<div class="col-md-12">
				<div class="headingMain">
					<?php if($success = $this->session->flashdata('success')): ?>
						<div class="alert alert-warning text-center">
							<p><?php echo $success; ?></p>
						</div>
					<?php endif; ?>
					<h1>
						Leaves Management Dashboard
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
								<h3>Pending <span>(requests pending)</span></h3>
							</div>
						</div>
						<div class="col-md-4">
							<div class="tabelTopBtn">
								<a class="btn" href="<?php echo base_url('leaves/list_pending'); ?>"> 
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
												<th>Requested by</th>
												<th>leave type</th>
												<th>date applied</th>
												<th>options</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($pen_leaves as $pending): ?>
											<tr>
												<td>
													<?php echo $pending->first_name; ?>
												</td>
												<td>
													<?php echo $pending->type_name; ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($pending->applied_on)); ?>
												</td>
												<td>
													<a data-toggle="modal" data-target="#leaveModal<?php echo $pending->leave_id; ?>" href="" class="btn btn-info btn-xs">Action</a>
													<div class="modal fade" id="leaveModal<?= $pending->leave_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <!--Header-->
                                <div class="modal-header">
                                  <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Leave Request Detail</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <!--Body-->
                                <div class="modal-body">
                                     <div class="row">
                                     	<div class="col-md-6">
                                     		<h4>Information</h4><hr>
                                     			<div class="row">
                                     				<div class="col-md-6">
                                     					<strong>Requested by: </strong>
                                     				</div>
                                     				<div class="col-md-6">
                                     					<p><?php echo $pending->first_name; ?></p>
                                     				</div>
                                     			</div>
                                     			<div class="row">
                                     				<div class="col-md-6">
                                     					<strong>Leave type: </strong>
                                     				</div>
                                     				<div class="col-md-6">
                                     					<p><?php echo $pending->type_name; ?></p>
                                     				</div>
                                     			</div>
                                     		  <div class="row">
                                     		  	<div class="col-md-6">
                                     		  		<strong>Date requested: </strong>
                                     		  	</div>
                                     		  	<div class="col-md-6">
                                     		  		<p><?php echo date('d M, Y', strtotime($pending->applied_on)); ?></p>
                                     		  	</div>
                                     		  </div>
		                                      <div class="row">
		                                      	<div class="col-md-6">
		                                      		<strong>From: </strong>
		                                      	</div>
		                                      	<div class="col-md-6">
		                                      		<p><?php echo date('d M, Y', strtotime($pending->from_date)); ?></p>
		                                      	</div>
		                                      </div>
		                                      <div class="row">
		                                      	<div class="col-md-6">
		                                      		<strong>Till: </strong>
		                                      	</div>
		                                      	<div class="col-md-6">
		                                      		<p><?php echo date('d M, Y', strtotime($pending->to_date)); ?></p>
		                                      	</div>
		                                      </div>
		                                      <div class="row">
		                                      	<div class="col-md-6">
		                                      		<strong>Reason: </strong>
		                                      	</div>
		                                      	<div class="col-md-6">
		                                      		<p><?php echo $pending->reason; ?></p>
		                                      	</div>
		                                      </div>
                                     	</div>
                                     	<div class="col-md-6">
                                     		<h4>Actions</h4><hr>
                                     		<strong>Grant leave as </strong>
                                     		<a data-toggle="tooltip" title="By clicking this button, the normal procedure will be followed and the leave status will be changed to Approved." href="<?= base_url(); ?>leaves/approve_leave/<?= $pending->leave_id; ?>" class="btn btn-info btn-xs">Paid Leave</a>
                                     		<a data-toggle="tooltip" title="Are you sure to grant an unpaid leave? Salary will be deducted from the employee's salary and the payroll will be effected." href="<?= base_url(); ?>leaves/approve_leave_unpaid/<?= $pending->employee_id; ?>" class="btn btn-primary btn-xs">Unpaid Leave</a> <br><br>
                                     		<strong>Or reject leave </strong>
                                     		<a href="<?= base_url(); ?>leaves/reject_leave/<?= $pending->leave_id; ?>" class="btn btn-warning btn-xs">Reject Request</a> <br><br>
                                     		<small><strong>Note: </strong>If the unpaid leave has clicked, the employee's data will go to the payroll and salary will be deducted.</small>
                                     	</div>
                                     </div>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                        </div>
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
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-9">
							<div class="tabelHeading">
								<h3>approved <span>(approved requests)</span></h3>
							</div>
						</div>
						<div class="col-md-3">
							<div class="tabelTopBtn">
								<a class="btn" href="<?php echo base_url('leaves/list_approved'); ?>">
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
												<th>Requested by</th>
												<th>leave type</th>
												<th>date applied</th>
												<th>status</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($app_leaves as $approved): ?>
											<tr>
												<td>
													<?php echo $approved->first_name; ?>
												</td>
												<td>
													<?php echo $approved->type_name; ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($approved->applied_on)); ?>
												</td>
												<td>
													<button data-toggle="tooltip" title="<?= date('d M, Y', strtotime($approved->from_date)).' - '.date('d M, Y', strtotime($approved->to_date)); ?>" class="btn btn-success btn-xs">Approved <i class="fa fa-check"></i></button>
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
	<section class="secIndexTable">
		<div class="mainTableWhite">
			<div class="row">
				<div class="col-md-6">
					<div class="tabelHeading">
						<h3>rejected <span>(requests rejected)</span></h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="tabelTopBtn">
						<a class="btn" href="<?php echo base_url('leaves/list_rejected'); ?>">
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
										<th>Requested by</th>
										<th>leave type</th>
										<th>date applied</th>
										<th>reason</th>
										<th>remarks</th>
										<th>status</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($rej_leaves as $rejected): ?>
									<tr>
										<td>
											<?php if($rejected->first_name == ''){ echo '<button data-toggle="tooltip" title="You\'re seeing this becuase employee name isn\'t available at the moment." class="btn btn-danger btn-xs">("_")</button>'; }else{ echo $rejected->first_name; } ?>
										</td>
										<td>
											<?php echo $rejected->type_name; ?>
										</td>
										<td>
											<?php echo date('M d, Y', strtotime($rejected->applied_on)); ?>
										</td>
										<td>
											<?php echo $rejected->reason; ?>
										</td>
										<td>
											<?php echo htmlspecialchars_decode($rejected->remarks); ?>
										</td>
										<td>
											<button data-toggle="tooltip" title="<?= date('d M, Y', strtotime($rejected->from_date)).' - '.date('d M, Y', strtotime($rejected->to_date)); ?>" class="btn btn-danger btn-xs">Wasted <i class="fa fa-trash"></i></button>
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
	</section>
</section>
