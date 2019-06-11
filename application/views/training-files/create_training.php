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
						<h3>Create training <span style="text-transform: lowercase;">(fill all the inputs in the form)
							<small>max no. of trainees in a training is </small><strong>25.</strong></span></h3><br>
						<?php if($success = $this->session->flashdata('success')): ?>
							<div class="alert alert-success alert-dismissable text-center">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<p class="lead"><?php echo $success; ?></p>
							</div>
						<?php endif; ?>
					</div>
				<form method="post" action="<?php echo base_url('trainings/create_training'); ?>">
					<div class="col-lg-6">
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
					<div class="col-lg-6">
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
							<input type="text" name="facilitator" class="form-control" required="" style="color: #aeafaf;" placeholder="Facilitator name...">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="target" class="form-control" required="" style="color: #aeafaf;" placeholder="Target group i.e, CHW, AS or FCM ...">
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
							<input type="text" name="hall" class="form-control" required="" style="color: #aeafaf;" placeholder="Hall detail...">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="session" class="form-control" required="" placeholder="Type Session here..." style="color: #aeafaf;">
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
					<div class="col-lg-12" id="results"></div>
					<input type="hidden" name="created_at" value="<?php echo date('Y-m-d'); ?>">
					<div class="row">
						<div class="col-lg-3">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="row">
										<?php foreach($designations as $des): ?>
										<div class="col-md-9">
											<a class="designation" id="<?= $des->designation_id; ?>" href="javascript:void(0);"><?php echo $des->designation_name; ?></a>
										</div>
										<div class="col-md-3" id="total_<?= $des->designation_id; ?>">
											<?= $des->applied; ?>
											
										</div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class='tableMain'>
										<table class='table'>
											<thead>
												<tr>
													<th>Serial #</th>
													<th>Employee Name</th>
													<th>Training Type</th>
													<th>Designation</th>
													<th>Assign To Training</th>
												</tr>
											</thead>
											<tbody id="results2">

											</tbody>
										</table>
									</div>
								</div>
							</div>	
						</div>
						<div class="col-md-1">
							<small>Selected ...</small>
							<div class="panel panel-default">
								<div class="panel-body">
									<strong><span id="countcheckboxes"></span></strong>
								</div>
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
			</div>
		</div>
	</section>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
// Get employees list on selecting project and designation.
// $(document).ready(function() { // call the function when the document gets ready.
//   $("#project").change(function() {
//     var displayResources = $("#results");
//     var project = $('#project').val();
//     displayResources.text("Select an option to fetch employees.");
//     $.ajax({
//       type: "POST",
//       url: "<?php echo base_url(); ?>trainings/training_employees/" + project,
//       // data: { project: project },
//       dataType: 'JSON',
//       success: function(result) {
//         console.log(result);
//         var serialNo = 1;
//         var output =
//           "<div class='tableMain'><table class='table'><thead><tr><th>Serial #</th><th>Employee</th><th>Training Type</th><th>Designation</th><th>Assign To Training</th></thead><tbody>"; // create table head.
//         for (var i = 0; i < result.length; i++) {
//           output +=
//             "<tr><td>"+ serialNo++ +"</td><td>" +
//             result[i].first_name + " " + result[i].last_name + // First & last name.
//             "</td><td>" +
//             result[i].name + "<td>" + result[i].designation_name +
//             "</td><td><input class='select_max' type='checkbox' name='employee[]' value='"+ result[i].employee_id +"> Mark as trainee" 
//             "</td></tr>";
//         }
//         output += "</tbody></table></div>"; // closing tags of tbody and table.
//         displayResources.html(output);
//         $("table").addClass("table"); // added a class and named it table.
//       }
//     });
//   });
// });
// Comment this out for now, will un-comment this later if needed !

// Put limit on the checkboxes for employees.
$(document).ready(function(){
	var limit = 25;
	$('#results2').on('change', '.select_max', function(evt){
		var counCheckbox = $(":checkbox:checked").length;
		var desg = parseInt($(this).data('desg'));
		var desg_total = parseInt($.trim($('#total_'+desg).text()));
		var new_val = 0;
		if($(this).prop("checked") == true)
		{
			console.log('checked: ' +desg_total);
			new_val = desg_total-1;
			checkboxCounter++;
		}
		else if($(this).prop("checked") == false)
		{
			console.log(desg_total);
			new_val = desg_total+1;
			checkboxCounter--;
		}
		// $('#countcheckboxes').html(counCheckbox);
		// $('#total').html(counCheckbox)--;
		if($('.select_max:checked').length > limit){
			alert('Your limit to select employees has exceeded, you can select 3 employees in one training. Please adjust the rest in another training !');
			this.checked = false; // will not allow the checkbox to be checked.
		}

		$('#countcheckboxes').text(checkboxCounter);
		$('#total_'+desg).text(new_val);
	});
});
// Load data by clicking on the links in the sidebar with Ajax request.
var counter = 1; // variable to print the serial number.
var checkedLimit = 25; // set limit for the already checked checkboxes.
var checked = 'checked'; // declare a variable to check if the checkbox is checked.
total = [];
var checkboxCounter = 0;
$(document).ready(function(){ 
	$('.designation').one('click', function(){ 
	
		var total = parseInt($.trim($('#total_'+$(this).attr('id')).text()));

		var displayResults = $('#results2');
		var data = $(this).attr('id');
		$.ajax({
			type: 'get',
			url: '<?php echo base_url() ?>trainings/get_count_desig/' + data,
			dataType: 'JSON',
			success: function(res){
				console.log(res);
				var print="";
				var desg_checked = 0;
				for(var j = 0; j < res.length; j++){
					if(checkedLimit <= 0) // check condition.
					{
						checked = '';
					}	
					else
					{
						desg_checked++;
						checkboxCounter++;
					}
					print +=
		           	"<tr><td>"+ counter++ +"</td><td>" +
		            res[j].first_name + " " + res[j].last_name + // First & last name.
		            "</td><td>" +
		            res[j].name + "<td>" + res[j].designation_name +
		            "</td><td><input class='select_max' type='checkbox' "+checked+" name='employee[]' value='"+ res[j].employee_id +"' data-desg='"+res[j].designation_id+"'> Mark as trainee" 
		            "</td></tr>";
            		checkedLimit--; // decrement on exceeding the limit specified.
				} // endfor.
       			displayResults.append(print);
        		$("table").addClass("table"); // added a class and named it table.
        		$('#countcheckboxes').text(checkboxCounter);
        		$('#total_'+data).text(total-desg_checked);
        		
			}
		});
	});
});
</script>