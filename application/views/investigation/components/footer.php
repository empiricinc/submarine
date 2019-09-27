<!-- Select Inquirer Modal -->
<div class="modal fade animated" id="select-inquirer-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        	<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<strong class="modal-title">Select Investigator</strong> 
    		</div>
    		<div class="modal-body" id="inquirer-handler">
    			<div class="row">
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
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-primary" id="forward-local"> 
    				Forward Inquiry
    			</button>
    		</div>
    		
        </div>
    </div>
</div>
<!-- ./Select Inquirer Modal -->

<!-- Employee Investigation Modal -->
<!-- <div class="modal fade animated" id="investigation-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header hide-from-print">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<strong class="modal-title">Create Investigation</strong> 
    		</div>
    		<div class="modal-body" id="investigation-handler">
    			
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> 
    				Close 
    			</button>
    		</div>
    		
        </div>
    </div>
</div> -->
<!-- ./Employee Investigation Modal -->


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


	<script type="text/javascript">
		$('.province').on('change', function() {
			var province = $(this).val();
			var districtHandler = $('#district').html('<option value="">Select District</option>');
			if(province == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_districts',
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
			var tehsilHandler = $('#tehsil').html('<option value="">Select Tehsil</option>');
			if(district == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_tehsils',
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

			if(tehsil == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_union_councils',
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

		$('#designation').on('change', function() {
			
			var designation = $(this).val();
			var employeeHandler = $('#employee').html('<option value="">Select Employee</option>');

			if(designation == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_employees',
				type: 'POST',
				dataType: 'json',
				data: {designation_id: designation},
				success: function(response) {
					var obj = response.data;
					var emp_list = '';
					$.each(obj, function(index, el) {
						emp_list += `<option value="${el.employee_id}">${el.employee_name}</option>`;
					});

					employeeHandler.append(emp_list);
				}
			});
			
		});
	</script>

	<script>
	   $('#complaints-handler').on('click', '#status-btn .label', function() {
	    	var status = $(this).data('status');
	    	var type = "<?= $this->uri->segment(2); ?>";

	    	$('#complaints-handler').html('');
	    	
	    	$.ajax({
	    		url: '<?= base_url(); ?>Investigation/get_complaints_table',
	    		type: 'GET',
	    		dataType: 'html',
	    		data: {status: status, type: type},
	    		success: function(response) {
	    			$('#complaints-handler').append(response);
	    		}
	    	});
	    	
	    });

	</script>

	<script type="text/javascript">
		$('#complaints-handler').on('click', '#complaints-tbody tr', function() {
			var id = $(this).attr('data');
			
			if($('#complaints-handler').hasClass('print'))
			{
				window.location = "<?= base_url(); ?>Investigation/complaint_detail/" + id;
				return;
			}
			else
			{
				window.location = "<?= base_url(); ?>Investigation/view_detail/" + id;
				return;
			}
			
		});
	</script>

	<script type="text/javascript">
		$('#complaints-tbody-internal tr').on('click', function() {
			var id = $(this).attr('data');

			window.location = "<?= base_url(); ?>Investigation/view_detail_internal/" + id;
			return;
			
		});
	</script>

	<script type="text/javascript">
		
		$('#complaints-handler').on('click', ' #legal-tbody tr', function() {
			var id = $(this).attr('data');
			window.location = "<?= base_url(); ?>Investigation/legal_detail/" + id;
			return;
		});
		
	</script>
	
	<script type="text/javascript">
		
		$('#legal-tbody-internal tr').on('click', function() {
			var id = $(this).attr('data');
			console.log(id);
			window.location = "<?= base_url(); ?>Investigation/legal_detail_internal/" + id;
			return;
		});
		
	</script>

	<!-- Forward a complaint -->
	<script type="text/javascript">
		
		$('#forward-legal').on('click', function() {
			var remarks = $('#remarks').val();
			var complaint_id = $('#complaint_id').val();
			var complaint_type = $('#complaint_type').val();
			
			if($.trim(remarks) == "")
			{
				toastr.error('Write your remarks');
				return;
			}

			$.ajax({
				url: '<?= base_url(); ?>Investigation/forward',
				type: 'POST',
				dataType: 'html',
				data: {complaint_id: complaint_id, type: complaint_type, remarks: remarks},
				success: function(response) {
					if(response == '2')
					{
						toastr.error('Investigation already in progress');
					}
					else if(response == '1')
					{
						$('#remarks').val('');
						toastr.success('Complaint forwarded successfully.');
					}
					else if(response == '0')
					{
						toastr.error('Error! Complaint coudn\'t be forwarded');
					}
					else 
					{
						console.log(response);
						toastr.error('Error! There\'s problem on server');
					}
				}
			});
			
		});

	</script>
	<!-- ./ Forward a complaint -->



	<!-- Forward Inquiry to local -->

	<script type="text/javascript">
	
	$('#forward-local').on('click', function() {
		var remarks = $('#remarks').val();
		var complaint_id = $('#complaint_id').val();
		var complaint_type = $('#complaint_type').val();
		var employee_id = $('#employee').val();

		/* Set Employee ID in form */
		$('#employee_id').val(employee_id);
		
		if($.trim(remarks) == "")
		{
			toastr.error('Write your remarks');
			return;
		}

		if(employee_id == "")
		{
			toastr.error('Select employee whome you wan\'t');
			return;
		}

		// $('#legal-form-'+complaint_type).attr('action', '<?= base_url(); ?>Investigation/forward_local').submit
		// document.getElementById('legal-form-'+complaint_type).submit();

		// console.log('#legal-form-'+complaint_type);

		$.ajax({
			url: '<?= base_url(); ?>Investigation/forward_local',
			type: 'POST',
			dataType: 'html',
			data: $('#legal-form-'+complaint_type).serialize(),
			success: function(response) {
				console.log(response);
				if(response == '2')
				{
					toastr.error('Investigation already in progress');
				}
				else if(response == '1')
				{
					$('#remarks').val('');
					toastr.success('Investigation forwarded successfully.');
				}
				else if(response == '0')
				{
					toastr.error('Error! Investigation coudn\'t be forwarded');
				}
				else 
				{
					toastr.error('Error! There\'s problem on server');
				}

				$('#select-inquirer-modal').modal('hide');
			}
		});
		
	});

	</script>



	<script type="text/javascript">
		$('#investigation-table tr').on('click', function() {
			// $('#investigation-modal').modal('show');
			var employee_id = $(this).attr('data');
			if(employee_id == undefined)
				return;
			// console.log(employee_id);
			window.location = "<?= base_url(); ?>Investigation/create/"+employee_id;
		});
	</script>



	<!-- ./ Forward Inquiry to local -->

	<script type="text/javascript">
		$('#local-table tbody tr').on('click', function() {
			var id = $(this).data('id');
			window.location = "<?= base_url(); ?>Investigation/local_view/"+id;
		});
	</script>

	<script type="text/javascript">
		$('#local-table-internal tbody tr').on('click', function() {
			var id = $(this).data('id');
			window.location = "<?= base_url(); ?>Investigation/local_detail_internal/"+id;
		});
	</script>

	<script type="text/javascript">
		$('#print-view tr').on('click', function() {
			var id = $(this).data('id');
			window.location = "<?= base_url(); ?>Investigation/print_detail/"+id;
		});
	</script>




</body>
</html>