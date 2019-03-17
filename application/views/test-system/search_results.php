<?php 
/* Filename: search_results.php
*  Author: Saddam
*  Location: Views/test-system/search_results.php
*/
?>
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<h1>Search Results</h1><hr>
			Search results for: <span style="background-color: yellow; font-family: lucida calligraphy; font-weight: bold; color: red; "><?php echo $_GET['keyword']; ?></span><hr>
			<p class="text-justify">Here you can see the results for the query you're looking for, you can edit, delete, view and add options for the question as well !</p>
		</div>
		<div class="col-md-9">
			<h1>Table to Display the Search Results|<a href="<?php echo base_url('tests/all_questions'); ?>" class="btn btn-info btn-lg">Back</a></h1><hr>
			<table class="table table-hover">
				<thead>
					<th>Serial</th>
					<th>Question</th>
					<th>Action</th>
				</thead>
				<?php $serial = 1; foreach($results as $res) : ?>
				<tbody>
					<td><?php echo $serial++; ?></td>
					<td><?php echo $res->question; ?></td>
					<td><a href="<?php echo base_url() ?>tests/view_single/<?php echo $res->id; ?>" class="btn btn-info">View</a>
						<a href="<?php echo base_url() ?>tests/edit/<?php echo $res->id; ?>" class="btn btn-primary">Edit</a>
						<a href="<?php echo base_url() ?>tests/delete/<?php echo $res->id; ?>" class="btn btn-danger" onclick="javascript: return confirm('Are you sure to delete this question?');">Delete</a>
						<a href="<?php echo base_url() ?>tests/add_options/<?php echo $res->id; ?>" class="btn btn-warning">Add</a>
					</td>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>