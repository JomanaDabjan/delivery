<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;

class Role {

  public function handle($request, Closure $next, ... $roles) {
    if (!Auth::check()) // This isnt necessary, it should be part of your 'auth' middleware
      return redirect('/home');

    $user = Auth::user();
    

      if($user->role_type =='ADMIN')
      return $next($request);

  foreach($roles as $role) {
      // here conditions Check if real time user has the role This check will your depend on how your roles (perfect true) are set up
      if($user->role_type =='USER')
      return $next($request);
      if($user->role_type =='DRIVER')
      return $next($request);
  }

    return redirect('/home');
  }
}