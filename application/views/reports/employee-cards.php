<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad hide-from-print">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh clear-form" onclick="$('#employee-search-form')[0].reset();"></a></h3>
				</div>
				<form action="<?= base_url(); ?>Reports/employee_cards" method="GET" id="employee-search-form" class="search-form">
					<div class="selectBoxMain">
						<div class="filterSelect">
							<input type="text" name="employee_id" class="form-control" placeholder="Employee ID">
						</div>
						<div class="filterSelect">
							<input type="text" name="employee_name" class="form-control" placeholder="Employee Name">
						</div>
						<div class="filterSelect">
							<select name="designation" class="form-control">
								<option value="">Designation</option>
								<?php foreach($designations AS $d): ?>
								<option value="<?= $d->designation_id; ?>"><?= $d->designation_name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
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
							<select name="location" class="form-control">
								<option value="">Location</option>
								<?php foreach($locations AS $l): ?>
								<option value="<?= $l->location_id; ?>"><?= $l->location_name; ?></option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<select name="employee_type" class="form-control">
								<option value="current">Employee Type</option>
								<option value="current">Current</option>
								<option value="resigned">Resigned</option>
								<option value="terminated">Terminated</option>
							</select>
							<span></span>
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
			<div class="mainTableWhite no-border-print">
				<div class="row  hide-from-print">
					<div class="col-md-12">
						<div class="tabelHeading">
							<div class="col-md-10">
								<h3><?= $title; ?> <span></span></h3>
							</div>
							<!-- <div class="col-md-3 text-right" style="padding-right: 0px;">
								<div class="tabelTopBtn">
								<a href="<?= base_url(); ?>Reports/employee_cards_pdf" target="_blank" class="btn"><i class="fa fa-file"></i> PDF</a>
								</div>
							</div> -->
							<div class="col-md-2 text-right" style="padding-left: 0px;">
								<div class="tabelTopBtn">
								<a href="javascript:void(0);" class="btn" onclick="window.print()";><i class="fa fa-print"></i> Print</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<table class="table" style="width:872px;height:100%; margin-bottom: 0px;">
								<tbody>
	
						<?php foreach($employees AS $e): ?>
						<tr>
							<td id="tdColumn1" style="width:50%;vertical-align: top; padding: 20px;" class="no-padding-print no-border">
									<div class="card-container" id="dvColumn_1_9595">
										<img src="<?= base_url(); ?>assets/img/card-front.png" style="width: 380px;height: 240px;">

									<div class="card-emp-picture">
										<img src="<?= base_url(); ?>assets/img/no-photo.png" style="position: relative;width: 73px;height: 86px;left: 5px;bottom: 15px;">
									</div>
									<div class="card-emp-name"><?= ucwords($e->emp_name); ?></div>
									<div class="card-province-logo"><img src="<?= base_url(); ?>assets/img/FATA_logo.png" style="position: relative; width: 57px;height: 67px;"></div>
				                    <div class="card-district-heading">District :</div>
				                    <div class="card-tehsil-uc-area-heading">UC/Area :</div>
									<div class="card-district">KP-TD</div>
									<div class="card-uc"></div>
									<div class="card-job-type"><?= ucwords($e->designation_name); ?></div>
									<div class="card-emp-id">1280010011978</div>
									<div class="card-sign-authority">( Regional Manager )</div>
									<div class="card-authority-signature">
										<img src="<?= base_url(); ?>assets/img/fatasign.png" style="position: relative; width: 60px;height: 43px; right: 80px;">
									</div>
								</div>
							</td>
							<td id="tdColumn2" style="width:50%;vertical-align: top; padding: 20px;" class=" no-border">
								<div class="card-container" id="dvColumn_2_9595">
									<img src="<?= base_url(); ?>assets/img/card-rear.png" style="width: 380px;height: 240px;">
									<div class="card-cnic"><?= $e->cnic; ?></div>
									<div class="card-other-id-name"></div>
									<div class="card-date-of-birth">
										<?= date('d-m-Y', strtotime($e->date_of_birth)); ?>
									</div>
									<div class="card-emergency"><?= $e->personal_contact; ?></div>
									<div class="card-issue-date">Jan,2019</div>
				                    <div class="temporary-card-issue-date"></div>
				                    <div class="card-expiry-date"></div>
									<div class="card-lost-location">Any District Polio control room of KP-TD</div>
								</div>
							</td>
						</tr>
							
						<?php endforeach; ?>
							</tbody>
						</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>