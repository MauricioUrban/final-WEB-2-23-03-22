<?php

class loginHelper{
    function __construct(){
        if (session_status()!=PHP_SESSION_ACTIVE){
            session_start();
        }
    }
    public function login($user){
        $_SESSION['USER_ID'] = $user->id;
        $_SESSION['USER_MAIL'] = $user->email;
        header("location: ". BASE_URL. "/admin");
    }
    public function checkLoggedIn(){
        if (empty($_SESSION['USER_ID'])){
            header ("location: ".BASE_URL."/home");
            die();
        }

    public function checkLoggedIn(){
        if (empty($_SESSION['USER_ID_USUARIO'])){
            header ("location: ".BASE_URL."/home");
            die();
        }
    }
    public function logout(){
        session_destroy();
        header("Location: ".BASE_URL."/home");
    }

}