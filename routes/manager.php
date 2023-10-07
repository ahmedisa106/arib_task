<?php

use App\Http\Controllers\Manager\Auth\AuthController;
use App\Http\Controllers\Manager\HomeController;
use App\Http\Controllers\Manager\TaskController;
use Illuminate\Support\Facades\Route;

/** managers routes **/


/**
 * guest routes
 */
Route::group(['middleware' => 'guest:manager'], function () {
    Route::view('manager/login', 'partials.manager.auth.login')->name('manager_login');
    Route::post('manager/login', [AuthController::class, 'login'])->name('manager.do_login');
});


/**
 * auth routes
 */
Route::group(['prefix' => 'manager', 'middleware' => 'auth:manager', 'as' => 'manager.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*Tasks Routes*/

    Route::group(['controller' => TaskController::class, 'prefix' => 'tasks', 'as' => 'tasks.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/data', 'ajaxData')->name('data');
        Route::post('/', 'store')->name('store');
        Route::get('/edit/{task}', 'edit')->name('edit')->middleware('can:edit-task,task');
        Route::put('/{task}', 'update')->name('update');
        Route::delete('{task}/delete', 'destroy')->name('delete');
    });
});
