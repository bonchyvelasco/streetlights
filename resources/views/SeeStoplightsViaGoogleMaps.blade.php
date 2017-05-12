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
    function createMarkers (map) {
        var icon = createIcon();
        var stoplights = <?php print_r(json_encode($stoplights)) ?>;
        $.each( stoplights, function( index, value ){
          //1 is working, 0 is not working
          if (value.status == 0){
            var marker = new google.maps.Marker({
                position: {lat: value.latitude, lng: value.longitude},
                map: map,
                title: value.name,
                icon: icon,
            });  
            marker.addListener('click', function() {
                alert('This is not working');
            });

          }


       });
    }
    

    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 12.6, lng: 122.5},
      zoom: 6
    }); 

    setInterval(function(){
      createMarkers(map);
    }, 5000);



  </script>

</body>
</html>