@extends('layouts.main_layout')

@section('content')
  <div class="main_content">
    <div class="jumbotron jumbotron-fluid">
      <div class="overlay"></div>
        <div class="container container-input center_home">
          <div class="row justify-content-center">
            <h1 class="display-4">La tua casa Ovunque</h1>
          </div>
          <div class="input-group">
            <div class="filter">

              {{-- INSERISCO IL FORM PER LA RICERCA --}}
              <form action="{{route('search')}}" method="get">
                @csrf
                @method('GET')
                <div class="form-group">
                  <div class="row justify-content-space-between">
                    <input type="search" class="form-control" style="width: calc(100% - 62.25px);" id="algolia-input" name='search' placeholder="Cerca Località" value="">
                    <input type="submit" id="submit" class="btn bnb_btn" value='Cerca'>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="container">
    @empty (!$apartments_sponsor)
      <div class="row mb-2">
        @foreach ($apartments_sponsor as $apartment)
          <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250 border_card">
              <div class="col-md-6">
                <img class="card-img-right flex-auto d-none d-md-block"
                @if(stristr($apartment -> image, 'http'))
                  src=" {{ asset($apartment -> image) }}"
                @else
                  src="{{ asset('storage/' . $apartment -> image) }}"
                @endif
                alt="Card image cap">
              </div>
              <div class="col-md-6">
                <div class="card-body d-flex flex-column align-items-start">

                  <h3 class="mb-0">
                    <a class="text-dark" href="{{ route('show', $apartment -> id) }}"> {{ $apartment -> title }} </a>
                    <span>
                      <strong class="d-inline-block mb-2 text-warning"><i class="fab fa-stripe-s"></i></strong>
                    </span>
                  </h3>
                  <div class="mb-1 text-muted">{{ $apartment -> created_at -> diffForHumans() }}</div>
                  <p>
                    <span>Posti Letto: {{$apartment -> beds}}</span> <br>
                    <span>Numero di stanze: {{$apartment -> room_number}}</span> <br>
                    <span>Bagni: {{$apartment -> bath_number}}</span>
                  </p>
                  <a href="{{ route('show', $apartment -> id) }}" class="btn bnb_btn">Vedi Appartamento</a>
                </div>
              </div>

            </div>
          </div>
        @endforeach
      </div>

      <div class="row justify-content-center mt-50">
        {{ $apartments_sponsor -> links() }}
      </div>
    @endempty
  </div>

@endsection
