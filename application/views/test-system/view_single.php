<?php
/* Filename: view_single.php
*  Location: views/test-system/view_single.php
*  Author: Saddam
*/
?>

<div class="container">
	<div class="row">
		<div class="col-md-5">
			<h2>Question with possible answers.</h2><hr>
			<small>The question will look like this to the applicant / candidate while taking exam / test.</small>
		</div>
		<div class="col-md-7">
			<h2>Question</h2>
			<small>Select the most appropriate option of the following!</small><hr>
			<?php $count = 'A';
			foreach($view_one as $one) : // Took the foreach here to hide the error. ?>
				<p class="lead"><?php echo $one['ques_id']; ?>. <?php echo $one['ques']; ?></p>
				<?php foreach($view_one as $one_ques): ?>
			<strong>
			<?php echo "<strong>" . $count++ . " - " . "</strong>" ; ?>
				<input type="checkbox" name="option" value="<?php echo $one_ques['ans_status']; ?>"> <?php echo $one_ques['ans_name']; ?>
			</strong><hr>
			<?php endforeach; break; ?>
			<?php endforeach; ?>
			<button type="submit" class="btn btn-info">Next &raquo;</button>
			<a class="btn btn-warning" href="<?php echo base_url('tests/all_questions'); ?>">&raquo; Back</a>
		</div>
	</div>
</div>