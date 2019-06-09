<?php
    class Controller
    {
        
        public function model($model)
        {
            require_once 'app/models/' . $model . '.php';
            return new $model();
        }

        public function view($view, $data = [])
        {
            $domain = Config::get('default/domain');
            $assets = "$domain/public";
            if(file_exists('app/views/' . $view . '.php')){
                require_once 'app/views/' . $view . '.php';
            }else{
                Redirect::to(404);
            }
        }

        public function inputError($field)
        {
            $output = '  <span class="text-danger" style="font-size: 12px;">';

            if(Input::errors($field)){
                foreach (Input::errors($field) as $error) {
                    $error = ucfirst(str_replace('_', ' ', $error));
                $output .= $error.' ';
                }

            $output .= '</span>';
            //unset(Session::get('inputs-errors')[$field]);
            return $output;

            }
            return false;
        }

        public function guardian_id()
        {
            if(Session::exists(Config::get('session/guardian'))){
                return Session::get(Config::get('session/guardian'));
            }else{
                return false;
            }
        }

        public function school_id()
        {
            if(Session::exists(Config::get('session/school'))){
                return Session::get(Config::get('session/school'));
            }else{
                return false;
            }
        }

        public function admin_id()
        {
            if(Session::exists(Config::get('session/admin'))){
                return Session::get(Config::get('session/admin'));
            }else{
                return false;
            }
        }

        public function notifications($type = 'success', $message){
            if($type == 'success'){
                return '<div style="position: absolute; top: 0; left: 0; right: 0; width: 400px; margin: auto;"class="alert alert-success alert-dismissible fade show text-center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                 <strong>' . $message . '!</strong>
                </div>';
            }
            return '<div style="position: absolute; top: 0; left: 0; right: 0; width: 400px; margin: auto;"class="alert alert-danger alert-dismissible fade show text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
             <strong>' . $message . '!</strong>
            </div>';
        }

        public function school()
        {
            if(Session::exists(Config::get('session/school'))){
                return School::find(Session::get(Config::get('session/school')));
            }
        }

        public function guardian()
        {
            if(Session::exists(Config::get('session/guardian'))){
                return Guardian::find(Session::get(Config::get('session/guardian')));
            }
        }

        public function admin()
        {
            if(Session::exists(Config::get('session/admin'))){
                return Admin::find(Session::get(Config::get('session/admin')));
            }
        }

        public function domain()
        {
            return Config::get('default/domain');
        }

        public function currency()
        {
            return Config::get('default/currency');
        }

        public function profile()
        {
            return Config::get('default/profile_image');
        }

        public function password()
        {
            return Config::get('default/password');
        }

        public function middleware($middleware)
        {
			require_once 'app/middlewares/' . $middleware . '.php';
			return new $middleware;
		}
    
    }