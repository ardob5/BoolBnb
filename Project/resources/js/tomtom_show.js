$(document).ready(function(){

  var longitude = $('#longitude').html();
  var latitude = $('#latitude').html();

  var position = [ longitude, latitude ];

  console.log(position );

  tomtom.setProductInfo('<your-product-name>', '<your-product-version>');
      var map = tt.map({
        container: 'map',
        key: 'GA5MivJiK0ZxoB9tGaVHIhVkwckf4jOc',
        source: 'vector',
        basePath: '/sdk',
        center: position,
        zoom: 20
      });

  var marker = new tt.Marker().setLngLat(position).addTo(map);


});
