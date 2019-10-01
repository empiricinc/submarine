<section class="secMainWidth">
	<section class="secIndex">
		<div class="row">
			<div class="col-md-12">
				<div class="headingMain">
					<h1>
						Insurance Dashboard
						<!-- <span>statics and more</span> -->
					</h1>
				</div>
			</div>
		</div>
	</section>
	
	<section class="secIndexTable margint-top-0">
		<div class="row">
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Pending Insurances <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Insurance/reportXLS?status=pending" class="btn">
									<i class="fa fa-file-excel-o"></i> Export All
								</a>
								<a href="<?= base_url(); ?>Insurance/list_employees?status=pending" class="btn">
									<i class="fa fa-eye"></i> View All
								</a>
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
												<th>Employee Name</th>
												<th>Project</th>
												<th>Department</th>
												<th>Designation</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($insurances AS $i): ?>
											<tr>
												<td><?= ucwords($i->emp_name); ?></td>
												<td><?= ucwords($i->project_name); ?></td>
												<td><?= ucwords($i->department_name) ?></td>
												<td><?= ucwords($i->designation_name); ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Pending Claims<span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Insurance/claimsReportXLS?status=pending" class="btn">
									<i class="fa fa-file-excel-o"></i> Export All
								</a>
								<a href="<?= base_url(); ?>Insurance/view_claims?status=pending" class="btn">
									<i class="fa fa-eye"></i> View All
								</a>
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
												<th>Employee Name</th>
												<th>Project</th>
												<th>Department</th>
												<th>Designation</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($pending AS $p): ?>
											<tr>
												<td><?= ucwords($p->emp_name); ?></td>
												<td><?= ucwords($p->project_name); ?></td>
												<td><?= ucwords($p->department_name) ?></td>
												<td><?= ucwords($p->designation_name); ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="secIndexTable margint-top-0">
		<div class="row">
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Inprogress Claims<span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Insurance/claimsReportXLS?status=inprogress" class="btn">
									<i class="fa fa-file-excel-o"></i> Export All
								</a>
								<a href="<?= base_url(); ?>Insurance/view_claims?status=inprogress" class="btn">
									<i class="fa fa-eye"></i> View All
								</a>
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
												<th>Employee Name</th>
												<th>Project</th>
												<th>Department</th>
												<th>Designation</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($inprogress AS $i): ?>
											<tr>
												<td><?= ucwords($i->emp_name); ?></td>
												<td><?= ucwords($i->project_name); ?></td>
												<td><?= ucwords($i->department_name) ?></td>
												<td><?= ucwords($i->designation_name); ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Completed Claims<span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Insurance/claimsReportXLS?status=completed" class="btn">
									<i class="fa fa-file-excel-o"></i> Export All
								</a>
								<a href="<?= base_url(); ?>Insurance/view_claims?status=completed" class="btn">
									<i class="fa fa-eye"></i> View All
								</a>
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
												<th>Employee Name</th>
												<th>Project</th>
												<th>Department</th>
												<th>Designation</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($completed AS $c): ?>
											<tr>
												<td><?= ucwords($c->emp_name); ?></td>
												<td><?= ucwords($c->project_name); ?></td>
												<td><?= ucwords($c->department_name) ?></td>
												<td><?= ucwords($c->designation_name); ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>