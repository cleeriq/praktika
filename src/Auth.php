<?php

namespace Ven\App;

use Ven\App\SQL;
use Ven\App\User;
use Ven\App\Session;

class Auth {


    public static function authentication() {
        $info = SQL::select('user', 'login', $_POST['login'], 'password', $_POST['password']);

        if (empty($info)) {
            Session::validation(true, $_POST['login']);
            header('Location: /home');
        } else {

            $user = new User($info[0]);
            Session::user($user);
            Session::validation(false);

            if ($user->info['role_id'] == '1') {
                header('Location: /shifts');
            } else {
                header('Location: /orders');
            }

        }
   
    }
}