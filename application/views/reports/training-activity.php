<section class="secMainWidthFilter hide-from-print">
<div class="row marg">
	<div class="col-lg-2 no-leftPad">
		<div class="main-leftFilter">
			<div class="tabelHeading">
				<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#activity-search-form')[0].reset();"></a></h3>
			</div>
			<form action="<?= base_url(); ?>Reports/activity" method="GET" id="activity-search-form">
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
						<div class="col-md-8">
							<h3><?= $title; ?> <span></span></h3>
						</div>
						<div class="col-md-4 text-right">
							<div class="tabelTopBtn">
								<a href="<?= base_url(); ?>Reports/training_activity_pdf" target="_blank" class="btn"><i class="fa fa-file"></i> PDF</a>
								<a href="<?= base_url(); ?>Reports/activityXLS" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
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
							<table class="table" id="activity-table">
								<thead>
									<th>District</th>
									<th>Town/UC</th>
									<th>Cadre/Designation</th>
									<th>Training Type</th>
									<th>Plan (No. of participants)</th>
									<th colspan="3">Accomplishment (No. of Participants)</th>
									<th>Training Date</th>
									<th>Remarks</th>
									<tr>
						        		<th colspan="5" style="padding: 2px 10px;"></th>	
						        		<th style="padding: 2px 10px;">Male</th>
						        		<th style="padding: 2px 10px;">Female</th>
						        		<th style="padding: 2px 10px;">Total</th>
						        		<th colspan="2" style="padding: 2px 10px;"></th>
						        	</tr>
								</thead>
						        <tbody>		        	
						        	
									<?php for($index=0; $index<count($training); $index++): ?>
						        	<tr>
						        		<td><?= ucwords($training[$index]['detail']['district']); ?></td>
						        		<td></td>
						        		<td>
						        		<?php 
						        			$designations = '';
						        			for($i=0; $i<count($training[$index]['designations']); $i++) {
												$designations .= '<label class="label label-primary">'.$training[$index]['designations'][$i] . '</label> '; 
											 	
						        			}
						        			echo rtrim($designations, ', ');

						        			$total_participants = $training[$index]['male_participants'] + $training[$index]['female_participants'];
						        			 ?>
						        		</td>
						        		<td><?= $training[$index]['detail']['training_type']; ?></td>
						        		<td><?= $training[$index]['detail']['plan_no_of_participants']; ?></td>
						        		<td><?= $training[$index]['male_participants']; ?></td>
						        		<td><?= $training[$index]['female_participants']; ?></td>
						        		<td><?= $total_participants; ?></td>
						        		<td><?= date('d-m-Y', strtotime($training[$index]['detail']['start_date'])); ?></td>
						        		<td></td>
		
						        	</tr>
						        	<?php endfor; ?>
						        </tbody>
						    </table>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<?php  echo $this->pagination->create_links(); ?>
				</div>
			</div>
		</div>
	</div>

</div>
</section>





