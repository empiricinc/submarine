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
		var $departments = $('#departments');
		$departments.on('show.bs.collapse','.collapse', function() {
		    $departments.find('.collapse.in').collapse('hide');
		});

		<?php if($this->session->flashdata('department')): ?>
			var dpt_id = <?= $this->session->flashdata('department'); ?>;
			$departments.find('.collapse').collapse('hide');
			$departments.find('#dpt-'+dpt_id).collapse('show');
		<?php endif; ?>
	</script>




</body>
</html>