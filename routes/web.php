<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', [App\Http\Controllers\LoginController::class, 'getLoginForm'])->name('form.login.get');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'adminLogin'])->name('form.login.post');

Route::prefix('admin')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('/list/user', [App\Http\Controllers\DashboardController::class, 'getListUser'])->name('user.get');

        Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('user.logout');
    });
});