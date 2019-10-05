<section class="secMainWidth hide-from-print">
	<section class="secFormLayout">
		<div class="mainInputBg">

			<div class="row">
				<div class="col-lg-10">
					<div class="tabelHeading" style="margin-bottom: 0px;">
						<h3>
							<?= $title; ?>
							<br><br>
							<button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('comments-form').scrollIntoView();">
								<i class="fa fa-comments"></i> COMMENTS
							</button>

						<?php if($detail->status_text != 'delete'): ?>
							<?php if($detail->status_text == 'open' OR $detail->status_text == 'pending'): ?>
								<button type="button" class="btn btn-sm btn-danger disciplinary-status-btn" data-text="delete">
									<i class="fa fa-trash"></i> DELETE
								</button>
							<?php endif; ?>
							

							<?php if($detail->status_text == 'open') { ?>
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="pending">
									<i class="fa fa-archive"></i> PENDING	
								</button>
							<?php } elseif($detail->status_text == 'pending') { ?>
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="issued">
									<i class="fa fa-archive"></i> ISSUE	
								</button>
							<?php } elseif($detail->status_text == 'issued') { ?>
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="printed">
									<i class="fa fa-archive"></i> PRINT	
								</button>
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="no action">
									<i class="fa fa-archive"></i> NO ACTION	
								</button>
							<?php } elseif($detail->status_text == 'printed') { ?>
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="delivered">
									<i class="fa fa-archive"></i> DELIVER
								</button>

							<?php } elseif($detail->status_text == 'delivered') { ?>
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="received">
									<i class="fa fa-archive"></i> RECEIVED
								</button>
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="not received">
									<i class="fa fa-archive"></i> NOT RECEIVED
								</button>
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="no action">
									<i class="fa fa-archive"></i> NO ACTION
								</button>

							<?php } ?>
						
						<?php endif; ?>
						</h3>
					</div>
				</div>
				<!-- <div class="col-lg-2">
					<a href="javascript:void(0);" class="label label-primary">Disciplinary Action</a>
				</div> -->
			</div>
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
						<div class="col-lg-2"><strong>Type</strong></div>
						<div class="col-lg-4"><label class="label label-primary"><?= strtoupper($detail->type_name); ?></label></div>
						<div class="col-lg-2"><strong>Status</strong></div>
						<div class="col-lg-4"><label class="label label-warning"><?= strtoupper($detail->status_text); ?></label></div>
					</div>

					<!-- <div class="col-lg-12"><hr></div> -->
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Reason</strong></div>
						<div class="col-lg-4"><?= $detail->reason_text; ?></div>
						<div class="col-lg-2"><strong>Other Reason</strong></div>
						<div class="col-lg-4"><?= $detail->other_reason; ?></div>
					</div>

					<!-- <div class="col-lg-12"><hr></div> -->
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Evidence</strong></div>
						<div class="col-lg-4"><?= ($detail->evidence) ? 'Yes' : 'No'; ?></div>

						<div class="col-lg-2"><strong>Evidence Date</strong></div>
						<div class="col-lg-4"><?= date('d-m-Y', strtotime($detail->evidence_date)); ?></div>
					</div>
					
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Salary Hold</strong></div>
						<div class="col-lg-4"><?= ($detail->salary_hold) ? 'Yes' : 'No'; ?></div>
					</div>

					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Reported By</strong></div>
						<div class="col-lg-4"><?= $detail->reported_by; ?></div>

						<div class="col-lg-2"><strong>Reported Date</strong></div>
						<div class="col-lg-4"><?= date('d-m-Y', strtotime($detail->reported_date)); ?></div>
					</div>

					

					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Description</strong></div>
						<div class="col-lg-4"><?= $detail->description; ?></div>
					</div>
					
				</div>
				
				<div class="col-lg-12"><hr></div>
				
				<div class="row" style="margin-left: 2px; margin-right: 2px;">
					<div class="col-lg-4">
						<h4 style="margin-top: 0px;">Attachments</h4>
						<ul style="padding-left: 15px;">
						<?php foreach($files AS $f): ?>
							<li>
								<a href="<?= base_url(); ?>uploads/disciplinary_files/<?= $f->file_name; ?>" target="_blank">
									<?= $f->original_name; ?>
								</a>
								<small>
									, Uploaded by: <?= ucwords($f->emp_name); ?>, at: <?= date('d-m-Y', strtotime($f->upload_date)); ?>
								</small>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>
					<div class="col-lg-8">
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
									<td>Open</td>
									<td width="50%"><?= $detail->description; ?></td>
									<td><?= ucwords($detail->emp_name); ?></td>
									<td><?= date('d-m-Y', strtotime($detail->created_date)); ?></td>
								</tr>
								<?php foreach ($comments as $c): ?>
								<tr>
									<td><?= ucwords($c->status_text); ?></td>
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
						<form action="<?= base_url(); ?>Disciplinary/add_comments" method="POST" enctype="multipart/form-data" id="comments-form">
							<div class="inputFormMain col-lg-12">
								<input type="hidden" name="status_id" id="status-id" value="<?= $detail->status_id; ?> ">
								<input type="hidden" name="disciplinary_id" id="disciplinary-id" value="<?= $detail->id; ?>">

								<textarea name="comments" id="comments" class="form-control resize-v" rows="5" required="required" placeholder="Add your comments here..."></textarea>	
							</div>
							<div class="inputFormMain col-lg-12">
								<input type="file" name="files[]" class="form-control" multiple>
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

