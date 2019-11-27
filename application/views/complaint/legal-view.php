<section class="secMainWidthFilter">
	<!-- <section class="secFormLayout"> -->

		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#complaints-search-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Complaint/legal_view" method="GET" id="complaints-search-form">
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

							<div class="filterSelect">
								<select name="status" id="complaint-status" class="form-control">
									<option value="">Status</option>
									<option value="">Show All</option>
									<option value="pending">Pending</option>
									<option value="process">Process</option>
									<option value="review">Review</option>
								</select>
								<span></span>
							</div>

							<div class="filterSelectBtn">
								<button type="submit" name="search" id="complaint-search-btn" class="btn btnSubmit">Search</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="mainTableWhite" style="margin-top: 0px">
				<div class="col-lg-10">
					<div id="complaints-handler" style="padding-top: 22px;">
						<div class="mainTableWhite">
							<div class="row">
								<div class="col-md-12">
									<div class="tabelHeading">
										<div class="col-md-10">
											<h3><?= $title; ?><span></span>
												<br>
												<small class="" id="status-btn">
													<a href="javascript:void(0);" data-status="pending" class="label label-warning">pending</a>
													<a href="javascript:void(0);" data-status="process" class="label label-info">process</a>
													<a href="javascript:void(0);" data-status="review" class="label label-success">review</a>
													<a href="javascript:void(0);" data-status="all" class="label label-danger">show all</a>
												</small>
											</h3>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="tableMain">
										<div class="table-responsive">
											<table class="table table-hover" id="complaints-legal">
												<thead>
													<tr>
														<th>Complaint No</th>
														<th>Subject</th>
														<th>Name</th>
														<th>Contact No</th>
														<th>Province</th>
														<th>Assigned Date</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody id="legal-tbody">
													<?php $count=1; foreach($complaints AS $c): 
														$label = '';
														if($c->status == "pending") 
															$label = "label label-warning";
														elseif($c->status == "resolved")
															$label = "label label-primary";
														elseif($c->status == "review")
															$label = "label label-success";
														elseif($c->status == "process")
															$label = "label label-info";
													?>

														<tr data="<?= $c->complaint_id; ?>">
															<td><?= $c->complaint_no; ?></td>
															<td><?= $c->subject; ?></td>
															<td><?= ucwords($c->name); ?></td>
															<td><?= $c->contact_no; ?></td>
															<td><?= ucwords($c->province); ?></td>
															<td><?= date('d-m-Y', strtotime($c->r_date)); ?></td>
															<td>
																<label class="<?= $label; ?>"><?= $c->status; ?></label>
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
			</div>
			
		</div>
		
	<!-- </section> -->
</section>