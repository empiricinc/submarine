<section class="secMainWidthFilter">
	<!-- <section class="secFormLayout"> -->
		
		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#complaints-search-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Reports/complaints" method="GET" id="complaints-search-form" class="search-form">
						<div class="selectBoxMain">
							<div class="filterSelect">
								<input type="text" name="complaint_no" class="form-control" placeholder="Complaint No">
							</div>
							
							<div class="filterSelect">
								<input type="text" name="from_date" class="form-control date" placeholder="From Date">
							</div>
							<div class="filterSelect">
								<input type="text" name="to_date" class="form-control date" placeholder="To Date">
							</div>

							<!-- <div class="filterSelect">
								<select name="status" class="form-control" id="complaint-status">
									<option value="">Status</option>
									<option value="">Show All</option>
									<option value="pending">Pending</option>
									<option value="process">Process</option>
									<option value="review">Review</option>
									<option value="resolved">Resolved</option>
								</select>
								<span></span>
							</div> -->

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

							<div class="filterSelect">
								<select name="province" class="form-control province">
									<option value="">Province</option>
									<?php foreach($province AS $p): ?>
									<option value="<?= $p->id; ?>"><?= $p->name; ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>

							<!-- <div class="filterSelect hide">
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
							</div> -->

							<div class="filterSelectBtn">
								<button type="submit" name="search" id="search-btn" class="btn btnSubmit">Search</button>
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
										<h3><?= $title; ?><span></span></h3>
									</div>
									<div class="col-md-2">
										<div class="tabelTopBtn">
											<a href="<?= base_url(); ?>Reports/createComplaintsXLS?<?= $search_query; ?>" class="btn">
												<i class="fa fa-file-excel-o"></i> Export All
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
										<table class="table table-hover">
											<thead>
												<tr>
													<th>Complaint No</th>
													<th>Name</th>
													<th>Subject</th>
													<th>Contact No</th>
													<th>Email</th>
													<th>Province</th>
													<th>Date</th>
													<!-- <th>Status</th> -->
												</tr>
											</thead>
											<tbody id="complaints-tbody">
												<?php $count=1; foreach($complaints AS $c): 
													// $label = '';
													// if($c->status == "pending") 
													// 	$label = "label label-warning";
													// elseif($c->status == "resolved")
													// 	$label = "label label-primary";
													// elseif($c->status == "review")
													// 	$label = "label label-success";
													// elseif($c->status == "process")
													// 	$label = "label label-info";
												?>

													<tr data="<?= $c->id; ?>">
														<!-- <td><?= $count; ?></td> -->
														<td><?= $c->complaint_no; ?></td>
														<td><?= ucwords($c->name); ?></td>
														<td><?= $c->subject; ?></td>
														<td><?= $c->contact_no; ?></td>
														<td><?= $c->email; ?></td>
														<td><?= ucwords($c->province); ?></td>
														<td><?= date('d-m-Y', strtotime($c->created_at)); ?></td>
														<!-- <td>
															<label class="<?= $label; ?>"><?= $c->status; ?></label>
														</td> -->
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