<?php $page_title = 'Edit Guardian'; ?>

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
                        <h3 class="text-themecolor">Guardian</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Edit Guardian</li>
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
                        <?php
                            function isGuardianBlocked($val)
                            {
                                if($val->blocked_on === NULL){
                                    return '<i style="color: green"; class="fa fa-circle">Active</i>';
                                }else{
                                    return '<i style="color: red"; class="fa fa-circle">Blocked</i>';
                                }
                            }

                            function blockActivate($val, $id)
                            {
                                if($val->blocked_on === NULL){
                                    return '<a class="btn btn-danger" href="/school-manager/block-guardian/' . $id . '">Block</a>';
                                }else{
                                    return '<a class="btn btn-success" href="/school-manager/block-guardian/' . $id . '">Activate</a>';
                                }
                            }
                            $guardian = $this->school()->guardians->find($data['id']);
                        ?>
                            <div class="card-body">
                                <center class="m-t-30"> <img src="<?=$this->domain()?>/<?=$guardian->profile_pix?>" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?=$guardian->firstname?> <?=$guardian->lastname?></h4>
                                    <h6 class="card-subtitle"><?=isGuardianBlocked($guardian)?></h6>
                                    <?=blockActivate($guardian, $data['id'])?>
                                    <div class="row text-center justify-content-md-center">
                                        <div data-toggle="tooltip" data-placement="top" title="" data-original-title="Total number of wards" class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium"><?=$this->school()->guardians->find($data['id'])->users->count()?></font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Email address </small>
                                <h6><?=$this->school()->guardians->find($data['id'])->email?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?=$this->school()->guardians->find($data['id'])->phone?></h6> <small class="text-muted p-t-30 db">Address</small>
                                <h6><?=$this->school()->guardians->find($data['id'])->address?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Guardian</h4>
                                <form class="form-horizontal p-t-20" action="/school-manager/update-guardian/<?=$data['id']?>" method="post">
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 control-label">Lastname*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->school()->guardians->find($data['id'])->lastname?>" class="form-control" name="lastname" id="lastname" placeholder="Lastname">
                                                
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
                                                <input type="text" value="<?=$this->school()->guardians->find($data['id'])->firstname?>" class="form-control" name="firstname" id="firstname" placeholder="Firstname">
                                                
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
                                                <input type="email" value="<?=$this->school()->guardians->find($data['id'])->email?>" class="form-control" name="email" id="email" placeholder="Enter Email">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label">Phone*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        +234
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->school()->guardians->find($data['id'])->phone?>" class="form-control" name="phone" id="phone" placeholder="Enter Phone No">
                                                
                                            </div>
                                            <?=$this->InputError('phone')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label">Address*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-mobile"></i>
                                                    </span>
                                                </div>
                                                <input type="text" value="<?=$this->school()->guardians->find($data['id'])->address?>" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                
                                            </div>
                                            <?=$this->InputError('address')?>
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
                                                    <?php $sex = $this->school()->guardians->find($data['id'])->sex; ?>
                                                    <option <?php  echo ($sex == 'Male') ? 'selected' : '';?>>Male</option>
                                                    <option <?php  echo ($sex == 'Female') ? 'selected' : '';?>>Female</option>
                                                </select>
                                            </div>
                                            <?=$this->InputError('sex')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-3 col-sm-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                        </div>
                                    </div>
                                </form>
                                <a onclick="resetGuardianPassword(<?=$data['id']?>)" style="color: white;" class="btn btn-primary">Reset password</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Guardians</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Sex</th>
                                                <th>Wards</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $guardians = $this->school()->guardians->all();
                                            function guardianBlocked($val){
                                                if($val->blocked_on === NULL){
                                                    return '<span class="label label-success">Active</span>';
                                                }else{
                                                    return '<span class="label label-danger">Blocked</span>';
                                                }
                                            }
                                            foreach($guardians as $guardian){
                                                echo '<tr>';
                                                echo '<td><img class="img-responsive" style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $guardian->profile_pix . '">' . $guardian->firstname . ' ' . $guardian->lastname .'</td>';
                                                echo '<td>' . $guardian->email . '</td>';
                                                echo '<td class="text-center">' . $guardian->sex . '</td>';
                                                echo '<td class="text-center">' . $guardian->users->count() . '</td>';
                                                echo '<td class="text-center">' . guardianBlocked($guardian) . '</td>';
                                                echo '<td><a href="' . $this->domain() . '/school/student/' . $guardian->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Add ward" style="color: green;" class="fa fa-plus-circle"></i></a> <a href="/school/edit-guardian/' . $guardian->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Guardian" style="color: dodgerblue" class="fa fa-edit"></i></a> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Guardian" style="color: brown; cursor: pointer;" class="fa fa-trash"  onclick="deleteGuardian(' . $guardian->id . ')"></i></td>';
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
                        if(confirm("Do you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-guardian/' + id;
                            return true;
                        }
                    }

                    function resetGuardianPassword(id)
                    {
                        if(confirm("This action can't be reverted. Are you sure you want to reset guardian's password?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/reset-guardian-password/' + id;
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