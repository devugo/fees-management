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
                    <div class="profile-img"> <img src="<?=$this->domain()?>/<?=$this->admin()->logo?>" alt="user" width="50" height="50"  /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?=$this->admin()->name?></a>
                        <div class="dropdown-menu animated flipInY"> <a href="<?=$this->domain()?>/admin/profile" class="dropdown-item"><i class="ti-user"></i> My Profile</a> <a href="<?=$this->domain()?>/admin/subscription" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> <a href="<?=$this->domain()?>/admin/notification" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> <a href="<?=$this->domain()?>/admin/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/admin/dashboard" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/admin/profile" aria-expanded="false"><i class="fa fa-clock"></i><span class="hide-menu">Profile </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/admin/school" aria-expanded="false"><i class="fa fa-archive"></i><span class="hide-menu">Schools </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/admin/payment" aria-expanded="false"><i class="fa fa-briefcase"></i><span class="hide-menu">Payments </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/admin/subscription" aria-expanded="false"><i class="fa fa-bullseye"></i><span class="hide-menu">Subscriptions </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/admin/notification" aria-expanded="false"><i class="fas fa-bell"></i><span class="hide-menu">Notifications </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/admin/ticket" aria-expanded="false"><i class="fas fa-assistive-listening-systems"></i><span class="hide-menu">Tickets </span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item--><a href="<?=$this->domain()?>/admin/settings" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item--><a href="<?=$this->domain()?>/admin/notification" class="link" data-toggle="tooltip" title="Notifications"><i class="fa fa-bell"></i></a>
                <!-- item--><a href="<?=$this->domain()?>/admin/logout" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->