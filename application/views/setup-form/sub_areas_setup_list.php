<?php $session = $this->session->userdata('username');

 $this->load->model('provinceCity');
 $geProvinces = $this->provinceCity->getAllProvinces();   



$messageSuccess = $this->session->flashdata('messageSuccess');
if ($messageSuccess) { echo $messageSuccess = '<div class="alert alert-success text-center"><strong>Success!</strong> '.$messageSuccess.' </div>'; }


$error = $this->session->flashdata('error');
if ($error) { echo $error = '<div class="alert alert-danger text-center"><strong>Alert!</strong> '.$error.' </div>'; }


?>

<div class="add-form" style="display:none;">

  <div class="box box-block bg-white">

    <h2><strong><?php echo $this->lang->line('xin_add_new');?></strong> <?php echo $this->lang->line('xin_location');?>

      <div class="add-record-btn">

        <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-minus icon"></i> <?php echo $this->lang->line('xin_hide');?></button>

      </div>

    </h2>

    <div class="row m-b-1">

      <div class="col-md-12">
 
          <div class="bg-white">

            <div class="box-block">

              <div class="row">


 <form class="m-b-1 add" action="<?php echo site_url(); ?>Uc_setup/add_sub_areas" method="post">
          <div class="col-md-12">
                     <div class="col-md-4">  
                        <div class="form-group">
                            <label for="date_of_closing" class="control-label">Area Name</label>
                            <select title="Select Union Councel" name="area_id" class="form-control" required="required">      
                                <option value="">Select Areas</option>

                                <?php
                                foreach ($allareas as $key => $uc) {
                                    echo '<option value="'.$uc['id'].'">'.$uc['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div> 

                    <div class="col-md-4">  
                        <div class="form-group">
                            <label for="" class="control-label">Sub Area Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Sub Area Name" required="required">
                        </div>
                    </div>
           </div>  

          <div class="col-md-12" class="text-right">
            <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>
          </div>           
</form>

              </div>

              <!-- <div class="text-right">

                <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_save');?> <i class="icon-circle-right2 position-right"></i> <i class="icon-spinner3 spinner position-left"></i></button>

              </div> -->

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>



 

<div class="box box-block bg-white">

  <h2><strong><?php echo $this->lang->line('xin_list_all');?></strong> <?php echo $this->lang->line('xin_locations');?>
    <div class="add-record-btn">
      <button class="btn btn-sm btn-primary add-new-form"><i class="fa fa-plus icon"></i> <?php echo $this->lang->line('xin_add_new');?></button>
    </div>
  </h2>


<script type="text/javascript">
  $(document).ready(function() {
    $('#job_listing').DataTable();
} );

  $(document).ready(function() {
    $('#area_positions_listing').DataTable();
} );
</script>

<div class="table-responsive">
     <table id="job_listing" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                 
                <th>Sub Area Name</th>
                
                <th>Area Name</th>
            </tr>
        </thead>
        <tbody>
           <?php 
                $i = 0;
                  $location_detail=0;
                  foreach($all_sub_areas as $location_detail){   
                  $i++;

          $area_name_data = $this->provinceCity->read_area_information($location_detail['area_id']);
          if($area_name_data){
                    if(!is_null($area_name_data)){
                              $area_name = $area_name_data[0]->name;
                    } else {
                              $area_name = '--';
                    }  
          }else{ $area_name = '--'; }   
   

            ?>
          <tr>
                <td><?php echo $i; ?></td>   
                 

                <td><?php echo $location_detail['name']; ?></td>
                 

                <td><?php echo $area_name; ?></td>
                 

                 
                 
            </tr> 
            <?php  } ?>
        </tbody>
    </table>
</div>
 

</div>

 