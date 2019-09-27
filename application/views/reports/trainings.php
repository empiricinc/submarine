<section class="secMainWidthFilter hide-from-print">
<div class="row marg">
	<div class="col-lg-2 no-leftPad">
		<div class="main-leftFilter">
			<div class="tabelHeading">
				<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#trainings-search-form')[0].reset();"></a></h3>
			</div>
			<form action="<?= base_url(); ?>Reports/trainings" method="GET" id="trainings-search-form">
				<div class="selectBoxMain">
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
						<input type="text" name="facilitator" class="form-control" placeholder="Facilitator Name">
					</div>
					<div class="filterSelect">
						<input type="text" name="from_date" class="form-control date" placeholder="From Date">
					</div>
					<div class="filterSelect">
						<input type="text" name="to_date" class="form-control date" placeholder="To Date">
					</div>
					
					<div class="filterSelect">
						<select name="training_type" class="form-control">
							<option value="">Training Type</option>
							<?php foreach($training_type AS $tt): ?>
							<option value="<?= $tt->training_type_id; ?>"><?= $tt->type; ?></option>
							<?php endforeach; ?>
						</select>
						<span></span>
					</div>

					<!-- <div class="filterSelect">
						<select name="training_format" class="form-control">
							<option value="">Training Format</option>
							<option value="1">Induction</option>
							<option value="2">Refresher</option>

						</select>
						<span></span>
					</div> -->
				
					<div class="filterSelect">
						<select name="province" class="form-control province">
							<option value="">Province</option>
							<?php foreach($provinces AS $p): ?>
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
					

					<div class="filterSelectBtn">
						<button type="submit" name="search" class="btn btnSubmit" id="search">Search</button>
					</div>
				</div>
			</form>
		</div>
	</div>
			
	<div class="col-lg-10">
		<div class="topNavFilter">
				
		</div>
	
		<div class="mainTableWhite">
			<div class="row">
				<div class="col-md-12">
					<div class="tabelHeading">
						<div class="col-md-10">
							<h3><?= $title; ?> <span></span></h3>
						</div>
						<div class="col-md-2 text-right">
							<div class="tabelTopBtn">
							<a href="<?= base_url(); ?>Reports/trainingsXLS" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
							</div>
						</div>
					</div>
				</div>
				
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="tableMain">
						<div class="table-responsive">
							<!-- Table -->
							<table class="table" id="trainings-table">
								<thead>
									<th>Project</th>
									<th>Training Type</th>
									<th>Target Group</th>
									<th>Province</th>
									<th>Facilitator</th>
									<th>Session</th>
									<th>Participants</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Reports</th>
								</thead>
						        <tbody>
						        	<?php $count = 1; ?>
						        	<?php foreach($training AS $t): ?>
						        	<?php 
										// $label = '';
										// $format = '';
										// if($t->status == "1") 
										// {
										// 	$label = "label label-success";
										// 	$format = "induction";
										// }
										// elseif($t->status == "2" || $t->status == "3")
										// {
										// 	$label = "label label-primary";
										// 	$format = "refresher";
										// }


									?>

									<tr data="<?= $t->trg_id; ?>" style="cursor: default;">
										<td><?= ucwords($t->company); ?></td>
										<td><?= $t->training_type; ?></td>
										<td><?= $t->target_group; ?></td>
										<td><?= strtoupper($t->province_name); ?></td>
										<td><?= $t->facilitator_name; ?></td>
										<td><?= $t->session; ?></td>
										<td>
											<?php $no_of_trainees = explode(',', $t->trainee_employees); ?>
											<?= count($no_of_trainees); ?>
										</td>
										<td><?= date('d-m-Y', strtotime($t->start_date)); ?></td>
										<td><?= date('d-m-Y', strtotime($t->end_date)); ?></td>

										<td id="training-reports">
											<a href="<?= base_url(); ?>Reports/training_detail/<?= $t->trg_id; ?>" class="label label-primary detail">Detail</a>
											<a href="<?= base_url(); ?>Reports/training_attendees/<?= $t->trg_id; ?>" class="label label-danger attendance">Attendance</a>
											<a href="<?= base_url(); ?>Reports/training_expenses/<?= $t->trg_id; ?>" class="label label-success expense">Expense</a>
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
				<div class="col-md-4 col-md-offset-4">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</div>

</div>
</section>





