<?php $page_title = 'View Notifications'; ?>

<?php require_once 'app/views/guardian/includes/header.php'; ?>

<?php require_once 'app/views/guardian/includes/sidebar.php'; ?>

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
                        <h3 class="text-themecolor"><?=$this->guardian()->school->name?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">View Notification</li>
                        </ol>
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
                                            <a href="<?=$this->domain()?>/guardian/notification"><button type="button" class="btn btn-secondary font-18"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Go Back to Notifications" class="mdi mdi-alert-octagon"></i></button></a>
                                        </div>
                                        <a href=""><button type="button " class="btn btn-secondary m-r-10 m-b-10"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh" class="mdi mdi-reload font-18"></i></button></a>
                                    </div>
                                    <div class="card-body p-t-0">
                                        <?php
                                            $notification = $this->guardian()->broadcasts->find($data['id']);

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
    <?php require_once 'app/views/guardian/includes/footer.php'; ?>