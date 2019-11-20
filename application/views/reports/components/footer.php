<!-- Employee Detail Modal -->
	<div class="modal fade animated" id="employee-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header hide-from-print">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<strong class="modal-title">Employee Detail</strong> 
        		</div>
        		<div class="modal-body" id="employee-handler">
        			
        		</div>
        		<div class="modal-footer hide-from-print">
        			<button type="button" class="btn btnSubmit" id="print-employee-detail"> 
        				Print 
        			</button>
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
        				Close 
        			</button>
        		</div>
	    		
	        </div>
	    </div>
	</div>
<!-- ./Employee Detail Modal -->

<!-- /Termination Detail Modal -->
	<div class="modal fade animated" id="termination-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<strong class="modal-title">Termination Detail</strong> 
        		</div>
        		<div class="modal-body" id="termination-handler">
        			
        		</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
        				Close 
        			</button>
        		</div>
	    		
	        </div>
	    </div>
	</div>
<!-- .//Termination Detail Modal -->

<!-- Resignation Detail Modal -->
	<div class="modal fade animated" id="resignation-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<strong class="modal-title">Resignation Detail</strong> 
        		</div>
        		<div class="modal-body" id="resignation-handler">
        			
        		</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
        				Close 
        			</button>
        		</div>
	    		
	        </div>
	    </div>
	</div>
<!-- ./Resignation Detail Modal -->


<!-- Employee Detail Modla -->

<!-- Edit Bank Info Modal -->
	<div class="modal fade animated" id="edit-bankinfo-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<h4 class="modal-title">Bank Detail</h4> 
        		</div>
        		<div class="modal-body" id="bank-detail-handler">
					<div class="row">
						<input type="hidden" id="bank-detail-id">
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="bank" id="update-bank" class="form-control" data-toggle="tooltip" title="" required="" data-original-title="Bank name">
									<option value="">Select bank name</option>
										
									</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="account_title" value="" id="update-account-title" class="form-control" placeholder="Account title" data-toggle="tooltip" title="" required="" data-original-title="Account title">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="account" value="" id="update-account-no" class="form-control" placeholder="Account #" data-toggle="tooltip" title="" required="" data-original-title="Account #">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="branch_code" value="" id="update-branch-code" class="form-control" placeholder="Branch code" data-toggle="tooltip" title="" required="" data-original-title="Branch code">
							</div>
						</div>
					</div>
        		</div>
        		<div class="modal-footer">
        			<button type="button" id="update-bank-info" class="btn btn-block btnSubmit">Update</button>
        		</div>
	        </div>
	    </div>
	</div>
<!-- ./Edit Bank Info Modal -->

<!-- Edit Educational Qualification Modal -->
	<div class="modal fade animated" id="edit-education-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<h4 class="modal-title">Qualification Detail</h4> 
        		</div>
        		<div class="modal-body" id="qualification-detail-handler">
        			<div class="row">
        				<input type="hidden" id="qualification-detail-id">
						<div class="col-lg-12">
							<div class="inputFormMain">
								<input type="text" name="institute_name" value="" id="update-institute-name" class="form-control" placeholder="University/ Institute" data-toggle="tooltip" title="" required="" data-original-title="University/ Institute">
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="qualification_id" id="update-qualification-id" class="form-control" data-toggle="tooltip" title="" required="" data-original-title="Qualification">
									<option value="">Select Qualification</option>
										
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<select name="discipline" id="update-discipline" class="form-control" data-toggle="tooltip" title="" required="" data-original-title="Descipline">
									<option value="">Select Descipline</option>
										
								</select>
							</div>
						</div>
					</div>	
        		</div>
        		<div class="modal-footer">
        			<button type="button" id="update-education" class="btn btn-block btnSubmit">Update</button>
        		</div>
	        </div>
	    </div>
	</div>
<!-- ./Edit Educational Qualification Modal -->


<!-- Edit Work Experience -->

<div class="modal fade animated" id="edit-job-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<h4 class="modal-title">Job Detail</h4> 
    		</div>
    		<div class="modal-body" id="job-detail-handler">
    			<div class="row">
    				<input type="hidden" id="job-detail-id">
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="company" value="" id="update-company" class="form-control" placeholder="Company name"  data-toggle="tooltip" title="Company name" required >
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="designation" value="" id="update-designation" class="form-control" placeholder="Designation"  data-toggle="tooltip" title="Designation" required >
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="from_date" value="" id="update-from-date" class="form-control date" placeholder="From date"  data-toggle="tooltip" title="From date" required >
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="to_date" value="" id="update-to-date" class="form-control date" placeholder="To date"  data-toggle="tooltip" title="To date" required >
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="description" id="update-description" class="form-control" rows="3" placeholder="Description" required></textarea>
						</div>
					</div>
				</div>	
    		</div>
    		<div class="modal-footer">
    			<button type="button" id="update-job" class="btn btn-block btnSubmit">Update</button>
    		</div>
        </div>
    </div>
</div>

<!-- ./ Edit Work Experience -->


<!-- Delete Modal -->
<div class="modal fade animated" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
    		<div class="modal-body" id="delete-data-handler">
    			<input type="hidden" id="record-id" value="">
    			<input type="hidden" id="record-type" value="">
    			<h4>Do you want this record to be deleted?</h4>
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-danger" id="deleteBtn" data-dismiss="modal" aria-label="Close"> 
    				Yes 
    			</button>
    			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
    				No
    			</button>
    		</div>
    		
        </div>
    </div>
</div>



<!-- ./Employee Detail Modla -->


<?php $this->load->view('html/footer'); ?>
	



	<script>
		$('#employee-table tr').on('click', function() {
		
			var id = $(this).attr('data');
			if(id == undefined)
				return;


			window.location = "<?= base_url(); ?>Reports/employee_detail/"+id;
			
		});

	</script>

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

	<!-- Change status btns -->
	<script type="text/javascript">

	    // $('#complaints-handler').on('click', '#status-btn .label', function() {
	    // 	var status = $(this).data('status');
	    // 	$('#complaints-handler').html('');
	    	
	    // 	$.ajax({
	    // 		url: '<?= base_url(); ?>Reports/get_complaints_table',
	    // 		type: 'GET',
	    // 		dataType: 'json',
	    // 		data: {status: status, search: '1'},
	    // 		success: function(response) {
	    // 			console.log(response.data.query);
	    // 			$('#complaints-handler').append(response.data.table);
	    // 		}
	    // 	});
	    	
	    // });

	    $('#complaints-handler').on('click', '#status-btn .label', function() {
	    	var status = $(this).data('status');
	    	$('#complaint-status').val(status);
	    	$('#search-btn').trigger('click');
	    });

	</script>



	<script type="text/javascript">
		$('#complaints-handler').on('click', 'tr', function() {
			var id = $(this).attr('data');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Reports/complaint_detail/" + id;
			return;
		});
	</script>



	<script>
		$('.resignation-table tr').on('click', function() {

			var id = $(this).attr('data');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Reports/resignation_detail/" + id;
			return;
			// $('#resignation-handler').html('');

			// $.ajax({
			// 	url: '<?= base_url(); ?>Resignations/detail',
			// 	type: 'POST',
			// 	dataType: 'html',
			// 	data: {id: id},
			// 	success: function(response)
			// 	{
			// 		$('#resignation-handler').append(response);
			// 		$('#resignation-detail-modal').modal('show');
			// 	}
			// });
			
		});
	</script>

	<script>
		$('.termination-table tr').on('click', function() {

			var id = $(this).attr('data');
			console.log(id);
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Reports/termination_detail/" + id;
			return;
			// $('#termination-handler').html('');

			// $.ajax({
			// 	url: '<?= base_url(); ?>Terminations/detail',
			// 	type: 'POST',
			// 	dataType: 'html',
			// 	data: {id: id},
			// 	success: function(response)
			// 	{
			// 		$('#termination-handler').append(response);
			// 		$('#termination-detail-modal').modal('show');
			// 	}
			// });
			
		});



		$('#print-employee-detail').on('click', function() {
			window.print();
		});
	</script>


	

	<!-- Employee Detail -->
	
		<script type="text/javascript">
		$('.province').on('change', function() {
			var province = $(this).val();
			var type = $(this).attr('type');
			var districtHandler = $('#'+type+'-district').html('<option>Select District</option>');
			if(province == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/district_for_province',
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
			var tehsilHandler = $('#'+type+'-tehsil').html('<option>Select Tehsil</option>');
			if(district == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/tehsil_for_district',
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
			var type = $(this).attr('type');
			
			var ucHandler = $('#'+type+'-uc').html('<option>Select Union Council</option>');

			if(tehsil == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/uc_for_tehsil',
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


	<!-- Trainings -->

	<script type="text/javascript">
		// $('#trainings-table tbody tr').on('click', function() {
		
		// 	var id = $(this).attr('data');
		// 	if(id == undefined)
		// 		return;

		// 	window.location = "<?= base_url(); ?>Reports/training_detail/"+id;
		// });

		// $('#trainings-table #training-report a').on('click', function() {
		// 	console.log()
		// });
	</script>

	<!-- Tests -->

	<script type="text/javascript">
		$('#tests-table tbody tr').on('click', function() {
			
			var id = $(this).attr('data');

			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Reports/test_detail/"+id;
		});
	</script>



</body>
</html>