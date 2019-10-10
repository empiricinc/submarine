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



<!-- <script type="text/javascript">
  $(document).ready(function() {
    $('#job_avail_position').DataTable();
} );
</script> -->

<!-- <style type="text/css"> .no-padding{ padding: 0px !important; } .allowance-tabl{ width: 100%; } .allowance-tabl td{ border: 0px solid #ddd !important; } </style> -->





<?php require_once('dtui.php'); ?>










<?php if($payrollempName){?>

 

<form action="<?php echo base_url(); ?>payroll/add_employee_payroll" method="post" name="employee_payroll">
 <div class="col-md-9"></div>
 <div class="col-md-3">
    <div class="form-group" style="">
      <button type="submit" class="btn btn-primary save" style="position: absolute; top:15px">Save Payroll</button>
    </div>
  </div> 

<div class="table-responsive">
    <!-- <table id="job_avail_position0" class="table table-striped table-bordered" style="width:100%"> -->
      <table id="ejemplo" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Employee Name</th>
                <th>Project</th>
                <th>Province</th>
                <th>Designation</th>
                <th>Department</th>
                
                <th>Basic Salary</th>
                <!-- <th>Allowances</th> -->
                <th>H.Rent</th><th>Medical Allowance</th><th>Travel Allowance</th>
                  <!-- </tr></table></th> -->
                <!-- <th class="no-padding"><table class="allowance-tabl"><tr> -->
                <th>EOBI</th><th>Pro.Fund</th><th>Tax</th>
                <!-- <th>Deductions</th> -->
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
            

<?php 

 $thelocation = $this->input->post('province_id');

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

     $province_data = $this->ProvinceCity->read_province_information($thelocation);
          if($province_data){ 
                    if(!is_null($province_data)){
                              $province_name = $province_data[0]->name;
                    } else {
                              $province_name = '--';
                    }   
          }else{ $province_name = '--'; }       
        
     /*$district_data = $this->ProvinceCity->read_district_information($empdetail->district_id=10);
        if($district_data){ 
            if(!is_null($district_data)){
                      $district_name = $district_data[0]->name;
            } else {
                      $district_name = '--';
            } 
        }else{ $district_name = '--'; } */   


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
          
      

            ?>
     

            <tr>
                <td><?php echo $i; ?></td>   
                <td><?php  echo $empdetail->first_name.''.$empdetail->last_name; ?></td>
                <td><?php echo $proj_name;?></td>
                <td><?php echo $province_name;?></td>
                <td><?php echo $designation_name;?></td>
                <td><?php echo $department_name;?></td>
                
                <td>Rs <?php echo $basic_salary;  
                                 $TbasicSalary[] = $basic_salary; ?></td>
                <!-- <td class="no-padding"><table class="allowance-tabl"><tr> -->
                  <td><?php echo $house_rent_allowance; ?></td>
                  <td><?php echo $medical_allowance; ?></td>
                  <td><?php echo $travelling_allowance; 
                                 $TAllwnc = $house_rent_allowance+$medical_allowance+$travelling_allowance;
                                 $Tallowance[] = $house_rent_allowance+$medical_allowance+$travelling_allowance;

                                /* $total_house_rent_allowance[]=$house_rent_allowance;
                                 $total_medical_allowance[]=$medical_allowance;
                                 $total_travelling_allowance[]=$travelling_allowance;*/ 

                                  ?></td><!-- </tr></table> -->
                </td>
                <!-- <td class="no-padding"><table class="allowance-tabl"><tr> -->
                  <td><?php echo $eobi; ?></td>
                  <td><?php echo $provident_fund; ?></td>
                  <td><?php echo $tax_deduction;  
                                $Tdeductn = $eobi+$provident_fund+$tax_deduction;
                                $Tdeduction[] = $eobi+$provident_fund+$tax_deduction; 
                               /* $Teobi[]=$eobi;
                                $Tprovident_fund[]=$provident_fund;
                                $Ttax_deduction[]=$tax_deduction;*/

                                ?></td><!-- </tr></table> -->
                </td>
                <td>Rs <?php echo $netSallery = ($basic_salary+$TAllwnc)-($Tdeductn);
                                  $TnetSallery[] = ($basic_salary+$TAllwnc)-($Tdeductn); ?></td>
                <td><?php echo date('Y-m-d'); ?>
                  
<input type="hidden" name="employee_id[]" value="<?php echo $empdetail->employee_id; ?>">
<input type="hidden" name="basic_salary[]" value="<?php echo $basic_salary; ?>">
<input type="hidden" name="total_allowances[]" value="<?php echo $TAllwnc; ?>">

<input type="hidden" name="company_id[]" value="<?php echo $empdetail->company_id; ?>">
<input type="hidden" name="department_id[]" value="<?php echo $empdetail->department_id; ?>">
<input type="hidden" name="designation_id[]" value="<?php echo $empdetail->designation_id; ?>">
<input type="hidden" name="location_id[]" value="<?php echo $thelocation; ?>">

<input type="hidden" name="house_rent_allowance[]" value="<?php echo $house_rent_allowance; ?>">
<input type="hidden" name="medical_allowance[]" value="<?php echo $medical_allowance; ?>">
<input type="hidden" name="travelling_allowance[]" value="<?php echo $travelling_allowance; ?>">

<input type="hidden" name="total_deductions[]" value="<?php echo $Tdeductn; ?>">

<input type="hidden" name="eobi[]" value="<?php echo $eobi; ?>">
<input type="hidden" name="provident_fund[]" value="<?php echo $provident_fund; ?>">
<input type="hidden" name="tax_deduction[]" value="<?php echo $tax_deduction; ?>">

<input type="hidden" name="net_salary[]" value="<?php echo $netSallery; ?>">
<input type="hidden" name="created_by[]" value="<?php echo $session['employee_id']; ?>">

                </td>

</tr>


            
            <?php  } } ?>

<!-- <tr>
                <td><?php //echo $i; ?></td>   
                <td><?php  //echo $empdetail->first_name; ?></td>
                <td><?php //echo $proj_name;?></td>
                <td><?php //echo $designation_name;?></td>
                <td><?php //echo $department_name;?></td>
                <td><?php //echo $district_name;?>Total</td>
                <td>Rs <?php echo array_sum($TbasicSalary); ?></td>
                <td>Rs <?php echo array_sum($Tallowance); ?></td>
                <td>Rs <?php echo array_sum($Tdeduction); ?></td>
                <td>Rs <?php echo array_sum($TnetSallery); ?></td>
                <td> <?php //echo $district_name; ?></td>
                 

</tr> -->

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
 
