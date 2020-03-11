<?php
/*
* Filename: fcm_interview_form.php
* Filepath: views/interviews/fcm_interview_form.php
* Author: Saddam
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading text-center">
						<h3>CHIP TRAINING & CONSULTING (Pvt) Ltd</h3>
						<strong>Interview assessment sheet for FCW/CHW</strong>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('interview/fcm_interview'); ?>">
					<input type="hidden" name="rollnumber" value="<?php echo $this->uri->segment(3); ?>">
					<div class="col-md-3">
						<label>Candidate's ID</label>
					</div>
					<div class="col-md-9">
						<div class="inputFormMain">
							<input type="text" name="applicant_rollnumber" class="form-control" placeholder="Applicant's roll number" id='rollnumber' style="color: #aeafaf;" required="required" value="<?php echo $applicant_detail->rollnumber; ?>" readonly>
						</div>
					</div>
					<div class="col-md-3">
						<label>Candidate's Name</label>
					</div>
					<div class="col-md-9">
						<div class="inputFormMain">
							<input type="text" name="applicant_name" class="form-control" id="applicant_name" style="color: #aeafaf;" value="<?php echo $applicant_detail->fullname; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label>CNIC #</label>
					</div>
					<div class="col-md-5">
						<div class="inputFormMain">
							<input type="text" name="applicant_cnic" class="form-control" id="applicant_name" style="color: #aeafaf;" value="<?php echo $applicant_detail->cnic; ?>">
						</div>
					</div>
					<div class="col-md-1">
						<label>Tribe</label>
					</div>
					<div class="col-md-3">
						<div class="inputFormMain">
							<input type="text" name="tribe" class="form-control" style="color: #aeafaf">
						</div>
					</div>
					<div class="col-md-3">
						<label>Position applied for</label>
					</div>
					<div class="col-lg-9">
						<div class="inputFormMain">
							<input type="text" name="applicant_designation" class="form-control" id="designation" style="color: #aeafaf;" value="<?php echo $applicant_detail->designation_name; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label>District / Uncion Council / Area / Code</label>
					</div>
					<div class="col-lg-9">
						<div class="inputFormMain">
							<input type="text" name="applicant_code" class="form-control" id="designation" style="color: #aeafaf;" value="<?php echo $applicant_detail->cityName; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label>Date of Interview</label>
					</div>
					<div class="col-lg-9">
						<div class="inputFormMain">
							<input type="text" name="interview_date" class="form-control" id="designation" style="color: #aeafaf;" value="<?php echo date('d/m/Y', strtotime($applicant_detail->interview_date)); ?>">
						</div>
					</div>
					<div class="row"></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Areas of Assessment</th>
												<th>Points of Importance</th>
												<th>Max Marks</th>
												<th>Marks Awarded</th>
												<th>Remarks, if any</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Age / D.O.B</td>
												<td>Below 25 Years=0,25-35 years=5,above 35-10</td>
												<td>10</td>
												<td>
													<input type="text" name="dob_marks" class="form-control marks marks_10" required="">
												</td>
												<td><input type="text" name="dob_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Marital Status</td>
												<td>Married, Widow, Divorce=5, Single above 30 years=3, Young single=2</td>
												<td>5</td>
												<td>
													<input type="text" name="marital_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="marital_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Qualification</td>
												<td>Literate=5, Matric=10, Illiterate=0</td>
												<td>10</td>
												<td>
													<input type="text" name="qual_marks" class="form-control  marks marks_10" required="">
												</td>
												<td><input type="text" name="qual_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Experience/ Professional affiliation</td>
												<td>Working experience upto 5 years in Polio program=5, Midwife, LHW, Health program related experience etc=5</td>
												<td>10</td>
												<td>
													<input type="text" name="exp_marks" class="form-control marks marks_10" required="">
												</td>
												<td><input type="text" name="exp_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Communication skills</td>
												<td>As per question</td>
												<td>5</td>
												<td>
													<input type="text" name="comm_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="comm_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Mobility</td>
												<td>As per question</td>
												<td>5</td>
												<td>
													<input type="text" name="mob_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="mob_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Local language skills</td>
												<td>As per question</td>
												<td>5</td>
												<td>
													<input type="text" name="lang_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="lang_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td><strong>Total Score</strong></td>
												<td></td>
												<td><strong>50</strong></td>
												<td><input type="text" name="total_marks" class="form-control" readonly="" id="total"></td>
												<td></td>
											</tr>
											<tr><td colspan="5"></td></tr>
											<tr>
												<td>Overall Remarks</td>
												<td colspan="4">
													<textarea name="overall_remarks" class="form-control" rows="3"></textarea>
												</td>
											</tr>
											<tr>
												<td>Interviewer's Signature</td>
												<td colspan="4"><input type="text" name="int_sign" class="form-control"></td>
											</tr>
											<tr>
												<td>Interviewer's Name</td>
												<td colspan="4"><input type="text" name="int_name" class="form-control"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Submit</button>
							<button type="reset" class="btn btnSubmit">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('.marks').keyup(function(){
			var sum = 0;
			$('.marks').each(function(){
				sum += Number($(this).val());
			});
			$('#total').val(sum);
		});
	});

	// Restrict user from entering marks greater than 10.
	$('.marks_10').keyup(function(){
	    if(parseInt($(this).val()) > 10){
	        alert("Value can't be greater than 10.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less than 1.");
	        $(this).val('');
	    }else{
	    	$('#span_10').html('');
	    }
	});
	// Restrict user from entering marks greater than 5.
	$('.marks_5').keyup(function(){
	    if(parseInt($(this).val()) > 5){
	        alert("Value can't be greater than 5.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less than 1.");
	        $(this).val('');
	    }else{
	    	$('#span_5').html('');
	    }
	});
</script>