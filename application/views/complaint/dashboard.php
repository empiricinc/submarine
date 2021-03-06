<section class="secMainWidth">
	<section class="secIndex">
		<div class="row">
			<div class="col-md-12">
				<div class="headingMain">
					<h1>
						<?= $title; ?>
						<!-- <span>statics and more</span> -->
					</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="secIndexTable margint-top-0">
		<div class="row">
			<div class="col-md-12">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-7">
							<div class="tabelHeading">
								<h3>List of Complaints <span></span></h3>
							</div>
						</div>
						<div class="col-md-5">
							<div class="tabelTopBtn" style="padding-top: 12px !important;">
								<a href="<?= base_url(); ?>Reports/createComplaintsXLS" class="btn">
									<i class="fa fa-file-excel-o"></i> Export All
								</a>
								<a href="<?= base_url(); ?>Investigation/view" class="btn">
									<i class="fa fa-eye"></i> View All
								</a>
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
												<th>Subject</th>
												<th>Name</th>
												<th>Contact No</th>
												<th>Province</th>
												<th>Date</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody id="complaints-tbody">
											<?php //var_dump($complaints); exit; ?>
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

												<tr data="<?= $c->id; ?>">
													<td><?= $c->complaint_no; ?></td>
													<td><?= $c->subject; ?></td>
													<td><?= ucwords($c->name); ?></td>
													<td><?= $c->contact_no; ?></td>
													<td><?= ucwords($c->province); ?></td>
													<td><?= date('d-m-Y', strtotime($c->created_at)); ?></td>
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

				</div>
			</div>
		</div>
		
	</section>
</section>