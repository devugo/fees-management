<?php

    class AdminController extends Controller
    {
        public function __construct()
        {
            $cookie_exist = Cookie::exists(Config::get('remember/admin'));
            if($cookie_exist){
                $value_of_cookie = Cookie::get(Config::get('remember/admin'));
                $admin_id = AdminSession::where('hash', $value_of_cookie)->first()->admin_id;
                Session::put(Config::get('session/admin'), $admin_id);
            }
            return ($this->admin() || Cookie::exists(Config::get('remember/admin'))) ? true : Redirect::to('/login/super_admin_url');
        }

        public function index()
        {
            $this->view('admin/index');
        }

        public function dashboard()
        {
            Session::delete(Config::get('session/school'));
            $this->view('admin/index');
        }

        public function school()
        {
            $this->view('admin/school');
        }

        public function edit_school($id = '')
        {
            if($id != ''){
                $school_exist = School::find($id);
                if(!$school_exist){
                    Redirect::to('/admin/school');
                }
            }else{
                Redirect::to('/admin/school');
            }
            $this->view('admin/edit-school', ['id' => $id]);
        }

        public function profile()
        {
            $this->view('admin/profile');
        }

        public function payment()
        {
            $this->view('admin/payment');
        }

        public function notification()
        {
            $this->view('admin/notification');
        }

        public function view_notification($id = '')
        {
            if($id != ''){
                $notification_exist = Notification::find($id);
                if(!$notification_exist){
                    Redirect::to('/admin/notification');
                }
            }else{
                Redirect::to('/admin/notification');
            }
            $this->view('admin/view-notification', ['id' => $id]);
        }

        public function subscription()
        {
            $this->view('admin/subscription');
        }

        public function edit_subscription_plan($id = '')
        {
            if($id != ''){
                $sub_exist = SubscriptionType::find($id);
                if(!$sub_exist){
                    Redirect::to('/admin/subscription');
                }
            }else{
                Redirect::to('/admin/subscription');
            }
            $this->view('admin/edit-subscription-plan', ['id' => $id]);
        }

        public function ticket()
        {
            $this->view('admin/ticket');
        }

        public function reply_ticket($id = '')
        {
            if($id != ''){
                $ticket_exist = Ticket::find($id);
                if(!$ticket_exist){
                    Redirect::to('/admin/ticket');
                }
            }else{
                Redirect::to('/admin/ticket');
            }
            $this->view('admin/reply-ticket', ['id' => $id]);
        }

        public function view_ticket($id = '')
        {
            if($id != ''){
                $ticket_exist = Ticket::find($id);
                if(!$ticket_exist){
                    Redirect::to('/admin/ticket');
                }
            }else{
                Redirect::to('/admin/ticket');
            }
            $this->view('admin/view-ticket', ['id' => $id]);
        }

        public function settings()
        {
            $this->view('admin/settings');
        }
        
        public function logout()
        {
            Session::put('flash', $this->notifications('success', 'Logout Successful'));
            Session::delete(Config::get('session/admin'));
            Session::delete(Config::get('session/school'));
            Cookie::delete(Config::get('remember/admin'));
            Redirect::to('/login/super_admin_url');
        }
    }