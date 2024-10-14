<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MitraBaruNotification extends Notification
{
    use Queueable;

    private $mitra;

    /**
     * Create a new notification instance.
     */
    public function __construct($mitra)
    {
        $this->mitra = $mitra;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => '',
            'name_mitra' => $this->mitra->name_mitra,
            'name_company' => $this->mitra->name_company,
        ];
    }
}
