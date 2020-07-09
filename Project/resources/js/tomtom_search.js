
$(document).ready(function(){

  $('#home-search-bar').keyup(function(){

  var city = $('#home-search-bar').val();
  console.log(city);

  var url = "https://api.tomtom.com/search/2/geocode/" + city + ".JSON?key=GA5MivJiK0ZxoB9tGaVHIhVkwckf4jOc";

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
