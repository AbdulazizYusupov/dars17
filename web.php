<?php 

use App\Controllers\Authcontroller;
use App\Controllers\UserController;
use App\Controllers\AdminController;
use App\Routes\Route;

Route::get('/user',[UserController::class,'user']);
Route::get('/admin',[Admincontroller::class,'admin']);

Route::get('/login', [AuthController::class, "loginPage"]);
Route::get('/register',[Authcontroller::class, 'registerPage']);

Route::post('/login',[Authcontroller::class, 'login']);
Route::post('/register',[Authcontroller::class, 'register']);

Route::post('/task',[Authcontroller::class,'task']);
Route::get('/members',[Admincontroller::class,'members']);
Route::post('/status',[Admincontroller::class,'status']);