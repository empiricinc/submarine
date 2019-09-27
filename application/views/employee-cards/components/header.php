<!DOCTYPE html>
<html>
<head>
	<title>Employee's Card</title>
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

	<link rel="icon" href="" >
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:400,700,800|Roboto:400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url(); ?>dashboardDesign/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>dashboardDesign/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>dashboardDesign/assets/css/style.css">

	<!-- <link rel="stylesheet" href="<?php echo base_url();?>skin/css/core.css"> -->
	<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/DataTables/Buttons/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/select2/dist/css/select2.min.css">

   	<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/clockpicker/dist/bootstrap-clockpicker.min.css">
   	<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/jquery-ui/jquery-ui.css">

   	<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/toastr/toastr.min.css">
	
	<style type="text/css">
		/* Container holding the image and the text */
		.card-container {
		    position: relative;
		    /*text-align: center;*/
		    color: black;
		}


		.card-emp-picture {
		    position: absolute;
		    top: 16.9%;
		    left: 5%;
		}
		.card-emp-name {
		    position: absolute;
		    top: 48%;
		    left: 6%;
		    font-weight: bold;
		    font-size: 11px;

		    color: #0000FF;
		}
		.card-province-logo {
		    position: absolute;
		    top: 18%;
		    left: 49%;
		}

		.card-district-heading{
		    position: absolute;
		    top: 56%;
		    left: 36.6%;
		    font-weight: bold;
		    font-size: 12px;
		    color: #2f4f44;
		}

		.card-tehsil-uc-area-heading{
		    position: absolute;
		    top: 67%;
		    left: 35%;
		    font-weight: bold;
		    font-size: 12px;
		    color: #2f4f44;
		}

		.card-district{
		    position: absolute;
		    top: 56%;
		    left: 52%;
		    font-weight: bold;
		    font-size: 11px;

		    color: #0000FF;
		}

		.card-uc{
		    position: absolute;
		    top: 68%;
		    left: 52%;
		    font-weight: bold;
		    font-size: 11px;

		    color: #0000FF;
		}

		.card-emp-id{
		    position: absolute;
		    top: 86%;
		    left: 66%;
		    font-weight: bold;
		    font-size: 11px;
		    color: #0000FF;
		}


		.card-job-type{
		    position: absolute;
		    top: 55%;
		    left: 6%;
		    font-weight: bold;
		    font-size: x-small;
		    color: #0000FF;
		}

		/* Card Rear */
		.card-cnic{
		    position: absolute;
		    top: 16.5%;
		    left: 23%;
		    font-weight: bold;
		    font-size: 12px;
		    color: #0000FF;
		    letter-spacing: 1.09rem;
		}
		.card-other-id-name{
		    position: absolute;
		    top: 23%;
		    left: 30%;
		    font-weight: normal;
		    font-size: x-small;
		    color: #0000FF;
		}

		.card-date-of-birth{
		    position: absolute;
		    top: 28%;
		    left: 29%;
		    font-weight: bold;
		    font-size: x-small;
		    color: #0000FF;
		}
		.card-emergency{
		    position: absolute;
		    top: 40%;
		    left: 44%;
		    font-weight: bold;
		    font-size: x-small;
		    color: #0000FF;
		}

		.card-issue-date{
		    position: absolute;
		    top: 40%;
		    left: 80%;
		    font-weight: bold;
		    font-size: x-small;
		    color: #0000FF;
		}
		.temporary-card-issue-date{
		    position: absolute;
		    top: 50%;
		    right: 62%;
		    font-weight: bold;
		    font-size: x-small;
		    color: #0000FF;
		}

		.card-expiry-date{
		    position: absolute;
		    top: 50%;
		    right: 19%;
		    font-weight: bold;
		    font-size: x-small;
		    color: #0000FF;
		}
		.card-lost-location{
		    position: absolute;
		    top: 80%;
		    left: 11%;
		    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
		    font-weight: bold;
		    font-size: x-small;
		    color: #0000FF;
		}
		.card-sign-authority{
		    position: absolute;
		    top: 93%;
		    left: 5.5%;
		    font-weight: 900;
		    font-size: x-small;
		    color: #0000FF;
		}
		.card-authority-signature{
		    position: absolute;
		    top: 70%;
		    left: 30%;

		}



		/*
	</style>

   	<style type="text/css">

		tr {
			cursor: pointer;
		}

		.modal-body .form-control {
		  border-color: #e1e4e7;
		  box-shadow: 0 0 0 0;
		  min-height: 45px;
		  background-color: #f6f7f8;
		  border-radius: 3px;
		  margin-top: 10px;
		}

		.modal-footer .btnSubmit {
		  background-color: #3e8df7;
		  padding: 10px 90px;
		  border-radius: 3px;
		  box-shadow: 0 0 0 0;
		  border: 0px;
		  color: #fff;
		}

		.tabelTopBtn {
			padding-top: 0px !important;
		}



		@media screen {
		    .hide-from-screen {
		        display: none;
		    }
		}

		@media print {
			@page {
				margin: 0;
			}


			.modal-content{
			    border: 0px;
			}

			.marginLR {
				margin-top: 0px;
				margin-left: 20px;
				margin-right: 20px;
			}
			
			.hide-from-print {
				display: none;
			}

			.remove-padding-print {
				padding: 0px !important;
			}

			.remove-margin-print {
				margin: 0px !important;
			}

			.no-border-print {
				border: none !important;
			}

			.no-padding-print {
				padding-left: 0px;
				padding-right: 0px;
			}

			/*.no-padding {
				padding-left: 0px !important;
				padding-right: 0px !important;
			}*/
			.border {
				border: 1px dashed #808080;
				padding: 5px !important;
			}

			.font-12 {
				font-size: 12px !important;
			}

			.col-print-1 {width:8%;  float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-2 {width:16%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-3 {width:25%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-4 {width:33%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-5 {width:42%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-6 {width:50%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-7 {width:58%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-8 {width:66%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-9 {width:75%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-10{width:83%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-11{width:92%; float:left; padding-left: 0px; padding-right: 0px;}
			.col-print-12{width:100%; float:left; padding-left: 0px; padding-right: 0px;}
		}
	</style>


</head>
<body>
	