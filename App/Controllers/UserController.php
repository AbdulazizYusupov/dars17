<?php
namespace App\Controllers;

use App\Helpers\Auth;
use App\Models\User;

class UserController
{
    public function __construct()
    {
        // dd('user', Auth::check());
        if (!Auth::check()) {
            header('location: /login');
        }
        layout('user');
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
        return $models;
    }
    public function create()
    {
        if (isset($_POST['ok'])) {
            $data = [
                'name' => $_POST['name'],
            ];
            User::create($data);
            header('location: /janr');
        }
    }
    public function delete()
    {
        if (isset($_POST['ok'])) {
            $id = $_POST['id'];
            User::delete($id);
            header('location: /janr');
        }
    }
    public function show()
    {
        if (isset($_POST['ok'])) {
            $id = $_POST['id'];
            $models = User::show($id);
            return view('Janr/show', 'Show', $models);
        }
    }
    public function edit()
    {
        if (isset($_POST['ok'])) {
            $id = $_POST['id'];
            $models = User::show($id);
            return view('Janr/edit', 'Edit', $models);
        }
    }
    public function update()
    {
        if (isset($_POST['ok'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            user::update($id, $name);
        }
        header('location: /janr');
    }
}

?>