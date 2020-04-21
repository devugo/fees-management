<?php $page_title = 'Dashboard'; ?>

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
                        <h3 class="text-themecolor">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                <?php
                    $subscriptions = Subscription::all();
                    $total_payments = AdminIncome::find(1)->income;
                    $confirmed_payments = AdminIncome::find(1)->income;
                    $pending_payments = 0;
                    foreach ($subscriptions as $subscription) {
                        if(!$subscription->confirmed()){
                           $total_payments += $subscription->subscription_type->amount;
                           $pending_payments += $subscription->subscription_type->amount;
                        }
                    }
                ?>
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-light"><?=School::currency_formatter($total_payments)?></h3>
                                        <h5 class="text-muted m-b-0">Payments Made</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-cellphone-link"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?=School::currency_formatter($confirmed_payments)?></h3>
                                        <h5 class="text-muted m-b-0">Confirmed payments</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-cart-outline"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?=School::currency_formatter($pending_payments)?></h3>
                                        <h5 class="text-muted m-b-0">Unconfirmed Payments</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                    <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-bullseye"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?=SubscriptionType::all()->count()?></h3>
                                        <h5 class="text-muted m-b-0">Subscription Plans</h5></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card card-inverse card-primary">
                            <div class="card-body">
                                <div class="d-flex">
                                <?php
                                    $last_student_id = User::all()->max('id');
                                    $last_student_created_date = User::find($last_student_id);
                                ?>
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="fa fa-users"></i></h1></div>
                                    <div>
                                        <h3 class="card-title">Student count</h3>
                                        <h6 class="card-subtitle">Last Added: <?=($last_student_created_date) ? $last_student_created_date->created_at->toFormattedDateString() : '' ?></h6> </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-light text-white"><?=User::all()->count()?></h2>
                                    </div>
                                    <div class="col-8 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-inverse card-success">
                            <div class="card-body">
                                <div class="d-flex">
                                <?php
                                    $last_guardian_id = Guardian::all()->max('id');
                                    $last_guardian_created_date = User::find($last_guardian_id);
                                ?>
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="fa fa-user-secret"></i></h1></div>
                                    <div>
                                        <h3 class="card-title">Guardian count</h3>
                                        <h6 class="card-subtitle">Last Added: <?=($last_guardian_created_date) ? $last_guardian_created_date->created_at->toFormattedDateString() : '' ?></h6> </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-light text-white"><?=Guardian::all()->count()?></h2>
                                    </div>
                                    <div class="col-8 p-t-10 p-b-20 text-right">
                                        <div class="spark-count" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-inverse card-info">
                            <div class="card-body">
                                <div class="d-flex">
                                <?php
                                    $last_school_id = School::all()->max('id');
                                    $last_school_created_date = School::find($last_school_id);
                                ?>
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="fa fa-building"></i></h1></div>
                                    <div>
                                        <h3 class="card-title">School Count</h3>
                                        <h6 class="card-subtitle">Last Added: <?=($last_school_created_date) ? $last_school_created_date->created_at->toFormattedDateString() : '' ?></h6> </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-light text-white"><?=School::all()->count()?></h2>
                                    </div>
                                    <div class="col-8 p-t-10 p-b-20 align-self-center">
                                        <div class="usage chartist-chart" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <h4 class="card-title">Recent Payment</h4>
                                </div>
                                <?php
                                    $payments = Subscription::all();
                                    $sorted_payments = $payments->sortByDesc('id');
                                ?>
                                <div class="table-responsive m-t-20">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Name of School</th>
                                                <th>Plan</th>
                                                <th>SMS/Email</th>
                                                <th>Amount (NGN)</th>
                                                <th>Status</th>
                                                <th>Date Paid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $control = 0;
                                            foreach($sorted_payments as $sorted_payment){
                                                if($control == 6){
                                                    break;
                                                }else{
                                                    echo '<tr>';
                                                    echo '<td style="width:50px;"><span class="round"><img width="50" height="50" src="' . $this->domain() . '/' . $sorted_payment->school->logo . '"></span></td>';
                                                    echo '<td>' . $sorted_payment->school->name . '</td>';
                                                    echo '<td>' . $sorted_payment->subscription_type->name . '</td>';
                                                    echo '<td>' . $sorted_payment->subscription_type->sms . '/' . $sorted_payment->subscription_type->email . '</td>';
                                                    echo '<td>' . $sorted_payment->subscription_type->amount . '</td>';?>
                                                    <td><?=($sorted_payment->confirmed()) ? '<span class="label label-success">confirmed</span>' : '<span class="label label-danger">Pending</span>'?></td><?php
                                                    echo '<td><span class="label label-primary">' . $sorted_payment->created_at->toFormattedDateString() . '</span></td>';
                                                    echo '</tr>';
                                                    $control++;
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
           
    <?php require_once '../app/views/admin/includes/footer.php'; ?>