<?php $session = $this->session->userdata('username'); ?>
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
                    <option value="<?php $find = array(
                                                    "[[name]]",
                                                    "[[designation]]",
                                                    "[[district]]",
                                                    "[[date]]",
                                                    "[[start_date]]",
                                                    "[[session]]",
                                                    "[[logged_user]]",
                                                    "[[logged_email]]",
                                                    "[[cnic]]",
                                                    "[[gender]]",
                                                    "[[province]]",
                                                    "[[spinsaree_eobi_salary]]",
                                                    "[[spinsaree_eobi_benefit]]");
                  $subject = $letter->offer_letter_text;
                  $gender = $applicant->gender == 0 ? "Mr" : "Ms";
                  // EOBI clause.
                  // If the applicant has a valid CNIC, the sentence below will be printed.
                  $eobi_cnic = "The employee shall be entitled for EOBI benefits. A contribution shall be deducted from the salary on monthly basis and deposited to EOBI along with employer's contribution as per rules.";
                  // If the applicant doesn't have valide CNIC, the below sentence will be printed.
                  $eobi_non_cnic = "The employee shall not be entitled for EOBI benefits due ot lack of CNIC, hence no deduction shall be made from salary as part of EOBI contribution.";
                  // If the applicant is overage, the below sentence will be printed.
                  $eobi_overage = "The employee shall not be entitled for EOBI benefits due to overage, hence no deduction shall be made from salary as part of EOBI contribution.";
                  // Insurance clause.
                  $insurance_cnic = "The employee shall be entitled for death and accidental insurace as per employer's policy.";
                  $insurace_non_cnic = "The employee shall not be provided with death and accidental insurance due to lack of CNIC.";
                  $insurance_overage = "The employee shall not be provided with death and accidental insurace due to overage.";
                  // $eobi_salary = $applicant->cnic != 0 ? $eobi_cnic : $eobi_non_cnic;
                  $dob = strtotime($applicant->dob); // Applicant's Birth date.
                  $today = time(); // today's date.
                  $age = date('Y', $today) - date('Y', $dob); // subtract today's date form Birth date.
                  // EOBI clasue.
                  $eobi_salary = '';
                  if($applicant->cnic == 0 OR $applicant->cnic_expiry_date < date('Y-m-d')){
                    $eobi_salary .= $eobi_non_cnic;
                  }elseif($age > '60' AND $applicant->gender == 0 OR $age > '55' AND $applicant->gender == 1){
                    $eobi_salary .= $eobi_overage;
                  }else{
                    $eobi_salary .= $eobi_cnic;
                  }
                  // Insurance clasue.
                  $eobi_benefit = '';
                  if($applicant->cnic == 0 OR $applicant->cnic_expiry_date < date('Y-m-d')){
                    $eobi_benefit .= $insurace_non_cnic;
                  }elseif($age > '60' AND $applicant->gender == 0 OR $age > '55' AND $applicant->gender == 1){
                    $eobi_benefit .= $insurance_overage;
                  }else{
                    $eobi_benefit .= $insurance_cnic;
                  }
                  $replace = array(
                                '[[name]]' => $applicant->fullname,
                                '[[designation]]'=>$applicant->designation_name,
                                '[[district]]' => $applicant->dist_name,
                                '[[date]]'=>date("M y"),
                                '[[start_date]]' => date("F jS, Y", strtotime($applicant->created_at)),
                                '[[logged_user]]'=> substr(ucfirst($session['username']), 0, 1),
                                '[[session]]' => ucfirst($session['username']),
                                '[[logged_email]]' => $session['email'],
                                '[[cnic]]' => $applicant->cnic,
                                '[[gender]]' => $gender,
                                '[[province]]' => $applicant->name,
                                '[[spinsaree_eobi_salary]]' => $eobi_salary,
                                '[[spinsaree_eobi_benefit]]' => $eobi_benefit); ?>
                      <?php echo htmlspecialchars(str_replace($find, $replace, $subject)); ?>">
                      <?php echo $letter->offer_letter_type; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div><br><br><br>
              <div class="col-lg-12">
                <textarea class='editor' name='offer_letter' id='letter_type'>
                  <?php if(!empty($letter_exists)){ echo $letter_exists['attachment']; } ?>
                </textarea><br><br>
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
<!-- TinyMCE script -->
<script src='<?= base_url(); ?>assets/tinymce/tinymce.min.js'></script>
<script type="text/javascript">
tinymce.init({
    // basic tinyMCE stuff
    selector: ".editor",
    // content_css: 'style.css',
    fontsize_formats: "8px 10px 11px 12px 14px 15px 24px 36px",
    lineheight_formats: "1px 2px 4px 6px 8px 9px 10px 11px 12px 14px 16px 18px 20px 22px 24px 26px 36px",
    height: 200,
    theme: 'modern',
    menubar: true,
    skin: "lightgray",
    height: 700,
    toolbar: "undo redo | styleselect | alignleft alignright alignjustify aligncenter | bullist numlist outdent indent | link image | print preview media fullscreen | forecolor backcolor emoticons | visualchars code template | formatselect fontsizeselect lineheightselect",
    statusbar: true,
    setup: function(ed)
    {
      ed.on('init', function()
      {
        // this.getDoc().body.style.fontSize = '150';
        this.getDoc().body.style.fontFamily = 'Book Antiqua';
      });
    },
    plugins: "variable, code, advlist, autolink, image, lists, charmap, print, preview, hr, pagebreak, anchor, searchreplace, wordcount, visualblocks, visualchars, fullscreen, insertdatetime, media, nonbreaking, save, table, contextmenu, directionality, emoticons, template, paste, textcolor, fullpage, spellchecker, lineheight",
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
});
// Get offer letter from database to the textarea.
$(function() {
    $("#offer_type").change(function() {
        var s = $(this).val();
        tinyMCE.activeEditor.setContent(s);
    });
});
</script>