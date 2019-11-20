<section class="secMainWidth remove-padding-print">
<section class="secFormLayout">
	<div class="mainInputBg remove-padding-print remove-margin-print no-border-print">
		<div class="salary-slip-header hide-print">
			<div class="row">
				<div class="col-lg-10">
					<div class="tabelHeading">
						<h3><?= $title; ?></h3>
					</div>
				</div>	
				<?php if(!empty($payroll)): ?>
				<div class="col-lg-2 text-right">
					<button type="button" class="btn btn-warning print-payslip">
						<i class="fa fa-print"></i> Print
					</button>
				</div>
				<?php endif; ?>
			</div>

			<div class="row">
				<form action="<?= base_url(); ?>User_panel/payroll" method="POST">
				<!-- <div class=""> -->
					<div class="col-md-3">
						<div class="inputFormMain">
							<input type="text" name="salary_month" id="salary-month" class="form-control payroll-month" placeholder="Payroll Month/Year" required>
						</div>
					</div>
					<div class="col-md-3 pr-0">
						<div class="submitBtn">
							<button type="submit" class="btn btnSubmit" id="load-salary-slip">
								<i class="fa fa-download"></i> Load
							</button>
						</div>	
					</div>
				<!-- </div> -->
				</form>
			</div>

			<div class="solidLine"></div>
		</div>
		
		<?php if(!empty($payroll)): ?>
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
								<center><h5>Employee Salary Slip</h5></center>
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
								<div class="col-md-4 col-print-3"><?= (isset($payroll->salary_id)) ? $payroll->salary_id : ''; ?></div>

								<div class="col-md-2 col-print-3"><label>Salary Month</label></div>
								<div class="col-md-4 col-print-3">
									<?php echo (isset($payroll->sdt)) ? date('M, Y', strtotime($payroll->sdt)) : ''; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12">
								<div class="col-md-2 col-print-3"><label>Name</label></div>
								<div class="col-md-4 col-print-3"><?= (isset($payroll->emp_name)) ? ucwords($payroll->emp_name) : ''; ?></div>

								<div class="col-md-2 col-print-3"><label>CNIC</label></div>
								<div class="col-md-4 col-print-3"><?= (isset($payroll->cnic)) ? $payroll->cnic : ''; ?></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-print-12">
								<div class="col-md-2 col-print-3"><label>Project</label></div>
								<div class="col-md-4 col-print-3"><?= (isset($payroll->company_name)) ? $payroll->company_name : ''; ?></div>

								<div class="col-md-2 col-print-3"><label>Designation</label></div>
								<div class="col-md-4 col-print-3"><?= (isset($payroll->designation_name)) ? $payroll->designation_name : ''; ?></div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 col-print-12">
								<div class="col-md-2 col-print-3"><label>Basic Salary</label></div>
								<div class="col-md-4 col-print-3"><?= (isset($payroll->payroll_basic_salary)) ? $payroll->payroll_basic_salary : 0; ?></div>

								<div class="col-md-2 col-print-3"><label>Net Salary</label></div>
								<div class="col-md-4 col-print-3"><?= (isset($payroll->payroll_net_salary)) ? $payroll->payroll_net_salary : 0; ?></div>
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
												<?= $house_rent = (isset($payroll->house_rent_allowance)) ? $payroll->house_rent_allowance : 0; ?>
													
											</td>
										</tr>
										<tr>
											<td>Medical Allowance</td>
											<td>
												<?= $medical = (isset($payroll->medical_allowance)) ? $payroll->medical_allowance : 0; ?>
													
											</td>
										</tr>
										<tr>
											<td>Travel Allowance</td>
											<td>
												<?= $travel = (isset($payroll->travelling_allowance)) ? $payroll->travelling_allowance : 0; ?>
													
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
												<?= $tax = (isset($payroll->tax_deduction)) ? $payroll->tax_deduction : 0; ?>
											</td>
										</tr>
										<tr>
											<td>EOBI</td>
											<td>
												<?= $eobi = (isset($payroll->eobi)) ? $payroll->eobi : 0; ?>	
											</td>
										</tr>
										<tr>
											<td>Provident Fund</td>
											<td>
												<?= $provident_fund = (isset($payroll->provident_fund)) ? $payroll->provident_fund : 0; ?>
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

		<?php else: ?>
			<div class="row">
				<center><p>No Record Found.</p></center>
			</div>
		<?php endif; ?>
			
	</div>
</section>
</section>
