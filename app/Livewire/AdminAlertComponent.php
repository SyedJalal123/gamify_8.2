<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AdminAlertComponent extends Component
{
    use WithPagination;
    public $type;

    #[On('notification-received')]
    public function refreshNotifications(){
        $count = count(auth()->user()->unreadnotifications()
            ->where('type', 'App\Notifications\OrderDisputedNotification')->get());

        $this->dispatch('notifications-count-update', count: $count);
    }

    #[On('mark-as-read')]
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        $count = count(auth()->user()->unreadnotifications()
            ->where('type', 'App\Notifications\OrderDisputedNotification')->get());
        $this->dispatch('notifications-count-update', count: $count);
    }

    #[On('mark-all-as-read')]
    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications()
            ->where('type', 'App\Notifications\OrderDisputedNotification')->get()->markAsRead();

        $count = count(auth()->user()->unreadnotifications()
            ->where('type', 'App\Notifications\OrderDisputedNotification')->get());
        $this->dispatch('notifications-count-update', count: $count);
    }

    public function render()
    {
        if($this->type == 'header'){
            $notifications = auth()->user()->unreadnotifications()
                ->where('type', 'App\Notifications\OrderDisputedNotification')->paginate('6');
        }else {
            $notifications = auth()->user()->notifications()
                ->where('type', 'App\Notifications\OrderDisputedNotification')->paginate('20');
        }

        return view('livewire.admin-alert-component', [
            'notifications' => $notifications,
        ]);
    }
}
