<?php

use Illuminate\Support\Facades\Route; // version 8

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
    return view('welcome');
});

Route::get('test', 'TestingController@index'); // version 6
// Route::get('test',[TestingController::class,'index']); // version 8

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // return view('dashboard');
    if (Auth::check() && Auth::user()->role_id == 1) {
        return redirect('admin/dashboard');
    } elseif (Auth::check() && Auth::user()->role_id == 2) {
        return redirect()->route('userDashboard');
    }
})->name('dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'adminCheck'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('adminDashboard');
});

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'userCheck'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('userDashboard')->middleware('userCheck');
});
