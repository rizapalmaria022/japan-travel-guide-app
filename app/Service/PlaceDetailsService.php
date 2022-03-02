<?php 

namespace App\Service;

use GuzzleHttp\Client;
use App\Service\ApiConnectionService;

class PlaceDetailsService {
    
    public $apiConnectionService;

    public function __construct(ApiConnectionService $apiConnectionService)
    {
        $this->apiConnectionService = $apiConnectionService;
    }

    public function details($city)
    {
        $api_data = $this->apiConnectionService->getDataInstance('venue','v3/places/search?near='.$city.',&limit=5');
        
        if(!is_null($api_data)){

            $details = $this->getDetails($api_data['results']);

            if(!$details){
                return  [];
            }
            $data = [
                'latitude'  => $api_data['context']['geo_bounds']['circle']['center']['latitude'], 
                'longitude' => $api_data['context']['geo_bounds']['circle']['center']['longitude'], 
                'details'   => $details
            ];

        }

        return $data;
        
    }

    public function getDetails($details)
    {
        
        if(!is_null($details)){

            foreach ($details as $key => $value) {

                if($value['location']['country'] != 'JP'){
                    return false;
                }
                $photos = $this->apiConnectionService->getDataInstance('venue','v3/places/'.$value['fsq_id'].'/photos?limit=3&sort=NEWEST');

                $result[] = [
                    'id'    =>$value['fsq_id'],
                    'name'  => $value['name'],
                    'address'=> $value['location']['address'],
                    'cross_street' => $value['location']['address'], 
                    'formatted_address' => $value['location']['formatted_address'], 
                    'categories' => $value['categories'], 
                    'photos'    => $photos
                ];
            }

            
        }
        return $result;
    }

}