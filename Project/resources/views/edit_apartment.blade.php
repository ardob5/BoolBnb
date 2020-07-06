@extends('layouts.main_layout')

@section('content')

  <div class="main_content">
    <div class="container">
      <h2>Modifica il tuo appartamento</h2>
      <div class="row">
        <div class="col-md-10 mx-auto">
          <form action=" {{ route('update', $apartment -> id )}} " method="post" enctype="multipart/form-data" role="form">
            @method('POST')
            @csrf

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="title">Titolo</label>
                <input type="text" required name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Titolo dell'appartamento" value="{{ $apartment -> title }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-sm-6">
                <label for="address">Indirizzo</label>
                <input type="text" required name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Indirizzo" value="{{ $apartment -> address }}">
                @error('address')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="room_number">Numero di stanze</label>
                <input type="number" required name="room_number" id="room_number" class="form-control  @error('room_number') is-invalid @enderror" value="{{ $apartment -> room_number }}">
                @error('room_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-sm-6">
                <label for="bath_number">Numero di bagni</label>
                <input type="number" required name="bath_number" id="bath_number" class="form-control  @error('bath_number') is-invalid @enderror" value="{{ $apartment -> bath_number }}">
                @error('bath_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="area">Area</label>
                <input type="number" required name="area" id="area" class="form-control @error('area') is-invalid @enderror" value="{{ $apartment -> area }}">
                @error('area')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="col-sm-6">
                <label for="price">Prezzo in €</label>
                <input type="number" required name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $apartment -> price }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-6">
                <label for="image">Foto copertina appartamento</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="img_card">
                  <img
                      @if(stristr($apartment -> image, 'http'))
                          src=" {{ asset($apartment -> image) }}"
                      @else
                          src="{{ asset('storage/' . $apartment -> image) }}"
                      @endif
                      width="50" height="50" alt="{{ $apartment -> title }}">
                </div>
              </div>

              <div class="col-sm-6 d-flex justify-content-center">
                  @foreach ($apartment -> photos as $photo)
                    <div class="img_card">
                      <img
                        @if(stristr($photo -> img_path, 'http'))
                            src=" {{ asset($photo -> img_path) }}"
                        @else
                            src="{{ asset('storage/' . $photo -> img_path) }}"
                        @endif
                        width="50" height="50" alt="{{ $apartment -> title }}">
                    </div>
                  @endforeach
                  @if (count($apartment -> photos) < 4)
                    <div class="img_card">
                      <div class="image-upload">
                        <label for="file-input">
                          <i class="fas fa-upload"></i>
                        </label>
                        <input id="file-input" name="photos[]" id="photos" class="form-control" type="file" />
                      </div>
                    </div>
                  @endif
              </div>
            </div>

              <div class="form-group row">
                <div class="col-sm-12">
                  <div class="form-check">
                    <label>Optionals:</label>
                  </div>
                  @foreach ($optionals as $optional)
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="optionals[]" value="{{ $optional -> id}}"
                        @foreach ($apartment -> optionals as $apartmentWithOptional)
                          @if ($optional -> id == $apartmentWithOptional -> id)
                            checked
                          @endif
                        @endforeach
                      >
                      <label for="optionals[]">{{ $optional -> optional}}</label>
                    </div>
                  @endforeach
                </div>
              </div>

            <div class="form-group row">
              <div class="col-sm-12">
                <label for="description">Descrizione appartamento</label>
                <textarea rows="4" name="description" required id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Descrizione"> {{ $apartment -> description }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Modifica</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
