@extends('layouts.main_layout')

@section('content')
  <div class="main_content">
    {{-- CAROUSEL SHOW --}}
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        @foreach ($photos as $photo)
          <div class="carousel-item
          @if ($loop->first)
            active
          @endif
          ">
            <img class="d-block w-100" src="{{ $photo -> img_path}}"
            alt="First slide">
          </div>
        @endforeach
      </div>
    </div>


    <p>description: {{ $apartment -> description }}</p>

    <p>address: {{ $apartment -> address }}</p>
    <p>rooms' number: {{ $apartment -> room_number }}</p>
    <p>bath's number: {{ $apartment -> bath_number}}</p>
    <p>area: {{ $apartment -> area }} mq</p>
    <p>price: {{ $apartment -> price }} €</p>
    <p>owner: {{ $apartment ->user -> name}} {{ $apartment -> user-> lastName}} </p>
  </div>



@endsection
