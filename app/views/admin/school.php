<?php $page_title = 'School'; ?>

<?php require_once '../app/views/admin/includes/header.php'; ?>

<?php require_once '../app/views/admin/includes/sidebar.php'; ?>

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
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor">School</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Add School</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>INCOME</small></h6>
                                    <h4 class="m-t-0 text-info"><?=School::currency_formatter(AdminIncome::find(1)->income)?></h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
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
                                <h4 class="card-title">Register School</h4>
                                <form class="form-horizontal p-t-20" action="<?=$this->domain()?>/admin-manager/create-school" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 control-label">Name*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Name of school">
                                                
                                            </div>
                                            <?=$this->InputError('name')?>
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
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                                                
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
                                                <input type="number" min="1" class="form-control" name="phone" id="phone" placeholder="Enter Phone">
                                                
                                            </div>
                                            <?=$this->InputError('phone')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 control-label">Address</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-pin"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                            </div>
                                            <?=$this->InputError('address')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-3 control-label">City</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-tag"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="city" id="city" placeholder="Enter City">
                                            </div>
                                            <?=$this->InputError('city')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="state" class="col-sm-3 control-label">State</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="fa fa-life-ring"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name="state" id="state" placeholder="Enter State">
                                            </div>
                                            <?=$this->InputError('state')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="logo" class="col-sm-3 control-label">Logo</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-direction-alt"></i>
                                                    </span>
                                                </div>
                                                <input type="file" class="form-control" name="logo" id="logo" placeholder="Upload Logo">
                                            </div>
                                            <?=$this->InputError('logo')?>
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
                                <h4 class="card-title">Schools</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>phone</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $schools = School::all(); 
                                            function active($name){
                                                if($name->blocked_on === NULL){
                                                    return '<span class="label label-success">Active</span>';
                                                }else{
                                                    return '<span class="label label-danger">Blocked</span>';
                                                }
                                            }
                                            foreach($schools as $school){
                                                echo '<tr class="text-center">';
                                                echo '<td>' . $school->name . '</td>';
                                                echo '<td>' . $school->email . '</td>';
                                                echo '<td>+234' . $school->phone . '</td>';
                                                echo '<td>' . $school->address . '</td>';
                                                echo '<td>' . $school->city . '</td>';
                                                echo '<td>' . $school->state . '</td>';
                                                echo '<td class="text-center">' . active($school) . '</td>';
                                                echo '<td><a href="' . $this->domain() . '/school/dashboard/' . $school->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="View School" style="color: green;" class="fa fa-eye"></i></a> <a href="/admin/edit-school/' . $school->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit School" style="color: dodgerblue" class="fa fa-edit"></i></a> <a><i  data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete School" style="color: brown; cursor: pointer;" class="fa fa-trash" onclick="deleteSchool(' . $school->id . ')"></i></a></td>';
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
                    function deleteSchool(id)
                    {
                        if(confirm("This action can't be reverted. Every Information about the school will be wiped from the system. Are you sure you want to delete school?")){
                            window.location.href='<?=$this->domain()?>' + '/admin-manager/delete-school/' + id;
                            return true;
                        }
                    }
                </script>
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/admin/includes/footer.php'; ?>