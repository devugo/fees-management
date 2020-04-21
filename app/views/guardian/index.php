<?php $page_title = 'Dashboard'; ?>

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
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                
                
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <h4 class="card-title">Outstanding Fees</h4>
                                </div>
                                <div class="table-responsive m-t-20">
                                    <table class="table stylish-table">
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
                    </div>
                    <div class="col-lg-4">
                        <!-- Column -->
                        <div class="card"> <img class="" src="<?=$assets?>/images/background/profile-bg.jpg" alt="Card image cap">
                            <div class="card-body little-profile text-center">
                                <div class="pro-img"><img src="<?=$this->domain()?>/<?=$this->guardian()->profile_pix?>" alt="user"></div>
                                <h3 class="m-b-0"><?=$this->guardian()->lastname?> <?=$this->guardian()->firstname?></h3>
                                <h6><i class="fa fa-circle" style="color: green;"></i> Active</h6><hr>
                                <h4>Address: <?=$this->guardian()->address?></h4><hr>
                                <h4 data-toggle="tooltip" data-placement="top" title="" data-original-title="Total number of Wards">Wards: <?=$this->guardian()->users->count()?></h4>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
           
    <?php require_once '../app/views/guardian/includes/footer.php'; ?>