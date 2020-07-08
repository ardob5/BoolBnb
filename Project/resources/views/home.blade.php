@extends('layouts.main_layout')

@section('content')
  <div>
    {{-- HOME - JUMBOTRON --}}
    <div class="jumbotron jumbotron-fluid">
      <div class="overlay"></div>
        <div class="container container-input center_home">
          <div class="row justify-content-center">
            <h1 class="display-4">Home is where love resides</h1>
          </div>
          {{-- JUMBOTRON - SEARCHBAR --}}
          <div class="input-group">
            <div class="filter">

              {{-- SEARCH - FORM --}}
              <form action="{{route('search')}}" method="get">
                @csrf
                @method('GET')
                <div class="form-group">
                  <div class="row flex-nowrap justify-content-space-between">
                    <input type="search" class="form-control"  name='search' placeholder="Cerca Località" value="">
                    <input type="submit" id="submit" class="btn bnb_btn" value='Cerca'>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>

  {{-- HOME - SECTION-NORACISM' --}}
  <div class="container-fluid" style="margin-bottom: 2rem;">
    <div class="row">
      <div class="col-md-10 offset-1">
        <div class="no_racism">
          {{-- SPOT VUOTO --}}
          <div class="row" style="height: 120px;"><div class="col-md-12"></div></div>
          <div class="row">
            <div class="col-md-4" style="margin-left: 30px;">
              <h2>
                <b>
                  Noi stiamo con <br> #BlackLivesMatter
                </b>
              </h2>
              <h5>
                Crediamo in un futuro fondato sull’inclusione e il rispetto reciproco, nel quale il razzismo non ha posto.
              </h5>
            </div>
          </div>
        </div>
      </div>
      {{-- FIX OFFSET --}}
      <div class="col-md-1"></div>
    </div>
  </div>

  {{-- HOME - MAIN-CONTENT --}}
  <div class="container-fluid">
    <div class="row justify-content-around">
      {{-- HOME - LEFT - CONTENT --}}
      <div class="col-md-3 offset-1">
        <div class="aside_left">
          <div class="row">
            <div class="col-md-12 banner_container">
              <h1>Perché affittare su Boolbnb?</h1>
              <p>Indipendentemente dal tipo di alloggio o stanza che vuoi condividere, Airbnb rende semplice e sicuro ospitare dei viaggiatori. Spetta a te il controllo completo della disponibilità, dei prezzi, delle regole della casa e della modalità di interazione con gli ospiti.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 banner_container">
              <h1>Con noi sei al sicuro</h1>
              <p>Per tenere al sicuro te, il tuo alloggio e le tue cose, tuteliamo ogni prenotazione con una protezione in caso di danni alla casa di 1.000.000 USD e con un'altra assicurazione di pari valore contro gli incidenti.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 banner_container">
              <h1>Decidi il tuo prezzo</h1>
              <p>Hai sempre la possibilità di scegliere il prezzo. Serve aiuto? Abbiamo degli strumenti per aiutarti a soddisfare la domanda della tua zona.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 banner_container">
              <h1>Pagamenti rapidi</h1>
              <p>Siamo quattro scappati di casa non sappiamo ancora come farti pagare</p>
            </div>
          </div>
        </div>
      </div>

      {{-- HOME - RIGHT - CONTENT --}}
      <div class="col-md-8 justify-content-center">
        {{-- CREAZIONE CARD - SPONSORED --}}
        @empty (!$apartments_sponsor)
          <div class="row justify-content-center">
            @foreach ($apartments_sponsor as $apartment)
              <div class="col-md-10 offset-1">
                <div class="card flex-md-row mb-4 box-shadow h-md-250 onHover">
                  <div class="col-md-4  d-flex justify-content-center align-items-center">
                    <img class="card-img-right flex-auto d-none d-md-block"
                    @if(stristr($apartment -> image, 'http'))
                      src=" {{ asset($apartment -> image) }}"
                    @else
                      src="{{ asset('storage/' . $apartment -> image) }}"
                    @endif
                    alt="Card image cap">
                  </div>
                  <div class="col-md-5">
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
                        <span>Bagni: {{$apartment -> bath_number}}</span> <br>
                        <div class="hr_container">
                          <hr style="height:1px; color: lightgrey; width:100%; margin:2px 0;">
                          <span>$ a notte</span> <br>
                          <span class="total_prc">$ totale</span>
                        </div>
                      </p>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="from_bottom">
                      <a href="{{ route('show', $apartment -> id) }}" class="btn bnb_btn">Vai all'appartamento</a>
                    </div>
                  </div>
                </div>
              </div>
              {{-- FIX OFFSET --}}
              <div class="col-md-1"></div>
            @endforeach
          </div>

          {{-- PAGINATE - SPONSORED --}}
          <div class="row justify-content-center mt-50 ">
            {{ $apartments_sponsor -> links() }}
          </div>
        @endempty
      </div>
    </div>
  </div>
<button type="button" id="scrolled-button" class="btn btn-sm rounded">
  <i class="fas fa-angle-up"></i>
</button>
@endsection

@section('script')
    <script src="{{ asset('js/home.js') }}"></script>
@endsection
