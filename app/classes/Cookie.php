<?php
    class Cookie
    {
        public static function exists($name)
        {
            return (isset($_COOKIE[$name])) ? true : false;
        }

        public static function get($name)
        {
            return $_COOKIE[$name];
        }

        public static function put($name, $value, $expiry)
        {
            ob_start();
            if(setcookie($name, $value, time() + $expiry, '/')){
                return true;
            }
            ob_end_flush();
            return false;
        }

        public static function delete($name)
        {
            self::put($name, '', time()-1);
            // exit();
        }
    }