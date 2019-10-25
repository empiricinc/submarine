<!-- Policy Detail Modal -->
	<div class="modal fade animated" id="policy-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<strong class="modal-title">Policy Detail</strong> 
        		</div>
        		<div class="modal-body" id="policy-handler">
        			
        			
        		</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
        				Close 
        			</button>
        		</div>
	    		
	        </div>
	    </div>
	</div>
<!-- ./Policy Detail Modal -->

<!-- Complainee Modal -->
	<div class="modal fade animated" id="complainee-reply-modal" tabindex="-1" role="dialog" aria-hidden="true">

		<form action="<?= base_url(); ?>User_panel/investigation_reply" method="POST">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<strong class="modal-title">Complainee Reply Form</strong> 
        		</div>
        		<div class="modal-body" id="complainee-reply-handler">
        			<input type="hidden" name="complaint_id" id="complaint_id" value="">
        			<textarea name="complaint_reply" id="complainee_reply" class="form-control noresize" cols="30" rows="10" style="width: 100%;" placeholder="Write your reply here..."></textarea>
        		</div>
        		<div class="modal-footer">
        			<button type="submit" class="btn btnSubmit" id="send-reply"> 
        				Send 
        			</button>
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
        				Close 
        			</button>
        		</div>
	    		
	        </div>
	    </div>
	    </form>
	</div>
<!-- ./Complainee Modal -->


<!-- Field Joining Modal -->
	<div class="modal fade animated" id="field-modal" tabindex="-1" role="dialog" aria-hidden="true">

		<form action="<?= base_url(); ?>User_panel/" method="POST">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<strong class="modal-title">Field Joining Report</strong> 
        		</div>
        		<div class="modal-body" id="field-handler">
        			
        			
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
	    </div>
	    </form>
	</div>
<!-- ./Field Joining Modal -->


<!-- Training Detail Modal -->
	<div class="modal fade animated" id="training-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<h4 class="modal-title">Training Detail</h4> 
        		</div>
        		<div class="modal-body" id="training-handler">
        			
        			
        		</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
        				Close 
        			</button>
        		</div>
	    		
	        </div>
	    </div>
	</div>
<!-- ./Training Detail Modal -->


<!-- Training Rejection Modal -->
	<div class="modal fade animated" id="training-rejection-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<form action="<?= base_url(); ?>User_panel/reject_training" method="POST">
		    <div class="modal-dialog">
		        <div class="modal-content">
		        	<div class="modal-header">
	        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
	        				<span aria-hidden="true">×</span> 
	        			</button>

	        			<h4 class="modal-title">Training Rejection Form</h4> 
	        		</div>
	        		<div class="modal-body" id="training-rejection-handler">
	        			
	        			<input type="hidden" id="trainingID" name="training_id" value="">
	        			<div class="row">	
							<div class="col-lg-12">
								<div class="inputFormMain">
									<select name="rejection_reason" id="rejection-reason" class="form-control"required="">
										<option value="">Select Rejection Reason</option>
										<option value="1">Reason 1</option>
										<option value="2">Reason 2</option>
										<option value="3">Reason 3</option>
										<option value="4">Reason 4</option>
									</select>
								</div>
							</div>
						</div>
	        			
	        		</div>
	        		<div class="modal-footer">
	        			<button type="submit" class="btn btnSubmit"> 
	        				Submit 
	        			</button>
	        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
	        				Close 
	        			</button>
	        		</div>	
		        </div>
		    </div>
		</form>
	</div>
<!-- ./Training Rejection Modal -->


<!-- Leave Application Detail Modal -->
	<div class="modal fade animated" id="leave-app-detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	        	<div class="modal-header">
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
        				<span aria-hidden="true">×</span> 
        			</button>

        			<strong class="modal-title">Leave Application Detail</strong> 
        		</div>
        		<div class="modal-body" id="leave-app-handler">
        			
        			
        		</div>
        		<div class="modal-footer">
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
        				Close 
        			</button>
        		</div>
	    		
	        </div>
	    </div>
	</div>
<!-- ./Leave Application Detail Modal -->

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
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="from" value="" id="update-qFromDate" class="form-control date" placeholder="From Date"  data-toggle="tooltip" title="From Date" required >
							</div>
						</div>
						<div class="col-lg-6">
							<div class="inputFormMain">
								<input type="text" name="to" value="" id="update-qToDate" class="form-control date" placeholder="To Date"  data-toggle="tooltip" title="To Date" required >
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
    <div class="modal-dialog">
        <div class="modal-content modal-sm">
    		<div class="modal-body" id="delete-data-handler">
    			<input type="hidden" id="record-id" value="">
    			<input type="hidden" id="record-type" value="">
    			<h4>Are you sure to delete?</h4>
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-danger" id="deleteBtn" data-dismiss="modal" aria-label="Close"> 
    				Yes 
    			</button>
    			<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> 
    				No
    			</button>
    		</div>
    		
        </div>
    </div>
</div>

<?php $this->load->view('html/footer'); ?>
	

	<script type="text/javascript">

	$(document).ready(function(){


		$(".add-new-form").click(function(){

			$(".add-form").slideToggle('slow');

		});

		// $('.select2').select2();
		// $('#resg-reason').select2({
		// 	placeholder: 'SELECT A REASON',
		// 	allowClear: true
		// });



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

	$('.payroll-month').datepicker({dateFormat:'mm/yy'});

	$('.date-onward').datepicker({
		minDate: 0
	});

	$('.dataTable').DataTable();



	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	});

	</script> 


	<script>
		$('.policy-table tr').on('click', function() {

			var id = $(this).attr('data');
			$('#policy-handler').html('');

			$.ajax({
				url: '<?= base_url(); ?>User_panel/policy_detail',
				type: 'POST',
				dataType: 'html',
				data: {id: id},
				success: function(response)
				{
					$('#policy-handler').append(response);
					$('#policy-detail-modal').modal('show');
				}
			});
			
		});


		/* If user click on leave application row */
		$('.leave-application-table tr').on('click', function() {

			var id = $(this).attr('data');
			if(id == undefined)
				return;

			$('#leave-app-handler').html('');

			$.ajax({
				url: '<?= base_url(); ?>User_panel/leave_detail',
				type: 'POST',
				dataType: 'html',
				data: {id: id},
				success: function(response)
				{
					$('#leave-app-handler').append(response);
					$('#leave-app-detail-modal').modal('show');
				}
			});
			
		});

		$('.print-payslip').click(function(){
		     window.print();
		});
	</script>


	<script type="text/javascript">
		$('.province').on('change', function() {
			var province = $(this).val();
			var type = $(this).attr('type');
			var districtHandler = $('#'+type+'-district').html('<option>Select District</option>');

			$('#'+type+'-tehsil').html('<option>Select Tehsil</option>');
			$('#'+type+'-uc').html('<option>Select Union Council</option>');

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

			$('#'+type+'-uc').html('<option>Select Union Council</option>');
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


	<!-- Employee detail forms -->

	<script type="text/javascript">

		/* Enabling Update Buttons */
		$('.form-control').on('change paste keyup', function() {
			$formID = $(this).closest('form').attr('id');
			$('#'+$formID+' .btnSubmit').prop('disabled', false);
		});


		$('#basic-information-form').on('submit', function(e) {
			e.preventDefault();
			var error = 0;
			$.each($('.contact-no'), function(index, val) {

				if(!$(this).val().match(/^\d+$/))
				{
					toastr.error('Contact No must not contain letters');
					error = 1;
					return;
				}
				
			});

			$.each($('.contact-no'), function(index, val) {
				
				if($(this).val().length > 11 || $(this).val().length < 11)
				{
					toastr.error('Invalid contact no provided.');
					toastr.error('Contact No must not exceed 11 digits.');
					error = 1;
					return;
				}
				
			});

			
			if(error == 1)
				return;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/update_employee',
				type: 'POST',
				dataType: 'html',
				data: new FormData(this),
				processData:false,
	            contentType:false,
	            cache:false,
	            async:false,
				success: function(response) {
					
					if(response == '1')
						toastr.success('Success! Record was updated');
					else
						toastr.error('Error! Record wasn\'t updated');
				}
			});
			
		});

		$('#residential-address-form').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= base_url(); ?>User_panel/update_residential_address',
				type: 'POST',
				dataType: 'html',
				data: $('#residential-address-form').serialize(),
				success: function(response) {

					if(response == '1')
						toastr.success('Success! Address was updated');
					else
						toastr.error('Error! Address wasn\'t updated');
				}
			});
		});

		$('#permanent-address-form').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= base_url(); ?>User_panel/update_permanent_address',
				type: 'POST',
				dataType: 'html',
				data: $('#permanent-address-form').serialize(),
				success: function(response) {
			
					if(response == '1') 
						toastr.success('Success! Address was updated');
					else
						toastr.error('Error! Address wasn\'t updated');
				}
			});
		});

		$('#educational-qualification-form').on('submit', function(e) {
			e.preventDefault();

			var institute_name = $('#institute-name').val();
			var qualification_id = $('#qualification option:selected').val();
			var discipline = $('#discipline option:selected').text();
			var from_date = $('#qFromDate').val();
			var to_date = $('#qToDate').val();

			if(institute_name == "" || qualification_id == "" || discipline == "" || from_date == "" || to_date == "")
			{
				toastr.error('Error! All fields are requird');
				return;
			}

			var row_count = $('#education-table').DataTable().column(0).data().length + 1;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/add_qualification',
				type: 'POST',
				dataType: 'html',
				data: $('#educational-qualification-form').serialize(),
				success: function(response) {
			
					if(response != '0')
					{
						education_table.dataTable().api().ajax.reload();

						$('#institute-name').val('');
						$('#discipline').val($('#discipline option:first').val());
						toastr.success('Success! Qualification was added');
					}
					else
					{
						toastr.error('Error! Qualification wasn\'t added');
					}
				}
			});
		});

		$('#bank-information-form').on('submit', function(e) {
			e.preventDefault();
			var account_title = $('#account-title').val();
			var account_no = $('#account').val();
			var branch_code = $('#branch-code').val();
			var bank = $('#bank option:selected').text();

			if(account_title == "" || account_no == "" || branch_code == "" || bank == "")
			{
				toastr.error('Error! All fields are required');
				return;
			}
			
			var row_count = $('#bank-detail-table').DataTable().column(0).data().length + 1;


			$.ajax({
				url: '<?= base_url(); ?>User_panel/add_bank_info',
				type: 'POST',
				dataType: 'html',
				data: $('#bank-information-form').serialize(),
				success: function(response) {
					
					if(response != '0')
					{
						bank_table.dataTable().api().ajax.reload();
						$('#account-title').val('');
						$('#account').val('');
						$('#branch-code').val('');
						$('#bank').val($('#bank option:first').val());
						toastr.success('Success! Bank Detail was added');
					}
					else
					{
						toastr.error('Error! Bank Detail wasn\'t added');
					}

				}
			});
		});
	</script>

	<!-- Education and Bank DataTables -->
	<script type="text/javascript">
		var education_table = $('#education-table').dataTable({
	        "bDestroy": true,
			"ajax": {
	            url : "<?= base_url(); ?>User_panel/get_education_table",
	            type : 'GET'
	        },

			"fnDrawCallback": function(settings){         

			}
	    });

	    var bank_table = $('#bank-detail-table').dataTable({
	        "bDestroy": true,
			"ajax": {
	            url : "<?= base_url(); ?>User_panel/get_bank_table",
	            type : 'GET'
	        },

			"fnDrawCallback": function(settings){         

			}
	    });

	    var job_table = $('#job-experience-table').dataTable({
	        "bDestroy": true,
			"ajax": {
	            url : "<?= base_url(); ?>User_panel/get_job_table",
	            type : 'GET'
	        },

			"fnDrawCallback": function(settings){         

			}
	    });
	</script>

	<!-- Edit Education and Bank -->
	<script type="text/javascript">
		$('#edit-education-modal').on('show.bs.modal', function(e) {
			var editBtn = $(e.relatedTarget);
			
			var rec_id = editBtn.attr('data');
			var disciplineHolder = $('#update-discipline').html('<option value="">Select Discipline</option>');
			var qualificationHolder = $('#update-qualification-id').html('<option value="">Select Qualification</option>');
			var disciplines = '';
			var qualifications = '';

			$.ajax({
				url: '<?= base_url(); ?>User_panel/get_education_info',
				type: 'POST',
				dataType: 'json',
				data: {id: rec_id},
				success: function(response)
				{
					var disciplines = response.discipline;
					var qualifications = response.qualification;
					var institute_name = response.data.institute_name;
					var qualification_id = response.data.qualification_id;
					var selected_discipline = response.data.discipline_id;
					var record_id = response.data.id;

					var from_date = response.data.from;
					var to_date = response.data.to;

					$.each(disciplines, function(index, val) {
						if(val.discipline_id == selected_discipline)
							disciplines += `<option value="${val.discipline_id}" selected>${val.discipline_name}</option>`;
						else
							disciplines += `<option value="${val.discipline_id}">${val.discipline_name}</option>`;

					});

					$.each(qualifications, function(index, val) {
						if(val.id == qualification_id)
							qualifications += `<option value="${val.id}" selected>${val.name}</option>`;
						else
							qualifications += `<option value="${val.id}">${val.name}</option>`;

					});

					disciplineHolder.append(disciplines);
					qualificationHolder.append(qualifications);
					$('#qualification-detail-id').val(record_id);
					$('#update-institute-name').val(institute_name);
					$('#update-qFromDate').val(from_date);
					$('#update-qToDate').val(to_date);
				
				}
			});
			
		});

		$('#edit-bankinfo-modal').on('show.bs.modal', function(e) {
			var editBtnInfo = $(e.relatedTarget);
			var rec_id = editBtnInfo.attr('data');
			var bankHolder = $('#update-bank').html('<option value="">Select Bank</option>');
			var banks = '';

			$.ajax({
				url: '<?= base_url(); ?>User_panel/get_bank_info',
				type: 'POST',
				dataType: 'json',
				data: {id: rec_id},
				success: function(response)
				{
					console.log(response);
					var obj = response.bank;
					var acc_no = response.data.account_id;
					var branch_code = response.data.branch_code;
					var acc_title = response.data.account_title;
					var selected_bank = response.data.bank_id;
					var record_id = response.data.id;

					$.each(obj, function(index, val) {
						if(val.bank_id == selected_bank)
							banks += `<option value="${val.bank_id}" selected>${val.bank_name}</option>`;
						else
							banks += `<option value="${val.bank_id}">${val.bank_name}</option>`;

					});

					bankHolder.append(banks);
					$('#bank-detail-id').val(record_id);
					$('#update-account-title').val(acc_title);
					$('#update-account-no').val(acc_no);
					$('#update-branch-code').val(branch_code);
					$('#edit-bank-modal').modal('show');

					// $('#edit-bankinfo-modal').modal('show');
				}
			});
			
		});
	</script>

	<!-- ./ Edit Education and Bank -->

	<!-- Update Education and Bank Record -->

	<script type="text/javascript">
		$('#update-bank-info').on('click', function() {
			var id = $('#bank-detail-id').val();
			var bank_id = $('#update-bank').val();
			var acc_title = $('#update-account-title').val();
			var acc_no = $('#update-account-no').val();
			var branch = $('#update-branch-code').val();

			if(bank_id == "" || acc_title == "" || acc_no == "" || branch == "")
			{
				toastr.error('Error! All form fields are required');
				return;
			}

			$.ajax({
				url: '<?= base_url(); ?>User_panel/update_bank_info',
				type: 'POST',
				dataType: 'html',
				data: {id: id, bank_id: bank_id, acc_title: acc_title, acc_no: acc_no, branch_code: branch},
				success: function(response) {
					console.log(response);
					if(response == '0')
					{
						toastr.error('Error! Record updation failed.');
					}
					else
					{
						bank_table.dataTable().api().ajax.reload();
						toastr.success('Success! Record was updated.');
						$('#edit-bankinfo-modal').modal('hide');
					}
				}
			});

		});

		$('#update-education').on('click', function() {
			var id = $('#qualification-detail-id').val();
			var discipline = $('#update-discipline').val();
			var qualification = $('#update-qualification-id').val();
			var institute_name = $('#update-institute-name').val();
			var from_date = $('#update-qFromDate').val();
			var to_date = $('#update-qToDate').val();

			var tableRowCount = $('#education-table').DataTable().column(0).data().length + 1;
			
			if(discipline == "" || institute_name == "") {
				toastr.error('Error! All fields are required');
				return;
			}

			$.ajax({
				url: '<?= base_url(); ?>User_panel/update_education_info',
				type: 'POST',
				dataType: 'html',
				data: {id: id, discipline: discipline, qualification_id: qualification, institute_name: institute_name, from_date, to_date},
				success: function(response) {
					
					if(response == '0')
					{
						toastr.error('Error! Record updation failed.');
					}
					else
					{
						// reWriteEductionTable();
						education_table.dataTable().api().ajax.reload();
						toastr.success('Success! Record was updated.');
						$('#edit-education-modal').modal('hide');
					}
				}
			});
			
		});
	</script>



	<!-- Update Education and Bank Record -->

	<!-- Delete Records -->
	<script type="text/javascript">
		$('#delete-modal').on('show.bs.modal', function(e) {
			var rec_id = $(e.relatedTarget).data('id');
			var type = $(e.relatedTarget).data('type');

			$('#record-id').val(rec_id);
			$('#record-type').val(type);
			
		});

		$('#deleteBtn').on('click', function() {

			var record_id = $('#record-id').val();
			var record_type = $('#record-type').val();
			var url = '';

			if(record_id == "" || record_type == "")
			{
				toastr.error('Error! Invalid record.');
				return;
			}

			if(record_type == 'bank')
				url = 'delete_emp_bank_info'
			else if(record_type == 'qualification')
				url = 'delete_emp_qualification_info';
			else if(record_type == 'job')
				url = 'delete_job_experience';

			$.ajax({
				url: '<?= base_url(); ?>User_panel/'+url,
				type: 'POST',
				dataType: 'html',
				data: {id: record_id},
				success: function(response)
				{
					if(response == '1')
					{
						if(record_type == 'bank')
							bank_table.dataTable().api().ajax.reload();
						else if(record_type == 'qualification')
							education_table.dataTable().api().ajax.reload();
						else
							job_table.dataTable().api().ajax.reload();

						toastr.success('Success! Record Deleted.');
					}
					else
					{
						toastr.error('Error! Record not deleted.');
					}
				}
			});
			
		});
	</script>



	<!-- Work Experience Pane manipulation -->
	
	<script type="text/javascript">

		$('#work-experience-form').on('submit', function(e) {
			e.preventDefault();

			var company = $('#company').val();
			var designation = $('#designation').val();
			var from_date = $('#from-date').val();
			var to_date = $('#to-date').val();
			var description = $('#description').val();

			if(company == "" || designation == "" || from_date == "" || to_date == "" || description == "")
			{
				toastr.error('Error! All fields are required');
				return;
			}

			var row_count = job_table.DataTable().column(0).data().length + 1;

			$.ajax({
				url: '<?= base_url(); ?>User_panel/add_experience',
				type: 'POST',
				dataType: 'html',
				data: $('#work-experience-form').serialize(),
				success: function(response) {
					
					if(response != '0')
					{
						job_table.dataTable().api().ajax.reload();
						$('#company').val('');
						$('#designation').val('');
						$('#from-date').val('');
						$('#to-date').val('');
						$('#description').val('');
						toastr.success('Success! Record was added');
					}
						
					else
					{
						toastr.error('Error! Record wasn\'t added');
					}
				}
			});
			
		});
	</script>

	<!-- ./ Work Experience Pane manipulation -->


	<!-- Work experience/Job update -->

	<script type="text/javascript">
		$('#edit-job-modal').on('show.bs.modal', function(e) {
			
			var editJobBtn = $(e.relatedTarget);
			var rec_id = editJobBtn.attr('data');

			$.ajax({
				url: '<?= base_url(); ?>User_panel/get_job_info',
				type: 'POST',
				dataType: 'json',
				data: {id: rec_id},
				success: function(response)
				{
					var company = response.data.company;
					var designation = response.data.designation;
					var from_date = response.data.from_date;
					var to_date = response.data.to_date;
					var description = response.data.description;

					$('#job-detail-id').val(rec_id);
					$('#update-company').val(company);
					$('#update-designation').val(designation);
					$('#update-from-date').val(from_date);
					$('#update-to-date').val(to_date);
					$('#update-description').val(description);

				}
			});
			
		});

		$('#update-job').on('click', function() {
			var id = $('#job-detail-id').val();
			var company = $('#update-company').val();
			var designation = $('#update-designation').val();
			var from_date = $('#update-from-date').val();
			var to_date = $('#update-to-date').val();
			var description = $('#update-description').val();

			if(company == "" || designation == "" || from_date == "" || to_date == "" || description == "")
			{
				toastr.error('Error! All fields are required');
				return;
			}

			$.ajax({
				url: '<?= base_url(); ?>User_panel/update_job',
				type: 'POST',
				dataType: 'html',
				data: {id: id, company: company, designation: designation, from_date: from_date, to_date: to_date, description: description},
				success: function(response) {
					if(response == "0")
					{
						toastr.error('Error! Record updation failed');
					}
					else
					{
						job_table.dataTable().api().ajax.reload();
						toastr.success('Success! Record updated');
						$('#edit-job-modal').modal('hide');
					}
				}

			});
			
		});
	</script>

	<!-- Set heading of the pan -->
	<script type="text/javascript">
		 /* At start set the heading to first nav-item */
		$('#detail-box-title').text($('.nav-item:first').find('a').text());
		
		$('.nav-item').on('click', function() {
			$('#detail-box-title').text($(this).find('a').text());
		});

	</script>

	<script type="text/javascript">
		$('.nav-link').on('click', function() {
			$('#detail-box-title').text($.trim($(this).text()));
		});
	</script>

	<script type="text/javascript">
		$('.new-style').each(function() {
		    $(this).wrapAll('<div class="inputFormMain"/>');
		});

		$('.newBtnStyle').each(function() {
			$(this).wrapAll('<div class="submitBtn">');
		});
	</script>


	<script type="text/javascript">
		$('.trainings-table tr').on('click', function() {

			var id = $(this).attr('data');
			$('#training-handler').html('');

			$.ajax({
				url: '<?= base_url(); ?>User_panel/training_detail',
				type: 'POST',
				dataType: 'html',
				data: {training_id: id},
				success: function(response)
				{
					$('#training-handler').append(response);
					$('#training-detail-modal').modal('show');
				}
			});
			
		});

	</script>

	<script type="text/javascript">
		$('.new-trainings-table #detail').on('click', function() {
			var id = $(this).data('id');
			$('#training-handler').html('');

			$.ajax({
				url: '<?= base_url(); ?>User_panel/training_detail',
				type: 'POST',
				dataType: 'html',
				data: {training_id: id},
				success: function(response)
				{
					$('#training-handler').append(response);
					$('#training-detail-modal').modal('show');
				}
			});
		});

		$('.new-trainings-table #reject').on('click', function() {
			var id = $(this).data('id');
			$('#trainingID').val(id);
			$('#training-rejection-modal').modal('show');

		});
	</script>


	<script type="text/javascript">
		$('#print-contract').on('click', function() {
			var user_id = "<?= $id = (isset($contract_detail[0]->user_id)) ? $contract_detail[0]->user_id : ''; ?>";
			window.open("<?= base_url(); ?>Contract/print_contract/"+user_id, "_blank");
		});
	</script>

	<script type="text/javascript">
		$('#elm-xls').on('click', function() {
			window.open("<?= base_url(); ?>User_panel/leaveManagementXLS", "_blank");
		});
	</script>

	<script type="text/javascript">
		$('.overlay').on('mouseenter', function() {
			$(this).css('opacity', '1');
		});

		$('.overlay').on('mouseleave', function() {
			$(this).css('opacity', '0');
		});

		$('#edit-profile-pic').on('click', function() {
			$('#profile-pic').click();

		});

		$('#profile-pic').on('change', function(e){
            var fileName = e.target.files[0];
            $('#profile').attr('src', window.URL.createObjectURL(fileName));


        });

  		// $('#image').on('change', function(e) {
  		// 	var fileName = e.target.files[0].name;
  		// 	console.log(e.target);
  		// });
	</script>

	<script type="text/javascript">
		$('.investigation-table>tbody>tr').on('click', function() {
			var complaint_id = $(this).data('id');
		
			if(complaint_id == undefined)
				return; 

			$('#complaint_id').val(complaint_id);
			$('#complainee-reply-modal').modal('show');
		});
	</script>


	<script type="text/javascript">

		$('#insurance-files').on('change', function(e) {
			e.preventDefault();
			var error = 0;

			var attachments = $('#insurance-files')[0].files;
			$.each(attachments, function(index) {
				var extension = attachments[index].name.split('.').pop();
				if($.inArray(extension, ['txt', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'pdf']) == -1)
					error = 1;
			});

			if(error === 1)
			{
				toastr.error('Invalid file extension.');
				$('#insurance-files').val('');
				return;
			}

			// $('#insurance-form').trigger('submit');
		});
	
	</script>



</body>
</html>