<section class="secMainWidth">
<section class="secFormLayout">
	<div class="mainInputBg">
		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
					<small><strong><?= ucwords($department); ?></strong> (<?= ucwords($role); ?>)</small>
				</div>
			</div>
			<div class="col-lg-12">
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
		</div>
		
		<div class="solidLine"></div>

		<div class="row">

				<div class="col-md-12">
					<div class="tableMain">
						<div class="table-responsive">
							<table class="table" id="permissions-table">
								<thead>
									<tr>
										<th>#</th>
										<th>Page Name</th>
										<th>Create</th>
										<th>Read</th>
										<th>Update</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									
									<input type="hidden" id="group" value="<?= $permissions[0]->group_id; ?>">
									<tr class="bg-info">
										<td style="padding-top: 2px; padding-bottom: 2px;"></td>
										<td style="padding-top: 2px; padding-bottom: 2px;"></td>
										<td style="padding-top: 2px; padding-bottom: 2px;">
											<input type="checkbox" class="mark-all" data-action="create">
										</td>
										<td style="padding-top: 2px; padding-bottom: 2px;">
											<input type="checkbox" class="mark-all" data-action="read">
										</td>
										<td style="padding-top: 2px; padding-bottom: 2px;">
											<input type="checkbox" class="mark-all" data-action="update">
										</td>
										<td style="padding-top: 2px; padding-bottom: 2px;">
											<input type="checkbox" class="mark-all" data-action="delete">
										</td>
									</tr>

									<?php $count=1; foreach($permissions AS $p): ?>
									
									<tr class="permission-checkbox" data-page="<?= $p->page_id; ?>">
										<td><?= $count; ?></td>
										<td><?= ucwords($p->page_name); ?></td>
										<td>
											<input type="checkbox" class="create" data-action="create" <?php if($p->create): ?> checked <?php endif; ?>>
										</td>
										<td>
											<input type="checkbox" class="read" data-action="read" <?php if($p->read): ?> checked <?php endif; ?>>
										</td>
										<td>
											<input type="checkbox" class="update" data-action="update" <?php if($p->update): ?> checked <?php endif; ?>>
										</td>
										<td>
											<input type="checkbox" class="delete" data-action="delete" <?php if($p->delete): ?> checked <?php endif; ?>>
										</td>
									</tr>
									<?php $count++; endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
		</div>
			
	</div>
</section>
</section>
