<?php

namespace App\Helpers;

use App\Models\User;

class Auth
{
    public static function attach($data)
    {
        $user = User::attach($data);

        if ($user) {
            return $user[0];
        } else {
            return false;
        }
    }
    public static function check()
    {

        if (isset($_SESSION['Auth']) && !empty($_SESSION['Auth'])) {
            return true;
        }
        return false;
    }
    public static function user()
    {
        if (self::check()) {
            return $_SESSION['Auth'];
        }
        return false;
    }
    public static function createUser($data)
    {
        $user = User::createUser($data);

        if ($user) {
            $_SESSION['Auth'] = $user;
            return true;
        } else {
            return false;
        }
    }

    public static function logout()
    {
        unset($_SESSION['Auth']);
    }
}
