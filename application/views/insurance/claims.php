<section class="secMainWidthFilter hide-from-print">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#employee-search-form')[0].reset();"></a></h3>
				</div>
				<form action="<?= base_url(); ?>Insurance/view_claims" method="GET" id="employee-search-form">
					<div class="selectBoxMain">
						<div class="filterSelect">
							<input type="text" name="employee_id" class="form-control" placeholder="Employee ID">
						</div>
						<div class="filterSelect">
							<input type="text" name="employee_name" class="form-control" placeholder="Employee Name">
						</div>
						<div class="filterSelect">
							<select name="designation" class="form-control">
								<option value="">Designation</option>
								<?php foreach($designations AS $d): ?>
								<option value="<?= $d->designation_id; ?>"><?= $d->designation_name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<select name="project" class="form-control">
								<option value="">Project</option>
								<?php foreach($projects AS $p): ?>
								<option value="<?= $p->company_id; ?>"><?= $p->name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>

						<div class="filterSelect">
							<select name="status" id="status" class="form-control">
								<option value="">Status</option>
								<option value="pending">Pending</option>
								<option value="inprogress">Inprogress</option>
								<option value="completed">Completed</option>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<select name="province" class="form-control province">
								<option value="">Province</option>
								<?php foreach($provinces AS $p): ?>
									<option value="<?= $p->id; ?>"><?= $p->name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						

						<div class="filterSelectBtn">
							<button type="submit" name="search" class="btn btnSubmit" id="search-btn">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<div class="col-lg-10">
			<div class="topNavFilter">
				
			</div>
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-12">
						<div class="tabelHeading">
							<div class="col-md-10">
								<h3><?= $title; ?> <span></span>
									<br>
									<small class="" id="status-btn">
										<a href="javascript:void(0);" data-status="pending" class="label label-warning">pending</a>
										<a href="javascript:void(0);" data-status="inprogress" class="label label-primary">inprogress</a>
										<a href="javascript:void(0);" data-status="completed" class="label label-success">completed</a>
										<a href="javascript:void(0);" data-status="" class="label label-danger">show all</a>
									</small>
								</h3>
							</div>
							<div class="col-md-2 text-right">
								<div class="tabelTopBtn pt-0">
								<a href="<?= base_url(); ?>Insurance/claimsReportXLS<?= '?'.$query_string; ?>" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
								</div>
							</div>

							<div class="col-lg-12 pt-10">
								<?php if($this->session->flashdata('success')): ?>
									<div class="alert alert-info" data-dismiss="alert">
										<?php echo $this->session->flashdata('success'); ?>
									</div>
								<?php elseif($this->session->flashdata('error')): ?>
									<div class="alert alert-danger" data-dismiss="alert">
										<?php echo $this->session->flashdata('error'); ?>
									</div> 
								<?php endif; ?>
							</div>
							
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table" id="employee-table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Contact</th>
											<!-- <th>Email</th> -->
											<th>Project</th>
											<th>Department</th>
											<th>Designation</th>
											<th>Date of birth</th>
											<!-- <th>From Date</th>
											<th>To Date</th> -->
											<th>Status</th>	
											<th>Action</th>	
										</tr>
									</thead>
									<tbody>
										<?php $count=1; foreach($insurance_claims AS $e): ?>
										<?php 
										    $label = '';
										    $a_label = '';

											if($e->status == 'pending') {
												$label = 'label-warning'; 
											} elseif($e->status == 'inprogress') {
												$label = 'label-primary';
											} elseif($e->status == 'completed') {
												$label = 'label-success';
											}
										 ?>
										<tr>
											<input type="hidden" id="emp-name-<?= $e->employee_id; ?>" value="<?= ucwords($e->emp_name); ?>">
											<input type="hidden" id="emp-designation-<?= $e->employee_id; ?>" value="<?= ucwords($e->designation_name); ?>">
											<input type="hidden" id="status-<?= $e->employee_id; ?>" value="<?= $e->status; ?>">
											
											<td><?= $e->employee_id; ?></td>
											<td><?= ucwords($e->emp_name); ?></td>
											<td><?= $e->contact_number; ?></td>
											<td><?= $e->project_name; ?></td>
											<td><?= $e->department_name; ?></td>
											<td><?= ucwords($e->designation_name); ?></td>
											<td><?= ($e->date_of_birth) ? date('d-m-Y', strtotime($e->date_of_birth)) : ''; ?></td>
											<td>
												<?= 
													'<label class="label '.$label.'" id="label-'. $e->employee_id.'">'.$e->status.'</label>'; 
												?>
											</td>
											<td>
												<div class="btn-group btn-group-sm dropdown-btns custom-dropdown-btn">
												  	<a class="btn btn-primary dropdown-toggle" href="javscript:void(0);" data-toggle="dropdown">
												  		<i class="fa fa-cog"></i>
												  		<i class="fa fa-angle-down"></i>
												  	</a>
												  	<ul class="dropdown-menu pull-right" style="z-index: 1000; background: #fff;">
													  	<li>   
													  		<a href="<?= base_url(); ?>Insurance/claim_detail/<?= $e->id; ?>" data-id="<?= $e->employee_id; ?>">
													  			<i class="fa fa-eye"></i>
													  			View Detail
													  		</a>
													  	</li>
													  	<?php if($e->status != 'completed'): ?>
													  	<li>   
													  	 	<a href="javascript:void(0);" class="change-status" data-status="<?= $e->status; ?>" data-id="<?= $e->id; ?>">
													  	 		<i class="fa fa-edit"></i>
													  	 		Update Status
													  		</a>
													  	</li>
													  	<?php endif; ?>
												  	</ul>
												</div>
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
					<div class="col-md-4">
						
					</div>
					<div class="col-md-4">
						<?php echo $this->pagination->create_links(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>