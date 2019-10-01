<section class="secMainWidth">
<section class="secFormLayout">
	<div class="mainInputBg">

		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
				</div>
			</div>
			<div class="col-lg-12">
				<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-info" data-dismiss="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php elseif($this->session->flashdata('error')): ?>
				<div class="alert alert-error" data-dismiss="alert">
					<?php echo $this->session->flashdata('error'); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-12">
				<!-- List of Investigations -->	
				<table class="table table-hover table-bordered table-striped dataTable investigation-table">
					<thead>
						<th>#</th>
						<th>Complaint No</th>
						<th>Reason</th>
						<th>Other Reason</th>
						<th>Evidence</th>
						<th>Description</th>
					</thead>
			        <tbody>
			        	<?php $count = 1; ?>
			        	<?php foreach($investigation AS $i): ?>
			        	<?php $evidence = ($i->evidence) ? 'Yes' : 'No'; ?>
						<tr data-id="<?= $i->complaint_id; ?>" style="cursor: pointer;">
							<td><?= $count; ?></td>
							<td><?= $i->complaint_no; ?></td>
							<td><?= $i->reason_text; ?></td>
							<td><?= $i->other_reason; ?></td>
							<td><?= $evidence; ?></td>
							<td><?= $i->description; ?></td>
						</tr>
						<?php $count++; endforeach; ?>
			        </tbody>
			    </table>
				<!-- ./End List of Investigations -->
			</div>
		</div>
			
	</div>
</section>
</section>
