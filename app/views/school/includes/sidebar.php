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
                    <div class="profile-img"> <img src="<?=$this->domain()?>/<?=$this->school()->logo?>" alt="user" height="50" width="50" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?=$this->school()->name?></a>
                        <div class="dropdown-menu animated flipInY"> <a href="<?=$this->domain()?>/school/profile" class="dropdown-item"><i class="ti-user"></i> My Profile</a> <a href="<?=$this->domain()?>/school/subscription" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> <a href="<?=$this->domain()?>/school/notification" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> <a href="<?=$this->domain()?>/school/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/school/dashboard" aria-expanded="false"><i class="fa fa-home"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/school/profile" aria-expanded="false"><i class="fa fa-clock"></i><span class="hide-menu">Profile </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu">Structure</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?=$this->domain()?>/school/class">Classes</a></li>
                                <li><a href="<?=$this->domain()?>/school/arm">Arms</a></li>
                                <li><a href="<?=$this->domain()?>/school/term">Terms</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="ti-money"></i><span class="hide-menu">Administration</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?=$this->domain()?>/school/fee">Fee</a></li>
                                <li><a href="<?=$this->domain()?>/school/bonus">Bonus</a></li>
                                <li><a href="<?=$this->domain()?>/school/payment">Payment</a></li>
                                <li><a href="<?=$this->domain()?>/school/expenses">Expense</a></li>
                                <li><a href="<?=$this->domain()?>/school/subscription">Subscription</a></li>
                            </ul>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/school/guardian" aria-expanded="false"><i class="fa fa-user-secret"></i><span class="hide-menu">Guardians </span></a>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/school/student" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Students </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-braille"></i><span class="hide-menu">Reports</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?=$this->domain()?>/school/view-report/incoming">Incoming</a></li>
                                <li><a href="<?=$this->domain()?>/school/view-report/outgoing">Outgoing</a></li>
                            </ul>
                        </li>
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/school/broadcast" aria-expanded="false"><i class="fa fa-bullhorn"></i><span class="hide-menu">Broadcasts </span></a>
                        </li>
                        
                        <li><a class="waves-effect waves-dark" href="<?=$this->domain()?>/school/ticket" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Tickets </span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item--><a href="<?=$this->domain()?>/school/settings" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item--><a href="<?=$this->domain()?>/school/notification" class="link" data-toggle="tooltip" title="Notifications"><i class="fas fa-bell"></i></a>
                <!-- item--><a href="<?=$this->domain()?>/school/logout" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a> </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->