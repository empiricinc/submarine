<section class="secMainWidth">
<section class="secFormLayout">
	<div class="mainInputBg">

		<div class="row">
			<div class="col-lg-12">
				<div class="tabelHeading">
					<h3><?= $title; ?></h3><small>(Click on table row for detail)</small>
				</div>
			</div>
			<div class="col-lg-12">
				<!-- List of Policies -->	
				<table class="table table-hover table-bordered dataTable trainings-table">
					<thead>
						<th>#</th>
						<th>Training type</th>
						<!-- <th>Trainers</th> -->
						<th>City</th>
						<th>Venue</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Status</th>
					</thead>
			        <tbody>
			        	<?php $count = 1; ?>
			        	<?php foreach($trainings AS $t): ?>
			        	
						<tr data="<?= $t->training_id; ?>" style="cursor: pointer;">
							<td><?= $count; ?></td>
							<td><?= $t->training_type; ?></td>
							<!-- <td><?= $t->trainer1 . ', ' . $t->trainer2; ?></td> -->
							<td><?= $t->training_city; ?></td>
							<td><?= $t->training_location; ?></td>
							<td><?= date('d-m-Y', strtotime($t->start_date)); ?></td>
							<td><?= date('d-m-Y', strtotime($t->end_date)); ?></td>
							<td><?php
								$startDate = date(strtotime($t->start_date));
								$endDate = date(strtotime($t->end_date));
								$currentDate = strtotime(date('d-m-Y'));

								if($endDate < $currentDate) { 
									echo '<span class="label label-danger">complete</span>'; 
								}
								
								elseif(($startDate <= $currentDate) && ($endDate >= $currentDate)) { 
									echo '<span class="label label-primary">ongoing</span>'; 
								} 

								elseif($startDate > $currentDate) { 
									echo '<span class="label label-success">upcoming</span>'; 
								}
								?>
								
							</td>
						</tr>
						<?php $count++; endforeach; ?>
			        </tbody>
			    </table>
				<!-- ./End List of Policies -->
			</div>
		</div>
			
	</div>
</section>
</section>
