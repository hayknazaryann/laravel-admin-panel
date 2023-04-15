<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin');
});


Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, "showLoginForm"])->name('admin.login');
    Route::post('login', [LoginController::class, "login"]);
    Route::post('logout', [LoginController::class, "logout"])->name('admin.logout');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('', [DashboardController::class, 'index'])->name('admin');
        Route::resource('companies', CompaniesController::class);
        Route::resource('employees', EmployeesController::class);
    });
});
