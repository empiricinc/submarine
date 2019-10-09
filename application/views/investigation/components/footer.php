<div class="modal fade" id="investigation-status-modal">
	<div class="modal-dialog">
		<form action="<?= base_url(); ?>Investigation/update_investigation_status" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Status Modal</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" name="status" id="inv-status" value="">
					<input type="hidden" name="investigation_id" id="inv-id" value="<?= $detail->id; ?>">

					<div class="row">
						<?php if($detail->status == 'completed'): ?>
						<div class="col-lg-12">
							<div class="inputFormMain">
								<label>Severity</label>
								<select name="severity" id="severity" class="form-control" required="required">
									<option value="">SELECT CASE SEVERITY</option>
									<option value="low">Low</option>
									<option value="moderate">Moderate</option>
									<option value="high">High</option>
								</select>
							</div>
						</div>
						<?php endif; ?>

						<div class="col-lg-12">
							<div class="inputFormMain">
								<label>Date</label>
								<input type="text" name="added_date" class="form-control date">
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


<!-- Previous Investigation Modal -->
<div class="modal fade" id="previous-inquires-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%; margin: 3% auto;">
        <div class="modal-content">
        	<div class="modal-header hide-from-print">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<strong class="modal-title">Previous Inquiries</strong> 
    		</div>
    		<div class="modal-body" id="inquires-handler">
    			
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
    				Close 
    			</button>
    		</div>
    		
        </div>
    </div>
</div>
<!-- ./Previous Investigation Modal -->

<div class="modal fade" id="confirm-delete-modal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body">
    			<input type="hidden" id="record-id" value="">
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


<?php if(isset($detail)): ?>
<div class="modal fade" id="edit-investigation-modal">
	<div class="modal-dialog modal-lg">
		<form action="<?= base_url(); ?>Investigation/update_investigation" method="POST">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>

				<h3 class="modal-title">Edit</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<label>Subject</label>
						<div class="inputFormMain">
							<input type="hidden" name="investigation_id" value="<?= $detail->id; ?>">
							<input type="text" name="subject" class="form-control" value="<?= $detail->title; ?>">
						</div>
					</div>
					<div class="col-lg-12">
						<label>Description</label>
						<div class="inputFormMain">
							<textarea name="description" class="form-control" rows="5"><?= $detail->description; ?></textarea>
						</div>
					</div>
					<div class="col-lg-4">
						<label>Reason</label>
						<div class="inputFormMain">
							<select name="reason" id="reason" class="form-control reason" required="required">
								<option value="">SELECT REASON</option>
								<?php foreach($reason AS $r): ?>
									<?php if($r->parent_id == '0') { ?>
										<optgroup label="<?= $r->reason_text; ?>">
									<?php } else { ?>
											<option value="<?= $r->id; ?>"
												<?php if($r->id == $detail->reason_id) { ?> selected <?php } ?>
												><?= $r->reason_text; ?></option>
									<?php } ?>
									<?php endforeach; ?>
								<option value="other" 
									<?php if($detail->reason_id == 0) { ?> selected <?php } ?>
								>Other</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<label>Other Reason</label>
						<div class="inputFormMain">
							<input type="text" name="other_reason" id="other-reason" class="form-control other-reason" value="<?= $detail->other_reason; ?>"
							<?php if($detail->reason_id != 0) { ?> disabled <?php } ?>
							>
						</div>
					</div>
					<div class="col-lg-4">
						<label>Evidence</label>
						<div class="inputFormMain">
							<select name="evidence" id="evidence" class="form-control evidence" required="required">
								<option value="1"
									<?php if($detail->evidence == 1) { ?> selected <?php } ?>
								>Yes</option>
								<option value="0"
									<?php if($detail->evidence == 0) { ?> selected <?php } ?>
								>No</option>
							</select>
						</div>
					</div>
					<div class="col-lg-4">
						<label>Evidence Date</label>
						<div class="inputFormMain">
							<input type="text" name="evidence_date" class="form-control evidence-date" value="<?= $detail->evidence_date; ?>"
								<?php if($detail->evidence == 0) { ?> disabled <?php } ?>
							>
						</div>
					</div>
					<div class="col-lg-4">
						<label>Reported By</label>
						<div class="inputFormMain">
							<input type="text" name="reported_by" class="form-control" value="<?= $detail->reported_by; ?>">
						</div>
					</div>
					<div class="col-lg-4">
						<label>Reported Date</label>
						<div class="inputFormMain">
							<input type="text" name="reported_date" class="form-control date" value="<?= $detail->reported_date; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btnSubmit"> 
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
		$('#employees-table tr').on('click', function() {
			var employee_id = $(this).data('id');
			if(employee_id == undefined)
				return;

			window.location = "<?= base_url(); ?>Investigation/create/" + employee_id;
			
		});
	</script>

	<script type="text/javascript">
		$('#previous-inquiry-btn').on('click', function() {
			var id = $(this).data('id');
			// no_of_records = 0;
			var inquiryHandler = $('#inquires-handler').html('');

			$.ajax({
				url: '<?= base_url(); ?>Investigation/previous_inquiries',
				type: 'POST',
				dataType: 'json',
				data: {employee_id: id},
				success: function(response) {
					var obj = response.data;

					var table = `<table class="table table-hover" id="previous-investigations-table">
									<thead>
										<tr>
											<th>Case No</th>
											<th>Title</th>
											<th>Reason</th>
											<th>Evidence</th>
											<th>Reported Date</th>
											<th>Intensity</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>`;

					$.each(obj, function(index, val) {

						var reason = (val.reason_text == '') ? val.other_reason : val.reason_text;
						var evidence = (val.evidence == '1') ? 'Yes' : 'No';
						var label = '';
						if(val.status == "initiated") 
							label = "label label-warning";
						else if(val.status == "submitted")
							label = "label label-primary";
						else if(val.status == "completed")
							label = "label label-success";
						else if(val.status == "in-progress")
							label = "label label-info";
						else if(val.status == "cancelled")
							label = "label label-danger";

						table += `<tr data-id="${val.id}">
									<td>${val.case_no}</td>
									<td>${val.title}</td>
									<td>${reason}</td>
									<td>${evidence}</td>
									<td>${val.reported_date}</td>
									<td>${val.intensity}</td>
									<td><label class="${label}">${val.status}</label></td>
								</tr>`;
					});
										
						table += `</tbody>
							</table>`;

					inquiryHandler.append(table);

					if(obj.length > 0)
						$('#previous-inquires-modal').modal('show');
					else
						toastr.error('No Previous Records Found');

				}

			});

		});

		$('#inquires-handler').on('click', '#previous-investigations-table>tbody>tr', function() {
			var id = $(this).data('id');
			window.open('<?= base_url(); ?>Investigation/detail/'+id, '_blank');
		});
	</script>

	<script type="text/javascript">
		$('.reason').on('change', function() {
			var reason = $(this).val();
			console.log(reason);
			if(reason == 'other')
				$('.other-reason').prop('disabled', false);
			else
				$('.other-reason').prop('disabled', true);
		});
	</script>

	<script type="text/javascript">
		$('.evidence').on('change', function() {
			if($('.evidence').val() == '1')
			{
				$('.evidence-date').prop('disabled', false);
			}
			else
			{
				$('.evidence-date').prop('disabled', true);
				$('.evidence-date').val('');
			}
		});
	</script>

	<script type="text/javascript">
		 $('#inv-status-btn .label').on('click', function() {
	    	var status = $(this).data('status');
	    	$('#investigation-status').val(status);
	    	$('#investigation-search-btn').trigger('click');
	    });
	</script>

	<script type="text/javascript">
		$('#investigations-table tr').on('click', function() {
			var id = $(this).data('id');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Investigation/detail/" + id;
			
		});
	</script>

	<script type="text/javascript">
		$('.inv-checklist').on('click', function() {
			var id = $('#investigation-id').val();
			var status = 0;
			var attribute = $(this).attr('name');

			if($(this).is(':checked'))
				status = 1;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/update_checkboxes',
				type: 'POST',
				dataType: 'html',
				data: {id: id, attribute: attribute, status: status},
				success: function(response) {

					if(response == '1')
						toastr.success('Success! Status Updated');
					else
						toastr.error('Error! Problem on server');
				}
			});
			
			
		});
	</script>

	<script type="text/javascript">
		$('.status-modal-btn').on('click', function(e) {
			var status = $(this).data('status');
			console.log(status);
			$('#inv-status').val(status);
			$('#investigation-status-modal').modal('show');
		});
	</script>


</body>
</html>