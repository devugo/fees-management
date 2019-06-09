<?php $page_title = 'Support Tickets'; ?>

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
                            <div class="card-body">
                                <h4 class="card-title">Support Ticket List</h4>
                                <h6 class="card-subtitle">List of ticket opened</h6>
                                <button type="button" class="btn btn-info btn-rounded m-t-10 float-right" data-toggle="modal" data-target="#myModal">Open Ticket</button>
                                
                                <div class="row m-t-40">
                                <?php
                                    $ticketCount = $this->school()->tickets->count();
                                    $ticketUnconfirmed = $this->school()->tickets->where('confirmed_at', NULL)->count();
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
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Date Opened</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $tickets = $this->school()->tickets;
                                            function confirm($sub){
                                                if($sub->confirmed_at === NULL){
                                                    return '<span class="label label-danger">Pending</span>';
                                                }else{
                                                    return '<span class="label label-success">Confirmed</span>';
                                                }
                                            }
                                           // echo "<pre>";
                                            //print_r($subscriptions);
                                            $sn = 1;
                                            foreach($tickets as $ticket){ 
                                                
                                                ?>
                                                <tr>
                                                    <td><?=$sn?></td>
                                                    <td><?=$ticket->title?></td>
                                                    <td><?=confirm($ticket)?></td>
                                                    <td><span class="label label-info"><?=$ticket->created_at->toFormattedDateString()?></span></td>
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
                                <h4 class="modal-title">Support Ticket</h4>
                            </div>
                            
                                <form action="<?=$this->domain()?>/school-manager/create-ticket" method="post" class="form-horizontal form-material">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" name="title" placeholder="Title"> 
                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <textarea class="form-control" name="description" placeholder="decsription"></textarea>
                                            </div>
                                            <?=Token::csrf()?>
                                        </div>
                                        

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info waves-effect" onclick="form.submit()">Send</button>
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                                
                            
                            
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/school/includes/footer.php'; ?>