<?php

/* Location view

*/

?>

<?php $session = $this->session->userdata('username');

 $this->load->model('provinceCity');
 $geProvinces = $this->provinceCity->getAllProvinces();   



$messageSuccess = $this->session->flashdata('messageSuccess');
if ($messageSuccess) { echo $messageSuccess = '<div class="alert alert-success text-center"><strong>Success!</strong> '.$messageSuccess.' </div>'; }




$error = $this->session->flashdata('error');
if ($error) { echo $error = '<div class="alert alert-danger text-center"><strong>Alert!</strong> '.$error.' </div>'; }


?>



<div class="add-form" style="display:none;">

  <div class="box box-block bg-white">

    <h2><strong><?php echo $this->lang->line('xin_add_new');?></strong> <?php echo $this->lang->line('xin_location');?>

      <div class="add-record-btn">

        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> <?php echo $this->lang->line('xin_hide');?></button>

      </div>

    </h2>

    <div class="row m-b-1">

      <div class="col-md-12">
 
          <div class="bg-white">

            <div class="box-block">

              <div class="row">




    
<!-- <div class="mystaff_hide mystaff_opt2"> -->
 <form class="m-b-1 add" action="<?php echo site_url(); ?>uc_setup/add_district" method="post">
 
          
          <div class="col-md-12">
                    

                     <div class="col-md-4">  
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">All Provinces</label>
                             <select title="Select province" name="province_id" class="form-control">      
                                  <option value="">Select Province</option>
                                  <?php
                                  foreach ($all_provinces as $key => $element) {
                                      echo '<option value="'.$element['id'].'">'.$element['name'].'</option>';
                                  }
                                  ?>
                              </select>
                        </div>
                    </div> 

                    <div class="col-md-4">  
                        <div class="form-group">
                            <label for="" class="control-label">District Name</label>
                            <input type="text" class="form-control" name="name" placeholder="District Name" required="required">
                        </div>
                    </div>
           </div>  

          <div class="col-md-12" class="text-right">
            <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>
          </div>           
</form>
 


<!-- <script type="text/javascript">
  
            //add collapse to all tags hiden and showed by select mystuff
          $('.mystaff_hide').addClass('collapse');

          //on change hide all divs linked to select and show only linked to selected option
          $('#mystuff').change(function(){
              //Saves in a variable the wanted div
              var selector = '.mystaff_' + $(this).val();

              //hide all elements
              $('.mystaff_hide').collapse('hide');

              //show only element connected to selected option
              $(selector).collapse('show');
          });

</script>  -->         


              </div>

              <!-- <div class="text-right">

                <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>

              </div> -->

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>





<!-- <div class="box box-block bg-white">
<br>
<div class="col-md-12">
<div class="row">
<form action="<?php echo base_url(); ?>/location" method="post" name="location">
  <div class="col-sm-3">

      <div class="form-group">

        <label for="company_name"><?php echo $this->lang->line('module_company_title');?></label>

        <select class="form-control" name="company_id" data-plugin="select_hrm" data-placeholder="Select Project" required="required">

          <option value=""><?php echo $this->lang->line('xin_select_one');?></option>

          <?php foreach($all_companies as $company) {?>

          <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>

          <?php } ?>

        </select>

      </div>
  </div>
  <div class="col-md-3">
            <div class="form-group">
                <label for="date_of_closing" class="control-label">Province</label>
                <select title="Select province" name="province_id" class="form-control" required="required">      
                    <option value="all">All Provinces</option>
                    <?php
                    foreach ($geProvinces as $key => $element) {
                        echo '<option value="'.$element['province_id'].'">'.$element['province_name'].'</option>';
                    }
                    ?>
                </select>
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
</div> -->



<div class="box box-block bg-white">

  <h2><strong><?php echo $this->lang->line('xin_list_all');?></strong> <?php echo $this->lang->line('xin_locations');?>
    <div class="add-record-btn">
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> <?php echo $this->lang->line('xin_add_new');?></button>
    </div>
  </h2>






<?php 

 //$jobdetails = $this->job_longlisted_model->getJobPosted();

 //   $this->load->model("Designation_model");

   // $this->load->model("Job_post_model");
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#job_listing').DataTable();
} );

  $(document).ready(function() {
    $('#area_positions_listing').DataTable();
} );
</script>

<div class="table-responsive">
    <table id="job_listing" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                 

                <th>District Name</th>
                
                 
              
                <th>Province</th>
            </tr>
        </thead>
        <tbody>
           <?php 
                $i = 0;
                  $location_detail=0;
                  foreach($all_district as $location_detail){   
                  $i++;

$province_data = $this->provinceCity->read_province_information($location_detail['province_id']);

          if(!is_null($province_data)){
                    $province_name = $province_data[0]->name;
          } else {
                    $province_name = '--';
          } 
                   

    /*$designation = $this->Designation_model->read_designation_information($location_detail->location_id);
            if(!is_null($designation)){
                      $designation_name = $designation[0]->designation_name;
            } else {
                      $designation_name = '--';
            }


    $department = $this->Department_model->read_department_information($location_detail->location_id);

          if(!is_null($department)){
                    $department_name = $department[0]->department_name;
          } else {
                    $department_name = '--';
          }*/


    /*$all_projects = $this->Company_model->read_company_information($location_detail->company_id);

          if(!is_null($all_projects)){
                    $proj_name = $all_projects[0]->name;
          } else {
                    $proj_name = '--';
          }

     $province_data = $this->provinceCity->read_province_information($location_detail->province_id);

          if(!is_null($province_data)){
                    $province_name = $province_data[0]->name;
          } else {
                    $province_name = '--';
          }   
     
        
     $district_data = $this->provinceCity->read_district_information($location_detail->district_id);
        if($district_data){ 
            if(!is_null($district_data)){
                      $district_name = $district_data[0]->name;
            } else {
                      $district_name = '--';
            } 
        }else{ $district_name = '--'; }    
          
      $tehsil_data = $this->provinceCity->read_tehsil_information($location_detail->tehsil_id);
        if($tehsil_data){
            if(!is_null($tehsil_data)){
                      $tehsil_name = $tehsil_data[0]->name;
            } else {
                      $tehsil_name = '--';
            } 
        }else{ $tehsil_name = '--'; }     
          
      $uc_data = $this->provinceCity->read_union_councel_information($location_detail->uc_id);
          if($uc_data){
                    if(!is_null($uc_data)){
                              $uc_name = $uc_data[0]->name;
                    } else {
                              $uc_name = '--';
                    }   
          }else{ $uc_name = '--'; }  

       $area_name_data = $this->provinceCity->read_area_information($location_detail->area_id);
          if($area_name_data){
                    if(!is_null($area_name_data)){
                              $area_name = $area_name_data[0]->name;
                    } else {
                              $area_name = '--';
                    }  
          }else{ $area_name = '--'; }  
          
      $sub_area_data = $this->provinceCity->read_sub_area_information($location_detail->sub_area_id);
          if($sub_area_data){
                    if(!is_null($sub_area_data)){
                              $sub_area_name = $sub_area_data[0]->name;
                    } else {
                              $sub_area_name = '--';
                    }                
          }else{ $sub_area_name = '--'; }  */

             

            ?>
          <tr>
                <td><?php echo $i; ?></td>   
                 

                <td><?php echo $location_detail['name']; ?></td>
                 

                <td><?php echo $province_name; ?></td>
                 

                 
                 
            </tr> 
            <?php  } ?>
        </tbody>
    </table>
</div>
 

</div>

<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/select2/dist/js/select2.min.js"></script> 
 