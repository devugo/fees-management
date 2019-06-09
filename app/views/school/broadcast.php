<?php $page_title = 'Broadcasts'; ?>

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
                        <h3 class="text-themecolor">Broadcast</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Broadcast</li>
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
                                <h4 class="card-title">Broadcast to Guardians</h4>
                                <small class="label label-primary">Selected guardians will receive text messages</small>
                                <form class="form-horizontal p-t-20" action="/school-manager/create-broadcast" method="post">
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-1 control-label">Title*</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-calendar"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                                                
                                            </div>
                                            <?=$this->InputError('title')?>
                                        </div>
                                        <label for="description" class="col-sm-1 control-label">Description*</label>
                                        <div class="col-sm-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-calendar"></i>
                                                    </span>
                                                </div>
                                                <textarea class="form-control" name="description" placeholder="description..."></textarea>
                                                
                                            </div>
                                            <?=$this->InputError('description')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-1 control-label">Guardian*</label>
                                        <div class="col-sm-4">
                                            <select class="form-control select2 m-b-10 select2-multiple" name="guardian[]" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                                <?php
                                                    $guardians = $this->school()->guardians;

                                                    foreach($guardians as $guardian){
                                                        echo '<option value=' . $guardian->id . '>' . $guardian->lastname . ' ' . $guardian->firstname . '</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-1 col-sm-1">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Broadcast</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Broadcasts</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
                                                <th>Guardian</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $broadcasts = $this->school()->broadcasts->all();
                                            $sn = 1;
                                            foreach($broadcasts as $broadcast){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $broadcast->title . '</td>';
                                                echo '<td>' . $broadcast->guardian->lastname . ' ' . $broadcast->guardian->firstname . '</td>';
                                                echo '<td><span class="label label-primary">' . $broadcast->created_at->toFormattedDateString() . '</span></td>';
                                                echo '<td class="text-center"><a href="' . $this->domain() . '/school/view-broadcast/' . $broadcast->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="View Broadcast" class="fas fa-eye"></i></a> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Broadcast" class="fa fa-trash" style="color: brown; cursor: pointer;" onclick="deleteBroadcast(' . $broadcast->id . ')"></td>';
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
                    function deleteBroadcast(id)
                    {
                        if(confirm("Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-broadcast/' + id;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/school/includes/footer.php'; ?>