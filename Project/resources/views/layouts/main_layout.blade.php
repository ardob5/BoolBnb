<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">



    <title>BoolBnb</title>
  </head>
  <body>
    @include('components.header')

    @yield('content')

    @include('components.footer')

    {{-- Scripts --}}
    <script src="https://kit.fontawesome.com/d99074f875.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
  </body>
</html>
