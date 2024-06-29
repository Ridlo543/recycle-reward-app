<x-filament::button type="button" onclick="getLocation()" class="filament-button">
    Dapatkan Lokasi
</x-filament::button>

<script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                @this.set('data.latitude', latitude);
                @this.set('data.longitude', longitude);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
</script>
