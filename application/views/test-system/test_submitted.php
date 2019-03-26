<?php 
/* Filename: test_submitted.php
*  Author: Saddam
*  Location: Views / test-system / test_submitted.php
*/
?>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="jumbotron" style="background-color: lightblue; box-shadow: 10px 15px 5px 9px;">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-11">
					<h2 style="text-align: center;">Good Job!</h2>
					<p style="text-align: center;">You have successfully attempted and submitted your test for the position as an employee at CHIP Training & Consulting. You can perform some actions by cliking the buttons below.</p><hr>
					<?php if($success = $this->session->flashdata('success')): ?>
						<div class="alert alert-success">
							<p style="text-align: center;"><?php echo $success; ?></p>
						</div>
					<?php endif; ?>
					<a href="<?php echo base_url('tests/applicant_result'); ?>" class="btn btn-info">Review Your Result &raquo;</a>
					<a href="<?php echo base_url('tests/applicant_paper'); ?>" class="btn btn-warning">Review Your Paper &raquo;</a>
					<a href="http://www.ctc.org.pk" target="_blank" class="btn btn-danger">Visit Our Site &raquo;</a>
					<a href="http://www.ctc.org.pk/business-opportunities/jobs/" target="_blank" class="btn btn-info">Review Job Criteria &raquo;</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>