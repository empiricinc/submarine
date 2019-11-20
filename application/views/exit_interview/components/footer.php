
<?php $this->load->view('html/footer'); ?>


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