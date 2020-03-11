<section class="secMainWidthFilter">
	<div class="row marg">
		<div class="col-lg-2 no-leftPad">
			<div class="main-leftFilter">
				<div class="tabelHeading">
					<h3>Search Papers <a href="<?php echo base_url('tests/applicants'); ?>" class="fa fa-refresh"></a></h3>
				</div>
				<div class="selectBoxMain">
					<form method="get" action="<?php echo base_url('tests/applicant_search'); ?>">
						<div class="filterSelect">
							<select class="form-control" id="project" name="project">
								<option value="">Project</option>
								<?php foreach($projects as $proj) : ?>
									<option value="<?php echo $proj->name; ?>">
										<?php echo $proj->name; ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<select class="form-control" id="designation" name="designation">
								<option value="">Designation</option>
								<?php foreach ($designations as $desig): ?>
									<option value="<?= $desig->designation_name; ?>">
										<?= $desig->designation_name; ?>
									</option>
								<?php endforeach; ?>
							</select>
							<span></span>
						</div>
						<div class="filterSelect">
							<input type="text" name="rollnumber" class="form-control" placeholder="Search by Roll no.">
						</div>
						<div class="filterSelect">
							<input type="text" name="keyword" class="form-control" placeholder="Search by applicant name">
						</div>
						<div class="filterSelect">
							<input type="date" name="date_from" class="form-control" placeholder="Search by applicant name">
						</div>
						<div class="filterSelect">
							<input type="date" name="date_to" class="form-control" placeholder="Search by applicant name">
						</div>
						<div class="filterSelectBtn">
							<button class="btn btnSubmit">Search</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div class="col-lg-10">
			<?php if($success = $this->session->flashdata('success')): ?>
				<div class="alert alert-success text-center">
					<p><?php echo $success; ?></p>
				</div>
			<?php endif; ?>
			<div class="mainTableWhite">
				<div class="row">
					<div class="col-md-8">
						<div class="tabelHeading">
							<h3>
								subjective papers list
							</h3>
						</div>
					</div>
					<div class="col-md-4">
						<div class="tabelTopBtn">
							<form class="form-inline" action="<?php echo base_url('tests/applicant_search'); ?>" method="get">
								<div class="inputFormMain">
									<div class="input-group">
										<input type="text" name="search_applicant" class="form-control" placeholder="Search applicants..." required="" autocomplete="off">
										<div class="input-group-btn">
											<button type="submit" class="btn btnSubmit">
												<i class="fa fa-search"></i>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="tableMain">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr <?php if(!empty($applicant_detail)): ?> style="display: none;"<?php endif; ?>>
											<th>applicant's name</th>
											<th>job title</th>
											<th>roll no.</th>
											<th>action</th>
										</tr>
									</thead>
									<tbody>
										<?php if(!empty($attempted)):
										foreach($attempted as $attempt): ?>
										<tr>
											<td>
												<?php echo ucwords($attempt->fullname); ?>
											</td>
											<td>
												<p data-toggle='tooltip' title="<?php echo $attempt->job_title; ?>"><?php echo substr($attempt->job_title, 0, 20).' ...'; ?></p>
											</td>
											<td>
												<?php echo $attempt->applicant_id; ?>
											</td>
											<td>
												<a data-toggle="modal" data-target="#resultModal<?php echo $attempt->applicant_id; ?>" href="#" class="btn btn-primary btn-sm">View Answers</a>
												<!-- Modal -->
												<?php $app_answers = $this->Tests_model->subjective_result($attempt->applicant_id); ?>
												<div id="resultModal<?php echo $attempt->applicant_id; ?>" class="modal fade" role="dialog">
												  <div class="modal-dialog">
												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">View Answers and add result</h4>
												      </div>
												      <div class="modal-body">
												      	<?php $que_no = 1; foreach($app_answers as $answer): ?>
												        <p>
												        	<strong>Ans <?php echo $que_no++ .'.'; ?></strong>
												        	<?php echo $answer->answer_text; ?><br>
												        	<input type="text" name="marks_perQ" class="form-control input-sm add_marks" placeholder="Enter marks here...">
												        </p>
												    	<?php endforeach; ?><hr>
												    	<form action="<?php echo base_url('tests/save_subjective_result'); ?>" method="post">
												    		<input type="hidden" name="applicant_id" value="<?php echo $attempt->applicant_id; ?>">
												    		<div class="row">
												    			<div class="col-md-4">
												    				<strong>Cumulative marks</strong>
												    			</div>
												    			<div class="col-md-5">
												    				<input type="number" name="marks" class="form-control input-sm" placeholder="Cumulative marks..." autocomplete="off" required="" id="cumulative_marks" readonly="">
												    			</div>
												    			<div class="col-md-3">
												    				<button type="submit" class="btn btn-primary btn-sm">Save Result</button>
												    			</div>
												    		</div><br>
												    		<div class="row">
												    			<div class="col-md-12 text-center">
												    				<span id="span_warning" style="color:red;"></span>
												    			</div>
												    		</div>
												    	</form>
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
												      </div>
												    </div>
												  </div>
												</div>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="tabelSideListing text-center">
							<span>
								<?php endif; //echo $this->pagination->create_links(); endif; ?>
							</span>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$('.add_marks').keyup(function(){
			var sum = 0;
			$('.add_marks').each(function(){
				sum += Number($(this).val());
			});
			$('#cumulative_marks').val(sum);
		});
	});
	// Put validation for a value should not be greater than 10.
	$('.add_marks').keyup(function(){
	    if(parseInt($(this).val()) > 10){
	        $('#span_warning').html("The value can't be greater than 10. Try entering less than or equal to that instead.");
	        $('.add_marks').val('');
	    }else if(parseInt($(this).val()) < 1){
	    	$('#span_warning').html("The value can't be less than 1. Try entering greater than or equal to that instead.");
	        $(this).val('');
	    }else{
	    	$('#span_warning').html("");
	    }
	});
</script>