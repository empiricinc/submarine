<section class="secMainWidth hide-from-print">
	<section class="secFormLayout">
		<div class="mainInputBg">

			<div class="row">
				<div class="col-lg-10">
					<div class="tabelHeading">
						<h3><?= $title; ?></h3>
					</div>
				</div>
				<!-- <div class="col-lg-2">
					<a href="javascript:void(0);" class="label label-primary">Disciplinary Action</a>
				</div> -->
			</div>
			<div class="solidLine"></div>
			
			<?php if($detail->status == 'resolved' && $detail->action == NULL): ?>
			<form action="<?= base_url(); ?>Investigation/add_disciplinary" method="POST">
			<div class="panel panel-info mlr-15">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-12">
							<h4>Disciplinary Action</h4>
						</div>
					</div>
					
				</div>
				<div class="panel-body">
					<input type="hidden" name="complaint_id" value="<?= $detail->id; ?>">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="disciplinary" id="disciplinary" class="form-control" required="required">
								<option value="">Select Disciplinary Action</option>
								<option value="warning">Warning</option>
								<option value="suspend">Suspend</option>
								<option value="terminate">Terminate</option>
							</select>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="submitBtn col-lg-1 pr-0">
							<button type="submit" class="btn btnSubmit"> Submit </button>
						</div>
					</div>
				</div>
			</div>
			</form>
			<?php endif; ?>

			<div class="panel panel-default mlr-15">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-10 text-left">
							<h4>Complaint Detail</h4>
						</div>
						<div class="col-lg-2 text-right">
							<div class="btn-group" role="group" aria-label="Basic example">
							  <a href="javascript:void(0);" class="btn btn-default print-btn" onclick="window.print();"><i class="fa fa-print"></i> Print </a>
							 
							  <a href="<?= base_url(); ?>Investigation/report_internal/<?= $detail->id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-file"></i> Pdf </a>
							</div>
						</div>
					</div>	
				</div>
				<div class="panel-body">				
					<div class="row ptb-5">

						<div class="col-lg-12 ptb-5">
							<div class="col-lg-2"><strong>Compalint No</strong></div>
							<div class="col-lg-4"><?= $detail->complaint_no; ?></div>

							<div class="col-lg-2"><strong>Date</strong></div>
							<div class="col-lg-4"><?= date('d-m-Y', strtotime($detail->entry_at)); ?></div>
						</div>
						
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

						<div class="col-lg-12"><hr></div>
						<div class="col-lg-12 ptb-5">
							<div class="col-lg-2"><strong>Reason</strong></div>
							<div class="col-lg-4"><?= $detail->reason_text; ?></div>
							<div class="col-lg-2"><strong>Other Reason</strong></div>
							<div class="col-lg-4"><?= $detail->other_reason; ?></div>
						</div>

						<div class="col-lg-12">
							
							<div class="col-lg-2"><strong>Description</strong></div>
							<div class="col-lg-4"><?= $detail->description; ?></div>
						</div>

						<div class="col-lg-12"><hr></div>
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
						
						<?php if($detail->action != NULL OR $detail->action != ""): ?>
						<div class="col-lg-12"><hr></div>
						<div class="col-lg-12 ptb-5">
							<div class="col-lg-2"><strong>Action Taken</strong></div>
							<div class="col-lg-4"><?= ucfirst($detail->action); ?></div>

							<div class="col-lg-2"><strong>Action Date</strong></div>
							<div class="col-lg-4"><?= date('d-m-Y', strtotime($detail->action_at)); ?></div>
						</div>
						
						<div class="col-lg-12 ptb-5">
							<div class="col-lg-2"><strong>Action Taken By</strong></div>
							<div class="col-lg-4"><?= ucwords($detail->action_taken_by); ?></div>

						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- Files and Reviews from Legal department -->

			<?php if(!empty($remarks_and_files) || !empty($detail->closing_remarks)): ?>
			<div class="panel panel-default mlr-15">
				<div class="panel-heading">
					<div class="row">
						<div class="col-lg-10">
						<h4>Investigation Remarks</h4>
					</div>
					<div class="col-lg-2 text-right">
						<button class="btn btn-default hidden-print" id="remarks-btn" data-toggle="collapse" data-target="#remarks-panel"><i class="fa fa-minus-circle fa-1x"></i></button>
					</div>
					</div>
					
					
				</div>
				<div class="panel-body collapse in" id="remarks-panel">
				<?php $marginLeft=0; for ($i=0; $i < count($remarks_and_files); $i++) { 
					$employee_name = ucfirst($remarks_and_files[$i]['first_name'])." ".ucfirst($remarks_and_files[$i]['last_name']);
				?>
					<?php if($remarks_and_files[$i]['send_from'] == 'head'):
							$sender = 'You';
							$marginLeft = 0;
						  elseif($remarks_and_files[$i]['send_from'] == 'legal'):
						  	$sender = $employee_name . ' (Legal)';
						  	$marginLeft = 10;
						  elseif($remarks_and_files[$i]['send_from'] == 'local'):
						  	$sender = $employee_name . ' (Investigator)';
						  	$marginLeft = 20;
						  endif;
					 ?>
					<div class="col-lg-11">
					<div class="col-lg-12 well mb-5" style="margin-left: <?= $marginLeft; ?>px;">
						<div class="col-lg-12 mb-10">
							<strong><?= $sender; ?></strong>
						</div>	
						<div class="col-lg-12">
							<?= $remarks_and_files[$i]['sender_remarks']; ?>
						</div>	
						<?php 
							for ($j=0; $j < $remarks_and_files[$i]['number_of_files']; $j++) { 
								$url = base_url().'uploads/investigation_files/'. $remarks_and_files[$i][$j]['file_name'];
						?>
						<div class="col-lg-12">
							<a href="<?= $url; ?>" download><?= $remarks_and_files[$i][$j]['original_name']; ?></a>
						</div>
						<?php } ?>
						<div class="col-lg-12 mt-15">
							<span class="label label-primary"><?= date('d-m-Y', strtotime($remarks_and_files[$i]['r_date'])); ?></span>
						</div>
						
					</div>
					</div>

				<?php } ?>

				<!-- Complainee Reply -->

				<?php if($complainee_reply->complainee_reply != ''): ?>
					<div class="col-lg-11">
						<div class="col-lg-12 well mb-5">
							<div class="col-lg-12 mb-10">
								<strong><?= ucwords($complainee_reply->emp_name); ?> (Complainee Reply)</strong>
							</div>
							<div class="col-lg-12">
								<?= $complainee_reply->complainee_reply; ?>
							</div>
							<div class="col-lg-12 mt-15">
								<span class="label label-primary"><?= date('d-m-Y', strtotime($complainee_reply->reply_date)); ?></span>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!-- ./ End of Complainee Reply -->
				
				<!-- closing remarks -->
				<?php if($detail->status == 'resolved'): ?>
					<div class="col-lg-11">
						<div class="col-lg-12 well mb-5">
							<div class="col-lg-12 mb-10">
								<strong>Project Head</strong>
							</div>
							<div class="col-lg-12">
								<?= $detail->closing_remarks; ?>
							</div>
							<div class="col-lg-12 mt-15">
								<span class="label label-primary"><?= date('d-m-Y', strtotime($detail->remarks_at)); ?></span>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!-- ./ closing remarks -->
				</div>
			</div>
			<?php endif; ?>
			<!-- ./ End of Files and Reviews -->


			<?php if($detail->status != 'resolved'): ?>
			<div class="row">
				<!-- Form -->
				<div class="col-lg-12">
					<form action="<?= base_url(); ?>Investigation/close_investigation" method="POST">
						<div class="inputFormMain col-lg-12">
							<input type="hidden" name="complaint_id" id="complaint_id" value="<?= $detail->id; ?>">
							<input type="hidden" name="complaint_type" id="complaint_type" value="internal">
							<textarea name="remarks" id="remarks" class="form-control resize-v" rows="5" required="required" placeholder="Your remarks about the complaint..."></textarea>	
						</div>

						<div class="submitBtn col-lg-3 pr-0">
							<button type="submit" class="btn btnSubmit" id="resolve-btn"><i class="fa fa-check"></i> Resolve </button>
						</div>	
						<div class="submitBtn col-lg-3 pl-0">
							<button type="button" id="forward-legal" class="btn btnSubmit"><i class="fa fa-forward"></i> Forward Legal </button>
						</div>	
					</form>
				</div>
				<!-- ./ Form -->
			</div>
			<?php endif; ?>
		</div>
	</section>
</section>

<!-- Print -->
<section id="printable" class="hide-from-screen">
	<div class="salaryslip-header">
		<div class="row">
			<div class="col-print-12">
				<center><img src="<?= base_url(); ?>uploads/logo/chip.png" height="50px" alt="CHIP Logo"></center>
			</div>
			<div class="col-print-12">
				<center><h4>CHIP Training &amp; Consulting Pvt Ltd.</h4><h4></h4></center>
				<center><h4>Complaint Detail And Remarks</h4></center>
			</div>
			<div class="col-print-12">
				<hr>
			</div>	
		</div>
	</div>
	<div class="detail">
		<!-- <div class="col-lg-12 col-print-12">
			<h4>Complaint Detail And Remarks</h4>
		</div> -->
		<!-- <div class="col-lg-12 col-print-12"><hr></div> -->

		<div class="mlr-15">				
			<div class="row ptb-5">
				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Compalint No</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->complaint_no; ?></div>

					<div class="col-lg-2 col-print-2"><strong>Date</strong></div>
					<div class="col-lg-4 col-print-4"><?= date('d-m-Y', strtotime($detail->entry_at)); ?></div>
				</div>
				
				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Employee Name</strong></div>
					<div class="col-lg-4 col-print-4"><?= ucwords($detail->emp_name); ?></div>

					<div class="col-lg-2 col-print-2"><strong>Project</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->project_name; ?></div>
				</div>

				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Department</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->department_name; ?></div>
					<div class="col-lg-2 col-print-2"><strong>Designation</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->designation_name; ?></div>
				</div>

				<div class="col-lg-12 col-print-12"><hr></div>
				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Reason</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->reason_text; ?></div>
					<div class="col-lg-2 col-print-2"><strong>Other Reason</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->other_reason; ?></div>
				</div>

				<div class="col-lg-12 col-print-12">
					
					<div class="col-lg-2 col-print-2"><strong>Description</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->description; ?></div>
				</div>

				<div class="col-lg-12 col-print-12"><hr></div>
				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Evidence</strong></div>
					<div class="col-lg-4 col-print-4"><?= ($detail->evidence) ? 'Yes' : 'No'; ?></div>

					<div class="col-lg-2 col-print-2"><strong>Evidence Date</strong></div>
					<div class="col-lg-4 col-print-4"><?= date('d-m-Y', strtotime($detail->evidence_date)); ?></div>
				</div>
				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2 col-print-2"><strong>Reported By</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->reported_by; ?></div>

					<div class="col-lg-2 col-print-2"><strong>Reported Date</strong></div>
					<div class="col-lg-4 col-print-4"><?= date('d-m-Y', strtotime($detail->reported_date)); ?></div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-print-12"><hr></div>
	</div>

		<!-- Files and Reviews from Legal department -->
		<?php if(!empty($remarks_and_files) || !empty($detail->closing_remarks)): ?>
		<div class="remarks">
		<div class="col-lg-12 col-print-12">
			<h4>Investigation Remarks</h4>
		</div>
		<div class="">
			<?php $marginLeft=0; for ($i=0; $i < count($remarks_and_files); $i++) { 
				$employee_name = ucfirst($remarks_and_files[$i]['first_name'])." ".ucfirst($remarks_and_files[$i]['last_name']);
			?>
				<?php if($remarks_and_files[$i]['send_from'] == 'head'):
						$sender = 'You';
						$marginLeft = 0;
					  elseif($remarks_and_files[$i]['send_from'] == 'legal'):
					  	$sender = $employee_name . ' (Legal)';
					  	$marginLeft = 10;
					  elseif($remarks_and_files[$i]['send_from'] == 'local'):
					  	$sender = $employee_name . ' (Investigator)';
					  	$marginLeft = 20;
					  endif;
				 ?>
			<div class="col-lg-11 col-print-11">
				<div class="col-lg-12 col-print-12  mb-10 border" style="margin-left: <?= $marginLeft; ?>px;">
					<div class="col-lg-12 col-print-12">
						<strong><?= $sender; ?></strong>
					</div>	
					<div class="col-lg-12 col-print-12">
						<?= $remarks_and_files[$i]['sender_remarks']; ?>
					</div>	

					<div class="col-lg-12 col-print-12">
						<span class="font-12"><?= date('d-m-Y', strtotime($remarks_and_files[$i]['r_date'])); ?></span>
					</div>
					
				</div>
			</div>
			<?php } ?>

			<!-- Complainee Reply -->
			<?php if(!empty($complainee_reply->complainee_reply)): ?>
				<div class="col-lg-11 col-print-11">
					<div class="col-lg-12 col-print-12 mb-10 border">
						<div class="col-lg-12 col-print-12">
							<strong><?= ucwords($complainee_reply->emp_name); ?> (Complainee Reply)</strong>
						</div>
						<div class="col-lg-12 col-print-12">
							<?= $complainee_reply->complainee_reply; ?>
						</div>
						<div class="col-lg-12 col-print-12">
							<span class="font-12"><?= date('d-m-Y', strtotime($complainee_reply->reply_date)); ?></span>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<!-- ./ End of Complainee Reply -->

			<!-- closing remarks -->
			<?php if($detail->status == 'resolved'): ?>
				<div class="col-lg-11 col-print-11">
					<div class="col-lg-12 col-print-12 mb-10 border">
						<div class="col-lg-12 col-print-12">
							<strong>Project Head</strong>
						</div>
						<div class="col-lg-12 col-print-12">
							<?= $detail->closing_remarks; ?>
						</div>
						<div class="col-lg-12 col-print-12">
							<span class="font-12"><?= date('d-m-Y', strtotime($detail->remarks_at)); ?></span>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<!-- ./ closing remarks -->
			</div>
		</div>
		<?php endif; ?>
		<!-- ./ End of Files and Reviews -->
</section>	
<!-- ./ Print -->