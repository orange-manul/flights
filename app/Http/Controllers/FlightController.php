<?php

namespace App\Http\Controllers;

use App\Service\Api\FlightService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    public function index()
    {
        $cacheKey = '$flights_data';
        $cacheTime = 60;

        $filteredFlights = Cache::remember($cacheKey, $cacheTime, function (){
           return $this->flightService->fetchFlights();
        });

//        // Сохранение данных в базу данных
//        foreach ($filteredFlights as $flightData) {
//            Flight::updateOrCreate(
//                ['flight_iata' => $flightData['flight_iata']],
//                array_merge($flightData, ['last_updated' => Carbon::now()])
//            );
//        }

        return response()->json(['data' => $filteredFlights]);
    }
}
