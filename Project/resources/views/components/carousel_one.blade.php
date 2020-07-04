<div class="container cta-100 ">
        <div class="container">
          <div class="row blog">
            <div class="col-md-12">
              <div id="blogCarousel" class="carousel slide container-blog" data-ride="carousel" data-interval="7000">
                <h2>In evidenza</h2>
                <ol class="carousel-indicators">
                  @foreach ($apartmentWithSponsor as $apartment)
                    <li data-target="#blogCarousel" data-slide-to="{{ $loop ->index }}" class=
                      @if ($loop->first)
                        "active"
                      @endif
                    ></li>
                  @endforeach
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                  @foreach ($apartmentWithSponsor as $apartment)
                    <div class="carousel-item
                    @if ($loop->first)
                      active
                    @endif
                    ">
                      <div class="row">
                        <div class="col-md-12" >
                          <div class="item-box-blog">
                            <div class="item-box-blog-image">
                              <!--Date-->
                              <div class="item-box-blog-date bg-blue-ui white"> <span class="mon">Augu 01</span> </div>
                              <!--Image-->
                              <figure> <img alt="" src=""</figure>
                            </div>
                            <div class="item-box-blog-body">
                              <!--Heading-->
                              <div class="item-box-blog-heading">
                                <a href="#" tabindex="0">
                                  <h5>{{$apartment -> title}}</h5>
                                </a>
                              </div>
                              <!--Text-->
                              <div class="item-box-blog-text">
                                <p>{{$apartment -> title}}</p>
                              </div>
                              <div class="mt"> <a href="{{ route('show', $apartment -> id) }}" tabindex="0" class="btn bg-blue-ui white read">vai all'appartamento</a> </div>
                              <!--Read More Button-->
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--.row-->
                    </div>
                  @endforeach
                  <!--.item-->
                </div>
                <!--.carousel-inner-->
              </div>
              <!--.Carousel-->
            </div>
          </div>
        </div>
      </div>
