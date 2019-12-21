<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<form method="post" action="<?php if(empty($edit)){ echo base_url('tests/save_subjective_paper'); }else{ echo base_url('tests/update_subjective_paper'); } ?>">
					<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="project" id="project" class="form-control" style="color: #aeafaf;" required="required">
								<option value="">Select Project...</option>
								<?php if(!empty($edit)): ?>
								<option value="<?php echo $edit->project_id; ?>" selected><?php if(!empty($edit)){ echo $edit->name; } ?></option><?php endif; ?>
								<?php foreach($projects as $project): ?>
									<option value="<?= $project->company_id; ?>">
										<?= $project->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="designation" id="designation" class="form-control" style="color: #aeafaf;" required="required">
								<option value="">Select Designation...</option>
								<?php if(!empty($edit)): ?>
								<option value="<?php echo $edit->designation; ?>" selected><?php echo $edit->designation_name; ?></option><?php endif; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="question" class="form-control" style="color: #aeafaf;" rows="6" placeholder="Type question here..."><?php if(!empty($edit)){ echo $edit->question_text; } ?></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Submit</button>
							<button type="reset" class="btn btnSubmit">Reset</button>
						</div>
					</div>
				</form>
			</div><hr>
		</div>
	</section>
</section>
<script type="text/javascript">
$(document).ready(function(){
	$('#project').on('change', function(){
		// Get the value of the project.
		var project = $('#project').val(); // Get the project's list value i.e project_id.
		// AJAX request.
		$.ajax({ 
			// send the project_id in the url with the request.
			url: '<?php echo base_url(); ?>tests/create_exam_form/' + project,
			method: 'POST', // method of the request.
			dataType: 'JSON', // type of the data to be retrieved.
			data: { project: project },
			success: function(response){ // function to get the response of.
				// Remove options
				console.log(response); // Log the response to the console.
				$('#designation').find('option').not(':first').remove();
				// Add options
				$.each(response, function(index, data){ // Get the data retrieved in a loop.
					//var designation = data['designation_name'];
					$('#designation').append('<option value="'+data['designation_id']+'">'+data['designation_name']+'</option>'); // append the retrieved data in target list.
				});
			}
		});
	});
});
</script>