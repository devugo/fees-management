<?php $page_title = 'Edit Subscription'; ?>

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
                        <h3 class="text-themecolor">Subscription</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Edit Subscription</li>
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
                <?php
                    $subscription_plan = SubscriptionType::find($data['id']);
                    //print_r($subscription_plan);
                ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="ribbon-wrapper card">
                                    <div class="ribbon ribbon-bookmark  ribbon-default"><?=$subscription_plan->name?></div>
                                    <h2><i class="ti-email" style="color: red;"></i> <?=$subscription_plan->sms?> SMS</h2><hr>
                                    <h2><i class="ti-server" style="color: blue;"></i> <?=$subscription_plan->email?> Email</h2><hr>
                                    <h2>Cost: NGN<?=$subscription_plan->amount?>.00</h2><hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Subscription Plan</h4>
                                <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/admin-manager/update-subscription-plan/<?=$data['id']?>" method="post">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 control-label">Name*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$subscription_plan->name?>" class="form-control" name="name" id="name" placeholder="Name of admin">
                                                
                                            </div>
                                            <?=$this->InputError('name')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-2 control-label">Amount*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-direction-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="number" min="1" value="<?=$subscription_plan->amount?>" class="form-control" name="amount" id="amount" placeholder="Enter Amount">
                                                
                                            </div>
                                            <?=$this->InputError('amount')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sms" class="col-sm-2 control-label">SMS*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="number" min="1" value="<?=$subscription_plan->sms?>" class="form-control" name="sms" id="sms" placeholder="Enter SMS Qty">
                                                
                                            </div>
                                            <?=$this->InputError('sms')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 control-label">Email*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="number" min="1" value="<?=$subscription_plan->email?>" class="form-control" name="email" id="email" placeholder="Enter Email Qty">
                                                
                                            </div>
                                            <?=$this->InputError('email')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>


                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/admin/includes/footer.php'; ?>