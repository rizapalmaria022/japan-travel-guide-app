<?php 

namespace App\Service;

use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Service\ApiConnectionService;

class WeatherService {
    
    public $apiConnectionService;

    public function __construct(ApiConnectionService $apiConnectionService)
    {
        $this->apiConnectionService = $apiConnectionService;
    }
    public function weatherDetails($data)
    {
        if( !is_null($data) ){
            $params ='forecast?lat='.$data['latitude'].'&lon='.$data['longitude'].'&units=metric&appid=300eb7dd43bdb180195ae7af92c15a86';
        }

        $request = $this->apiConnectionService->getDataInstance('weather',$params);

        $forecast = $this->getForcast($request['list']);
       
        return [
            'details'  => $request['city'], 
            'forecast' => $forecast
        ];
        
    }

    public function getForcast($list)
    {
       
        foreach ($list as $key => $value) {

            $date = Carbon::parse($value['dt_txt'])->toFormattedDateString();
            $time = Carbon::parse($value['dt_txt'])->format('h:i A');

            $result[] = [
                'id'       => $value['dt'],
                'temp_min' => floor($value['main']['temp_min']).'°',
                'time'     => $time, 
                'date'     => $date, 
                'icon'     => $value['weather'][0]['icon'].'@2x.png',
            ];
        }

        return $result;
    }

}