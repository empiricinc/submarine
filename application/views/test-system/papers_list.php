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
						<h3>papers list | <small> click on any of the job to view the paper for that specific job post...</small></h3>
					</div>
				</div>
			</div>
			<?php $counter = $this->uri->segment(3) + 1; foreach ($papers as $paper): ?>
			<strong><?php echo $counter++; ?>. </strong>
				<a href="<?= base_url(); ?>tests/paper/<?= $paper->job_id; ?>"><?php echo $paper->job_title; ?></a>
			<?php endforeach; ?>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10 text-center">
					<?php echo $this->pagination->create_links(); ?>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</section>
</section>