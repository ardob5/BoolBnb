$(document).ready(function(){


  var latLong;

  $("#submit").click(function() {
    var latLong = $("#algolia-input").val();
  });



  var places = require('places.js');
  var placesAutocomplete = places({
    appId: 'pl3MGAFPUYLC',
    apiKey: 'b9a43d62226d2109d529ba9f00f20cb8',
    container: document.querySelector('#algolia-input'),
    templates: {
      value: function(value) {
        return suggestion.name;
      }
    }
  }).configure({
    language: 'it',
    aroundLatLng: latLong,
    aroundRadius: 20 * 1000,
  });
}); 
