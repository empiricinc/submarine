<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-12">
						<div class="tabelHeading">
							<div class="col-md-10">
								<h3>Employee's List <span></span></h3>
							</div>
							<div class="col-md-2 text-right">
								<div class="tabelTopBtn">
								<a href="<?= base_url(); ?>Reports/createEmployeeXLS?<?= $query_string; ?>" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
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
											<!-- <th>#</th> -->
											<th>Name</th>
											<th>Contact</th>
											<!-- <th>Email</th> -->
											<th>Project</th>
											<th>Department</th>
											<th>Designation</th>
											<th>Date of birth</th>
											<!-- <th>Gender</th>	 -->
										</tr>
									</thead>
									<tbody>
										<?php $count=1; foreach($employees AS $e): ?>
										<tr data="<?= $e->employee_id; ?>">
											<!-- <td><?= $count; ?></td> -->
											<td><?= ucwords($e->emp_name); ?></td>
											<td><?= $e->contact_number; ?></td>
											<!-- <td><?= $e->email; ?></td> -->
											<td><?= $e->company_name; ?></td>
											<td><?= $e->department_name; ?></td>
											<td><?= $e->designation_name; ?></td>
											<td><?= date('d-m-Y', strtotime($e->date_of_birth)); ?></td>
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