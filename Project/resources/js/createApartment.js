$(document).ready(function () {

    var header = $('header');
    var links = $('header a');

    header.css({
        'background-color': 'white',
        'box-shadow': '1px 1px 15px rgba(0, 0, 0, .1)'
    });

    links.css({
        'color': 'rgb(225, 60, 60)'
    });

    $('#address').keyup(function(){

    var streetname = $('#address').val();

    var url = "https://api.tomtom.com/search/2/geocode/" + streetname + ".JSON?key=GA5MivJiK0ZxoB9tGaVHIhVkwckf4jOc";

    $.ajax({
      url: url,
      method: "GET",
      success: function (data) {

          var lat = data.results[0]['position']['lat'];
          var lon = data.results[0]['position']['lon'];

          console.log(lat + ', ' + lon );

          $('#hidden-lat').val(lat);
          $('#hidden-lon').val(lon);

      },
      error: function(error, status){
        console.log('errore:' + error);
        }
      });

    });

});
