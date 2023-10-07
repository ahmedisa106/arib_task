<?php

use App\Http\Controllers\Employee\Auth\AuthController;
use App\Http\Controllers\Employee\HomeController;
use App\Http\Controllers\Employee\TaskController;
use Illuminate\Support\Facades\Route;

/** employees routes **/

/**
 * guest routes
 */
Route::group(['middleware' => 'guest:employee'], function () {
    Route::view('employee/login', 'partials.employee.auth.login')->name('employee_login');
    Route::post('employee/login', [AuthController::class, 'login'])->name('employee.do_login');
});

/**
 * auth routes
 */
Route::group(['prefix' => 'employee', 'middleware' => 'auth:employee', 'as' => 'employee.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*Tasks Routes*/

    Route::group(['controller' => TaskController::class, 'prefix' => 'tasks', 'as' => 'tasks.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'ajaxData')->name('data');
        Route::get('/{id}', 'show')->name('show')->middleware('can:show-task,id');
        Route::post('/change-status/{id}', 'changeStatus')->name('change_status')->middleware('can:show-task,id');
    });
});
