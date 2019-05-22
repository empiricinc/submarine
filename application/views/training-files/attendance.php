 <?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: attendance.php
*  Author: Saddam
*  Filepath: views / training-files / attendance.php
*/
?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-12">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>employees attendance 
								<span>(list of trainees for attendance)</span>
							</h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('trainings/trainer_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_trainer" class="form-control" placeholder="Search trainers..." required="" autocomplete="off">
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
											<th>employee name</th>
											<th>status / present, absent</th>
										</tr>
									</thead>
									<tbody>
										<form action="<?php echo base_url('trainings/save_attendance'); ?>" method="post">
										<?php for ($i = 0; $i < count($names); $i++): ?>
											<tr>
												<td>
													<div class="col-lg-3">
														<?php echo $names[$i]->first_name . " " . $names[$i]->last_name; ?>
													</div>
												</td>
												<td>
													<div class="col-lg-5">
														<select name="status[]" class="form-control" style="color: #aeafaf;">
															<option value="">
																Select Status
															</option>
															<option value="Present">
																Present
															</option>
															<option value="Absent">
																Absent
															</option>
														</select>
														<input type="hidden" name="project[]" value="<?= $trainee_employees->project; ?>">
														<input type="hidden" name="trg_id[]" value="<?= $trainee_employees->trg_id; ?>">
														<input type="hidden" name="employee_id[]" value="<?= $names[$i]->employee_id; ?>">
													</div>
												</td>
											</tr>
											<?php endfor; ?>
											<tr>
												<td>
													<div class="submitBtn">
														<button class="btn btnSubmit" type="submit">Save</button>
														<a href="javascript:history.go(-1);" class="btn btnSubmit">Cancel</a>
													</div>
												</td>
												<td></td>
											</tr>
										</form>
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