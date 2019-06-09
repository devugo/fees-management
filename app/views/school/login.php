<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/minisidebar/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 08:38:33 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <?php $site_logo = Admin::find(1)->logo; ?>
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$this->domain()?>/<?=$site_logo?>">
    <title><?=Config::get('default/project_title')?> | School Login</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=$assets?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=$assets?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?=$assets?>/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    
    <section id="wrapper">
        <div class="login-register" style="background-color: grey; background-image:url();">
            
            <!--<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> You have been signed in successfully!
            </div>-->

            <div class="login-box card"><?=Session::flash('flash')?>
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" method="post" action="<?=Config::get('default/domain')?>/school-manager/authenticate">
                        <h3 class="box-title m-b-20">School Sign In</h3>
                        
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="email" placeholder="Email"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="password"placeholder="Password"> </div>
                        </div>
                        <?=Token::csrf()?>
                        <div class="form-group">
                            <div class="d-flex no-block align-items-center">
                                <div class="checkbox checkbox-primary p-t-0">
                                    <input id="checkbox-signup" type="checkbox" name="remember">
                                    <label for="checkbox-signup"> Remember me </label>
                                </div> 
                                <div class="ml-auto">
                                    <a href="javascript:void(0)" id="to-recover" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="submit" type="submit">Log In</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Don't have an account? <a href="<?=$this->domain()?>/register" class="text-info m-l-5"><b>Sign Up</b></a>
                            </div>
                            <div class="col-sm-12 text-center">
                                Are you a guardian? <a href="<?=$this->domain()?>/login/guardian" class="text-info m-l-5"><b>Login Here</b></a>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" id="recoverform" method="post" action="<?=Config::get('default/domain')?>/school-manager/forgot-password">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="email" name="email" required="" placeholder="Email"> </div>
                                <?=$this->InputError('email')?>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" name="submit" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?=$assets?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=$assets?>/plugins/popper/popper.min.js"></script>
    <script src="<?=$assets?>/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=$assets?>/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?=$assets?>/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=$assets?>/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?=$assets?>/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?=$assets?>/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=$assets?>/js/custom.min.js"></script>
    <!--DevugpNotifications-->
    <script src="<?=$assets?>/js/devugonotifications.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?=$assets?>/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    
    
</body>

<?php Session::delete('inputs-errors');?>
<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/minisidebar/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 08:38:34 GMT -->
</html>