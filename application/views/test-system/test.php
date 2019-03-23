<?php 
/*  Filename : test.php
*	Author: Saddam
*	Location : views / test-system / test.php 
*/
?>

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
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="project">Project:</label>
							<select name="project" class="form-control" required>
								<option value="">Select Project</option>
								<?php foreach($projects as $project) : ?>
								<option value="<?php echo $project->company_id; ?>"><?php echo $project->name; ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="designation">Designation:</label>
							<select name="designation" class="form-control" required>
								<option value="">Select Designation</option>
								<?php foreach ($designations as $desg) : ?>
									<option value="<?php echo $desg->designation_id; ?>"><?php echo $desg->designation_name; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			  <div class="form-group">
			    <label for="question">Type Question here:</label>
			    <textarea name="question" class="form-control" rows="12" id="question" placeholder="Type your question here and save it..." required></textarea>
			  </div>
			  <button type="submit" class="btn btn-primary">Save Question</button>
			  <button type="reset" class="btn btn-warning">Clear Question</button>
			</form>
		</div>
	</div>
</div>