<?php

/* Location view

*/

?>

<?php $session = $this->session->userdata('username');

 $this->load->model('provinceCity');
 $geProvinces = $this->provinceCity->getAllProvinces();   



?>



<div class="add-form" style="display:none;">

  <div class="box box-block bg-white">

    <h2><strong>Add Job Positions Sutup</strong> Positions Sutup

      <div class="add-record-btn">

        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> <?php echo $this->lang->line('xin_hide');?></button>

      </div>

    </h2>

    <div class="row m-b-1">

      <div class="col-md-12">

        <form class="m-b-1 add" method="post" name="add_location" id="xin-form">

          <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">

          <div class="bg-white">

            <div class="box-block">

              <div class="row">

                <div class="col-sm-3">

                  <div class="form-group">

                    <label for="company_name"><?php echo $this->lang->line('module_company_title');?></label>

                    <select class="form-control" name="company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">

                      <option value=""><?php echo $this->lang->line('xin_select_one');?></option>

                      <?php foreach($all_companies as $company) {?>

                      <option value="<?php echo $company->company_id;?>"> <?php echo $company->name;?></option>

                      <?php } ?>

                    </select>

                  </div>
                </div>

               <!--  <div class="col-sm-6">

                  <div class="form-group">

                    <div class="row">

                      <div class="col-md-6">

                        <label for="email"><?php echo $this->lang->line('xin_view_locationh');?></label>

                        <select class="form-control" name="location_head" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_view_locationh');?>">

                          <option value=""><?php echo $this->lang->line('xin_select_one');?></option>

                          <?php foreach($all_employees as $employee) {?>

                          <option value="<?php echo $employee->user_id;?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>

                          <?php } ?>

                        </select>

                      </div>

                      <div class="col-md-6">

                        <label for="website"><?php echo $this->lang->line('xin_view_locationmgr');?></label>

                        <select class="form-control" name="location_manager" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_view_locationmgr');?>">

                          <option value=""><?php echo $this->lang->line('xin_select_one');?></option>

                          <?php foreach($all_employees as $employee) {?>

                          <option value="<?php echo $employee->user_id;?>"> <?php echo $employee->first_name.' '.$employee->last_name;?></option>

                          <?php } ?>

                        </select>

                      </div>

                    </div>

                  </div> 
               </div>     -->
                


    


         <!--  <div class="col-md-4">
              <div class="form-group">
                  <label for="Selector option" class="control-label">Select Locations</label>
                  <select id="mystuff" class="form-control">      
                       
                       <option value="0">-- Choose Locations --</option>       
                       <option value="opt1">Option 1</option>
                       <option value="opt2">CBV</option>
                       <option value="opt3">ComNet</option>

                  </select>
              </div>
          </div>  -->   


 <!-- <div class="col-sm-12"> -->
 

    <!-- <div class="mystaff_hide mystaff_opt1">
        <div class="col-md-12">
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Province</label>
                            <select title="Select province" name="province" class="form-control" id="preven-name">      
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
                            <select title="Select City" name="city_name" class="form-control" id="city-name">      
                                <option value="">Select City</option>
                            </select>
                        </div>
                      </div>
                 
                    
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Area</label>
                            <select title="Select area" name="area_name" class="form-control" id="area-name">      
                                <option value="">Select Area</option>
                            </select>
                        </div>
                      </div>  
            </div>        
    </div>  -->

    
   <!--  <div class="mystaff_hide mystaff_opt2"> -->
        
          
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Province op2</label>
                            <select title="Select province" name="province" class="form-control" id="province-name">      
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
                            <select title="Select district" name="district_name" class="form-control" id="district-name">      
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                 
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Tehsil</label>
                            <select title="Select Tehsil" name="Tehsil_name" class="form-control" id="Tehsil-name">      
                                <option value="">Select Tehsil</option>
                            </select>
                        </div>
                    </div>   


                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">UC</label>
                            <select title="Select UC" name="uc_name" class="form-control" id="uc-name">      
                                <option value="">Select UC</option>
                            </select>
                        </div>
                    </div>  

                     <div class="col-md-4">  
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Area</label>
                            <select title="Select Area" name="area_name" class="form-control" id="area-name">      
                                <option value="">Select Area</option>
                            </select>
                        </div>
                    </div> 

                    <div class="col-md-4">  
                        <div class="form-group">
                            <label for="" class="control-label">Sub Area</label>
                            <select title="Select Area" name="sub_area_name" class="form-control" id="sub-area-name">      
                                <option value="">Select Sub Area</option>
                            </select>
                        </div>
                    </div>
                    
       <!-- </div> -->  



<!-- <div class="mystaff_hide mystaff_opt3">
        
          <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Province</label>
                            <select title="Select province" name="province" class="form-control" id="province-name">      
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
                            <select title="Select district" name="district_name" class="form-control" id="district-name">      
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                 
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Tehsil</label>
                            <select title="Select Tehsil" name="Tehsil_name" class="form-control" id="Tehsil-name">      
                                <option value="">Select Tehsil</option>
                            </select>
                        </div>
                    </div>   


                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">UC</label>
                            <select title="Select UC" name="uc_name" class="form-control" id="uc-name">      
                                <option value="">Select UC</option>
                            </select>
                        </div>
                    </div>  

                      <div class="col-md-4">  
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Area</label>
                            <select title="Select Area" name="area_name" class="form-control" id="area-name">      
                                <option value="">Select Area</option>
                            </select>
                        </div>
                    </div> 
           </div>         
       </div>  -->

<!-- 

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

</script>     -->      


                 <!--  <div class="form-group">

                    <label for="name"><?php echo $this->lang->line('xin_location_name');?></label>

                    <input class="form-control" placeholder="<?php echo $this->lang->line('xin_location_name');?>" name="name" type="text">
                  </div> -->
                 <!--  <div class="form-group">

                    <label for="email"><?php echo $this->lang->line('xin_email');?></label>

                    <input class="form-control" placeholder="<?php echo $this->lang->line('xin_email');?>" name="email" type="email">
                  </div> -->
                  <!-- <div class="form-group">

                    <div class="row">

                      <div class="col-md-6">

                        <label for="phone"><?php echo $this->lang->line('xin_phone');?></label>

                        <input class="form-control" placeholder="<?php echo $this->lang->line('xin_phone');?>" name="phone" type="number">

                      </div>

                      <div class="col-md-6">

                        <label for="xin_faxn"><?php echo $this->lang->line('xin_faxn');?></label>

                        <input class="form-control" placeholder="<?php echo $this->lang->line('xin_faxn');?>" name="fax" type="number">

                      </div>

                    </div>
                  </div> -->
                <!-- </div> -->

                

              </div>

              <div class="text-right">

                <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>

              </div>

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<div class="box box-block bg-white">

  <h2><strong>List All Sutups </strong> All Sutups
    <div class="add-record-btn">
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> <?php echo $this->lang->line('xin_add_new');?></button>
    </div>
  </h2>
  <div class="table-responsive" data-pattern="priority-columns">

    <table class="table table-striped table-bordered dataTable" id="xin_table" style="width:100%;">

      <thead>

        <tr>

          <th><?php echo $this->lang->line('xin_action');?></th>

          <th><?php echo $this->lang->line('xin_location_name');?></th>

          <th><?php echo $this->lang->line('xin_view_locationh');?></th>

          <th><?php echo $this->lang->line('module_company_title');?></th>

          <th><?php echo $this->lang->line('xin_city');?></th>

          <th><?php echo $this->lang->line('xin_country');?></th>

          <th><?php echo $this->lang->line('xin_added_by');?></th>

        </tr>

      </thead>

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
          url: "http://www.ctcorg.com/hrms/job_post/getDistrict",
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
                    url: "http://www.ctcorg.com/hrms/job_post/getTehsil",
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
                     
                    url: "http://www.ctcorg.com/hrms/job_post/getuc",
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
            url: "http://www.ctcorg.com/hrms/job_post/getCBVareas",
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
            url: "http://www.ctcorg.com/hrms/job_post/getCBVSubAreas",
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
        url: "http://www.ctcorg.com/hrms/job_post/getcity",
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
                  url: "http://www.ctcorg.com/hrms/job_post/getareas",
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