<?php

namespace App\Http\Controllers\Trips;

use App\Models\Driver;
use App\Models\Package_type;
use App\Models\Trip;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


    public function get_trips_all()
    {
        $trips = DB::select(DB::raw("SELECT t.*,v.vehicle_type,u.user_name 
        FROM `trip` t 
        JOIN drivers d ON d.driver_id=t.driver_id
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        WHERE t.status_id=1;"));
        return $trips;
    }

    public function get_trips_all_by_filter(Request $request)
    {
        $filter = $request->f;
        $trips = DB::select(DB::raw("SELECT t.*,v.vehicle_type,u.user_name 
        FROM `trip` t 
        JOIN drivers d ON d.driver_id=t.driver_id
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        WHERE t.status_id=1
        ORDER BY $filter;"));
        return $trips;
    }

    public function search(Request $request)
    {
        $keyword = $request->k;
        $search = DB::select(DB::raw("SELECT t.*,v.vehicle_type,u.user_name 
        FROM `trip` t 
        JOIN drivers d ON d.driver_id=t.driver_id
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        WHERE t.start_address like concat('%','$keyword','%') OR t.end_address LIKE concat('%','$keyword','%') AND t.status_id=1;"));
        return $search;
    }




    public function getbyid(Request $request)
    {
        $id = $request->id;
        $trips = DB::select(DB::raw("SELECT t.*,v.vehicle_type,u.user_name 
        FROM `trip` t 
        JOIN drivers d ON d.driver_id=t.driver_id
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id
        JOIN users u ON u.id=d.driver_id where trip_id=$id;"));
        return $trips;
    }

    public function trips_driver()
    {
        return view('Trips/book_trip_driver');
    }

    public function get_trips_all_driver()
    {
        $id = Auth::user()->id;
        $trips = DB::select(DB::raw("SELECT t.*,v.vehicle_type,u.user_name 
        FROM `trip` t 
        JOIN drivers d ON d.driver_id=t.driver_id
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        WHERE t.status_id=1 AND d.driver_id !=$id;"));
        return $trips;
    }

    public function get_trips_all_by_filter_driver(Request $request)
    {
        $id = Auth::user()->id;
        $filter = $request->f;
        $trips = DB::select(DB::raw("SELECT t.*,v.vehicle_type,u.user_name 
        FROM `trip` t 
        JOIN drivers d ON d.driver_id=t.driver_id
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        WHERE t.status_id=1 AND d.driver_id !=$id
        ORDER BY $filter;"));
        return $trips;
    }

    public function search_driver(Request $request)
    {
        $id = Auth::user()->id;
        $keyword = $request->k;
        $search = DB::select(DB::raw("SELECT t.*,v.vehicle_type,u.user_name 
        FROM `trip` t 
        JOIN drivers d ON d.driver_id=t.driver_id
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        WHERE t.start_address like concat('%','$keyword','%') OR t.end_address LIKE concat('%','$keyword','%') 
        AND t.status_id=1
        AND d.driver_id !=$id;"));
        return $search;
    }

    public function announce_trips()
    {
        $id = Auth::user()->id;
        $id2 = Driver::where('driver_id', $id)->first()->vehicle_id;
        $vehicle = Vehicles::where('vehicle_id', $id2)->first();


        return view('Trips/announce_trip', ['vehicle' => $vehicle]);
    }

    public function book_trips_seat(Request $request)
    {

        $trip = Trip::where('trip_id', $request->id)->first();
        return view('Trips/book_trip_seat_form', ['id' => $request->id, 'trip' => $trip]);
    }

    public function book_trips_package(Request $request)
    {
        $trip = Trip::where('trip_id', $request->id)->first();
        $package_type = Package_type::get();
        return view('Trips/book_trip_package_form', ['id' => $request->id, 'trip' => $trip, 'package_type' => $package_type]);
    }

    public function track_trips_user()
    {
        return view('Trips/trip_track');
    }

    public function get_passenger_track(Request $request)
    {
        $id = Auth::user()->id;
        $trip_id = $request->id;
        return  $trip = DB::select(DB::raw("SELECT tp.*,t.start_time,v.*,u.user_name,ifnull(c.counts,0) passengers,t.start_point_longitude s_lng ,t.start_point_latitude s_lat ,t.end_point_longitude e_lng ,t.end_point_latitude e_lat ,ifnull(pp.counts,0) packages
        FROM `passenger_trip` tp 
        JOIN trip t ON t.trip_id=tp.trip_id
        JOIN drivers d ON d.driver_id=t.driver_id 
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        left JOIN(SELECT p.trip_id,COUNT(id) counts FROM passenger_trip p WHERE p.trip_id=$trip_id GROUP BY p.trip_id)as c ON c.trip_id=tp.trip_id
        left JOIN(SELECT p.trip_id,COUNT(p.package_id) counts FROM package p WHERE p.trip_id=$trip_id GROUP BY p.trip_id)as pp ON c.trip_id=tp.trip_id
        where  tp.trip_id=$trip_id AND tp.passenger_id=$id;"));
    }

    public function get_passengers_trip(Request $request)
    {
        $trip_id = $request->id;
        return  $trip = DB::select(DB::raw("SELECT trip_id,package_id as id, start_point_latitude,start_point_longitude,end_point_latitude,pack.end_point_longitude FROM `package` pack where trip_id=$trip_id
        UNION
        SELECT trip_id,p.id as id,start_point_latitude,start_point_longitude,end_point_latitude,end_point_longitude FROM `passenger_trip` p where trip_id=$trip_id
        ORDER BY trip_id;"));
    }

    public function track_trips_user_package()
    {
        return view('Trips/trip_track_package');
    }

    public function get_package_track(Request $request)
    {
        $id = Auth::user()->id;
        $trip_id = $request->id;
        return  $trip = DB::select(DB::raw("SELECT p.*,t.start_time,v.*,u.user_name,ifnull(c.counts,0) passengers,t.start_point_longitude s_lng ,t.start_point_latitude s_lat ,t.end_point_longitude e_lng ,t.end_point_latitude e_lat ,ifnull(pp.counts,0) packages
        FROM `package` p 
        JOIN trip t ON t.trip_id=p.trip_id
        JOIN drivers d ON d.driver_id=t.driver_id 
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        left JOIN(SELECT p.trip_id,COUNT(id) counts FROM passenger_trip p WHERE p.trip_id=$trip_id GROUP BY p.trip_id)as c ON c.trip_id=p.trip_id
        left JOIN(SELECT p.trip_id,COUNT(p.package_id) counts FROM package p WHERE p.trip_id=$trip_id GROUP BY p.trip_id)as pp ON c.trip_id=p.trip_id
        where  p.trip_id=$trip_id AND p.sender_id=$id;"));
    }

    public function get_package_trip(Request $request)
    {
        $trip_id = $request->id;
        return  $trip = DB::select(DB::raw("SELECT trip_id,package_id as id, start_point_latitude,start_point_longitude,end_point_latitude,pack.end_point_longitude FROM `package` pack where trip_id=$trip_id
        UNION
        SELECT trip_id,p.id as id,start_point_latitude,start_point_longitude,end_point_latitude,end_point_longitude FROM `passenger_trip` p where trip_id=$trip_id
        ORDER BY trip_id;"));
    }
    public function track_trips_driver()
    {
        return view('Trips/trip_track_driver');
    }

    public function get_driver_track(Request $request)
    {
        $id = Auth::user()->id;
        $trip_id = $request->id;
        return  $trip = DB::select(DB::raw("SELECT t.start_time,v.*,u.user_name,ifnull(c.counts,0) passengers,t.start_point_longitude s_lng ,t.start_point_latitude s_lat ,t.end_point_longitude e_lng ,t.end_point_latitude e_lat ,ifnull(pp.counts,0) packages
        FROM trip t 
        JOIN drivers d ON d.driver_id=t.driver_id 
        JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
        JOIN users u ON u.id=d.driver_id
        left JOIN(SELECT p.trip_id,COUNT(id) counts FROM passenger_trip p WHERE p.trip_id=$trip_id GROUP BY p.trip_id)as c ON c.trip_id=t.trip_id
        left JOIN(SELECT p.trip_id,COUNT(p.package_id) counts FROM package p WHERE p.trip_id=$trip_id GROUP BY p.trip_id)as pp ON c.trip_id=t.trip_id
        where  t.trip_id=$trip_id AND t.driver_id=$id;"));
    }

    public function get_driver_trip(Request $request)
    {
        $trip_id = $request->id;
        return  $trip = DB::select(DB::raw("SELECT 'package'AS name,start_address, trip_id,package_id as id,trip_cost, start_point_latitude,start_point_longitude,end_point_latitude,pack.end_point_longitude FROM `package` pack where trip_id=21
        UNION
        SELECT 'passenger' as name,start_address,trip_id,p.id as id,trip_cost,start_point_latitude,start_point_longitude,end_point_latitude,end_point_longitude FROM `passenger_trip` p where trip_id=21
        ORDER BY trip_id;"));
    }
}
