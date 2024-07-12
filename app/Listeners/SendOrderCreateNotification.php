<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Models\User;
use App\Notifications\OrderCreateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreateNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreate $event): void
    {
        $order=$event->order;
//        dd($order);
        //single user
        $user=User::where('store_id',$order->store_id)->first();
//        dd($user);
        $user->notify(new OrderCreateNotification($order));

        //many users
//        $users=User::where('store_id',$order->store_id)->get();
//        Notification::send($users,new OrderCreateNotification($order));
    }
}
