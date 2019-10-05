<section class="secMainWidth hide-from-print">
<section class="secFormLayout">
	<div class="mainInputBg">
		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
			</div>
		</div>
		<div class="solidLine"></div>
		<div class="panel panel-default mlr-15">
			<div class="panel-heading">
				<div class="row">
					<div class="col-lg-10 text-left">
						<h4><?= $title; ?></h4>
					</div>
					<div class="col-lg-2 text-right">	
						<div class="btn-group" role="group" aria-label="Basic example">
						  <a href="javascript:void(0);" class="btn btn-default print-btn" onclick="window.print();"><i class="fa fa-print"></i> Print </a>
						 
						  <a href="<?= base_url(); ?>Complaint/report/<?= $detail->id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-file"></i> Pdf </a>
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
						<div class="col-lg-4"><?= date('d-m-Y', strtotime($detail->created_at)); ?></div>
					</div>
					
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Complainee Name</strong></div>
						<div class="col-lg-4"><?= $detail->name; ?></div>

						<div class="col-lg-2"><strong>Contact number</strong></div>
						<div class="col-lg-4"><?= $detail->contact_no; ?></div>
					</div>
				
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Email address</strong></div>
						<div class="col-lg-4"><?= $detail->email; ?></div>
					</div>

					<div class="col-lg-12 ptb-5 mt-15">
						<div class="col-lg-2"><strong>Subject</strong></div>
						<div class="col-lg-4"><?= $detail->subject; ?></div>
					</div>
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Description</strong></div>
						<div class="col-lg-10"><?= $detail->complaint_desc; ?></div>
					</div>
					
					<div class="col-lg-12"><hr></div>
					<div class="col-lg-12">
						<div class="col-lg-2"><strong>Province</strong></div>
						<div class="col-lg-4"><?= ucwords($detail->province); ?></div>

						<div class="col-lg-2"><strong>District</strong></div>
						<div class="col-lg-4"><?= ucwords($detail->district); ?></div>
					</div>
					
					<div class="col-lg-12 ptb-5">
						<div class="col-lg-2"><strong>Tehsil</strong></div>
						<div class="col-lg-4"><?= ucwords($detail->tehsil); ?></div>

						<div class="col-lg-2"><strong>Union council</strong></div>
						<div class="col-lg-4"><?= ucwords($detail->uc); ?></div>
					</div>
				</div>
			</div>
		</div>
		<!-- ./ Complaint panel -->


		<!-- Remarks and files -->
		<?php if(!empty($remarks_and_files) || !empty($detail->closing_remarks)): ?>
		<div class="panel panel-default mlr-15">
			<div class="panel-heading">
				<h4>Complaint Remarks and Detail</h4>
			</div>
			<div class="panel-body">
			<?php $marginLeft=0; for ($i=0; $i < count($remarks_and_files); $i++) { 
				$employee_name = ucfirst($remarks_and_files[$i]['first_name'])." ".ucfirst($remarks_and_files[$i]['last_name']);
			?>
				<?php if($remarks_and_files[$i]['send_from'] == 'head'):
						$sender = $employee_name .' (Project Head)';
						$marginLeft = 0;
					  elseif($remarks_and_files[$i]['send_from'] == 'legal'):
					  	$sender = 'You';
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
					
					<?php $files_count = $remarks_and_files[$i]['number_of_files']; ?>

					<?php if($files_count > 0): ?>
						<div class="col-lg-12 pt-10">
							<span style="font-weight: bold; font-size: 12px;">
							<i class="fa fa-paperclip"></i> Attachments
							</span>
						</div>
					<?php endif; ?>

					<?php 
						for ($j=0; $j < $files_count; $j++) { 
							$url = base_url().'uploads/complaint_files/'. $remarks_and_files[$i][$j]['file_name'];
					?>
					<div class="col-lg-12" style="font-weight: bold; font-size: 12px;">
						<a href="<?= $url; ?>" target="_blank"><?= $remarks_and_files[$i][$j]['original_name']; ?></a>
					</div>
					<?php } ?>
					<div class="col-lg-12 mt-15">
						<span class="label label-primary"><?= date('d-m-Y', strtotime($remarks_and_files[$i]['r_date'])); ?></span>
					</div>
					
				</div>
				</div>
			<?php } ?>

			</div>
		</div>
		<?php endif; ?>
		<!-- ./ Remarks and files -->

		
		<div class="row">
			<!-- Form -->
			<div class="col-lg-12">
				<form action="<?= base_url(); ?>Complaint/legal_resolve" method="POST" enctype="multipart/form-data" id="legal-form">
					<div class="inputFormMain col-lg-12">
						<input type="hidden" name="remarks" value="<?= $detail->remarks_id; ?>">
						<input type="hidden" name="complaint_id" id="complaint_id" 
						value="<?= $detail->id; ?>">
						<input type="hidden" name="employee_id" id="employee_id" value="">
						<textarea name="remarks" id="remarks" class="form-control resize-v" rows="5" required="required" placeholder="Your remarks about the complaint..."></textarea>	
					</div>
					<div class="inputFormMain col-lg-12">
						<input type="file" name="docs[]" multiple>
					</div>

					<div class="submitBtn col-lg-3 pr-0">
						<button type="submit" class="btn btnSubmit"><i class="fa fa-check"></i> Resolve </button>
					</div>	
					<div class="submitBtn col-lg-3 pl-0">
						<button type="button" data-toggle="modal" data-target="#select-inquirer-modal" class="btn btnSubmit"><i class="fa fa-forward"></i> Forward </button>
					</div>	
				</form>
			</div>
			<!-- ./ Form -->
		</div>

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
					<div class="col-lg-4 col-print-4"><?= date('d-m-Y', strtotime($detail->created_at)); ?></div>
				</div>

				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Name</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->name; ?></div>

					<div class="col-lg-2 col-print-2"><strong>Contact</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->contact_no; ?></div>
				</div>

				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Email address</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->email; ?></div>
				</div>


				<div class="col-lg-12 col-print-12 ptb-5 mt-15">
					<div class="col-lg-2 col-print-2"><strong>Subject</strong></div>
					<div class="col-lg-4 col-print-4"><?= $detail->subject; ?></div>
				</div>
				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Description</strong></div>
					<div class="col-lg-10 col-print-10"><?= $detail->complaint_desc; ?></div>
				</div>

				<div class="col-lg-12 col-print-12"><hr></div>
				<div class="col-lg-12 col-print-12">
					<div class="col-lg-2 col-print-2"><strong>Province</strong></div>
					<div class="col-lg-4 col-print-4"><?= ucwords($detail->province); ?></div>

					<div class="col-lg-2 col-print-2"><strong>District</strong></div>
					<div class="col-lg-4 col-print-4"><?= ucwords($detail->district); ?></div>
				</div>

			
				<div class="col-lg-12 col-print-12 ptb-5">
					<div class="col-lg-2 col-print-2"><strong>Tehsil</strong></div>
					<div class="col-lg-4 col-print-4"><?= ucwords($detail->tehsil); ?></div>

					<div class="col-lg-2 col-print-2"><strong>UC</strong></div>
					<div class="col-lg-4 col-print-4"><?= ucwords($detail->uc); ?></div>
				</div>
			</div>
		</div>

		<div class="col-lg-12 col-print-12"><hr></div>
	</div>

	<!-- Files and Reviews from Legal department -->
	<?php if(!empty($remarks_and_files) || !empty($detail->closing_remarks)): ?>
	<div class="remarks">
		<div class="col-lg-12 col-print-12">
			<h4>Complaint Remarks</h4>
		</div>
		<div class="">
		<?php $marginLeft=0; for ($i=0; $i < count($remarks_and_files); $i++) { 
			$employee_name = ucfirst($remarks_and_files[$i]['first_name'])." ".ucfirst($remarks_and_files[$i]['last_name']);
		?>
			<?php if($remarks_and_files[$i]['send_from'] == 'head'):
					$sender = $employee_name . ' (Project Head)';
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

		<!-- closing remarks -->
		<?php if($detail->status == 'resolved'): ?>
			<div class="col-lg-11 col-print-11 border">
				<div class="col-lg-12 col-print-12 mb-5">
					<div class="col-lg-12 col-print-12">
						<strong>Closing remarks by project head</strong>
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