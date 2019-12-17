<section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
  <section class="secIndex">
      <div class="row">
        <div class="col-md-12">
          <div class="headingMain">
            <h1>
              Offer Letters Management Dashboard | <small><a href="<?php echo base_url('contract/offer_letter_setup'); ?>"><i class="fa fa-plus"></i> Templates</a></small>
            </h1>
          </div>
          <?php if($success = $this->session->flashdata('success')): ?>
            <div class="alert alert-success text-center">
              <p><?php echo $success; ?></p>
            </div>
          <?php endif; ?>
        </div>
      </div>
  </section>
  <section class="secIndexTable">
    <div class="mainTableWhite">
      <div class="row">
        <div class="col-md-7">
          <div class="tabelHeading">
            <?php if(empty($results)): ?>
                <h3>template list</h3>
              <?php else: ?>
                <h3>serach results <small><a href="javascript:history.go(-1)">Back</a></small></h3>
              <?php endif; ?>
          </div>
        </div>
       <div class="col-md-5 text-right">
          <div class="tabelTopBtn">
            <form class="form-inline" action="<?php echo base_url('contract/search_offer_templates'); ?>" method="get">
              <div class="inputFormMain">
                <div class="input-group">
                  <input type="text" name="search_templates" class="form-control" placeholder="Search templates..." required="" autocomplete="off">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btnSubmit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tableMain">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>serial</th>
                    <th>cadre</th>
                    <th>type</th>
                    <th>actions | Edit | Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($results) AND !empty($templates)):
                  $serial = $this->uri->segment(3) + 1; foreach($templates as $template): ?>
                  <tr>
                    <td><?php echo $serial++; ?></td>
                    <td><?php echo $template->designation_name; ?></td>
                    <td><?php echo $template->offer_letter_type; ?></td>
                    <td>
                      <a href="<?php echo base_url("contract/edit_offer_template/{$template->id}"); ?>" class="btn btn-info btn-xs">View / Edit</a>
                      <a href="<?php echo base_url("contract/delete_offer_template/{$template->id}"); ?>" class="btn btn-danger btn-xs" onclick="javascrip:return confirm('Are you sure to delete ?');">Delete</a>
                    </td>
                  </tr>
                  <?php endforeach; endif; ?>
                  <?php if(!empty($results)): ?>
                  <?php $serial = $this->uri->segment(3) + 1; foreach($results as $ressult): ?>
                  <tr>
                    <td><?php echo $serial++; ?></td>
                    <td><?php echo $ressult->designation_name; ?></td>
                    <td><?php echo $ressult->offer_letter_type; ?></td>
                    <td>
                      <a href="<?php echo base_url("contract/edit_offer_template/{$ressult->id}"); ?>" class="btn btn-info btn-xs">View / Edit</a>
                      <a href="<?php echo base_url("contract/delete_offer_template/{$ressult->id}"); ?>" class="btn btn-danger btn-xs" onclick="javascrip:return confirm('Are you sure to delete ?');">Delete</a>
                    </td>
                  </tr>
                  <?php endforeach; endif; ?>
                   <?php if(empty($results) AND empty($templates)): ?>
                    <div class="alert alert-danger text-center">
                      <p><strong>Sorry. </strong> We were unable to find results for the keyword "<?php echo $_GET['search_templates']; ?>". <a href="javascript:history.go(-1);">Return</a></p>
                    </div>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 text-center">
          <?php if(!empty($templates)){ echo $this->pagination->create_links(); } ?>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </div>
  </section>