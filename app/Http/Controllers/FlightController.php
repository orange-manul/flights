<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlightController extends Controller
{
    public function index()
    {
        $apiKey = env('AVIATIONSTACK_API_KEY');
        $response = Http::get("http://api.aviationstack.com/v1/flights", [
            'access_key' => $apiKey,
        ]);

        $flights = $response->json();

        return response()->json($flights);
    }
}
