<section class="secnavMain">
  <nav class="navbar navbar-inverse" style="padding: 0px;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
        <a class="navbar-brand" href="#"><img src="<?= base_url(); ?>assets/img/bars.png" alt=""></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class=""><a href="<?= base_url(); ?>User_panel">Home</a></li>
          <li><a href="<?= base_url(); ?>User_panel/personal_detail">Employee Detail</a></li>
          <li><a href="<?= base_url(); ?>User_panel/policies">Policies</a></li>
          <li><a href="<?= base_url(); ?>User_panel/payroll">Payroll Info</a></li>
          <li><a href="<?= base_url(); ?>User_panel/leaveManagement">Leave Management</a></li>
          <li><a href="<?= base_url(); ?>User_panel/resignation">Resignation</a></li>

          <li><a href="<?= base_url(); ?>User_panel/trainings">Trainings</a></li>
          <li><a href="<?= base_url(); ?>User_panel/new_card">Card Request</a></li>
          <li>
            <a href="#">
              <span class="dot"></span>
              <span class="dot"></span>
              <span class="dot"></span>
            </a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#">
              <img src="<?= base_url(); ?>assets/img/profile.png" alt="">
              Hasseb Khattak
              <span class="caret"></span>    
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</section>