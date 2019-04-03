<?php 
/* 
* Filename: question_paper.php
* Location: Views/test-system/question_paper.php
* Author  : Saddam
*/
?>
<style type="text/css">
	ul li#alpha{
		list-style-type: cjk-earthly-branch;
		font-variant: initial;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h1>Question Paper</h1><hr>
			<p class="lead text-justify">Select only one option from the list, OR your answer will not be given credit. So please be very careful in selecting options. When you complete the questions on this page move to the next page through the links given below.</p>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-8 text-left">
					<!-- Added the timer here, JavaScript timer, initially set to 60 minutes. -->
					<h1>Back Home. <small><span id="time"></span> minutes remaining.</small></h1><hr>
				</div>
				<div class="col-md-4 text-right">
					<a href="<?php echo base_url('tests/all_questions'); ?>" class="btn btn-info btn-lg btn-block">Back To Home</a>
				</div>
			</div>
			<form action="<?php echo base_url('tests/applicants_test'); ?>" method="post">
				<ul>
					<?php $counter = 1; //$i = 'A';  ?>
					<?php foreach($qdash as $que_rand) : ?>
						<input type="hidden" name="question_id[]" value="<?php echo $que_rand->id; ?>">
						<p><strong><?php echo $counter++; ?>. <?php echo $que_rand->question; ?></strong></p>
						<?php foreach($questions_rand as $ans): ?>
					<?php if($que_rand->id == $ans->ques_id): ?>
						<li id="alpha"><input type="checkbox" name="answer[]" value="<?=$ans->ans_id; ?>"> <?= $ans->ans_name; ?></li>
					<br>
					<?php endif; 
						endforeach; ?>
					<?php echo "<hr>";endforeach;  ?>
				</ul>
				<br>
				<button type="submit" class="btn btn-info" id="next">Submit Test</button>
				<a href="<?php echo base_url('tests/all_questions'); ?>" class="btn btn-warning">Cancel</a>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
// Countdown Timer for test paper. 
function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds;
    function timer() {
        // get the number of seconds that have elapsed since 
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);
        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds; 
        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            start = Date.now() + 1000;
        }
    };
    // we don't want to wait a full second before the timer starts
    timer();
    setInterval(timer, 1000);
}

window.onload = function () {
    var fiveMinutes = 60 * 60,
        display = document.querySelector('#time');
    startTimer(fiveMinutes, display);
};
</script>