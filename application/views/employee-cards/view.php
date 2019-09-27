<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad hide-from-print">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#employee-search-form')[0].reset();"></a></h3>
				</div>
				<form action="<?= base_url(); ?>Employee_cards/view" method="GET" id="employee-search-form">
					<div class="selectBoxMain">
						<?php switch ($card_status) {
							case 'pending':
								$status = 1;
								break;
							case 'printed':
								$status = 2;
								break;
							case 'delivered':
								$status = 3;
								break;
							default:
								$status = 4;
								break;

						} ?>
						<input type="hidden" name="card_status" value="<?= $status; ?>">
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
							<select name="location" class="form-control">
								<option value="">Location</option>
								<?php foreach($locations AS $l): ?>
								<option value="<?= $l->location_id; ?>"><?= $l->location_name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<!-- <div class="filterSelect">
							<select name="employee_type" class="form-control">
								<option value="all">Card status</option>
								<option value="pending">Pending</option>
								<option value="deliver">Deliver</option>
								<option value="received">Received</option>
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
								<h3>Employee Cards<span></span></h3>
							</div>
							<div class="col-md-6 text-right">
								<div class="tabelTopBtn">
									<?php if($card_status == 'printed'): ?>
										<a href="javascript:void(0);" data-url="<?= base_url(); ?>Employee_cards/change_status" data-status="<?= $card_status; ?>" class="btn change-status">
											<i class="fa fa-truck"></i> Deliver
										</a>
									<?php endif; ?>
									<?php if($card_status == 'pending'): ?>
										<a href="javascript:void(0);" data-url="<?= base_url(); ?>Employee_cards/change_status" data-status="<?= $card_status; ?>" class="btn change-status">
											<i class="fa fa-check"></i> Mark As Printed
										</a>

										<a href="javascript:void(0);" data-url="<?= base_url(); ?>Employee_cards/print_cards/<?= $this->uri->segment(3); ?>" class="btn print-cards">
											<i class="fa fa-print"></i> Print View
										</a>
									<?php endif; ?>
									<?php if($card_status == 'delivered'): ?>
										<a href="javascript:void(0);" data-url="<?= base_url(); ?>Employee_cards/change_status" data-status="<?= $card_status; ?>" class="btn change-status">
											<i class="fa fa-arrow-down"></i> Mark As Received
										</a>
									<?php endif; ?>
									
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
											<th>
												<input type="checkbox" id="mark-all">
											</th>
											<th>Name</th>
											<th>Contact</th>
											<th>Project</th>
											<th>Designation</th>
											<th>Date of joining</th>
											<?php if($card_status == 'printed'): ?>
											<th>Print Date</th>
												<?php elseif($card_status == 'delivered'): ?>
													<th>Delivered Date</th>
												<?php elseif($card_status == 'received'): ?>
													<th>Received Date</th>
											<?php endif; ?>
											<?php if($card_status == 'pending' OR $card_status == 'printed' OR $card_status == 'delivered'): ?>
											<th>Action</th>
											<?php endif; ?>
										</tr>
									</thead>
									<tbody>
										<?php $count=0; foreach($employees AS $e): ?>
										<tr>
											<td>
												<input type="checkbox" data-id="<?= $e->employee_id; ?>" data-index="<?= $count; ?>" class="employee">
											</td>
											<td><?= ucwords($e->emp_name); ?></td>
											<td><?= $e->contact_no; ?></td>
											<td><?= $e->project_name; ?></td>
											<td><?= $e->designation_name; ?></td>
											<td><?= date('d-m-Y', strtotime($e->date_of_joining)); ?></td>
											<?php if($card_status == 'printed'): ?>
											<td><?= date('d-m-Y', strtotime($e->print_date)); ?></td>
												<?php elseif($card_status == 'delivered'): ?>
													<td><?= date('d-m-Y', strtotime($e->deliver_date)); ?></td>
												<?php elseif($card_status == 'received'): ?>
													<td><?= date('d-m-Y', strtotime($e->receive_date)); ?></td>
											<?php endif; ?>

											<?php if($card_status == 'pending'): ?>
											<td>
												<a href="<?= base_url(); ?>Employee_cards/print_cards/1/<?= $e->employee_id; ?>" class="label label-primary">Print</a>
											</td>
									
											<?php elseif($card_status == 'printed'): ?>
											<td>
												<a href="<?= base_url(); ?>Employee_cards/change_status/<?= $e->employee_id; ?>/2" class="label label-danger">deliver</a>
											</td>

											<?php elseif($card_status == 'delivered'): ?>
											<td>
												<a href="<?= base_url(); ?>Employee_cards/change_status/<?= $e->employee_id; ?>/3" class="label label-success">receive</a>
											</td>
											<?php endif; ?>
										</tr>
										<?php $count++; endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						
					</div>
					<div class="col-md-4">
						<?php echo $this->pagination->create_links(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>