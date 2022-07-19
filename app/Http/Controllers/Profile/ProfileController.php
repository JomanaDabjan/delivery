<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile_user()
    {
        return view('Profile/my_profile');
    }

    public function profile_driver()
    {
        return view('Profile/my_profile_driver');
    }

    public function profile_user_log()
    {
        return view('Profile/my_profile_log');
    }

    public function profile_driver_log()
    {
        return view('Profile/my_profile_log_driver');
    }

    public function profile_driver_vehicle()
    {
        return view('Profile/my_profile_driver_vehicle');
    }
}
