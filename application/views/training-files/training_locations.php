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
						<h3>training locations' setup <span style="text-transform: lowercase;">(fill all the inputs given in the form)</span></h3><br>
						<?php if($success = $this->session->flashdata('success')): ?>
							<div class="alert alert-success alert-dismissable text-center">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<p><?php echo $success; ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<form method="post" action="">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="location" id="location" class="form-control" style="color: #aeafaf;">
								<option value="">Select Province</option>
								<?php foreach ($locations as $location): ?>
									<option value="<?php echo $location->id ?>">
										<?php echo $location->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="city" id="city" class="form-control" style="color: #aeafaf;">
								<option value="">Select City</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="venue" id="venue" class="form-control" placeholder="Location name ... ">
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
			<h4>Recently added...</h4>
			<table class="table">
				<thead>
					<tr>
						<th>Province</th>
						<th>City</th>
						<th>Location/Venue</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($all_locations as $location): ?>
					<tr>
						<td><?php echo $location->name; ?></td>
						<td><?php echo $location->city_name; ?></td>
						<td><?php echo $location->location; ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-4">
					<?php echo $this->pagination->create_links(); ?>
				</div>
				<div class="col-md-3"></div>
			</div>
			
		</div>
	</section>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
//Upload form data without refreshing the page.
	$(document).ready(function(){
		$('#save').click(function(e){
			e.preventDefault(); // Function to stop all the default actions on the page.
			// Assign all the form inputs to variables.
			var location = $('#location').val();
			var city = $('#city').val();
			var venue = $('#venue').val();
			if(location == '' || city== '' || venue == ''){
				alert('Please fill up the required fields');
				return false;
			}else{
			// AJAX function call to post data into database.
			$.ajax({
				type: "post",
				url: "<?php echo base_url('trainings/create_locations'); ?>", // URL to submit data to DB.
				data: {location: location, city: city, venue: venue},
				dataType: 'json', // dataType should be 'json' or it won't work.
				cache: false,
				success: function(res){ // Alert something to let the user know something happened.
					alert('Location has been added successfully !');
					$('#venue').val(''); // Clear the textarea to add new data.
					
					console.log(res); // Log 'true' to the console as well.
				}
			})
		}
		});
	});

//select project from the list and get the designations associated with the project_id.
$(document).ready(function(){
	$('#location').on('change', function(){
		// Get the value of the project.
		var location = $('#location').val(); // Get the project's list value i.e project_id.
		// AJAX request.
		$.ajax({ 
			// send the project_id in the url with the request.
			url: '<?php echo base_url(); ?>trainings/get_provinces/' + location,
			method: 'POST', // method of the request.
			dataType: 'JSON', // type of the data to be retrieved.
			data: { project: location },
			success: function(response){ // function to get the response of.
				// Remove options
				console.log(response); // Log the response to the console.
				$('#city').find('option').not(':first').remove();
				// Add options
				$.each(response, function(index, data){ // Get the data retrieved in a loop.
					//var designation = data['designation_name'];
					$('#city').append('<option value="'+data['city_id']+'">'+data['city_name']+'</option>'); // append the retrieved data in target list.
				});
			}
		});
	});
});
</script>