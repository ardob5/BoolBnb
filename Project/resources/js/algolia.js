
//ALGOLIA API

var places = require('places.js');
var placesAutocomplete = places({
  appId: 'pl3MGAFPUYLC',
  apiKey: 'b9a43d62226d2109d529ba9f00f20cb8',
  container: document.querySelector('#algolia-input'),
  templates: {
    value: function(suggestion) {
      return suggestion.name;
    }
  }
}).configure({
  language: 'it',
  type: 'address'
});
