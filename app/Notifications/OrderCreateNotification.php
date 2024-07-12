<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreateNotification extends Notification
{
    use Queueable;
    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return['database','broadcast'];
//        return['mail','database'];

//        $channels=['database'];
//        if($notifiable->notification_references['order_create']['sms']??false)
//        {
//            $channels[] ='voyage';
//        }
//        if($notifiable->notification_references['order_create']['mail']??false)
//        {
//            $channels[] ='mail';
//        }    if($notifiable->notification_references['order_create']['broadcast']??false)
//        {
//            $channels[] ='broadcast';
//        }
//            return $channels;
        }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr=$this->order->billingAddress;
        return (new MailMessage)
                    ->subject("New order #{$this->order->number}")
                    ->greeting("Hi,{$notifiable->name}")
                    ->line("New order (#{$this->order->number}) created at {$addr->name} from {$addr->country_name}.")
                    ->action('View order', url('/dashboard'))
                    ->line('Thank you for using our application!');
    }
    public function toDatabase(object $notifiable)
    {
        $addr=$this->order->billingAddress;
        return [
            'body'=>"New order (#{$this->order->number}) created at {$addr->name} from {$addr->country_name}.",
            'icon'=>"fas fa-envelope",
            'url'=>url('/dashboard')

        ];
    }
    public function toBroadcast(object $notifiable)
    {
        $addr=$this->order->billingAddress;
        return new BroadcastMessage([
            'body'=>"New order (#{$this->order->number}) created at {$addr->name} from {$addr->country_name}.",
            'icon'=>"fas fa-envelope",
            'url'=>url('/dashboard')

        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
