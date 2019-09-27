<section class="secMainWidth">
	<section class="secIndex">
		<div class="row">
			<div class="col-md-12">
				<div class="headingMain">
					<h1>
						Employee's Card Dashboard
						<span>statics and more</span>
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
								<h3>Ready to Print <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Employee_cards/print_cards/1" class="btn">
									<i class="fa fa-print"></i> Print All
								</a>
								<a href="<?= base_url(); ?>Employee_cards/view/1" class="btn">
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
												<!-- <th>
													<input type="checkbox" id="mark-all-pending">
												</th> -->
												<th>ID</th>
												<th>Name</th>
												<th>CNIC</th>
												<th>Project</th>
												<th>Date of Joining</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($cards AS $c): ?>
												<?php if($c->card_status == 'pending'): ?>
											<tr>
												<!-- <td>
													<input type="checkbox" data-id="<?= $c->employee_id; ?>" class="pending-card">
												</td> -->
												<td><?= $c->employee_id; ?></td>
												<td><?= ucwords($c->emp_name); ?></td>
												<td><?= $c->cnic; ?></td>
												<td><?= $c->project_name; ?></td>
												<td><?= date('d-m-Y', strtotime($c->date_of_joining)); ?></td>
												<td>
													<a href="<?= base_url(); ?>Employee_cards/print_cards/1/<?= $c->employee_id; ?>" class="label label-primary">Print</a>
													<a href="<?= base_url(); ?>Employee_cards/change_status/<?= $c->employee_id; ?>/1/1" class="label label-info">Mark Print</a>
												</td>
											</tr>
												<?php endif; ?>
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
								<h3>Ready to Deliver <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Employee_cards/view/2" class="btn">
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
												<!-- <th>
													<input type="checkbox" id="mark-all-delivered">
												</th> -->
												<th>ID</th>
												<th>Name</th>
												<th>CNIC</th>
												<th>Project</th>
												<th>Print Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($cards AS $c): ?>
												<?php if($c->card_status == 'printed'): ?>
												<tr>
													<!-- <td>
														<input type="checkbox" data-id="<?= $c->employee_id; ?>" class="delivered-card">
													</td> -->
													<td><?= $c->employee_id; ?></td>
													<td><?= ucwords($c->emp_name); ?></td>
													<td><?= $c->cnic; ?></td>
													<td><?= $c->project_name; ?></td>
													<td><?= date('d-m-Y', strtotime($c->print_date)); ?></td>
													<td>
														<a href="<?= base_url(); ?>Employee_cards/change_status/<?= $c->employee_id; ?>/2/1" class="label label-danger">deliver</a>

													</td>
												</tr>
												<?php endif; ?>
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
								<h3>Delivered <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Employee_cards/view/3" class="btn">
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
												<!-- <th>
													<input type="checkbox" id="mark-all-delivered">
												</th> -->
												<th>ID</th>
												<th>Name</th>
												<th>CNIC</th>
												<th>Project</th>
												<th>Deliver Date</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($cards AS $c): ?>
												<?php if($c->card_status == 'delivered'): ?>
												<tr>
													<!-- <td>
														<input type="checkbox" data-id="<?= $c->employee_id; ?>" class="delivered-card">
													</td> -->
													<td><?= $c->employee_id; ?></td>
													<td><?= ucwords($c->emp_name); ?></td>
													<td><?= $c->cnic; ?></td>
													<td><?= $c->project_name; ?></td>
													<td><?= date('d-m-Y', strtotime($c->deliver_date)); ?></td>
													<td>
														<a href="<?= base_url(); ?>Employee_cards/change_status/<?= $c->employee_id; ?>/3/1" class="label label-success">receive</a>

													</td>
												</tr>
												<?php endif; ?>
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
								<h3>Received <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">		
								<a href="<?= base_url(); ?>Employee_cards/view/4" class="btn">
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
												<!-- <th>
													<input type="checkbox" id="mark-all-delivered">
												</th> -->
												<th>ID</th>
												<th>Name</th>
												<th>CNIC</th>
												<th>Project</th>
												<th>Receive Date</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($cards AS $c): ?>
												<?php if($c->card_status == 'received'): ?>
												<tr>
													<!-- <td>
														<input type="checkbox" data-id="<?= $c->employee_id; ?>" class="delivered-card">
													</td> -->
													<td><?= $c->employee_id; ?></td>
													<td><?= ucwords($c->emp_name); ?></td>
													<td><?= $c->cnic; ?></td>
													<td><?= $c->project_name; ?></td>
													<td><?= date('d-m-Y', strtotime($c->receive_date)); ?></td>
												</tr>
												<?php endif; ?>
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