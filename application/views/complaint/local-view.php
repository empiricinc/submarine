<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#complaints-search-form')[0].reset();"></a></h3>
				</div>
				<form action="<?= base_url(); ?>Complaint/local_view" method="GET" id="complaints-search-form">
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
							<select name="province" class="form-control province">
								<option value="">Province</option>
								<?php foreach($province AS $p): ?>
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
						</div> -->

						<div class="filterSelectBtn">
							<button type="submit" name="search" class="btn btnSubmit">Search</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="mainTableWhite" style="margin-top: 0px">
			<div class="col-lg-10" style="padding-top: 22px;">
				<!-- data -->
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-12">
							<div class="tabelHeading">
								<div class="col-md-10">
									<h3><?= $title; ?><span></span></h3>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="tableMain">
								<div class="table-responsive">
									<table class="table table-hover" id="local-table">
										<thead>
											<tr>
												<!-- <th>#</th> -->
												<th>Complaint No</th>
												<th>Subject</th>
												<th>Name</th>
												<th>Contact No</th>
												<th>Province</th>
												<th>Assigned Date</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody id="local-tbody">
											<?php $count=1; $previous_ids=array(); foreach($complaints as $c): ?>
											<?php if(in_array($c->complaint_id, $previous_ids)) continue; ?>
												<tr data-id="<?= $c->complaint_id; ?>">
													<!-- <td><?= $count; ?></td> -->
													<td><?= $c->complaint_no; ?></td>
													<td><?= $c->subject; ?></td>
													<td><?= ucwords($c->name); ?></td>
													<td><?= $c->contact_no; ?></td>
													<td><?= ucwords($c->province); ?></td>
													<td><?= date('d-m-Y', strtotime($c->r_date)); ?></td>
													<td>
														<?php 
															$label = '';
															if($c->status == 'pending') 
																$label = 'label label-warning';
															elseif($c->status == 'resolved')
																$label = 'label label-primary';
															elseif($c->status == 'review')
																$label = 'label label-success';
															elseif($c->status == 'process')
																$label = 'label label-info';
														?>

														<label class="<?= $label; ?>"><?= $c->status; ?></label>
													</td>
													
												</tr>
											<?php array_push($previous_ids, $c->complaint_id); ?>
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
				<!-- ./data -->
			</div>
		</div>
	</div>
</section>

