<?php $page_title = 'Edit Bonus'; ?>

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
                            <li class="breadcrumb-item active">Edit Bonus</li>
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
                    $bonus  = $this->school()->bonuses->find($data['id']);
                    //print_r($bonus);
                ?>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Bonus</h4>
                                <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/school-manager/update-bonus/<?=$data['id']?>" method="post">
                                    <div class="form-group row">
                                        <label for="no_of_wards" class="col-sm-2 control-label">No of Wards*</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="number" min="1" class="form-control" value="<?=$bonus->no_of_wards?>" name="no_of_wards" id="no_of_wards" placeholder="No of Wards">
                                                
                                            </div>
                                            <?=$this->InputError('no_of_student')?>
                                        </div>
                                        <?php
                                            if($bonus->bonus_type == 'percentage'){?>
                                                <label for="percentage" class="col-sm-2 control-label">Percentage(%)*</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="ti-pin"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" min="1" max="100" class="form-control" value="<?=$bonus->bonus?>" name="amount" placeholder="Percentage">
                                                        <input type="hidden" name="bonus_type" value="percentage">
                                                        
                                                    </div>
                                                    <?=$this->InputError('percentage')?>
                                                </div><?php
                                            }else{?>
                                                <label for="amount" class="col-sm-2 control-label">Amount*</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                NGN
                                                            </span>
                                                        </div>
                                                        <input type="number" min="1" class="form-control" name="amount" value="<?=$bonus->bonus?>" placeholder="Amount">
                                                        <input type="hidden" name="bonus_type" value="amount">
                                                        
                                                    </div>
                                                    <?=$this->InputError('amount')?>
                                                </div><?php
                                            }
                                        ?>
                                        
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-1 col-sm-1">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
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

                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/school/includes/footer.php'; ?>