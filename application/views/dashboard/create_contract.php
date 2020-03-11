<?php $session = $this->session->userdata('username'); ?>
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
                <input type="text" id="from_date" name="from_date" class="form-control date" value="<?php if(!empty($cr_contract)){ echo date('Y/m/d', strtotime($cr_contract['from_date'])); }elseif(!empty($extension)){ echo date('Y/m/d', strtotime($extension['from_date'])); }else{ echo date('Y-m-d'); } ; ?>">
              </div>
              <div class="col-lg-4">
                <input type="text" id="to_date" name="to_date" class="form-control date" value="<?php if(!empty($cr_contract)){ echo date('Y/m/d', strtotime($cr_contract['to_date'])); }elseif(!empty($extension)){ echo date('Y/m/d', strtotime($extension['to_date'])); }else{ echo date('Y-m-d'); } ; ?>">
              </div>
              <div class="col-lg-4">
                <select class="form-control" id="contract_type">
                  <option value="">Select Type...</option>
                  <?php foreach($types as $type): ?>
                    <option value="<?php $find = array(
                                                      "[[name]]",
                                                      "[[designation]]",
                                                      "[[district]]",
                                                      "[[current_month_year]]",
                                                      "[[contract_start_date]]",
                                                      "[[contract_expiry_date]]",
                                                      "[[initial]]",
                                                      "[[signature_name]]",
                                                      "[[logged_email]]",
                                                      "[[cnic]]",
                                                      "[[title]]",
                                                      "[[province]]",
                                                      "[[spinsaree_eobi_salary]]",
                                                      "[[spinsaree_eobi_benefit]]"
                                                  );
                  $subject = $type->contract_format;
                  $title = $applicant->gender == 0 ? "Mr" : "Ms";
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
                  $start_date = date('F jS, Y', strtotime($cr_contract['from_date']));
                  $end_date = date('F jS, Y', strtotime($cr_contract['to_date']));
                  $replace = array(
                                    '[[name]]' => $applicant->fullname,
                                    '[[designation]]'=>$applicant->designation_name,
                                    '[[district]]' => $applicant->dist_name,
                                    '[[current_month_year]]'=>date("M y"),
                                    '[[contract_start_date]]' => $start_date,
                                    '[[contract_expiry_date]]' => $end_date,
                                    '[[signature_name]]'=> substr(ucfirst($session['username']), 0, 1),
                                    '[[initial]]' => ucfirst($session['username']),
                                    '[[logged_email]]' => $session['email'],
                                    '[[cnic]]' => $applicant->cnic,
                                    '[[title]]' => $title,
                                    '[[province]]' => $applicant->name,
                                    '[[spinsaree_eobi_salary]]' => $eobi_salary,
                                    '[[spinsaree_eobi_benefit]]' => $eobi_benefit
                                  ); ?>
                      <?php echo htmlspecialchars(str_replace($find, $replace, $subject)); ?>">
                      <?php echo $type->name.' - '.$type->designation_name; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div><br><br><br>
              <div class="col-lg-12">
                <textarea class='editor' name='long_description'>
                  <?php if(!empty($cr_contract)){ echo $cr_contract['long_description']; }elseif(!empty($extension)){ echo $extension['long_description']; } ?>
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
// Get offer letter from database to the textarea.
$(function() {
    $("#contract_type").change(function() {
        var s = $(this).val();
        tinyMCE.activeEditor.setContent(s);
    });
});
</script>