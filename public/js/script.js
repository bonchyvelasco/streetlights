$(document).ready(function() {

    function initMap(){
	    var map = new google.maps.Map(document.getElementById('map'), {
	      center: {lat: 12.6, lng: 122.5},
	      scrollwheel: true,
	      zoom: 6
	    });	
	    return map;
    }
    function createIcon () {
		var icon = {
		    url: "http://www.i2clipart.com/cliparts/9/f/8/2/clipart-traffic-lights-9f82.png", // url
		    scaledSize: new google.maps.Size(25, 25), // scaled size
		    origin: new google.maps.Point(0,0), // origin
		    anchor: new google.maps.Point(0, 0) // anchor
		};
		return icon;
    }
    function createMarker(latlng,icn,name){
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: icn,
            title: name
        });   	
    }

    function searchStoplights(lat, lng){
    	$.post('http://location/searchStoplights',{lat:lat,lng:lng},function(match){
    	});
    }
    var map = initMap();
    var icon = createIcon();

    createMarker({lat:12.6,lng:122.5},icon,"Marker");
	var myvar = <?php echo json_encode($reading->r); ?>;
    document.write(myvar);

    // @foreach ($stoplights as $s)
    //     var myLatLng = {lat: $s->latitude, lng: $s->longitude};
        // var marker = new google.maps.Marker({
        //     position: myLatLng,
        //     map: map,
        //     title: $s->name
        // });
    //     <ul>
    //         <li>{{ $s->name }}</li>
    //         <li>{{ $s->longitude }}</li>
    //         <li>{{ $s->latitude }}</li>
    //         <li>{{ $s->status }}</li>
    //     </ul>
    // @endforeach
});