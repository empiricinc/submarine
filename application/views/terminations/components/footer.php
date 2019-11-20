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
        			<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
        				Close 
        			</button>
        		</div>
	    		
	        </div>
	    </div>
	</div>
<!-- .//Termination Detail Modal -->


<?php $this->load->view('html/footer'); ?>
	

	<script>
		$('.view-detail, .termination-table tr').on('click', function() {

			var id = $(this).data('id');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Terminations/detail/" + id;
			return;

		});

	</script>

	<script type="text/javascript">
		$('.terminate').on('click', function() {
			var id = $(this).data('id');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Terminations/confirm/" + id;
			return;
		});
	</script>





</body>
</html>