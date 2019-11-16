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
              <div class="col-lg-4">
                <input type="text" name="from_date" class="form-control date" value="<?php if(!empty($cr_contract)){ echo date('Y/m/d', strtotime($cr_contract['from_date'])); }elseif(!empty($extension)){ echo date('Y/m/d', strtotime($extension['from_date'])); }else{ echo date('Y-m-d'); } ; ?>">
              </div>
              <div class="col-lg-4">
                <input type="text" name="to_date" class="form-control date" value="<?php if(!empty($cr_contract)){ echo date('Y/m/d', strtotime($cr_contract['to_date'])); }elseif(!empty($extension)){ echo date('Y/m/d', strtotime($extension['to_date'])); }else{ echo date('Y-m-d'); } ; ?>">
              </div>
              <div class="col-lg-4">
                <select class="form-control" id="contract_type">
                  <option value="">Select Type...</option>
                  <?php foreach($types as $type): ?>
                    <option value="<?php echo $type->contract_format; ?>">
                      <?php echo $type->name; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/tinymce/plugins/variable/style.css'); ?>">
<!-- TinyMCE script -->
<script src='<?= base_url(); ?>assets/tinymce/tinymce.min.js'></script>
<!-- Script -->
<script type="text/javascript" src="<?php echo base_url('assets/tinymce/plugins/variable/plugin.js'); ?>"></script>
<!-- TinyMCE script -->
<script src='<?= base_url(); ?>assets/tinymce/tinymce.min.js'></script>
<!-- Script -->
<script>
  var name = '<?php if(!empty($applicant)){ echo $applicant->fullname; }?>';
  var designation = '<?php if(!empty($applicant)){ echo $applicant->designation_name; } ?>';
  var province = '<?php if(!empty($applicant)){ echo $applicant->name; } ?>';
  var district = '<?php if(!empty($applicant)){ echo $applicant->dist_name; } ?>';
  var start_date = '<?php if(!empty($applicant)){ echo date("M d, Y", strtotime($applicant->created_at)); } ?>';
  var date = '<?php echo date('F y'); ?>';
  var cnic = '<?php if(!empty($applicant)){ echo $applicant->cnic; } ?>';
tinymce.init({ 
  selector:'.editor',
  theme: 'modern',
  height: 700,
  toolbar: "undo redo | styleselect | alignleft alignright alignjustify aligncenter | bullist numlist outdent indent | link image | print preview media fullscreen | forecolor backcolor emoticons | visualchars code template | fullpage spellchecker formatselect",
    statusbar: true,
    setup: function(ed)
    {
      ed.on('init', function()
        {
          this.getDoc().body.style.fontSize = '12';
          this.getDoc().body.style.fontFamily = 'Book Antiqua';
        });
    },
    plugins: "variable, code, advlist, autolink, image, lists, charmap, print, preview, hr, pagebreak, anchor, searchreplace, wordcount, visualblocks, visualchars, fullscreen, insertdatetime, media, nonbreaking, save, table, contextmenu, directionality, emoticons, template, paste, textcolor, fullpage, spellchecker",
    variable_mapper: {  // Will look for variables in replace them with the text.
        name: name,
        designation: designation,
        address: 'Hayat Abad, Phase III',
        district: district,
        province: province,
        cnic: cnic,
        start_date: start_date,
        end_date: start_date,
        date: date
    },
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
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_drawer: 'sliding',
    contextmenu: "link image imagetools table",
    // variable_prefix: '{{',
    // variable_suffix: '}}'
    // variable_class: 'bbbx-my-variable',
    //variable_valid: ['name', 'designation', 'address', 'district', 'province', 'cnic', 'start_date', 'end_date', 'date']
});
// Get offer letter from database to the textarea.
$(function() {
    $("#contract_type").change(function() {
        var s = $(this).val();
        tinyMCE.activeEditor.setContent(s);
    });
});
</script>