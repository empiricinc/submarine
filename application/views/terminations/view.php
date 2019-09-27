<section class="secMainWidthFilter">
		<div class="topNavFilter">
				
		</div>
		<div class="row marg">
			<div class="col-lg-12">
				<div class="mainTableWhite">
					<div class="row">
						<div class="col-md-12">
							<div class="tabelHeading">
								<div class="col-md-10">
									<h3><?= $title; ?> <span></span></h3>
								</div>
								<!-- <div class="col-md-2 text-right">
									<div class="tabelTopBtn">
									<a href="<?= base_url(); ?>Reports/terminationsXLS" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
									</div>
								</div> -->
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="tableMain">
								<div class="table-responsive">
									<!-- Table -->
									<table class="table table-hover termination-table">
										<thead>
											<th>#</th>
											<th>Employee</th>
											<th>Designation</th>
											<th>Project</th>
											<th>Termination Reason</th>
											<th>Terminated By</th>
											<th>Notice Date</th>
										</thead>
								        <tbody>
								        	<?php $count = 1; ?>
								        	<?php foreach($terminated AS $t): ?>
											<tr data="<?= $t->id; ?>" style="cursor: pointer;">
												<td><?= $count; ?></td>
												<td><?= $t->employee_name; ?></td>
												<td><?= $t->designation_name; ?></td>
												<td><?= $t->employee_name; ?></td>
												<td><?= $t->reason_text; ?></td>
												<td><?= $t->terminator; ?></td>
												<td><?= $t->notice_date; ?></td>
											</tr>
											<?php $count++; endforeach; ?>
								        </tbody>
								    </table>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

</section>