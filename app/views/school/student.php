<?php $page_title = 'Student'; ?>

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
                        <h3 class="text-themecolor">Student</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Student</li>
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
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Register Student</h4>
                                <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/school-manager/create-student" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-2 control-label">Lastname*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname">
                                                
                                            </div>
                                            <?=$this->InputError('lastname')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-2 control-label">Firstname*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname">
                                                
                                            </div>
                                            <?=$this->InputError('firstname')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-2 control-label">Middlename*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Middlename">
                                                
                                            </div>
                                            <?=$this->InputError('middlename')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="guardian" class="col-sm-2 control-label">Guardian*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-stamp"></i>
                                                    </span>
                                                </div>
                                                <?php
                                                $guardians = $this->school()->guardians;
                                                ?>
                                                <select class="form-control" name="guardian">
                                                    <?php
                                                        $guardians = $this->school()->guardians;
                                                        $id = ($data['id'] != '') ? $data['id'] : '';
                                                        
                                                        function select($val, $idVal)
                                                        {
                                                            if($val->id == $idVal){
                                                                return 'selected';
                                                            }
                                                        }
                                                       
                                                        
                                                        foreach($guardians as $guardian){
                                                            echo '<option value="' . $guardian->id . '" ' . select($guardian, $id) . '>' . $guardian->lastname . ' ' . $guardian->firstname . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('guardian')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="age" class="col-sm-2 control-label">DOB*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-calendar"></i>
                                                    </span>
                                                </div>
                                                <input type="date" class="form-control" name="age" id="age" placeholder="Age">
                                                
                                            </div>
                                            <?=$this->InputError('age')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sex" class="col-sm-2 control-label">Sex*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-link"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="sex" placeholder="Select Sex">
                                                    <option>Male</option>
                                                    <option>female</option>
                                                </select>
                                            </div>
                                            <?=$this->InputError('sex')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="reg_no" class="col-sm-2 control-label">Reg. Number*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-pencil"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="reg_no" id="reg_no" placeholder="Registration Number">
                                                
                                            </div>
                                            <?=$this->InputError('reg_no')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="arm" class="col-sm-2 control-label">Class Arm*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-shift-right"></i>
                                                    </span>
                                                </div>
                                                <select name="arm" class="form-control" id="arm">
                                                    <?php  
                                                        $arms = $this->school()->arms;
                                                        foreach($arms as $arm){
                                                            echo '<option value=' . $arm->id . '>' . $arm->name . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('arm')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <?php
                                        $school = new School();
                                        $years = $school->find($this->school_id())->grad_year_get();

                                        $classes = $school->find($this->school_id())->class_get();
                                    ?>
                                        <label for="year_of_graduation" class="col-sm-2 control-label">Year of Graduation*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-shift-right"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="year_of_graduation" id="year_of_graduation" placeholder="Year of graduation">
                                                    <?php
                                                        for($i=0; $i<count($years); $i++){
                                                            echo '<option>' . $years[$i] . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('year_of_graduation')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="profile_pix" class="col-sm-2 control-label">Profile Picture*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="file" class="form-control" name="profile_pix" id="profile_pix" placeholder="Profile Picture">
                                                
                                            </div>
                                            <?=$this->InputError('profile_pix')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-2 col-sm-9">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card text-center">
                            <div class="card-header"><span style="color: green">HINT:</span> Assigning of graduation year <br>Based on the classes registered.</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table color-table table-primary">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Grad. Year</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                
                                                for($i=0; $i<count($years); $i++){
                                                    echo '<tr>';
                                                    echo '<td>' . $classes[$i] . '</td>';
                                                    echo '<td>' . $years[$i] . '</td>';
                                                    echo '</tr>';
                                                }
                                                //print_r($this->school->grad_year_get());
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">Powered by Devugo</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Students</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                    <?php
                                        function classe($no, $arr)
                                        {
                                            if(in_array($no, $arr)){
                                                return array_search($no, $arr);
                                            }
                                        }
                                    ?>
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Name of Student</th>
                                                <th>Reg No</th>
                                                <th>Guardian</th>
                                                <th>Sex</th>
                                                <th>DOB</th>
                                                <th>Class</th>
                                                <th>Joined</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $students = $this->school()->users->all();
                                            function isStudentBlocked($val)
                                            {
                                                if($val->blocked_on === NULL){
                                                    return '<span class="label label-success">Active</span>';
                                                }else{
                                                    return '<span class="label label-danger">Blocked</span>';
                                                }
                                            }

                                            function ban($val)
                                            {
                                                if($val->blocked_on === NULL){
                                                    return '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Block Student" style="color: orange;" class="fa fa-ban"></i>';
                                                }else{
                                                    return '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate Student" style="color: green;" class="fa fa-plus-circle"></i>';
                                                }
                                            }
                                            $sn = 1;
                                            foreach($students as $student){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td><img class="img-responsive" style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $student->profile_pix . '"> ' . $student->firstname . ' ' . $student->lastname .'</td>';
                                                echo '<td>' . $student->reg_no . '</td>';
                                                echo '<td><img class="img-responsiv3" style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $student->guardian->profile_pix . '"> ' . $student->guardian->lastname . ' ' . $student->guardian->firstname . '</td>';
                                                echo '<td>' . $student->sex . '</td>';
                                                echo '<td>' . $student->age . '</td>';
                                                echo '<td>' . $classes[classe($student->year_of_graduation, $years)] . $student->arm->name . '</td>';
                                                echo '<td class="text-center"><span class="label label-primary">' . $student->created_at->toFormattedDateString() . '</span></td>';
                                                echo '<td class="text-center">' . isStudentBlocked($student) . '</td>';
                                                echo '<td class="text-center"><a href="' . $this->domain() . '/school/edit-student/' . $student->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Student" style="color: dodgerblue" class="fa fa-edit"></i></a> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Student" onclick="deleteStudent(' . $student->id . ')" style="cursor: pointer; color: brown" class="fa fa-trash"></i></td>';
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
                    function deleteStudent(id)
                    {
                        if(confirm("This action can't be reverted. Deleting a student would delete every fees associated with the student. Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-student/' + id;
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