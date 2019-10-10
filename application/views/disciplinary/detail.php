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
								<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="dpcr">
									<i class="fa fa-archive"></i> DPCR	
								</button>
							<?php } elseif($detail->status_text == 'dpcr') { ?>
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

						<?php } elseif($detail->status_text == 'received') { ?>
							<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="satisfactory">
								<i class="fa fa-archive"></i> 
								SATISFACTORY 
							</button>

							<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="unsatisfactory">
								<i class="fa fa-archive"></i> 
								UNSATISFACTORY 
							</button>

							<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="admitted"> 
								<i class="fa fa-archive"></i>
								ADMITTED 
							</button>

							<button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="no action">
									<i class="fa fa-archive"></i> 
									NO ACTION	
							</button>

							<!-- <button type="button" class="btn btn-sm btn-primary disciplinary-status-btn" data-text="re open"> 
								<i class="fa fa-archive"></i>
								RE OPEN 
							</button> -->

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
					<div class="col-lg-12">
						<div class="col-lg-2"><strong>Employee Name</strong></div>
						<div class="col-lg-2"><strong>Project</strong></div>
						<div class="col-lg-2"><strong>Department</strong></div>
						<div class="col-lg-2"><strong>Designation</strong></div>
						<div class="col-lg-4"><strong>Previous Type | Status</strong></div>
					</div>
					<div class="col-lg-12 pb-5">
						<div class="col-lg-2"><?= ucwords($detail->emp_name); ?></div>
						<div class="col-lg-2"><?= $detail->project_name; ?></div>
						<div class="col-lg-2"><?= $detail->department_name; ?></div>
						<div class="col-lg-2"><?= $detail->designation_name; ?></div>
						<div class="col-lg-4"></div>
					</div>

					<div class="col-lg-12 pt-5">
						<div class="col-lg-2"><strong>CNIC</strong></div>
						<div class="col-lg-2"><strong>Type</strong></div>
						<div class="col-lg-2"><strong>Status</strong></div>
						<div class="col-lg-2"><strong>Category</strong></div>
						<div class="col-lg-2"><strong>Reason</strong></div>
						<div class="col-lg-2"><strong>Other Reason</strong></div>
					</div>

					<div class="col-lg-12 pb-5">
						<div class="col-lg-2"><?= $detail->cnic; ?></div>
						<div class="col-lg-2">
							<label class="primary-label"><?= ucwords($detail->type_name); ?></label>
						</div>
						<div class="col-lg-2">
							<label class="warning-label"><?= $detail->status_text; ?></label>
						</div>
						<div class="col-lg-2"></div>
						<div class="col-lg-2"><?= ($detail->reason_text) ? '<label class="success-label">'.$detail->reason_text.'</label>' : ''; ?></div>
						<div class="col-lg-2"><?= $detail->other_reason; ?></div>
					</div>

					<div class="col-lg-12 pt-5">
						<div class="col-lg-2"><strong>Suspended</strong></div>
						<div class="col-lg-2"><strong>Issue reporting date</strong></div>
						<div class="col-lg-2"><strong>Salary hold</strong></div>
						<div class="col-lg-2"><strong>Salary deduction days</strong></div>
						<div class="col-lg-2"><strong>Salary deduction month</strong></div>
						<div class="col-lg-2"><strong>Last working date</strong></div>
					</div>

					<div class="col-lg-12 pb-5">
						<div class="col-lg-2">
							<label class="pink-label">
							<?= ($detail->suspend_from_duty) ? 'Yes' : 'No'; ?>
							</label>
						</div>
						<div class="col-lg-2">
							<?= ($detail->issue_reporting_date) ? date('d-m-Y', strtotime($detail->issue_reporting_date)) : '' ?>
						</div>
						<div class="col-lg-2">
							<label class="default-label">
							<?= ($detail->salary_hold) ? 'Yes' : 'No'; ?>
							</label>
						</div>
						<div class="col-lg-2"></div>
						<div class="col-lg-2"></div>
						<div class="col-lg-2"></div>
					</div>

					<div class="col-lg-12 pt-5">
						<div class="col-lg-2"><strong>Position abolish</strong></div>
						<div class="col-lg-2"><strong>Abolish date</strong></div>
						<div class="col-lg-2"><strong>Reported by</strong></div>
						<div class="col-lg-2"><strong>Approved by</strong></div>
						<div class="col-lg-2"><strong>Action approval date</strong></div>
						<div class="col-lg-2"><strong>Approval received date</strong></div>
					</div>

					<div class="col-lg-12 pb-5">
						<div class="col-lg-2"><?= ($detail->position_abolish) ? 'Yes' : 'No'; ?></div>
						<div class="col-lg-2">
							<?= ($detail->abolish_date) ? date('d-m-Y', strtotime($detail->abolish_date)) : ''; ?>
						</div>
						<div class="col-lg-2"><?= ucwords($detail->reported_by); ?></div>
						<div class="col-lg-2"><?= ucwords($detail->approved_by); ?></div>
						<div class="col-lg-2">
							<?= ($detail->action_approval_date) ? date('d-m-Y', strtotime($detail->action_approval_date)) : ''; ?>
						</div>
						<div class="col-lg-2">
							<?= ($detail->approval_receive_date) ? date('d-m-Y', strtotime($detail->approval_receive_date)) : ''; ?>
						</div>
					</div>

					<div class="col-lg-12 pt-5">
						<div class="col-lg-2"><strong>Letter No</strong></div>
						<div class="col-lg-2"><strong>Created by</strong></div>
						<div class="col-lg-2"><strong>Created date</strong></div>
						<div class="col-lg-2"><strong>Issued date</strong></div>
						<div class="col-lg-2"><strong>Delivered date</strong></div>
						<div class="col-lg-2"><strong>Date of joining</strong></div>
					</div>
					<div class="col-lg-12 pb-5">
						<div class="col-lg-2"></div>
						<div class="col-lg-2"><?= ucwords($detail->created_by); ?></div>
						<div class="col-lg-2">
							<?= ($detail->created_date) ? date('d-m-Y', strtotime($detail->created_date)) : ''; ?>
						</div>
						<div class="col-lg-2">
							<?= ($detail->issued_date) ? date('d-m-Y', strtotime($detail->issued_date)) : ''; ?>
						</div>
						<div class="col-lg-2">
							<?= ($detail->delivered_date) ? date('d-m-Y', strtotime($detail->delivered_date)) : ''; ?>
						</div>
						<div class="col-lg-2">
							<?= ($detail->date_of_joining) ? date('d-m-Y', strtotime($detail->date_of_joining)) : ''; ?>
						</div>
					</div>

					<div class="col-lg-12 pt-5">
						<div class="col-lg-2"><strong>Security Deposit Paid</strong></div>
					</div>
					<div class="col-lg-12 pb">
						<div class="col-lg-2"></div>
					</div>

					<div class="col-lg-12 pt-5">
						<div class="col-lg-2"><strong>Description</strong></div>
					</div>
					<div class="col-lg-12 pb">
						<div class="col-lg-12"><?= $detail->description; ?></div>
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
						<div class="col-lg-12">
							<form action="<?= base_url(); ?>Disciplinary/upload_attachments" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="disciplinary_id" class="disciplinary-id" value="<?= $detail->id; ?>">
								<div class="inputFormMain col-lg-12 plr-0">
									<input type="file" name="files[]" class="form-control" multiple>
								</div>

								<div class="submitBtn">
									<button type="submit" class="btn btn-primary btn-block" id="save-btn"> 
										Attach Files </button>
								</div>	
							</form>
						</div>

						<div class="col-lg-12"><hr></div>

						<div class="col-lg-12 inputFormMain">
							<label>Reason Description</label>
							<select name="disciplinary_reason" id="disciplinary-reason" class="form-control" data-plugin="select_hrm">
								<option value=""></option>
							</select>
						</div>
						<div class="col-lg-12">
							<div class="submitBtn">
								<button type="submit" class="btn btn-warning btn-block" id="save-btn"> 
									<i class=""></i> Add </button>
							</div>	
						</div>
					</div>

					<div class="col-lg-8">
						<div class="col-lg-6 plr-0">
							<h3 class="mt-0"><i class="fa fa-ticket"></i> Template</h3>
						</div>
						<div class="col-lg-6 plr-0">
							<button type="button" class="btn btn-sm btn-primary" id="load-template-btn" data-type="<?= $detail->type_id; ?>" style="float: right;">
								<i class="fa fa-paste"></i>
								LOAD <?= strtoupper($detail->type_name); ?> TEMPLATE
							</button>
						</div>
						<div class="col-lg-12 plr-0">
							<textarea name="template" id="template" class="form-control editor" cols="30" rows="15"></textarea>
						</div>
					</div>
				</div>

				<div class="col-lg-12"><hr></div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="col-lg-6">
							<h3><i class="fa fa-comment"></i> Comments</h3>
						</div>
						<div class="col-lg-6">
							<h3><i class="fa fa-history"></i> Status History</h3>
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="col-lg-6 pl-0">
							<div class="col-lg-12" id="comments">
								<?php foreach($comments AS $c): ?>
								<blockquote style="font-size: 14px;">
									<small> Comment By: <?= $c->emp_name; ?>, Date: <?= $c->added_date; ?></small>
									<div>
										<?= $c->comment_text; ?>
									</div>
								</blockquote>	
								<?php endforeach; ?>
							</div>
							<form action="<?= base_url(); ?>Disciplinary/add_comments" method="POST" enctype="multipart/form-data" id="comments-form">
								<div class="inputFormMain col-lg-12">
									<input type="hidden" name="status_id" id="status-id" value="<?= $detail->status_id; ?> ">
									<input type="hidden" name="disciplinary_id" class="disciplinary-id" value="<?= $detail->id; ?>">

									<textarea name="comments" id="comments" class="form-control resize-v" rows="5" required="required" placeholder="Add your comments here..."></textarea>	
								</div>

								<div class="submitBtn col-lg-3 pr-0">
									<button type="submit" class="btn btnSubmit" id="save-btn"> Add </button>
								</div>	
							</form>
						</div>
						
						<div class="col-lg-6">
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
										<td width="40%"><?= $detail->description; ?></td>
										<td><?= ucwords($detail->created_by); ?></td>
										<td><?= date('d-m-Y', strtotime($detail->created_date)); ?></td>
									</tr>
									<?php foreach ($status_comments as $c): ?>
									<tr>
										<td><?= ucwords($c->status_text); ?></td>
										<td width="40%"><?= $c->comment_text; ?></td>
										<td><?= ucwords($c->emp_name); ?></td>
										<td><?= date('d-m-Y', strtotime($c->added_date)); ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>	
				</div>		
		</div>
	</section>
</section>

