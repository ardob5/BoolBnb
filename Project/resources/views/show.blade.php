@extends('layouts.main_layout')

@section('content')
  <div class="main_content">
      <img src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
      <p>id appartamento : {{ $apartment -> id }}</p> 
      <p>title: {{ $apartment -> title }}</p>
      <p>description: {{ $apartment -> description }}</p>
      <p>address: {{ $apartment -> address }}</p>
      <p>rooms' number: {{ $apartment -> room_number }}</p>
      <p>bath's number: {{ $apartment -> bath_number}}</p>
      <p>area: {{ $apartment -> area }} mq</p>
      <p>price: {{ $apartment -> price }} €</p>
      <p>owner: {{ $apartment ->user -> name}} {{ $apartment ->user->lastName}}</p>

  </div>
@endsection
