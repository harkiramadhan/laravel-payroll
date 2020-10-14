<?php

use App\Http\Controllers\UserController;
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

Route::post('login', [UserController::class, 'login']);
Route::get('login', [UserController::class, 'index'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::put('user', [UserController::class, 'update']);
    Route::get('user', [UserController::class, 'showAll']);
    Route::post('user', [UserController::class, 'store']);
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::delete('user/{id}', [UserController::class, 'destroy']);
});
