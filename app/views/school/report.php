<?php $page_title = 'Report'; ?>

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
                <script>
                    function showIncomeReport(str) {
                        if (str == "") {
                            document.getElementById("txtHint").innerHTML = "";
                            return;
                        } else { 
                            if (window.XMLHttpRequest) {
                                // code for IE7+, Firefox, Chrome, Opera, Safari
                                xmlhttp = new XMLHttpRequest();
                            } else {
                                // code for IE6, IE5
                                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                    document.getElementById("tableIncome").innerHTML = xmlhttp.responseText;
                                }
                            };
                            xmlhttp.open("GET","<?=$this->domain()?>/school-manager/view-income-report/"+str, true);
                            xmlhttp.send();
                        }
                    }

                    function showExpenseReport(str) {
                        if (str == "") {
                            
                        } else { 
                            if (window.XMLHttpRequest) {
                                // code for IE7+, Firefox, Chrome, Opera, Safari
                                xmlhttp = new XMLHttpRequest();
                            } else {
                                // code for IE6, IE5
                                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                            }
                            xmlhttp.onreadystatechange = function() {
                                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                    document.getElementById("myTable").innerHTML = xmlhttp.responseText;
                                }
                            };
                            xmlhttp.open("GET","<?=$this->domain()?>/school-manager/view-expense-report/"+str, true);
                            xmlhttp.send();
                        }
                    }
                </script>
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
                                <h4 class="card-title">View Income Report</h4>
                                <button onclick="showIncomeReport('daily')" style="color: white;" class="btn btn-primary">Daily</button>
                                <button onclick="showIncomeReport('monthly')" style="color: white;" class="btn btn-primary">Monthly</button>
                                <button onclick="showIncomeReport('yearly')" style="color: white;" class="btn btn-primary">Yearly</button>
                                <div class="row">
                                    Custom Search:
                                    <div class="col-lg-2">
                                        <input class="form-control" id="startIncomeDate" onchange="showIncomeReport(this.value + '.' + document.getElementById('endIncomeDate').value)" type="date">
                                    </div>
                                    <div class="col-lg-2">
                                        <input class="form-control" id="endIncomeDate" value="<?=date("Y-m-d")?>" onchange="showIncomeReport(document.getElementById('startIncomeDate').value + '.' + this.value)" type="date">
                                    </div>
                                </div>
                                <div id="tableIncome" class="table-responsive m-t-40">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Expenses</h4>
                                <button onclick="showExpenseReport('daily')" style="color: white;" class="btn btn-primary">Daily</button>
                                <button onclick="showExpenseReport('monthly')" style="color: white;" class="btn btn-primary">Monthly</button>
                                <button onclick="showExpenseReport('yearly')" style="color: white;" class="btn btn-primary">Yearly</button>
                                <div class="row">
                                    Custom Search:
                                    <div class="col-lg-2">
                                        <input class="form-control" id="startExpenseDate" onchange="showExpenseReport(this.value + '.' + document.getElementById('endExpenseDate').value)" type="date">
                                    </div>
                                    <div class="col-lg-2">
                                        <input class="form-control" id="endExpenseDate" value="<?=date("Y-m-d")?>" onchange="showExpenseReport(document.getElementById('startExpenseDate').value + '.' + this.value)" type="date">
                                    </div>
                                </div>
                                <div id="tableExpense" class="table-responsive m-t-40">
                                    <table style="font-size: 14px;" id="myTable" class="tableExpense table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Age</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
            //$('#ugoTable').DataTable(
        </script>