<?php

namespace App\Service\Api;

use Illuminate\Support\Facades\Http;

class FlightService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('AVIATIONSTACK_API_KEY');
    }

    public function fetchFlights()
    {
        $response = Http::get("http://api.aviationstack.com/v1/flights", [
            'access_key' => $this->apiKey
        ]);

        $flights = $response->json();

        return array_map(function ($flight){
            return [
                'airline_name' => $flight['airline']['name'],
                'flight_iata' => $flight['flight']['iata'],
                'departure_airport' => $flight['departure']['airport'],
                'arrival_airport' => $flight['arrival']['airport']
            ];
        }, $flights['data']);
    }
}
