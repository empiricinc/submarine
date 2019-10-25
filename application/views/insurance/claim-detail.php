<section class="secMainWidth">
	<div class="row">
		<div class="col-lg-12">
			<section class="secFormLayout">
				<div class="mainInputBg">
					<div class="row">
						<div class="col-lg-10">
							<div class="tabelHeading">
								<h3><?= $title; ?></h3>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<?php if($this->session->flashdata('success')) { ?>
							<div class="alert alert-info" data-dismiss="alert">
								<strong>Success!</strong> <?= $this->session->flashdata('success'); ?>
							</div>
							<?php } elseif($this->session->flashdata('error')) { ?>
							<div class="alert alert-danger" data-dismiss="alert">
								<strong>Error!</strong> <?= $this->session->flashdata('error'); ?>
							</div>
							<?php } ?>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="btn-group">
								<button type="button" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">
									<i class="fa fa-cog"></i> Admin <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu">
									<li>
										<a href="#edit-insurance-modal" class="dropdown-item" data-toggle="modal">
											<i class="fa fa-edit"></i> Edit
										</a>
									</li>
								</ul>
							</div>
							

							<?php 
								if($detail->status == 'pending') {
									$update_status = 'inprogress';
								} elseif($detail->status == 'inprogress') {
									$update_status = 'completed';
								}

							?>
							<?php if($detail->status != 'completed'): ?>
							<button type="button" class="btn btn-success btn-sm change-status" data-id="<?= $detail->insurance_claim_id; ?>" data-status="<?= $detail->status; ?>">
								<i class="fa fa-archive"></i> <?= $update_status; ?>
							</button>
							<?php endif; ?>
						</div>
					</div>

					<div class="solidLine"></div>
					
					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label>Employee Name</label>
								<div>
									<?= ucwords($detail->emp_name); ?>
								</div>
							</div>	
						</div>	
						<div class="col-lg-2">
							<div class="form-group">
								<label>CNIC</label>
								<div>
									<?= $detail->cnic; ?>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="form-group">
								<label>Job Position</label>
								<div>
									<?= $detail->job_title; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label>Type</label>
								<div>
									<span class="primary-label"><?= ucwords($detail->type); ?></span>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Status</label>
								<div>
									<span class="danger-label"><?= ucwords($detail->status); ?></span>
								</div>
							</div>
						</div>

						<div class="col-lg-2">
							<div class="form-group">
								<label>Incident Date</label>
								<div>
									<?= date('d-m-Y', strtotime($detail->incident_date)); ?>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Reported By</label>
								<div>
									<?= ucwords($detail->reported_by); ?>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Reported Date</label>
								<div>
									<?= date('d-m-Y', strtotime($detail->reporting_date)); ?>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Created By</label>
								<div>
									<?= ucwords($detail->created_by); ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-2">
							<div class="form-group">
								<label>Remarks By</label>
								<div>
									<?= ucwords($detail->remarks_by); ?>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Remarks Date</label>
								<div>
									<?= ($detail->remarks_date) ? date('d-m-Y', strtotime($detail->remarks_date)) : ''; ?>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Decision</label>
								<div>
									<?php 
										if($detail->decision == '1')  
											echo '<span class="info-label">Accepted</span>';
										elseif($detail->decision == '0') 
										  	echo '<span class="info-label">Rejected</span>'; 
									?>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Decision By</label>
								<div>
									<?= ucwords($detail->decision_by); ?>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="form-group">
								<label>Decision Date</label>
								<div>
									<?= ($detail->decision_date) ? date('d-m-Y', strtotime($detail->decision_date)) : ''; ?>
								</div>
							</div>
						</div>
					</div>

					
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Subject</label>
								<div>
									<?= $detail->subject; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Description</label>
								<div>
									<?= $detail->description; ?>
								</div>
							</div>
						</div>
					</div>

					<?php if(!empty($detail->remarks_by)): ?>

					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Remarks</label>
								<div>
									<?= $detail->remarks; ?>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>
					
					<?php if(!empty($detail->decision_by)): ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Decision detail</label>
								<div>
									<?= $detail->decision_text; ?>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>

					<div class="solidLine"></div>

					<div class="row">
						<div class="col-lg-4">
							<div class="col-lg-12 pl-0">
								<h3><i class="fa fa-paperclip"></i> Attachments</h3>
								<ul>
									<?php foreach($files AS $file): ?>
									<li>
										<a href="<?= base_url(); ?>uploads/insurance_claims/<?= $file->file_name; ?>" target="_blank"><?= $file->original_name;  ?></a>
										<small>
											<?= ucwords($file->uploaded_by); ?>, at: <?= date('d-m-Y', strtotime($file->uploaded_date)); ?>
										</small>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
							<div class="col-lg-12 pl-0">
							<form action="<?= base_url(); ?>Insurance/add_new_files" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="claim_id" value="<?= $detail->insurance_claim_id; ?>" id="insurance-claim-id">

								<div class="inputFormMain">
									<input type="file" name="attachments[]" class="form-control" multiple />
								</div>
								<div class="submitBtn">
									<button type="submit" class="btn btnSubmit btn-block">
										Upload Files
									</button>
								</div>
							</form>
							</div>
						</div>

						<div class="col-lg-8">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="10%">Check</th>
										<th>Updates</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($file_checklist AS $f): ?>
									<tr>
										<td>
											<input type="checkbox" class="checklist" name="file_type[]" data-id="<?= $f->id; ?>" <?php if($f->status == '1') { ?> checked <?php } ?> />
										</td>
										<td>
											<?= $f->type_description; ?>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</section>
		</div>
	</div>
</section>