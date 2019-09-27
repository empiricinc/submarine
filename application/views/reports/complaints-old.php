<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">

			<div class="row">
				<div class="col-lg-10">
					<div class="tabelHeading">
						<h3><?= $title; ?></h3>
					</div>
				</div>
				<div class="col-md-2 text-right">
					<div class="tabelTopBtn">
					<a href="<?= base_url(); ?>Reports/createEmployeeXLS" target="_blank" class="btn"><i class="fa fa-file-excel-o"></i> Export Data</a>
					</div>
				</div>
			</div>
			<div class="solidLine"></div>
			<div class="row">
				<center>
				<div class="col-lg-12">
					<div class="" id="status-btn">
						<button type="button" data-status="pending" class="btn mlr-5 small-btn btn-warning">pending</button>
						<button type="button" data-status="process" class="btn mlr-5 small-btn btn-info">process</button>
						<button type="button" data-status="review" class="btn mlr-5 small-btn btn-success">review</button>
						<button type="button" data-status="resolved" class="btn mlr-5 small-btn btn-primary">resolved</button>
						<button type="button" data-status="all" class="btn mlr-5 small-btn btn-danger">show all</button>
					</div>
				</div>
				</center>
				<div class="col-lg-12 table-responsive">
					<table class="table table-bordered table-hover dataTable" id="complaints-table">
						<thead>
							<tr>
								<th>ID</th>
								<th>#</th>
								<th>Complaint No</th>
								<th>Subject</th>
								<th>Contact No</th>
								<th>Email</th>
								<th>Province</th>
								<th>Date</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
					
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</section>