<?php $school = $this->school(); echo $sum_of_expenses = $school->expenses->sum('amount'); 

echo School::currency_formatter($sum_of_expenses) . '<br>';
$payments = $this->school()->fee_users;
$monthly_payments = 0;
foreach($payments as $payment){
    $dateFormat = date("Y-m", strtotime($payment->created_at));
    if($dateFormat == date("Y-m")){
        $monthly_payments += $payment->fee->prepared_fees->sum('amount') - $payment->bonus;
    }
}
echo School::currency_formatter($this->school()->expenses->sum('amount')) . '<br>';
echo School::currency_formatter($monthly_payments) . '<br>';

$payments = $this->school()->fee_users;
$unconfirmed_payments = 0;
foreach($payments as $payment){
    //$dateFormat = date("Y-m", strtotime($payment->created_at));
    if($payment->confirmed_at == NULL || $payment->confirmed_at == ''){
        $unconfirmed_payments += $payment->fee->prepared_fees->sum('amount') - $payment->bonus;
    }
}
echo School::currency_formatter($unconfirmed_payments) . '<br>';

$email = $this->school()->subscriptions_balance->email;
$sms = $this->school()->subscriptions_balance->sms;

echo $email . '<br>';
echo $sms . '<br>';

$last_guardian_id = $this->school()->guardians->max('id');
//echo $last_guardian_id;
$last_guardian_created_date = $this->school()->guardians->find($last_guardian_id);
echo $this->school()->users->count() . '<br>';

echo $last_guardian_created_date->created_at->toFormattedDateString() . '<br>';



die();
?>
<?php $page_title = 'Dashboard'; ?>

<?php require_once 'app/views/school/includes/header.php'; ?>

<?php require_once 'app/views/school/includes/sidebar.php'; ?>

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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-row">
                                <?php
                                    $payments = $this->school()->fee_users;
                                    $monthly_payments = 0;
                                    foreach($payments as $payment){
                                        $dateFormat = date("Y-m", strtotime($payment->created_at));
                                        if($dateFormat == date("Y-m")){
                                            $monthly_payments += $payment->fee->prepared_fees->sum('amount') - $payment->bonus;
                                        }
                                    }
                                    
                                ?>
                                    <div class="round round-lg align-self-center round-info"><i class="ti-wallet"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-light"><?=School::currency_formatter($monthly_payments)?></h3>
                                        <h5 class="text-muted m-b-0">Payments Made This Month</h5></div>
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
                                        <h3 class="m-b-0 font-lgiht"><?=School::currency_formatter($this->school()->expenses->sum('amount'))?></h3>
                                        <h5 class="text-muted m-b-0">Expense Incurred This Month</h5></div>
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
                                <?php
                                    $payments = $this->school()->fee_users;
                                    $unconfirmed_payments = 0;
                                    foreach($payments as $payment){
                                        //$dateFormat = date("Y-m", strtotime($payment->created_at));
                                        if($payment->confirmed_at == NULL || $payment->confirmed_at == ''){
                                            $unconfirmed_payments += $payment->fee->prepared_fees->sum('amount') - $payment->bonus;
                                        }
                                    }
                                    
                                ?>
                                    <div class="round round-lg align-self-center round-primary"><i class="mdi mdi-cart-outline"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht"><?=School::currency_formatter($unconfirmed_payments)?></h3>
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
                                <?php
                                    $email = $this->school()->subscriptions_balance->email;
                                    $sms = $this->school()->subscriptions_balance->sms;
                                ?>
                                    <div class="round round-lg align-self-center round-danger"><i class="mdi mdi-bullseye"></i></div>
                                    <div class="m-l-10 align-self-center">
                                        <h3 class="m-b-0 font-lgiht">SMS: <?=$sms?> Email: <?=$email?></h3>
                                        <h5 class="text-muted m-b-0">Subscription Balance</h5></div>
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
                                    $last_guardian_id = $this->school()->guardians->max('id');
                                    //echo $last_guardian_id;
                                    $last_guardian_created_date = $this->school()->guardians->find($last_guardian_id);
                                    //print_r($last_guardian_created_date->created_at);
                                ?>
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="fa fa-user-secret"></i></h1></div>
                                    <div>
                                        <h3 class="card-title">Guardian count</h3>
                                        <h6 class="card-subtitle">Last Added: <?=$last_guardian_created_date->created_at->toFormattedDateString()?></h6> </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-light text-white"><?=$this->school()->guardians->count()?></h2>
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
                                    $last_student_id = $this->school()->users->max('id');
                                    //echo $last_guardian_id;
                                    $last_student_created_date = $this->school()->users->find($last_student_id);
                                    //print_r($last_guardian_created_date->created_at);
                                ?>
                                    <div class="m-r-20 align-self-center">
                                        <h1 class="text-white"><i class="fa fa-users"></i></h1></div>
                                    <div>
                                        <h3 class="card-title">Student count</h3>
                                        <h6 class="card-subtitle">Last Added: <?=$last_student_created_date->created_at->toFormattedDateString()?></h6> </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 align-self-center">
                                        <h2 class="font-light text-white"><?=$this->school()->users->count()?></h2>
                                    </div>
                                    <div class="col-8 p-t-10 p-b-20 text-right">
                                        <div class="spark-count" style="height:65px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <h4 class="card-title">Recent Payment</h4>
                                </div>
                                <?php
                                    $sorted_payments = $payments->sortByDesc('id');
                                ?>
                                <div class="table-responsive m-t-20">
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Name of Student</th>
                                                <th>Class</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Date Paid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $school = new School();
                                            $years = $school->find($this->school_id())->grad_year_get();
                                            $classes = $school->find($this->school_id())->class_get();
                                            function classe($no, $arr)
                                            {
                                                if(in_array($no, $arr)){
                                                    return array_search($no, $arr);
                                                }
                                            }

                                            function confirmed($val){
                                                if($val->confirmed_at != NULL){
                                                    return '<span class="label label-success">Confirmed</span>';
                                                }else{
                                                    return '<span class="label label-danger">Pending</span>';   
                                                }
                                            }
                                            $control = 0;
                                            foreach($sorted_payments as $sorted_payment){
                                                if($control == 6){
                                                    break;
                                                }else{
                                                    echo '<tr>';
                                                    echo '<td style="width:50px;"><span class="round"><img width="50" height="50" src="' . $this->domain() . '/' . $sorted_payment->user->profile_pix . '"></span></td>';
                                                    echo '<td><h6>' . $sorted_payment->user->lastname . ' ' . $sorted_payment->user->firstname . ' ' . $sorted_payment->user->middlename . '</h6><small data-toggle="tooltip" data-placement="top" title="" data-original-title="Guardian" class="text-muted">' . $sorted_payment->guardian->lastname . ' ' . $sorted_payment->guardian->firstname . '</small></td>';
                                                    echo '<td>' . $classes[classe($sorted_payment->user->year_of_graduation, $years)] . $sorted_payment->user->arm->name . '</td>';
                                                    echo '<td>' . $sorted_payment->fee->title . '</td>';
                                                    echo '<td>' . confirmed($sorted_payment) . '</td>';
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