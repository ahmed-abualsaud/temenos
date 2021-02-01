<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Temenos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ asset('welcome-page/css/main.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>




        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="header">
               <!-- <div class="shader"></div>-->
                @if (Route::has('login'))
                    <div class="top-right links">
                        @auth
                            <a href="{{ url('/index') }}">Home</a>
                        @else
                            <p>
                                <a href="{{ route('login') }}">
                                     <span>
                                        login
                                    </span>
                                </a>
                            </p>
                            @if (Route::has('register'))
                                <p>
                                    <a href="{{ route('register') }}">
                                        <span>
                                            signup
                                        </span>
                                    </a>
                                </p>
                            @endif
                        @endauth
                    </div>
                @endif

                <div class="info">
                    <div class="meta">
                        <a  href="#" target="_b" class="brand"></a><br>
                    </div>
                    <div class="title">
                        <h1>temenos</h1>
                    </div>
                    <h3 class="meta">24 hours per day</h3>
                </div>
            </div>

        </div>
    </body>
</html>