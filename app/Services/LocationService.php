<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LocationService
{
    private ?string $apiKey;
    private bool $hasKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.maps_api_key');
        $this->hasKey = !empty($this->apiKey) && $this->apiKey !== 'YOUR_GOOGLE_MAPS_API_KEY_HERE';
    }

    /**
     * Check if Google Maps API is available
     */
    public function isAvailable(): bool
    {
        return $this->hasKey;
    }

    /**
     * Geocode address (with fallback)
     */
    public function geocodeAddress(string $address): ?array
    {
        if (!$this->hasKey) {
            return $this->fallbackGeocode($address);
        }

        $cacheKey = 'geocode_' . md5($address);
        
        return Cache::remember($cacheKey, now()->addDays(30), function () use ($address) {
            try {
                $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                    'address' => $address,
                    'key' => $this->apiKey,
                    'region' => 'pk',
                ]);

                if ($response->successful() && $response->json('status') === 'OK') {
                    $result = $response->json('results')[0];
                    $location = $result['geometry']['location'];
                    
                    return [
                        'latitude' => $location['lat'],
                        'longitude' => $location['lng'],
                        'formatted_address' => $result['formatted_address'],
                        'place_id' => $result['place_id'],
                    ];
                }
                return null;
            } catch (\Exception $e) {
                return null;
            }
        });
    }

    /**
     * Reverse geocode (with fallback)
     */
    public function reverseGeocode(float $lat, float $lng): ?array
    {
        if (!$this->hasKey) {
            return $this->fallbackReverseGeocode($lat, $lng);
        }

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'latlng' => "{$lat},{$lng}",
                'key' => $this->apiKey,
            ]);

            if ($response->successful() && $response->json('status') === 'OK') {
                $result = $response->json('results')[0];
                return [
                    'formatted_address' => $result['formatted_address'],
                    'place_id' => $result['place_id'],
                ];
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Calculate distance using Haversine formula (no API needed)
     */
    public function calculateDistance(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) * sin($dLng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return round($earthRadius * $c, 2);
    }

    /**
     * Fallback geocode for Pakistan cities (no API key)
     */
    private function fallbackGeocode(string $address): ?array
    {
        // Pakistan major cities coordinates
        $cities = [
            'karachi' => [24.8607, 67.0011],
            'lahore' => [31.5204, 74.3587],
            'islamabad' => [33.6844, 73.0479],
            'rawalpindi' => [33.5651, 73.0169],
            'faisalabad' => [31.4180, 73.0790],
            'gujranwala' => [32.1617, 74.1883],
            'sialkot' => [32.4945, 74.5229],
            'multan' => [30.1575, 71.5249],
            'peshawar' => [34.0151, 71.5249],
            'quetta' => [30.1798, 66.9750],
        ];

        $lower = strtolower($address);
        foreach ($cities as $city => $coords) {
            if (str_contains($lower, $city)) {
                return [
                    'latitude' => $coords[0],
                    'longitude' => $coords[1],
                    'formatted_address' => $address . ', Pakistan',
                    'place_id' => 'fallback_' . $city,
                ];
            }
        }

        // Default to center of Pakistan
        return [
            'latitude' => 30.3753,
            'longitude' => 69.3451,
            'formatted_address' => $address . ', Pakistan',
            'place_id' => 'fallback_pakistan',
        ];
    }

    /**
     * Fallback reverse geocode
     */
    private function fallbackReverseGeocode(float $lat, float $lng): ?array
    {
        return [
            'formatted_address' => "Location at {$lat}, {$lng}",
            'place_id' => 'fallback_location',
        ];
    }
}