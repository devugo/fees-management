<?php

    class ForgotPasswordController extends Controller
    {
        public function __construct()
        {

        }

        public function reset($token = '')
        {
            if($token == ''){
                Redirect::to('/login');
            }
            $this->view('school/reset', ['token' => $token]);
        }
    }