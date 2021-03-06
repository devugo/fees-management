<?php $page_title = 'View Notifications'; ?>

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
                        <h3 class="text-themecolor">Notification</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">View Notification</li>
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
                            <div class="row">
                                <div class="col-xlg-12 col-lg-12 col-md-12">
                                    <div class="card-body">
                                        <div class="btn-group m-b-10 m-r-10" role="group" aria-label="Button group with nested dropdown">
                                            <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Notification" type="button" class="btn btn-secondary font-18"><a href="<?=$this->domain()?>/admin/notification"><i class="mdi mdi-alert-octagon"></i></a></button>
                                        </div>
                                        <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh Notification" type="button " class="btn btn-secondary m-r-10 m-b-10"><a href=""><i class="mdi mdi-reload font-18"></i></a></button>
                                        <button data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Notification" onclick="deleteNotification(<?=$data['id']?>)" type="button " class="btn btn-secondary m-r-10 m-b-10"><i class="mdi mdi-delete font-18"></i></button>
                                        
                                    </div>
                                    <div class="card-body p-t-0">
                                        <?php
                                            $notification = Notification::find($data['id']);

                                        ?>
                                        <div class="card b-all shadow-none">
                                            <div class="card-body">
                                                <h3 class="card-title m-b-0"><?=$notification->title?></h3>
                                            </div>
                                            <div>
                                                <hr class="m-t-0">
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex m-b-40">
                                                    <div>
                                                        <img src="<?=$this->domain()?>/<?=$notification->school->logo?>" alt="user" width="40" class="img-circle" />
                                                    </div>
                                                    <div class="p-l-10">
                                                        <h4 class="m-b-0"><?=$notification->school->name?></h4>
                                                        <small class="text-muted">From: <?=$this->admin()->name?></small>
                                                    </div>
                                                </div>
                                                <p><b>Dear Sir</b></p>
                                                <p><?=$notification->description?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script language="javascript">
                    function deleteNotification(id)
                    {
                        if(confirm("Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/admin-manager/delete-notification/' + id;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/admin/includes/footer.php'; ?>