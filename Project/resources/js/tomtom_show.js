$(document).ready(function(){

  var longitude = $('#longitude').val();
  var latitude = $('#latitude').val();

  var position = [ longitude, latitude ];

  console.log(position );

  tomtom.setProductInfo('<your-product-name>', '<your-product-version>');
      var map = tt.map({
        container: 'map',
        key: 'GA5MivJiK0ZxoB9tGaVHIhVkwckf4jOc',
        source: 'vector',
        basePath: '/sdk',
        center: position,
        zoom: 15
      });

      console.log(longitude);
      console.log(latitude);
      
      

  var marker = new tt.Marker().setLngLat(position).addTo(map);


});
