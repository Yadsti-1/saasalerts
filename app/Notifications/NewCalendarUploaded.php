<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCalendarUploaded extends Notification implements ShouldQueue
{
    use Queueable;

    public $calendarName;
    public $uploadedBy;

    /**
     * Create a new notification instance.
     */
    public function __construct($calendarName, $uploadedBy)
    {
        $this->calendarName = $calendarName;
        $this->uploadedBy = $uploadedBy;
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
            ->subject('📅 Nuevo Calendario Subido')
            ->greeting('Hola ' . $notifiable->name . '!')
            ->line('Se ha subido un nuevo calendario al sistema.')
            ->line('📂 **Calendario:** ' . $this->calendarName)
            ->line('👤 **Subido por:** ' . $this->uploadedBy->name)
            ->action('Ver Calendario', url('/calendarios'))
            ->line('Gracias por usar nuestra aplicación.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'calendar_name' => $this->calendarName,
            'uploaded_by' => $this->uploadedBy->id,
        ];
    }
}
