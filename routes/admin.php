<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ShelveController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TransferProductController;

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

    Route::get('/technician', [TechnicianController::class, 'index'])->name('admin.technician');
    Route::get('/create-technician', [TechnicianController::class, 'create_technician'])->name('admin.create_technician');
    Route::get('/edit-technician/{id}', [TechnicianController::class, 'edit_technician'])->name('admin.edit_technician');
    Route::get('/delete-technician/{id}', [TechnicianController::class, 'delete_technician'])->name('admin.delete_technician');
    Route::post('/store-technician', [TechnicianController::class, 'store_technician'])->name('admin.store_technician');

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
    Route::post('/store-product-modal', [ProductController::class, 'store_product'])->name('admin.store_product');

    Route::post('change-password', [AdminController::class, 'change_password'])->name('admin.change_password');
    Route::post('update-profile', [AdminController::class, 'update_profile'])->name('admin.update_profile');
    Route::get('/edit-profile', [AdminController::class, 'index'])->name('admin.profile');

    Route::get('/branch', [BranchController::class, 'index'])->name('admin.branch');
    Route::get('/create-branch', [BranchController::class, 'create_branch'])->name('admin.create_branch');
    Route::get('/edit-branch/{id}', [BranchController::class, 'edit_branch'])->name('admin.edit_branch');
    Route::get('/delete-branch/{id}', [BranchController::class, 'delete_branch'])->name('admin.delete_branch');
    Route::post('/store-branch', [BranchController::class, 'store_branch'])->name('admin.store_branch');

    Route::get('/shelve', [ShelveController::class, 'index'])->name('admin.shelve');
    Route::get('/create-shelve', [ShelveController::class, 'create_shelve'])->name('admin.create_shelve');
    Route::get('/edit-shelve/{id}', [ShelveController::class, 'edit_shelve'])->name('admin.edit_shelve');
    Route::get('/delete-shelve/{id}', [ShelveController::class, 'delete_shelve'])->name('admin.delete_shelve');
    Route::post('/store-shelve', [ShelveController::class, 'store_shelve'])->name('admin.store_shelve');

    Route::get('/supplier', [SupplierController::class, 'index'])->name('admin.supplier');
    Route::get('/create-supplier', [SupplierController::class, 'create_supplier'])->name('admin.create_supplier');
    Route::get('/edit-supplier/{id}', [SupplierController::class, 'edit_supplier'])->name('admin.edit_supplier');
    Route::get('/delete-supplier/{id}', [SupplierController::class, 'delete_supplier'])->name('admin.delete_supplier');
    Route::post('/store-supplier', [SupplierController::class, 'store_supplier'])->name('admin.store_supplier');

    Route::get('/invoice', [InvoiceController::class, 'index'])->name('admin.invoice');
    Route::get('/new-invoice', [InvoiceController::class, 'create_invoice'])->name('admin.new_invoice');
    Route::post('/get-product-code', [InvoiceController::class, 'get_product_code'])->name('admin.get_product_code');
    Route::get('/edit-invoice/{id}', [InvoiceController::class, 'edit_invoice'])->name('admin.edit_invoice');
    Route::get('/delete-invoice/{id}', [InvoiceController::class, 'delete_invoice'])->name('admin.delete_invoice');
    Route::post('/store-invoice', [InvoiceController::class, 'store_invoice'])->name('admin.store_invoice');
    Route::get('/invoice-detail/{id}', [InvoiceController::class, 'invoice_detail'])->name('admin.invoice_detail');

    //transfer product 
    Route::get('/transfer-product', [TransferProductController::class, 'index'])->name('admin.transfer_product');
    Route::get('/get-branches', [TransferProductController::class, 'get_branches'])->name('admin.get_branches');
    Route::get('/get-shelves', [TransferProductController::class, 'get_shelves'])->name('admin.get_shelves');
    Route::get('/get-quantity', [TransferProductController::class, 'get_quantity'])->name('admin.get_quantity');
    Route::post('/store-transfer-products', [TransferProductController::class, 'store_transfer_products'])->name('admin.store_transfer_products');


    //transfer product history 
    
    Route::get('/transfer-product-history', [TransferProductController::class, 'transfer_product_history'])->name('admin.transfer_product_history');


    //find Products
    
    Route::get('/find-product/{product_id}', [ProductController::class, 'find_products'])->name('admin.find_products');
    Route::get('/autocomplete', [ProductController::class, 'autocomplete'])->name('admin.autocomplete');
    
}); 