<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        view()->composer('includes.header', function ($view) {
            
            
            
            $view->with('notifi',Auth::check() ? DB::select(DB::raw("SELECT * FROM `notifications` WHERE user_id='".Auth::user()->id."' ORDER BY date DESC,clock DESC;")) :[])
            ->with('count',Auth::check() ?  DB::select(DB::raw("SELECT COUNT(user_id) as counts FROM `notifications` WHERE user_id='".Auth::user()->id."';"))[0] :[]);
        });
    }
}
