<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Smart Stoplight</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('css/main.css')}}">

    </head>
    <body>

        <!-- initializing map -->
        <div class="container text-center">
            <h1> <center> Smart Stoplights </center> </h1> 
        </div>


        <script crossorigin="anonymous" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" src="https://code.jquery.com/jquery-3.1.0.min.js">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
        </script>


        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <!--<div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>-->
<!--                 @foreach ($stoplights as $s)
                    var myLatLng = {lat: -25.363, lng: 131.044};

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        title: 'Hello World!'
                    });
                    <ul>
                        <li>{{ $s->name }}</li>
                        <li>{{ $s->longitude }}</li>
                        <li>{{ $s->latitude }}</li>
                        <li>{{ $s->status }}</li>
                    </ul>
                @endforeach -->

                @foreach ($readings as $reading)
                    <ul>
                        <li>{{ $reading->r }}</li>
                        <li>{{ $reading->g }}</li>
                        <li>{{ $reading->b }}</li>
                    </ul>
                    <script>

                    //     var myvar = <?php echo json_encode($reading->r); ?>;
                    //     document.write(myvar);
                    </script>
                @endforeach
                <div class = "links">
                    <a href = "{{ url('/readings/add')}}">Add Readings</a>
                </div>
            </div>
        </div>
    </body>
</html>
