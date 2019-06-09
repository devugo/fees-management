<?php

    class SchoolsManagerController extends Controller
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
                    $school = new School();

                    $remember = (Input::get('remember') === 'on') ? true : false;
                    $login = $school->login(Input::get('email'), Input::get('password'), $remember);
                    if($login){ // If authentication is 
                        $email = Input::get('email');
                        if($school->where('email', $email)->first()->blocked()){
                            Session::delete(Config::get('session/school'));
                            Session::put('flash', $this->notifications('danger', 'Account Blocked'));
                            Redirect::to('/login');
                        }
                        Session::put('flash', $this->notifications('success', 'Login SuccessFul'));
                        Redirect::to('/school/dashboard');
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

        public function forgot_password()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'email' => [
                        'required' => true,
                        'exist' => 'School.email'
                    ]
                ));
                if($validation->passed()){
                    $token = str_replace('/', '.', Hash::unique());
                    ResetPassword::updateOrCreate(
                        ['email' => Input::get('email')],
                        ['token' => $token]
                    );
                    $to = Input::get('email');
                    $subject = 'Password Reset';
                    $txt = 'Kindly visit the url or copy to your your browser to reset your password. url: http://fees.me/forgot-password/reset/' . $token;
                    $headers = "From: ofemco@gmail.com";
    
                    mail($to,$subject,$txt,$headers);
                    Session::put('flash', $this->notifications('success', 'Kindly check your email and follow the instruction'));
                }else{
                    Session::put('flash', $this->notifications('danger', 'Email does not exist'));
                }
            }
            Redirect::back();
        }

        public function reset_school_password($token = '')
        {
            //echo $token; die();
            $email = ResetPassword::where('token', $token)->first()->email;
            //echo $email; die();
            if($token = '' || !$email){
                Session::put('flash', $this->notifications('danger', 'Invalid token'));
                Redirect::to('/login');
            }
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'new_password' => [
                        'required' => true
                    ],
                    'new_password_again' => [
                        'required' => true,
                        'matches' => 'new_password'
                    ]
                ));
                if($validation->passed()){
                    $email = ResetPassword::where('token', $token)->first()->email;
                    School::where('email', $email)->first()->update([
                        'password' => Hash::make(Input::get('new_password'))
                    ]);
                }
            }
            Session::put('flash', $this->notifications('success', 'Password changed successfully'));
            Redirect::to('/login');
        }

        public function reset_guardian_password($id = '')
        {
            if($id != ''){
                $guardian_exist = $this->school()->guardians->find($id);
                if(!$guardian_exist){
                    Redirect::to('/school/guardian');
                }
            }else{
                Redirect::to('/school/guardian');
            }

            Guardian::find($id)->update([
                'password' => Hash::make('111111')
            ]);
            Session::put('flash', $this->notifications('success', 'Reset Successful'));
            Redirect::back();
        }

        public function create_guardian()
        {
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, Guardian::$guardian_rules);
                    if($validation->passed()){
                        Guardian::create(
                            [
                                'firstname' => Input::get('firstname'),
                                'lastname' => Input::get('lastname'),
                                'email' => Input::get('email'),
                                'phone' => Input::get('phone'),
                                'sex' => Input::get('sex'),
                                'password' => Hash::make(Config::get('default/password')),
                                'school_id' => $this->school_id(),
                                'profile_pix' => $this->profile()
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Guardian Added'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function update_guardian($id = '')
        {
            if($id != ''){
                $guardian_exist = $this->school()->guardians->find($id);
                if(!$guardian_exist){
                    Redirect::to('/school/guardian');
                }
            }else{
                Redirect::to('/school/guardian');
            }
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'firstname' => [
                            'required' => true,
                            'min' => 2,
                            'max' => 30
                        ],
                        'lastname' => [
                            'required' => true,
                            'min' => 2,
                            'max' => 30
                        ],
                        'email' => [
                            'required' => true,
                            'min' => 6,
                            'max' => 50,
                            'uniquEdit' => 'Guardian' . '.' . $id
                        ],
                        'phone' => [
                            'required' => true,
                            'numeric' => true,
                            'min' => 10,
                            'max' =>10
                        ],
                        'sex' => [
                            'required' => true,
                            'min' => 1,
                            'max' => 6
                        ],
                        'address' => [
                            'required' => true,
                            'min' => 5,
                            'max' => 100
                        ]
                    ]);
                    if($validation->passed()){
                        if($this->school()->guardians->find($id)->update(
                            [
                                'firstname' => Input::get('firstname'),
                                'lastname' => Input::get('lastname'),
                                'email' => Input::get('email'),
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
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_guardian($id = '')
        {
            if($id != ''){
                $guardian_exist = $this->school()->guardians->find($id);
                if(!$guardian_exist){
                    Redirect::to('/school/guardian');
                }
            }else{
                Redirect::to('/school/guardian');
            }

            //echo date('Y:m:d H:i:s'); die();
            Guardian::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            //(Guardian::destroy($id)) ? Session::put('flash', $this->notifications('success', 'Deleted successfull')) : Session::put('flash', $this->notifications('danger', 'delete failed'));
            Redirect::back();
        }

        public function block_guardian($id)
        {
            $guardian_exist = $this->school()->guardians->find($id);
            if(!$guardian_exist){
                Redirect::to('/school/guardian');
            }

            $guardian = $this->school()->guardians->find($id);
            if($guardian->blocked_on === NULL){
                $guardian->update([
                    'blocked_on' => date('Y-m-d H:i:s')
                ]);
                Session::put('flash', $this->notifications('success', 'Guardian Blocked'));
            }else{
                $guardian->update([
                    'blocked_on' => NULL
                ]);
                Session::put('flash', $this->notifications('success', 'Guardian Activated'));
            }
            //Guardian::find($id)->update(['blocked_on' => date('Y-m-d H:i:s')]);
            
            Redirect::back();
        }

        public function create_student()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, School::$student_rules);
                if($validation->passed()){
                    //echo 'good'; die();
                    
                    User::create(
                        [
                            'firstname' => Input::get('firstname'),
                            'lastname' => Input::get('lastname'),
                            'middlename' => Input::get('middlename'),
                            'sex' => Input::get('sex'),
                            'age' => Input::get('age'),
                            'year_of_graduation' => Input::get('year_of_graduation'),
                            'reg_no' => Input::get('reg_no'),
                            'guardian_id' => Input::get('guardian'),//Guardian::where('firstname', explode(' ', Input::get('guardian'))[0])->first()->id,
                            'school_id' => $this->school_id(),
                            'arm_id' => Input::get('arm'),
                            'profile_pix' => $this->profile()

                        ]
                    );

                    $directory 	= 'uploads/images/profile_pictures';
                    $handle  = new Upload($_FILES['profile_pix']);
                    if($handle->uploaded){
                        $handle->process($directory);

                        if($handle->processed){
                            $handle->clean();
                            $file_name  = $directory.'/'.$handle->file_dst_name;
                            User::where('reg_no', Input::get('reg_no'))->first()->update(['profile_pix' => $file_name]);
                        }
                    }
                    
                    Session::put('flash', $this->notifications('success', 'Student added'));
                    Redirect::back();
                }else{
                    Redirect::back();
                }
            }
        }

        public function block_student($id = '')
        {
            if($id != ''){
                $student_exist = $this->school()->users->find($id);
                if(!$student_exist){
                    Redirect::to('/school/student');
                }
            }else {
                Redirect::to('/school/student');
            }

            $student = $this->school()->users->find($id);
            if($student->blocked_on === NULL){
                $student->update([
                    'blocked_on' => date('Y-m-d H:i:s')
                ]);
                Session::put('flash', $this->notifications('success', 'Student Blocked'));
            }else{
                $student->update([
                    'blocked_on' => NULL
                ]);
                Session::put('flash', $this->notifications('success', 'Student Activated'));
            }
            Redirect::back();
        }

        public function delete_student($id = '')
        {
            if($id != ''){
                $student_exist = $this->school()->users->find($id);
                if(!$student_exist){
                    Redirect::to('/school/student');
                }
            }else{
                Redirect::to('/school/student');
            }
            //echo date('Y:m:d H:i:s'); die();
            User::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            Redirect::back();
        }

        public function update_student($id = '')
        {
            if($id != ''){
                $student_exist = $this->school()->users->find($id);
                if(!$student_exist){
                    Redirect::to('/school/student');
                }
            }else{
                Redirect::to('/school/student');
            }

            if(Input::exists()){
                //echo "<pre>";
                //print_r($_POST); die();
                $validate = new Validate();
                $validation = $validate->check($_POST, [
                    'firstname' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 100
                    ],
                    'lastname' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 100
                    ],
                    'middlename' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 100
                    ],
                    'year_of_graduation' => [
                        'reauired' => true,
                        'numeric' => true,
                        'min' => 4,
                        'max' => 4
                    ],
                    'reg_no' => [
                        'required' => true,
                        'min' => 5,
                        'max' => 50,
                        'uniquEdit' => 'User' . '.' . $id
                    ],
                    'guardian' => [
                        'required' => true,
                        'min' => 1,
                        'max' => 50
                    ],
                    'age' => [
                        'required' => true
                    ],
                    'sex' => [
                        'required' => true,
                        'min' => 1,
                        'max' => 6
                    ],
                    'arm' => [
                        'required' => true,
                        'min' => 1,
                        'max' => 50
                    ]
                ]);
                if($validation->passed()){
                    
                    User::find($id)->update(
                        [
                            'firstname' => Input::get('firstname'),
                            'lastname' => Input::get('lastname'),
                            'middlename' => Input::get('middlename'),
                            'sex' => Input::get('sex'),
                            'age' => Input::get('age'),
                            'year_of_graduation' => Input::get('year_of_graduation'),
                            'reg_no' => Input::get('reg_no'),
                            'guardian_id' => Guardian::where('firstname', explode(' ', Input::get('guardian'))[0])->first()->id

                        ]);
                    Session::put('flash', $this->notifications('success', 'Update successfull'));
                    Redirect::back();
                
                }else{
                    Redirect::back();
                }
            }
        }
        
        public function update_student_profile_pix($id)
        {
            if($id != ''){
                $student_exist = $this->school()->users->find($id);
                if(!$student_exist){
                    Redirect::to('/school/student');
                }
            }else{
                Redirect::to('/school/student');
            }

            $directory 	= 'uploads/images/profile_pictures';
                $handle  = new Upload($_FILES['profile_pix']);
                if($handle->uploaded){
                    $handle->process($directory);

                    if($handle->processed){
                        $handle->clean();
                        $file_name  = $directory.'/'.$handle->file_dst_name;
                        User::find($id)->update(['profile_pix' => $file_name]);
                    }
                }
                
                Session::put('flash', $this->notifications('success', 'Profile Picture Updated'));
                Redirect::back();
        }

        public function create_class()
        {
            
            if(Token::check(Input::get('token'))){
                $validate = new Validate();
                $validation = $validate->check($_POST,  [
                    'class' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 15,
                        'unique' => $this->school()->classes
                    ],
                    'level' => [
                        'required' => true,
                        'numeric' => true,
                        'min' => 1,
                        'max' => 2,
                        'unique' => $this->school()->classes
                    ]
                ]);
                if($validation->passed()){
                    Classe::create(
                        [
                            'class' => strtoupper(Input::get('class')),
                            'level' => Input::get('level'),
                            'school_id' => $this->school_id()
                        ]
                    );
                    Session::put('flash', $this->notifications('success', 'Class Added'));
                    Redirect::back();
                }else{
                    Redirect::back();
                }
            }
        }

        public function update_class($id = '')
        {
            if($id != ''){
                $class_exist = $this->school()->classes->find($id);
                if(!$class_exist){
                    Redirect::to('/school/class');
                }
            }else{
                Redirect::to('/school/class');
            }

            if(Input::exists()){
                if($this->school()->classes->where('level', Input::get('level'))->count() > 0){
                    $idLevelVal = $id;
                    //echo $idVal; die();
                }else{
                    $idLevelVal = '';
                }
                if($this->school()->classes->where('class', Input::get('class'))->count() > 0){
                    $idClassVal = $id;
                    //echo $idClassVal; die();
                }else{
                    $idClassVal = '';
                }
                //print_r($this->school()->classess->where('level', 6)->first()->class); die();
                if(Token::check(Input::get('token'))){
                    $validate = new Validate($idLevelVal, $idClassVal);
                    $validation = $validate->check($_POST,  [
                        'class' => [
                            'required' => true,
                            'min' => 2,
                            'max' => 15,
                            'unique_class' => $this->school()->classes
                        ],
                        'level' => [
                            'required' => true,
                            'numeric' => true,
                            'min' => 1,
                            'max' => 2,
                            'unique_level' => $this->school()->classes
                        ]
                    ]);
                    if($validation->passed()){
                        $this->school()->classes->find($id)->update(
                            [
                                'class' => Input::get('class'),
                                'level' => Input::get('level')
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Update Successful'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }
        
        public function delete_class($id = '')
        {
            //echo 'good'; die();
            if($id != ''){
                $class_exist = $this->school()->classes->find($id);
                if(!$class_exist){
                    Redirect::to('/school/class');
                }
            }else{
                Redirect::to('/school/class');
            }

            //echo date('Y:m:d H:i:s'); die();
            //Classes::destroy($id);
            //print_r($this->school()->classes->find($id)); die();
            $this->school()->classes->find($id)->delete();
            //$this->school()->classes->find($id)->delete();
            //print_r($this->school()->classes->find($id)); die();
           // print_r($this->school()->classes->find($id)->fees); die();
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            //(Guardian::destroy($id)) ? Session::put('flash', $this->notifications('success', 'Deleted successfull')) : Session::put('flash', $this->notifications('danger', 'delete failed'));
            Redirect::back();   
        }

        public function create_fee()
        {
            //print_r($this->school()->classess->where('class', 'JSS 1')->first()->id); die();
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, School::$fee_rules);
                    if($validation->passed()){
                        Fee::create(
                            [
                                'session' => School::get_session(),
                                'classe_id' => Input::get('class'),
                                'term_id' => Input::get('term'),
                                'arm_id' => Input::get('arm'),
                                'title' => Input::get('title'),
                                'school_id' => $this->school_id()
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Fee Added'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function update_fee($id = '')
        {
            if($id != ''){
                $fee_exist = $this->school()->fees->find($id);
                if(!$fee_exist){
                    Redirect::to('/school/fee');
                }
            }else{
                Redirect::to('/school/fee');
            }
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, School::$fee_rules);
                    if($validation->passed()){
                        $this->school()->fees->find($id)->update(
                            [
                                'session' => School::get_session(),
                                'classe_id' => Input::get('class'),
                                'term_id' => Input::get('term'),
                                'arm_id' => Input::get('arm'),
                                'title' => Input::get('title'),
                                'school_id' => $this->school_id()
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Fee Updated'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_fee($id = '')
        {
            if($id != ''){
                $fee_exist = $this->school()->fees->find($id);
                if(!$fee_exist){
                    Redirect::to('/school/fee');
                }
            }else{
                Redirect::to('/school/fee');
            }
            Fee::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            //(Guardian::destroy($id)) ? Session::put('flash', $this->notifications('success', 'Deleted successfull')) : Session::put('flash', $this->notifications('danger', 'delete failed'));
            Redirect::back();
        }

        public function create_prepared_fee($id = '')
        {
            if($id != ''){
                $fee_exist = $this->school()->fees->find($id);
                if(!$fee_exist){
                    Redirect::to('/school/fee');
                }
            }else{
                Redirect::to('/school/fee');
            }

            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'title' =>[
                            'required' => true,
                            'min' => 2,
                            'max' => 50
                        ],
                        'amount' => [
                            'required' => true,
                            'min' => 1,
                            'max' => 50,
                            'numeric' => true
                        ]
                    ]);
                    if($validation->passed()){
                        PreparedFee::create(
                            [
                                'title' => Input::get('title'),
                                'amount' => Input::get('amount'),
                                'fee_id' => $id,
                                'school_id' => $this->school_id()
                            ]
                        );
                        Fee::find($id)->update([
                            'prepared' => date("Y-m-d H:i:s")
                        ]);
                        Session::put('flash', $this->notifications('success', 'Fee Prepared'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_prepared_fee($id = '')
        {
            if($id != ''){
                $prepared_fee_exist = $this->school()->prepared_fees->find($id);
                if(!$prepared_fee_exist){
                    Redirect::to('/school/fee');
                }
            }else{
                Redirect::to('/school/fee');
            }
            PreparedFee::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            //(Guardian::destroy($id)) ? Session::put('flash', $this->notifications('success', 'Deleted successfull')) : Session::put('flash', $this->notifications('danger', 'delete failed'));
            Redirect::back();
        }

        public function delete_payment($id = '')
        {
            if($id != ''){
                $payment_exist = $this->school()->fee_users->find($id);
                if(!$payment_exist){
                    Redirect::to('/school/payment');
                }
            }else{
                Redirect::to('/school/payment');
            }

            FeeUser::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            //(Guardian::destroy($id)) ? Session::put('flash', $this->notifications('success', 'Deleted successfull')) : Session::put('flash', $this->notifications('danger', 'delete failed'));
            Redirect::back();
        }

        public function confirm_payment($id = '')
        {
            //print_r($fee_amount = FeeUser::find($id)->fee->prepared_fees->sum('amount')); die();
            //print_r($this->school()->income->amount); die();
            if($id != ''){
                $payment_exist = $this->school()->fee_users->find($id);
                if(!$payment_exist){
                    Redirect::to('/school/payment');
                }
            }else{
                Redirect::to('/school/payment');
            }
            FeeUser::find($id)->update([
                'confirmed_at' => date("Y-m-d H:i:s")
            ]);
            $school_income = $this->school()->income->amount;
            $fee_bonus = FeeUser::find($id)->first()->bonus;
            $fee_amount = FeeUser::find($id)->fee->prepared_fees->sum('amount');
            $actual_fee_paid = $fee_amount - $fee_bonus;

            $this->school()->income->update([
                'amount' => $school_income + $actual_fee_paid
            ]);
            Session::put('flash', $this->notifications('success', 'Payment Confirmed'));
            Redirect::back();
        }

        public function wave_payment($fee_id = '', $user_id = '')
        {
            if($fee_id != '' || $user_id != ''){
                $fee_exist = $this->school()->fees->find($fee_id);
                $user_exist = $this->school()->users->find($user_id);
                if(!$fee_exist || !$user_exist){
                    Redirect::to('/school/payment');
                }
            }else{
                Redirect::to('/school/payment');
            }

            FeeUser::create([
                'fee_id' => $fee_id,
                'user_id' => $user_id,
                'school_id' => $this->school()->id,
                'guardian_id' => User::find($user_id)->guardian->id,
                'confirmed_at' => date("Y-m-d H:i:s"),
                'waved_at' => date("Y-m-d H:i:s")
            ]);

            Session::put('flash', $this->notifications('success', 'Payment Waved'));
            Redirect::back();
        }

        public function print_payment_receipt($id = '')
        {
            //echo date("d-m-Y"); die();
            $school_name = $this->school()->name;
            $school_address = $this->school()->address;
            $school_email = $this->school()->email;
            $school_phone = $this->school()->phone;
            $school_logo = $this->domain(). '/' . $this->school()->logo;
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
            $pdf->SetFont('Times', 'B', 30);
            $pdf->Cell(300, 80, 'POWERED BY DEVUGO', 0, 1, 'C');


            $pdf->Output();
        }

        public function create_ticket()
        {
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, School::$ticket_rules);
                    if($validation->passed()){
                        $get_sms = $this->school()->subscriptions_balance->sms;
                        $get_email= $this->school()->subscriptions_balance->email;
                        if($get_sms < 1 || $get_email < 1){
                            Session::put('flash', $this->notifications('danger', 'Bundle Exhausted'));
                            Redirect::back();
                        }
                        Ticket::create(
                            [
                                'title' => Input::get('title'),
                                'description' => Input::get('description'),
                                'school_id' => $this->school_id()
                            ]
                        );
                        
                        $school_phone = 234 . $this->school()->phone;
                        $school_email = $this->school()->email;
                        $title = Input::get('title');
                        $description = Input::get('description');

                        $headers = Admin::find(1)->name;
                        $message = 'Your ticket ' . $title . ': ' . $description . ' would be attended to in due time. Thank You! From ' . $headers;
                        

                        $sms = new SMS;
                        $sms->send_sms($school_phone, $message, 'Admin');
                        mail($school_email,$title,$message,$headers);
                        $get_sms = $this->school()->subscriptions_balance->sms;
                        $get_email= $this->school()->subscriptions_balance->email;
                        $this->school()->subscriptions_balance->update([
                            'sms' => $get_sms - 1,
                            'email' => $get_email - 1
                        ]);
                        Session::put('flash', $this->notifications('success', 'Ticket Sent'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function create_broadcast()
        {
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, School::$broadcast_rules);
                    if($validation->passed()){

                        $get_sms = $this->school()->subscriptions_balance->sms;
                        $get_email= $this->school()->subscriptions_balance->email;
                        if($get_sms < 1 || $get_email < 1){
                            Session::put('flash', $this->notifications('danger', 'Bundle Exhausted'));
                            Redirect::back();
                        }

                        if(count(Input::get('guardian')) < 1){
                            $this->addError("guardian", "guardian is required");
                        }else{
                            foreach(Input::get('guardian') as $guardian){
                                //$splitGuardian = explode(' ', $guardian)
                                Broadcast::create(
                                    [
                                        'title' => Input::get('title'),
                                        'guardian_id' => $guardian,
                                        'description' => Input::get('description'),
                                        'school_id' => $this->school_id()
                                    ]
                                );
                                $guardian_phone = 234 . Guardian::find($guardian)->phone;
                                $guardian_email = Guardian::find($guardian)->email;
                                $title = Input::get('title');
                                $description = Input::get('description');

                                $message = $title . ': ' . $description;
                                $headers = $this->school()->name;

                                $sms = new SMS;
                                $sms->send_sms($guardian_phone, $message, 'School');
                                mail($guardian_email,$title,$message,$headers);
                                $get_sms = $this->school()->subscriptions_balance->sms;
                                $get_email= $this->school()->subscriptions_balance->email;
                                $this->school()->subscriptions_balance->update([
                                    'sms' => $get_sms - 1,
                                    'email' => $get_email - 1
                                ]);
                            }
                            Session::put('flash', $this->notifications('success', 'Broadcast Sent'));
                            Redirect::back();
                        }
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_broadcast($id = '')
        {
            if($id != ''){
                $broadcast_exist = $this->school()->broadcasts->find($id);
                if(!$broadcast_exist){
                    Redirect::to('/school/broadcast');
                }
            }else{
                Redirect::to('/school/broadcast');
            }

            Broadcast::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            //(Guardian::destroy($id)) ? Session::put('flash', $this->notifications('success', 'Deleted successfull')) : Session::put('flash', $this->notifications('danger', 'delete failed'));
            Redirect::back();
        }

        public function delete_notification($id = '')
        {
            if($id != ''){
                $notification_exist = $this->school()->notifications->find($id);
                if(!$notification_exist){
                    Redirect::to('/school/notification');
                }
            }else{
                Redirect::to('/school/notification');
            }

            Notification::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            //(Guardian::destroy($id)) ? Session::put('flash', $this->notifications('success', 'Deleted successfull')) : Session::put('flash', $this->notifications('danger', 'delete failed'));
            Redirect::back();
        }

        public function upload_logo()
        {
            $directory 	= 'uploads/images/logos';
            $handle  = new Upload($_FILES['logo']);
            if($handle->uploaded){
                $handle->process($directory);

                if($handle->processed){
                    $handle->clean();
                    $file_name  = $directory.'/'.$handle->file_dst_name;
                    $this->school()->update(['logo' => $file_name]);
                    //echo 'good'; die();
                    Session::put('flash', $this->notifications('success', 'Logo Uploaded'));
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
                $validation = $validate->check($_POST, [
                    'email' => [
                        'required' => true,
                        'min' => 10,
                        'max' => 50,
                        'uniquEdit' => 'School' . '.' . $this->school_id()
                    ],
                    'name'=> [
                        'required' => true,
                        'min' => 3,
                        'max' => 200
                    ],
                    'address' => [
                        'required' => true,
                        'min' => 3,
                        'max' => 100
                    ],
                    'city' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 30
                    ],
                    'state' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 50
                    ],
                    'phone' => [
                        'required' => true,
                        'min' => 10,
                        'max' => 10,
                        'numeric' => true
                    ]
                ]);
                if($validation->passed()){
                    $this->school()->update(
                        [
                            'name' => Input::get('name'),
                            'email' => Input::get('email'),
                            'address' => Input::get('address'),
                            'city' => Input::get('city'),
                            'state' => Input::get('state'),
                            'phone' => Input::get('phone')
                        ]
                    );
                    Session::put('flash', $this->notifications('success', 'Profile updated'));
                    Redirect::back();
                }else{
                    Redirect::back();
                }
                
            }   
        }

        public function change_password()
        {
            if(Input::exists()){
                $pass_hashed = Hash::make(Input::get('new_password'));
                if(password_verify(Input::get('old_password'), $this->school()->password)){
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
                        //echo 'good'; die();
                        $this->school()->update([
                            'password' => $pass_hashed
                        ]);
                        Session::put('flash', $this->notifications('success', 'Password changed'));
                        Redirect::back();
                    }
                }else{
                    $validate = new Validate();
                    $validate->addError("old_password", "Password is invalid.");
                    Redirect::back();
                }
            }
            Redirect::back();
        }

        public function order_subscription($id)
        {
            $subscription_amount = SubscriptionType::find($id)->amount * 100;
            Subscription::create(
                [
                    'subscription_type_id' => $id,
                    'school_id' => $this->school_id(),
                    'paystack_amount' => $subscription_amount
                ]
            );
            Session::put('flash', $this->notifications('success', 'Order Placed'));
            Redirect::back();
        }

        public function upload_payment_proof($id = '')
        {
            if($id != ''){
                $subscription_exist = $this->school()->subscriptions->find($id);
                if(!$subscription_exist){
                    Redirect::to('/school/subscription');
                }
            }else{
                Redirect::to('/school/subscription');
            }
            
            //echo "<pre>";
            //print_r($_FILES); die();
            $directory 	= 'uploads/images/payment_proofs';
            $handle  = new Upload($_FILES['payment_proof']);
            if($handle->uploaded){
                $handle->process($directory);

                if($handle->processed){
                    $handle->clean();
                    $file_name  = $directory.'/'.$handle->file_dst_name;
                    Subscription::find($id)->update(['payment_proof' => $file_name]);
                    //echo 'good'; die();
                    Session::put('flash', $this->notifications('success', 'Proof Uploaded'));
                }else{
                    //echo 'failed'; die();
                }
            }
            Redirect::back();
        }

        public function create_arm()
        {
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'arm' => [
                            'required' => true,
                            'max' => 50
                        ]
                    ]);
                    if($validation->passed()){
                        Arm::create(
                            [
                                'name' => strtoupper(Input::get('arm')),
                                'school_id' => $this->school_id()
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Arm Added'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function update_arm($id = '')
        {
            if($id != ''){
                $arm_exist = $this->school()->arms->find($id);
                if(!$arm_exist){
                    Redirect::to('/school/arm');
                }
            }else{
                Redirect::to('/school/arm');
            }
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'arm' => [
                            'required' => true,
                            'max' => 50
                        ]
                    ]);
                    if($validation->passed()){
                        Arm::find($id)->update(
                            [
                                'name' => Input::get('arm'),
                                'school_id' => $this->school_id()
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Update Success'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_arm($id = '')
        {
            if($id != ''){
                $arm_exist = $this->school()->arms->find($id);
                if(!$arm_exist){
                    Redirect::to('/school/arm');
                }
            }else{
                Redirect::to('/school/arm');
            }
            Arm::destroy($id);

            Session::put('flash', $this->notifications('success', 'Arm Deleted'));
            Redirect::to('/school/arm');
        }

        public function create_term()
        {
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'term' => [
                            'required' => true,
                            'max' => 11,
                            'unique' => $this->school()->terms->where('session', School::get_session())
                        ],
                        'start' => [
                            'required' => true,
                            'min' => 10,
                            'max' => 10
                        ],
                        'end' => [
                            'required' => true,
                            'min' => 10,
                            'max' => 10,
                            'greater' => 'start'
                        ]
                    ]);
                    if($validation->passed()){
                        Term::create(
                            [
                                'term' => Input::get('term'),
                                'session' => School::get_session(),
                                'start' => Input::get('start'),
                                'end' => Input::get('end'),
                                'school_id' => $this->school_id()
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Term Added'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function update_term($id = '')
        {
            //echo $this->school()->terms->where('session', School::get_session()); die();
            if($id != ''){
                $term_exist = $this->school()->terms->find($id);
                if(!$term_exist){
                    Redirect::to('/school/term');
                }
            }else{
                Redirect::to('/school/term');
            }

            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'start' => [
                            'required' => true,
                            'min' => 10,
                            'max' => 10
                        ],
                        'end' => [
                            'required' => true,
                            'min' => 10,
                            'max' => 10,
                            'greater' => 'start'
                        ]
                    ]);
                    if($validation->passed()){
                        Term::find($id)->update(
                            [
                                'term' => $this->school()->terms->find($id)->term,
                                'session' => School::get_session(),
                                'start' => Input::get('start'),
                                'end' => Input::get('end'),
                                'school_id' => $this->school_id()
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Update Successful'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_term($id = '')
        {
            if($id != ''){
                $term_exist = $this->school()->terms->find($id);
                if(!$term_exist){
                    Redirect::to('/school/term');
                }
            }else{
                Redirect::to('/school/term');
            }
            Term::destroy($id);

            Session::put('flash', $this->notifications('success', 'Term Deleted'));
            Redirect::to('/school/term');
        }

        public function update_bank_settings()
        {
            $settings = $this->school()->school_settings;
            if($settings){
                if(Input::exists()){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, School::$bank_rules);
                    if($validation->passed()){
                        
                        $settings->update(
                            [
                                'account_name' => Input::get('account_name'),
                                'account_no' => Input::get('account_no'),
                                'bank' => Input::get('bank')
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Bank Details Updated'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }else{
                if(Input::exists()){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, Admin::$bank_rules);
                    if($validation->passed()){
                        
                        SchoolSettings::create(
                            [
                                'school_id' => $this->school()->id,
                                'account_name' => Input::get('account_name'),
                                'account_no' => Input::get('account_no'),
                                'bank' => Input::get('bank')
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Bank Details Updated'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }

            }
            Redirect::back();
        }

        public function create_expense()
        {
            if(Input::exists()){
                //echo "<pre>";
                //print_r($_POST); die();
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, School::$expenses_rules);
                    if($validation->passed()){
                        $get_sms = $this->school()->subscriptions_balance->sms;
                        $get_email= $this->school()->subscriptions_balance->email;
                        if($get_sms < 1 || $get_email < 1){
                            Session::put('flash', $this->notifications('danger', 'Bundle Exhausted'));
                            Redirect::back();
                        }
                        //echo 'validated'; die();
                        $session = School::get_session();
                        Expense::create(
                            [
                                'session' => School::get_session(),
                                'term' => Input::get('term'),
                                'title' => Input::get('title'),
                                'amount' => Input::get('amount'),
                                'description' => Input::get('description'),
                                'receiver' => Input::get('receiver'),
                                'phone' => Input::get('phone'),
                                'payment_method' => Input::get('payment_method'),
                                'school_id' => $this->school()->id
                            ]
                        );
                        $receiver_phone = 234 . $this->school()->phone;
                        $title = Input::get('title');
                        $description = Input::get('description');

                        $message = 'A ' . Input::get('payment_method') . ' of ' . School::currency_formatter(Input::get('amount')) . ' for ' . $title . ' has been concluded ' . '. From: ' . $this->school()->name;

                        $sms = new SMS;
                        $sms->send_sms($receiver_phone, $message, 'School');
                        $get_sms = $this->school()->subscriptions_balance->sms;
                        $get_email= $this->school()->subscriptions_balance->email;
                        $this->school()->subscriptions_balance->update([
                            'sms' => $get_sms - 1,
                            'email' => $get_email - 1
                        ]);
                        Session::put('flash', $this->notifications('success', 'Expenditure Added'));
                        Redirect::back();
                    }else{
                        //echo 'failed to validate'; die();
                        Redirect::back();
                    }
                }
            }
            Redirect::back();
        }

        public function create_bonus_percentage()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, [
                    'no_of_wards' => [
                        'required' => true,
                        'min' => 1,
                        'max' =>50,
                        'numeric' => true
                    ],
                    'percentage' => [
                        'required' => true,
                        'min' => 1,
                        'max' =>3,
                        'numeric' => true
                    ],
                ]);
                if($validation->passed()){
                    //echo 'validated'; die();
                    //$session = School::get_session();
                    Bonus::create(
                        [
                            'no_of_wards' => Input::get('no_of_wards'),
                            'bonus' => Input::get('percentage'),
                            'school_id' => $this->school()->id,
                            'bonus_type' => 'percentage'
                        ]
                    );
                    Session::put('flash', $this->notifications('success', 'Bonus Added'));
                    Redirect::back();
                }else{
                    //echo 'failed to validate'; die();
                    Redirect::back();
                }
            }
        }

        public function create_bonus_amount()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, [
                    'no_of_wards' => [
                        'required' => true,
                        'min' => 1,
                        'max' =>50,
                        'numeric' => true
                    ],
                    'amount' => [
                        'required' => true,
                        'min' => 1,
                        'max' =>50,
                        'numeric' => true
                    ],
                ]);
                if($validation->passed()){
                    //echo 'validated'; die();
                    //$session = School::get_session();
                    Bonus::create(
                        [
                            'no_of_wards' => Input::get('no_of_wards'),
                            'bonus' => Input::get('amount'),
                            'school_id' => $this->school()->id,
                            'bonus_type' => 'amount'
                        ]
                    );
                    Session::put('flash', $this->notifications('success', 'Bonus Added'));
                    Redirect::back();
                }else{
                    //echo 'failed to validate'; die();
                    Redirect::back();
                }
            }
        }

        public function update_bonus($id = '')
        {
            if($id != ''){
                $bonus_exist = $this->school()->bonuses->find($id);
                if(!$bonus_exist){
                    Redirect::to('/school/bonus');
                }
            }else{
                Redirect::to('/school/bonus');
            }
            if(Input::exists()){
                //echo "<pre>";
                //print_r($_POST); die();
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'no_of_wards' => [
                            'required' => true,
                            'min' => 1,
                            'max' => 50,
                            'numeric' => true
                        ],
                        'amount' => [
                            'required' => true,
                            'min' => 1,
                            'max' => 50,
                            'numeric' => true
                        ],
                    ]);
                    if($validation->passed()){
                        //echo 'validated'; die();
                        //$session = School::get_session();
                        Bonus::find($id)->update(
                            [
                                'no_of_wards' => Input::get('no_of_wards'),
                                'bonus' => Input::get('amount'),
                                'bonus_type' => Input::get('bonus_type')
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'Bonus Updated'));
                        Redirect::back();
                    }else{
                        //echo 'failed to validate'; die();
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_bonus($id = '')
        {
            if($id != ''){
                $bonus_exist = $this->school()->bonuses->find($id);
                if(!$bonus_exist){
                    Redirect::to('/school/bonus');
                }
            }else{
                Redirect::to('/school/bonus');
            }
            Bonus::destroy($id);

            Session::put('flash', $this->notifications('success', 'Bonus Deleted'));
            Redirect::to('/school/bonus');
        }

        public function view_income_report($val)
        {
            
            //echo $val; die();
            $incomes = $this->school()->fee_users;
            echo '
                <table style="font-size: 14px;" id="myTab" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Student</th>
                        <th>Guardian</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
            ';
            $sn = 1;
            if($val == 'daily'){
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
            }else if($val == 'monthly'){
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
            }else if($val == 'yearly'){
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
                $startTime = strtotime(explode('.', $val)[0]);
                $endTime = strtotime(explode('.', $val)[1]);
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
            
            echo '</tbody>
                </table>';
                $assets = 'http://fees.me/public';
                echo '<script src="' . $assets . '/plugins/jquery/jquery.min.js"></script>';
                echo '<script src="' . $assets . '/plugins/datatables/datatables.min.js"></script>';
                echo '<script>
                $(document).ready(function() {
                    $("#myTab").DataTable();
                });</script>';
                //echo date("Y-m");
        }

        public function view_expense_report($val)
        {
            //echo $val; die();
            $expenses = $this->school()->expenses;
            echo '
                
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Reciever Name</th>
                        <th>Receiver No</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
            ';
            $sn = 1;
            if($val == 'daily'){
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
            }else if($val == 'monthly'){
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
            }else if($val == 'yearly'){
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
                $startTime = strtotime(explode('.', $val)[0]);
                $endTime = strtotime(explode('.', $val)[1]);
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
            
            echo '</tbody>';

                //echo date("Y-m");
        }

        public function send_notification($id = '')
        {
            if($id != ''){
                $fee_exist = $this->school()->fees->find($id);
                if(!$fee_exist){
                    Redirect::to('/school/fee');
                }
            }else{
                Redirect::to('/school/fee');
            }
            $get_sms = $this->school()->subscriptions_balance->sms;
            $get_email= $this->school()->subscriptions_balance->email;
            if($get_sms < 1 || $get_email < 1){
                Session::put('flash', $this->notifications('danger', 'Bundle Exhausted'));
                Redirect::back();
            }
            $school_name = $this->school()->name;
            $headers = "From: " . $school_name;
            $fee = Fee::find($id);
            $fee_title = $fee->title;
            $fee_session = $fee->session;
            $fee_term = $fee->term->term;
            $fee_class_id = Fee::find($id)->classe_id;
            $fee_arm_id = Fee::find($id)->arm_id;

            $students = $this->school()->users;
            $school = new School();
            $years = $school->find($this->school_id())->grad_year_get();
            $classes = $school->find($this->school_id())->class_get();
            function classe($no, $arr)
            {
                if(in_array($no, $arr)){
                    return array_search($no, $arr);
                }
            }
            foreach($students as $student){
                $student_name = $student->lastname . ' ' . $student->firstname . ' ' . $student->middlename;
                $student_class = $classes[classe($student->year_of_graduation, $years)];
                $student_class_id = Classe::where('class', $student_class)->first()->id;
                $student_class_arm = $student->arm_id;
                if($fee_class_id == $student_class_id && $fee_arm_id == $student_class_arm){
                    $guardian_phone = 234 . $student->guardian->phone;
                    $guardian_email = $student->guardian->email;
                    //$phone = $student->guardian->phone;
                    
                    $message = 'Dear sir/madam, ' . $student_name . ' ' . $fee_title . ' for ' . $fee_session . ' session, ' . $fee_term . ' breakdown is as follows; ';
                    $prepared_fees = $fee->prepared_fees;
                    
                    $bonuses = $this->school()->bonuses->sortByDesc('no_of_wards');
                    $bonus_money = 0;
                    $no_of_wards = $student->guardian->users->count();
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
                    $expecting_fee_amount = ($fee->prepared_fees->sum('amount')) - $bonus_money;

                    foreach($prepared_fees as $prepared_fee){
                        $prepared_title = $prepared_fee->title;
                        $prepared_amount = $prepared_fee->amount;
                        $message .=  $prepared_title . ' = ' . School::currency_formatter($prepared_amount) . ' ';
                    }
                    $message .= 'Bonus = ' . School::currency_formatter($bonus_money) . '. ' . 'Expecting fee amount: ' . School::currency_formatter($expecting_fee_amount) . '. From: ' . $this->school()->name;
                    //echo $message . ', ' . $guardian_phone . ' ' . $this->school()->name . '<br>';
                    $sms = new SMS;
                    $sms->send_sms($guardian_phone, $message, 'School');
                    mail($guardian_name,$fee_title,$message,$headers);
                    
                }
            }
            //die();
            $fee->update([
                'noti_sent' => date("Y-m-d H:i:s")
            ]);
            $get_sms = $this->school()->subscriptions_balance->sms;
            $get_email= $this->school()->subscriptions_balance->email;
            $this->school()->subscriptions_balance->update([
                'sms' => $get_sms - 1,
                'email' => $get_email - 1
            ]);
            Session::put('flash', $this->notifications('success', 'Notifications sent'));
            Redirect::back();
        }

        public function verify_paystack_payment($ref)
        {
            //$order = Subscription::find($order_id);
            $sKey = AdminSettings::find(1)->secret_key;
            //$paystack = new Paystack('$sKey');
            //$responseObj = $paystack->transaction->verify(["reference"=>"$ref"]); die();
            $result = array();
            //The parameter after verify/ is the transaction reference to be verified
            $url = 'https://api.paystack.co/transaction/verify/' . $ref;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
                'Authorization: ' . $sKey]
            );
            $request = curl_exec($ch);
            if(curl_error($ch)){
            echo 'error:' . curl_error($ch);
            }
            curl_close($ch);

            if ($request) {
            $result = json_decode($request, true);
            }

            if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {

            echo "Transaction was successful";
                //Perform necessary action
            }else{
            echo "Transaction was unsuccessful";
            }
        }

        public function verify_new_paystack_payment($ref, $order_id)
        {
            $sKey = AdminSettings::find(1)->secret_key;
            $result = array();
            //The parameter after verify/ is the transaction reference to be verified
            $url = 'https://api.paystack.co/transaction/verify/' . $ref;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $sKey]
            );
            $request = curl_exec($ch);
            curl_close($ch);

            if ($request) {
                $result = json_decode($request, true);
                // print_r($result);
                if($result){
                if($result['data']){
                    //something came in
                    if($result['data']['status'] == 'success'){
                    // the transaction was successful, you can deliver value
                    /* 
                    @ also remember that if this was a card transaction, you can store the 
                    @ card authorization to enable you charge the customer subsequently. 
                    @ The card authorization is in: 
                    @ $result['data']['authorization']['authorization_code'];
                    @ PS: Store the authorization with this email address used for this transaction. 
                    @ The authorization will only work with this particular email.
                    @ If the user changes his email on your system, it will be unusable
                    */
                   // echo "<pre>";
                    //print_r($result);
                    echo "Transaction was successful";
                    $subscription = Subscription::find($order_id);
                    $sub_sms = $subscription->subscription_type->sms;
                    $sub_email = $subscription->subscription_type->email;
                    //echo $sub_sms; echo $sub_email;
                    $subscription->update([
                        'paystack_proof' => date("Y-m-d H:i:s"),
                        'confirmed_at' => date("Y-m-d H:i:s")
                    ]);
                    $old_bal_sms = $this->school()->subscriptions_balance->sms;
                    $old_bal_email = $this->school()->subscriptions_balance->email;

                    $new_bal_sms = $sub_sms + $old_bal_sms;
                    $new_bal_email = $sub_email + $old_bal_email;
                   // echo $new_bal_sms . '<br>';
                    //echo $new_bal_email; die();
                    $this->school()->subscriptions_balance->update([
                        'sms' => $new_bal_sms,
                        'email' => $new_bal_email
                    ]);
                    //echo $bal_sms; echo $bal_email; die();
                    Session::put('flash', $this->notifications('success', 'Transaction was successful'));
                    Redirect::back();
                    }else{
                    // the transaction was not successful, do not deliver value'
                    // print_r($result);  //uncomment this line to inspect the result, to check why it failed.
                    echo "Transaction was not successful: Last gateway response was: ".$result['data']['gateway_response'];
                    Session::put('flash', $this->notifications('danger', 'Transaction was not successful'));
                    Redirect::back();
                    }
                }else{
                    echo $result['message'];
                }

                }else{
                //print_r($result);
                //die("Something went wrong while trying to convert the request variable to json. Uncomment the print_r command to see what is in the result variable.");
                }
            }else{
                //var_dump($request);
                //die("Something went wrong while executing curl. Uncomment the var_dump line above this line to see what the issue is. Please check your CURL command to make sure everything is ok");
            }
        }

        public function test()
        {
            echo Hash::unique();
            //echo AdminSettings::find(1)->public_key;
           //echo password_hash('admin1234', PASSWORD_DEFAULT);
           
        }

    }