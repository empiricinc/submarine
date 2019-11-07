<!-- Status update Modal -->
<div class="modal fade animated" id="status-update-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    	<form action="<?= base_url(); ?>Resignations/update_status" method="POST">
        <div class="modal-content">
        	<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">&times;</span> 
    			</button>

    			<strong class="modal-title">Status Update</strong> 
    		</div>
    		<div class="modal-body">
    			<div class="inputFormMain">
    				<input type="hidden" name="resignation_id" value="<?= $detail->resignation_id; ?>">
    				<input type="hidden" name="status_text" class="status-text" value="">
    				<input type="text" name="added_date" class="form-control date" placeholder="Date" required>
    			</div>
    			<div class="inputFormMain">
    				<textarea name="description" class="form-control" placeholder="Description" rows="5" required></textarea>
    			</div>
    		</div>
    		<div class="modal-footer">
    			<div class="submitBtn">
    				<button type="submit" name="submit" class="btn btnSubmit">Update</button>
    				<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
    				Close 
    				</button>
    			</div>
    		</div>
        </div>
        </form>
    </div>
</div>
<!-- ./Status update Modal -->

<!-- Resignation Reversion Modal -->

<div class="modal fade animated" id="resignation-reversion-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
    	<form action="<?= base_url(); ?>Resignations/reversion" method="POST">
        <div class="modal-content">
        	<div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
    				<span aria-hidden="true">×</span> 
    			</button>

    			<strong class="modal-title">Resignation Reversion</strong> 
    		</div>
    		<div class="modal-body">
    			<div class="row">
    			<div class="col-lg-6">
    				<div class="inputFormMain">
	    				<input type="hidden" name="resignation_id" value="<?= $detail->resignation_id; ?>">
	    				<input type="hidden" name="employee_id" value="<?= $detail->employee_id; ?>">
	    				<input type="hidden" name="status_text" class="status-text" value="">
	    				<input type="text" name="added_date" class="form-control date" placeholder="Added date" required>
	    			</div>
    			</div>
    			
    			<div class="col-lg-6">
    				<div class="inputFormMain">
	    				<select name="reason" class="form-control" required>
							<option value="">Reversion Reason</option>
							<?php foreach($reasons AS $r): ?>
							<option value="<?= $r->id; ?>"><?= $r->reason_text; ?></option>
							<?php endforeach; ?>
	    				</select>
	    			</div>
    			</div>
    			
    			<div class="col-lg-6">
    				<div class="inputFormMain">
	    				<input type="text" name="request_date" class="form-control date" placeholder="Reversion request date">
	    			</div>
    			</div>
    			
    			<div class="col-lg-6">
    				<div class="inputFormMain">
	    				<input type="text" name="approval_date" class="form-control date" placeholder="Approval date">
	    			</div>
    			</div>
    			
    			<div class="col-lg-12">
    				<div class="inputFormMain">
	    				<textarea name="description" class="form-control" placeholder="Description" rows="5" required></textarea>
	    			</div>
    			</div>
    			
    			</div>
    		</div>
    		<div class="modal-footer">
    			<div class="submitBtn">
    				<button type="submit" name="submit" class="btn btnSubmit">Update</button>
    				<button type="button" class="btn btnSubmit" data-dismiss="modal" aria-label="Close"> 
    				Close 
    				</button>
    			</div>
    		</div>
        </div>
        </form>
    </div>
</div>

<!-- ./Resignation Reversion Modal -->


<!-- Edit Resignations Modal -->

<div class="modal fade animated" id="edit-resignation-modal">
	<div class="modal-dialog">
		<form action="<?= base_url(); ?>Resignations/update" method="POST">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="inputFormMain">
					
				</div>
			</div>
			<div class="modal-footer">
				<div class="submitBtn">
					<button type="submit" name="submit" class="btn btnSubmit">Update</button>
					<button type="button" class="btn btnSubmit" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
<!-- ./ Edit Resignations Modal -->



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

		$('#resignations-request tr').on('click', function() {
			var id = $(this).data('id');
			if(id == undefined)
				return;

			window.location = "<?= base_url(); ?>Resignations/detail/" + id;
		});
	</script>

	<script type="text/javascript">
		$('.resignation-status-btn').on('click', function() {
			var status_text = $(this).data('text');
			$('.status-text').val(status_text);
			$('#status-update-modal').modal('show');

			$('.date').datepicker({dateFormat: 'yy-mm-dd'});
			$('input').attr('autocomplete','off');
		});
	</script>

	<script type="text/javascript">
		$('.reversion-btn').on('click', function() {
			var status_text = $(this).data('text');
			$('.status-text').val(status_text);
			$('#resignation-reversion-modal').modal('show');

		})
	</script>

	<script type="text/javascript">
		$('#load-template').on('click', function() {
			var resignation_id = $('#resignation-id').val();
			$.ajax({
				url: '<?= base_url(); ?>Resignations/acceptance_letter',
				type: 'POST',
				dataType: 'json',
				data: {resignation_id: resignation_id},
				success: function(response) {
					if(response.data == '')
						toastr.error('No template found.');
					else
						tinymce.get('acceptance-letter').setContent(response.data);
				}

			});
			
		});


		$('#save-letter').on('click', function() {
			var id = $('#resignation-id').val();
			var letter_text = tinymce.get('acceptance-letter').getContent();

			if(letter_text == '')
			{
				toastr.error('Acceptance letter can\'t be empty.');
				return;
			}
			else
			{
				$.ajax({
					url: '<?= base_url(); ?>Resignations/update',
					type: 'POST',
					dataType: 'html',
					data: {id: id, acceptance_letter: letter_text},
					success: function(response) {
						if(response == '1')
							toastr.success('Acceptance letter saved successfully.');
						else
							toastr.error('Server problem occured.');
					}
				});				
			}
		});

		
		$('#print-letter').on('click', function() {
			var letter_text = tinymce.get('acceptance-letter').getContent();
			if(letter_text == '')
			{
				toastr.error('Acceptance letter can\'t be empty.');
				return;
			}
			else
			{
				var print_window = window.open('_blank', 'PRINT');
				print_window.document.write(letter_text);
				print_window.document.close();

				print_window.focus();
				print_window.print();
				print_window.close();

			}
		});
	</script>



</body>
</html>