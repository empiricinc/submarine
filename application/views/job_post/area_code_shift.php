<?php
//echo 'ddddddddddddddd';
/* Job List/Post view

*/

?>

<?php $session = $this->session->userdata('username');?>
<?php 

$message = $this->session->flashdata('message');

if ($message) {
                  echo $message = '<div class="alert alert-success text-center"><strong>Success!</strong>'.$message.'</div>';
}

?>

<div class="box box-block bg-white">

  <!-- <h2><strong><?php echo $this->lang->line('xin_list_all');?></strong> <?php echo $this->lang->line('xin_jobs');?>

    <div class="add-record-btn">

      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> <?php echo $this->lang->line('xin_add_new');?></button>

    </div>

  </h2> -->
<?php 

// $jobdetails = $this->Job_longlisted_model->getJobPosted();

   // $this->load->model("Designation_model");

   // $this->load->model("Job_post_model");

   //$this->Job_post_model->all_job_types();

if($_POST){ ($this->input->post('job_code')) ? $location_job_position = $this->Location_model->all_location_job_positionCondiall($_POST['job_code']) : '';
    }else{
      //if($data['sl2']['accessLevel2']){
      if(isset($sl2['accessLevel2'])  &&  !empty($sl2['accessLevel2'])){  
                $location_job_position = $this->Location_model->all_location_job_position();
         }else{ 
                  $location_job_position = $this->Location_model->all_location_job_positionn($projid,$provid);
                }            
    }
    

?>


<?php if($sl2['accessLevel2']) { 
        // if($session['department_id']==3 || $session['department_id']==6){ 
 ?>

<div class="box box-block bg-white">
<br>
<div class="col-md-12">
<div class="row">
<form action="<?php echo base_url(); ?>area_code_shift" method="post" name="area_code_shift">
  <!-- <div class="col-sm-3">
      <div class="form-group">
        <label for="company_name"><?php echo $this->lang->line('module_company_title');?></label>
        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Select Project" required="required">
          <option value="">Select Project</option>
          <?php foreach($all_companies as $company) {?>
          <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>
          <?php } ?>
        </select>
      </div>
  </div>
  <div class="col-md-3">
            <div class="form-group">
                <label for="date_of_closing" class="control-label">Province</label>
                <select title="Select province" name="province_id" class="form-control" required="required">   <option value="all">All Provinces</option>
                    <?php
                    foreach ($geProvinces as $key => $element) {
                        echo '<option value="'.$element['province_id'].'">'.$element['province_name'].'</option>';
                    }
                    ?>
                </select>
            </div>
  </div>  -->

  <div class="col-md-4">
      <div class="form-group">
          <label for="job_title">Job Code</label>
          <input class="form-control" placeholder="Job Code" name="job_code" type="text" value="" required="required">
      </div>
  </div>

  <div class="col-md-3">

    <div class="form-group" style="margin-top: 8%;">

      <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_search');?></button>

    </div>

  </div>              
</form>
</div>
</div>  
<br><br><br><br>                                     
</div>

<?php }/*elseif($sl3['accessLevel3']) { echo "ye manager ha-----------------------------------"; }*/  ?>
 
<div class="box box-block bg-white">
<!-- <ul class="nav nav-tabs">
      <li class="">
        <a  href="<?php echo base_url(); ?>job_post" >All Posted Jobs</a>
      </li> 
      <li class="active">
        <a href="<?php echo base_url(); ?>vacant_position" >Vacant Position</a>
      </li>
       
</ul> -->

<script type="text/javascript">
  $(document).ready(function() {
    $('#job_avail_position').DataTable();
} );

   
</script>

<div class="table-responsive">
    <table id="job_avail_position" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Project</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Province</th>
                <th>District</th>
                <th>Tehsil</th>
                <th>UC</th>
                <th>Area</th>
                <th>Sub.Area</th>                
                <th>Job Code</th>                
                <th class="text-center">Action</th>
                
                
            </tr>
        </thead>
        <tbody>

<?php 

  $i = 0;
    $location_detail=0;
    foreach($location_job_position as $location_detail){  // echo $location_detail->company_id;
    $i++;
     
    $designation = $this->Designation_model->read_designation_information($location_detail->designation_id);
          if($designation){ 
                if(!is_null($designation)){
                          $designation_name = $designation[0]->designation_name;
                          $designation_id = $designation[0]->designation_id;
                } else {
                          $designation_name = '--';
                }
          }else{ $designation_name = '--'; }  


    $department = $this->Department_model->read_department_information($location_detail->department_id);
          if($department){ 
                    if(!is_null($department)){
                              $department_name = $department[0]->department_name;
                              $department_id = $department[0]->department_id;
                    } else {
                              $department_name = '--';
                    }
          }else{ $department_name = '--'; }  

    $all_projects = $this->Company_model->read_company_information($location_detail->company_id);
          if($all_projects){ 
                    if(!is_null($all_projects)){
                              $proj_name = $all_projects[0]->name;
                    } else {
                              $proj_name = '--';
                    }
           }else{ $proj_name = '--'; }    

     $province_data = $this->ProvinceCity->read_province_information($location_detail->province_id);
          if($province_data){ 
                    if(!is_null($province_data)){
                              $province_name = $province_data[0]->name;
                    } else {
                              $province_name = '--';
                    }   
          }else{ $province_name = '--'; }       
        
     $district_data = $this->ProvinceCity->read_district_information($location_detail->district_id);
        if($district_data){ 
            if(!is_null($district_data)){
                      $district_name = $district_data[0]->name;
            } else {
                      $district_name = '--';
            } 
        }else{ $district_name = '--'; }    
          
      $tehsil_data = $this->ProvinceCity->read_tehsil_information($location_detail->tehsil_id);
        if($tehsil_data){
            if(!is_null($tehsil_data)){
                      $tehsil_name = $tehsil_data[0]->name;
            } else {
                      $tehsil_name = '--';
            } 
        }else{ $tehsil_name = '--'; }     
          
      $uc_data = $this->ProvinceCity->read_union_councel_information($location_detail->uc_id);
          if($uc_data){
                    if(!is_null($uc_data)){
                              $uc_name = $uc_data[0]->name;
                    } else {
                              $uc_name = '--';
                    }   
          }else{ $uc_name = '--'; }  

       $area_name_data = $this->ProvinceCity->read_area_information($location_detail->area_id);
          if($area_name_data){
                    if(!is_null($area_name_data)){
                              $area_name = $area_name_data[0]->name;
                    } else {
                              $area_name = '--';
                    }  
          }else{ $area_name = '--'; }  
          
      $sub_area_data = $this->ProvinceCity->read_sub_area_information($location_detail->sub_area_id);
          if($sub_area_data){
                    if(!is_null($sub_area_data)){
                              $sub_area_name = $sub_area_data[0]->name;
                    } else {
                              $sub_area_name = '--';
                    }                
          }else{ $sub_area_name = '--'; }  



            ?>
            <tr>
                <td><?php echo $i; ?></td>   
                <td><?php echo $proj_name;?></td>
                <td><span class="d-inline-block text-truncate" style="max-width: 80px;"><?php echo $designation_name;?></span></td>
                <td><span class="d-inline-block text-truncate" style="max-width: 80px;"><?php echo $department_name;?> </span></td>
                <td><span class="d-inline-block text-truncate" style="max-width: 80px;"><?php echo $province_name; ?> </span></td>
                <td><span class="d-inline-block text-truncate" style="max-width: 80px;"><?php echo $district_name; ?> </span></td>
                <td><span class="d-inline-block text-truncate" style="max-width: 80px;"><?php echo $tehsil_name; ?> </span></td>
                <td><span class="d-inline-block text-truncate" style="max-width: 80px;"><?php echo $uc_name; ?> </span></td>
                <td><span class="d-inline-block text-truncate" style="max-width: 80px;"> <?php echo $area_name; ?> </span></td>
                <td><span class="d-inline-block text-truncate" style="max-width: 80px;"> <?php echo $sub_area_name; ?> </span></td>
                
                <td><?php echo $location_detail->job_code; ?></td>
                 
                <!-- <td><?php echo ($location_detail->status==0)?'Open':'Closed' ; ?></td> -->                
                <!-- <td><?php echo $location_detail->sdt; ?></td> -->
                <td><button type="button" data-toggle="modal" data-target="#job_setup<?php echo $i; ?>" class="btn btn-xs btn-info" style="padding: 5px;">Shift Job Code</button></td>
               
                             
</tr>



<div class="modal fade" id="job_setup<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="jobsetupModalLabel">
  <div class="modal-dialog" role="document" style="width: 900px; max-width: 900px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F5F5F5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="jobsetupModalLabel"> Job Posting... </h4>
      </div>
      <form action="<?php echo site_url("job_post/add_job") ?>" method="post" name="add_job" id="xin-form">
        <input type="hidden" value="job" name="add_type">
        <input type="hidden" value="<?php echo $location_detail->id; ?>" name="id"> 
        <input type="hidden" value="<?php echo $location_detail->location_id; ?>" name="location_id"> 
        <input type="hidden" value="<?php echo $location_detail->company_id; ?>" name="company_id"> 
        <input type="hidden" value="<?php echo $location_detail->designation_id; ?>" name="designation_id"> 
        <input type="hidden" value="<?php echo $location_detail->department_id; ?>" name="department_id"> 

        <input type="hidden" value="<?php echo $location_detail->province_id; ?>" name="province_id"> 
        <!-- <input type="hidden" value="<?php echo $location_detail->city_id; ?>" name="city_id">  -->
        <input type="hidden" value="<?php echo $location_detail->district_id; ?>" name="district_id"> 
        <input type="hidden" value="<?php echo $location_detail->tehsil_id; ?>" name="tehsil_id"> 
        <input type="hidden" value="<?php echo $location_detail->uc_id; ?>" name="uc_id"> 
        <input type="hidden" value="<?php echo $location_detail->area_id; ?>" name="area_id"> 
        <input type="hidden" value="<?php echo $location_detail->sub_area_id; ?>" name="sub_area_id">  
        <br>
        <div style="width: 96%; margin:auto;">
          <div class="col-md-12">
                  <!-- <div class="form-group">
                    <label for="long_description"><?php echo $this->lang->line('xin_long_description');?></label>
                    <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_long_description');?>" name="long_description" cols="30" rows="15" id="long_description" required="required"></textarea>
                  </div> -->
                  <!-- <div class="form-group"> -->
                  <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">Project</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">designation_id</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>

                  </div>

                  <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">department_id</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">province_id</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>
                     
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">district_id</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">tehsil_id</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>
                     
                  </div>


                <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">uc_id</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">area_id</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>
                     
                  </div>

                 
                 
            
               <div class="row">
                     <div class="col-md-6">
                      <div class="form-group">
                        <label for="Project">sub_area_id</label>
                        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Project" required="required">                          
                          <?php foreach($all_companies as $proj) {?>
                          <option value="<?php echo $proj->company_id; ?>"><?php echo $proj->name?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </div>

                      
                     
                  </div>

            </div>  
        </div> 
         
        <br><br>
        <div class="clearfix form-actions">
          <div class="col-md-offset-3 col-md-9">
            <button class="btn btn-info" type="submit">
              <i class="ace-icon fa fa-check bigger-110"></i> Save
            </button>
            &nbsp; &nbsp; &nbsp;
            <button class="btn" type="reset">
              <i class="ace-icon fa fa-undo bigger-110"></i> Reset
            </button>
          </div>
        </div>
        <br>
        <br>
      </form>
    </div>
  </div>
</div>            
            <?php  } ?>
        </tbody>
    </table>
</div>
 </div> 

</div>

