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
                <textarea class='editor' name='offer_letter' id='letter_type'><?php if(!empty($letter_exists)){ echo $letter_exists['attachment']; } ?></textarea><br><br>
              </div>
              <div class="col-lg-12">
                <?php if(empty($letter_exists)): ?>
                  <input type='submit' value='Send Letter' name='submit' class="btn btn-primary">
                <?php else: ?>
                  <input type="submit" name="submit" value="Update Letter" class="btn btn-primary">
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tinymce/plugins/variable/style.css'); ?>">
<!-- TinyMCE script -->
<script src='<?= base_url(); ?>assets/tinymce/tinymce.min.js'></script>
<!-- Script -->
<script type="text/javascript" src="<?php echo base_url('assets/tinymce/plugins/variable/plugin.js'); ?>"></script>
<script type="text/javascript">
tinymce.init({
    // basic tinyMCE stuff
    selector: ".editor",
    // content_css: 'style.css',
    height: 200,
    theme: 'modern',
    menubar: true,
    // toolbar: "bold,italic,mybutton,code",
    statusbar: true,
    // Adding more variables to the form, but we don't need to add more vars.
    // setup : function(ed) {
    //     window.tester = ed;
    //     ed.addButton('mybutton', {
    //         title : 'My button',
    //         text : 'Insert variable',
    //         onclick : function() {
    //             ed.plugins.variables.addVariable('account_id');         
    //         }
    //     });
    //     ed.on('variableClick', function(e) {
    //        console.log('click', e);
    //     });
    // },
    // variable plugin related
    plugins: "variable, code",
    variable_mapper: {  // Will look for variables in replace them with the text.
        name: 'Shahid Qamar',
        designation: 'CHW',
        address: 'Hayat Abad, Phase III',
        district: 'Peshawar',
        province: 'KP',
        cnic: '1420245324532',
        start_date: '2019-10-01',
        end_date: '2019-12-31',
        date: '2019-10-01'
    }
    // variable_prefix: '{{',
    // variable_suffix: '}}'
    // variable_class: 'bbbx-my-variable',
    //variable_valid: ['username', 'sender', 'phone', 'community_name', 'email']
});

// Get offer letter from database to the textarea.
$(function() {
    $("#offer_type").change(function() {
        var s = $(this).val();
        tinyMCE.activeEditor.setContent(s);
    });
});
</script>