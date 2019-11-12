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
          <?php $controllerName = strtolower($this->uri->segment(1)); ?>

          <li class=""><a href="<?= base_url(); ?>dashboard">Home</a></li>

          <!-- COMPLAINT -->
          <?php if($controllerName == 'complaint'): ?>
          <li class=""><a href="<?= base_url(); ?>Complaint/index">Add Complaint</a></li>
          <li class=""><a href="<?= base_url(); ?>Complaint/view">Manager View</a></li>
          <li class=""><a href="<?= base_url(); ?>Complaint/legal_view">Legal View</a></li>
          <li class=""><a href="<?= base_url(); ?>Complaint/local_view">local View</a></li> 


          <!-- DISCIPLINARY -->
          <?php elseif($controllerName == 'disciplinary'): ?>
          <li class=""><a href="<?= base_url(); ?>Investigation/dashboard">Dashboard</a></li>
          <li class=""><a href="<?= base_url(); ?>Disciplinary/employees">Add Disciplinary</a></li>
          <li class=""><a href="<?= base_url(); ?>Disciplinary/view">View Disciplinary</a></li>


          <!-- EMPLOYEE CARDS -->
          <?php elseif($controllerName == 'employee_cards'): ?>
          <li class=""><a href="<?= base_url(); ?>Employee_cards/index">Dashboard</a></li>
          <li class=""><a href="<?= base_url(); ?>Employee_cards/receive">Receive Cards</a></li>


          <!-- FIELD JOINING -->
          <?php elseif($controllerName == 'field_joining'): ?>
          <li class=""><a href="<?= base_url(); ?>Field_joining">Dashboard</a></li>
          <li><a href="<?= base_url(); ?>Field_joining/employees">Employees</a></li>

                
          <!-- INVESTIGATION -->
          <?php elseif($controllerName == 'investigation'): ?>
          <li class=""><a href="<?= base_url(); ?>Investigation/employees">Add Investigation</a></li>
          <li class=""><a href="<?= base_url(); ?>Investigation/view">View Investigation</a></li>

          
          <!-- INSURANCE -->
          <?php elseif($controllerName == 'insurance'): ?>
          <li class=""><a href="<?= base_url(); ?>Insurance/dashboard">Dashboard</a></li>
          <li class=""><a href="<?= base_url(); ?>Insurance/list_employees">Employee Insurances</a></li>
          <li class=""><a href="<?= base_url(); ?>Insurance/view_claims">Insurance Claims</a></li>


          <!-- REPORTS -->
          <?php elseif($controllerName == 'reports'): ?>
          <li class=""><a href="<?= base_url(); ?>Reports/employees">Employees</a></li>
          <li><a href="<?= base_url(); ?>Reports/complaints">Complaints</a></li> 
          <li><a href="<?= base_url(); ?>Reports/terminations">Terminations</a></li>
          <li><a href="<?= base_url(); ?>Reports/resignations">Resignations</a></li>
          <li><a href="<?= base_url(); ?>Reports/trainings">Trainings</a></li>
          <li><a href="<?= base_url(); ?>Reports/activity">Activity</a></li>
          <li><a href="<?= base_url(); ?>Reports/tests">Tests</a></li>
          <li><a href="<?= base_url(); ?>Reports/events">Events</a></li>
          <li><a href="<?= base_url(); ?>Reports/training_calendar">Training Calendar</a></li>


          <!-- RESIGNATIONS -->
          <?php elseif($controllerName == 'resignations'): ?>
          <li><a href="<?= base_url(); ?>Resignations/view">List Resignations</a></li>


          <!-- TERMINATIONS -->
          <?php elseif($controllerName == 'terminations'): ?>
          <li class=""><a href="<?= base_url(); ?>Terminations/add">Add Termination</a></li>
          <li><a href="<?= base_url(); ?>Terminations/view">List Terminations</a></li>


          <!-- USER PANEL -->
          <?php elseif($controllerName == 'user_panel'): ?>
          <li class=""><a href="<?= base_url(); ?>User_panel">Dashboard</a></li>
          <li><a href="<?= base_url(); ?>User_panel/basic_info">Basic Info</a></li>
          <li><a href="<?= base_url(); ?>User_panel/policies">Policies</a></li>
          <li><a href="<?= base_url(); ?>User_panel/payroll">Payroll Info</a></li>
          <li><a href="<?= base_url(); ?>User_panel/leave_management">Leave Management</a></li>
          <li><a href="<?= base_url(); ?>User_panel/resignation">Resignation</a></li>
          <li><a href="<?= base_url(); ?>User_panel/trainings">Trainings</a></li>
          <li><a href="<?= base_url(); ?>User_panel/new_card">Card Request</a></li>
          <!-- <li><a href="<?= base_url(); ?>User_panel/investigation">Investigation</a></li> -->
          <li><a href="<?= base_url(); ?>User_panel/insurance">Insurance</a></li>

          <?php endif; ?>

          
        </ul>

        <?php $session = $this->session->userdata('username'); ?>
        
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?= base_url(); ?>Logout">Logout</a></li>
          <li>
            <a href="<?= base_url(); ?>User_panel">
              
              <?php echo $session['username']; ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</section>