<?php 
/*  Filename : test.php
*	Author: Saddam
*	Location : views / test-system / test.php 
*/
?>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<?php if($success = $this->session->flashdata('success')): ?>
						<div class="alert alert-success">
							<p class="text-center"><?php echo $success; ?></p>
						</div>
					<?php endif; ?>
					<div class="tabelHeading">
						<h3>add possible answers</h3>
					</div>
				</div>
				<form method="post" action="<?php echo base_url('tests/add_answers'); ?>">
					<input type="hidden" name="que_id" value="<?php echo $addopt['id']; ?>">
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="question" rows="6" class="form-control"  placeholder="Start typing question here..."><?php echo $addopt['question']; ?></textarea>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input name="option[]" type="text" class="form-control" placeholder="1. Write answer here..." required value="<?php if(!empty($opt_exist)){ echo $opt_exist[0]->ans_name; } ?>">
							<input type="radio" name="mark" value="1" <?php if(!empty($opt_exist) AND $opt_exist[0]->status == 1): ?> checked <?php endif; ?>> Mark as correct
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input name="option[]" type="text" class="form-control" placeholder="2. Write answer here..." required value="<?php if(!empty($opt_exist)){ echo $opt_exist[1]->ans_name; } ?>">
							<input type="radio" name="mark" value="2" <?php if(!empty($opt_exist) AND $opt_exist[1]->status == 1): ?> checked <?php endif; ?>> Mark as correct
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input name="option[]" type="text" class="form-control" placeholder="3. Write answer here..." required value="<?php if(!empty($opt_exist)){ echo $opt_exist[2]->ans_name; } ?>">
							<input type="radio" name="mark" value="3" <?php if(!empty($opt_exist) AND $opt_exist[2]->status == 1): ?> checked <?php endif; ?>> Mark as correct
						</div>
					</div>
					<div class="col-lg-3">
						<div class="inputFormMain">
							<input name="option[]" type="text" class="form-control" placeholder="4. Write answer here..." required value="<?php if(!empty($opt_exist)){ echo $opt_exist[3]->ans_name; } ?>">
							<input type="radio" name="mark" value="4" <?php if(!empty($opt_exist) AND $opt_exist[3]->status == 1): ?> checked <?php endif; ?>> Mark as correct
						</div>
					</div>
					<div class="col-lg-12">
						<div class="submitBtn">
							<button id="save" type="submit" class="btn btnSubmit">Submit</button>
							<a href="<?php echo base_url('tests/all_questions'); ?>" class="btn btnSubmit">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</section>