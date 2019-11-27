<section class="secMainWidthFilter hide-from-print">
<div class="row marg">
	<div class="col-lg-2 no-leftPad">
		<div class="main-leftFilter">
			<div class="tabelHeading">
				<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#events-search-form')[0].reset();"></a></h3>
			</div>
			<form action="<?= base_url(); ?>Reports/events" method="GET" id="events-search-form" class="search-form">
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
						<select name="designation" class="form-control">
							<option value="">Designation</option>
							<?php foreach($designation AS $d): ?>
							<option value="<?= $d->designation_id; ?>"><?= $d->designation_name; ?></option>
							<?php endforeach; ?>
						</select>
						<span></span>
					</div>

					<div class="filterSelect">
						<select name="training_type" class="form-control">
							<option value="">Type</option>
							<?php foreach($training_type AS $t): ?>
							<option value="<?= $t->training_type_id; ?>"><?= ucwords($t->type); ?></option>
							<?php endforeach; ?>
						</select>
						<span></span>
					</div>

					<div class="filterSelect">
						<input type="text" name="from_date" class="form-control date" placeholder="From Date">
					</div>
					<div class="filterSelect">
						<input type="text" name="to_date" class="form-control date" placeholder="To Date">
					</div>
					
				
					<div class="filterSelect">
						<select name="province" class="form-control province">
							<option value="">Province</option>
							<?php foreach($provinces AS $p): ?>
								<option value="<?= $p->id; ?>"><?= $p->name; ?></option>
							<?php endforeach; ?>
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
							<a href="<?= base_url(); ?>Reports/eventsXLS?<?= $search_query; ?>" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
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
							<table class="table table-hover" id="events-table">
								<thead>
									<th>Event Title</th>
									<th>Type</th>
									<th>Project</th>
									<th>Designation</th>
									<th>Province</th>
									<th>District</th>
									<th>Start Date</th>
									<th>End Date</th>
								</thead>
						        <tbody>
						        	<?php $count = 1; ?>
						        	<?php foreach($events AS $e): ?>
									<tr data="<?= $e->event_id; ?>" style="cursor: pointer;">
										<td><?= ucwords($e->title); ?></td>
										<td><?= $e->training_type; ?></td>
										<td><?= ucwords($e->project_name); ?></td>
										<td><?= ucwords($e->designation_name); ?></td>
										<td><?= ucwords($e->province); ?></td>
										<td><?= ucwords($e->district); ?></td>
										<td><?= date('d-m-Y', strtotime($e->start_date)); ?></td>
										<td><?= date('d-m-Y', strtotime($e->end_date)); ?></td>

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
</section>





