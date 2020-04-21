<?php $page_title = 'School'; ?>

<?php require_once '../app/views/admin/includes/header.php'; ?>

<?php require_once '../app/views/admin/includes/sidebar.php'; ?>

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
                        <h3 class="text-themecolor">School</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Update School</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>INCOME</small></h6>
                                    <h4 class="m-t-0 text-info"><?=School::currency_formatter(AdminIncome::find(1)->income)?></h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
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
                        <?php
                            $school = School::find($data['id']);

                            function active($val){
                                if($val->blocked_on === NULL){
                                    return '<a style="color: white;" class="btn btn-danger" href="/admin-manager/block-school/' . $val->id . '">Block</a>';
                                }else{
                                    return '<a style="color: white;" class="btn btn-success" href="/admin-manager/unblock-school/' . $val->id . '">Activate</a>';
                                }
                            }

                            function active_icon($val)
                            {
                                if($val->blocked_on === NULL){
                                    return '<i style="color: green;" class="fa fa-circle"></i> Active';
                                }else{
                                    return '<i style="color: red;" class="fa fa-circle"></i> Blocked';
                                }
                            }

                        ?>
                            <div class="card-body">
                                    <?=active($school)?>
                                <center class="m-t-30"> <img src="<?=$this->domain()?>/<?=$school->logo?>" class="img-circle" width="150" height="150" />
                                    <h4 class="card-title m-t-10"><?=$school->name?></h4>
                                    <h6 class="card-subtitle"><?=active_icon($school)?></h6>
                                    <form action="<?=$this->domain()?>/admin-manager/upload-school-logo/<?=$data['id']?>" method="post" enctype="multipart/form-data">
                                        <input onchange="form.submit()" style="display: none;" type="file" class="form-control" name="logo" id="logo" placeholder="School Logo">
                                    </form>
                                    <button style="cursor: pointer; color: white;" onclick="document.getElementById('logo').click();" class="form-control btn-info">Update Logo</button>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="No of Students" class="fa fa-users"></i> <font class="font-medium"><?=$school->users->count()?></font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="No of Guardians" class="fa fa-user-secret"></i> <font class="font-medium"><?=$school->guardians->count()?></font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?=$school->email?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?=$school->phone?></h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6><?=$school->address?>, <?=$school->city?>, <?=$school->state?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit School</h4>
                                <form class="form-horizontal p-t-20" action="/admin-manager/update-school/<?=$school->id?>" method="post">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 control-label">Name*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$school->name?>" class="form-control" name="name" id="name" placeholder="Name of admin">
                                                
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
                                                <input type="email" value="<?=$school->email?>" class="form-control" name="email" id="email" placeholder="Email">
                                                
                                            </div>
                                            <?=$this->InputError('email')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 control-label">Phone*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-mobile"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$school->phone?>" class="form-control" name="phone" id="phone" placeholder="phone">
                                                
                                            </div>
                                            <?=$this->InputError('phone')?>
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
                                                <input type="text" value="<?=$school->address?>" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                
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
                                                        <i class="ti-tag"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$school->city?>" class="form-control" name="city" id="city" placeholder="Enter City">
                                                
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
                                                <input type="text" value="<?=$school->state?>" class="form-control" name="state" id="state" placeholder="Enter State">
                                                
                                            </div>
                                            <?=$this->InputError('state')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                        </div>
                                    </div>
                                </form>
                                <a style="color: white;" class="btn btn-primary" onclick="resetPassword(<?=$data['id']?>)">Reset Password</a>
                            </div>
                        </div>
                    </div>
                </div>

                <script language="javascript">
                    function resetPassword(id)
                    {
                        if(confirm("Resetting a password would set school's password back to default value. Are you sure you want to proceed?")){
                            window.location.href='<?=$this->domain()?>' + '/admin-manager/school-reset-password/' + id;
                            return true;
                        }
                    }
                </script>
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/admin/includes/footer.php'; ?>