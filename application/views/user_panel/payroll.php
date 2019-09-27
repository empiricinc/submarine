<section class="secMainWidth remove-padding-print">
<section class="secFormLayout">
	<div class="mainInputBg remove-padding-print remove-margin-print no-border-print">
		<div class="salary-slip-header hide-print">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3><?= $title; ?></h3>
					</div>
				</div>	
			</div>

			<div class="row">
				<div class="">
					<div class="col-md-3">
						<div class="inputFormMain">
							<select name="salary_date" id="salary-date" class="form-control select2" required="required">
								<option value="">SELECT SALARY DATE</option>
							</select>
						</div>
					</div>
					<div class="col-md-1">
						<div class="submitBtn">
							<button type="button" class="btn btnSubmit print-payslip"><i class="fa fa-print"></i> Print</button>
						</div>
						
					</div>
				</div>
			</div>

			<div class="solidLine"></div>
		</div>
		

		<div class="row">
			<div class="col-lg-12">
				<!-- Salary slip row -->
				<div id="salary-slip">
					<div class="salaryslip-header">
						<div class="row">
							<div class="col-md-12">
								<center><img src="<?= base_url(); ?>uploads/logo/chip.png" height="50px" alt="CHIP Logo"></center>
							</div>
							<div class="col-md-12">
								<center><h4>CHIP Training & Consulting Pvt Ltd.<h4></center>
							</div>
							<div class="col-md-12">
								<hr>
							</div>	
						</div>
					</div>
					
					<div class="salary-slip-body">
						<div class="row">
							<div class="col-md-12 no-padding-print">
								<div class="col-md-2 col-print-3"><label>Salary slip #</label></div>
								<div class="col-md-4 col-print-3">1</div>

								<div class="col-md-2 col-print-3"><label>Employee ID</label></div>
								<div class="col-md-4 col-print-3">G34T7</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12 no-padding-print">
								<div class="col-md-2 col-print-3"><label>Name</label></div>
								<div class="col-md-4 col-print-3">Nawaz Sharif</div>

								<div class="col-md-2 col-print-3"><label>CNIC</label></div>
								<div class="col-md-4 col-print-3">548968299582</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12 no-padding-print">
								<div class="col-md-2 col-print-3"><label>Project</label></div>
								<div class="col-md-4 col-print-3">CBV</div>

								<div class="col-md-2 col-print-3"><label>Designation</label></div>
								<div class="col-md-4 col-print-3">VP</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12 no-padding-print">
								<div class="col-md-2 col-print-3"><label>Salary Date</label></div>
								<div class="col-md-4 col-print-3">Mar-2019</div>

								<div class="col-md-2 col-print-3"><label>Total Days</label></div>
								<div class="col-md-4 col-print-3">30</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12 no-padding-print">
								<div class="col-md-2 col-print-3"><label>Absent Days</label></div>
								<div class="col-md-4 col-print-3">1</div>

								<div class="col-md-2 col-print-3"><label>Paid Days</label></div>
								<div class="col-md-4 col-print-3">29</div>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-12 col-print-12 no-padding-print">
								<div class="col-md-2 col-print-3"><label>Salary Per Day</label></div>
								<div class="col-md-4 col-print-3">30,000</div>

								<div class="col-md-2 col-print-3"><label></label></div>
								<div class="col-md-4 col-print-3"></div>
							</div>
						</div> -->
						<div class="row">
							<div class="col-md-12 col-print-12 no-padding-print">
								<div class="col-md-2 col-print-3"><label>Gross Salary</label></div>
								<div class="col-md-4 col-print-3">900,000</div>

								<div class="col-md-2 col-print-3"><label>Paid Salary</label></div>
								<div class="col-md-4 col-print-3">900,0000</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12 no-padding-print">
								<div class="col-md-2 col-print-3"><label>Paid Date</label></div>
								<div class="col-md-4 col-print-3">4-5-2019</div>

								<div class="col-md-2 col-print-3"><label>Description</label></div>
								<div class="col-md-4 col-print-3">None</div>
							</div>
						</div>
					</div>

					<div class="salary-slip-footer">
						<div class="col-md-12 col-print-12 no-padding">
							<div class="col-md-5 col-print-5 no-padding-print">
								<table class="table table-bordered">
									<thead>
										<th colspan='2' class="bb-0">Earning</th>
									</thead>
									<tbody>
										<tr>
											<td width="60%">Basic Salary</td>
											<td>10000</td>
										</tr>
										<tr>
											<td>Medical Allowance</td>
											<td>30000</td>
										</tr>
										<tr>
											<td>Stationary Allowance</td>
											<td>25000</td>
										</tr>
										<tr>
											<td>Vehicle Fuel Allowance</td>
											<td>70000</td>
										</tr>
										<tr>
											<td><strong>Total</strong></td>
											<td>40000</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-md-1 col-print-1"></div>
							<div class="col-md-5 col-print-5 no-padding-print">
								<table class="table table-bordered">
									<thead>
										<th colspan='2' class="bb-0">Deduction</th>
									</thead>
									<tbody>
										<tr>
											<td width="50%">TAX</td>
											<td>20000</td>
										</tr>
										<tr>
											<td>EOBI</td>
											<td>20000</td>
										</tr>
										<tr>
											<td>Absent</td>
											<td>22338</td>
										</tr>
										<tr>
											<td>Others</td>
											<td>2345</td>
										</tr>
										<tr>
											<td><strong>Total</strong></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>
					</div>	
				</div>
				<!-- ./End of salary slip row -->
			</div>
		</div>
			
	</div>
</section>
</section>
