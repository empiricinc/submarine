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
					<?php if(empty($results)): ?>
						<h3>papers list | <small> click on any of the job to view the paper for that specific job post...</small></h3>
					<?php else: ?>
						<h3>search results | <small> for <?php echo $_GET['search_papers']; ?></small></h3>
					<?php endif; ?>
					</div>
				</div>
				<div class="col-md-4 text-right">
					<form class="form-inline" action="<?php echo base_url('tests/papers_search'); ?>" method="get">
						<div class="input-group">
							<input type="text" name="search_papers" class="form-control" placeholder="Search papers" required="" autocomplete="off">
							<div class="input-group-btn">
								<button type="submit" class="btn btn-default">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div><hr>
			<?php $counter = $this->uri->segment(3) + 1;
			if(!empty($papers)):
			foreach ($papers as $paper): ?>
			<strong><?php echo $counter++; ?>. </strong>
				<a href="<?= base_url(); ?>tests/paper/<?= $paper->job_id; ?>"><?php echo $paper->job_title; ?></a><br>
			<?php endforeach; endif; ?>
			<?php if(!empty($results)): foreach($results as $result): ?>
				<strong><?php echo $counter++; ?>. </strong>
				<a href="<?= base_url(); ?>tests/paper/<?= $result->job_id; ?>"><?php echo $result->job_title; ?></a><br>
			<?php endforeach; endif; ?>
			<?php if(empty($papers) AND empty($results)): ?>
				<div class="alert alert-danger text-center">
					<p><strong>Oops!</strong> The keyword <strong>( <?php echo $_GET['search_papers']; ?> )</strong> you just entered was Not Found.</p>
				</div>
			<?php endif; ?>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10 text-center">
					<?php if(!empty($papers) AND empty($results)){ echo $this->pagination->create_links(); } ?>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</section>
</section>