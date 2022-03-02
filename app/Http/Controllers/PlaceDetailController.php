<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\WeatherService;
use App\Service\PlaceDetailsService;

class PlaceDetailController extends Controller
{
    protected $weather_service;
    protected $place_details_service;
    
    public function __construct(WeatherService $weatherService, 
                                PlaceDetailsService $placeDetailsService)
    {
        $this->weather_service = $weatherService;
        $this->place_details_service= $placeDetailsService;
    }

    public function searchPlace(Request $request)
    {
        $request->validate([
            'city' => 'required',
        ]);
        
        $details = $this->place_details_service->details($request->city);
        if(!empty($details)){

            $weather = $this->weather_service->weatherDetails($details);

            $data = [
                'weather' => $weather, 
                'details' => $details
            ]; 
    
            return response()->json($data);
        }else{
            return response()->json(['error'  => "City is not Available"], 422);
        }
       
    }
}
