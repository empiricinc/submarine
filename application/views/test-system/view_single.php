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
			<small>Select the most appropriate option of the following. If you think there are two matches in the list then you can select 2 of them!</small><hr>
			<?php $count = 'A'; // Print alphabets before the options for each question.
			foreach($view_one as $one) : // Took the foreach here to hide the error. ?>
				<p class="lead" style="font-weight: bold;"><?php echo $one['ques_id']; ?>. <?php echo $one['ques']; ?></p>
				<?php foreach($view_one as $one_ques): // Use nested foreach loop to print the data of another DB table and break to display just one record out of the 4 records with same ID. ?>
			<div class="row">
				<div class="col-md-4">
					<?php echo "<strong>" . $count++ . " - " . "</strong>" ; ?>
					<?php echo $one_ques['ans_name']; ?><br>
				</div>
				<div class="col-md-8">
					<a href="<?php echo base_url('tests/edit_answer/'); ?><?php echo $one_ques['ans_id']; ?>" class="btn btn-primary">Edit</a>
					<a href="<?php echo base_url('tests/delete_answer'); ?><?php echo $one_ques['ans_id']; ?>" class="btn btn-danger" onclick="javascript: return confirm('Are you sure to delete this ?');">Delete</a>
				</div>
			</div><hr>
			<?php endforeach; break; // END and BREAK the second "foreach". ?>
			<?php endforeach; // END the first "foreach loop". ?>
			<a class="btn btn-primary" href="<?php echo base_url('tests/all_questions'); ?>">Move &raquo;</a>
			<a class="btn btn-warning" href="<?php echo base_url('tests/all_questions'); ?>">Back &laquo;</a>
		</div>
	</div>
</div>