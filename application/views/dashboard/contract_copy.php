<style type="text/css">
  #image{
    box-shadow: 12px 8px 13px #ccc;
  }
</style>
<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable">
    <div class="mainTableWhite">
      <div class="row">
        <div class="col-md-12">
          <div class="tabelHeading">
            <h3>contract verification
              <span>
                (upload scanned copies of the signed contract.)
              </span>
            </h3>
          </div>
          <div class="col-md-5">
            <!-- <form method='post' action='<?php echo base_url("contract/contract_copy"); ?>' enctype='multipart/form-data'>
              <input type="hidden" name="user_id" value="<?= $this->uri->segment(3); ?>">
              <div class="col-lg-12">
                <input type="file" name="scanned_copy"><br>
              </div>
                <div class="col-lg-12">
                  <input type='submit' value='Upload' name='submit' class="btn btn-primary">
                  <a href="javascript:history.go(-1);" class="btn btn-warning">Back</a>
                  <br><br>
                </div>
            </form> -->

            <form method='post' action='<?= base_url('contract/contract_upload'); ?>' enctype='multipart/form-data'>
              <input type="hidden" name="user_id" value="<?= $this->uri->segment(3); ?>">
              <div class="col-lg-12">
                <label for="file">Select Files |</label><small> Press & hold the CTRL key to select multiple files.</small>
                <input type="file" name="files[]" multiple="multiple" required><br>
              </div>
                <div class="col-lg-12">
                  <input type='submit' value='Upload' name='fileSubmit' class="btn btn-primary">
                  <a href="javascript:history.go(-1);" class="btn btn-warning">Back</a>
                  <br><br>
                </div>
            </form>
          </div>
          <div class="col-lg-7">
            <?php $copies = $this->Contract_model->get_copies($this->uri->segment(3)); 
            if($copies): ?>
            <?php foreach($copies as $copy): ?>
              <a href="<?php echo base_url(); ?>contract/delete_file/<?php echo $copy->file_id; ?>" class="btn btn-danger btn-xs">Delete <i class="fa fa-arrow-circle-right"></i></a>
              <a href="<?= base_url(); ?>uploads/contract/<?= $copy->file_name; ?>">
                <img id="image" height="155" width="155" class="img-circle shadow" src="<?= base_url(); ?>uploads/contract/<?= $copy->file_name; ?>" alt="Loading image, please wait...">
              </a>
              <?php endforeach; else: ?>
            <div class="alert alert-danger text-justify col-lg-8 col-lg-offset-4">
              <blockquote>There are no scanned copies available for this employee. The employee will only be considered verified if his/her scanned copies of contract uploaded. <br><strong>Choose files from your computer to verify.</strong></blockquote>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div><br><br>
    </div>
  </section>
</section>