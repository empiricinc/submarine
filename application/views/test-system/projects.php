<?php 
/* Filename: projects.php
*  Author: Saddam
*  Location: views / test-system / projects.php
*/
?>
<?php if(empty($results)): ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<?php if(empty($project_detail)): ?>
								<h3>all projects <span>(list of the projects the company is working with)</span></h3>
							<?php else: ?>
								<h3>project detail <span>(see project's detail)</span></h3>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/project_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_project" class="form-control" placeholder="Search projects..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr <?php if(!empty($project_detail)): ?> style="display: none;" <?php endif; ?>>
											<th>project name</th>
											<th>project type</th>
											<th>contact</th>
											<th>email</th>
											<th>website</th>
											<th>project logo</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($projects_list)):
										foreach($projects_list as $project): ?>
										<tr>
											<td><a href="<?php echo base_url(); ?>tests/detail_project/<?php echo $project->company_id; ?>"><?=$project->name; ?></a></td>
											<td><?=$project->type_name; ?></td>
											<td><?=$project->contact_number; ?></td>
											<td><a href="mailto:<?=$project->email; ?>"><?=$project->email; ?></a></td>
											<td><a target="blank" href="http://www.<?=$project->website_url; ?>"><?=$project->website_url; ?></a></td>
											<td><img src="<?php echo base_url().'uploads/logo/'.$project->logo;?>" class="img-responsive" height="70" width="70"></td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="tabelSideListing text-center">
							<span><?php echo $this->pagination->create_links(); endif; ?></span>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php else: ?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>you've searched for : <span><?php echo $_GET['search_project']; ?></span></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/project_search'); ?>" method="get">
								<div class="inputFormMain">
									<a href="javascript:history.go(-1);" class="form-control">Go back</a>
									<div class="input-group">
										<input type="text" name="search_project" class="form-control" placeholder="Search projects..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>project name</th>
											<th>project type</th>
											<th>contact</th>
											<th>email</th>
											<th>website</th>
											<th>project logo</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($results)) :
										foreach($results as $project): ?>
										<tr>
											<td><a href="<?php echo base_url(); ?>tests/detail_project/<?php echo $project->company_id; ?>"><?=$project->name; ?></a></td>
											<td><?php echo $project->type_name; ?></td>
											<td><?=$project->contact_number; ?></td>
											<td><a href="mailto:<?=$project->email; ?>"><?=$project->email; ?></a></td>
											<td><a target="blank" href="http://www.<?=$project->website_url; ?>"><?=$project->website_url; ?></a></td>
											<td><img src="<?php echo base_url().'uploads/logo/'.$project->logo;?>" class="img-responsive" height="70" width="70"></td>
										</tr>
										<?php endforeach; endif; ?>
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
<?php endif; ?>
<?php if(isset($project_detail)): ?>
<div class="col-lg-10 col-lg-offset-1">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3>Project Detail</h3>
		</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-2">
						<p><img src="<?php echo base_url(); ?>uploads/logo/<?php echo $project_detail['logo']; ?>" class="img-responsive"></p>
					</div>
					<div class="col-lg-5">
						<p><strong>Name:</strong> <?php echo $project_detail['name']; ?></p>
						<p><strong>Trading Name:</strong> <?php echo $project_detail['trading_name']; ?></p>
						<p><strong>Email:</strong> <?php echo $project_detail['email']; ?></p>
						<p><strong>Website:</strong> <?php echo $project_detail['website_url']; ?></p>
						<p><strong>Contact:</strong> <?php echo $project_detail['contact_number']; ?></p>
						<p><strong>Reg. No.:</strong> <?php echo $project_detail['registration_no']; ?></p>
						<p><strong>Tax No.</strong> <?php echo $project_detail['government_tax']; ?></p>
					</div>
					<div class="col-lg-5">
						<p><strong>Address:</strong> <?php echo $project_detail['address_1'] .", ". $project_detail['address_2']; ?></p>
						<p><strong>Project Type:</strong> <?php echo $project_detail['type_name']; ?></p>
						<p><strong>City:</strong> <?php echo $project_detail['city']; ?></p>
						<p><strong>State:</strong> <?php echo $project_detail['state']; ?></p>
						<p><strong>Zip:</strong> <?php echo $project_detail['zipcode']; ?></p>
						<p><strong>Country:</strong> <?php echo $project_detail['country_name']; ?></p>
						<p><strong>Established:</strong> <?php echo date('M d, Y', strtotime($project_detail['created_at'])); ?></p>
					</div>
				</div>
			</div>
		<div class="panel-footer">
			<?php echo date('Y') . " - " . $project_detail['trading_name']; ?> | <a href="javascript:history.go(-1);">Go Back &laquo;</a>
		</div>
	</div>
</div>
<?php endif; ?>