<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Smart Stoplight</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

	<title>Smart Stoplights</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5-tH2P_lwRYhBjnSaFyfKBlYI9jxbIE"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

  <div class="container">
      <h1> <center> Smart Stoplights </center> </h1> 
  </div>
  <div id="map"></div>

  <script type="text/javascript">
    function createIcon () {
      var icon = {
          url: "http://www.i2clipart.com/cliparts/9/f/8/2/clipart-traffic-lights-9f82.png", // url
          scaledSize: new google.maps.Size(35, 35), // scaled size
          origin: new google.maps.Point(0,0), // origin
          anchor: new google.maps.Point(0, 0) // anchor
      };
      return icon;
    }
    var icon = createIcon();
    var stoplights = <?php print_r(json_encode($stoplights)) ?>;

    var map = new GMaps({
      el: '#map',
      lat: 21.170240,
      lng: 72.831061,
      center: {lat: 12.6, lng: 122.5},
      zoom:6
    });

    $.each( stoplights, function( index, value ){
      //0 is working, 1 is not working
      if (value.status == 0){
        map.addMarker({
          lat: value.latitude,
          lng: value.longitude,
          title: value.name,
          icon: icon,
          click: function(e) {
            alert('This is '+value.status+', gujarat from India.');
          }
        });
      }


   });

  </script>

</body>
</html>