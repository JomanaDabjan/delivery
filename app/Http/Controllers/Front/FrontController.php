<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class FrontController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }
    public function about()
    {
        return view('Front/about');
    }

    public function contact()
    {
        return view('Front/contact');
    }

    public function services()
    {
        return view('Front/services');
    }

   
    public function register_driver()
    {
        return view('Auth/register_driver');
    }
    public function signup_driver_car()
    {
        return view('Front/signup-driver-car');
    }
}
