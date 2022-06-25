<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function services()
    {
        return view('services');
    }

    public function loginn()
    {
        return view('login');
    }
    public function signup()
    {
        return view('signup');
    }
    public function signup_driver()
    {
        return view('signup-driver');
    }
    public function signup_driver_car()
    {
        return view('signup-driver-car');
    }
}
