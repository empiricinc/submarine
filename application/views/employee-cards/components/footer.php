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
        			<button type="button" class="btn btn-success" id="print-employee-detail"> 
        				Print 
        			</button>
        			<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> 
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
        			<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> 
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
        			<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> 
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
    			<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> 
    				No
    			</button>
    		</div>
    		
        </div>
    </div>
</div>



<!-- ./Employee Detail Modla -->


<footer></footer>

	<script src="<?= base_url(); ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/jquery-ui/jquery-ui.js"></script> 

	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/clockpicker/dist/jquery-clockpicker.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/tether/js/tether.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/bootstrap/js/bootstrap.min.js"></script> 
 	<script type="text/javascript">var site_url = '<?php echo base_url(); ?>';</script> 
	<script type="text/javascript" src="<?php echo base_url().'skin/js_module/employees_detail.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/js/jquery.dataTables.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/js/dataTables.bootstrap4.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/Responsive/js/dataTables.responsive.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/Responsive/js/responsive.bootstrap4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/Buttons/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/Buttons/js/buttons.bootstrap4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/pdfmake/build/pdfmake.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/pdfmake/build/vfs_fonts.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/Buttons/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/Buttons/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/DataTables/Buttons/js/buttons.colVis.min.js"></script> 
	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/select2/dist/js/select2.min.js"></script> 

	<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/toastr/toastr.min.js"></script>
	

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

	$(function() {
    	$('.year').datepicker({
	        changeYear: true,
	        showButtonPanel: true,
	        dateFormat: 'yy',
	        onClose: function(dateText, inst) { 
	            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	            $(this).datepicker('setDate', new Date(year, 1));
	        }
    	});
	 
		 $(".year").focus(function () {
		        $(".ui-datepicker-month").hide();
	    });
	});



	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	});

	</script> 


	<script>
		$('#employee-table tr').on('click', function() {
		
			var id = $(this).attr('data');
			if(id == undefined)
				return;


			window.location = "<?= base_url(); ?>Reports/employee_detail/"+id;
			// $('#employee-handler').html('');

			// $.ajax({
			// 	url: '<?= base_url(); ?>Reports/get_employee_detail',
			// 	type: 'POST',
			// 	dataType: 'html',
			// 	data: {id: id},
			// 	success: function(response)
			// 	{
			// 		$('#employee-handler').append(response);
			// 		$('#employee-detail-modal').modal('show');
			// 	}
			// });
			
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


	<script>
		var ids = [];

		$('#mark-all').on('click', function() {
			if($(this).is(':checked'))
			{
				ids = [];
				$('.employee').prop('checked', true);

				$('.employee').each(function(index, el) {
					ids.push($(this).data('id'));
				});
			}
			else
			{
				$('.employee').prop('checked', false);
				ids = [];
			}
		});

		$('.employee').on('click', function() {

			if($(this).is(':checked'))
			{
				ids.push($(this).data('id'));
			}
			else
			{	
				ids.splice($(this).data('index'), 1); 
			}

		});

		$('.print-cards').on('click', function() {
			$.unique(ids.sort()).sort();
			
			var res = '';
			for(i=0; i<ids.length; i++)
			{
				res += ids[i].toString() + '-';
				
			}
			res = res.replace(/-+$/,'');

			var url = $(this).data('url');
			window.location = url+'/'+res;
		});


		$('.change-status').on('click', function() {
			var status = $(this).data('status');
			if(status == 'pending')
				status = '/'+1;
			else if(status == 'printed')
				status = '/'+2;
			else if(status == 'delivered')
				status = '/'+3;

			$.unique(ids.sort()).sort();
			
			var res = '';
			for(i=0; i<ids.length; i++)
			{
				res += ids[i].toString() + '-';
				
			}
			res = res.replace(/-+$/,'');
			res = '/'+res;

			var url = $(this).data('url');
			console.log(url+res+status); return;
			window.location = url+res+status;

		});
	</script>

</body>
</html>