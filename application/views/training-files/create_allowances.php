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
						<h3>setup for trainings' allowance <span style="text-transform: lowercase;">(fill all the inputs given in the form)</span></h3><br>
						<?php if($success = $this->session->flashdata('success')): ?>
							<div class="alert alert-success alert-dismissable text-center">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<p><?php echo $success; ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('trainings/create_allowances'); ?>">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<div class="inputFormMain">
								<select name="project" id="project" class="form-control" style="color: #aeafaf;">
									<option value="">Select Project</option>
									<?php foreach($projects as $project): ?>
										<option value="<?php echo $project->company_id; ?>">
											<?php echo $project->name; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="designation" id="designation" class="form-control" style="color: #aeafaf;">
								<option value="">Select Designation</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<select name="behavior" id="behavior" class="form-control" style="color: #aeafaf;">
								<option value="">Select Behavior</option>
								<option value="local">Local</option>
								<option value="out">Non Local</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="dsa" id="dsa" class="form-control" placeholder="DSA ... ">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="travel" id="travel" class="form-control" placeholder="Travel ... ">
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input type="text" name="stay" id="stay" class="form-control" placeholder="Stay allowance ... ">
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Submit</button>
							<button type="reset" class="btn btnSubmit">Reset</button>
						</div>
					</div>
				</form>
			</div>
			<div class="solidLine"></div>
			<table class="table">
				<thead>
					<tr>
						<th>Project</th>
						<th>Designation</th>
						<th>Behavior</th>
						<th>DSA</th>
						<th>Travel</th>
						<th>Stay</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($allowances as $allowance): // get the data in loop. ?>
					<tr>
						<td><?php echo $allowance->name; ?></td>
						<td><?php echo $allowance->designation_name; ?></td>
						<td>
							<?php if($allowance->behavior == 'local'){ echo "Local"; }
							elseif($allowance->behavior == 'out') { echo "Non Local"; } ?>
						</td>
						<td>
							<?php if($allowance->dsa == NULL) { echo "<strong style='color: red;'>N/A</strong>"; }
							else{ echo "Rs. ".$allowance->dsa; } ?>
						</td>
						<td><?php echo "Rs. ".$allowance->travel; ?></td>
						<td>
							<?php if($allowance->stay_allowance == NULL) { echo "<strong style='color: red;'>N/A</strong>"; } else{ echo "Rs. ".$allowance->stay_allowance; } ?>
						</td>
						<td>
							<?php $total = $allowance->dsa + $allowance->travel + $allowance->stay_allowance; 
								echo "Rs. ". $total;
							?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</section>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#project').on('change', function(){
		// Get the value of the project.
		var project = $('#project').val(); // Get the project's list value i.e project_id.
		// AJAX request.
		$.ajax({ 
			// send the project_id in the url with the request.
			url: '<?php echo base_url(); ?>trainings/get_trg_projects/' + project,
			method: 'POST', // method of the request, (form method = 'post').
			dataType: 'JSON', // type of the data to be retrieved, & it's JSON.
			data: { project: project },
			success: function(response){ // function to get the response of.
				// Remove options
				console.log(response); // Log the response to the console.
				$('#designation').find('option').not(':first').remove();
				// Add options
				$.each(response, function(index, data){ // Get the data retrieved in a loop.
				// var designation = data['designation_name'];
					$('#designation').append('<option value="'+data['designation_id']+'">'+data['designation_name']+'</option>'); // append the retrieved data in target list.
				});
			}
		});
	});
});

// Change input value to zero and disable the input on selecting option.
$(document).ready(function(){
	$('#behavior').on('change', function(){
		var local = $(this).val();
		if(local == 'local'){ // if local, the 'dsa' and 'stay' inputs will be disabled.
			$('#dsa').attr('disabled', 'disabled').val('0'); // disabled & value will be 0.
			$('#stay').attr('disabled', 'disabled').val('0');
		}else{
			$('#dsa').removeAttr('disabled').val(''); // enabled, value entered by user.
			$('#stay').removeAttr('disabled').val('');
		}
	})
});
</script>