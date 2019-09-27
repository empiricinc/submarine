	<?php $this->load->view('html/header'); ?>
	
	<style type="text/css">

		.dropdown>a {
			margin: 0px !important;
			padding: 15px !important;
		}
		
		.dropdown-menu>li>a {
			margin: 0px !important;
			padding: 8px !important;
		}

		.dropdown-menu>li>a:hover {
			background: #000;
		}

		.dropdown-menu {
			background: #3a3b3c;
		}

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



		@media screen {
		    .hide-from-screen {
		        display: none;
		    }
		}

		@media print {
			@page {
				margin: 0;
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
	