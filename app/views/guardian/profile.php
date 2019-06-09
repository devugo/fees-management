<?php $page_title = 'Profile'; ?>

<?php require_once 'app/views/guardian/includes/header.php'; ?>

<?php require_once 'app/views/guardian/includes/sidebar.php'; ?>

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
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor"><?=$this->guardian()->school->name?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Update Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="<?=$this->domain()?>/<?=$this->guardian()->profile_pix?>" class="img-circle" width="150" height="150" />
                                    <h4 class="card-title m-t-10"><?=$this->guardian()->lastname?> <?=$this->guardian()->firstname?></h4>
                                    <h6 class="card-subtitle"><?=($this->guardian()->blocked()) ? '<i style="color: red;" class="fa fa-circle"></i> Blocked' : '<i style="color: green;" class="fa fa-circle"></i> Active' ?></h6>
                                    <form action="<?=$this->domain()?>/guardian-manager/update-profile_pix" method="post" enctype="multipart/form-data">
                                        <input onchange="form.submit()" style="display: none;" type="file" class="form-control" name="profile_pix" id="profile_pix" placeholder="Guardian Image">
                                    </form>
                                    <button style="cursor: pointer; color: white;" onclick="document.getElementById('profile_pix').click();" class="form-control btn-info">Update Profile Picture</button>
                                    <div class="row text-center justify-content-md-center">
                                        <div data-toggle="tooltip" data-placement="top" title="" data-original-title="Total Number of Wards" class="col-4"><a href="<?=$this->domain()?>/guardian/ward" class="link"><i class="icon-people"></i> <font class="font-medium"><?=$this->guardian()->users->count()?></font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?=$this->guardian()->email?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?=$this->guardian()->phone?></h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6><?=$this->guardian()->address?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Profile</h4>
                                <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/guardian-manager/update-profile" method="post">
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-3 control-label">Firstname*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->guardian()->firstname?>" class="form-control" name="firstname" id="firstname" placeholder="Firstname">
                                                
                                            </div>
                                            <?=$this->InputError('firstname')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 control-label">Lastname*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->guardian()->lastname?>" class="form-control" name="lastname" id="lastname" placeholder="Lastname">
                                                
                                            </div>
                                            <?=$this->InputError('lastname')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <?php
                                            function sex($name, $val)
                                            {
                                                if($name->sex == $val){
                                                    return 'selected';
                                                }
                                            }
                                        ?>
                                        <label for="sex" class="col-sm-3 control-label">Sex*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <select name="sex" id="sex" class="form-control">
                                                    <option value="Male" <?=sex($this->guardian(), 'Male')?>>Male</option>
                                                    <option value="Female" <?=sex($this->guardian(), 'Female')?>>Female</option>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('sex')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 control-label">Address*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-pin"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->guardian()->address?>" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                
                                            </div>
                                            <?=$this->InputError('address')?>
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
                                                <input type="text" value="<?=$this->guardian()->phone?>" class="form-control" name="phone" id="phone" placeholder="Enter Phone No">
                                                
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
                                <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/guardian-manager/change-password" method="post">
                                    <div class="form-group row">
                                        <label for="old_password" class="col-sm-3 control-label">Old Password*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-key"></i>
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
                                                        <i class="ti-key"></i>
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
                                                        <i class="ti-key"></i>
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
    <?php require_once 'app/views/guardian/includes/footer.php'; ?>