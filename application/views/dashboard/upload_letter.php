<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable">
    <div class="mainTableWhite">
      <div class="row">
        <div class="col-md-12">
          <div class="tabelHeading">
            <h3>create an offer letter
              <span>
                (select an offer from the list and send it, that's it.)
              </span></h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
             <!-- Form -->
          <form method='post' action='<?php echo base_url("contract/create_offer_letter"); ?>'>
            <!-- Textarea -->
            <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3); ?>">
              <div class="col-lg-4">
                <select name="offer_letter_type" class="form-control" id="offer_type">
                  <option value="">Select type...</option>
                  <?php foreach($letters as $letter): ?>
                    <option value="<?php echo $letter->offer_letter_text; ?>">
                      <?php echo $letter->offer_letter_type; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div><br><br><br>
              <div class="col-lg-12">
                <textarea class='editor' name='offer_letter' id='letter_type'></textarea><br><br>
              </div>
              <div class="col-lg-12">
                <input type='submit' value='Send Letter' name='submit' class="btn btn-primary">
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
// Get offer letter from database to the textarea.
$(function() {
    $("#offer_type").change(function() {
        var s = $(this).val();
        tinyMCE.activeEditor.setContent(s);
    });
});
</script>