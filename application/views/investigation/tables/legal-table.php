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
									<td><?= $c->name; ?></td>
									<td><?= $c->contact_no; ?></td>
									<td><?= $c->province; ?></td>
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
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>

</div>