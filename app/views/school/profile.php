<?php $page_title = 'Profile'; ?>

<?php require_once '../app/views/school/includes/header.php'; ?>

<?php require_once '../app/views/school/includes/sidebar.php'; ?>

        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <?php
                    $school = $this->school();
                    $sum_of_expenses = $school->expenses->sum('amount');
                    
                    

                ?>
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">Profile</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Update Profile</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>INCOME</small></h6>
                                    <h4 class="m-t-0 text-info"><?=School::currency_formatter($this->school()->income->amount)?></h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>EXPENSES</small></h6>
                                    <h4 class="m-t-0 text-primary"><?=School::currency_formatter($sum_of_expenses)?></h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="<?=$this->domain()?>/<?=$this->school()->logo?>" class="img-circle" width="150" height="150" />
                                    <h4 class="card-title m-t-10"><?=$this->school()->name?></h4>
                                    <h6 class="card-subtitle"><?=($this->school()->blocked()) ? '<i style="color: red;" class="fa fa-circle"></i> Blocked' : '<i style="color: green;" class="fa fa-circle"></i> Active'?></h6>
                                    <form action="<?=$this->domain()?>/school-manager/upload-logo" method="post" enctype="multipart/form-data">
                                        <input onchange="form.submit()" style="display: none;" type="file" class="form-control" name="logo" id="logo" placeholder="School Logo">
                                    </form>
                                    <button style="color: white; cursor: pointer;" onclick="document.getElementById('logo').click();" class="form-control btn-info">Update Logo</button>
                                    <div class="row text-center justify-content-md-center">
                                        <div data-toggle="tooltip" data-placement="top" title="" data-original-title="Total number of guardians" class="col-4"><a href="javascript:void(0)" class="link"><i class="fa fa-user-secret"></i> <font class="font-medium"><?=$this->school()->guardians->count()?></font></a></div>
                                        <div data-toggle="tooltip" data-placement="top" title="" data-original-title="Total number of students" class="col-4"><a href="javascript:void(0)" class="link"><i class="fa fa-users"></i> <font class="font-medium"><?=$this->school()->users->count()?></font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?=$this->school()->email?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?=$this->school()->phone?></h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6><?=$this->school()->address?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Profile</h4>
                                <form class="form-horizontal p-t-20" action="/school-manager/update-profile" method="post">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 control-label">Name*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->school()->name?>" class="form-control" name="name" id="name" placeholder="Name of school">
                                                
                                            </div>
                                            <?=$this->InputError('name')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label">Email*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-email"></i>
                                                    </span>
                                                </div>
                                                <input type="email" value="<?=$this->school()->email?>" class="form-control" name="email" id="email" placeholder="Email">
                                                
                                            </div>
                                            <?=$this->InputError('email')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 control-label">Address*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-direction-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->school()->address?>" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                
                                            </div>
                                            <?=$this->InputError('address')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-3 control-label">City*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-mobile"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->school()->city?>" class="form-control" name="city" id="city" placeholder="Enter City">
                                                
                                            </div>
                                            <?=$this->InputError('city')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="state" class="col-sm-3 control-label">State*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-tag"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->school()->state?>" class="form-control" name="state" id="state" placeholder="Enter State">
                                                
                                            </div>
                                            <?=$this->InputError('state')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 control-label">Phone*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        +234
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->school()->phone?>" class="form-control" name="phone" id="phone" placeholder="Enter Phone No">
                                                
                                            </div>
                                            <?=$this->InputError('phone')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                        </div>
                                    </div>
                                </form>

                                <hr>
                                <h4>Change Password</h4>
                                <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/school-manager/change-password" method="post">
                                    <div class="form-group row">
                                        <label for="old_password" class="col-sm-3 control-label">Old Password*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old password">
                                                
                                            </div>
                                            <?=$this->InputError('old_password')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password" class="col-sm-3 control-label">New Password*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New password">
                                                
                                            </div>
                                            <?=$this->InputError('new_password')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password_again" class="col-sm-3 control-label">New Password Again*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="password" class="form-control" name="new_password_again" id="new_password_again" placeholder="New password Again">
                                                
                                            </div>
                                            <?=$this->InputError('new_password_again')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Change Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/school/includes/footer.php'; ?>