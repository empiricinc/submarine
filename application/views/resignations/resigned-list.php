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
								<a href="http://localhost/submarine/Reports/resignationsXLS" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
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
								<table class="table table-hover resignation-table">
									<thead>
										<th>#</th>
										<th>Employee</th>
										<th>Resignation Reason</th>
										<th>Designation</th>
										<th>Project</th>
										<th>Resignation Date</th>
									</thead>
							        <tbody>
							        	<?php $count = 1; ?>
							        	<?php foreach($r_employees AS $r): ?>
										<tr data="<?= $r->resignation_id; ?>" style="cursor: pointer;">
											<td><?= $count; ?></td>
											<td><?= ucfirst($r->first_name.' '.$r->last_name); ?></td>
											<td><?= $r->reason_text; ?></td>
											<td><?= $r->designation_name; ?></td>
											<td><?= $r->name; ?></td>
											<td><?= $r->resignation_date; ?></td>
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