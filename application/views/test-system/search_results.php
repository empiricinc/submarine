<?php 
/*  Filename : search_results.php
*	Author: Saddam
*	Location : views / test-system / search_results.php
*/
?>
<section class="secMainWidthFilter">
<div class="row marg">
	<div class="col-lg-2 no-leftPad">
		<div class="main-leftFilter">
			<div class="tabelHeading">
				<h3>Search Criteria <a href="<?php echo base_url('tests/all_questions'); ?>" class="fa fa-refresh"></a></h3>
			</div>
			<div class="selectBoxMain">
				<div class="filterSelect">
					<select class="form-control">
						<option value="">Project</option>
						<?php foreach($projects as $proj): ?>
							<option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name; ?></option>
						<?php endforeach; ?>
					</select>
					<span></span>
				</div>
				<div class="filterSelect">
					<select class="form-control">
						<option value="">Designation</option>
						<?php foreach($designations as $desig): ?>
							<option value="<?php echo $desig->designation_id; ?>"><?php echo $desig->designation_name; ?></option>
						<?php endforeach; ?>
					</select>
					<span></span>
				</div>
				<form method="get" action="<?php echo base_url('tests/search'); ?>">
					<div class="filterSelect">
						<input type="text" name="keyword" class="form-control" placeholder="Search here..." required="">
						<span></span>
					</div>
					<div class="filterSelectBtn">
						<button class="btn btnSubmit">Search</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-10">
		<div class="mainTableWhite">
			<div class="row">
				<div class="col-lg-6">
					<div class="tabelHeading">
						<h3>search results for: <span style="color: lightgreen; border: 1px dashed; border-radius: 10%;"> <?php echo $_GET['keyword'];?> </span></h3>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="tabelTopBtn">
						<a class="btn" href="<?php echo base_url('tests'); ?>">Back Home &laquo;</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="tableMain">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>serial</th>
										<th>question</th>
										<th>operations/actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $serial = 1; foreach($results as $res) : ?>
									<tr>
										<td>
											<?php echo $serial++; ?>
										</td>
										<td>
											<a href="<?php echo base_url(); ?>tests/view_single/<?php echo $res->id; ?>"><?php echo $res->question; ?></a>
										</td>
										<td>
											<a href="<?php echo base_url() ?>tests/view_single/<?php echo $res->id; ?>" class="btn btn-info">View</a>
											<a href="<?php echo base_url() ?>tests/edit/<?php echo $res->id; ?>" class="btn btn-primary">Edit</a>
											<a href="<?php echo base_url() ?>tests/delete/<?php echo $res->id; ?>" class="btn btn-danger" onclick="javascript: return confirm('Are you sure to delete this question?');">Delete</a>
											<a href="<?php echo base_url() ?>tests/add_options/<?php echo $res->id; ?>" class="btn btn-warning">Add</a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>