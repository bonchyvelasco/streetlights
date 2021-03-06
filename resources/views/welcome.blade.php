@extends('layouts.master')

@section('title')
    Smart Stoplights - Home
@endsection
    

@section('content-header')
    Welcome to Smart Stoplights!
@endsection

@section('content')
<div class="col-sm-8">
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

        function createMarkers () {
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
                    animation: google.maps.Animation.DROP,
                    });  
                    marker.addListener('click', function() {
                        // +alert('This is not working');
                        document.getElementById("header").innerHTML="Details";
                        document.getElementById("stoplight_name").innerHTML="Name of Place: "+value.name;
                        document.getElementById("stoplight_latitude").innerHTML="Latitude: "+value.latitude;
                        document.getElementById("stoplight_longitude").innerHTML="Longitude: "+value.longitude;
                        document.getElementById("stoplight_status").innerHTML="Status: "+value.error;
                        $("#stoplight_id").attr({
                            "value" : value.stoplight_id
                          });
                        $("#form").show();
                    });
                    markers.push(marker);
                }

            });

        }

        function reloadMarkers(){
            // Loop through markers and set map to null for each
            for (var i=0; i<markers.length; i++) {
                markers[i].setMap(null);
            }
            
            // Reset the markers array
            markers = [];
            
            // Call set markers to re-add markers
            createMarkers();
        }

        var markers = [];
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 12.6, lng: 122.5},
            zoom: 6
        }); 

        createMarkers();
        setInterval(function(){
            reloadMarkers();
        }, 5000);

    </script>
</div>
<div class="col-sm-4">
    <div class="row"> <h3 id = "header">Click a marker on the map to show details.</h3></div>
    <div class="row mx-auto my-auto"><h4 id = "stoplight_name" ></h4></div>
    <div class="row"><h4 id = "stoplight_latitude"></h4></div>
    <div class="row"><h4 id = "stoplight_longitude" ></h4></div>
    <div class="row"><h4 id = "stoplight_status"></h4></div>
    <form method = "POST" action = "{{ url('/stoplights/reset') }}" id = "form" style = "display:none">
        {{ csrf_field() }}
          <div class="form-group">
            <input type="hidden" class="form-control" name = "id" id="stoplight_id" value = "">
          </div>
      <button type="submit" class="btn btn-default">Reset</button>
    </form>
</div>
@endsection