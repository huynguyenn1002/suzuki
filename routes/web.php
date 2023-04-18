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
        //LoginController
        Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('user.logout');

        //ContractController
        Route::get('/contract/list', [App\Http\Controllers\ContractController::class, 'getContractList'])->name('contract.list.get');
        Route::get('/contract/add', [App\Http\Controllers\ContractController::class, 'getContractForm'])->name('contract.form.get');
        Route::post('/contract/update', [App\Http\Controllers\ContractController::class, 'updateContract'])->name('contract.update');
        Route::post('/createContract', [App\Http\Controllers\ContractController::class, 'createContract'])->name('contract.form.register');
        Route::post('/contract/preview', [App\Http\Controllers\ContractController::class, 'previewContract'])->name('contract.preview');
        Route::get('/contract/detail', [App\Http\Controllers\ContractController::class, 'contractDetail'])->name('contract.detail');
        Route::post('/contract/contractExport', [App\Http\Controllers\ContractController::class, 'contractExport'])->name('contract.export');
        Route::get('/contract/show/{id}', [App\Http\Controllers\ContractController::class, 'printPreviewContract'])->name('contract.show');
        Route::post('/get-saler-phone', [App\Http\Controllers\ContractController::class, 'getSalerPhone'])->name('sale.phone.get');

        Route::get('get-district-info/', [App\Http\Controllers\ContractController::class, 'contractGetDistrictInfo'])->name('admin.contract-get-district');
        Route::get('get-ward-info/', [App\Http\Controllers\ContractController::class, 'contractGetWardInfo'])->name('admin.contract-get-ward');
        Route::post('get-type-car/', [App\Http\Controllers\ContractController::class, 'getTypeCar'])->name('car.type.get');
        
        //DashboardController
        Route::get('/list/user', [App\Http\Controllers\DashboardController::class, 'getListUser'])->name('user.get');
        Route::post('/user/add', [App\Http\Controllers\DashboardController::class, 'addNewUser'])->name('user.add');
        Route::post('/user/detail', [App\Http\Controllers\DashboardController::class, 'getUserDetail'])->name('user.detail');
        Route::post('/user/update', [App\Http\Controllers\DashboardController::class, 'updateUser'])->name('user.update');
        Route::post('/user/delete', [App\Http\Controllers\DashboardController::class, 'deleteUser'])->name('user.delete');
        Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'getProfile'])->name('admin.profile');
        Route::post('/profile/update', [App\Http\Controllers\DashboardController::class, 'updateProfile'])->name('admin.profile.update');
        Route::get('admin-district-info/', [App\Http\Controllers\DashboardController::class, 'adminGetDistrictInfo'])->name('admin.admin-get-district');
        Route::get('admin-ward-info/', [App\Http\Controllers\DashboardController::class, 'adminGetWardInfo'])->name('admin.admin-get-ward');

        //SalerController 
        Route::get('/list/saler', [App\Http\Controllers\SalerController::class, 'getListSaler'])->name('saler.get');
        Route::post('/saler/add', [App\Http\Controllers\SalerController::class, 'addNewSaler'])->name('saler.add');
        Route::post('/saler/detail', [App\Http\Controllers\SalerController::class, 'salerDetail'])->name('saler.detail');
        Route::post('/saler/delete', [App\Http\Controllers\SalerController::class, 'salerDelete'])->name('saler.delete');

        //CarController 
        Route::get('/list/car', [App\Http\Controllers\CarController::class, 'getListCar'])->name('car.get');
        Route::post('/car/add', [App\Http\Controllers\CarController::class, 'addNewCar'])->name('car.add');
        Route::post('/car/detail', [App\Http\Controllers\CarController::class, 'carDetail'])->name('car.detail');
        Route::post('/car/delete', [App\Http\Controllers\CarController::class, 'carDelete'])->name('car.delete');
    });
});


