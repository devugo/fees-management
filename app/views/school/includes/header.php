<!DOCTYPE html>
<html lang="en">

<?php
    $site_logo = Admin::find(1)->logo;
?>
<!-- Mirrored from wrappixel.com/demos/admin-templates/material-pro/minisidebar/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 08:20:51 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=Config::get('default/project_description')?>">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$this->domain()?>/<?=$site_logo?>">
    <title><?=Config::get('default/project_title')?> | <?=$page_title?></title>
    
    <!-- Bootstrap Core CSS -->
    <link href="<?=$assets?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- chartist CSS -->
    <link href="<?=$assets?>/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="<?=$assets?>/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="<?=$assets?>/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="<?=$assets?>/plugins/css-chart/css-chart.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="<?=$assets?>/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="<?=$assets?>/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="<?=$assets?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?=$assets?>/css/colors/default-dark.css" id="theme" rel="stylesheet">

    <link href="<?=$assets?>/plugins/datatables/media/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">

    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
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
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== --><?=Session::flash('flash')?>
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?=$this->domain()?>/home">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            
                            <img src="<?=$this->domain()?>/<?=$site_logo?>" alt="homepage" width="35" height="35" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?=$this->domain()?>/<?=$site_logo?>" alt="homepage" width="35" height="35" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- dark Logo text -->
                         <!-- Light Logo text -->    
                         BILLS MANAGEMENT</span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                        <?php
                        if($this->admin()){
                            echo '<a href="' . $this->domain() . '/admin/dashboard" class="btn btn-info">Back Home</a>';
                        }
                        ?>
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                <ul>
                                    <li>
                                        <div class="drop-title">Notifications</div>
                                    </li>
                                    <li>
                                    <?php
                                        $admin_notifications = $this->school()->notifications->sortByDesc('id');
                                        $admin_pix = Admin::find(1)->logo;
                                        function get_time($val)
                                        {
                                            if(date("Y-m-d") == date("Y-m-d", strtotime($val->created_at))){
                                                if(date("H", strtotime($val->created_at)) >= 12){
                                                    return date("H:i", strtotime($val->created_at)) . 'PM';
                                                }else{
                                                    return date("H:i", strtotime($val->created_at)) . 'AM';
                                                }
                                                return date("H:i", strtotime($val->created_at));
                                            }else{
                                                return $val->created_at->toFormattedDateString();
                                            }
                                        }
                                    ?>
                                        <div class="message-center">
                                        <?php
                                        $noti_control = 0;
                                            foreach($admin_notifications as $notification){
                                                if($noti_control == 3){
                                                    break;
                                                }   
                                                ?>
                                                <a href="<?=$this->domain()?>/school/view-notification/<?=$notification->id?>">
                                                    <div class="user-img"> <img src="<?=$this->domain()?>/<?=$admin_pix?>" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                                    <div class="mail-contnet">
                                                        <h5>Admin</h5> <span class="mail-desc"><?=$notification->title?></span> <span class="time"><?=get_time($notification)?></span> </div>
                                                </a><?php
                                                $noti_control++;
                                            }
                                        ?>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center" href="<?=$this->domain()?>/school/notification"> <strong>See all Notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?=$this->domain()?>/<?=$this->school()->logo?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?=$this->domain()?>/<?=$this->school()->logo?>" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?=$this->school()->name?></h4>
                                                <p class="text-muted"><?=$this->school()->email?></p><a href="<?=$this->domain()?>/school/profile" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?=$this->domain()?>/school/profile"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="<?=$this->domain()?>/school/subscription"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li><a href="<?=$this->domain()?>/school/notification"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?=$this->domain()?>/school/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->