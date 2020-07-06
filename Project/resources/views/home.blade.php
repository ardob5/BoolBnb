@extends('layouts.main_layout')

@section('content')
  <div class="main_content">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">La tua casa Ovunque</h1>
        <div class="input-group">
          <div class="filter">

            {{-- INSERISCO IL FORM PER LA RICERCA --}}
            <form action="{{route('search')}}" method="get">
              @csrf
              @method('GET')
              <div class="form-group">
                <input type="search" class="form-control" id="algolia-input" name='search' placeholder="Cerca Località" value="">
              </div>
              <div class="form-check">
                <label class="prova" for="wi_fi">WiFi</label>
                <input name="wi_fi" type="checkbox" class="prova-input"  value="" id="wi_fi">
              </div>
              <input type="submit" id="submit" class="btn btn-primary" value='cerca'>
            </form>
            <script type="text/javascript" src="{{ asset('js/algolia.js') }}"></script>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="container">
  @empty (!$apartments_sponsor)
    <div class="row">
      @foreach ($apartments_sponsor as $apartment)
        <div class="card" style="width: 18rem; margin: 15px 30px;">
          <img class="card-img-top"
          @if(stristr($apartment -> image, 'http'))
              src=" {{ asset($apartment -> image) }}"
          @else
              src="{{ asset('storage/' . $apartment -> image) }}"
          @endif  
          alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{ $apartment -> title }}<i class="fas fa-certificate" style="color: yellow; margin-left: 3px;"></i> <small>Sponsorizzato</small> </h5>
            <p class="card-text">{{ $apartment -> description }}</p>
            <a href="{{ route('show', $apartment -> id) }}" class="btn btn-warning">Vedi Appartamento</a>
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
