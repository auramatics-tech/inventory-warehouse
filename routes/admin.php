<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
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
Route::post('/', [LoginController::class, 'authenticate'])->name('admin.login');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
    Route::get('/create-user', [UserController::class, 'create_user'])->name('admin.create_user');
    Route::get('/edit-user/{id}', [UserController::class, 'edit_user'])->name('admin.edit_user');
    Route::get('/delete-user/{id}', [UserController::class, 'delete_user'])->name('admin.delete_user');
    Route::post('/store-user', [UserController::class, 'store_user'])->name('admin.store_user');

    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/create-category', [CategoryController::class, 'create_category'])->name('admin.create_category');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit_category'])->name('admin.edit_category');
    Route::get('/delete-category/{id}', [CategoryController::class, 'delete_category'])->name('admin.delete_category');
    Route::post('/store-category', [CategoryController::class, 'store_category'])->name('admin.store_category');

    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/create-product', [ProductController::class, 'create_product'])->name('admin.create_product');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit_product'])->name('admin.edit_product');
    Route::get('/delete-product/{id}', [ProductController::class, 'delete_product'])->name('admin.delete_product');
    Route::post('/store-product', [ProductController::class, 'store_product'])->name('admin.store_product');
});