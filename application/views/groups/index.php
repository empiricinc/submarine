<section class="secMainWidth">
<section class="secFormLayout">
	<div class="mainInputBg">
		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3>
					<small>(Click on Department Name for Detail)</small>
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
			<div class="col-lg-12">
				<div class="panel-group" id="departments">
					<?php $count=1; foreach ($departments as $d): ?>
					<?php $in = ($count == 1) ? 'in' : ''; ?>
					<div class="panel panel-default">
					    <div class="panel-heading">
					      <h4 class="panel-title">
					        <a data-toggle="collapse" data-parent="#departments" href="#dpt-<?= $d->department_id; ?>">
					        <?= ucwords($d->department_name); ?>
					        </a>
					      </h4>
					    </div>
					    <div id="dpt-<?= $d->department_id; ?>" class="panel-collapse collapse <?= $in; ?>">
					      <div class="panel-body">
					      	<div class="row">
					      		<div class="col-lg-12">
					      			<form action="<?= base_url(); ?>Groups/add" method="POST">
					      				<input type="hidden" name="department" value="<?= $d->department_id; ?>">
										<div class="col-lg-4">
											<div class="inputFormMain">
												<input type="text" name="group_name" class="form-control" value="" placeholder="Enter New Role" autocomplete="off" required>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="submitBtn">
												<button class="btn btnSubmit" type="submit">Add Role</button>
											</div>
										</div>
									</form>
					      		</div>
					      	</div>

					      	<?php $roles = $controller->department_roles($d->department_id); ?>
					      	<?php if(!empty($roles)): ?>
					      	<!-- <div class="solidLine"></div> -->
					      	<div class="row">
								<!-- <div class="col-lg-12">
									<div class="tabelHeading">
										<h3>List of Roles</h3>
									</div>
								</div> -->
								<div class="col-lg-12">
									<div class="col-lg-12">
										<div class="tableMain">
											<div class="table-responsive">
												<table class="table" id="local-table">
													<thead>
														<tr>
															<th>#</th>
															<th>Role</th>
															<th>Permissions</th>
														</tr>
													</thead>
													<tbody>

														<?php $count=1; foreach($roles AS $r): ?>
														<tr>
															<td><?= $count; ?></td>
															<td><?= ucwords($r->name); ?></td>
															<td>
																<a href="<?= base_url(); ?>Permissions/view/<?= $r->id; ?>" class="label label-primary">View</a>
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
							<?php endif; ?>
					      </div>
					    </div>
					</div>

				<?php $count++; endforeach; ?>
				</div>
			</div>	
		</div>	

	</div>
</section>
</section>
