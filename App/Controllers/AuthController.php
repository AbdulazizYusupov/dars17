<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Task;

class Authcontroller
{
    public function __construct()
    {
        layout('mainLogin');
    }
    public function loginpage()
    {
        return view('login', 'Login');
    }
    public function registerPage()
    {
        return view('register', 'Register');
    }
    public function login()
    {
        if (isset($_SESSION['message'])) {
            unset($_SESSION['message']);
        }
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];
        $user = User::attach($data);

        if ($user) {
            $_SESSION['Auth'] = $user;

            if ($user->role == 'admin') {
                header('location: /admin');
            }
            if ($user->role == 'user') {
                // dd(123);
                header('location: /user');
            }
        } else {
            $_SESSION['message'] = 'email or password incorrect';
            header('location: /login');
        }
    }

    public function register()
    {
        if (isset($_POST['ok'])) {
            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                if (isset($_SESSION['text'])) {
                    unset($_SESSION['text']);
                }
                $key = [
                    'email' => $_POST['email']
                ];
                $user = User::hasKey($key);
                if ($user) {
                    $_SESSION['text'] = "Bunday email oldin ro'yxatan o'tilgan";
                    header('location: /register');
                } else {
                    $data = [
                        'name' => $_POST['name'],
                        'email' => $_POST['email'],
                        'password' => $_POST['password'],
                    ];
                    $user = User::createUser($data);

                    if ($user) {
                        header("location: /login");
                    }
                    header('location: /register');
                }
            }
        }
    }
    public function task()
    {
        if (isset($_POST['ok'])) {
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $data = explode('.', $_FILES['rasm']['name']);
            $filePath = date('Y-m-d_H-i-s') . '.' . $data[1];
            move_uploaded_file($_FILES['rasm']['tmp_name'], 'img/' . $filePath);
            $user_id = $_POST['user_id'];
            
            $data = [
                'title' => $title,
                'description' => $desc,
                'user_id' => $user_id,
                'image' => $filePath,
                'status' =>  0,
                'comments' => ''
            ];
            Task::create($data);
            header("location: /admin");

        }
    }

}
