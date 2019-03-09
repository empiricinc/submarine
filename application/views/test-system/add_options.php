<?php 
/* Filename: add_options.php
*  Author: Saddam
*  Location: Views/test-system/add_options.php
*/
?>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h2>Add Possible Answers.</h2>
			<small>Here you can add possible answers/options for the question!</small>
		</div>
		<div class="col-md-8">
			<form action="<?php echo base_url('tests/add_options/'); ?><?php echo $addopt['id']; ?>" method="post">
			  <div class="form-group">
			    <label for="question">Add possible answers for this question:</label>
			    <textarea name="question" class="form-control" rows="12" id="question" required="required"><?php echo $addopt['question']; ?></textarea>
			  </div>
			  <div class="row">
			  	<div class="col-md-3">
			  	<input type="text" id="option1" name="option1" placeholder="1. Write option..." class="form-control input-sm">
			  	<input type="checkbox" name="select"> Mark as Correct
			  </div>
			  <div class="col-md-3">
			  	<input type="text" id="option2" name="option2" placeholder="2. Write option..." class="form-control input-sm">
			  	<input type="checkbox" name="select"> Mark as Correct
			  </div>
			  <div class="col-md-3">
			  	<input type="text" id="option3" name="option3" placeholder="3. Write option..." class="form-control input-sm">
			  	<input type="checkbox" name="select"> Mark as Correct
			  </div>
			  <div class="col-md-3">
			  	<input type="text" id="option4" name="option4" placeholder="4. Write option..." class="form-control input-sm">
			  	<input type="checkbox" name="select"> Mark as Correct
			  </div>
			  </div><hr>
			  <button type="submit" class="btn btn-primary btn-sm"> Save</button>
			  <a class="btn btn-warning btn-sm" href="<?php echo base_url('tests/all_questions'); ?>">Cancel</a>
			</form>
		</div>
	</div>
</div>