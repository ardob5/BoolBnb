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

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h3>Perchè affittare su BoolBnb?</h3>
        <p>
          Indipendentemente dal tipo di alloggio o stanza che vuoi condividere, Airbnb rende semplice e sicuro ospitare dei viaggiatori. Spetta a te il controllo completo della disponibilità, dei prezzi, delle regole della casa e della modalità di interazione con gli ospiti.
        </p>
      </div>
      <div class="col-md-6">
        <h3>Con noi sei al sicuro</h3>
        <p>
          Per tenere al sicuro te, il tuo alloggio e le tue cose, tuteliamo ogni prenotazione con una protezione in caso di danni alla casa di 1.000.000 USD e con un'altra assicurazione di pari valore contro gli incidenti.
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center">Ospitare in 3 passaggi</h2>
      </div>
      <div class="col-md-4">
        <h4>Pubblica il tuo annuncio gratuitamente</h4>
        <p>
          Pubblica qualsiasi alloggio senza addebiti di registrazione, da un salotto condiviso a una seconda casa e a tutto quello che c'è nel mezzo.
        </p>
      </div>
      <div class="col-md-4">
        <h4>Stabilisci come vuoi affittare</h4>
        <p>
          Scegli le date, i prezzi e i requisiti per gli ospiti. Siamo sempre a disposizione per aiutarti.
        </p>
      </div>
      <div class="col-md-4">
        <h4>Accogli il tuo primo ospite</h4>
        <p>
          Una volta che il tuo annuncio viene pubblicato, gli ospiti idonei potranno contattarti. Puoi inviare loro delle domande prima del soggiorno.

          Scopri come iniziare ad affittare
        </p>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row justify-content-around">
      <div class="col-md-3">
        <div class="banner">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, quisquam, quod doloremque inventore nihil, eos blanditiis vitae ullam sint saepe illum quasi? Ducimus nemo doloribus saepe laudantium tenetur porro labore.</p>
        </div>
      </div>
      <div class="col-md-9 justify-content-center">
        @empty (!$apartments_sponsor)
          <div class="row justify-content-center">
            @foreach ($apartments_sponsor as $apartment)
              <div class="col-md-4 reduction_card">
                <div class="card flex-md-row mb-4 box-shadow h-md-250 border_card onHover">
                  <div class="col-md-6  d-flex justify-content-center align-items-center">
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
    </div>
  </div>

@endsection
