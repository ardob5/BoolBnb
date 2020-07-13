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
            <h6>{{ $apartment -> price }} €</h6>
          </div>
          <p>{{ $apartment -> description }}</p>
        </div>
        <div class="apartment-services">
          <ul>
            <li>owner: {{ $apartment ->user -> name}} {{ $apartment -> user-> lastName}}</li>
            <li>rooms' number: {{ $apartment -> room_number }}</li>
            <li>Posti letto: {{ $apartment -> beds }}</li>
            <li>bath's number: {{ $apartment -> bath_number}}</li>
            <li>area: {{ $apartment -> area }} mq</li>
            <li>address: {{ $apartment -> address }}</li>
            <li>Views:
              {{ count($apartment -> views)}}
            </li>
            <li>optionals:
                <ul>
                  @foreach ($optionals as $optional)
                  <li>
                    <small>{{ $optional -> optional }}</small>
                  </li>
                  @endforeach
                </ul>
              </li>
          </ul>
          @if ($apartment->user->id == Auth::id())
            <a href="{{route('stats', $apartment -> id)}}">Stats</a>
          @endif
        </div>
      </div>
      {{-- fine sezione 2 --}}
      {{-- inzio sezione 3 --}}
      <div class="section3">
        <div class="apartment-location">
          <div id='map' style='height:400px;width:500px'></div>
          <input type="hidden" id="latitude" value="{{$apartment -> latitude}}"></input>
          <input type="hidden" id="longitude" value="{{$apartment -> longitude}}"></input>
        </div>
        @if ($apartment->user->id !== Auth::id())
        <div class="apartment-mail">
          <h2>Richiedi informazioni</h2>
          <form action="{{ route('informations', $apartment -> id) }}" method="post" class="formarco">
            @csrf
            @method('POST')
            <input type="email" name="email" placeholder="Inserisci la tua mail" value="
            @auth
            {{ auth()->user()->email }}
            @endauth
            "class="@error('email') is-invalid @enderror">
            @error('email')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <textarea name="informations" rows="8" cols="50" value=" {{ old('informations') }}" class="@error('informations') is-invalid @enderror"></textarea>
            @error('informations')
            <small class="text-danger">{{ $message }}</small>
            @enderror
            <button type="submit" name="invia">Invia</button>
          </form>
        </div>
        @endif
      </div>
    </div>
  </div>
  @endsection

  @section('script')
    <script type="text/javascript" src="{{ asset('./js/tomtom_show.js') }}"></script>
  @endsection
