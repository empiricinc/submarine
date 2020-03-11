<?php
/*
* Filename: sm_interview_form.php
* Filepath: views/interviews/sm_interview_form.php
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
						<strong>Interview assessment sheet for SM/UCCSO</strong>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('interview/sm_interview'); ?>">
					<input type="hidden" name="rollnumber" value="<?php echo $this->uri->segment(3); ?>">
					<div class="col-md-3">
						<label>Candidate's Name</label>
					</div>
					<div class="col-md-9">
						<div class="inputFormMain">
							<input type="text" name="applicant_name" class="form-control" id="applicant_name" style="color: #aeafaf;" value="<?php echo $applicant_detail->fullname; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label>Position</label>
					</div>
					<div class="col-lg-9">
						<div class="inputFormMain">
							<input type="text" name="applicant_designation" class="form-control" id="designation" style="color: #aeafaf;" value="<?php echo $applicant_detail->designation_name; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label>Uncion Council / Area / Code</label>
					</div>
					<div class="col-lg-9">
						<div class="inputFormMain">
							<input type="text" name="applicant_code" class="form-control" id="designation" style="color: #aeafaf;" value="<?php //echo $applicant_detail->designation_name; ?>">
						</div>
					</div>
					<div class="col-md-3">
						<label>Location: District / Agency</label>
					</div>
					<div class="col-lg-9">
						<div class="inputFormMain">
							<input type="text" name="applicant_location" class="form-control" id="designation" style="color: #aeafaf;" value="<?php //echo $applicant_detail->designation_name; ?>">
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
												<td>Personality</td>
												<td>Appearance, Dress, Manner of Conducting Him/Herself</td>
												<td>5</td>
												<td>
													<input type="text" name="per_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="per_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Qualification</td>
												<td>Relevance to Position</td>
												<td>5</td>
												<td>
													<input type="text" name="qual_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="qual_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Experience</td>
												<td>Relevance to Position</td>
												<td>5</td>
												<td>
													<input type="text" name="exp_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="exp_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Job Knowledge</td>
												<td>Knowledge of Job Contents, development world</td>
												<td>10</td>
												<td>
													<input type="text" name="job_marks" class="form-control marks marks_10" required="">
												</td>
												<td><input type="text" name="job_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Personal Attributes/Supervisory Skills</td>
												<td>Competencies (integrity, ambition, leadership, initiative, layalty, learning, resourceful)</td>
												<td>10</td>
												<td>
													<input type="text" name="sup_marks" class="form-control marks marks_10" required="">
												</td>
												<td><input type="text" name="sup_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Reporting & Computer Skills</td>
												<td>As per question</td>
												<td>5</td>
												<td>
													<input type="text" name="rep_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="rep_remarks" class="form-control"></td>
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
												<td>Communication Skills</td>
												<td>As per question</td>
												<td>5</td>
												<td>
													<input type="text" name="comm_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="comm_remarks" class="form-control"></td>
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
											<tr><td colspan="5"></td></tr>
											<tr>
												<td colspan="5">
													<small>*Max Marks to be assigned to each areas of assessment must be decided by the interview panel, in light of the vacancy to be filled, before the start of the interview exercise, the total marks for all areas must add up 50.</small>
												</td>
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
	// Restrict user from entering marks greater than total marks.
	$('.marks_5').keyup(function(){
	    if(parseInt($(this).val()) > 5){
	        alert("Value can't be greater than 5.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less than 1.");
	        $(this).val('');
	    }else{
	    	$('#span_2').html('');
	    }
	});

	// Restrict user from entering marks greater than total marks.
	$('.marks_10').keyup(function(){
	    if(parseInt($(this).val()) > 10){
	        alert("Value can't be greater than 10.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less than 1.");
	        $(this).val('');
	    }else{
	    	$('#span_2').html('');
	    }
	});
</script>