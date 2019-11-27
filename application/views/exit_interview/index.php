<section class="secMainWidthFilter">

	<div class="row marg">
		<div class="col-lg-12">
			<div class="topNavFilter">
			
			</div>
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-12">
						<div class="tabelHeading">
							<div class="col-md-10">
								<h3><?= $title; ?> <span></span></h3>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<!-- Table -->
								<table class="table table-hover" id="exit-interviews-table">
									<thead>
										<th>ID</th>
										<th>Employee Name</th>
										<th>Project</th>
										<th>Province</th>
										<th>Department</th>
										<th>Designation</th>
										<th>Contact No</th>
										<th>Resignation Date</th>
									</thead>
								    <tbody>
								    	<?php foreach($exit_interview AS $ei): ?>
								    	<tr data-id="<?= $ei->resignation_id; ?>">
											<td><?= $ei->employee_id; ?></td>
											<td><?= ucwords($ei->employee_name); ?></td>
											<td><?= $ei->project_name; ?></td>
											<td><?= $ei->province_name; ?></td>
											<td><?= $ei->department_name; ?></td>
											<td><?= $ei->designation_name; ?></td>
											<td><?= $ei->contact_number; ?></td>
											<td><?= date('d-m-Y', strtotime($ei->resignation_date)); ?></td>
										</tr>
								    	<?php endforeach; ?>
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

</section>