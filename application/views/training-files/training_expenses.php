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
								</span> | <small><a href="javascript:history.go(-1)">Go Back &laquo;</a></small>
							</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="panel panel-warning">
						<div class="panel-heading">
						<!-- Retrieved data directy from Model. -->
						<?php $data = $this->Trainings_model->training_detail($this->uri->segment(3)); ?>
							<div class="row">
								<div class="col-lg-6">
									<h3>Training Information</h3>
								</div>
								<div class="col-lg-6 text-right">
									<small>
									Started: 
									<strong>
										<?php echo date('M d, Y', strtotime($data['start_date'])); ?>
									</strong>
									</small><br>
									<small>
									Ended: 
									<strong>
										<?php echo date('M d, Y', strtotime($data['end_date'])); ?>
									</strong>
									</small><br>
									<small>
									Total Days: 
									<strong>
										<?php $date1 = date_create(date('Y-m-d', strtotime($data['start_date'])));
											  $date2 = date_create(date('Y-m-d', strtotime($data['end_date'])));
											  $diff = date_diff($date1, $date2);
											  echo $diff->format("%a") + 1;
										?>
									</strong>
									</small>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<strong>Training Type: </strong>
										<?php echo $data['type']; ?><br>
									<strong>Project Name: </strong>
										<?php echo $data['name']; ?><br>
									<strong>Training Location: </strong>
										<?php echo $data['provName']; ?>
								</div>
								<div class="col-md-6 text-right">
									<strong>Venue: </strong>
										<?php echo $data['location']; ?><br>
									<strong>Hall Detail: </strong>
										<?php echo $data['hall_detail']; ?><br>
									<strong>Training lasted for: </strong>
										<?php $date1 = date_create(date('Y-m-d', strtotime($data['start_date'])));
											  $date2 = date_create(date('Y-m-d', strtotime($data['end_date'])));
											  $diff = date_diff($date1, $date2);
											  echo $diff->format("%a") + 1;
										?> 
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3>Training Objective</h3>
						</div>
						<div class="panel-body">
							<p>The objective of the training was to train the new employees joined the company. Aware them with the company culture, duty timing, and other rules and regulations. Things to do and things not to do. </p>
						</div>
					</div>
				</div>
				<form action="<?php echo base_url('trainings/save_to_payroll'); ?>" method="post">
					<div class="row container-fluid">
						<div class="col-lg-12 text-right">
							<input type="submit" name="submit" class="btn btn-primary" value="Save Payroll">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="tableMain">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th><input type="checkbox" id="savePayroll"></th>
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
													<input type="checkbox" name="employee[]" value="<?php echo $expense->employee_id; ?>">
												</td>
												<td>
													<?= $expense->first_name; ?>
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
												<td>
													<?php if($expense->designation AND $expense->behavior == 'local'): echo "Local";
													else: echo "Non Local"; endif;
												 ?>
												</td>
												<td>
													<?php if($expense->dsa == NULL): echo "..."; ?>
													<?php elseif($expense->status == 'Absent'): echo "..."; else: ?>
														<?= $expense->dsa; ?>
													<?php endif; ?>
												</td>
												<td>
													<?php if($expense->status == 'Absent'):
															echo "..."; else:
													?>
													<?= $expense->travel; 
														endif;
													?>
												</td>
												<td>
													<?php if($expense->stay_allowance == NULL): echo "..."; ?>
													<?php else: ?>
														<?= $expense->stay_allowance; ?>
													<?php endif; ?>
												</td>
												<td>
													<?php if($expense->status == 'Absent'):
														echo ($expense->travel) - ($expense->travel); else:
													echo $expense->dsa + $expense->travel + $expense->stay_allowance;
													endif; 
													?>
												</td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</form>
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
<script type="text/javascript">
// Script to check multiple checkboxes at once.
$(document).ready(function(){
	$("#savePayroll").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});
});
</script>