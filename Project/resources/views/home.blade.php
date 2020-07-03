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
                <input type="search" class="form-control" name='search' placeholder="Cerca Località" value="">
              </div>
              <div class="form-check">
                <label class="prova" for="wi_fi">WiFi</label>
                <input name="wi_fi" type="checkbox" class="prova-input"  value="" id="wi_fi">
              </div>
              <input type="submit" class="btn btn-primary" value='cerca'>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <ul>
    @foreach ($apartmentWithSponsor as $sponsored)
      <li>
        {{ $sponsored -> title }} <br>
      </li>
    @endforeach
  </ul>
@endsection
