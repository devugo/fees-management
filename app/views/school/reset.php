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
    <title><?=Config::get('default/project_title')?> | School Reset Password</title>
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
            <?=Session::flash('flash')?>
            <!--<div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> You have been signed in successfully!
            </div>-->

            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" method="post" action="<?=Config::get('default/domain')?>/school-manager/reset-school-password/<?=$data['token']?>">
                        <h3 class="box-title m-b-20">Reset Password</h3>
                        
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="new_password" placeholder="New Password"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="new_password_again" placeholder="New Password again"> </div>
                        </div>
                        <?=Token::csrf()?>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="submit" type="submit">Change</button>
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


<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/minisidebar/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 08:38:34 GMT -->
</html>