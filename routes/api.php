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
    // Admin Api Routing
    Route::get('users', [UserController::class, 'showAll']);
    Route::post('user', [UserController::class, 'edit']);
    
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/user', function (Request $request) {return $request->user();});
});
