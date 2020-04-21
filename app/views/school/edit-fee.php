<?php $page_title = 'Fees'; ?>

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
                        <h3 class="text-themecolor">Fee</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Edit Fee</li>
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
                    function select($val, $valId){
                        if($val == $valId){
                            return 'selected';
                        }else{
                            return false;
                        }
                    }
                    //print_r($fee);
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Fee</h4>
                                <form class="form-horizontal p-t-20" action="/school-manager/update-fee/<?=$data['id']?>" method="post">
                                    <div class="form-group row">
                                        <label for="from" class="col-sm-1 control-label">Session*</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-calendar"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="from" id="session" value="<?=School::get_session()?>" placeholder="Session" disabled>
                                                
                                            </div>
                                            <?=$this->InputError('session')?>
                                        </div>
                                        <label for="class" class="col-sm-1 control-label">Term*</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-stamp"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="term">
                                                    <?php
                                                        $terms = $this->school()->terms->where('session', School::get_session());
                                                        
                                                        foreach($terms as $term){
                                                            echo '<option value="' . $term->id . '"' . ' ' . select($term->id, $fee->term_id) . '>' . $term->term . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('term')?>
                                        </div>
                                        <label for="class" class="col-sm-1 control-label">Class*</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-tag"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="class">
                                                    <?php
                                                        $classes = $this->school()->classes->all();
                                                        
                                                        foreach($classes as $class){
                                                            echo '<option value="' . $class->id . '"'  . ' ' . select($class->id, $fee->classe_id) . '>' . $class->class . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('class')?>
                                        </div>
                                        <label for="class" class="col-sm-1 control-label">Arm*</label>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-star"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="arm">
                                                    <?php
                                                        $arms = $this->school()->arms->all();
                                                        
                                                        foreach($arms as $arm){
                                                            echo '<option value="' . $arm->id . '"' . ' ' . select($arm->id, $fee->arm_id) . '>' . $arm->name . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('arm')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="title" class="col-sm-1 control-label">Title*</label>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-tag"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$fee->title?>" class="form-control" name="title" id="title" placeholder="Title">
                                                
                                            </div>
                                            <?=$this->InputError('title')?>
                                        </div>
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
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fees</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>Class</th>
                                                <th>Amount (NGN)</th>
                                                <th>Created At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $fees = $this->school()->fees->all();
                                        // Function to check if fee has been preapred or not
                                        function prepared($val)
                                        {
                                            if($val > 0){
                                                return '<span class="label label-success">Prepared</span>';
                                            }else{
                                                return '<span class="label label-danger">Not Prepared</span>';
                                            }
                                        }
                                            $sn = 1;
                                            foreach($fees as $fee){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $fee->title . '</td>';
                                                echo '<td>' . $fee->session .' </td>';
                                                echo '<td>' . $fee->term->term . '</td>';
                                                echo '<td>' . $fee->classe->class . $fee->arm->name . '</td>';
                                                echo '<td class="text-center">' . $fee->prepared_fees->sum('amount') . '</td>';
                                                echo '<td class="text-center"><span class="label label-primary">' . $fee->created_at->toFormattedDateString() . '</span></td>';
                                                echo '<td class="text-center">' . prepared($fee->prepared_fees->sum('amount')) . '</td>';
                                                echo '<td class="text-center"><i onclick="sendNotification(' . $fee->id . ')" style="color: orange; cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Send Notification" class="fa fa-envelope"></i> <a href="' . $this->domain() . '/school/prepare-fee/' . $fee->id . '"><i style="color: green;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Prepare Fee" class="fas fa-dna"></i></a> <a href="' . $this->domain() . '/school/edit-fee/' . $fee->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Fee" style="color: dodgerblue" class="fa fa-edit"></i></a> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Fee" class="fa fa-trash" style="color: brown; cursor: pointer;" onclick="deleteFee(' . $fee->id . ')"></td>';
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
                    function deleteFee(id)
                    {
                        if(confirm("This action can't be reverted. Deleting a fee would delete every prepared fees associated with the fee. Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-fee/' + id;
                            return true;
                        }
                    }

                    function sendNotification(id)
                    {
                        if(confirm("This action can't be reverted. Are you sure you want to send notification to all students guardians?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/send-notification/' + id;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/school/includes/footer.php'; ?>