<?php

$session = $this->session->userdata('username');

$system = $this->Xin_model->read_setting_info(1);

$user_info = $this->Xin_model->read_user_info($session['user_id']);

/*if ($user_info[0]->user_role_id==5) {    echo 'kkkkkkkkkkkk'; exit(); header('Location: user_panel');
  # code...
}
*/

/*$designation = $this->Designation_model->read_designation_information($user_info[0]->designation_id);  
$department = $this->Department_model->read_department_information($user_info[0]->department_id);
$project = $this->Xin_model->read_company_info($user_info[0]->company_id);

 $emp_name = $user_info[0]->first_name. ' '.$user_info[0]->last_name;
 $designation_name = $designation[0]->designation_name;
 $department_name = $department[0]->department_name;
 $project_name = $project[0]->name;
*/


/*

$user_role = $user_info[0]->user_role_id;

$designation_id = $user_info[0]->designation_id;

$department_id = $user_info[0]->department_id;

$project_id = $user_info[0]->company_id;

$provience_id = $user_info[0]->provience_id;

$city_id = $user_info[0]->city_id;

*/


  //var_dump($session);


//echo $session['department_id'];





$role_user = $this->Xin_model->read_user_role_info($user_info[0]->user_role_id);


if(!is_null($role_user)){

  $role_resources_ids = explode(',',$role_user[0]->role_resources);

} else {

  $role_resources_ids = explode(',',0); 

}

$accessLevel5 = ($user_info[0]->user_role_id==1 || $user_info[0]->user_role_id==2 || $user_info[0]->user_role_id==3 || $user_info[0]->user_role_id==5); // level from admin---> to User/Employee
$accessLevel3 = ($user_info[0]->user_role_id==1 || $user_info[0]->user_role_id==2 || $user_info[0]->user_role_id==3); // Leavel from admin to Manager...HR,Account etc
$accessLevel2 = ($user_info[0]->user_role_id==1 || $user_info[0]->user_role_id==2); // level upto admin or super Admin
$accessLevel1 = ($user_info[0]->user_role_id==1); //level upto Super Admin.

$accessLevel = array('accessLevel5' => $accessLevel5, 'accessLevel3' => $accessLevel3, 'accessLevel2' => $accessLevel2, 'accessLevel1' => $accessLevel1);
$this->session->set_userdata('accessLevel', $accessLevel);



$departmentLevel0 = ($user_info[0]->department_id==3); //Administrations 
$departmentLevel1 = ($user_info[0]->department_id==5); //HR
$departmentLevel2 = ($user_info[0]->department_id==2); //Finance
$departmentLevel3 = ($user_info[0]->department_id==6); //Payroll
$departmentLevel4 = ($user_info[0]->department_id==4); //Operations
$departmentLevel5 = ($user_info[0]->department_id==1); //Trainings
$departmentLevel6 = ($user_info[0]->department_id==7); //Test/Exam
$departmentLevel7 = ($user_info[0]->department_id==8); //Legal
$departmentLevel8 = ($user_info[0]->department_id==9); //Insurance
$departmentLevel9 = ($user_info[0]->department_id==10); //Card Management
$departmentLevel10 = ($user_info[0]->department_id==11); //Contracts

 

$departmentLevel = array('departmentLevel1' => $departmentLevel1, 'departmentLevel2' => $departmentLevel2, 'departmentLevel3' => $departmentLevel3, 'departmentLevel4' => $departmentLevel4, 'departmentLevel5' => $departmentLevel5, 'departmentLevel6' => $departmentLevel6, 'departmentLevel7' => $departmentLevel7, 'departmentLevel8' => $departmentLevel8, 'departmentLevel9' => $departmentLevel9, 'departmentLevel10' => $departmentLevel10);
$this->session->set_userdata('departmentLevel', $departmentLevel);





if($system[0]->system_skin=='skin-default'){

	$cl_skin = 'light';

} else if($system[0]->system_skin=='skin-1'){

	$cl_skin = 'dark';

} else if($system[0]->system_skin=='skin-2'){

	$cl_skin = 'light';

} else if($system[0]->system_skin=='skin-3'){

	$cl_skin = 'light';

} else if($system[0]->system_skin=='skin-4'){

	$cl_skin = 'dark';

} else if($system[0]->system_skin=='skin-5'){

	$cl_skin = 'dark';

} else if($system[0]->system_skin=='skin-6'){

	$cl_skin = 'dark';

}

?>

<?php $site_lang = $this->load->helper('language');?>

<?php $wz_lang = $site_lang->session->userdata('site_lang');?>

<?php if($user_info[0]->user_role_id==1) { ?>
 

<?php }?>

<div class="site-header">

  <nav class="navbar navbar-<?php echo $cl_skin;?>">

    <div class="navbar-left"> 

      <a class="navbar-brand" href="<?php echo site_url();?>dashboard">   <!--Ayat Ullah Khan@CTC-->
          <div class="hrms-logo">HRMS</div>
          <!-- <img src="assets/img/bars.png" alt=""> -->
      </a>

      <div class="toggle-button <?php echo $cl_skin;?> sidebar-toggle-first float-xs-left hidden-md-up" data-toggle-tooltip="tooltip" data-placement="bottom" data-title="Sidebar" data-original-title="" title=""> <span class="hamburger"></span> </div>

      <div class="toggle-button <?php echo $cl_skin;?> float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1" data-toggle-tooltip="tooltip" data-placement="bottom" data-title="Sidebar" data-original-title="" title=""> <span class="more"></span> </div>

    </div>

    <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">



      <div class="collapse navbar-collapse" id="myNavbar">

      <div class="myNavbarleft">        
              <ul class="nav navbar-nav">
                <li class=""><a href="<?php echo base_url(); ?>dashboard">Home</a></li>

                <li class="dropdown">
                    <a href="<?php echo base_url(); ?>company" data-toggle="dropdown" class="dropdown-toggle"> Organization </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>company">All Projects</a></li>
                        <li><a href="<?php echo base_url(); ?>location">Project Location Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>area_code_shift">Shift Job/Area Code </a></li>
                        <li><a href="<?php echo base_url(); ?>district_setup">District Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>tehsil_setup">Tehsil Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>uc_setup">UC Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>Areas_setup">Areas Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>Sub_areas_setup">Sub Areas Setup</a></li>
                        <!-- <li><a href="<?php echo base_url(); ?>department">Add Departments to Project</a></li> -->  
                        <!-- <li><a href="<?php echo base_url(); ?>department">Department Setup</a></li> -->                 
                        <li><a href="<?php echo base_url(); ?>designation">Designation</a></li>
                        <li><a href="<?php echo base_url(); ?>announcement">Announcement</a></li>
                        <li><a href="<?php echo base_url(); ?>policy">Policies</a></li>
                        <li><a href="<?php echo base_url(); ?>expense">Expenses</a></li>
                         

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="<?php echo base_url(); ?>employees" data-toggle="dropdown" class="dropdown-toggle"> System Users </a>
                    <ul class="dropdown-menu">

                      <li><a href="<?php echo base_url(); ?>user_panel">User Panel</a></li>
                        <li><a href="<?php echo base_url(); ?>investigation/dashboard">Investigation</a></li>
                        <li><a href="<?php echo base_url(); ?>reports/employees">Reports</a></li>
                        <li><a href="<?php echo base_url(); ?>terminations/view">Terminations</a></li>
                        <li><a href="<?php echo base_url(); ?>resignations/view">Resignations</a></li>
                        <li><a href="<?php echo base_url(); ?>Employee_cards">Employee Cards</a></li>
                        <li><a href="<?php echo base_url(); ?>Field_joining">Field Joining</a></li>
                        <li><a href="<?php echo base_url(); ?>insurance/dashboard">Insurance</a></li>
                        <li><a href="<?php echo base_url(); ?>Pages">Pages</a></li>
                        <li><a href="<?php echo base_url(); ?>Groups">Roles/Groups</a></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="<?php echo base_url(); ?>job_post" data-toggle="dropdown" class="dropdown-toggle"> Recruitments </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>vacant_position">Vacant Positions</a></li>
                        <li><a href="<?php echo base_url(); ?>job_post">Posted Jobs</a></li>
                        <li><a href="<?php echo base_url(); ?>frontend/jobs/">Jobs WebSite</a></li>
                        
                        <li><a href="<?php echo base_url(); ?>trainings">Trainings</a></li>
                        <li class=""><a href="<?php echo base_url(); ?>tests">Test</a></li>                 
                         
                        <li class=""><a href="<?php echo base_url(); ?>interview">Interview</a></li>
                        <li class=""><a href="<?php echo base_url(); ?>contract">Contract</a></li>
                        
                    </ul>
                </li>          


                 
                <!-- <li><a href="<?php echo base_url(); ?>/settings">settings</a></li> -->
                <!--  <li><a href="#">leads</a></li>
                <li><a href="#">accounts</a></li> -->
                <!-- <li><a href="#">contacts</a></li> -->
                <!--<li><a href="#">deals</a></li>
                 <li><a href="#">deals</a></li>

                <li><a href="#">reports</a></li> -->
                <li><a href="<?php echo base_url(); ?>/logout">Logout</a></li>
                <li>
                  <a href="#">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                  </a>
                </li>
              </ul>
              <!-- <ul class="nav navbar-nav navbar-right">
                <li>
                  <a href="#">
                    <img src="assets/img/profile.png" alt="">
                    Hasseb Khattak
                    <span class="caret"></span>    
                  </a>
                </li>
              </ul> -->
            <!-- </div> -->

      </div>      
<div class="myNavbarright">

      <!-- <div class="toggle-button <?php echo $cl_skin;?> sidebar-toggle-second float-xs-left hidden-sm-down" data-toggle-tooltip="tooltip" data-placement="bottom" data-title="Sidebar" data-original-title="" title=""> <span class="hamburger"></span> </div> -->

      <ul class="nav navbar-nav float-md-right">
 
        <?php if($system[0]->enable_policy_link=='yes'):?>

        <!-- <li class="nav-item"> <a class="nav-link" href="#" data-toggle="modal" data-target=".policy"> <i class="fa fa-product-hunt"></i> <span class="hidden-md-up ml-1"><?php echo $this->lang->line('header_policies');?></span></a> </li> -->

        <?php endif;?>

        <?php if($user_info[0]->user_role_id==1) {?>

        <!-- <li class="nav-item dropdown"> <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false"> <i class="ti-bell"></i> <span class="hidden-md-up ml-1"><?php echo $this->lang->line('header_notifications');?></span> </a>

          <div class="dropdown-messages dropdown-tasks dropdown-menu dropdown-menu-right animated <?php echo $system[0]->animation_effect_topmenu;?>">

            <?php foreach($this->Xin_model->get_last_leave_applications() as $leave_notify){?>

            <?php $employee_info = $this->Xin_model->read_user_info($leave_notify->employee_id);?>

            <?php

				if(!is_null($employee_info)){

					$emp_name = $employee_info[0]->first_name. ' '.$employee_info[0]->last_name;

				} else {

					$emp_name = '--';	

				}

			?>

            <?php //$el_type = $this->Xin_model->read_leave_type($leave_notify->leave_type_id);?>

            <div class="m-item">

              <div class="mi-icon bg-info"><i class="ti-comment"></i></div>

              <div class="mi-text"><a class="text-black" href="<?php echo site_url()?>timesheet/leave_details/id/<?php echo $leave_notify->leave_id;?>/"><?php echo $emp_name;?></a> <span class="text-muted"><?php echo $this->lang->line('header_has_applied_for_leave');?></span></div>

              <div class="mi-time"><?php echo $this->Xin_model->set_date_format($leave_notify->applied_on);?></div>

            </div>

            <?php } ?>

            <a class="dropdown-more" href="<?php echo site_url()?>timesheet/leave/"> <strong><?php echo $this->lang->line('header_view_all_leave');?></strong> </a> </div>

        </li> -->

        <?php } ?>

        <?php if(in_array('53',$role_resources_ids) || in_array('54',$role_resources_ids) || in_array('55',$role_resources_ids) || in_array('56',$role_resources_ids)){?>

       <!--  <li class="nav-item dropdown"> <a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false" data-placement="bottom"> <i class="ti-settings"></i> <span class="hidden-md-up ml-1"><?php echo $this->lang->line('left_settings');?></span> </a>

          <div class="dropdown-menu dropdown-menu-right animated <?php echo $system[0]->animation_effect_topmenu;?>">

            <?php if(in_array('53',$role_resources_ids)){?>

            <a class="dropdown-item" href="<?php echo site_url()?>settings/"> <?php echo $this->lang->line('header_configuration');?> </a>

            <?php } ?>

            <?php if(in_array('54',$role_resources_ids)){?>

            <a class="dropdown-item" href="<?php echo site_url()?>settings/constants/"> <?php echo $this->lang->line('left_constants');?> </a>

            <?php } ?>

            <?php if(in_array('55',$role_resources_ids)){?>

            <a class="dropdown-item" href="<?php echo site_url()?>settings/email_template/"> <?php echo $this->lang->line('left_email_templates');?> </a>

            <?php } ?>

            <?php if(in_array('56',$role_resources_ids)){?>

            <a class="dropdown-item" href="<?php echo site_url()?>settings/database_backup/"> <?php echo $this->lang->line('header_db_log');?> </a>

            <?php } ?>

          </div>

        </li> -->

        <?php } ?>

        

        <li class="nav-item dropdown hidden-sm-down">

            <a href="#" data-toggle="dropdown" aria-expanded="false">

                <span class="avatar box-32">

                    <?php  if($user_info[0]->profile_picture!='' && $user_info[0]->profile_picture!='no file') {?>

                    <img src="<?php  echo base_url().'uploads/profile/'.$user_info[0]->profile_picture;?>" alt="" id="user_avatar" 

                    class="b-a-radius-circle user_profile_avatar">

                    <?php } else {?>

                    <?php  //if($user_info[0]->gender=='Male') { ?>

                    <?php 	$de_file = base_url().'uploads/profile/default_male.jpg';?>

                    <?php //} else { ?>

                    <?php 	//$de_file = base_url().'uploads/profile/default_female.jpg';?>

                    <?php //} ?>

                    <img src="<?php  echo $de_file;?>" alt="" id="user_avatar" class=" b-a-radius-circle user_profile_avatar">

                    <?php  } ?>

                </span>

            </a>

            <div class="dropdown-menu dropdown-menu-right animated <?php echo $system[0]->animation_effect_topmenu;?>">

                <a class="dropdown-item" href="<?php echo site_url()?>profile/">

                    <i class="ti-user mr-0-5"></i> <?php echo $this->lang->line('header_my_profile');?>

                </a>

                <?php if(in_array('53',$role_resources_ids)){?>

                <a class="dropdown-item" href="<?php echo site_url()?>settings/">

                    <i class="ti-settings mr-0-5"></i> <?php echo $this->lang->line('left_settings');?>

                </a>

                <?php  } ?>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target=".pro_change_password" data-profile_id="<?php echo $session['user_id'];?>"><i class="fa fa-key mr-0-5"></i> <?php echo $this->lang->line('header_change_password');?></a>

                <a class="dropdown-item" href="<?php echo site_url()?>logout/"><i class="ti-power-off mr-0-5"></i> <?php echo $this->lang->line('header_sign_out');?></a>

            </div>

        </li>

      </ul>

      <ul class="nav navbar-nav">

        <li class="nav-item hidden-sm-down"> <a class="nav-link toggle-fullscreen" href="#"> <i class="ti-fullscreen"></i> </a> </li>

       

        <?php /*if($system[0]->enable_job_application_candidates=='yes'){?>

        <li class="nav-item hidden-sm-down"> <a href="<?php echo site_url();?>frontend/jobs/" target="_blank">

          <button type="button" class="btn btn-outline-success w-min-sm mb-0-25 waves-effect waves-light" style="background:#43b968; color:#fff;"><?php echo $this->lang->line('header_apply_jobs');?></button>

          </a> </li>

        <?php }*/ ?>

        <?php if($user_info[0]->user_role_id!=1) {?>

        <?php if($system[0]->enable_attendance == 'yes' && $system[0]->enable_clock_in_btn=='yes'){?>

        <li class="nav-item hidden-sm-down clock-in-btn">

          <form name="set_clocking" id="set_clocking_hd" method="post">

            <input type="hidden" name="timeshseet" value="<?php echo $user_info[0]->user_id;?>">

            <?php $attendances = $this->Xin_model->attendance_time_checks($session['user_id']); $dat = $attendances->result();?>

            <?php if($attendances->num_rows() < 1) {?>

            <input type="hidden" value="clock_in" name="clock_state" id="clock_state">

            <input type="hidden" value="" name="time_id" id="time_id">

            <button class="btn btn-success text-uppercase w-min-sm mb-0-25 waves-effect waves-light" type="submit"><i class="fa fa-arrow-circle-right"></i> <?php echo $this->lang->line('dashboard_clock_in');?></button>

            <?php } else {?>

            <input type="hidden" value="clock_out" name="clock_state" id="clock_state">

            <input type="hidden" value="<?php echo $dat[0]->time_attendance_id;?>" name="time_id" id="time_id">

            <button class="btn btn-warning text-uppercase w-min-sm mb-0-25 waves-effect waves-light" type="submit"><i class="fa fa-arrow-circle-left"></i> <?php echo $this->lang->line('dashboard_clock_out');?></button>

            <?php } ?>

          </form>

        </li>

        <?php } ?>

        <?php } ?>

        

      </ul>
  </div>
</div>
    </div>

  </nav>

</div>

<div class="modal fade pro_change_password animated <?php echo $system[0]->animation_effect_modal;?>" id="pro_change_password" tabindex="-1" role="dialog" aria-labelledby="pro_change_password" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content" id="change_password_modal"></div>

  </div>

</div>

<div class="modal fade policy animated <?php echo $system[0]->animation_effect_modal;?>" id="policy" tabindex="-1" role="dialog" aria-labelledby="policy" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content" id="policy_modal"></div>

  </div>

</div>