<section class="secMainWidthFilter">
	<!-- <section class="secFormLayout"> -->
		
		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#investigation-search-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Investigation/view" method="GET" id="investigation-search-form">
						<div class="selectBoxMain">
							<div class="filterSelect">
								<input type="text" name="case_no" class="form-control" placeholder="Case No">
							</div>

							<div class="filterSelect">
								<input type="text" name="employee_name" class="form-control" placeholder="Employee Name">
							</div>

							<div class="filterSelect">
								<input type="text" name="cnic" class="form-control" placeholder="CNIC No">
							</div>
							
							<div class="filterSelect">
								<input type="text" name="from_date" class="form-control date" placeholder="From Date">
							</div>
							<div class="filterSelect">
								<input type="text" name="to_date" class="form-control date" placeholder="To Date">
							</div>

							<div class="filterSelect">
								<select name="investigation_status" id="investigation-status" class="form-control">
									<option value="">Status</option>
									<option value="">Show All</option>
									<option value="initiated">Initiated</option>
									<option value="in-progress">In Progress</option>
									<option value="completed">Completed</option>
									<option value="submitted">Submitted</option>
									<option value="cancelled">Cancelled</option>
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
								<button type="submit" name="search" id="investigation-search-btn" class="btn btnSubmit">Search</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-10">
				<div class="topNavFilter">
				
				</div>
				<div>
					<div class="mainTableWhite">
						<div class="row">
							<div class="col-md-12">
								<div class="tabelHeading">
									<div class="col-md-10">
										<h3><?= $title; ?><span></span>
											<br>
											<small class="" id="inv-status-btn">
												<a href="javascript:void(0);" data-status="initiated" class="label label-warning">initiated</a>
												<a href="javascript:void(0);" data-status="in-progress" class="label label-info">in progress</a>
												<a href="javascript:void(0);" data-status="completed" class="label label-success">completed</a>
												<a href="javascript:void(0);" data-status="submitted" class="label label-primary">submitted</a>
												<a href="javascript:void(0);" data-status="cancelled" class="label label-danger">cancelled</a>
												<a href="javascript:void(0);" data-status="all" class="label label-default">show all</a>
											</small>
										</h3>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="tableMain">
									<div class="table-responsive">
										<table class="table table-hover" id="investigations-table">
											<thead>
												<tr>
													<th>Case No</th>
													<th>Employee</th>
													<th>CNIC</th>
													<th>Project</th>
													<th>Department</th>
													<th>Designation</th>
													<th>Reason</th>
													<th>Date</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												
												<?php $count=1; foreach($investigation AS $i): 
													$label = '';
													if($i->status == "initiated") 
														$label = "label label-warning";
													elseif($i->status == "submitted")
														$label = "label label-primary";
													elseif($i->status == "completed")
														$label = "label label-success";
													elseif($i->status == "in-progress")
														$label = "label label-info";
													elseif($i->status == "cancelled")
														$label = "label label-danger";
												?>

													<tr data-id="<?= $i->id; ?>">
														<td><?= $i->case_no; ?></td>
														<td><?= ucwords($i->emp_name); ?></td>
														<td><?= $i->cnic; ?></td>
														<td><?= $i->project_name; ?></td>
														<td><?= $i->department_name; ?></td>
														<td><?= $i->designation_name; ?></td>
														<td><?= $i->reason_text; ?></td>
														<td><?= date('d-m-Y', strtotime($i->reported_date)); ?></td>
														<td>
															<label class="<?= $label; ?>"><?= $i->status; ?></label>
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
							<div class="col-md-12 text-center">
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		
	<!-- </section> -->
</section>