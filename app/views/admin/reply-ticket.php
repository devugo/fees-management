<?php $page_title = 'Reply Tickets'; ?>

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
                            <li class="breadcrumb-item active">Reply Ticket</li>
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
                <?php
                    $ticket = Ticket::find($data['id']);

                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><img width="30" height="30" src="<?=$this->domain()?>/<?=$ticket->school->logo?>"> <?=$ticket->school->name?></h4>
                                <h6 class="card-subtitle"><?=$ticket->title?></h6>
                                    <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/admin-manager/create-ticket-reply/<?=$data['id']?>" method="post">
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <textarea class="form-control" style="width: 100% !important;" name="response" placeholder="Reply..."></textarea>
                                                </div>
                                            </div>
                                        </div>                                  
                                        <div class="form-group row m-b-0">
                                            <div class="col-sm-1">
                                                <button type="submit" class="btn btn-info waves-effect waves-light">Reply</button>
                                            </div>
                                        </div>
                                    </form>
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
                                                    return '<span class="label label-success">Replied</span>';
                                                }
                                            }
                                            $sn = 1;
                                            foreach($tickets as $ticket){?>
                                                <tr>
                                                    <td><?=$sn?></td>
                                                    <td><?=$ticket->school->name?></td>
                                                    <td><?=$ticket->title?></td>
                                                    <td><?=confirm($ticket)?></td>
                                                    <td><span class="label label-primary"><?=$ticket->created_at->toFormattedDateString()?></span></td>
                                                    <td><?=($ticket->confirmed_at) ? '' : '<a href="' . $this->domain() . '/admin/reply_ticket/' . $ticket->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Reply Ticket" style="cursor: pointer;" class="fa fa-reply"></i></a>' ?> <a href="<?=$this->domain()?>/admin/view-ticket/<?=$ticket->id?>"><i style="color: orange; cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Ticket" class="fa fa-eye"></i></a></td>
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