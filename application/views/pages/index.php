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
					<div class="alert alert-danger" data-dismiss="alert">
						<?php echo $this->session->flashdata('error'); ?>
					</div>
				<?php endif; ?>
			</div>
			
			<form action="<?= base_url(); ?>Pages/add" method="POST">
				<div class="col-lg-4">
					<div class="inputFormMain">
						<input type="text" name="page_name" class="form-control" value="" placeholder="Enter Page/Menu Name" autocomplete="off" required>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="inputFormMain">
						<input type="text" name="url" class="form-control" value="" placeholder="Page Url" autocomplete="off">
					</div>
				</div>
				<div class="col-lg-4">
					<div class="inputFormMain">
						<select name="parent" class="form-control">
							<option value="0">SELECT PARENT PAGE</option>
							<?php foreach($pages AS $p): ?>
								<option value="<?= $p->id; ?>"><?= ucwords($p->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="submitBtn">
						<button class="btn btnSubmit" type="submit">Add New</button>
					</div>
				</div>
			</form>
		</div>
		
		<div class="solidLine"></div>

		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3>List of Pages/Menus</h3>
				</div>
			</div>
				<div class="col-md-12">
					<div class="tableMain">
						<div class="table-responsive">
							<table class="table" id="local-table">
								<thead>
									<tr>
										<th>#</th>
										<th>Page Name</th>
										<th>Slug</th>
										<th>Url</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $count=1; foreach($pages AS $p): ?>
								
									<tr>
										<td><?= $count; ?></td>
										<td><?= ucwords($p->name); ?></td>
										<td><?= $p->slug; ?></td>
										<td><?= $p->url = ($p->url == "") ? '#' : $p->url; ?></td>
										<td>
											<a class="plr-5 icon-gray edit-page" data-toggle="modal" href="#edit-education-modal" data="" title="Edit">
												<i class="fa fa-pencil"></i>
											</a>
											<a class="plr-5 icon-gray delete-page" data-toggle="modal" href="#delete-modal" data-id="" data-type="qualification" title="Delete">
												<i class="fa fa-trash"></i>
											</a>
										</td>
									</tr>
									<?php $count++; endforeach; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
		</div>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<?php //echo $this->pagination->create_links(); ?>
			</div>
		</div>
			
	</div>
</section>
</section>
