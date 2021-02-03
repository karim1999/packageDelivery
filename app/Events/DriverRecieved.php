<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DriverRecieved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $name;
    public $id;
    public $status;
    public $lat;
    public $long;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name,$id,$status,$lat,$long)
    {
      $this->name = $name;
      $this->id = $id;
      $this->status = $status;
      $this->lat = $lat;
      $this->long = $long;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('drivers');
    }
    public function broadcastAs()
 {
     return 'update';
 }
}
