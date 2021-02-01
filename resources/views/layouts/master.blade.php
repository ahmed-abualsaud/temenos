<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Temenos</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('home-style/css/style.css')}}">
    <style type="text/css">
        .infocardContainer * {
          font-family: 'Fira Sans Condensed', sans-serif;
          font-weight: 300;
        }
        .infocardContainer {
          display: flex;
          height: 150px;
          width: 150px;
          border-radius: 100px;
          background: rgb(73,72,71);
          background: linear-gradient(121deg, rgba(255,255,255,0) 13%, rgba(73,72,71,1) 100%);
          transition: all 500ms ease-in;
          transition-delay: 10ms;
          margin: auto;
          margin-bottom: 50px;
          --margin-bottom: 50px;

        }
        .infocardContainer:hover {
          width: 400px;
          border-radius: 100px 10px 100px 100px;
          transition: all 1s ease-out;
        }

        .infocardContainer div {
          text-color: white;
          flex-shrink: 1;
          width: 100%;
          --background-color: green;
        }
        .infocardContainer div * {
          display: flex;
          --flex: inherit;
          overflow: hidden;
          text-overflow: hidden;
          --background-color: yellow;
          color: white;
          white-space: nowrap;
          width: 0;
          height: auto;
          transition: all 450ms ease-in;
          transition-delay: 10ms;
        }
        .infocardContainer:hover div *{
          --background-color: purple;
          display: flex;
          visibility: visible;
          transition: all 1s ease-out;
          transition-delay: 500ms;
          width: 100%;
          height: auto;
        }

        .infocardContainer #main, .infocardContainer #main img{
          --background-color: red;
          height: 150px;
          width: 150px;
          padding-right: 10px;
          border-radius: 100%;
          flex-shrink: 0;
          object-fit: cover;
        }
        .infocardContainer #main img{
          height: 150px;
          width: 150px;
          transition: none;
          display: float;
          position: relative;
          border: 10px solid white;
          margin: 0 0 0 0; padding: 0 0 0 0;
        }
        .infocardContainer #textbois {
          position: relative;
          margin-left: 3%;
        }
        .label {
          text-align: center;
        }
        .avatar {
          margin-left: -10px!important;
        }

        .upload {
          margin-left: 40px;
          background-color: orange;
          width: 70px!important;
          padding-left: 10px;
          border-radius: 5px;
          color: black!important;
        }

    </style>
    @yield('style')
</head>
<body>

    <div class="wrapper d-flex align-items-stretch">
    <nav style="z-index: 100;" id="sidebar">
        <div class="p-4 pt-5">
            <div class="infocardContainer">
                <div id="main">
                  @if(empty(auth()->user()->photo))
                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/ea/Dog_coat_variation.png"></img>
                  @else
                    <img src="{{asset('images/users/'.auth()->user()->photo)}}"></img>
                  @endif
                </div>
                <div id="textbois">
                    <h3>{{ auth()->user()->name }}</h3>
                    <a href="#">{{ auth()->user()->email }}</a>
                    <div class="label">Choose Photo
                      <a class="upload" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-upload-photo').submit();">
                          Upload
                      </a> 
                    </div>   
                    <form id="frm-upload-photo" action="{{ route('uploadPhoto') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="avatar">
                          <input type="file" name="photo">
                        </div>
                    </form>
                </div>
            </div>

            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="{{route('index')}}">Account Details</a>
                </li>
                <li>
                    <a href="{{route('transferView')}}">Money Transfer</a>
                </li>
                <li>
                    <a href="{{route('listTransactions', 10)}}">Transactions</a>
                </li>
            </ul>

            <div class="footer">
                <p>
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This design is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Sicoman</a>
                </p>
            </div>

        </div>
    </nav>

        <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>

                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                Logout
                          </a>    
                          <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @if (session('status'))
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            </div>
        @endif            

        @yield('content')
    </div>
</div>
    <script src="{{asset('home-style/js/jquery.min.js')}}"></script>
    <script src="{{asset('home-style/js/popper.js')}}"></script>
    <script src="{{asset('home-style/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('home-style/js/main.js')}}"></script>
    @yield('script')
</body>
</html>
