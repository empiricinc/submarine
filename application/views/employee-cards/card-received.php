<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad hide-from-print">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#employee-search-form')[0].reset();"></a></h3>
				</div>
				<form action="<?= base_url(); ?>Employee_cards/received" method="GET" id="employee-search-form">
					<div class="selectBoxMain">
						<input type="hidden" name="card_status" value="3">
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
							<select name="province" class="form-control province">
								<option value="">Province</option>
								<?php foreach($provinces AS $p): ?>
									<option value="<?= $p->id; ?>"><?= $p->name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect hide">
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
						</div>
						

						<div class="filterSelectBtn">
							<button type="submit" name="search" class="btn btnSubmit" id="search">Search</button>
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
							<div class="col-md-6">
								<h3>Receive Cards <span></span></h3>
							</div>
							<div class="col-md-6 text-right">
								<div class="tabelTopBtn">
									<a href="javascript:void(0);" data-url="<?= base_url(); ?>Employee_cards/status_update" data-status="3" class="btn change-status">
										<i class="fa fa-check"></i> Mark As Received
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
								<table class="table" id="employee-table" style="cursor: pointer;">
									<thead>
										<tr>
											<th>
												<input type="checkbox" id="mark-all">
											</th>
											<th>ID</th>
											<th>Name</th>
											<th>Contact</th>
											<th>Project</th>
											<th>Designation</th>
											<th>Date of joining</th>
											<th>Deliver Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $count=0; foreach($employees AS $e): ?>
										<tr>
											<td>
												<input type="checkbox" data-id="<?= $e->card_id; ?>" data-index="<?= $count; ?>" class="employee">
											</td>
											<td><?= $e->employee_id; ?></td>
											<td><?= ucwords($e->emp_name); ?></td>
											<td><?= $e->contact_number; ?></td>
											<td><?= $e->project_name; ?></td>
											<td><?= $e->designation_name; ?></td>
											<td><?= ($e->date_of_joining) ? date('d-m-Y', strtotime($e->date_of_joining)) : ''; ?></td>
											<td><?= ($e->deliver_date) ? date('d-m-Y', strtotime($e->deliver_date)) : ''; ?></td>
											<td>
												<a href="javascript:void(0);" data-status="<?= $card_status; ?>" data-id="<?= $e->card_id; ?>" data-url="<?= base_url(); ?>Employee_cards/status_update" class="label label-success change-status">received</a>
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
</section>