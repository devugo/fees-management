<?php $page_title = 'Payments'; ?>

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
                        <h3 class="text-themecolor">Payment</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Payment</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Payments Made</h4>
                                <div class="table-responsive m-t-40">
                                    <table style="font-size: 14px;" id="myTable" class="table table-bordered table-striped">
                                        <?php
                                            $school = new School();
                                            $years = $school->find($this->school_id())->grad_year_get();

                                            $classes = $school->find($this->school_id())->class_get();
                                            function classe($no, $arr)
                                            {
                                                if(in_array($no, $arr)){
                                                    return array_search($no, $arr);
                                                }
                                                return false;
                                            }
                                        ?>
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
                                                <th>Amount(NGN)</th>
                                                <th>Bonus</th>
                                                <th>Guardian</th>
                                                <th>Student</th>
                                                <th>Class</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $payments = $this->school()->fee_users;
                                            function confirmBut($val, $pay_id)
                                            {
                                                if($val->confirmed_at === NULL){
                                                    return '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Confirm Payment" style="color: green; cursor: pointer;" onclick="confirmPayment(' . $pay_id . ')" class="fa fa-plus-circle"></i>';
                                                }else{
                                                    return false;
                                                }
                                            }
                                            $sn = 1;
                                            foreach($payments as $payment){
                                                echo '<tr>';
                                                echo '<td>' . $sn . '</td>';
                                                echo '<td>' . $payment->fee->title . '</td>';
                                                echo '<td class="text-center">' . $payment->fee->prepared_fees->sum('amount') . '</td>';
                                                echo '<td>' . $payment->bonus . '</td>';
                                                echo '<td><img style="border-radius: 50%; width: 25px; height: 25px;" src="' . $this->domain() . '/' . $payment->user->guardian->profile_pix . '"> ' . $payment->user->guardian->lastname . ' ' . $payment->user->guardian->firstname . '</td>';
                                                echo '<td><img style="border-radius: 50%; width: 25px; height: 25px;" src="' . $this->domain() . '/' . $payment->user->profile_pix. '"> ' . $payment->user->lastname . ' ' . $payment->user->firstname . ' ' . $payment->user->guardian->middlename . '</td>';
                                                echo '<td>' . $classes[classe($payment->user->year_of_graduation, $years)] . $payment->user->arm->name . '</td>';
                                                echo '<td>' . $payment->fee->session . '</td>';
                                                echo '<td>' . $payment->fee->term->term . '</td>';
                                                echo '<td>'  . $payment->confirmed() . '</td>'; ?>
                                                <td class="text-center"><?=($payment->confirmed_payment()) ? '<a target="_blank" href="' . $this->domain() . '/school-manager/print-payment-receipt/' . $payment->id . '"><i style="color: grey;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Receipt" class="fa fa-print"></i></a>' : '' ?> <?=(!$payment->waved()) ? '<a href="<?=$this->domain()?>/<?=$payment->payment_proof?>"><i data-toggle="tooltip" data-placement="top" title="" data-original-title="View Payment Proof" class="fa fa-eye"></i></a>' : ''?> <?=confirmBut($payment, $payment->id)?> <?=(!$payment->confirmed_payment()) ? '<i data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Payment" class="fa fa-trash" style="color: brown; cursor: pointer;" onclick="deletePayment(' . $payment->id . ')">' : ''?></td>;
                                                <?php echo '</tr>';
                                                $sn++;
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Payments Expecting</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="ugoTable" style="font-size: 12px;" class="table table-bordered table-striped">
                                       
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Amount</th>
                                                <th>Bonus</th>
                                                <th>Guardian</th>
                                                <th>Student</th>
                                                <th>Class</th>
                                                <th>Session</th>
                                                <th>Term</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $fees = $this->school()->fees;

                                                foreach($fees as $fee){
                                                    $fee_title = $fee->title;
                                                    $fee_session = $fee->session;
                                                    $fee_term = $fee->term->term;
                                                    //$fee_amount = $fee->amount;
                                                    $fee_amount = $fee->prepared_fees->sum('amount');

                                                    $fee_class = $fee->classe->class;
                                                    $fee_grad_year = $years[classe($fee_class, $classes)];
                                                    $fee_arm_id = $fee->arm->id;
                                                    //echo $fee_grad_year . '<br>';
                                                    //echo $fee_class . '<br>';
                                                    $students = $this->school()->users->where('year_of_graduation', $fee_grad_year)->where('arm_id', $fee->arm_id)->all();
                                                    foreach($students as $student)
                                                    {
                                                        $bonuses = $this->school()->bonuses->sortByDesc('no_of_wards');
                                                        $bonus_money = 0;
                                                        $no_of_wards = $student->guardian->users->count();
                                                        foreach($bonuses as $bonus){
                                                            if($no_of_wards >= $bonus->no_of_wards){
                                                                if($bonus->bonus_type == 'amount'){
                                                                    $bonus_money = $bonus->bonus;
                                                                }else{
                                                                    $bonus_money = $fee_amount * ($bonus->bonus / 100);
                                                                }
                                                                break;
                                                            }
                                                        }
                                                        if(FeeUser::where('fee_id', $fee->id)->where('user_id', $student->id)->first()){
                                                            continue;
                                                        }
                                                        echo '<tr>';
                                                        echo '<td><i style="color: dodgerblue; cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wave Payment" onclick="wavePayment(' . $fee->id . ',' . $student->id . ')" class="fa fa-2x fa-hand-paper"></i> ' . $fee_title . '</td>';
                                                        echo '<td class="text-center">' . $fee_amount . '</td>';
                                                        echo '<td class="text-center">' . $bonus_money . '</td>';
                                                        echo '<td><img class="img-responsive" style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $student->guardian->profile_pix . '"> ' . $student->guardian->lastname . ' ' . $student->guardian->firstname . '</td>';
                                                        echo '<td><img class="img-responsive" style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $student->profile_pix . '"> ' . $student->lastname . ' ' . $student->firstname . '</td>';
                                                        echo '<td class="text-center">' . $fee_class . $fee->arm->name . '</td>';
                                                        echo '<td class="text-center">' . $fee_session . '</td>';
                                                        echo '<td class="text-center">' . $fee_term . '</td>';
                                                        echo '</tr>';
                                                    }
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
                    function deletePayment(id)
                    {
                        if(confirm("This action can't be reverted. Deleting a payment would warrant a student to pay again. Are you sure you want to delete payment?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/delete-payment/' + id;
                            return true;
                        }
                    }

                    function confirmPayment(id)
                    {
                        if(confirm("A payment confirmed can't be reverted. Are you sure you want to confirm?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/confirm-payment/' + id;
                            return true;
                        }
                    }

                    function wavePayment(feeId, studentId)
                    {
                        if(confirm("This action can't be reverted. Waving a payment would not require the student to pay. Are you sure you want to wave payment?")){
                            window.location.href='<?=$this->domain()?>' + '/school-manager/wave-payment/' + feeId + '/' + studentId;
                            return true;
                        }
                    }
                </script>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once 'app/views/school/includes/footer.php'; ?>
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