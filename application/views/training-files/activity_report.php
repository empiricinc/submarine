<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/*  Filename : activity_report.php
*	Author: Saddam
*	Filepath: views / training-files / activity_report.php
*	Adding the report.
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-10">
					<div class="tabelHeading">
						<h3>training activity reporting form <span>( fill out the relevant fields )</span></h3>
					</div>
				</div>
				<?php $data = $this->Trainings_model->training_detail($this->uri->segment(3)); ?>
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="panel panel-success">
							<div class="panel-heading text-center">
								<strong>CHIP Training & Consulting (Pvt) Ltd.</strong><br>
								Training Activity Reporting
							</div>
							<form action="<?= base_url('trainings/store_activity_report'); ?>" method="post">
								<input type="hidden" name="trg_id" value="<?= $data['trg_id']; ?>">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-6 text-right">
											<strong>Province: </strong>
										</div>
										<div class="col-md-6 text-left">
											<?php echo $data['provName']; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 text-right">
											<strong>District: </strong>
										</div>
										<div class="col-md-6 text-left">
											<?php echo $data['cityName']; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 text-right">
											<strong>Project: </strong>
										</div>
										<div class="col-md-6 text-left">
											<?php echo $data['name']; ?>
										</div>
									</div>
									<div class="solidLine"></div>
									<div class="row">
										<div class="col-md-4">
											<strong>Name of the Training: </strong>
										</div>
										<div class="col-md-8-">
											<?php echo $data['type']; ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<strong>Dates (Start - End): </strong>
										</div>
										<div class="col-md-8-">
											<?php echo date('D, M d, Y', strtotime($data['start_date']))." - ". date('D, M d, Y', strtotime($data['end_date'])); ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<strong>Venue: </strong>
										</div>
										<div class="col-md-8-">
											<?php echo $data['location']; ?>
										</div>
									</div><div class="solidLine"></div>
									<div class="row">
										<div class="col-md-3">
											Residential Training
										</div>
										<div class="col-md-2">
											<input type="radio" name="res_trg" value="Residential">
										</div>
										<div class="col-md-3">
											Non Residential Training
										</div>
										<div class="col-md-2">
											<input type="radio" name="res_trg" value="Non Residential">
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-3">
											No. of Staff Travel
										</div>
										<div class="col-md-3">
											<input type="text" name="staff" class="form-control input-sm">
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-3">
											No. of Rooms
										</div>
										<div class="col-md-3">
											<input type="text" name="rooms" class="form-control input-sm">
										</div>
									</div><div class="solidLine"></div>
									<div class="row">
										<div class="col-md-12">
											<strong>Budget of Training</strong>
										</div>
									</div><br>
									<div class="row text-right">
										<div class="col-md-3">
											Budget Amount
										</div>
										<div class="col-md-3">
											<input type="text" name="budget" class="form-control input-sm">
										</div>
									</div><br>
									<div class="row text-right">
										<div class="col-md-3">
											Actual Expenses
										</div>
										<div class="col-md-3">
											<input type="text" name="expenses" class="form-control input-sm">
										</div>
									</div><div class="solidLine"></div>
									<div class="row">
										<div class="col-md-12">
											<u><i><strong>Checklist (Please check the relevant box).</strong></i></u>
										</div>
									</div><br>
									<?php $data = $this->db->select('*')->get('activity_checklist')->result(); ?>
									<?php $serial = 1; foreach($data as $check): ?>
									<div class="row">
										<div class="col-md-6">
											<small>
												<?php echo $serial++. ". " . $check->checklist_text; ?> :
											</small>
										</div>
										<div class="col-md-4">
											<input type="radio" name="checklist[<?= $check->id; ?>]" value="<?= $check->id; ?>"> Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="radio" name="checklist[<?= $check->id; ?>]" value=""> No
										</div>
									</div>
									<?php endforeach; ?>
									<div class="row">
										<div class="col-md-6 text-left">
											<hr>
											CTC Representative <br>
											<input type="text" name="chip_rep" class="form-control input-sm" placeholder="Name and Designation...">
										</div>
										<div class="col-md-6">
											<hr>
											UNICEF Representative <br>
											<input type="text" name="unicef_rep" class="form-control input-sm" placeholder="Name and Designation... ">
										</div>
									</div><br>
									<div class="row">
										<div class="col-md-12">
											<div class="submitBtn">
												<button id="save" type="submit" class="btn btnSubmit">Submit</button>
												<a href="javascript:history.go(-1);" class="btn btnSubmit">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</form>
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
	// $(document).ready(function(){
	// 	$('#save').click(function(e){
	// 		e.preventDefault(); // Function to stop all the default actions on the page.
	// 		// Assign all the form inputs to variables.
	// 		var first_name = $('#first_name').val();
	// 		var last_name = $('#last_name').val();
	// 		var contact = $('#contact').val();
	// 		var email = $('#email').val();
	// 		var expertise = $('#expertise').val();
	// 		var address = $('#address').val();
	// 		if(first_name == '' || last_name =='' || contact == '' || email == ''|| expertise == '' || address == ''){
	// 			alert('Please fill out the required fields');
	// 			return false;
	// 		}else{
	// 			// AJAX function call to post data into database.
	// 			$.ajax({
	// 				type: "post",
	// 				url: "<?php echo base_url('trainings/add_new_trainer'); ?>", // URL to submit data to DB.
	// 				data: {first_name: first_name, last_name: last_name, contact: contact, email: email, expertise: expertise, address: address},
	// 				dataType: 'json', // dataType should be 'json' or it won't work.
	// 				cache: false,
	// 				success: function(res){ // Alert something to let the user know something happened.
	// 					alert('Trainer has been added successfully !');
	// 					console.log(res); // Log 'true' to the console as well.
	// 				}
	// 			});
	// 		}
	// 	});
	// });
	// select project from the list and get the designations associated with the project_id.
</script>