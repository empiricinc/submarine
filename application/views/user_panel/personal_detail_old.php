<section class="secFormLayout">
	<div class="mainInputBg">

		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
			</div>
		</div>
		<div class="solidLine"></div>
		<div class="row">
			<div class="col-md-3 employee-info-nav">
				<ul class="nav">
					<li class="nav-item">
						<a href="#basic-information" data-toggle="tab">Basic Information</a>
					</li>
					<li class="nav-item">
						<a href="#residential-address" data-toggle="tab">Residential Address</a>
					</li>
					<li class="nav-item">
						<a href="#permanent-address" data-toggle="tab">Permanent Address</a>
					</li>
					<li class="nav-item">
						<a href="#educational-qualification" data-toggle="tab">Educational Qualification</a>
					</li>
					<li class="nav-item">
						<a href="#work-experience" data-toggle="tab">Work Experience</a>
					</li>
					<li class="nav-item">
						<a href="#bank-information" data-toggle="tab">Bank Information</a>
					</li>
					<li class="nav-item">
						<a href="#supervisor-detail" data-toggle="tab">Supervisor Detail</a>
					</li>
				</ul>	
			</div>
			<div class="col-md-9">
			<div class="tab-content">
				<div id="basic-information" class="tab-pane fade in active">
				    <div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="employee_name" value="<?= ucwords($basic_info->emp_name); ?>" id="employee-name" class="form-control" placeholder="Employee name" data-toggle="tooltip" title="Employee name" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="father_name" value="<?= ucwords($basic_info->father_name); ?>" id="father-name" class="form-control" placeholder="Father name"  data-toggle="tooltip" title="Father name" required readonly>
						</div>
					</div>
					<!-- <div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="relation" value="" id="relation" class="form-control" placeholder="Father Name"  data-toggle="tooltip" title="" required readonly>
						</div>
					</div> -->
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="gender" id="gender" class="form-control" data-toggle="tooltip" title="Gender" required readonly>
								<option value="">Select gender</option>
								<option value="0" <?php if($basic_info->gender == "0"): ?> selected <?php endif; ?> >Male</option>
								<option value="1" <?php if($basic_info->gender == "1"): ?> selected <?php endif; ?>>Female</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="dob" value="<?= date('Y-m-d', strtotime($basic_info->date_of_birth)); ?>" id="dob" class="form-control date" placeholder="Date of birth"  data-toggle="tooltip" title="Date of birth" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="marital_status" id="marital-status" class="form-control" data-toggle="tooltip" title="Marital status" required readonly>
								<option value="">Marital status</option>
								<option value="0" <?php if($basic_info->marital_status == "0"): ?> selected <?php endif; ?> >Married</option>
								<option value="1" <?php if($basic_info->marital_status == "1"): ?> selected <?php endif; ?> >Unmarried</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="date_joining" value="<?= date('Y-m-d', strtotime($basic_info->date_of_joining)); ?>" id="date-joined" class="form-control date" placeholder="Date of joining"  data-toggle="tooltip" title="Date of joining" required readonly>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="cnic" value="<?= $basic_info->cnic; ?>" id="cnic" class="form-control" placeholder="CNIC"  data-toggle="tooltip" title="CNIC" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="cnic_expiry" value="<?= date('Y-m-d', strtotime($basic_info->cnic_expiry_date)); ?>" id="cnic-expiry" class="form-control" placeholder="CNIC expiry"  data-toggle="tooltip" title="CNIC Expiry" required readonly>
						</div>
					</div>
					<!-- <div class="col-lg-4">
						<div class="inputFormMain">
							<select name="cnic_type" id="cnic-type" class="form-control" data-toggle="tooltip" title="CNIC type" required readonly>
								<option value="">CNIC type</option>
								
							</select>
						</div>
					</div> -->
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="contract_type" id="contract-type" class="form-control" data-toggle="tooltip" title="Contract type" required readonly>
								<option value="">Contract type</option>
								
							</select>
						</div>
					</div>
					<!-- <div class="col-lg-4">
						<div class="inputFormMain">
							<select name="other_id_name" id="other-id-name" class="form-control" data-toggle="tooltip" title="Other id name" required readonly>
								<option value="">Other id name</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="other_passport" id="other-passport" class="form-control" data-toggle="tooltip" title="Other passport" required readonly>
								<option value="">Other passport</option>
								
							</select>
						</div>
					</div>  -->

					<div class="col-lg-4">
						<div class="inputFormMain">
							<!-- <input type="text" name="tirbe" value="<?= $basic_info->tribe; ?>" id="tirbe" class="form-control" placeholder="Tribe"  data-toggle="tooltip" title="Tribe" required readonly> -->
							<select name="tribe" id="tribe" class="form-control" data-toggle="tooltip" title="Tribe" required readonly>
								<option value="">Select tribe</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<!-- <input type="text" name="ethnicity" value="<?= $basic_info->ethnicity; ?>" id="ethnicity" class="form-control" placeholder="Ethnicity"  data-toggle="tooltip" title="Ethnicity" required readonly> -->
							<select name="ethnicity" id="ethnicity" class="form-control" data-toggle="tooltip" title="Language" required readonly>
								<option value="">Select language</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="language" id="language" class="form-control" data-toggle="tooltip" title="Language" required readonly>
								<option value="">Select language</option>
								
							</select>
							<!-- <input type="text" name="language" value="<?= $basic_info->language; ?>" id="language" class="form-control" placeholder="Language"  data-toggle="tooltip" title="Language" required readonly> -->
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="other_language" id="other-language" class="form-control multi-select" data-toggle="tooltip" title="Other languages" required readonly>
								<option value="">Select Other languages</option>
								
							</select>
						<!-- 	<input type="text" name="other_languages" value="<?= $basic_info->other_languages; ?>" id="other_languages" class="form-control" placeholder="Other languages"  data-toggle="tooltip" title="Other language" required readonly> -->
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="nationality" id="nationality" class="form-control" data-toggle="tooltip" title="Nationality" required readonly>
								<option value="">Select nationality</option>
								
							</select>
						<!-- 	<input type="text" name="nationality" value="<?= $basic_info->nationality; ?>" id="nationality" class="form-control" placeholder="Nationality"  data-toggle="tooltip" title="Nationality" required readonly> -->
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="religion" id="religion" class="form-control" data-toggle="tooltip" title="Religion" required readonly>
								<option value="">Select religion</option>
								
							</select>
							<!-- <input type="text" name="religion" value="<?= $basic_info->religion; ?>" id="religion" class="form-control" placeholder="Religion"  data-toggle="tooltip" title="Religion" required readonly> -->
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="personal_contact_no" value="<?= $basic_info->personal_contact; ?>" id="personal_contact-no" class="form-control" placeholder="Personal contact no"  data-toggle="tooltip" title="Personal contact no" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="contact_no" value="<?= $basic_info->contact_number; ?>" id="contact-no" class="form-control" placeholder="Contact number"  data-toggle="tooltip" title="Contact number" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="other_contact_no" value="<?= $basic_info->contact_other; ?>" id="other-contact-no" class="form-control" placeholder="Other contact"  data-toggle="tooltip" title="Other contact" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="blood-group" id="blood_group" class="form-control" data-toggle="tooltip" title="Blood group" required readonly>
								<option value="">Select blood group</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="email" value="" id="email" class="form-control" placeholder="Email address"  data-toggle="tooltip" title="Email address" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="contract_expiry" value="" id="contract-expiry" class="form-control" placeholder="Contract expiry"  data-toggle="tooltip" title="Contract expiry" required readonly>
						</div>
					</div>
					<!-- <div class="col-lg-4">
						<div class="inputFormMain">
							<textarea name="remarks" id="remarks" rows="5" class="form-control" data-toggle="tooltip" title="Remarks">
								Remarks
							</textarea>
						</div>
					</div> -->
					<div class="col-lg-12">
						<div class="submitBtn">
							<button type="button" class="btn btnSubmit">Update</button>
						</div>
					</div>
				</div>

				  <!-- Residential Address -->
				<div id="residential-address" class="tab-pane fade">
				    <div class="col-lg-6">
						<div class="inputFormMain">
							<select name="residential_province" id="residential-province" class="form-control" data-toggle="tooltip" title="Province" required readonly>
								<option value="">Select Province</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="residential_district" id="residential-district" class="form-control" data-toggle="tooltip" title="District" required readonly>
								<option value="">Select District</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="residential_tehsil" id="residential-tehsil" class="form-control" data-toggle="tooltip" title="Tehsil" required readonly>
								<option value="">Select Tehsil</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="residential_uc" id="residential-uc" class="form-control" data-toggle="tooltip" title="Union council" required readonly>
								<option value="">Select union council</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="residential_address" value="" id="residential-address" class="form-control" placeholder="Current address"  data-toggle="tooltip" title="residential address" required readonly>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="local_id" id="local-id" class="form-control" data-toggle="tooltip" title="Union council" required readonly>
								<option value="">Select Local</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="verify_local_id" id="verify-local-id" class="form-control" data-toggle="tooltip" title="Union council" required readonly>
								<option value="">Verify Local</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button type="button" class="btn btnSubmit">Update</button>		
						</div>
					</div>
				</div>

				  <!-- Permanent Address -->
				<div id="permanent-address" class="tab-pane fade">
				    <div class="col-lg-6">
						<div class="inputFormMain">
							<select name="permanent_province" id="permanent-province" class="form-control" data-toggle="tooltip" title="Province" required readonly>
								<option value="">Select Province</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="permanent_district" id="permanent-district" class="form-control" data-toggle="tooltip" title="District" required readonly>
								<option value="">Select District</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="permanent_tehsil" id="permanent-tehsil" class="form-control" data-toggle="tooltip" title="Tehsil" required readonly>
								<option value="">Select Tehsil</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="permanent_uc" id="permanent-uc" class="form-control" data-toggle="tooltip" title="Union council" required readonly>
								<option value="">Select union council</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="permanent_address" value="" id="permanent-address" class="form-control" placeholder="Permanent address"  data-toggle="tooltip" title="Permanent address" required readonly>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="local_id" id="local-id" class="form-control" data-toggle="tooltip" title="Union council" required readonly>
								<option value="">Select Local</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="verify_local_id" id="verify-local-id" class="form-control" data-toggle="tooltip" title="Union council" required readonly>
								<option value="">Verify Local</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button type="button" class="btn btnSubmit">Update</button>		
						</div>
					</div>
				</div>

				<div id="educational-qualification" class="tab-pane fade">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="degree_name" value="" id="degree-name" class="form-control" placeholder="Degree / Diploma / Certificate"  data-toggle="tooltip" title="Degree/Diploma/Certificate" required readonly>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="descipline" id="descipline" class="form-control" data-toggle="tooltip" title="Descipline" required readonly>
								<option value="">Select Descipline</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button type="button" class="btn btnSubmit">Save</button>		
						</div>
					</div>
					<div class="col-lg-12"><hr></div>
					<div class="col-lg-12">
						<table class="table table-bordered table-hover dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Degree</th>
									<th>Discipline</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>BSSE</td>
									<td>Software Engineering</td>
									<td>
										<a href="#" class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div id="work-experience" class="tab-pane fade">
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="company" value="" id="company" class="form-control" placeholder="Company name"  data-toggle="tooltip" title="Company name" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="from_date" value="" id="from-date" class="form-control date" placeholder="From date"  data-toggle="tooltip" title="From date" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="to_date" value="" id="to-date" class="form-control date" placeholder="To date"  data-toggle="tooltip" title="To date" required readonly>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="description" id="description" class="form-control" rows="3" placeholder="Description" required></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button type="button" class="btn btnSubmit">Save</button>		
						</div>
					</div>
					<div class="col-lg-12"><hr></div>
					<div class="col-lg-12">
						<table class="table table-bordered table-hover dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Company Name</th>
									<th>Post</th>
									<th>From Date</th>
									<th>To Date</th>
									<!-- <th>Description</th> -->
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>CHIP</td>
									<td>Web Developer</td>
									<td>20-May-2019</td>
									<td>31-Aug-2019</td>
									<!-- <td>Worked on Human Resource Management System </td> -->
									<td>
										<a href="#" class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div id="bank-information" class="tab-pane fade">
					<div class="col-lg-4">
						<div class="inputFormMain">
							<select name="bank" id="bank" class="form-control" data-toggle="tooltip" title="Bank name" required readonly>
								<option value="">Select bank name</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="account" value="" id="account" class="form-control" placeholder="Account #"  data-toggle="tooltip" title="Account #" required readonly>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="inputFormMain">
							<input type="text" name="branch_code" value="" id="branch-code" class="form-control" placeholder="Branch code"  data-toggle="tooltip" title="Branch code" required readonly>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button type="button" class="btn btnSubmit">Save</button>		
						</div>
					</div>

					<div class="col-lg-12"><hr></div>
					<div class="col-lg-12">
						<table class="table table-bordered table-hover dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Account Title</th>
									<th>Account No</th>
									<th>Bank Name</th>
									<th>Branch Code</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>AssadUllah Khan</td>
									<td>012345678987</td>
									<td>Habib bank ltd.</td>
									<td>0221</td>
									<td>
										<a href="#" class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div id="supervisor-detail" class="tab-pane fade">
				<h3>Supervisor Detail</h3>
				<p>Some content in menu 2.</p>
				</div>
				</div>
			</div>

		</div>
			
	</div>
</section>
