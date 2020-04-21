<?php $page_title = 'Support Tickets'; ?>

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
                        <h3 class="text-themecolor">Support Ticket</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Support Ticket</li>
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
                                <h4 class="card-title">Support Ticket List</h4>
                                <h6 class="card-subtitle">List of ticket opened</h6>
                                
                                <div class="row m-t-40">
                                <?php
                                    $ticketCount = Ticket::all()->count();
                                    $ticketUnconfirmed = Ticket::where('confirmed_at', NULL)->count();
                                    $ticketConfirmed = $ticketCount - $ticketUnconfirmed;
                                ?>
                                    <!-- Column -->
                                    <div class="offset-md-2 col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-inverse card-info">
                                            <div class="box bg-info text-center">
                                                <h1 class="font-light text-white"><?=$ticketCount?></h1>
                                                <h6 class="text-white">Total Tickets</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="offset-md-2 col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card card-primary card-inverse">
                                            <div class="box text-center">
                                                <h1 class="font-light text-white"><?=$ticketConfirmed?></h1>
                                                <h6 class="text-white">Responded</h6>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>School</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Date Opened</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $tickets = Ticket::all();
                                            function confirm($sub){
                                                if($sub->confirmed_at === NULL){
                                                    return '<span class="label label-danger">Pending</span>';
                                                }else{
                                                    return '<span class="label label-success">Confirmed</span>';
                                                }
                                            }
                                            $sn = 1;
                                            foreach($tickets as $ticket){?>
                                                <tr>
                                                    <td><?=$sn?></td>
                                                    <td><?=$ticket->school->name?></td>
                                                    <td><?=$ticket->title?></td>
                                                    <td class="text-center"><?=confirm($ticket)?></td>
                                                    <td class="text-center"><span class="label label-primary"><?=$ticket->created_at->toFormattedDateString()?></span></td>
                                                    <td class="text-center"><?=($ticket->confirmed_at) ? '' : '<a href="' . $this->domain() . '/admin/reply_ticket/' . $ticket->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Reply Ticket" style="cursor: pointer;" class="fa fa-reply"></i></a>' ?> <a href="<?=$this->domain()?>/admin/view-ticket/<?=$ticket->id?>"><i style="color: orange; cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Ticket" class="fa fa-eye"></i></a></td>
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
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/admin/includes/footer.php'; ?>