<?php $page_title = 'Bonus'; ?>

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
                        <h3 class="text-themecolor">Bonus</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Add Bonus</li>
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
                                <h4 class="card-title">Create Bonus</h4>
                                <small class="label label-primary">Bonus can be created in two basis; either by a percentage for each fees or a fixed amount.</small>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Create Bonus By Percentage" class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Percentage</span></a> </li>
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Create Bonus By Amount" class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Amount</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="p-20">
                                            <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/school-manager/create-bonus-percentage" method="post">
                                                <div class="form-group row">
                                                    <label for="no_of_wards" class="col-sm-2 control-label">No of Wards*</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="ti-user"></i>
                                                                </span>
                                                            </div>
                                                            <input type="number" min="1" class="form-control" name="no_of_wards" id="no_of_wards" placeholder="No of Wards">
                                                            
                                                        </div>
                                                        <?=$this->InputError('no_of_wards')?>
                                                    </div>
                                                    <label for="percentage" class="col-sm-2 control-label">Percentage(%)*</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <i class="ti-pin"></i>
                                                                </span>
                                                            </div>
                                                            <input type="number" min="1" max="100" class="form-control" name="percentage" placeholder="Percentage">
                                                            
                                                        </div>
                                                        <?=$this->InputError('percentage')?>
                                                    </div>
                                                </div>
                                                <?=Token::csrf()?>
                                                
                                                <div class="form-group row m-b-0">
                                                    <div class="offset-sm-1 col-sm-1">
                                                        <button type="submit" class="btn btn-info waves-effect waves-light">Add</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                        <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/school-manager/create-bonus-amount" method="post">
                                            <div class="form-group row">
                                                <label for="no_of_wards" class="col-sm-2 control-label">No of Wards*</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="ti-user"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" min="1" class="form-control" name="no_of_wards" id="no_of_wards" placeholder="No of Wards">
                                                        
                                                    </div>
                                                    <?=$this->InputError('no_of_wards')?>
                                                </div>
                                                <label for="amount" class="col-sm-2 control-label">Amount(NGN)*</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="ti-pin"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" min="1" class="form-control" name="amount" placeholder="Amount">
                                                        
                                                    </div>
                                                    <?=$this->InputError('amount')?>
                                                </div>
                                            </div>
                                            <?=Token::csrf()?>
                                            
                                            <div class="form-group row m-b-0">
                                                <div class="offset-sm-1 col-sm-1">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light">Add</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Bonuses</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th>SN</th>
                                                <th>Bonus Type</th>
                                                <th>No of Wards</th>
                                                <th>Bonus</th>
                                                <th>Date Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $bonuses = $this->school()->bonuses;
                                            $sn = 1;
                                            foreach($bonuses as $bonus){
                                                echo '<tr class="text-center">';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $bonus->bonus_type . '</td>';
                                                echo '<td>' . $bonus->no_of_wards . '</td>';
                                                echo '<td>' . $bonus->bonus . '</td>';
                                                echo '<td><span class="label label-primary">' . $bonus->created_at->toFormattedDateString() . '</span></td>';
                                                echo '<td class="text-center"><a href="' . $this->domain() . '/school/edit-bonus/' . $bonus->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Bonus" class="fa fa-edit"></i></a> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Bonus" class="fa fa-trash" style="color: brown; cursor: pointer;" onclick="deleteBonus(' . $bonus->id . ')"></td>';
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

                <script language="javascript">
                    function deleteBonus(id)
                    {
                        if(confirm("This action can't be reverted. Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-bonus/' + id;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/school/includes/footer.php'; ?>