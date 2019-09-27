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
				<!-- List of Policies -->	
				<table class="table table-hover table-bordered table-striped dataTable policy-table">
					<thead>
						<th>#</th>
						<th>Title</th>
					</thead>
			        <tbody>
			        	<?php $count = 1; ?>
			        	<?php foreach($policy AS $p): ?>
						<tr data="<?= $p->policy_id; ?>" style="cursor: pointer;">
							<td><?= $count; ?></td>
							<td><?= $p->title; ?></td>
						</tr>
						<?php $count++; endforeach; ?>
			        </tbody>
			    </table>
				<!-- ./End List of Policies -->
			</div>
		</div>
			
	</div>
</section>
</section>
