<?php 
/* Filename: all_questions.php
*  Location: views / test-system / all_questions.php
*  Author: Saddam
*/
?>
<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Questions <a href="<?php echo base_url('tests/all_questions'); ?>" class="fa fa-refresh"></a></h3>
				</div>
				<div class="selectBoxMain">
					<!-- <small style="color: #aeafaf;">If you're on the search results page, you won't be able to select and change questions table in the right.</small> -->
					<div class="filterSelect">
						<select class="form-control" id="project">
							<option value="">Project</option>
							<?php foreach($projects as $proj) : ?>
								<option value="<?php echo $proj->company_id; ?>">
									<?php echo $proj->name; ?>
								</option>
							<?php endforeach; ?>
						</select>
						<span></span>
					</div>
					<div class="filterSelect">
						<select class="form-control" id="designation">
							<option value="">Designation</option>
						</select>
						<span></span>
					</div>
					<form method="get" action="<?php echo base_url('tests/search'); ?>">
						<div class="filterSelect">
							<input type="text" name="keyword" class="form-control" placeholder="Search here..." required="">
						</div>
						<div class="filterSelectBtn">
							<button class="btn btnSubmit">Search</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-10">
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>Search Results | <span> perform actions shown against each question &hellip;</span></h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<a href="<?php echo base_url('tests/exam_login'); ?>" class="btn btnSubmit">
							<i class="fa fa-file"></i> | Go to Paper</a>
						</div>
					</div>
				</div><br>
				<div id="results"><p style="text-align: center; color: green;">You'll be able to see questions here according to the designation selected from the dropdown lists in the left &hellip;</p></div>
			</div>
		</div>
	</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
// Select designation from the list and get the questions associated with the designation_id.
$(document).ready(function() { // call the function when the document gets ready.
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
          "<div class='tableMain'><table class='table'><thead><tr><th>Serial</th><th>Question</th><th>Operations / Actions</th></thead><tbody>"; // create table head.
        for (var i = 0; i < result.length; i++) {
          output +=
            "<tr><td>" +
            serial++ + // The serial number will be increased by 1.
            "</td><td><a href='<?=base_url(); ?>tests/view_single/"+result[i].id +"'>" +
            result[i].question + // the question text is here, I'll make this link as well so that admin can click on it and redirect to the question detail page.

            // Add links with IDs in the Action to perform actions.
            "</td><td><a class='btn btn-info' href='<?=base_url(); ?>tests/view_single/" + result[i].id + "'>View</a> <a class='btn btn-primary' href='<?=base_url(); ?>tests/edit/" + result[i].id + "'>Edit</a> <a class='btn btn-danger' href='<?=base_url(); ?>tests/delete/" + result[i].id + "'>Delete</a> <a class='btn btn-warning' href='<?=base_url(); ?>tests/add_options/" + result[i].id + "'>Add</a>" 
            "</td></tr>";
        }
        output += "</tbody></table></div>"; // closing tags of tbody and table.
        displayResources.html(output);
        $("table").addClass("table"); // added a class and named it table.
      }
    });
  });
});

// select project from the list and get the designations associated with the project_id.
$(document).ready(function(){
	$('#project').on('change', function(){
		// Get the value of the project.
		var project = $('#project').val(); // Get the project's list value i.e project_id.
		// AJAX request.
		$.ajax({ 
			// send the project_id in the url with the request.
			url: '<?php echo base_url(); ?>tests/changeDesignation/' + project,
			method: 'POST', // method of the request.
			dataType: 'JSON', // type of the data to be retrieved.
			data: { project: project },
			success: function(response){ // function to get the response of.
				// Remove options
				console.log(response); // Log the response to the console.
				$('#designation').find('option').not(':first').remove();
				// Add options
				$.each(response, function(index, data){ // Get the data retrieved in a loop.
					//var designation = data['designation_name'];
					$('#designation').append('<option value="'+data['desig_id']+'">' +data['designation_name']+'</option>'); // append the retrieved data in target list.
				});
			}
		});
	});
});
</script>