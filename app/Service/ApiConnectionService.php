<?php 

namespace App\Service;

use GuzzleHttp\Client;

class ApiConnectionService {

    private $request;
    private $client;

    private function clientInstance($api)
    {
       
        switch ($api) {
            case 'weather':
                $path = [
                    'base_uri'    => env('WEATHER_API_URI'), 
                    'http_errors' => true, 
                    'headers'     => ['Content-Type' => 'application/json' ]
                ];
                break;
            case 'venue':

                $path = [
                    'base_uri'    => env('VENUE_API_URI'), 
                    'headers'     => [
                        'Accept'  => 'application/json', 
                        'Authorization' => 'fsq3vMAX78TUIaCaCLtmN/2fGGe42S8HURlAMN85LeVEijA=', 
                        ]
                ];
                break;
            
            default:
                $path = [];
                break;
        }
        
        return new Client($path);
    }

    public function getDataInstance($api, $params = '', $method = "GET")
    {
       
        $this->client = Self::ClientInstance($api);

        $request = $this->client->request($method,$params);

        $contents=  json_decode(($api == 'weather') ? $request->getBody()->getContents(): $request->getBody(),true);

        if(is_null($contents)){
            return (object)['status' => $request->getStatusCode()];
        }else{
            return $contents;
        }

        
    }

}