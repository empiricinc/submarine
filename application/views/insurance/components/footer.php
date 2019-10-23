<!-- Insurance Modal -->
<div class="modal fade animated" id="insurance-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-header hide-from-print">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<strong class="modal-title">Insurance Claim Form</strong> 
    		</div>
    		<form action="<?= base_url(); ?>Insurance/add_claim" method="POST" id="insurance-form" enctype="multipart/form-data">
	    		<div class="modal-body" id="insurance-handler">
	    			<div class="row">
	    			<input type="hidden" name="employee_id" id="employee-id" value="">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="employee_name" value="" id="employee-name" class="form-control" placeholder="Employee name" data-toggle="tooltip" title="Employee name" readonly>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="project" value="" id="project" class="form-control" placeholder="Project" data-toggle="tooltip" title="Project" readonly>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="department" value="" id="department" class="form-control" placeholder="Department" data-toggle="tooltip" title="Department" readonly>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="designation" value="" id="designation" class="form-control" placeholder="Designation" data-toggle="tooltip" title="Designation" readonly>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="inputFormMain">
							<select name="type" id="type" class="form-control" required="required">
								<option value="">SELECT TYPE</option>
								<option value="accident">Accident</option>
								<option value="death">Death</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="incident_date" value="" id="incident-date" class="form-control date" placeholder="Incident Date" data-toggle="tooltip" title="Incident Date" required>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="reporting_date" value="" id="reporting-date" class="form-control date" placeholder="Reporting Date" data-toggle="tooltip" title="Reporting Date" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<input type="text" name="reported_by" value="" id="reported_by" class="form-control" placeholder="Reported By" data-toggle="tooltip" title="Reported By" required>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="file" name="attachments[]" value="" class="form-control insurance-files" data-toggle="tooltip" title="Insurance Files" multiple required>
								<small class="form-text text-muted">Supported file formats (.txt, .doc, .docx, .pdf)</small>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="subject" value="" id="subject" class="form-control" placeholder="Subject" data-toggle="tooltip" title="Subject" required>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="description" id="description" class="form-control" rows="5" placeholder="Description" required></textarea>
						</div>
					</div>
					</div>
	    		</div>
	    		<div class="modal-footer">
	    			<div class="col-lg-12">
		    			<button type="submit" class="btn btnSubmit" id="insurance-form-btn"> 
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
</div>
<!-- ./Insurance Modal -->

<!-- Insurance Status Change Modal -->
<div class="modal fade" id="status-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Update Insurance Status</h4>
			</div>
			<form action="<?= base_url(); ?>Insurance/update_status" method="POST">
			<input type="hidden" name="employee_id" id="emp-id">
			<input type="hidden" name="status" id="insurance-status">
			<div class="row" style="padding-left: 15px; padding-right: 15px;">
				<div class="modal-body">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btnSubmit" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btnSubmit">Update</button>
			</div>
			</form>
		</div>
	</div>
</div>


<!-- Bulk Update Modal -->
<div class="modal fade" id="bulk-update-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Insurance Status</h4>
			</div>
			<form action="<?= base_url(); ?>Insurance/bulk_update" method="POST">
			<input type="hidden" name="employee_ids" id="employee-ids" value="">
			<div class="row" style="padding-left: 15px; padding-right: 15px;">
				<div class="modal-body">
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="from_date" value="" id="start-date" class="form-control date" placeholder="Insurance Start Date" data-toggle="tooltip" title="Insurance Start Date" required>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="to_date" value="" id="end-date" class="form-control date" placeholder="Insurance End Date" data-toggle="tooltip" title="Insurance End Date" required>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btnSubmit" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btnSubmit">Update</button>
			</div>
			</form>
		</div>
	</div>
</div>


<!-- Insurance Claim Update Modal -->
<div class="modal fade" id="claim-update-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Insurance Claim Status</h4>
			</div>
			<form action="<?= base_url(); ?>Insurance/update_claim" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="claim_id" id="claim-id">
			<input type="hidden" name="status" id="claim-status">

			<div class="row" style="padding-left: 15px; padding-right: 15px;">
				<div class="modal-body">
					<div class="col-lg-12">
						<div class="inputFormMain">
							<textarea name="remarks" class="form-control" rows="5" placeholder="Write Your Remarks..." required="required"></textarea>
						</div>
					</div>
					<div id="decision">
						
					</div>
					<div class="inputFormMain col-lg-12">
						<input type="file" class="form-control insurance-files" name="attachments[]" multiple>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btnSubmit" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btnSubmit status-update-btn" id="claim-update-btn">Update</button>
			</div>
			</form>
		</div>
	</div>
</div>


<!-- Insurance Edit Modal -->

<div class="modal fade" id="edit-insurance-modal">
	<div class="modal-dialog">
		<form action="<?= base_url(); ?>Insurance/update_claim_detail" method="POST">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="claim_id" value="<?= $detail->insurance_claim_id; ?>">
				<div class="row">
					<div class="col-lg-6">
						<div class="inputFormMain">
							<label>Type</label>
							<select name="type" class="form-control" required="required">
								<option value="">SELECT TYPE</option>
								<option value="accident" <?php if($detail->type == 'accident') { ?> selected <?php } ?>>Accident</option>
								<option value="death" <?php if($detail->type == 'death') { ?> selected <?php } ?>>Death</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<div class="form-group">
								<label>Incident Date</label>
								<input type="text" name="incident_date" class="form-control date" value="<?= $detail->incident_date; ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<div class="form-group">
								<label>Reported By</label>
								<input type="text" name="reported_by" class="form-control" value="<?= $detail->reported_by; ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="inputFormMain">
							<div class="form-group">
								<label>Reported Date</label>
								<input type="text" name="reported_date" class="form-control date" value="<?= $detail->reporting_date; ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<div class="form-group">
								<label>Subject</label>
								<input type="text" name="subject" class="form-control" value="<?= $detail->subject; ?>">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<div class="form-group">
								<label>Description</label>
								<textarea name="description" class="form-control no-resize" id="" cols="30" rows="5"><?= $detail->description; ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="submitBtn">
					<button type="button" class="btn btnSubmit" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btnSubmit">Update</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

<!-- Insurance Edit Modal -->


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
		function ucwords($str)
		{
			$str = $str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
			    return letter.toUpperCase();
			});

			return $str;
		}
	</script>


	<script type="text/javascript">
		$('.project').on('change', function() {
			var project = $(this).val();
			var provinceHandler = $('#province').html('<option value="">Select Province</option>');
			var dsgHandler = $('#designation').html('<option value="">Select Designation</option>');

			$('#district').html('<option value="">Select District</option>');
			$('#tehsil').html('<option value="">Select Tehsil</option>');
			$('#uc').html('<option value="">Select Union Council</option>');

			if(project == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_provinces',
				type: 'POST',
				dataType: 'json',
				data: {project_id: project},
				success: function (response) {
					var province = response.data.provinces;
					var designation = response.data.designations;
					var employees = response.data.employees;

					var province_list = '';
					var designation_list = '';

					$.each(province, function(index, val) {
						 province_list += `<option value="${val.id}">${val.name}</option>`;
					});

					var designation_list = employee_designation_tree(employees, designation);
					provinceHandler.append(province_list);
					dsgHandler.append(designation_list);
					// $('#tree1').treed();
					$('.tree').css('visibility', 'visible');

				}

			});

		});


	</script>

	<script type="text/javascript">
		$('.add-claim').on('click', function() {
			var emp_id = $(this).data('id');
			var emp_name = $('#emp-name-'+emp_id).val();
			var designation = $('#emp-designation-'+emp_id).val();
			var insurance_status = $('#status-'+emp_id).val();
			var project = $('#project-'+emp_id).val();
			var department = $('#department-'+emp_id).val();
			
			$('#employee-id').val(emp_id);
			$('#employee-name').val(emp_name);
			$('#designation').val(designation);
			$('#project').val(project);
			$('#department').val(department);

			if(insurance_status == 'insured')
				$('#insurance-modal').modal('show');
			else
				toastr.error('Update Insurance Status');

		});

		$('.update-status').on('click', function() {
			var emp_id = $(this).data('id');
			var insurance_status = $('#status-'+emp_id).val();
			var dataHandler = $('#status-modal .modal-body').html('');
		
			$('#emp-id').val(emp_id);
			$('#insurance-status').val(insurance_status);

			if(insurance_status == 'pending' || insurance_status == 'uninsured')
			{
				dataHandler.append(`
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="from_date" value="" id="start-date" class="form-control date" placeholder="Insurance Start Date" data-toggle="tooltip" title="Insurance Start Date" required>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="inputFormMain">
							<input type="text" name="to_date" value="" id="end-date" class="form-control date" placeholder="Insurance End Date" data-toggle="tooltip" title="Insurance End Date" required>
						</div>
					</div>
				`);	

			}
			else if(insurance_status == 'insured')
			{
				dataHandler.append(`
					<div class="col-lg-12">
						<p>Click on update to mark employee as uninsured.</p>
					</div>
					`);
			}

			$('#status-modal').modal('show');
			$('.date').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat:'yy-mm-dd',
				yearRange: '1900:' + (new Date().getFullYear() + 15),
				beforeShow: function(input) {
					$(input).datepicker("widget").show();
				}

			});
			$('input').attr('autocomplete','off');
			
		});
	</script>

	<script>

		var ids = [];

		$('#mark-all').on('click', function() {
			if($(this).is(':checked'))
			{
				ids = [];
		
				$('.record:enabled').prop('checked', true);

				$('.record:enabled').each(function(index, el) {
					ids.push($(this).data('id'));
				});
			}
			else
			{
				$('.record').prop('checked', false);
				ids = [];
			}
		});

		
		$('.record').on('click', function() {
			if($(this).is(':checked'))
			{
				ids.push($(this).data('id'));
			}
			else
			{	
				var index = ids.indexOf($(this).data('id'));
				if(index != -1)
					ids.splice(index, 1); 
			}

		});


		$('.update-status-btn').on('click', function() {
			$.unique(ids.sort()).sort();
			
			var res = '';
			for(i=0; i<ids.length; i++)
			{
				res += ids[i].toString() + '-';
				
			}
			res = res.replace(/-+$/,'');

			$('#employee-ids').val(res);
			$('#bulk-update-modal').modal('show');
		});

	</script>

	<script type="text/javascript">
		$('.change-status').on('click', function() {
			var claim_id = $(this).data('id');
			var status = $(this).data('status');
			$('#decision').html('');

			$('#claim-id').val(claim_id);
			$('#claim-status').val(status);
			if(status == 'completed')
			{
				toastr.error('Record can\'t be updated');
			}
			else
			{
				if(status == 'pending')
				{
					$('#claim-update-btn').html('Inprogress');
				}
				else if(status == 'inprogress')
				{
					$('#decision').html(`<div class="col-lg-12">
						<div class="inputFormMain">
							<select name="decision" id="input" class="form-control" required="required">
								<option value="">Select Decision</option>
								<option value="1">Accepted</option>
								<option value="0">Rejected</option>
							</select>
						</div>
					</div>`);
					$('#claim-update-btn').html('Completed');
				}

				$('#claim-update-modal').modal('show');
			}
			
		});

	</script>


	<script type="text/javascript">
		$('#status-btn>.label').on('click', function() {
			var status = $(this).data('status');
			$('#status').val(status);
			$('#search-btn').trigger('click');
		});

	</script>

	<script type="text/javascript">
		$('.insurance-files').on('change', function(e) {
			var error = 0;

			var attachments = $(this)[0].files;
			$.each(attachments, function(index) {
				var extension = attachments[index].name.split('.').pop();

				if($.inArray(extension, ['txt', 'doc', 'docx', 'png', 'jpg', 'jpeg']) == -1)
					error = 1;
			});

			if(error === 1)
			{
				toastr.error('Invalid file extension');
				$('.insurance-files').val('');
				return;
			}



		});
	</script>

	<script type="text/javascript">
		$('input[type="checkbox"]').on('click', function() {
			var file_type = $(this).data('id');
			var claim_id = $('#insurance-claim-id').val();
			var status = 0;

			if($(this).is(':checked') == true)
			{
				status = 1;
			}
			else
			{
				status = 0;
			}

			$.ajax({
				url: '<?= base_url(); ?>Insurance/update_checklist',
				type: 'POST',
				dataType: 'html',
				data: {file_type: file_type, claim_id: claim_id, status: status},
				success: function(response) {
					
					if(response == 1)
						toastr.success('Record updated successfully.');
					else
						toastr.error('Record updation failed.');
				}
			});
			
		});
	</script>



</body>
</html>