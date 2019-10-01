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


	<script>
		$('.resignation-table tr').on('click', function() {

			var id = $(this).attr('data');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Resignations/detail/" + id;
			return;
			
		});
	</script>

	<script type="text/javascript">
		$('.resignation-detail').on('click', function() {
			var id = $(this).data('id');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Resignations/detail/" + id;
			return;
		});
	</script>

	<script type="text/javascript">
		$('.resignation-accept').on('click', function() {
			var id = $(this).data('id');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Resignations/accept_resignation/" + id;
			return;
		});
	</script>

	<script type="text/javascript">
		$('.resignation-reject').on('click', function() {
			var id = $(this).data('id');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Resignations/reject_resignation/" + id;
			return;
		});
	</script>



</body>
</html>