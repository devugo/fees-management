<?php $page_title = 'Notification'; ?>

<?php require_once '../app/views/guardian/includes/header.php'; ?>

<?php require_once '../app/views/guardian/includes/sidebar.php'; ?>

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
                            <li class="breadcrumb-item active">Notification</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Notifications</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
                                                <th>School</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $noticiations = $this->guardian()->broadcasts;
                                            $sn = 1;
                                            foreach($noticiations as $notification){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $notification->title . '</td>';
                                                echo '<td>' . substr($notification->description, 0, 20) . '</td>';
                                                echo '<td>' . $notification->created_at . '</td>';
                                                echo '<td class="text-center">' . Guardian::viewed_notification($notification) . ' <a href="' . $this->domain() . '/guardian/view-notification/' . $notification->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="View Notification" class="fas fa-eye"></i></a></td>';
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
    <?php require_once '../app/views/guardian/includes/footer.php'; ?>