<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class GeocodingService
{
    public static function getCoordinates(string $address) {
        Http::fake([
            "https://maps.googleapis.com/*" => Http::response([
                "results" => [
                    [
                        "geometry" => [
                            "location" => [
                                "lat" => 37.4224764,
                                "lng" => -122.0842499
                            ]
                        ]
                    ]
                ]
            ])
        ]);

        $cacheKey = md5($address);

        $response = cache()->remember($cacheKey, 86400, function () use ($address) {
            return Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
                "address" => urlencode($address),
                "key" => config("google.api_key")
            ]);
        });

        return $response->json()["results"][0]["geometry"]["location"]; // lat/lng
    }
}
