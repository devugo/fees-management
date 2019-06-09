<?php $page_title = 'Edit Student'; ?>

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
                            <li class="breadcrumb-item active">Edit Student</li>
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
                                $student = $this->school()->users->find($data['id']);
                                function activeDot($val){
                                    if($val->blocked_on === NULL){
                                        return '<i style="color: green;" class="fa fa-circle"></i> Active';
                                    }else{
                                        return '<i style="color: red;" class="fa fa-circle"></i> Blocked';
                                    }
                                }

                                function activeButton($val, $id){
                                    if($val->blocked_on === NULL){
                                        return '<a class="btn btn-danger" href="/school-manager/block-student/' . $id .'">Block</a>';
                                    }else{
                                        return '<a class="btn btn-success" href="/school-manager/block-student/' . $id .'">Activate</a>';
                                    }
                                }
                            ?>
                            <div class="card-body">
                                <center class="m-t-30"> <img src="<?=$this->domain()?>/<?=$this->school()->users->find($data['id'])->profile_pix?>" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?=$this->school()->users->find($data['id'])->lastname?> <?=$this->school()->users->find($data['id'])->firstname?> <?=$this->school()->users->find($data['id'])->middlename?></h4>
                                    <h6 class="card-subtitle"><?=activeDot($student)?></h6>
                                    <!--<h4><?=activeButton($student, $data['id'])?></h4>-->
                                    
                                    <?php
                                        $school = new School();
                                        $years = $school->find($this->school_id())->grad_year_get();

                                        $classes = $school->find($this->school_id())->class_get();
                                        function classe($no, $arr)
                                        {
                                            if(in_array($no, $arr)){
                                                return array_search($no, $arr);
                                            }
                                        }
                                    ?>
                                    <form action="<?=$this->domain()?>/school-manager/update-student_profile_pix/<?=$data['id']?>" method="post" enctype="multipart/form-data">
                                        <input onchange="form.submit()" style="display: none;" type="file" class="form-control" name="profile_pix" id="profile_pix" placeholder="Student Profile">
                                    </form>
                                    <button style="color: white; cursor: pointer;" onclick="document.getElementById('profile_pix').click();" class="form-control btn-info">Update Profile Picture</button>
                                    <div class="row text-center justify-content-md-center">
                                        <div data-toggle="tooltip" data-placement="top" title="" data-original-title="Name of Guardian" class="col-4"><a href="<?=$this->domain()?>/school/edit-guardian/<?=$this->school()->users->find($data['id'])->guardian->id?>" class="link"><i class="fa fa-user-secret"></i> <font class="font-medium"><?=$this->school()->users->find($data['id'])->guardian->firstname?> <?=$this->school()->users->find($data['id'])->guardian->lastname?></font></a></div>
                                        <div data-toggle="tooltip" data-placement="top" title="" data-original-title="Number of siblings in school" class="col-4"><a href="javascript:void(0)" class="link"><i class="fa fa-users"></i> <font class="font-medium"><?=$this->school()->users->find($data['id'])->guardian->users->count()?></font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Class </small>
                                <h6><?=$classes[classe($student->year_of_graduation, $years)]?></h6> <small class="text-muted p-t-30 db">Phone</small>
                                <h6><?=$this->school()->users->find($data['id'])->guardian->phone?></h6> <small class="text-muted p-t-30 db">Email</small>
                                <h6><?=$this->school()->users->find($data['id'])->guardian->email?></h6><small class="text-muted p-t-30 db">Address</small>
                                <h6><?=$this->school()->users->find($data['id'])->guardian->address?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Student</h4>
                                <form class="form-horizontal p-t-20" action="/school-manager/update-student/<?=$data['id']?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-2 control-label">Lastname*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="lastname" value="<?=$this->school()->users->find($data['id'])->lastname?>" id="lastname" placeholder="Lastname">
                                                
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
                                                <input type="text" class="form-control" value="<?=$this->school()->users->find($data['id'])->firstname?>" name="firstname" id="firstname" placeholder="Firstname">
                                                
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
                                                <input type="text" class="form-control" value="<?=$this->school()->users->find($data['id'])->middlename?>" name="middlename" id="middlename" placeholder="Middlename">
                                                
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
                                                <select class="form-control" name="guardian">
                                                    <?php
                                                        $guardians = $this->school()->guardians->all();
                                                        $id = ($data['id'] != '') ? $data['id'] : '';
                                                        
                                                        //echo selected
                                                       
                                                        
                                                        foreach($guardians as $guardian){
                                                            $select = ($guardian->id==$this->school()->users->find($data['id'])->guardian->id) ? 'selected' : '' ;
                                                            echo '<option ' . $select . '>' . $guardian->firstname . ' ' . $guardian->lastname . '</option>';
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
                                                <input type="date" value="<?=$this->school()->users->find($data['id'])->age?>" class="form-control" name="age" id="age" placeholder="Age">
                                                
                                            </div>
                                            <?=$this->InputError('age')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sex" class="col-sm-2 control-label">Sex</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-link"></i>
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
                                    <div class="form-group row">
                                        <label for="reg_no" class="col-sm-2 control-label">Registration Number*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-pencil"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" value="<?=$this->school()->users->find($data['id'])->reg_no?>" name="reg_no" id="reg_no" placeholder="Registration Number">
                                                
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
                                                <?php
                                                    function active($val, $equal)
                                                    {
                                                        if($val == $equal){
                                                            return 'selected';
                                                        }
                                                        return false;
                                                    }
                                                    $arms = $this->school()->arms;
                                                ?>
                                                <select name="arm" id="arm" class="form-control">
                                                    <?php
                                                        foreach($arms as $arm){
                                                            echo '<option value=' . $arm->id . ' ' . active($this->school()->users->find($data['id'])->arm->id, $arm->id) . '>' . $arm->name . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                
                                                
                                            </div>
                                            <?=$this->InputError('arm')?>
                                        </div>
                                    </div>
                                    <?php
                                        function selectGradYear($actual, $val)
                                        {
                                            if($actual == $val ){
                                                return 'selected';
                                            }
                                        }
                                    ?>
                                    <div class="form-group row">
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
                                                            echo '<option ' . selectGradYear($this->school()->users->find($data['id'])->year_of_graduation, $years[$i]) . '>' . $years[$i] . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('year_of_graduation')?>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-2 col-sm-9">
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
                                <h4 class="card-title">Students</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Name of Student</th>
                                                <th>Guardian</th>
                                                <th>Sex</th>
                                                <th>Age</th>
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
                                                    return '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Ban Student" style="color: orange;" class="fa fa-ban"></i>';
                                                }else{
                                                    return '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Activate Student" style="color: green;" class="fa fa-plus-circle"></i>';
                                                }
                                            }
                                            $sn = 1;
                                            foreach($students as $student){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td><img class="img-responsive" style="border-radius: 50%; width: 30px; height: 30px;"src="' . $this->domain(). '/' . $student->profile_pix . '"> ' . $student->firstname . ' ' . $student->lastname .'</td>';
                                                echo '<td>' . $student->guardian->lastname . ' ' . $student->guardian->firstname . '</td>';
                                                echo '<td>' . $student->sex . '</td>';
                                                echo '<td>' . $student->age . '</td>';
                                                echo '<td>' . $classes[classe($student->year_of_graduation, $years)] . '</td>';
                                                echo '<td>' . $student->year_of_graduation . '</td>';
                                                echo '<td class="text-center">' . isStudentBlocked($student) . '</td>';
                                                echo '<td class="text-center"><a href="' . $this->domain() .'/school-manager/block-student/' . $student->id . '">' . ban($student) . '</a> <a href="' . $this->domain() . '/school/edit-student/' . $student->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Student" style="color: dodgerblue" class="fa fa-edit"></i></a> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Student" onclick="deleteStudent(' . $student->id . ')" style="cursor: pointer; color: brown" class="fa fa-trash"></i></td>';
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