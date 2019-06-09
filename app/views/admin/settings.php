<?php $page_title = 'Settings'; ?>

<?php require_once 'app/views/admin/includes/header.php'; ?>

<?php require_once 'app/views/admin/includes/sidebar.php'; ?>

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
                        <h3 class="text-themecolor">Settings</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
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
                $mail  = new Mail();
                $mail->sendMail('ugoezenwankwo@gmail.com', 'test', 'This is body', 'ugo');
                    $settings = AdminSettings::find(1);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">PayStack Settings</h4>
                                <div class="container">
                                    <form action="<?=$this->domain()?>/admin-manager/update_paystack_settings" method="post">
                                        <div class="row">
                                            <label for="public_key" class="col-lg-2">Public Key</label>
                                            <div class="col-lg-10">
                                                <input type="text" value="<?=$settings->public_key?>" name="public_key" id="public_key" class="form-control" placeholder="Public Key" required>
                                            </div>
                                            <?=$this->InputError('public_key')?>
                                        </div><hr>
                                        <div class="row">
                                            <label for="secret_key" class="col-lg-2">Secret Key</label>
                                            <div class="col-lg-10">
                                                <input type="text" value="<?=$settings->secret_key?>" name="secret_key" id="secret_key" class="form-control" placeholder="Secret Key" required>
                                            </div>
                                            <?=$this->InputError('private_key')?>
                                        </div><hr>
                                        <?=Token::csrf()?>
                                        <div class="row">
                                            <input type="submit" name="submit" value="Update" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">SMS Settings</h4>
                                <div class="container">
                                    <form action="<?=$this->domain()?>/admin-manager/update_sms_settings" method="post">
                                        <div class="row">
                                            <label for="api_link" class="col-lg-2">API Link</label>
                                            <div class="col-lg-10">
                                                <input type="text"  value="<?=$settings->api_link?>" name="api_link" id="api_link" class="form-control" placeholder="API Link" required>
                                            </div>
                                            <?=$this->InputError('api_link')?>
                                        </div><hr>
                                        <div class="row">
                                            <label for="api_username" class="col-lg-2">API Username</label>
                                            <div class="col-lg-10">
                                                <input type="text" value="<?=$settings->api_username?>" name="api_username" id="api_username" class="form-control" placeholder="API Username" required>
                                            </div>
                                            <?=$this->InputError('api_username')?>
                                        </div><hr>
                                        <div class="row">
                                            <label for="api_password" class="col-lg-2">API Password</label>
                                            <div class="col-lg-10">
                                                <input type="text" value="<?=$settings->api_password?>" name="api_password" id="api_password" class="form-control" placeholder="API Password" required>
                                            </div>
                                            <?=$this->InputError('api_password')?>
                                        </div><hr>
                                        <div class="row">
                                            <label for="sender" class="col-lg-2">Sender</label>
                                            <div class="col-lg-10">
                                                <input type="text" value="<?=$settings->sender?>" name="sender" id="sender" class="form-control" placeholder="Sender" required>
                                            </div>
                                            <?=$this->InputError('sender')?>
                                        </div><hr>
                                        <?=Token::csrf()?>
                                        <div class="row">
                                            <input type="submit" name="submit" value="update" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bank Settings</h4>
                                <div class="container">
                                    <form action="<?=$this->domain()?>/admin-manager/update_bank_settings" method="post">
                                        <div class="row">
                                            <label for="account_name" class="col-lg-2">Account Name</label>
                                            <div class="col-lg-10">
                                                <input value="<?=$settings->account_name?>" type="text" name="account_name" id="account_name" class="form-control" placeholder="Account Name" required>
                                            </div>
                                            <?=$this->InputError('account_name')?>
                                        </div><hr>
                                        <div class="row">
                                            <label for="account_no" class="col-lg-2">Account No</label>
                                            <div class="col-lg-10">
                                                <input type="text" value="<?=$settings->account_no?>" name="account_no" id="account_no" class="form-control" placeholder="Account No" required>
                                            </div>
                                            <?=$this->InputError('account_no')?>
                                        </div><hr>
                                        <div class="row">
                                            <label for="bank" class="col-lg-2">Bank</label>
                                            <div class="col-lg-10">
                                                <input type="text" value="<?=$settings->bank?>" name="bank" id="bank" class="form-control" placeholder="Bank " required>
                                            </div>
                                            <?=$this->InputError('bank')?>
                                        </div><hr>
                                        <?=Token::csrf()?>
                                        <div class="row">
                                            <input type="submit" name="submit" value="Update" class="btn btn-info">
                                        </div>
                                    </form>
                                </div>
              
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/admin/includes/footer.php'; ?>