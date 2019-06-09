<?php

    class SchoolsController extends Controller
    {
        public function __construct()
        {
            $cookie_exist = Cookie::exists(Config::get('remember/school'));
            if($cookie_exist){
                $value_of_cookie = Cookie::get(Config::get('remember/school'));
                $school_id = SchoolSession::where('hash', $value_of_cookie)->first()->school_id;
                Session::put(Config::get('session/school'), $school_id);
            }
            return ($this->school() || $this->admin()) ? true : Redirect::to('/login');
        }

        public function index()
        {
            $this->view('school/index');
        }

        public function dashboard($id = '')
        {
            if($this->admin()){
                Session::put(Config::get('session/school'), $id);
            }
            $this->view('school/index');
        }

        public function guardian()
        {
            $this->view('school/guardian');
        }

        public function edit_guardian($id = '')
        {
            
            $guardian_exist = $this->school()->guardians->find($id);
            if(!$guardian_exist){
                Redirect::to('/school/guardian');
            }
            $this->view('school/edit-guardian', ['id' => $id]);
        }

        public function student($id = '')
        {
            if($id != ''){
                $guardian_exist = $this->school()->guardians->find($id);
                if(!$guardian_exist){
                    Redirect::to('/school/student');
                }
            }
            $this->view('school/student', ['id' => $id]);
        }

        public function edit_student($id = '')
        {
            if($id != ''){
                $student_exist = $this->school()->users->find($id);
                if(!$student_exist){
                    Redirect::to('/school/student');
                }
            }
            $this->view('school/edit-student', ['id' => $id]);
        }

        public function class()
        {
            $this->view('school/class');
        }

        public function edit_class($id = '')
        {
            if($id != ''){
                $class_exist = $this->school()->classes->find($id);
                if(!$class_exist){
                    Redirect::to('/school/class');
                }
            }else{
                Redirect::to('/school/class');
            }
            $this->view('school/edit-class', ['id' => $id]);
        }
        
        public function fee()
        {
            $this->view('school/fee');
        }

        public function edit_fee($id = '')
        {
            if($id != ''){
                $fee_exist = $this->school()->fees->find($id);
                if(!$fee_exist){
                    Redirect::to('/school/fee');
                }
            }else{
                Redirect::to('/school/fee');
            }
            $this->view('school/edit-fee', ['id' => $id]);
        }

        public function prepare_fee($id = '')
        {
            if($id != ''){
                $fee_exist = $this->school()->fees->find($id);
                if(!$fee_exist){
                    Redirect::to('/school/fee');
                }
            }else{
                Redirect::to('/school/fee');
            }

            $this->view('school/prepare-fee', ['id' => $id]);
        }

        public function payment()
        {
            $this->view('school/payment');
        }

        public function subscription()
        {
            $this->view('school/subscription');
        }

        public function ticket()
        {
            $this->view('school/ticket');
        }

        public function broadcast()
        {
            $this->view('school/broadcast');
        }

        public function view_broadcast($id = '')
        {
            if($id != ''){
                $broadcast_exist = $this->school()->broadcasts->find($id);
                if(!$broadcast_exist){
                    Redirect::to('/school/broadcast');
                }
            }else{
                Redirect::to('/school/broadcast');
            }
            $this->view('school/view-broadcast', ['id' => $id]);
        }

        public function notification()
        {
            $this->view('school/notification');
        }

        public function view_notification($id = '')
        {
            if($id != ''){
                $notification_exist = $this->school()->notifications->find($id);
                if(!$notification_exist){
                    Redirect::to('/school/notification');
                }
            }else{
                Redirect::to('/school/notification');
            }
            Notification::find($id)->update([
                'viewed_on' => date("Y-m-d H:i:s")
            ]);
            $this->view('school/view-notification', ['id' => $id]);
        }

        public function profile()
        {
            $this->view('school/profile');
        }

        public function arm()
        {
            $this->view('school/arm');
        }

        public function edit_arm($id = '')
        {
            if($id != ''){
                $arm_exist = $this->school()->arms->find($id);
                if(!$arm_exist){
                    Redirect::to('/school/arm');
                }
            }else{
                Redirect::to('/school/arm');
            }
            $this->view('school/edit-arm', ['id' => $id]);
        }

        public function term()
        {
            $this->view('school/term');
        }

        public function edit_term($id = '')
        {
            if($id != ''){
                $term_exist = $this->school()->terms->find($id);
                if(!$term_exist){
                    Redirect::to('/school/term');
                }
            }else{
                Redirect::to('/school/term');
            }
            $this->view('school/edit-term', ['id' => $id]);
        }

        public function test()
        {
            $this->view('school/test');
        }

        public function settings()
        {
            $this->view('school/settings');
        }

        public function expenses()
        {
            $this->view('school/expenses');
        }

        public function bonus()
        {
            $this->view('school/bonus');
        }

        public function edit_bonus($id = '')
        {
            if($id != ''){
                $bonus_exist = $this->school()->bonuses->find($id);
                if(!$bonus_exist){
                    Redirect::to('/school/bonus');
                }
            }else{
                Redirect::to('/school/bonus');
            }
            $this->view('school/edit-bonus', ['id' => $id]);
        }

        public function reports()
        {
            $this->view('school/report');
        }
        
        public function view_report($type = '', $dur = '', $fin = '')
        {
            if($type == 'incoming' || $type == 'outgoing'){
                if(isset($fin)){
                    $this->view('school/view-report', ['type' => $type, 'dur' => $dur, 'finish' => $fin]);
                }else if(isset($dur)){
                    $this->view('school/view-report', ['type' => $type, 'dur' => $dur]);
                }else if(isset($type)){
                    $this->view('school/view-report', ['type' => $type]);
                }else{
                    Redirect::back();
                }
            }else{
                Redirect::to('/school/view-report/incoming');
            }

            // $this->view('school/view-report', ['type' => $type]);
        }

        public function logout()
        {
            Session::put('flash', $this->notifications('success', 'Logout Successful'));
            Session::delete(Config::get('session/school'));
            Cookie::delete(Config::get('remember/school'));
            Redirect::to('/login');
        }

    }