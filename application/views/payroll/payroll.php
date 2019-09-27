<?php
//echo 'ddddddddddddddd';
/* Job List/Post view

*/


?>

<?php $session = $this->session->userdata('username');
      //$session = $this->session->userdata('accessLevel');
?>
<?php 

$message = $this->session->flashdata('message');

if ($message) {
                  echo $message = '<div class="alert alert-success text-center"><strong>Success!</strong>'.$message.'</div>';
}

?>

<style type="text/css">

.hide-calendar .ui-datepicker-calendar { display:none !important; }

.hide-calendar .ui-priority-secondary { display:none !important; }

</style>

<div class="box box-block bg-white">

  <!-- <h2><strong><?php echo $this->lang->line('xin_list_all');?></strong> <?php echo $this->lang->line('xin_jobs');?>

    <div class="add-record-btn">

      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> <?php echo $this->lang->line('xin_add_new');?></button>

    </div>

  </h2> -->
<?php 
//$user_info = $this->Xin_model->read_user_info($session['user_id']);
//$role_user = $this->Xin_model->read_user_role_info($user_info[0]->user_role_id);

// $jobdetails = $this->Job_longlisted_model->getJobPosted();

    //$this->load->model("Designation_model");

   // $this->load->model("Job_post_model");

   //$this->Job_post_model->all_job_types();


//echo $session['department_id'];
//$accessLevel = $this->session->userdata("accessLevel");
//echo $session['department_id'];

  $sl1 = $this->session->userdata('accessLevel'); //echo $sl1['accessLevel1'];
  $sl2 = $this->session->userdata('accessLevel'); //echo $sl2['accessLevel2'];
  $sl3 = $this->session->userdata('accessLevel'); //echo $sl3['accessLevel3'];

/*
 echo  $session['project_id'];
 echo  $session['provience_id'];
 echo  $session['department_id'];
*/

?>

<?php if($sl1['accessLevel2']) { 
        // if($session['department_id']==3 || $session['department_id']==6){ 
 ?>
 
<div class="box box-block bg-white">
<br>
<div class="col-md-12">
<div class="row">
<form action="<?php echo base_url(); ?>payroll" method="post" name="set_salary_details">
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
                    <option value="">Select Province</option>
                    <?php
                    foreach ($geProvinces as $key => $element) {
                        echo '<option value="'.$element['province_id'].'">'.$element['province_name'].'</option>';
                    }
                    ?>
                </select>
            </div>
  </div> 

  <div class="col-md-3">

    <div class="form-group">
    <label for="month_year"><?php echo $this->lang->line('xin_select_month');?></label>
      <input class="form-control month_year" placeholder="<?php echo $this->lang->line('xin_select_month');?>" readonly id="month_year" name="month_year" type="text" value="<?php echo date('Y-m');?>">

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

<?php }else{

 //} 
//if($sl1['accessLevel2']) { 
        // if($session['department_id']==3 || $session['department_id']==6){ 
 ?>
 
<div class="box box-block bg-white">
<br>
<div class="col-md-12">
<div class="row">
<form action="<?php echo base_url(); ?>payroll" method="post" name="set_salary_details">
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
 <!--  <div class="col-md-3">
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
  </div>  -->

  <div class="col-md-3">

    <div class="form-group">
    <label for="month_year"><?php echo $this->lang->line('xin_select_month');?></label>
      <input class="form-control month_year" placeholder="<?php echo $this->lang->line('xin_select_month');?>" readonly id="month_year" name="month_year" type="text" value="<?php echo date('Y-m');?>">

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

<?php } ?>

<div class="box box-block bg-white">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" /> 
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
 -->

<?php 

echo ($this->session->flashdata('msg')) ? '<div class="alert alert-success text-center"><strong>Success!</strong> '.$this->session->flashdata('msg').' </div>' : '';

?>



<script type="text/javascript">
  $(document).ready(function() {
    $('#job_avail_position').DataTable();
} );
</script>
<style type="text/css"> .no-padding{ padding: 0px !important; } .allowance-tabl{ width: 100%; } .allowance-tabl td{ border: 1px solid #ddd !important; } </style>

<?php if($payrollempName){?>
<form action="<?php echo base_url(); ?>payroll/add_employee_payroll" method="post" name="employee_payroll">
 <div class="col-md-9"></div>
 <div class="col-md-3 text-right">
    <div class="form-group" style="margin-top: 8%;">
      <button type="submit" class="btn btn-primary save">Save Payroll</button>
    </div>
  </div> 

<div class="table-responsive">
    <table id="job_avail_position0" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Employee Name</th>
                <th>Project</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Location</th>
                <th>Basic Salary</th>
                <th>Allowances</th>
                <th>Deductions</th>
                <th>Net Salary</th>
                
                <!-- <th>Tehsil</th>
                <th>UC</th>
                <th>Area</th>
                <th>Sub.Area</th>
                <th>No.Positions</th>
                <th>Job Code</th>
                <th>To Be Vacant Position</th>
                <th>Status</th> -->
                <th>Date</th>
                 
                
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php //echo $i; ?></td>   
                <td><?php  //echo $empdetail->first_name; ?></td>
                <td><?php //echo $proj_name;?></td>
                <td><?php //echo $designation_name;?></td>
                <td><?php //echo $department_name;?></td>
                <td><?php //echo $district_name;?></td>
                <td><?php //echo $province_name; ?></td>
                <td class="no-padding"><table class="allowance-tabl"><tr><td>H.Rent</td><td>Medical</td><td>Travel</td></tr></table></td>
                <td class="no-padding"><table class="allowance-tabl"><tr><td>EOBI</td><td>Pro.Fund</td><td>Tax</td></tr></table></td>
                <td><?php //echo $district_name; ?></td>
                <td><?php //echo $location_detail->sdt; ?></td>
            </tr>

<?php 

  $TbasicSalary = array();
  $Tallowance = array();
  $Tdeduction = array();
  $TnetSallery = array();
  $TAllwnc=0;
  $basic_salary=0;
  $Tdeductn=0;
  $netSallery=0;
 
    $location_detail=0;
    $i = 0;
    foreach($payrollempName as $empdetail){  // echo $location_detail->company_id;
      $i++;
     




    $check_user_month = $this->Payroll_model->get_user_payroll($empdetail->employee_id,$dat=date('Y-m-d'));
          /*if($check_user_month){ 
                if(is_null($check_user_month)){
                          $availableSallery = "yah";
                      echo    '(--hahahha--)<br>';
                           
                } else {
                         //echo '(----emp not exist-----)<br>'; // $designation_name = '--';
                }
          }*/ //else{ $check_user_month = '--'; }  


     if (is_null($check_user_month)) {
        


    $designation = $this->Designation_model->read_designation_information($empdetail->designation_id);
          if($designation){ 
                if(!is_null($designation)){
                          $designation_name = $designation[0]->designation_name;
                          $designation_id = $designation[0]->designation_id;
                } else {
                          $designation_name = '--';
                }
          }else{ $designation_name = '--'; }  


    $department = $this->Department_model->read_department_information($empdetail->department_id);
          if($department){ 
                    if(!is_null($department)){
                              $department_name = $department[0]->department_name;
                              $department_id = $department[0]->department_id;
                    } else {
                              $department_name = '--';
                    }
          }else{ $department_name = '--'; }  

    $all_projects = $this->Company_model->read_company_information($empdetail->company_id);
          if($all_projects){ 
                    if(!is_null($all_projects)){
                              $proj_name = $all_projects[0]->name;
                    } else {
                              $proj_name = '--';
                    }
           }else{ $proj_name = '--'; }    

     /*$province_data = $this->ProvinceCity->read_province_information($location_detail->province_id);
          if($province_data){ 
                    if(!is_null($province_data)){
                              $province_name = $province_data[0]->name;
                    } else {
                              $province_name = '--';
                    }   
          }else{ $province_name = '--'; }    */   
        
     $district_data = $this->ProvinceCity->read_district_information($empdetail->district_id=10);
        if($district_data){ 
            if(!is_null($district_data)){
                      $district_name = $district_data[0]->name;
            } else {
                      $district_name = '--';
            } 
        }else{ $district_name = '--'; }    


        $emp_salary = $this->Employees_model->read_employee_salary($empdetail->employee_id);
          if($emp_salary){ 
                    if(!is_null($emp_salary)){
                              $basic_salary = $emp_salary[0]->basic_salary;
                    } else {
                              $basic_salary = '0';
                    }
           }else{ $basic_salary = '0'; } 


       $emp_allowances = $this->Employees_model->read_employee_allowances($empdetail->employee_id);
          if($emp_allowances){ 
                    if(!is_null($emp_allowances)){
                              $house_rent_allowance = $emp_allowances[0]->house_rent_allowance;
                              $medical_allowance = $emp_allowances[0]->medical_allowance;
                              $travelling_allowance = $emp_allowances[0]->travelling_allowance;
                    } else {
                              $house_rent_allowance = '0';
                              $medical_allowance = '0';
                              $travelling_allowance = '0';
                    }
           }else{ $house_rent_allowance = '0';
                              $medical_allowance = '0';
                              $travelling_allowance = '0'; }   
           

      $deductions = $this->Employees_model->read_employee_deductions($empdetail->employee_id);
          if($deductions){ 
                    if(!is_null($deductions)){
                              $eobi = $deductions[0]->eobi;
                              $provident_fund = $deductions[0]->provident_fund;
                              $tax_deduction = $deductions[0]->tax_deduction;
                    } else {
                              $eobi = '0';
                              $provident_fund = '0';
                              $tax_deduction = '0';
                    }
           }else{ $eobi = '0';
                              $provident_fund = '0';
                              $tax_deduction = '0'; }              
          
     /* $tehsil_data = $this->ProvinceCity->read_tehsil_information($location_detail->tehsil_id);
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
          }else{ $sub_area_name = '--'; } */ 

            ?>
     

            <tr>
                <td><?php echo $i; ?></td>   
                <td><?php  echo $empdetail->first_name.''.$empdetail->last_name; ?></td>
                <td><?php echo $proj_name;?></td>
                <td><?php echo $designation_name;?></td>
                <td><?php echo $department_name;?></td>
                <td><?php echo $district_name;?></td>
                <td>Rs <?php echo $basic_salary;  
                                 $TbasicSalary[] = $basic_salary; ?></td>
                <td class="no-padding"><table class="allowance-tabl"><tr>
                  <td><?php echo $house_rent_allowance; ?></td>
                  <td><?php echo $medical_allowance; ?></td>
                  <td><?php echo $travelling_allowance; 
                                 $TAllwnc = $house_rent_allowance+$medical_allowance+$travelling_allowance;
                                 $Tallowance[] = $house_rent_allowance+$medical_allowance+$travelling_allowance;  ?></td></tr></table>
                </td>
                <td class="no-padding"><table class="allowance-tabl"><tr>
                  <td><?php echo $eobi; ?></td>
                  <td><?php echo $provident_fund; ?></td>
                  <td><?php echo $tax_deduction;  
                                $Tdeductn = $eobi+$provident_fund+$tax_deduction;
                                $Tdeduction[] = $eobi+$provident_fund+$tax_deduction; ?></td></tr></table>
                </td>
                <td>Rs <?php echo $netSallery = ($basic_salary+$TAllwnc)-($Tdeductn);
                                  $TnetSallery[] = ($basic_salary+$TAllwnc)-($Tdeductn); ?></td>
                <td><?php echo date('Y-m-d'); ?></td>

</tr>

<input type="hidden" name="user_id[]" value="<?php echo $empdetail->employee_id; ?>">
<input type="hidden" name="basic_salary[]" value="<?php echo $basic_salary; ?>">
<input type="hidden" name="total_allowance[]" value="<?php echo $TAllwnc; ?>">
<input type="hidden" name="total_deduction[]" value="<?php echo $Tdeductn; ?>">
<input type="hidden" name="net_salary[]" value="<?php echo $netSallery; ?>">
<input type="hidden" name="created_by[]" value="1<?php //echo $user; ?>">
            
            <?php  } } ?>

<tr>
                <td><?php //echo $i; ?></td>   
                <td><?php  //echo $empdetail->first_name; ?></td>
                <td><?php //echo $proj_name;?></td>
                <td><?php //echo $designation_name;?></td>
                <td><?php //echo $department_name;?></td>
                <td><?php //echo $district_name;?></td>
                <td>Rs <?php echo array_sum($TbasicSalary); ?></td>
                <td>Rs <?php echo array_sum($Tallowance); ?></td>
                <td>Rs <?php echo array_sum($Tdeduction); ?></td>
                <td>Rs <?php echo array_sum($TnetSallery); ?></td>
                <td> <?php //echo $district_name; ?></td>
                 

</tr>

        </tbody>
      </table>
    </div>
  </form>

  <?php }else{ echo '<div class="alert alert-warning text-center"><strong>Warning!</strong> No Records Found</div>'; } ?>

 </div> 

</div>

  

<script type="text/javascript">

$(document).ready(function(){

  toastr.options.closeButton = false;

  toastr.options.progressBar = true;

  toastr.options.timeOut = 3000;

  toastr.options.preventDuplicates = true;

  toastr.options.positionClass = "toast-top-center";

  $(".add-new-form").click(function(){

    $(".add-form").slideToggle('slow');

  });



  $('.date').datepicker({

  changeMonth: true,

  changeYear: true,

  dateFormat:'yy-mm-dd',

  yearRange: '1900:' + (new Date().getFullYear() + 15),

  beforeShow: function(input) {

    $(input).datepicker("widget").show();

  }

  });

}); 

</script> 

<style type="text/css">



</style>


<!-- <script type="text/javascript">var user_role = '1';</script>

<script type="text/javascript">var js_date_format = 'dd-M-yy';</script> 

<script type="text/javascript">var site_url = 'http://localhost/submarine/';</script> 
 -->
<!-- <script type="text/javascript">var base_url = 'http://localhost/submarine/payroll';</script> 
 -->
<script type="text/javascript" src="http://localhost/submarine/skin/js_module/generate_payslip.js"></script>
 
