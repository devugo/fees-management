<?php $page_title = 'Notification'; ?>

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
                        <h3 class="text-themecolor">Notification</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Notification</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Notify Schools</h4>
                                <form class="form-horizontal p-t-20" action="/admin-manager/create-notification" method="post">
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
                                        <label for="title" class="col-sm-1 control-label">School*</label>
                                        <div class="col-sm-4">
                                            <select class="form-control select2 m-b-10 select2-multiple" name="school[]" style="width: 100%" multiple="multiple" data-placeholder="Choose">
                                                <?php
                                                    $schools = School::all();

                                                    foreach($schools as $school){
                                                        echo '<option value=' . $school->id . '>' . $school->name . '</option>';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?=Token::csrf()?>
                                    
                                    <div class="form-group row m-b-0">
                                        <div class="offset-sm-1 col-sm-1">
                                            <button type="submit" class="btn btn-info waves-effect waves-light">Send</button>
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
                                <h4 class="card-title">Notification</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>School</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $noticiations = Notification::all();
                                            $sn = 1;
                                            foreach($noticiations as $notification){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $notification->title . '</td>';
                                                echo '<td>' . substr($notification->description, 0, 20) . '</td>';
                                                echo '<td>' . $notification->school->name . '</td>';
                                                echo '<td>' . $notification->created_at . '</td>';
                                                echo '<td>'  . Admin::viewed_notification($notification) . '</td>';
                                                echo '<td class="text-center"><a href="' . $this->domain() . '/admin/view-notification/' . $notification->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="View Notification" class="fas fa-eye"></i></a> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Notification" class="fa fa-trash" style="color: brown; cursor: pointer;" onclick="deleteNotification(' . $notification->id . ')"></td>';
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
                    function deleteNotification(id)
                    {
                        if(confirm("Are you sure you want to delete?")){
                            window.location.href='<?=$this->domain()?>' + '/admin-manager/delete-notification/' + id;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/admin/includes/footer.php'; ?>