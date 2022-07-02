<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Speck</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- <link type="text/css" href="{{ asset('css/argon.css?v=1.0.0') }}" rel="stylesheet"> -->
        <link href="{{ asset('css/particle.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <!-- <canvas id="canvas"></canvas>
        <h1>Click Anywhere</h1> -->

        <!-- <div class="slider-box">
            <input id="slider" type="range" min="1" max="199" value="190"/>
            <div id="range">1000px / 10.0s</div>
        </div> -->
        <ul id="scene" data-friction-x="0.03" data-friction-y="0.05">
            <li class="layer" id="specks" data-depth="0.1"></li>
            <li class="layer" id="layer-1" data-depth="0.15">
                <div class="img" id="img-1"></div>
            </li>
            <li class="layer" id="layer-2" data-depth="0.25">
                <div class="img" id="img-2"></div>
            </li>
            <li class="layer" id="layer-3" data-depth="0.45">
                <div class="img" id="img-3"></div>
            </li>
        </ul>

        <div id="title" style="text-align: center;">
            <h1 class="text-center">Speck</h1>
            <h2>Simulasi AI untuk Mensimulasikan Penyebaran Partikel</h2>
            @if(@isset($message))
                <h3>{{$message}}</h3>
            @else
            <a href="{{ route('register') }}">
                <button type="button" class="btn btn-default">Daftar disini</button>
            </a>
            @endif
        </div>


        <script src="{{asset ('vendor/jquery/dist/jquery.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/2.1.3/jquery.parallax.min.js"></script>
        <script src="{{asset ('js/particle.js') }}"></script>
        <script src="{{asset ('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{asset ('js/argon.js?v=1.0.0') }}"></script>
    </body>
</html>


