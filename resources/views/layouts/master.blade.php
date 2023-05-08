<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>VILLAMIN LARAVEL</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('src/css/app.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        @yield('styles')
    <style>
        body{
            background-color: #77ff77;
            }
        .container{
            background: #ff77ff;
            padding: 0.5%;
            }
        .topnav {
            background-color: #282A35;
            overflow: hidden;
            }
        .topnav a {
            float: left;
            color: #f1f1f1;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            letter-spacing: 1px;
            }
        .topnav a:hover {
            background-color: #000000;
            color: #f1f1f1;
            }
        .topnav a.active {
            background-color: #4CAF50;
            color: white;
            }
        .topnav-right {
            float: right;
            color: #f1f1f1;
            letter-spacing: 1px;
            }
        .noHover{
            pointer-events: none;
            }
    </style>
    </head>
    <body>
        <div class="topnav">
        <ul>
						@if (Auth::user()->role == "employee")
						<li>
                        <div class="topnav-right">
                            <a href='' class='btn noHover'>{{ Auth::user()->name }}</a>
                            <a><form method="POST" action="{{ route('logout') }}">{{ Form::token() }}
                            <button class="btn btn-danger" type="submit">{{ __('Logout') }}</button></form><a></div>
        				</li>
						@elseif (Auth::user()->role == "rescuer")
						<li>
                        <div class="topnav-right">
                            <a href='' class='btn noHover'>{{ Auth::user()->name }}</a>
                            <a><form method="POST" action="{{ route('logout') }}">{{ Form::token() }}
		                        <button class="btn btn-danger" type="submit">{{ __('Logout') }}</button></form><a></div>
						</li>
						@elseif (Auth::user()->role == "adopter")
						<li>
                        <div class="topnav-right">
                            <a href='' class='btn noHover'>{{ Auth::user()->name }}</a>
                            <a><form method="POST" action="{{ route('logout') }}">{{ Form::token() }}
                                <button class="btn btn-danger" type="submit">{{ __('Logout') }}</button></form><a></div>
						</li>
    					@else
						<li>
							<a href="/multiuser">Dashboard</a>
                            <a class="fa fa fa-paw" href="/animal">Animals</a>
                            <a class="fa fa fa-life-saver" href="/rescuer">Rescuers</a>
                            <a class="fa fa fa-thermometer-full" href="/disease_injury">Injuries</a>
                            <a class="fa fa-id-badge" href="/adopter">Adopters</a>
                            <a class="fa fa-group" href="/shelter_personnel">Personnels</a>
                            <a class="fa fa-user" href="/user">BanUser</a>
                        <ul class="navbar-nav mr-auto">
                            <form class="navbar-form navbar-left" method="POST" role="search" action="{{route('search')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="text" name="search" placeholder="Search">
                            <button type="submit" class="fa fa-search" style="padding: 5px;"></button>
                        </form>
                    </ul>
                        <div class="topnav-right">
                            <a href='' class='btn noHover'>{{ Auth::user()->name }}</a>
                            <a><form method="POST" action="{{ route('logout') }}">{{ Form::token() }}
	                            <button class="btn btn-danger" type="submit">{{ __('Logout') }}</button></form><a></div>
    						</li>
						@endif
						</ul>
						</div>
						</li>
					</ul>
        </div>
        <div class="container">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script
      src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
      <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    @yield('scripts')
    </body>
</html>