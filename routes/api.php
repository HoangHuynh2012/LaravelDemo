<?php

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('getAllUsers', [UserController::class, "__getAll"]);
Route::post('addDataUser', [UserController::class, "__insert"]);
Route::post('updateDataUser', [UserController::class, "__update"]);
Route::post('deleteUser', [UserController::class, "__delete"]);
Route::post('findAddressUser', [UserController::class, "__findAddress"]);
