<?php 
/*  Filename : edit_question.php
*	Author: Saddam
*	Location : views / test-system / edit_question.php 
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="tabelHeading">
						<h3>modify/update question</h3>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('tests/update_question'); ?>">
					<input type="hidden" name="que_id" value="<?php echo $edit['id']; ?>">
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="question" rows="6" class="form-control"><?php echo $edit['question']; ?></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Save Changes</button>
							<a href="<?php echo base_url('tests/all_questions');?>" class="btn btnSubmit">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</section>
