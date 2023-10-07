<?php

use App\Http\Controllers\Api\Admin\Auth\AuthController;
use App\Http\Controllers\Api\Admin\ManagerController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api', 'guest:admin_api'], 'prefix' => 'admin'], function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth:admin_api'], 'prefix' => 'admin'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'managers', 'controller' => ManagerController::class], function () {
        Route::get('/', 'getAll');
    });
});
