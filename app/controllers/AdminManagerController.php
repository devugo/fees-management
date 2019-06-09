<?php

    class AdminManagerController extends Controller
    {
        public function __construct()
        {

        }

        public function authenticate()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'username' => [
                        'required' => true
                    ],
                    'password' => [
                        'required' => true
                    ]
                ));
                if($validation->passed()){
                    $admin = new Admin();

                    $remember = (Input::get('remember') === 'on') ? true : false;
                    $login = $admin->login(Input::get('username'), Input::get('password'), $remember);
                    if($login){ // If authentication is passed
                        Session::put('flash', $this->notifications('success', 'Welcome Admin'));
                        Redirect::to('/admin/dashboard');
                    }else{ // If authentication was not passed
                        Session::put('flash', $this->notifications('danger', 'Invalid Credentials'));
                        Redirect::back();
                    }
                }
            }
            Redirect::back();
        }

        public function create_school()
        {
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, Admin::$school_rules);
                    if($validation->passed()){
                        
                        School::create(
                            [
                                'name' => Input::get('name'),
                                'phone' => Input::get('phone'),
                                'email' => Input::get('email'),
                                'address' => Input::get('address'),
                                'city' => Input::get('city'),
                                'state' => Input::get('state'),
                                'password' => $this->password()
                            ]
                        );
                        SchoolSetting::create([
                            'school_id' => School::where('email', Input::get('email'))->first()->id
                        ]);
                        Income::create([
                            'school_id' => School::where('email', Input::get('email'))->first()->id
                        ]);
                        SubscriptionBalance::create([
                            'school_id' => School::where('email', Input::get('email'))->first()->id
                        ]);

                        $directory 	= 'uploads/images/logos';
                        $handle  = new Upload($_FILES['logo']);
                        if($handle->uploaded){
                            $handle->process($directory);

                            if($handle->processed){
                                $handle->clean();
                                $file_name  = $directory.'/'.$handle->file_dst_name;
                                School::where('email', Input::get('email'))->first()->update(['logo' => $file_name]);
                            }
                        }
                        
                        Session::put('flash', $this->notifications('success', 'School added'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function update_school($id = '')
        {
            if($id != ''){
                $school_exist = School::find($id);
                if(!$school_exist){
                    Redirect::to('/admin/school');
                }
            }else{
                Redirect::to('/admin/school');
            }
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'name'=> [
                            'required' => true,
                            'min' => 3,
                            'max' => 200
                        ],
                        'email'=> [
                            'required' => true,
                            'min' => 3,
                            'max' => 200,
                            'uniquEdit' => 'School' . '.' . $id
                        ],
                        'phone' => [
                            'required' => true,
                            'min' => 10,
                            'max' => 10,
                            'numeric' =>   true
                        ],
                        'city' => [
                            'required' => true,
                            'min' => 2,
                            'max' => 50
                        ],
                        'address' => [
                            'required' => true,
                            'min' => 6,
                            'max' => 200
                        ],
                        'state' => [
                            'required' => true,
                            'min' => 2,
                            'max' => 50
                        ]
                    ]);
                    if($validation->passed()){
                        School::find($id)->update(
                            [
                                'name' => Input::get('name'),
                                'address' => Input::get('address'),
                                'city' => Input::get('city'),
                                'state' => Input::get('state'),
                                'phone' => Input::get('phone'),
                                'email' => Input::get('email')
                            ]
                        );
                        Session::put('flash', $this->notifications('success', 'School Updated'));
                        Redirect::back();
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_school($id = '')
        {
            if($id != ''){
                $school_exist = School::find($id);
                if(!$school_exist){
                    Redirect::to('/admin/school');
                }
            }else{
                Redirect::to('/admin/school');
            }
            School::destroy($id);
            Session::put('flash', $this->notifications('success', 'School Deleted'));
            Redirect::back();
        }

        public function school_reset_password($id = '')
        {
            if($id != ''){
                $school_exist = School::find($id);
                if(!$school_exist){
                    Redirect::to('/admin/school');
                }
            }else{
                Redirect::to('/admin/school');
            }

            School::find($id)->update([
                'password' => password_hash($this->password(), PASSWORD_DEFAULT)
            ]);
            Session::put('flash', $this->notifications('success', 'Reset Successful'));
            Redirect::back();
        }

        public function block_school($id)
        {
           School::find($id)->update(
               [
                   'blocked_on' => date("Y-m-d H:i:s")
               ]
           );
           Session::put('flash', $this->notifications('success', 'School Blocked'));
           Redirect::back();
        }

        public function unblock_school($id)
        {
           School::find($id)->update(
               [
                   'blocked_on' => NULL
               ]
           );
           Session::put('flash', $this->notifications('success', 'School Activated'));
           Redirect::back();
        }

        public function update_profile()
        {
            $validate = new Validate();
            $validation = $validate->check($_POST, [
                'name' => [
                    'required' => true,
                    'min' => 5,
                    'max' => 50
                ],
                'email' => [
                    'required' => true,
                    'min' => 10,
                    'max' => 100
                ],
                'username' => [
                    'required' => true,
                    'min' => 5,
                    'max' => 50
                ],
                'address' => [
                    'required' => true,
                    'min' => 5,
                    'max' => 200
                ],
                'state' => [
                    'required' => true,
                    'min' => 3,
                    'max' => 30
                ],
                'phone' => [
                    'required' => true,
                    'min' => 10,
                    'max' => 10
                ],
                'city' => [
                    'required' => true,
                    'min' => 3,
                    'max' => 50
                ]
            ]);
            if($validation->passed()){
                $this->admin()->update([
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'username' => Input::get('username'),
                    'address' => Input::get('address'),
                    'state' => Input::get('state'),
                    'phone' => Input::get('phone'),
                    'city' => Input::get('city')
                ]);
                Session::put('flash', $this->notifications('success', 'Profile Updated'));
            }

            Redirect::back();
        }

        public function change_password()
        {
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $pass_hashed = Hash::make(Input::get('new_password'));
                    if(password_verify(Input::get('old_password'), $this->admin()->password)){
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
                            $this->admin()->update([
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
                        
                        
                        //Redirect::back();
                    
                }
            }
            
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
                    $this->admin()->update([
                        'logo' => $file_name
                    ]);
                    Session::put('flash', $this->notifications('success', 'Logo Updated'));
                }
            }
            
            Redirect::back();
        }

        public function upload_school_logo($id = '')
        {
            if($id != ''){
                $school_exist = School::find($id);
                if(!$school_exist){
                    Redirect::to('/admin/school');
                }
            }else{
                Redirect::to('/admin/school');
            }
            $directory 	= 'uploads/images/logos';
            $handle  = new Upload($_FILES['logo']);
            if($handle->uploaded){
                $handle->process($directory);

                if($handle->processed){
                    $handle->clean();
                    $file_name  = $directory.'/'.$handle->file_dst_name;
                    School::find($id)->update([
                        'logo' => $file_name
                    ]);
                    Session::put('flash', $this->notifications('success', 'Logo Updated'));
                }
            }
            
            Redirect::back();
        }

        public function confirm_payment($id = '')
        {
            //$subscription = Subscription::find($id);
            //print_r($school = $subscription->school); die();
            if($id != ''){
                $subscription_exist = Subscription::find($id);
                if(!$subscription_exist){
                    Redirect::to('/admin/payment');
                }
            }else{
                Redirect::to('/admin/payment');
            }

            $subscription = Subscription::find($id);
            //$school = $subscription->school;
            $subscription->update([
                'confirmed_at' => date("Y/m/d H:i:s")
            ]);
            $subscription_amount = $subscription->subscription_type->amount;
            $prev_admin_income = AdminIncome::find(1)->income;
            AdminIncome::find(1)->update([
                'income' => $prev_admin_income + $subscription_amount
            ]);
           // Session::put('flash', $this->notifications('success', 'Payment confirmed'));
           // Redirect::back();

            //get the school's current subscription balance
            $subscriptionBal = $subscription->school->subscriptions_balance;
            $emailBal = $subscriptionBal->email;
            $smsBal = $subscriptionBal->sms;

            //get the amount of sms and email for the subscription plan to add up the available balance
            $subPlanSms = $subscription->subscription_type->sms;
            $subPlanEmail = $subscription->subscription_type->email;

            //update subscription balance
            $subscriptionBal->update([
                'email' => $emailBal + $subPlanEmail,
                'sms' => $smsBal + $subPlanSms
            ]);

            Session::put('flash', $this->notifications('success', 'Payment confirmed'));
            Redirect::back();
        }

        public function delete_payment($id = '')
        {
            if($id != ''){
                $subscription_exist = Subscription::find($id);
                if(!$subscription_exist){
                    Redirect::to('/admin/payment');
                }
            }else{
                Redirect::to('/admin/payment');
            }
            Subscription::destroy($id);
            Session::put('flash', $this->notifications('success', 'Payment Deleted'));
            Redirect::back();
        }

        public function create_notification()
        {
            if(Input::exists()){
                //echo "<pre>";
                //print_r($_POST); die();
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, Admin::$notification_rules);
                    if($validation->passed()){
                        //echo count(Input::get('guardian')); die();
                        if(count(Input::get('school')) < 1){
                            $this->addError("school", "school is required");
                        }else{
                            foreach(Input::get('school') as $school){
                                //$splitGuardian = explode(' ', $guardian)
                                Notification::create(
                                    [
                                        'title' => Input::get('title'),
                                        'description' => Input::get('description'),
                                        'school_id' => $school
                                    ]
                                );
                            }
                            Session::put('flash', $this->notifications('success', 'Notification Sent'));
                            Redirect::back();
                        }
                    }else{
                        Redirect::back();
                    }
                }
            }
        }

        public function delete_notification($id)
        {
            Notification::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            Redirect::to('/admin/notification');
        }

        public function create_subscription_plan()
        {
            //echo "<pre>";
            //print_r($_POST); die();
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, Admin::$subscription_plan_rules);
                if($validation->passed()){
                    SubscriptionType::create(
                        [
                            'name' => Input::get('name'),
                            'amount' => Input::get('amount'),
                            'sms' => Input::get('sms'),
                            'email' => Input::get('email')
                        ]
                    );

                    
                    Session::put('flash', $this->notifications('success', 'Subscription added'));
                    Redirect::back();
                }else{
                    Redirect::back();
                }
            }
        }

        public function activate_subscription_plan($id = '')
        {
            if($id != ''){
                $sub_exist = SubscriptionType::find($id);
                if(!$sub_exist){
                    Redirect::to('/admin/subscription');
                }
            }else{
                Redirect::to('/admin/subscription');
            }
            SubscriptionType::find($id)->update(
                [
                    'blocked_on' => NULL
                ]
            );

            Session::put('flash', $this->notifications('success', 'Subscription Activated'));
            Redirect::back();
        }

        public function deactivate_subscription_plan($id = '')
        {
            if($id != ''){
                $sub_exist = SubscriptionType::find($id);
                if(!$sub_exist){
                    Redirect::to('/admin/subscription');
                }
            }else{
                Redirect::to('/admin/subscription');
            }
            SubscriptionType::find($id)->update(
                [
                    'blocked_on' => date("Y-m-d H:i:s")
                ]
            );

            Session::put('flash', $this->notifications('success', 'Subscription Deactivated'));
            Redirect::back();
        }

        public function delete_subscription_plan($id = '')
        {
            if($id != ''){
                $sub_exist = SubscriptionType::find($id);
                if(!$sub_exist){
                    Redirect::to('/admin/subscription');
                }
            }else{
                Redirect::to('/admin/subscription');
            }
            SubscriptionType::destroy($id);
            Session::put('flash', $this->notifications('success', 'Delete Successful'));
            Redirect::back();
        }

        public function update_subscription_plan($id = '')
        {
            if($id != ''){
                $sub_exist = SubscriptionType::find($id);
                if(!$sub_exist){
                    Redirect::to('/admin/subscription');
                }
            }else{
                Redirect::to('/admin/subscription');
            }

            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST, [
                        'name' => [
                            'required' => true,
                            'min' => 2,
                            'max' => 25
                        ],
                        'amount' => [
                            'required' => true,
                            'min' => 1,
                            'max' => 25,
                            'numeric' => true
                        ],
                        'sms' => [
                            'required' => true,
                            'min' => 2,
                            'max' => 25,
                            'numeric' => true
                        ],
                        'email' => [
                            'required' => true,
                            'min' => 2,
                            'max' => 25,
                            'numeric' => true
                        ]
                        
                    ]);
                    if($validation->passed()){
                        SubscriptionType::find($id)->update([
                            'name' => Input::get('name'),
                            'amount' => Input::get('amount'),
                            'sms' => Input::get('sms'),
                            'email' => Input::get('email')
                        ]);
                        Session::put('flash', $this->notifications('success', 'Subscription Updated'));
                    }
                    Redirect::back();
                }
            }
        }

        public function create_ticket_reply($id = '')
        {
            if($id != ''){
                $ticket_exist = Ticket::find($id);
                if(!$ticket_exist){
                    Redirect::to('/admin/ticket');
                }
            }else{
                Redirect::to('/admin/ticket');
            }
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, [
                    'response' => [
                        'required' => true,
                        'min' => 2,
                        'max' => 2000
                    ]
                ]);
                if($validation->passed()){
                    TicketResponse::create(
                        [
                            'ticket_id' => $id,
                            'response' => Input::get('ticket_reply')
                        ]
                    );
                    Ticket::find($id)->update([
                        'confirmed_at' => date("Y-m-d H:i:s")
                    ]);
                    
                    Session::put('flash', $this->notifications('success', 'Replied successful'));
                    Redirect::back();
                }else{
                    Redirect::back();
                }
            }   
        }

        public function update_paystack_settings()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, Admin::$paystack_rules);
                if($validation->passed()){
                    
                    AdminSettings::find(1)->update(
                        [
                            'public_key' => Input::get('public_key'),
                            'secret_key' => Input::get('secret_key')
                        ]
                    );
                    Session::put('flash', $this->notifications('success', 'Paystack Details Updated'));
                    Redirect::back();
                }else{
                    Redirect::back();
                }
            }
        }

        public function update_sms_settings()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, Admin::$sms_rules);
                if($validation->passed()){
                    
                    AdminSettings::find(1)->update(
                        [
                            'api_link' => Input::get('api_link'),
                            'api_username' => Input::get('api_username'),
                            'api_password' => Input::get('api_password'),
                            'sender' => Input::get('sender')
                        ]
                    );
                    Session::put('flash', $this->notifications('success', 'SMS Details Updated'));
                    Redirect::back();
                }else{
                    Redirect::back();
                }
            }
        }

        public function update_bank_settings()
        {
            if(Input::exists()){
                $validate = new Validate();
                $validation = $validate->check($_POST, Admin::$bank_rules);
                if($validation->passed()){
                    
                    AdminSettings::find(1)->update(
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
        }
    }
?>