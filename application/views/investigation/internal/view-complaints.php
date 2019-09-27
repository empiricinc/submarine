<section class="secMainWidthFilter">
	<!-- <section class="secFormLayout"> -->
		
		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#complaints-search-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Investigation/view_internal" method="GET" id="complaints-search-form">
						<div class="selectBoxMain">
							<div class="filterSelect">
								<input type="text" name="complaint_no" class="form-control" placeholder="Complaint No">
							</div>
							
							<div class="filterSelect">
								<input type="text" name="from_date" class="form-control date" placeholder="From Date">
							</div>
							<div class="filterSelect">
								<input type="text" name="to_date" class="form-control date" placeholder="To Date">
							</div>

							<div class="filterSelect">
								<select name="complaint_status" class="form-control">
									<option value="">Status</option>
									<option value="all">Show All</option>
									<option value="pending">Pending</option>
									<option value="process">Process</option>
									<option value="review">Review</option>
									<option value="resolved">Resolved</option>
								</select>
								<span></span>
							</div>
							<div class="filterSelect">
								<select name="project" class="form-control">
									<option value="">Project</option>
									<?php foreach($project AS $p): ?>
									<option value="<?= $p->company_id; ?>"><?= $p->name; ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>

							<div class="filterSelect">
								<select name="department" class="form-control">
									<option value="">Department</option>
									<?php foreach($department AS $d): ?>
									<option value="<?= $d->department_id; ?>"><?= $d->department_name; ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>

							<div class="filterSelect">
								<select name="designation" class="form-control">
									<option value="">Designation</option>
									<?php foreach($designation AS $d): ?>
									<option value="<?= $d->designation_id; ?>"><?= $d->designation_name; ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>

							<div class="filterSelectBtn">
								<button type="submit" name="search" class="btn btnSubmit">Search</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-10">
				<div class="topNavFilter">
				
				</div>
				<div id="complaints-handler">
					<div class="mainTableWhite">
						<div class="row">
							<div class="col-md-12">
								<div class="tabelHeading">
									<div class="col-md-10">
										<h3><?= $title; ?><span></span>
											<br>
											<!-- <small class="" id="status-btn">
												<a href="javascript:void(0);" data-status="pending" class="label label-warning">pending</a>
												<a href="javascript:void(0);" data-status="process" class="label label-info">process</a>
												<a href="javascript:void(0);" data-status="review" class="label label-success">review</a>
												<a href="javascript:void(0);" data-status="resolved" class="label label-primary">resolved</a>
												<a href="javascript:void(0);" data-status="all" class="label label-danger">show all</a>
											</small> -->
										</h3>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="tableMain">
									<div class="table-responsive">
										<table class="table table-hover" id="">
											<thead>
												<tr>
													<th>Complaint No</th>
													<th>Employee</th>
													<th>Project</th>
													<th>Department</th>
													<th>Designation</th>
													<th>Reason</th>
													<th>Date</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody id="complaints-tbody-internal">
												<?php //var_dump($complaints); exit; ?>
												<?php $count=1; foreach($complaints AS $c): 
													$label = '';
													if($c->status == "pending") 
														$label = "label label-warning";
													elseif($c->status == "resolved")
														$label = "label label-primary";
													elseif($c->status == "review")
														$label = "label label-success";
													elseif($c->status == "process")
														$label = "label label-info";
												?>

													<tr data="<?= $c->id; ?>">
														<td><?= $c->complaint_no; ?></td>
														<td><?= $c->employee_id; ?></td>
														<td><?= $c->project_name; ?></td>
														<td><?= $c->department_name; ?></td>
														<td><?= $c->designation_name; ?></td>
														<td><?= $c->reason_text; ?></td>
														<td><?= date('d-m-Y', strtotime($c->reported_date)); ?></td>
														<td>
															<label class="<?= $label; ?>"><?= $c->status; ?></label>
														</td>
													</tr>
												<?php $count++; endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-4">
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		
	<!-- </section> -->
</section>