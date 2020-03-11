<?php 
/*  Filename : pending_leaves.php
*	Author: Saddam
*	Filepath : views / leaves / pending_leaves.php 
*/
?>
<section class="secMainWidth">
	<section class="secIndexTable margint-top-0">
		<div class="row">
			<div class="col-md-12">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<?php if(empty($results)): ?>
								<h3>list of Pending leave requests <span>(requests pending)</span> | <small><a href="javascript:history.go(-1);">&laquo; Back</a></small></h3>
								<?php else: ?>
								<h3>Search results for: <small><?php echo $_GET['search_pending']; ?></small></h3>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn">
								<form class="form-inline" action="<?php echo base_url('leaves/pending_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_pending" class="form-control" placeholder="Search by name or type" required="" autocomplete="off">
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
												<th>options</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($pen_leaves)): foreach($pen_leaves as $pending): ?>
											<tr>
												<td>
													<?php echo 'CTC-'.$pending->employee_id.'-'.date('Y'); ?>
												</td>
												<td>
													<?php echo $pending->first_name; ?>
												</td>
												<td>
													<?php echo $pending->type_name; ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($pending->from_date)); ?>
												</td>
												<td>
													<?php echo date('d M, Y', strtotime($pending->to_date)); ?>
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
													<a data-toggle="modal" data-target="#leaveModal<?php echo $result->leave_id; ?>" href="" class="btn btn-info btn-xs">Action</a>
													<div class="modal fade" id="leaveModal<?= $result->leave_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                     					<p><?php echo $result->first_name; ?></p>
                                     				</div>
                                     			</div>
                                     			<div class="row">
                                     				<div class="col-md-6">
                                     					<strong>Leave type: </strong>
                                     				</div>
                                     				<div class="col-md-6">
                                     					<p><?php echo $result->type_name; ?></p>
                                     				</div>
                                     			</div>
                                     		  <div class="row">
                                     		  	<div class="col-md-6">
                                     		  		<strong>Date requested: </strong>
                                     		  	</div>
                                     		  	<div class="col-md-6">
                                     		  		<p><?php echo date('d M, Y', strtotime($result->applied_on)); ?></p>
                                     		  	</div>
                                     		  </div>
		                                      <div class="row">
		                                      	<div class="col-md-6">
		                                      		<strong>From: </strong>
		                                      	</div>
		                                      	<div class="col-md-6">
		                                      		<p><?php echo date('d M, Y', strtotime($result->from_date)); ?></p>
		                                      	</div>
		                                      </div>
		                                      <div class="row">
		                                      	<div class="col-md-6">
		                                      		<strong>Till: </strong>
		                                      	</div>
		                                      	<div class="col-md-6">
		                                      		<p><?php echo date('d M, Y', strtotime($result->to_date)); ?></p>
		                                      	</div>
		                                      </div>
		                                      <div class="row">
		                                      	<div class="col-md-6">
		                                      		<strong>Reason: </strong>
		                                      	</div>
		                                      	<div class="col-md-6">
		                                      		<p><?php echo $result->reason; ?></p>
		                                      	</div>
		                                      </div>
                                     	</div>
                                     	<div class="col-md-6">
                                     		<h4>Actions</h4><hr>
                                     		<strong>Grant leave as </strong>
                                     		<a data-toggle="tooltip" title="By clicking this button, the normal procedure will be followed and the leave status will be changed to Approved." href="<?= base_url(); ?>leaves/approve_leave/<?= $result->leave_id; ?>" class="btn btn-info btn-xs">Paid Leave</a>
                                     		<a data-toggle="tooltip" title="Are you sure to grant an unpaid leave? Salary will be deducted from the employee's salary and the payroll will be effected." href="<?= base_url(); ?>leaves/approve_leave_unpaid/<?= $result->employee_id; ?>" class="btn btn-primary btn-xs">Unpaid Leave</a> <br><br>
                                     		<strong>Or reject leave </strong>
                                     		<a href="<?= base_url(); ?>leaves/reject_leave/<?= $result->leave_id; ?>" class="btn btn-warning btn-xs">Reject Request</a> <br><br>
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
											<?php endforeach; endif; ?>
											<?php if(empty($pen_leaves) AND empty($results)): ?>
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
								<?php if(!empty($pen_leaves) AND empty($results)){ echo $this->pagination->create_links();} ?>
							</div>
							<div class="col-md-2"></div>
						</div>
				</div>
			</div>
		</div>
	</section>
</section>
