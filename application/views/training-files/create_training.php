<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/*  Filename : create_training.php
*	Author: Saddam
*	Filepath: views / training-files / create_training.php 
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3>Create training <span style="text-transform: lowercase;">(fill all the inputs and dropdowns given in the form)</span></h3><br>
						<?php if($success = $this->session->flashdata('success')): ?>
							<div class="alert alert-success alert-dismissable text-center">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<p class="lead"><?php echo $success; ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('trainings/create_training'); ?>">
					<div class="col-lg-3">
						<div class="inputFormMain">
							<select name="location" id="location" class="form-control" style="color: #aeafaf;" required="">
								<option value="" >Select Location</option>
								<?php foreach($locations as $location): ?>
									<option value="<?php echo $location->id; ?>">
										<?php echo $location->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<select name="project" id="project" class="form-control" style="color: #aeafaf;" required="">
								<option value="" >Select Project</option>
								<?php foreach($projects as $project): ?>
									<option value="<?php echo $project->company_id; ?>">
										<?php echo $project->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="trg_type" id="trg_type" class="form-control" style="color: #aeafaf;" required="">
								<option value="" >Select Type</option>
								<?php foreach($training_types as $type): ?>
									<option value="<?php echo $type->training_type_id; ?>">
										<?php echo $type->type; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-12" id="results"></div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="trainer_1" id="trainer_1" class="form-control" style="color: #aeafaf;" required="">
								<option value="" >Select Trainer 1</option>
								<?php foreach($trainers as $trainer): ?>
									<option value="<?php echo $trainer->trainer_id; ?>">
										<?php echo $trainer->first_name." ".$trainer->last_name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="trainer_2" id="trainer_2" class="form-control" style="color: #aeafaf;">
								<option value="">Select Trainer 2</option>
								<?php foreach($trainers as $trainer): ?>
									<option value="<?php echo $trainer->trainer_id; ?>">
										<?php echo $trainer->first_name." ".$trainer->last_name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="facilitator" class="form-control" required="" placeholder="Facilitator name...">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="target" class="form-control" required="" placeholder="Target group i.e, CHW, AS or FCM ...">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="date" name="start_date" class="form-control" required="" style="color: #aeafaf;">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="date" name="end_date" class="form-control" required="" style="color: #aeafaf;">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="venue" class="form-control" required="" style="color: #aeafaf;">
								<option value="">Select Venue</option>
								<?php foreach($venues as $venue): ?>
									<option value="<?php echo $venue->location_id; ?>">
										<?php echo $venue->location; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="hall" class="form-control" required="" placeholder="Hall detail...">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="date" name="session" class="form-control" required="" placeholder="Session...">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="approval_type" class="form-control" required="" style="color: #aeafaf;">
								<option value="">Select Approval Type</option>
								<option value="Planned">Planned</option>
								<option value="Not Planned">Not Planned</option>
							</select>
						</div>
					</div>
					<input type="hidden" name="created_at" value="<?php echo date('Y-m-d'); ?>">
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Submit</button>
							<button type="reset" class="btn btnSubmit">Reset</button>
							<a href="javascript:history.go(-1);" class="btn btnSubmit">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
// Upload questions without refreshing the page.
	// $(document).ready(function(){
	// 	$('#save').click(function(e){
	// 		e.preventDefault(); // Function to stop all the default actions on the page.
	// 		// Assign all the form inputs to variables.
	// 		var employee = $('#employee').val();
	// 		var training_type = $('#training_type').val();
	// 		var trainer = $('#trainer').val();
	// 		var start_date = $('#start_date').val();
	// 		var end_date = $('#end_date').val();
	// 		var cost = $('#cost').val();
	// 		var status = $('#status').val();
	// 		var remarks = $('#remarks').val();
	// 		var description = $('#description').val();
	// 		var performance = $('#performance').val();
	// 		// AJAX function call to post data into database.
	// 		$.ajax({
	// 			type: "post",
	// 			url: "<?php echo base_url('trainings/create_training'); ?>", // URL to submit data to DB.
	// 			data: {employee: employee, training_type: training_type, trainer: trainer, start_date: start_date, end_date: end_date, cost: cost, status: status, remarks: remarks, description: description, performance: performance},
	// 			dataType: 'json', // dataType should be 'json' or it won't work.
	// 			cache: false,
	// 			success: function(res){ // Alert something to let the user know something happened.
	// 				alert('Training has been added successfully !');
	// 				$('#employee').val(''); // Clear the textarea to add new data.
	// 				$('#training_type').val('');
	// 				$('#trainer').val('');
	// 				$('#start_date').val('');
	// 				$('#end_date').val('');
	// 				$('#cost').val('');
	// 				$('#status').val('');
	// 				$('#remarks').val('');
	// 				$('#description').val('');
	// 				$('#performance').val('');
	// 				console.log(res); // Log 'true' to the console as well.
	// 			}
	// 		})
	// 	});
	// });

	// select project from the list and get the designations associated with the project_id.

// Get employees list on selecting project and designation.
$(document).ready(function() { // call the function when the document gets ready.
  $("#project").change(function() {
    var displayResources = $("#results");
    var project = $('#project').val();
    displayResources.text("Select an option to fetch employees.");
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>trainings/training_employees/" + project,
      // data: { project: project },
      dataType: 'JSON',
      success: function(result) {
        console.log(result);
        var output =
          "<div class='tableMain'><table class='table'><thead><tr><th>Employee</th><th>Training Type</th><th>Designation</th><th>Assign To Training</th></thead><tbody>"; // create table head.
        for (var i = 0; i < result.length; i++) {
          output +=
            "<tr><td>" +
            result[i].first_name + " " + result[i].last_name + // First & last name.
            "</td><td>" +
            result[i].name + "<td>" + result[i].designation_name +
            "</td><td><input type='checkbox' name='employee[]' value='"+ result[i].employee_id +"'> Mark as trainee" 
            "</td></tr>";
        }
        output += "</tbody></table></div>"; // closing tags of tbody and table.
        displayResources.html(output);
        $("table").addClass("table"); // added a class and named it table.
      }
    });
  });
});
</script>