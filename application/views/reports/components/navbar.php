<section class="secnavMain">
  <nav class="navbar navbar-inverse" style="padding: 0px;">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
        <a class="navbar-brand" href="<?php echo base_url();?>"><div class="hrms-logo">HRMS</div></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="<?= base_url(); ?>">Home</a></li>
          <!-- <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                Reports <span class="fa fa-caret"></span>
              </a>
              <ul class="dropdown-menu"> -->
                <li class=""><a href="<?= base_url(); ?>Reports/employees">Employees</a></li>
                <!-- <li><a href="<?= base_url(); ?>Reports/complaints">Complaints</a></li> -->
                <li><a href="<?= base_url(); ?>Reports/terminations">Terminations</a></li>
                <li><a href="<?= base_url(); ?>Reports/resignations">Resignations</a></li>
                <li><a href="<?= base_url(); ?>Reports/trainings">Trainings</a></li>
                <li><a href="<?= base_url(); ?>Reports/activity">Activity</a></li>
                <li><a href="<?= base_url(); ?>Reports/tests">Tests</a></li>
                <li><a href="<?= base_url(); ?>Reports/events">Events</a></li>
                <li><a href="<?= base_url(); ?>Reports/training_calendar">Training Calendar</a></li>
              <!-- </ul>
          </li> -->
          
          
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