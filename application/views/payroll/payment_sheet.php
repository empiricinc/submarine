<?php $session = $this->session->userdata('username');?>
<?php 
$this->load->model("Xin_model");
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
                <select title="Select province" name="province_id" class="form-control">      
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


<!-- 
<script type="text/javascript">
  $(document).ready(function() {
    $('#job_avail_position').DataTable();
} );
</script>
<style type="text/css"> .no-padding{ padding: 0px !important; } .allowance-tabl{ width: 100%; } .allowance-tabl td{ border: 1px solid #ddd !important; } </style> -->

<?php require_once('dtpaysheet.php'); ?>

<?php if($payrollempName != 1){?>
 

<div class="table-responsive">
    

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
                <th>payment_amount</th> 
                <th>Gross Salary</th> 
                <th>Total Allowances</th> 
                <th>Total Deductions</th> 
                <th>Net Salary</th> 
                <th>House Rent Allowance</th> 
                <th>Medical Allowance</th> 
                <th>Travelling Allowance</th> 
                <th>Dearness Allowance</th> 
                <th>Provident Fund</th> 
                <th>EOBI</th> 
                <th>Tax Deduction</th> 
                <th>Advance Salary</th>                  
                <th>Month</th>
                <th>Action</th>                 
                
            </tr>
        </thead>
        <tbody>
            

<?php 

  
 
    
    $i = 0;
    foreach($payrollempName as $empdetail){  // echo $location_detail->company_id;
      $i++;
     

     //$data['emp_details'] = $this->Xin_model->read_user_info($payment[0]->employee_id);

     $emp_details = $this->Xin_model->read_user_info($empdetail->employee_id);
          if($emp_details){ 
                if(!is_null($emp_details)){
                          $fname = $emp_details[0]->first_name;
                          $lname = $emp_details[0]->last_name;
                } else {
                          $designation_name = '--';
                }
          }else{ $designation_name = '--'; } 



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

    $province_data = $this->ProvinceCity->read_province_information($empdetail->location_id);
          if($province_data){ 
                    if(!is_null($province_data)){
                              $province_name = $province_data[0]->name;
                    } else {
                              $province_name = '--';
                    }   
          }else{ $province_name = '--'; }         

                 
          

            ?>
     

            <tr>
                <td><?php echo $i; ?></td>   
                <td><?php echo $fname.' '.$lname;; ?></td>
                <td><?php echo $proj_name;?></td>
                <td><?php echo $province_name;?></td>
                <td><?php echo $designation_name;?></td>
                <td><?php echo $department_name;?></td>
                <td><?php echo $empdetail->basic_salary; $TbasicSalary[] = $empdetail->basic_salary;?> </td>
                <td><?php echo $empdetail->payment_amount;?> </td>
                <td><?php echo $empdetail->gross_salary;?> </td>
                <td><?php echo $empdetail->total_allowances; $Tallowance[] = $empdetail->total_allowances; ?> </td>
                <td><?php echo $empdetail->total_deductions; $Tdeduction[] = $empdetail->total_deductions; ?> </td>
                <td><?php echo $empdetail->net_salary; $TnetSallery[] = $empdetail->net_salary; ?> </td>
                <td><?php echo $empdetail->house_rent_allowance;?> </td>
                <td><?php echo $empdetail->medical_allowance;?> </td>
                <td><?php echo $empdetail->travelling_allowance;?> </td>
                <td><?php echo $empdetail->dearness_allowance;?> </td>
                <td><?php echo $empdetail->provident_fund;?> </td>
                <td><?php echo $empdetail->eobi;?> </td>
                <td><?php echo $empdetail->tax_deduction;?> </td>                 
                <td><?php echo $empdetail->advance_salary_amount;?> </td> 
                <td><?php echo $empdetail->payment_date;?> </td>
                <td><a class="text-success" href="<?php echo base_url(); ?>payroll/pdf_create/sl/<?php echo $empdetail->employee_id; ?>/">Payslip</a>
                </td>

</tr>


            
            <?php   } ?>

 

        </tbody>
      </table>

<?php if($payrollempName){ ?>

<table id="job_avail_position" class="table table-striped table-bordered" style="width:100%">

<tbody>
  <tr>
                <th><!-- Project Name: --></th>  
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
<?php } ?>

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
 
