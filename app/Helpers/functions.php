<?php

if(!function_exists('host'))
{
    function host(){
        return Config::get('default/domain');
    }
}

if(!function_exists('port'))
{
    function port(){
        return '4000';
    }
}

if(!function_exists('base_url'))
{
    function base_url(){
        return host();
    }
}

if(!function_exists('default_password'))
{
    function default_password(){
        return 'password';
    }
}