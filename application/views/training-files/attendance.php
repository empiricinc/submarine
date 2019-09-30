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
				</div>
				<div class="row">
					<div class="col-md-4 col-lg-offset-4">
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
											<?php $today = date('Y-m-d');
										$att_date = $this->db->select('training_id, attendance_date')->from('training_attendance')->where('training_id', $this->uri->segment(3))->get()->result(); ?>
										<?php for ($i = 0; $i < count($names); $i++): ?>
											<tr>
												<td>
													<?php echo $names[$i]->first_name . " " . $names[$i]->last_name; ?>
												</td>
												<td>
													<div class="inputFormMain">
														<select name="status[]" class="form-control input-sm" style="color: #aeafaf;" <?php if($today == date('Y-m-d', strtotime($att_date[0]->attendance_date))): ?> disabled <?php endif; ?>>
															<option value="">
																Select Status
															</option>
															<option value="Present" selected>
																Present
															</option>
															<option value="Absent">
																Absent
															</option>
														</select>
													</div>
													<input type="hidden" name="project[]" value="<?= $trainee_employees->project; ?>">
													<input type="hidden" name="trg_id[]" value="<?= $trainee_employees->trg_id; ?>">
													<input type="hidden" name="employee_id[]" value="<?= $names[$i]->employee_id; ?>">
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