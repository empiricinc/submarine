<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/*  Filename : create_training.php
*	Author: Saddam
*	Filepath: views / training-files / create_training.php (setup form)
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3>tentative training calendar <span style="text-transform: lowercase;">(fill all the inputs)</span>
					</div>
				<form method="post" action="<?php echo base_url('trainings/create_calendar'); ?>">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="title" class="form-control" id="title" placeholder="Enter Title here..." required="" style="color: #aeafaf;">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="province" id="location" class="form-control" style="color: #aeafaf;" required="">
								<option value="" >Select Province</option>
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
							<select name="district" id="city" class="form-control" style="color: #aeafaf;" required="">
								<option value="" >Select District</option>
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
							<select name="designation" id="designation" class="form-control" style="color: #aeafaf;" required="">
								<option value="" >Select Designation</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="trg_type" id="trg_type" class="form-control" style="color: #aeafaf;" required="">
								<option value="" >Select Training Type</option>
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
							<input type="date" name="start_date" class="form-control" required="" style="color: #aeafaf;">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="date" name="end_date" class="form-control" required="" style="color: #aeafaf;">
						</div>
					</div>
					<input type="hidden" name="created_at" value="<?php echo date('Y-m-d'); ?>">
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Submit</button>
							<a href="javascript:history.go(-1);" class="btn btnSubmit">Cancel</a>
						</div>
					</div>
				</form>
				</div>
				<div class="col-lg-12"><hr>
					<div class="tabelHeading">
						<h3>recently added <span style="text-transform: lowercase;">( Here's the list of recently added events )</span></h3>
					</div>
					<div class="tableMain">
		              <div class="table-responsive">
		                <table class="table">
		                  <thead>
		                    <tr>
		                      <th>Title</th>
		                      <th>Province</th>
		                      <th>District</th>
		                      <th>Project</th>
		                      <th>Designation</th>
		                      <th>Trg Type</th>
		                      <th>Start Date</th>
		                      <th>End Date</th>
		                      <th>Actions</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                    <?php foreach($events_list as $event): ?>
		                    <tr>
		                      <td><?= $event->title; ?></td>
		                      <td><?= $event->provName; ?></td>
		                      <td><?= $event->cityName; ?></td>
		                      <td><?= $event->compName; ?></td>
		                      <td><?= $event->designation_name; ?></td>
		                      <td><?= $event->type; ?></td>
		                      <td><?= date('M d, y', strtotime($event->start_date)); ?></td>
		                      <td><?= date('M d, y', strtotime($event->end_date)); ?></td>
		                      <td>
		                        <div class="label label-primary">Modify</div>
		                        <a href="<?php echo base_url(); ?>trainings/delete_event/<?php echo $event->event_id; ?>" onclick="javascript: return confirm('Are you sure to delete ?');">
		                            <div class="label label-danger">Delete</div>
		                        </a>
		                      </td>
		                    </tr>
		                    <?php endforeach; ?>
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
						<span>
							<?php echo $this->pagination->create_links(); ?>
						</span>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</section>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
// Get districts on selecting province.
// Dependent select boxes.
$(document).ready(function(){
	$('#location').on('change', function(){
		var location = $('#location').val();
		$.ajax({ 
			url: '<?php echo base_url(); ?>trainings/get_provinces/' + location,
			method: 'POST',
			dataType: 'JSON',
			data: { project: location },
			success: function(response){
				console.log(response);
				$('#city').find('option').not(':first').remove();
				$.each(response, function(index, data){ 
					$('#city').append('<option value="'+data['city_id']+'">'+data['city_name']+'</option>');
				});
			}
		});
	});
});
// Get designation on selecting project
$(document).ready(function(){
	$('#project').on('change', function(){
		var project = $('#project').val();
		$.ajax({ 
			url: '<?php echo base_url(); ?>trainings/get_trg_projects/' + project,
			method: 'POST',
			dataType: 'JSON',
			data: { project: project },
			success: function(response){ 
				console.log(response);
				$('#designation').find('option').not(':first').remove();
				$.each(response, function(index, data){ 
					$('#designation').append('<option value="'+data['designation_id']+'">'+data['designation_name']+'</option>');
				});
			}
		});
	});
});
</script>