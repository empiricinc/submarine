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
 <form class="m-b-1 add" action="<?php echo site_url(); ?>Uc_setup/add_tehsil" method="post" name="add_location">
 
          
          <div class="col-md-12">
                    

                     <div class="col-md-4">  
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">District</label>
                            <select title="Select district" name="district_id" class="form-control" required="required">      
                                <option value="">Select District</option>

                                <?php
                                foreach ($all_district as $key => $disc) {
                                    echo '<option value="'.$disc['id'].'">'.$disc['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div> 

                    <div class="col-md-4">  
                        <div class="form-group">
                            <label for="" class="control-label">Tehsil Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Tehsil Name" required="required">
                        </div>
                    </div>
           </div>  

          <div class="col-md-12" class="text-right">
            <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>
          </div>           
</form>
<!-- </div>  -->















            
         <!--  <div class="col-md-4" style="margin-left: 1.2%; width: 32.3%;">
              <div class="form-group">
                  <label for="Selector option" class="control-label">Select Locations(Project Type)</label>
                  <select id="mystuff" class="form-control">                         
                       <option value="0">-- Choose Locations --</option>       
                       <option value="opt1">Option 1</option>
                       <option value="opt2">CBV</option>
                       <option value="opt3">ComNet</option>
                  </select>
              </div>
          </div>   -->  


 <!-- <div class="col-sm-12"> -->
 
<!-- 
<div class="mystaff_hide mystaff_opt1">
 <form class="m-b-1 add" action="<?php echo site_url(); ?>location/add_location" method="post" name="add_location" id="">
 <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">     
 <input type="hidden" name="location_option" value="1">     

         <div class="col-sm-4">

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

        <div class="col-md-12">
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Province</label>
                            <select title="Select province" name="province_id" class="form-control" id="preven-name">      
                                <option value="">Select Province</option>
                                <?php
                                foreach ($geProvinces as $key => $element) {
                                    echo '<option value="'.$element['province_id'].'">'.$element['province_name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                      </div>  
                     
                 
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">City</label>
                            <select title="Select City" name="city_id" class="form-control" id="city-name">      
                                <option value="">Select City</option>
                            </select>
                        </div>
                      </div>
                 
                    
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Area</label>
                            <select title="Select area" name="area_id" class="form-control" id="area-name">      
                                <option value="">Select Area</option>
                            </select>
                        </div>
                      </div>  
            </div>        
            <div class="col-md-12" class="text-right">
              <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>
            </div>            
</form>
</div>  -->




 <!--    
<div class="mystaff_hide mystaff_opt2">
 <form class="m-b-1 add" action="<?php echo site_url(); ?>location/add_location" method="post" name="add_location" id="">
 <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">     
<input type="hidden" name="location_option" value="1">
         <div class="col-sm-4">

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
          <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Province</label>
                            <select title="Select province" name="province_id" class="form-control" id="province-name">      
                                <option value="">Select Province</option>
                                <?php
                                foreach ($geProvinces as $key => $element) {
                                    echo '<option value="'.$element['province_id'].'">'.$element['province_name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                 
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">District</label>
                            <select title="Select district" name="district_id" class="form-control" id="district-name">      
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                 
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Tehsil</label>
                            <select title="Select Tehsil" name="tehsil_id" class="form-control" id="Tehsil-name">      
                                <option value="">Select Tehsil</option>
                            </select>
                        </div>
                    </div>   


                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">UC</label>
                            <select title="Select UC" name="uc_id" class="form-control" id="uc-name">      
                                <option value="">Select UC</option>
                            </select>
                        </div>
                    </div>  

                     <div class="col-md-4">  
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Area</label>
                            <select title="Select Area" name="area_id" class="form-control" id="area-name">      
                                <option value="">Select Area</option>
                            </select>
                        </div>
                    </div> 

                    <div class="col-md-4">  
                        <div class="form-group">
                            <label for="" class="control-label">Sub Area</label>
                            <select title="Select Area" name="sub_area_id" class="form-control" id="sub-area-name">      
                                <option value="">Select Sub Area</option>
                            </select>
                        </div>
                    </div>
           </div>  

          <div class="col-md-12" class="text-right">
            <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>
          </div>           
</form>
</div>   -->



<!-- 
<div class="mystaff_hide mystaff_opt3">
  <form class="m-b-1 add" action="<?php echo site_url(); ?>location/add_location" method="post" name="add_location" id="">
  <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">
  <input type="hidden" name="location_option" value="1">
           <div class="col-sm-4">

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
        
          <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Province</label>
                            <select title="Select province" name="province_id" class="form-control" id="province-name">      
                                <option value="">Select Province</option>
                                <?php
                                foreach ($geProvinces as $key => $element) {
                                    echo '<option value="'.$element['province_id'].'">'.$element['province_name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                 
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">District</label>
                            <select title="Select district" name="district_id" class="form-control" id="district-name">      
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                 
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Tehsil</label>
                            <select title="Select Tehsil" name="tehsil_id" class="form-control" id="Tehsil-name">      
                                <option value="">Select Tehsil</option>
                            </select>
                        </div>
                    </div>   


                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">UC</label>
                            <select title="Select UC" name="uc_id" class="form-control" id="uc-name">      
                                <option value="">Select UC</option>
                            </select>
                        </div>
                    </div>  

                      <div class="col-md-4">  
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Area</label>
                            <select title="Select Area" name="area_id" class="form-control" id="area-name">      
                                <option value="">Select Area</option>
                            </select>
                        </div>
                    </div> 
           </div>         
  
        <div class="col-md-12" class="text-right">
          <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>
        </div>
</form>
</div>  -->





<script type="text/javascript">
  
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

</script>          


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
                <th>Tehsil Name</th>

                <th>District Name</th>
                
                 
               
                 
            </tr>
        </thead>
        <tbody>
           <?php 
                $i = 0;
                  $location_detail=0;
                  foreach($all_tehsil as $location_detail){   
                  $i++;
                   

                   $district_data = $this->provinceCity->read_district_information($location_detail['district_id']);
        if($district_data){ 
            if(!is_null($district_data)){
                      $district_name = $district_data[0]->name;
            } else {
                      $district_name = '--';
            } 
        }else{ $district_name = '--'; } 

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
                 

                <td><?php echo $district_name; ?></td>
                 

                 
                 
            </tr> 
            <?php  } ?>
        </tbody>
    </table>
</div>
 

</div>

<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/select2/dist/js/select2.min.js"></script> 

<script type="text/javascript">
    

  // get province 
  jQuery(document).on('change', 'select#province-name', function (e) {
      e.preventDefault();
      var provinceID = jQuery(this).val();
      getDistrictList(provinceID);
  });

  // get district
  jQuery(document).on('change', 'select#district-name', function (e) {
      e.preventDefault();
      var thedistrictID = jQuery(this).val();
      getTehsilList(thedistrictID);

  });

  jQuery(document).on('change', 'select#Tehsil-name', function (e) {
      e.preventDefault();
      var tehsilID = jQuery(this).val();
      getucList(tehsilID);

  });

  jQuery(document).on('change', 'select#uc-name', function (e) {
        e.preventDefault();
        var theucID = jQuery(this).val();
        getCBVAreaList(theucID);

    });

  jQuery(document).on('change', 'select#area-name', function (e) {
      e.preventDefault();
      var theareaID = jQuery(this).val();
      getCBVSubAreaList(theareaID);

  });

  // function get All District
  function getDistrictList(provinceID) {
      $.ajax({
          url: "<?php echo base_url(); ?>job_post/getDistrict",
          type: 'post',
          data: {provinceID: provinceID},
          dataType: 'json',
          beforeSend: function () {
              jQuery('select#district-name').find("option:eq(0)").html("Please wait..");
          },
          complete: function () {
              // code
          },
          success: function (json) {
              var options = '';
              options +='<option value="">Select District</option>';
              for (var i = 0; i < json.length; i++) {
                  options += '<option value="' + json[i].district_id + '">' + json[i].district_name + '</option>';
              }
              jQuery("select#district-name").html(options);

          },
          error: function (xhr, ajaxOptions, thrownError) {
              console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
          }
      });
  }

  // function get All Tehsils
  function getTehsilList(thedistrictID) {
                $.ajax({
                    //url: baseurl + "location/getTehsils",
                    url: "<?php echo base_url(); ?>job_post/getTehsil",
                    type: 'post',
                    data: {thedistrictID: thedistrictID},
                    dataType: 'json',
                    beforeSend: function () {
                        jQuery('select#Tehsil-name').find("option:eq(0)").html("Please wait..");
                    },
                    complete: function () {
                        // code
                    },
                    success: function (json) {
                        var options = '';
                        options +='<option value="">Select Tehsil</option>';
                        for (var i = 0; i < json.length; i++) {
                            options += '<option value="' + json[i].Tehsil_id + '">' + json[i].Tehsil_name + '</option>';
                        }
                        jQuery("select#Tehsil-name").html(options);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
      
  // function get All uc
  function getucList(tehsilID) {
                $.ajax({
                     
                    url: "<?php echo base_url(); ?>job_post/getuc",
                    type: 'post',
                    data: {tehsilID: tehsilID},
                    dataType: 'json',
                    beforeSend: function () {
                        jQuery('select#uc-name').find("option:eq(0)").html("Please wait..");
                    },
                    complete: function () {
                        // code
                    },
                    success: function (json) {
                        var options = '';
                        options +='<option value="">Select uc</option>';
                        for (var i = 0; i < json.length; i++) {
                            options += '<option value="' + json[i].uc_id + '">' + json[i].uc_name + '</option>';
                        }
                        jQuery("select#uc-name").html(options);

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }

  // function get All Areas
  function getCBVAreaList(theucID) {
        $.ajax({
            //url: baseurl + "location/getareas",
            url: "<?php echo base_url(); ?>job_post/getCBVareas",
            type: 'post',
            data: {theucID: theucID},
            dataType: 'json',
            beforeSend: function () {
                jQuery('select#area-name').find("option:eq(0)").html("Please wait..");
            },
            complete: function () {
                // code
            },
            success: function (json) {
                var options = '';
                options +='<option value="">Select Area</option>';
                for (var i = 0; i < json.length; i++) {
                    options += '<option value="' + json[i].area_id + '">' + json[i].area_name + '</option>';
                }
                jQuery("select#area-name").html(options);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

  function getCBVSubAreaList(theareaID) {
        $.ajax({
            //url: baseurl + "location/getareas",
            url: "<?php echo base_url(); ?>job_post/getCBVSubAreas",
            type: 'post',
            data: {theareaID: theareaID},
            dataType: 'json',
            beforeSend: function () {
                jQuery('select#sub-area-name').find("option:eq(0)").html("Please wait..");
            },
            complete: function () {
                // code
            },
            success: function (json) {
                var options = '';
                options +='<option value="">Select Sub Area</option>';
                for (var i = 0; i < json.length; i++) {
                    options += '<option value="' + json[i].sub_area_id + '">' + json[i].sub_area_name + '</option>';
                }
                jQuery("select#sub-area-name").html(options);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }  




</script>



 
<!-- <script type="text/javascript" src="<?php echo base_url();?>skin/vendor/select2/dist/js/select2.min.js"></script> 
 -->
<script type="text/javascript">
  

// get province 
jQuery(document).on('change', 'select#preven-name', function (e) {
    e.preventDefault();
    var provinceID = jQuery(this).val();
    getCityList(provinceID);
});

// get city
jQuery(document).on('change', 'select#city-name', function (e) {
    e.preventDefault();
    var thecityID = jQuery(this).val();
    getAreaList(thecityID);

});

// function get All city
function getCityList(provinceID) {
    $.ajax({
        url: "<?php echo base_url(); ?>job_post/getcity",
        type: 'post',
        data: {provinceID: provinceID},
        dataType: 'json',
        beforeSend: function () {
            jQuery('select#city-name').find("option:eq(0)").html("Please wait..");
        },
        complete: function () {
            // code
        },
        success: function (json) {
            var options = '';
            options +='<option value="">Select City</option>';
            for (var i = 0; i < json.length; i++) {
                options += '<option value="' + json[i].city_id + '">' + json[i].city_name + '</option>';
            }
            jQuery("select#city-name").html(options);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

// function get All Areas
function getAreaList(thecityID) {
              $.ajax({
                  //url: baseurl + "location/getareas",
                  url: "<?php echo base_url(); ?>job_post/getareas",
                  type: 'post',
                  data: {thecityID: thecityID},
                  dataType: 'json',
                  beforeSend: function () {
                      jQuery('select#area-name').find("option:eq(0)").html("Please wait..");
                  },
                  complete: function () {
                      // code
                  },
                  success: function (json) {
                      var options = '';
                      options +='<option value="">Select Area</option>';
                      for (var i = 0; i < json.length; i++) {
                          options += '<option value="' + json[i].area_id + '">' + json[i].area_name + '</option>';
                      }
                      jQuery("select#area-name").html(options);

                  },
                  error: function (xhr, ajaxOptions, thrownError) {
                      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                  }
              });
          }

</script>