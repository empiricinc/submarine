<section class="secMainWidthFilter">

		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#calendar-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Reports/generate_calendar" method="GET" id="calendar-form">
						<div class="selectBoxMain">

							<div class="filterSelect">
								<select name="project" class="form-control" required>
									<option value="">Project</option>
									<?php foreach($projects AS $p): ?>
									<option value="<?= $p->company_id; ?>"><?= $p->name; ?></option>
									<?php endforeach; ?>
								</select>
								<span></span>
							</div>
							<div class="filterSelect">
								<select name="months" class="form-control" required>
									<option value="">Months</option>
									<option value="jan_jun">January-June</option>
									<option value="jul_dec">July-December</option>
								</select>
								<span></span>
							</div>
									
							<div class="filterSelect">
								<input type="text" name="year" class="form-control year" placeholder="Year" required>
							</div>

							<div class="filterSelectBtn">
								<button type="submit" name="generate" class="btn btnSubmit">Generate</button>
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
								<div class="col-md-10" style="height: 40px;">
									<h3><?= $title; ?> <span></span></h3>
								</div>
							</div>
						</div>	
					</div>
					<div class="row">
						<div class="col-md-12" style="padding-left: 40px; padding-right: 40px;">
							<div class="alert alert-info">
								<strong>Info!</strong> To generate an event calendar fill all the fields on left sidebar, then click on generate button.
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

</section>