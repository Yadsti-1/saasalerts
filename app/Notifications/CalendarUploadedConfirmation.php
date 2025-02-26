<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CalendarUploadedConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    public $calendarName;

    /**
     * Create a new notification instance.
     */
    public function __construct($calendarName)
    {
        $this->calendarName = $calendarName;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('✅ Calendario Subido Exitosamente')
            ->greeting('Hola ' . $notifiable->name . '!')
            ->line('Tu calendario ha sido subido con éxito.')
            ->line('📂 **Calendario:** ' . $this->calendarName)
            ->action('Ver Mis Calendarios', url('/mis-calendarios'))
            ->line('Gracias por contribuir al sistema.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'calendar_name' => $this->calendarName,
        ];
    }
}
