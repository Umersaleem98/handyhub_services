{{-- resources/views/components/map-picker.blade.php --}}
<div class="mb-3">
    <label class="form-label fw-semibold">Location</label>
    
    @php
        $apiKey = config('services.google.maps_api_key');
        $hasGoogleKey = !empty($apiKey) && $apiKey !== 'YOUR_GOOGLE_MAPS_API_KEY_HERE';
    @endphp
    
    <!-- Address Input -->
    <div class="input-group mb-3">
        <span class="input-group-text bg-white"><i class="bi bi-geo-alt text-secondary"></i></span>
        <input type="text" id="addressInput_{{ $id ?? 'default' }}" class="form-control-hp" 
               placeholder="Search your address..." autocomplete="off" value="{{ $address ?? '' }}">
    </div>
    
    <!-- Map Container -->
    <div id="map_{{ $id ?? 'default' }}" class="map-container-hp mb-3" style="background: #e5e7eb; position: relative;">
        @if(!$hasGoogleKey)
            <div class="position-absolute top-50 start-50 translate-middle text-center p-4">
                <i class="bi bi-map fs-1 text-secondary mb-2 d-block"></i>
                <div class="text-secondary small">Map view requires Google Maps API key</div>
                <div class="text-secondary small">Enter address manually below</div>
            </div>
        @endif
    </div>
    
    <!-- Hidden Inputs -->
    <input type="hidden" name="latitude" id="latitude_{{ $id ?? 'default' }}" value="{{ $latitude ?? '' }}" required>
    <input type="hidden" name="longitude" id="longitude_{{ $id ?? 'default' }}" value="{{ $longitude ?? '' }}" required>
    
    <!-- Manual Address Fields -->
    <div class="row g-3">
        <div class="col-md-8">
            <input type="text" name="address" class="form-control-hp" placeholder="Full Address" 
                   value="{{ $address ?? '' }}" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="city" class="form-control-hp" placeholder="City" 
                   value="{{ $city ?? '' }}">
        </div>
    </div>
</div>

@if($hasGoogleKey)
@push('scripts')
<script>
(function() {
    const mapId = 'map_{{ $id ?? 'default' }}';
    const inputId = 'addressInput_{{ $id ?? 'default' }}';
    const latId = 'latitude_{{ $id ?? 'default' }}';
    const lngId = 'longitude_{{ $id ?? 'default' }}';
    
    // Load Google Maps with async
    const script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&libraries=places&loading=async&callback=initMap_{{ $id ?? 'default' }}';
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
    
    window['initMap_{{ $id ?? 'default' }}'] = function() {
        const map = new google.maps.Map(document.getElementById(mapId), {
            center: { lat: 30.3753, lng: 69.3451 },
            zoom: 13,
            mapTypeControl: false,
            streetViewControl: false,
        });
        
        // Use AdvancedMarkerElement if available, fallback to Marker
        let marker;
        if (google.maps.marker && google.maps.marker.AdvancedMarkerElement) {
            marker = new google.maps.marker.AdvancedMarkerElement({
                map: map,
                position: { lat: 30.3753, lng: 69.3451 },
                gmpDraggable: true,
            });
        } else {
            marker = new google.maps.Marker({
                map: map,
                position: { lat: 30.3753, lng: 69.3451 },
                draggable: true,
            });
        }
        
        // Autocomplete with new API warning suppression
        const input = document.getElementById(inputId);
        const autocomplete = new google.maps.places.Autocomplete(input, {
            componentRestrictions: { country: 'pk' },
            fields: ['geometry', 'formatted_address', 'place_id'],
        });
        
        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            if (place.geometry) {
                const loc = place.geometry.location;
                map.setCenter(loc);
                map.setZoom(17);
                
                if (marker.setPosition) {
                    marker.setPosition(loc);
                } else if (marker.position) {
                    marker.position = loc;
                }
                
                document.getElementById(latId).value = loc.lat();
                document.getElementById(lngId).value = loc.lng();
                document.querySelector('input[name="address"]').value = place.formatted_address;
            }
        });
        
        // Click on map
        map.addListener('click', (e) => {
            if (marker.setPosition) {
                marker.setPosition(e.latLng);
            } else if (marker.position) {
                marker.position = e.latLng;
            }
            document.getElementById(latId).value = e.latLng.lat();
            document.getElementById(lngId).value = e.latLng.lng();
        });
    };
})();
</script>
@endpush
@else
{{-- No Google Key - Simple manual input with Pakistan cities dropdown --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addressInput = document.getElementById('addressInput_{{ $id ?? 'default' }}');
    const latInput = document.getElementById('latitude_{{ $id ?? 'default' }}');
    const lngInput = document.getElementById('longitude_{{ $id ?? 'default' }}');
    
    // Pakistan cities data
    const cities = {
        'karachi': [24.8607, 67.0011],
        'lahore': [31.5204, 74.3587],
        'islamabad': [33.6844, 73.0479],
        'rawalpindi': [33.5651, 73.0169],
        'faisalabad': [31.4180, 73.0790],
        'multan': [30.1575, 71.5249],
        'peshawar': [34.0151, 71.5249],
        'quetta': [30.1798, 66.9750],
    };
    
    addressInput.addEventListener('change', function() {
        const val = this.value.toLowerCase();
        for (const [city, coords] of Object.entries(cities)) {
            if (val.includes(city)) {
                latInput.value = coords[0];
                lngInput.value = coords[1];
                return;
            }
        }
        // Default
        latInput.value = 30.3753;
        lngInput.value = 69.3451;
    });
});
</script>
@endpush
@endif