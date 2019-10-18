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
									<a href="#salary-detail" data-toggle="tab">Salary Information</a>
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
						<div class="col-lg-8">
							<div class="tabelHeading">
								<h3 id="detail-box-title">Basic Information</h3>
							</div>
						</div>
					</div>
					<div class="solidLine"></div>
					<div class="row">
						
						<div class="">
							<div class="tab-content">
								<!-- Employee Basic Information -->
								<div id="basic-information" class="tab-pane fade in active">
									<form enctype="multipart/form-data" id="basic-information-form">
										<div class="col-lg-12" style="padding-bottom: 30px;">
											<div class="col-lg-4 col-lg-offset-5">
												<?php 
													$profile_picture = ($basic_info->profile_picture) ?  base_url().'uploads/profile/'.$basic_info->profile_picture : base_url()."uploads/profile/no-photo.png";
												 ?>
												 <div class="img-wrapper img-circle" style="width: 120px; height: 120px; border: 1px solid #e1e4e7;">
												<img src="<?= $profile_picture; ?>" id="profile" alt="Profile Picture" width="120px" height="120px" class="img-circle" style="position: relative;">
												</div>
												<div class="overlay img-circle" style="position: absolute;top: 0;left: 15; right: 223.719;width: 120px;height: 120px;z-index: 10;background-color: rgba(0,0,0,0.5); opacity: 0;">
													<span class="fa fa-pencil fa-2x" id="edit-profile-pic"></span>
													<input type="file" name="profile_pic" id="profile-pic" style="opacity: 0;">
												</div>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Employee name</label>
													<input type="text" name="employee_name" value="<?= ucwords($basic_info->emp_name); ?>" id="employee-name" class="form-control" placeholder="Employee name" data-toggle="tooltip" title="Employee name" readonly>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Father name</label>
													<input type="text" name="father_name" value="<?= ucwords($basic_info->father_name); ?>" id="father-name" class="form-control" placeholder="Father name"  data-toggle="tooltip" title="Father name" readonly>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Gender</label>
													<select name="gender" id="gender" class="form-control" data-toggle="tooltip" title="Gender" disabled>
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
										</div>
									    
									    <div class="col-lg-12">
									    	<div class="col-lg-4">
												<div class="inputFormMain" data-toggle="tooltip" title="Date of birth">
													<label>Date of birth</label>
													<input type="text" name="dob" value="<?= date('d-m-Y', strtotime($basic_info->date_of_birth)); ?>" id="dob" class="form-control date" placeholder="Date of birth" disabled>
												</div>
											</div>

											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>CNIC</label>
													<input type="text" name="cnic" value="<?= $basic_info->cnic; ?>" id="cnic" class="form-control" placeholder="CNIC"  data-toggle="tooltip" title="CNIC"  readonly>
												</div>
											</div>
											
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>CNIC expiry</label>
													<input type="text" name="cnic_expiry" value="<?= date('d-m-Y', strtotime($basic_info->cnic_expiry_date)); ?>" id="cnic-expiry" class="form-control" placeholder="CNIC expiry"  data-toggle="tooltip" title="CNIC Expiry" readonly>
												</div>
											</div>
									    </div>
										
										<div class="col-lg-12">
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Marital status</label>
													<select data-plugin="select_hrm" name="marital_status" id="marital-status" class="form-control" data-toggle="tooltip" title="Marital status">
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
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Tribe</label>
													<select data-plugin="select_hrm" name="tribe" id="tribe" class="form-control" data-toggle="tooltip" title="Tribe" >
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
													<label>Ethnicity</label>
													<select data-plugin="select_hrm" name="ethnicity" id="ethnicity" class="form-control" data-toggle="tooltip" title="Ethnicity" >
														<option value="">Select ethnicity</option>
														<?php foreach($ethnicity as $e): ?>
														<option value="<?= $e->ethnicity_id; ?>"
															<?php if($e->ethnicity_id == $basic_info->ethnicity): ?> selected <?php endif; ?>
															><?= $e->ethnicity_name; ?></option>
														<?php endforeach; ?>
														
													</select>
												</div>
											</div>	
										</div>
										
										<div class="col-lg-12">
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Language</label>
													<select data-plugin="select_hrm" name="language" id="language" class="form-control" data-toggle="tooltip" title="Language" >
														<option value="">Select language</option>
														<?php foreach($language as $l): ?>
														<option value="<?= $l->language_id; ?>" 
															<?php if($l->language_id == $basic_info->language): ?> selected <?php endif; ?>
															><?= $l->language_name; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Other Language</label>
													<input type="text" name="other_languages" value="<?= $basic_info->other_languages; ?>" id="other_languages" class="form-control" placeholder="Other languages"  data-toggle="tooltip" title="Other languages" >
												</div>
											</div>
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Nationality</label>
													<select data-plugin="select_hrm" name="nationality" id="nationality" class="form-control" data-toggle="tooltip" title="Nationality"  >
														<option value="">Select nationality</option>
														<?php foreach($countries AS $c): ?>
															<option	value="<?= $c->country_id; ?>"
																<?php if($c->country_id == $basic_info->nationality): ?>selected <?php endif; ?>
																	><?= $c->country_name; ?></option>
														<?php endforeach; ?>
													</select> 
													
												</div>
											</div>	
										</div>
										
										<div class="col-lg-12">
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Religion</label>
													<select data-plugin="select_hrm" name="religion" id="religion" class="form-control" data-toggle="tooltip" title="Religion" >
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
													<label>Contact no</label>
													<input type="text" name="personal_contact_no" value="<?= $basic_info->personal_contact; ?>" id="personal_contact-no" class="form-control contact-no" placeholder="Personal contact no"  data-toggle="tooltip" title="Personal contact no" >
												</div>
											</div>
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Other contact</label>
													<input type="text" name="contact_no" value="<?= $basic_info->contact_number; ?>" id="contact-no" class="form-control contact-no" placeholder="CTC mobile number"  data-toggle="tooltip" title="CTC mobile number" >
												</div>
											</div>
										</div>
										
										<div class="col-lg-12">
											<div class="col-lg-4">
												<label>CTC contact</label>
												<div class="inputFormMain">
													<input type="text" name="other_contact_no" value="<?= $basic_info->contact_other; ?>" id="other-contact-no" class="form-control contact-no" placeholder="Other contact"  data-toggle="tooltip" title="Other contact" >
												</div>
											</div>
											<div class="col-lg-4">
												<div class="inputFormMain">
													<label>Blood group</label>
													<select data-plugin="select_hrm" name="blood_group" id="blood-group" class="form-control" data-toggle="tooltip" title="Blood group" >
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
													<label>Email address</label>
													<input type="email" name="email" value="<?= $basic_info->email_address; ?>" id="email" class="form-control" placeholder="Email address"  data-toggle="tooltip" title="Email address" >
												</div>
											</div>	
										</div>
										
										
										<div class="col-lg-12">
											<div class="col-lg-4">
												<div class="submitBtn">
													<button type="submit" class="btn btnSubmit" disabled>Update</button>
												</div>
											</div>
										</div>
									</form>
								</div>
								

								<!-- Residential Address -->
								<div id="residential-address" class="tab-pane fade">
									<form id="residential-address-form">
									    <div class="col-lg-6">
											<div class="inputFormMain">
												<label>Province</label>
												<select data-plugin="select_hrm" name="residential_province" id="residential-province" class="form-control province" data-toggle="tooltip" title="Province" type="residential" >
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
												<label>District</label>
												<select data-plugin="select_hrm" name="residential_district" id="residential-district" class="form-control district" data-toggle="tooltip" title="District" type="residential" >
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
												<label>Tehsil</label>
												<select data-plugin="select_hrm" name="residential_tehsil" id="residential-tehsil" class="form-control tehsil" data-toggle="tooltip" title="Tehsil" type="residential" >
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
												<label>Union Council</label>
												<select data-plugin="select_hrm" name="residential_uc" id="residential-uc" class="form-control union-council" data-toggle="tooltip" title="Union council" type="residential" >
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
												<label>Address</label>
												<input type="text" name="residential_address" value="<?= $basic_info->resident_address_details; ?>" id="residential-address" class="form-control" placeholder="Current address"  data-toggle="tooltip" title="residential address" >
											</div>
										</div>
										<div class="col-lg-12">
											<div class="submitBtn">
												<button type="submit" class="btn btnSubmit" disabled>Update</button>		
											</div>
										</div>
									</form>
								</div>

								<!-- Permanent Address -->
								<div id="permanent-address" class="tab-pane fade">

								    <form id="permanent-address-form">
									    <div class="col-lg-6">
											<div class="inputFormMain">
												<label>Province</label>
												<select data-plugin="select_hrm" name="permanent_province" id="permanent-province" class="form-control province" data-toggle="tooltip" title="Province" type="permanent" >
													<option value="">Select Province</option>
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
												<label>District</label>
												<select data-plugin="select_hrm" name="permanent_district" id="permanent-district" class="form-control district" data-toggle="tooltip" title="District" type="permanent" >
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
												<label>Tehsil</label>
												<select data-plugin="select_hrm" name="permanent_tehsil" id="permanent-tehsil" class="form-control tehsil" data-toggle="tooltip" title="Tehsil" type="permanent"  >
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
												<label>Union Council</label>
												<select data-plugin="select_hrm" name="permanent_uc" id="permanent-uc" class="form-control union-council" data-toggle="tooltip" title="Union council" type="permanent"  >
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
												<label>Address</label>
												<input type="text" name="permanent_address" value="<?= $basic_info->permanent_address_details; ?>" id="permanent-address" class="form-control" placeholder="Permanent address"  data-toggle="tooltip" title="Permanent address"  >
											</div>
										</div>

										<div class="col-lg-12">
											<div class="submitBtn">
												<button type="submit" class="btn btnSubmit" disabled>Update</button>		
											</div>
										</div>
									</form>
								</div>
								
								<!-- Educational Qualification -->
								<div id="educational-qualification" class="tab-pane fade">
									<form id="educational-qualification-form">
									<div class="col-lg-6">
										<div class="inputFormMain">
											<label>Qualification</label>
											<select data-plugin="select_hrm" name="qualification" id="qualification" class="form-control" data-toggle="tooltip" title="Qualification"  >
												<option value="">Select Qualification</option>
												<?php foreach($qualification as $q): ?>
												<option value="<?= $q->id; ?>"><?= $q->name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="inputFormMain">
											<label>Institute name</label>
											<input type="text" name="institute_name" value="" id="institute-name" class="form-control" placeholder="University/ Institute"  data-toggle="tooltip" title="University/ Institute"  >
										</div>
									</div>
									<div class="col-lg-6">
										<div class="inputFormMain">
											<label>Discipline</label>
											<select data-plugin="select_hrm" name="discipline" id="discipline" class="form-control" data-toggle="tooltip" title="Descipline"  >
												<option value="">Select Descipline</option>
												<?php foreach($discipline as $d): ?>
												<option value="<?= $d->discipline_id; ?>"><?= $d->discipline_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-lg-3">
										<div class="inputFormMain">
											<label>From date</label>
											<input type="text" name="from" value="" id="qFromDate" class="form-control date" placeholder="From Date"  data-toggle="tooltip" title="From Date"  >
										</div>
									</div>
									<div class="col-lg-3">
										<div class="inputFormMain">
											<label>To date</label>
											<input type="text" name="to" value="" id="qToDate" class="form-control date" placeholder="To Date"  data-toggle="tooltip" title="To Date"  >
										</div>
									</div>
									<div class="col-lg-12">
										<div class="submitBtn">
											<button type="submit" class="btn btnSubmit" disabled>Save</button>		
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
													<th>From</th>
													<th>To</th>
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
												<label>Company</label>
												<input type="text" name="company" value="" id="company" class="form-control" placeholder="Company name"  data-toggle="tooltip" title="Company name"  >
											</div>
										</div>
										<div class="col-lg-6">
											<div class="inputFormMain">
												<label>Designation</label>
												<input type="text" name="designation" value="" id="designation" class="form-control" placeholder="Designation"  data-toggle="tooltip" title="Designation"  >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="inputFormMain">
												<label>From date</label>
												<input type="text" name="from_date" value="" id="from-date" class="form-control date" placeholder="From date"  data-toggle="tooltip" title="From date"  >
											</div>
										</div>
										<div class="col-lg-3">
											<div class="inputFormMain">
												<label>To date</label>
												<input type="text" name="to_date" value="" id="to-date" class="form-control date" placeholder="To date"  data-toggle="tooltip" title="To date"  >
											</div>
										</div>
										<div class="col-lg-12">
											<div class="inputFormMain">
												<label>Description</label>
												<textarea name="description" id="description" class="form-control" rows="3" placeholder="Description" ></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="submitBtn">
												<button type="submit" class="btn btnSubmit" disabled>Save</button>		
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
											<label>Bank name</label>
											<select data-plugin="select_hrm" name="bank" id="bank" class="form-control select2" data-toggle="tooltip" title="Bank name"  >
												<option value="">Select bank name</option>
												<?php foreach($bank as $b): ?>
												<option value="<?= $b->bank_id; ?>"><?= $b->bank_name; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="inputFormMain">
											<label>Account title</label>
											<input type="text" name="account_title" value="" id="account-title" class="form-control" placeholder="Account title"  data-toggle="tooltip" title="Account title"  >
										</div>
									</div>
									<div class="col-lg-4">
										<div class="inputFormMain">
											<label>Account</label>
											<input type="text" name="account" value="" id="account" class="form-control" placeholder="Account #"  data-toggle="tooltip" title="Account #"  >
										</div>
									</div>
									<div class="col-lg-4">
										<div class="inputFormMain">
											<label>Branch code</label>
											<input type="text" name="branch_code" value="" id="branch-code" class="form-control" placeholder="Branch code"  data-toggle="tooltip" title="Branch code"  >
										</div>
									</div>
									<div class="col-lg-12">
										<div class="submitBtn">
											<button type="submit" class="btn btnSubmit" disabled>Save</button>		
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
									<div class="col-lg-12">
										<div class="col-lg-3">
											<strong>Supervisor Name</strong>
										</div>
										<div class="col-lg-8">
											<?= (isset($supervisor_detail->emp_name)) ? $supervisor_detail->emp_name : ""; ?>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="col-lg-3">
											<strong>Designation</strong>
										</div>
										<div class="col-lg-8">
											<?= (isset($supervisor_detail->designation_name)) ? $supervisor_detail->designation_name : ""; ?>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="col-lg-3">
											<strong>Contact</strong>
										</div>
										<div class="col-lg-8">
											<?= (isset($supervisor_detail->contact_number)) ? $supervisor_detail->contact_number : ""; ?>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="col-lg-3">
											<strong>District</strong>
										</div>
										<div class="col-lg-8">
											<?= (isset($supervisor_detail->district)) ? $supervisor_detail->district : ""; ?>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="col-lg-3">
											<strong>Tehsil</strong>
										</div>
										<div class="col-lg-8">
											<?= (isset($supervisor_detail->tehsil)) ? $supervisor_detail->tehsil : ""; ?>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="col-lg-3">
											<strong>Union Council</strong>
										</div>
										<div class="col-lg-8">
											<?= (isset($supervisor_detail->union_concil)) ? $supervisor_detail->union_concil : ""; ?>
										</div>
									</div>
								</div>

								<!-- Salary Detail -->
								<div id="salary-detail" class="tab-pane fade">

									<div class="col-lg-12">
										<div class="col-lg-2">
											<strong>Basic Salary</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->basic_salary)) ? $salary->basic_salary : 0; ?>
										</div>
									
										<div class="col-lg-2">
											<strong>Gross Salary</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->gross_salary)) ? $salary->gross_salary : 0; ?>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="col-lg-2">
											<strong>Security Deposit</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->security_deposit)) ? $salary->security_deposit : 0; ?>
										</div>
									
										<div class="col-lg-2">
											<strong>Net Salary</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->net_salary)) ? $salary->net_salary : 0; ?>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="col-lg-2">
											<strong>House Rent Allowance</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->house_rent_allowance)) ? $salary->house_rent_allowance : 0; ?>
										</div>
									
										<div class="col-lg-2">
											<strong>Travel Allowance</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->travelling_allowance)) ? $salary->travelling_allowance : 0; ?>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="col-lg-2">
											<strong>Medical Allowance</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->medical_allowance)) ? $salary->medical_allowance : 0; ?>
										</div>
									
										<div class="col-lg-2">
											<strong>Provident Fund</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->provident_fund)) ? $salary->provident_fund : 0; ?>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="col-lg-2">
											<strong>EOBI</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->eobi)) ? $salary->eobi : 0; ?>
										</div>
									
										<div class="col-lg-2">
											<strong>Tax Deduction</strong>
										</div>
										<div class="col-lg-4">
											<?= (isset($salary->tax_deduction)) ? $salary->tax_deduction : 0; ?>
										</div>
									</div>
								</div>

								<!-- Contract -->
								<div id="contract" class="tab-pane fade">
									
									<?php if(!empty($contract_detail[0])): ?>
									<div class="col-lg-10 col-lg-offset-1" style="border: 1px solid gray; padding: 15px;">
										<p>
											<?= $contract_detail[0]->long_description; ?>
										</p>
									</div>
									<div class="col-lg-12 col-lg-offset-1" style="padding-left: 0px; padding-top: 15px;">
										<div class="submitBtn">
											<button type="button" class="btn btnSubmit" disabled id="print-contract"><i class="fa fa-print"></i> Print</button>
										</div>
									</div>
									<?php endif; ?>
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