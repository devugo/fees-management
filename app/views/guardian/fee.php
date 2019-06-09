<?php $page_title = 'Fee'; ?>

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
                            <li class="breadcrumb-item active">Fee</li>
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
                                <h4 class="card-title">Outstanding Fees</h4>
                                <h5><span class="label label-primary">Bonuses have been deducted from the actual amount of fees to be paid. Upload proof of payment once payment is made</span></h5>
                                <button type="button" class="btn btn-info btn-rounded m-t-10 float-right" data-toggle="modal" data-target="#myModal">View Bank Details</button>
                                <div class="table-responsive m-t-40">
                                    <table id="ugoTable" class="table table-bordered table-striped">
                                        <?php
                                            $school = new School();
                                            $years = $school->find($this->guardian()->school_id)->grad_year_get(); // Get the graduation years

                                            $classes = $school->find($this->guardian()->school_id)->class_get(); // Get the various classes

                                            function classe($no, $arr)
                                            {
                                                if(in_array($no, $arr)){
                                                    return array_search($no, $arr);
                                                }
                                                return false;
                                            }
                                                //print_r($years) . '<br>';
                                                //print_r($classes);
                                           
                                        ?>
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Ward</th>
                                                <th>Title</th>
                                                <th>Amount</th>
                                                <th>Bonus</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>Class</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 1;
                                                 $wards = $this->guardian()->users;
                                                 foreach($wards as $ward){
                                                     $class = $classes[classe($ward->year_of_graduation, $years)];
                                                     $arm_id = $ward->arm_id;
                                                     $school_id = $ward->school_id;
                                                     $class_id = Classe::where('school_id', $school_id)->where('class', $class)->first()->id;
                                                     
                                                     $fees = Fee::where('school_id', $school_id)->where('classe_id', $class_id)->where('arm_id', $arm_id)->get();
                                                    // $fees = Fee::where('school_id', $school_id)->where('classe_id', $class_id)->where('arm_id', $arm_id)->first();
                                                     foreach($fees as $fee){
                                                        $fee_id = $fee->id;
     
                                                         //check if payment has been made for the fees
                                                        $payment = FeeUser::where('user_id', $ward->id)->where('fee_id', $fee_id)->get();

                                                        $bonuses = $this->guardian()->school->bonuses->sortByDesc('no_of_wards');
                                                        $bonus_money = 0;
                                                        $no_of_wards = $this->guardian()->users->count();
                                                        foreach($bonuses as $bonus){
                                                            if($no_of_wards >= $bonus->no_of_wards){
                                                                if($bonus->bonus_type == 'amount'){
                                                                    $bonus_money = $bonus->bonus;
                                                                }else{
                                                                    $bonus_money = $fee->prepared_fees->sum('amount') * ($bonus->bonus / 100);
                                                                }
                                                                break;
                                                            }
                                                        }
                                                         if($payment->count() < 1){?>
                                                            <tr>
                                                                <td><?=$sn?></td>
                                                                <td><?=$ward->firstname?> <?=$ward->lastname?></td>
                                                                <td><?=$fee->title?></td>
                                                                <td class="text-center"><?=$fee->prepared_fees->sum('amount') - $bonus_money?></td>
                                                                <td class="text-center"><?=$bonus_money?></td>
                                                                <td class="text-center"><?=$fee->session?></td>
                                                                <td class="text-center"><?=$fee->term->term?></td>
                                                                <td class="text-center"><?=$fee->classe->class?></td>
                                                                <td class="text-center">
                                                                    <form action="<?=$this->domain()?>/guardian-manager/upload_payment_proof/<?=$ward->id?>/<?=$fee_id?>/<?=$bonus_money?>" method="post" enctype="multipart/form-data">
                                                                        <input onchange="form.submit()" type="file" name="payment_proof" style="display: none;" id="payment_proof<?=$ward->id?><?=$fee_id?>">
                                                                    </form>
                                                                    <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Payment Proof" style="cursor: pointer; color: orange;"  onclick="document.getElementById('payment_proof<?=$ward->id?><?=$fee_id?>').click()" class="fa fa-upload">
                                                                    </i>
                                                                </td>
                                                            
                                                            </tr><?php
                                                         }
                                                     }
                                                 }

                                            ?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Fees Paid</h4>
                                <h5><span class="label label-primary">Receipt can be printed once payment has been approved by school.</span></h5>
                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Ward</th>
                                                <th>Title</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>Class</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $payments = $this->guardian()->fee_users; // Get all paid fees
                                                
                                            //Get all bonuses created by guardian's school
                                            $bonuses = $this->guardian()->school->bonuses->sortByDesc('no_of_wards');
                                                $bonus_money = 0;
                                                $no_of_wards = $this->guardian()->users->count();
                                                foreach($bonuses as $bonus){
                                                    if($no_of_wards >= $bonus->no_of_wards){
                                                        if($bonus->bonus_type == 'amount'){
                                                            $bonus_money = $bonus->bonus;
                                                        }else{
                                                            $bonus_money = $fee->prepared_fees->sum('amount') * ($bonus->bonus / 100);
                                                        }
                                                        break;
                                                    }
                                                }

                                            $sn = 1;
                                            foreach($payments as $payment)
                                            {
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $payment->user->firstname . ' ' . $payment->user->lastname . '</td>';
                                                echo '<td>' . $payment->fee->title . '</td>';
                                                echo '<td>' . $payment->fee->session . '</td>';
                                                echo '<td>' . $payment->fee->term->term . '</td>';
                                                echo '<td>' . $payment->fee->classe->class . $payment->user->arm->name . '</td>';?>
                                                <td><?=($payment->fee->prepared_fees->sum('amount')) - $bonus_money?></td><?php
                                                echo '<td class="text-center">' . $payment->confirmed() . '</td>';?>
                                                <td class="text-center">
                                                    <form action="<?=$this->domain()?>/guardian-manager/upload_payment_proof/<?=$payment->user_id?>/<?=$payment->fee_id?>/<?=$bonus_money?>" method="post" enctype="multipart/form-data">
                                                        <input onchange="form.submit()" type="file" name="payment_proof" style="display: none;" id="payment_proof<?=$payment->user_id?><?=$payment->fee_id?>">
                                                    </form>
                                                    <?=($payment->confirmed_payment()) ? '<a style="color: grey;" href="' . $this->domain() . '/guardian-manager/print-payment-receipt/' . $payment->id . '"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Receipt" class="fa fa-print"></i></a>' : '' ?> <i data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Payment Proof" style="cursor: pointer; color: orange;"  onclick="document.getElementById('payment_proof<?=$payment->user_id?><?=$payment->fee_id?>').click()" class="fa fa-upload">
                                                    </i>
                                                    <a href="<?=$this->domain()?>/<?=$payment->payment_proof?>"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="View Proof" class="fa fa-eye"></i></a>
                                                </td><?php
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
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Bank Details</h4>
                                </div>
                                <div class="container text-center">
                                    Bank Name: <?=$this->guardian()->school->school_settings->bank?><br>
                                    Account Name: <?=$this->guardian()->school->school_settings->account_name?><br>
                                    Bank Number: <?=$this->guardian()->school->school_settings->account_no?>
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
    <?php require_once 'app/views/guardian/includes/footer.php'; ?>
    <script>
            $('#ugoTable thead th').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input class="form-control" type="text" placeholder="Search '+title+'" />' );
            } );

            var dataTableInstance = $('#ugoTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );

            dataTableInstance.columns().every(function () {
                var datatableColumn = this;

                var searchTextBoxes = $(this.header()).find('input');

                searchTextBoxes.on('keyup change', function() {
                    datatableColumn.search(this.value).draw();
                });

                searchTextBoxes.on('click', function(e) {
                    e.stopPropagation();
                });
            });
        </script>