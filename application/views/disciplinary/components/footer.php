<div class="modal fade" id="disciplinary-modal">
	<div class="modal-dialog">
		<form action="<?= base_url(); ?>Disciplinary/update_disciplinary_status" method="POST" novalidate>
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Status Modal</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="disciplinary_id" value="<?= $detail->id; ?>">
					
					<div id="disciplinaryHandler">
						
					</div>


					<div class="row">
						<div class="col-lg-12">
							<div class="inputFormMain">
								<label>Status Date</label>
								<input type="text" name="added_date" class="form-control date" required>
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


<?php if(isset($detail)): ?>
<div class="modal fade" id="edit-disciplinary-modal">
	<div class="modal-dialog modal-lg">
		<form action="<?= base_url(); ?>Disciplinary/update" method="POST">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>

				<h3 class="modal-title">Edit</h3>
			</div>
			<div class="modal-body">
				<div class="row">
		
					<?= $form_fields; ?>
	
	    		</div>	
			</div>
			<div class="modal-footer">
				<button type="submit" name="submit" class="btn btnSubmit"> 
    				Update 
    			</button>
    			<button type="reset" class="btn btnSubmit" data-dismiss="modal"> 
    				Close 
    			</button>
			</div>
		</div>
		</form>
	</div>
</div>
<?php endif; ?>


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

			window.location = "<?= base_url(); ?>Disciplinary/detail/" + id;
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
			var jobPositionHandler = $('#job_position').html('<option value="">SELECT OPTION</option>');

			$('#tehsil').html('<option value="">Select Tehsil</option>');
			$('#uc').html('<option value="">Select Union Council</option>');

			if(province == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Disciplinary/districts/'+province,
				type: 'POST',
				dataType: 'json',
				// data: {province_id: province},
				success: function (response) {
					
					var district = response.data.districts;
					var job_position = response.data.job_positions;

					var district_list = '';
					var job_positions_list = '';

					$.each(district, function(index, val) {
						 district_list += `<option value="${val.id}">${val.name}</option>`;
					});

					$.each(job_position, function(index, val) {
						job_positions_list += `<option value="${val.designation_id}">${val.designation_name}</option>`;
					});

					districtHandler.append(district_list);
					jobPositionHandler.append(job_positions_list);
				}

			});

		});


		$('.disciplinary').on('change', '.district', function() {
			var district = $(this).val();
			
			var tehsilHandler = $('#tehsil').html('<option value="">Select Tehsil</option>');
			var jobPositionHandler = $('#job_position').html('<option value="">SELECT OPTION</option>');


			$('#uc').html('<option value="">Select Union Council</option>');

			if(district == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Disciplinary/tehsils/'+district,
				type: 'POST',
				dataType: 'json',
				// data: {district_id: district},
				success: function (response) {
				
					var tehsil = response.data.tehsils;
					var job_position = response.data.job_positions;

					var tehsil_list = '';
					var job_positions_list = '';

					$.each(tehsil, function(index, val) {
						 tehsil_list += `<option value="${val.id}">${val.name}</option>`;
					});

					$.each(job_position, function(index, val) {
						job_positions_list += `<option value="${val.designation_id}">${val.designation_name}</option>`;
					});

					tehsilHandler.append(tehsil_list);
					jobPositionHandler.append(job_positions_list);
				}

			});

		});


		$('.disciplinary').on('change', '.tehsil', function() {
			var tehsil = $(this).val();
			var ucHandler = $('#uc').html('<option value="">Select Union Council</option>');
			var jobPositionHandler = $('#job_position').html('<option value="">SELECT OPTION</option>');


			if(tehsil == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Disciplinary/union_councils/'+tehsil,
				type: 'POST',
				dataType: 'json',
				// data: {tehsil_id: tehsil},
				success: function (response) {
				
					var ucs = response.data.ucs;
					var job_position = response.data.job_positions;

					var ucs_list = '';
					var job_positions_list = '';

					$.each(ucs, function(index, val) {
						 ucs_list += `<option value="${val.id}">${val.name}</option>`;
					});

					$.each(job_position, function(index, val) {
						job_positions_list += `<option value="${val.designation_id}">${val.designation_name}</option>`;
					});

					ucHandler.append(ucs_list);
					jobPositionHandler.append(job_positions_list);
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
				var position_filled_against = "";
				var transfer_type = "";

				<?php if(isset($province_string)): ?>
					provinces += "<?= $province_string; ?>";
				<?php endif; ?>

				<?php if(isset($position_filled_against_string)): ?>
					position_filled_against += "<?= $position_filled_against_string; ?>";
				<?php endif; ?>

				<?php if(isset($transfer_type_string)): ?>
					transfer_type += "<?= $transfer_type_string; ?>"
				<?php endif; ?>

				$('.disciplinary').html(`<div class="col-lg-4">
								<div class="inputFormMain">
									<label>Transfer Type</label>
									<select name="salary_hold" id="salary" class="form-control" required="required">
										<option value="">SELECT OPTION</option>
										${transfer_type}
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
										${position_filled_against}
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

			$('.date').datepicker({dateFormat: 'yy-mm-dd'});
			$('input').attr('autocomplete','off');
		});
	</script>


	<script type="text/javascript">
		
		$('.disciplinary-status-btn').on('click', function() {
			var status_text = $(this).data('text');
			
			var disciplinaryHandler = $('#disciplinaryHandler').html('');
			$.ajax({
				url: '<?= base_url(); ?>Disciplinary/status_fields',
				type: 'POST',
				dataType: 'json',
				data: {status_text: status_text},
				success: function(response) {
					disciplinaryHandler.append(response.data.output);
					$('#disciplinary-modal').modal('show');

					$('.date').datepicker({dateFormat: 'yy-mm-dd'});
					$('input').attr('autocomplete','off');
				}

			});
			
		});
		
	</script> 

	<script type="text/javascript">
		$('#load-template-btn').on('click', function() {
			var type_id = $(this).data('type');
			var disciplinary_id = $('.disciplinary-id').val();
			
			$.ajax({
				url: '<?= base_url(); ?>Disciplinary/load_template',
				type: 'POST',
				dataType: 'json',
				data: {disciplinary_id: disciplinary_id, type_id: type_id},
				success: function(response) {
					if(response.data == '')
						toastr.error('No template available.');
					else
						tinymce.get('template').setContent(response.data);
				}
			});
		});
	</script>

	<script type="text/javascript">
		$('#save-template-btn').on('click', function() {
			var disciplinary_id = $('.disciplinary-id').val();
			var template_content = tinymce.get('template').getContent();
			
			if(template_content == '')
			{
				toastr.error('Template can\'t be empty.');
				return;
			}

			$.ajax({
				url: '<?= base_url(); ?>Disciplinary/save_template',
				type: 'POST',
				dataType: 'html',
				data: {disciplinary_id: disciplinary_id, template_content: template_content},
				success: function(response) {

					if(response == '1')
						toastr.success('Letter saved successfully.');
					if(response == '0')
						toastr.error('Server Error.');
				}
			});
		});

	</script>



</body>
</html>