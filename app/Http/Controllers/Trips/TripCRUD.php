<?php

namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Passenger_trip;
use App\Models\Trip;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TripCRUD extends Controller
{

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'user_name' => ['required', 'string', 'max:255', 'unique:users'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'numeric', 'unique:users'],
        ]);
    }

    protected function store_trip(Request $request)
    {


        $data = $request->all();
        //return $dataa = json_encode($data['start_address'], JSON_UNESCAPED_UNICODE);
        $trip = Trip::create([

            'start_point_longitude' => $data['start_long'],
            'start_point_latitude' => $data['start_lat'],
            'end_point_longitude' => $data['end_long'],
            'end_point_latitude' => $data['end_lat'],
            'start_address' =>  json_encode($data['start_address'], JSON_UNESCAPED_UNICODE),
            'end_address' => json_encode($data['end_address'], JSON_UNESCAPED_UNICODE),
            'start_time' => $data['start_time'],
            // 'end_time'=> $data['end_time'],
            'driver_id' => $data['id'],
            'available_size' => $data['size'],
            'available_weight' => $data['weight'],
            'available_seats' => $data['seats'],
            'status_id' => '1',
        ]);


        return redirect()->to('home');
    }

    protected function store_passenger(Request $request)
    {
        $data = $request->all();
        Trip::where("trip_id", $data['trip_id'])->decrement('available_seats', $data['seat']);

        $passnger = Passenger_trip::create([
            'passenger_id' =>  Auth::user()->id,
            'trip_id' => $data['trip_id'],
            'seats_reserved' => $data['seat'],
            'start_point_longitude' => $data['start_long'],
            'start_point_latitude' => $data['start_lat'],
            'end_point_longitude' => $data['end_long'],
            'end_point_latitude' => $data['end_lat'],
            'start_address' =>  json_encode($data['start_address'], JSON_UNESCAPED_UNICODE),
            'end_address' => json_encode($data['end_address'], JSON_UNESCAPED_UNICODE),
            'km_distance' => 55,
            'trip_cost' => 550,

        ]);
        return redirect()->to('home');
    }

    protected function store_packages(Request $request)
    {
        $data = $request->all();
        if (($data['width'] * $data['height'] * $data['length']) > 0)
            Trip::where("trip_id", $data['trip_id'])->decrement('available_size', ($data['width'] * $data['height'] * $data['length']));
        else
            Trip::where("trip_id", $data['trip_id'])->decrement('available_size', 1);
        if ($data['weight'] > 0)

            Trip::where("trip_id", $data['trip_id'])->decrement('available_weight', $data['weight']);
        else
            Trip::where("trip_id", $data['trip_id'])->decrement('available_weight', 1);
        $passnger = Package::create([
            'weight' => $data['weight'],
            'width' => $data['width'],
            'height' => $data['height'],
            'length' => $data['length'],
            'start_point_longitude' => $data['start_long'],
            'start_point_latitude' => $data['start_lat'],
            'end_point_longitude' => $data['end_long'],
            'end_point_latitude' => $data['end_lat'],
            'start_address' =>  json_encode($data['start_address'], JSON_UNESCAPED_UNICODE),
            'end_address' => json_encode($data['end_address'], JSON_UNESCAPED_UNICODE),
            'trip_cost' => 550,
            'receiver_name' => $data['r_name'],
            'receiver_phone' => $data['r_phone'],
            'sender_id' =>  Auth::user()->id,
            'trip_id' => $data['trip_id'],
            'package_type' => $data['package_type'],

        ]);
        return redirect()->to('home');
    }

    protected function end_user_trip(Request $request)
    {
        $id =  Auth::user()->id;
        $data = $request->all();
        $passnger = Passenger_trip::where([["trip_id", $data['trip_id']], ['passenger_id', $id]])->update([
            'passenger_rating' => $data['stars'],
            'trip_status' =>  'ended',

        ]);
        return redirect()->to('home');
    }

    protected function cancel_user_trip(Request $request)
    {
        $data = $request->all();
        $id =  Auth::user()->id;
        $passnger = Passenger_trip::where([["trip_id", $data['trip_id']], ['passenger_id', $id]])->first()->seats_reserved;

        Trip::where("trip_id", $data['trip_id'])->increment('available_seats', $passnger);


        return Passenger_trip::where([["trip_id", 1], ['passenger_id', $id]])->delete();
    }

    protected function end_package_trip(Request $request)
    {
        $id =  Auth::user()->id;
        $data = $request->all();
        $package = Package::where([["trip_id", $data['trip_id']], ['sender_id', $id]])->update([
            'sender_rating' => $data['stars'],
            'trip_status' =>  'ended',

        ]);
        return redirect()->to('home');
    }

    protected function cancel_package_trip(Request $request)
    {
        $data = $request->all();
        $id =  Auth::user()->id;
        $package_weight = Package::where([["trip_id", $data['trip_id']], ['sender_id', $id]])->first()->weight;
        $package_height = Package::where([["trip_id", $data['trip_id']], ['sender_id', $id]])->first()->height;
        $package_length = Package::where([["trip_id", $data['trip_id']], ['sender_id', $id]])->first()->length;
        $package_width = Package::where([["trip_id", $data['trip_id']], ['sender_id', $id]])->first()->width;

        Trip::where("trip_id", $data['trip_id'])->increment('available_weight', $package_weight);
        Trip::where("trip_id", $data['trip_id'])->increment('available_size', ($package_height * $package_length * $package_width));


        Package::where([["trip_id",  $data['trip_id']], ['sender_id', $id]])->delete();
        return redirect()->to('home');
    }

    protected function end_driver_trip(Request $request)
    {
        $id =  Auth::user()->id;
        $data = $request->all();
        $trip = Trip::where([["trip_id", $data['trip_id']], ['driver_id', $id]])->update([
            //  'sender_rating' => $data['stars'],
            'trip_status' =>  'ended',

        ]);
        return redirect()->to('home');
    }

    protected function cancel_driver_trip(Request $request)
    {
        $data = $request->all();
        $id =  Auth::user()->id;

        Passenger_trip::where("trip_id", $data['trip_id'])->update([
            'trip_status' =>  'canceled',

        ]);
        Package::where("trip_id", $data['trip_id'])->update([
            'trip_status' =>  'canceled',

        ]);


        Trip::where([["trip_id",  $data['trip_id']], ['driver_id', $id]])->update([
            'trip_status' =>  '3',

        ]);
        return redirect()->to('home');
    }
}
