<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VILLAMIN LARAVEL</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            background-color: #77ff77;
            }
        .container{
            background: #ff77ff;
            padding: 0.5%;
            }
    </style>
    </head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <form class="navbar-form navbar-left" method="POST" role="search" action="{{route('search')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="search" placeholder="Search">
                            <button type="submit" class="fa fa-search" style="padding: 5px;"></button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <!-- <li>
                            <form method="POST" action="{{ route('logout') }}">
                                    {{ Form::token() }}
                                    <button type="submit">{{ __('Logout') }}</button>
                                </form>
                            </li> -->
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">Contact</a>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="/signin">Sign In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/signup">Sign Up</a>
                            </li> -->
                        @endif
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                            <form method="POST" action="{{ route('logout') }}">
                                    {{ Form::token() }}
                                    <button type="submit">{{ __('Logout') }}</button>
                                </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
</body>
</html>
