<?php $page_title = 'Prepare Fee'; ?>

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
                        <h3 class="text-themecolor">Prepare Fee</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Prepare Fee</li>
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
                <?php
                    $fee = $this->school()->fees->find($data['id']);

                ?>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Sub Fee</h4>
                                <form class="form-horizontal p-t-20" action="/school-manager/create-prepared-fee/<?=$data['id']?>" method="post">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-3 control-label">Title*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-tag"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                                
                                            </div>
                                            <?=$this->InputError('title')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="amount" class="col-sm-3 control-label">Amount*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        NGN
                                                    </span>
                                                </div>
                                                <input type="number" min="1" class="form-control" name="amount" id="amount" placeholder="Enter Amount">
                                                
                                            </div>
                                            <?=$this->InputError('amount')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">INVOICE</h4>
                                <h3><?=$fee->title?></h3>
                                <div class="table-responsive">
                                    <table class="table color-table primary-table">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>session</th>
                                                <th>Term</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?=$fee->classe->class?><?=$fee->arm->name?></td>
                                                <td><?=$fee->session?></td>
                                                <td><?=$fee->term->term?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive">
                                    <table class="table color-table success-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $prepared_fees = $fee->prepared_fees;
                                                $sn = 1;
                                                $total = 0;
                                                foreach($prepared_fees as $prepared_fee){
                                                    echo '<tr>';
                                                    echo '<td>' . $sn . '</td>';
                                                    echo '<td>' . $prepared_fee->title . '</td>';
                                                    echo '<td>' . $prepared_fee->amount . '</td>';
                                                    echo '<td><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Sub Fee" onclick="deletePreparedFee(' . $prepared_fee->id . ')" style="color: brown; cursor: pointer;" class="fa fa-trash"></i></td>';
                                                    echo '</tr>';
                                                    $total = $total + $prepared_fee->amount;
                                                    $sn++;
                                                }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                            <h4 class="card-title">TOTAL: <?=School::currency_formatter($total)?>.00</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->

                <script language="javascript">
                    function deletePreparedFee(id)
                    {
                        if(confirm("This action can't be reverted. Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-prepared-fee/' + id;
                            return true;
                        }
                    }
                    
                    
                </script>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/school/includes/footer.php'; ?>