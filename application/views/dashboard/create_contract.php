<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable">
    <div class="mainTableWhite">
      <div class="row">
        <div class="col-md-12">
          <div class="tabelHeading">
            <?php if(!empty($extension)): ?>
            <h3>extend contract
              <span>
                (make changes and click the extend contract button)
              </span></h3>
              <?php else: ?>
              <h3>create contract
              <span>
                (make changes and click the create contract button)
              </span>
              <?php endif; ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
             <!-- Form -->
          <form method='post' action='<?php if(empty($extension)){ echo base_url("contract/add_contract"); }else{ echo base_url("contract/extend_contract"); } ?>'>
            <!-- Textarea -->
            <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3); ?>">
              <div class="col-lg-6">
                <input type="text" name="from_date" class="form-control date" value="<?php if(!empty($cr_contract)){ echo date('Y/m/d', strtotime($cr_contract['from_date'])); }else{ echo date('Y/m/d', strtotime($extension['from_date'])); } ; ?>">
              </div>
              <div class="col-lg-6">
                <input type="text" name="to_date" class="form-control date" value="<?php if(!empty($cr_contract)){ echo date('Y/m/d', strtotime($cr_contract['to_date'])); }else{ echo date('Y/m/d', strtotime($extension['to_date'])); } ; ?>">
              </div><br><br><br>
              <div class="col-lg-12">
                <textarea class='editor' name='long_description'>
                  <?php if(!empty($cr_contract)){ echo $cr_contract['long_description']; } else{
                  echo $extension['long_description']; } ?>
                </textarea><br><br>
              </div>
              <div class="col-lg-12">
                <?php if(empty($extension)): ?>
                <input type='submit' value='Create Contract' name='submit' class="btn btn-primary">
                <?php else: ?>
                <input type="submit" value="Extend Contract" name="submit" class="btn btn-primary">
                <?php endif; ?>
                <a href="javascript:history.go(-1);" class="btn btn-warning">Back</a>
                <br><br>
              </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</section>
<!-- TinyMCE script -->
<script src='<?= base_url(); ?>assets/tinymce/tinymce.min.js'></script>
<!-- Script -->
<script>
tinymce.init({ 
  selector:'.editor',
  theme: 'modern',
  height: 200
});
</script>