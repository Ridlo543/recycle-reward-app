<x-filament::widget class="">
    <div class="flex flex-row items-center justify-center space-x-4">

        <x-filament::button tag="a" href="{{ route('filament.user.resources.exchange-waste-users.index') }}" outlined>
            <div class="flex flex-col items-center justify-center text-center">
                <x-heroicon-m-trash class="w-16 p-2 mb-1" />
                <span class="text-xs">Tukar Sampah</span>
            </div>
        </x-filament::button>
        <x-filament::button tag="a" href="{{ route('filament.user.resources.redeem-reward-users.index') }}" outlined>
            <div class="flex flex-col items-center justify-center text-center">
                <x-heroicon-m-gift class="w-16 p-12 mb-1" />
                <span class="text-xs">Tukar Reward</span>
            </div>
        </x-filament::button>
    </div>
</x-filament::widget>
