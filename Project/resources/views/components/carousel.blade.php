<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach ($apartmentWithSponsor as $apartment)

      <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop ->index }}" class=
        @if ($loop->first)
          "active"
        @endif
      ></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach ($apartmentWithSponsor as $apartment)
      <div class="carousel-item
      @if ($loop->first)
        active
      @endif
      ">


        <img class="d-block w-100" src="{{ $apartment -> image }}" alt="First slide">
        <div class="specific_apt">
          <h4>{{ $apartment -> title }} <i class="fas fa-certificate" style="color: yellow; margin-left: 3px;"></i></h4>
          <a href="#">Vai all'appartamento</a>
        </div>
      </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
