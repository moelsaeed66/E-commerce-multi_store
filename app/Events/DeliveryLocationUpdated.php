<?php

namespace App\Events;

use App\Models\Delivery;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeliveryLocationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

public $lng;
public $lat;
protected $delivery;

    /**
     * Create a new event instance.
     */
    public function __construct($delivery,$lng,$lat)
    {
        $this->lng=$lng;
        $this->lat=$lat;
        $this->delivery=$delivery;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        //public channel
//        return [
//            new Channel('deliveries'),
//        ];

        //private channel
        return [
            new PrivateChannel('deliveries'.$this->delivery->order_id),
        ];
    }

    //return data
    public function broadcastWith()
    {
        return[
            'lng'=>$this->lng,
            'lat'=>$this->lat,
        ];
    }

    //listener name
    public function broadcastAs()
    {
        return 'location-updated';
    }

}
