@extends('layouts.main_layout')

@section('content')
<div class="main_content">
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

    <p>title: {{ $apartment -> title }}</p>
    <p>description: {{ $apartment -> description }}</p>
    <p>address: {{ $apartment -> address }}</p>
    <p>rooms' number: {{ $apartment -> room_number }}</p>
    <p>bath's number: {{ $apartment -> bath_number}}</p>
    <p>area: {{ $apartment -> area }} mq</p>
    <p>optionals:
      @foreach ($optionals as $optional)
        <small>{{ $optional -> optional }}</small>
      @endforeach</p>
    <p>price: {{ $apartment -> price }} €</p>
    <p>owner: {{ $apartment ->user -> name}} {{ $apartment -> user-> lastName}} </p>
  </div>

  @auth
    @if ($apartment->user->id == auth()->user()->id)
      <a href="{{ route('edit', $apartment ->id )}}"> Edit </a>
    @endif
  @endauth




@endsection
