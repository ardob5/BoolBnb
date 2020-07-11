@extends('layouts.main_layout')
@section('content')
<div>
  <div class="jumbotron jumbotron-fluid">
    <div class="overlay"></div>
      <div class="container container-input center_home">
        <div class="row justify-content-center">
          <h1 class="display-4">Home is where love resides.</h1>
        </div>
        <input type="search" class="form-control" id="search-search-bar"  name='search' placeholder="Cerca Località" value="">
      </div>
  </div>
</div>
<input class="filter" type="checkbox" name="optionals[]" value="1">
<label for="optionals">Pool</label>
<input class="filter" type="checkbox" name="optionals[]" value="2">
<label for="optionals">Security</label>
<input class="filter" type="checkbox" name="optionals[]" value="3">
<label for="optionals">Box-auto</label>
<input class="filter" type="checkbox" name="optionals[]" value="4">
<label for="optionals">wi-fi</label>
<input class="filter" type="checkbox" name="optionals[]" value="5">
<label for="optionals">Sauna</label>
<input class="filter" type="checkbox" name="optionals[]" value="6">
<label for="optionals">Sea-view</label>

<div class="">
  <select id="distance" class="filter" name="radius" id="radius">
    <option value="20">20 km</option>
    <option value="50">50 km</option>
    <option value="100">100 km</option>
  </select>
</div>

<div class="">
  <label for="rooms">N° minimo di stanze</label>
  <input class="filter" type="number" name="rooms" id="rooms">
</div>

<div class="">
  <label for="rooms">Numero minimo posti letto</label>
  <input class="filter" type="number" name="beds" id="beds">
</div>
      {{-- <script type="text/javascript" src="{{ asset('js/algolia.js') }}"></script> --}}
      {{-- APPARTAMENTI IN EVIDENZA --}}
      {{-- <div class="sponsored_container">
        <div class="container">
          <h2>In Evidenza</h2>
        </div>
        <div class="container-fluid">
          <div class="row justify-content-center">
            @foreach ($apartmentWithSponsor as $apartment)
              <div class="card" style="width: 18rem; margin: 15px 30px;">
                <img class="card-img-top" src="{{ $apartment -> image }}" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">{{ $apartment -> title }}<i class="fas fa-certificate" style="color: yellow; margin-left: 3px;"></i> <small>Sponsorizzato</small></h5>
                  <p class="card-text">{{ $apartment -> description }}</p>
                  <a href="{{ route('show', $apartment -> id) }}" class="btn btn-warning">Vedi Appartamento</a>
                </div>
              </div>
            @endforeach
          </div>
        </div> --}}
        {{-- @include('components.carousel') --}}
    @empty (!$apartmentWithSponsor)
      @include('components.carousel_one')
    @endempty
    <div class="row justify-content-center">
      @foreach ($apartments_no_sponsor as $nosponsorApt)
        <div class="card" style="width: 18rem; margin: 15px 30px;">
          <img class="card-img-top"
            @if(stristr($nosponsorApt -> image, 'http'))
                src=" {{ asset($nosponsorApt -> image) }}"
              @else
                src="{{ asset('storage/' . $nosponsorApt -> image) }}"
            @endif
            alt="{{ $nosponsorApt -> title }}">
          <div class="card-body">
            <h5 class="card-title">{{ $nosponsorApt -> title }}</h5>
            <p class="card-text">{{ $nosponsorApt -> description }}</p>
            <a href="{{ route('show', $nosponsorApt -> id) }}" class="btn btn-primary">Vedi Appartamento</a>
          </div>
        </div>
      @endforeach
    </div>
    <div class="row justify-content-center">
      {{ $apartments_no_sponsor -> links() }}
    </div>
@endsection
<input id="search-lat" type="hidden" name="search-lat" value="{{ $latitude }}">
<input id="search-lon" type="hidden" name="search-lon" value="{{ $longitude }}">
@section('script')
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/tomtom_search.js') }}"></script>
@endsection
