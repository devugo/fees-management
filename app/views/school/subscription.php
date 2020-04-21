<?php $page_title = 'Subscrptions'; ?>

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
                        <h3 class="text-themecolor">Subscription</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Subscription</li>
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
                <script src="https://js.paystack.co/v1/inline.js"></script>
                <script>
                    function payWithPaystack($email, $amount, $order_id){
                        $pKey = '<?=AdminSettings::find(1)->public_key?>';
                        var handler = PaystackPop.setup({
                        key: $pKey,
                        email: $email,
                        amount: $amount,
                        currency: "NGN",
                        firstname: 'Devugo',
                        lastname: 'Designs',
                        // label: "Optional string that replaces customer email"
                        metadata: {
                            custom_fields: [
                                {
                                    display_name: "Mobile Number",
                                    variable_name: "mobile_number",
                                    value: "+2348133491134"
                                }
                            ]
                        },
                        callback: function(response){
                            window.location.href = '<?=$this->domain()?>/school-manager/verify-new-paystack-payment/' + response.reference + '/' + $order_id;
                            //after the transaction have been completed
                            //make post call  to the server with to verify payment 
                            //using transaction reference as post data
                           /* $.post("<?=$this->domain()?>/school-manager/verify-paystack-payment", {reference:response.reference}, function(status){
                                if(status == "success")
                                
                                    //successful transaction
                                    alert('Transaction was successful');
                                else
                                    //transaction failed
                                    alert(response);
                            });*/
                        },
                        onClose: function(){
                            // alert('Click "Pay now" to retry payment.');
                        }
                        });
                        handler.openIframe();
                    }
                </script>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Subscriptions Balance</h4>
                                <h5 class="label label-primary">Kindly upload proof of payment or pay online to complete your order from orders table below.</h5>
                                <button type="button" class="btn btn-info btn-rounded m-t-10 float-right" data-toggle="modal" data-target="#myModal">View Bank Details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    //get the subscription balance of school
                    $subscriptionBalance = $this->school()->subscriptions_balance;
                ?>
                <div class="row">
                    <div class="card text-center offset-lg-1 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="round round-lg align-self-center round-danger"><i class="ti-email"></i></div>
                                <h4 class="card-title">SMS</h4>
                                <h1 data-toggle="tooltip" data-placement="top" title="" data-original-title="SMS Left"><?=$subscriptionBalance->sms?></h1>
                            </div>
                            <div class="card-footer">
                                <p class="card-text"><small class="text-muted">Last purchased <?=$subscriptionBalance->updated_at->toFormattedDateString()?></small></p>
                            </div>
                        </div>
                    </div>
                    <div class="card text-center offset-lg-1 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="round round-lg align-self-center round-info"><i class="ti-server"></i></div>
                                <h4 class="card-title">Email</h4>
                                <h1 data-toggle="tooltip" data-placement="top" title="" data-original-title="Email Left"><?=$subscriptionBalance->email?></h1>
                            </div>
                            <div class="card-footer">
                                <p class="card-text"><small class="text-muted">Last purchased <?=$subscriptionBalance->updated_at->toFormattedDateString()?></small></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Available Subscription Plans</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                        // Get the created subscription plans
                        $subscriptionPlans = SubscriptionType::where('blocked_on', NULL)->get()->sortBy('amount');
                        foreach($subscriptionPlans as $subscriptionPlan){
                    ?>
                
                    <div class="col-lg-3 col-md-4 col-sm-3 col-xs-12">
                        <div class="ribbon-wrapper card">
                            <div class="ribbon ribbon-bookmark  ribbon-default"><?=$subscriptionPlan->name?></div>
                            <h2><i class="ti-email" style="color: red;"></i> <?=$subscriptionPlan->sms?> SMS</h2><hr>
                            <h2><i class="ti-server" style="color: blue;"></i> <?=$subscriptionPlan->email?> Email</h2><hr>
                            <h2>Cost: <?=School::currency_formatter($subscriptionPlan->amount)?></h2><hr>
                            <a href="<?=$this->domain()?>/school-manager/order-subscription/<?=$subscriptionPlan->id?>" class="btn btn-info">
                                <i class="fa fa-shopping-cart"></i> Order
                            </a>
                            
                        </div>
                    </div>
                    
                    <?php
                        } 
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Orders</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Type</th>
                                                <th>Amount (NGN)</th>
                                                <th>Sms</th>
                                                <th>Email</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $subscriptions = $this->school()->subscriptions->sortByDesc('id');
                                            //print_r($subscriptions); die();
                                           // echo "<pre>";
                                            //print_r($subscriptions);
                                            function confirm($sub){
                                                if($sub->payment_proof === NULL && $sub->paystack_proof === NULL){
                                                    return '<span class="label label-danger">Not Paid</span>';
                                                }else if($sub->confirmed_at === NULL){
                                                    return '<span class="label label-primary">Pending</span>';
                                                }else{
                                                    return '<span class="label label-success">Confirmed</span>';
                                                }
                                            }

                                            function uploaded($sub)
                                            {
                                                if($sub->payment_proof !== NULL) {
                                                    return '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="View Uploaded Payment Proof" class="fa fa-eye"></i> ';
                                                }
                                            }
                                            $sn = 1;
                                            foreach($subscriptions as $subscription){ 
                                                $subctn = $subscription;
                                                $subType = $subscription->subscription_type;
                                                
                                                ?>
                                                <tr>
                                                    <td><?=$sn?></td>
                                                    <td><?=$subType->name?></td>
                                                    <td><?=$subType->amount?></td>
                                                    <td><?=$subType->sms?></td>
                                                    <td><?=$subType->email?></td>
                                                    <td><span class="label label-info"><?=$subscription->created_at->toFormattedDateString()?></label></td>
                                                    <td><?=confirm($subscription)?></td>
                                                    <td class="text-center">
                                                        <form action="<?=$this->domain()?>/school-manager/upload_payment_proof/<?=$subscription->id?>" method="post" enctype="multipart/form-data">
                                                            <input onchange="form.submit()" type="file" name="payment_proof" style="display: none;" id="payment_proof<?=$subscription->id?>">
                                                        </form>
                                                        <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Payment Proof" style="cursor: pointer; color: orange;"  onclick="document.getElementById('payment_proof<?=$subscription->id?>').click()" class="fa fa-upload">

                                                        </i> 
                                                        <a href="<?=$this->domain()?>/<?=$subscription->payment_proof?>"><?=uploaded($subscription)?></a>
                                                      <?php if($subscription->paystack_proof == NULL){?>
                                                            <i onclick="payWithPaystack('<?=$this->school()->email?>', <?=$subscription->paystack_amount?>, <?=$subscription->id?>);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pay Online" style="color: green; cursor: pointer;" class="fas fa-angle-double-right"></i><?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                
                                                <?php
                                                $sn++;
                                            }
                                        /*$subscriptions = $this->school()->subscriptions->all();
                                            $sn = 1;
                                            foreach($subscriptions as $subscription){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $subscription->type .' </td>';
                                                echo '<td>' . $subscription->amount . '</td>';
                                                echo '<td>' . substr($subscription->description, 0, 20) . '.....' . '</td>';
                                                echo '<td>' . $subscription->sms . '</td>';
                                                echo '<td>' . $subscription->email . '</td>';
                                                echo '<td>' . $subscription->confirmed_at . '</td>';
                                                echo '</tr>';
                                                $sn++;
                                            }*/
                                        ?>
                                        </tbody>
                                    </table>
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
                                <h4 class="modal-title">Bank Details</h4>
                            </div>
                            <div class="container text-center">
                                Bank Name: <?=AdminSettings::find(1)->bank?><br>
                                Account Name: <?=AdminSettings::find(1)->account_name?><br>
                                Bank Number: <?=AdminSettings::find(1)->account_no?>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/school/includes/footer.php'; ?>