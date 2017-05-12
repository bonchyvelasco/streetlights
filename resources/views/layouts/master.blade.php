<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>@yield('title')</title>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5-tH2P_lwRYhBjnSaFyfKBlYI9jxbIE"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <script>
            $(document).ready(function () {

                var menu = $('.menu');
                var origOffsetY = menu.offset().top;

                function scroll() {
                    if ($(window).scrollTop() >= origOffsetY) {
                        $('.navbar').addClass('navbar-fixed-top');
                        $('.content').addClass('menu-padding');
                    } else {
                        $('.navbar').removeClass('navbar-fixed-top');
                        $('.content').removeClass('menu-padding');
                    }
                }

                document.onscroll = scroll;

            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Smart Stoplights</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('/about#') }}">About<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/about#') }}">Page 1-1</a></li>
                    <li><a href="{{ url('/about#') }}">Page 1-2</a></li>
                    <li><a href="{{ url('/about#') }}">Page 1-3</a></li>
                </ul>
                </li>
                <li><a href="{{ url('/readings') }}">Readings</a></li>
                <li><a href="{{ url('/stoplights') }}">Stoplights</a></li>
            </ul>
            </div>
        </div>
        </nav>
        <div class="container-fluid" style = "padding: 0 50px;">
            <div class="page-header">
              <h1>@yield('content-header')</h1>
            </div>
            @yield('content')
        </div>
    </body>
</html>