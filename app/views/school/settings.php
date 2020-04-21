<?php $page_title = 'Settings'; ?>

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
                        <h3 class="text-themecolor">Settings</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Update Settings</li>
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
                <?php
                    $settings = $this->school()->school_settings;
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bank Settings</h4>
                                <div class="container">
                                    <form action="<?=$this->domain()?>/school-manager/update_bank_settings" method="post">
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

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Support Ticket</h4>
                            </div>
                            
                                <form action="<?=$this->domain()?>/school-manager/create-ticket" method="post" class="form-horizontal form-material">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" name="title" placeholder="Title"> 
                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <textarea class="form-control" name="description" placeholder="decsription"></textarea>
                                            </div>
                                            <?=Token::csrf()?>
                                        </div>
                                        

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info waves-effect" onclick="form.submit()">Send</button>
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                
                            
                            
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/school/includes/footer.php'; ?>