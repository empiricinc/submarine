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
	
	<footer></footer>

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
		$('.btn-group-sm:last').addClass('dropup');
	</script>


