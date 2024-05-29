<?php

namespace Ven\App;
session_start();

class Session {

    public static function user($user) {
        $_SESSION['user'] = $user;
    }

    public static function validation($val, $login=NULL) {
        $_SESSION['validation'] = [];
        if ($val) {
            $_SESSION['validation']['text'] = 'Неверный логин или пароль';
            $_SESSION['validation']['login'] = $login;
        }
        
    }
}