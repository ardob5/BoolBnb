$(document).ready(function () {
    
    var header = $('header');
    var links = $('header a');
    var images = $('img');
    var overlay = $('.overlay-image');
    var img = $('<img></img>');

    header.css({
        'background-color': 'white',
        'box-shadow': '1px 1px 15px rgba(0, 0, 0, .1)'
    });

    links.css({
        'color': 'rgb(225, 60, 60)'
    });

    // overlay con immagine centrata
    overlay.html(img);

    images.click(function() {

        var src = $(this).attr('src');
        overlay.show();
        img.attr('src', src);
        console.log(src);
        
    });

    overlay.click(function() {

        overlay.hide();
    })

    // chiamata ajax per latitudine e longitudine
    $('input').keyup(function(){

        var address = $('#address').val();
        var city = $('#city').val();
        var civicNumber = $('#civicNumber').val();
        var postCode = $('#postCode').val();
        
        var url = "https://api.tomtom.com/search/2/structuredGeocode.JSON?key=GA5MivJiK0ZxoB9tGaVHIhVkwckf4jOc";


      
        $.ajax({
          url: url,
          method: "GET",
          data: {
              streetName: address,
              streetNumber: civicNumber,
              countryCode: 'IT',
              municipality: city,
              postalCode: postCode
          },
          success: function (data) {
      
              var lat = data.results[0]['position']['lat'];
              var lon = data.results[0]['position']['lon'];
      
              $('#latitude-edit').val(lat);
              $('#longitude-edit').val(lon);
      
          },
          error: function(error, status){
            console.log('errore:' + error);
            }
          });
      
        });

});