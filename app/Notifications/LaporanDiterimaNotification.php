<?php

namespace App\Notifications;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LaporanDiterimaNotification extends Notification
{
    use Queueable;

    private $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
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
            'title' => 'Laporan "' . $this->laporan->title . '" Telah Diterima.',
        ];
    }
}
