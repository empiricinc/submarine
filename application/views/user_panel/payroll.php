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
							<input type="text" name="salary_month" id="salary-month" class="form-control payroll-month" placeholder="Payroll Month/Year" required>
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
					
					<div class="salary-slip-body mlr-15">
						<div class="row">
							<div class="col-md-12 col-print-12">
								<div class="col-md-2 col-print-3"><label>Salary slip #</label></div>
								<div class="col-md-4 col-print-3">1</div>

								<div class="col-md-2 col-print-3"><label>Employee ID</label></div>
								<div class="col-md-4 col-print-3"><?= $basic_info->employee_id; ?></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12">
								<div class="col-md-2 col-print-3"><label>Name</label></div>
								<div class="col-md-4 col-print-3"><?= ucwords($basic_info->emp_name); ?></div>

								<div class="col-md-2 col-print-3"><label>CNIC</label></div>
								<div class="col-md-4 col-print-3"><?= $basic_info->cnic; ?></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12">
								<div class="col-md-2 col-print-3"><label>Project</label></div>
								<div class="col-md-4 col-print-3"><?= $basic_info->company_name; ?></div>

								<div class="col-md-2 col-print-3"><label>Designation</label></div>
								<div class="col-md-4 col-print-3"><?= $basic_info->designation_name; ?></div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 col-print-12">
								<div class="col-md-2 col-print-3"><label>Gross Salary</label></div>
								<div class="col-md-4 col-print-3"><?= (isset($salary->gross_salary)) ? $salary->gross_salary : 0; ?></div>

								<div class="col-md-2 col-print-3"><label>Basic Salary</label></div>
								<div class="col-md-4 col-print-3"><?= (isset($salary->basic_salary)) ? $salary->basic_salary : 0; ?></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12">
								<div class="col-md-2 col-print-3"><label>Payment Date</label></div>
								<div class="col-md-4 col-print-3"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12">
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
										<th colspan='2' class="bb-0">Allowances</th>
									</thead>
									<tbody>
										<tr>
											<td width="60%">House Rent Allowance</td>
											<td>
												<?= $house_rent = (isset($salary->house_rent_allowance)) ? $salary->house_rent_allowance : 0; ?>
													
											</td>
										</tr>
										<tr>
											<td>Medical Allowance</td>
											<td>
												<?= $medical = (isset($salary->medical_allowance)) ? $salary->medical_allowance : 0; ?>
													
											</td>
										</tr>
										<tr>
											<td>Travel Allowance</td>
											<td>
												<?= $travel = (isset($salary->travelling_allowance)) ? $salary->travelling_allowance : 0; ?>
													
											</td>
										</tr>
										<tr>
											<td><strong>Total</strong></td>
											<td><?= $house_rent + $medical + $travel; ?></td>
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
											<td>
												<?= $tax = (isset($salary->tax_deduction)) ? $salary->tax_deduction : 0; ?>
											</td>
										</tr>
										<tr>
											<td>EOBI</td>
											<td>
												<?= $eobi = (isset($salary->eobi)) ? $salary->eobi : 0; ?>	
											</td>
										</tr>
										<tr>
											<td>Provident Fund</td>
											<td>
												<?= $provident_fund = (isset($salary->provident_fund)) ? $salary->provident_fund : 0; ?>
											</td>
										</tr>
										<tr>
											<td><strong>Total</strong></td>
											<td><?= $tax + $eobi + $provident_fund; ?></td>
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
