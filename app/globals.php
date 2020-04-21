<?php

    session_start();

    $GLOBALS['config'] = array(
        'mysql' => array(
            'host' => '127.0.0.1',
            'username' => 'root',
            'password' => '',
            'db' => 'fees_management'
        ),
        'remember' => array(
            'guardian' => 'guardian_cooki',
            'school' => 'school_cooki',
            'admin' => 'admin_cooki',
            'expiry' => 604800
        ),
        'session' => array(
            'guardian' => 'guardian_sess',
            'school' => 'school_sess',
            'admin' => 'admin_sess',
            'token_name' => 'token',
            'error' => 'errors',
            'expiry' => 86400
        ),
        'default' => array(
            'project_title' => 'Fees Management',
            'project_description' => 'Fees Management system to control and manage all payments and expenses in a school',
            'domain' => 'http://' . $_SERVER['SERVER_NAME'] . ':4000',
            'profile_image' => 'profile.png',
            'logo' => 'public/images/favicon.png',
            'currency' => 'N',
            'page' => 'index.php',
            'password' => 111111,
            'username' => 'devugo'
        )
    );


    $GLOBALS['route'] = array(
        'register' => 'RegisterController',
        'login' => 'LoginController',
        'forgot-password' => 'ForgotPasswordController',
        'front' => 'FrontController',
        'admin' => 'AdminController',
        'school' => 'SchoolsController',
        'guardian' => 'GuardiansController',
        'school-manager' => 'SchoolsManagerController',
        'admin-manager' => 'AdminManagerController',
        'guardian-manager' => 'GuardiansManagerController',
        'user' => 'UsersController',
        'user-manager' => 'UsersManagerController'
    );