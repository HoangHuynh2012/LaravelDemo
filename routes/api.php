<?php

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// API Users
Route::get('getAllUsers', [UserController::class, "__getAll"]);
Route::post('addDataUser', [UserController::class, "__insert"]);
Route::post('updateDataUser', [UserController::class, "__update"]);
Route::post('deleteUser', [UserController::class, "__delete"]);
Route::post('findAddressUser', [UserController::class, "__findAddress"]);
//API login 
Route::post('registerUser', [UserController::class, "__register"]);
Route::post('loginUser', [UserController::class, "__login"]);
//API Category
Route::get('getAllCategory', [CategoryController::class, "__getAll"]);
Route::post('addDataCategory', [CategoryController::class, "__insert"]);
Route::post('updateCategory', [CategoryController::class, "__update"]);
Route::post('deleteCategory', [CategoryController::class, "__delete"]);
//API Product
Route::get('getAllProduct', [ProductController::class, "__getAll"]);
Route::post('addDataProduct', [ProductController::class, "__insert"]);
Route::post('updateProduct', [ProductController::class, "__update"]);
Route::post('deleteProduct', [ProductController::class, "__delete"]);
