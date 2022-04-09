<?php

use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\Product\ProductController;
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

/**
 * Authentication
 */
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('user', [AuthController::class, 'authUser'])->name('user');

/**
 * Products
 */
Route::resource('products', ProductController::class, ['except' => ['create', 'edit']]);
Route::delete('products', [ProductController::class, 'multipleDestroy'])->name('products.multiple_destroy');
