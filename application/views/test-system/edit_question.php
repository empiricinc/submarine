<?php 
/*  Filename : edit_question.php
*	Author: Saddam
*	Location : views / test-system / edit_question.php 
*/
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h2>Update Questions!</h2>
			<small>Rewrite the question and click the update button to change it!</small>
		</div>
		<div class="col-md-7">
			<h2>Update the question!</h2>
			<form action="<?php echo base_url('tests/update_question'); ?>" method="post">
			  <div class="form-group">
			  	<input type="hidden" name="que_id" value="<?php echo $edit['id']; ?>">
			    <label for="question">Type Question here:</label>
			    <textarea name="question" class="form-control" rows="12" id="question" placeholder="Type your question here and save it..." required="required"><?php echo $edit['question']; ?></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Update Question</button>
			  <a href="<?php echo base_url('tests/all_questions'); ?>" class="btn btn-warning">Cancel</a>
			</form>
		</div>
	</div>
</div>