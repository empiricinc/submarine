<?php 
/*  Filename : create_exam.php
*	Author: Saddam
*	Location : views / test-system / create_exam.php 
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3>Create Exam <span style="text-transform: lowercase;">(Select options from the dropdowns and type the question in the box.)</span></h3>
					</div>
				</div>
				<form method="post" action="">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="project" id="project" class="form-control" style="color: #aeafaf;" required="required">
								<option value="">Select Project</option>
								<?php foreach($projects as $project) : ?>
									<option value="<?php echo $project->company_id; ?>">
										<?php echo $project->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="designation" id="designation" class="form-control" style="color: #aeafaf;" required="required">
								<option value="" >Select Designation</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea id="question" rows="6" class="form-control"  placeholder="Start typing question here..." required=""></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Submit</button>
							<button type="reset" class="btn btnSubmit">Reset</button>
							<a href="javascript:history.go(-1);" class="btn btnSubmit">Cancel</a>
						</div>
					</div>
				</form>
			</div>
			<div class="solidLine"></div>
			<div class="row">
				<div class="col-lg-12">
					<div class="tableMain">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Serial No.</th>
										<th>Question</th>
										<th>In Project</th>
										<th>For Designation</th>
									</tr>
								</thead>
								<tbody>
									<?php $serial = 1; foreach($recent_questions as $recent): ?>
									<tr>
										<td>
											<?php echo $serial++; ?>
										</td>
										<td>
											<a href="<?php echo base_url(); ?>tests/view_single/<?php echo $recent->id; ?>"><?php echo $recent->question; ?></a>
										</td>
										<td>
											<a href="<?php echo base_url(); ?>tests/detail_project/<?php echo $recent->company_id; ?>"><?php echo $recent->name; ?></a>
										</td>
										<td>
											<?php echo $recent->designation_name; ?>
										</td>
										<td>
											
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
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
			if(project == '' || designation == ''){
				alert('Please fill out the required fields');
				return false;
			}else{
			// AJAX function call to post data into database.
				$.ajax({
					type: "post",
					url: "<?php echo base_url('tests/upload'); ?>", // URL to submit data to DB.
					data: {project: project, designation: designation, question: question},
					dataType: 'json', // dataType should be 'json' or it won't work.
					cache: false,
					success: function(res){ // Alert something to let the user know something happened.
						alert('Your data has been stored successfully !');
						$('#question').val(''); // Clear the textarea to add new data.
						console.log(res); // Log 'true' to the console as well.
					}
				});
			}
		});
	});
	// select project from the list and get the designations associated with the project_id.
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