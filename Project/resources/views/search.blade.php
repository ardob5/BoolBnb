@extends('layouts.main_layout')
@section('content')
<div>
  <div class="jumbotron jumbotron-fluid">
    <div class="overlay"></div>
      <div class="container container-input center_home">
        <div class="row justify-content-center">
          <h1 class="display-4">Home is where love resides.</h1>
        </div>
        <form id="form-search" action="{{route('search')}}" method="get">
          @csrf
          @method('GET')
          <div class="form-group">
            <div class="row flex-nowrap justify-content-space-between">
              {{-- BARRA DI RICERCA --}}
              <input type="search" class="form-control" id="search-search-bar"  name='search' placeholder="Cerca Località" value="">
              {{-- SUBMIT --}}
              <input type="submit" id="submit-search" class="btn bnb_btn" value='Cerca'>

              <input type="hidden" name="lat" id="hidden-lat-search" value="">
              <input type="hidden" name="lon" id="hidden-lon-search" value ="">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
<div class="main_content">
  <div class="sponsored_and_filters">
    <div class="sponsored_carousel">
      @empty (!$apartmentWithSponsor)
        @include('components.carousel_one')
      @endempty
    </div>
    <div class="filters">
      <div class="filters_checkbox">
        <div class="checkboxup">
          <div class="checkboxes">
            <input class="filter" type="checkbox" name="optionals[]" value="1">
            <label for="optionals">Pool</label>
          </div>
          <div class="checkboxes">
            <input class="filter" type="checkbox" name="optionals[]" value="2">
            <label for="optionals">Security</label>
          </div>
          <div class="checkboxes">
            <input class="filter" type="checkbox" name="optionals[]" value="3">
            <label for="optionals">Box-auto</label>
          </div>
        </div>
        <div class="checkboxdown">
          <div class="checkboxes">
            <input class="filter" type="checkbox" name="optionals[]" value="4">
            <label for="optionals">wi-fi</label>
          </div>
          <div class="checkboxes">
            <input class="filter" type="checkbox" name="optionals[]" value="5">
            <label for="optionals">Sauna</label>
          </div>
          <div class="checkboxes">
            <input class="filter" type="checkbox" name="optionals[]" value="6">
            <label for="optionals">Sea-view</label>
          </div>
        </div>
      </div>
      <div class="filters_tendine">
        <div class="tendine">
          <p>Raggio di ricerca</p>
          <select id="distance" class="filter" name="radius" id="radius">
            <option value="20">20 km</option>
            <option value="50">50 km</option>
            <option value="100">100 km</option>
          </select>
        </div>
        <div class="tendine">
          <label for="rooms">Numero di stanze</label>
          <input class="filter" type="number" name="rooms" id="rooms">
        </div>
        <div class="tendine">
          <label for="rooms">Letti <br> necessari</label>
          <input class="filter" type="number" name="beds" id="beds">
        </div>
      </div>
    </div>
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
          <img class="logobnb-loading" src="{{asset('img/LOGO_UNO_MOD.png')}}" alt="logo_boolbnb">
      <div class="row justify-content-center container-apartments">
        @if(count($apartments_no_sponsor) < 1)
        <div class="alert alert-danger text-center" role="alert">
          <strong class="text-danger">Nessun risultato trovato</strong>
        </div>
        @else
          @foreach ($apartments_no_sponsor as $nosponsorApt)
          <div class="col-md-10 offset-1">
            <div class="card flex-md-row mb-4 box-shadow h-md-250 onHover">
              <div class="col-md-4  d-flex justify-content-center align-items-center">
                <img width="100%" class="card-img-right flex-auto d-none d-md-block"
                @if(stristr($nosponsorApt -> image, 'http'))
                  src=" {{ asset($nosponsorApt -> image) }}"
                @else
                  src="{{ asset('storage/' . $nosponsorApt -> image) }}"
                @endif
                alt="Card image cap">
              </div>
              <div class="col-md-4">
                <div class="card-body d-flex flex-column align-items-start">

                  <h3 class="mb-0">
                    <a class="text-dark" href="{{ route('show', $nosponsorApt -> id) }}"> {{ $nosponsorApt -> title }} </a>
                  </h3>

                  <p>
                    <span>Posti Letto: {{$nosponsorApt -> beds}}</span> <br>
                    <span>Numero di stanze: {{$nosponsorApt -> room_number}}</span> <br>
                    <span>Bagni: {{$nosponsorApt -> bath_number}}</span> <br>
                    <div class="hr_container">
                      <hr style="height:1px; color: lightgrey; width:100%; margin:2px 0;">
                      <span class="total_prc">{{ $nosponsorApt -> price }} € - Totale</span>
                    </div>
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="from_bottom">
                  <a href="{{ route('show', $nosponsorApt -> id) }}" class="btn bnb_btn">Vai all'appartamento</a>
                </div>
              </div>
            </div>
          </div>
          {{-- FIX OFFSET --}}
          <div class="col-md-1"></div>
          @endforeach
        </div>
      @endif
      <div class="row justify-content-center">
        {{ $apartments_no_sponsor -> links() }}
      </div>
  @endsection
  <input id="search-lat" type="hidden" name="search-lat" value="{{ $latitude }}">
  <input id="search-lon" type="hidden" name="search-lon" value="{{ $longitude }}">
</div>

    <!-- INIZIO HANDLEBARS -->
    <script id="entry-template" type="text/x-handlebars-template">
        <div class="col-md-10 offset-1">
          <div class="card flex-md-row mb-4 box-shadow h-md-250 onHover">
            <div class="col-md-4  d-flex justify-content-center align-items-center">
              <img width="100%" class="card-img-right flex-auto d-none d-md-block"

                src="storage/@{{img}}"

              alt="Card image cap">
            </div>
            <div class="col-md-4">
              <div class="card-body d-flex flex-column align-items-start">

                <h3 class="mb-0">
                  <a class="text-dark" href="/show/@{{ id }}"> @{{title}} </a>
                </h3>
                <p>
                  <span>Posti Letto: @{{beds}}</span> <br>
                  <span>Numero di stanze: @{{rooms}}</span> <br>
                  <span>Bagni: @{{bath}}</span> <br>
                  <div class="hr_container">
                    <hr style="height:1px; color: lightgrey; width:100%; margin:2px 0;">
                    <span class="total_prc">@{{ price }} € - Totale</span>
                  </div>
                </p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="from_bottom">
                <a href="/show/@{{ id }}" class="btn bnb_btn">Vai all'appartamento</a>
              </div>
            </div>
          </div>
        </div>
        <!-- FIX OFFSET -->
        <div class="col-md-1"></div>
    </script>
  <!-- FINE HANDLEBARS -->

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js"></script>
    <script src="{{ asset('js/tomtom_search.js') }}"></script>
@endsection
