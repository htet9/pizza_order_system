<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAccController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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

//* login, register
Route::middleware(['admin_auth'])->group(function() {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {

    //* dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['admin_auth'])->group(function() {
        //* category
        Route::prefix('category')->group(function() {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('category#update');
        });

        //* admin account
        Route::prefix('admin')->group(function() {
            Route::get('password/resetPage', [AdminController::class, 'resetPage'])->name('password#resetPage');
            Route::post('reset/password', [AdminController::class, 'resetPassword'])->name('password#reset');

            //* profile
            Route::get('details', [AdminController::class, 'details'])->name('admin#info');
            Route::get('edit', [AdminController::class, 'edit'])->name('admin#edit');
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');

            //* admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changeRole', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            // Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            // Route::post('change/role/{id}', [AdminController::class, 'change'])->name('admin#change');
        });

        //* products
        Route::prefix('products')->group(function() {
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('create', [ProductController::class, 'createPage'])->name('product#create');
            Route::post('create', [ProductController::class, 'create'])->name('pizza#create');
            Route::get('details/{id}', [ProductController::class, 'details'])->name('pizza#details');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('pizza#delete');
            Route::get('edit/{id}', [ProductController::class, 'editPage'])->name('pizza#edit');
            Route::post('update', [ProductController::class, 'update'])->name('pizza#update');
        });

        //* orders
        Route::prefix('order')->group(function() {
            Route::get('list', [OrderController::class, 'orderList'])->name('admin#orderList');
            Route::get('change/status', [OrderController::class, 'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status', [OrderController::class, 'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('list/info/{orderCode}', [OrderController::class, 'listInfo'])->name('admin#listInfo');
        });

        //* user list
        Route::prefix('user')->group(function() {
            Route::get('list', [UserAccController::class, 'userList'])->name('admin#userList');
            Route::get('change/role', [UserAccController::class, 'userChangeRole'])->name('admin#userChangeRole');
            Route::get('delete/{id}', [UserAccController::class, 'userDelete'])->name('admin#userDelete');
        });

        //* contact messages
        Route::prefix('contact')->group(function() {
            Route::get('list', [ContactController::class, 'contactList'])->name('admin#contactList');
        });
    });

    //* user
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function() {
        Route::get('/home', [UserController::class, 'home'])->name('user#home');
        Route::get('/contact', [ContactController::class, 'contact'])->name('user#contact');
        Route::post('/contact', [ContactController::class, 'contactForm'])->name('user#contactForm');
        Route::get('/filter/{id}', [UserController::class, 'filter'])->name('user#filter');

        Route::prefix('product')->group(function() {
            Route::get('details/{id}', [UserController::class, 'pizzaDetails'])->name('user#pizzaDetails');
            Route::get('order/history', [UserController::class, 'cartHistory'])->name('user#cartHistory');
        });

        Route::prefix('cart')->group(function() {
            Route::get('list', [UserController::class, 'cartList'])->name('user#cartList');
        });

        Route::prefix('password')->group(function() {
            Route::get('change', [UserController::class, 'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change', [UserController::class, 'changePassword'])->name('user#changePassword');
        });

        Route::prefix('account')->group(function() {
            Route::get('change', [UserController::class, 'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}', [UserController::class, 'accountChange'])->name('user#accountChange');
        });

        //* ajax
        Route::prefix('ajax')->group(function() {
            Route::get('pizza/list', [AjaxController::class, 'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('delete/item', [AjaxController::class, 'deleteItem'])->name('ajax#deleteItem');
            Route::get('increase/viewCount', [AjaxController::class, 'increaseViewCount'])->name('ajax#increaseViewCount');
        });
    });

});
