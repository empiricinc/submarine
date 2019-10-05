<!-- Select Inquirer Modal -->
<div class="modal fade animated" id="select-inquirer-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        	<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<strong class="modal-title">Select Investigator</strong> 
    		</div>
    		<div class="modal-body" id="inquirer-handler">
    			<div class="row">
    			
	    			<div class="col-lg-7">
	    				<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="project" id="project" class="form-control project" data-toggle="" title="Project" >
									<option value="">Select Projects</option>
									<?php foreach($projects as $p): ?>
									<option value="<?= $p->company_id; ?>"><?= $p->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
	    				<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="province" id="province" class="form-control province" data-toggle="" title="Province" >
									<option value="">Select Province</option>
									<?php foreach($province as $p): ?>
									<option value="<?= $p->id; ?>"><?= $p->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="district" id="district" class="form-control district" data-toggle="" title="District" >
									<option value="">Select District</option>
									
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="tehsil" id="tehsil" class="form-control tehsil" data-toggle="" title="Tehsil" >
									<option value="">Select Tehsil</option>
									
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="uc" id="uc" class="form-control union-council uc-investigation" data-toggle="" title="Union council" required>
									<option value="">Select Union Council</option>
									
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="designation" id="designation" class="form-control" data-toggle="" title="Designation" required>
									<option value="">Select Designation</option>
									<?php foreach($designations AS $d): ?>
									<option value="<?= $d->designation_id; ?>"><?= $d->designation_name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="employee" id="employee" class="form-control" data-toggle="" title="Employee" required>
									<option value="">Select Employee</option>
									
								</select>
							</div>
						</div>
	    			</div>
	    			<div class="col-lg-5" style="padding-left: 0px;">
	    				<div id="project-employees" style="border: 1px solid #e1e4e7; background: #f6f7f8; height: 375px; margin-top: 10px; margin-right: 15px; border-radius: 3px; overflow-y: scroll; padding: 10px">
	    					<div class="new"></div>
	    				</div>
	    			</div>

    			</div>
    		</div>
    		<div class="modal-footer">
    			<div class="col-lg-12">
    				<button type="button" class="btn btnSubmit" id="forward-local"> 
	    				Forward Inquiry
	    			</button>
    			</div>
    			
    		</div>
    		
        </div>
    </div>
</div>
<!-- ./Select Inquirer Modal -->

<!-- Investigation Modal -->
<div class="modal fade animated" id="investigation-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 60%; margin: 3% auto;">
    	<form action="<?= base_url(); ?>Disciplinary/add" method="POST">
	        <div class="modal-content">
	        	<div class="modal-header">
	    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
	    				<span aria-hidden="true">×</span> 
	    			</button>

	    			<strong class="modal-title">Create Investigation</strong> 
	    		</div>
	    		<div class="modal-body">
	    			<div class="row">
	    				<div class="col-lg-4">
	    					<input type="hidden" name="employee_id" id="employee-id" value="">
	    					<input type="hidden" name="project_id" id="project-id" value="">
	    					<input type="hidden" name="province_id" id="province-id" value="">
	    					<input type="hidden" name="department_id" id="department-id" value="">
	    					<input type="hidden" name="designation_id" id="designation-id" value="">
							<div class="inputFormMain">
								<label>Employee Name</label>
								<input type="text" name="employee_name" id="employee-name" class="form-control" readonly>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="inputFormMain">
								<label>Designation</label>
								<input type="text" name="designation_name" id="designation-name" class="form-control" readonly>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="inputFormMain">
								<label>Type</label>
								<select name="type" id="type" class="form-control" required="required">
									<option value="">SELECT TYPE</option>
									<?php foreach($type AS $t): ?>
										<option value="<?= $t->id; ?>"><?= ucwords($t->type_name); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="inputFormMain">
								<label>Reason</label>
								<select name="reason" id="reason" class="form-control" required="required">
									<option value="">SELECT REASON</option>
									<?php foreach($reasons AS $r): ?>
										<?php if($r->parent_id == '0') { ?>
											<optgroup label="<?= $r->reason_text; ?>">
										<?php } else { ?>
												<option value="<?= $r->id; ?>"><?= $r->reason_text; ?></option>
										<?php } ?>
										<?php endforeach; ?>
									<option value="other">Other</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="inputFormMain">
								<label>Other Reason</label>
								<input type="text" name="other_reason" id="other-reason" class="form-control" disabled>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="inputFormMain">
								<label>Reported By</label>
								<input type="text" name="reported_by" class="form-control">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="inputFormMain">
								<label>Reporting Date</label>
								<input type="text" name="reporting_date" class="form-control date">
							</div>
						</div>
						
					
						<div class="col-lg-12">
							<div class="inputFormMain">
								<label>Subject</label>
								<input type="text" name="subject" class="form-control">
							</div>
						</div>
						<div class="col-lg-12">
							<label>Description</label>
							<textarea name="description" id="description" class="form-control" rows="3" required="required"></textarea>
						</div>
	    			</div>
	    		</div>
	    		<div class="modal-footer">
	    			<button type="submit" class="btn btnSubmit" name="submit"> 
	    				Add 
	    			</button>
	    		</div>    		
	        </div>
    	</form>
    </div>
</div>
<!-- ./Previous Investigation Modal -->

<div class="modal fade" id="disciplinary-modal">
	<div class="modal-dialog">
		<form action="<?= base_url(); ?>Disciplinary/update_disciplinary_status" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Status Modal</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="status_text" id="status-text" value="<?= $detail->status_text; ?> ">
					<input type="hidden" name="disciplinary_id" value="<?= $detail->id; ?>">
					<?php if($detail->status_text == 'open'): ?>
					<div class="row">
						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Action Approval Date</label>
								<input type="text" name="approval_date" class="form-control date">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Approval Receive Date</label>
								<input type="text" name="approval_receive_date" class="form-control date">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Approved By</label>
								<input type="text" name="approved_by" class="form-control">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="inputFormMain">
								<label>Approved Action</label>
								<select name="approved_action" class="form-control" required="required">
									<option value="">SELECT ACTION</option>
									<?php foreach($type AS $t): ?>
										<option value="<?= $t->id; ?>"><?= ucwords($t->type_name); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<?php endif; ?>

					<div class="row">
						<?php if($detail->status_text != 'open'): ?>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<label>Date</label>
								<input type="text" name="added_date" class="form-control date">
							</div>
						</div>
						<?php endif; ?>

						<div class="col-lg-12 hide" id="next-action">
							<div class="inputFormMain">
								<label>Next Action</label>
								<select name="approved_action" class="form-control" required="required">
									<option value="">SELECT ACTION</option>
									<?php foreach($type AS $t): ?>
										<option value="<?= $t->id; ?>"><?= ucwords($t->type_name); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="inputFormMain">
								<label>Comments</label>
								<textarea name="comments" id="comments" class="form-control noresize" rows="5" required="required"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btnSubmit">Update</button>
					<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
				</div>
			</div>
		</form>
	</div>
</div>



<?php $this->load->view('html/footer'); ?>


	<script type="text/javascript">

	$(document).ready(function(){


		$(".add-new-form").click(function(){

			$(".add-form").slideToggle('slow');

		});

		$('.select2').select2();
		$('#resg-reason').select2({
			placeholder: 'SELECT A REASON',
			allowClear: true
		});



		$('.date').datepicker({

		changeMonth: true,

		changeYear: true,

		dateFormat:'yy-mm-dd',

		yearRange: '1900:' + (new Date().getFullYear() + 15),

		beforeShow: function(input) {

			$(input).datepicker("widget").show();

		}

		});

	});	




	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	});

	</script> 


	<script>
	
		 $('#complaints-handler').on('click', '#status-btn .label', function() {
	    	var status = $(this).data('status');
	    	$('#status').val(status);
	    	$('#disciplinary-search-btn').trigger('click');
	    });

	</script>

	<script type="text/javascript">
		$('#investigations-list>tr').on('click', function() {
			var id = $(this).attr('data');

			window.location = "<?= base_url(); ?>Disciplinary/view_detail/" + id;
			return;
			
		});
	</script>


	<script type="text/javascript">
		function ucwords($str)
		{
			$str = $str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
			    return letter.toUpperCase();
			});

			return $str;
		}
	</script>


	<script type="text/javascript">

		$('.disciplinary').on('change', '.province', function() {
			
			var province = $(this).val();
			var districtHandler = $('#district').html('<option value="">Select District</option>');


			$('#tehsil').html('<option value="">Select Tehsil</option>');
			$('#uc').html('<option value="">Select Union Council</option>');

			if(province == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/district_for_province',
				type: 'POST',
				dataType: 'json',
				data: {province_id: province},
				success: function (response) {

					var district = response.data;

					var district_list = '';
					$.each(district, function(index, val) {
						 district_list += `<option value="${val.id}">${val.name}</option>`;
					});

					districtHandler.append(district_list);
				}

			});

		});


		$('.disciplinary').on('change', '.district', function() {
			var district = $(this).val();
			var tehsilHandler = $('#tehsil').html('<option value="">Select Tehsil</option>');


			$('#uc').html('<option value="">Select Union Council</option>');

			if(district == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/tehsil_for_district',
				type: 'POST',
				dataType: 'json',
				data: {district_id: district},
				success: function (response) {
					var tehsil = response.data;

					var tehsil_list = '';
					$.each(tehsil, function(index, val) {
						 tehsil_list += `<option value="${val.id}">${val.name}</option>`;
					});

					tehsilHandler.append(tehsil_list);
				}

			});

		});


		$('.disciplinary').on('change', '.tehsil', function() {
			var tehsil = $(this).val();
			var ucHandler = $('#uc').html('<option value="">Select Union Council</option>');


			if(tehsil == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/uc_for_tehsil',
				type: 'POST',
				dataType: 'json',
				data: {tehsil_id: tehsil},
				success: function (response) {

					var ucs = response.data;
					var ucs_list = '';

					$.each(ucs, function(index, val) {
						 ucs_list += `<option value="${val.id}">${val.name}</option>`;
					});

					ucHandler.append(ucs_list);
				}

			});

		});


	</script>


	<script type="text/javascript">
		$('#investigation-table tr').on('click', function() {

			 var employee_id = $(this).data('id');
			if(employee_id == undefined)
				return;

			window.location = "<?= base_url(); ?>Disciplinary/employee_disciplinary/" + employee_id;
			// var employee_id = $(this).data('id');
			// if(employee_id == undefined)
			// 	return;
			
			// $.ajax({
			// 	url: '<?= base_url(); ?>Disciplinary/employee_detail',
			// 	type: 'POST',
			// 	dataType: 'json',
			// 	data: {employee_id: employee_id},
			// 	success: function(response) {

			// 		$('#employee-id').val(response.data.employee_id);
			// 		$('#project-id').val(response.data.project_id);
			// 		$('#province-id').val(response.data.provience_id);
			// 		$('#department-id').val(response.data.department_id);
			// 		$('#designation-id').val(response.data.designation_id);
			// 		$('#employee-name').val(ucwords(response.data.emp_name));
			// 		$('#designation-name').val(response.data.designation_name);
			// 		$('#investigation-modal').modal('show');
			// 	}
			// });
			
		});
	</script>

	<script type="text/javascript">
		$('#reason').on('change', function() {
			var reason = $(this).val();
			if(reason == 'other')
				$('#other-reason').prop('disabled', false);
			else
				$('#other-reason').prop('disabled', true);
		});
	</script>


	<script type="text/javascript">
		$('#type').on('change', function() {
			var type = $('#type option:selected').text();
			$('.disciplinary').html('');

			if(type == 'Warning' || type == 'Final Warning' || type == 'Explanation' || type == 'Suspension' || type == 'Query')
			{
				$('.disciplinary').append(`<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence</label>
									<select name="evidence" id="evidence" class="form-control" required>
										<option value="">SELECT EVIDENCE</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence Date</label>
									<input type="text" name="evidence_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SALARY HOLD</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>`);
			}

			else if(type == 'Show Cause')
			{
				$('.disciplinary').append(`<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence</label>
									<select name="evidence" id="evidence" class="form-control" required="required">
										<option value="">SELECT EVIDENCE</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence Date</label>
									<input type="text" name="evidence_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SALARY HOLD</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Suspende from Duty</label>
									<select name="suspend_from_duty" id="suspend" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>`);
			}

			else if(type == 'Resign')
			{
				$('.disciplinary').html(`<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence</label>
									<select name="evidence" id="evidence" class="form-control" required="required">
										<option value="">SELECT EVIDENCE</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Evidence Date</label>
									<input type="text" name="evidence_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SALARY HOLD</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Suspende from Duty</label>
									<select name="suspend_from_duty" id="suspend" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>`);
			}

			else if(type == 'Contract Closure')
			{
				$('.disciplinary').html(`<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Issue Reporting Date</label>
									<input type="text" name="issue_reporting_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Last Working Date</label>
									<input type="text" name="last_working_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Position Abolish</label>
									<select name="position_abolish" id="position_abolish" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Abolish Date</label>
									<input type="text" name="abolish_date" class="form-control date">
								</div>
							</div>`);
			}

			else if(type == 'Refusal')
			{
				$('.disciplinary').html(`<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Issue Reporting Date</label>
									<input type="text" name="issue_reporting_date" class="form-control date">
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Salary Hold</label>
									<select name="salary" id="salary" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Last Working Date</label>
									<input type="text" name="last_working_date" class="form-control date">
								</div>
							</div>`);
			}

			else if(type == 'Transfer')
			{
				var provinces = "";
				<?php if(isset($province_string)): ?>
				 provinces += "<?= $province_string; ?>";
				<?php endif; ?>

				$('.disciplinary').html(`<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Transfer Type</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Normal Transfer</option>
										<option value="2">Transfer Due to UC Split</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Position Abolish</label>
									<select name="position_abolish" id="position_abolish" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Yes</option>
										<option value="0">No</option>
									</select>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Abolish Date</label>
									<input type="text" name="abolish_date" class="form-control date">
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Reporting Date To CTC</label>
									<input type="text" name="reported_date_ctc" class="form-control date">
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Province</label>
									<select name="province" id="province" class="form-control province" required="required">
										<option value="">SELECT OPTION</option>
										${provinces}
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>District</label>
									<select name="district" id="district" class="form-control district" required="required">
										<option value="">SELECT OPTION</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Tehsil</label>
									<select name="tehsil" id="tehsil" class="form-control tehsil" required="required">
										<option value="">SELECT OPTION</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>UC</label>
									<select name="uc" id="uc" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
									</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Position Filled Against</label>
									<select name="position_filled_against" id="position_filled_against" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										<option value="1">Vacant Positions</option>
										<option value="2">New Positions</option>
										<option value="3">Shifted Positions</option>
									</select>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>New Job Position</label>
									<select name="job_position" id="job_position" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
									</select>
								</div>
							</div>

							<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Transfer Effective Date</label>
									<input type="text" name="transfer_effective_date" class="form-control date">
								</div>
							</div>`);
			}

			$('.date').datepicker();
			$('input').attr('autocomplete','off');
		});
	</script>


	<script type="text/javascript">
		
		$('.disciplinary-status-btn').on('click', function() {
			var status_text = $(this).data('text');
			$('#status-text').val(status_text);

			if(status_text == 'not received')
				$('#next-action').removeClass('hide');
			else
				$('#next-action').addClass('hide');

			$('#disciplinary-modal').modal('show');
			
		});

		
	</script> 



</body>
</html>