<?php defined('BASEPATH') OR exit('No direct script access allowed!');
/* Filename: head.php
*  Author: Saddam
*  Filepath: views / training-files / components / head.php
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
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
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
          <li class=""><a href="<?php echo base_url('trainings'); ?>">home</a></li>
          <li><a href="<?php echo base_url('trainings/add_trainings'); ?>">create training</a></li>
          <li><a href="<?php echo base_url('trainings/all_trainings'); ?>">trainings list</a></li>
          <li><a href="<?php echo base_url('trainings/trainers'); ?>">trainers list</a></li>
          <li><a href="<?php echo base_url('trainings/add_allowances'); ?>">allowances</a></li>
          <li id="appeared"><a href="<?php echo base_url('trainings/locations'); ?>">locations</a></li>
          <li><a href="<?php echo base_url('trainings/stay_hotels'); ?>">stay hotels</a></li>
          <li><a href="<?php echo base_url('trainings/attendance_view'); ?>">attendance</a></li>
          <li><a href="<?php echo base_url('trainings/get_calendar'); ?>">evts calendar</a></li>
          <li><a href="<?php echo base_url('trainings/training_reports'); ?>">reports</a></li>
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