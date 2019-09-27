<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/*  Filename : attendance_view.php
*	Author: Saddam
*	Filepath: views / training-files / attendance_view.php 
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3>attendance <span style="text-transform: lowercase;">(select an option from the list to get to attendance page)</span></h3><br>
						<?php if($success = $this->session->flashdata('success')): ?>
							<div class="alert alert-success">
								<p><?php echo $success; ?></p>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('trainings/attendance'); ?>">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="training" class="form-control" style="color: #aeafaf;" required="">
								<option value="">Select Training</option>
								<?php foreach($trainings as $training): ?>
									<option value="<?= $training->trg_id; ?>">
										<?= $training->type; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="submitBtn">
							<button type="submit" class="btn btnSubmit">Go to Attendance</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</section>