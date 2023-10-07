<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/** admins routes **/
Route::get('/', function () {
    return redirect('/admin');
})->middleware('auth:admin');

/**
 * guest routes
 */
Route::group(['middleware' => 'guest:admin'], function () {
    Route::view('admin/login', 'partials.admin.auth.login')->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('do_login');
});


/**
 * auth routes
 */
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin', 'as' => 'admin.'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

    /** Managers Routes*/
    Route::group(['controller' => ManagerController::class, 'prefix' => 'managers', 'as' => 'managers.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/data', 'ajaxData')->name('data');
        Route::post('/', 'store')->name('store');
        Route::get('/edit/{manager}', 'edit')->name('edit');
        Route::put('/{manager}', 'update')->name('update');
        Route::delete('{manager}/delete', 'destroy')->name('delete');
    });

    /** Departments Routes*/
    Route::group(['controller' => DepartmentController::class, 'prefix' => 'departments', 'as' => 'departments.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/data', 'ajaxData')->name('data');
        Route::post('/', 'store')->name('store');
        Route::get('/edit/{department}', 'edit')->name('edit');
        Route::put('/{department}', 'update')->name('update');
        Route::delete('{department}/delete', 'destroy')->name('delete');
    });

    /** Departments Routes*/
    Route::group(['controller' => EmployeeController::class, 'prefix' => 'employees', 'as' => 'employees.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/data', 'ajaxData')->name('data');
        Route::post('/', 'store')->name('store');
        Route::get('/edit/{employee}', 'edit')->name('edit');
        Route::put('/{employee}', 'update')->name('update');
        Route::delete('{employee}/delete', 'destroy')->name('delete');
    });

});




