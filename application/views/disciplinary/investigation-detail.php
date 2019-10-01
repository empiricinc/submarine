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
							<button type="button" class="btn btn-sm btn-danger">
								<i class="fa fa-trash"></i> DELETE
							</button>
							
							<!-- <button type="button" class="btn btn-sm btn-primary" id="disciplinary-status-btn" data-id="<?= $status->id; ?>">
								<i class="fa fa-archive"></i><?= strtoupper($status->status_text); ?>	
							</button> -->
							<?php foreach ($status as $s): ?>
								<!-- <button type="button" class="btn btn-sm btn-primary" id="disciplinary-status-btn" data-id="<?= $s->id; ?>">
									<i class="fa fa-archive"></i> <?= strtoupper($s->status_text); ?>	
								</button> -->
							<?php endforeach; ?>

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
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td><input type="checkbox" class="checkbox" id="analysis"
										 <?php if($detail->analysis) { ?>checked <?php } ?>></td>
									<td><label>Preliminary Analysis</label></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="checkbox" id="investigation"
										 <?php if($detail->investigation) { ?>checked <?php } ?>></td>
									<td><label>Investigation Process</label></td>
								</tr>
								<tr>
									<td><input type="checkbox" class="checkbox" id="conclusion"
										 <?php if($detail->conclusion) { ?>checked <?php } ?>></td>
									<td><label>Finding and Conclusion</label></td>
								</tr>
							</tbody>
						</table>
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
								<?php foreach ($comments as $c): ?>
								<tr>
									<td>
										<?= $c->status_text; ?>
									</td>
									<td width="50%">
										<?= $c->comment_text; ?>
									</td>
									<td>
										<?= ucwords($c->emp_name); ?>
									</td>
									<td>
										<?= $c->added_date; ?>
									</td>
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

