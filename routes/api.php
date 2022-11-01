<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    // User Management
    Route::get('profile', [UserController::class, 'get_current_user_profile']);
    Route::post('profile/update', [UserController::class, 'update_user_profile']);
    Route::post('password/update', [UserController::class, 'update_password']);

    //Roles Management
    Route::get('user/roles', [UserController::class, 'get_user_roles']);

    //Product Management
    Route::get('products', [ProductController::class, 'get_all_products']);
    Route::get('user/products', [ProductController::class, 'get_user_products']);
    Route::post('product/add', [ProductController::class, 'add_product']);
    Route::post('product/update', [ProductController::class, 'edit_product']);
    Route::post('product/delete', [ProductController::class, 'delete_product']);
    Route::post('user/products/assign', [ProductController::class, 'assign_product_to_user']);

});

