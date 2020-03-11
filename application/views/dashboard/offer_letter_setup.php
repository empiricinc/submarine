<?php $session = $this->session->userdata('username'); ?>
<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable">
    <div class="mainTableWhite">
      <div class="row">
        <div class="col-md-12">
          <div class="tabelHeading">
            <h3>template setup
              <span>(setup template and press the save button)</span> | 
              <small><a href="<?php echo base_url('contract/offer_letter_templates'); ?>"><i class="fa fa-eye"></i> Recently Added</a></small>
            </h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <!-- Form -->
          <form method='post' action='<?php if(empty($edit_template)){ echo base_url("contract/add_offer_letter"); }else{ echo base_url('contract/update_offer_letter'); } ?>'>
            <!-- Textarea -->
            <input type="hidden" name="created_at" value="<?php echo date('Y-m-d'); ?>">
            <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
            <div class="col-lg-4">
              <select name="designation" class="form-control" required="">
                <option value="">Select Cadre</option>
                <?php if(!empty($edit_template)): ?>
                <option value="<?php echo $edit_template['designation']; ?>"selected><?php echo $edit_template['designation_name']; ?></option><?php endif; ?>
                 <?php foreach($designations as $designation): ?>
                <option value="<?php echo $designation->designation_id; ?>">
                  <?php echo $designation->designation_name; ?>
                </option>
                <?php endforeach; ?>
              </select>
              </div>
              <div class="col-lg-4">
               <select name="offer_type" class="form-control" required="">
                 <option value="">Select Type</option>
                 <?php if(!empty($edit_template)): ?>
                 <option value="<?php echo $edit_template['offer_letter_type'];  ?>" selected><?php echo $edit_template['offer_letter_type']; ?></option><?php endif; ?>
                 <option value="Offer Letter">Offer Letter</option>
                 <option value="Withdrawal Letter">Withdrawal Letter</option>
                 <option value="Reference Letter">Reference Letter</option>
               </select>
              </div><br><br><br>
              <div class="col-lg-12">
                <textarea class='editor' name='offer_letter_format' required="">
                  <?php if(!empty($edit_template)){ echo $edit_template['offer_letter_text']; } ?>
                </textarea><br><br>
              </div>
              <div class="col-lg-12">
                <?php if(empty($edit_template)): ?>
                  <input type="submit" value="Save" name="submit" class="btn btn-primary">
                <?php else: ?>
                  <input type="submit" value="Update" name="submit" class="btn btn-primary">
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
  fontsize_formats: "8px 9px 10px 11px 12px 14px 15px 18px 20px 22px 24px 36px",
  lineheight_formats: "1px 2px 4px 6px 8px",
  height: 700,
  toolbar: "undo redo | styleselect | alignleft alignright alignjustify aligncenter | bullist numlist outdent indent | link image | print preview media fullscreen | forecolor backcolor emoticons | code template | fontsizeselect formatselect lineheightselect",
    statusbar: true,
    setup: function(ed)
    {
      ed.on('init', function()
        {
          // this.getDoc().body.style.fontSize = '12';
          this.getDoc().body.style.fontFamily = 'Book Antiqua';
        });
    },
    plugins: "variable, code, advlist, autolink, image, lists, charmap, print, preview, hr, pagebreak, anchor, searchreplace, wordcount, visualblocks, visualchars, fullscreen, insertdatetime, media, nonbreaking, save, table, contextmenu, directionality, emoticons, template, paste, textcolor, fullpage, spellchecker, lineheight",
    templates: [
      { 
        title: 'New Table',
        description: 'Creates a new table',
        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"></th></tr><tr><td></td><td> </td></tr><tr><td></td></tr></table></div>'
      },
      { 
        title: 'Story',
        // src: 'htpp://localhost/submarine/tests',
        description: 'The Jungle Book',
        content: 'Once upon a time, there was a jungle, a boy went into that. A lion came and took the boy with itself. The boy grown up in the jungle. They named the boy Tarzan...'
      },
      {
        title: 'List with Dates',
        description: 'New list with date formats in it...',
        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
      }
    ]
});
// Get offer letter from database to the textarea.
$(function() {
    $("#contract_type").change(function() {
        var s = $(this).val();
        tinyMCE.activeEditor.setContent(s);
    });
});
</script>