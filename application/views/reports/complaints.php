<section class="secMainWidthFilter">
	<!-- <section class="secFormLayout"> -->
		
		<div class="row marg">
			<div class="col-lg-2 no-leftPad">
				<div class="main-leftFilter">
					<div class="tabelHeading">
						<h3>Search Criteria <a href="javascript:void(0);" class="fa fa-refresh" onclick="$('#complaints-search-form')[0].reset();"></a></h3>
					</div>
					<form action="<?= base_url(); ?>Reports/complaints" method="GET" id="complaints-search-form">
						<div class="selectBoxMain">
							<div class="filterSelect">
								<input type="text" name="complaint_no" class="form-control" placeholder="Complaint No">
							</div>
							
							<div class="filterSelect">
								<input type="text" name="from_date" class="form-control date" placeholder="From Date">
							</div>
							<div class="filterSelect">
								<input type="text" name="to_date" class="form-control date" placeholder="To Date">
							</div>

							<div class="filterSelect">
								<select name="complaint_status" class="form-control">
									<option value="">Status</option>
									<option value="all">Show All</option>
									<option value="pending">Pending</option>
									<option value="process">Process</option>
									<option value="review">Review</option>
									<option value="resolved">Resolved</option>
								</select>
								<span></span>
							</div>
							<div class="filterSelect">
								<select name="designation" class="form-control province">
									<option value="">Province</option>
									<?php foreach($province AS $p): ?>
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
								<button type="submit" name="search" class="btn btnSubmit">Search</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-10">
				<div class="topNavFilter">
				
				</div>
				<div id="complaints-handler">
					<?= $complaints_table; ?>
				</div>
			</div>
		</div>
		
	<!-- </section> -->
</section>