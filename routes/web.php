<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


//main
Route::get('/', function () {
    return redirect()->to('home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\Front\FrontController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\Front\FrontController::class, 'contact'])->name('contact');
Route::get('/services', [App\Http\Controllers\Front\FrontController::class, 'services'])->name('services');
Route::get('/register_driver', [App\Http\Controllers\Front\FrontController::class, 'register_driver'])->name('register_driver');


//trips USER
Route::get('/Trips', [App\Http\Controllers\Trips\TripsController::class, 'trips_user'])->name('trips')->middleware('role:USER');
Route::group(['prefix' => 'Trips', 'middleware' => ['role:DRIVER', 'role:USER']], function () {

    Route::get('/track_trip', [App\Http\Controllers\Trips\TripsController::class, 'track_trips_user'])->name('track_trips_user');
    Route::get('/book_seat', [App\Http\Controllers\Trips\TripsController::class, 'book_trips_seat'])->name('book_seat');
    Route::get('/book_trips_package', [App\Http\Controllers\Trips\TripsController::class, 'book_trips_package'])->name('book_package');
});

//trips DRIVER
Route::group(['prefix' => 'Trips_driver', 'middleware' => 'role:DRIVER'], function () {
    Route::get('/', [App\Http\Controllers\Trips\TripsController::class, 'trips_driver'])->name('trips_driver');
    Route::get('/announce_trip', [App\Http\Controllers\Trips\TripsController::class, 'announce_trips'])->name('announce_trip');
    Route::get('/track_trip', [App\Http\Controllers\Trips\TripsController::class, 'track_trips_driver'])->name('track_trips_driver');
});



//insert user data
Auth::routes();
Route::post('store_user', [App\Http\Controllers\Auth\RegisterController::class, 'store_user'])->name('store_user');
Route::post('store_driver', [App\Http\Controllers\Auth\RegisterController::class, 'store_driver'])->name('store_driver');


//profile USER
Route::group(['prefix' => 'home', 'middleware' => 'role:USER'], function () {
    Route::get('/my_profile', [App\Http\Controllers\Profile\ProfileController::class, 'profile_user'])->name('my_profile');
    Route::get('/my_profile/log', [App\Http\Controllers\Profile\ProfileController::class, 'profile_user_log'])->name('my_profile/log');
});


//profile DRIVER
Route::group(['prefix' => 'home', 'middleware' => 'role:DRIVER'], function () {
    Route::get('/my_profile_driver', [App\Http\Controllers\Profile\ProfileController::class, 'profile_driver'])->name('my_profile_driver');
    Route::get('/my_profile_driver/log', [App\Http\Controllers\Profile\ProfileController::class, 'profile_driver_log'])->name('my_profile_driver/log');
    Route::get('/my_profile_driver/vehicle', [App\Http\Controllers\Profile\ProfileController::class, 'profile_driver_vehicle'])->name('my_profile_driver/vehicle');
});


//admin
Route::group(['prefix' => 'admin', 'middleware' => 'role:ADMIN'], function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'admin'])->name('admin');
    Route::get('/drivers', [App\Http\Controllers\Admin\AdminController::class, 'drivers'])->name('drivers');
    Route::get('/management', [App\Http\Controllers\Admin\AdminController::class, 'management'])->name('management');
    Route::get('/packages', [App\Http\Controllers\Admin\AdminController::class, 'packages'])->name('packages');
    Route::get('/trips_log', [App\Http\Controllers\Admin\AdminController::class, 'trips'])->name('trips_log');
    Route::get('/users', [App\Http\Controllers\Admin\AdminController::class, 'users'])->name('users');
    Route::get('/vehicles', [App\Http\Controllers\Admin\AdminController::class, 'vehicles'])->name('vehicles');
});


Route::get('fillable', [App\Http\Controllers\Auth\RegisterController::class, 'get']);
