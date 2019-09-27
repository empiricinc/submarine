<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($_GET['jd']) && isset($_GET['job_id']) && $_GET['data']=='apply_job'){

$session = $this->session->userdata('username');

$user = $this->Xin_model->read_user_info($session['user_id']);


        $this->load->model('provinceCity');
        $geProvinces = $this->provinceCity->getAllProvinces();   
          

         
?>


<div class="modal-header">

  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>

  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_job_application_for');?> <?php echo $job_title;?></h4>

</div>
<!-- 
<form class="m-b-1" action="<?php echo site_url("frontend/jobs/apply_job").'/'.$job_id.'/'; ?>" method="post" name="apply_job" id="apply_job"> -->

  
<form class="m-b-1" action="<?php echo site_url("frontend/jobs/apply_job").'/'.$job_id.'/'; ?>" method="post" name="apply_job">

  <input type="hidden" name="_method" value="EDIT">
  <input type="hidden" name="add_type" value="apply_job">
  

  <input type="hidden" name="job_id" value="<?php echo $job_id;?>">

  <input type="hidden" name="user_id" value="<?php echo $session['user_id'];?>">

  <div class="modal-body">

    <div class="row">

      <div class="col-md-12">

        <div class="row">

           <div class="col-md-4">

            <div class="form-group">

              <label for="fullname"><?php echo $this->lang->line('dashboard_fullname');?></label>

              <input type="text" name="fullname" class="form-control" value="<?php //echo $user[0]->first_name. ' ' .$user[0]->last_name;?>" placeholder="Full name">

            </div>

          </div>

          <div class="col-md-4">

            <div class="form-group">

              <label for="contact"><?php echo $this->lang->line('dashboard_email');?></label>

              <input type="email" name="email" class="form-control" value="<?php //echo $user[0]->email;?>" placeholder="email">

            </div>

          </div>

          <div class="col-md-4">
                      <div class="form-group">
                        <label for="gender"><?php echo $this->lang->line('xin_employee_gender');?></label>
                        <select class="form-control" name="gender" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_employee_gender');?>">
                          <option value="0"><?php echo $this->lang->line('xin_gender_male');?></option>
                          <option value="1"><?php echo $this->lang->line('xin_gender_female');?></option>
                          <option value="2"><?php echo $this->lang->line('xin_job_no_preference');?></option>
                        </select>
                      </div>
            </div>

        </div>

        <div class="row">

           <div class="col-md-4">

            <div class="form-group">
                            <label for="age">Age</label>
                            <select class="form-control" name="age" data-plugin="select_hrm" data-placeholder="Age">
                              <option value="">Select Age</option>
                              <option value="1"> 20 - 25</option>
                              <option value="2"> 25-30</option>
                              <option value="3"> 30-35</option>
                            </select>
                          </div>

          </div>

          <div class="col-md-4">

            <div class="form-group">
                            <label for="education_name">Education</label>
                            <select class="form-control" name="education" data-plugin="select_hrm" data-placeholder="Education">
                              <option value="">Select Education</option>
                              <option value="1"> MA</option>
                              <option value="2"> BA</option>
                              <option value="3"> FA</option>
                            </select>
                          </div>

          </div>
 <div class="col-md-4">

            <div class="form-group">

              <label for="experience" class="control-label"><?php echo $this->lang->line('xin_job_minimum_experience');?></label>

              <select class="form-control" name="experience" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_job_minimum_experience');?>">

                <option value="0" <?php if($minimum_experience=='0'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_fresh');?></option>

                <option value="1" <?php if($minimum_experience=='1'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_1year');?></option>

                <option value="2" <?php if($minimum_experience=='2'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_2years');?></option>

                <option value="3" <?php if($minimum_experience=='3'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_3years');?></option>

                <option value="4" <?php if($minimum_experience=='4'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_4years');?></option>

                <option value="5" <?php if($minimum_experience=='5'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_5years');?></option>

                <option value="6" <?php if($minimum_experience=='6'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_6years');?></option>

                <option value="7" <?php if($minimum_experience=='7'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_7years');?></option>

                <option value="8" <?php if($minimum_experience=='8'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_8years');?></option>

                <option value="9" <?php if($minimum_experience=='9'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_9years');?></option>

                <option value="10" <?php if($minimum_experience=='10'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_10years');?></option>

                <option value="11" <?php if($minimum_experience=='11'):?> selected <?php endif;?>>

        <?php echo $this->lang->line('xin_job_experience_define_plus_10years');?></option>

              </select>

            </div>

          </div>
          

        </div>


        <div class="row">


          <div class="col-md-4">
                 <div class="form-group">
                    <label for="domicile">Domicile</label>
                    <select class="form-control" name="domicile" data-plugin="select_hrm" data-placeholder="Domicile">
                      <option value="">Select Domicile</option>
                      <option value="1"> swat</option>
                      <option value="2"> banu</option>
                      <option value="3"> kohat</option>
                    </select>
                  </div>
          </div>



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

           

        </div>

        <?php $system_setting = $this->Xin_model->read_setting_info(1);?>

        <div class="row">

          <div class="col-md-6">

            <div class="form-group">

              <label for="resume"><?php echo $this->lang->line('xin_upload_resume_from_pc');?></label>

              <span class="btn btn-primary btn-file"> <?php echo $this->lang->line('xin_browse');?>

              <input type="file" name="resume">

              </span>

              <?php if($system_setting[0]->job_application_format!=''){?>

              <br>

              <small><?php echo $this->lang->line('xin_upload_file_only_for_resume');?>: <?php echo $system_setting[0]->job_application_format;?></small>

              <?php } ?>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-md-8">

            <div class="form-group">

              <label for="message"><?php echo $this->lang->line('xin_your_covering_message_for');?> <?php echo $job_title;?></label>

              <textarea class="form-control" name="message" id="message" rows="5"></textarea>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

  <div class="modal-footer">

    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>

    <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('xin_apply');?></button>

  </div>

</form>

<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/select2/dist/css/select2.min.css">
<!-- 
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/select2/dist/js/select2.min.js"></script>  -->

<script type="text/javascript">

 $(document).ready(function(){		



		/* Edit data */

		$("#apply_job").submit(function(e){

		var fd = new FormData(this);

		var obj = $(this), action = obj.attr('name');

		fd.append("is_ajax", 6);

		fd.append("add_type", 'apply_job');

		fd.append("data", 'apply_job');

		fd.append("form", action);

		e.preventDefault();

		$('.save').prop('disabled', true);

		$.ajax({

			url: e.target.action,

			type: "POST",

			data:  fd,

			contentType: false,

			cache: false,

			processData:false,

			success: function(JSON)

			{

				if (JSON.error != '') {

					toastr.error(JSON.error);

					$('.save').prop('disabled', false);

				} else {

					$('.apply-job').modal('toggle');

					toastr.success(JSON.result);

					$('#apply_job')[0].reset(); // To reset form fields

					$('.save').prop('disabled', false);

				}

			},

			error: function() 

			{

				toastr.error(JSON.error);

				$('.save').prop('disabled', false);

			} 	        

	   });

	});

	});	







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
        url: "http://localhost/submarine/job_post/getcity",
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
/*function getAreaList(thecityID) {
    $.ajax({
        //url: baseurl + "location/getareas",
        url: base_url+"/getareas",
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
}*/

  </script>

<?php }

?>

