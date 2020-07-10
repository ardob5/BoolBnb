//RICHIAMO API TOM TOM PER MOSTRARE UNA MAPPA CON MARCATORE NELLA PAGINA DI DETTAGLI APPARTAMENTO
$(document).ready(function(){

  // prendo i valori degli input lat e lon
  var longitude = $('#longitude').val();
  var latitude = $('#latitude').val();

  // chiudo in un array i valori precedenti
  var position = [ longitude, latitude ];

// richiamo la funzione di tom tom che permette di creare una mappa
  tomtom.setProductInfo('<your-product-name>', '<your-product-version>');
      var map = tt.map({
        container: 'map', //id del div che conterrà la mappa
        key: 'GA5MivJiK0ZxoB9tGaVHIhVkwckf4jOc', //chiave dell'api
        source: 'vector', //tipo di risorsa
        basePath: '/sdk', //cartella (locale) da cui l'api prenderà i dati
        center: position, //coordinate lat e lon (in array) su cui la mappa si centrerà
        zoom: 15 //valore dello zoom sulla mappa
      });

// creazione del marcatore sulla mappa 
  var marker = new tt.Marker().setLngLat(position).addTo(map);


});
