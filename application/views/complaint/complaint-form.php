<section class="secMainWidth">
<section class="col-lg-6 col-lg-offset-3">
<section class="secFormLayout">
	<div class="mainInputBg">

		<div class="row" style="padding: 30px;">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
			</div>
			<div id="complaint-form-container">
				
				<div class="col-lg-12">
					<?php if(isset($errors)): ?>
						<div class="alert alert-danger" data-dismiss="alert">
							<?php echo $errors; ?>
						</div>
					<?php endif; ?>
					
					<?php if($this->session->flashdata('success')): ?>
						<div class="alert alert-info" data-dismiss="alert">
							<?php echo $this->session->flashdata('success'); ?>
						</div>
					<?php endif; ?>
				</div>
				
				<?php echo form_open('Complaint/add'); ?>
				
				<!-- <form method="POST" action="" id="complaint-form"> -->
					<div class="col-lg-12">
						<div class="inputFormMain">
							<select name="project" id="project" class="form-control" data-toggle="tooltip" title="Project" required>
								<option value="">Select Project</option>
								<?php foreach($projects as $p): ?>
								<option value="<?= $p->company_id; ?>"><?= $p->name; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

				    <div class="col-lg-12">
						<div class="inputFormMain">
							<select name="province" id="province" class="form-control province" data-toggle="tooltip" title="Province" required>
								<option value="">Select Province</option>
								<?php foreach($province as $p): ?>
								<option value="<?= $p->id; ?>"><?= $p->name; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<select name="district" id="district" class="form-control district" data-toggle="tooltip" title="District" required>
								<option value="">Select District</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<select name="tehsil" id="tehsil" class="form-control tehsil" data-toggle="tooltip" title="Tehsil" required>
								<option value="">Select Tehsil</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<select name="uc" id="uc" class="form-control union-council" data-toggle="tooltip" title="Union council" required>
								<option value="">Select Union Council</option>
								
							</select>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="name" value="" id="name" class="form-control" placeholder="Name" data-toggle="tooltip" title="Name" required>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="contact" value="" id="contact" class="form-control" placeholder="Contact #"  data-toggle="tooltip" title="Contact #" minlength="11" maxlength="11" required>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="email" value="" id="email" class="form-control" placeholder="Email address (optional)"  data-toggle="tooltip" title="Email address (optional)" >
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="subject" value="" id="subject" class="form-control" placeholder="Subject"  data-toggle="tooltip" title="Subject" required>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="complaint" id="complaint" class="form-control" rows="5" placeholder="Complaint Detail..." style="resize:vertical;" required></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button type="submit" name="submit" class="btn btn-block btnSubmit">Submit</button>		
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
</section>
</section>