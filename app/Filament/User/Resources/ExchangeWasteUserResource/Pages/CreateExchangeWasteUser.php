<?php

namespace App\Filament\User\Resources\ExchangeWasteUserResource\Pages;

use App\Filament\User\Resources\ExchangeWasteUserResource;
use App\Models\RecyclingCenter;
use App\Models\WasteExchange;
use App\Notifications\ExchangeSubmittedNotification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Filament\Notifications\Notification;
use Filament\Notifications\Events\DatabaseNotificationsSent;

class CreateExchangeWasteUser extends CreateRecord
{
    use WithFileUploads;

    protected static string $resource = ExchangeWasteUserResource::class;
    protected $listeners = ['setLatitude', 'setLongitude'];

    protected function getFormModel(): WasteExchange
    {
        return $this->record;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        return $data;
    }

    public function setLatitude($latitude)
    {
        $this->form->fill(['latitude' => $latitude]);
    }

    public function setLongitude($longitude)
    {
        $this->form->fill(['longitude' => $longitude]);
    }

    public function getLocation()
    {
        $this->dispatchBrowserEvent('getLocation');
    }

    protected function afterCreate(): void
    {
        $recyclingCenter = $this->record->recyclingCenter;
        Notification::make()
            ->title('Pengguna baru saja menukar sampah')
            ->body('Pengguna ' . $this->record->user->name . ' telah menukar sampah dengan rincian yang ditentukan.')
            ->sendToDatabase($recyclingCenter);
        event(new DatabaseNotificationsSent($recyclingCenter));
    }
}
// protected function afterCreate(): void
    // {
    //     $recyclingCenter = RecyclingCenter::find($this->record->recycling_center_id);

    //     if ($recyclingCenter) {
    //         $details = [
    //             'message' => 'A new waste exchange has been submitted.',
    //         ];
    //         $recyclingCenter->notify(new ExchangeSubmittedNotification($details));
    //     }
    // }