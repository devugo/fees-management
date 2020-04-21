<?php $page_title = 'Payments'; ?>

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
                        <h3 class="text-themecolor">Payment</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Payments</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Payments</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>School</th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>SMS</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $subscriptions = Subscription::all();
                                            function active($val){
                                                if($val->confirmed_at === NULL){
                                                    return '<span class="label label-danger">Pending</span>';
                                                }else{
                                                    return '<span class="label label-success">confirmed</span>';
                                                }
                                            }
                                            
                                            $sn = 1;
                                            foreach($subscriptions as $subscription){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $subscription->school->name .' </td>';
                                                echo '<td>' . $subscription->subscription_type->name . '</td>';
                                                echo '<td>' . $subscription->subscription_type->amount . '</td>';
                                                echo '<td>' . $subscription->subscription_type->sms . '</td>';
                                                echo '<td>' . $subscription->subscription_type->email . '</td>';
                                                echo '<td>' . active($subscription) . '</td>';
                                                echo '<td class="text-center"><a href="' . $this->domain() . '/' . $subscription->payment_proof . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="View Payment Proof" style="color: orange" class="fa fa-eye"></i> </a>' . Admin::confirm_proof_of_payment($subscription) ; ?> <?=(!$subscription->confirmed()) ? '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Payment" class="fa fa-trash" style="color: brown; cursor: pointer;" onclick="deletePayment(' . $subscription->id . ')">' : '' ?></td><?php
                                                echo '</tr>';
                                                $sn++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script language="javascript">
                    function deletePayment(id)
                    {
                        if(confirm("This action can't be reverted. Are you sure you want to delete school's payment?")){
                            window.location.href='<?=$this->domain()?>' + '/admin-manager/delete-payment/' + id;
                            return true;
                        }
                    }

                    function confirmPayment(id)
                    {
                        if(confirm("This action can't be reverted. Are you sure you want to confirm payment?")){
                            window.location.href='<?=$this->domain()?>' + '/admin-manager/confirm-payment/' + id;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/admin/includes/footer.php'; ?>