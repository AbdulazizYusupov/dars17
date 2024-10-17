<?php
namespace App\Controllers;

use App\Helpers\Auth;
use App\Models\User;

class UserController
{
    public function __construct()
    {
        if (!Auth::check()) {
            header('location: /');
        }
        layout('user');
    }
    public function admin()
    {
        return view('admin', 'Admin');
    }
    public function user()
    {
        return view('user', 'User');
    }

    public function all()
    {
        $models = User::all();
        return $models;
    }
}

?>