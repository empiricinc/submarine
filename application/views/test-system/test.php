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
			<small>Write question in the input field and click the save button!</small><hr>
			<?php if($success = $this->session->flashdata('success')): ?>
				<div class="alert alert-success">
					<?php echo $success; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-md-7">
			<h2>Fill out the form below!</h2>
			<small>Fill out the form below and click the <strong style="text-transform: uppercase;">"Save Question"</strong> button, it'll be saved on the database.</small><hr>
			<form action="" method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="project">Project:</label>
							<select id="project" name="project" class="form-control" required>
								<option value="">--Select Project--</option>
								<?php foreach($projects as $project) : ?>
								<option value="<?php echo $project->company_id; ?>">
									<?php echo $project->name; ?>
								</option>
							<?php endforeach; ?>
							</select>
							<span><?php echo form_error('project'); ?></span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="designation">Designation:</label>
							<select id="designation" name="designation" class="form-control" required>
								<option value="">--Select Designation--</option>
								<?php foreach ($designations as $desg) : ?>
									<option value="<?php echo $desg->designation_id; ?>"><?php echo $desg->designation_name; ?></option>
								<?php endforeach; ?>
							</select>
							<span><?php echo form_error('designation'); ?></span>
						</div>
					</div>
				</div>
			  <div class="form-group" id="load">
			    <label for="question">Type Question here:</label>
			    <textarea name="question" class="form-control" rows="12" id="question" placeholder="Type your question here and save it..." required></textarea>
			    <span><?php echo form_error('question'); ?></span>
			  </div>
			  <button id="save" type="submit" class="btn btn-primary">Save Question</button>
			  <button type="reset" class="btn btn-warning">Clear Question</button>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
// Upload questions without refreshing the page.
	$(document).ready(function(){
		$('#save').click(function(e){
			e.preventDefault(); // Function to stop all the default actions on the page.
			// Assign all the form inputs to variables.
			var project = $('#project').val();
			var designation = $('#designation').val();
			var question = $('#question').val();
			// AJAX function call to post data into database.
			$.ajax({
				type: "post",
				url: "<?php echo base_url('tests/upload'); ?>", // URL to submit data to DB.
				data: {project: project, designation: designation, question: question},
				dataType: 'json', // dataType should be 'json' or it won't work.
				cache: false,
				success: function(res){ // Alert something to let the user know something happened.
					alert('Your data has been sent successfully !');
					$('#question').val(''); // Clear the textarea to add new data.
					console.log(res); // Log 'true' to the console as well.
				}
			})
		});
	});
//Onchange event on projects list, get all the designations associated with the project_id in que_tbl
// $(document).ready(function(){
// 	$('#project').on('change', function(){
// 		var project = $('#project').val();
// 		$.ajax({
// 			url: '<?php echo base_url(); ?>tests/changeDesignation/' + project,
// 			method: 'POST',
// 			dataType: 'JSON',
// 			data: { project: project },
// 			success: function(result){
// 				console.log(result);
// 				$('#designation').find('option').not(':first').remove();
// 				$.each(result, function(index, data){
// 					$('#designation').append('<option value="'+data['designation_id']+'">' + data['designation_id']+ '</option>'); // in the 2nd output I need the name of designation, not the ID of the designation. for that I need to write join query.
// 				});
// 			}
// 		});
// 	});
// });
</script>