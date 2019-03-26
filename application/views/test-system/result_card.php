<?php 
/* Filename: result_card.php
*  Author: Saddam
*  Location: Views / test-system / result_card.php
*/
?>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="jumbotron" style="background-color: lightblue; box-shadow: 10px 15px 5px 9px;">
			<div class="row">
				<div class="col-md-1"></div>
				<h2 style="text-align: center;">Applicant's result card !<br><small>Count the serial numbers, all the answers displayed here are correct answers. The numbers colored RED are the marks you've obtained in the test you've just attempted!</small></h2><hr>

				<?php $counter = 1; foreach($calc_result as $result): ?>
					<p><strong style="font-weight: bold; color: red; font-size: 25px;"><?php echo $counter++; ?></strong> <strong><?php echo $result->ans_name; ?></strong> | Correct Answer!</p>
				<?php endforeach; ?>
				<div class="col-md-11">
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