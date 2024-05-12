<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\UserController;


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
// Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register.submit');


Route::get('/send-notification', [PushNotificationController::class, 'sendPushNotification']);
Route::get('/', function () {
    return view('register');
});
