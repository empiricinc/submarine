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

	<script src='<?= base_url(); ?>assets/tinymce/tinymce.min.js'></script>
	<!-- Script -->
	<script>
	tinymce.init({ 
	  selector:'.editor',
	  theme: 'modern',
	  height: 300
	});
	</script>


    <script>
      $('.navbar-brand').on('click', function(e) {
         e.preventDefault();
         window.location = "<?= base_url(); ?>dashboard";
		});

    </script>

    <script>
		$('input').attr('autocomplete','off');
	</script>

	<script type="text/javascript">
		$('[data-toggle="tooltip"]').tooltip(); 
	</script>

	<script type="text/javascript">
		// $('.btn-group-sm:last').addClass('dropup');

		function reloadDatepicker(elem) {
		    $(elem).datepicker({
				dateFormat: 'yy-mm-dd',
				changeYear: true,
				maxDate: 0
			});
		}

		$('.date').datepicker({
			dateFormat: 'yy-mm-dd',
			changeYear: true
		});

		$('.date-onward').datepicker({
			minDate: 0,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});

		$('.prev-date').datepicker({
			dateFormat: 'yy-mm-dd',
			changeYear: true,
			maxDate: 0
		});

		$('.dob').datepicker({
			dateFormat: 'yy-mm-dd',
			changeYear: true,
			minDate: new Date(1960, 10, 25),
        	maxDate: '-17Y'
		});

		$('.discplinary-reporting-date').datepicker({
			dateFormat: 'yy-mm-dd',
			changeYear: true,
			// minDate: '+2d',
			maxDate: 0
		});

		$('.payroll-month').datepicker({
			changeYear: true,
			maxDate: 0,
			dateFormat:'yy-mm'
		});

		$('.disciplinary-reporting-date').datepicker({
			changeYear: false,
			maxDate: 0,
			minDate: '-2d',
			dateFormat: 'yy-mm-dd'
		});

		$('.field-joining-date').datepicker({
			changeYear: false,
			maxDate: '+7d',
			minDate: '-7d',
			dateFormat: 'yy-mm-dd'
		});

		$('.disciplinary-last-working-date').datepicker({
			changeYear: true,
			dateFormat: 'yy-mm-dd'
		});

	</script>


