<?php $page_title = 'Arm'; ?>

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
                        <h3 class="text-themecolor">Arm</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Add Arm</li>
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
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Register Arms</h4>
                                <!-- <?php //echo "<pre>"; print_r($this->school()->guardians->where('firstname', 'Mike')->count()); ?> -->
                                <form class="form-horizontal p-t-20" action="/school-manager/create-arm" method="post">
                                    <div class="form-group row">
                                        <label for="arm" class="col-sm-3 control-label">Arm*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-bookmark"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="arm" id="arm" placeholder="Enter Arm">
                                                
                                            </div>
                                            <?=$this->InputError('arm')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Arms</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Arms</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $arms = $this->school()->arms->all(); 
                                            $sn = 1;
                                            foreach($arms as $arm){
                                                echo '<tr class="text-center">';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $arm->name .'</td>';
                                                echo '<td><a href="/school/edit-arm/' . $arm->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Arm" style="color: dodgerblue" class="fa fa-edit"></i></a> <a><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Arm" style="color: brown; cursor: pointer;" class="fa fa-trash" onclick="deleteArm(' . $arm->id . ')"></i></a></td>';
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
                    function deleteArm(id)
                    {
                        if(confirm("This action can't be reverted. Deleting an arm would delete every fees associated with the arm. Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-arm/' + id;
                            return true;
                        }
                    }
                </script>
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/school/includes/footer.php'; ?>