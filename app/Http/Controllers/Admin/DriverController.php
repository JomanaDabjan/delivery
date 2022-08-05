<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicles;
use Faker\Core\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function __construct()
    {
    }

    public function create()
    {

        //view form to add this driver
        return view('Admin.drivers');
    }

    protected function store(Request $request)
    {
        //save driver in DB using AJAX


       $data = $request->all();
       $vehicle = Vehicles::create([
        'brand' => $data['brand'],
        'model' =>  $data['model'],
        'license_num' =>  $data['license_num'],
        'color' =>  $data['color'],
        'insurance_type' => $data['insurance_type'],
        'passenger_count' =>  $data['passenger_count'],
        'vehicle_type' => $data['vehicle_type'],
        'max_load_size' => $data['max_load_size'],
        'max_load_weight' => $data['max_load_weight'],
    ]);
    
    $user = User::create([
        'user_name' => $data['user_name'],
        'full_name' => $data['full_name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'phone' => $data['phone'],
        'role_type' => 'DRIVER',
    ]);

    $id_photo = $request->id_photo;
    $file_name_id = date("Y-m-d",time()) . '_' . $user['user_name'] . '.' . $id_photo->getClientOriginalExtension();
    $path_ID = 'images/ID';
    $request->id_photo->move($path_ID, $file_name_id);

    $license = $request->license;
    $file_name_license = date("Y-m-d",time()) . '_' . $user['user_name'] . '.' . $license->getClientOriginalExtension();
    $path_license = 'images/License';
    $request->license->move($path_license, $file_name_license);



    $driver = Driver::create([
        'driver_id' => $user['id'],
        'id_photo' =>$file_name_id,
        'license' =>  $file_name_license,
        'vehicle_id' => $vehicle['id'],
    ]);



        return response()->json(['driver' => $driver]);
    }

    // protected function validator(Request $request)
    // {
    //     return Validator::make($request->all(), [
    //         'user_name' => ['required', 'string', 'max:255', 'unique:users'],
    //         'full_name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:6', 'confirmed'],
    //         'phone' => ['required', 'numeric', 'unique:users'],
    //     ]);
    // }


    public function show($id)
    {
       
        $driver = DB::select(DB::raw("SELECT d.*,u.* FROM `drivers` d  JOIN users u ON u.id=d.driver_id;"));
        return response()->json(['driver' => $driver]);
    }

    protected function update(Request $request)
    {
        //save driver in DB using AJAX
        $user = User::find($request->id);
        $data = $request->all();
        if (array_key_exists('u_id_photo', $data) && array_key_exists('u_license', $data)) {
            $user = User::where("id", $data['u_id'])->update([
                'user_name' => $data['user_name'],
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
        $id_photo = $request->u_id_photo;
            $file_name_id = date("Y-m-d", time()) . '_' . $data['user_name'] . '.' . $id_photo->getClientOriginalExtension();
            $path_ID = 'images/ID';
            $request->u_id_photo->move($path_ID, $file_name_id);

            $license = $request->u_license;
            $file_name_license = date("Y-m-d", time()) . '_' . $data['user_name'] . '.' . $license->getClientOriginalExtension();
            $path_license = 'images/License';
            $request->u_license->move($path_license, $file_name_license);


        $driver = Driver::where("driver_id", $data['u_id'])->update([
            'id_photo' => $file_name_id,
            'license' =>  $file_name_license,

        ]);
        return response()->json(['driver' => $driver]);
    } elseif (!array_key_exists('u_id_photo', $data) && array_key_exists('u_license', $data)) {
        $user = User::where("id", $data['u_id'])->update([
            'user_name' => $data['user_name'],
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        $license = $request->u_license;
            $file_name_license = date("Y-m-d", time()) . '_' . $data['user_name'] . '.' . $license->getClientOriginalExtension();
            $path_license = 'images/License';
            $request->u_license->move($path_license, $file_name_license);



            $driver = Driver::where("driver_id", $data['u_id'])->update([
                'license' =>  $file_name_license,

            ]);
            return response()->json(['driver' => $driver]);
        }elseif (array_key_exists('u_id_photo', $data) && !array_key_exists('u_license', $data)) {
            $user = User::where("id", $data['u_id'])->update([
                'user_name' => $data['user_name'],
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
            $id_photo = $request->u_id_photo;
            $file_name_id = date("Y-m-d", time()) . '_' . $data['user_name'] . '.' . $id_photo->getClientOriginalExtension();
            $path_ID = 'images/ID';
            $request->u_id_photo->move($path_ID, $file_name_id);



            $driver = Driver::where("driver_id", $data['u_id'])->update([
                'id_photo' => $file_name_id,


            ]);
            return response()->json(['driver' => $driver]);
        }else {

            $user = User::where("id", $data['u_id'])->update([
                'user_name' => $data['user_name'],
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
            ]);
            return response()->json(['user' => $user]);
        }
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $driver = Driver::findOrFail($id);
        $vehicle_id=$data['d_id'];
        $driver->delete();
        $user->delete();
        Vehicles::where('vehicle_id', $vehicle_id)->delete();
   
        $driver->forceDelete();
        $user->forceDelete();
        Vehicles::where('vehicle_id', $vehicle_id)->delete();
    

    //File::delete(public_path('images/ID/' . $driver->id_photo));
    //File::delete(public_path('images/license/' . $driver->id_photo));

   
    return response()->json(['driver' => $driver]);
}


}     
    

