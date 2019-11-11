<section class="secMainWidth hide-from-print">
	<section class="secFormLayout">
		<div class="mainInputBg">

			<div class="row">
				<div class="col-lg-10">
					<div class="tabelHeading" style="margin-bottom: 0px;">
						<h3>
							<?= $title; ?>
							<br><br>
							<div class="btn-group">
								<button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
									<i class="fa fa-cog"></i> ADMIN <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu">
									<li>
										<a class="dropdown-item" href="#edit-investigation-modal" data-toggle="modal">
											<i class="fa fa-edit"></i> Edit
										</a>
									</li>
								</ul>
							</div>
							

							<button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('comments-form').scrollIntoView();">
								<i class="fa fa-comment"></i> COMMENT
							</button>
							
						<?php if($detail->status != 'cancel'): ?>
							<?php if($detail->status == 'initiated' OR $detail->status == 'in-progress') { ?>
							<button type="button" class="btn btn-sm btn-danger status-modal-btn" data-status="cancel">
							<i class="fa fa-trash"></i> DELETE
							</button>
							<?php } ?>

							<?php if($detail->status == 'initiated') { ?>
							<button type="button" class="btn btn-sm btn-default status-modal-btn" data-status="<?= $detail->status; ?>">
								<i class="fa fa-arrow-down"></i> IN-PROGRESS
							</button>
							<?php } elseif($detail->status == 'in-progress') {  ?>
							<button type="button" class="btn btn-sm btn-default status-modal-btn" data-status="<?= $detail->status; ?>">
								<i class="fa fa-magic"></i> COMPLETED
							</button>
							<?php } elseif($detail->status == 'completed') { ?>
							<button type="button" class="btn btn-sm btn-default status-modal-btn" data-status="<?= $detail->status; ?>">
								<i class="fa fa-archive"></i> SUBMITTED
							</button>
							<?php } ?>
						<?php endif; ?>
						</h3>
					</div>
				</div>
			</div>
			<div class="row" style="margin-left: 0px; margin-right: 0px; margin-top: 5px;">
				
				<?php if($this->session->flashdata('success')): ?>
					<div class="alert alert-info" data-dismiss="alert">
						<?php echo $this->session->flashdata('success'); ?>
					</div>

				<?php elseif($this->session->flashdata('error')): ?>
					<div class="alert alert-danger" data-dismiss="alert">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php 
				$label = '';
				if($detail->status == "initiated") 
					$label = "label label-warning";
				elseif($detail->status == "submitted")
					$label = "label label-primary";
				elseif($detail->status == "completed")
					$label = "label label-success";
				elseif($detail->status == "in-progress")
					$label = "label label-info";
				elseif($detail->status == "cancelled")
					$label = "label label-danger";
			 ?>

			<div class="solidLine"></div>
				<div class="row">
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Employee Name</strong></div>
						<div class="col-lg-4"><?= ucwords($detail->emp_name); ?></div>

						<div class="col-lg-2"><strong>Project</strong></div>
						<div class="col-lg-4"><?= $detail->project_name; ?></div>
					</div>

					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Department</strong></div>
						<div class="col-lg-4"><?= $detail->department_name; ?></div>
						<div class="col-lg-2"><strong>Designation</strong></div>
						<div class="col-lg-4"><?= $detail->designation_name; ?></div>
					</div>

					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Status</strong></div>
						<div class="col-lg-4"><label class="<?= $label; ?>"><?= $detail->status; ?></label></div>
					</div>

					<!-- <div class="col-lg-12"><hr></div> -->
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Reason</strong></div>
						<div class="col-lg-4"><?= ($detail->reason_id == '0') ? 'None' : $detail->reason_text; ?></div>
						<div class="col-lg-2"><strong>Other Reason</strong></div>
						<div class="col-lg-4"><?= ($detail->other_reason == '') ? 'None' : $detail->other_reason; ?></div>
					</div>

					<!-- <div class="col-lg-12"><hr></div> -->
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Evidence</strong></div>
						<div class="col-lg-4"><?= ($detail->evidence) ? 'Yes' : 'No'; ?></div>

						<div class="col-lg-2"><strong>Evidence Date</strong></div>
						<div class="col-lg-4"><?= date('d-m-Y', strtotime($detail->evidence_date)); ?></div>
					</div>
					

					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Reported By</strong></div>
						<div class="col-lg-4"><?= $detail->reported_by; ?></div>

						<div class="col-lg-2"><strong>Reported Date</strong></div>
						<div class="col-lg-4"><?= date('d-m-Y', strtotime($detail->reported_date)); ?></div>
					</div>

					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Description</strong></div>
					</div>
					<div class="col-lg-12">
						<div class="col-lg-10 text-justify"><?= $detail->description; ?></div>
					</div>
					
				</div>
				
				<div class="col-lg-12"><hr></div>
				
				<div class="col-lg-12 pl-0 pr-0">
					<div class="col-lg-12">
						<h3><i class="fa fa-pencil"></i> Investigation Updates</h3>
					</div>
					<div class="col-lg-12">
						<table class="table table-condensed table-bordered">
							<thead>
								<tr>
									<th style="width: 10%;">Check</th>
									<th>Updates</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<input 
											type="checkbox" name="analysis" class="inv-checklist"
											<?php if($detail->analysis): ?> checked <?php endif; ?>
											>
									</td>
									<td>Preliminary Analysis</td>
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="investigation" class="inv-checklist"
										<?php if($detail->investigation): ?> checked <?php endif; ?>
										>
									</td>
									<td>Investigation Process</td>
								</tr>
								<tr>
									<td>
										<input type="checkbox" name="conclusion" class="inv-checklist"
										<?php if($detail->conclusion): ?> checked <?php endif; ?>
										>
									</td>
									<td>Finding and Conclusion</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-12"><hr></div>
				<div class="row" style="margin-right: 2px;">
					<div class="col-lg-4">
						<div class="col-lg-12">
							<h3 class="mt-0"><i class="fa fa-paperclip"></i> Attachments</h3>
							<ul class="pl-15">
							<?php foreach($files AS $f): ?>
								<li>
									<a href="<?= base_url(); ?>uploads/investigation_files/<?= $f->file_name; ?>" target="_blank">
										<?= $f->original_name; ?>
									</a>
									<small>
										, Uploaded by: <?= ucwords($f->emp_name); ?>, at: <?= date('d-m-Y', strtotime($f->upload_date)); ?>
									</small>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
						<div class="col-lg-12">
							<form action="<?= base_url(); ?>Investigation/upload_attachments" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="investigation_id" id="investigation-id" value="<?= $detail->id; ?>">
								<div class="inputFormMain col-lg-12 plr-0">
									<input type="file" name="files[]" class="form-control" multiple>
								</div>

								<div class="submitBtn">
									<button type="submit" class="btn btnSubmit btn-block" id="save-btn"> Attach Files </button>
								</div>	
							</form>
						</div>
					</div>
					<div class="col-lg-8">
						<h3 class="mt-0"><i class="fa fa-history"></i> Status History</h3>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Status</th>
									<th>Description</th>
									<th>Added By</th>
									<th>Added Date</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Initiate</td>
									<td width="50%"><?= $detail->description; ?></td>
									<td><?= ucwords($detail->emp_name); ?></td>
									<td><?= date('d-m-Y', strtotime($detail->entry_at)); ?></td>
								</tr>
								<?php foreach ($status_comment as $c): ?>
								<tr>
									<td><?= ucwords($c->status); ?></td>
									<td width="50%"><?= $c->comment_text; ?></td>
									<td><?= ucwords($c->emp_name); ?></td>
									<td><?= date('d-m-Y', strtotime($c->added_date)); ?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-12"><hr></div>


				<div class="row">
					<div class="col-lg-12">
						<div class="col-lg-12">
							<h3><i class="fa fa-comment"></i> Comments</h3>
						</div>

						<div class="col-lg-12" id="comments">
							<?php foreach($comment AS $c): ?>
							<blockquote style="font-size: 14px;">
								<small> Comment By: <?= $c->emp_name; ?>, Date: <?= $c->added_date; ?></small>
								<div>
									<?= $c->comment_text; ?>
								</div>
							</blockquote>	
							<?php endforeach; ?>
						</div>

						<form action="<?= base_url(); ?>Investigation/add_comments" method="POST" enctype="multipart/form-data" id="comments-form">
							<div class="inputFormMain col-lg-12">
								<input type="hidden" name="status" value="<?= $detail->status; ?>">
								<input type="hidden" name="investigation_id" value="<?= $detail->id; ?>">

								<textarea name="comments" id="comments" class="form-control resize-v" rows="5" required="required" placeholder="Add your comments here..."></textarea>	
							</div>

							<div class="submitBtn col-lg-3 pr-0">
								<button type="submit" class="btn btnSubmit" id="save-btn"> Add </button>
							</div>	
						</form>
					</div>
				</div>		

		</div>
	</section>
</section>

