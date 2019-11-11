<section class="secMainWidth remove-padding-print">
	<div class="row">
		
		<div class="col-lg-12">
		<!-- <section class="secMainWidth"> -->
			<section class="secFormLayout">
				<div class="mainInputBg remove-padding-print remove-margin-print no-border-print">

					<div class="row hide-from-print">
						<div class="col-lg-8">
							<div class="tabelHeading">
								<h3 id="detail-box-title"><?= $title; ?></h3>
							</div>
						</div>
						<div class="col-md-4 text-right">
							<div class="tabelTopBtn">
								<div class="btn-group">
									<a href="javascript:void(0);" onclick="window.print();" class="btn"><i class="fa fa-print"></i> Print</a>
									<a href="<?= base_url(); ?>Reports/employee_detail_pdf/<?= $detail->employee_id; ?>" target="_blank" class="btn"><i class="fa fa-file"></i> PDF</a>
								</div>
						
							</div>
						</div>
					</div>
					<div class="print-header hide-from-screen">
						<div class="row">
							<div class="col-md-12">
								<center><img src="<?= base_url(); ?>uploads/logo/chip.png" height="50px" alt="CHIP Logo"></center>
							</div>
							<div class="col-md-12">
								<center><h4>CHIP Training &amp; Consulting Pvt Ltd.</h4></center>
								<center><h5>Employee Detail</h5></center>
							</div>
							<div class="col-md-12">
								<hr>
							</div>	
						</div>
					</div>
					<div class="solidLine hide-from-print"></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Name</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->emp_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Father Name</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->father_name; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Contact No</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->contact_number; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Personal Contact</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->personal_contact; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Other Contact</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->contact_other; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Gender</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->gender_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>DOB</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ($detail->date_of_birth) ? date('d-m-Y', strtotime($detail->date_of_birth)) : ''; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>CNIC</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->cnic; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>CNIC Expiry</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ($detail->cnic_expiry_date) ? date('d-m-Y', strtotime($detail->cnic_expiry_date)) : ''; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Marital Status</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->marital_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>

					<div class="row"><hr></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Nationality</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->country_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Religion</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->religion_name; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Tribe</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->tribe_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Ethnicity</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->ethnicity_name; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Language</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->language_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Blood Group</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->blood_group_name; ?>
							</div>
						</div>
					</div>



					<div class="row"><hr></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Project Name</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->company_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Location</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->location_name; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Department</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->department_name; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Designation</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->designation_name; ?>
							</div>
						</div>
					</div>

					<div class="row"><hr></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-3 col-print-3">
								<label>Current Address</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Province</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->r_province; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>District</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->r_district; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Tehsil</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->r_tehsil; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>UC</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->r_uc; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Address</label>
							</div>
							<div class="col-lg-10 col-print-10">
								<?= $detail->r_address; ?>
							</div>
							
						</div>
					</div>

					
					<div class="row"><hr></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-3 col-print-3">
								<label>Permanent Address</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Province</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->p_province; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>District</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->p_district; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Tehsil</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->p_tehsil; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>UC</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->p_uc; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Address</label>
							</div>
							<div class="col-lg-10 col-print-10">
								<?= $detail->p_address; ?>
							</div>
							
						</div>
					</div>

					<div class="row"><hr></div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Contract Type</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->contract_type; ?>
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Date of Joining</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ($detail->date_of_joining) ? date('d-m-Y', strtotime($detail->date_of_joining)) : ''; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Contract Expiry</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ($detail->contract_expiry_date) ? date('d-m-Y', strtotime($detail->contract_expiry_date)) : ''; ?>
							</div>
						</div>
					</div>

				</div>
			</section>
		<!-- </section> -->
		</div>

	</div>
</section>