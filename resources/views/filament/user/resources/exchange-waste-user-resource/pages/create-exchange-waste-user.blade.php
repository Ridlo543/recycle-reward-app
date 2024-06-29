<x-filament-panels::page>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}
        <button type="button" onclick="getLocation()" class="filament-button">
            Dapatkan Lokasi
        </button>
        <x-filament::button type="submit">
            Tukar Sampah
        </x-filament::button>

    </form>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    @this.call('setLatitude', latitude);
                    @this.call('setLongitude', longitude);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
</x-filament-panels::page>
