<?php
/* Filename: questions_list.php
*  Location: Views/test-system/questions_list.php
*  Author: Saddam
*/
?>
<div class="container">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-2">
				<h1>Questions</h1>
			</div>
				<div class="col-md-2">
					<select name="project" id="project" class="form-control">
						<option value=""> Select Project </option>
						<?php foreach($projects as $proj) : ?>
							<option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-3">
					<select name="designation" id="designation" class="form-control">
						<option value=""> Select Designation </option>
						<?php foreach ($designations as $desg) : ?>
							<option value="<?php echo $desg->designation_id; ?>"><?php echo $desg->designation_name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-3">
					<form class="form-inline" action="<?php echo base_url('tests/search') ?>" method="get">
						<input type="text" name="keyword" class="form-control" placeholder="Search for questions..." required="required" id="keyword" onkeyup="searchHere();">
						<input type="submit" name="submit" class="btn btn-success" value="GO !">
					</form>
				</div>
			<div class="col-md-2 text-right">
				<a class="btn btn-info" href="<?=base_url('tests/questions_for_test'); ?>">GO TO PAPER &raquo;</a>
			</div>
		</div>
		<hr>
		<div id="results"><p style="text-align: center; color: green;">You'll be to see questions here according to the designation selected from the dropdown lists above...</p></div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
// Show designation-wise questions in the HTML table.
$(document).ready(function() {
  $("#designation").change(function() {
    var displayResources = $("#results");
    var des_id = $('#designation').val();
    var serial = 1; // Initialize serial number to display before the question.
    displayResources.text("Select an option to view the data you're looking for !");
    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>tests/changeData/" + des_id,
      data: { des_id: des_id },
      dataType: 'JSON',
      success: function(result) {
        console.log(result);
        var output =
          "<table><thead><tr><th>Serial</th><th>Question</th><th>Designation</th></thead><tbody>";
        for (var i = 0; i < result.length; i++) {
          output +=
            "<tr><td>" +
            serial++ + // The serial number will be increased by 1.
            "</td><td>" +
            result[i].question + // the question text is here, I'll make this link as well so that admin can click on it and redirect to the question detail page.

            // Add links with IDs in the Action to perform actions.
            "</td><td><a class='btn btn-info' href='<?=base_url(); ?>tests/view_single/" + result[i].id + "'>View</a> <a class='btn btn-primary' href='<?=base_url(); ?>tests/edit/" + result[i].id + "'>Edit</a> <a class='btn btn-danger' href='<?=base_url(); ?>tests/delete/" + result[i].id + "'>Delete</a> <a class='btn btn-warning' href='<?=base_url(); ?>tests/add_options/" + result[i].id + "'>Add</a>" 
            "</td></tr>";
        }
        output += "</tbody></table>";
        displayResources.html(output);
        $("table").addClass("table");
      }
    });
  });
});

// Select project and get the designations according to the ID stored in the database with project_id.
$(document).ready(function(){
	$('#project').on('change', function(){
		// Get the value of the project.
		var project = $('#project').val();
		// alert(project);
		// AJAX request.
		$.ajax({
			url: '<?php echo base_url(); ?>tests/changeData/' + project,
			method: 'POST',
			dataType: 'JSON',
			data: { project: project },
			success: function(response){
				// Remove options
				console.log(response);
				$('#designation').find('option').not(':first').remove();
				// Add options
				$.each(response, function(index, data){
					$('#designation').append('<option value="'+data['designation_id']+'">' +data['name']+'</option>');
				});
			}
		});
	});
});
</script>