<?php 
/*  Filename : edit_answer.php
*	Author: Saddam
*	Location : views / test-system / edit_answer.php
*/
?>
<section class="secFormLayout">
	<div class="mainInputBg">
		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3>modify/update answer</h3>
				</div>
			</div>
			<form action="<?php echo base_url('tests/update_answer'); ?>" method="post">
				<input type="hidden" name="answer_id" value="<?php echo $answers_edit['ans_id']; ?>">
				<div class="col-lg-4">
					<div class="inputFormMain">
						<label for="que_id">Question ID</label>
						<input type="text" name="question_id" class="form-control" value="<?php echo $answers_edit['q_id']; ?>">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="inputFormMain">
						<label for="ans_text">Answer Text</label>
						<input type="text" name="answer" class="form-control" value="<?php echo $answers_edit['ans_name']; ?>">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="inputFormMain">
						<label for="status">Status | 1-Correct, 0-Incorrect</label>
						<input type="text" name="status" class="form-control" value="<?php echo $answers_edit['status']; ?>">
						<small>Status respresents whether the answer is correct or incorrect. 1 represents the correct answer whereas 0 incorrect!</small>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="submitBtn">
						<button type="submit" class="btn btnSubmit" onclick="javascript: return confirm('Are you sure to update this ?');">Save Changes</button>
						<a href="<?php echo base_url(); ?>tests/view_single/<?php echo $answers_edit['q_id']; ?>" class="btn btnSubmit">Cancel</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>