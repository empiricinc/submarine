<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable">
    <div class="mainTableWhite">
      <div class="row">
        <div class="col-md-12">
          <div class="tabelHeading">
            <h3>contract history</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
             <!-- Form -->
          <form action="" method="">
            <!-- Textarea -->
            <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(3); ?>">
              <div class="col-lg-4">
              </div>
              <div class="col-lg-12">
                <textarea class='editor' name='long_description'>
                  <?php if(!empty($previous)){ echo $previous->long_description; } ?>
                </textarea><br><br>
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
  fontsize_formats: "8px 9px 10px 11px 12px 14px 15px 24px 36px",
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
</script>