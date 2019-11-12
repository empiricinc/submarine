<section class="secMainWidth remove-padding-print">
	<div class="row">
		
		<div class="col-lg-12">
		<!-- <section class="secMainWidth"> -->
			<section class="secFormLayout">
				<div class="mainInputBg remove-padding-print remove-margin-print no-border-print">

					<div class="row hide-from-print">
						<div class="col-lg-10">
							<div class="tabelHeading">
								<h3 id="detail-box-title">
									<?= $title; ?>
									<br>
					<?php if($detail->status_text == 'delivered' AND $detail->exit_interview_status == '0') { ?>
					<small>
						(For resignation acceptance <a href="<?= base_url(); ?>Exit_interview/form/<?= $detail->resignation_id; ?>" style="text-decoration: underline !important;">exit interview</a> need to be conducted)
					</small>
					<?php } elseif($detail->exit_interview_status == '1') { ?>
					<small>
						<a href="<?= base_url(); ?>Exit_interview/form/<?= $detail->resignation_id; ?>" style="text-decoration: underline !important;">View employee's exit interview</a>
					</small>				
					<?php } ?>
								</h3>

								<br>

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


								<?php if($detail->status_text != 'accepted' AND $detail->status_text != 'rejected' AND $detail->status_text != 'reversal'): ?>
									<button type="button" class="btn btn-sm btn-danger resignation-status-btn" data-text="rejected">
										<i class="fa fa-trash"></i> DELETE
									</button>
								<?php endif; ?>
								
								<?php if($detail->status_text == 'accepted' || $detail->status_text == 'rejected'): ?>
									<button type="button" class="btn btn-sm btn-warning reversion-btn" data-text="reversal">
										<i class="fa fa-archive"></i> REVERSAL
									</button>
								<?php endif; ?>

								<?php if($detail->status_text == 'open') { ?>
									<button type="button" class="btn btn-sm btn-primary resignation-status-btn" data-text="dpcr">
										<i class="fa fa-archive"></i> DPCR	
									</button>
								<?php } elseif($detail->status_text == 'dpcr') { ?>
									<button type="button" class="btn btn-sm btn-primary resignation-status-btn" data-text="pending">
										<i class="fa fa-archive"></i> PENDING	
									</button>
								<?php } elseif($detail->status_text == 'pending') { ?>
									<button type="button" class="btn btn-sm btn-primary resignation-status-btn" data-text="issued">
										<i class="fa fa-archive"></i> ISSUE	
									</button>
								<?php } elseif($detail->status_text == 'issued') { ?>
									<button type="button" class="btn btn-sm btn-primary resignation-status-btn" data-text="printed">
										<i class="fa fa-archive"></i> PRINT	
									</button>
								<?php } elseif($detail->status_text == 'printed') { ?>
									<button type="button" class="btn btn-sm btn-primary resignation-status-btn" data-text="delivered">
										<i class="fa fa-archive"></i> DELIVER
									</button>

								<?php } elseif($detail->status_text == 'delivered') { ?>

									<button type="button" class="btn btn-sm btn-primary resignation-status-btn" data-text="accepted" 
									<?php if($detail->exit_interview_status == '0') { ?>
										disabled
									<?php } ?>
									>
										<i class="fa fa-archive"></i> ACCEPTED
									</button>

									<button type="button" class="btn btn-sm btn-primary resignation-status-btn" data-text="rejected">
										<i class="fa fa-archive"></i> REJECTED
									</button>
								<?php } ?>
							</div>
						</div>
						<div class="col-md-2 text-right">
							<div class="tabelTopBtn">
								<div class="btn-group">
									<a href="javascript:void(0);" onclick="window.print();" class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Print</a>
								</div>
							
							</div>
						</div>
					</div>
					
					<div class="print-header hide-from-screen">
						<div class="row">
							<div class="col-md-12">
								<center><img src="<?= base_url(); ?>uploads/logo/chip.png" height="50px" alt="CHIP Logo"></center>
							</div>
							<div class="col-md-12">
								<center><h4>CHIP Training &amp; Consulting Pvt Ltd.</h4></center>
								<center><h5>Employee Resignation Detail</h5></center>
							</div>
							<div class="col-md-12">
								<hr>
							</div>	
						</div>
					</div>
					<div class="solidLine hide-from-print"></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Name</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<input type="hidden" id="resignation-id" name="resignation_id" value="<?= $detail->resignation_id; ?>">
								<?= ucwords($detail->employee_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Designation</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->designation_name); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Project</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->project_name); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Status</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<label class="default-label remove-padding-print"><?= ucwords($detail->status_text); ?></label>
							</div>
						</div>
					</div>
	
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Reason</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->reason_text; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Other Reason</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ($detail->reason) ? ucwords($detail->reason) : 'N/A'; ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Resignation Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ($detail->resignation_date) ? date('d-m-Y', strtotime($detail->resignation_date)) : ''; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label></label>
							</div>
							<div class="col-lg-3 col-print-3">
								
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Subject</label>
							</div>
							<div class="col-lg-10 col-print-10">
								<?= ucwords($detail->subject); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Description</label>
							</div>
							<div class="col-lg-10 col-print-10">
								<?= $detail->description; ?>
							</div>	
						</div>
					</div>
					<hr>
					
					<?php if($detail->decision_by != '' && $detail->reversion_approved_by ==''): ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Decision By</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->decision_by); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Decision Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->decision_date)); ?>
							</div>
						</div>
					</div>
					
					<?php endif; ?>

					<?php if($detail->reversion_approved_by != ''): ?>

					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Reversal Reason</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= $detail->reversion_reason; ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Dicision By</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= ucwords($detail->reversion_by); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-2 col-print-2">
								<label>Request Date</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->reversion_request_date)); ?>
							</div>
							<div class="col-lg-2 col-print-2"></div>
							<div class="col-lg-2 col-print-2">
								<label>Approved By</label>
							</div>
							<div class="col-lg-3 col-print-3">
								<?= date('d-m-Y', strtotime($detail->reversion_approval_date)); ?>
							</div>
						</div>
					</div>

					<?php endif; ?>

					<div class="row">
						<div class="col-lg-12">
							<h3 class="hide-from-print"><i class="fa fa-history"></i> Status History</h3>
							<h4 class="hide-from-screen"><i class="fa fa-history"></i> Status History</h4>
						</div>
						<div class="col-lg-12">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Status</th>
										<th>Description</th>
										<th style="width: 20%;">Added By</th>
										<th style="width: 15%;">Added Date</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Open</td>
										<td><?= $detail->description; ?></td>
										<td><?= ucwords($detail->employee_name); ?></td>
										<td><?= date('d-m-Y', strtotime($detail->created_at)); ?></td>
									</tr>
									<?php foreach($comments AS $c): ?>
									<tr>
										<td><?= ucwords($c->status_text); ?></td>
										<td><?= $c->comment_text; ?></td>
										<td><?= ucwords($c->employee_name); ?></td>
										<td><?= date('d-m-Y', strtotime($c->added_date)); ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="row hide-from-print">
						<div class="col-lg-12">
							<div class="col-lg-8 plr-0">
								<h3>
									<i class="fa fa-envelope-square"></i>
									Acceptance Letter
								</h3>
							</div>
							<div class="col-lg-4" style="margin-top: 15px; text-align: right; padding-right: 5px;">
									<button type="button" class="btn btn-sm btn-success" id="save-letter">
										<i class="fa fa-save"></i> Save
									</button>

									<button type="button" class="btn btn-sm btn-primary" id="load-template">
										<i class="fa fa-download"></i> Load Template
									</button>	

									<button type="button" class="btn btn-sm btn-danger" id="print-letter">
										<i class="fa fa-print"></i> Print Letter
									</button>
							</div>
						</div>
					</div>

					<div class="row hide-from-print">
						<div class="col-lg-12">
							<textarea name="acceptance_letter" class="form-control editor" id="acceptance-letter" cols="30" rows="10">
								<?= $detail->acceptance_letter; ?>
							</textarea>
						</div>
					</div>

				</div>
			</section>
		<!-- </section> -->
		</div>

	</div>
</section>