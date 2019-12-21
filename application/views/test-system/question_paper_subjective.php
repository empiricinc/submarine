<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<form method="post" action="<?php echo base_url('tests/save_subjective_paper'); ?>">
					<?php if($questions): $counter = 1; foreach($questions as $question): ?>
						<input type="hidden" name="question_id" value="<?php echo $question->id; ?>">
						<input type="hidden" name="applicant_id" value="">
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