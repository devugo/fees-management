<?php $page_title = 'Wards'; ?>

<?php require_once 'app/views/guardian/includes/header.php'; ?>

<?php require_once 'app/views/guardian/includes/sidebar.php'; ?>

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
                        <h3 class="text-themecolor"><?=$this->guardian()->school->name?></h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">View Wards</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row">
                <?php
                    $wards = $this->guardian()->users;
                    $school_id = $this->guardian()->school->id;
                    $school = new School();
                    $years = $school->find($school_id)->grad_year_get();
                    //print_r($years);

                    $classes = $school->find($school_id)->class_get();
                    //print_r($classes);
                    
                    
                    function classe($no, $arr)
                    {
                        if(in_array($no, $arr)){
                            return array_search($no, $arr);
                        }
                        return false;
                    }
                    foreach($wards as $ward){
                        $school = $ward->school; //get the student's school object
                        $class = $classes[classe($ward->year_of_graduation, $years)];
                        $payments_made = FeeUser::where('user_id', $ward->id)->get(); //payments made by the user
                        $availableFees = Fee::where('school_id', $school->id)->where('arm_id', $ward->arm->id)->where('classe_id', Classe::where('class', $class)->first()->id)->get(); //All fees for a particular student
                        $student_no_fees_not_paid = $availableFees->count() - $payments_made->count();
                       // print_r($payments_made);
                        //$class_index = classe($ward->year_of_graduation, $years);
                        //$no_of_fees = Classes::find($classes[$class_index])->count();
                        
                        ?>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <center class="m-t-30"> <img src="<?=$this->domain()?>/<?=$ward->profile_pix?>" class="img-circle" width="150" height="150" />
                                        <h3>Graduation Year: <?=$ward->year_of_graduation?></h3>
                                        <h6 class="card-subtitle"><i style="color: green;" class="fa fa-circle"></i> Active</h6>
                                        <a href="<?=$this->domain()?>/guardian/fee"><i class="ti-unlock"></i><span data-toggle="tooltip" data-placement="top" title="" data-original-title="No of fees paid" class="badge badge-success"><?php echo ($payments_made->count() > 0) ? count($payments_made) : 0; ?></span></a>
                                        <a href="<?=$this->domain()?>/guardian/fee"><i class="ti-lock"></i><span data-toggle="tooltip" data-placement="top" title="" data-original-title="No of fees unpaid" class="badge badge-danger"><?=$student_no_fees_not_paid?></span></a>
                                        <div class="row text-center justify-content-md-center">
                                            <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-money"></i> <font class="font-medium"></font></a></div>
                                        </div>
                                    </center>
                                </div>
                                <div>
                                    <hr> </div>
                                <div class="card-body"> <small class="text-muted">Name </small>
                                    <h6><?=$ward->lastname?> <?=$ward->firstname?> <?=$ward->middlename?></h6> <small class="text-muted p-t-30 db">School</small>
                                    <h6><?=$ward->school->name?></h6> <small class="text-muted p-t-30 db">Class</small>
                                    <h6><?=$class?><?=$ward->arm->name?></h6>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                ?>
                    

                </div>
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/guardian/includes/footer.php'; ?>