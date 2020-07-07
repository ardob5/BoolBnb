$(document).ready(function(){

  var longitude = $('#longitude').html();
  var latitude = $('#latitude').html();

  var position = [ longitude, latitude ];

  console.log(position );

  tomtom.setProductInfo('<your-product-name>', '<your-product-version>');
      var map = tt.map({
        container: 'map',
        key: 'GA5MivJiK0ZxoB9tGaVHIhVkwckf4jOc',
        style: 'tomtom://vector/1/basic-main',
        center: position,
        zoom: 15
      });

  var marker = new tt.Marker().setLngLat(position).addTo(map);

  var popupOffsets = {
    top: [0, 0],
    bottom: [0, -70],
    'bottom-right': [0, -70],
    'bottom-left': [0, -70],
    left: [25, -35],
    right: [-25, -35]
  };

});
