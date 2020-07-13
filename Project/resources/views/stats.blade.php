@extends('layouts.main_layout')

@section('content')
  <div class="main_content">

    
    <input id="id_apt" type="hidden" name="" value="{{$id}}">

    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="chartOne">
            <canvas id="views" width="300" height="300"></canvas>
          </div>
        </div>
        <div class="col-md-6">
          <canvas id="messages" width="300" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{asset('js/stats.js')}}" charset="utf-8"></script>
@endsection
