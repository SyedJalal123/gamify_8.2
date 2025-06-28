<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AdminNotificationComponent extends Component
{
    use WithPagination;
    public $type;

    #[On('notification-received')]
    public function refreshNotifications(){
        $count = count(auth()->user()->unreadnotifications);

        $this->dispatch('notifications-count-update', count: $count);
    }

    #[On('mark-as-read')]
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        $count = count(auth()->user()->unreadnotifications);
        $this->dispatch('notifications-count-update', count: $count);
    }

    #[On('mark-all-as-read')]
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        $count = count(auth()->user()->unreadnotifications);
        $this->dispatch('notifications-count-update', count: $count);
    }

    public function render()
    {
        if($this->type == 'header'){
            $notifications = auth()->user()->unreadnotifications()->paginate('6');
        }else {
            $notifications = auth()->user()->notifications()->paginate('20');
        }

        $notifications = $orders->merge($users)
                 ->sortByDesc('created_at')
                 ->take(6)
                 ->values();

        return view('livewire.admin-notification-component', [
            'notifications' => $notifications,
        ]);
    }
}
