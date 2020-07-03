<header>
  <div class="header-sx">
    <div class="header-logo">
      <i class="fas fa-hotel"></i>
      <h2>
        <a href="{{ route('home') }}"> BoolBnb</a>
      </h2>
    </div>
  </div>
  <div class="header-dx">
    <ul>
      <li><i class="fas fa-globe"></i></li>
      <li>
        <a href="{{ route('home')}}">Home</a>
      </li>
      @auth
        <li>
          <a href="#">Diventa un Host</a>
        </li>
      @endauth
      <li>
        <a href="#">Assistenza</a>
      </li>
        <!-- Authentication Links -->
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
  </div>
</header>
