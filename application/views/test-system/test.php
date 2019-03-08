<!--Filename : test.php
	Author: Saddam
	Location : views / test-system
 -->

<div class="container">
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<h2>Upload Questions!</h2>
			<small>Write question in the input field and click the save button!</small>
		</div>
		<div class="col-md-7">
			<h2>Fill out the form below!</h2>
			<form action="<?php echo base_url('tests/upload'); ?>" method="post">
			  <div class="form-group">
			    <label for="question">Type Question here:</label>
			    <textarea name="question" class="form-control" rows="12" id="question" placeholder="Type your question here and save it..." required="required"></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Save Question</button>
			  <button type="reset" class="btn btn-warning">Clear Question</button>
			</form>
		</div>
	</div>
</div>