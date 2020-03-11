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
				<div class="row mainInputBg">
					<form method="post" action="<?php echo base_url('tests/applicant_test_subjective'); ?>" id="js_submit">
						<input type="hidden" name="applicant_id" value="<?php echo $this->uri->segment(3); ?>">
						<?php if($questions): $counter = 1; foreach($questions as $question): ?>
							<input type="hidden" name="question_id[]" value="<?php echo $question->id; ?>">
							<label><?php echo 'Question '.$counter++; ?>.
								<?php echo $question->question_text; ?>
							</label>
							<div class="col-lg-12">
								<div class="inputFormMain">
									<textarea name="answer[]" class="form-control" style="color: #aeafaf;" rows="6" placeholder="Start typing your answers here..."></textarea>
								</div>
							</div>
						<?php endforeach; endif; ?>
						<div class="col-lg-12">
							<div class="submitBtn">
								<button id="save" type="submit" class="btn btnSubmit">Submit</button>
								<button type="reset" class="btn btnSubmit">Reset</button>
							</div>
						</div>
					</form>
				</div><hr>
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
    var time = 45 * 60 // your time in seconds here 70 * 60 means 70 minutes.
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
