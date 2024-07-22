<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_name',
        'flight_iata',
        'departure_airport',
        'arrival_airport',
        'last_updated'
    ];
}
