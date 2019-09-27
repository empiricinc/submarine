

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

	$('.dataTable').DataTable();



	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();   
	});

	</script> 

	<script type="text/javascript">
		$('#permissions-table .permission-checkbox input[type="checkbox"]').on('click', function() {
			var page = $(this).closest('tr').data('page');
			var action = $(this).data('action');
			var group = $('#group').val();
			var status = 0;

			if($(this).is(':checked'))
				status = 1;
			else
				status = 0;

			$.ajax({
				url: '<?= base_url(); ?>Permissions/update',
				type: 'POST',
				dataType: 'html',
				data: {page: page, action: action, group: group, status: status},
				success: function(response) {
					if(response == '1')
					{
						toastr.success('Success! Permissions Updated.');
					}
					else if(response == '0')
					{
						toastr.error('Error! Server problem encountered');
					}
				}
			});
			

		});

		$('.mark-all').on('click', function() {
			var action = $(this).data('action');
			var group = $('#group').val();
			var status = 0;

			if($(this).is(':checked'))
			{
				status = 1;
				$('.'+action).prop('checked', true);
			}
			else
			{
				status = 0;
				$('.'+action).prop('checked', false);
			}

			
			$.ajax({
				url: '<?= base_url(); ?>Permissions/update',
				type: 'POST',
				dataType: 'html',
				data: {action: action, group: group, status: status},
				success: function(response) {
					if(response == '1')
					{
						toastr.success('Success! Permissions Updated.');
					}
					else if(response == '0')
					{
						toastr.error('Error! Server problem encountered');
					}
				}
			});

		});


	</script>





</body>
</html>