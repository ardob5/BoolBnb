<?php

namespace App\Http\Controllers;
use App\Apartment;
use App\Sponsor;

use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
  public function index()
  {
    return view('home');
  }

  public function search(Request $request){
    
    return view('search');
  }
}
