<?php

namespace App\Http\Controllers\Trips;

use App\Events\NewNotification;
use App\Events\NewNotificationTrip;
use App\Events\NewNotificationUser;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Package;
use App\Models\Passenger_trip;
use App\Models\Price;
use App\Models\Trip;
use App\Models\Vehicles;
use App\Providers\RouteServiceProvider;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'start_address' => $data['start_address'],
            'end_address' =>  $data['end_address'],
            'start_time' => $data['start_time'],
            // 'end_time'=> $data['end_time'],
            'driver_id' => $data['id'],
            'available_size' => $data['size'],
            'available_weight' => $data['weight'],
            'available_seats' => $data['seats'],
            'status_id' => '1',
        ]);
        $notification = Notification::create([
            'user_id' =>  Auth::user()->id,
            'trip_id' => $data['trip_id'],
            'trip_end' => $data['end_address'],
            'trip_type' => 'passenger',
            'message' => 'Track your trip to',
            'trip_status' => 'waiting',
            'date' => date("Y M d", time()),
            'clock' => date("h:i A", time()),
        ]);
        $notifi_data = [
            'user_id' =>  Auth::user()->id,
            'user_role' => Auth::user()->role_type,
            'trip_id' => $data['trip_id'],
            'trip_end' => $data['end_address'],
            'trip_type' => 'passenger',
            'message' => 'Track your trip to',
            'trip_status' => 'waiting',
            'date' => date("Y M d", time()),
            'clock' => date("h:i A", time()),

        ];


        event(new NewNotification($notifi_data));

        return redirect()->to('Trips_driver')->with(['success' => 'Trip announced successfuly check your notifications for more updates']);;
    }

    protected function store_passenger(Request $request)
    {
        $data = $request->all();
        $trip_id = $data['trip_id'];
        $driver_id = $data['driver_id'];
        $user_id = Auth::user()->id;


        $pp = Passenger_trip::where([["trip_id",  $data['trip_id']], ['passenger_id', $user_id]])->get();
        if (count($pp) === 0) {
            if (Auth::user()->role_type == 'USER')
                return redirect()->to('Trips')->with(['error' => 'You already booked this trip']);
            if (Auth::user()->role_type == 'DRIVER')
                return redirect()->to('Trips_driver')->with(['error' => 'You already booked this trip']);
        } else {
            $price = DB::select(DB::raw(" SELECT p.p4km,p.p4kg FROM `trip` t 
             JOIN drivers d ON d.driver_id=t.driver_id 
             JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
             JOIN vehicle_types vt ON vt.name=v.vehicle_type 
             JOIN prices p ON p.vehicle_type_id=vt.vehicle_type_id WHERE trip_id= $trip_id;"))[0];

            //  $price->p4km * $data['km'];
            Trip::where("trip_id", $data['trip_id'])->decrement('available_seats', $data['seat']);

            $passnger = Passenger_trip::create([
                'passenger_id' =>  Auth::user()->id,
                'trip_id' => $data['trip_id'],
                'seats_reserved' => $data['seat'],
                'start_point_longitude' => $data['start_long'],
                'start_point_latitude' => $data['start_lat'],
                'end_point_longitude' => $data['end_long'],
                'end_point_latitude' => $data['end_lat'],
                'start_address' => $data['start_address'],
                'end_address' =>  $data['end_address'],
                'km_distance' =>  $data['km'],
                'trip_cost' => $price->p4km * $data['km'],

            ]);
            $notification = Notification::create([
                'user_id' =>  Auth::user()->id,
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'passenger',
                'message' => 'Track your trip to',
                'trip_status' => 'waiting',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),
            ]);

            $notifi_data = [
                'user_id' =>  Auth::user()->id,
                'user_role' => Auth::user()->role_type,
                // 'driver_id'=>$data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'passenger',
                'message' => 'Track your trip to',
                'trip_status' => 'waiting',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),

            ];
            $notifi_data_driver = [
                'user_id' =>  Auth::user()->id,
                'user_role' => Auth::user()->role_type,
                'driver_id' => $data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'driver',
                'message' => 'new passenger booked your trip to',
                'trip_status' => 'waiting',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),

            ];
            $notification_driver = Notification::create([
                'user_id' => $data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'driver',
                'message' => 'new passenger booked your trip to',
                'trip_status' => 'waiting',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),
            ]);

            event(new NewNotificationTrip($notifi_data_driver));
            event(new NewNotification($notifi_data));
            if (Auth::user()->role_type == 'USER')
                return redirect()->to('Trips')->with(['success' => 'Trip booked successfuly check your notifications for more updates']);
            if (Auth::user()->role_type == 'DRIVER')
                return redirect()->to('Trips_driver')->with(['success' => 'Trip booked successfuly check your notifications for more updates']);
        }
    }

    protected function store_packages(Request $request)
    {
        $data = $request->all();
        $trip_id = $data['trip_id'];
        $user_id = Auth::user()->id;
        
        $pp = Package::where([["trip_id",  $data['trip_id']], ['sender_id', $user_id]])->get();
        if (count($pp) === 0) {
            if (Auth::user()->role_type == 'USER')
                return redirect()->to('Trips')->with(['error' => 'You already booked this trip']);
            if (Auth::user()->role_type == 'DRIVER')
                return redirect()->to('Trips_driver')->with(['error' => 'You already booked this trip']);
        } else {
            $price = DB::select(DB::raw(" SELECT p.p4km,p.p4kg FROM `trip` t 
         JOIN drivers d ON d.driver_id=t.driver_id 
         JOIN vehicles v ON v.vehicle_id=d.vehicle_id 
         JOIN vehicle_types vt ON vt.name=v.vehicle_type 
         JOIN prices p ON p.vehicle_type_id=vt.vehicle_type_id WHERE trip_id= $trip_id;"))[0];

            //$price->p4kg * $data['km'];
            if (($data['width'] * $data['height'] * $data['length']) > 0)
                Trip::where("trip_id", $data['trip_id'])->decrement('available_size', ($data['width'] * $data['height'] * $data['length']));
            else
                Trip::where("trip_id", $data['trip_id'])->decrement('available_size', 1);
            if ($data['weight'] > 0)

                Trip::where("trip_id", $data['trip_id'])->decrement('available_weight', $data['weight']);
            else
                Trip::where("trip_id", $data['trip_id'])->decrement('available_weight', 1);
            $package = Package::create([
                'weight' => $data['weight'],
                'width' => $data['width'],
                'height' => $data['height'],
                'length' => $data['length'],
                'start_point_longitude' => $data['start_long'],
                'start_point_latitude' => $data['start_lat'],
                'end_point_longitude' => $data['end_long'],
                'end_point_latitude' => $data['end_lat'],
                'start_address' => $data['start_address'],
                'end_address' =>  $data['end_address'],
                'trip_cost' => $price->p4kg * $data['weight'],
                'receiver_name' => $data['r_name'],
                'receiver_phone' => $data['r_phone'],
                'sender_id' =>  Auth::user()->id,
                'trip_id' => $data['trip_id'],
                'package_type' => $data['package_type'],

            ]);

            $notification = Notification::create([
                'user_id' =>  Auth::user()->id,
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'package',
                'message' => 'Track your trip to',
                'trip_status' => 'waiting',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),
            ]);
            $notifi_data = [
                'user_id' =>  Auth::user()->id,
                'user_role' => Auth::user()->role_type,
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'package',
                'message' => 'Track your trip to',
                'trip_status' => 'waiting',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),

            ];
            $notifi_data_driver = [
                'user_id' =>  Auth::user()->id,
                'user_role' => Auth::user()->role_type,
                'driver_id' => $data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'driver',
                'message' => 'new package booked to your trip to',
                'trip_status' => 'waiting',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),

            ];
            $notification_driver = Notification::create([
                'user_id' => $data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'driver',
                'message' => 'new package booked to your trip to',
                'trip_status' => 'waiting',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),
            ]);

            event(new NewNotificationTrip($notifi_data_driver));

            event(new NewNotification($notifi_data));
            if (Auth::user()->role_type == 'USER')
                return redirect()->to('Trips')->with(['success' => 'Trip booked successfuly check your notifications for more updates']);;
            if (Auth::user()->role_type == 'DRIVER')
                return redirect()->to('Trips_driver')->with(['success' => 'Trip booked successfuly check your notifications for more updates']);;
        }
    }

    protected function end_user_trip(Request $request)
    {
        $id =  Auth::user()->id;
        $data = $request->all();
        $passnger = Passenger_trip::where([["trip_id", $data['trip_id']], ['passenger_id', $id]])->update([
            'passenger_rating' => $data['stars'],
            'trip_status' =>  'ended',

        ]);
        if (Auth::user()->role_type == 'USER')
            return redirect()->to('Trips')->with(['success' => 'Trip ended thank you for your rating']);;
        if (Auth::user()->role_type == 'DRIVER')
            return redirect()->to('Trips_driver')->with(['success' => 'Trip ended thank you for your rating']);;
    }

    protected function cancel_user_trip(Request $request)
    {
        $data = $request->all();
        $id =  Auth::user()->id;
        $passnger = Passenger_trip::where([["trip_id", $data['trip_id']], ['passenger_id', $id]])->first()->seats_reserved;

        Trip::where("trip_id", $data['trip_id'])->increment('available_seats', $passnger);


        Passenger_trip::where([["trip_id", 1], ['passenger_id', $id]])->delete();

        $notifi_data_driver = [
            'user_id' =>  Auth::user()->id,
            'user_role' => Auth::user()->role_type,
            'driver_id' => $data['driver_id'],
            'trip_id' => $data['trip_id'],
            'trip_end' => $data['end_address'],
            'trip_type' => 'driver',
            'message' => 'a passenger cancelled the booking to your trip to',
            'trip_status' => 'waiting',
            'date' => date("Y M d", time()),
            'clock' => date("h:i A", time()),

        ];
        $notification_driver = Notification::create([
            'user_id' => $data['driver_id'],
            'trip_id' => $data['trip_id'],
            'trip_end' => $data['end_address'],
            'trip_type' => 'driver',
            'message' => 'a passenger cancelled the booking to your trip to',
            'trip_status' => 'waiting',
            'date' => date("Y M d", time()),
            'clock' => date("h:i A", time()),
        ]);

        event(new NewNotificationTrip($notifi_data_driver));
        if (Auth::user()->role_type == 'USER')
            return redirect()->to('Trips')->with(['success' => 'Trip cancelled successfuly']);;
        if (Auth::user()->role_type == 'DRIVER')
            return redirect()->to('Trips_driver')->with(['success' => 'Trip cancelled successfuly']);;
    }

    protected function end_package_trip(Request $request)
    {
        $id =  Auth::user()->id;
        $data = $request->all();
        $package = Package::where([["trip_id", $data['trip_id']], ['sender_id', $id]])->update([
            'sender_rating' => $data['stars'],
            'trip_status' =>  'ended',

        ]);
        if (Auth::user()->role_type == 'USER')
            return redirect()->to('Trips')->with(['success' => 'Trip ended successfuly thank you for your rating']);;
        if (Auth::user()->role_type == 'DRIVER')
            return redirect()->to('Trips_driver')->with(['success' => 'Trip ended successfuly thank you for your rating']);;
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

        $notifi_data_driver = [
            'user_id' =>  Auth::user()->id,
            'user_role' => Auth::user()->role_type,
            'driver_id' => $data['driver_id'],
            'trip_id' => $data['trip_id'],
            'trip_end' => $data['end_address'],
            'trip_type' => 'driver',
            'message' => 'a package sender cancelled the booking to your trip to',
            'trip_status' => 'waiting',
            'date' => date("Y M d", time()),
            'clock' => date("h:i A", time()),

        ];
        $notification_driver = Notification::create([
            'user_id' => $data['driver_id'],
            'trip_id' => $data['trip_id'],
            'trip_end' => $data['end_address'],
            'trip_type' => 'driver',
            'message' => 'a package sender cancelled the booking to your trip to',
            'trip_status' => 'waiting',
            'date' => date("Y M d", time()),
            'clock' => date("h:i A", time()),
        ]);

        event(new NewNotificationTrip($notifi_data_driver));
        if (Auth::user()->role_type == 'USER')
            return redirect()->to('Trips')->with(['success' => 'Trip cancelled successfuly']);;
        if (Auth::user()->role_type == 'DRIVER')
            return redirect()->to('Trips_driver')->with(['success' => 'Trip cancelled successfuly']);;
    }

    protected function end_driver_trip(Request $request)
    {
        $id =  Auth::user()->id;
        $data = $request->all();
        $trip = Trip::where([["trip_id", $data['trip_id']], ['driver_id', $id]])->update([
            //  'sender_rating' => $data['stars'],
            'status_id' =>  '4',

        ]);

        return redirect()->to('Trips_driver')->with(['success' => 'Trip ended']);;
    }

    protected function cancel_driver_trip(Request $request)
    {
        $data = $request->all();
        $id =  Auth::user()->id;
        $trip_id = $data['trip_id'];
        $passngers = DB::select(DB::raw("SELECT u.role_type, passenger_id  FROM passenger_trip p JOIN users u ON u.id=p.passenger_id where trip_id=$trip_id;"));
        //return $passngers[0]->role_type;
        //Passenger_trip::where("trip_id", $data['trip_id'])->get('passenger_id');
        $packages = DB::select(DB::raw("SELECT u.role_type, sender_id  FROM `package` pack JOIN users u ON u.id=pack.sender_id where trip_id=$trip_id;"));

        // Package::where("trip_id", $data['trip_id'])->get('sender_id');

        //   return count($passngers) + count($packages);

        for ($i = 0; $i < (count($passngers)); $i++) {
            print($passngers[$i]->passenger_id);
            $notifi_data = [
                'user_id' =>  $passngers[$i]->passenger_id,
                'user_role' =>  $passngers[$i]->role_type,
                // 'driver_id'=>$data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'passenger',
                'message' => 'Your driver cancelled the trip to',
                'trip_status' => 'cancelled',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),

            ];

            $notification = Notification::create([
                'user_id' =>  $passngers[$i]->passenger_id,
                'user_role' =>  $passngers[$i]->role_type,
                // 'driver_id'=>$data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'passenger',
                'message' => 'Your driver cancelled the trip to',
                'trip_status' => 'cancelled',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),
            ]);

            event(new NewNotificationUser($notifi_data));
        }

        for ($i = 0; $i < (count($packages)); $i++) {
            print($packages[$i]->sender_id);

            $notifi_data = [
                'user_id' => ($packages[$i]->sender_id),
                'user_role' => ($packages[$i]->role_type),
                // 'driver_id'=>$data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'package',
                'message' => 'Your driver cancelled the trip to',
                'trip_status' => 'cancelled',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),

            ];
            $notification = Notification::create([
                'user_id' => ($packages[$i]->sender_id),
                'user_role' => ($packages[$i]->role_type),
                // 'driver_id'=>$data['driver_id'],
                'trip_id' => $data['trip_id'],
                'trip_end' => $data['end_address'],
                'trip_type' => 'package',
                'message' => 'Your driver cancelled the trip to',
                'trip_status' => 'cancelled',
                'date' => date("Y M d", time()),
                'clock' => date("h:i A", time()),

            ]);

            event(new NewNotificationUser($notifi_data));
        }


        /* Passenger_trip::where("trip_id", $data['trip_id'])->update([
            'trip_status' =>  'canceled',

        ]);
        Package::where("trip_id", $data['trip_id'])->update([
            'trip_status' =>  'canceled',

        ]);


        Trip::where([["trip_id",  $data['trip_id']], ['driver_id', $id]])->update([
            'trip_status' =>  '3',

        ]);*/



        return redirect()->to('Trips_driver')->with(['success' => 'Trip cancelled successfuly']);;
    }

    protected function ongoing_trip(Request $request)
    {
        $data = $request->all();
        $id =  Auth::user()->id;
        return  Trip::where([["trip_id",  $data['trip_id']], ['driver_id', $id]])->update([
            'status_id' =>  '2',

        ]);
    }
}
