// EVENTI E CHIAMATE AJAX NELLE PAGINE DI RICERCA APPARTAMENTO
$(document).ready(function(){

    // evento al rilascio di un tasto sui tag input
    $('#search-search-bar').keyup(function(){
  
    // chiudo in una variabile il valore dell'input nella barra di ricerca
    var city = $('#search-search-bar').val();
  
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
  
          // inserisco i dati nell'hidden input che servirà a passarli al backend
          $('#hidden-lat-search').val(lat);
          $('#hidden-lon-search').val(lon);
  
      },
      error: function(error, status){
        console.log('errore:' + error);
        }
      });
  
    });
  });
  