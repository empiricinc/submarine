<?php $session = $this->session->userdata('username');?>
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

// $jobdetails = $this->Job_longlisted_model->getJobPosted();

    //$this->load->model("Designation_model");

   // $this->load->model("Job_post_model");

   //$this->Job_post_model->all_job_types();
 // $sl1 = $this->session->userdata('accessLevel'); //echo $sl1['accessLevel1'];
 // $sl2 = $this->session->userdata('accessLevel'); //echo $sl2['accessLevel2'];
 // $sl3 = $this->session->userdata('accessLevel'); //echo $sl3['accessLevel3'];



?>


 
<div class="box box-block bg-white">
<!-- <ul class="nav nav-tabs">
      <li class="active">
        <a  href="<?php echo base_url(); ?>job_post" >All Posted Jobs</a>
      </li> 
      <li class="">
        <a href="<?php echo base_url(); ?>vacant_position" >Vacant Position</a>
      </li>
       
</ul> -->
<br>
<div class="col-md-12">
<div class="row">
<form action="<?php echo base_url(); ?>payroll/payment_sheet" method="post" name="set_salary_details">
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



<div class="box box-block bg-white">

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
 

<div class="table-responsive">
    <table id="job_avail_position" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Project</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Location</th>
                <th>Basic Salary</th>
                <th>Allowances</th>
                <th>Deductions</th>
                <th>Net Salary</th>
                <th>Date</th>
                <th>Action</th> 
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
    foreach($payrollempName as $empdetail){   
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
                <td><a class="text-success" href="<?php echo base_url(); ?>payroll/pdf_create/sl/<?php echo $empdetail->employee_id; ?>/">Payslip</a></td>

</tr>

       
            <?php  } } ?>



        </tbody>
      </table>

<table id="job_avail_position" class="table table-striped table-bordered" style="width:100%">

<tbody>
  <tr>
                <th>Project Name:</th>  
                <td><?php //echo ($proj_name) ? $proj_name : '--'; ?></td>
                <th>Total Basic Salaries:</th>
                <td>Rs <?php echo array_sum($TbasicSalary); ?></td>
                <th>Total Allowances:</th>
                <td>Rs <?php echo array_sum($Tallowance); ?></td>
                <th>Total Deductions:</th>
                 <td>Rs <?php echo array_sum($Tdeduction); ?></td>
                <th>Total Net Salaries:</th>
                <td>Rs <?php echo array_sum($TnetSallery); ?></td>
                 
                 

</tr>
</tbody>
</table>

    </div>
 
  <?php }else{ echo '<div class="alert alert-warning text-center"><strong>Warning!</strong> No Record Found</div>'; } ?>

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
 
