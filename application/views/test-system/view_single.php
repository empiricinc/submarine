<?php
/* Filename: view_single.php
*  Location: views/test-system/view_single.php
*  Author: Saddam
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<?php if($success = $this->session->flashdata('success')): ?>
						<div class="alert alert-success text-center">
							<?php echo $success; ?>
						</div>
					<?php endif; ?>
					<div class="tabelHeading">
						<h3>question detail</h3>
					</div>
					<?php $count = 'A'; // Print alphabets before the options for each question.
					foreach($view_one as $one) : // Took the foreach here to hide the error. ?>
						<a href="<?php echo base_url();?>tests/edit/<?php echo $one['ques_id']; ?>"><p class="lead"><?php echo $one['ques_id']; ?>. <?php echo $one['ques']; ?></p></a>
						<?php foreach($view_one as $one_ques): // Use nested foreach loop to print the data of another DB table and break to display just one record out of the 4 records with same ID. ?>
					<div class="row">
						<div class="col-lg-5">
							<?php echo "<strong>" . $count++ . " - " . "</strong>" ; ?>
							<a href="<?php echo base_url();?>tests/edit_answer/<?php echo $one_ques['ans_id']; ?>"><?php echo $one_ques['ans_name']; ?></a>
						</div>
						<div class="col-lg-4 submitBtn">
							<a href="<?php echo base_url('tests/edit_answer/'); ?><?php echo $one_ques['ans_id']; ?>" class="btn btnSubmit">Modify</a>
						</div>
					</div><br>
					<?php endforeach; break; // END and BREAK the second "foreach". ?>
					<?php endforeach; // END the first "foreach loop". ?>
					<div class="submitBtn">
						<a class="btn btnSubmit" href="<?php echo base_url('tests/view_single/'); ?><?php $count_id = $one['ques_id']+1; echo $count_id++; ?>">Move Forward &raquo;</a>

						<a class="btn btnSubmit" href="<?php echo base_url('tests/view_single/'); ?><?php $count_id = $one['ques_id']-1; echo $count_id--; ?>">Move Backward &laquo;</a>

						<a class="btn btnSubmit" href="javascript:history.go(-1);">Back &laquo;</a>
					</div>
				</div>
			</div>
				<small>[&hellip; You can only modify answers, and can't delete them so that you're seeing only the modify link against each answer here &hellip;]</small>
		</div>
	</section>
</section>