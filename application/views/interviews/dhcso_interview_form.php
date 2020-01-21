<?php
/*
* Filename: fcm_interview_form.php
* Filepath: views/interviews/fcm_interview_form.php
* Author: Saddam
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg" id="printThis">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading text-center">
						<h3>CHIP TRAINING & CONSULTING (Pvt) Ltd</h3>
						<strong>Interview assessment sheet for DHCSO</strong>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('interview/dhcso_interview'); ?>">
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
												<th>Guidig Points</th>
												<th>Marking Criteria</th>
												<th>Max Marks</th>
												<th>Marks Awarded</th>
												<th>Remarks, if any</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Personality</td>
												<td>Appearance, Dressing</td>
												<td>Interviewer should assess whether s/he properly dress up for the interview=2, Not=0</td>
												<td>2</td>
												<td>
													<input type="text" name="per_marks" class="form-control marks marks_2" required="">
												</td>
												<td><input type="text" name="per_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Conduct during interview</td>
												<td>General conduct/Commnunication with coordinators and penal members</td>
												<td>Satisfactory=3, Normal=1, Poor=0</td>
												<td>3</td>
												<td>
													<input type="text" name="con_marks" class="form-control marks marks_3" required="">
												</td>
												<td><input type="text" name="con_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Qualification</td>
												<td>Relevant qualification as per TORs or Master level qualification however not</td>
												<td>Relevant Qualification= 5, Not Relevat= 2</td>
												<td>5</td>
												<td>
													<input type="text" name="qual_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="qual_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Experience</td>
												<td>Relevant Experience as per TORs and general experience</td>
												<td>One mark per year for relevant experience while for general experience not relevant to the position total marks will be max.2</td>
												<td>5</td>
												<td>
													<input type="text" name="exp_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="exp_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Job Competence Assessment</td>
												<td>Competence assessment through scnario based questions taken from TORs</td>
												<td>Ask 5 scenario based questions relevant to the position, (2 marks each * 5 questions)</td>
												<td>10</td>
												<td>
													<input type="text" name="comp_marks" class="form-control marks marks_10" required="">
												</td>
												<td><input type="text" name="comp_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Job Knowledge</td>
												<td>Knowledge of the position and ToRs s/he has applied for</td>
												<td>Ask three questions on the job position and ToRs (2 marks each * 3 questions)</td>
												<td>6</td>
												<td>
													<input type="text" name="job_marks" class="form-control marks marks_6" required="">
												</td>
												<td><input type="text" name="job_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Computer proficiency</td>
												<td>Competence assessment through scenario based questions taken from ToRs</td>
												<td>Ask three scenario based questions relevant to the position, (2 marks for each * 3 questions)</td>
												<td>6</td>
												<td>
													<input type="text" name="prof_marks" class="form-control marks marks_6" required="">
												</td>
												<td><input type="text" name="prof_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Personal Attributes</td>
												<td>Competencies (integrity, ambition, initiative, learning aptitude)</td>
												<td>As per panel members judgement</td>
												<td>5</td>
												<td>
													<input type="text" name="attrib_marks" class="form-control marks marks_5" required="">
												</td>
												<td><input type="text" name="attrib_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td>Commnunication Skills</td>
												<td>Effectively expressing and conveyig ideas in response to questions</td>
												<td>Ask questions on strength and weaknesses & mark accordingly</td>
												<td>8</td>
												<td>
													<input type="text" name="comm_marks" class="form-control marks marks_8" required="">
												</td>
												<td><input type="text" name="comm_remarks" class="form-control"></td>
											</tr>
											<tr>
												<td><strong>Total Score</strong></td>
												<td colspan="2"></td>
												<td><strong>50</strong></td>
												<td><input type="text" name="total_marks" class="form-control" readonly="" id="total"></td>
												<td></td>
											</tr>
											<tr><td colspan="6"></td></tr>
											<tr>
												<td>Overall Remarks</td>
												<td colspan="5">
													<textarea name="overall_remarks" class="form-control" rows="3"></textarea>
												</td>
											</tr>
											<tr>
												<td>Interviewer's Signature</td>
												<td colspan="5"><input type="text" name="int_sign" class="form-control"></td>
											</tr>
											<tr>
												<td>Interviewer's Name</td>
												<td colspan="5"><input type="text" name="int_name" class="form-control"></td>
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
							<a href="<?php echo base_url("interview/print_sheet_dhcso/{$applicant_detail->rollnumber}"); ?>" class="btn btnSubmit">PDF</a>
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
	$('.marks_2').keyup(function(){
	    if(parseInt($(this).val()) > 2){
	        alert("Value can't be greater than 2.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less than 1.");
	        $(this).val('');
	    }else{
	    	$('#span_2').html('');
	    }
	});

	$('.marks_3').keyup(function(){
	    if(parseInt($(this).val()) > 3){
	        alert("Value can't be greater than 3.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less 1.");
	        $(this).val('');
	    }else{
	    	$('#span_3').html('');
	    }
	});
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

	$('.marks_10').keyup(function(){
	    if(parseInt($(this).val()) > 10){
	        alert("Hey, don't you understand? You can not enter value greater than the total marks.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less than 1.");
	        $(this).val('');
	    }else{
	    	$('#span_10').html('');
	    }
	});

	$('.marks_6').keyup(function(){
	    if(parseInt($(this).val()) > 6){
	        alert("Hey, can't you see the total marks on the left ? It's 6, and you can't enter more than that.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less than 1.");
	        $(this).val('');
	    }else{
	    	$('#span_6').html('');
	    }
	});

	$('.marks_8').keyup(function(){
	    if(parseInt($(this).val()) > 8){
	        alert("What did I tell you ? You can't enter value greater than the total marks.");
	        $(this).val('');
	    }else if(parseInt($(this).val()) < 1){
	    	alert("Value can't be less than 1.");
	        $(this).val('');
	    }else{
	    	$('#span_8').html('');
	    }
	});
</script>
<script type="text/javascript">
	function printDiv(printThis){
    var content = document.getElementById('printThis').innerHTML;
    var win = window.open();
    win.document.write(content);
    win.document.body.style.fontFamily="book antiqua";  
    // win.document.body.status.fontSize="14px";
    win.print();
    win.close();
  }
</script>