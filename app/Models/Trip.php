<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    protected $table='trip';
    public $timestamps = false;
    protected $fillable = [
       
        'start_point_longitude',
        'start_point_latitude',
        'end_point_longitude',
        'end_point_latitude',
        'start_time',
        'end_time',
        'driver_id',
        'available_size',
        'available_weight',
        'available_seats',
        'trip_status',
        'driver_rating',
        
    ];

}
