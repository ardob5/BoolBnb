<footer>
  <div class="lato-sx">
    <div class="logo">
      <img src="{{ asset('img/marcomaialona.png') }}" alt="">
    </div>
    <div class="text">
      <h1>
        Home is where love resides.
      </h1>
      <p>
        Il vero viaggio di scoperta non consiste nel cercare nuove terre, ma nell'avere nuovi occhi.
      </p>
    </div>
  </div>
  <div class="lato-dx">
    <div class="container-link">
      <div class="link1">
        <h1>
          Home
        </h1>
        <ul>
          <li>
            <a href="{{ route('home') }}">
              Home
            </a>
          </li>
        </ul>
        <ul>
          <li>
            <a href="http://localhost:8000/login">
              Assistenza
            </a>
          </li>
        </ul>
        <ul>
          <li>
            <a href="{{ route('my_apartments') }}">
              Appartamenti
            </a>
          </li>
        </ul>
      </div>
      <div class="link2">
        <h1>
         Login
        </h1>
        <ul>
          <li>
            <a href="#">
              Login
            </a>
          </li>
        </ul>
        <ul>
          <li>
            <a href="{{ route('register') }}">
              Registrati
            </a>
          </li>
        </ul>
        <ul>
          <li>
            <a href="{{ route('create') }}">
              Diventa Host
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="social">
      <a href="facebook"><img src="{{ asset('img/facebook.png') }}" alt=""></a>
      <a href="facebook"><img src="{{ asset('img/instagram.png') }}" alt=""></a>
      <a href="facebook"><img src="{{ asset('img/whatsapp.png') }}" alt=""></a>
    </div>
  </div>
</footer>
