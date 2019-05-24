<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: training_expenses.php
*  Author: Saddam
*  Filepath: views / training-files / training_expenses.php
*/
?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-12">
						<div class="tabelHeading">
							<h3>
								training expenses detail
								<span>
									(list of employees participated in the training and expenses detail) 
								</span>
							</h3>
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
											<th>employee name</th>
											<th>attendance status</th>
											<th>project</th>
											<th>designation</th>
											<th>behavior</th>
											<th>dSA</th>
											<th>travel</th>
											<th>stay</th>
											<th>total</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($expenses as $expense): ?>
										<tr>
											<td>
												<?= $expense->first_name." ".$expense->last_name; ?>
											</td>
											<td>
												<?= $expense->status; ?>
											</td>
											<td>
												<?= $expense->name; ?>
											</td>
											<td>
												<?= $expense->designation_name; ?>
											</td>
											<td><?php if($expense->behavior == 'local'){
												echo "Local";
											}elseif($expense->behavior == 'out'){ echo "Non Local"; } ?>
											</td>
											<td>
												<?php if($expense->dsa == NULL): ?>N/A
												<?php else: ?>
													<?= $expense->dsa; ?>
												<?php endif; ?>
											</td>
											<td>
												<?= $expense->travel; ?>
											</td>
											<td>
												<?php if($expense->stay_allowance == NULL): ?>N/A
												<?php else: ?>
													<?= $expense->stay_allowance; ?>
												<?php endif; ?>
											</td>
											<td>
												<?php echo $expense->dsa + $expense->travel + $expense->stay_allowance; ?>
											</td>
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
							<span>
								<?php //echo $this->pagination->create_links(); endif; ?>
							</span>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
</section>