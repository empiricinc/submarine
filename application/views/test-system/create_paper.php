<?php 
/* Filename: create_paper.php
*  Author: Saddam
*  Location: Views / test-system / create_paper.php
*/
?>
<style type="text/css">
	ul li{
		list-style-type: none;
		display: inline;
	}
</style>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<?php if($success = $this->session->flashdata('success')): ?>
						<div class="alert alert-success text-center">
							<p><?php echo $success; ?></p>
						</div>
					<?php endif; ?>
					<div class="tabelHeading">
						<h3>create exam paper <span style="text-transform: lowercase;">(create paper for specific job) | </span><a href="<?php echo base_url('tests/subjective_paper'); ?>" class="btn btn-primary btn-xs">Add Subjective Questions</a></h3>
					</div><hr>
				</div>
				<form method="post" action="<?php echo base_url('tests/get_paper'); ?>">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="project" id="project" class="form-control" style="color: #aeafaf;" required="required">
								<option value="">Select Project...</option>
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
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Submit</button>
							<button type="reset" class="btn btnSubmit">Reset</button>
						</div>
					</div>
				</form>
			</div><hr>
			<div class="row">
				<div class="col-md-10">
					<?php if(!empty($list_questions)): ?><strong>Here's the list that you can choose questions from !</strong><br><br>
				<div class="row" style="font-weight: bold;">
					<div class="col-md-1">S.No</div>
					<div class="col-md-5">Question</div>
					<div class="col-md-2">Project</div>
					<div class="col-md-2">Designation</div>
					<div class="col-md-2">Marks</div>
				</div><br><?php endif; ?>
					<form action="<?php echo base_url('tests/save_paper'); ?>" method="post">
						<?php if(!empty($list_questions)): ?>
							<div class="inputFormMain">
								<select name="job_id" class="form-control" style="color: #aeafaf;" required="">
									<option value="">Select Job...</option>
									<?php foreach ($jobs as $job): ?>
										<option value="<?php echo $job->job_id; ?>">
											<?php echo substr($job->job_title, 0, 35); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						<?php endif; ?>
						<?php $counter = 1; if(!empty($list_questions)): foreach ($list_questions as $list): ?>
						<input type="hidden" name="project" value="<?php echo $list->project_id; ?>">
						<input type="hidden" name="designation" value="<?php echo $list->designation_id; ?>">
						<div class="row">
							<div class="col-md-1">
								<input type="checkbox" name="question[]" value="<?php echo $list->id; ?>">
								<?php echo $counter++; ?>.
							</div>
							<div class="col-md-5"><?php echo $list->question; ?></div>
							<div class="col-md-2"><?php echo $list->name; ?></div>
							<div class="col-md-2"><?php echo $list->designation_name; ?></div>
							<div class="col-md-2"><input type="text" name="marks[]" class="form-control input-sm"></div>
						</div>
					<?php endforeach; endif; ?><br>
					<?php if(!empty($list_questions)): ?>
						<div class="submitBtn">
							<input type="submit" name="submit" class="btn btnSubmit" value="Save">
						</div>
					<?php endif; ?>
					</form>
				</div>
			</div>
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