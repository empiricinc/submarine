<section class="secMainWidthFilter">
	<div class="row marg">

		<div class="col-lg-12">
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
						<?php if(!empty($employees[0])): ?>
					
						<?php foreach($employees AS $e): ?>
						<?php 

							$job_title = explode('—', $e->job_title);
						
							$province = (isset($job_title[2])) ? $job_title[2] : '';
							$district = (isset($job_title[3])) ? $job_title[3] : '';
							$uc = (isset($job_title[5])) ? $job_title[5] : '';
							$area_code = (isset($job_title[7])) ? strstr($job_title[7], '(') : '';
							
						 ?>
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
									<div class="card-district"><?= strtoupper($district); ?></div>
									<div class="card-uc"><?= strtoupper($uc). '—' . $area_code; ?></div>
									<div class="card-job-type"><?= ucwords($e->designation_name); ?></div>
									<div class="card-emp-id"></div>
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
									<div class="card-emergency"><?= $e->contact_number; ?></div>
									<div class="card-issue-date"><?= ($e->receive_date) ? date('d-m-Y', strtotime($e->receive_date)) : ''; ?></div>
				                    <div class="temporary-card-issue-date"></div>
				                    <div class="card-expiry-date"></div>
									<div class="card-lost-location">Any District Polio control room of KP-TD</div>
								</div>
							</td>
						</tr>
							
						<?php endforeach; ?>
					<?php endif; ?>
							</tbody>
						</table>
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>