<?php

namespace App\Http\Controllers\Trips;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class TripsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
      
    }
   
    public function trips_user()
    {
        return view('Trips/book_trip');
    }
    public function trips_driver()
    {
        return view('Trips/book_trip_driver');
    }

    public function announce_trips()
    {
        return view('Trips/announce_trip');
    }
    
    public function book_trips_seat()
    {
        return view('Trips/book_trip_seat_form');
    }
    
    public function book_trips_package()
    {
        return view('Trips/book_trip_package_form');
    }
    
    public function track_trips_user()
    {
        return view('Trips/trip_track');
    }
    
    public function track_trips_driver()
    {
        return view('Trips/trip_track_driver');
    }
}
