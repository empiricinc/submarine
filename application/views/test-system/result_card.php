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
				<div class="col-md-11">
					<h2 style="text-align: center;">Applicant's result card !</h2>
					<p style="text-align: center;">Here's your result, take a look at.</p>
					<hr>
					<?php $counter = 0; foreach($calc_result as $result): ?>
						<p><strong style="font-weight: bold; color: red; font-size: 25px;"><?php ++$counter; ?></strong> <strong><?php //echo $result->ans_name; ?></strong></p>
					<?php endforeach; ?>
					<?php if($counter > 6): // If an applicant scored more than 6, will be passed. ?>
						<h2 style="text-align: center; color: green;">Your score is: <strong style="font-size: 2em;"><?php echo $counter; ?></strong>
						</h2><br>
					<?php else: // If an applicant scored less than 6, will be failed. ?>
						<h2 style="text-align: center; color: red;">Your score is: <strong style="font-size: 2em;"><?php echo $counter; ?></strong>
						</h2><br>
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