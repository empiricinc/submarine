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

<!-- Previous Investigation Modal -->
<div class="modal fade animated" id="previous-inquires-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%; margin: 3% auto;">
        <div class="modal-content">
        	<div class="modal-header hide-from-print">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<strong class="modal-title">Previous Inquires</strong> 
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
		var employeesHandler = $('#project-employees');

		function employee_designation_tree(employees, designations)
		{
			var designation_list = '';
			var tree = '<ul id="tree1" class="tree" style="visibility: hidden;">';
            $.each(designations, function(index, val) {
                 designation_list += `<option value="${val.designation_id}">${val.designation_name}</option>`;  

                 tree += `<li data-id="${val.designation_id}">
                                        <a href="javascript:void(0);">${ucwords(val.designation_name)}</a>
                                        <ul id="designation-${val.designation_id}">

                                        </ul>
                                       </li>`;
            });

            if(tree != '')
            {
                employeesHandler.html('');
                employeesHandler.append(tree);  
            }

            $.each(employees, function(index, val) {

                $(`#designation-${val.designation_id}`).append(`<li>${ucwords(val.emp_name)}</li>`);
                
    
            });

            return designation_list;
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
					// console.log(response.data.query);
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

		$('.province').on('change', function() {
			var province = $(this).val();
			var project = $('#project option:selected').val();
			var districtHandler = $('#district').html('<option value="">Select District</option>');
			var dsgHandler = $('#designation').html('<option value="">Select Designation</option>');


			$('#tehsil').html('<option value="">Select Tehsil</option>');
			$('#uc').html('<option value="">Select Union Council</option>');

			if(province == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_districts',
				type: 'POST',
				dataType: 'json',
				data: {province_id: province, project_id: project},
				success: function (response) {

					var district = response.data.districts;
					var designation = response.data.designations;
					var employees = response.data.employees;

					var district_list = '';
					var designation_list = '';
					$.each(district, function(index, val) {
						 district_list += `<option value="${val.id}">${val.name}</option>`;
					});

					var designation_list = employee_designation_tree(employees, designation);
					districtHandler.append(district_list);
					dsgHandler.append(designation_list);
					$('.tree').css('visibility', 'visible');
				}

			});

		});


		$('.district').on('change', function() {
			var district = $(this).val();
			var project = $('#project option:selected').val();
			var tehsilHandler = $('#tehsil').html('<option value="">Select Tehsil</option>');
			var dsgHandler = $('#designation').html('<option value="">Select Designation</option>');


			$('#uc').html('<option value="">Select Union Council</option>');

			if(district == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_tehsils',
				type: 'POST',
				dataType: 'json',
				data: {district_id: district, project_id: project},
				success: function (response) {
					var tehsil = response.data.tehsils;
					var designation = response.data.designations;
					var employees = response.data.employees;

					var tehsil_list = '';
					var designation_list = '';
					$.each(tehsil, function(index, val) {
						 tehsil_list += `<option value="${val.id}">${val.name}</option>`;
					});

					var designation_list = employee_designation_tree(employees, designation);
					tehsilHandler.append(tehsil_list);
					dsgHandler.append(designation_list);
					$('.tree').css('visibility', 'visible');
				}

			});

		});


		$('.tehsil').on('change', function() {
			var tehsil = $(this).val();
			var project = $('#project option:selected').val();
			var ucHandler = $('#uc').html('<option value="">Select Union Council</option>');
			var dsgHandler = $('#designation').html('<option value="">Select Designation</option>');


			if(tehsil == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_union_councils',
				type: 'POST',
				dataType: 'json',
				data: {tehsil_id: tehsil, project_id: project},
				success: function (response) {

					var ucs = response.data.ucs;
					var designation = response.data.designations;
					var employees = response.data.employees;

					var ucs_list = '';
					var designation_list = '';
					$.each(ucs, function(index, val) {
						 ucs_list += `<option value="${val.id}">${val.name}</option>`;
					});

					var designation_list = employee_designation_tree(employees, designation);
					ucHandler.append(ucs_list);
					dsgHandler.append(designation_list);
					$('.tree').css('visibility', 'visible');
				}

			});

		});


		$('.uc').on('change', function() {
			var uc = $(this).val();
			var project = $('#project option:selected').val();
			var dsgHandler = $('#designation').html('<option value="">Select Designation</option>');


			if(uc == "")
				return;

			$.ajax({
				url: '<?= base_url(); ?>Investigation/get_uc_designations',
				type: 'POST',
				dataType: 'json',
				data: {uc_id: uc, project_id: project},
				success: function (response) {

					var designation = response.data.designations;
					var employees = response.data.employees;
					var designation_list = '';

					var designation_list = employee_designation_tree(employees, designation);
					dsgHandler.append(designation_list);
					$('.tree').css('visibility', 'visible');
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
						emp_list += `<option value="${el.employee_id}">${ucwords(el.employee_name)}</option>`;
					});

					employeeHandler.append(emp_list);
				}
			});
			
		});
	</script>

	<script>
	
		 $('#complaints-handler').on('click', '#status-btn .label', function() {
	    	var status = $(this).data('status');
	    	$('#complaint-status').val(status);
	    	$('#complaint-search-btn').trigger('click');
	    });

	</script>

	<script type="text/javascript">
		$('#complaints-table>tbody>tr').on('click', function() {
			var id = $(this).attr('data');

			window.location = "<?= base_url(); ?>Complaint/view_detail/" + id;
			return;
			
		});
	</script>


	<script type="text/javascript">
		
		$('#complaints-handler').on('click', ' #legal-tbody tr', function() {
			var id = $(this).attr('data');
			window.location = "<?= base_url(); ?>Complaint/legal_detail/" + id;
			return;
		});
		
	</script>
	

	<!-- Forward a complaint -->
	<script type="text/javascript">
		
		$('#forward-legal').on('click', function() {
			var remarks = $('#remarks').val();
			var complaint_id = $('#complaint_id').val();
			
			if($.trim(remarks) == "")
			{
				toastr.error('Write your remarks');
				return;
			}

			$.ajax({
				url: '<?= base_url(); ?>Complaint/forward',
				type: 'POST',
				dataType: 'html',
				data: {complaint_id: complaint_id, remarks: remarks},
				success: function(response) {
					if(response == '2')
					{
						toastr.error('Complaint already in progress');
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
						toastr.error('Error! There\'s problem on server');
					}
				}
			});
			
		});

	</script>
	<!-- ./ Forward a complaint -->


	<!-- Forward Inquiry to local -->

	<script type="text/javascript">
	
	$('#forward-local').on('click', function(e) {
		e.preventDefault();
		var remarks = $('#remarks').val();
		var complaint_id = $('#complaint_id').val();
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
			toastr.error('Select an employee to forward complaint to.');
			return;
		}

		$('#legal-form').attr('action', '<?= base_url(); ?>Complaint/forward_local').submit();

		// $.ajax({
		// 	url: '<?= base_url(); ?>Complaint/forward_local',
		// 	type: 'POST',
		// 	dataType: 'html',
		// 	data: $('#legal-form').serialize(),
		// 	success: function(response) {
		// 		console.log(response);
		// 		if(response == '2')
		// 		{
		// 			toastr.error('Investigation already in progress');
		// 		}
		// 		else if(response == '1')
		// 		{
		// 			$('#remarks').val('');
		// 			toastr.success('Investigation forwarded successfully.');
		// 		}
		// 		else if(response == '0')
		// 		{
		// 			toastr.error('Error! Investigation coudn\'t be forwarded');
		// 		}
		// 		else 
		// 		{
		// 			toastr.error('Error! There\'s problem on server');
		// 		}

		// 		$('#select-inquirer-modal').modal('hide');
		// 	}
		// });
		
	});

	</script>



	<!-- ./ Forward Inquiry to local -->

	<script type="text/javascript">
		$('#local-table tbody tr').on('click', function() {
			var id = $(this).data('id');
			window.location = "<?= base_url(); ?>Complaint/local_detail/"+id;
		});
	</script>
	

	<script type="text/javascript">

	  $(".collapse").on('show.bs.collapse', function(){
			$('#remarks-btn').html('<i class="fa fa-minus-circle fa-1x"></i>');
	  });

	  $(".collapse").on('hide.bs.collapse', function(){
			$('#remarks-btn').html('<i class="fa fa-plus-circle fa-1x"></i>');
	  });
	</script>

	<script type="text/javascript">
        $.fn.extend({
            treed: function (o) {
              
              var openedClass = 'glyphicon-minus-sign';
              var closedClass = 'glyphicon-plus-sign';
              
              if (typeof o != 'undefined'){
                if (typeof o.openedClass != 'undefined'){
                openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined'){
                closedClass = o.closedClass;
                }
              };
              
                //initialize each of the top levels
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                    branch.addClass('branch');
                    branch.on('click', function (e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });
                //fire event from the dynamically added icon
              tree.find('.branch .indicator').each(function(){
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
              });
                //fire event to open branch if the li contains an anchor instead of text
                tree.find('.branch>a').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                //fire event to open branch if the li contains a button instead of text
                tree.find('.branch>button').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
            }
        });

        //Initialization of treeviews

        $('#tree1').treed();

        $('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

        $('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});

    </script>

	

</body>
</html>