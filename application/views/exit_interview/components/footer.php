
<?php $this->load->view('html/footer'); ?>

	<script type="text/javascript">

	$(document).ready(function(){


		$(".add-new-form").click(function(){

			$(".add-form").slideToggle('slow');

		});


		$('.date').datepicker({

		changeMonth: true,

		changeYear: true,

		dateFormat:'yy-mm-dd',

		yearRange: '2019:' + (new Date().getFullYear() + 15),
		// yearRange: '-1:+1',

		beforeShow: function(input) {

			$(input).datepicker("widget").show();

		}

		});

	});	
	</script>

	<script type="text/javascript">
		$('#position-leaving-reason').on('change', function() {
			if($(this).val() == '0')
				$('#position-leaving-other-reason').prop('readonly', false);
			else
				$('#position-leaving-other-reason').prop('readonly', true);
		});

		$('#respondent-not-found-reason').on('change', function() {
			if($(this).val() == '0')
				$('#respondent-not-found-other-reason').prop('readonly', false);
			else
				$('#respondent-not-found-other-reason').prop('readonly', true);
		});
	</script>