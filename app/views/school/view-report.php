<?php $page_title = 'Report'; ?>

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
                        <h3 class="text-themecolor">Report</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Reports</li>
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
                                <h4 class="card-title"><?=($data['type'] == 'incoming') ? 'Incomes' : 'Expenses' ?> Report</h4>
                                <div class="row">
                                    <a href="<?=$this->domain()?>/school/view-report/<?=$data['type']?>/daily" style="color: white;" class="btn btn-primary">Daily</a>
                                    <a href="<?=$this->domain()?>/school/view-report/<?=$data['type']?>/monthly" style="color: white;" class="btn btn-primary">Monthly</a>
                                    <a href="<?=$this->domain()?>/school/view-report/<?=$data['type']?>/yearly" style="color: white;" class="btn btn-primary">Yearly</a>
                                    
                                    From: <div class="col-lg-2">
                                        <input class="form-control" id="startExpenseDate" type="date">
                                    </div>
                                    To: <div class="col-lg-2">
                                        <input class="form-control" id="endExpenseDate" onchange="customSearch(document.getElementById('startExpenseDate').value, this.value)" type="date">
                                    </div>
                                </div><br><br>
                                <h5><?=strtoupper($data['dur'])?> <?=(isset($data['finish'])) ? $data['finish'] : '' ?> REPORT</h5>
                                <div id="tableExpense" class="table-responsive m-t-40">
                                    <table style="font-size: 14px;" id="myTable" class="tableExpense table table-bordered table-striped">
                                        <thead> 
                                            <tr>
                                            <?php
                                            if($data['type'] == 'incoming'){
                                                echo '<th>SN</th>
                                                <th>Student</th>
                                                <th>Guardian</th>
                                                <th>Title</th>
                                                <th>Amount</th>
                                                <th>Date</th>';
                                            }else if($data['type'] == 'outgoing'){
                                                echo '<th>SN</th>
                                                <th>Title</th>
                                                <th>Amount</th>
                                                <th>Reciever Name</th>
                                                <th>Receiver No</th>
                                                <th>Payment Method</th>
                                                <th>Date</th>';
                                            }
                                            ?>
                                            </tr>
                                        </thead>
                                        <?php
                                            $incomes = $this->school()->fee_users;
                                            $expenses = $this->school()->expenses;
                                            $sn = 1;
                                            if($data['type'] == 'incoming'){
                                                if($data['dur'] == 'daily'){
                                                    foreach($incomes as $income){
                                                        if(date("Y-m-d", strtotime($income->created_at)) == date("Y-m-d")){
                                                            echo '<tr>';
                                                                echo '<td>' . $sn . '</td>';
                                                                echo '<td><img style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $income->user->profile_pix . '">' . $income->user->lastname . ' ' . $income->user->firstname . '</td>';
                                                                echo '<td><img style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $income->guardian->profile_pix . '">' . $income->guardian->lastname . ' ' . $income->guardian->firstname . '</td>';
                                                                echo '<td>' . $income->fee->title . '</td>';
                                                                echo '<td>' . $income->fee->prepared_fees->sum('amount') . '</td>';
                                                                echo '<td><span class="label label-primary">' . $income->created_at->toFormattedDateString() . '</span></td>';
                                                            echo '</tr>';
                                                            $sn++;
                                                        }
                                                    }
                                                }else if($data['dur'] == 'monthly'){
                                                    foreach($incomes as $income){
                                                        if(date("Y-m", strtotime($income->created_at)) == date("Y-m")){
                                                            echo '<tr>';
                                                                echo '<td>' . $sn . '</td>';
                                                                echo '<td><img style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $income->user->profile_pix . '">' . $income->user->lastname . ' ' . $income->user->firstname . '</td>';
                                                                echo '<td><img style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $income->guardian->profile_pix . '">' . $income->guardian->lastname . ' ' . $income->guardian->firstname . '</td>';
                                                                echo '<td>' . $income->fee->title . '</td>';
                                                                echo '<td>' . $income->fee->prepared_fees->sum('amount') . '</td>';
                                                                echo '<td><span class="label label-primary">' . $income->created_at->toFormattedDateString() . '</span></td>';
                                                            echo '</tr>';
                                                            $sn++;
                                                        }
                                                    }
                                                }else if($data['dur'] == 'yearly'){
                                                    foreach($incomes as $income){
                                                        if(date("Y", strtotime($income->created_at)) == date("Y")){
                                                            echo '<tr>';
                                                                echo '<td>' . $sn . '</td>';
                                                                echo '<td><img style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $income->user->profile_pix . '">' . $income->user->lastname . ' ' . $income->user->firstname . '</td>';
                                                                echo '<td><img style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $income->guardian->profile_pix . '">' . $income->guardian->lastname . ' ' . $income->guardian->firstname . '</td>';
                                                                echo '<td>' . $income->fee->title . '</td>';
                                                                echo '<td>' . $income->fee->prepared_fees->sum('amount') . '</td>';
                                                                echo '<td><span class="label label-primary">' . $income->created_at->toFormattedDateString() . '</span></td>';
                                                            echo '</tr>';
                                                            $sn++;
                                                        }
                                                    }
                                                }else{
                                                    $startTime = strtotime($data['dur']);
                                                    $endTime = strtotime($data['finish']);
                                                    foreach($incomes as $income){
                                                        $incomeDate = date("Y-m-d", strtotime($income->created_at));
                                                        $incomeTime = strtotime($incomeDate);
                                                        //print_r($incomeTime); die();
                                                        if($incomeTime >= $startTime && $incomeTime <= $endTime){
                                                            echo '<tr>';
                                                                echo '<td>' . $sn . '</td>';
                                                                echo '<td><img style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $income->user->profile_pix . '">' . $income->user->lastname . ' ' . $income->user->firstname . '</td>';
                                                                echo '<td><img style="width: 30px; height: 30px; border-radius: 50%;" src="' . $this->domain() . '/' . $income->guardian->profile_pix . '">' . $income->guardian->lastname . ' ' . $income->guardian->firstname . '</td>';
                                                                echo '<td>' . $income->fee->title . '</td>';
                                                                echo '<td>' . $income->fee->prepared_fees->sum('amount') . '</td>';
                                                                echo '<td><span class="label label-primary">' . $income->created_at->toFormattedDateString() . '</span></td>';
                                                            echo '</tr>';
                                                            $sn++;
                                                        }
                                                    }
                                                }
                                            }else if($data['type'] == 'outgoing'){
                                                if($data['dur'] == 'daily'){
                                                    foreach($expenses as $expense){
                                                        if(date("Y-m-d", strtotime($expense->created_at)) == date("Y-m-d")){
                                                            echo '<tr>';
                                                                echo '<td>' . $sn . '</td>';
                                                                echo '<td>' . $expense->title . '</td>';
                                                                echo '<td>' . $expense->amount . '</td>';
                                                                echo '<td>' . $expense->receiver . '</td>';
                                                                echo '<td>' . $expense->phone . '</td>';
                                                                echo '<td>' . $expense->payment_method . '</td>';
                                                                echo '<td><span class="label label-primary">' . $expense->created_at->toFormattedDateString() . '</span></td>';
                                                            echo '</tr>';
                                                            $sn++;
                                                        }
                                                    }
                                                }else if($data['dur'] == 'monthly'){
                                                    foreach($expenses as $expense){
                                                        if(date("Y-m", strtotime($expense->created_at)) == date("Y-m")){
                                                            echo '<tr>';
                                                                echo '<td>' . $sn . '</td>';
                                                                echo '<td>' . $expense->title . '</td>';
                                                                echo '<td>' . $expense->amount . '</td>';
                                                                echo '<td>' . $expense->receiver . '</td>';
                                                                echo '<td>' . $expense->phone . '</td>';
                                                                echo '<td>' . $expense->payment_method . '</td>';
                                                                echo '<td><span class="label label-primary">' . $expense->created_at->toFormattedDateString() . '</span></td>';
                                                            echo '</tr>';
                                                            $sn++;
                                                        }
                                                    }
                                                }else if($data['dur'] == 'yearly'){
                                                    foreach($expenses as $expense){
                                                        if(date("Y", strtotime($expense->created_at)) == date("Y")){
                                                            echo '<tr>';
                                                                echo '<td>' . $sn . '</td>';
                                                                echo '<td>' . $expense->title . '</td>';
                                                                echo '<td>' . $expense->amount . '</td>';
                                                                echo '<td>' . $expense->receiver . '</td>';
                                                                echo '<td>' . $expense->phone . '</td>';
                                                                echo '<td>' . $expense->payment_method . '</td>';
                                                                echo '<td><span class="label label-primary">' . $expense->created_at->toFormattedDateString() . '</span></td>';
                                                            echo '</tr>';
                                                            $sn++;
                                                        }
                                                    }
                                                }else{
                                                    $startTime = strtotime($data['dur']);
                                                    $endTime = strtotime($data['finish']);
                                                    foreach($expenses as $expense){
                                                        $expenseDate = date("Y-m-d", strtotime($expense->created_at));
                                                        $expenseTime = strtotime($expenseDate);
                                                        //print_r($incomeTime); die();
                                                        if($expenseTime >= $startTime && $expenseTime <= $endTime){
                                                            echo '<tr>';
                                                                echo '<td>' . $sn . '</td>';
                                                                echo '<td>' . $expense->title . '</td>';
                                                                echo '<td>' . $expense->amount . '</td>';
                                                                echo '<td>' . $expense->receiver . '</td>';
                                                                echo '<td>' . $expense->phone . '</td>';
                                                                echo '<td>' . $expense->payment_method . '</td>';
                                                                echo '<td><span class="label label-primary">' . $expense->created_at->toFormattedDateString() . '</span></td>';
                                                            echo '</tr>';
                                                            $sn++;
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script language="javascript">
                    function customSearch(start, finish)
                    {
                        if(confirm("View report from " + start + " to " + finish)){
                            window.location.href='<?=$this->domain()?>' + '/school/view-report/<?=$data["type"]?>/' + start + '/' + finish;
                            return true;
                        }
                    }
                </script>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
    <?php require_once '../app/views/school/includes/footer.php'; ?>
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
            //$('#ugoTable').DataTable(
        </script>