<?php

/* Job List/Post view

*/

?>

<?php $session = $this->session->userdata('username');?>



 

<div class="box box-block bg-white">

   
<?php 

 $jobdetails = $this->Job_longlisted_model->getJobPosted();

    $this->load->model("Designation_model");

    $this->load->model("Job_post_model");

   //$this->Job_post_model->all_job_types();



?>

<div class="box box-block bg-white">
<ul class="nav nav-tabs">
      <li class="active">
        <a  href="<?php echo base_url(); ?>job_post" >All Applications</a>
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
                <th>Applications</th>

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





    // get job designation

    $designation = $this->Designation_model->read_designation_information($jobd->designation_id);

    if(!is_null($designation)){

      $designation_name = $designation[0]->designation_name;

    } else {

      $designation_name = '--';

    }

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
                <td> <a href="<?php echo base_url(); ?>job_longlisted/getsinglejoballapplication/<?php echo $jobd->job_id;?>">All Applications</a> </td>

                <td><?php echo $jobd->job_title;?></td>
                <td><?php echo $designation_name;?></td>
                <td><?php echo $jtype; ?></td>
                <td><?php echo $jobd->job_vacancy;?></td>
                <td><?php echo $jobd->city_name;?></td>
                <td><?php echo $jobd->date_of_closing;?></td>
                <td><?php echo $jobd->status;?></td>                
                <td><?php echo $jobd->created_at;?></td>
                

                 
                 
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
  

</div>

