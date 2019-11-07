<section class="secMainWidthFilter">
	<!-- <section class="secFormLayout"> -->
		
		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#disciplinary-search-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Disciplinary/view" method="GET" id="complaints-search-form">
						<div class="selectBoxMain">
							<div class="filterSelect">
								<input type="text" name="from_date" class="form-control date" placeholder="From Date">
							</div>
							<div class="filterSelect">
								<input type="text" name="to_date" class="form-control date" placeholder="To Date">
							</div>

							<div class="filterSelect">
								<select name="status" id="status" class="form-control">
									<option value="">Status</option>
									<?php foreach($status AS $s): ?>
										<option value="<?= $s->id; ?>"><?= ucwords($s->status_text); ?></option>
									<?php endforeach; ?>
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
													<th>Date</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody id="investigations-list">
												
												<?php $count=1; foreach($disciplinary_actions AS $c): ?>

													<tr data="<?= $c->id; ?>">
														<td><?= $c->employee_id; ?></td>
														<td><?= ucwords($c->emp_name); ?></td>
														<td><?= $c->project_name; ?></td>
														<td><?= $c->department_name; ?></td>
														<td><?= $c->designation_name; ?></td>
														<td><?= $c->reason_text; ?></td>
														<td>
															<?= ucwords($c->type_name); ?>
														</td>
														<td><?= date('d-m-Y', strtotime($c->reported_date)); ?></td>
														<td>
															<label class="label label-primary"><?= $c->status_text; ?></label>
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