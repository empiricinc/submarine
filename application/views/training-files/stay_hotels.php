<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/*  Filename : stay_hotels.php
*	Author: Saddam
*	Filepath: views / training-files / stay_hotels.php 
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3>stay hotels' setup <span style="text-transform: lowercase;">(fill all the inputs given in the form) | </span><small>
						<a href="<?php echo base_url('trainings/all_stay_hotels'); ?>">
							<i class="fa fa-eye"></i> view all
						</a>
						</small></h3>
					</div>
					<?php if($success = $this->session->flashdata('success')): ?>
						<div class="alert alert-success">
							<p class="text-center"><?php echo $success; ?></p>
						</div>
					<?php endif; ?>
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
							<input type="text" name="hotel" id="hotel" class="form-control" placeholder="Hotel name ... ">
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
			<div class="col-lg-6">
				<h4>Recently added...</h4>
			</div>
			<div class="col-lg-6 text-right">
				<a href="<?php echo base_url('trainings/all_stay_hotels'); ?>">
					<h4><i class="fa fa-eye"></i> View All</h4>
				</a>
			</div>
			<table class="table">
				<thead>
					<tr <?php if(!empty($prices)): ?> style="display: none;"<?php endif; ?>>
						<th>Province</th>
						<th>City</th>
						<th>Hotel Name</th>
						<th>Amenities & Prices</th>
					</tr>
				</thead>
				<tbody>
					<?php if(!empty($hotels)):
					foreach($hotels as $hotel): ?>
					<tr>
						<td><?php echo $hotel->name; ?></td>
						<td><?php echo $hotel->city_name; ?></td>
						<td><?php echo $hotel->hotel_name; ?></td>
						<td>
							<div class="submitBtn">
								<a href="" class="btn btnSubmit" data-toggle="modal" data-target="#myModal<?php echo $hotel->hotel_id; ?>">Amenities</a>
								<a href="" class="btn btnSubmit" data-toggle="modal" data-target="#prices<?php echo $hotel->hotel_id; ?>">Prices</a>
								<a href="<?php echo base_url(); ?>trainings/prices_detail/<?php echo $hotel->hotel_id; ?>" class="btn btnSubmit">View Prices</a>
							</div>
						</td>
					</tr>
					<div id="myModal<?php echo $hotel->hotel_id; ?>" class="modal fade" role="dialog" data-backdrop = 'false'>
					  <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Add amenities here</h4>
					      </div>
					      <div class="modal-body">
					      	<div class="row">
					      		<form action="<?php echo base_url('trainings/add_amenities'); ?>" method="post">
						      		<input type="hidden" name="hotel" value="<?php echo $hotel->hotel_id; ?>">
						      		<div class="col-lg-6">
										<div class="inputFormMain">
											<input type="text" name="hotel_name" class="form-control" value="<?php echo $hotel->hotel_name; ?>">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="inputFormMain">
											<select name="room_type" class="form-control" style="color: #aeafaf;" required="">
												<option value="">Select Room Type</option>
												<?php foreach($room_types as $room): ?>
													<?php if($room->hotel_id == $hotel->hotel_id): ?>
													<option value="<?php echo $room->price_id; ?>"><?php echo $room->room_type; ?></option>
												<?php endif; endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="inputFormMain">
											<input type="checkbox" name="amenity[]" id="amenities" value="Bed & Breakfast"> Bed & Breakfast &nbsp;&nbsp;
											<input type="checkbox" name="amenity[]" id="ac_room" value="AC Room"> AC Room &nbsp;&nbsp;
											<input type="checkbox" name="amenity[]" id="attach_bath" value="Attach Bath"> Attach Bath &nbsp;&nbsp;
											<input type="checkbox" name="amenity[]" id="tv" value="TV Facility"> TV Facility &nbsp;&nbsp;
											<input type="checkbox" name="amenity[]" id="carpeted_room" value="Carpeted Room"> Carpeted Room &nbsp;&nbsp;
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
					      </div>
					      <div class="modal-footer">
					      	<div class="submitBtn">
					      		<button type="button" class="btn btnSubmit" data-dismiss="modal">Close</button>
					      	</div>
					      </div>
					    </div>
					  </div>
					</div>
					<!-- Prices modal, here we can add prices for hotels. -->
					<div id="prices<?php echo $hotel->hotel_id; ?>" class="modal fade" role="dialog" data-backdrop = 'false'>
					  <div class="modal-dialog">
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Add prices here</h4>
					      </div>
					      <div class="modal-body">
					      	<div class="row">
					      		<form action="<?php echo base_url('trainings/add_room_charges'); ?>" method="post">
					      		<input type="hidden" name="hotel_id" value="<?php echo $hotel->hotel_id; ?>">
					      		<div class="col-lg-6">
									<div class="inputFormMain">
										<input type="text" name="hotel_name" class="form-control" value="<?php echo $hotel->hotel_name; ?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="inputFormMain">
										<input type="text" name="room_type" id="room_type" class="form-control" placeholder="Room type i,e. 1, 2, seat or VIP ... " required="">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="inputFormMain">
										<input type="text" name="charges" id="charges" class="form-control" placeholder="Room charges for staying ... " required="">
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
					      </div>
					      <div class="modal-footer">
					      	<div class="submitBtn">
					      		<button type="button" class="btn btnSubmit" data-dismiss="modal">Close</button>
					      	</div>
					      </div>
					    </div>
					  </div>
					</div>
					<?php endforeach;  ?>
				</tbody>
			</table>
			<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-4">
					<?php echo $this->pagination->create_links(); endif; ?>
				</div>
				<div class="col-md-3"></div>
			</div>
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<?php if(!empty($prices)): ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3><?php if(!empty($prices)){ echo $prices[0]->hotel_name; }?> | <small> Amenities & Prices list</small></h3>
							</div>
							<div class="panel-body">
								<?php if(!empty($prices)): foreach($prices as $price): ?>
								<div class="row">
									<div class="col-lg-3">
										<strong>Room Type: </strong><?php echo $price->room_type; ?>
									</div>
									<div class="col-lg-3">
										<strong>Charges: </strong>PKR. <?php echo $price->charges;  ?>
									</div>
									<div class="col-lg-6">
									 	<strong>Amenities : </strong>
									 	<?php
									 	echo rtrim($price->amenities, ', ') . '.';
									 	?>
									</div>
									<hr>
								</div>
								<?php endforeach; endif; ?>
							</div>
							<div class="panel-footer text-right">
								<p>
									<?php if(!empty($prices)){ echo date('Y') . ", " .$prices[0]->hotel_name; } ?> | <a href="javascript: history.go(-1);">Go Back &laquo;</a>
								</p>
							</div>
						</div>
					<?php endif; ?>
				</div>
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
			var hotel = $('#hotel').val();
			if(location == '' || hotel == ''){
				alert('Please fill up the required fields');
				return false;
			}else{
			// AJAX function call to post data into database.
			$.ajax({
				type: "post",
				url: "<?php echo base_url('trainings/add_stay_hotels'); ?>", // URL to submit data to DB.
				data: {location: location, city: city, hotel: hotel},
				dataType: 'json', // dataType should be 'json' or it won't work.
				cache: false,
				success: function(res){ // Alert something to let the user know something happened.
					alert('Data has been added successfully!');
					$('#hotel').val('');
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