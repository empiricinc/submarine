<?php
/* Filename: head.php
*  Location: views/test-system/components/head.php
*  Author: Saddam
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta name="og:card" content="" />
	<meta name="og:description" content="" />
	<meta name="og:title" content="" />
	<meta name="og:image" content="" />


	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,700,800|Roboto:400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('skin/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('skin/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
</head>
<body>
<section class="secnavMain">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span> 
        </button>
        <a class="navbar-brand" href="<?php echo base_url();?>dashboard"><div class="hrms-logo">HRMS</div></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class=""><a href="<?php echo base_url('tests'); ?>">Home</a></li>
          <li><a href="<?php echo base_url('tests/add_questions'); ?>">create exam</a></li>
          <li><a href="<?php echo base_url('tests/all_questions'); ?>">questions</a></li>
          <li><a href="<?php echo base_url('tests/results'); ?>">results / reports</a></li>
          <li><a href="<?php echo base_url('tests/add_result'); ?>">add result</a></li>
          <li><a href="<?php echo base_url('tests/create_paper'); ?>">create paper</a></li>
          <li><a href="<?php echo base_url('tests/applicants'); ?>">applicants</a></li>
          <li id="appeared"><a href="<?php echo base_url('tests/total_appeared'); ?>">appeared</a></li>
          <li><a href="<?php echo base_url('tests/projects'); ?>">projects</a></li>
          <li><a href="<?php echo base_url('tests/jobs'); ?>">jobs</a></li>
          <li><a href="<?php echo base_url('tests/list_papers'); ?>">papers</a></li>
          <!-- <li><a href="<?php //echo base_url('tests/reports'); ?>"></a></li> -->
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
            <?php if($this->session->userdata('username')): ?>
              <a href="<?php echo base_url('logout'); ?>">
              <img src="<?php echo base_url('assets/img/profile.png'); ?>" alt="">
              Logout &nbsp; <i class="fa fa-sign-out"></i>  
            </a>
            <?php else: ?>
            <a href="#">
              <img src="<?php echo base_url('assets/img/profile.png'); ?>" alt="">
              Haseeb Khattak
              <span class="caret"></span>    
            </a>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</section>