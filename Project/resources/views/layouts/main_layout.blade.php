<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel='stylesheet' type='text/css' href="{{ asset('sdk/map.css') }}">
    <script src="{{ asset('sdk/tomtom.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.37.2/maps/maps.css'/>
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.37.2/maps/maps-web.min.js'></script>
    <title>BoolBnb</title>
  </head>
  <body>
    @include('components.header')

    @yield('content')

    @include('components.footer')

    {{-- Scripts --}}
    <script src="https://kit.fontawesome.com/d99074f875.js" crossorigin="anonymous"></script>
    @yield('script')
    <script src="{{ asset('js/app.js')}}" charset="utf-8"></script>
  </body>
</html>
