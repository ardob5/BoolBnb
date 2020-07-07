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
            </div>
        @endempty


        <h5>Inserisci il tuo appartamento</h5>
        <a href="{{ route('create') }}" type="button" class="btn btn-success">Vai</a>

    </div>
@endsection
