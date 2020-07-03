<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\Sponsor;
use DB;

use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
  public function index()
  {

    $apartmentWithSponsor = [];
    $apartments = Apartment::all();
    foreach ($apartments as $apartment) {
      if ( count($apartment -> sponsors) > 0 ) {
        $apartmentWithSponsor[] = $apartment;
      }
    }

    return view('home', compact('apartmentWithSponsor'));
  }
}
