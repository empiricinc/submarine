<?php $system = $this->Xin_model->read_setting_info(1);?>

<?php $company = $this->Xin_model->read_company_setting_info(1);?>

<?php $site_lang = $this->load->helper('language');?>

<?php $lang = $site_lang->session->userdata('site_lang');?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
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
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/style.css">
    <script src="<?php echo base_url();?>/assets/js/jquery.js"></script>
<!-- 
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/bootstrap4/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/themify-icons/themify-icons.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/font-awesome/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/toastr/toastr.min.css">
<!-- <link rel="stylesheet" href="<?php echo base_url();?>skin/css/core.css"> -->
</head>
<body>

        <!-- <h6><?php echo $this->lang->line('xin_welcome_login_page_text');?> </h6> -->

<section class="secLogin">
    <div class="container">
        <div class="loginWhite">
            <div class="row">
                <div class="col-md-6">
                    <div class="mainLeftImg">
                        <div class="loginLogo">
                            <img src="<?php echo base_url();?>/assets/img/loginLogo.png" alt="">
                        </div>
                        <img src="<?php echo base_url();?>/assets/img/login.png" alt="">
                        <p>
                            Traning and consulting staff of civil suciety human and instituional development program (CHIP) in pakistan.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="rightLoginMain">
                    <form class="mb-1" method="post" name="hrm-form" id="hrm-form" data-redirect="dashboard?module=dashboard" data-form-table="login" data-is-redirect="1" action="<?php echo site_url('login/auth');?>">
                        <div class="aligmentWrap">
                            <h3>Login</h3>
                            <div class="loginInput">
                                <!-- <input type="text" class="form-control" placeholder="User Name"> -->
                            <input type="text" class="form-control" name="iusername" id="iusername" placeholder="Username">

                            </div>
                            <div class="loginInput">
                                <!-- <input type="password" class="form-control" placeholder="Password"> -->
                        <input type="password" class="form-control" name="ipassword" id="ipassword" placeholder="Password">

                            </div>
                            <div class="loginInput">
                                <!-- <button class="btn btn-block">
                                    submit
                                </button> -->
                        <button type="submit" class="btn btn-danger btn-block"><?php echo $this->lang->line('xin_sign_in_button');?></button>

                                <!-- <a href="#">Forgot Password?</a> -->
                            <a class="text-white font-90" href="<?php echo site_url('forgot_password');?>"><?php echo $this->lang->line('xin_forgot_password_link');?></a>

                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer></footer>





<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/jquery/jquery-3.2.1.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/tether/js/tether.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/toastr/toastr.min.js"></script> 
<script type="text/javascript">
$(document).ready(function(){
    toastr.options.closeButton = <?php echo $system[0]->notification_close_btn;?>;
    toastr.options.progressBar = <?php echo $system[0]->notification_bar;?>;
    toastr.options.timeOut = 3000;
    toastr.options.preventDuplicates = true;
    toastr.options.positionClass = "<?php echo $system[0]->notification_position;?>";
});

</script>

<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript" src="<?php echo base_url();?>skin/js_module/xin_login.js"></script>
<script src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>/assets/js/custom.js"></script>
</body>
</html>

