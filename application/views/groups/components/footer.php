

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