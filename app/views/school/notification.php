<?php $page_title = 'Notifications'; ?>

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
                        <h3 class="text-themecolor">Notification</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Notification</li>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        <a href="<?=$this->domain()?>/school/notification"><button type="button " class="btn btn-secondary m-r-10 m-b-10"><i class="mdi mdi-reload font-18"></i></button></a>
                                        
                                    </div>
                                    <div class="card-body p-t-0">
                                        <div class="card b-all shadow-none">
                                            <div class="inbox-center table-responsive">
                                                <table class="table table-hover no-wrap">
                                                    <tbody>
                                                        <?php
                                                            $notifications = $this->school()->notifications->all();
                                                            
                                                            //print_r($notifications); //die();
                                                            foreach($notifications as $notification){?>
                                                                <tr class="unread" style="cursor: pointer;">
                                                                    <a href="<?=$this->domain()?>/school/view-notification/<?=$notification->id?>">
                                                                        <td style="width:40px">
                                                                            <i style="cursor: pointer; color: brown;" onclick="deleteNotification(<?=$notification->id?>)" class="fa fa-trash"></i>
                                                                        </td>
                                                                        <td style="width:40px" class="hidden-xs-down"><i class="fa fa-star-o"></i></td>
                                                                        <td class="hidden-xs-down">Megafemco</td>
                                                                        <td><a href="<?=$this->domain()?>/school/view-notification/<?=$notification->id?>"><?=$notification->title?> <?=(!$notification->viewedOn()) ? '<span class="label label-success">new</span>' : '' ?></a></td>
                                                                        <td><a href="<?=$this->domain()?>/school/view-notification/<?=$notification->id?>"><span class="label label-success">View</span></a></td>
                                                                        <td class="text-right"><span class="label label-primary"><?=$notification->created_at->toFormattedDateString()?></span></td>
                                                                    </a>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
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
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-notification/' + id;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/school/includes/footer.php'; ?>