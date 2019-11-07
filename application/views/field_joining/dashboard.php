<section class="secMainWidth">
	<section class="secIndex">
		<div class="row">
			<div class="col-md-10">
				<div class="headingMain">
					<h1>
						<?= $title; ?>
						<span></span>
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
									<h3>Unverified <span></span></h3>
								</div>
							</div>
							<div class="col-md-5">
								<div class="tabelTopBtn" style="padding-top: 12px !important;">
									<a href="<?= base_url(); ?>Field_joining/employees?record_type=unverified" class="btn">
										<i class="fa fa-eye"></i> View All
									</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="tableMain">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Gender</th>
													<th>Designation</th>
													<th>Province</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($unverified AS $e): ?>
												<tr>
													<td><?= ucwords($e->emp_name); ?></td>
													<td><?= ucfirst($e->gender); ?></td>
													<td><?= $e->designation_name; ?></td>
													<td><?= ucfirst($e->province); ?></td>
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
									<h3>DOJ Verified <span></span></h3>
								</div>
							</div>
							<div class="col-md-5">
								<div class="tabelTopBtn" style="padding-top: 12px !important;">
									<a href="<?= base_url(); ?>Field_joining/employees?record_type=doj" class="btn">
										<i class="fa fa-eye"></i> View All
									</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="tableMain">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Gender</th>
													<th>Designation</th>
													<th>Province</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($doj_verified AS $e): ?>
												<tr>
													<td><?= ucwords($e->emp_name); ?></td>
													<td><?= ucfirst($e->gender); ?></td>
													<td><?= $e->designation_name; ?></td>
													<td><?= ucfirst($e->province); ?></td>
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
									<h3>CNIC Verified <span></span></h3>
								</div>
							</div>
							<div class="col-md-5">
								<div class="tabelTopBtn" style="padding-top: 12px !important;">
									<a href="<?= base_url(); ?>Field_joining/employees?record_type=cnic" class="btn">
										<i class="fa fa-eye"></i> View All
									</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="tableMain">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Gender</th>
													<th>Designation</th>
													<th>Province</th>												</tr>
											</thead>
											<tbody>
												<?php foreach($cnic_verified AS $e): ?>
												<tr>
													<td><?= ucwords($e->emp_name); ?></td>
													<td><?= ucfirst($e->gender); ?></td>
													<td><?= $e->designation_name; ?></td>
													<td><?= ucfirst($e->province); ?></td>
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
									<h3>CNIC/DOJ Verified <span></span></h3>
								</div>
							</div>
							<div class="col-md-5">
								<div class="tabelTopBtn" style="padding-top: 12px !important;">
									<a href="<?= base_url(); ?>Field_joining/employees?record_type=both" class="btn">
										<i class="fa fa-eye"></i> View All
									</a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="tableMain">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Gender</th>
													<th>Designation</th>
													<th>Province</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($both_verified AS $e): ?>
												<tr>
													<td><?= ucwords($e->emp_name); ?></td>
													<td><?= ucfirst($e->gender); ?></td>
													<td><?= $e->designation_name; ?></td>
													<td><?= ucfirst($e->province); ?></td>
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