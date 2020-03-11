<?php
/*
* Filename: interview_marks.php
* Filepath: views/interviews/interview_marks.php
* Author: Saddam
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3>add interview marks <span style="text-transform: lowercase;">(fill out the form below and hit the submit button)</span></h3>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('interview/save_marks'); ?>">
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="applicant_rollnumber" class="form-control" placeholder="Applicant's roll number" id='rollnumber' style="color: #aeafaf;" required="required" value="<?php echo set_value('applicant_rollnumber'); ?>">
							<span style="color: red;"><?php echo form_error('applicant_rollnumber'); ?></span>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="applicant_name" class="form-control" placeholder="Applicant's name" id="applicant_name" style="color: #aeafaf;" readonly="">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="applicant_project" class="form-control" placeholder="Applicant's Project" id="project" style="color: #aeafaf;" readonly="">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="applicant_designation" class="form-control" placeholder="Applicant's Designation" id="designation" style="color: #aeafaf;" readonly="">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="marks_obtained" class="form-control" placeholder="Marks Obtained" style="color: #aeafaf;" required="required" value="<?php echo set_value('marks_obtained'); ?>">
							<span style="color: red;"><?php echo form_error('marks_obtained'); ?></span>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="total_marks" class="form-control" placeholder="Total Marks" style="color: #aeafaf;" required="required" value="<?php echo set_value('total_marks'); ?>">
							<span style="color: red;"><?php echo form_error('total_marks'); ?></span>
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
		$('#rollnumber').on('change', function(){
			var rollnumber = $('#rollnumber').val();
			$.ajax({
				url: '<?php echo base_url(); ?>interview/get_rollnumber/' + rollnumber,
				method: 'POST',
				dataType: 'JSON',
				data: {rollnumber: rollnumber},
				success: function(data){
					console.log(data);
					if(data){
						$('#applicant_name').val(data.fullname);
						$('#project').val(data.name);
						$('#designation').val(data.designation_name);
					}else{
						$('#applicant_name').val('');
						$('#project').val('');
						$('#designation').val('');
					}
				}
			});
		});
	});
</script>