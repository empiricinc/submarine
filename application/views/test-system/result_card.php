<?php 
/* Filename: result_card.php
*  Author: Saddam
*  Location: Views / test-system / result_card.php
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
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
</head>
<body>
	<section class="secMainWidth">
		<section class="secFormLayout">
			<div class="mainInputBg">
				<div class="col-lg-12 text-center">
					<div class="tabelHeading">
						<h3>Applicant's result card</h3>
						<div class="solidLine"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 text-center">
					<?php $counter = 0; foreach($calc_result as $result): ?>
						<p><strong style="font-weight: bold; color: red; font-size: 25px;"><?php ++$counter; ?></strong> <strong><?php //echo $result->ans_name; ?></strong></p>
					<?php endforeach; ?>
					<?php if($counter > 6): // If an applicant scored more than 6, will be passed. ?>
						<h3 style="text-align: center; color: green;">Your score is: <strong style="font-size: 2em;"><?php echo $counter; ?></strong>
						</h3><br>
					<?php else: // If an applicant scored less than 6, will be failed. ?>
						<h3 style="text-align: center; color: red;">Your score is: <strong style="font-size: 2em; text-shadow: 15px 18px #aeafaf;"><?php echo $counter; ?></strong><br>
						</h3><br>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	</section>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
</body>
</html>