<?php

class HomeController extends Controller
{
    public function index($name = '')
    {
        
        $this->view('home/index');

    }

    public function send_mail()
    {
        if(Input::exists()){
            //echo 'good'; die();
            $name = Input::get('name');
            $email = Input::get('email');
            $subject = Input::get('subject');
            $message = Input::get('message');
            mail($email,$subject,$message,$name);
            Session::put('flash', $this->notifications('success', 'MEssage delivered'));
            Redirect::back();
        }
    }

    public function logout()
    {
        Session::delete(Config::get('session/admin'));
        Session::delete(Config::get('session/school'));
        Session::delete(Config::get('session/guardian'));
        Session::put('flash', $this->notifications('success', 'Logout successfully'));
        Redirect::back();
    }


}