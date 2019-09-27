<section class="secMainWidthFilter">

		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#terminations-search-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Reports/terminations" method="GET" id="terminations-search-form">
						<div class="selectBoxMain">

							<div class="filterSelect">
								<input type="text" name="employee_name" class="form-control" placeholder="Employee Name">
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
								<select name="designation" class="form-control">
									<option value="">Designation</option>
									<?php foreach($designations AS $d): ?>
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
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-12">
							<div class="tabelHeading">
								<div class="col-md-10">
									<h3><?= $title; ?> <span></span></h3>
								</div>
								<div class="col-md-2 text-right">
									<div class="tabelTopBtn">
									<a href="<?= base_url(); ?>Reports/terminationsXLS" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
									</div>
								</div>
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="tableMain">
								<div class="table-responsive">
									<!-- Table -->
									<table class="table table-hover termination-table">
										<thead>
											<!-- <th>#</th> -->
											<th>Employee</th>
											<th>Project</th>
											<th>Designation</th>	
											<th>Termination Reason</th>
											<th>Terminated By</th>
											<th>Notice Date</th>
										</thead>
								        <tbody>
								        	<?php $count = 1; ?>
								        	<?php foreach($terminated AS $t): ?>
											<tr data="<?= $t->id; ?>" style="cursor: pointer;">
												<!-- <td><?= $count; ?></td> -->
												<td><?= ucwords($t->employee_name); ?></td>
												<td><?= $t->company_name; ?></td>
												<td><?= $t->designation_name; ?></td>
												<td><?= $t->reason_text; ?></td>
												<td><?= $t->terminator; ?></td>
												<td><?= $t->notice_date; ?></td>
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