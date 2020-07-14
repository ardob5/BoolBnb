@extends('layouts.main_layout')

@section('content')
  <div class="main_content">
    <table class="table">
      <thead class="thead" style="background: rgb(225,60,60); color: #FFF;">
        <tr>
          <th scope="col">Data</th>
          <th scope="col">Email</th>
          <th scope="col">Testo</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($messages as $message)
          <tr>
            <td>{{ $message -> created_at -> diffForHumans()}}</td>
            <td>{{ $message -> email}}</td>
            <td>{{ $message -> text}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

@endsection
