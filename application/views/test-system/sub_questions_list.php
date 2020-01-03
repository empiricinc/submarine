<?php 
/* Filename: projects.php
*  Author: Saddam
*  Location: views / test-system / projects.php
*/
?>
<?php if(empty($results)): ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>subjective questions <span>(list of the subjective questions) | <a href="<?php echo base_url('tests/subjective_paper'); ?>" class="btn btn-primary btn-sm">add new</a> <a href="<?php echo base_url('tests/subjective_paper_view'); ?>" class="btn btn-info btn-info btn-sm">View Paper</a> <a href="<?php echo base_url('tests/attempted_papers'); ?>" class="btn btn-info btn-warning btn-sm">Attempted Papers</a></span></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/search_subjective'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_question" class="form-control" placeholder="Search questions..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php if($success = $this->session->flashdata('success')): ?>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<div class="alert alert-success text-center">
								<p><?php echo $success; ?></p>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>serial #</th>
											<th>question</th>
											<th>project</th>
											<th>desingation</th>
											<th>actions</th>
										</tr>
									</thead>
									<tbody>
									<?php if(!empty($sub_questions)): $counter = $this->uri->segment(3) + 1;
										foreach($sub_questions as $question): ?>
										<tr>
											<td><?php echo $counter++; ?></td>
											<td>
												<?php $detail = $this->Tests_model->single_subjective($question->id); ?><?php echo substr($question->question_text, 0, 25); ?><a data-toggle="modal" data-target="#question_detail<?php echo $question->id; ?>" href="#question_detail">... read more &raquo;</a>
												<!-- Modal -->
												<div id="question_detail<?php echo $question->id; ?>" class="modal fade" role="dialog">
												  <div class="modal-dialog">
												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">Question Detail</h4>
												      </div>
												      <div class="modal-body">
												        <?php echo $detail->question_text; ?>
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												      </div>
												    </div>
												  </div>
												</div>
											</td>
											<td><?php echo $question->name; ?></td>
											<td><?php echo $question->designation_name; ?></td>
											<td>
												<a href="<?=base_url();?>tests/edit_subjective/<?=$question->id; ?>" class="btn btn-primary btn-sm">Edit</a>
												<a href="<?=base_url();?>tests/delete_subjective/<?=$question->id; ?>" class="btn btn-danger btn-sm" onclick="javascript:return confirm('Are you sure to delete ?');">Delete</a>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="tabelSideListing text-center">
							<span><?php echo $this->pagination->create_links(); endif; ?></span>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php else: ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>you've searched for : <span><?php echo $_GET['search_question']; ?></span></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/search_subjective'); ?>" method="get">
								<div class="inputFormMain">
									<a href="javascript:history.go(-1);" class="form-control">Go back</a>
									<div class="input-group">
										<input type="text" name="search_question" class="form-control" placeholder="Search questions..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>serial #</th>
											<th>question</th>
											<th>project</th>
											<th>designation</th>
											<th>actions</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($results)) : $counter = $this->uri->segment(3) + 1;
										foreach($results as $result): ?>
										<tr>
											<td><?php echo $counter++; ?></td>
											<td><?php echo $result->question_text; ?></td>
											<td><?php echo $result->name; ?></td>
											<td><?php echo $result->designation_name; ?></td>
											<td>
												<a href="<?=base_url();?>tests/edit_subjective/<?=$result->id; ?>" class="btn btn-primary btn-sm">Edit</a>
												<a href="<?=base_url();?>tests/delete_subjective/<?=$result->id; ?>" class="btn btn-danger btn-sm" onclick="javascript:return confirm('Are you sure to delete ?');">Delete</a>
											</td>
										</tr>
										<?php endforeach; endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>