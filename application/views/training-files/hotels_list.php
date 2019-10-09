<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: hotels_list.php
*  Author: Saddam
*  Filepath: views / training-files / hotels_list.php
*/
?>
<?php if(empty($results)): ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<?php if(empty($hotel_detail)): ?>
								<h3>all hotels <span>(list of the hotels registered with the company)</span> |
									<small><a href="<?php echo base_url('trainings/stay_hotels'); ?>"><i class="fa fa-plus"></i> add new hotel</a></small>
								</h3>
							<?php else: ?>
								<h3>hotel's detail <span>(see hotel's detail)</span></h3>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('trainings/hotel_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_hotel" class="form-control" placeholder="Search hotels..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr <?php if(!empty($hotel_detail)): ?> style="display: none;" <?php endif; ?>>
											<th>hotel name</th>
											<th>province</th>
											<th>district</th>
											<th>actions | add amenities & prices</th>
											<th>more actions | modify | delete</th>
										</tr>
									</thead>
									<tbody>
										<?php if($sl3['accessLevel3']): // Check Access Level.
										if(!empty($hotels_list)):
										foreach($hotels_list as $hotel): ?>
										<tr>
											<td><a href="<?php echo base_url(); ?>trainings/detail_hotel/<?php echo $hotel->hotel_id; ?>"><?=$hotel->hotel_name; ?></a></td>
											<td><?=$hotel->name; ?></td>
											<td><?=$hotel->city_name; ?></td>
											<td>
												<div class="submitBtn">
													<a href="" data-toggle="modal" data-target="#prices<?php echo $hotel->hotel_id; ?>" class="btn btnSubmit"><i class="fa fa-plus"></i> Room Charges</a>
													<a href="" class="btn btnSubmit" data-toggle="modal" data-target="#myModal<?php echo $hotel->hotel_id; ?>"><i class="fa fa-plus"></i> Amenities</a>
													<a href="<?php echo base_url(); ?>trainings/prices_detail/<?php echo $hotel->hotel_id; ?>" class="btn btnSubmit"><i class="fa fa-eye"></i> View Prices</a>
												</div>
											</td>
											<td>
												<a href="" data-toggle="modal" data-target="#modify<?php echo $hotel->hotel_id; ?>" class="btn btn-primary btn-xs">Modify</a>
												<a href="<?php echo base_url(); ?>trainings/delete_hotel/<?php echo $hotel->hotel_id; ?>" onclick="javascript: return confirm('Are you sure to delete ?');" class="btn btn-danger btn-xs">Delete</a>
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
																<select name="room_type" class="form-control" style="color: #aeafaf;">
																	<option value="">Select Room Type</option>
																	<?php foreach($room_types as $room): 
																		if($room->hotel_id == $hotel->hotel_id):
																		?>
																		<option value="<?php echo $room->price_id; ?>"><?php echo $room->room_type; ?></option>
																	<?php endif; endforeach; ?>
																</select>
															</div>
														</div><br><br>
														<div class="col-lg-12">
															<div class="inputFormMain">
																<input type="checkbox" name="amenity[]" id="amenities" value="Bed & Breakfast"> Bed & Breakfast &nbsp;&nbsp;
																<input type="checkbox" name="amenity[]" id="ac_room" value="AC Room"> AC Room &nbsp;&nbsp;
																<input type="checkbox" name="amenity[]" id="attach_bath" value="Attach Bath"> Attach Bath &nbsp;&nbsp;
																<input type="checkbox" name="amenity[]" id="tv" value="TV Facility"> TV Facility &nbsp;&nbsp;
																<input type="checkbox" name="amenity[]" id="carpeted_room" value="Carpeted Room"> Carpeted Room &nbsp;&nbsp;
															</div><br><br>
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
										<!-- Amenities modal ends here. -->
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
															<input type="text" name="room_type" id="room_type" class="form-control" placeholder="Room type i,e. 1, 2, seat or VIP ... ">
														</div>
													</div><br><br><br>
													<div class="col-lg-6">
														<div class="inputFormMain">
															<input type="text" name="charges" id="charges" class="form-control" placeholder="Room charges for staying ... ">
														</div>
													</div><br><br><br>
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
										<!-- Prices modal ends here... -->
										<!-- Modifying rooms and charges in hotels... -->
										<div id="modify<?php echo $hotel->hotel_id; ?>" class="modal fade" role="dialog" data-backdrop = 'false'>
										  <div class="modal-dialog">
										    <!-- Modal content-->
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <h4 class="modal-title">Modify room prices or type here</h4>
										      </div>
										      <div class="modal-body">
										      	<div class="row">
										      		<form action="<?php echo base_url('trainings/modify_hotel'); ?>" method="post">
										      		<input type="hidden" name="hotel_id" value="<?php echo $hotel->hotel_id; ?>">
										      		<div class="col-lg-12">
														<div class="inputFormMain">
															<input type="text" name="hotel_name" class="form-control" value="<?php echo $hotel->hotel_name; ?>">
														</div>
													</div><br><br><br>
													<div class="col-lg-12">
														<div class="submitBtn">
															<button id="save" type="submit" class="btn btnSubmit">Update</button>
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
										<?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="tabelSideListing text-center">
							<span><?php if(empty($hotel_detail)){ echo $this->pagination->create_links(); } 
							endif; ?></span>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php else: ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>you've searched for : <span><?php echo $_GET['search_hotel']; ?></span></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('trainings/hotel_search'); ?>" method="get">
								<div class="inputFormMain">
									<a href="javascript:history.go(-1);" class="form-control">Go back</a>
									<div class="input-group">
										<input type="text" name="search_hotel" class="form-control" placeholder="Search hotels..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>hotel name</th>
											<th>province</th>
											<th>city</th>
											<th>amenities & prices</th>
										</tr>
									</thead>
									<tbody>
										<?php if($sl3['accessLevel3']): // Check Acccess Level.
										foreach($results as $result): ?>
										<tr>
											<td><a href="<?php echo base_url(); ?>trainings/detail_hotel/<?php echo $result->hotel_id; ?>"><?=$result->hotel_name; ?></a></td>
											<td><?=$result->name; ?></td>
											<td><?=$result->city_name; ?></td>
											<td>
												<div class="submitBtn">
													<a href="<?php echo base_url(); ?>trainings/prices_detail/<?php echo $result->hotel_id; ?>" class="btn btnSubmit">View Prices</a>
												</div>
											</td>
										</tr>
										<?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<?php if(isset($hotel_detail)): ?>
<section class="secMainWidthFilter">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>Hotel's Detail</h3>
					</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-4"><strong>Hotel's Name: </strong></div>
								<div class="col-lg-8"><?php echo $hotel_detail['hotel_name']; ?></div>
							</div>
							<div class="row">
								<div class="col-md-4"><strong>Province: </strong></div>
								<div class="col-md-8"><?php echo $hotel_detail['name']; ?></div>
							</div>
							<div class="row">
								<div class="col-md-4"><strong>City: </strong></div>
								<div class="col-md-8"> <?php echo $hotel_detail['cityName']; ?></div>
							</div>
						</div>
					<div class="panel-footer text-right">
						<?php echo date('Y') . " - " . $hotel_detail['hotel_name']; ?> | <a href="javascript:history.go(-1);">Go Back &laquo;</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>