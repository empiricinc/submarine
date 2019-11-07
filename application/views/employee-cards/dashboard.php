<section class="secMainWidth">
	<section class="secIndex">
		<div class="row">
			<div class="col-md-12">
				<div class="headingMain">
					<h1>
						Employee's Card Dashboard
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
								<h3>Card Requests <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Employee_cards/view?status=0" class="btn">
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
												<th>ID</th>
												<th>Name</th>
												<th>Project</th>
												<th>Date of Joining</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($card_request AS $c): ?>
											<tr>
												<td><?= $c->employee_id; ?></td>
												<td><?= ucwords($c->emp_name); ?></td>
												<td><?= $c->project_name; ?></td>
												<td><?= ($c->date_of_joining) ? date('d-m-Y', strtotime($c->date_of_joining)) : ''; ?></td>
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
								<h3>Pending for Print <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Employee_cards/view?status=1" class="btn">
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
												<th>ID</th>
												<th>Name</th>
												<th>Project</th>
												<th>Date of Joining</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($pending AS $c): ?>
											<tr>
												<td><?= $c->employee_id; ?></td>
												<td><?= ucwords($c->emp_name); ?></td>
												<td><?= $c->project_name; ?></td>
												<td><?= ($c->date_of_joining) ? date('d-m-Y', strtotime($c->date_of_joining)) : ''; ?></td>
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
		<br>

		<div class="row">
			<div class="col-md-6">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Printed <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Employee_cards/view?status=2" class="btn">
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
												<th>ID</th>
												<th>Name</th>
												<th>Project</th>
												<th>Print Date</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($printed AS $c): ?>
												<tr>
													<td><?= $c->employee_id; ?></td>
													<td><?= ucwords($c->emp_name); ?></td>
													<td><?= $c->project_name; ?></td>
													<td><?= date('d-m-Y', strtotime($c->print_date)); ?></td>
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
								<h3>Delivered <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Employee_cards/view?status=3" class="btn">
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
												<th>ID</th>
												<th>Name</th>
												<th>Project</th>
												<th>Deliver Date</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($delivered AS $c): ?>
												<tr>
													<td><?= $c->employee_id; ?></td>
													<td><?= ucwords($c->emp_name); ?></td>
													<td><?= $c->project_name; ?></td>
													<td><?= date('d-m-Y', strtotime($c->deliver_date)); ?></td>
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
		<br>
		<div class="row">
			
			<div class="col-md-12">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>Received <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">		
								<a href="<?= base_url(); ?>Employee_cards/view?status=4" class="btn">
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
												<th>ID</th>
												<th>Name</th>
												<th>Project</th>
												<th>Receive Date</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($received AS $c): ?>
												<tr>
													<td><?= $c->employee_id; ?></td>
													<td><?= ucwords($c->emp_name); ?></td>
													<td><?= $c->project_name; ?></td>
													<td><?= date('d-m-Y', strtotime($c->receive_date)); ?></td>
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