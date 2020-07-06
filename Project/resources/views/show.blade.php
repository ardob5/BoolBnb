@extends('layouts.main_layout')

@section('content')
<div class="main_content">
  <div class="apartment">
    <div class="section1">
      <div class="apartment-img">
        @if (session('success'))
            <div class="alert alert-success text-center" role="alert">
              <strong>{{ session('success') }}</strong>
            </div>
        @endif

          {{-- CAROUSEL SHOW --}}
          @if (count($photos) > 0)
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
              <div class="carousel-inner">
                @foreach ($photos as $photo)
                  <div class="carousel-item
                  @if ($loop->first)
                    active
                  @endif
                  ">
                    <img class="d-block w-100"
                    @if(stristr($photo -> img_path, 'http'))
                        src=" {{ asset($photo -> img_path) }}"
                    @else
                        src="{{ asset('storage/' . $photo -> img_path) }}"
                    @endif
                    alt="{{ $apartment -> title }}">
                  </div>
                @endforeach
              </div>
            </div>
          @endif
      </div>
    </div>
    {{-- fine sezione 1 --}}
    {{-- inzio sezione 2 --}}
    <div class="section2">
      <div class="apartment-description">
        <div class="titleprice">
          <h1>{{ $apartment -> title }}</h1>
          <p>{{ $apartment -> price }} €</p>
        </div>
        <p>{{ $apartment -> description }}</p>
      </div>
      <div class="apartment-services">
        <ul>
          <li>owner: {{ $apartment ->user -> name}} {{ $apartment -> user-> lastName}}</li>
          <li>rooms' number: {{ $apartment -> room_number }}</li>
          <li>Posti letto</li>
          <li>bath's number: {{ $apartment -> bath_number}}</li>
          <li>area: {{ $apartment -> area }} mq</li>
          <li>address: {{ $apartment -> address }}</li>
          <li>optionals:
            @foreach ($optionals as $optional)
              <small>{{ $optional -> optional }}</small>
            @endforeach</li>
        </ul>
      </div>
    </div>
    {{-- fine sezione 2 --}}
    {{-- inzio sezione 3 --}}
    <div class="section3">
      <div class="apartment-location">
        <div class="gpsbox">
          <h1>SOME GPS SHIET</h1>
        </div>
      </div>
      <div class="apartment-mail">
        <h2>Scrivi al proprietario</h2>
        <input type="text" name="" placeholder="Inserisci la tua mail">
        <textarea name="name" rows="8" cols="50"></textarea>
        <button type="button" name="awe" value="">bottone inutile</button>
      </div>
    </div>
  </div>
</div>



@endsection
