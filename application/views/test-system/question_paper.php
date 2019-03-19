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
			<?php $counter = 1; $i = 'A'; ?>
			<?php foreach($questions_rand as $que_rand) : ?>
				<p><strong><?php echo $counter++; ?>. <?php echo $que_rand->quest; ?></strong></p>
				<?php foreach($questions_rand as $ans_rand): ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $i++; ?> - <input type="checkbox" name="option" value="<?=$ans_rand->ans_id; ?>"> <?= $ans_rand->ans_name; ?><br>
			<?php endforeach;  echo "<hr>"; endforeach; ?>
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>
</div>