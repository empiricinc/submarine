<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
					<div class="employee-info-nav">
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
								<li class="nav-item">
									<a href="#contract" data-toggle="tab">Contract</a>
								</li>
							</ul>	
					</div>
					
				</div>
			</div>
		

		<div class="col-lg-10">
		<!-- <section class="secMainWidth"> -->
			<section class="secFormLayout">
				<div class="mainInputBg">

					<div class="row">
						<div class="col-lg-12">
							<div class="tabelHeading">
								<h3 id="detail-box-title"><?= $title; ?></h3>
							</div>
						</div>
					</div>
					<div class="solidLine"></div>
					<div class="row">
						
						<div class="col-md-12">
							<div class="tab-content">
								<!-- Employee Basic Information -->
								<div id="basic-information" class="tab-pane fade in active">
									<form id="basic-information-form">
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
												<input type="text" name="relation" value="" id="relation" class="form-control" placeholder="Father Name"  data-toggle="tooltip" title="" required >
											</div>
										</div> -->
										<div class="col-lg-4">
											<div class="inputFormMain">
												<select name="gender" id="gender" class="form-control" data-toggle="tooltip" title="Gender" required disabled>
													<option value="">Select gender</option>
													<?php foreach($gender as $g): ?>
													<option 
														value="<?= $g->gender_id; ?>" 
														<?php if($g->gender_id == $basic_info->gender): ?> selected <?php endif; ?>
													>
														<?= $g->gender_name; ?>
													</option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain" data-toggle="tooltip" title="Date of birth">
												<input type="text" name="dob" value="<?= date('d-m-Y', strtotime($basic_info->date_of_birth)); ?>" id="dob" class="form-control date" placeholder="Date of birth" required disabled>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<select name="marital_status" id="marital-status" class="form-control" data-toggle="tooltip" title="Marital status" required>
													<option value="">Marital status</option>
													<?php foreach($marital as $m): ?>
													<option 
														value="<?= $m->marital_id; ?>" 
														<?php if($m->marital_id == $basic_info->marital_status): ?> selected <?php endif; ?>
													>
														<?= $m->marital_name; ?>
													</option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<!-- <div class="col-lg-4">
											<div class="inputFormMain">
												<input type="text" name="date_joining" value="<?= date('d-m-Y', strtotime($basic_info->date_of_joining)); ?>" id="date-joined" class="form-control date" placeholder="Date of joining"  data-toggle="tooltip" title="Date of joining" required >
											</div>
										</div> -->
										
										<div class="col-lg-4">
											<div class="inputFormMain">
												<input type="text" name="cnic" value="<?= $basic_info->cnic; ?>" id="cnic" class="form-control" placeholder="CNIC"  data-toggle="tooltip" title="CNIC" required readonly>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<input type="text" name="cnic_expiry" value="<?= date('d-m-Y', strtotime($basic_info->cnic_expiry_date)); ?>" id="cnic-expiry" class="form-control" placeholder="CNIC expiry"  data-toggle="tooltip" title="CNIC Expiry" required>
											</div>
										</div>
										<!-- <div class="col-lg-4">
											<div class="inputFormMain">
												<select name="cnic_type" id="cnic-type" class="form-control" data-toggle="tooltip" title="CNIC type" required >
													<option value="">CNIC type</option>
													
												</select>
											</div>
										</div> -->
										<!-- <div class="col-lg-4">
											<div class="inputFormMain">
												<select name="contract_type" id="contract-type" class="form-control" data-toggle="tooltip" title="Contract type" required >
													<option value="">Contract type</option>
													
												</select>
											</div>
										</div> -->
										<!-- <div class="col-lg-4">
											<div class="inputFormMain">
												<select name="other_id_name" id="other-id-name" class="form-control" data-toggle="tooltip" title="Other id name" required >
													<option value="">Other id name</option>
													
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<select name="other_passport" id="other-passport" class="form-control" data-toggle="tooltip" title="Other passport" required >
													<option value="">Other passport</option>
													
												</select>
											</div>
										</div>  -->

										<div class="col-lg-4">
											<div class="inputFormMain">
												<!-- <input type="text" name="tirbe" value="<?= $basic_info->tribe; ?>" id="tirbe" class="form-control" placeholder="Tribe"  data-toggle="tooltip" title="Tribe" required > -->
												<select name="tribe" id="tribe" class="form-control" data-toggle="tooltip" title="Tribe" required>
													 ?>
													<option value="">Select tribe</option>
													<?php foreach($tribe as $t): ?>
													<option 
														value="<?= $t->tribe_id; ?>" 
														<?php if($t->tribe_id == $basic_info->tribe): ?> selected <?php endif; ?>
													>
														<?= $t->tribe_name; ?>
													</option>
													<?php endforeach; ?>
													
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<!-- <input type="text" name="ethnicity" value="<?= $basic_info->ethnicity; ?>" id="ethnicity" class="form-control" placeholder="Ethnicity"  data-toggle="tooltip" title="Ethnicity" required > -->
												<select name="ethnicity" id="ethnicity" class="form-control" data-toggle="tooltip" title="Ethnicity" required>
													<option value="">Select ethnicity</option>
													<?php foreach($ethnicity as $e): ?>
													<option value="<?= $e->ethnicity_id; ?>"
														<?php if($e->ethnicity_id == $basic_info->ethnicity): ?> selected <?php endif; ?>
														><?= $e->ethnicity_name; ?></option>
													<?php endforeach; ?>
													
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<select name="language" id="language" class="form-control" data-toggle="tooltip" title="Language" required>
													<option value="">Select language</option>
													<?php foreach($language as $l): ?>
													<option value="<?= $l->language_id; ?>" 
														<?php if($l->language_id == $basic_info->language): ?> selected <?php endif; ?>
														><?= $l->language_name; ?></option>
													<?php endforeach; ?>
												</select>
												<!-- <input type="text" name="language" value="<?= $basic_info->language; ?>" id="language" class="form-control" placeholder="Language"  data-toggle="tooltip" title="Language" required > -->
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<!-- <select name="other_language" id="other-language" class="form-control multi-select" data-toggle="tooltip" title="Other languages" required >
													<option value="">Select Other languages</option>

												</select> -->
												<input type="text" name="other_languages" value="<?= $basic_info->other_languages; ?>" id="other_languages" class="form-control" placeholder="Other languages"  data-toggle="tooltip" title="Other languages" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<select name="nationality" id="nationality" class="form-control" data-toggle="tooltip" title="Nationality" required >
													<option value="">Select nationality</option>
													<?php foreach($countries AS $c): ?>
														<option	value="<?= $c->country_id; ?>"
															<?php if($c->country_id == $basic_info->nationality): ?>selected <?php endif; ?>
																><?= $c->country_name; ?></option>
													<?php endforeach; ?>
												</select> 
												
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<select name="religion" id="religion" class="form-control" data-toggle="tooltip" title="Religion" required >
													<option value="">Select religion</option>
													<?php foreach($religion AS $r): ?>
														<option value="<?= $r->id; ?>"
															<?php if($r->id == $basic_info->religion): ?>selected <?php endif; ?>
															><?= $r->religion_name; ?></option>
													<?php endforeach; ?>
												</select> 
												
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<input type="text" name="personal_contact_no" value="<?= $basic_info->personal_contact; ?>" id="personal_contact-no" class="form-control" placeholder="Personal contact no"  data-toggle="tooltip" title="Personal contact no" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<input type="text" name="contact_no" value="<?= $basic_info->contact_number; ?>" id="contact-no" class="form-control" placeholder="CTC mobile number"  data-toggle="tooltip" title="CTC mobile number" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<input type="text" name="other_contact_no" value="<?= $basic_info->contact_other; ?>" id="other-contact-no" class="form-control" placeholder="Other contact"  data-toggle="tooltip" title="Other contact" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<select name="blood_group" id="blood-group" class="form-control" data-toggle="tooltip" title="Blood group" required>
													<option value="">Select blood group</option>
													<?php foreach($blood_group as $bg): ?>
													<option value="<?= $bg->blood_group_id; ?>"
														<?php if($bg->blood_group_id == $basic_info->bloodgroup): ?> selected <?php endif; ?>
														><?= $bg->blood_group_name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="inputFormMain">
												<input type="email" name="email" value="<?= $basic_info->email_address; ?>" id="email" class="form-control" placeholder="Email address"  data-toggle="tooltip" title="Email address" required>
											</div>
										</div>
										<!-- <div class="col-lg-4">
											<div class="inputFormMain">
												<input type="text" name="contract_expiry" value="" id="contract-expiry" class="form-control" placeholder="Contract expiry"  data-toggle="tooltip" title="Contract expiry" required >
											</div>
										</div> -->
										<!-- <div class="col-lg-4">
											<div class="inputFormMain">
												<textarea name="remarks" id="remarks" rows="5" class="form-control" data-toggle="tooltip" title="Remarks">
													Remarks
												</textarea>
											</div>
										</div> -->
										<div class="col-lg-12">
											<div class="submitBtn">
												<button type="submit" class="btn btnSubmit">Update</button>
											</div>
										</div>
									</form>
								</div>
								

								<!-- Residential Address -->
								<div id="residential-address" class="tab-pane fade">
									<form id="residential-address-form">
									    <div class="col-lg-6">
											<div class="inputFormMain">
												<select name="residential_province" id="residential-province" class="form-control province" data-toggle="tooltip" title="Province" type="residential" required>
													<option value="">Select Province</option>
													<?php foreach($province as $p): ?>
													<option value="<?= $p->id; ?>" 
														<?php if($p->id == $basic_info->resident_province): ?> selected <?php endif; ?>
														><?= $p->name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<select name="residential_district" id="residential-district" class="form-control district" data-toggle="tooltip" title="District" type="residential" required>
													<option value="">Select District</option>
													<?php foreach($r_district as $rd): ?>
													<option value="<?= $rd->id; ?>" 
														<?php if($rd->id == $basic_info->resident_district): ?> selected <?php endif; ?>
														><?= $rd->name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<select name="residential_tehsil" id="residential-tehsil" class="form-control tehsil" data-toggle="tooltip" title="Tehsil" type="residential" required>
													<option value="">Select Tehsil</option>
													<?php foreach($r_tehsil as $rt): ?>
													<option value="<?= $rt->id; ?>" 
														<?php if($rt->id == $basic_info->resident_tehsil): ?> selected <?php endif; ?>
														><?= $rt->name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<select name="residential_uc" id="residential-uc" class="form-control union-council" data-toggle="tooltip" title="Union council" type="residential" required>
													<option value="">Select Union Council</option>
													<?php foreach($r_uc as $ru): ?>
													<option value="<?= $ru->id; ?>" 
														<?php if($ru->id == $basic_info->resident_uc): ?> selected <?php endif; ?>
														><?= $ru->name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="inputFormMain">
												<input type="text" name="residential_address" value="<?= $basic_info->resident_address_details; ?>" id="residential-address" class="form-control" placeholder="Current address"  data-toggle="tooltip" title="residential address" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="submitBtn">
												<button type="submit" class="btn btnSubmit">Update</button>		
											</div>
										</div>
									</form>
								</div>

								<!-- Permanent Address -->
								<div id="permanent-address" class="tab-pane fade">
								    <form id="permanent-address-form">
									    <div class="col-lg-6">
											<div class="inputFormMain">
												<select name="permanent_province" id="permanent-province" class="form-control province" data-toggle="tooltip" title="Province" type="permanent" required>
													<?php foreach($province as $p): ?>
													<option value="<?= $p->id; ?>" 
														<?php if($p->id == $basic_info->permanent_province): ?> selected <?php endif; ?>
														><?= $p->name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<select name="permanent_district" id="permanent-district" class="form-control district" data-toggle="tooltip" title="District" type="permanent" required>
													<option value="">Select District</option>
													<?php foreach($p_district as $pd): ?>
													<option value="<?= $p->id; ?>" 
														<?php if($pd->id == $basic_info->permanent_district): ?> selected <?php endif; ?>
														><?= $pd->name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<select name="permanent_tehsil" id="permanent-tehsil" class="form-control tehsil" data-toggle="tooltip" title="Tehsil" type="permanent" required >
													<option value="">Select Tehsil</option>
													<?php foreach($p_tehsil as $pt): ?>
													<option value="<?= $pt->id; ?>" 
														<?php if($pt->id == $basic_info->permanent_tehsil): ?> selected <?php endif; ?>
														><?= $pt->name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<select name="permanent_uc" id="permanent-uc" class="form-control union-council" data-toggle="tooltip" title="Union council" type="permanent" required >
													<option value="">Select Union council</option>
													<?php foreach($p_uc as $pu): ?>
													<option value="<?= $pu->id; ?>" 
														<?php if($pu->id == $basic_info->permanent_uc): ?> selected <?php endif; ?>
														><?= $pu->name; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="inputFormMain">
												<input type="text" name="permanent_address" value="<?= $basic_info->permanent_address_details; ?>" id="permanent-address" class="form-control" placeholder="Permanent address"  data-toggle="tooltip" title="Permanent address" required >
											</div>
										</div>
										<!-- <div class="col-lg-6">
											<div class="inputFormMain">
												<select name="local_id" id="local-id" class="form-control" data-toggle="tooltip" title="Union council" required >
													<option value="">Select Local</option>
													
												</select>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<select name="verify_local_id" id="verify-local-id" class="form-control" data-toggle="tooltip" title="Union council" required >
													<option value="">Verify Local</option>
													
												</select>
											</div>
										</div> -->
										<div class="col-lg-12">
											<div class="submitBtn">
												<button type="submit" class="btn btnSubmit">Update</button>		
											</div>
										</div>
									</form>
								</div>
								
								<!-- Educational Qualification -->
								<div id="educational-qualification" class="tab-pane fade">
									<form id="educational-qualification-form">
									<div class="col-lg-6">
										<div class="inputFormMain">
											<select name="qualification" id="qualification" class="form-control" data-toggle="tooltip" title="Qualification" required >
												<option value="">Select Qualification</option>
												<?php foreach($qualification as $q): ?>
												<option value="<?= $q->id; ?>"><?= $q->name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="inputFormMain">
											<input type="text" name="institute_name" value="" id="institute-name" class="form-control" placeholder="University/ Institute"  data-toggle="tooltip" title="University/ Institute" required >
										</div>
									</div>
									<div class="col-lg-6">
										<div class="inputFormMain">
											<select name="discipline" id="discipline" class="form-control" data-toggle="tooltip" title="Descipline" required >
												<option value="">Select Descipline</option>
												<?php foreach($discipline as $d): ?>
												<option value="<?= $d->discipline_id; ?>"><?= $d->discipline_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="submitBtn">
											<button type="submit" class="btn btnSubmit">Save</button>		
										</div>
									</div>
									</form>
									<div class="col-lg-12"><hr></div>
									<div class="col-lg-12">
										<table class="table table-bordered table-hover dataTable" id="education-table" style="width: 100%;">
											<thead>
												<tr>
													<th>#</th>
													<th>Institute</th>
													<th>Qualification</th>
													<th>Discipline</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
								</div>

								<!-- Work Experience -->
								<div id="work-experience" class="tab-pane fade">
									<form id="work-experience-form">
										<div class="col-lg-6">
											<div class="inputFormMain">
												<input type="text" name="company" value="" id="company" class="form-control" placeholder="Company name"  data-toggle="tooltip" title="Company name" required >
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<input type="text" name="designation" value="" id="designation" class="form-control" placeholder="Designation"  data-toggle="tooltip" title="Designation" required >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="inputFormMain">
												<input type="text" name="from_date" value="" id="from-date" class="form-control date" placeholder="From date"  data-toggle="tooltip" title="From date" required >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="inputFormMain">
												<input type="text" name="to_date" value="" id="to-date" class="form-control date" placeholder="To date"  data-toggle="tooltip" title="To date" required >
											</div>
										</div>
										<div class="col-lg-12">
											<div class="inputFormMain">
												<textarea name="description" id="description" class="form-control" rows="3" placeholder="Description" required></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="submitBtn">
												<button type="submit" class="btn btnSubmit">Save</button>		
											</div>
										</div>
									</form>
									<div class="col-lg-12"><hr></div>
									<div class="col-lg-12">
										<table class="table table-bordered table-hover dataTable" id="job-experience-table" style="width: 100%;">
											<thead>
												<tr>
													<th>#</th>
													<th>Company</th>
													<th>Designation</th>
													<th>From Date</th>
													<th>To Date</th>
													<!-- <th>Description</th> -->
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>
									</div>
								</div>

								<!-- Bank Information -->
								<div id="bank-information" class="tab-pane fade">
									<form id="bank-information-form">
									<div class="col-lg-4">
										<div class="inputFormMain">
											<select name="bank" id="bank" class="form-control select2" data-toggle="tooltip" title="Bank name" required >
												<option value="">Select bank name</option>
												<?php foreach($bank as $b): ?>
												<option value="<?= $b->bank_id; ?>"><?= $b->bank_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="inputFormMain">
											<input type="text" name="account_title" value="" id="account-title" class="form-control" placeholder="Account title"  data-toggle="tooltip" title="Account title" required >
										</div>
									</div>
									<div class="col-lg-4">
										<div class="inputFormMain">
											<input type="text" name="account" value="" id="account" class="form-control" placeholder="Account #"  data-toggle="tooltip" title="Account #" required >
										</div>
									</div>
									<div class="col-lg-4">
										<div class="inputFormMain">
											<input type="text" name="branch_code" value="" id="branch-code" class="form-control" placeholder="Branch code"  data-toggle="tooltip" title="Branch code" required >
										</div>
									</div>
									<div class="col-lg-12">
										<div class="submitBtn">
											<button type="submit" class="btn btnSubmit">Save</button>		
										</div>
									</div>
									</form>

									<div class="col-lg-12"><hr></div>
									<div class="col-lg-12">
										<table class="table table-bordered table-hover dataTable" id="bank-detail-table" style="width: 100%;">
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
												
											</tbody>
										</table>
									</div>
								</div>

								<!-- Supervisor Detail -->
								<div id="supervisor-detail" class="tab-pane fade">
									<div class="row">
										<div class="col-lg-3">
											<strong>Supervisor Name</strong>
										</div>
										<div class="col-lg-8">
											<?php echo $supervisor_detail->emp_name; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<strong>Designation</strong>
										</div>
										<div class="col-lg-8">
											<?php echo $supervisor_detail->designation_name; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<strong>Contact</strong>
										</div>
										<div class="col-lg-8">
											<?php echo $supervisor_detail->contact_number ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<strong>District</strong>
										</div>
										<div class="col-lg-8">
											<?php echo $supervisor_detail->district; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<strong>Tehsil</strong>
										</div>
										<div class="col-lg-8">
											<?php echo $supervisor_detail->tehsil; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<strong>Union Council</strong>
										</div>
										<div class="col-lg-8">
											<?php echo $supervisor_detail->union_council; ?>
										</div>
									</div>
								</div>

								<!-- Contract -->
								<div id="contract" class="tab-pane fade">
									<div class="col-lg-4">
										<div class="inputFormMain" data-toggle="tooltip" title="Date of joining">
											<input type="text" name="date_joining" value="<?= date('d-m-Y', strtotime($basic_info->date_of_joining)); ?>" id="date-joined" class="form-control date" placeholder="Date of joining" required disabled >
										</div>
									</div>
									<div class="col-lg-4">
										<div class="inputFormMain" data-toggle="tooltip" title="Contract type">
											<select name="contract_type" id="contract-type" class="form-control" required disabled>
												<option value="">Contract type</option>
												<?php foreach($contract_type as $c): ?>
												<option value="<?= $c->contract_type_id; ?>"
													<?php if($c->contract_type_id == $basic_info->employee_contract_type):  ?>selected<?php endif; ?>
													><?= $c->contract_type_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="inputFormMain" data-toggle="tooltip" title="Contract expiry">
											<input type="text" name="contract_expiry" value="<?= $basic_info->contract_expiry_date; ?>" id="contract-expiry" class="form-control date" placeholder="Contract expiry" required disabled>
										</div>
									</div>
									<!-- <div class="col-lg-12">
										<div class="submitBtn">
											<button type="button" class="btn btnSubmit">Update</button>
										</div>
									</div> -->
								</div>
							</div>
						</div>

					</div>
						
				</div>
			</section>
		<!-- </section> -->
		</div>

	</div>
</section>