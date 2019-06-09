<?php

    class GuardiansController extends Controller
    {
        public function __construct()
        {
            $cookie_exist = Cookie::exists(Config::get('remember/guardian'));
            if($cookie_exist){
                $value_of_cookie = Cookie::get(Config::get('remember/guardian'));
                $guardian_id = GuardianSession::where('hash', $value_of_cookie)->first()->guardian_id;
                Session::put(Config::get('session/guardian'), $guardian_id);
            }
            return ($this->guardian() || Cookie::exists(Config::get('remember/guardian'))) ? true : Redirect::to('/login/guardian');
        }

        public function index()
        {
            $this->view('guardian/index');
        }

        public function dashboard()
        {
            $this->view('guardian/index');
        }

        public function profile()
        {
            $this->view('guardian/profile');
        }

        public function ward()
        {
            $this->view('guardian/ward');
        }

        public function notification()
        {
            $this->view('guardian/notification');
        }

        public function view_notification($id)
        {
            $this->guardian()->broadcasts->find($id)->update([
                'viewed_on' => date("Y-m-d H:i:s")
            ]);
            $this->view('guardian/view-notification', ['id' => $id]);
        }

        public function fee()
        {
            $this->view('guardian/fee');
        }

        public function logout()
        {
            Session::put('flash', $this->notifications('success', 'Logout Successful'));
            Session::delete(Config::get('session/guardian'));
            Cookie::delete(Config::get('remember/guardian'));
            Redirect::to('/login/guardian');
        }
    }