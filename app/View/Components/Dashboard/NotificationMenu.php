<?php

namespace App\View\Components\Dashboard;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationMenu extends Component
{
    public $notifications;
    public $newCount;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user=Auth::user();
        $this->notifications=$user->notifications()->limit(5)->get();//this relation from  Notifiable trait
        $this->newCount=$user->unreadNotifications()->count();//this relation from  Notifiable trait
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notification-menu');
    }
}
