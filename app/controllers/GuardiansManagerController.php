<?php

    class GuardiansManagerController extends Controller
    {
        public function __construct()
        {

        }

        public function authenticate()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'email' => [
                        'required' => true
                    ],
                    'password' => [
                        'required' => true
                    ]
                ));
                if($validation->passed()){
                    $guardian = new Guardian();

                    $remember = (Input::get('remember') === 'on') ? true : false;
                    $login = $guardian->login(Input::get('email'), Input::get('password'), $remember);
                    if($login){ // If authentication is passed

                        $email = Input::get('email');
                        if($guardian->where('email', $email)->first()->blocked()){
                            Session::delete(Config::get('session/guardian'));
                            Session::put('flash', $this->notifications('danger', 'Account Blocked'));
                            Redirect::to('/login/guardian');
                        }
                        Session::put('flash', $this->notifications('success', 'Login SuccessFul'));
                        Redirect::to('/guardian/dashboard');
                    }else{ // If authentication was not passed
                        Session::put('flash', $this->notifications('danger', 'Invalid Credentials'));
                        Redirect::back();
                    }
                }else{
                    Redirect::back();
                }
            }
            Redirect::back();
        }

        public function update_profile_pix()
        {
            $directory 	= 'uploads/images/profile_pictures';
            $handle  = new Upload($_FILES['profile_pix']);
            if($handle->uploaded){
                $handle->process($directory);

                if($handle->processed){
                    $handle->clean();
                    $file_name  = $directory.'/'.$handle->file_dst_name;
                    $this->guardian()->update(['profile_pix' => $file_name]);
                    //echo 'good'; die();
                    Session::put('flash', $this->notifications('success', 'Profile picture updated'));
                }else{
                    //echo 'failed'; die();
                }
            }
            Redirect::back();
        }

        public function update_profile()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'firstname' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 50
                    ],
                    'lastname' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 50
                    ],
                    'sex' => [
                        'required' => true,
                        'min' => 4,
                        'max' => 6
                    ],
                    'phone' => [
                        'required' => true,
                        'min' => 10,
                        'max' => 10,
                        'numeric' => true
                    ],
                    'address' => [
                        'required' => true,
                        'min' => 5,
                        'max' => 200
                    ]
                ));
                if($validation->passed()){
                    if($this->guardian()->update(
                        [
                            'firstname' => Input::get('firstname'),
                            'lastname' => Input::get('lastname'),
                            'sex' => Input::get('sex'),
                            'phone' => Input::get('phone'),
                            'address' => Input::get('address')
                        ]
                        ))
                    {
                        Session::put('flash', $this->notifications('success', 'Update successfull'));
                        Redirect::back();
                    }else{
                        Session::put('flash', $this->notifications('danger', 'Update failed'));
                        Redirect::back();
                    }
                }
                Redirect::back();
            }
        }

        public function change_password()
        {
            //print_r($_POST);
            if(Input::exists()){
                
                $pass_hashed = Hash::make(Input::get('new_password'));
                //echo $pass_hashed;
                if(password_verify(Input::get('old_password'), $this->guardian()->password)){
                    //echo 'verified';
                    //echo 'good'; die();
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'new_password' => [
                            'required' => true,
                            'min' => 6,
                            'max' => 30
                        ],
                        'new_password_again' => [
                            'required' => true,
                            'matches' => 'new_password'
                        ]
                    ]);
                    if($validation->passed()){
                        $this->guardian()->update([
                            'password' => $pass_hashed
                        ]);
                        Session::put('flash', $this->notifications('success', 'Password changed'));
                    }
                }else{
                    //echo 'failed'; die();
                    $validate = new Validate();
                    $validate->addError("old_password", "Password is invalid.");
                }
                Redirect::back();
            }
            
        }

        public function upload_payment_proof($user_id='', $fee_id='', $bonus_money = '')
        {
            //print_r(FeeUser::where('fee_id', $fee_id)->where('user_id', $user_id)->count()); die();
            if($user_id != '' && $fee_id != ''){
                $fee_exist = $this->guardian()->school->fees->find($fee_id);
                $user_exist = $this->guardian()->users->find($user_id);
                if(!$fee_exist || !$user_exist){
                    Redirect::to('/guardian/fee');
                }
            }else{
                Redirect::to('/guardian/fee');
            }
            if(FeeUser::where('fee_id', $fee_id)->where('user_id', $user_id)->count() == 0){
                FeeUser::create(
                    [
                        'fee_id' => $fee_id,
                        'user_id' => $user_id,
                        'school_id' => $this->guardian()->school->id,
                        'guardian_id' => $this->guardian()->id,
                        'bonus' => $bonus_money
    
                    ]
                );
            }
            

            $directory 	= 'uploads/images/payment_proofs';
            $handle  = new Upload($_FILES['payment_proof']);
            if($handle->uploaded){
                $handle->process($directory);

                if($handle->processed){
                    $handle->clean();
                    $file_name  = $directory.'/'.$handle->file_dst_name;
                    FeeUser::where('fee_id', $fee_id)->where('user_id', $user_id)->update(['payment_proof' => $file_name]);
                    //echo 'good'; die();
                    Session::put('flash', $this->notifications('success', 'Proof Uploaded'));
                    Redirect::back();
                }   
            }
        }

        public function print_payment_receipt($id = '')
        {
            //echo date("d-m-Y"); die();
            $school_name = $this->guardian()->school->name;
            $school_address = $this->guardian()->school->address;
            $school_email = $this->guardian()->school->email;
            $school_phone = $this->guardian()->school->phone;
            $school_logo = $this->domain(). '/' . $this->guardian()->school->logo;
            $guardian = FeeUser::find($id)->guardian->lastname . ' ' . FeeUser::find($id)->guardian->firstname;
            $student = FeeUser::find($id)->user->lastname . ' ' . FeeUser::find($id)->user->firstname . ' ' . FeeUser::find($id)->user->middlename;
            $bonus =  FeeUser::find($id)->bonus;
            $fee_amount = FeeUser::find($id)->fee->prepared_fees->sum('amount');
            $actual_fee_paid = $fee_amount - $bonus;
            $fee_title =  FeeUser::find($id)->fee->title;
            $session =  FeeUser::find($id)->fee->session;
            $term =  FeeUser::find($id)->fee->term->term;
            $classe =  FeeUser::find($id)->fee->classe->class . FeeUser::find($id)->fee->arm->name;
            $date = date("d-m-Y");
            $receipt_no = '0' . $id;
            //echo $school_logo; die();
            $pdf = new FPDF('p', 'mm', [300, 800]);

            $pdf->AddPage();
            $pdf->SetMargins(2, 2, 2);

            $pdf->Image($school_logo,10,10,40,80);
            
            $pdf->setFont('Times', 'B', 70);
            $pdf->Cell(50, 10, '', 0, 0);
            $pdf->Cell(130, 25, $school_name, 0, 1);

            $pdf->setFont('Times', 'B', 50);
            $pdf->Cell(40, 5, '', 0, 0);
            $pdf->Cell(200, 20, $school_address, 0, 1, 'C');
            $pdf->Cell(40, 5, '', 0, 0);
            $pdf->Cell(200, 20, $school_email, 0, 1, 'C');
            $pdf->Cell(40, 5, '', 0, 0);
            $pdf->Cell(200, 20, '0' . $school_phone, 0, 1, 'C');

            $pdf->setFont('Times', 'B', 50);
            $pdf->Cell(100, 50, 'GUARDIAN\'S COPY', 0, 1);
            $pdf->Cell(100, 10, 'PAYMENT RECEIPT', 0, 1);
            $pdf->Cell(59, 120, 'Date:   ' . $date, 0, 1);
            $pdf->Cell(80, -70, 'Trans ID:   ' . $receipt_no, 0, 1);
            $pdf->Cell(100, 120, 'Fee:   ' . $fee_title, 0, 1);
            $pdf->Cell(100, -70, 'Session:   ' . $session, 0, 1);
            $pdf->Cell(100, 120, 'Term:   ' . $term, 0, 1);
            $pdf->Cell(100, -70, 'Guardian:   ' . $guardian, 0, 1);
            $pdf->Cell(100, 120, 'Student:   ' . $student, 0, 1);
            $pdf->Cell(100, -70, 'Class:   ' . $classe, 0, 1);
            $pdf->Cell(100, 120, 'Amount: ' . School::currency_formatter($fee_amount), 0, 1);
            $pdf->Cell(100, -70, 'Bonus: ' . School::currency_formatter($bonus), 0, 1);
            $pdf->Cell(100, 120, 'Paid:   ' . School::currency_formatter($actual_fee_paid), 0, 1);

            $pdf->SetFont('Times', 'B', 40);
            $pdf->Cell(100, 60, 'GUARDIAN\'S SIGNATURE', 0, 1);
            $pdf->Cell(100, 80, '................................................', 0, 1);


            $pdf->Output();
        }
    }