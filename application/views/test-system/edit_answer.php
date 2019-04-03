<?php 
/* 
* Filename: edit_answer.php
* Author: Saddam
* Location: Views / test-system / edit_answer.php
*/
?>
<?php //echo $answers_edit['ans_id'] . "|" . $answers_edit['q_id'] . "|". $answers_edit['ans_name'] ; ?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h1>Modify the Answer</h1><hr>
			<small>You can modify the answer here, you can see the question ID here, and this answer is allocated to that specfic question.</small>
		</div>
		<div class="col-md-6">
			<h1>Here's the Form, make your changes here.</h1><hr>
			<small>All you have to do is to make changes according to your needs and save the data, it'll be updated in the database and also on the front end to the user. Be careful while updating records.</small><br><br>
			<form action="<?php echo base_url('tests/update_answer'); ?>" method="post">
				<input type="hidden" name="answer_id" value="<?php echo $answers_edit['ans_id']; ?>">
				<div class="form-group">
					<label for="question_id">Question ID</label>
					<input type="text" name="question_id" class="form-control" value="<?php echo $answers_edit['q_id']; ?>">
				</div>
				<div class="form-group">
					<label for="answer">Answer</label>
					<input type="text" name="answer" class="form-control" value="<?php echo $answers_edit['ans_name'] ?>">
				</div>
				<div class="form-group">
					<label for="status">Status | 1 - Correct , 0 - Incorrect.</label>
					<input type="text" name="status" class="form-control" value="<?php echo $answers_edit['status']; ?>">
					<small>Status respresents whether the answer is correct or incorrect. 1 represents the correct answer whereas 0 incorrect!</small>
				</div>
				<input type="submit" name="submit" class="btn btn-primary" value="Save Changes" onclick="javascript:return confirm('Are you sure to save changes?');">
				<a href="<?php echo base_url('tests/all_questions'); ?>" class="btn btn-warning">Cancel</a>
			</form>
		</div>
	</div>
</div>