<?php

namespace App\Service\Api;

use Illuminate\Http\Client\RequestException;
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
        try {

            $response = Http::retry(3, 100)->timeout(60)->get("http://api.aviationstack.com/v1/flights", [
                'access_key' => $this->apiKey,
            ]);

            $flights = $response->json();

            return array_map(function ($flight) {
                // Проверяем, что flight_iata существует и не пустое
                if (isset($flight['flight']['iata']) && !empty($flight['flight']['iata'])) {
                    return [
                        'airline_name' => $flight['airline']['name'] ?? 'Unknown',
                        'flight_iata' => $flight['flight']['iata'],
                        'departure_airport' => $flight['departure']['airport'] ?? 'Unknown',
                        'arrival_airport' => $flight['arrival']['airport'] ?? 'Unknown',
                    ];
                }
                return null;
            }, $flights['data']);
        }catch (RequestException $e){
            return response()->json([
                'error' => 'Не удалось получить данные от API. Попробуйте позже.',
                'message' => $e->getMessage()
            ], 500);
    }
    }
}
