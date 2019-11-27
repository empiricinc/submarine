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
									<?php foreach($province AS $p): ?>
									<option value="<?= $p->id; ?>"><?= $p->name; ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>


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
												<?php $count=1; foreach($complaints AS $c): ?>

													<tr data="<?= $c->id; ?>">
														<td><?= $c->complaint_no; ?></td>
														<td><?= ucwords($c->name); ?></td>
														<td><?= $c->subject; ?></td>
														<td><?= $c->contact_no; ?></td>
														<td><?= $c->email; ?></td>
														<td><?= ucwords($c->province); ?></td>
														<td><?= date('d-m-Y', strtotime($c->created_at)); ?></td>
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
		
	<!-- </section> -->
</section>