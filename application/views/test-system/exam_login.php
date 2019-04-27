<?php
/* Filename: exam_login.php
*  Location: views/test-system/exam_login.php
*  Author: Saddam
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Applicant Login | Test System</title>
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
	<section class="secLogin">
	<div class="container">
		<div class="loginWhite">
			<div class="row">
				<div class="col-md-6">
					<div class="mainLeftImg">
						<div class="loginLogo">
							<img src="<?php echo base_url('dashboardDesign/assets/img/loginLogo.png'); ?>" alt="">
						</div>
						<img src="<?php echo base_url('dashboardDesign/assets/img/login.png'); ?>" alt="">
						<p>
							Hiring staff for Civil Society Human and Institutional development Program (CHIP) in Pakistan.
						</p>
					</div>
				</div>
				<div class="col-md-6">
					<form action="<?php echo base_url('tests/begin_exam'); ?>" method="post">
						<div class="rightLoginMain">
							<div class="aligmentWrap">
								<h3 style="margin-bottom: 4px;">Applicant's Login</h3>
								<small>Enter the roll that you have got while applying.</small>
								<div class="loginInput">
									<input type="hidden" name="test_date" value="<?php echo date('Y-m-d'); ?>">
									<input name="roll_no" type="text" class="form-control" placeholder="Enter your roll number here..." required>
								</div>
								<div class="loginInput">
									<button type="submit" class="btn btn-block">
										proceed
									</button>
								</div>
								<?php if($failed = $this->session->flashdata('failed')): ?>
								<div class="alert alert-danger alert-dismissable text-center">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<p><?php echo $failed; ?></p>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url('dashboardDesign/assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('dashboardDesign/assets/js/custom.js'); ?>"></script>
</body>
</html>