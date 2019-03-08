<div class="container">
	<div class="row">
		<div class="col-md-5">
			<h2>Question with possible answers.</h2><hr>
			<small>The question will look like this to the applicant / candidate while taking exam / test.</small>
		</div>
		<div class="col-md-7">
			<h2>Question</h2>
			<small>Select the most appropriate option of the following!</small><hr>
			<p class="lead"><?php echo $view_one['id']; ?>. <?php echo $view_one['question']; ?></p>
			<strong>
				<input type="radio" name="option" value="option1"> A. 206 <br>
				<input type="radio" name="option" value="option2"> B. 301 <br>
				<input type="radio" name="option" value="option3"> C. 210 <br>
				<input type="radio" name="option" value="option4"> D. None of These 
			</strong><hr>
			<button type="submit" class="btn btn-info">Next &raquo;</button>
			<a class="btn btn-warning" href="<?php echo base_url('test/allquestions'); ?>">&raquo; Back</a>
		</div>
	</div>
</div>