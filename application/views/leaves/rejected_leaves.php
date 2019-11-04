<?php 
/*  Filename : rejected_leaves.php
*	Author: Saddam
*	Filepath : views / leaves / rejected_leaves.php 
*/
?>
<section class="secMainWidth">
	<section class="secIndexTable">
		<div class="mainTableWhite">
			<div class="row">
				<div class="col-md-8">
					<div class="tabelHeading">
						<?php if(empty($results)): ?>
						<h3>list of rejected leave requests <span>(requests rejected)</span> | <small><a href="javascript:history.go(-1);">&laquo; Back</a></small></h3>
						<?php else: ?>
						<h3>Search results for: <small><?php echo $_GET['search_rejected']; ?></small></h3>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="tabelTopBtn">
						<form class="form-inline" action="<?php echo base_url('leaves/rejected_search'); ?>" method="get">
							<div class="inputFormMain">
								<div class="input-group">
									<input type="text" name="search_rejected" class="form-control" placeholder="Search by name or type" required="" autocomplete="off">
									<div class="input-group-btn">
										<button type="submit" class="btn btnSubmit">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
							</div>
						</form><small>Search by employee name of leave type....</small>
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
										<th>Requested by</th>
										<th>leave type</th>
										<th>request from</th>
										<th>request to</th>
										<th>date applied</th>
										<th>reason</th>
										<th>remarks</th>
										<th>status</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($rej_leaves)): foreach($rej_leaves as $rejected): ?>
									<tr>
										<td>
											<?php if($rejected->first_name == ''){ echo '<button data-toggle="tooltip" title="You\'re seeing this becuase employee name isn\'t available at the moment." class="btn btn-danger btn-xs">("_")</button>'; }else{ echo $rejected->first_name; } ?>
										</td>
										<td>
											<?php echo $rejected->type_name; ?>
										</td>
										<td>
											<?php echo date('d M, Y', strtotime($rejected->from_date)); ?>
										</td>
										<td>
											<?php echo date('d M, Y', strtotime($rejected->to_date)); ?>
										</td>
										<td>
											<?php echo date('M d, Y', strtotime($rejected->applied_on)); ?>
										</td>
										<td>
											<?php echo $rejected->reason; ?>
										</td>
										<td>
											<?php echo htmlspecialchars_decode($rejected->remarks); ?>
										</td>
										<td>
											<button data-toggle="tooltip" title="<?= date('d M, Y', strtotime($rejected->from_date)).' - '.date('d M, Y', strtotime($rejected->to_date)); ?>" class="btn btn-danger btn-xs">Wasted <i class="fa fa-trash"></i></button>
										</td>
									</tr>
									<?php endforeach; endif; ?>
									<?php if(!empty($results)): foreach($results as $result): ?>
										<tr>
										<td>
											<?php if($result->first_name == ''){ echo '<button data-toggle="tooltip" title="You\'re seeing this becuase employee name isn\'t available at the moment." class="btn btn-danger btn-xs">("_")</button>'; }else{ echo $result->first_name; } ?>
										</td>
										<td>
											<?php echo $result->type_name; ?>
										</td>
										<td>
											<?php echo date('d M, Y', strtotime($result->from_date)); ?>
										</td>
										<td>
											<?php echo date('d M, Y', strtotime($result->to_date)); ?>
										</td>
										<td>
											<?php echo date('M d, Y', strtotime($result->applied_on)); ?>
										</td>
										<td>
											<?php echo $result->reason; ?>
										</td>
										<td>
											<?php echo htmlspecialchars_decode($result->remarks); ?>
										</td>
										<td>
											<button data-toggle="tooltip" title="<?= date('d M, Y', strtotime($result->from_date)).' - '.date('d M, Y', strtotime($result->to_date)); ?>" class="btn btn-danger btn-xs">Wasted <i class="fa fa-trash"></i></button>
										</td>
									</tr>
									<?php endforeach; endif; ?>
									<?php if(empty($rej_leaves) AND empty($results)): ?>
									<div class="alert alert-danger text-center">
										<p><strong>Aww snap! </strong>The keyword you're looking for doesn't exist. Try something that do exist instead.</p>
									</div>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<?php if(!empty($rej_leaves) AND empty($results)){ echo $this->pagination->create_links(); } ?>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
	</section>
</section>
