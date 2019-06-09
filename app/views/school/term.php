<?php $page_title = 'Term'; ?>

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
                        <h3 class="text-themecolor">Term</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Term</li>
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
                                <h4 class="card-title">Register Term</h4>
                                <form class="form-horizontal p-t-20" action="/school-manager/create-term" method="post">
                                    <div class="form-group row">
                                        <label for="session" class="col-sm-2 control-label">Session*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-calendar"></i>
                                                    </span>
                                                </div>
                                                <input type="text" min="2000" name="session" class="form-control" value="<?=School::get_session()?>" placeholder="Session" disabled>
                                                
                                            </div>
                                            <?=$this->InputError('session')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-2 control-label">Term*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-map"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control" name="term">
                                                    <option value="First Term">1st</option>
                                                    <option value="Second Term">2nd</option>
                                                    <option value="Third Term">3rd</option>
                                                </select>
                                                
                                            </div>
                                            <?=$this->InputError('term')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="start" class="col-sm-2 control-label">Start*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-back-right"></i>
                                                    </span>
                                                </div>
                                                <input type="date" name="start" class="form-control">
                                                
                                            </div>
                                            <?=$this->InputError('start')?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="end" class="col-sm-2 control-label">End*</label>
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="ti-back-left"></i>
                                                    </span>
                                                </div>
                                                <input type="date" name="end" class="form-control">
                                                
                                            </div>
                                            <?=$this->InputError('end')?>
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
                                <h4 class="card-title">Terms</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $terms = $this->school()->terms->all(); 
                                            foreach($terms as $term){
                                                echo '<tr>';
                                                echo '<td>' . $term->session . '</td>';
                                                echo '<td>' . $term->term . '</td>';
                                                echo '<td class="text-center">' . $term->start . '</td>';
                                                echo '<td class="text-center">' . $term->end . '</td>';
                                                echo '<td class="text-center"><a href="/school/edit-term/' . $term->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Term" style="color: dodgerblue" class="fa fa-edit"></i></a> <a><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Term" style="color: brown; cursor: pointer;" class="fa fa-trash" onclick="deleteTerm(' . $term->id . ')"></i></a></td>';
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
                    function deleteTerm(id)
                    {
                        if(confirm("This action can't be reverted. Deleting a term would delete every fees associated with the term. Are you sure you want to delete??")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-term/' + id;
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