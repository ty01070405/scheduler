<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ trans('general.page_title') }}</title>
	
	<!-- JavaScripts -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/spin.min.js"></script>
	<script src="js/common.js"></script>
	<script>
		var days = ['{{ trans('menu.sun') }}','{{ trans('menu.mon') }}','{{ trans('menu.tue') }}','{{ trans('menu.wed') }}','{{ trans('menu.thu') }}','{{ trans('menu.fri') }}','{{ trans('menu.sat') }}'];
		var months = ['{{ trans('menu.jan') }}', '{{ trans('menu.feb') }}', '{{ trans('menu.mar') }}', '{{ trans('menu.apr') }}', '{{ trans('menu.may') }}', '{{ trans('menu.jun') }}', '{{ trans('menu.jul') }}', 
			'{{ trans('menu.aug') }}', '{{ trans('menu.sep') }}', '{{ trans('menu.oct') }}', '{{ trans('menu.nov') }}', '{{ trans('menu.dec') }}'];
		
		$(document).ready(function() {
			if(this.location.href.slice(-1)=='/'){
				this_url = this.location.href.slice(0, -1);
			}else{
				this_url = this.location.href;
			}
			$('a[href="' + this_url + '"]').parent().addClass('active');
		});
	</script>
	
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <!-- Fonts -->
    <link href="css/font-awesome.min.css" rel='stylesheet' type='text/css'>

    <!-- Styles -->
	<link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'arial';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container" style="width:100%;">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img height="25px" src="images/sample_logo.png">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse" >
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
					@if(Auth::check())
						<li><a href="{{ url('/') }}">{{ trans('menu.team_schedule') }}</a></li>
						<li><a href="{{ url('/my_schedule') }}">{{ trans('menu.my_schedule') }}</a></li>
						<li><a href="{{ url('/project') }}">{{ trans('menu.project') }}</a></li>
						<li><a href="{{ url('/client') }}">{{ trans('menu.client') }}</a></li>
						<li><a href="{{ url('/department') }}">{{ trans('menu.department') }}</a></li>
						<li><a href="{{ url('/staff') }}">{{ trans('menu.staff') }}</a></li>
						<li><a href="{{ url('/admin') }}">{{ trans('menu.admin') }}</a></li>
					@endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('menu.login') }}</a></li>
                        <li><a href="{{ url('/register') }}">{{ trans('menu.register') }}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ trans('menu.logout') }}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</body>
</html>
