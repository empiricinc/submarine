<?php 
/* Filename: test_submitted.php
*  Author: Saddam
*  Location: Views / test-system / test_submitted.php
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test System | Test Submitted </title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta name="og:card" content="" />
	<meta name="og:description" content="" />
	<meta name="og:title" content="" />
	<meta name="og:image" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,700,800|Roboto:400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('dashboardDesign/assets/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('dashboardDesign/assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('dashboardDesign/assets/css/style.css'); ?>">
	<script src="<?php echo base_url('dashboardDesign/assets/js/jquery.js'); ?>"></script>
</head>
<body>
	<section class="secMainWidth">
		<section class="secFormLayout">
			<div class="mainInputBg">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3 class="text-center" style="color: lightgreen;">Congratulations! <span>You've successfully attempted the exam, we'll soon be in touch !</span></h3>
						<div class="solidLine"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3">
						<?php if($success = $this->session->flashdata('success')): ?>
						<div class="alert alert-success alert-dismissable fade in">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo $success; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="submitBtn">
							<a href="http://www.ctc.org.pk" target="blank" class="btn btnSubmit">Visit our Site</a>
							<a href="http://www.ctc.org.pk/business-opportunities/jobs/" class="btn btnSubmit" target="blank">View Job Criteria</a>
							<a href="?" class="btn btnSubmit">Call for Result</a>
							<a href="?" class="btn btnSubmit">More info</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>
	<script src="<?php echo base_url('dashboardDesign/assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('dashboardDesign/assets/js/custom.js'); ?>"></script>
</body>
</html>