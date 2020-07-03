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

    $apartmentWithSponsor = [];
    $apartmentWithoutSponsor = [];
    $apartments = Apartment::all();
    foreach ($apartments as $apartment) {
      if ( count($apartment -> sponsors) > 0 ) {
        $apartmentWithSponsor[] = $apartment;
      }
      else {
        $apartmentWithoutSponsor[] = $apartment;
      }
    }

    $apartments_no_sponsor = collect($apartmentWithoutSponsor) -> paginate(10);

    return view('search', compact('apartments_no_sponsor', 'apartmentWithSponsor'));
  }

  public function show($id) {

    $apartment = Apartment::findOrFail($id);

    return view('show', compact('apartment'));
  }
}
