// EVENTI E CHIAMATE AJAX NELLE PAGINE DI RICERCA APPARTAMENTO
$(document).ready(function(){

    var registerButton = $('.register-button');
    var scrolledButton = $('#scrolled-button');
    // header scroll
    $(document).scroll(function () {
        var scrollDocument = $(document).scrollTop();
        if (scrollDocument != 0) {
            $('.logobnb').attr('src', 'img/LOGO_UNO_MOD.png');
            $('header').css({
                'background-color': 'white',
                'box-shadow': '1px 1px 15px 5px grey'
            });
            $('.header-dx ul li a').css({
                'color': 'rgb(225, 60, 60)'
            });
            registerButton.addClass('scrolled');
        } else {
            $('.logobnb').attr('src', 'img/LOGO_UNO_MOD_BA.png');
            registerButton.removeClass('scrolled');
            $('header').css({
                'background-color': 'transparent',
                'box-shadow': 'none'
            });
            $('.header-dx ul a').css({
                'color': 'white'
            });
        }
        
    });
    // click sul scrolled-Button
    scrolledButton.click(function () {
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        })
    });
    // hover register-button
    registerButton.mouseenter(function(){
        registerButton.css({
            'background-color': 'rgb(225, 60, 60)',
        });
        $('.register-button a').css({
        'color': 'white',
        });
    });
    // hover register-button
    registerButton.mouseleave(function(){
        registerButton.css({
            'background-color': 'transparent'
        });
        if (registerButton.hasClass('scrolled')) {
            $('.register-button a').css({
                'color': 'rgb(225, 60, 60)',
            });
        } else {
            $('.register-button a').css({
                'color': 'white',
            });
        }
    });

    // filtro
    var optionals = [];

    // handlebars
    var source = $('#entry-template').html();
    var template = Handlebars.compile(source);

    $('.filter').change(function (e) {

        e.preventDefault();
        optionals = [];

        

        $('input[name="optionals[]"]:checked').each(function () {

            optionals.push($(this).val());
        })

        var radius = $('#distance').val();
        var rooms = $('#rooms').val();
        var beds = $('#beds').val();
        var lat = $('#search-lat').val();
        var lon = $('#search-lon').val();
        $('.container-apartments').html('');
        // 
        $('.main_content').css('opacity', '.4');
        $('.logobnb-loading').show();
        $.ajax({
            method: "GET",
            url: "http://localhost:8000/api/search/filter",
            data: {
                optionals: optionals,
                latitude: lat,
                longitude: lon,
                distance: radius,
                beds: beds,
                rooms: rooms
            },
            dataType: "json",
            success: function (response) {
               console.log(response)
               var data = response;
               $('.main_content').css('opacity', '1');
               $('.logobnb-loading').hide();

               if (data.length > 0) {
                   
                   for (var i = 0; i < data.length; i++) {
    
                       var apartment = data[i];
                       var context = {
                            title: apartment.title,
                            beds: apartment.beds,
                            rooms: apartment.room_number,
                            bath: apartment.bath_number,
                            price: apartment.price,
                            img: apartment.image,
                            id: apartment.id 
                       }
    
                       $('.container-apartments').append(template(context));
                
                   }
               } else {
                $('.container-apartments').append('<div class="alert alert-danger text-center" role="alert">' + '<strong class="text-danger">' + 'Nessun risultato trovato' + '</strong>' + '</div>');
               }

            }
        });
    });

    // evento al rilascio di un tasto sui tag input
    $('#submit-search').click(function(e){
      e.preventDefault();
      var city = $('#search-search-bar').val();
    // chiudo in una variabile il valore dell'input nella barra di ricerca
    
    if (city != '') {

       // preparo l'url personalizzato da dare in pasto all'api
      var url = "https://api.tomtom.com/search/2/geocode/" + city + ".JSON?key=A19bLrkzxbFaNdTAWvUaqCPN1NCB7UQH";
    
      // chiamata ajax per ottenere latitudine e longitudine partendo dalla città
      $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
    
          // chiudo in variabili i valori dati dall'api di latitudine e longitudine
            var lat = data.results[0]['position']['lat'];
            console.log(lat)
            var lon = data.results[0]['position']['lon'];
            console.log(lon)
            console.log(city);
    
            // inserisco i dati nell'hidden input che servirà a passarli al backend
            $('#hidden-lat-search').val(lat);
            $('#hidden-lon-search').val(lon);
  
            $('#form-search').submit();
        },
        error: function(error, status){
          console.log('errore:' + error);
          }
        });
    }
   
    });
  
    (function() {
      var placesAutocomplete = places({
        appId: 'pl3MGAFPUYLC',
        apiKey: 'b9a43d62226d2109d529ba9f00f20cb8',
        container: document.querySelector('#search-search-bar'),
        templates: {
          value: function(suggestion) {
            return suggestion.name;
          }
        }
      }).configure({
        type: 'city',
        aroundLatLngViaIP: false,
      });
    })();

  });
  