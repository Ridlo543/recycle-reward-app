<?php

namespace App\Notifications;

use Filament\Notifications\Notifiable as FilamentNotifiable;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Notifications\Notification;
use App\Models\WasteExchange;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WasteExchangeNotification extends Notification
{
    use Queueable;

    protected $wasteExchange;

    public function __construct(WasteExchange $wasteExchange)
    {
        $this->wasteExchange = $wasteExchange;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Notifikasi via email dan database
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Ada permintaan pertukaran sampah baru.')
            ->action('Lihat Detail', url('/recycleCenter/waste-exchanges/' . $this->wasteExchange->id))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Ada permintaan pertukaran sampah baru.',
            'wasteExchangeId' => $this->wasteExchange->id,
        ];
    }

    public function toFilamentDatabase($notifiable)
    {
        return FilamentNotification::make()
            ->title('Permintaan Pertukaran Sampah Baru')
            ->body('Ada permintaan pertukaran sampah baru.')
            ->actions([
                FilamentNotification::action('Lihat Detail', url('/recycleCenter/waste-exchanges/' . $this->wasteExchange->id)),
            ]);
    }

    public function toFilamentDatabasePolling($notifiable)
    {
        return $this->toFilamentDatabase($notifiable)
            ->polling('30s'); // Konfigurasi polling setiap 30 detik
    }
}
