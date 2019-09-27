<?php

$session = $this->session->userdata('username');

$system = $this->Xin_model->read_setting_info(1);

$user_info = $this->Xin_model->read_user_info($session['user_id']);



//$dept_info = $this->Department_model->all_department_info();

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


  //echo $RollNumber['RollNumber'];


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


 
//echo $accessLevel5; exit();



$deptLevel1 = 1; //Trainings
$deptLevel2 = 2; //Finance
$deptLevel3 = 3; // Admin - Administrations 
$deptLevel4 = 4; //Operations
$deptLevel5 = 5; //HR
$deptLevel6 = 6; //Payroll
$deptLevel7 = 7; //Test/Exam
$deptLevel8 = 8; //Legal
$deptLevel9 = 9; //Insurance
$deptLevel10 = 10; //Card Management
$deptLevel11 = 11; //Contracts

 

$deptLevel = array('deptLevel1' => $deptLevel1, 'deptLevel2' => $deptLevel2, 'deptLevel3' => $deptLevel3, 'deptLevel4' => $deptLevel4, 'deptLevel5' => $deptLevel5, 'deptLevel6' => $deptLevel6, 'deptLevel7' => $deptLevel7, 'deptLevel8' => $deptLevel8, 'deptLevel9' => $deptLevel9, 'deptLevel10' => $deptLevel10, 'deptLevel11' => $deptLevel11);
$this->session->set_userdata('deptLevel', $deptLevel);


//var_dump($deptLevel);

/*$accessLevel = $this->session->userdata("accessLevel");
echo $accessLevel['accessLevel3'];
*/
//echo $accessLevel['accessLevel3'];

//($session['department_id']==6) ? $DeptAccessLevel3=true : $DeptAccessLevel3=false;

//echo $DeptAccessLevel3;

 

if($system[0]->system_skin=='skin-6'){

	$cl_skin = 'dark';

}

?>

<?php $site_lang = $this->load->helper('language');?>

<?php $wz_lang = $site_lang->session->userdata('site_lang');?>

<?php if($accessLevel3) { ?>
 

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

<?php if($accessLevel2) { ?>
                 
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Organization </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>company">All Projects</a></li>
                        <li><a href="<?php echo base_url(); ?>location">Setup / Add Location to Project</a></li>
                        <li><a href="<?php echo base_url(); ?>district_setup">District Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>tehsil_setup">Tehsil Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>uc_setup">UC Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>Areas_setup">Areas Setup</a></li>
                        <li><a href="<?php echo base_url(); ?>Sub_areas_setup">Sub Areas Setup</a></li>
                        <!-- <li><a href="<?php echo base_url(); ?>department">Add Departments to Project</a></li> -->  
                        <!-- <li><a href="<?php echo base_url(); ?>department">Department Setup</a></li> -->                 
                        <li><a href="<?php echo base_url(); ?>designation">Designation</a></li>
                        <li><a href="<?php echo base_url(); ?>Employees">Employees</a></li>

                    </ul>
                </li>
                <!-- <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Employees Management </a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url(); ?>Employees">Employees</a></li>
                       
                    </ul>
                </li> -->
<?php }?>

<?php if($accessLevel3) { if($session['department_id']==$deptLevel6 || $session['department_id']==$deptLevel3){ 
 ?>

                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Payroll </a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url(); ?>payroll">Payroll</a></li>
                      <li><a href="<?php echo base_url(); ?>payroll/payment_sheet">Payment Sheet</a></li> 
                    </ul>
                </li>

<?php } } ?>

<?php if($accessLevel3) { if($session['department_id']==$deptLevel5 || $session['department_id']==$deptLevel3){ 


  ?>

                <!-- <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> User Panel </a>
                    <ul class="dropdown-menu">
                       
                      <li><a href="<?php echo base_url(); ?>user_panel">User Panel</a></li>
                      <li><a href="<?php echo base_url(); ?>investigation">Investigation</a></li>
                      <li><a href="<?php echo base_url(); ?>reports/employees">Reports</a></li>
                      <li><a href="<?php echo base_url(); ?>terminations/view">Terminations</a></li>
                      <li><a href="<?php echo base_url(); ?>resignations/view">Resignations</a></li>
                    </ul>
                </li> -->

<?php } } ?>


<?php if($accessLevel2) { if($session['department_id']==$deptLevel5 || $session['department_id']==$deptLevel3){ 


  ?>

                

                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> HR</a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url(); ?>Field_joining">Field Joining</a></li>
                       <li><a href="<?php echo base_url(); ?>terminations/view">Terminations</a></li>
                      <li><a href="<?php echo base_url(); ?>resignations/view">Resignations</a></li>
                      <li><a href="<?php echo base_url(); ?>investigation">Investigation</a></li>
                      <li><a href="<?php echo base_url(); ?>reports/employees">Reports</a></li>
                    </ul>
                </li>


<?php } } ?>


<?php if($accessLevel3) { if($session['department_id']==$deptLevel5 || $session['department_id']==$deptLevel3){ 
 ?>

                <li class="dropdown">
                    <a href="<?php echo base_url(); ?>job_post" data-toggle="dropdown" class="dropdown-toggle"> Recruitments </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>vacant_position">Vacant Positions</a></li>
                        <li><a href="<?php echo base_url(); ?>job_post">Posted Jobs</a></li>
                        <li><a href="<?php echo base_url(); ?>frontend/jobs/">Jobs WebSite</a></li>                   
                        <li class=""><a href="<?php echo base_url(); ?>interview">Interview</a></li>

                        
                    </ul>
                </li> 

<?php } } ?>


<?php if($accessLevel3) { if($session['department_id']==$deptLevel7 || $session['department_id']==$deptLevel3){ ?>
<li class="dropdown">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Test</a>
    <ul class="dropdown-menu">
        <li class=""><a href="<?php echo base_url(); ?>tests">Test</a></li> 
    </ul>
</li>
<?php } } ?>

<?php if($accessLevel3) { if($session['department_id']==$deptLevel1 || $session['department_id']==$deptLevel3){ ?>
<li class="dropdown">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Trainings</a>
    <ul class="dropdown-menu">
        <li><a href="<?php echo base_url(); ?>trainings">Trainings</a></li> 
    </ul>
</li>
<?php } } ?>
 
<?php if($accessLevel3) { if($session['department_id']==$deptLevel11 || $session['department_id']==$deptLevel3){ ?>
<li class="dropdown">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Contract</a>
    <ul class="dropdown-menu">
        <li class=""><a href="<?php echo base_url(); ?>contract">Contract</a></li>
        <li class=""><a href="<?php echo base_url(); ?>contract/offer_letters">Offer Letters</a></li>
    </ul>
</li>
<?php } } ?>


<?php if($accessLevel3) { if($session['department_id']==$deptLevel10 || $session['department_id']==$deptLevel3){ ?>
<li class="dropdown">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Card Management</a>
    <ul class="dropdown-menu">
        <li><a href="<?php echo base_url(); ?>Employee_cards">Employee Cards</a></li>
        <!-- <li><a href="<?php echo base_url(); ?>performance_evaluation/tcsp_evaluation">TCSP evaluation</a></li> -->
    </ul>
</li>
<?php } } ?>



<?php if($accessLevel3) { if($session['department_id']==$deptLevel9 || $session['department_id']==$deptLevel3){ ?>
<li class="dropdown">
    <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Insurance</a>
    <ul class="dropdown-menu">
        <li><a href="<?php echo base_url(); ?>Insurance/dashboard">Insurance</a></li>
    </ul>
</li>
<?php } } ?>


            <!-- <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle"> Employee Dashboard </a>
                <ul class="dropdown-menu">
                   
                  <li><a href="<?php echo base_url(); ?>user_panel">User Panel</a></li>
                   
                </ul>
            </li> -->
                 
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
  
        <li><a href=""><?php echo $session['username']; ?></a></li>

        <li class="nav-item dropdown hidden-sm-down">
          
         <a href="<?php echo base_url(); ?>user_panel" >

                        <span class="avatar box-32">

                            <?php  if($user_info[0]->profile_picture!='' && $user_info[0]->profile_picture!='no file') {?>

                            <img src="<?php  echo base_url().'uploads/profile/'.$user_info[0]->profile_picture;?>" alt="" id="user_avatar" 

                            class="b-a-radius-circle user_profile_avatar">

                            <?php } else {?>

                            <?php  //if($user_info[0]->gender=='Male') { ?>

                            <?php   $de_file = base_url().'uploads/profile/default_male.jpg';?>

                            <?php //} else { ?>

                            <?php   //$de_file = base_url().'uploads/profile/default_female.jpg';?>

                            <?php //} ?>

                            <img src="<?php  echo $de_file;?>" alt="" id="user_avatar" class=" b-a-radius-circle user_profile_avatar">

                            <?php  } ?>

                        </span>

                    </a>
           <!--  <a href="#" data-toggle="dropdown" aria-expanded="false">

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

            </a> -->

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