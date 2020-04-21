<?php

    class LoginController extends Controller
    {
        public function __construct()
        {

        }

        public function index()
        {
            if(Session::exists(Config::get('session/school')) || Cookie::exists(Config::get('remember/school'))){
                Redirect::to('/school/dashboard');
            }
            $this->view('school/login');
        }

        public function guardian()
        {
            // $numargs = func_num_args(); // Number of argumaents passed to the method
            // $allArgs = func_get_args(); // Get all the arguments passed to the function
            // $firstArg = func_get_arg(1); // Get the first argument passed to the function

            //*131*106# 1000mb and 3gb bonus
            
            if(Session::exists(Config::get('session/guardian')) || Cookie::exists(Config::get('remember/guardian'))){
                Redirect::to('/guardian/dashboard');
            }
            $this->view('guardian/login');
        }

        public function super_admin_url()
        {
            if(Session::exists(Config::get('session/admin')) || Cookie::exists(Config::get('remember/admin'))){
                Redirect::to('/admin/dashboard');
            }
            $this->view('admin/login');
        }
    }

?>