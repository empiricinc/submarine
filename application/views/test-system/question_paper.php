<?php
/* Filename: question_paper.php
*  Location: views/test-system/question_paper.php
*  Author: Saddam
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Question Paper | Test System</title>
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
<style type="text/css">
	ul{
		list-style-type: none;
	}
	ul li{
		padding-left: 15px;
		display: inline-block;
	}
	hr:last-child{
		display: none;
	}
</style>
<body>
	<section class="secMainWidth">
		<section class="secFormLayout">
			<div class="mainInputBg">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3 style="color: lightgreen;">your time starts now | <span id="time"></span> <small> remaining ...</small></h3>
					</div>
				</div>
				<form action="<?php echo base_url('tests/applicants_test'); ?>" method="post" id='js_submit'>
					<ul>
						<?php $counter = 1;  ?>
						<?php foreach($qdash as $que_rand) : ?>
							<input type="hidden" name="question_id[]" value="<?php echo $que_rand->id; ?>">
							<input type="hidden" name="applicant_id" value="<?php echo $this->uri->segment(3); ?>">
							<p>
								<strong>
									<?php echo $counter++; ?>. <?php echo $que_rand->question; ?>
								</strong>
							</p>
							<?php $i = 'A'; // Initialize the variable.
							foreach($questions_rand as $ans): ?>
							<?php if($que_rand->id == $ans->ques_id): ?>
							<li>
								<strong>
									<?php echo $i++; // Print alphabetical numbers before the options. ?>
								-</strong>
								<input type="radio" name="answer[]<?php echo $ans->ques_id; ?>" value="<?=$ans->ans_id; ?>"> 
								<?= $ans->ans_name; ?>
							</li>
						<?php endif;
							endforeach; ?>
						<?php echo "<hr>"; endforeach;  ?>
					</ul>
					<div class="submitBtn">
						<button type="submit" class="btn btnSubmit" onclick="javascript: return confirm('Are you sure to submit the test? Make sure you have attempted all the questions.');">Submit Test</button>
						<button type="reset" class="btnSubmit">Clear</button>
						<a href="<?php echo base_url('tests/exam_login'); ?>" class="btnSubmit">Logout</a>
					</div>
				</form><br>
			</div>
		</section>
	</section>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
	<script type="text/javascript">
// Countdown Timer for test paper. 
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            timer = 0;
            //alert("Your time has ended. Click OK to continue !");
            document.getElementById('js_submit').submit();
            // timer = duration; // uncomment this line to reset timer automatically after reaching 0
        }
    }, 1000);
}
window.onload = function () {
	// Show user the messages before beginning the paper.
	alert("Your time starts now. Click OK to begin paper...");
	alert("Are you sure to begin paper?");
    var time = 70 * 60 // your time in seconds here 70 * 60 means 70 minutes.
        display = document.querySelector('#time');
    startTimer(time, display);
};
// Disable the F5 and R key to restrict the user from reloading the page.
document.onkeydown = function(){
  switch (event.keyCode){
        case 116 : //F5 button
            event.returnValue = false;
            event.keyCode = 0;
            return false;
        case 82 : //R button
            if (event.ctrlKey){ 
                event.returnValue = false;
                event.keyCode = 0;
                return false;
            }
    }
}
// Disable the mouse's right-click on the page which the user is currently on. (Question Paper)
document.addEventListener('contextmenu', event => event.preventDefault());
</script>
</body>
</html>