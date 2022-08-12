<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Carbon;


class NewNotificationUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user_id;
    public $trip_id;
    public $trip_end;
    public $date;
    public $clock;
    public $message;
    public $trip_status;
    public $user_role;
    public $trip_type;




    public function __construct($notifi_data)
    {
        $this->user_id = $notifi_data['user_id'];
        $this->user_role = $notifi_data['user_role'];
        $this->message  = $notifi_data['message'];
        $this->trip_id = $notifi_data['trip_id'];
        $this->trip_end = $notifi_data['trip_end'];
        $this->trip_status = $notifi_data['trip_status'];
        $this->date =  $notifi_data['date'];
        $this->clock =  $notifi_data['clock'];
        $this->trip_type=$notifi_data['trip_type'];
       
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new channel('new_notification');
        //   return ['new_notification'];
        return ['new_notification' . $this->user_id ];
    }
    public function broadcastAs()
    {
        return 'my-event';
    }
}
