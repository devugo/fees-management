<?php

    class Administrator extends Controller
    {
        public function __construct()
        {

        }


        public function loggedIn()
        {
            if(Session::exists(Config::get('session/school'))){
                return true;
            }else{
                return false;

                //Redirect::to('/login');
            }
        }
    }