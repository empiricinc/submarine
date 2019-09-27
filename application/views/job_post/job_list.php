<?php

/* Job List/Post view

*/

?>

<?php $session = $this->session->userdata('username');


 

?>



 

<div class="box box-block bg-white">

   
<?php
$this->load->model("Designation_model");

    $this->load->model("Job_post_model");

 


if($_POST){

 
($this->input->post('province_id')=='all') ?  $jobdetails = $this->Job_longlisted_model->getJobPostedBycondition4all($_POST['company_id']) : $jobdetails = $this->Job_longlisted_model->getJobPostedBycondition($_POST['company_id'],$_POST['province_id']);


}else{
  //$jobdetails = $this->Job_longlisted_model->getJobPostedn($projid,$provid);
  //$jobdetails = $this->Job_longlisted_model->getJobPosted();

     if(isset($sl2['accessLevel2'])  &&  !empty($sl2['accessLevel2'])){  
                  $jobdetails = $this->Job_longlisted_model->getJobPosted();
         }else{ 
                  $jobdetails = $this->Job_longlisted_model->getJobPostedn($projid,$provid);
                }  

}

 // $sl1 = $this->session->userdata('accessLevel'); //echo $sl1['accessLevel1'];
 // $sl2 = $this->session->userdata('accessLevel'); //echo $sl2['accessLevel2'];
 // $sl3 = $this->session->userdata('accessLevel'); //echo $sl3['accessLevel3'];


?>

<?php if($sl2['accessLevel2']) { 
        // if($session['department_id']==3 || $session['department_id']==6){ 
 ?>


<div class="box box-block bg-white">
<br>
<div class="col-md-12">
<div class="row">
<form action="<?php echo base_url(); ?>job_post" method="post" name="set_salary_details">
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
                    <option value="all">All Province</option>
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
</div>

<?php } ?>


<div class="box box-block bg-white">
<ul class="nav nav-tabs">
      <li class="active">
        <a  href="<?php echo base_url(); ?>job_post" >All Posted Jobs</a>
      </li> 
      <li class="">
        <a href="<?php echo base_url(); ?>vacant_position" >Vacant Position</a>
      </li>
       
</ul>




<script type="text/javascript">
  $(document).ready(function() {
    $('#job_listing').DataTable();
} );
</script>


    
    <!-- 
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
 -->

<div class="table-responsive">
    <table id="job_listing" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>All Posted Jobs</th>
                <th>Title</th>
                <th>Designation</th>
                <th>Job Type</th>
                <th>no. Positions</th>
                <th>City</th>
                <th>Closing date</th>
                <th>Status</th>
                <th>Created Date</th>
                
                 
            </tr>
        </thead>
        <tbody>
           <?php 
                $i = 0;
                foreach($jobdetails as $jobd){  //echo $jobd->job_type; exit();
                  $i++;
                  //$gender = (($candidate->gender==0)?'Male':(($candidate->gender==1)?'Female':'No'));

                    $designation = $this->Designation_model->read_designation_information($jobd->designation_id);

                    if(!is_null($designation)){

                      $designation_name = $designation[0]->designation_name;

                    } else {

                      $designation_name = '--';

                    }
                    
                    $TheCityName = $this->ProvinceCity->read_district_information($jobd->city_name);
                    if($TheCityName){
                        
                        if(!is_null($TheCityName)){
                          $cityName = $TheCityName[0]->name;
                        } else {
                          $cityName = '--';
                        }
                    }else{ $cityName = '--'; } 

                    // get job type

                    $job_type = $this->Job_post_model->read_job_type_information($jobd->job_type);

                    if(!is_null($job_type)){

                      $jtype = $job_type[0]->type;

                    } else {

                      $jtype = '--';

                    }

            ?>
            <tr>
                <td><?php echo $i; ?></td>   
                <td> <?php echo ($jobd->reserve==0) ? '<a href="'.base_url().'job_longlisted/getsinglejoballapplication/'.$jobd->job_id.'">All Applications</a>' : '<a class="text-warning" href="'.base_url().'job_longlisted/getReservedRecords/'.$jobd->job_id.'">View Reserved</a>'; ?> </td>
                <td><?php echo $jobd->job_title;?></td>
                <td><?php echo $designation_name;?></td>
                <td><?php echo $jtype; ?></td>
                <td><?php echo $jobd->job_vacancy;?></td>
                <td><?php echo $cityName;?></td>
                <td><?php echo $jobd->date_of_closing;?></td>
                <td><?php echo ($jobd->reserve==0)? '<a class="nav-link active" href="#">Open</a>' : '<a class="nav-link text-warning" href="#">Reserved</a>';?></td>                
                <td><?php echo $jobd->created_at;?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
  

</div>

