@extends('layouts.main_layout')

@section('content')
  <div class="main_content">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">La tua casa Ovunque</h1>
        <div class="input-group">
          <div class="filter">
            <form>
              <div class="form-group">
                <input type="search" class="form-control" placeholder="Cerca Località">
              </div>
              <div class="form-check">
                <label class="prova" for="wi_fi">WiFi</label>
                <input name="wi_fi" type="checkbox" class="prova-input"  value="" id="wi_fi">
              </div>
              <button type="submit" class="btn btn-primary">Cerca</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
