<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Service\Api\FlightService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class FlightController extends Controller
{
    protected $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    public function index()
    {
        $cacheKey = 'flights_data';
        $cacheTime = 60; // Время кэширования в минутах

        $filteredFlights = Cache::remember($cacheKey, $cacheTime, function () {
            return $this->flightService->fetchFlights();
        });

        // Фильтрация данных, удаление null значений
        $filteredFlights = array_filter($filteredFlights, function ($flightData) {
            return $flightData !== null;
        });

        // Сохранение данных в базу данных
        foreach ($filteredFlights as $flightData) {
            Flight::updateOrCreate(
                ['flight_iata' => $flightData['flight_iata']],
                array_merge($flightData, ['last_updated' => Carbon::now()])
            );
        }

//        return response()->json(['data' => $filteredFlights]);
        return view('flights.index', ['flights' => $filteredFlights]);

    }
}
