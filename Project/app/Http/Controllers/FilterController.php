<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use DB;

class FilterController extends Controller {

    protected function findNearestHouse($latitude, $longitude, $radius = 20) {
        $apartments = DB::table('apartments') -> selectRaw("id, title, description, price, room_number, bath_number, beds, address, image, latitude, longitude, user_id ,
                         ( 6371 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance", [$latitude, $longitude, $latitude])
        ->having("distance", "<", $radius)
        ->orderBy("distance",'asc')
        ->get();

        return $apartments;
    }

    public function filterCheckbox(Request $request) {

    $apartments = Apartment::all();
    $latitude = $request -> latitude;
    $longitude = $request -> longitude;
    $radius = $request -> distance;
    $optionals_request = $request -> optionals;
    $filter_apartments = [];
    $id_optionals = [];
    $apartments_radius_filter = [];
    
    if (isset($optionals_request)) {
        //  filtro checkbox
        foreach ($apartments as $apartment) {
            $id_optionals = [];
            foreach ($apartment -> optionals as $optional) {
                $id_optionals[] = $optional -> id;
            }

            $result = array_intersect($optionals_request, $id_optionals);

            if ($result == $optionals_request) {
                $filter_apartments[] = $apartment;
            }
        }
    }

    // filtro distanza
    $apartments_radius = $this -> findNearestHouse($latitude, $longitude, $radius);

    if (count($filter_apartments) < 1) {
        
        return $apartments_radius;
        
    } else {

        // filtro distanza con filtro checkbox
        foreach ($apartments_radius as $apartment_radius) {
          
            foreach ($filter_apartments as $filter_apartment) {
                
                if ($apartment_radius -> id === $filter_apartment -> id) {
                    $apartments_radius_filter[] = $apartment_radius;
                }
            }
          }

          return $apartments_radius_filter;
    }

    
   
  
    
      // $optionals_filter = DB::table('apartment_optional') -> whereIn('optional_id', $optionals) -> get();
      // foreach ($optionals_filter  as $optional) {
      //   foreach ($apartments as $apartment) {
      //     if ($apartment -> id == $optional -> apartment_id) {
      //       $ciao[] = $apartment;
      //     }
      //   }
      // }
      
    
    
    }
}
