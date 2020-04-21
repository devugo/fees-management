<?php

    class RegisterController extends Controller
    {
        public function index($name = '')
        {
            $this->view('school/register');
        }

        public function register_school()
        {
            //echo Session::get('token');
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $accept_terms = (Input::get('terms') == 'on') ? true : false;
                    if($accept_terms){
                        $validate = new Validate();
                        $validation = $validate->check($_POST, School::$school_rules);
                        if($validation->passed()){
                            School::create(
                                [
                                    'name' => Input::get('name'),
                                    'email' => Input::get('email'),
                                    'password' => Hash::make(Input::get('password'))
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
                            /*$mail = new Mail();
                            $sendEmail = $mail->sendMail('ugonnaezenwankwo@gmail.com', 'Registered Successfully', 'You have successfully registered your school, kindly follow the link to continue registration');
                            if($sendEmail){
                                echo 'Mail sent';
                            }else{
                                echo 'Mail was not sent successfully';
                            }*/
                            $to = Input::get('email');
                            $subject = 'Welcome Message';
                            $txt = 'Welcome to Devugo Bills Management System. We are glad to have you around.';
                            $headers = "From: info@devugo.com";
            
                            mail($to,$subject,$txt,$headers);
                            Session::put('flash', $this->notifications('success', 'School Registered'));
                            Redirect::to('/login');
                        }else{
                            Redirect::back();
                        /*  foreach($errors as $error){
                                echo '<li>' . $error . '</li>';
                            }*/
                        }
                    }else{
                        $validate = new Validate();
                        $validate->addError('accept_terms', 'Please accept our terms');
                        Redirect::back();
                    }
                    

                }
            }
        }
    }