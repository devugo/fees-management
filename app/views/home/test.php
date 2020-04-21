<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Page Title -->
    <title>Fees Management - Home</title>
    <meta content="Fees Management system to manage every incoming ang outgoing money in a school" name="description">
	<meta content="fees, fees management, school fees, school bills, bills, bills management, school fees management, bill, school bill, expense management" name="keywords">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=$this->domain()?>/<?=Admin::find(1)->logo?>" type="image/x-icon">

    <!-- CSS Files -->
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?=$assets?>/home/css/animate-3.7.0.css">
    <link rel="stylesheet" href="<?=$assets?>/home/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="<?=$assets?>/home/fonts/flat-icon/flaticon.css">
    <link rel="stylesheet" href="<?=$assets?>/home/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="<?=$assets?>/home/css/owl-carousel.min.css">
    <link rel="stylesheet" href="<?=$assets?>/home/css/nice-select.css">
    <link rel="stylesheet" href="<?=$assets?>/home/css/style.css">
</head>
<body>
    <!-- Preloader Starts -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- Preloader End -->

    <!-- Header Area Starts -->
    <header class="header-area single-page">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo-area">
                            <a href=""><img src="<?=$this->domain()?>/<?=Admin::find(1)->logo?>" width="30" height="30" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="custom-navbar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>  
                        <div class="main-menu main-menu-light">
                            <ul>
                                <li class="active"><a href="">home</a></li>
                                <li><a href="#contact">contact</a></li>
                                <?php
                                if($this->admin()){?>
                                    <li class="menu-btn">
                                        <a href="<?=$this->domain()?>/admin" class="template-btn">dashaord</a>
                                        <a href="<?=$this->domain()?>/home/logout" class="login">log out</a>
                                    </li><?php
                                }else if($this->school()){?>
                                    <li class="menu-btn">
                                        <a href="<?=$this->domain()?>/school" class="template-btn">dashaord</a>
                                        <a href="<?=$this->domain()?>/home/logout" class="login">log out</a>
                                    </li><?php
                                }else if($this->guardian()){?>
                                    <li class="menu-btn">
                                        <a href="<?=$this->domain()?>/guardian" class="template-btn">dashaord</a>
                                        <a href="<?=$this->domain()?>/home/logout" class="login">log out</a>
                                    </li><?php
                                }else{?>
                                    <li class="menu-btn">
                                        <a href="<?=$this->domain()?>/login" class="login">log in</a>
                                        <a href="<?=$this->domain()?>/register" class="template-btn">sign up</a>
                                    </li><?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-title text-center" style="background-image: url('../images/banner-bg.jpg') !important; ">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <h3 style="color: white">Taking your school to greater heights!</h3>
                    </div>
                </div>
            </div>
        </div>
    </header><br><br><?=Session::flash('flash')?>
    <!-- Header Area End -->

    <!-- Contact Form Starts -->
    <section class="contact-form section-padding3">
        <div id="contact">
            <div class="container">
            <h4 style="color: #04091e; border-bottom: solid; width: 30px;">CONTACT</h4><br><br>
                <div class="row">
                    <div class="col-lg-3 mb-5 mb-lg-0">
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="info-text">
                                <h4>Devugo</h4>
                                <p>Santa monica bullevard</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="info-text">
                                <h4>08065674312, 08021181967</h4>
                                <p>Mon to Fri 9am to 6 pm</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="into-icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="info-text">
                                <h4 style="text-transform: lowercase">info@devugo.com</h4>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <form action="<?=$this->domain()?>/home/send-mail" method="post">
                            <div class="left">
                                <input type="text" name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" required>
                                <input type="email" name="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" required>
                                <input type="text" name="subject" placeholder="Enter subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter subject'" required>
                            </div>
                            <div class="right">
                                <textarea name="message" cols="20" rows="7"  placeholder="Enter Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" required></textarea>
                            </div>
                            <button style="cursor: pointer;" type="submit" class="template-btn">SEND</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form End -->


    <!-- Footer Area Starts -->
    <footer style="height: 70px !important; line-height: 70px; margin-top: -100px" class="text-center footer-area">
        <div class="footer-copyright">
            <div class="container">
                 Copyright &copy; Devugo <script>document.write(new Date().getFullYear());</script> All rights reserved | Developed by Devugo
            </div>
        </div>
    </footer>
        <!-- Footer Area End -->


    <!-- Javascript -->
    <script src="<?=$assets?>/home/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="<?=$assets?>/home/js/vendor/bootstrap-4.1.3.min.js"></script>
    <script src="<?=$assets?>/home/js/vendor/wow.min.js"></script>
    <script src="<?=$assets?>/home/js/vendor/owl-carousel.min.js"></script>
    <script src="<?=$assets?>/home/js/vendor/jquery.nice-select.min.js"></script>
    <script src="<?=$assets?>/home/js/vendor/ion.rangeSlider.js"></script>
    <script src="<?=$assets?>/home/js/main.js"></script>
</body>
</html>
