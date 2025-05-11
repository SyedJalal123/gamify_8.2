<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Carbon\Carbon;

class BoostingOfferNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $boostingOffer;

    /**
     * Create a new notification instance.
     */
    public function __construct($boostingOffer)
    {
        $this->boostingOffer = $boostingOffer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // dd($this->boostingOffer);
        return [
            'title' => $this->boostingOffer['title'],
            'data1' => $this->boostingOffer['data1'],
            'data2' => $this->boostingOffer['data2'],
            'link' => $this->boostingOffer['link'],
            'category' => 'notification',
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}
