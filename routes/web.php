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

Route::group(['prefix'=>'home'],function(){
    Route::get('/', [App\Http\Controllers\Front\FrontController::class, 'index'])->name('home');
    Route::get('/about', [App\Http\Controllers\Front\FrontController::class,'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\Front\FrontController::class, 'contact'])->name('contact');
Route::get('/services', [App\Http\Controllers\Front\FrontController::class, 'services'])->name('services');
Route::get('/login', [App\Http\Controllers\Front\FrontController::class, 'login'])->name('login');
Route::get('/signup', [App\Http\Controllers\Front\FrontController::class, 'signup'])->name('signup');
Route::get('/signup_driver', [App\Http\Controllers\Front\FrontController::class, 'signup_driver'])->name('signup_driver');
Route::get('/signup_driver_car', [App\Http\Controllers\Front\FrontController::class, 'signup_driver_car'])->name('signup_driver_car');

});

Route::get('/test', function () { return view('test');})->name('test');
Route::get('/admin', function () { return view('admin');});
Route::get('/admin/users', function () { return view('users');});
