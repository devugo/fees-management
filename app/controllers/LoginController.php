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