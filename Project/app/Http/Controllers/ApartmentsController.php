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

    $apartments_sponsor = collect($apartmentWithSponsor) -> paginate(6);

    return view('home', compact('apartments_sponsor'));
  }

  public function search(){

    $apartments = Apartment::all();
    $apartmentWithSponsor = [];
    $apartmentWithoutSponsor = [];
    foreach ($apartments as $apartment) {
      if ( count($apartment -> sponsors) > 0 ) {
        $apartmentWithSponsor[] = $apartment;
      }
      else {
        $apartmentWithoutSponsor[] = $apartment;
      }
    }

    $apartments_no_sponsor = collect($apartmentWithoutSponsor) -> paginate(12);

    return view('search', compact('apartmentWithSponsor', 'apartments_no_sponsor'));
  }


  public function show($id) {

    $apartment = Apartment::findOrFail($id);
    $photos = $apartment -> photos;
   

    return view('show', compact('apartment', 'photos'));
  }
}
