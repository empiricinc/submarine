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
						<h3>add trainer <span style="text-transform: lowercase;">(fill all the inputs given in the form)</span></h3><br>
						<?php if($success = $this->session->flashdata('success')): ?>
							<div class="alert alert-success alert-dismissable text-center">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<p class="lead"><?php echo $success; ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<form method="post" action="<?php //echo base_url('trainings/add_new_trainer'); ?>">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name ... ">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name ...">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="contact" id="contact" class="form-control" placeholder="Contact ... ">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="email" id="email" class="form-control" placeholder="Email ... ">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<textarea name="expertise" id="expertise" rows="3" class="form-control"  placeholder="Expertise..."></textarea>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<textarea name="address" id="address" rows="3" class="form-control"  placeholder="Address..."></textarea>
						</div>
					</div>
					<input type="hidden" name="created_at" value="<?php echo date('d-m-Y'); ?>">
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
	$(document).ready(function(){
		$('#save').click(function(e){
			e.preventDefault(); // Function to stop all the default actions on the page.
			// Assign all the form inputs to variables.
			var first_name = $('#first_name').val();
			var last_name = $('#last_name').val();
			var contact = $('#contact').val();
			var email = $('#email').val();
			var expertise = $('#expertise').val();
			var address = $('#address').val();
			if(first_name == '' || last_name =='' || contact == '' || email == ''|| expertise == '' || address == ''){
				alert('Please fill out the required fields');
				return false;
			}else{
				// AJAX function call to post data into database.
				$.ajax({
					type: "post",
					url: "<?php echo base_url('trainings/add_new_trainer'); ?>", // URL to submit data to DB.
					data: {first_name: first_name, last_name: last_name, contact: contact, email: email, expertise: expertise, address: address},
					dataType: 'json', // dataType should be 'json' or it won't work.
					cache: false,
					success: function(res){ // Alert something to let the user know something happened.
						alert('Trainer has been added successfully !');
						console.log(res); // Log 'true' to the console as well.
					}
				});
			}
		});
	});

	// select project from the list and get the designations associated with the project_id.
</script>