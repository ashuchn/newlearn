<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\QnaController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QuestionAnswerController;
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

Route::get('/', [AuthController::class, 'loginView'])->name('login');

Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::get('register', [AuthController::class, 'registerView'])->name('register');
Route::post('register.post', [AuthController::class, 'register'])->name('register.post');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('qna', [QnaController::class, 'index'])->name('qna.index');

});
Route::get('logout', [AuthController::class,'logout'])->name('logout');

/**
 * admin routes
 */

Route::group(['prefix' => 'admin'], function(){
    Route::get('login', [AdminAuthController::class,'login'])->name('admin.login');
    Route::post('login/post', [AdminAuthController::class,'loginPost'])->name('admin.loginPost');
    Route::middleware(['auth', 'checkUserRole'])->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('users',[UserController::class, 'index'])->name('users.index');
        Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('user/{id}/update', [UserController::class, 'update'])->name('user.update');
    });
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
});