<?php 
/* 
* Filename: question_paper.php
* Location: Views/test-system/question_paper.php
* Author  : Saddam
*/
?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<h1>Question Paper</h1><hr>
			<p class="lead text-justify">Select only one option from the list, OR your answer will not be given credit. So please be very careful in selecting options. When you complete the questions on this page move to the next page through the links given below.</p>
		</div>
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-8 text-left">
					<h1>Back Home</h1><hr>
				</div>
				<div class="col-md-4 text-right">
					<a href="<?php echo base_url('tests/all_questions'); ?>" class="btn btn-info btn-lg btn-block">Back To Home</a>
				</div>
			</div>
			<form action="#" method="post">
				<?php $counter = 1; $i = 'A';  ?>
				<?php foreach($qdash as $que_rand) : ?>
					<p><strong><?php echo $counter++; ?>. <?php echo $que_rand->question; ?></strong></p>
					<?php foreach($questions_rand as $ans): ?>
						<input type="hidden" name="question_id" value="<?php echo $que_rand->id; ?>">
				<?php if($que_rand->id == $ans->ques_id): ?>
				<strong style="color: red; font-weight: bold;"><?php echo $i++; ?> - </strong>
				<input type="checkbox" name="option" value="<?=$ans->ans_id; ?>"> <?= $ans->ans_name; ?><br>
				<?php endif; 
					endforeach; ?>
				<?php echo "<hr>";endforeach;  ?>
				<br>
				<button type="submit" class="btn btn-info" id="next">Submit Test</button>
				<button type="reset" class="btn btn-warning" id="cancel">Cancel</button>
			</form>
			<?php //echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var curDiv = $('#tab_1');
		curDiv.show();
		$('#next').click(function(){
			curDiv = curDiv.next();
			curDiv.show().prev().hide();
			$('#prev').show();
		});
		$('#prev').click(function(){
			curDiv = curDiv.prev();
			curDiv.next().hide();
		});
	});
</script>