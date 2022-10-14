<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//* GET
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('order/list', [RouteController::class, 'orderList']);
Route::get('user/list', [RouteController::class, 'userList']);
Route::get('contact/list', [RouteController::class, 'contactList']);
Route::get('category/details/{id}', [RouteController::class, 'categoryDetails']);
// Route::get('delete/category/{id}', [RouteController::class, 'deleteCategory']);

//* POST
Route::post('create/category', [RouteController::class, 'createCategory']);
Route::post('create/contact', [RouteController::class, 'createContact']);
Route::post('delete/category', [RouteController::class, 'deleteCategory']);
Route::post('update/category', [RouteController::class, 'updateCategory']);

/**
 *
 * product list/ category list
 * 127.0.0.1:8000/api/product/list (GET)
 *
 * order list
 * 127.0.0.1:8000/api/order/list (GET)
 *
 * user list/ contact list
 * 127.0.0.1:8000/api/user/list (GET)
 *
 * contact list
 * 127.0.0.1:8000/api/contact/list (GET)
 *
 * create category
 * 127.0.0.1:8000/api/create/category (POST)
 * body{
 *      name : ''
 * }
 *
 * category details
 * 127.0.0.1:8000/api/category/details/{id} (GET)
 *
 * delete category
 * 127.0.0.1:8000/api/delete/category (POST)
 *
 * update category
 * 127.0.0.1:8000/api/update/category (POST)
*/
