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
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', function () { return view('admin');});
Route::get('/admin/users', function () { return view('users');});
Route::get('/home/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/home/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/home/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/home/login', [App\Http\Controllers\HomeController::class, 'loginn'])->name('loginn');
Route::get('/home/signup', [App\Http\Controllers\HomeController::class, 'signup'])->name('signup');
Route::get('/home/signup_driver', [App\Http\Controllers\HomeController::class, 'signup_driver'])->name('signup_driver');
Route::get('/home/signup_driver_car', [App\Http\Controllers\HomeController::class, 'signup_driver_car'])->name('signup_driver_car');
