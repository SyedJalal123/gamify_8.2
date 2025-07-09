<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Mail\Mailable;
use App\Mail\OrderMail;

class BoostingRequestEmail extends Notification implements ShouldQueue
{
    use Queueable;
    public $data;

    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    {
        return (new MailMessage)
        ->from('support@gamify.com', 'Gamify')
        ->subject($this->data['title'])
        ->view('emails.new_order', ['data' => $this->data]);
    }

}
