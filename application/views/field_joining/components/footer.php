<!-- Date of Joining Modal -->
	<div class="modal fade animated" id="doj-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	    	<form action="<?= base_url(); ?>Field_joining/add_doj" method="POST">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<strong class="modal-title">Date of Joining Form</strong> 
        		</div>
        		<div class="modal-body">
					<div class="row">
						<input type="hidden" name="employee_id" id="doj-employee-id" class="employee-id" value="">
						<input type="hidden" name="action" id="doj-action" class="action" value="">
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="employee_name" value="" id="doj-employee-name" class="form-control employee-name" placeholder="Employee Name" data-toggle="tooltip" title="Employee Name" readonly>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="father_name" value="" id="doj-father-name" class="form-control father-name" placeholder="Father Name" data-toggle="tooltip" title="Father Name" readonly>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="designation" value="" id="doj-father-name" class="form-control designation" placeholder="Designation" data-toggle="tooltip" title="Desigantion" readonly>
							</div>
						</div>
						<div class="col-lg-12"><hr></div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<select name="source_field_joining" id="doj-source" class="form-control" data-toggle="tooltip" title="Source Of Field Joining" required="required">
									<option value="">Select Field Joining Source</option>
									<option value="email">Email</option>
									<option value="written">Written</option>
									<option value="induction_training">By Induction Training</option>
								</select>
							</div>
						</div>
						
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="doj" value="" id="doj" class="form-control field-joining-date" placeholder="Date Of Joining" data-toggle="tooltip" title="Date Of Joining">
							</div>
						</div>
					</div>
				</div>

        		<div class="modal-footer">
        			<button type="submit" class="btn btnSubmit" id="">Submit</button>
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close">Close</button>
        		</div>
	        </div>
	        </form>
	    </div>
	</div>
<!-- ./Date of Joining Modal -->

<!-- CNIC Check Modal -->
<div class="modal fade animated" id="cnic-check-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    	<form action="<?= base_url(); ?>Field_joining/cnic_check" method="POST">
        <div class="modal-content">
        	<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<strong class="modal-title">CNIC Check Form</strong> 
    		</div>
    		<div class="modal-body">
				<div class="row">
						<input type="hidden" name="employee_id" id="check-employee-id" class="employee-id" value="">
						<input type="hidden" name="action" id="check-action" class="action" value="">

						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="doj_employee_name" value="" id="check-employee-name" class="form-control employee-name" placeholder="Employee Name" data-toggle="tooltip" title="Employee Name" readonly>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="doj_father_name" value="" id="check-father-name" class="form-control father-name" placeholder="Father Name" data-toggle="tooltip" title="Father Name" readonly>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="designation" value="" id="check-father-name" class="form-control designation" placeholder="Designation" data-toggle="tooltip" title="Desigantion" readonly>
							</div>
						</div>
						<div class="col-lg-12"><hr></div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="cnic_no" value="" id="check-cnic-no" class="form-control cnic-no" placeholder="CNIC No (digits only)" data-toggle="tooltip" title="CNIC No (digits only)" pattern="[0-9]{13}" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="cnic_expiry" value="" id="check-cnic-expiry" class="form-control date-onward cnic-expiry" placeholder="CNIC Expiry" data-toggle="tooltip" title="CNIC Expiry" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="dob" value="" id="check-dob" class="form-control dob" placeholder="Date Of Birth" data-toggle="tooltip" title="Date of Birth" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<select name="marital_status" id="doj-marital-status" class="form-control" data-toggle="tooltip" title="Marital Status" required="required">
									<option value="">Select Marital Status</option>
									<?php foreach($marital_status AS $m): ?>
									<option value="<?= $m->marital_id; ?>"><?= $m->marital_name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
				</div>
			</div>

    		<div class="modal-footer">
    			<button type="submit" class="btn btnSubmit" id=""> 
    				Submit 
    			</button>
    			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
    				Close 
    			</button>
    		</div>
        </div>
        </form>
    </div>
</div>
<!-- ./CNIC Check Modal -->




<?php $this->load->view('html/footer'); ?>

	<script type="text/javascript">
		$('.province').on('change', function() {
			var province = $(this).val();
			$('#district').parent().removeClass('hide');
			var districtHandler = $('#district').html('<option value="">Select District</option>');
			if(province == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Reports/district_for_province',
				type: 'POST',
				dataType: 'json',
				data: {province_id: province},
				success: function (response) {
					var obj = response.data;
					var district_list = '';
					$.each(obj, function(index, val) {
						 district_list += `<option value="${val.id}">${val.name}</option>`;
					});

					districtHandler.append(district_list);
				}

			});

		});


		$('.district').on('change', function() {
			var district = $(this).val();
			var type = $(this).attr('type');
			$('#tehsil').parent().removeClass('hide');
			var tehsilHandler = $('#tehsil').html('<option value="">Select Tehsil</option>');
			if(district == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Reports/tehsil_for_district',
				type: 'POST',
				dataType: 'json',
				data: {district_id: district},
				success: function (response) {
					var obj = response.data;
					var tehsil_list = '';
					$.each(obj, function(index, val) {
						 tehsil_list += `<option value="${val.id}">${val.name}</option>`;
					});

					tehsilHandler.append(tehsil_list);
				}

			});

		});


		$('.tehsil').on('change', function() {
			var tehsil = $(this).val();
			var ucHandler = $('#uc').html('<option value="">Select Union Council</option>');
			$('#uc').parent().removeClass('hide');
			if(tehsil == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Reports/uc_for_tehsil',
				type: 'POST',
				dataType: 'json',
				data: {tehsil_id: tehsil},
				success: function (response) {

					var obj = response.data;
					var ucs_list = '';
					$.each(obj, function(index, val) {
						 ucs_list += `<option value="${val.id}">${val.name}</option>`;
					});

					ucHandler.append(ucs_list);
				}

			});

		});
	</script>

	<script type="text/javascript">
		$('#employees-handler').on('click', '.cnic-check-link', function() { 
			var id = $(this).data('id');
			var name = $(`#name-${id}`).val();
			var fathername = $(`#fathername-${id}`).val();
			var designation = $(`#designation-${id}`).val();
			var office_location = $(`#location-${id}`).val();
			var action = $(`#action-${id}`).val();

			$('.employee-id').val(id);
			$('.employee-name').val(name);
			$('.father-name').val(fathername);
			$('.designation').val(designation);
			$('.action').val(action);

		    $('#cnic-check-modal').modal('show');
		});

		$('#employees-handler').on('click', '.doj-link', function() { 
			var id = $(this).data('id');
			var name = $(`#name-${id}`).val();
			var fathername = $(`#fathername-${id}`).val();
			var designation = $(`#designation-${id}`).val();
			var office_location = $(`#location-${id}`).val();
			var action = $(`#action-${id}`).val();

			$('.employee-id').val(id);
			$('.employee-name').val(name);
			$('.father-name').val(fathername);
			$('.designation').val(designation);
			$('.action').val(action);

		    $('#doj-modal').modal('show');
		});
	</script>

	<!-- Change status btns -->
	<script type="text/javascript">

	    // $('#employees-handler').on('click', '#status-btn .label', function() {
	    // 	var status = $(this).data('status');
	    // 	$('#employees-handler').html('');
	    // 	console.log(status);
	    // 	$.ajax({
	    // 		url: '<?= base_url(); ?>Field_joining/get_employees_table',
	    // 		type: 'GET',
	    // 		dataType: 'html',
	    // 		data: {status: status},
	    // 		success: function(response) {
	    // 			console.log(response);
	    // 			$('#employees-handler').append(response);
	    // 		}
	    // 	});
	    	
	    // });

	    $('#employees-handler').on('click', '#status-btn .label', function() {
	    	var status = $(this).data('status');
	    	$('#status').val(status);
	    	$('#search-btn').trigger('click');
	    	
	    });

	</script>


</body>
</html>