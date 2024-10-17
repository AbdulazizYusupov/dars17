<?php
namespace App\Controllers;

use App\Helpers\Auth;
use App\Models\User;

class AdminController
{
    public function __construct()
    {
        if (!Auth::check()) {
            header('location: /');
        }
    }
    public function admin()
    {
        return view('admin', 'Admin');
    }
    public function user()
    {
        layout('user');
        return view('user', 'User');
    }

    public function all()
    {
        $models = User::all();
        return view('user/task', 'tasks', $models);
    }
    public function members()
    {
        return view('members', 'Users');
    }
    public function status()
    {
        if (isset($_POST['true'])) {
            $id = $_POST['id'];
            $users = User::status($id,0);
            header('location: /members');

        } elseif (isset($_POST['false'])) {
            $id = $_POST['id'];
            $users = User::status($id,1);
            header('location: /members');

        }
    }
}

?>