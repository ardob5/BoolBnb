@extends('layouts.main_layout')

@section('content')
    <div class="main_content">
        @empty(!$apartmentWithSponsor)
            <div class="row justify-content-center">
                @foreach ($apartmentWithSponsor as $apartment)
                    <div class="card text-white bg-warning mb-3" style="width: 18rem;">
                        <img
                        @if(stristr($apartment -> image, 'http'))
                            src=" {{ asset($apartment -> img_path) }}"
                        @else
                            src="{{ asset('storage/' . $apartment -> image) }}"
                        @endif
                        alt="{{ $apartment->title }}" class="card-img-top">
                        <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                        <p class="card-text">{{ $apartment-> description }}</p>
                        <a href="{{ route('show', $apartment->id) }}" class="btn btn-success">Dettagli</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endempty

        @empty(!$apartmentWithoutSponsor)
            <div class="row justify-content-center">
                @foreach ($apartmentWithoutSponsor as $apartment)
                    <div class="card text-white bg-info mb-3" style="width: 18rem;">
                        <img
                        @if(stristr($apartment -> image, 'http'))
                            src=" {{ asset($apartment -> img_path) }}"
                        @else
                            src="{{ asset('storage/' . $apartment -> image) }}"
                        @endif
                        alt="{{ $apartment->title }}" class="card-img-top">
                        <div class="card-body">
                        <h5 class="card-title">{{ $apartment->title }}</h5>
                        <p class="card-text">{{ $apartment-> description }}</p>
                        <div class="row">
                          <a href="{{ route('edit', $apartment->id) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ route('show', $apartment->id) }}" class="btn btn-success">Dettagli</a>
                          <a href="{{ route('delete', $apartment->id) }}" class="btn btn-danger">Elimina appartamento</a>
                        </div>
                        </div>
                    </div>
                @endforeach
                    <a href="{{ route('create') }}" type="button" class="btn btn-small">Inserisci appartamento</a>
                </div>
            </div>
        @endempty

        @if (count($apartmentWithSponsor) < 1 && count($apartmentWithoutSponsor) < 1)
            <div class="container">
                <div class="row mb-5">
                    <div class="col-sm-12">
                        <h1 class="text-center font-weight-bold">
                            Perchè inserire un appartamento
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="mb-3 font-weight-bold">
                            Pubblica il tuo annuncio gratuitamente
                        </h4>
                        <p>
                            Pubblica qualsiasi alloggio senza addebiti di registrazione, da un salotto condiviso a una seconda casa e a tutto quello che c'è nel mezzo.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="mb-3 font-weight-bold">
                            Stabilisci come vuoi affittare
                        </h4>
                        <p>
                            Scegli le date, i prezzi e i requisiti per gli ospiti. Siamo sempre a disposizione per aiutarti.
                        </p>
                    </div>
                    <div class="col-md-4">
                        <h4 class="mb-3 font-weight-bold">
                            Accogli il tuo primo ospite
                        </h4>
                        <p>
                            Una volta che il tuo annuncio viene pubblicato, gli ospiti idonei potranno contattarti. Puoi inviare loro delle domande prima del soggiorno.

                            Scopri come iniziare ad affittare
                        </p>
                    </div>
                </div>
                <div class="row my-apartments">
                    <div class="col-sm-12">
                        <div class="card bg-dark text-white">
                            <img class="card-img" src="{{ asset('img/img-myapartments.jpg') }}" alt="Card image">
                            <div class="overlay"></div>
                            <div class="card-img-overlay">
                                <a href="{{ route('create') }}" type="button" class="btn btn-large">Inserisci il tuo appartamento</a>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
