<?php

namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LaporanDitolakNotification extends Notification
{
    use Queueable;

    private $laporan;
    private $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Laporan $laporan, string $message)
    {
        $this->laporan = $laporan;
        $this->message = $message;
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
            'laporan_id' => $this->laporan->id,
            'title' => 'Laporan' . $this->laporan->title,
            'message' => $this->message,
            'status' => $this->laporan->status,
        ];
    }
}
