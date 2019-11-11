<?php
/* Filename: question_paper.php
*  Location: views/test-system/question_paper.php
*  Author: Saddam
*/
?>
<style type="text/css">
	ul{
		list-style-type: none;
	}
	ul#list li{
		padding-left: 15px;
		display: inline-block;
	}
	hr:last-child{
		display: none;
	}
</style>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-8">
					<div class="tabelHeading">
						<h3>paper pattern | <small>for the post of: <strong data-toggle="tooltip" title="<?php echo $questions_rand[0]->job_title; ?>" data-placement="bottom"><?php if(!empty($questions_rand)){ echo substr($questions_rand[0]->job_title, 0, 56).' &hellip;'; } ?></strong></small></h3>
					</div>
				</div>
				<div class="col-lg-4 text-right">
					<strong>Total Marks: </strong>
					<?php $query = $this->db->query('SELECT job_id, SUM(marks) as total FROM exam_paper group by job_id')->result();
						foreach ($query as $value){
							$total = $value->total;
					} echo $total; ?>
				</div>
			</div><hr>
			<form action="<?php //echo base_url('tests/applicants_test'); ?>" method="post">
				<ul id="list">
					<?php $counter = 1;  ?>
					<?php foreach($qdash as $que_rand) : ?>
						<p>
							<strong>
								<?php echo $counter++; ?>. <?php echo $que_rand->question; ?>
							</strong> Having marks <span style="color: red; font-weight: bold;"><?php echo $que_rand->marks; ?></span>
						</p>
						<?php $i = 'A'; // Initialize the variable.
						foreach($questions_rand as $ans): ?>
						<?php if($que_rand->id == $ans->q_id): ?>
						<li>
							<strong>
								<?php echo $i++; // Print alphabetical numbers before the options. ?>
							-</strong>
							<input type="radio" name="answer[]<?php echo $ans->q_id; ?>" value="<?=$ans->ans_id; ?>"> 
							<?= $ans->ans_name; ?>
						</li>
					<?php endif;
						endforeach; ?>
					<?php echo "<hr>"; endforeach;  ?>
				</ul>
			</form><br>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10 text-center">
					<?php //echo $this->pagination->create_links(); ?>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</section>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>