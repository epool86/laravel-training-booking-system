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

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::group(['prefix' => '/app', 'as' => 'app.', 'middleware' => ['auth']], function(){

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('booking', 'App\Http\Controllers\User\BookingController');

    Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['check_admin']], function(){

        Route::get('/booking/pdf',[App\Http\Controllers\Admin\BookingController::class, 'pdf'])->name('booking.pdf');
        Route::get('/dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
        Route::resource('user', 'App\Http\Controllers\Admin\UserController');
        Route::resource('room', 'App\Http\Controllers\Admin\RoomController');
        Route::resource('booking', 'App\Http\Controllers\Admin\BookingController');
        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');

    });

});

Auth::routes(); //"login, register, password reset"


