<section class="secMainWidthFilter hide-from-print">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#doj-search-form')[0].reset();"></a></h3>
				</div>
				<form action="<?= base_url(); ?>Field_joining/employees" method="GET" id="doj-search-form">
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
							<select name="record_type" id="status" class="form-control">
								<option value="all" <?php if($type == 'all'): ?> selected <?php endif; ?>>Show All</option>
								<option value="cnic" <?php if($type == 'cnic'): ?> selected <?php endif; ?>>CNIC Verified</option>
								<option value="doj" <?php if($type == 'doj'): ?> selected <?php endif; ?>>DOJ Verified</option>
								<option value="both" <?php if($type == 'both'): ?> selected <?php endif; ?>>CNIC/DOJ Verified</option>
								<option value="unverified" <?php if($type == 'unverified'): ?> selected <?php endif; ?>>Unverified</option>
							</select>
							<span></span>
						</div>
						<!-- <div class="filterSelect">
							<select name="project" class="form-control">
								<option value="">Project</option>
								<?php foreach($projects AS $p): ?>
								<option value="<?= $p->company_id; ?>"><?= $p->name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<select name="location" class="form-control">
								<option value="">Location</option>
								<?php foreach($locations AS $l): ?>
								<option value="<?= $l->location_id; ?>"><?= $l->location_name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div> -->

						<div class="filterSelect">
							<select name="province" class="form-control province">
								<option value="">Province</option>
								<?php foreach($provinces AS $p): ?>
									<option value="<?= $p->id; ?>"><?= $p->name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<!-- <div class="filterSelect hide">
							<select name="district" class="form-control district" id="district">
								<option value="">District</option>
								
							</select>
							<span></span>
						</div>
						<div class="filterSelect hide">
							<select name="tehsil" class="form-control tehsil" id="tehsil">
								<option value="">Tehsil</option>
								
							</select>
							<span></span>
						</div>
						<div class="filterSelect hide">
							<select name="uc" class="form-control uc" id="uc">
								<option value="">UC</option>
								
							</select>
							<span></span>
						</div> -->
						

						<div class="filterSelectBtn">
							<button type="submit" name="search" class="btn btnSubmit" id="search-btn">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		
				
		<div class="col-lg-10">
			<div id="employees-handler">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-12">
							<div class="tabelHeading">
								<div class="col-md-10">
									<h3><?= $title; ?><span></span>
										<br>
										<small class="" id="status-btn">
											<a href="javascript:void(0);" data-status="cnic" class="label label-warning">CNIC verified</a>
											<a href="javascript:void(0);" data-status="doj" class="label label-info">DOJ verified</a>
											<a href="javascript:void(0);" data-status="both" class="label label-primary">Both Verified</a>
											<a href="javascript:void(0);" data-status="unverified" class="label label-success">unverified</a>
											<a href="javascript:void(0);" data-status="all" class="label label-danger">show all</a>
										</small>
									</h3>
								</div>
								<div class="col-md-2 text-right">
									<div class="tabelTopBtn pt-0">
									<a href="<?= base_url(); ?>Field_joining/reportXLS<?= '?'.$query_string; ?>" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="tableMain">
											<div class="table-responsive">
												<table class="table table-hover" id="employee-table" style="cursor: pointer;">
													<thead>
														<tr>
															<th>ID</th>
															<th>Province</th>
															<th>District</th>
															<th>Name</th>
															<th>Gender</th>
															<th>Designation</th>
															<th>D.O.B</th>
															<th>CNIC</th>
															<th>D.O.J</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php $count=1; foreach($employees AS $e): ?>
														<tr data-row="<?= $e->employee_id; ?>">
															<input type="hidden" id="name-<?= $e->employee_id; ?>" value="<?= ucwords($e->emp_name); ?>">
															<input type="hidden" id="fathername-<?= $e->employee_id; ?>" value="<?= ucwords($e->father_name); ?>">
															<input type="hidden" id="designation-<?= $e->employee_id; ?>" value="<?= ucwords($e->designation_name); ?>">
															<?php $action = ($e->doj == '' && $e->cnic_no == '') ? 'add' : 'update'; ?>
															<input type="hidden" id="action-<?= $e->employee_id; ?>" value="<?= $action; ?>">

															<td><?= $e->employee_id; ?></td>
															<td><?= ucfirst($e->province); ?></td>
															<td><?= ucfirst($e->district); ?></td>
															<td><?= ucwords($e->emp_name); ?></td>
															<td><?= ucfirst($e->gender); ?></td>
															<td><?= $e->designation_name; ?></td>
															<td><?= date('d-m-Y', strtotime($e->date_of_birth)); ?></td>
															<td><?= $cnic_no = ($e->cnic_no == '') ? '<label class="label label-default">Unverified</label>' : $e->cnic_no; ?></td>
															<td><?= $doj = ($e->doj == '') ? '<label class="label label-default">Unverified</label>' : date('d-m-Y', strtotime($e->doj)); ?></td>
															<td>
																<?php if($e->doj == '' || $e->cnic_no == ''): ?>
																<div class="btn-group btn-group-sm">
																  	<a class="btn btn-primary dropdown-toggle" href="javscript:void(0);" data-toggle="dropdown">
																  		<i class="fa fa-cog"></i>
																  		<i class="fa fa-angle-down"></i>
																  	</a>
																  	<ul class="dropdown-menu pull-right" style="z-index: 1000; background: #fff;">
																  		<?php if($e->cnic_no == ''): ?>
																	  	<li>   
																	  		<a href="javascript:void(0);" class="cnic-check-link" data-id="<?= $e->employee_id; ?>">
																	  			<i class="fa fa-check"></i>
																	  			CNIC Check
																	  		</a>
																	  	</li>
																	  	<?php endif; ?>
																	  	<?php if($e->doj == ''): ?>
																	  	<li>   
																	  	 	<a href="javascript:void(0);" class="doj-link" data-id="<?= $e->employee_id; ?>">
																	  	 		<i class="fa fa-edit"></i>
																	  	 		Enter DOJ
																	  		</a>
																	  	</li>
																	  	<?php endif; ?>
																  	</ul>
																</div>
																<?php endif; ?>

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
</section>