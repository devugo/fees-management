<?php $page_title = 'Subscription'; ?>

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
                        <h3 class="text-themecolor">Subscription</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Create Subscription</li>
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
                                <h4 class="card-title">Subscriptions Plans</h4>
                                <button type="button" class="btn btn-info btn-rounded m-t-10 float-right" data-toggle="modal" data-target="#myModal">Add Plan</button>
                                
                                
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                                <th>SMS</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $subscription_types = SubscriptionType::all();
                                           // echo "<pre>";
                                            //print_r($subscriptions);
                                            $sn = 1;
                                            foreach($subscription_types as $subscription_type){ 
                                                
                                                ?>
                                                <tr>
                                                    <td><?=$sn?></td>
                                                    <td><?=$subscription_type->name?></td>
                                                    <td><?=$subscription_type->amount?></td>
                                                    <td><?=$subscription_type->sms?></td>
                                                    <td><?=$subscription_type->email?></td>
                                                    <td><?=Admin::active($subscription_type)?></td>
                                                    <td><?=Admin::activateSubPlan($subscription_type)?> <a href="<?=$this->domain()?>/admin/edit-subscription-plan/<?=$subscription_type->id?>"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Subscription Plan" class="fa fa-edit"></i></a> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Subscription Plan" style="color: brown; cursor: pointer;" onclick="deleteSubscriptionPlan(<?=$subscription_type->id?>)" class="fa fa-trash"></i></td>
                                                </tr>
                                                
                                                <?php
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

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Subscription Plan</h4>
                            </div>
                            
                                <form action="<?=$this->domain()?>/admin-manager/create-subscription-plan" method="post" class="form-horizontal form-material">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" name="name" placeholder="Name of Plan"> 
                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" name="amount" placeholder="Cost of Plan">
                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" name="sms" placeholder="No of SMS">
                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" name="email" placeholder="No of Email">
                                            </div>
                                            <?=Token::csrf()?>
                                        </div>
                                        

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info waves-effect" onclick="form.submit()">Add</button>
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                
                            
                            
                        </div>
                        
                    </div>
                </div>

                <script language="javascript">
                    function deleteSubscriptionPlan(id)
                    {
                        if(confirm("Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/admin-manager/delete-subscription-plan/' + id;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/admin/includes/footer.php'; ?>