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
          <li class=""><a href="<?= base_url(); ?>dashboard">Home</a></li>
          <!-- <li class=""><a href="<?= base_url(); ?>Investigation/dashboard">Dashboard</a></li> -->
          <li class=""><a href="<?= base_url(); ?>Investigation/employees">Add Investigation</a></li>
          <li class=""><a href="<?= base_url(); ?>Investigation/view">View Investigation</a></li>
              
          <li>
            <a href="#">
              <span class="dot"></span>
              <span class="dot"></span>
              <span class="dot"></span>
            </a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle">
              <img src="<?= base_url(); ?>assets/img/profile.png" alt="">
              Hasseb Khattak
              <span class="caret"></span>    
            </a>
            <ul class="dropdown-menu">  
                
            </ul>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
</section>