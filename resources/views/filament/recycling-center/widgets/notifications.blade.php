<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold">Notifikasi</h2>
        <ul>
            @forelse ($this->getNotifications() as $notification)
                <li>{{ $notification->data['message'] }}</li>
            @empty
                <li>Tidak ada notifikasi.</li>
            @endforelse
        </ul>
    </x-filament::card>
</x-filament::widget>
