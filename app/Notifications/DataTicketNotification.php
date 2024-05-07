<?php

namespace App\Notifications;

use App\Models\Data;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DataTicketNotification extends Notification
{
    use Queueable;

    public Data $ticket;
    public string $pdf;

    /**
     * Create a new notification instance.
     */
    public function __construct(Data $ticket, string $pdf)
    {
        $this->ticket = $ticket;
        $this->pdf = $pdf;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Your Kanastra Ticket')
                    ->line('Here is your latest ticket.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!')
                    ->attachData($this->pdf, 'ticket.pdf', [
                        'mime' => 'application/pdf',
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
            'message' => 'Your ticket has been processed.'
        ];
    }
}
