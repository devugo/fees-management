<?php $page_title = 'Dashboard'; ?>

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
                        <h3 class="text-themecolor">Guardian</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Guardian</li>
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
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Register Guardian</h4>
                                <small>Default Guardian password: <?=Config::get('default/password')?></small>
                                <form class="form-horizontal p-t-20" action="/school-manager/create-guardian" method="post">
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 control-label">Lastname*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" value="<?=Input::get('lastname')?>" name="lastname" id="lastname" placeholder="Lastname">
                                                
                                            </div>
                                            <?=$this->InputError('lastname')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-3 control-label">Firstname*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" value="<?=Input::get('firstname')?>" name="firstname" id="firstname" placeholder="Firstname">
                                                
                                            </div>
                                            <?=$this->InputError('firstname')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label">Email*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-email"></i>
                                                    </span>
                                                </div>
                                                <input type="email" class="form-control" value="<?=Input::get('email')?>" name="email" id="email" placeholder="Enter Email">
                                                
                                            </div>
                                            <?=$this->InputError('email')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 control-label">Phone*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        +234
                                                    </span>
                                                </div>
                                                <input type="phone" value="<?=Input::get('phone')?>" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                                                
                                            </div>
                                            <?=$this->InputError('phone')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sex" class="col-sm-3 control-label">Sex</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-life-ring"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="sex" placeholder="Select Sex">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                            <?=$this->InputError('sex')?>
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
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Guardians</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Sex</th>
                                                <th>Wards</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $guardians = $this->school()->guardians->all(); 
                                            function isGuardianBlocked($val)
                                            {
                                                if($val->blocked_on === NULL){
                                                    return '<span class="label label-success">Active</span>';
                                                }else{
                                                    return '<span class="label label-danger">Blocked</span>';
                                                }
                                            }
                                            foreach($guardians as $guardian){
                                                echo '<tr class="text-center">';
                                                echo '<td>' . $guardian->firstname . ' ' . $guardian->lastname .'</td>';
                                                echo '<td>' . $guardian->email . '</td>';
                                                echo '<td>' . $guardian->phone . '</td>';
                                                echo '<td>' . $guardian->sex . '</td>';
                                                echo '<td>' . $guardian->users->count() . '</td>';
                                                echo '<td class="text-center">' . isGuardianBlocked($guardian) . '</td>';
                                                echo '<td><a href="' . $this->domain() . '/school/student/' . $guardian->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Add ward" style="color: green;" class="fa fa-plus-circle"></i></a> <a href="/school/edit-guardian/' . $guardian->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Guardian" style="color: dodgerblue" class="fa fa-edit"></i></a> <a><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Guardian" style="color: brown; cursor: pointer;" class="fa fa-trash" onclick="deleteGuardian(' . $guardian->id . ')"></i></a></td>';
                                                echo '</tr>';
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
                    function deleteGuardian(id)
                    {
                        if(confirm("This action can't be reverted. Deleting a guardian would delete every wards associated with the guardian. Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-guardian/' + id;
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