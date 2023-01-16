<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('admin-panel', [LoginController::class, 'index'])->name('admin.home');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'show_forgot_password'])->name("show_forgot_password");
Route::post('forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'get_password_link'])->name("get_password_link");
