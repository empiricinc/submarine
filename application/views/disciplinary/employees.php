<section class="secMainWidthFilter hide-from-print">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#employee-search-form')[0].reset();"></a></h3>
				</div>
				<form action="<?= base_url(); ?>Disciplinary/employees" method="GET" id="employee-search-form">
					<div class="selectBoxMain">
						<div class="filterSelect">
							<input type="text" name="employee_id" class="form-control" placeholder="Employee ID" pattern="[0-9]*" title="Employee ID contain digits only">
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
							<div class="col-md-10">
								<h3><?= $title; ?> <span></span></h3>
								<small>(Click on row to add disciplinary)</small>
							</div>

						</div>
					</div>
				</div>
				<div class="row" style="margin-left: 0px; margin-right: 0px; margin-top: 5px;">
					<div class="col-lg-12">
						<?php if(isset($errors)): ?>
							<div class="alert alert-danger" data-dismiss="alert">
								<?php echo $errors; ?>
							</div>
						<?php endif; ?>
						
						<?php if($this->session->flashdata('success')): ?>
							<div class="alert alert-info" data-dismiss="alert">
								<?php echo $this->session->flashdata('success'); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table table-hover" id="disciplinary-table" style="cursor: pointer;">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Contact</th>
											<th>Project</th>
											<th>Department</th>
											<th>Designation</th>
											<th>Date of birth</th>
										</tr>
									</thead>
									<tbody>
										<?php $count=1; foreach($employees AS $e): ?>
										<tr data-id="<?= $e->employee_id; ?>">
											<td><?= $e->employee_id; ?></td>
											<td><?= ucwords($e->emp_name); ?></td>
											<td><?= $e->contact_number; ?></td>
											<td><?= $e->company_name; ?></td>
											<td><?= $e->department_name; ?></td>
											<td><?= $e->designation_name; ?></td>
											<td><?= date('d-m-Y', strtotime($e->date_of_birth)); ?></td>
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
</section>