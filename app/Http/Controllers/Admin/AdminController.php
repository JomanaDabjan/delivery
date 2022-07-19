<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
      
    }
   
    public function admin()
    {
        return view('admin');
    }
    public function drivers()
    {
        return view('Admin/drivers');
    }

    public function management()
    {
        return view('Admin/management');
    }

    public function packages()
    {
        return view('Admin/packages');
    }

    public function trips()
    {
        return view('Admin/trips');
    }

    public function users()
    {
        return view('Admin/users');
    }

    public function vehicles()
    {
        return view('Admin/vehicles');
    }
}
