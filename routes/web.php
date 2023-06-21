<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
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

Route::get('/', function () {
    return view('frontend.auth.login');
})->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::view('register', 'frontend.auth.register')->name('register');
Route::post('register.post', [AuthController::class, 'register'])->name('register.post');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});
Route::get('logout', [AuthController::class,'logout'])->name('logout');