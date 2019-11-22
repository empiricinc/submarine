<section class="secMainWidthFilter">
	<!-- <section class="secFormLayout"> -->
		
		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#disciplinary-search-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Disciplinary/view" method="GET" id="disciplinary-search-form">
						<div class="selectBoxMain">
							<div class="filterSelect">
								<input type="text" name="employee_id" class="form-control" placeholder="Employee ID" pattern="[0-9]*" title="Employee ID contain digits only">	
							</div>

							<div class="filterSelect">
								<input type="text" name="employee_name" class="form-control" placeholder="Employee Name">
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

							<div class="filterSelect">
								<input type="text" name="from_date" class="form-control date" placeholder="From Date">
							</div>
							<div class="filterSelect">
								<input type="text" name="to_date" class="form-control date" placeholder="To Date">
							</div>

							<div class="filterSelect">
								<select name="status" id="status" class="form-control">
									<option value="">Disciplinary Status</option>
									<?php foreach($status AS $s): ?>
										<option value="<?= $s->id; ?>"><?= ucwords($s->status_text); ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>
							
							<div class="filterSelect">
								<select name="type" id="type" class="form-control">
									<option value="">Disciplinary Type</option>
									<?php foreach($type AS $t): ?>
										<option value="<?= $t->id; ?>"><?= ucwords($t->type_name); ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>

							<div class="filterSelect">
								<select name="province" id="province" class="form-control">
									<option value="">Province</option>
									<?php foreach($province AS $p): ?>
									<option value="<?= $p->id; ?>"><?= ucwords($p->name); ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>

							<div class="filterSelectBtn">
								<button type="submit" name="search" id="disciplinary-search-btn" class="btn btnSubmit">Search</button>
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
											<small class="" id="status-btn">

											</small>
										</h3>
									</div>
									<div class="col-md-2">
										<div class="tabelTopBtn">
											<a href="<?= base_url(); ?>Disciplinary/reportXLS" class="btn">
												<i class="fa fa-file-excel-o"></i> Export Data
											</a>
										</div>
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
													<th>ID</th>
													<th>Employee</th>
													<th>Project</th>
													<th>Department</th>
													<th>Designation</th>
													<th>Reason</th>
													<th>Type</th>
													<th>Created date</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody id="disciplinary-list">
												
												<?php $count=1; foreach($disciplinary_actions AS $d): ?>

													<tr data="<?= $d->id; ?>">
														<td><?= $d->employee_id; ?></td>
														<td><?= ucwords($d->emp_name); ?></td>
														<td><?= $d->project_name; ?></td>
														<td><?= $d->department_name; ?></td>
														<td><?= $d->designation_name; ?></td>
														<td><?= $d->reason_text; ?></td>
														<td>
															<?= ucwords($d->type_name); ?>
														</td>
														<td><?= date('d-m-Y', strtotime($d->created_date)); ?></td>
														<td>
															<label class="label label-primary"><?= $d->status_text; ?></label>
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
							<div class="col-md-4 col-md-offset-4">
								<?php echo $this->pagination->create_links(); ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		
	<!-- </section> -->
</section>