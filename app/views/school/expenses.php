<?php $page_title = 'School Expenses'; ?>

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
                        <h3 class="text-themecolor">Expenses</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Expenses</li>
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
                                <h4 class="card-title">Expenses</h4>
                                <h6 class="card-subtitle"><span class="label label-primary" style="font-size: 14px;">Expenses created can't be reverted, make sure the information entered are valid.</span></h6>
                                <button type="button" class="btn btn-info btn-rounded m-t-10 float-right" data-toggle="modal" data-target="#myModal">Add Expense</button>
                                
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Amount(NGN)</th>
                                                <th>Receiver</th>
                                                <th>Phone</th>
                                                <th>Payment Method</th>
                                                <th>Date Opened</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $expenses = $this->school()->expenses;
                                            function paymentType($val)
                                            {
                                                if($val == 'bank deposit'){
                                                    return '<span class="label label-info">Bank Deposit</label>';
                                                }else if($val == 'cash'){
                                                    return '<span class="label label-primary">Cash</label>';
                                                }else if($val == 'transfer'){
                                                    return '<span class="label label-success">Transfer</label>';
                                                }
                                            }

                                            $sn = 1;
                                            foreach($expenses as $expense){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $expense->session . '</td>';
                                                echo '<td>' . $expense->term . '</td>';
                                                echo '<td>' . $expense->title . '</td>';
                                                echo '<td>' . substr($expense->description, 0, 10) . '</td>';
                                                echo '<td class="text-center">' . $expense->amount . '</td>';
                                                echo '<td>' . $expense->receiver . '</td>';
                                                echo '<td class="text-center">' . $expense->phone . '</td>';
                                                echo '<td class="text-center">' . paymentType($expense->payment_method) . '</td>';
                                                echo '<td><span class="label label-primary">' . $expense->created_at->toFormattedDateString() . '</span></td>';
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

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header modal-dialog modal-lg">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add Expendicture</h4>
                            </div>
                            
                            <form action="<?=$this->domain()?>/school-manager/create-expense" method="post" class="form-horizontal form-material">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <div class="col-md-12 m-b-20">
                                            <input type="text" class="form-control" name="session" value="<?=School::get_session()?>" placeholder="Title" required disabled> 
                                            <?=$this->InputError('session')?>
                                        </div>
                                        <?php
                                            $terms = $this->school()->terms->where('session', School::get_session());
                                        ?>
                                        <div class="col-md-12 m-b-20">
                                            <select class="form-control" name="term" required>
                                                <?php
                                                foreach($terms as $term){
                                                    echo '<option value="' . $term->id . '">' . $term->term . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <?=$this->InputError('term')?>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            <input type="text" class="form-control" name="title" placeholder="Title" required> 
                                            <?=$this->InputError('title')?>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            <textarea class="form-control" name="description" placeholder="Description" required></textarea>
                                            <?=$this->InputError('description')?>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            <input type="number" min="1" class="form-control" name="amount" placeholder="Amount" required> 
                                            <?=$this->InputError('amount')?>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            <input type="text" class="form-control" name="receiver" placeholder="Name of Receiver" required>
                                            <?=$this->InputError('receiver')?>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            +234<input type="text" class="form-control" name="phone" placeholder="Phone No of Receiver" required>
                                            <?=$this->InputError('phone')?>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            <select class="form-control" name="payment_method" required>
                                                <option value="Cash">Cash</option>
                                                <option value="Bank Deposit">Bank Deposit</option>
                                                <option value="Transfer">Transfer</option>
                                            </select>
                                            <?=$this->InputError('payment_method')?>   
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