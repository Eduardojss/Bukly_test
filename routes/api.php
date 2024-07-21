<?php

use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [UserController::class, 'getUserInfo'])->name('user.info');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::apiResource('/hotels', HotelController::class);
    Route::apiResource('/rooms', RoomController::class)->except('store');
    Route::post('/{hotel_id}/rooms', [RoomController::class, 'store'])->name('rooms.store');
});


Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
