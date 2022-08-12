<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'notifi_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'trip_id',
        'message',
        'trip_end',
        'trip_status',
        'trip_type',
        'date',
        'clock',

    ];
}
