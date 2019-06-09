 <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(<?=$assets?>/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?=$this->domain()?>/<?=$this->guardian()->school->logo?>" alt="user" /> </div>
                    <!-- User profile text-->
                    <div style="color: red !important;" class="profile-text"> <a role="button" aria-haspopup="true" aria-expanded="true"><?=$this->guardian()->school->name?></a>
                        
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/guardian/dashboard" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/guardian/profile" aria-expanded="false"><i class="fa fa-user-secret"></i><span class="hide-menu">Profile </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/guardian/ward" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Wards </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/guardian/fee" aria-expanded="false"><i class="fa fa-briefcase"></i><span class="hide-menu">Fees </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/guardian/notification" aria-expanded="false"><i class="fas fa-bell"></i><span class="hide-menu">Notifications </span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item--><!--<a href="<?=$this->domain()?>/guardian/settings" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>-->
                <!-- item--><a href="<?=$this->domain()?>/guardian/notification" class="link" data-toggle="tooltip" title="Notifications"><i class="fa fa-bell"></i></a>
                <!-- item--><a href="<?=$this->domain()?>/guardian/logout" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->